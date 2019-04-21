<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Modelos\Transferencias;
use Illuminate\Support\Facades\File;
use App\Validaciones\ValidacionesTransaferencias;

class TransferenciasController extends Controller
{

    /**
     * @api {get} /api/v1/administradora/transferencias Muestra varios registros de transferencias
     * @apiVersion 1.0.0 
     * @apiName MostrarTransaferencias
     * @apiGroup Transferencia

     * @apiSuccess (200) {json} Transaferencias.
     *
     * @apiSuccessExample Success-Response:
     *     HTTP/1.1 200 OK
     * {
     *    "data": [
     *    {
     *     "id": 1,
     *     "productora_id": 3,
     *     "fecha_solicitud": "2010-04-25 12:48:57",
     *     "fecha_solventada": null,
     *     "nro_operacion": "5cbde2ea6bdc8ec2838187a12cd26d54f039f07d",
     *     "codigo": "ed60cf323476b84fd96d754822d8d0fdd4b0383e",
     *     "monto": "738.96",
     *     "estado": "solicitud",
     *     "rc": "a3",
     *     "recibo": "c0c8e12ab4292bd2d5b8ed64816ebdc8f565ac0e",
     *     "deleted_at": null,
     *     "created_at": "1994-04-12 10:12:59",
     *     "updated_at": "1985-05-22 17:26:18"
     *   },
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
    public function mostrarTransferencias()
    {
        $transferencias = Transferencias::all();
        return (count($transferencias) > 0) ? response()->json(['data' => $transferencias->toArray()], 200) :
                response()->json(['data' => false], 404);
    }

    /**
     * @api {post} /api/v1/administradora/transferencias Crea un nuevo registro de
     * transferencias
     * @apiVersion 1.0.0
     * @apiName crearTransferencia
     * @apiGroup Transaferencias
     * @apiHeader {String} Content-Type Tipo de contenido para el request enviado
     * @apiHeaderExample {json} Header-Example:
     * {
     *  "Content-Type": "multipart/form-data"
     * }
     * @apiParam {Integer} productora_id    Id Productora
     * @apiParam {String} codigo            Codigo
     * @apiParam {Float}  monto             Monto
     * @apiParam {File}   recibo            Recibo  

     * @apiParamExample {json} Request-Example:
     *       productora_id =  1,
     *       codigo =  abc1,
     *       monto = 450.36,
     *       recibo = imagen.jpg  || imagen.png || imagen.jpeg || archivo.pdf
     *
     * @apiSuccess {Integer} Transferencia ID.
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
     *        "errors": "TransferenciaNotSave"
     *     }
     */
    public function crearTransferencia(Request $request)
    {
        if (!$request->hasFile('recibo')) {
            return response()->json(['data' => false], 404);
        }

        $request->merge(['nro_operacion' => str_random(16),
            'fecha_solicitud' => Carbon::now()->toDateTimeString(), 'estado' => 'solicitud']);
        $data = $request->all();
        $validator = ValidacionesTransaferencias::crearTransferenciaValidacion($data);
        if ($validator->fails()) {
            return response()->json(['data' => false, 'error' =>
                        $validator->messages()->first()], 404);
        }

        list($base_path, $transferencia, $file) = [storage_path(), new Transferencias(), $request->file('recibo')];
        $nombre = str_random(12) . '.' . $file->getClientOriginalExtension();
        $destinationPath = $base_path . "\\app\\public\\Recibos\\Transferencia" . $data['nro_operacion'];
        $file->move($destinationPath, $nombre);
        $data['recibo'] = $nombre;

        $transferencia->fill($data);
        return ($transferencia->save()) ? response()->json(['id' => $transferencia->id], 200) :
                response()->json(['data' => false,
                    'errors' => $transferencia->getErrors()], 404);
    }

    /**
     * @api {get} /api/v1/administradora/transferencias/{transferencia_id} Muestra un registro de transferencias
     * @apiVersion 1.0.0 
     * @apiName MostrarTransferencia
     * @apiGroup Transferencia
     * @apiParam {Integer} transferencia_id     Id Transferencia

     * @apiSuccess (200) {json} Transferencia
     *
     * @apiSuccessExample Success-Response:
     *     HTTP/1.1 200 OK
     *   {
     *     "data": {
     *     "id": 9,
     *     "productora_id": 1,
     *     "fecha_solicitud": "2016-11-13 01:39:34",
     *     "fecha_solventada": null,
     *     "nro_operacion": "HJYvtNoLT0hW4Zrf",
     *     "codigo": "abc1",
     *     "monto": "450.65",
     *     "estado": null,
     *     "rc": null,
     *     "recibo": "g5YuWtFuIsN2.pdf",
     *     "deleted_at": null,
     *     "created_at": "2016-11-13 01:39:34",
     *     "updated_at": "2016-11-13 01:39:34"
     *   }
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
    public function mostrarTransferencia(Request $request, $transferencia_id)
    {
        $request->merge(['transferencia_id' => $transferencia_id]);
        $data = $request->all();
        $validator = ValidacionesTransaferencias::mostrarTransferenciaValidacion($data);
        if ($validator->fails()) {
            return response()->json(['data' => false, 'error' =>
                        $validator->messages()->first()], 404);
        }
        $transferencia = Transferencias::whereId($data['transferencia_id'])->first();
        if (count($transferencia) > 0) {
            return response()->json(['data' => $transferencia->toArray()], 200);
        } else {
            return response()->json(['data' => false], 404);
        }
    }

    /**
     * @api {post} /api/v1/administradora/transferencias/{transferencia_id} Actualiza un registro de transferencias
     * @apiVersion 1.0.0 
     * @apiName ModificarTransferencia
     * @apiGroup Transferencia
     * @apiHeader {String} Content-Type Tipo de contenido para el request enviado
     * @apiHeaderExample {json} Header-Example:
     * {
     *  "Content-Type": "multipart/form-data"
     * }
     * @apiParam {Integer} productora_id    Id Productora
     * @apiParam {String} codigo            Codigo
     * @apiParam {Float}  monto             Monto
     * @apiParam {File}   recibo            Recibo  

     * @apiParamExample {json} Request-Example:
     *       productora_id =  1,
     *       codigo =  abc1,
     *       monto = 450.36,
     *       rc = a1
     *       estado = exitoso
     *       recibo = imagen.jpg  || imagen.png || imagen.jpeg || archivo.pdf
     * 
     * @apiSuccess (200) {Boolean} true Transferencia Modificada.
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
     *        "errors": "TransferenciaNotSave"
     *     }
     */
    public function actualizarTransferencia(Request $request, $transferencia_id)
    {

        $request->merge(['transferencia_id' => $transferencia_id]);
        $data = $request->all();
        $validator = ValidacionesTransaferencias::actualizarTransferenciaValidacion($data);
        if ($validator->fails()) {
            return response()->json(['data' => false, 'error' =>
                        $validator->messages()->first()], 404);
        }

        $transferencia = Transferencias::whereId($transferencia_id)->first();
        if ($request->hasFile('recibo')) {
            list($base_path, $file) = [storage_path(), $request->file('recibo')];
            $nombre = str_random(12) . '.' . $file->getClientOriginalExtension();
            $destinationPath = $base_path . "\\app\\public\\Recibos\\Transferencia" . $transferencia->nro_operacion;
            if (file_exists($destinationPath . "\\" . $transferencia->recibo)) {
                File::delete($destinationPath . "\\" . $transferencia->recibo);
            }
            $file->move($destinationPath, $nombre);
            $data['recibo'] = $nombre;
        }

        $transferencia->fill($data);
        return ($transferencia->save()) ? response()->json(['id' => true], 200) :
                response()->json(['data' => false,
                    'errors' => $transferencia->getErrors()], 404);
    }

    /**
     * @api {delete} /api/v1/administradora/transferencias/{transferencia_id} Elimina un 
     * registro de transferencias
     * @apiVersion 1.0.0 
     * @apiName EliminarTransferencia
     * @apiGroup Transaferencias
     * @apiParam {Integer} transferencia_id     Id Transferencia

     * @apiSuccess (200) {Boolean} true Transferencia Eliminada.
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
    public function eliminarTransferencia(Request $request, $transferencia_id)
    {
        $request->merge(['transferencia_id' => $transferencia_id]);
        $data = $request->all();
        $validator = ValidacionesTransaferencias::eliminarTransferenciaValidacion($data);
        if ($validator->fails()) {
            return response()->json(['data' => false, 'error' =>
                        $validator->messages()->first()], 404);
        }
        $transferencia = Transferencias::whereId($data['transferencia_id'])->first();
        if (count($transferencia) > 0) {
            return ($transferencia->delete()) ?
                    response()->json(['data' => true], 200) :
                    response()->json(['data' => false], 404);
        } else {
            return response()->json(['data' => false], 404);
        }
    }

}
