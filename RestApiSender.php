<?php

include 'models/SimpleHttpResponse.php';
require 'models/SimpleHttpCurlResponse.php';

class RestApiSender
{
    public function sendPostRequest($data, $baseUrl)
    {
        $options = array(
            'http' => array(
                'header' => "Content-type: application/x-www-form-urlencoded",
                'method' => 'POST',
                'content' => http_build_query($data)
            )
        );

        $context = stream_context_create($options);
        $result = file_get_contents($baseUrl, false, $context);

        $resp = new SimpleHttpResponse();
        $resp->statusCode = $this->get_http_response_code($baseUrl);
        $resp->responseContentString = $result;

        return $resp;
    }

    public function sendCurlPostRequest($data, $baseUrl)
    {

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $baseUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));

        $resp = new SimpleHttpCurlResponse();
        $resp->statusCode = $this->get_http_response_code($baseUrl);
        $resp->responseContentString = curl_exec($ch);
        $resp->curlInfo = curl_getinfo($ch);

        curl_close($ch);

        return $resp;
    }

    public function sendGetRequest($data, $baseUrl)
    {

        $options = array(
            'http' => array(
                'header' => "Content-type: application/x-www-form-urlencoded",
                'method' => 'GET',
                'content' => http_build_query($data)
            )
        );

        $context = stream_context_create($options);
        $result = file_get_contents($baseUrl, false, $context);


        $resp = new SimpleHttpResponse();
        $resp->statusCode = $this->get_http_response_code($baseUrl);
        $resp->responseContentString = $result;

        return $resp;
    }

    function get_http_response_code($domain1)
    {
        $headers = get_headers($domain1);
        return substr($headers[0], 9, 3);
    }
}
