<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Validaciones;

use Illuminate\Support\Facades\Validator;

/**
 * Description of ValidacionesDistancias
 *
 * @author Reysmer Valle
 */
class ValidacionesDistancias
{
    public static function mostrarDistanciaValidacion($data)
    {
        $rules = [
            'distancia_id' => 'required|exists:distancias,id,deleted_at,NULL',
        ];
        $validator = Validator::make($data, $rules);
        return $validator;
        
    }
    
    public static function actualizarDistanciaValidacion($data)
    {
        $rules = [
            'id' => 'required|integer|exists:distancias,id,deleted_at,NULL',
            'fecha_id' => 'required|integer|exists:fechas,id,deleted_at,NULL',
            'nombre' => 'required|string',
            'status' => 'required|string',
        ];
        $validator = Validator::make($data, $rules);
        return $validator;
        
    }
    
    public static function crearDistanciaValidation($data)
    {
        $rules = [
            'fecha_id' => 'required|integer|exists:fechas,id,deleted_at,NULL',
            'nombre' => 'required|string',
            'status' => 'required|string',
        ];
        $validator = Validator::make($data, $rules);
        return $validator;
        
    }
}
