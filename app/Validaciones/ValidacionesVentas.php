<?php


namespace App\Validaciones;

use Illuminate\Support\Facades\Validator;

/**
 * Description of ValidacionesSlider
 *
 * @author Raffaele Ranaldo
 */
class ValidacionesVentas
{

    public static function existsVentasValidacion($data){

        $rules = [
            'id' => 'required|integer|exists:ventas,id',
            'productora_id' =>'required|integer|exists:productoras,id',
        ];
        return Validator::make($data, $rules);
    }



}
