<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class RulesCodigo extends Request
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
        'codigo' => 'required|string|min:8|max:15',
        'competencia' => 'required',
        'fecha_inicio' => 'required|date',
        'fecha_vencimiento' => 'required|date|after:fecha_inicio',
        'limite_uso_cupon' => 'required|integer',
        'limite_uso_usuario' => 'required|integer',
        'tipo' => 'required|string',
        'estatus' => 'required|string',
        'porcentaje_descuento' => 'required|numeric|between:0,100',
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
