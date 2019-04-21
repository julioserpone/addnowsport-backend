<?php

namespace App\Http\Controllers;

use App\Modelos\Perfil;
use App\Modelos\Usuario;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class SoporteController extends Controller {

    public function index()
    {
//        return view('dashboard.soporte.index');
        return view('layouts.admin.index');
    }

    public function perfil()
    {
        $usuario = Usuario::getLogged();
        $perfil = new Perfil();
        $perfil_usuario = $perfil->getModelById($usuario['id']);

        return view('dashboard.soporte.perfil.index', array('usuario' => $usuario, 'perfiles' => $perfil_usuario));
    }

    public function ActualizarPerfil(Request $request)
    {
        if($request->ajax())
        {
            $arr = array('response' => 'null');
            $usuario = Usuario::getLogged();

            $data = Input::all();
            $nombre = $data['nombre'];
            $apellido = $data['apellido'];
            $correo = $data['correo'];
            $dia = $data['dia'];
            $mes = $data['mes'];
            $year = $data['year'];
            $pais = $data['pais'];
            $prefijo = $data['prefijo'];
            $telefono = $data['telefono'];
            $provincia = $data['provincia'];
            $grupo =  $data['grupo'];
            $nombre_contacto =  $data['nombreContacto'];
            $prefijo_contacto =  $data['prefijoContacto'];
            $telefono_contacto =  $data['telefonoContacto'];
            $derivacion = $data['derivacion'];

            $usuario_new = new Usuario();
            $update = [
                'id' => $usuario['id'],
                'nombre' => $nombre,
                'apellido' => $apellido,
                'fecha_nacimiento' => Carbon::createFromDate($year, $mes, $dia),
                'correo' => $correo,
                'username', $usuario['username'],
                'pais' => $pais,
                'nombre_contacto' => $nombre_contacto,
                'prefijo_contacto' => $prefijo_contacto,
                'telefono_contacto' => $telefono_contacto,
                'derivacion_contacto' => $derivacion
            ];

            $perfil = new Perfil();
            $update_perfil = [];

            $arr = array('response' => 'null');
            if($usuario_new->update($update) && $perfil->update($update_perfil))
            {
                $arr = array($update);
                $arr['response'] = 'ok';
            }

            return json_encode($arr);
        }
    }

    public function changePassword()
    {
        return view('dashboard.soporte.changePassword.index');
    }

    public function misinscripciones()
    {
        return view('dashboard.soporte.misinscripciones.index');
    }


}
