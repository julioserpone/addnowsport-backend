<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class AplicarCodigo extends Request
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
        'competencia_id' => 'required',
        'productora_id' => 'required',
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
