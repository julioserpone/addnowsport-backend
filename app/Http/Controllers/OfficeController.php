<?php

namespace App\Http\Controllers;

use Excel;
use Exception;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use App\Validaciones\ValidacionesOffice;

class OfficeController extends Controller
{

    /**
     * @api {post} /v1/system/office/importar Exporta el resultado a excel 
     * de una consulta
     * @apiVersion 1.0.0
     * @apiName ImportarExcel
     * @apiGroup System
     * @apiParam {File}   archivo     Archivo a importar (Excel)
     * @apiParam {String} tabla       Nombre de la tabla donde se insertaran los datos
     *      
     * @apiParamExample {form-data} Request-Example:
     *      archivo        Archivo excel, a importar
     *      tabla          Nombre de la tabla a insertar
     *  
     * @apiSuccess (200) {true} Archivo guardado y registros guardados.
     *
     * @apiSuccessExample Success-Response:
     *     HTTP/1.1 200 OK
     *     {
     *      data: true
     *     }
     *
     * @apiError {json}  json   Retorna un json de estructura <code>{ "errors": false }</code> 
     *
     * @apiErrorExample Error-Response:
     *     HTTP/1.1 404 DataNotFound
     *     {
     *        "data": false
     *     }
     */
    public function importarResultados(Request $request)
    {
        $data = $request->all();
        $validator = ValidacionesOffice::importarResultadosValidacion($data);

        if ($validator->fails()) {
            return response()->json(['data' => false, 'error' =>
                        $validator->messages()->first()], 404);
        }
        if (!Schema::hasTable($data['tabla'])) {
            return response()->json(['data' => false, 'error' =>
                        'Tabla no encontrada'], 404);
        }
        try {
            Excel::load($request->file('archivo'), function($reader) use ($data) {
                $insert = [];
                $reader->each(function($sheet) use ($insert, $data) {
                    foreach ($sheet->toArray() as $row) {
                        $row = array_filter($row, function($array){return !is_null($array);});
                        array_set($row, 'created_at', Carbon::now()->toDateTimeString());
                        array_set($row, 'updated_at', Carbon::now()->toDateTimeString());
                        array_push($insert, $row);
                    }
                    DB::table($data['tabla'])->insert($insert);
                });
            });
            list($destinationPath, $file) = [storage_path('app\\files\\'), $request->file('archivo')];
            $extension = $file->getClientOriginalExtension();
            $nombre = 'import-' . str_random(8) . '.' . $extension;
            $file->move($destinationPath, $nombre);
            return response()->json(['data' => true]);
        } catch (Exception $e) {
            return response()->json(['data' => false, 'error' =>
                        $e->getMessage()], 404);
        }
    }

    /**
     * @api {post} /v1/system/office/exportar Exporta el resultado a excel 
     * de una consulta
     * @apiVersion 1.0.0
     * @apiName ExportarExcel
     * @apiGroup System
     * @apiParam {String}   filename        Nombre del archivo     
     * @apiParam {String}   type            Tipo del archivo (xls - pdf)
     * @apiParam {String}   content         Contenido (json string)
     * @apiParamExample {json} Request-Example:
     *   {
     *       "filename": 1,
     *       "type": "distancia1",
     *       "content": "",
     *   }
     * @apiSuccess (200) {excel} Documento Excel.
     *
     * @apiSuccessExample Success-Response:
     *     HTTP/1.1 200 OK
     *     Documento Excel
     *
     * @apiError {json}  json   Retorna un json de estructura <code>{ "errors": false }</code> 
     *
     * @apiErrorExample Error-Response:
     *     HTTP/1.1 404 DataNotFound
     *     {
     *        "data": false
     *     }
     */
    public function exportarResultados(Request $request)
    {
        $data = $request->all();
        $validator = ValidacionesOffice::exportarResultadosValidacion($data);
        if ($validator->fails()) {
            return response()->json(['data' => false, 'error' =>
                        $validator->messages()->first()], 404);
        }
        $data['filename'] = (empty($data['filename'])) ? str_random(10) : $data['filename'];
        $data['content'] = json_decode($data['content'], true);

        Excel::create($data['filename'] . $data['type'], function($excel) use ($data) {
            $excel->sheet($data['filename'], function($sheet) use ($data) {
                $sheet->fromArray($data['content']);
            });
        })->download($data['type']);

        return response()->json(['data' => true], 200);
    }

}
