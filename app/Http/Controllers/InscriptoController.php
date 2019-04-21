<?php

namespace App\Http\Controllers;

/* -----------------------------------------
* GESTOR DE INSCRIPCIONES
* Autor: Julio Hernandez
--------------------------------------------*/ 
use App\Modelos\Categoria;
use App\Modelos\Codigo;
use App\Modelos\Competencia;
use App\Modelos\DistanciaCategoria;
use App\Modelos\Inscripto;
use App\Modelos\Usuario;
use App\Modelos\TeamUsuario;
use App\Http\Requests\RulesInscripcionPaso1;
use App\Http\Requests\RulesInscripcionPaso2;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Collection;

class InscriptoController extends Controller
{

    //Este metodo devuelve todos los datos necesarios para comenzar el proceso de inscripcion
    public function create($id) {

        $competencia = Competencia::FindWithRelations($id)->first();

        if ($competencia) {

            $usuario = Usuario::isAuthenticate();
            //Distancias registradas para la competencia
            $distancias = $competencia->distancias;
            //Categorias permitidas para el usuario, en funcion a su edad y a las categorias disponibles por la productora
            $categorias = Categoria::FromProductora($competencia->productora->id)->RangoPermitido($usuario)->get();

            $data = [
                'competencia' => [
                    'id' => $competencia->id,
                    'nombre' => $competencia->nombre,
                    'costo' => $competencia->costo,
                    'costo_individual' => $competencia->costo_individual,
                    'titulo' => $competencia->titulo,
                    'texto' => $competencia->texto,
                    'subtitulado' => $competencia->subtitulado,
                    'descripcion' => $competencia->descripcion,
                    'bases' => $competencia->bases,
                    'cantidad_integrantes' => $competencia->cantidad_integrantes,
                    'total_inscriptos' => 0,
                    'estatus' => $competencia->estatus,
                    'facebook' => $competencia->facebook,
                    'twitter' => $competencia->twitter,
                    'google' => $competencia->google,
                ],
                'productora' => [
                    'id' =>  $competencia->productora->id,
                    'nombre'=> $competencia->productora->nombre,
                    'razon_social'=> $competencia->productora->razon_social,
                    'correo'=> $competencia->productora->correo,
                    'telefono'=> $competencia->productora->telefono,
                    'avatar'=> $competencia->productora->avatar,
                ],
                'disciplina' => [
                    'id' => $competencia->disciplina->id,
                    'nombre' => $competencia->disciplina->nombre,
                ],
                'fechas' => $competencia->fechas,
                'distancias' => $distancias,
                'categorias' => $categorias,
                'teams' => $usuario->teams->where('estatus', 'activo'),
                'paises' =>trans('pais'),
            ];

            return response()->json(['data'=> $data], 200);
            
        }

    }

    public function store(RulesInscripcionPaso1 $request) 
    {

        //Antes de procesar la inscripcion, el metodo verifica los datos mediante un Validate Request
        
        $usuario = Usuario::isAuthenticate();
        $fechas = $request->fechas;
        $competencia = Competencia::where('id', $request->competencia_id)->first();
        $distancias_x_inscribir = Collection::make();   //Esto es para guardar locamente las fechas junto a la distancia-categoria donde voy a inscribir al participante
        $monto_pagar = ($request->tipo_inscripcion == 'grupal') ? $competencia->costo : $competencia->costo_individual;

        //Falta Registrar el equipo, en caso de que sea uno nuevo. Esto implica validar que este usuario no lo tenga previamente registrado
        $team = ($request->get('new_team')) ? $usuario->teams()->create(['nombre' => $request->get('new_team')])->id : $request->get('team');
        
        //Asociacion del equipo con el usuario
        $team_usuario = TeamUsuario::where('usuario_id', $usuario->id)->where('team_id', $team)->first();
        
        //Dependiendo de la forma de pago, proceso la inscripcion
        //Primero valido si el pago sera por codigo. Si el pago es combinado, primero procesamos el codigo, y una vez finalizado todo, envio una respuesta al front indicando que falta procesar el pago por webpay
        if (in_array('codigo', $request->medio_pago)) {
            
            //Validar que el monto y tipo de codigo sirva para ser utilizado para la inscripcion
            $codigo_aplicado = Codigo::aplicarCodigo($request->codigo_redencion, $request->competencia_id, $request->productora_id, $usuario);

            if ($codigo_aplicado) {

                $codigo = Codigo::FindWithRelations(['codigo' => $request->codigo_redencion])->first();
                $competencia = $codigo->competencia->where('id', $request->competencia_id)->first();

                //Si la competencia tiene cuota suficiente para procesar la inscripcion
                if (($competencia->cantidad_integrantes - $competencia->inscriptos->count()) >= $request->cantidad_participantes) {

                    //Collection de inscriptos en esta competencia
                    $inscriptos = $competencia->inscriptos->where('codigo_id', $codigo->id);

                    //Esto es para guardar locamente las fechas junto a la distancia-categoria donde voy a inscribir al participante
                    $distancias_x_inscribir = Inscripto::distancias_x_inscribir($fechas, $usuario, $request);

                    if (!$distancias_x_inscribir['is_collection']) {
                        return response()->json(['errors' => $distancias_x_inscribir['error']], 404);
                    }

                    //Si no esta inscripto en las fechas (con distancia y categoria), valido el monto del cupon
                    $monto_pagar = ($monto_pagar * $distancias_x_inscribir['data']->count() * $request->cantidad_participantes) - $competencia->pivot->valor_descuento;
                    
                    if (($monto_pagar > 0) && (!in_array('webpay', $request->medio_pago))) {
                        return response()->json(['errors' => trans('inscriptos.monto_insuficiente')], 404);
                    }

                    //Si el cupon cubre la inscripcion, proceso la inscripcion
                    $codigo_usado = CodigoUsado::create([
                        'codigo_id' => $codigo->id,
                        'usuario_id' => $usuario_id,
                        'productora_id' => $request->get('productora_id'),
                        'competencia_id' => $competencia->id,
                    ]);

                    //Si existe un remanente en el cupon, finalizo el actual, y le creo una codigo tipo nota de credito
                    
                    //En caso de campeonato, debo indicarle al front para que se pase al paso 2 (invitacion del resto del equipo). Se debe generar un codigo para este proceso
                } else {
                    return response()->json(['errors' => trans('inscriptos.cuota_inscriptos_superada')], 404);
                }

            }
            else 
                return response()->json(['data'=> false, 'errors' => trans('codigos.codigo_no_aplicable')], 404);
        }


        
    }

    public function update(RulesInscripcionPaso2 $request, $id)
    {

    }

}
