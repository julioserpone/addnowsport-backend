<?php
namespace App\Http\Controllers\Auth;

use App\Modelos\Usuario;
use Auth;
use JWTAuth;
use Illuminate\Http\Response as HttpResponse;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */
    use AuthenticatesUsers;
    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';
    /**
    *   Rules Login
    **/
    private $rules = [
        'email' => 'required|email',
        'password' => 'required',
    ];
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => ['logout','reactivacionCuenta']]);
    }

    /**
     * Handle an authentication attempt.
     *
     * @return Response
     */
    public function login(Request $request)
    {
        $v = \Validator::make($request->all(), $this->rules);

        if ($v->fails()) {
            \Utility::setMessage(['message' => $v->errors()->all()]);
            return redirect()->back()->withInput($request->all());
        }

        $credentials = [
            'email' => $request->get('email'),
            'password' => $request->get('password')
        ];

        // Authentication passed...
        if (Usuario::attempt($credentials, $request->get('remember'))) {

            if(\Auth::user()->recordarme) {
                return redirect()->to(\Auth::user()->rol_activo);
            }
            
            if (\Auth::user()->hasRole('administrador')) {
                return redirect()->to('administrador');
            }

            elseif (\Auth::user()->hasRole('soporte')) {
                return redirect()->to('soporte');
            }

            if (\Auth::user()->hasRole('usuario')) {
                return redirect()->to('usuario');
            }

            return redirect()->intended('home');
        } 
        else
        {
            \Utility::setMessage(['message' => trans('auth.failed')]);
            return redirect()->back()->withInput($request->all());
        }
    }


    public function logout()
    {
        if (\Auth::user() && \Auth::user()->recordarme) {
            $usuario = Usuario::find(\Auth::user()->id);
            $usuario->where('id', $usuario->id)->update(['rol_activo' => session('rol_activo')]);
        }
        auth()->logout();
        return redirect()->to('login');
    }

    public function reactivacionCuenta() {

        if(!is_null(\Auth::user()->hash_activacion)) {
            $usuario = Usuario::find(\Auth::user()->id);
            $usuario->hash_activacion = hash(env('ENCRYPTION_ALGORITHM'), $usuario->correo);

            //Enviar email para activacion
            $usuario->sendMail(['process' => 'activacion']);
            \Utility::setMessage(['message' => trans('auth.account_reactivation')]);
        } else {
            \Utility::setMessage(['message' => trans('auth.account_active')]);
        }
        
        return redirect()->to($this->redirectTo);
    }

    /**
     * @api {post} /authenticate     Login
     * @apiVersion 1.0.0
     * @apiName authenticate
     * @apiDescription Realiza la autenticacion en el servidor. 
     * Si la peticion es procesada, devuelve un JSON con el token generado. Este token debe ser enviado para cada peticion que requiera de un usuario autenticado
     * 
     * @apiGroup Autenticacion
     * @apiHeader {String} Content-Type Tipo de contenido para el request enviado
     * @apiHeaderExample {json} Header-Example:
     * {
     *  "Content-Type": "application/json"
     * }
     * @apiParam {String} email         Correo del Usuario
     * @apiParam {String} password      Contraseña del usuario
     * @apiParam {Integer} [remember]   Valor del Checkbox para recordar al usuario
     * @apiParamExample {json} Request-Example:
     * {
     *   "email": "correo@dominio.com",
     *   "password": "123456789",
     *   "remember": 0
     * }
     * @apiSuccess (200) {Object}  usuario                      Informacion del usuario
     * @apiSuccess (200) {String}  usuario.token                Token generado por el sistema
     * @apiSuccess (200) {Object}  usuario.roles                Roles del usuario
     * @apiSuccess (200) {String}  usuario.roles.nombre         Nombre del Rol asociado al usuario
     * @apiSuccess (200) {String}  usuario.roles.permissions    Json con los permisos asociados al rol
     * @apiSuccess (200) {String}  usuario.roles.slug           Codigo del rol (utilizado para la gestion de roles)
     * @apiSuccess (200) {String}  usuario.rol_activo           Ultimo rol utilizado por el usuario (Este valor cambia solo si el campo <code>recordarme</code> esta en <code>true</code>)
     *
     * @apiSuccessExample Success-Response:
     *     HTTP/1.1 200 OK
     *     {
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
     *           "recordarme": 0
     *        }
     *     }
     *
     * @apiError {Boolean}  value   Retorna <code>false</code> si las credenciales suministradas no son válidas
     *
     * @apiErrorExample {json} Error-Response:
     *     HTTP/1.1 404 TokenNoTCreate
     *     {
     *        "errors": "could_not_create_token"
     *     }
     */
    public function authenticate(Request $request) {

        try {
            $credentials = [
                'email' => $request->get('email'),
                'password' => $request->get('password'),
                'remember' => $request->get('remember'),
            ];
            //Se mantiene la autenticacion con hash personalizado
            if (!$usuario = Usuario::autenticar($credentials)) {
               return \Response::json(false, HttpResponse::HTTP_UNAUTHORIZED);
            }
            //Este token se deben almacenar en el frontend y se debe enviar entre peticiones cliente-servidor
            //de esta manera, podemos validar si la peticion es de un usuario autenticado
            return \Response::json(compact('usuario'));
        } catch (JWTException $e) {
            //Ocurrio algun error al generar el token
            return response()->json(['errors' => 'could_not_create_token'], 404);
        }
    }

    /**
     * @api {get} /finish     Logout
     * @apiVersion 1.0.0
     * @apiName finish
     * @apiDescription Invalida el token, y el usuario no podra volver a utilizarlo. 
     * Se debera ejecutar nuevamente el proceso de login
     * 
     * @apiGroup Autenticacion
     * @apiHeader {String} Content-Type Tipo de contenido para el request enviado
     * @apiHeaderExample {json} Header-Example:
     * {
     *  "Content-Type": "application/json"
     * }
     * @apiParam {String} token         Token generado por el sistema al momento de la autenticacion
     * @apiParamExample {json} Request-Example:
     * {
     *   "token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOjEsImlzcyI6Imh0dHA6XC9cL3BzcC5hcHBcL2FwaVwvdjFcL2F1dGhlbnRpY2F0ZSIsImlhdCI6MTQ3NjkwMzEyMSwiZXhwI"
     * }
     * @apiSuccess (200) {json}   message   Mensaje del sistema indicando la finalizacion de la sesion del usuario en el servidor
     *
     * @apiSuccessExample Success-Response:
     *     HTTP/1.1 200 OK
     *     {
     *       "message": "OK"
     *     }
     *
     * @apiError {json}  json   Retorna un json de estructura <code>{ "errors": "mensaje" }</code> 
     *
     * @apiErrorExample {json} Error-Response:
     *     HTTP/1.1 404 TokenExpired
     *     {
     *        "errors": "Token is invalid"
     *     }
     */
    public function finish(Request $request) {

        try {
            $this->validate($request, [
                'token' => 'required' 
            ]);

            JWTAuth::invalidate($request->input('token'));

        } catch (JWTException $e) {
            //Se dispara una exception. La respuesta esta renderizada en /app/Exceptions/Handler.php (metodo render)
            return response()->json(['errors' => 'token_invalid'], 404);
        }

        return response()->json(['message' => 'OK'], 200);
    }
}