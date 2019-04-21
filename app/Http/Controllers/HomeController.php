<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\ChangePasswordRequest;
use App\Modelos\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class HomeController extends Controller {

    public function index()
    {
        return view('home.home');
    }

    public function changePassword(Request $request)
    {
        if($request->ajax() && $request->isMethod('POST'))
        {
            $arr = array('response' => 'null');

            $usuario = Usuario::getLogged();
            $data = Input::all();

            $oldPassword = $data['oldPassword'];
            $newPassword = $data['newPassword'];
            $samePassword = $data['samePassword'];
            $hash = hash(env('ENCRYPTION_ALGORITHM'), $oldPassword);

            if(sizeof($newPassword) < 6 && $newPassword != $samePassword)
            {
                $arr['response'] = 'error_password';
            }

            elseif($usuario->password != $hash)
            {
                $arr['response'] = 'error_password_no_macth';
            }

            elseif($usuario->password == $hash)
            {
                $usuario->password = hash(env('ENCRYPTION_ALGORITHM'), $newPassword);
                $usuario->save();
                $arr['response'] = 'ok';
            }

            return json_encode($arr);
        }

        return redirect()->back();
    }

}
