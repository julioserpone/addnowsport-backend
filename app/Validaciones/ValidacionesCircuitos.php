<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Validaciones;

use Illuminate\Support\Facades\Validator;

/**
 * Description of ValidacionesCompetencias
 *
 * @author Reysmer Valle
 */
class ValidacionesCircuitos
{

    public static function crearValidacion($data)
    {
        $rules = [
            'productora_id' => 'required|exists:productoras,id,deleted_at,NULL',
            'nombre' => 'required|string',
            'puntos' => 'required|string',
        ];

        $validator = Validator::make($data, $rules);
        return $validator;
    }

    public static function mostrarValidacion($data)
    {
        $rules = [
            'id' => 'required|integer|exists:circuitos,id,deleted_at,NULL',
            'productora_id' => 'required|exists:productoras,id,deleted_at,NULL'
        ];

        $validator = Validator::make($data, $rules);
        return $validator;
    }

    public static function mostrarCircuitosValidacion($data)
    {
        $rules = [
            'productora_id' => 'required|exists:productoras,id,deleted_at,NULL'
        ];

        $validator = Validator::make($data, $rules);
        return $validator;
    }

    public static function actualizarValidacion($data)
    {
        $rules = [
            'id' => 'required|integer|exists:circuitos,id,deleted_at,NULL',
            'productora_id' => 'required|exists:productoras,id,deleted_at,NULL',
            'nombre' => 'required|string',
            'puntos' => 'required|string',
        ];

        $validator = Validator::make($data, $rules);
        return $validator;
    }

    public static function eliminarValidacion($data)
    {
        $rules = [
            'id' => 'required|integer|exists:circuitos,id,deleted_at,NULL',
            'productora_id' => 'required|exists:productoras,id,deleted_at,NULL',
        ];

        $validator = Validator::make($data, $rules);
        return $validator;
    }

}
