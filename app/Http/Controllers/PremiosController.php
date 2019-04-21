<?php

namespace App\Http\Controllers;

use App\Modelos\Foto;
use App\Modelos\Premio;
use Illuminate\Http\Request;
use App\Validaciones\ValidacionesPremios;

class PremiosController extends Controller
{

    /**
     * @api {get} /api/v1/administradora/premios Muestra varios registros de premios
     * @apiVersion 1.0.0 
     * @apiName MostrarPremios
     * @apiGroup Premio

     * @apiSuccess (200) {json} Premios.
     *
     * @apiSuccessExample Success-Response:
     *     HTTP/1.1 200 OK
     * {
     *    "data": [
     *     {
     *       "id": 1,
     *       "productora_id": 1,
     *       "competencia_id": 8,
     *       "foto_id": 9,
     *       "fecha": "2007-03-05",
     *       "nombre": "in",
     *       "descripcion": "Id beatae doloribus sit rerum iusto eius vitae distinctio, 
     *       "puesto": "6",
     *       "monto": 238.55,
     *       "deleted_at": null,
     *       "created_at": "2014-04-28 12:46:16",
     *       "updated_at": "2007-04-13 16:39:31"
     *     },
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
    
    public function mostrarPremios()
    {
        $premios = Premio::all();
        return (count($premios) > 0) ? response()->json(['data' => $premios->toArray()], 200) :
                response()->json(['data' => false], 404);
        
    }

        /**
     * @api {post} /api/v1/administradora/premios/fotos Crea un nuevo registro de
     * fotos y asocia la foto a un premio existente
     * @apiVersion 1.0.0
     * @apiName agregarFoto
     * @apiGroup Premios
     * @apiHeader {String} Content-Type Tipo de contenido para el request enviado
     * @apiHeaderExample {json} Header-Example:
     * {
     *  "Content-Type": "multipart/form-data"
     * }
     * @apiParam {Integer} premio_id    Id Productora
     * @apiParam {Image} foto           Foto

     * @apiParamExample {form-data} Request-Example:
     *  
     * premio_id = 1
     * foto = imagen.jpg  || imagen.png || imagen.jpeg
     *   
     * @apiSuccess {Integer} Foto ID.
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
     *        "errors": "FotoNotSave"
     *     }
     */
    
    public function agregarFoto(Request $request)
    {
        $data = $request->all();
        $validator = ValidacionesPremios::agregarFotoValidacion($data);

        if ($validator->fails()) {
            return response()->json(['data' => false, 'error' =>
                $validator->messages()->first()], 404);
        }
        list($base_path, $foto, $file) = [storage_path(), new Foto(), $request->file('foto')]; 
 
        $destinationPath = $base_path . "\\app\\public\\Fotos\\" . $data['premio_id'];
        $nombre = str_random(8) . '.' . $file->getClientOriginalExtension();
        $file->move($destinationPath, $nombre);
        
        $data['foto'] = $nombre;
        
        $foto->fill($data);
        if($foto->save()){
            Premio::whereId($data['premio_id'])->update(['foto_id' => $foto->id]);
            return response()->json(['data' => $foto->id], 200);
        } else
        {
            return response()->json(['data' => false, 'errors' => $foto->getErrors()], 404);
        }
    }

    /**
     * @api {post} /api/v1/administradora/premios Crea un nuevo registro de
     * premios
     * @apiVersion 1.0.0
     * @apiName crearPremio
     * @apiGroup Premios
     * @apiHeader {String} Content-Type Tipo de contenido para el request enviado
     * @apiHeaderExample {json} Header-Example:
     * {
     *  "Content-Type": "application/json"
     * }
     * @apiParam {Integer} productora_id    Id Productora
     * @apiParam {Integer} competencia_id   Id Competencia
     * @apiParam {Integer} foto_id          Id Foto
     * @apiParam {Integer} fecha            Fecha  
     * @apiParam {String} nombre            Nombre del premio
     * @apiParam {String} descripcion       Descripcion
     * @apiParam {String} puesto            Puesto
     * @apiParam {Float} monto             Monto

     * @apiParamExample {json} Request-Example:
     *  {
     *       "productora_id": 1,
     *       "competencia_id": 1,
     *       "foto_id": 1,
     *       "fecha": "2007-12-25",
     *       "nombre": "premio1",
     *       "descripcion": "primer lugar",
     *       "puesto": "primero",
     *       "monto": 450.36,
     *   }
     * @apiSuccess {Integer} Premio ID.
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
     *        "errors": "PremioNotSave"
     *     }
     */
    public function crearPremio(Request $request)
    {
        $data = $request->all();
        $validator = ValidacionesPremios::crearPremioValidacion($data);
        if ($validator->fails()) {
            return response()->json(['data' => false, 'error' =>
                        $validator->messages()->first()], 404);
        }

        $premio = new Premio();
        $premio->fill($data);
        return ($premio->save()) ? response()->json(['id' => $premio->id], 200) :
                response()->json(['data' => false,
                    'errors' => $premio->getErrors()], 404);
    }

   /**
     * @api {get} /api/v1/administradora/premios/{premio_id} Muestra un registro de premios
     * @apiVersion 1.0.0 
     * @apiName MostrarPremio
     * @apiGroup Premio
     * @apiParam {Integer} premio_id     Id Premio

     * @apiSuccess (200) {json} Premio
     *
     * @apiSuccessExample Success-Response:
     *     HTTP/1.1 200 OK
     * {
     *    "data": {
     *       "id": 1,
     *       "productora_id": 1,
     *       "competencia_id": 8,
     *       "foto_id": 9,
     *       "fecha": "2007-03-05",
     *       "nombre": "in",
     *       "descripcion": "Id beatae doloribus sit rerum iusto eius vitae distinctio, 
     *       "puesto": "6",
     *       "monto": 238.55,
     *       "deleted_at": null,
     *       "created_at": "2014-04-28 12:46:16",
     *       "updated_at": "2007-04-13 16:39:31"
     *     }
     * }
     *
     * @apiError {json}  json   Retorna un json de estructura <code>{ "errors": false }</code> 
     *
     * @apiErrorExample Error-Response:
     *     HTTP/1.1 404 Not Found
     *     {
     *        "data": false
     *     }
     */
    public function mostrarPremio(Request $request, $premio_id)
    {
        $request->merge(['premio_id' => $premio_id]);
        $data = $request->all();
        $validator = ValidacionesPremios::mostrarPremioValidacion($data);
        if ($validator->fails()) {
            return response()->json(['data' => false, 'error' =>
                        $validator->messages()->first()], 404);
        }
        $premio = Premio::whereId($data['premio_id'])->first();
        return (count($premio) > 0) ? response()->json(['data' => $premio->toArray()], 200) :
                response()->json(['data' => false], 404);
    }

       /**
     * @api {put} /api/v1/administradora/premios/{premio_id} Actualiza un registro de premios
     * @apiVersion 1.0.0 
     * @apiName ModificarPremio
     * @apiGroup Premio
     * @apiHeader {String} Content-Type Tipo de contenido para el request enviado
     * @apiHeaderExample {json} Header-Example:
     * {
     *  "Content-Type": "application/json"
     * }
     * @apiParam {Integer} premio_id        Id Premio
     * @apiParam {Integer} productora_id    Id Productora
     * @apiParam {Integer} competencia_id   Id Competencia
     * @apiParam {Integer} foto_id          Id Foto
     * @apiParam {Integer} fecha            Fecha  
     * @apiParam {String} nombre            Nombre del premio
     * @apiParam {String} descripcion       Descripcion
     * @apiParam {String} puesto            Puesto
     * @apiParam {String} monto             Monto

     * @apiParamExample {json} Request-Example:
     *  {
     *       "productora_id": 1,
     *       "competencia_id": 1,
     *       "foto_id": 1,
     *       "fecha": "2007-12-25",
     *       "nombre": "premio1",
     *       "descripcion": "primer lugar",
     *       "puesto": "primero",
     *       "monto": 450.36,
     *   }
     * @apiSuccess (200) {Boolean} true Premio Modificada.
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
     *        "errors": "PremioNotSave"
     *     }
     */
    public function actualizarPremio(Request $request, $premio_id)
    {
        $request->merge(['premio_id' => $premio_id]);
        $data = $request->all();
        $validator = ValidacionesPremios::actualizarPremioValidacion($data);
        if ($validator->fails()) {
            return response()->json(['data' => false, 'error' =>
                        $validator->messages()->first()], 404);
        }

        $premio = Premio::whereId($premio_id)->first();
        $premio->fill($data);
        return ($premio->save()) ? response()->json(['id' => true], 200) :
                response()->json(['data' => false,
                    'errors' => $premio->getErrors()], 404);
    }

    /**
     * @api {delete} /api/v1/administradora/premios/{premio_id} Elimina un 
     * registro de premios
     * @apiVersion 1.0.0 
     * @apiName EliminarPremio
     * @apiGroup Premios
     * @apiParam {Integer} premio_id     Id Premio

     * @apiSuccess (200) {Boolean} true Premio Eliminada.
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
    public function eliminarPremio(Request $request, $premio_id)
    {
        $request->merge(['premio_id' => $premio_id]);
        $data = $request->all();
        $validator = ValidacionesPremios::eliminarPremioValidacion($data);
        if ($validator->fails()) {
            return response()->json(['data' => false, 'error' =>
                        $validator->messages()->first()], 404);
        }
        $premio = Premio::whereId($data['premio_id'])->first();
        if (count($premio) > 0) {
            return ($premio->delete()) ?
                    response()->json(['data' => true], 200) :
                    response()->json(['data' => false], 404);
        } else {
            return response()->json(['data' => false], 404);
        }
    }

}
