<?php

namespace LeandroFerreiraMa\OpenAI;

class Run
{
    private $httpClient;

    public function __construct(HttpClient $httpClient)
    {
        $this->httpClient = $httpClient;
    }

    public function create($threadId, $assistantId)
    {
        $data = ['assistant_id' => $assistantId];
        return $this->httpClient->sendRequest("threads/{$threadId}/runs", 'POST', $data);
    }

    public function getStatus($threadId, $runId)
    {
        return $this->httpClient->sendRequest("threads/{$threadId}/runs/{$runId}", 'GET');
    }
}
