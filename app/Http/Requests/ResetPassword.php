<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class ResetPassword extends Request
{

    protected $rules = [
        'token' => 'required',
        'email' => 'required|exists:usuarios,email|email',
        'password' => 'required|min:8|max:15',
        'password_confirmation' => 'required_with:password|same:password'
    ];
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

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
