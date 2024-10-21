<?php

namespace LeandroFerreiraMa\OpenAI;

enum Model: string
{
    case GPT_3_5 = 'gpt-3.5';
    case GPT_4 = 'gpt-4';
    case GPT_4_TURBO = 'gpt-4-turbo';
    // Adicione outros modelos conforme necessário
}
