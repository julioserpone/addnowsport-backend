<?php

namespace App\Helpers\Webpay;

use SoapClient;
use DOMDocument;
use App\Helpers\Webpay\WSSESoap;
use Illuminate\Support\Facades\File;

//use RobRichards\WsePhp\WSSESoap;
//use RobRichards\XMLSecLibs\XMLSecurityKey;

File::requireOnce(app_path('Helpers/Webpay/XmlSecLibs.php')); // require_once app_path('Helpers\WebPay\XmlSecLibs.php');
//File::requireOnce(app_path('Helpers\WebPay\WSSESoasp.php')); // require_once app_path('Helpers\WebPay\WSSESoasp.php');

class MySoap extends SoapClient
{

    private $useSSL = false;

    public function __construct($wsdl, $options)
    {
        $locationparts = parse_url($wsdl);
        $this->useSSL = $locationparts['scheme'] == "https" ? true : false;
        return parent::__construct($wsdl, $options);
    }

    public function __doRequest($request, $location, $saction, $version, $one_way = 0)
    {
        if ($this->useSSL) {
            $locationparts = parse_url($location);
            $location = 'https://';
            if (isset($locationparts['host']))
                $location .= $locationparts['host'];
            if (isset($locationparts['port']))
                $location .= ':' . $locationparts['port'];
            if (isset($locationparts['path']))
                $location .= $locationparts['path'];
            if (isset($locationparts['query']))
                $location .= '?' . $locationparts['query'];
        }
        $doc = new DOMDocument('1.0');
        $request = str_replace("\n", "", $request);
        $doc->recover = TRUE;
        $doc->loadXML($request);        
        $doc->normalizeDocument();
        $objWSSE = new WSSESoap($doc);
        $objKey = new XMLSecurityKey(XMLSecurityKey::RSA_SHA1, ['type' => 'private']);
        $objKey->loadKey(env('PRIVATE_KEY'), TRUE);
        $options = ["insertBefore" => TRUE];
        $objWSSE->signSoapDoc($objKey, $options);
        $objWSSE->addIssuerSerial(env('CERT_FILE'));
        $objKey = new XMLSecurityKey(XMLSecurityKey::AES256_CBC);
        $objKey->generateSessionKey();
        $retVal = parent::__doRequest($objWSSE->saveXML(), $location, $saction, $version, $one_way = 0);
        $doc = new DOMDocument();
        $doc->loadXML($retVal);
        return $doc->saveXML();
    }

    public function cleanupXML($xml)
    {
        $xmlOut = '';
        $inTag = false;
        $xmlLen = strlen($xml);
        for ($i = 0; $i < $xmlLen; ++$i) {
            $char = $xml[$i];
            // $nextChar = $xml[$i+1];
            switch ($char) {
                case '<':
                    if (!$inTag) {
                        // Seek forward for the next tag boundry
                        for ($j = $i + 1; $j < $xmlLen; ++$j) {
                            $nextChar = $xml[$j];
                            switch ($nextChar) {
                                case '<':  // Means a < in text
                                    $char = htmlentities($char);
                                    break 2;
                                case '>':  // Means we are in a tag
                                    $inTag = true;
                                    break 2;
                            }
                        }
                    } else {
                        $char = htmlentities($char);
                    }
                    break;
                case '>':
                    if (!$inTag) {  // No need to seek ahead here
                        $char = htmlentities($char);
                    } else {
                        $inTag = false;
                    }
                    break;
                default:
                    if (!$inTag) {
                        $char = htmlentities($char);
                    }
                    break;
            }
            $xmlOut .= $char;
        }
        return $xmlOut;
    }

}
