<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Modelos\Distancia;
use App\Validaciones\ValidacionesDistancias;

class DistanciasController extends Controller
{

    /**
     * @api {post} /api/v1/productora/distancias Crea un nuevo registro de distancias
     * @apiVersion 1.0.0
     * @apiName crearDistancia
     * @apiGroup Distancia
     * @apiHeader {String} Content-Type Tipo de contenido para el request enviado
     * @apiHeaderExample {json} Header-Example:
     * {
     *  "Content-Type": "application/json"
     * }
     * @apiParam {Integer} fecha_id     Id de fecha
     * @apiParam {String} nombre    Nombre de distancia
     * @apiParam {String} status    Estatus de distancia
     * @apiParamExample {json} Request-Example:
     * {
     *   "fecha_id": 1,
     *   "nombre": "distancia1",
     *   "status": "activo"
     * }
     * @apiSuccess (200) {Integer} id   Id distancia creada
     *
     * @apiSuccessExample Success-Response:
     *     HTTP/1.1 200 OK
     *     {
     *       "id": 6
     *     }
     *
     * @apiError {json}  json   Retorna un json de estructura <code>{ "errors": false }</code> 
     *
     * @apiErrorExample Error-Response:
     *     HTTP/1.1 404 DistanciaNotSave
     *     {
     *        "errors": "DistanciaNotSave"
     *     }
     */
    public function crearDistancia(Request $request)
    {
        $data = $request->all();
        $validator = ValidacionesDistancias::crearDistanciaValidation($data);
        if ($validator->fails()) {
            return response()->json(['error' =>
                        $validator->messages()->first()], 404);
        }
        $distancia = new Distancia();
        $distancia->fill($data);
        return ($distancia->save()) ? response()->json(['id' => $distancia->id], 200) :
                response()->json(['errors' => $distancia->getErrors()], 404);
    }

    /**
     * @api {get} /api/v1/productora/distancias/{distancia_id} Muestra un registro de distancias
     * @apiVersion 1.0.0
     *  @apiName MostrarDistancia
     * @apiGroup Distancia
     * @apiParam {Integer} distancia_id     Id de distancia

     * @apiSuccess (200) {json} Distancia.
     *
     * @apiSuccessExample Success-Response:
     *     HTTP/1.1 200 OK
     *     "data": {
     *       "id": 6,
     *       "fecha_id": 2,
     *       "nombre": "distanciamodificada",
     *       "status": "inactivo",
     *       "deleted_at": null,
     *       "created_at": "2016-10-17 20:48:44",
     *       "updated_at": "2016-10-17 21:11:20"
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
    public function mostrarDistancia(Request $request, $distancia_id)
    {
        $request->merge(['distancia_id' => $distancia_id]);
        $data = $request->all();
        $validator = ValidacionesDistancias::mostrarDistanciaValidacion($data);
        if ($validator->fails()) {
            return response()->json(['data' => false, 'error' =>
                        $validator->messages()->first()], 404);
        }
        $distancia = Distancia::whereId($data['distancia_id'])->first();
        if (count($distancia) > 0) {
            return response()->json(['data' => $distancia->toArray()], 200);
        } else {
            response()->json(['data' => false], 404);
        }
    }

    /**
     * @api {get} /api/v1/productora/distancias/ Muestra varios registros de distancias
     * @apiVersion 1.0.0
     *  @apiName MostrarDistancias
     * @apiGroup Distancia

     * @apiSuccess (200) {json} Distancias.
     *
     * @apiSuccessExample Success-Response:
     *     HTTP/1.1 200 OK
     * {
     *    "data": [
     *        {
     *          "id": 1,
     *          "fecha_id": 29,
     *          "nombre": "recusandae",
     *          "status": "activo",
     *          "deleted_at": null,
     *          "created_at": "1970-06-19 10:31:41",
     *          "updated_at": "1996-09-14 09:01:56"
     *        },
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
    public function mostrarDistancias(Request $request)
    {
        $distancias = Distancia::all();
        return (count($distancias) > 0) ? response()->json(['data' => $distancias->toArray()], 200) :
                response()->json(['data' => false], 404);
    }

    /**
     * @api {put} /api/v1/productora/distancias/{distancia_id} Actualiza un registro de distancias
     * @apiVersion 1.0.0
     * @apiName ModificarDistancia
     * @apiGroup Distancia
     * @apiHeader {String} Content-Type Tipo de contenido para el request enviado
     * @apiHeaderExample {json} Header-Example:
     * {
     *  "Content-Type": "application/json"
     * }
     * @apiParam {Integer} fecha_id     Id de fecha
     * @apiParam {String} nombre    Nombre de distancia
     * @apiParam {String} status    Estatus de distancia
     * @apiParamExample {json} Request-Example:
     * {
     *   "fecha_id": 2,
     *   "nombre": "distancia2",
     *   "status": "inactivo"
     * }
     * @apiSuccess {Boolean} true Distancia Modificada.
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
     *        "errors": "DistanciaNotSave"
     *     }
     */
    public function actualizarDistancia(Request $request, $distancia_id)
    {
        $request->merge(['id' => $distancia_id]);
        $data = $request->all();
        $validator = ValidacionesDistancias::actualizarDistanciaValidacion($data);
        if ($validator->fails()) {
            return response()->json(['data' => false, 'error' =>
                        $validator->messages()->first()], 404);
        }
        $distancia = Distancia::where('id', $data['id'])->first();
        if (!is_null($distancia) || !empty($distancia)) {
            $distancia->fill($data);
            return ($distancia->save()) ? response()->json(['data' => true], 200) :
                    response()->json(['data' => false, 'errors' => $distancia->getErrors()], 404);
        } else {
            return response()->json(['data' => false], 404);
        }
    }

    /**
     * @api {delete} /api/v1/productora/distancias/{distancia_id} Elimina un registro de distancias
     * @apiVersion 1.0.0
     * @apiName EliminarDistancia
     * @apiGroup Distancia
     * @apiParam {Integer} distancia_id     Id de distancia

     * @apiSuccess {Boolean} true Distancia Eliminada.
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
    public function eliminarDistancia(Request $request, $distancia_id)
    {
        $request->merge(['distancia_id' => $distancia_id]);
        $data = $request->all();
        $validator = ValidacionesDistancias::mostrarDistanciaValidacion($data);
        if ($validator->fails()) {
            return response()->json(['data' => false, 'error' =>
                        $validator->messages()->first()], 404);
        }
        $distancia = Distancia::whereId($data['distancia_id'])->first();
        if (count($distancia) > 0) {
            return ($distancia->delete()) ?
                    response()->json(['data' => true], 200) :
                    response()->json(['data' => false], 404);
        } else {
            return response()->json(['status' => false], 404);
        }
    }

}
