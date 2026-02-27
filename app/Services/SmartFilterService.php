<?php

namespace App\Services;

use App\Enums\ChatRole;
use Illuminate\Support\Facades\Log;
use OpenAI\Laravel\Facades\OpenAI;
use Throwable;

class SmartFilterService
{
    public function __construct(
        private readonly ExperienceChatService $experienceChatService
    ) {}

    /**
     * @return array{slugs: array<int, string>, summary: string}
     */
    public function filter(string $message, string $locale = 'en'): array
    {
        $evidence = $this->experienceChatService->getProjectsForContext();
        $descriptionMaxLength = config('experience-chat.smart_filter_description_max_length', 600);
        $evidenceText = $this->experienceChatService->formatEvidence($evidence, $locale, $descriptionMaxLength);

        $systemPrompt = config('experience-chat.smart_filter_prompt');
        $userContent = "EVIDENCE:\n{$evidenceText}\n\nUSER REQUEST: {$message}";

        try {
            $response = OpenAI::chat()->create([
                'model' => config('openai.chat_model'),
                'messages' => [
                    ['role' => ChatRole::SYSTEM->value, 'content' => $systemPrompt],
                    ['role' => ChatRole::USER->value, 'content' => $userContent],
                ],
                'temperature' => 0.2,
                'max_tokens' => (int) config('experience-chat.smart_filter_max_tokens', 200),
                'response_format' => ['type' => 'json_object'],
            ]);
        } catch (Throwable $e) {
            Log::error('[SmartFilter] openai_exception', [
                'exception' => get_class($e),
                'message' => $e->getMessage(),
            ]);

            return $this->fallbackResponse();
        }

        $content = $response->choices[0]->message->content ?? null;
        if ($content === null || $content === '') {
            return $this->fallbackResponse();
        }

        $parsed = json_decode($content, true);
        if (! is_array($parsed) || ! isset($parsed['slugs']) || ! isset($parsed['summary'])) {
            Log::warning('[SmartFilter] invalid_json', ['content_preview' => mb_substr($content, 0, 200)]);

            return $this->fallbackResponse();
        }

        $slugs = is_array($parsed['slugs']) ? array_values(array_filter($parsed['slugs'], 'is_string')) : [];

        return [
            'slugs' => $slugs,
            'summary' => (string) $parsed['summary'],
        ];
    }

    /**
     * @return array{slugs: array<int, string>, summary: string}
     */
    private function fallbackResponse(): array
    {
        return [
            'slugs' => [],
            'summary' => '',
        ];
    }
}
