# OpenAI PHP Client

This is a simple PHP client for interacting with the OpenAI API, allowing you to create assistants, manage threads, and send messages.

## Installation

You can install the package via Composer. Run the following command in your terminal:

```bash
composer require leandroferreirama/openai-php
```

## Usage

### Creating an Assistant

You can create an assistant using the following code:

```php
$client = new OpenAIClient();
$assistant = $client->getAssistant()->create(Model::GPT_4, 'Answer as if you were a tour guide.');
```

### Creating a Thread

To create a thread, use the following:

```php
$thread = $client->getThread()->create();
```

### Sending Messages

Send messages to the assistant like this:

```php
$response = $client->askAssistant($assistantId, $threadId, 'What are the best places to visit in Argentina?');
```

### Getting Responses

The assistant's response will be returned as a string:

```php
echo $response;
```

## Example

You can find an example of usage in the `example/index.php` file.

## License

This project is licensed under the MIT License. See the LICENSE file for details.

---

# Cliente PHP para OpenAI

Este é um cliente PHP simples para interagir com a API da OpenAI, permitindo que você crie assistentes, gerencie threads e envie mensagens.

## Instalação

Você pode instalar o pacote via Composer. Execute o seguinte comando no seu terminal:

```bash
composer require leandroferreirama/openai-php
```

## Uso

### Criando um Assistente

Você pode criar um assistente usando o seguinte código:

```php
$client = new OpenAIClient();
$assistant = $client->getAssistant()->create(Model::GPT_4, 'Responda como se você fosse um guia turístico.');
```

### Criando uma Thread

Para criar uma thread, use o seguinte:

```php
$thread = $client->getThread()->create();
```

### Enviando Mensagens

Envie mensagens ao assistente assim:

```php
$response = $client->askAssistant($assistantId, $threadId, 'Quais são os melhores lugares para visitar na Argentina?');
```

### Obtendo Respostas

A resposta do assistente será retornada como uma string:

```php
echo $response;
```

## Exemplo

Você pode encontrar um exemplo de uso no arquivo `example/index.php`.

## Licença

Este projeto é licenciado sob a Licença MIT. Veja o arquivo LICENSE para detalhes.