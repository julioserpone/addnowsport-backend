<?php


namespace App\Validaciones;

use Illuminate\Support\Facades\Validator;

class ValidacionesWebPay
{

    public static function initTransactionValidacion($data){

        $rules = [
            'transactionType' => 'required|string',
            "commerceId" => "string|max:12",
            "sessionId" => "required|string|max:61",
            "buyOrderPrincipal" => "string",
            "returnUrl" => "required|string|url|max:256",
            "finalUrl" => "required|string|url|max:256",
            "commerceCode" => "string|max:12",
            "buyOrderDetail" => "required|string|max:26",
            "amount" => "required|numeric",
            "urlWsdl" => "required|string|url"
            
        ];
        return Validator::make($data, $rules);
    }
    
    public static function getTransactionResultValidacion($data){

        $rules = [
            'token_ws' => 'required|string',
            "url_wsdl" => "required|string|url"
        ];
        return Validator::make($data, $rules);
    }

}
