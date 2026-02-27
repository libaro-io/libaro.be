<?php

namespace App\Services;

use App\Data\ExperienceChat\ChatAnswerResponse;
use App\Data\ExperienceChat\ChatHistoryTurn;
use App\Enums\ChatConfidence;
use App\Enums\ChatRole;
use App\Models\Project;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use OpenAI\Laravel\Facades\OpenAI;
use Throwable;

class ExperienceChatService
{
    /**
     * @param  array<int, ChatHistoryTurn>  $history
     */
    public function answer(string $message, string $locale = 'en', array $history = []): ChatAnswerResponse
    {
        $evidence = $this->getProjectsForContext();
        $evidenceText = $this->formatEvidence($evidence, $locale);

        $result = $this->callOpenAI($message, $evidenceText, $locale, $history);

        $result['follow_up'] = null;
        $result = $this->ensureLocaleInReferences($result, $locale);
        $result = $this->enrichReferencesWithImage($result, $evidence);

        if (empty($result['references'])) {
            $result['contact_link'] = "/{$locale}/contact";
        }

        return ChatAnswerResponse::fromArray($result);
    }

    /**
     * Format full chat history into a short message for the contact form.
     * Used when the user clicks "Contact" / "Discuss your project" so they don't have to retype.
     *
     * @param  array<int, ChatHistoryTurn>  $history
     */
    public function formatMessageForContact(array $history, string $locale = 'en'): string
    {
        if ($history === []) {
            return '';
        }

        $conversation = collect($history)
            ->map(fn (ChatHistoryTurn $turn) => ($turn->role === 'user' ? 'Visitor' : 'Assistant') . ': ' . $turn->content)
            ->implode("\n");

        $systemPrompt = config('experience-chat.contact_form_format_prompt');
        $userMessage = "Conversation:\n{$conversation}";

        try {
            $response = OpenAI::chat()->create([
                'model' => config('experience-chat.model'),
                'messages' => [
                    ['role' => ChatRole::SYSTEM->value, 'content' => $systemPrompt],
                    ['role' => ChatRole::USER->value, 'content' => $userMessage],
                ],
                'temperature' => 0.3,
                'max_tokens' => config('experience-chat.contact_form_format_max_tokens', 300),
            ]);

            $content = $response->choices[0]->message->content ?? null;

            return $content !== null && $content !== '' ? trim($content) : '';
        } catch (Throwable $e) {
            Log::error('[ExperienceChat] format_for_contact_exception', [
                'exception' => get_class($e),
                'message' => $e->getMessage(),
            ]);

            return '';
        }
    }

    /**
     * Add project image key to each reference (same as project listing/detail).
     * Frontend uses useS3Image(image) with page props S3 prefix.
     *
     * @param  array{answer: string, references: array<int, array{project_name: string, why_relevant: string, link: string, image?: string|null}>, confidence: string, follow_up: string|null}  $result
     * @param  Collection<int, Project>  $evidence
     * @return array{answer: string, references: array<int, array{project_name: string, why_relevant: string, link: string, image?: string|null}>, confidence: string, follow_up: string|null, contact_link?: string}
     */
    private function enrichReferencesWithImage(array $result, Collection $evidence): array
    {
        $projectsBySlug = $evidence->keyBy(fn (Project $p) => strtolower($p->slug));

        foreach ($result['references'] as $i => $ref) {
            $link = $ref['link'];
            $project = null;

            if (preg_match('#/realisaties/([^/]+)#', $link, $m)) {
                $project = $projectsBySlug->get(strtolower($m[1]));
            }

            if (! $project) {
                $refName = strtolower($ref['project_name']);
                $project = $evidence->first(fn (Project $p) => strtolower($p->name) === $refName);
            }

            $result['references'][$i]['image'] = $project?->image;

        }

        return $result;
    }

    /**
     * @return Collection<int, Project>
     */
    private function getProjectsForContext(): Collection
    {
        return Cache::remember('experience_chat_projects', 3600, function () {
            return Project::query()
                ->with('client')
                ->where('visible', true)
                ->orderByDesc('date')
                ->get();
        });
    }

    /**
     * @param  Collection<int, Project>  $projects
     */
    private function formatEvidence(Collection $projects, string $locale = 'en'): string
    {
        if ($projects->isEmpty()) {
            return 'No matching projects found in the database.';
        }

        return $projects->map(function (Project $project) use ($locale) {
            $tags = implode(', ', $project->tags ?? []);
            $desc = mb_substr(strip_tags($project->description ?? ''), 0, 120);

            return "{$project->name}|{$tags}|{$desc}|/{$locale}/realisaties/{$project->slug}";
        })->implode("\n");
    }

    /**
     * Ensure reference links include locale prefix for /realisaties/ and /expertise/ paths.
     *
     * @param  array{answer: string, references: array<int, array{project_name: string, why_relevant: string, link: string, image?: string|null}>, confidence: string, follow_up: string|null}  $result
     * @return array{answer: string, references: array<int, array{project_name: string, why_relevant: string, link: string, image?: string|null}>, confidence: string, follow_up: string|null, contact_link?: string}
     */
    private function ensureLocaleInReferences(array $result, string $locale): array
    {
        $prefix = "/{$locale}";
        foreach ($result['references'] as $i => $ref) {
            $link = $ref['link'];
            if (str_starts_with($link, '/realisaties/') || str_starts_with($link, '/expertise/')) {
                if (! str_starts_with($link, $prefix)) {
                    $result['references'][$i]['link'] = $prefix . $link;
                }
            }
        }

        return $result;
    }

    /**
     * @param  array<int, ChatHistoryTurn>  $history
     * @return array{answer: string, references: array<int, array{project_name: string, why_relevant: string, link: string, image?: string|null}>, confidence: string, follow_up: string|null, contact_link?: string}
     */
    private function callOpenAI(string $message, string $evidence, string $locale = 'en', array $history = []): array
    {
        /** @var array<string, string> $expertises */
        $expertises = config('experience-chat.expertises', []);
        $expertiseLinks = collect($expertises)
            ->map(fn (string $label, string $slug) => "{$label} (/{$locale}/expertise/{$slug})")
            ->implode(', ');
        $partnerships = implode(' ', config('experience-chat.partnerships', []));
        $systemPrompt = config('experience-chat.system_prompt');
        $systemPrompt = str_replace('{{ partnerships }}', $partnerships, $systemPrompt);
        $systemPrompt = str_replace('{{ expertises }}', $expertiseLinks, $systemPrompt);

        $messages = [
            ['role' => ChatRole::SYSTEM->value, 'content' => $systemPrompt],
        ];
        $historyTurns = (int) config('experience-chat.history_turns', 4);
        foreach (array_slice($history, -$historyTurns) as $turn) {
            $role = $turn->role === 'assistant' ? ChatRole::ASSISTANT->value : ChatRole::USER->value;
            $messages[] = ['role' => $role, 'content' => $turn->content];
        }
        $messages[] = ['role' => ChatRole::USER->value, 'content' => "EVIDENCE:\n{$evidence}\n\nQ: {$message}"];

        try {
            $response = OpenAI::chat()->create([
                'model' => config('experience-chat.model'),
                'messages' => $messages,
                'temperature' => config('experience-chat.temperature', 0.2),
                'max_tokens' => config('experience-chat.max_tokens', 400),
                'response_format' => ['type' => 'json_object'],
            ]);
        } catch (Throwable $e) {
            Log::error('[ExperienceChat] openai_exception', [
                'exception' => get_class($e),
                'message' => $e->getMessage(),
            ]);

            return $this->fallbackResponse();
        }

        $content = $response->choices[0]->message->content ?? null;
        $finishReason = $response->choices[0]->finishReason ?? 'unknown';

        if ($content === null || $content === '') {
            Log::error('[ExperienceChat] openai_empty_content', [
                'model' => $response->model,
                'finish_reason' => $finishReason,
            ]);

            return $this->fallbackResponse();
        }

        $parsed = json_decode($content, true);

        if (! is_array($parsed) || ! isset($parsed['answer'])) {
            Log::error('[ExperienceChat] openai_invalid_json', [
                'content_preview' => mb_substr($content, 0, 200),
            ]);

            return $this->fallbackResponse();
        }

        $confidence = ChatConfidence::tryFrom($parsed['confidence'] ?? '') ?? ChatConfidence::LOW;

        return [
            'answer' => (string) $parsed['answer'],
            'references' => array_slice($parsed['references'] ?? [], 0, 3),
            'confidence' => $confidence->value,
            'follow_up' => $parsed['follow_up'] ?? null,
        ];
    }

    /**
     * @return array{answer: string, references: array<int, array{project_name: string, why_relevant: string, link: string, image?: string|null}>, confidence: string, follow_up: string|null, contact_link?: string}
     */
    private function fallbackResponse(): array
    {
        return [
            'answer' => 'I could not process your question. Could you rephrase it?',
            'references' => [],
            'confidence' => ChatConfidence::LOW->value,
            'follow_up' => null,
        ];
    }
}
