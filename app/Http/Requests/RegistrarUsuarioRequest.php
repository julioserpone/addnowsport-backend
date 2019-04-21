<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;

class RegistrarUsuarioRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
    
    protected $rules = [
        'nombre' => 'required|string|max:100',
        'apellido' => 'required|string|max:100',
        'fecha_nacimiento' => 'date',
        'correo' => 'required|email|unique:usuarios,email',
        'correo_confirmation' => 'required_with:correo|email',
        'clave' => 'required_without:id|min:8|confirmed',
        'clave_confirmation' => 'required_with:clave|min:8',
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

    protected function formatErrors(Validator $validator)
    {
        return $validator->errors()->all();
    }
}
