<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Validaciones;

use Illuminate\Support\Facades\Validator;

/**
 * Description of ValidacionesProductoras
 *
 * @author Raffaele Ranaldo
 */
class ValidacionesProductoras
{
    public static function cambiarImagenProductoraValidacion($data)
    {
        $rules = [
            'image' => 'required|image|mimes:jpg,png,jpeg',
        ];
        return Validator::make($data, $rules);
    }

    public static function getProductoraImagenValidacion($data){

        $rules = [
            'productora_id' => 'required|integer|exists:productoras,id'
        ];
        return Validator::make($data, $rules);
    }

    public static function crearProductoraValidacion($data){
        $rules=[
            'usuario_id'    =>'required|integer|exists:usuarios,id',
        ];
        return Validator::make($data,$rules);
    }

    public static function actualizarProductoraValidacion($data){
        $rules=[
            'productora_id' =>'required|integer|exists:productoras,id',
            'nombre'        =>'required|string',
            'razon'         =>'required|string',
            'cuit'          =>'required|string',
            'pais'          =>'required|string',
            'provincia'     =>'required|string',
            'direccion'     =>'required|string',
            'email'         =>'required|email',
            'prefijo'       =>'required|string',
            'telefono'      =>'required|string',
            'website'       =>'string',
            'descripcion'   =>'required|string',
            'facebook'      =>'string',
            'twitter'       =>'string',
            'google'        =>'string'
        ];
        return Validator::make($data,$rules);
    }

    public static function existsProductoraValidacion($data){
            //Esta validacion la utilizo en los metodos que solo requiera comprobar el que el id exista, evito crear varios para la misma actividad.
        $rules = [
            'productora_id' => 'required|integer|exists:productoras,id'
        ];
        return Validator::make($data, $rules);
    }

}
