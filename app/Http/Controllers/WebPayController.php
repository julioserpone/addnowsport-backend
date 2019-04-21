<?php

namespace App\Http\Controllers;

use Exception;
use App\Modelos\WebPay;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use App\Helpers\Webpay\WebPayService;
use App\Helpers\Webpay\SoapValidation;
use App\Validaciones\ValidacionesWebPay;
use App\Helpers\Webpay\Classmap\wsTransactionDetail;
use App\Helpers\Webpay\Classmap\getTransactionResult;
use App\Helpers\Webpay\Classmap\wsInitTransactionInput;
use App\Helpers\Webpay\Classmap\acknowledgeTransaction;

class WebPayController extends Controller
{

    public function index()
    {

        return view('webpay.index');
    }

    public function getWebpay()
    {
        return "RECHAZADO";
    }

    public function sendWebpay(Request $request)
    {
        //$SERVERTRA = env('SERVERTRA');
        //$PORTTRA = env('PORTTRA');

        $TBK_MONTO = $request['TBK_MONTO'];
        $TBK_TIPO_TRANSACCION = $request['TBK_TIPO_TRANSACCION'];
        $TBK_ID_SESION = $request['TBK_ID_SESION'];
        $TBK_ORDEN_COMPRA = $request['TBK_ORDEN_COMPRA'];
        $TBK_EXITO = $request['TBK_EXITO'];
        $TBK_FRACASO = $request['TBK_FRACASO'];

        $send = "TBK_MONTO=" . $TBK_MONTO
                . "&" . "TBK_TIPO_TRANSACCION=" . $TBK_TIPO_TRANSACCION
                . "&" . 'TBK_ID_SESION=' . $TBK_ID_SESION
                . "&" . "TBK_ORDEN_COMPRA=" . $TBK_ORDEN_COMPRA
                . "&" . "TBK_EXITO=" . $TBK_EXITO
                . "&" . "TBK_FRACASO=" . $TBK_FRACASO;


        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, "http://localhost/psp/kcc/cgi-bin/tbk_bp_pago.cgi");
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $send);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $server_output = curl_exec($ch);

        if ($errno = curl_errno($ch)) {
            echo $errno;
        }

        curl_close($ch);

        echo $server_output;
    }

    public function postWebpay(Request $request)
    {
        $input = Input::all();
        try {
            $data['TBK_ORDEN_COMPRA'] = $input['TBK_ORDEN_COMPRA'];
            $data['TBK_TIPO_TRANSACCION'] = $input['TBK_TIPO_TRANSACCION'];
            $data['TBK_RESPUESTA'] = $input['TBK_RESPUESTA'];
            $data['TBK_MONTO'] = $input['TBK_MONTO'];
            $data['TBK_CODIGO_AUTORIZACION'] = $input['TBK_CODIGO_AUTORIZACION'];
            $data['TBK_FINAL_NUMERO_TARJETA'] = $input['TBK_FINAL_NUMERO_TARJETA'];
            $data['TBK_FECHA_CONTABLE'] = $input['TBK_FECHA_CONTABLE'];
            $data['TBK_FECHA_TRANSACCION'] = $input['TBK_FECHA_TRANSACCION'];
            $data['TBK_HORA_TRANSACCION'] = $input['TBK_HORA_TRANSACCION'];
            $data['TBK_ID_SESION'] = $input['TBK_ID_SESION'];
            $data['TBK_ID_TRANSACCION'] = $input['TBK_ID_TRANSACCION'];
            $data['TBK_TIPO_PAGO'] = $input['TBK_TIPO_PAGO'];
            $data['TBK_NUMERO_CUOTAS'] = $input['TBK_NUMERO_CUOTAS'];
            $data['TBK_VCI'] = $input['TBK_VCI'];
            $data['TBK_MAC'] = $input['TBK_MAC'];
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return "RECHAZADO";
        }

        Log::info($data);

        $TBK_ORDEN_COMPRA = Input::get("TBK_ORDEN_COMPRA");
        $TBK_RESPUESTA = Input::get("TBK_RESPUESTA");
        $TBK_MONTO = Input::get("TBK_MONTO");
        $TBK_ID_SESION = Input::get("TBK_ID_SESION");

        if (WebPay::hasOrden($TBK_ORDEN_COMPRA)) {
            return "RECHAZADO";
        }

        dd('here webpay');
        Log::info('sin orden');

        $myPath = public_path("kcc/log/dato" . $TBK_ID_SESION . ".log");

        //GENERA ARCHIVO PARA MAC
        $filename_txt = public_path("kcc/log/" . $TBK_ID_SESION . ".txt");

        // Ruta Checkmac
        $cmdline = public_path("kcc/cgi-bin/tbk_check_mac.cgi " . $filename_txt);

        $acepta = false;
        $linea = "";

        //lectura archivo que guardo pago.php
        if ($fic = @fopen($myPath, "r")) {
            $linea = @fgets($fic);
            @fclose($fic);
        }

        $detalle = preg_split("/;/", $linea);

        if (count($detalle) > 1) {
            $monto = $detalle[0];
            $ordenCompra = $detalle[1];
        } else {
            Log::error("ERROR en dato" . $TBK_ID_SESION . ".log");
            return "RECHAZADO";
        }

        //guarda los datos del post uno a uno en archivo para la ejecución del MAC
        $fp = fopen($filename_txt, "wt");

        while (list($key, $val) = each($data)) {
            fwrite($fp, $key . "=" . $val . "&");
        }

        fclose($fp);

        //validación de monto y Orden de compra
        if ($TBK_MONTO == $monto && $TBK_ORDEN_COMPRA == $ordenCompra) {
            $acepta = true;
        } else {
            $acepta = false;
            Log::error("ERROR EN validación de monto y Orden de compra");
        }

        Log::info('validacion monto realizada...');

        //Validación MAC
        if ($acepta == true) {
            $this->saveLog($data);
            Log::info('log creado...');
            exec($cmdline, $result, $retint);
            Log::info('validacion tbk_check_mac realizada...' . $result[0]);
            if ($result[0] == "CORRECTO") {
                //Validación de respuesta de Transbank, solo si es 0 continua con la pagina de cierre
                if ($TBK_RESPUESTA != "0" && $acepta) {
                    return "ACEPTADO";
                }

                if ($this->isStore($TBK_ORDEN_COMPRA)) {
                    Log::info('tbk_store');
                    $this->confirmSale($TBK_ORDEN_COMPRA);
                } else {
                    Log::info('tbk_play');
                    $this->confirmTransaction($TBK_ORDEN_COMPRA);
                }
                $acepta = true;
            } else {
                $acepta = false;
            }
        }

        return ($acepta == true) ? "ACEPTADO" : "RECHAZADO";
    }

    public function postWebPayTransicion(Request $request)
    {
        $data = $request->all(); // Aqui retorna token_ws cuando es aceptada la transacción
        return view('home.home', $data);
    }
    
    public function postWebPayFinal(Request $request)
    {
        $data = $request->all(); // Aqui retorna TBK_TOKEN, TBK_ID_SESION, TBK_ORDEN_COMPRA cuando es anulada la transacción
        return view('home.home', $data);
    }

    public function initTransaction(Request $request)
    {
        try {
            $wsInitTransactionInput = new wsInitTransactionInput();
            $wsTransactionDetail = new wsTransactionDetail();
            $validator = ValidacionesWebPay::initTransactionValidacion($request->all());
            if ($validator->fails()) {
                return response()->json(['data' => false, 'error' =>
                            $validator->messages()->first()], 404);
            }
            /* Variables de tipo string */
            list($wsInitTransactionInputData, $urlWsdl) = $this->loadInitTransactionData($request->all(), $wsInitTransactionInput, $wsTransactionDetail);
            $webpayService = new WebPayService($urlWsdl);
            $initTransactionResponse = $webpayService->initTransaction(
                    ["wsInitTransactionInput" => $wsInitTransactionInputData]
            );
            /* Validación de firma del requerimiento de respuesta enviado por Webpay */
            $xmlResponse = $webpayService->soapClient->__getLastResponse();
            $soapValidation = new SoapValidation($xmlResponse, env('SERVER_CERT'));
            $validationResult = $soapValidation->getValidationResult();
            return $this->validateResultInitTransaction($validationResult, $initTransactionResponse);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 404);
        }
    }

    public function getTransactionResult(Request $request)
    {
        try {
            $validator = ValidacionesWebPay::getTransactionResultValidacion($request->all());
            if ($validator->fails()) {
                return response()->json(['data' => false, 'error' =>
                            $validator->messages()->first()], 404);
            }
            $webpayService = new WebPayService($request->url_wsdl);
            $getTransactionResult = new getTransactionResult();
            $getTransactionResult->tokenInput = $request->token_ws;
            $getTransactionResultResponse = $webpayService->getTransactionResult(
                    $getTransactionResult);
            $transactionResultOutput = $getTransactionResultResponse->return;
            /* Validación de firma del requerimiento de respuesta enviado por Webpay */
            $xmlResponse = $webpayService->soapClient->__getLastResponse();
            $soapValidation = new SoapValidation($xmlResponse, env('SERVER_CERT'));
            $validationResult = $soapValidation->getValidationResult();
            return $this->validateTransactionResult($validationResult, $getTransactionResultResponse);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 404);
        }
    }

    public function acknowledgeTransaction(Request $request)
    {
        try {
            $validator = ValidacionesWebPay::getTransactionResultValidacion($request->all());
            if ($validator->fails()) {
                return response()->json(['data' => false, 'error' =>
                            $validator->messages()->first()], 404);
            }
            $webpayService = new WebpayService($request->url_wsdl);
            $acknowledgeTransaction = new acknowledgeTransaction();
            $acknowledgeTransaction->tokenInput = $request->token_ws;
            $acknowledgeTransactionResponse = $webpayService->acknowledgeTransaction(
                    $acknowledgeTransaction);
            $xmlResponse = $webpayService->soapClient->__getLastResponse();
            $soapValidation = new SoapValidation($xmlResponse, env('SERVER_CERT'));
            $validationResult = $soapValidation->getValidationResult();
            return response()->json(['data' => true], 200);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 404);
        }
    }

    public function loadInitTransactionData($data, $wsInitTransactionInput, $wsTransactionDetail)
    {
        $wsInitTransactionInput->wSTransactionType = $data['transactionType'];
        $wsInitTransactionInput->commerceId = (isset($data['commerceId'])) ? $data['commerceId'] : "";
        $wsInitTransactionInput->buyOrder = (isset($data['buyOrderPrincipal'])) ? $data['buyOrderPrincipal'] : "";
        $wsInitTransactionInput->sessionId = $data['sessionId'];
        $wsInitTransactionInput->returnURL = $data['returnUrl'];
        $wsInitTransactionInput->finalURL = $data['finalUrl'];
        $wsTransactionDetail->commerceCode = (isset($data['commerceCode'])) ? $data['commerceCode'] : "";
        $wsTransactionDetail->buyOrder = $data['buyOrderDetail'];
        $wsTransactionDetail->amount = $data['amount'];
        $wsInitTransactionInput->transactionDetails = $wsTransactionDetail;

        return [$wsInitTransactionInput, $data['urlWsdl']];
    }

    public function validateResultInitTransaction($validationResult, $initTransactionResponse)
    {
        /* Invocar sólo sí $validationResult es TRUE */
        if ($validationResult) {
            $wsInitTransactionOutput = $initTransactionResponse->return;
            /* TOKEN de Transacción entregado por Webpay */
            $tokenWebpay = $wsInitTransactionOutput->token;
            /* URL donde se debe continuar el flujo */
            $urlRedirect = $wsInitTransactionOutput->url;
            return response()->json(['data' => ['token_ws' => $tokenWebpay,
                            'url_redirect' => $urlRedirect]]);
        } else {
            return response()->json(['data' => false], 404);
        }
    }

    public function validateTransactionResult($validationResult, $getTransactionResultResponse)
    {
        if ($validationResult) {
            /* Validación de firma correcta */
            $transactionResultOutput = $getTransactionResultResponse->return;
            /* URL donde se debe continuar el flujo */
            $url = $transactionResultOutput->urlRedirection;
            $wsTransactionDetailOutput = $transactionResultOutput->detailOutput;
            /* Código de autorización */
            $authorizationCode = $wsTransactionDetailOutput->authorizationCode;
            /* Tipo de Pago */
            $paymentTypeCode = $wsTransactionDetailOutput->paymentTypeCode;
            /* Código de respuesta */
            $responseCode = $wsTransactionDetailOutput->responseCode;
            /* Número de cuotas */
            $sharesNumber = $wsTransactionDetailOutput->sharesNumber;
            /* Monto de la transacción */
            $amount = $wsTransactionDetailOutput->amount;
            /* Código de comercio */
            $commerceCode = $wsTransactionDetailOutput->commerceCode;
            /* Orden de compra enviada por el comercio al inicio de la transacción */
            $buyOrder = $wsTransactionDetailOutput->buyOrder;
            if ($wsTransactionDetailOutput->responseCode == 0) {
                /* Esto indica que la transacción está autorizada */
                return response()->json(['data' => [
                    'url' => $url, 'authorizationCode' => $authorizationCode,
                    'paymentTypeCode' => $paymentTypeCode, 'responseCode' => $responseCode,
                    'sharesNumber' => $sharesNumber, 'amount' => $amount,
                    'commerceCode' => $commerceCode, 'buyOrder' => $buyOrder]], 200);
            } else {
                return response()->json(['data' => false], 404);
            }
        } else {
            return response()->json(['data' => false], 404);
        }
    }

}
