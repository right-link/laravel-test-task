<?php

namespace App\Services;

use App\Services\DTO\ParsedActorDTO;
use GuzzleHttp\Exception\ConnectException;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ActorParsingService
{


    public function parse(string $description): ?ParsedActorDTO
    {
        $prompt = $this->buildPrompt($description);

        try {
            $response = Http::withToken(config('services.openai.api_key'))
                ->timeout((int)(config('services.openai.timeout', config('services.openai.timeout'))))
                ->post('https://api.openai.com/v1/chat/completions', [
                    'model' => config('services.openai.model'),
                    'messages' => [
                        ['role' => 'system', 'content' => 'You are a strict JSON extractor.'],
                        ['role' => 'user', 'content' => $prompt],
                    ],
                    'temperature' => 0,
                ]);
        } catch (ConnectException $e) {
            Log::error('OpenAI connection error: ' . $e->getMessage());
            throw new \Exception('Connection error: ' . $e->getMessage());
        }

        if ($response->failed()) {
            Log::error('OpenAI API request failed: ' . $response->body());
            return null;
        }

        $content = data_get($response->json(), 'choices.0.message.content', '{}');

        $data = json_decode($content, true);
        if (!is_array($data)) {
            return new ParsedActorDTO(null, null, null, null, null, null, null);
        }

        $height = isset($data['height']) ? (float)$data['height'] : null;
        $weight = isset($data['weight']) ? (float)$data['weight'] : null;
        $age = isset($data['age']) ? (int)$data['age'] : null;

        return new ParsedActorDTO(
            $data['first_name'] ?? null,
            $data['last_name'] ?? null,
            $data['address'] ?? null,
            $height,
            $weight,
            $data['gender'] ?? null,
            $age
        );
    }

    private function buildPrompt(string $description): string
    {
        return <<<PROMPT
        Extract the following fields from the description and return ONLY JSON (no extra text):
        {
          "first_name": string|null,
          "last_name": string|null,
          "address": string|null,
          "height": number|null, // centimeters
          "weight": number|null, // kilograms
          "gender": "male"|"female"|"non-binary"|null,
          "age": number|null
        }
        If a field is unknown, set it to null.
        Description: "{$description}"
        PROMPT;
    }

}
