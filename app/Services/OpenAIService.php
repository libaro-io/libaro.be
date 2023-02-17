<?php

namespace App\Services;

use Orhanerday\OpenAi\OpenAi;

class OpenAIService
{
    private OpenAi $open_ai;

    public function __construct()
    {
        $this->open_ai = new OpenAi(config('openai.api_key'));
    }

    public function generateText(string $text, string $pretext = "Wij zijn een dynamisch en jong bedrijf dat PHP Laravel applicaties op maat van de klant maakt. Schrijf een tekst over")
    {
        $result = json_decode($this->open_ai->completion([
            'model' => 'text-davinci-003',
            'prompt' => $pretext . " " . mb_strtolower($text),
            'temperature' => 0.9,
            'max_tokens' => 300,
            'frequency_penalty' => 0,
            'presence_penalty' => 0.6,
        ]));
        return $result->choices[0]->text;
    }
}
