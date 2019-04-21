<?php


namespace App\Validaciones;

use Illuminate\Support\Facades\Validator;

/**
 * Description of ValidacionesSlider
 *
 * @author Raffaele Ranaldo
 */
class ValidacionesSlider
{
    public static function crearSliderValidacion($data){
        $rules = [
            'propietario_id' => 'required|integer|exists:usuarios,id',
            'tipo' => 'required|in:home,productora,competencia',
            'total'=> 'required|integer',
            'efecto'=>'required|integer',
            'status'=>'required|in:activo,inactivo',
        ];
        return Validator::make($data, $rules);
    }

    public static function agregarFotoSliderValidacion($data)
    {
        $rules = [
            'slider_id' => 'required|integer|exists:sliders,id',
            'foto' => 'required|image|mimes:jpg,png,jpeg',
        ];
        return Validator::make($data, $rules);
    }

    public static function sliderExistsValidacion($data){

        $rules = [
            'id' => 'required|integer|exists:sliders,id',
        ];
        return Validator::make($data, $rules);
    }

    public static function fotoExistsValidacion($data){

        $rules = [
            'id' => 'required|integer|exists:imagenes,id',
        ];
        return Validator::make($data, $rules);
    }

    public static function agregarInformacionFotoSliderValidacion($data)
    {
        $rules = [
            'id'     => 'required|integer|exists:imagenes,id',
            'titulo' => 'required|string',
            'texto' => 'required|string',
            'boton' => 'required|integer',
            'vinculo_boton' => 'required|string',
            'nombre_boton' => 'required|string',
        ];
        return Validator::make($data, $rules);
    }

    public static function getImagenesTemplateSlidersValidacion($data){

        $rules = [
            'id' => 'required|integer|exists:template_sliders,id,deleted_at,NULL',
        ];
        return Validator::make($data, $rules);
    }

}
