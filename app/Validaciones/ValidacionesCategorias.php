<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Validaciones;

use Illuminate\Support\Facades\Validator;

/**
 * Description of ValidacionesCategorias
 *
 * @author Reysmer Valle
 */
class ValidacionesCategorias
{

    public static function mostrarGrupoCategoriaValidacion($data)
    {
        $rules = [
            'grupo_id' => 'required|exists:grupos,id,deleted_at,NULL',
        ];
        $validator = Validator::make($data, $rules);
        return $validator;
    }
    
    public static function mostrarCategoriaValidacion($data)
    {
        $rules = [
            'id' => 'required|exists:categorias,id,deleted_at,NULL',
        ];
        $validator = Validator::make($data, $rules);
        return $validator;
    }

    public static function actualizarCategoriaValidacion($data)
    {
        $rules = [
            'id' => 'required|integer|exists:categorias,id,deleted_at,NULL',
            'productora_id' => 'required|integer|exists:productoras,id,deleted_at,NULL',
            'nombre' => 'required|string',
            'edad_inicio' => 'required|integer',
            'edad_final' => 'required|integer',
        ];
        $validator = Validator::make($data, $rules);
        return $validator;
    }

    public static function crearCategoriaValidation($data)
    {
        $rules = [
            'productora_id' => 'required|integer|exists:productoras,id,deleted_at,NULL',
            'nombre' => 'required|string',
            'edad_inicio' => 'required|integer',
            'edad_final' => 'required|integer',
            'grupo_id' => 'required|exists:grupos,id,deleted_at,NULL',
        ];
        $validator = Validator::make($data, $rules);
        return $validator;
    }

    public static function crearGrupoCategoriaValidation($data)
    {
        $rules = [
            'productora_id' => 'required|integer|exists:productoras,id,deleted_at,NULL',
            'nombre' => 'required|string',
        ];

        $validator = Validator::make($data, $rules);
        return $validator;
    }

    public static function modificarGrupoCategoriaValidacion($data)
    {
        $rules = [
            'categorias' => 'array',
            'productora_id' => 'integer|exists:productoras,id,deleted_at,NULL',
            'grupo_id' => 'required|integer|exists:categorias,id,deleted_at,NULL',
            'nombre' => 'string',
            'edad_inicio' => 'integer',
            'edad_final' => 'integer',
        ];
        $messages = [];
        foreach ($data['categorias'] as $key => $val) {
            $index = (int) $key;
            $messages['categorias.' . $key . '.exists'] = 'La categoría  ' . ($index + 1) . ' no es válida';
            $rules['categorias.' . $key] = 'integer|exists:categorias,id,deleted_at,NULL';
        }
        $validator = Validator::make($data, $rules);
        return $validator;
    }

    public static function eliminarGrupoCategoriaValidation($data)
    {
        $rules = [
            'productora_id' => 'required|integer|exists:productoras,id,deleted_at,NULL',
            'id' => 'required|integer|exists:categorias,id,deleted_at,NULL',
        ];

        $validator = Validator::make($data, $rules);
        return $validator;
    }

    public static function eliminarCategoriaValidation($data)
    {
        $rules = [
            'id' => 'required|exists:categorias,id,deleted_at,NULL',
            'productora_id' => 'required|integer|exists:productoras,id,deleted_at,NULL',
        ];

        $validator = Validator::make($data, $rules);
        return $validator;
    }

    public static function agregarDistanciasValidacion($data){
        $rules = [
            'id' => 'required|exists:categorias,id,deleted_at,NULL',
            'all' => 'integer',
            'distancia_id' => 'integer|exists:distancias,id,deleted_at,NULL',
        ];
        $validator = Validator::make($data, $rules);
        return $validator;
    }


    public static function existsDistanciaRelacionValidacion($data){

        $rules = [
            'relacion_id' => 'integer|exists:distancia_categorias,id,deleted_at,NULL'
        ];
        $validator = Validator::make($data, $rules);
        return $validator;

    }


}
