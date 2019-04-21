<?php

namespace App\Http\Requests;

//use Illuminate\Foundation\Http\FormRequest;
use App\Http\Requests\Request;

class RulesInscripcionPaso1 extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return \JWTAuth::parseToken()->authenticate();
    }

    protected $rules = [
        'competencia_id' => 'required|exists:competencias,id',
        'productora_id' => 'required|exists:productoras,id',
        'team' => 'required_without_all:new_team|integer|exists:teams,id',
        'new_team' => 'required_without_all:team|string|unique:teams,nombre',
        'fechas' => 'required|array',
        'fechas.*.categoria' => 'required|integer|exists:categorias,id',
        'fechas.*.distancia' => 'required|integer|exists:distancia_fecha,distancia_id',
        'cantidad_participantes' => 'required|integer|between:1,50',
        'tipo_inscripcion' => 'required|in:individual,grupal',
        'medio_pago' => 'required|array|in:codigo,webpay',
        'codigo_redencion' => 'required_if:medio_pago,codigo|exists:codigos,codigo',
    ];
    
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return $this->rules;
    }
}
