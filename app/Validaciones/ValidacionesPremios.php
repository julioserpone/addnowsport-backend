<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Validaciones;

use Illuminate\Support\Facades\Validator;
/**
 * Description of ValidacionesPremios
 *
 * @author Reysmer Valle
 */
class ValidacionesPremios
{
    
    public static function eliminarPremioValidacion($data)
    {
        $rules = [
            'premio_id' => 'required|integer|exists:premios,id,deleted_at,NULL',
        ];
        $validator = Validator::make($data, $rules);
        return $validator;
    }

    public static function actualizarPremioValidacion($data)
    {
        $rules = [
            'premio_id' => 'required|integer|exists:premios,id,deleted_at,NULL',
            'productora_id' => 'integer|exists:productoras,id,deleted_at,NULL',
            'competencia_id' => 'integer|exists:competencias,id,deleted_at,NULL',
            'foto_id' => 'integer|exists:fotos,id,deleted_at,NULL',
            'fecha' => 'date',
            'nombre' => 'string',
            'descripcion' => 'string',
            'puesto' => 'string',
            'monto' => 'numeric'
        ];
        $validator = Validator::make($data, $rules);
        return $validator;
    }

    public static function mostrarPremioValidacion($data)
    {
        $rules = [
            'premio_id' => 'required|integer|exists:premios,id,deleted_at,NULL',
        ];
        $validator = Validator::make($data, $rules);
        return $validator;
    }

    public static function crearPremioValidacion($data)
    {
        $rules = [
            'productora_id' => 'required|integer|exists:productoras,id,deleted_at,NULL',
            'competencia_id' => 'required|integer|exists:competencias,id,deleted_at,NULL',
            'foto_id' => 'required|integer|exists:fotos,id,deleted_at,NULL',
            'fecha' => 'required|date',
            'nombre' => 'required|string',
            'descripcion' => 'required|string',
            'puesto' => 'required|string',
            'monto' => 'numeric'
        ];

        $validator = Validator::make($data, $rules);
        return $validator;
    }
    
    public static function agregarFotoValidacion($data)
    {
        $rules = [
            'premio_id' => 'required|integer|exists:premios,id,deleted_at,NULL',
            'titulo' => 'string',
            'text' => 'string',
            'boton' => 'boolean',
            'nombre_boton' => 'string', 
            'vinculo_boton' => 'string',
            'foto' => 'required|image|mimes:jpg,png,jpeg',
        ];
        return Validator::make($data, $rules);
    }
}
