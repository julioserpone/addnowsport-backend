<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;

abstract class Request extends FormRequest
{

    /**
     * Treat every single request as AJAX
     * Permite sobre escribir el metodo ajax utilizado al momento de implementar una validacion de datos con FormRequest. Marca todos los request como AJAX
     * https://github.com/laravel/framework/issues/15807
     * @return bool
     */
    public function ajax()
    {
        return true;
    }

    /**
     * {@inheritdoc}
     */
    protected function formatErrors(Validator $validator)
    {
        return ['response' => false, 'errors' => $validator->errors()->all()];
    }
}