<?php

namespace App\Http\Controllers;

use App\Modelos\DatosBancarios;
use App\Modelos\DatosBancariosProductoras;
use App\Modelos\Productora;
use App\Modelos\RolUsuario;
use App\Modelos\Rol;
use App\Modelos\Usuario;
use JWTAuth;
use Illuminate\Http\Request;
use App\Validaciones\ValidacionesUsuarios;

class GeneralController extends Controller
{

    /**
     * @api {put} /api/v1/usuario/cambiar-clave Permite cambiar la
     * clave de un usuario
     * @apiVersion 1.0.0 
     * @apiName CambiarClave
     * @apiGroup Usuario
     * @apiHeader {String} Content-Type Tipo de contenido para el request enviado
     * @apiHeaderExample {json} Header-Example:
     * {
     *  "Content-Type": "application/json"
     * }
     * @apiParam {String} clave_actual          Clave Actual
     * @apiParam {String} clave_nueva           Clave Nueva
     * @apiParam {String} confirmacion_clave    Confirmación Clave

     * @apiParamExample {json} Request-Example:
     *   {
     *       "clave_actual": "123456",
     *       "clave": "12345678",
     *       "clave_confirmation": "12345678",
     *   }
     * @apiSuccess (200) {Boolean} true Clave Modificada.
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
     *        "errors": "ClaveNotSave"
     *     }
     */

    public function cambiarRolProductora(Request $request)
    {
        $usuario = Usuario::isAuthenticate();
        if ($usuario) {
            $request->merge(['id' => $usuario->id]);
            $data = $request->all();
            $validator = ValidacionesUsuarios::existUsuarioValidacion($data);

            if ($validator->fails()) {
                return response()->json(['data' => false, 'error' =>
                    $validator->messages()->first()], 404);
            }

            $rol = Rol::where('nombre', 'Productora')->first();
            $roles = RolUsuario::where('usuario_id', $data['id'])->where('rol_id', $rol->id)->first();

            if(!is_null($roles) || !empty($roles))
            {
                $productora = Productora::where('usuario_id', $data['id'])->first();

                if(!is_null($productora) || !empty($productora))
                {
                    $usuario->productora_activa = $productora->id;
                    $usuario->rol_activo = 'productora';
                    $usuario->save();

                    $campos = $productora->importantes();
                    $datosBancariosProductora = DatosBancariosProductoras::select('datosbancarios_id')->where('productora_id', $productora->id)->get()->toArray();
                    $datosBancarios = DatosBancarios::whereIn('id', $datosBancariosProductora)->where('status', 'activo')->first();

                    if(!is_null($datosBancarios) || !empty($datosBancarios))
                    {
                        $campos+= $datosBancarios->importantes();
                    }

                    $total = (100 / 13);
                    return (response()->json(['data' => ['porcentaje' => ($campos * $total), 'productora' => $productora, 'datosBancarios' => $datosBancarios]], 200));
                }

                return response()->json(['data' => false, 'errors' => 'No tiene productora asignada'], 404);
            }

            return response()->json(['data' => false, 'errors' => 'Usted no tiene el permisos de Productora'], 404);
        }
        return response()->json(['errors' => trans('generals.insufficient_role')], 404);
    }

    public function cambiarRolAdministrador(Request $request)
    {
        $usuario = Usuario::isAuthenticate();
        if ($usuario) {
            $request->merge(['id' => $usuario->id]);
            $data = $request->all();
            $validator = ValidacionesUsuarios::existUsuarioValidacion($data);

            if ($validator->fails()) {
                return response()->json(['data' => false, 'error' =>
                    $validator->messages()->first()], 404);
            }

            $rol = Rol::where('nombre', 'Administrador Sistema')->first();
            $roles = RolUsuario::where('usuario_id', $data['id'])->where('rol_id', $rol->id)->first();

            if(!is_null($roles) || !empty($roles))
            {
                $usuario->rol_activo = 'administrador';
                $usuario->save();
                return response()->json(['data' => true], 200);
            }

            return response()->json(['data' => false, 'errors'=> 'Usted no tiene permiso de Administrador'], 404);
        }
        return response()->json(['errors' => trans('generals.insufficient_role')], 404);
    }

    public function cambiarRolSoporte(Request $request)
    {
        $usuario = Usuario::isAuthenticate();
        if ($usuario) {
            $request->merge(['id' => $usuario->id]);
            $data = $request->all();
            $validator = ValidacionesUsuarios::existUsuarioValidacion($data);

            if ($validator->fails()) {
                return response()->json(['data' => false, 'error' =>
                    $validator->messages()->first()], 404);
            }

            $rol = Rol::where('nombre', 'Soporte')->first();
            $roles = RolUsuario::where('usuario_id', $data['id'])->where('rol_id', $rol->id)->first();

            if(!is_null($roles) || !empty($roles))
            {
                $usuario->rol_activo = 'soporte';
                $usuario->save();
                return response()->json(['data' => true], 200);
            }

            return response()->json(['data' => false, 'errors'=> 'Usted no tiene permiso de Soporte'], 404);
        }
        return response()->json(['errors' => trans('generals.insufficient_role')], 404);
    }

    public function cambiarRolUsuario(Request $request)
    {
        $usuario = Usuario::isAuthenticate();
        if ($usuario) {
            $usuario->productora_activa = null;
            $usuario->rol_activo = 'usuario';
            $usuario->save();
            return (response()->json(['data' => $usuario], 200));
        }
        return response()->json(['data' => false, 'errors' => trans('generals.insufficient_role')], 404);

    }

    public function mostrarFechas()
    {
        return response()->json(['data' => Fecha::get()], 200);
    }

    public function mostrarPaises()
    {
        return response()->json(['data' => trans('pais')], 200);
    }

    public function mostrarProvincias()
    {
        return response()->json(['data' => trans('pais')], 200);
    }

}
