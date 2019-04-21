<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Modelos\Mensaje;
use App\Http\Controllers\Controller;
use App\Modelos\Usuario;
use Illuminate\Support\Facades\Validator;

class ChatController extends Controller
{

    public function __construct()
    {
//        $this->middleware('auth', ['only' => ['sendMessage']]);
    }

    public function sendMessage(Request $request)
    {
        $model = new Mensaje();
        $model->fill($request->all());
        $validator = Validator::make($request->all(), $model['rules']);
        if (!$validator->fails()) {
            if ($model->save()) {
                $data = ['model' => $model->toArray(),
                    'mensaje' => 'Se guardó el mensaje correctamente'];
                return ($request->ajax()) ? response()->json($data) :
                        back()->with([$data]);
            } else {
                return ($request->ajax()) ? response()->json(
                                ['errores' => $model->getErrors()]) :
                        back()->with(['errores' => $model->getErrors()]);
            }
        } else {
            return back()->with(['error' => $validator->messages()->first()]);
        }
    }

    public function getChat()
    {
        $usuario = Usuario::getLogged();
        $rol = $usuario->getRolesAttribute()->first()->slug;
        return view('chat.index', ['usuario' => $usuario, 'rol' => $rol]);
    }

}
