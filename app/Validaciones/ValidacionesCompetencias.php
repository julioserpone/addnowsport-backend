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
class ValidacionesCompetencias
{

    public static function mostrarCompetenciaValidacion($data)
    {
        $rules = [
            'id' => 'required|integer|exists:competencias,id,deleted_at,NULL',
            'productora_id' => 'required|exists:productoras,id,deleted_at,NULL',
        ];
        $validator = Validator::make($data, $rules);
        return $validator;
    }

    public static function mostrarCompetenciasValidacion($data)
    {
        $rules = [
            'productora_id' => 'required|exists:productoras,id,deleted_at,NULL',
        ];
        $validator = Validator::make($data, $rules);
        return $validator;
    }

    public static function mostrarProximasCompetenciasValidacion($data)
    {
        $rules = [
            'productora_id' => 'required|exists:productoras,id,deleted_at,NULL',
        //    'fecha' => 'required|date_format:"Y-m-d',
        ];
        $validator = Validator::make($data, $rules);
        return $validator;
    }
    
    public static function eliminarCompetenciasValidacion($data)
    {
        $rules = [
            'productora_id' => 'required|exists:productoras,id,deleted_at,NULL',
        ];
        $validator = Validator::make($data, $rules);
        return $validator;
    }
    
    public static function eliminarCompetenciaValidacion($data)
    {
        $rules = [
            'id' => 'required|integer|exists:competencias,id,deleted_at,NULL',
            'productora_id' => 'required|exists:productoras,id,deleted_at,NULL',
        ];
        $validator = Validator::make($data, $rules);
        return $validator;
    }

    public static function actualizarCompetenciaValidacion($data)
    {
        $rules = [
            'id' => 'required|integer|exists:competencias,id,deleted_at,NULL',
            'productora_id' => 'required|integer|exists:productoras,id,deleted_at,NULL',
            'disciplina_id' => 'integer|exists:disciplinas,id,deleted_at,NULL',
            'nombre' => 'string',
            'dominio' => 'string',
            'sub_dominio' => 'string',
            'costo' => 'numeric',
            'costo_individual' => 'numeric',
            'titulo' => 'string',
            'texto' => 'string',
            'subtitulado' => 'string',
            'descripcion' => 'string',
            'bases' => 'string',
            'cantidad_integrantes' => 'integer',
            'status' => 'string|in:activo,inactivo,',
            'tipo' => 'string|in:competencia,campeonato,',
            'facebook' => 'string',
            'twitter' => 'string',
            'google' => 'string',
            'fechas' => 'required_with:ubicaciones|array',
            'ubicaciones' => 'required_with:fechas|array'
        ];
        $messages = [];
        if (isset($data['fechas']) && isset($data['ubicaciones'])) {
            foreach ($data['fechas'] as $key => $val) {
                $index = (int) $key;
                $messages['fechas.' . $key . '.date'] = 'La fecha  ' . ($index + 1) . ' no es una fecha válida';
                $rules['fechas.' . $key] = 'required|date';
            }
            foreach ($data['ubicaciones'] as $key => $val) {
                $index = (int) $key;
                $messages['ubicaciones.' . $key . '.string'] = 'La ubicación  ' . ($index + 1) . ' no es una ubicación válida';
                $rules['ubicaciones.' . $key] = 'required|string';
            }
        }
        $validator = Validator::make($data, $rules);
        return $validator;
    }

    public static function showCompetenciaValidacion($data)
    {
        $rules = [
            'competencia_id' => 'required|integer|exists:competencias,id,deleted_at,NULL',
            'productora_id' => 'required|integer|exists:productoras,id,deleted_at,NULL',
        ];
        $validator = Validator::make($data, $rules);
        return $validator;
    }

    public static function actualizarCompetenciaJSONValidacion($data)
    {
        $rules = [
            'id' => 'required|integer|exists:competencias,id,deleted_at,NULL',
            "json" => 'required|string',
        ];

        $validator = Validator::make($data, $rules);
        return $validator;
    }

    public static function continuarCompetenciaValidacion($data)
    {
        $rules = [
            'id' => 'required|integer|exists:competencias,id,deleted_at,NULL',
            'productora_id' => 'required|integer|exists:productoras,id,deleted_at,NULL',
        ];

        $validator = Validator::make($data, $rules);
        return $validator;
    }

    public static function crearCompetenciaValidacion($data)
    {
        $rules = [
            'productora_id' => 'required|integer|exists:productoras,id,deleted_at,NULL',
            "tipo" => 'required|string',
        ];

        $validator = Validator::make($data, $rules);
        return $validator;
    }

    public static function agregarImagenValidacion($data)
    {
        $rules = [
            'id' => 'required|integer|exists:competencias,id,deleted_at,NULL',
            'productora_id' => 'required|integer|exists:productoras,id,deleted_at,NULL',
            'image' => 'required|string',
            'ext' => 'required|string'
        ];

        $validator = Validator::make($data, $rules);
        return $validator;
    }

    public static function listarImagenValidacion($data)
    {
        $rules = [
            'id' => 'required|integer|exists:competencias,id,deleted_at,NULL',
            'productora_id' => 'required|integer|exists:productoras,id,deleted_at,NULL',
        ];

        $validator = Validator::make($data, $rules);
        return $validator;
    }

    public static function listarImagenesValidacion($data)
    {
        $rules = [
            'productora_id' => 'required|integer|exists:productoras,id,deleted_at,NULL',
        ];

        $validator = Validator::make($data, $rules);
        return $validator;
    }
/*
    public static function idCompetenciaValidacion($data)
    {
        $rules = [
            'id' => 'required|integer|exists:competencias,id,deleted_at,NULL',
        ];

        $validator = Validator::make($data, $rules);
        return $validator;
    }

    public static function crearCompetenciaValidacionPaso1($data)
    {
        $rules = [
            'id' => 'required|integer|exists:competencias,id,deleted_at,NULL',
            'disciplina_id' => 'required|integer|exists:disciplinas,id,deleted_at,NULL',
            'nombre' => 'required|string',
            'dominio' => 'string',
            'sub_dominio' => 'string',
            'facebook' => 'string',
            'twitter' => 'string',
            'google' => 'string',
        ];

        $validator = Validator::make($data, $rules);
        return $validator;
    }

    public static function crearCompetenciaValidacionPaso2($data)
    {
        $rules = [
            'id' => 'required|integer|exists:competencias,id,deleted_at,NULL',
            'texto' => 'string',
        ];

        $validator = Validator::make($data, $rules);
        return $validator;
    }

    public static function crearCompetenciaValidacionPaso3($data)
    {
        $rules = [
            'id' => 'required|integer|exists:competencias,id,deleted_at,NULL',
        ];

        $messages = [];
        foreach ($data['fechas'] as $key => $val) {
            $index = (int) $key;
            $messages['fechas.' . $key . '.date'] = 'La fecha  ' . ($index + 1) . ' no es una fecha válida';
            $rules['fechas.' . $key] = 'required|date';
        }

        $validator = Validator::make($data, $rules);
        return $validator;
    }

    public static function crearCompetenciaValidacionPaso4($data)
    {
        $rules = [
            'id' => 'required|integer|exists:competencias,id,deleted_at,NULL',
        ];

        $validator = Validator::make($data, $rules);
        return $validator;
    }

    public static function crearCompetenciaValidacionPaso5($data)
    {
        $rules = [
            'productora_id' => 'required|integer|exists:productoras,id,deleted_at,NULL',
            'disciplina_id' => 'required|integer|exists:disciplinas,id,deleted_at,NULL',
            'nombre' => 'required|string',
            'dominio' => 'string',
            'sub_dominio' => 'string',
            'costo' => 'numeric',
            'costo_individual' => 'numeric',
            'titulo' => 'string',
            'texto' => 'string',
            'subtitulado' => 'string',
            'descripcion' => 'string',
            'bases' => 'string',
            'cantidad_integrantes' => 'required|integer',
            'status' => 'required|string|in:activo,inactivo,',
            'tipo' => 'required|string|in:competencia,campeonato,',
            'facebook' => 'string',
            'twitter' => 'string',
            'google' => 'string',
            'fechas' => 'required|array',
            'ubicaciones' => 'required|array'
        ];

        $messages = [];
        foreach ($data['fechas'] as $key => $val) {
            $index = (int) $key;
            $messages['fechas.' . $key . '.date'] = 'La fecha  ' . ($index + 1) . ' no es una fecha válida';
            $rules['fechas.' . $key] = 'required|date';
        }
        foreach ($data['ubicaciones'] as $key => $val) {
            $index = (int) $key;
            $messages['ubicaciones.' . $key . '.string'] = 'La ubicación  ' . ($index + 1) . ' no es una ubicación válida';
            $rules['ubicaciones.' . $key] = 'required|string';
        }
        $validator = Validator::make($data, $rules);
        return $validator;
    }
*/
}
