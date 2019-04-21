<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Validaciones;

use Illuminate\Support\Facades\Validator;
/**
 * Description of ValidacionesTransaferencias
 *
 * @author Reysmer Valle
 */
class ValidacionesTransaferencias
{

    public static function eliminarTransferenciaValidacion($data)
    {
        $rules = [
            'transferencia_id' => 'required|integer|exists:transferencias,id,deleted_at,NULL',
        ];
        $validator = Validator::make($data, $rules);
        return $validator;
    }

    public static function actualizarTransferenciaValidacion($data)
    {
        $rules = [
            'transferencia_id' => 'required|integer|exists:transferencias,id,deleted_at,NULL',
            'productora_id' => 'integer|exists:productoras,id,deleted_at,NULL',
            'fecha_solventada' => 'date|after:fecha_solicitud',
            'codigo' => 'string|unique:transferencias,codigo',
            'monto' => 'numeric',
            'estado' => 'string|in:exitosa,problemas',
            'rc' => 'string|in:a1,a2,a3,b1,b2,b3,c1,c2,c3',
            'recibo' => 'file|mimes:jpg,png,jpeg,pdf|max:2048'
        ];
        $validator = Validator::make($data, $rules);
        return $validator;
    }

    public static function mostrarTransferenciaValidacion($data)
    {
        $rules = [
            'transferencia_id' => 'required|integer|exists:transferencias,id,deleted_at,NULL',
        ];
        $validator = Validator::make($data, $rules);
        return $validator;
    }

    public static function crearTransferenciaValidacion($data)
    {
        $rules = [
            'productora_id' => 'required|integer|exists:productoras,id,deleted_at,NULL',
            'fecha_solicitud' => 'required|date|after:yesterday',
            'nro_operacion' => 'required|string|unique:transferencias,nro_operacion',
            'codigo' => 'required|string|unique:transferencias,codigo',
            'estado' => 'required|string|in:solicitud',
            'monto' => 'required|numeric',
            'recibo' => 'required|file|mimes:jpg,png,jpeg,pdf|max:2048'
        ];

        $validator = Validator::make($data, $rules);
        return $validator;
    }

}
