<?php

namespace App\Http\Controllers;

use App\Modelos\Competencia;
use App\Modelos\Fecha;
use App\Modelos\Galeria;
use App\Modelos\Imagen;
use App\Modelos\Patrocinador;
use App\Modelos\Premio;
use App\Modelos\Productora;
use App\Modelos\Puntaje;
use App\Modelos\Slider;
use App\Modelos\TemplateImagen;
use App\Modelos\TemplateSlider;
use App\Modelos\Usuario;
use App\Validaciones\ValidacionesCompetencias;
use App\Validaciones\ValidacionesProductoras;
use App\Validaciones\ValidacionesPuntajes;
use App\Validaciones\ValidacionesSlider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use League\Flysystem\Exception;

class CompetenciasController extends Controller
{

    /**
     * @api {post} /api/v1/productora/competencias Crea un nuevo registro de
     * competencias de una productora
     * @apiVersion 1.0.0
     * @apiName crearCompetencia
     * @apiGroup Productora
     * @apiHeader {String} Content-Type Tipo de contenido para el request enviado
     * @apiHeaderExample {json} Header-Example:
     * {
     *  "Content-Type": "application/json"
     * }
     * @apiParam {Integer} productora_id    Id Productora
     * @apiParam {Integer} disciplina_id    Id Disciplina
     * @apiParam {String} nombre            Nombre de la competencia
     * @apiParam {String} dominio           Dominio
     * @apiParam {String} subdominio        SubDominio
     * @apiParam {String} subdominio        SubDominio
     * @apiParam {Float} costo              Costo de la competencia
     * @apiParam {Float} costo_individual   Costo individual de la competencia
     * @apiParam {String} titulo            Título de la competencia
     * @apiParam {String} texto             Texto de la competencia
     * @apiParam {String} subtitulado       Subtitulado de la competencia
     * @apiParam {String} descripcion       Descripción de la competencia
     * @apiParam {String} bases             Bases de la competencia
     * @apiParam {Integer} cantidad_integrantes Cantidad de integrantes de la competencia
     * @apiParam {String} tipo              Tipo de la competencia
     * @apiParam {String} facebook          Facebook de la competencia
     * @apiParam {String} twitter           Twitter de la competencia
     * @apiParam {String} google            Google de la competencia

     * @apiParamExample {json} Request-Example:
     *    {
     *     "productora_id": 1,
     *         "disciplina_id" : 1,
     *         "nombre" : "Competencia Test",
     *         "dominio" : "dominio.test",
     *         "subdominio" : "sugdominio.test",
     *         "google" : "google test",
     *         "facebook" : "facebook test",
     *         "twitter" : "twitter test",
     *         "tipo": "campeonato",
     *         "status": "activo",
     *         "cantidad_integrantes": 10,
     *         "fechas":[ 
     *          "2016-11-01",
     *          "2016-11-02",
     *          "2016-11-03"
     *         ],
     *         "ubicaciones": [
     *          "Caracas",
     *          "Valcencia",
     *          "Maracay"
     *         ]
     * }
     * @apiSuccess {Integer} Competencia ID.
     *
     * @apiSuccessExample Success-Response:
     *     HTTP/1.1 200 OK
     *     {
     *       "id": 3
     *     }
     *
     * @apiError {json}  json   Retorna un json de estructura <code>{ "errors": false }</code>
     *
     * @apiErrorExample Error-Response:
     *     HTTP/1.1 404 Not Save
     *     {
     *        "errors": "CompetenciaNotSave"
     *     }
     */

    public function crearCompetencia(Request $request)
    {
        $usuario = Usuario::isAuthenticate();
        if ($usuario && ($usuario->productora_activa != null))
        {
            $request->merge(['productora_id' => $usuario->productora_activa]);
            $data = $request->all();
            $validator = ValidacionesCompetencias::crearCompetenciaValidacion($data);

            if ($validator->fails())
            {
                return response()->json(['data' => false, 'errors' =>
                    $validator->messages()->first()], 404);
            }

            $competencia = new Competencia();
            $competencia->fill($data);

            if ($competencia->save())
            {
                return response()->json(['data' => $competencia->id], 200);
            }

            return response()->json(['data' => false, 'errors' => $competencia->getErrors()], 404);
        }

        return response()->json(['errors' => trans('generals.insufficient_role')], 404);
    }

    public function crearSlidersCompetencia(Request $request)
    {
        $usuario = Usuario::isAuthenticate();
        if ($usuario &&  $usuario->productora_activa != null)
        {
            $request->merge(['productora_id' => $usuario->productora_activa, 'tipo' => 'competencia']);
            $data = $request->all();
            $validator = ValidacionesSlider::crearSliderValidacion($data);

            if ($validator->fails()) {
                return response()->json(['data' => false, 'error' =>
                    $validator->messages()->first()], 404);
            }

            $slider= TemplateSlider::where('id',$slider_id)->first();

            $fotos= TemplateImagen::where('templateSlider_id',$slider_id)->get();

            $slider['fotos']=$fotos;
        }
        return response()->json(['data' => false, 'errors' => trans('generals.insufficient_role')], 404);

    }

    public function agregarImagenPremio(Request $request)
    {
        $usuario = Usuario::isAuthenticate();
        if ($usuario && $usuario->productora_activa != null)
        {
            $request->merge(['productora_id' => $usuario->productora_activa, 'tipo' => 'Premio']);
            $data = $request->all();
            $result = $this->agregarImagen($data);
            if($result['data'])
            {
                return response()->json(['data' => true], 200);
            }

            return response()->json(['data' => false, 'errors' => $result['errors']], 404);
        }
        return response()->json(['data' => false, 'errors' => trans('generals.insufficient_role')], 404);

    }

    public function agregarImagenPatrocinador(Request $request)
    {
        $usuario = Usuario::isAuthenticate();
        if ($usuario && $usuario->productora_activa != null)
        {
            $request->merge(['productora_id' => $usuario->productora_activa, 'tipo' => 'Patrocinador']);
            $data = $request->all();
            $result = $this->agregarImagen($data);
            if($result['data'])
            {
                return response()->json(['data' => true], 200);
            }

            return response()->json(['data' => false, 'errors' => $result['errors']], 404);
        }
        return response()->json(['data' => false, 'errors' => trans('generals.insufficient_role')], 404);

    }

    public function agregarImagenGaleria(Request $request)
    {
        $usuario = Usuario::isAuthenticate();
        if ($usuario && $usuario->productora_activa != null)
        {
            $request->merge(['productora_id' => $usuario->productora_activa, 'tipo' => 'Galeria']);
            $data = $request->all();
            $result = $this->agregarImagen($data);
            if($result['data'])
            {
                return response()->json(['data' => true], 200);
            }

            return response()->json(['data' => false, 'errors' => $result['errors']], 404);
        }
        return response()->json(['data' => false, 'errors' => trans('generals.insufficient_role')], 404);

    }

    public function agregarSliderCompetencia(Request $request)
    {
        $usuario = Usuario::isAuthenticate();
        if ($usuario &&  $usuario->productora_activa != null) {
            $request->merge(['productora_id' => $usuario->productora_activa]);
            $data = $request->all();
            $validator = ValidacionesSlider::crearSliderValidacion($data);

            if ($validator->fails()) {
                return response()->json(['data' => false, 'error' =>
                    $validator->messages()->first()], 404);
            }

            $slider = new Slider();
            $slider->fill($data);
            return ($slider->save()) ? response()->json(['data' => $slider->id], 200) :
                response()->json(['data' => false, 'errors' => $slider->getErrors()], 404);

        }
        return response()->json(['data' => false, 'errors' => trans('generals.insufficient_role')], 404);

    }

    public function actualizarCompetenciaIncompleta(Request $request)
    {
        $usuario = Usuario::isAuthenticate();
        if ($usuario && ($usuario->productora_activa != null))
        {
            $data = $request->all();
            $validator = ValidacionesCompetencias::actualizarCompetenciaJSONValidacion($data);

            if ($validator->fails())
            {
                return response()->json(['status' => 'fail', 'errors' =>
                    $validator->messages()->first()], 404);
            }

            try
            {
                Competencia::where('id', $data['id'])->update(['json' => $data['json']]);
                return response()->json(['data' => true], 200);
            }catch (Exception $e)
            {
                return response()->json(['data' => false, 'errors' => 'No se pudo llevar a cabo la actualizacion: ' . $e], 404);
            }
        }

        return response()->json(['errors' => trans('generals.insufficient_role')], 404);
    }

    public function finalizar(Request $request)
    {
        $usuario = Usuario::isAuthenticate();
        if ($usuario && ($usuario->productora_activa != null))
        {

            return response()->json(['data' => true], 200);
        }

        return response()->json(['errors' => trans('generals.insufficient_role')], 404);
    }

    public function mostrarPuntajes(Request $request)
    {
        $usuario = Usuario::isAuthenticate();
        if ($usuario && ($usuario->productora_activa != null))
        {
            $request->merge(['productora_id' => $usuario->productora_activa]);
            $data = $request->all();
            $validator = ValidacionesPuntajes::mostrarPuntajeValidacion($data);

            if ($validator->fails())
            {
                return response()->json(['data' => false, 'errors' =>
                    $validator->messages()->first()], 404);
            }

            $competencia = Competencia::where('id', $data['competencia_id'])->where('productora_id', $data['productora_id'])->first();
            if (!is_null($competencia) || !empty($competencia))
            {
                $puntajes = Puntaje::where('id', $competencia['puntaje_id'])->get();
                if(!is_null($puntajes) || !empty($puntajes))
                {
                    return response()->json(['data' => $puntajes], 200);
                }

                return response()->json(['data' => false, 'errors' =>  'Esta competencia no tiene una tabla de puntajes asociada'], 404);
            }

            return response()->json(['data' => false, 'errors' => 'No existe la competencia'], 404);
        }

        return response()->json(['error' => trans('generals.insufficient_role')], 404);
    }

    public function mostrarEstados()
    {
        return response()->json(['data' => Competencia::select('estatus')->distinct()->get()], 200);
    }

    /**
     * @api {get} /v1/productora/competencias
     * Muestra las competencias de una productora
     * @apiVersion 1.0.0
     * @apiName MostrarCompetencia
     * @apiGroup Productora
     * @apiParam {Integer} productora_id    Id Productora

     * @apiSuccess (200) {json} Competencias
     *
     * @apiSuccessExample Success-Response:
     *     HTTP/1.1 200 OK
     *    {
     *   "data": [
     *     ...
     *      {
     *        "id": 11,
     *        "productora_id": 3,
     *        "disciplina_id": 5,
     *        "nombre": "quaerat",
     *        "dominio": "at",
     *        "subdominio": "molestias",
     *        "costo": "384.59",
     *        "costo_individual": "215.23",
     *        "titulo": "pariatur",
     *        "texto": "Pariatur similique et quaerat sed qui nihil fuga. Qui magnam ea nihil totam laudantium.",
     *        "subtitulado": "dolor",
     *        "descripcion": "Neque harum animi sequi itaque. Quibusdam soluta nihil veniam vitae.",
     *        "bases": "Provident et ea et dolor. Ipsam aliquam ut voluptatum necessitatibus. 
     *        "cantidad_integrantes": 12,
     *        "status": "activo",
     *        "tipo": "competencia",
     *        "facebook": "et",
     *        "twitter": "sapiente",
     *        "google": "tenetur",
     *        "deleted_at": null,
     *        "created_at": "1989-11-28 22:18:49",
     *        "updated_at": "1996-09-07 20:28:46"
     *      },
     *       ...
     *    ]
     *   }
     *
     * @apiError {json}  json   Retorna un json de estructura <code>{ "errors": false }</code>
     *
     * @apiErrorExample Error-Response:
     *     HTTP/1.1 404 Not Found
     *     {
     *        "data": false
     *     }
     */
    public function mostrarCompetencias(Request $request)
    {
        $usuario = Usuario::isAuthenticate();
        if ($usuario &&  $usuario->productora_activa != null)
        {
            $request->merge(['productora_id' => $usuario->productora_activa]);
            $data = $request->all();
            $validator = ValidacionesCompetencias::mostrarCompetenciasValidacion($data);

            if ($validator->fails()) {
                return response()->json(['status' => 'fail', 'errors' =>
                            $validator->messages()->first()], 404);
            }

            $competencias = Competencia::whereProductoraId($data['productora_id'])->get();

            return (count($competencias) > 0) ? response()->json(['data' => $competencias->toArray()], 200) :
                    response()->json(['data' => false], 404);
        }

        return response()->json(['errors' => trans('generals.insufficient_role')], 404);

    }

    public function mostrarProximasCompetencias(Request $request)
    {
        $usuario = Usuario::isAuthenticate();
        if ($usuario &&  $usuario->productora_activa != null) {
            $request->merge(['productora_id' => $usuario->productora_activa]);
            $data = $request->all();
            $validator = ValidacionesCompetencias::mostrarProximasCompetenciasValidacion($data);

            if ($validator->fails()) {
                return response()->json(['status' => 'fail', 'errors' =>
                    $validator->messages()->first()], 404);
            }

            //$startDate = Carbon::createFromFormat('Y-m-d', $data['fecha']);
            //$endDate = Carbon::createFromFormat('Y-m-d', $data['fecha'])->addMonth();
            //$competencias = Competencia::select('id')->whereProductoraId($data['productora_id'])->get()->toArray();
            //$fechas = Fecha::whereIn('competencia_id', $competencias)->whereBetween('fecha_competencia', array($startDate, $endDate))->get();
            $fechas = Fecha::all();
            $lista = [];
            foreach($fechas as $fecha)
            {
                $competencia = $fecha->competencia()[0];
                $fecha->nombre = $competencia->nombre;
                $fecha->url = $competencia->foto()[0]->foto;
                $lista[] = $fecha;

            }

            return response()->json(['data' =>  $lista, 200]);
        }

        return response()->json(['errors' => trans('generals.insufficient_role')], 404);

    }

    public function mostrarContinuar(Request $request, $id)
    {
        $usuario = Usuario::isAuthenticate();
        if ($usuario && ($usuario->productora_activa != null))
        {
            $request->merge(['id' => $id]);
            $request->merge(['productora_id' => $usuario->productora_activa]);
            $data = $request->all();
            $validator = ValidacionesCompetencias::continuarCompetenciaValidacion($data);

            if ($validator->fails())
            {
                return response()->json(['status' => 'fail', 'errors' =>
                    $validator->messages()->first()], 404);
            }

            $competencias = Competencia::where('id', $data['id'])->first()['json'];
            return response()->json(['data' => $competencias], 200) ;

        }

        return response()->json(['errors' => trans('generals.insufficient_role')], 404);
    }

    public function mostrarIncompletas(Request $request)
    {
        $usuario = Usuario::isAuthenticate();
        if ($usuario &&  $usuario->productora_activa != null)
        {
            $request->merge(['productora_id' => $usuario->productora_activa]);
            $data = $request->all();
            $validator = ValidacionesCompetencias::mostrarCompetenciasValidacion($data);

            if ($validator->fails())
            {
                return response()->json(['status' => 'fail', 'errors' =>
                    $validator->messages()->first()], 404);
            }

            $competencias = Competencia::select('id','json')->where('completa', false)->whereProductoraId($data['productora_id'])->get();

            return (count($competencias) > 0) ? response()->json(['data' => $competencias->toArray()], 200) :
                response()->json(['data' => false], 404);
        }

        return response()->json(['errors' => trans('generals.insufficient_role')], 404);
    }

    public function mostrarImagenPremio(Request $request, $id, $img)
    {
        $usuario = Usuario::isAuthenticate();

        if ($usuario &&  $usuario->productora_activa != null) {
            $request->merge(['productora_id' => $usuario->productora_activa, 'id' => $id]);
            $data = $request->all();
            $validator = ValidacionesCompetencias::listarImagenValidacion($data);

            if ($validator->fails()) {
                return response()->json(['data' => 'fail', 'error' =>
                    $validator->messages()->first()], 404);
            }

            $premios = Premio::select('imagen_id')->where('productora_id', $usuario->productora_activa)->where('competencia_id', $data['id'])->where('tipo', 'Premio')->get()->toArray();
            $fotos = Imagen::select('imagen')->whereIn('id', $premios)->get()->toArray();
            return response()->json(['data' => $fotos], 200);

        }

        return response()->json(['data' => false, 'errors' => trans('generals.insufficient_role')], 404);

    }

    public function mostrarImagenesPremio(Request $request, $id)
    {
        $usuario = Usuario::isAuthenticate();

        if ($usuario &&  $usuario->productora_activa != null) {
            $request->merge(['productora_id' => $usuario->productora_activa, 'id' => $id]);
            $data = $request->all();
            $validator = ValidacionesCompetencias::listarImagenesValidacion($data);

            if ($validator->fails()) {
                return response()->json(['data' => 'fail', 'error' =>
                    $validator->messages()->first()], 404);
            }

            $premios = Premio::select('imagen_id')->where('productora_id', $usuario->productora_activa)->where('competencia_id', $data['id'])->get()->toArray();
            $imagenes = Imagen::select('imagen')->whereIn('id', $premios)->get();
            return response()->json(['data' => $imagenes], 200);

        }

        return response()->json(['data' => false, 'errors' => trans('generals.insufficient_role')], 404);

    }

    public function mostrarImagenesPatrocinador(Request $request, $id)
    {
        $usuario = Usuario::isAuthenticate();

        if ($usuario &&  $usuario->productora_activa != null) {
            $request->merge(['productora_id' => $usuario->productora_activa,  'id' => $id]);
            $data = $request->all();
            $validator = ValidacionesCompetencias::listarImagenValidacion($data);

            if ($validator->fails()) {
                return response()->json(['data' => 'fail', 'error' =>
                    $validator->messages()->first()], 404);
            }

            $premios = Premio::select('imagen_id')->where('productora_id', $usuario->productora_activa)->where('competencia_id', $data['id'])->get()->toArray();
            $imagenes = Imagen::select('imagen')->whereIn('id', $premios)->get();
            return response()->json(['data' => $imagenes], 200);
        }

        return response()->json(['data' => false, 'errors' => trans('generals.insufficient_role')], 404);

    }

    public function mostrarImagenesGaleria(Request $request)
    {
        $usuario = Usuario::isAuthenticate();

        if ($usuario &&  $usuario->productora_activa != null) {
            $request->merge(['productora_id' => $usuario->productora_activa]);
            $data = $request->all();
            $validator = ValidacionesCompetencias::listarImagenesValidacion($data);

            if ($validator->fails()) {
                return response()->json(['data' => 'fail', 'error' =>
                    $validator->messages()->first()], 404);
            }

            $premios = Premio::select('imagen_id')->where('productora_id', $usuario->productora_activa)->where('competencia_id', $data['id'])->get()->toArray();
            $imagenes = Imagen::select('imagen')->whereIn('id', $premios)->get()->toArray();
            return response()->json(['data' => $imagenes], 200);

        }

        return response()->json(['data' => false, 'errors' => trans('generals.insufficient_role')], 404);

    }

    public function mostrarPorcentaje(Request $request)
    {
        $usuario = Usuario::isAuthenticate();
        if ($usuario && $usuario->productora_activa != null) {

            $data = ['productora_id' => $usuario->productora_activa];
            $validator = ValidacionesProductoras::existsProductoraValidacion($data);

            if ($validator->fails()) {
                return response()->json(['data' => false, 'error' =>
                    $validator->messages()->first()], 404);
            }

            $campos = 100;
            $total = 100 / 100;
            return response()->json(['data' => $campos * $total], 200);
        }

        return response()->json(['errors' => trans('generals.insufficient_role')], 404);
    }

    public function mostrarTemplatesSliders(Request $request)
    {
        $usuario = Usuario::isAuthenticate();
        if ($usuario &&  $usuario->productora_activa != null)
        {
            $request->merge(['productora_id' => $usuario->productora_activa]);
            $data = $request->all();
            $validator = ValidacionesProductoras::existsProductoraValidacion($data);

            if ($validator->fails()) {
                return response()->json(['data' => false, 'error' =>
                    $validator->messages()->first()], 404);
            }

            $sliders = TemplateSlider::select('id')->where('tipo','productora')->get();
            return  response()->json(['data' => $sliders], 200);
        }

        return response()->json(['data' => false, 'errors' => trans('generals.insufficient_role')], 404);
    }

    public function mostrarImagenesTemplateSliders(Request $request, $id)
    {
        $usuario = Usuario::isAuthenticate();
        if ($usuario && $usuario->productora_activa != null)
        {
            $request->merge(['id' => $id, 'productora_id' => $usuario->productora_activa]);
            $data = $request->all();
            $validator = ValidacionesSlider::getImagenesTemplateSlidersValidacion($data);

            if ($validator->fails()) {
                return response()->json(['data' => false, 'error' =>
                    $validator->messages()->first()], 404);
            }

            $productora = Productora::where('id', $data['productora_id'])->first()['nombre'];
            $sliders = TemplateImagen::select('imagen')->where('templateSlider_id', $data['id'])->get()->toArray();
            $result = [];
            foreach($sliders as $s)
            {
                $s['imagen'] = url("imagenesProductora/" . $productora . "/" . $s['imagen']);
                $result[] = $s;
            }

            return  response()->json(['data' => $result], 200);
        }

        return response()->json(['data' => false, 'errors' => trans('generals.insufficient_role')], 404);
    }

    /**
     * @api {get} /api/v1/productora/{productora_id}/competencias/{competencia_id}
     * Muestra la competencia de una productora
     * @apiVersion 1.0.0
     * @apiName MostrarCompetencia
     * @apiGroup Productora
     * @apiParam {Integer} productora_id    Id Productora
     * @apiParam {Integer} competencia_id   Id Competencia
     *
     * @apiSuccess (200) {json} Competencia
     *
     * @apiSuccessExample Success-Response:
     *     HTTP/1.1 200 OK
     *    {
     *   "data":
     *      {
     *        "id": 11,
     *        "productora_id": 3,
     *        "disciplina_id": 5,
     *        "nombre": "quaerat",
     *        "dominio": "at",
     *        "subdominio": "molestias",
     *        "costo": "384.59",
     *        "costo_individual": "215.23",
     *        "titulo": "pariatur",
     *        "texto": "Pariatur similique et quaerat sed qui nihil fuga. Qui magnam ea nihil totam laudantium.",
     *        "subtitulado": "dolor",
     *        "descripcion": "Neque harum animi sequi itaque. Quibusdam soluta nihil veniam vitae.",
     *        "bases": "Provident et ea et dolor. Ipsam aliquam ut voluptatum necessitatibus. 
     *        "cantidad_integrantes": 12,
     *        "status": "activo",
     *        "tipo": "competencia",
     *        "facebook": "et",
     *        "twitter": "sapiente",
     *        "google": "tenetur",
     *        "deleted_at": null,
     *        "created_at": "1989-11-28 22:18:49",
     *        "updated_at": "1996-09-07 20:28:46"
     *      },
     *   }
     *
     * @apiError {json}  json   Retorna un json de estructura <code>{ "errors": false }</code>
     *
     * @apiErrorExample Error-Response:
     *     HTTP/1.1 404 Not Found
     *     {
     *        "data": false
     *     }
     */
    public function mostrarCompetencia(Request $request, $id)
    {
        $usuario = Usuario::isAuthenticate();
        if ($usuario &&  $usuario->productora_activa != null)
        {
            $request->merge(['productora_id' => $usuario->productora_activa, 'id' => $id]);
            $data = $request->all();
            $validator = ValidacionesCompetencias::mostrarCompetenciaValidacion($data);

            if ($validator->fails()) {
                return response()->json(['status' => 'fail', 'errors' =>
                    $validator->messages()->first()], 404);
            }

            $competencia = Competencia::whereId($data['id'])
                ->whereProductoraId($data['productora_id'])->with('fechas')->with('avatar')->with('tabla')->first();

            return (count($competencia) > 0) ? response()->json(['data' => $competencia->toArray()], 200) :
                response()->json(['data' => false], 404);
        }

        return response()->json(['errors' => trans('generals.insufficient_role')], 404);
    }

    /**
     * @api {put} /api/v1/productora/{productora_id}/competencias/{competencia_id}     
     * Actualiza un registro de competencia
     * @apiVersion 1.0.0
     * @apiName ModificarCompetencia
     * @apiGroup Productora
     * @apiHeader {String} Content-Type Tipo de contenido para el request enviado
     * @apiHeaderExample {json} Header-Example:
     * {
     *  "Content-Type": "application/json"
     * }
     * @apiParam {Integer} productora_id    Id Productora
     * @apiParam {Integer} competencia_id   Id Competencia
     * @apiParamExample {json} Request-Example:
     *    {
     *         "disciplina_id" : 1,
     *         "nombre" : "Competencia Test",
     *         "dominio" : "dominio.test",
     *         "subdominio" : "sugdominio.test",
     *         "google" : "google test",
     *         "facebook" : "facebook test",
     *         "twitter" : "twitter test",
     *         "tipo": "campeonato",
     *         "status": "activo",
     *         "cantidad_integrantes": 10,
     *         "fechas":[ 
     *          "2016-11-01",
     *          "2016-11-02",
     *          "2016-11-03"
     *         ],
     *         "ubicaciones": [
     *          "Caracas",
     *          "Valcencia",
     *          "Maracay"
     *         ]
     * }
     * @apiSuccess (200) {Boolean} true     Competencia Modificada
     *
     * @apiSuccessExample Success-Response:
     *     HTTP/1.1 200 OK
     *     {
     *       "data": true
     *     }
     *
     * @apiError {json}  json   Retorna un json de estructura <code>{ "errors": false }</code>
     *
     * @apiErrorExample Error-Response:
     *     HTTP/1.1 404 Not Save
     *     {
     *        "data": false
     *        "errors": "CompetenciaNotSave"
     *     }
     */
    public function actualizarCompetencia(Request $request, $productora_id, $competencia_id)
    {
        $request->merge(['productora_id' => $productora_id, 'competencia_id' => $competencia_id]);
        list($data, $fechas) = [$request->all(), []];
        $validator = ValidacionesCompetencias::actualizarCompetenciaValidacion($data);
        if ($validator->fails()) {
            return response()->json(['data' => false, 'errors' =>
                        $validator->messages()->first()], 404);
        }
        if (isset($data['fechas']) && isset($data['ubicaciones'])) {
            if ($data['tipo'] === 'competencia') {
                if (!(count($data['fechas']) === 1 && count($data['ubicaciones']) === 1)) {
                    return response()->json(['error' =>
                                'Debe suministrar una sola fecha y una sola ubicacion'], 404);
                }
            } else {
                if (!(count($data['fechas']) === count($data['ubicaciones']))) {
                    return response()->json(['error' => 'Debe suministrar la misma'
                                . ' cantidad de fechas y ubicaciones'], 404);
                }
            }
            $fechas = $this->cargarFechaUbicacion($data);
        }

        $competencia = Competencia::whereId($data['competencia_id'])
                        ->whereProductoraId($data['productora_id'])->with('fecha')->first();

        if (!is_null($competencia) || !empty($competencia)) {
            $competencia->fill($data, ['productora_id']);
            $transaction = $this->categoriaTransaction($competencia, $fechas);
            return $transaction;
        } else {
            return response()->json(['data' => false], 404);
        }
    }

    /**
     * @api {delete} /api/v1/productora/{productora_id}/competencias Elimina
     * todas las competencias asociadas a una productora
     * @apiVersion 1.0.0
     * @apiName EliminarCompetencias
     * @apiGroup Productora
     * @apiParam {Integer} productora_id    Id Productora

     * @apiSuccess (200) {Boolean} true     Competencias Eliminadas
     *
     * @apiSuccessExample Success-Response:
     *     HTTP/1.1 200 OK
     *     {
     *       "data": true
     *     }
     *
     * @apiError {json}  json   Retorna un json de estructura <code>{ "errors": false }</code>
     *
     * @apiErrorExample Error-Response:
     *     HTTP/1.1 404 Not Delete
     *     {
     *        "data": false
     *     }
     */
    public function eliminarCompetencias(Request $request)
    {
        $usuario = Usuario::isAuthenticate();
        if ($usuario &&  $usuario->productora_activa != null)
        {
            $request->merge(['productora_id' => $usuario->productora_activa]);
            $data = $request->all();
            $validator = ValidacionesCompetencias::eliminarCompetenciasValidacion($data);

            if ($validator->fails()) {
                return response()->json(['status' => 'fail', 'errors' =>
                            $validator->messages()->first()], 404);
            }

            $competencias = Competencia::whereProductoraId($data['productora_id'])
                            ->with('fecha')->get();
            if (count($competencias) > 0) {
                $ids = array_map(function($item) {
                    return $item['id'];
                }, $competencias->toArray());

                Fecha::whereIn('competencia_id', $ids)->delete();
                Competencia::whereIn('id', $ids)->delete();
                return response()->json(['data' => true], 200);
            } else {
                return response()->json(['data' => false], 404);
            }
        }

        return response()->json(['errors' => trans('generals.insufficient_role')], 404);

    }

    /**
     * @api {delete} /api/v1/productora/{productora_id}/competencias/{competencia_id} Elimina
     * una competencia especifica de una productora
     * @apiVersion 1.0.0
     * @apiName EliminarCompetencias
     * @apiGroup Productora
     * @apiParam {Integer} productora_id    Id Productora
     * @apiParam {Integer} competencia_id   Id Competencia

     * @apiSuccess (200) {Boolean} true     Competencia Eliminada
     *
     * @apiSuccessExample Success-Response:
     *     HTTP/1.1 200 OK
     *     {
     *       "data": true
     *     }
     *
     * @apiError {json}  json   Retorna un json de estructura <code>{ "errors": false }</code>
     *
     * @apiErrorExample Error-Response:
     *     HTTP/1.1 404 Not Delete
     *     {
     *        "data": false
     *     }
     */
    public function eliminarCompetencia(Request $request, $productora_id, $competencia_id)
    {
        $request->merge(['productora_id' => $productora_id, 'competencia_id' => $competencia_id]);
        $data = $request->all();
        $validator = ValidacionesCompetencias::eliminarCompetenciaValidacion($data);
        if ($validator->fails()) {
            return response()->json(['status' => 'fail', 'errors' =>
                        $validator->messages()->first()], 404);
        }
        $competencia = Competencia::whereId($data['competencia_id'])
                        ->whereProductoraId($data['productora_id'])->with('fecha')->first();
        if (!is_null($competencia) || !empty($competencia)) {
            if ($competencia->fecha()->delete()) {
                return ($competencia->delete()) ?
                        response()->json(['data' => true], 200) :
                        response()->json(['data' => false], 404);
            } else {
                return response()->json(['data' => false], 404);
            }
        } else {
            return response()->json(['data' => false], 404);
        }
    }

    public function categoriaTransaction($competencia, $fechas)
    {
        $transaction = DB::transaction(function () use ($competencia, $fechas) {
                    if ($competencia->save()) {
                        if (count($fechas) > 0) {
                            $competencia->fecha()->delete();
                            return ($competencia->fecha()->saveMany($fechas)) ?
                                    response()->json(['data' => true], 200) :
                                    response()->json(['data' => false,
                                        'errors' => $competencia->fecha()->getErrors()], 404);
                        } else {
                            return response()->json(['data' => true], 200);
                        }
                    } else {
                        return response()->json(['data' => false,
                                    'errors' => $competencia->getErrors()], 404);
                    }
                });

        return $transaction;
    }

    private function agregarImagen($data)
    {
        $validator = ValidacionesCompetencias::agregarImagenValidacion($data);

        if ($validator->fails()) {
            return ['data' => false, 'error' => $validator->messages()->first()];
        }

        $imagen = new Imagen(['imagen' => $data['image'], 'extension' => $data['ext']]);
        if($imagen->save())
        {
            switch($data['tipo'])
            {
                case 'Premio':
                    $premio = new Premio(['productora_id' => $data['productora_id'], 'competencia_id' => $data['id'], 'imagen_id' => $imagen->id]);
                    $premio->save();
                break;

                case 'Patrocinador':
                    $patrocinador = new Patrocinador(['productora_id' => $data['productora_id'], 'competencia_id' => $data['id'], 'imagen_id' => $imagen->id]);
                    $patrocinador->save();
                break;

                case 'Galeria':
                    $galeria = new Galeria(['productora_id' => $data['productora_id'], 'competencia_id' => $data['id'], 'imagen_id' => $imagen->id]);
                    $galeria->save();
                break;
            }

            return['data' => true];
        }

        return ['data' => false, 'errors' => 'No fue posible subir la imagen, por favor intente de nuevo'];
    }

}
