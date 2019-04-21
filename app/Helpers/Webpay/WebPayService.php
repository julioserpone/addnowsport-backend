<?php

namespace App\Helpers\Webpay;

use App\Helpers\Webpay\Classmap\cardDetail;
use App\Helpers\Webpay\Classmap\wpmDetailInput;
use App\Helpers\Webpay\Classmap\initTransaction;
use App\Helpers\Webpay\Classmap\wsTransactionDetail;
use App\Helpers\Webpay\Classmap\getTransactionResult;
use App\Helpers\Webpay\Classmap\wsInitTransactionInput;
use App\Helpers\Webpay\Classmap\acknowledgeTransaction;
use App\Helpers\Webpay\Classmap\transactionResultOutput;
use App\Helpers\Webpay\Classmap\initTransactionResponse;
use App\Helpers\Webpay\Classmap\wsInitTransactionOutput;
use App\Helpers\Webpay\Classmap\wsTransactionDetailOutput;
use App\Helpers\Webpay\Classmap\getTransactionResultResponse;
use App\Helpers\Webpay\Classmap\acknowledgeTransactionResponse;

class WebPayService
{

    var $soapClient;
    
    private static $classmap = ['getTransactionResult' => getTransactionResult::class
        , 'getTransactionResultResponse' => getTransactionResultResponse::class
        , 'transactionResultOutput' => transactionResultOutput::class
        , 'cardDetail' => cardDetail::class
        , 'wsTransactionDetailOutput' => wsTransactionDetailOutput::class
        , 'wsTransactionDetail' => wsTransactionDetail::class
        , 'acknowledgeTransaction' => acknowledgeTransaction::class
        , 'acknowledgeTransactionResponse' => acknowledgeTransactionResponse::class
        , 'initTransaction' => initTransaction::class
        , 'wsInitTransactionInput' => wsInitTransactionInput::class
        , 'wpmDetailInput' => wpmDetailInput::class
        , 'initTransactionResponse' => initTransactionResponse::class
        , 'wsInitTransactionOutput' => wsInitTransactionOutput::class
    ];

    function __construct($url = 'https://webpay3gint.transbank.cl/WSWebpayTransaction/cxf/WSWebpayService?wsdl')
    {
        $this->soapClient = new MySoap($url, ["classmap" => self::$classmap,
            "trace" => true, "exceptions" => true]);
    }

    function getTransactionResult($getTransactionResult)
    {
        $getTransactionResultResponse = $this->soapClient->getTransactionResult($getTransactionResult);
        return $getTransactionResultResponse;
    }

    function acknowledgeTransaction($acknowledgeTransaction)
    {
        $acknowledgeTransactionResponse = $this->soapClient->acknowledgeTransaction($acknowledgeTransaction);
        return $acknowledgeTransactionResponse;
    }

    function initTransaction($initTransaction)
    {
        try {
            $initTransactionResponse = $this->soapClient->initTransaction($initTransaction);
            return $initTransactionResponse;
        } catch (Exception $e) {
            dd($e);
        }
    }

}
