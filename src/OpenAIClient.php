<?php

namespace LeandroFerreiraMa\OpenAI;

use Dotenv\Dotenv;
use Exception;

class OpenAIClient
{
    private $httpClient;
    private $assistant;
    private $thread;
    private $run;

    public function __construct(string $envFilePath)
    {
        $dotenv = Dotenv::createImmutable($envFilePath);
        $dotenv->load();
        $apiKey = $_ENV['OPENAI_API_KEY'];

        $this->httpClient = new HttpClient($apiKey);
        $this->assistant = new Assistant($this->httpClient);
        $this->thread = new Thread($this->httpClient);
        $this->run = new Run($this->httpClient);
    }

    public function askAssistant($assistantId, $threadId, $question)
    {
        // 1. Enviar a pergunta ao assistente
        $message = $this->thread->sendMessage($threadId, $question);
        $messageId = $message['id'] ?? null;

        if (!$messageId) {
            throw new Exception("Erro ao enviar a mensagem.");
        }

        // 2. Criar o RUN associado à thread
        $run = $this->run->create($threadId, $assistantId);
        $runId = $run['id'] ?? null;

        if (!$runId) {
            throw new Exception("Erro ao criar o RUN.");
        }

        // 3. Verificar o status do RUN até que esteja concluído
        do {
            $runStatus = $this->run->getStatus($threadId, $runId);
            $statusMessage = $runStatus['status'] ?? 'pending';
            sleep(2);
        } while ($statusMessage !== 'completed');

        // 4. Buscar a última mensagem do assistente
        return $this->thread->getLatestAssistantMessage($threadId);
    }

    public function getAssistant()
    {
        return $this->assistant;
    }

    public function getThread()
    {
        return $this->thread;
    }

    public function getRun()
    {
        return $this->run;
    }
}
