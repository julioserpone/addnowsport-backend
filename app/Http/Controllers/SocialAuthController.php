<?php

namespace App\Http\Controllers;

use App\Modelos\Usuario;
use App\Modelos\Perfil;
use Auth;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Auth\RegisterController;
use Laravel\Socialite\Facades\Socialite;

class SocialAuthController extends Controller {

    public function __construct() {
        $this->middleware('guest');
    }

    public function getSocialAuth($provider = null) {
        if (!config("services.$provider")) {
            \Utility::setMessage(['message' => 'Proveedor no identificado']);
            return back();
        }
        return Socialite::driver($provider)->redirect();
    }

    //Metodo que recibe los parametros enviados por la app externa (utilizado para redes sociales)
    public function getSocialAuthCallback($provider = null) {

        if ($provider) {

            $user = Socialite::driver($provider)->user();
            if (!empty($user) && !is_null($user) && !is_null($user->email)) {
                $this->autenticacionUsuarioSocial($user, $provider);
            } else {
                \Utility::setMessage(['message' => 'Objeto usuario no encontrado']);
            }
        } else {
            \Utility::setMessage(['message' => 'Proveedor no encontrado']);
        }

        return redirect()->to('/');
    }

    public function autenticacionUsuarioSocial($data, $provider) {

        //Verificar que no este registrado. Si lo esta, auto-autenticar y registrarle el perfil. Sino, registro y autentico. Posteriormente, redireccionamiento a home
        $usuario = Usuario::with('perfil')->where('email', $data->email)->first();

        if ($usuario) {
            //Si esta registrado como usuario, pero no tiene el perfil del provider, le registramos el perfil para dicho provider
            if (!$usuario->perfil->where('proveedor', $provider)->first()) {
                $usuario->registrarPerfilSocial($data, $provider, false)->first();
            }
        } else {
            //Al no existir el usuario, se creara un perfil PSP por defecto (esto ocurre dentro del modelo Perfil)
            $model = new Usuario();
            $usuario = $model->registrarPerfilSocial($data, $provider, true)->first();
            //Enviar email para activacion de cuenta (registro de usuario)
            $usuario->sendMail(['process' => 'activacion']);
        }
        
        Auth::loginUsingId($usuario->id);
        \Utility::setMessage([
            "message" => trans('generals.welcome', ['usuario' => $usuario->nombre]),
            "messageTimeShow" => 5000,
        ], 'success');
    }

}
