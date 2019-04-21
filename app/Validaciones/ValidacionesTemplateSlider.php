<?php


namespace App\Validaciones;

use Illuminate\Support\Facades\Validator;

/**
 * Description of ValidacionesSlider
 *
 * @author Raffaele Ranaldo
 */
class ValidacionesTemplateSlider
{
    public static function crearTemplateSliderValidacion($data){
        $rules = [
            'usuario_id' => 'required|integer|exists:usuarios,id',
            'tipo' => 'required|in:home,productora,competencia',
            'total'=> 'required|integer',
            'efecto'=>'required|integer',
            'status'=>'required|in:activo,inactivo',
        ];
        return Validator::make($data, $rules);
    }
    public static function agregarFotoTemplateSliderValidacion($data)
    {
        $rules = [
            'templateSlider_id' => 'required|integer|exists:templatesliders,id',
            'foto' => 'required|image|mimes:jpg,png,jpeg',
        ];
        return Validator::make($data, $rules);
    }

    public static function TemplateSliderExistsValidacion($data){

        $rules = [
            'id' => 'required|integer|exists:templatesliders,id',
        ];
        return Validator::make($data, $rules);
    }

    public static function TemplatefotoExistsValidacion($data){

        $rules = [
            'id' => 'required|integer|exists:templatefotos,id',
        ];
        return Validator::make($data, $rules);
    }
    public static function agregarInformacionFotoTemplateSliderValidacion($data)
    {
        $rules = [
            'id'     => 'required|integer|exists:templatefotos,id',
            'titulo' => 'required|string',
            'texto' => 'required|string',
            'boton' => 'required|integer',
            'vinculo_boton' => 'required|string',
            'nombre_boton' => 'required|string',
        ];
        return Validator::make($data, $rules);
    }


}
