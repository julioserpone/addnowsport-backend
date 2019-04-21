<?php
namespace App\Http\Controllers\Auth;
use App\Modelos\Imagen;
use JWTAuth;
use App\Modelos\Usuario;
use App\Modelos\Perfil;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use App\Http\Requests\RegistrarUsuarioRequest;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */
    use RegistersUsers;
    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/';
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * @api {post} /register     Registro
     * @apiVersion 1.0.0
     * @apiName register
     * @apiDescription Ejecuta el registro del usuario. Este proceso tambien notifica por email al usuario para que sea activada la cuenta.
     * Si la peticion es procesada, devuelve un JSON con un mensaje y con la data del usuario registrado. Adicionalmente, en este mismo proceso se realiza la primera asociacion 
     * del perfil del usuario; el cual, por defecto es un perfil tipo USUARIO
     * 
     * @apiGroup Autenticacion
     * @apiHeader {String} Content-Type Tipo de contenido para el request enviado
     * @apiHeaderExample {json} Header-Example:
     * {
     *  "Content-Type": "application/json"
     * }
     * @apiParam {String} nombre                    Nombre del Usuario
     * @apiParam {String} apellido                  Apellido del usuario
     * @apiParam {String} [fecha_nacimiento]        Fecha de Nacimiento del Usuario (La fecha es parseada a Date en formato yyyy-mm-dd). Se debe enviar en formato mm/dd/yyyy
     * @apiParam {String} correo                    Correo electronico del Usuario
     * @apiParam {String} correo_confirmation       Confirmacion del Correo electronico del Usuario
     * @apiParam {String} clave                     Contraseña del Usuario
     * @apiParam {String} clave_confirmation        Confirmacion de la Contraseña del Usuario
     * @apiParamExample {json} Request-Example:
     * {
     *   "nombre": "NOMBRE",
     *   "apellido": "APELLIDO",
     *   "correo": "cuenta@correo.com",
     *   "correo_confirmation": "cuenta@correo.com",
     *   "clave": "12345678",
     *   "clave_confirmation": "12345678",
     *   "fecha_nacimiento" : "12/31/1980"
     * }
     * @apiSuccess (200) {String}   message                                     Resultado de la Operacion
     * @apiSuccess (200) {Object}   usuario                                     Data del Usuario registrado
     * @apiSuccess (200) {Integer}  usuario.id                                  ID del Usuario
     * @apiSuccess (200) {String}   usuario.nombre                              Nombres del Usuario
     * @apiSuccess (200) {String}   usuario.apellido                            Apellidos del Usuario
     * @apiSuccess (200) {String}   usuario.email                               Email del Usuario
     * @apiSuccess (200) {String}   usuario.password                            Contraseña del usuario (encriptada)
     * @apiSuccess (200) {String}   usuario.fecha_nacimiento                    Fecha de Nacimiento en formato yyyy-mm-dd
     * @apiSuccess (200) {String}   usuario.username                            UserName del Usuario
     * @apiSuccess (200) {Integer}  usuario.productora_activa                   Codigo de la Productora Activa
     * @apiSuccess (200) {String}   usuario.rol_activo                          Rol Activo (este valor solo cambia si el usuario asigna en <code>true</code> el atributo <code>recordarme</code>)
     * @apiSuccess (200) {Integer}  usuario.recordarme                          Atributo para indicar que se debe almacenar el ultimo rol utilizado. El rol del usuario es tomado de la ruta de acceso a la API; es decir, si ingreso a api/v1/administrador/codigos, el ultimo rol sera <code>Administrador</code>
     * @apiSuccess (200) {String}   usuario.avatar                              Ruta de la Imagen para el avatar del usuario
     * @apiSuccess (200) {Integer}  usuario.social                              Indica si el usuario fue creado mediante autenticacion de red social
     * @apiSuccess (200) {String}   usuario.status                              Status (Activo o Inactivo)
     * @apiSuccess (200) {Integer}  usuario.activado                            Identifica al usuario como activado. Este valor cambia cuando el usuario valida la direccion de correo suministrada mediante un link de activacion enviado a su email.
     * @apiSuccess (200) {String}   usuario.nombre_contacto                     Nombre de Contacto
     * @apiSuccess (200) {String}   usuario.prefijo_contacto                    Prefijo del Contacto (Sr, Sra, etc)
     * @apiSuccess (200) {String}   usuario.telefono_contacto                   Telefono del Contacto
     * @apiSuccess (200) {String}   usuario.derivacion_contacto                 Referencia del Contacto
     * @apiSuccess (200) {String}   usuario.hash_activacion                     Hash de activacion enviado al email suministrado en el registro. Este valor pasa a <code>null</code> cuando el usuario activa la cuenta
     * @apiSuccess (200) {Date}     usuario.deleted_at                          Fecha de eliminacion logica (softdelete)
     * @apiSuccess (200) {Date}     usuario.created_at                          Fecha de Registro
     * @apiSuccess (200) {Date}     usuario.updated_at                          Ultima Fecha de Actualizacion de datos del Usuario
     * @apiSuccess (200) {Object}   usuario.perfil                              Perfil registrado y asociado al Usuario
     * @apiSuccess (200) {Integer}  usuario.perfil.usuario_id                   ID del Usuario al cual se le asocia el perfil
     * @apiSuccess (200) {String}   usuario.perfil.proveedor                    Proveedor (psp, facebook, google+, instagram, etc)
     * @apiSuccess (200) {String}   usuario.perfil.usuario_social_id            Identificador del usuario en la red social
     * @apiSuccess (200) {Json}     usuario.perfil.usuario_social_attributes    Objeto Json con los valores suministrador por la red social al momento de la autenticacion
     * @apiSuccess (200) {String}   usuario.perfil.identificacion               Identificador del Usuario
     * @apiSuccess (200) {String}   usuario.perfil.foto                         Ruta de la Fotografia del Usuario (suministrada por la red social)
     * @apiSuccess (200) {String}   usuario.perfil.foto_original                Ruta de la Fotografia del Usuario
     * @apiSuccess (200) {String}   usuario.perfil.genero                       Genero (masculino, femenino)
     * @apiSuccess (200) {String}   usuario.perfil.prefijo                      Prefijo Telefonico
     * @apiSuccess (200) {String}   usuario.perfil.telefono                     Telefono
     * @apiSuccess (200) {String}   usuario.perfil.pais                         Pais
     * @apiSuccess (200) {String}   usuario.perfil.provincia                    Provincia
     * @apiSuccess (200) {String}   usuario.perfil.ciudad                       Ciudad
     * @apiSuccess (200) {String}   usuario.perfil.grupo                        Grupo
     * @apiSuccess (200) {String}   usuario.perfil.profesion                    Profesion
     * @apiSuccess (200) {String}   usuario.perfil.descripcion                  Descripcion
     *
     * @apiSuccessExample Success-Response:
     *     HTTP/1.1 200 OK
     *     {
     *         "message": "OK",
     *         "usuario": {
     *             "id": 5,
     *             "nombre": "NOMBRE",
     *             "apellido": "APELLIDO",
     *             "email": "cuenta@correo.com",
     *             "password": "$2y$10$kRdXInI/iJGOZANl3L9GRumqfRojFKVNjvMOR7if7NYIiSyS7gxA.",
     *             "fecha_nacimiento": "1980-12-31",
     *             "username": null,
     *             "last_login": null,
     *             "usuario": 1,
     *             "productora_activa": "0",
     *             "rol_activo": "usuario",
     *             "recordarme": 0,
     *             "avatar": null,
     *             "avatar_original": null,
     *             "social": 0,
     *             "status": "activo",
     *             "activado": 0,
     *             "nombre_contacto": null,
     *             "prefijo_contacto": null,
     *             "telefono_contacto": null,
     *             "derivacion_contacto": null,
     *             "hash_activacion": "ffcc3171108863b41a0f8e1e8487bbe3365c7704",
     *             "deleted_at": null,
     *             "created_at": "2016-10-19 18:50:15",
     *             "updated_at": "2016-10-19 18:50:15",
     *             "perfil": [
     *                 {
     *                     "usuario_id": 5,
     *                     "proveedor": "psp",
     *                     "usuario_social_id": null,
     *                     "usuario_social_attributes": null,
     *                     "identificacion": null,
     *                     "foto": "unknown-person.jpg",
     *                     "foto_original": "unknown-person.jpg",
     *                     "genero": "female",
     *                     "prefijo": null,
     *                     "telefono": null,
     *                     "pais": null,
     *                     "provincia": null,
     *                     "ciudad": null,
     *                     "grupo": null,
     *                     "profesion": null,
     *                     "descripcion": null
     *                 }
     *             ]
     *         }
     *     }
     *
     * @apiError {json}  json   Retorna un json de estructura <code>{ "errors": "mensaje" }</code> 
     *
     * @apiErrorExample {json} Error-Response:
     *     HTTP/1.1 404 Errors
     *     {
     *        "errors": ["Listado de Errores"]
     *     }
     */
    public function register(Request $request) {

        //Para poder utilizar las validaciones mediante api, es necesario no utilizar la clase RegistrarUsuarioRequest. Motivo: Esta clase automaticamente redirecciona en caso de error de validacion de tipos, y ademas utiliza un session flash para gestionar el error. Por ello se utiliza el modo manual para la validacion.
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|string|max:100',
            'apellido' => 'required|string|max:100',
            'fecha_nacimiento' => 'date',
            'correo' => 'required|email|unique:usuarios,email|confirmed',
            'correo_confirmation' => 'required_with:correo|email',
            'clave' => 'required|min:8|confirmed',
            'clave_confirmation' => 'required_with:clave|min:8',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()], 404);
        }

        $usuario = Usuario::where('email',$request->get('correo'))->first();
        
        if (!$usuario) {
            $imagen = Imagen::select('imagen')->whereId(1)->first();
            $data = [
                "usuario" => [
                    'nombre' => strtoupper($request->get('nombre')),
                    'apellido' => strtoupper($request->get('apellido')),
                    'email' => $request->get('correo'),
                    'password' => hash(env('ENCRYPTION_ALGORITHM'), $request->get('clave')),
                    'fecha_nacimiento' => Carbon::parse($request->get('fecha_nacimiento'))->toDateString(),
                    'hash_activacion' => hash(env('ENCRYPTION_ALGORITHM'), $request->get('correo')),
                ],
                'proveedor' => 'psp',
                'foto' => $imagen,
                'foto_original' => $imagen,
            ];
            $perfil = Perfil::create($data);
            $usuario = Usuario::with('perfil')->find($perfil->usuario_id);

            //Enviar email para activacion
            $usuario->sendMail(['process' => 'activacion']);

            return response()->json(['message' => 'OK', 'usuario' => $usuario], 201);

        } else {

            return response()->json(['error' => trans('auth.user_exist')], 404);
        }

    }

    /**
     * @api {get} /activate/{id}/{hash}     Activacion
     * @apiVersion 1.0.0
     * @apiName activarUsuario
     * @apiDescription Realiza la activacion del usuario. Este proceso no genera un email notificando la activa.
     * Si la peticion es procesada, devuelve un JSON con un mensaje y con la data del usuario registrado. Adicionalmente, en este mismo proceso se realiza la primera asociacion 
     * del perfil del usuario; el cual, por defecto es un perfil tipo USUARIO
     * 
     * @apiGroup Autenticacion
     * @apiParam {String} id                    ID del Usuario
     * @apiParam {String} hash                  HASH generado al momento del registro. Este se envia junto al email de activacion y es necesario para activar la cuenta
     * @apiParamExample {Request} Request-Example:
     * http://psp.app/api/v1/activate/1/ffcc3171108863b41a0f8e1e8487bbe3365c7704
     * 
     * @apiSuccess (200) {String}  message                      Resultado de la Operacion
     * @apiSuccess (200) {Object}  usuario                      Informacion del usuario
     * @apiSuccess (200) {String}  usuario.token                Token generado por el sistema
     * @apiSuccess (200) {Object}  usuario.roles                Roles del usuario
     * @apiSuccess (200) {String}  usuario.roles.nombre         Nombre del Rol asociado al usuario
     * @apiSuccess (200) {String}  usuario.roles.permissions    Json con los permisos asociados al rol
     * @apiSuccess (200) {String}  usuario.roles.slug           Codigo del rol (utilizado para la gestion de roles)
     * @apiSuccess (200) {String}  usuario.rol_activo           Ultimo rol utilizado por el usuario (Este valor cambia solo si el campo <code>recordarme</code> esta en <code>true</code>)
     * @apiSuccess (200) {String}  usuario.recordarme           Indica si se debe guardar el ultimo rol utilizado
     * @apiSuccess (200) {String}  usuario.code                 Codigo devuelto por la peticion (200 = Ok, 404 = Error)
     *
     * @apiSuccessExample Success-Response:
     *     HTTP/1.1 200 OK
     *     {
     *       "message": "Bienvenido Sr(a) :usuario",
     *       "usuario": {
     *           "token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOjEsImlzcyI6Imh0dHA6XC9cL3BzcC5hcHBcL2FwaVwvdjFcL2F1dGhlbnRpY2F0ZSIsImlhdCI6MTQ3NjkwMzEyMSwiZXhwI",
     *           "roles": [
     *               {
     *                   "nombre": "Administrador",
     *                   "permissions": "{\"superusuario\":true, \"ver.opciones.administrador\":true, \"ver.datos_personales\":true,\"ver.cambiar_contrase\\u00f1a\":true}", 
     *                   "slug": "administrador",
     *                   "pivot": {
     *                       "usuario_id": 1,
     *                       "rol_id": 1
     *                   }
     *               }
     *           ],
     *           "rol_activo": "usuario",
     *           "recordarme": 0,
     *           "code": 200
     *        }
     *     }
     *
     * @apiError {json}  json   Retorna un json de estructura <code>{ "errors": "mensaje" }</code> 
     *
     * @apiErrorExample {json} Error-Response:
     *     HTTP/1.1 404 Errors
     *     {
     *        "errors": ["Listado de Errores"]
     *     }
     */
    public function activarUsuario(Request $request, $id, $hash) {
        
        $usuario = Usuario::find($id);
        $autenticar = false;
        $response = [];
        if ($usuario) {
            //Si no tiene hash y esta activo, lo autentico
            if ((is_null($usuario->hash_activacion) || empty($usuario->hash_activacion)) && ($usuario->status == 'activo')) {
                $autenticar = true;
            } else {
                if ($usuario->hash_activacion == $hash) {
                    $usuario->status = 'activo';
                    $usuario->activado = 1;
                    $usuario->hash_activacion = null;
                    $usuario->save();
                    $autenticar = true;
                } else {
                    $response = ['message' => trans('auth.code_verification_wrong'), 'code' => 404];
                }
            }
        } else {
            $response = ['message' => trans('auth.usernotfound'), 'code' => 404];
        }

        if ($autenticar) {
            $token = JWTAuth::fromUser($usuario);
            $response = [
                'message' =>  trans('generals.welcome', ['usuario' => $usuario->nombre]),
                'token' => $token, 
                'roles' => $usuario->roles, 
                'rol_activo' => $usuario->rol_activo, 
                'recordarme' => $usuario->recordarme,
                'code' => 200
            ];
        }

        return response()->json($response, $response['code']);
    }
}