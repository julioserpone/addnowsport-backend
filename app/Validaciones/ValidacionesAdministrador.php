<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Validaciones;

use Illuminate\Support\Facades\Validator;

/**
 * Description of ValidacionesAdministrador
 *
 * @author Reysmer Valle
 */
class ValidacionesAdministrador
{

    /**
     * @param $data
     * @return mixed
     */
    public static function enviarMailValidacion($data)
    {
        $rules = [
            'email_destinatario' => 'required_without:ind_multiusuario|array',
            'ind_multiusuario' => 'required_without:email_destinatario|boolean',
            'asunto' => 'required|string|max:255',
            'mensaje' => 'required|string|max:4294967295'
        ];
        $messages = [];
        foreach ($data['email_destinatario'] as $key => $val) {
            $index = (int) $key;
            $messages['email_destinatario.' . $key . '.exists'] = 'El correo  ' . ($index + 1) . ' no es válido';
            $rules['email_destinatario.' . $key] = 'required|email|exists:usuarios,email,deleted_at,NULL';
        }
        $validator = \Validator::make($data, $rules, $messages);
        return $validator;
    }

    public static function cambiarRoles($data)
    {

        $rules = [
            'usuario_id' => 'integer|exists:usuarios,id,deleted_at,NULL',
            'rol_id' => 'integer|exists:roles,id,deleted_at,NULL'
        ];
        $validator = \Validator::make($data, $rules);
        return $validator;
    }

    public static function validarDatosValidation($data)
    {
        $rules = [
            'usuarios' => 'required|array',
        ];
        $messages = [];
        foreach ($data['usuarios'] as $key => $val) {
            $index = (int) $key;
            $messages['usuarios.' . $key . '.exists'] = 'El usuario  ' . ($index + 1) . ' no es válido';
            $rules['usuarios.' . $key] = 'required|integer|exists:usuarios,id,deleted_at,NULL';
        } 
        $validator = \Validator::make($data, $rules);
        return $validator;
    }

}
