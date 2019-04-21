<?php

namespace App\Http\Controllers;

/* -----------------------------------------
* GESTOR DE CODIGOS
* Autor: Julio Hernandez
--------------------------------------------*/ 
use App\Modelos\Codigo;
use App\Modelos\Usuario;
use App\Modelos\Productora;
use App\Modelos\Competencia;
use App\Modelos\CodigoCompetencia;
use JWTAuth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Requests\RulesCodigo;
use App\Http\Requests\AplicarCodigo;

use App\Http\Requests;

class CodigoController extends Controller
{
    /**
     * @api {get} /{role}/codigos     Listado de Codigos
     * @apiVersion 1.0.0
     * @apiName listaCodigo
     * @apiDescription Muestra una lista de Codigos registrados. 
     * Si la consulta la ejecuta una administradora, los codigos consultados seran aquellos que pertenezcan a las productoras de esa administradora. 
     * Si la consulta la ejecuta una productora, los codigos consultados seran solamente los de la productora.
     * Si la consulta la ejecuta un administrador del sistema, devuelve todos los codigos
     * 
     * @apiGroup Codigos
     * @apiParam {String} token                   Token generado por el sistema al momento de la autenticacion
     * @apiParamExample {json} Request-Example:
     * {
     *       "token":             "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOjEsImlzcyI6Imh0dHA6XC9cL3BzcC5hcHBcL2FwaVwvdjFcL2F1dGhlbnRpY2F0ZSIsImlhdCI6MTQ3NjkwMzEyMSwiZXhwI",
     * }
     * @apiSuccess (200) {Array}    data                        Contiene objetos JSON con informacion de codigos
     * @apiSuccess (200) {Integer}  data.id                     ID del codigo
     * @apiSuccess (200) {String}   data.codigo                 Identificador 
     * @apiSuccess (200) {String}   data.usuario                Nombre del Usuario que administra a la productora que registro el codigo 
     * @apiSuccess (200) {Integer}  data.productora_id          ID de la Productora dueña del codigo
     * @apiSuccess (200) {String}   data.productora             Nombre de la productora que registro el codigo
     * @apiSuccess (200) {String}   data.tipo                   Tipo de descuento (voucher, descuento, free, notacredito, team)
     * @apiSuccess (200) {String}   data.estatus                Estatus (activo, inactivo, utilizado)
     * @apiSuccess (200) {Date}     data.fecha_inicio           Fecha de inicio (entrada en vigencia) del codigo
     * @apiSuccess (200) {Date}     data.fecha_vencimiento      Fecha de vencimiento del codigo
     * @apiSuccess (200) {Double}   data.porcentaje_descuento   Porcentaje de Descuento
     * @apiSuccess (200) {Integer}  data.limite_uso_cupon       Valor maximo de usos del cupon (en toda una competencia)
     * @apiSuccess (200) {Integer}  data.limite_uso_usuario     Valor maximo de usos de un cupon por parte de un usuario
     * @apiSuccess (200) {Integer}  data.usos                   Total de usos del cupon
     *
     * @apiSuccessExample Success-Response:
     *     HTTP/1.1 200 OK
     *     {
     *         "data": [
     *             {
     *                 "id": 1,
     *                 "codigo": "3229775082",
     *                 "usuario": "Soporte PSP",
     *                 "productora_id": 12,
     *                 "productora": "Hane, Streich and Botsford",
     *                 "tipo": "notacredito",
     *                 "estatus": "activo",
     *                 "fecha_inicio": "2014-10-01",
     *                 "fecha_vencimiento": "2016-12-25",
     *                 "porcentaje_descuento": "27.27",
     *                 "limite_uso_cupon": 13,
     *                 "limite_uso_usuario": 2,
     *                 "usos": 0
     *             },
     *             .
     *             .
     *             .
     *         ]
     *     }
     *
     * @apiError {String}  String   Devuelve un mensaje error indicando falta de permisologias
     *
     * @apiErrorExample {json} Error-Response:
     *     HTTP/1.1 404 NotResult
     *     {
     *         "errors": "Usted no tiene el role necesario para acceder al módulo solicitado"
     *     }
     */
    public function index(Request $request)
    {
        //Usuario Autenticado
        $usuario = Usuario::isAuthenticate();

        if ($usuario) {
            $data = $this->search($request, $usuario);
            return response()->json(['data' => $data], 200);
        } else {
            return response()->json(['errors' => trans('generals.insufficient_role')], 404);
        }
    }

    /**
     * @api {post} /{role}/codigos     Registro de un nuevo Codigo
     * @apiVersion 1.0.0
     * @apiName storeCodigo
     * @apiDescription Registro de un nuevo Codigo. La clase RulesCodigo hace las validaciones de entrada
     * Este proceso varia segun el role que se suministre en la URL. su la ruta recibida es api/v1/system/codigos, el codigo se procesara como un usuario administrador.
     * Si por el contrario, el <code>{role}</code> es administradora, el registro se puede aplicar para todas las productoras de esa administradora
     * 
     * @apiGroup Codigos
     * @apiHeader {String} Content-Type  Tipo de contenido para el request enviado
     * @apiHeader {String} Authorization Tipo de Autorizacion. Se debe indicar la palabra Bearer con el valor del token generado por el sistema. Sin esto, la peticion no se procesa
     * @apiHeaderExample {json} Header-Example:
     * {
     *  "Content-Type":  "application/json"
     *  "Authorization": "Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOjEsImlzcyI6Imh0dHA6XC9cL3BzcC5hcHBcL2FwaVwvdjFcL2F1dGhlbnRpY2F0ZSIsImlhdCI6MTQ3ODExMzc5NCwiZXhwIjoxNDc4MTE3Mzk0LCJuYmYiOjE0NzgxMTM3OTQsImp0aSI6IjYxZDM3ZDBjMzE3MWE0NjZmMjM3YmVjNzdiMGMwYmFmIn0.TmoorRLZBiN95XuBYmXucRoPfn5tA6VpjHSD4MmHJHM"
     * }
     * @apiParam {String}   codigo                  Cadena que identifica al Codigo en el sistema
     * @apiParam {String}   fecha_inicio            Fecha de inicio (validez) del codigo
     * @apiParam {String}   fecha_vencimiento       Fecha de vencimiento del codigo
     * @apiParam {Double}   porcentaje_descuento    Porcentaje de descuento. Si tipo es 'free', el sistema le asigna 100 al porcentaje
     * @apiParam {Integer}  competencia             Id de la competencia. Si es -1, se asigna a todas las competencias de la productora
     * @apiParam {Integer}  productora              Id de la productora. Si es -1, se asigna a todas las productoras de la administradora
     * @apiParam {Integer}  limite_uso_cupon        Limite establecido para que un codigo sea usado
     * @apiParam {Integer}  limite_uso_usuario      Limite establecido para que un codigo sea usado por un usuario
     * @apiParam {String}   [tipo]                  Tipo de Descuento. Valores permitidos: voucher, descuento, free, notacredito, team. Por default es 'descuento'
     * @apiParam {String}   [estatus]               Valor del Checkbox para recordar al usuario
     * @apiParamExample {json} Request-Example:
     * {
     *     "codigo": "1234561239",
     *     "fecha_inicio": "01/01/2016",
     *     "fecha_vencimiento": "01/12/2016",
     *     "porcentaje_descuento": 20,
     *     "competencia": -1,
     *     "productora": -1,
     *     "limite_uso_cupon": 10,
     *     "limite_uso_usuario": 10,
     *     "tipo" : "descuento",
     *     "estatus" : "activo"
     * }
     * @apiSuccess (200) {Boolean} data              Booleano que indica el resultado de la operacion. True: Exitoso. False: Error
     *
     * @apiSuccessExample Success-Response:
     *     HTTP/1.1 200 OK
     *     {
     *         "data":   true
     *     }
     *
     * @apiError {Boolean}  data   Retorna <code>false</code> si las credenciales suministradas no son válidas
     *
     * @apiErrorExample {json} Error-Response:
     *     HTTP/1.1 404 NotProcess
     *     {
     *         "data":   false
     *         "errors": ["Listado de errores"]
     *     }
     */
    public function store(RulesCodigo $request)
    {

        //Luego de validados los datos en la Clase RegistrarCodigo, procedemos al registro. 
        $codigo = Codigo::where('codigo', $request->get('codigo'))->withTrashed()->first();
        
        //Si el codigo ya existe, no lo procesamos. Ahora, un mismo codigo puede registrarse para varias productoras
        if ($codigo) {
            return response()->json(['data'=> false, 'errors' => trans('codigos.codigo_existe', ['codigo' => $codigo->codigo])], 404);
        } else {

            //Registro del codigo
            $usuario = Usuario::isAuthenticate();
            $data = $request->except(['productora','competencia']);
            $productora_id = $request->get('productora');
            $competencia_id = $request->get('competencia');

            //Si el usuario es el administrador del sistema, registro el codigo a la productora seleccionada. Si productora_id = -1, asocio el codigo a todas las productoras
            switch ($usuario->role_activo) {
                case 'system':
                    $productoras = Productora::all();
                    break;
                case 'administradora':
                    $productoras = Productora::where('usuario_id', $usuario->id)->get();
                    break;
                case 'productora':
                    $productoras = Productora::where('id', $usuario->productora_activa)->get();
                    $productora_id = $productoras->first()->id;
                    break;
            }

            //Registro el codigo para todas las productoras del sistema
            if ($productora_id == -1) {
                if ($usuario->role_activo == 'system') {
                    foreach ($productoras as $productora) {

                        $codigo = Codigo::registrar($data, $productora->id, $usuario);
                        
                        //Asocio el codigo para todas las competencias del sistema
                        Competencia::asociarCodigo($codigo, $productora, $competencia_id);
                    }
                } else {
                    return response()->json(['data'=> false, 'errors' => trans('codigos.proceso_no_permitido')], 404);
                }
            } else {
                //Registro del codigo solo para la productora seleccionada
                $codigo = Codigo::registrar($data, $productora_id, $usuario);

                //Asocio el codigo para todas las competencias de la productora
                foreach ($productoras as $productora) {
                    Competencia::asociarCodigo($codigo, $productora, $competencia_id);
                }
            }

        }
        return response()->json(['data'=> true], 200);
    }

    /**
     * @api {get} /{role}/codigos/{codigo_id}     Datos de un Codigo
     * @apiVersion 1.0.0
     * @apiName showCodigo
     * @apiDescription Realiza la consulta de datos asociados a un Codigo
     * 
     * @apiGroup Codigos
     * @apiParam {String} token         Token generado por el sistema al momento de la autenticacion
     * @apiParamExample {json} Request-Example:
     * {
     *   "token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOjEsImlzcyI6Imh0dHA6XC9cL3BzcC5hcHBcL2FwaVwvdjFcL2F1dGhlbnRpY2F0ZSIsImlhdCI6MTQ3NjkwMzEyMSwiZXhwI"
     * }
     * @apiSuccess (200) {Array}    data                        Contiene objetos JSON con informacion de codigos
     * @apiSuccess (200) {Integer}  data.usuario_id             ID de Usuario que tipo Administradora
     * @apiSuccess (200) {Integer}  data.productora_id          ID de la Productora dueña del codigo
     * @apiSuccess (200) {String}   data.codigo                 Identificador 
     * @apiSuccess (200) {Date}     data.fecha_inicio           Fecha de inicio (entrada en vigencia) del codigo
     * @apiSuccess (200) {Date}     data.fecha_vencimiento      Fecha de vencimiento del codigo
     * @apiSuccess (200) {String}   data.tipo                   Tipo de descuento (voucher, descuento, free, notacredito, team)
     * @apiSuccess (200) {String}   data.estatus                Estatus (activo, inactivo, utilizado)
     * @apiSuccess (200) {Double}   data.porcentaje_descuento   Porcentaje de Descuento
     * @apiSuccess (200) {Date}     data.deleted_at             Fecha de eliminacion logica
     * @apiSuccess (200) {Date}     data.created_at             Fecha de registro
     * @apiSuccess (200) {Date}     data.updated_at             Ultima fecha de actualizacion
     *
     * @apiSuccessExample Success-Response:
     *     HTTP/1.1 200 OK
     *     {
     *         "data": [
     *             {
     *                 "id": 1,
     *                 "usuario_id": 7,
     *                 "productora_id": 12,
     *                 "codigo": "3229775082",
     *                 "fecha_inicio": "2014-10-01",
     *                 "fecha_vencimiento": "2016-12-25",
     *                 "limite_uso_cupon": 13,
     *                 "limite_uso_usuario": 2,
     *                 "tipo": "notacredito",
     *                 "estatus": "activo",
     *                 "porcentaje_descuento": "27.27",
     *                 "deleted_at": null,
     *                 "created_at": "2005-09-21 05:03:56",
     *                 "updated_at": "1972-12-07 02:19:21"
     *             },
     *             .
     *             .
     *             .
     *         ]
     *     }
     *
     * @apiError {Boolean}  data   Retorna <code>false</code> si no se encontro el codigo solicitado
     *
     * @apiErrorExample {json} Error-Response:
     *     HTTP/1.1 404 NotProcess
     *     {
     *         "data":      false,
     *         "errors":    "No se encontraron los valores solicitados"
     *     }
     */
    public function show($id)
    {
        $codigo = Codigo::find($id);
        if (!$codigo->count()) {
            return response()->json(['data'=> false, 'errors' => trans('generals.not_found')], 404);
        }
        return response()->json(['data'=> $codigo], 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * @api {put} /{role}/codigos/{codigo_id}     Actualizacion de un Codigo
     * @apiVersion 1.0.0
     * @apiName updateCodigo
     * @apiDescription Actualizacion de un Codigo. La clase RulesCodigo hace las validaciones de entrada
     * Este proceso varia segun el role que se suministre en la URL. su la ruta recibida es api/v1/system/codigos, el codigo se procesara como un usuario administrador.
     * Si por el contrario, el <code>{role}</code> es administradora, el registro se puede aplicar para todas las productoras de esa administradora
     * 
     * @apiGroup Codigos
     * @apiHeader {String} Content-Type  Tipo de contenido para el request enviado
     * @apiHeader {String} Authorization Tipo de Autorizacion. Se debe indicar la palabra Bearer con el valor del token generado por el sistema. Sin esto, la peticion no se procesa
     * @apiHeaderExample {json} Header-Example:
     * {
     *  "Content-Type":  "application/json"
     *  "Authorization": "Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOjEsImlzcyI6Imh0dHA6XC9cL3BzcC5hcHBcL2FwaVwvdjFcL2F1dGhlbnRpY2F0ZSIsImlhdCI6MTQ3ODExMzc5NCwiZXhwIjoxNDc4MTE3Mzk0LCJuYmYiOjE0NzgxMTM3OTQsImp0aSI6IjYxZDM3ZDBjMzE3MWE0NjZmMjM3YmVjNzdiMGMwYmFmIn0.TmoorRLZBiN95XuBYmXucRoPfn5tA6VpjHSD4MmHJHM"
     * }
     * @apiParam {String}   codigo                  Cadena que identifica al Codigo en el sistema
     * @apiParam {String}   fecha_inicio            Fecha de inicio (validez) del codigo
     * @apiParam {String}   fecha_vencimiento       Fecha de vencimiento del codigo
     * @apiParam {Double}   porcentaje_descuento    Porcentaje de descuento. Si tipo es 'free', el sistema le asigna 100 al porcentaje
     * @apiParam {Integer}  competencia             Id de la competencia. Si es -1, se asigna a todas las competencias de la productora
     * @apiParam {Integer}  productora              Id de la productora. Si es -1, se asigna a todas las productoras de la administradora
     * @apiParam {Integer}  limite_uso_cupon        Limite establecido para que un codigo sea usado
     * @apiParam {Integer}  limite_uso_usuario      Limite establecido para que un codigo sea usado por un usuario
     * @apiParam {String}   [tipo]                  Tipo de Descuento. Valores permitidos: voucher, descuento, free, notacredito, team. Por default es 'descuento'
     * @apiParam {String}   [estatus]               Valor del Checkbox para recordar al usuario
     * @apiParamExample {json} Request-Example:
     * {
     *     "codigo": "1234561239",
     *     "fecha_inicio": "01/01/2016",
     *     "fecha_vencimiento": "01/12/2016",
     *     "porcentaje_descuento": 20,
     *     "competencia": -1,
     *     "productora": -1,
     *     "limite_uso_cupon": 10,
     *     "limite_uso_usuario": 10,
     *     "tipo" : "descuento",
     *     "estatus" : "activo"
     * }
     * @apiSuccess (200) {Boolean} data              Booleano que indica el resultado de la operacion. True: Exitoso. False: Error
     *
     * @apiSuccessExample Success-Response:
     *     HTTP/1.1 200 OK
     *     {
     *         "data":   true
     *     }
     *
     * @apiError {Boolean}  data   Retorna <code>false</code> si las credenciales suministradas no son válidas o si se encontraron errores procesando la peticion
     *
     * @apiErrorExample {json} Error-Response:
     *     HTTP/1.1 404 NotProcess
     *     {
     *         "data":   false,
     *         "errors": ["Listado de errores"]
     *     }
     */
    public function update(RulesCodigo $request, $id)
    {
    
        $codigo = Codigo::FindWithRelations($id)->first();

        //Si el codigo no existe, no lo procesamos
        if (!$codigo) {
            return response()->json(['data'=> false, 'errors' => trans('codigos.codigo_no_existe')], 404);
        } else {

            $usuario = Usuario::isAuthenticate();
            $data = $request->except(['productora','competencia']);
            $productora_id = $request->get('productora');
            $competencia_id = $request->get('competencia');

            //Validacion si el cupon esta en uso queda(PENDIENTE, faltan las tablas)


            //Actualizacion del codigo
            $codigo->update($data);

            //Si el usuario es el administrador del sistema, actualizo el codigo a la productora seleccionada. Si productora_id = -1, actualizo el codigo asociado a las competencias de todas las productoras
            switch ($usuario->role_activo) {
                case 'system':
                    $productoras = Productora::all();
                    break;
                case 'administradora':
                    $productoras = Productora::where('usuario_id', $usuario->id)->get();
                    break;
                case 'productora':
                    $productoras = Productora::where('id', $usuario->productora_activa)->get();
                    $productora_id = $productoras->first()->id;
                    break;
            }
            //Recalculo el descuento y el monto a pagar de los codigos asociados a las competencias
            if ($productora_id == -1) {

                if ($usuario->role_activo == 'system') {
                    foreach ($productoras as $productora) {

                        //Reasocio el codigo para todas las competencias del sistema
                        Competencia::asociarCodigo($codigo, $productora, $competencia_id, true);
                    }
                } else {
                    return response()->json(['data'=> false, 'errors' => trans('codigos.proceso_no_permitido')], 404);
                }
            } else {
               
                //Asocio el codigo para todas las competencias de la productora
                foreach ($productoras as $productora) {
                    Competencia::asociarCodigo($codigo, $productora, $competencia_id, true);
                }
            }
        }
        return response()->json(['data'=> true], 200);
    }

    /**
     * @api {delete} /{role}/codigos/{codigo_id}     Eliminacion logica de un Codigo
     * @apiVersion 1.0.0
     * @apiName destroyCodigo
     * @apiDescription Elimina de forma logica un codigo. Se eliminan tambien (de forma definitiva) las asociaciones con competencias
     * 
     * @apiGroup Codigos
     * @apiParam {String} token         Token generado por el sistema al momento de la autenticacion
     * @apiParamExample {json} Request-Example:
     * {
     *   "token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOjEsImlzcyI6Imh0dHA6XC9cL3BzcC5hcHBcL2FwaVwvdjFcL2F1dGhlbnRpY2F0ZSIsImlhdCI6MTQ3NjkwMzEyMSwiZXhwI"
     * }
     * @apiSuccess (200) {Boolean} data              Boolean que indica el resultado de la operacion. True: Exitoso. False: Error
     *
     * @apiSuccessExample Success-Response:
     *     HTTP/1.1 200 OK
     *     {
     *         "data":   true
     *     }
     *
     * @apiError {Boolean}  data   Retorna <code>false</code> si las credenciales suministradas no son válidas o si se encontraron errores procesando la peticion
     *
     * @apiErrorExample {json} Error-Response:
     *     HTTP/1.1 404 NotProcess
     *     {
     *         "data":   false
     *     }
     */
    public function destroy($id)
    {
        $codigo = Codigo::FindWithRelations($id)->first();
        if ($codigo->count()) {
            //Elimina de manera logica el codigo
            $codigo->delete();
            //Y elimino los codigos asociados a las competencias
            $codigo->competencia()->detach();
            return response()->json(['data'=> true], 200);
        } else {
            return response()->json(['data'=> false], 404);
        }

    }

    /**
     * @api {get} /{role}/codigos/{codigo_id}/estatus/{estatus}     Cambio de estatus de un codigo
     * @apiVersion 1.0.0
     * @apiName cambiarEstatus
     * @apiDescription Realiza el cambio de estatus de un determinado codigo. Si se recibe el <code>estatus</code> con valor activo, se cambia a inactivo o viceversa
     * 
     * @apiGroup Codigos
     * @apiParam {String} token         Token generado por el sistema al momento de la autenticacion
     * @apiParamExample {json} Request-Example:
     * {
     *   "token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOjEsImlzcyI6Imh0dHA6XC9cL3BzcC5hcHBcL2FwaVwvdjFcL2F1dGhlbnRpY2F0ZSIsImlhdCI6MTQ3NjkwMzEyMSwiZXhwI"
     * }
     * @apiSuccess (200) {Boolean} data              Boolean que indica el resultado de la operacion. True: Exitoso. False: Error
     *
     * @apiSuccessExample Success-Response:
     *     HTTP/1.1 200 OK
     *     {
     *         "data":   true
     *     }
     *
     * @apiError {Boolean}  data   Retorna <code>false</code> si las credenciales suministradas no son válidas o si se encontraron errores procesando la peticion
     *
     * @apiErrorExample {json} Error-Response:
     *     HTTP/1.1 404 NotProcess
     *     {
     *         "data":   false,
     *         "errors": ["Listado de errores"]
     *     }
     */
    public function cambiarEstatus($id, $estatus) {

        $codigo = Codigo::withTrashed()->where('id', $id)->first();

        if ($codigo) {

            switch ($estatus) {
                case 'activo':
                    //Inactivo
                $deleted_at = \Carbon\Carbon::now();
                $codigo->estatus = 'inactivo';
                $codigo->deleted_at = $deleted_at->toDateTimeString();
                $codigo->save();
                break;
                case 'inactivo':
                    //Activo
                $codigo->deleted_at = null;
                $codigo->estatus = 'activo';
                $codigo->save();  
                break;
            }
            
        } else {
            return response()->json(['data'=> false, 'errors' => trans('generals.not_found')], 404);
        }
        return response()->json(['data'=> true], 200);
    }

    /**
     * @api {get} /{role}/codigos/search     Busqueda avanzada de codigos
     * @apiVersion 1.0.0
     * @apiName searchCodigo
     * @apiDescription Ejecuta una consulta de codigos, dependiendo de los parametros que se suministren. 
     * Si la consulta la ejecuta una administradora, los codigos consultados seran aquellos que pertenezcan a las productoras de esa administradora. 
     * Si la consulta la ejecuta una productora, los codigos consultados seran solamente los de la productora.
     * Si la consulta la ejecuta un administrador del sistema, devuelve todos los codigos
     * 
     * @apiGroup Codigos
     * @apiParam {String} token                   Token generado por el sistema al momento de la autenticacion
     * @apiParam {String} [codigo]                Codigo
     * @apiParam {String} [tipo]                  Tipo de Codigo
     * @apiParam {String} [fecha_inicio]          Fecha de Inicio (entrada en vigencia) del codigo. Formato yyyy-mm-dd
     * @apiParam {String} [fecha_vencimiento]     Fecha de Vencimiento del codigo. Formato yyyy-mm-dd
     * @apiParam {String} [estatus]               Estatus del codigo. (activo, inactivo, utilizado)
     * @apiParamExample {json} Request-Example:
     * {
     *       "token":             "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOjEsImlzcyI6Imh0dHA6XC9cL3BzcC5hcHBcL2FwaVwvdjFcL2F1dGhlbnRpY2F0ZSIsImlhdCI6MTQ3NjkwMzEyMSwiZXhwI",
     *       "codigo"             "123456",
     *       "tipo":              "descuento",
     *       "fecha_inicio":      "2000-01-01",
     *       "fecha_vencimiento": "2000-12-31",
     *       "estatus":           "activo"
     * }
     * @apiSuccess (200) {JSON} data              JSON con informacion de codigos
     *
     * @apiSuccessExample Success-Response:
     *     HTTP/1.1 200 OK
     *     {
     *         [
     *             {
     *                 "id": 1,
     *                 "codigo": "3229775082",
     *                 "usuario": "Soporte PSP",
     *                 "productora_id": 12,
     *                 "productora": "Hane, Streich and Botsford",
     *                 "tipo": "notacredito",
     *                 "estatus": "activo",
     *                 "fecha_inicio": "2014-10-01",
     *                 "fecha_vencimiento": "2016-12-25",
     *                 "porcentaje_descuento": "27.27",
     *                 "limite_uso_cupon": 13,
     *                 "limite_uso_usuario": 2,
     *                 "usos": 0
     *             },
     *             .
     *             .
     *             .
     *         ]
     *     }
     *
     * @apiError {Boolean}  Array   Retorna un Array vacio
     *
     * @apiErrorExample {json} Error-Response:
     *     HTTP/1.1 404 NotResult
     *     {
     *         []
     *     }
     */
    public function search(Request $request, $usuario = null) {

        //Pre-armado de la coleccion de Codigos
        $query = Codigo::FindWithRelations();

        //Parametros que se pueden recibir para la consulta (codigo, tipo, fecha de inicio o vencimiento, status)
        $data = [];
        $p_codigo = trim($request->get('codigo'));
        $p_tipo = trim($request->get('tipo'));
        $p_fecha_inicio = trim($request->get('fecha_inicio'));
        $p_fecha_vencimiento = trim($request->get('fecha_vencimiento'));
        $p_estatus = trim($request->get('estatus'));

        //Asignacion de parametros
        if ($p_codigo != '') $query->whereRaw("codigo like '%" . $p_codigo . "%'");
        if ($p_tipo != '') $query->whereRaw("tipo = '" . $p_tipo . "'");
        if (($p_fecha_inicio != '') || ($p_fecha_vencimiento != '')) {
            $query->OfDates($p_fecha_inicio, $p_fecha_vencimiento);
            //dd($query->toSql());
        }
        if ($p_estatus != '') $query->whereRaw("estatus = '" . $p_estatus . "'");

        //Si se requiere verificar el role del usuario para determinar que codigos mostrar
        //EN CASO DE SER ROLE SYSTEM, NO APLICO FILTRO POR ROLE. SE DEVUELVE TODOS LOS CODIGOS
        if ($usuario) {
            //Muestra los codigos de todas las productoras asociadas a esta administradora
            if ($usuario->hasRole('administradora')) {
                $query->whereIn('productora_id', $usuario->productoras_id);
            } else {
                //Muestra solamente los codigos de esta productora
                if ($usuario->hasRole('productora')) {
                    $query->where('usuario_id', $usuario->id);
                }
            }
        }

        $codigos = $query->orderBy('codigo', 'asc')->get();

        //Calculo de campos USOS y definicion de campos a mostrar en grid
        $codigos->each(function($codigo, $key) use (&$data){

            //$codigo = iteracion (item) de la collection
            $data[$key]['id'] = $codigo->id;
            $data[$key]['codigo'] = $codigo->codigo;
            $data[$key]['usuario'] = $codigo->usuario->nombre_completo;
            $data[$key]['productora_id'] = $codigo->productora->id;
            $data[$key]['productora'] = $codigo->productora->nombre;
            $data[$key]['tipo'] = $codigo->tipo;
            $data[$key]['estatus'] = $codigo->estatus;
            $data[$key]['fecha_inicio'] = $codigo->fecha_inicio;
            $data[$key]['fecha_vencimiento'] = $codigo->fecha_vencimiento;
            $data[$key]['porcentaje_descuento'] = $codigo->porcentaje_descuento;
            $data[$key]['limite_uso_cupon'] = $codigo->limite_uso_cupon;
            $data[$key]['limite_uso_usuario'] = $codigo->limite_uso_usuario;
            $data[$key]['usos'] = 0;   //Falta tabla donde se cargan los cupones utilizados
        });

        return $data;

    }

    public function aplicarCodigo(AplicarCodigo $request, $codigo)
    {
        
        $usuario = Usuario::isAuthenticate();
        $codigo = Codigo::aplicarCodigo($codigo, $request->competencia_id, $request->productora_id, $usuario);

        if ($codigo) return response()->json(['data'=> $codigo], 200);
        else return response()->json(['data'=> false, 'errors' => trans('codigos.codigo_no_aplicable')], 404);

    }

}
