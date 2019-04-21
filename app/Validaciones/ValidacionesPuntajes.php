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
class ValidacionesPuntajes
{

    public static function mostrarPuntajeValidacion($data)
    {
        $rules = [
            'competencia_id' => 'required|exists:competencias,id,deleted_at,NULL',
        ];
        $validator = Validator::make($data, $rules);
        return $validator;
    }

}
