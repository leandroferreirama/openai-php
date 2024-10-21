<?php

namespace LeandroFerreiraMa\OpenAI;

class Thread
{
    private $httpClient;

    public function __construct(HttpClient $httpClient)
    {
        $this->httpClient = $httpClient;
    }

    public function create()
    {
        return $this->httpClient->sendRequest('threads', 'POST');
    }

    public function sendMessage($threadId, $message)
    {
        $data = [
            'role' => 'user',  // Define o papel do remetente
            'content' => $message  // Define o conteúdo da mensagem
        ];
        return $this->httpClient->sendRequest("threads/{$threadId}/messages", 'POST', $data);
    }

    public function getMessages($threadId, $order = 'asc')
    {
        $params = ['order' => $order];
        $queryString = http_build_query($params);
        return $this->httpClient->sendRequest("threads/{$threadId}/messages?{$queryString}", 'GET');
    }

    public function getLatestAssistantMessage($threadId)
    {
        // Recupera as mensagens da thread com o parâmetro 'order' para garantir que a última mensagem do assistente seja a mais recente
        $params = [
            'order' => 'desc',  // Ordenação decrescente (mais recente primeiro)
            'limit' => 1        // Limitar a busca para 1 mensagem (a mais recente)
        ];

        $queryString = http_build_query($params);
        $response = $this->httpClient->sendRequest("threads/{$threadId}/messages?{$queryString}", 'GET');

        // Verifica se a resposta contém dados e se o role da mensagem é 'assistant'
        if (!empty($response['data']) && $response['data'][0]['role'] === 'assistant') {
            return $response['data'][0]['content'][0]['text']['value'] ?? 'Sem resposta disponível';
        }

        return 'Sem resposta do assistente disponível';
    }
}
