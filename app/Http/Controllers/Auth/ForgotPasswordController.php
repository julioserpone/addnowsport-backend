<?php
namespace App\Http\Controllers\Auth;

use App\Modelos\Usuario;
use App\Http\Controllers\Controller;
use App\Http\Requests\SendEmailResetPassword;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
use Illuminate\Auth\Passwords\PasswordBroker;
use Illuminate\Contracts\Auth\Guard;
use Faker\Factory as Faker;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */
    use SendsPasswordResetEmails;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Guard $auth, PasswordBroker $passwords)
    {
        //Las dos primeras asignaciones son obligatorias para poder hacer uso del Facade SendsPasswordResetEmails. Esto se implementa para hacer uso de Notifications Class
        $this->auth = $auth;
        $this->passwords = $passwords;
        $this->subject = 'Your Password Reset Link';
        $this->middleware('guest');
    }

    /**
     * @api {post} /password/email     Solicitud de Reseteo de contraseña
     * @apiVersion 1.0.0
     * @apiName sendEmailResetPassword
     * @apiDescription Proceso para solicitar el reseteo de una contraseña.
     * Al indicar el email, el sistema envia un email al solicitante del reseteo, siempre y cuando sea un usuario registrado. En este email, se adjunto un link para finalizar el proceso de reseteo. El paso posterior a este proceso esta indicado en el apendice RESETEO DE CONTRASEÑA, previsto en esta documentacion
     * 
     * @apiGroup Autenticacion
     * @apiHeader {String} Content-Type  Tipo de contenido para el request enviado
     * @apiHeaderExample {json} Header-Example:
     * {
     *  "Content-Type":  "application/json"
     * }
     * @apiParam {String} email                     Correo del Usuario
     * @apiParamExample {json} Request-Example:
     * {
     *   "email": "correo@dominio.com",
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
    public function sendResetLinkEmail(SendEmailResetPassword $request) {

        //$this->validate($request, ['email' => 'required']);

        $usuario = Usuario::select(['id', 'nombre', 'apellido', 'email'])->where('email', $request->get('email'))->first();

        if ($usuario) {

            $faker = Faker::create();
            $password = strtolower(str_replace(' ', '', $faker->text(20)));
            $usuario->where('id', $usuario->id)->update(['password' => \Hash::make($password)]);

            //Al enviar el objeto Usuario, el metodo sendResetLink verifica que este modelo tenga implementado Notifiable. De estarlo, invoco una sobrecarga del metodo sendPasswordResetNotification, el cual en vez de utilizar la interfaz de Iluminate, hara uso de una clase con extends Notification. Esto me permitira modificar data de la vista del email en la clase y simultaneamente hacer el envio del email
            $response = $this->passwords->sendResetLink($usuario->toArray());

            switch ($response) {
                case PasswordBroker::RESET_LINK_SENT:
                    return response()->json(['errors' => trans('auth.forgotpass_email')], 404);
                    //\Utility::setMessageSuccess(['message' => trans('auth.forgotpass_email')]);
                    break;
                case PasswordBroker::INVALID_USER:
                    return response()->json(['errors' => trans('auth.usernotfound')], 404);
                    //\Utility::setMessage(['message' => trans('auth.usernotfound')]); 
                    break;
            }
        } else {
            //\Utility::setMessage(['message' => trans('auth.usernotfound')]);            
            return response()->json(['errors' => trans('auth.usernotfound')], 404);
        }

        //return redirect()->back();
        return response()->json(['message' => 'OK'], 200);
    }

}