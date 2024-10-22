<?php

// Carrega o autoloader gerado pelo Composer
require __DIR__ . '/../vendor/autoload.php';

use LeandroFerreiraMa\OpenAI\OpenAIClient;
use LeandroFerreiraMa\OpenAI\Model;

try {
    // Caminho do arquivo .env
    $envFilePath = __DIR__ . '/../'; // Ajuste conforme necessário

    // Instância o cliente OpenAI com o caminho do arquivo .env
    $client = new OpenAIClient($envFilePath);

    // 1. Criação do assistente com o modelo utilizando ENUN
    $assistant = $client->getAssistant()->create(Model::GPT_4, 'Responda como se você fosse um guia turístico.');
    $assistantId = $assistant['id'] ?? null;

    if (!$assistantId) {
        throw new Exception('Erro ao criar o assistente');
    }
    echo "<br>Assistente criado: {$assistantId}\n";

    // 2. Criar a thread
    $thread = $client->getThread()->create();
    $threadId = $thread['id'] ?? null;

    if (!$threadId) {
        throw new Exception('Erro ao criar a thread');
    }
    echo "<br>Thread criada: {$threadId}\n";

    // 3. Enviar perguntas e obter respostas
    $response1 = $client->askAssistant($assistantId, $threadId, 'Quais são os melhores lugares para visitar na Argentina?');
    echo "<br>Resposta 1 do assistente: {$response1}\n";

    $response2 = $client->askAssistant($assistantId, $threadId, 'Quais são os melhores lugares para visitar no Brasil?');
    echo "<br>Resposta 2 do assistente: {$response2}\n";

} catch (Exception $e) {
    echo '<br>Erro: ' . $e->getMessage();
}
