<?php

// this defines the rccservicesoap class yeah so uhm use it if you want to :)
// not needing any other file, only the class then you are ready to go
// made by nolanwhy

class RCCServiceSoap {
    public $ip;
    public $port;
    public $url;

    function __construct($ip = "127.0.0.1", $port = 64989, $url = "roblox.com") {
        $this->ip = $ip;
        $this->port = $port;
        $this->url = $url;
    }
  
    function callToService($name, $arguments = []) {
        $result = $this->SoapClient->{$name}($arguments);
        return (!is_soap_fault($result) ? (/*is_soap_fault($result) ||*/ !isset($result->{$name."Result"}) ? null : $result->{$name."Result"}) : $result);
    }
  
    function GetStatus() {
        return $this->callToService(__FUNCTION__);
    }
  
    function requestUrl($url, $xml) {
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array("Content-Type: text/xml"));
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $xml);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        $result = curl_exec($curl);
        $luashit = array("LUA_TSTRING", "LUA_TNUMBER", "LUA_TBOOLEAN", "LUA_TTABLE");
        $result = str_replace($luashit, "", $result);
        $almost = strstr($result, '<ns1:value>');
        $luashit = array('<ns1:value>', "</ns1:value>", "</ns1:OpenJobResult>", "<ns1:OpenJobResult>", "<ns1:type>", "</ns1:type>", "<ns1:table>", "</ns1:table>", "</ns1:OpenJobResult>", "</ns1:OpenJobResponse>", "</SOAP-ENV:Body>", "</SOAP-ENV:Envelope>");
        $result = str_replace($luashit, "", $almost);

        return $result;
    }

    function execScript($script, $jobId, $jobExpiration) {
        $xml = '<?xml version="1.0" encoding="UTF-8"?>
        <SOAP-ENV:Envelope xmlns:SOAP-ENV="http://schemas.xmlsoap.org/soap/envelope/" xmlns:SOAP-ENC="http://schemas.xmlsoap.org/soap/encoding/" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:ns2="http://'.$this->url.'/RCCServiceSoap" xmlns:ns1="http://'.$this->url.'/" xmlns:ns3="http://'.$this->url.'/RCCServiceSoap12">
            <SOAP-ENV:Body>
                <ns1:OpenJob>
                    <ns1:job>
                        <ns1:id>'.$jobId.'</ns1:id>
                        <ns1:expirationInSeconds>'.$jobExpiration.'</ns1:expirationInSeconds>
                        <ns1:category>1</ns1:category>
                        <ns1:cores>321</ns1:cores>
                    </ns1:job>
                    <ns1:script>
                        <ns1:name>Script</ns1:name>
                        <ns1:script>
                            '.$script.'
                        </ns1:script>
                    </ns1:script>
                </ns1:OpenJob>
            </SOAP-ENV:Body>
        </SOAP-ENV:Envelope>';
        $url = 'http://'.$this->ip.':'.$this->port.'/';

        return $this->requestUrl($url,$xml);
    }
}