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
class ValidacionesDisciplinas
{
    public static function mostrarDisciplinaValidacion($data)
    {
        $rules = [
            'disciplina_id' => 'required|exists:disciplinas,id,deleted_at,NULL',
        ];
        $validator = Validator::make($data, $rules);
        return $validator;
        
    }
    
    public static function actualizarDisciplinaValidacion($data)
    {
        $rules = [
            'id' => 'required|integer|exists:disciplinas,id,deleted_at,NULL',
            'nombre' => 'required|string',
        ];
        $validator = Validator::make($data, $rules);
        return $validator;
        
    }

    public static function actualizarSubDisciplinaValidacion($data)
    {
        $rules = [
            'id' => 'required|integer|exists:disciplinas,id,deleted_at,NULL',
            'subdisciplina' => 'required|integer|exists:disciplinas,id,deleted_at,NULL',
            'nombre' => 'required|string',
        ];
        $validator = Validator::make($data, $rules);
        return $validator;

    }
    
    public static function crearDisciplinaValidation($data)
    {
        $rules = [
            'nombre' => 'required|string',
        ];
        $validator = Validator::make($data, $rules);
        return $validator;
        
    }

    public static function crearSubDisciplinaValidation($data)
    {
        $rules = [
            'subdisciplina' => 'required|integer|exists:disciplinas,id,deleted_at,NULL',
            'nombre' => 'required|string',
        ];
        $validator = Validator::make($data, $rules);
        return $validator;

    }
}
