<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\ResetPassword;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */
    use ResetsPasswords;
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
     * @api {post} /password/reset     Reseteo de contraseña
     * @apiVersion 1.0.0
     * @apiName resetPassword
     * @apiDescription Proceso para realizar el reseteo de una contraseña
     * Este proceso es posterior a la solicitud de reseteo de contraseña. El usuario al solicitar el reseteo, recibe un email con un link. El sistema adjunta este link un token.
     * Para el procesamiento efectivo, se debe suministrar este token como un elemento de formulario tipo Hidden
     * 
     * @apiGroup Autenticacion
     * @apiHeader {String} Content-Type  Tipo de contenido para el request enviado
     * @apiHeaderExample {json} Header-Example:
     * {
     *  "Content-Type":  "application/json"
     * }
     * @apiParam {String} token                     Token enviado al usuario via email
     * @apiParam {String} email                     Correo del Usuario
     * @apiParam {String} password                  Contraseña
     * @apiParam {String} password_confirmation     Confirmacion de Contraseña
     * @apiParamExample {json} Request-Example:
     * {
     *   "token": "7cef60ef22fd2780e9c4d1d1c5c8df8c4a44e6f5bbc0ef152c4958f2d0e22f64",
     *   "email": "correo@dominio.com",
     *   "password": "123456789",
     *   "password_confirmation": "123456789"
     * }
     * @apiSuccess (200) {json}   message   Mensaje del sistema indicando la que el proceso se proceso sin problemas
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
     *     HTTP/1.1 404 Error
     *     {
     *        "error": ["descripcion del error"]
     *     }
     */
    public function reset(ResetPassword $request) {

        $credentials = $request->only('email', 'password', 'password_confirmation', 'token');
        
        $response = Password::reset($credentials, function($user, $password)
        {
            $user->password = hash(env('ENCRYPTION_ALGORITHM'), $password);
            $user->save();
        });

        switch ($response)
        {
            case Password::INVALID_PASSWORD:
            case Password::INVALID_TOKEN:
            case Password::INVALID_USER:
                return response()->json(['error' => trans($response)], 404);

            case Password::PASSWORD_RESET:
                return response()->json(['message' => 'OK'], 200);
        }
    }
}