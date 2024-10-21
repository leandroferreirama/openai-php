<?php

namespace LeandroFerreiraMa\OpenAI;

class Assistant
{
    private $httpClient;

    public function __construct(HttpClient $httpClient)
    {
        $this->httpClient = $httpClient;
    }

    public function create(Model $model, string $instructions)
    {
        $data = [
            'model' => $model->value,
            'instructions' => $instructions
        ];
        return $this->httpClient->sendRequest('assistants', 'POST', $data);
    }
}
