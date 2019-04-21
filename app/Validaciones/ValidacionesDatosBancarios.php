<?php


namespace App\Validaciones;

use Illuminate\Support\Facades\Validator;

/**
 * Description of ValidacionesSlider
 *
 * @author Raffaele Ranaldo
 */
class ValidacionesDatosBancarios
{

    public static function crearValidacion($data){
        $rules=[
            'productora_id'     => 'required|integer|exists:productoras,id',
            'banco_id'          => 'required|integer|exists:bancos,id',
            'titular'           => 'required|string',
            'rut'               => 'required|string',
            'nro_cuenta'        => 'required|string',
            'tipo_cuenta'       => 'required|string',
            'correo'            => 'required|email',
            'pin'               => 'required|numeric|max:4',
            'pin_confirmacion'  => 'required|same:pin'
        ];
        return Validator::make($data,$rules);
    }

    public static function actualizarValidacion($data){
        $rules=[
            'productora_id'  => 'required|integer|exists:productoras,id',
            'banco_id'       => 'required|integer|exists:bancos,id',
            'titular'        => 'required|string',
            'rut'            => 'required|string',
            'nro_cuenta'     => 'required|string',
            'tipo_cuenta'    => 'required|string',
            'correo'         => 'required|email'
        ];
        return Validator::make($data,$rules);
    }

    public static function actualizarPinValidacion($data)
    {
        $rules=[
            'pin'               => 'required|numeric|min:1000|max:9999',
            'pin_nuevo'         => 'required|numeric|min:1000|max:9999',
            'pin_confirmacion'  => 'required|same:pin_nuevo',
        ];
        return Validator::make($data,$rules);
    }

    public static function eliminarValidacion($data)
    {
        $rules=[
            'id'             => 'required|integer|exists:datos_bancarios,id',
            'productora_id'  => 'required|integer|exists:productoras,id',
        ];
        return Validator::make($data,$rules);
    }


}
