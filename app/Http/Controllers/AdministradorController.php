<?php

namespace App\Http\Controllers;

use App\Modelos\DatosBancariosProductoras;
use App\Modelos\Imagen;
use App\Modelos\Rol;
use App\Mail\Email;
use App\Modelos\Usuario;
use App\Modelos\Productora;
use App\Modelos\RolUsuario;
use App\Modelos\Competencia;
use App\Validaciones\ValidacionesProductoras;
use Illuminate\Http\Request;
use App\Modelos\DatosBancarios;
use Illuminate\Support\Facades\Mail;
use App\Modelos\DatosBancariosUsuario;
use App\Validaciones\ValidacionesAdministrador;

class AdministradorController extends Controller
{

    /**
     * @api {post} /api/v1/productora/crear Crea un nuevo registro de Productora
     * @apiVersion 1.0.0
     * @apiName crearProductora
     * @apiGroup Productora
     * @apiHeader {String} Content-Type Tipo de contenido para el request enviado
     * @apiHeaderExample {json} Header-Example:
     * {
     *  "Content-Type": "application/json"
     * }
     * @apiParam {Integer} usuario_id   id del usuario asociado a la productora
     * @apiParamExample {json} Request-Example:
     * {
     *   'usuario_id'    : '1',
     * }
     * @apiSuccess (200) {Integer} id   Id Productora creada
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
     *     HTTP/1.1 404 ProductoraNotSave
     *     {
     *        "errors": "ProductoraNotSave"
     *     }
     */
    public function crearProductora(Request $request)
    {
        $usuario = Usuario::isAuthenticate();
        if ($usuario) {
            $data = $request->all();
            $validator = ValidacionesProductoras::crearProductoraValidacion($data);

            if ($validator->fails()) {
                return response()->json(['error' =>
                            $validator->messages()->first()], 404);
            }

            $productora = new Productora([
                'usuario_id' => $data['usuario_id'],
                'created_at' => \DB::raw('CURRENT_TIMESTAMP'),
                'updated_at' => \DB::raw('CURRENT_TIMESTAMP'),
            ]);

            if($productora->save())
            {
                $datosBancarios = new DatosBancarios([
                    'created_at' => \DB::raw('CURRENT_TIMESTAMP'),
                    'updated_at' => \DB::raw('CURRENT_TIMESTAMP'),
                ]);

                if ($datosBancarios->save()) {
                    $datosBancariosProductoras = new DatosBancariosProductoras([
                        'productora_id' => $productora->id,
                        'datosbancarios_id' => $datosBancarios->id,
                        'created_at' => \DB::raw('CURRENT_TIMESTAMP'),
                        'updated_at' => \DB::raw('CURRENT_TIMESTAMP'),
                    ]);
                }
                return response()->json(['id' => $productora->id], 200);
            }

            return response()->json(['errors' => $productora->getErrors()], 404);
        }

        return response()->json(['errors' => trans('generals.insufficient_role')], 404);
    }

    /**
     * @api {delete} /api/v1/productora/{productora_id} eliminar registro de Productora
     * @apiVersion 1.0.0
     * @apiName eliminarProductora
     * @apiGroup Productora
     * @apiHeader {String} Content-Type Tipo de contenido para el request enviado
     * @apiHeaderExample {json} Header-Example:
     * {
     *  "Content-Type": "application/json"
     * }
     * @apiParam {Integer} productora_id   id de la productora que se eliminara
     *
     * @apiSuccessExample Success-Response:
     *     HTTP/1.1 200 OK
     *     {
     *          "data": true
     *     }
     *
     * @apiError {json}  json   Retorna un json de estructura <code>{ "errors": false }</code>
     *
     * @apiErrorExample Error-Response:
     *     HTTP/1.1 404 ProductoraNotSave
     *     {
     *        "data":   false
     *     }
     */
    public function eliminarProductora(Request $request)
    {
        $usuario = Usuario::isAuthenticate();
        if ($usuario) {
            $request->merge(['productora_id' => $usuario->productora_activa]);
            $data = $request->all();
            $validator = ValidacionesProductoras::existsProductoraValidacion($data);
            if ($validator->fails()) {
                return response()->json(['data' => false, 'error' =>
                            $validator->messages()->first()], 404);
            }

            return (Productora::where('id', $data['productora_id'])->delete()) ?
                    response()->json(['data' => true], 200) :
                    response()->json(['data' => false], 404);
        }

        return response()->json(['errors' => trans('generals.insufficient_role')], 404);
    }

    public function mostrarAdministracionProductoras(Request $request)
    {
        $usuario = Usuario::isAuthenticate();
        if ($usuario) {
            $rolID = Rol::where('nombre', 'Productora')->first()['id'];
            $listado = RolUsuario::select('usuario_id')->where('rol_id', $rolID)->get()->toArray();
            $usuarios = Usuario::whereIn('id', $listado)->get();
            return response()->json(['data' => $usuarios], 200);
        }

        return response()->json(['errors' => trans('generals.insufficient_role')], 404);
    }

    public function mostrarProductora(Request $request)
    {
        $usuario = Usuario::isAuthenticate();
        if ($usuario) {
            $request->merge(['productora_id' => $usuario->productora_activa]);
            $data = $request->all();
            $validator = ValidacionesProductoras::existsProductoraValidacion($data);

            if ($validator->fails()) {
                return response()->json(['data' => false, 'error' =>
                            $validator->messages()->first()], 404);
            }

            return response()->json(['data' => Productora::where('id', $data['productora_id'])->first()], 200);
        }

        return response()->json(['errors' => trans('generals.insufficient_role')], 404);
    }

    public function mostrarProductoras()
    {
        return response()->json(['data' => Productora::get()], 200);
    }

    public function mostrarCompetenciasProductoras(Request $request)
    {
        $usuario = Usuario::isAuthenticate();
        if ($usuario) {
            $listado = Productora::get();
            $listado_competencias = [];
            foreach ($listado as $l) {
                $l['ventas'] = Competencia::where('productora_id', $l->id)->sum('cantidad_integrantes');
                $l['competencias'] = Competencia::where('productora_id', $l->id)->get();
                $listado_competencias[] = $l;
            }

            return response()->json(['data' => $listado_competencias], 200);
        }

        return response()->json(['errors' => trans('generals.insufficient_role')], 404);
    }

    /**
     * @api {put} /api/v1/v1/administradora/confirmar-datos Permite confirmar
     * los datos bancarios
     * @apiVersion 1.0.0 
     * @apiName ConfirmarDatosBancarios
     * @apiGroup Administradora
     * @apiHeader {String} Content-Type Tipo de contenido para el request enviado
     * @apiHeaderExample {json} Header-Example:
     * {
     *  "Content-Type": "application/json"
     * }
     * @apiParam {Array} usuarios                   Array de usuarios a confirmar

     * @apiParamExample {json} Request-Example:
     *    {
     *      "usuarios": {
     *          1, 2, 3
     *      },
     *    }
     * @apiSuccess (200) {Boolean} true Datos Confirmados.
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
     *     HTTP/1.1 404 Not Confirmed
     *     {
     *        "data": false
     *        "errors": "DatosNotConfirmed"
     *     }
     */
    public function validarDatosBancarios(Request $request)
    {
        $usuario = Usuario::isAuthenticate();
        if (!$usuario) {
            return response()->json(['errors' => trans('generals.insufficient_role')], 404);
        }
        $data = $request->all();
        $validator = ValidacionesAdministrador::validarDatosValidation($data);
        if ($validator->fails()) {
            return response()->json(['error' =>
                        $validator->messages()->first()], 404);
        }
        $datos_bancarios = DatosBancariosUsuario::whereIn('usuario_id', $data['usuarios'])->get();
        if (count($datos_bancarios) > 0) {
            $datosBancariosIds = array_map(function($item) {
                return $item['datosbancarios_id'];
            }, $datos_bancarios->toArray());
            $updateValida = DatosBancarios::whereIn('id', $datosBancariosIds)
                    ->update(['valida' => true]);
            return ($updateValida) ? response()->json(['data' => true], 200) :
                    response()->json(['data' => false, 'errors' => $datos_bancarios->getErrors()], 404);
        } else {
            return response()->json(['data' => false], 404);
        }
    }

    /**
     * @api {post} /api/v1/system/mailing Envio masivo de emails
     * @apiVersion 1.0.0
     * @apiName postMailing
     * @apiGroup Administrador
     * @apiHeader {String} Content-Type Tipo de contenido para el request enviado
     * @apiHeaderExample {json} Header-Example:
     * {
     *  "Content-Type": "application/json"
     * }
     * @apiParam {Array} email_destinatario     Destinatario
     * @apiParam {Boolean} ind_multiusuario     Indicador Multiusuario
     * @apiParam {String} asunto                Asunto del Email
     * @apiParam {String} mensaje               Mensaje del Email

     * @apiParamExample {json} Request-Example:
     * {
     *   "email_destinatario": ["productora@psp.com", ...] ,
     *   --------------------------------------------------
     *   "ind_multiusuario": true,
     *   --------------------------------------------------
     *   "asunto": "asunto",
     *   "mensaje": "mensaje"
     *  }
     * @apiSuccess {Boolean} true.
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
     *     HTTP/1.1 404 Not Sent
     *     {
     *        "errors": "MailNotSent"
     *     }
     */
    public function postMailing(Request $request)
    {
        $data = $request->all();
        $validator = ValidacionesAdministrador::enviarMailValidacion($data);
        if ($validator->fails()) {
            return response()->json(['data' => false, 'error' =>
                        $validator->messages()->first()], 404);
        }
        if (isset($data['ind_multiusuario']) && $data['ind_multiusuario'] === true) {
            $contactos = $this->buscarEmailUsuarios();
            $this->enviarEmail($data, $contactos, 'all');
        } else {
            $contactos = $data['email_destinatario'];
            $this->enviarEmail($data, $contactos, 'not_all');
        }
        return response()->json(['data' => true], 200);
    }

    public function buscarEmailUsuarios()
    {
        $usuarios = Usuario::all(['email', 'nombre', 'apellido'])->toArray();
        if (count($usuarios) > 0) {
            foreach ($usuarios as $usuario) {
                $contactos[$usuario['email']] = $usuario['nombre'] .
                        " " . $usuario['apellido'] . "( " . $usuario['email'] . " )";
            }
        }
        $array_contactos = (isset($contactos)) ? $contactos : [];

        return $array_contactos;
    }

    public function enviarEmail($data, $contactos, $modo)
    {
        foreach ($contactos as $correo => $contacto) {
            list($destinatario, $asunto, $nombreCorreo, $view) = [
                ($modo === 'all') ? $correo : $contacto, $data['asunto'],
                'Mensaje de Administrador PSP', 'emails.mailing'
            ];
            Mail::to($destinatario)->send(new Email($view, $asunto, $nombreCorreo, $data));
        }
        return;
    }

    public function modificarRoll(Request $request)
    {
        $data = $request->all();
        $validator = ValidacionesAdministrador::cambiarRoles($data);
        if ($validator->fails()) {
            return response()->json(['data' => false, 'error' =>
                        $validator->messages()->first()], 404);
        }

        $rol_user= RolUsuario::where('usuario_id', $data['usuario_id'])->where('rol_id',$data['rol_id'])->first();

        if (!is_null($rol_user) || !empty($rol_user)) {
            if ($rol_user->fecha()->delete()) {
                return ($rol_user->delete()) ?
                        response()->json(['data' => true], 200) :
                        response()->json(['data' => false], 404);
            } else {

                $rol_u = new RolUsuario();
                $rol_u->fill($data);
                return ($rol_u->save()) ? response()->json(['id' => $rol_u->id], 200) :
                        response()->json(['errors' => $rol_u->getErrors()], 404);
            }
        } else {
            $rolusuario = new RolUsuario(['usuario_id' => $data['usuario_id'], 'rol_id' => $data['rol_id']]);

            if($rolusuario->save())
            {
                return response()->json(['data' => true], 200);
            }
            return response()->json(['data' => false], 404);
        }
    }

}
