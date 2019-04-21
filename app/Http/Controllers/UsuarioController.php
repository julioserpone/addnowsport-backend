<?php

namespace App\Http\Controllers;

use App\Modelos\Categoria;
use App\Modelos\Competencia;
use App\Modelos\DatosBancarios;
use App\Modelos\DatosBancariosProductoras;
use App\Modelos\Distancia;
use App\Modelos\DistanciaCategoria;
use App\Modelos\Inscripto;
use App\Modelos\Productora;
use App\Modelos\RolUsuario;
use App\Modelos\Rol;
use App\Modelos\Perfil;
use App\Modelos\Usuario;
use JWTAuth;
use Illuminate\Http\Request;
use App\Validaciones\ValidacionesUsuarios;

class UsuarioController extends Controller
{

    /* --------------------------------------------------------------------------------------------------------
     * Metodos para autenticacion (ApiRest)
     * --------------------------------------------------------------------------------------------------------- */

    /**
     * Mostra los datos de un usuario especifico.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $usuario = Usuario::with('perfil', 'role')->where('id', $id)->first();
        return response()->json(['data' => $usuario], 200);
    }

    public function showAll(Request $request)
    {

        $usuarios = Usuario::with('perfil')->get();
        return response()->json(['data' => $usuarios], 200);
    }

    public function mostrarPerfil(Request $request)
    {
        $usuario = Usuario::isAuthenticate();
        if ($usuario) {
            $perfil = Perfil::where('usuario_id', $usuario->id)->first();
            $usuario['pais'] = $perfil['pais'];
            $usuario['provincia'] = $perfil['provincia'];
            $usuario['sexo'] = $perfil['genero'];
            return response()->json(['data' => $usuario], 200);
        }

        return response()->json(['errors' => trans('generals.insufficient_role')], 404);
    }

    public function showAllUsuarios()
    {
        return response()->json(['data' => Usuarios::get()], 200);
    }

    public function filtrar_usuarios_administracion(Request $request)
    {
        $data = $request->all();
        //Nombre, DNI o Email , Pais, Tipo, Acceso, Sexo
    }

    public function getAllPaisesUsuarios()
    {

        $paises = trans('pais');
        $paises_user = Perfil::select('pais')->distinct()->get();

        foreach ($paises_user as $pais) {
            $retorno[$pais->pais] = trans('pais.' . $pais->pais);
        }
        return response()->json(['data' => $retorno], 200);
    }

    public function getAllTipoUsuarios()
    {
        return response()->json(['data' => Rol::get()], 200);
    }

    public function getAllAccesoUsuarios()
    {
        return response()->json(['data' => Perfil::select('proveedor')->distinct()->get()], 200);
    }

    public function getPaises()
    {
        return response()->json(['data' => trans('pais')], 200);
    }
    
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
    
    public function cambiarClave(Request $request)
    {
        $usuario_autenticado = Usuario::isAuthenticate();
        if($usuario_autenticado)
        {
            $request->merge(['id' => $usuario_autenticado->id]);
            $data = $request->all();
            $validator = ValidacionesUsuarios::cambiarClaveValidacion($data);

            if ($validator->fails()) {
                return response()->json(['data' => false, 'error' =>
                            $validator->messages()->first()], 404);
            }

            $usuario = Usuario::whereId($data['id'])->first();
            if(hash(env('ENCRYPTION_ALGORITHM'), $data['clave']) != $usuario->password){
                return response()->json(['data' => false], 404);
            }

            if (!is_null($usuario) || !empty($usuario)) {
                $usuario->password = hash(env('ENCRYPTION_ALGORITHM'), $data['clave_nueva']);
                return ($usuario->save()) ? response()->json(['data' => true], 200) :
                        response()->json(['data' => false, 'errors' => $usuario->getErrors()], 404);
            } else {
                return response()->json(['data' => false], 404);
            }
        }
        return response()->json(['errors' => trans('generals.insufficient_role')], 404);
    }
    
    /**
     * @api {put} /api/v1/usuario/actualizar-datos Actualiza un 
     * registro de usuario
     * @apiVersion 1.0.0 
     * @apiName ActualizarUsuario
     * @apiGroup Usuario
     * @apiHeader {String} Content-Type Tipo de contenido para el request enviado
     * @apiHeaderExample {json} Header-Example:
     * {
     *  "Content-Type": "application/json"
     * }
     * 
     * @apiParam {String} nombre                Nombre Usuario
     * @apiParam {String} apellido              Apellido Usuario
     * @apiParam {String} email                 Email Usuario
     * @apiParam {String} fecha_nacimiento      Fecha de Nacimiento Usuario
     * @apiParam {String} username              Nickname Usuario
     * @apiParam {String} status                Email Usuario
     * @apiParam {String} nombre_contacto       Nombre de contacto
     * @apiParam {String} prefijo_contacto      Prefijo de contacto
     * @apiParam {String} telefono_contacto     Teléfono de contacto
     * @apiParam {String} derivacion_contacto   Derivación de contacto
     * 
     * @apiParamExample {json} Request-Example:
     * {
     *      "nombre": "Prueba",
     *      "apellido": "Prueba",
     *      "email": "prueba@hotmail.com",
     *      "fecha_nacimiento": "1991-12-09",
     *      "username": "pruebauser",
     *      "status": "inactivo",
     *      "nombre_contacto": "nombre",
     *      "prefijo_contacto": "prefijo",
     *      "telefono_contacto": "04241664997",
     *      "derivacion_contacto": "derviacion"
     * }
     * 
     * @apiSuccess (200) {Boolean} true Usuario Modificado.
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
     *        "errors": "UsuarioNotSave"
     *     }
     */
    
    public function actualizarDatos(Request $request)
    {
        $usuario_autenticado = Usuario::isAuthenticate();
        if($usuario_autenticado)
        {
            $request->merge(['id' => $usuario_autenticado->id]);
            $data = $request->all();
            $validator = ValidacionesUsuarios::actualizarDatosValidacion($data);
            if ($validator->fails()) {
                return response()->json(['data' => false, 'error' =>
                    $validator->messages()->first()], 404);
            }
            $usuario = Usuario::whereId($data['id'])->first();
            if (!is_null($usuario) || !empty($usuario)) {
                $usuario->fill($data);
                return ($usuario->save()) ? response()->json(['data' => true], 200) :
                    response()->json(['data' => false, 'errors' => $usuario->getErrors()], 404);
            } else {
                return response()->json(['data' => false], 404);
            }
        }
        return response()->json(['errors' => trans('generals.insufficient_role')], 404);
    }

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
                    $usuario->rol_activo = 'Productora';
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
                $usuario->rol_activo = 'Administrador';
                $usuario->save();
                return response()->json(['data' => true], 404);
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
                $usuario->rol_activo = 'Soporte';
                $usuario->save();
                return response()->json(['data' => true], 404);
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
            $usuario->rol_activo = 'Usuario';
            $usuario->save();
            return (response()->json(['data' => $usuario], 200));
        }
        return response()->json(['data' => false, 'errors' => trans('generals.insufficient_role')], 404);

    }

  /*  public function cambiarRolProductora(Request $request)
    {
        $usuario = Usuario::isAuthenticate();
        if ($usuario) {
            $request->merge(['usuario_id' => $usuario->id]);
            $request->merge(['productora_id' => $request->id]);
            $data = $request->all();
            $validator = ValidacionesUsuarios::existProductoraValidacion($data);

            if ($validator->fails()) {
                return response()->json(['data' => false, 'error' =>
                    $validator->messages()->first()], 404);
            }

            $productora = Productora::where('id', $data['productora_id'])->where('usuario_id', $usuario->id)->first();

            if(!is_null($productora) || !empty($productora))
            {
                $usuario->productora_activa = $data['productora_id'];
                $usuario->save();
                return (response()->json(['data' => $productora], 200));
            }

            return response()->json(['data' => false], 404);
        }
        return response()->json(['errors' => trans('generals.insufficient_role')], 404);
    }*/

    /**
     * @api {get} /api/v1/usuario/inscripciones/mis-competencias Permite obtener las competencias
     * de un usuario
     * @apiVersion 1.0.0
     * @apiName MisCompetencias
     * @apiGroup Usuario
     *
     * @apiSuccess (200) {json} Inscripciones de competencias de un usuario.
     *
     * @apiSuccessExample Success-Response:
     *     HTTP/1.1 200 OK
     * {
     *   "data": [
     *     ...
     *     {
     *       "id": 6,
     *       "productora_id": 9,
     *       "usuario_id": 6,
     *       "competencia_id": 17,
     *       "distancia_categoria_id": 1,
     *       "operacion_id": 7,
     *       "codigo_id": 12,
     *       "usuario_grupo_id": 1,
     *       "fecha": "2011-11-10 05:13:53",
     *       "nro_corredor": "24099",
     *       "tiempo": "13:12:44",
     *       "posicion": 7,
     *       "genero": "female",
     *       "edad": 11,
     *       "pais": "Ethiopia",
     *       "status": "pendiente",
     *       "deleted_at": null,
     *       "created_at": "1986-08-11 11:18:01",
     *       "updated_at": "2004-03-02 18:37:58"
     *     },
     *      ...
     *  ]
     * }
     *
     * @apiError {json}  json   Retorna un json de estructura <code>{ "errors": false }</code>
     *
     * @apiErrorExample Error-Response:
     *     HTTP/1.1 404 Not Found
     *     {
     *        "data": false
     *        "errors": "InscripcionNotFound"
     *     }
     */

    public function misInscripciones(Request $request)
    {
        $usuario_autenticado = Usuario::isAuthenticate();
        if($usuario_autenticado)
        {
            $request->merge(['usuario_id' => $usuario_autenticado->id]);
            $data = $request->all();
            $validator = ValidacionesUsuarios::misCompetenciasValidacion($data);

            if ($validator->fails()) {
                return response()->json(['data' => false, 'error' =>
                    $validator->messages()->first()], 404);
            }
            $incripciones = Inscripto::select('distancia_categoria_id','fecha','operacion_id','status')->whereUsuarioId($data['usuario_id'])->get();
            $lista = [];
            foreach($incripciones as $i)
            {
                $dc = DistanciaCategoria::where('id',$i->distancia_categoria_id)->first();
                $i['distancia'] = Distancia::where('id', $dc->distancia_id)->first()['nombre'];
                $i['categoria'] = Categoria::where('id', $dc->categoria_id)->first()['nombre'];
                $i['valor'] = Operacion::where('id', $i->operacion_id)->first()['monto'];
                $i['estado'] = $i['status'];
                $lista[] = $i;
            }
            if (!is_null($lista) || !empty($lista)) {
                return response()->json(['data' => $lista], 200);
            } else {
                return response()->json(['data' => false], 404);
            }
        }
        return response()->json(['errors' => trans('generals.insufficient_role')], 404);
    }

    public function misResultados(Request $request)
    {
        $usuario_autenticado = Usuario::isAuthenticate();
        if($usuario_autenticado)
        {
            $request->merge(['usuario_id' => $usuario_autenticado->id]);
            $data = $request->all();
            $validator = ValidacionesUsuarios::misCompetenciasValidacion($data);

            if ($validator->fails()) {
                return response()->json(['data' => false, 'error' =>
                    $validator->messages()->first()], 404);
            }
            $incripciones = Inscripto::whereUsuarioId($data['usuario_id'])->get();
            if (!is_null($incripciones) || !empty($incripciones)) {
                $listado = [];
                foreach($incripciones as $i)
                {
                    $dc = DistanciaCategoria::where('id', $i->distancia_categoria_id)->first();
                    $i['competencia'] = Competencia::where('id', $i->competencia_id)->first()['name'];
                    $i['distancia'] = Distancia::where('id', $dc->distancia_id)->first()['nombre'];
                    $i['categoria'] = Categoria::where('id', $dc->categoria_id)->first()['nombre'];
                    $i['puntos'] = 0;
                    $listado [] = $i;
                }
                return response()->json(['data' => $listado], 200);
            } else {
                return response()->json(['data' => false], 404);
            }

        }
        return response()->json(['errors' => trans('generals.insufficient_role')], 404);
    }

    public function misProductoras(Request $request)
    {
        $usuario = Usuario::isAuthenticate();
        if($usuario)
        {
            $request->merge(['id' => $usuario->id]);
            $data = $request->all();
            $validator = ValidacionesUsuarios::existUsuarioValidacion($data);

            if ($validator->fails()) {
                return response()->json(['data' => false, 'error' =>
                    $validator->messages()->first()], 404);
            }

            $productoras = Productora::select('id', 'nombre')->where('usuario_id',$data['id'])->get();
            if (!is_null($productoras) || !empty($productoras))
            {
                return response()->json(['data' => $productoras], 200);
            } else {
                return response()->json(['data' => false], 404);
            }

        }
        return response()->json(['errors' => trans('generals.insufficient_role')], 404);
    }

}
