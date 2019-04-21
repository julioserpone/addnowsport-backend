<?php

namespace App\Http\Controllers;

use App\Modelos\Competencia;
use App\Modelos\Fecha;
use App\Modelos\Grupo;
use App\Modelos\Usuario;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Modelos\DistanciaCategoria;
use App\Modelos\Distancia;
use App\Modelos\Categoria;
use Illuminate\Support\Facades\DB;
use App\Validaciones\ValidacionesCategorias;

class CategoriasController extends Controller
{

    /**
     * @api {post} /api/v1/productora/grupo-categorias Crea un nuevo registro de grupo de categorias
     * @apiVersion 1.0.0
     * @apiName crearGrupoCategoria
     * @apiGroup Categoria
     * @apiHeader {String} Content-Type Tipo de contenido para el request enviado
     * @apiHeaderExample {json} Header-Example:
     * {
     *  "Content-Type": "application/json"
     * }
     * @apiParam {Array} categorias         Ids Categorias Hijas
     * @apiParam {Integer} productora_id    Id Productora
     * @apiParam {Integer} grupo_id         Id Grupo
     * @apiParam {String} nombre            Nombre Categoria
     * @apiParam {Integer} edad_inicio      Edad de Inicio Categoria
     * @apiParam {Integer} edad_final       Edad de Final Categoria
     * @apiParam {String} texto_informativo Texto Informativo
     * @apiParam {String} tipo              Tipo Categoria
     *
     * @apiParamExample {json} Request-Example:
     *   {
     *     "categorias":[
     *           1,2
     *       ],
     *       "productora_id": 1,
     *       "grupo_id": null,
     *       "nombre": "distancia1",
     *       "edad_inicio": 15,
     *       "edad_final": 25,
     *       "texto_informativo": "texto",
     *       "tipo": "general"
     *   }
     * @apiSuccess (200) {Boolean} true Grupo Creado
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
     *        "errors": "GrupoCategoriaNotSave"
     *        "data" : false
     *     }
     */
    public function crearGrupoCategoria(Request $request)
    {
        $usuario = Usuario::isAuthenticate();
        if ($usuario && $usuario->productora_activa != null)
        {
            $request->merge(['productora_id' => $usuario->productora_activa]);
            $data = $request->all();
            $validator = ValidacionesCategorias::crearGrupoCategoriaValidation($data);

            if ($validator->fails()) {
                return response()->json(['error' =>
                    $validator->messages()->first()], 404);
            }

            $grupo = new Grupo([ 'productora_id' => $data['productora_id'], 'nombre' => $data['nombre']]);

            if ($grupo->save()) {
                return response()->json(['data' => $grupo->id], 200);
            } else {
                return response()->json(['errors' => $grupo->getErrors()], 404);
            }
        }
        else {
            return response()->json(['errors' => trans('generals.insufficient_role')], 404);
        }
    }

    /**
     * @api {get} /api/v1/productora/grupo-categorias Muestra varios registros de grupos categorias
     * @apiVersion 1.0.0
     * @apiName mostrarTodosGrupoCategoria
     * @apiGroup Categoria

     * @apiSuccess (200) {json} Categorias.
     *
     * @apiSuccessExample Success-Response:
     *     HTTP/1.1 200 OK
     * {
     *    "data": [
     *      {
     *       "id": 6,
     *       "grupo_id": 6,
     *       "productora_id": 1,
     *       "nombre": "distancia1",
     *       "edad_inicio": 15,
     *       "edad_final": 25,
     *       "texto_informativo": "texto",
     *       "tipo": "general",
     *       "deleted_at": null,
     *       "created_at": "2016-10-19 00:34:53",
     *       "updated_at": "2016-10-19 00:34:53"
     *      },
     *      ...
     *  ]
     * }
     *
     */
    public function mostrarGrupoCategorias(Request $request)
    {
        $usuario = Usuario::isAuthenticate();
        if ($usuario && $usuario->productora_activa != null)
        {
            $gruposCategorias = Grupo::select('id', 'nombre')->where('productora_id', $usuario->productora_activa)->get();
            $lista = [];
            foreach($gruposCategorias as $grupoCategoria)
            {
                $grupoCategoria['categorias'] = Categoria::select('id', 'nombre')->where('grupo_id', $grupoCategoria->id)->get();
                $lista[] = $grupoCategoria;
            }
        //   DB::table('categorias')->whereRaw('categorias.id = categorias.grupo_id')->get();
            return response()->json(['data' => $gruposCategorias->toArray()], 200);
        }
        else {
            return response()->json(['errors' => trans('generals.insufficient_role')], 404);
        }
    }

    /**
     * @api {get} /api/v1/productora/grupo-categorias/{grupo_id} Muestra un registro de grupo categorias
     * @apiVersion 1.0.0
     * @apiName mostrarGrupoCategoria
     * @apiGroup Categoria
     * @apiParam {Integer} grupo_id     Id Grupo Categoria

     * @apiSuccess (200) {json} Categoria
     *
     * @apiSuccessExample Success-Response:
     *     HTTP/1.1 200 OK
     *     "data": {
     *       "id": 6,
     *       "grupo_id": 6,
     *       "productora_id": 1,
     *       "nombre": "distancia1",
     *       "edad_inicio": 15,
     *       "edad_final": 25,
     *       "texto_informativo": "texto",
     *       "tipo": "general",
     *       "deleted_at": null,
     *       "created_at": "2016-10-19 00:34:53",
     *       "updated_at": "2016-10-19 00:34:53"
     *     }
     *
     * @apiError {json}  json   Retorna un json de estructura <code>{ "errors": false }</code>
     *
     * @apiErrorExample Error-Response:
     *     HTTP/1.1 404 Not Found
     *     {
     *        "data": false
     *     }
     */
    public function mostrarGrupoCategoria(Request $request, $id)
    {
        $usuario = Usuario::isAuthenticate();
        if ($usuario && $usuario->productora_activa != null)
        {
            $request->merge(['grupo_id' => $id]);
            $data = $request->all();
            $validator = ValidacionesCategorias::mostrarGrupoCategoriaValidacion($data);

            if ($validator->fails()) {
                return response()->json(['data' => false, 'error' =>
                    $validator->messages()->first()], 404);
            }

            $grupo = Grupo::whereId($data['grupo_id'])->first();

            return (count($grupo) > 0) ? response()->json(['data' => $grupo->toArray()], 200) :
                response()->json(['data' => false], 404);
        }
        else {
            return response()->json(['errors' => trans('generals.insufficient_role')], 404);
        }
    }

    /**
     * @api {put} /api/v1/productora/grupo-categorias/{grupo_id} Actualiza un registro de
     * grupos categorias
     * @apiVersion 1.0.0
     * @apiName modificarGrupoCategoria
     * @apiGroup Categoria
     * @apiHeader {String} Content-Type Tipo de contenido para el request enviado
     * @apiHeaderExample {json} Header-Example:
     * {
     *  "Content-Type": "application/json"
     * }
     * @apiParam {Array} categorias         Ids Categorias Hijas
     * @apiParam {Integer} productora_id    Id Productora
     * @apiParam {Integer} grupo_id         Id Grupo
     * @apiParam {String} nombre            Nombre Categoria
     * @apiParam {Integer} edad_inicio      Edad de Inicio Categoria
     * @apiParam {Integer} edad_final       Edad de Final Categoria
     * @apiParam {String} texto_informativo Texto Informativo
     * @apiParam {String} tipo              Tipo Categoria
     *
     * @apiParamExample {json} Request-Example:
     *   {
     *      "categorias":[
     *           1,2
     *       ],
     *       "productora_id": 1,
     *       "grupo_id": null,
     *       "nombre": "distancia1",
     *       "edad_inicio": 15,
     *       "edad_final": 25,
     *       "texto_informativo": "texto",
     *       "tipo": "general"
     *   }
     * @apiSuccess (200) {Boolean} true Grupo Categoria Modificado.
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
     *        "errors": "GrupoCategoriaNotSave"
     *     }
     */
    public function modificarGrupoCategoria(Request $request, $grupo_id)
    {

        $usuario = Usuario::isAuthenticate();
        if ($usuario && $usuario->productora_activa != null)
        {
            $request->merge(['grupo_id' => $grupo_id]);
            $data = $request->all();
            $validator = ValidacionesCategorias::modificarGrupoCategoriaValidacion($data);
            if ($validator->fails()) {
                return response()->json(['data' => false, 'error' =>
                    $validator->messages()->first()], 404);
            }
            $categoria = Categoria::whereId($data['grupo_id'])->first();
            if (!is_null($categoria) || !empty($categoria)) {
                $categoria->fill($data);
                if ($categoria->save()) {
                    if (isset($data['categorias']) && count($data['categorias']) > 0) {
                        Categoria::whereGrupoId($categoria->id)->whereNotIn('id', [$categoria->id])
                            ->update(['grupo_id' => null]);
                        Categoria::whereIn('id', $data['categorias'])->update(['grupo_id' => $categoria->id]);
                        return response()->json(['data' => true], 200);
                    } else {
                        return response()->json(['data' => false], 404);
                    }
                } else {
                    return response()->json(['data' => false, 'errors' => $categoria->getErrors()], 404);
                }
            } else {
                return response()->json(['data' => false], 404);
            }
        }

        return response()->json(['errors' => trans('generals.insufficient_role')], 404);
    }

    /**
     * @api {delete} /api/v1/productora/grupo-categorias/{grupo_id} Elimina un registro de
     * grupo de categorias
     * @apiVersion 1.0.0
     * @apiName eliminarGrupoCategoria
     * @apiGroup Categoria
     * @apiParam {Integer} grupo_id     Id Grupo Categoria

     * @apiSuccess (200) {Boolean} true Grupo Categoria Eliminado.
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
    public function eliminarGrupoCategoria(Request $request)
    {
        $usuario = Usuario::isAuthenticate();
        if ($usuario && $usuario->productora_activa != null)
        {
            $request->merge(['productora_id' => $usuario->productora_activa]);
            $data = $request->all();
            $validator = ValidacionesCategorias::eliminarGrupoCategoriaValidation($data);

            if ($validator->fails()) {
                return response()->json(['data' => false, 'error' =>
                    $validator->messages()->first()], 404);
            }

            $competencias = Competencia::where('productora_id', $data['productora_id'])->get();
            $now =Carbon::now();
            foreach($competencias as $competencia)
            {
                $fechas = Fecha::where('competencia_id', $competencia->id)->get();
                foreach($fechas as $fecha)
                {
                    if($fecha->fecha_competencia >= $now)
                    {
                        return response()->json(['data' => false, 'errors' =>'Existe una competencia en curso'], 404);
                    }
                }

            }

            $categoria = Categoria::where('grupo_id', $data['id'])->where('productora_id', $data['productora_id'])->get();
            if(!empty($categoria))
            {
                $categoria->delete();
            }

            Grupo::where('id', $data['id'])->where('productora_id', $data['productora_id'])->delete();

            return response()->json(['data' => true], 200);
            }

        return response()->json(['errors' => trans('generals.insufficient_role')], 404);
    }

    /**
     * @api {post} /api/v1/productora/categorias Crea un nuevo registro de categorias
     * @apiVersion 1.0.0 
     * @apiName crearCategoria
     * @apiGroup Categoria
     * @apiHeader {String} Content-Type Tipo de contenido para el request enviado
     * @apiHeaderExample {json} Header-Example:
     * {
     *  "Content-Type": "application/json"
     * }
     * @apiParam {Integer} productora_id     Id Productora
     * @apiParam {String} nombre            Nombre Categoria
     * @apiParam {Integer} edad_inicio      Edad de Inicio Categoria
     * @apiParam {Integer} edad_final       Edad de Final Categoria
     * @apiParam {String} texto_informativo Texto Informativo
     * @apiParam {String} tipo              Tipo Categoria
     * 
     * @apiParamExample {json} Request-Example:
     *   {
     *       "productora_id": 1,
     *       "nombre": "distancia1",
     *       "edad_inicio": 15,
     *       "edad_final": 25,
     *       "texto_informativo": "texto",
     *       "tipo": "general"
     *   }
     * @apiSuccess (200) {Integer} Id Categoria Creada
     *
     * @apiSuccessExample Success-Response:
     *     HTTP/1.1 200 OK
     *     {
     *       "id": 5
     *     }
     *
     * @apiError {json}  json   Retorna un json de estructura <code>{ "errors": false }</code> 
     *
     * @apiErrorExample Error-Response:
     *     HTTP/1.1 404 Not Save
     *     {
     *        "errors": "CategoriaNotSave"
     *     }
     */
    public function crearCategoria(Request $request)
    {
        $usuario = Usuario::isAuthenticate();
        if ($usuario && $usuario->productora_activa != null)
        {
            $request->merge(['productora_id' => $usuario->productora_activa]);
            $data = $request->all();
            $validator = ValidacionesCategorias::crearCategoriaValidation($data);
            if ($validator->fails()) {
                return response()->json(['error' =>
                            $validator->messages()->first()], 404);
            }
            $categoria = new Categoria();
            $categoria->fill($data);
            return ($categoria->save()) ? response()->json(['id' => $categoria->id], 200) :
                    response()->json(['errors' => $categoria->getErrors()], 404);
        }

        return response()->json(['errors' => trans('generals.insufficient_role')], 404);
    }

    /**
     * @api {get} /api/v1/productora/categorias/{categoria_id} Muestra un registro de categorias
     * @apiVersion 1.0.0 
     * @apiName MostrarCategoria
     * @apiGroup Categoria
     * @apiParam {Integer} categoria_id     Id Categoria

     * @apiSuccess (200) {json} Categoria
     *
     * @apiSuccessExample Success-Response:
     *     HTTP/1.1 200 OK
     *     "data": {
     *       "id": 6,
     *       "productora_id": 1,
     *       "nombre": "distancia1",
     *       "edad_inicio": 15,
     *       "edad_final": 25,
     *       "texto_informativo": "texto",
     *       "tipo": "general",
     *       "deleted_at": null,
     *       "created_at": "2016-10-19 00:34:53",
     *       "updated_at": "2016-10-19 00:34:53"
     *     }
     *
     * @apiError {json}  json   Retorna un json de estructura <code>{ "errors": false }</code> 
     *
     * @apiErrorExample Error-Response:
     *     HTTP/1.1 404 Not Found
     *     {
     *        "data": false
     *     }
     */
    public function mostrarCategoria(Request $request)
    {
        $usuario = Usuario::isAuthenticate();
        if ($usuario && $usuario->productora_activa != null)
        {
            $data = $request->all();
            $validator = ValidacionesCategorias::mostrarCategoriaValidacion($data);
            if ($validator->fails()) {
                return response()->json(['data' => false, 'error' =>
                            $validator->messages()->first()], 404);
            }
            $categoria = Categoria::whereId($data['categoria_id'])->first();
            if (count($categoria) > 0) {
                return response()->json(['data' => $categoria->toArray()], 200);
            } else {
                return response()->json(['data' => false], 404);
            }
        }

        return response()->json(['errors' => trans('generals.insufficient_role')], 404);
    }

    /**
     * @api {get} /api/v1/productora/categorias Muestra varios registros de categorias
     * @apiVersion 1.0.0 
     * @apiName MostrarCategorias
     * @apiGroup Categoria

     * @apiSuccess (200) {json} Categorias.
     *
     * @apiSuccessExample Success-Response:
     *     HTTP/1.1 200 OK
     * {
     *    "data": [
     *      {
     *       "id": 6,
     *       "productora_id": 1,
     *       "nombre": "distancia1",
     *       "edad_inicio": 15,
     *       "edad_final": 25,
     *       "texto_informativo": "texto",
     *       "tipo": "general",
     *       "deleted_at": null,
     *       "created_at": "2016-10-19 00:34:53",
     *       "updated_at": "2016-10-19 00:34:53"
     *      },
     *      ...
     *  ]
     * }
     * @apiError {json}  json   Retorna un json de estructura <code>{ "errors": false }</code> 
     *
     * @apiErrorExample Error-Response:
     *     HTTP/1.1 404 Not Found
     *     {
     *        "data": false
     *     }
     */
    public function mostrarCategorias(Request $request)
    {
        $usuario = Usuario::isAuthenticate();
        if ($usuario && $usuario->productora_activa != null)
        {
            $categorias = Categoria::select('id', 'nombre','edad_inicio', 'edad_final')->where('productora_id',$usuario->productora_activa)->get();
            return (count($categorias) > 0) ? response()->json(['data' => $categorias->toArray()], 200) :
                    response()->json(['data' => false], 404);
        }

        return response()->json(['errors' => trans('generals.insufficient_role')], 404);
    }

    /**
     * @api {put} /api/v1/productora/categorias/{categoria_id} Actualiza un registro de categorias
     * @apiVersion 1.0.0 
     * @apiName ModificarCategoria
     * @apiGroup Categoria
     * @apiHeader {String} Content-Type Tipo de contenido para el request enviado
     * @apiHeaderExample {json} Header-Example:
     * {
     *  "Content-Type": "application/json"
     * }
     * @apiParam {Integer} categoria_id     Id Categoria
     * @apiParam {Integer} productora_id     Id Productora
     * @apiParam {String} nombre            Nombre Categoria
     * @apiParam {Integer} edad_inicio      Edad de Inicio Categoria
     * @apiParam {Integer} edad_final       Edad de Final Categoria
     * @apiParam {String} texto_informativo Texto Informativo
     * @apiParam {String} tipo              Tipo Categoria
     * @apiParamExample {json} Request-Example:
     *   {
     *       "productora_id": 1,
     *       "nombre": "distancia1",
     *       "edad_inicio": 15,
     *       "edad_final": 25,
     *       "texto_informativo": "texto",
     *       "tipo": "general"
     *   }
     * @apiSuccess (200) {Boolean} true Categoria Modificada.
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
     *        "errors": "CategoriaNotSave"
     *     }
     */
    public function actualizarCategoria(Request $request)
    {
        $usuario = Usuario::isAuthenticate();
        if ($usuario && $usuario->productora_activa != null)
        {
            $data = $request->all();
            $validator = ValidacionesCategorias::actualizarCategoriaValidacion($data);
            if ($validator->fails()) {
                return response()->json(['data' => false, 'error' =>
                            $validator->messages()->first()], 404);
            }
            $categoria = Categoria::where('id', $data['id'])->first();
            if (!is_null($categoria) || !empty($categoria)) {
                $categoria->fill($data);
                return ($categoria->save()) ? response()->json(['data' => true], 200) :
                        response()->json(['data' => false, 'errors' => $categoria->getErrors()], 404);
            } else {
                return response()->json(['data' => false], 404);
        }        }

        return response()->json(['errors' => trans('generals.insufficient_role')], 404);
    }

    /**
     * @api {delete} /api/v1/productora/categorias/{categoria_id} Elimina un registro de categorias
     * @apiVersion 1.0.0 
     * @apiName EliminarCategoria
     * @apiGroup Categoria
     * @apiParam {Integer} categoria_id     Id Categoria

     * @apiSuccess (200) {Boolean} true Categoria Eliminada.
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
    public function eliminarCategoria(Request $request)
    {   $usuario = Usuario::isAuthenticate();
        if ($usuario && $usuario->productora_activa != null)
        {
            $request->merge(['productora_id' => $usuario->productora_activa]);
            $data = $request->all();
            $validator = ValidacionesCategorias::eliminarCategoriaValidation($data);

            if ($validator->fails()) {
                return response()->json(['data' => false, 'error' =>
                            $validator->messages()->first()], 404);
            }

            $categoria = Categoria::whereId($data['id'])->where('productora_id', $data['productora_id'])->first();
            if (count($categoria) > 0) {
                return ($categoria->delete()) ?
                        response()->json(['data' => true], 200) :
                        response()->json(['data' => 'usted no tiene fategorias para eliminar de este grupo'], 404);
            }
                return response()->json(['data' => false], 404);
        }

        return response()->json(['errors' => trans('generals.insufficient_role')], 404);
    }

    public function vincularDistancias(Request $request,$categoria_id){

        $request->merge(['categoria_id' => $categoria_id]);
        $data = $request->all();
        $validator = ValidacionesCategorias::agregarDistanciasValidacion($data);
        if ($validator->fails()) {
            return response()->json(['data' => false, 'error' =>
                $validator->messages()->first()], 404);
        }
        $categoria = Categoria::whereId($data['grupo_id'])
            ->whereGrupoId($data['grupo_id'])->first();
        if (array_key_exists('all',$data)) {
            $distancias = Distancia::get();
            foreach ($distancias as $distancia) {

                $realacion = DistanciaCategoria::where('distancia_id',$distancia->id)
                                                ->where('categoria_id' , $data['categoria_id'])->first();
                if (!is_null($realacion) || !empty($realacion)) {
                    $distancia_categoria = new DistanciaCategoria([
                        'distancia_id' => $distancia->id,
                        'categoria_id' => $data['categoria_id']
                    ]);
                    $distancia_categoria->save();
                }
            }
            return response()->json(['data' => true], 200);

        } else {
            $distancia_categoria = new DistanciaCategoria([
                'distancia_id' => $data['distancia_id'],
                'categoria_id' => $data['categoria_id']
            ]);
            $distancia_categoria->save();

            return response()->json(['data' => true], 200);
        }
    }

    public function eliminarDistancia(Request $request,$relacion_id){
        $request->merge(['relacion_id' => $relacion_id]);
        $data = $request->all();
        $validator = ValidacionesCategorias::existsDistanciaRelacionValidacion($data);

        if ($validator->fails()) {
            return response()->json(['data' => false, 'error' =>
                $validator->messages()->first()], 404);
        }

        $relacion = DistanciaCategoria::whereId($relacion_id)->first();
        if (count($relacion) > 0) {
            return ($relacion->delete()) ?
                response()->json(['data' => true], 200) :
                response()->json(['data' => false], 404);
        } else {
            return response()->json(['data' => false], 404);
        }

    }


    public function showAllDistancias()
    {

        return response()->json(['data' => DistanciaCategoria::get()], 200);

    }

    public function showDistancia(Request $request, $relacion_id)
    {
        $request->merge(['relacion_id' => $relacion_id]);
        $data = $request->all();
        $validator = ValidacionesCategorias::existsDistanciaRelacionValidacion($data);
        if ($validator->fails()) {
            return response()->json(['data' => false, 'error' =>
                $validator->messages()->first()], 404);
        }

        return response()->json(['data' => DistanciaCategoria::where('id', $relacion_id)->get()], 200);

    }


}
