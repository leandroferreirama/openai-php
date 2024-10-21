<?php

namespace LeandroFerreiraMa\OpenAI;

use Exception;

class HttpClient
{
    private $apiKey;
    private $baseUri = 'https://api.openai.com/v1/';

    public function __construct($apiKey)
    {
        $this->apiKey = $apiKey;
    }

    public function sendRequest($endpoint, $method, $data = null)
    {
        $url = $this->baseUri . $endpoint;
        $headers = [
            'Authorization: Bearer ' . $this->apiKey,
            'Content-Type: application/json',
            'OpenAI-Beta: assistants=v2'
        ];

        $options = [
            CURLOPT_URL => $url,
            CURLOPT_CUSTOMREQUEST => $method,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER => $headers,
        ];

        if ($data) {
            $options[CURLOPT_POSTFIELDS] = json_encode($data);
        }

        $ch = curl_init();
        curl_setopt_array($ch, $options);
        $response = curl_exec($ch);
        if ($response === false) {
            throw new Exception('Erro na requisição: ' . curl_error($ch));
        }
        curl_close($ch);

        return json_decode($response, true);
    }
}
