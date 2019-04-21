<?php

namespace App\Validaciones;

use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;

class ValidacionesUsuarios
{

    public static function cambiarClaveValidacion($data)
    {
        $rules = [
            'clave' => 'required|min:8|max:15',
            'clave_nueva' => 'required|min:8|max:15',
            'clave_confirmation' => 'same:clave_nueva'
        ];
        return Validator::make($data, $rules);
    }

    public static function actualizarDatosValidacion($data)
    {
        $rules = [
            'id' => 'required|exists:usuarios,id,deleted_at,NULL',
            'nombre' => 'required|string|max:32|alpha',
            'apellido' => 'required|string|max:32|alpha',
            'email' => 'required|email|unique:usuarios,email,'.$data['id'],
            'fecha_nacimiento' => 'date|before:'. Carbon::now()->subYear(18)->toDateString(),
            'username' => 'string|unique:usuarios,username,'.$data['id'],
            'status' => 'required|string|in:activo,inactivo',
            'nombre_contacto' => 'string|max:255',
            'prefijo_contacto' => 'string|max:255',
            'telefono_contacto' => 'string|max:255',
            'derivacion_contacto' => 'required|string',
        ];
        return Validator::make($data, $rules);
    }

    public static function existUsuarioValidacion($data)
    {
        $rules = [
            'id' => 'required|exists:usuarios,id,deleted_at,NULL',
        ];
        return Validator::make($data, $rules);
    }

    public static function existProductoraValidacion($data)
    {
        $rules = [
            'usuario_id' => 'required|exists:usuarios,id,deleted_at,NULL',
            'productora_id' => 'required|exists:productoras,id,deleted_at,NULL',
        ];
        return Validator::make($data, $rules);
    }
    
    public static function misCompetenciasValidacion($data)
    {
        $rules = [
            'usuario_id' => 'required|exists:usuarios,id,deleted_at,NULL',
        ];
        return Validator::make($data, $rules);
    }
}
