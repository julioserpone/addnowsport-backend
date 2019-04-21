<?php


namespace App\Validaciones;

use Illuminate\Support\Facades\Validator;

class ValidacionesOffice
{

    public static function exportarResultadosValidacion($data){

        $rules = [
            'filename' => 'string|max:50',
            'type' => 'required|string|in:pdf,xls',
            'content' => 'required|json'
        ];
        return Validator::make($data, $rules);
    }
    
    public static function importarResultadosValidacion($data)
    {
        $rules = [
            'archivo' => 'required|file|mimes:xls,xlsx,xlm,xla,xlc,xlt,xlw',
            'tabla' =>   'required|string',
        ];
        return Validator::make($data, $rules);
    }



}
