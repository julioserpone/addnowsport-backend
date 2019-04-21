<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Modelos\Disciplina;
use App\Validaciones\ValidacionesDisciplinas;

class DisciplinasController extends Controller
{

    /**
     * @api {post} /api/v1/Disciplinas Crea un nuevo registro de Disciplinas
     * @apiVersion 1.0.0
     * @apiName crearDisciplina
     * @apiGroup Disciplina
     * @apiHeader {String} Content-Type Tipo de contenido para el request enviado
     * @apiHeaderExample {json} Header-Example:
     * {
     *  "Content-Type": "application/json"
     * }
     * @apiParam {String} nombre    Nombre de Disciplina
     * @apiParamExample {json} Request-Example:
     * {
     *   "nombre": "Disciplina1",
     * }
     * @apiSuccess (200) {Integer} id   Id Disciplina creada
     *
     * @apiSuccessExample Success-Response:
     *     HTTP/1.1 200 OK
     *     {
     *       "id": 1
     *     }
     *
     * @apiError {json}  json   Retorna un json de estructura <code>{ "errors": false }</code> 
     *
     * @apiErrorExample Error-Response:
     *     HTTP/1.1 404 DisciplinaNotSave
     *     {
     *        "errors": "DisciplinaNotSave"
     *     }
     */
    public function crearDisciplina(Request $request)
    {
        $data = $request->all();
        $validator = ValidacionesDisciplinas::crearDisciplinaValidation($data);
        if ($validator->fails()) {
            return response()->json(['error' =>
                        $validator->messages()->first()], 404);
        }
        $disciplina = new Disciplina();
        $disciplina->fill($data);
        return ($disciplina->save()) ? response()->json(['id' => $disciplina->id], 200) :
                response()->json(['errors' => $disciplina->getErrors()], 404);
    }

    /**
     * @api {post} /api/v1/Disciplinas Crea un nuevo registro de Disciplinas
     * @apiVersion 1.0.0
     * @apiName crearSubDisciplina
     * @apiGroup Disciplina
     * @apiHeader {String} Content-Type Tipo de contenido para el request enviado
     * @apiHeaderExample {json} Header-Example:
     * {
     *  "Content-Type": "application/json"
     * }
     * @apiParam {String} nombre    Nombre de Disciplina
     * @apiParamExample {json} Request-Example:
     * {
     *   "subdisciplina": 1,
     *   "nombre": "Disciplina1",
     * }
     * @apiSuccess (200) {Integer} id   Id Disciplina creada
     *
     * @apiSuccessExample Success-Response:
     *     HTTP/1.1 200 OK
     *     {
     *       "id": 1
     *     }
     *
     * @apiError {json}  json   Retorna un json de estructura <code>{ "errors": false }</code>
     *
     * @apiErrorExample Error-Response:
     *     HTTP/1.1 404 DisciplinaNotSave
     *     {
     *        "errors": "DisciplinaNotSave"
     *     }
     */
    public function crearSubDisciplina(Request $request)
    {
        $data = $request->all();
        $validator = ValidacionesDisciplinas::crearSubDisciplinaValidation($data);
        if ($validator->fails()) {
            return response()->json(['error' =>
                $validator->messages()->first()], 404);
        }
        $disciplina = new Disciplina();
        $disciplina->fill($data);
        return ($disciplina->save()) ? response()->json(['id' => $disciplina->id], 200) :
            response()->json(['errors' => $disciplina->getErrors()], 404);
    }

    /**
     * @api {get} /api/v1/Disciplinas/{disciplina_id} Muestra un registro de Disciplinas
     * @apiVersion 1.0.0
     *  @apiName MostrarDisciplina
     * @apiGroup Disciplina
     * @apiParam {Integer} Disciplina_id     Id de Disciplina

     * @apiSuccess (200) {json} Disciplina.
     *
     * @apiSuccessExample Success-Response:
     *     HTTP/1.1 200 OK
     *     "data": {
     *       "id": 6,
     *       "subdisciplina": 2,
     *       "nombre": "Disciplinamodificada",
     *       "deleted_at": null,
     *       "created_at": "2016-10-26 20:48:44",
     *       "updated_at": "2016-10-26 21:11:20"
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
    public function mostrarDisciplina(Request $request, $disciplina_id)
    {
        $request->merge(['disciplina_id' => $disciplina_id]);
        $data = $request->all();
        $validator = ValidacionesDisciplinas::mostrarDisciplinaValidacion($data);
        if ($validator->fails()) {
            return response()->json(['data' => false, 'error' =>
                        $validator->messages()->first()], 404);
        }
        $disciplina = Disciplina::whereId($data['disciplina_id'])->first();
        if (count($disciplina) > 0) {
            return response()->json(['data' => $disciplina->toArray()], 200);
        } else {
            response()->json(['data' => false], 404);
        }
    }

    /**
     * @api {get} /api/v1/Disciplinas/ Muestra varios registros de Disciplinas
     * @apiVersion 1.0.0
     *  @apiName MostrarDisciplinas
     * @apiGroup Disciplina

     * @apiSuccess (200) {json} Disciplinas.
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
     *          "created_at": "2016-10-26 10:31:41",
     *          "updated_at": "2016-10-26 09:01:56"
     *        },
     *      ...
     *  ]
     * }
     *
     */
    public function mostrarDisciplinas(Request $request)
    {
        $disciplinas = Disciplina::all();
        return response()->json(['data' => $disciplinas->toArray()], 200);
    }

    /**
     * @api {put} /api/v1/Disciplinas/{disciplina_id} Actualiza un registro de Disciplinas
     * @apiVersion 1.0.0
     * @apiName ModificarDisciplina
     * @apiGroup Disciplina
     * @apiHeader {String} Content-Type Tipo de contenido para el request enviado
     * @apiHeaderExample {json} Header-Example:
     * {
     *  "Content-Type": "application/json"
     * }
     * @apiParam {Integer} fecha_id     Id de fecha
     * @apiParam {String} nombre    Nombre de Disciplina
     * @apiParam {String} status    Estatus de Disciplina
     * @apiParamExample {json} Request-Example:
     * {
     *   "fecha_id": 2,
     *   "nombre": "Disciplina2",
     * }
     * @apiSuccess {Boolean} true Disciplina Modificada.
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
     *        "errors": "DisciplinaNotSave"
     *     }
     */
    public function actualizarDisciplina(Request $request, $disciplina_id)
    {
        $request->merge(['id' => $disciplina_id]);
        $data = $request->all();
        $validator = ValidacionesDisciplinas::actualizarDisciplinaValidacion($data);
        if ($validator->fails()) {
            return response()->json(['data' => false, 'error' =>
                        $validator->messages()->first()], 404);
        }
        $disciplina = Disciplina::where('id', $data['id'])->first();
        if (!is_null($disciplina) || !empty($disciplina)) {
            $disciplina->fill($data);
            return ($disciplina->save()) ? response()->json(['data' => true], 200) :
                    response()->json(['data' => false, 'errors' => $disciplina->getErrors()], 404);
        } else {
            return response()->json(['data' => false], 404);
        }
    }

    /**
     * @api {delete} /api/v1/Disciplinas/{disciplina_id} Elimina un registro de Disciplinas
     * @apiVersion 1.0.0
     * @apiName EliminarDisciplina
     * @apiGroup Disciplina
     * @apiParam {Integer} Disciplina_id     Id de Disciplina

     * @apiSuccess {Boolean} true Disciplina Eliminada.
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
    public function eliminarDisciplina(Request $request, $disciplina_id)
    {
        $request->merge(['disciplina_id' => $disciplina_id]);
        $data = $request->all();
        $validator = ValidacionesDisciplinas::mostrarDisciplinaValidacion($data);
        if ($validator->fails()) {
            return response()->json(['data' => false, 'error' =>
                        $validator->messages()->first()], 404);
        }
        $disciplina = Disciplina::whereId($data['disciplina_id'])->first();
        if (count($disciplina) > 0) {
            return ($disciplina->delete()) ?
                    response()->json(['data' => true], 200) :
                    response()->json(['data' => false], 404);
        } else {
            return response()->json(['status' => false], 404);
        }
    }

    /**
     * @api {put} /api/v1/Disciplinas/{disciplina_id} Actualiza un registro de Disciplinas
     * @apiVersion 1.0.0
     * @apiName ModificarDisciplina
     * @apiGroup Disciplina
     * @apiHeader {String} Content-Type Tipo de contenido para el request enviado
     * @apiHeaderExample {json} Header-Example:
     * {
     *  "Content-Type": "application/json"
     * }
     * @apiParam {Integer} fecha_id     Id de fecha
     * @apiParam {String} nombre    Nombre de Disciplina
     * @apiParam {String} status    Estatus de Disciplina
     * @apiParamExample {json} Request-Example:
     * {
     *   "fecha_id": 2,
     *   "nombre": "Disciplina2",
     * }
     * @apiSuccess {Boolean} true Disciplina Modificada.
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
     *        "errors": "DisciplinaNotSave"
     *     }
     */
    public function actualizarSubDisciplina(Request $request, $disciplina_id)
    {
        $request->merge(['id' => $disciplina_id]);
        $data = $request->all();
        $validator = ValidacionesDisciplinas::actualizarSubDisciplinaValidacion($data);
        if ($validator->fails()) {
            return response()->json(['data' => false, 'error' =>
                $validator->messages()->first()], 404);
        }
        $disciplina = Disciplina::where('id', $data['id'])->first();
        if (!is_null($disciplina) || !empty($disciplina)) {
            $disciplina->fill($data);
            return ($disciplina->save()) ? response()->json(['data' => true], 200) :
                response()->json(['data' => false, 'errors' => $disciplina->getErrors()], 404);
        } else {
            return response()->json(['data' => false], 404);
        }
    }

    /**
     * @api {delete} /api/v1/Disciplinas/all  Muestra las disciplinas con sus subdisciplinas
     * @apiVersion 1.0.0
     * @apiName showSubDisciplinasByDisciplinas
     * @apiGroup Disciplina*
     * @apiSuccessExample Success-Response:
     *     HTTP/1.1 200 OK
     *     {
     *       "data": [
                    {
                    "nombre": "autem",
                    "id": 1,
                    "subdisciplinas": []
                    }
     *             ];
     *
     *     }
     *
     */
    public function showSubDisciplinasByDisciplinas(){

        $d =Disciplina::select('id','nombre')->whereNull('subdisciplina')->get();

        $sd =Disciplina::get();
        $disciplinas=array();
        foreach($d as $act){
            $temp=array();
            foreach($sd as $subact){
                if($subact->subdisciplina==$act->id)
                    $temp[]=array('nombre'=>$subact->nombre,'id'=>$subact->id);
            }
            $disciplinas[]=array('nombre'=>$act->nombre,'id'=>$act->id,'subdisciplinas'=>$temp);

        }

        return response()->json(['data' => $disciplinas], 200);
    }

}
