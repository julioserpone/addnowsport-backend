<?php

namespace App\Modelos;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Collection;

class Inscripto extends Model 
{
    use SoftDeletes;

    protected $table = 'inscriptos';

    public $timestamps = true;

    protected $dates = ['deleted_at','created_at','updated_at'];

	protected $hidden = ['deleted_at','created_at','updated_at'];


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    	'productora_id',
        'usuario_id',
		'competencia_id',
		'distancia_categoria_id', 
		'operacion_id', 
		'team_usuario_id',
		'fecha',
		'nro_corredor',
		'tiempo_1',
		'tiempo_2',
		'tiempo_3',
		'tiempo_4',
		'tiempo_t',
		'posicion',
		'genero',
		'edad', 
		'pais', 
		'status'	
    ];

   	public function productora() {

   		return $this->belongsTo('App\Modelos\Productora')->withTrashed();
   	}

   	public function usuario() {

   		return $this->belongsTo('App\Modelos\Usuario')->withTrashed();
   	}

   	public function competencia() {

   		return $this->belongsTo('App\Modelos\Competencia')->withTrashed();
   	}

   	public function distancia_categoria() {

   		return $this->belongsTo('App\Modelos\DistanciaCategoria')->withTrashed();
   	}

   	public function operacion() {

   		return $this->belongsTo('App\Modelos\Operacion')->withTrashed();
   	}

   	public function team_usuario() {

   		return $this->belongsTo('App\Modelos\TeamUsuario')->withTrashed();
   	}

   	public static function distancias_x_inscribir($fechas, $usuario, $data) {

   		$distancias_x_inscribir = Collection::make();   //Esto es para guardar locamente las fechas junto a la distancia-categoria donde voy a inscribir al participante
   		//Verificar que entre los inscriptos, el usuario no se encuentre en la fecha, distancia y categoria seleccionada (Crear proceso dentro de modelo INSCRIPTO)
        //Si llegase a estar inscripto en al menos una, le devuelvo un mensaje al front para indicar que debe cambiar la distancia y categoria seleccionada en esa fecha
        foreach ($fechas as $fecha => $detalle) {

            //Se obtiene el ID de la asociacion de Distancia-Categoria para una fecha. Luego, se verifica si esta seleccion junto al ID de la competencia, ya se encuentra registrado. De ser afirmativo, no se puede continuar con el proceso de inscripcion
            $distancia_categoria = DistanciaCategoria::with(['distancia','categoria'])->where('distancia_id', $detalle['distancia'])->where('categoria_id', $detalle['categoria'])->first();
            if ($distancia_categoria) {

            	//Validamos que esta dupla distancia-categoria no se encuentre inscrita para la competencia y usuario en consulta
            	$inscripto = self::where('productora_id', $data->get('productora_id'))
            						->where('competencia_id', $data->get('competencia_id'))
            						->where('usuario_id', $usuario->id)
            						->where('distancia_categoria_id', $distancia_categoria->id)
            						->first();

            	if ($inscripto) {
            		return [
            			'is_collection' => false,
            			'error' => trans('inscriptos.inscripto_distancia_categoria', ['categoria'=>$distancia_categoria->categoria->nombre, 'distancia'=>$distancia_categoria->distancia->nombre]),
            		];
            	}

                //Agrego esta asociacion de distancia-categoria a una collection generica, para luego utilizarla en el registro de inscriptos
                $distancias_x_inscribir = $distancias_x_inscribir
                    ->add([
                        'fecha_id' => $fecha,
                        'distancia_id' => $distancia_categoria->distancia_id,
                        'categoria_id' => $distancia_categoria->categoria_id,
                    ]);

            } else {
                return [
            			'is_collection' => false,
            			'error' => trans('inscriptos.distancia_categoria_no_relacionada'),
            		];
            }
        }
        return [
            	'is_collection' => true,
            	'data' => $distancias_x_inscribir,
            ];
   	}

}
