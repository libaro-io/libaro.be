<?php

namespace App\Services;

use App\Enums\ChatConfidence;
use App\Enums\ChatRole;
use App\Models\Project;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use OpenAI\Laravel\Facades\OpenAI;

class ExperienceChatService
{
    /**
     * @param  array<int, array{role: string, content: string}>  $history
     * @return array{answer: string, references: array<int, array{project_name: string, why_relevant: string, link: string}>, confidence: string, follow_up: string|null}
     */
    public function answer(string $message, string $locale = 'en', array $history = []): array
    {
        $evidence = $this->getProjectsForContext();
        $evidenceText = $this->formatEvidence($evidence, $locale);

        $beforeApi = microtime(true);
        $result = $this->callOpenAI($message, $evidenceText, $locale, $history);
        
        $result['follow_up'] = null;
        $result = $this->ensureLocaleInReferences($result, $locale);
        $result = $this->enrichReferencesWithImage($result, $evidence);

        if (empty($result['references'])) {
            $result['contact_link'] = "/{$locale}/contact";
        }

        return $result;
    }

    /**
     * Add project image key to each reference (same as project listing/detail).
     * Frontend uses useS3Image(image) with page props S3 prefix.
     *
     * @param  array{answer: string, references: array<int, array{project_name: string, why_relevant: string, link: string}>, confidence: string, follow_up: string|null}  $result
     * @param  Collection<int, Project>  $evidence
     * @return array{answer: string, references: array<int, array{project_name: string, why_relevant: string, link: string, image?: string|null}>, confidence: string, follow_up: string|null}
     */
    private function enrichReferencesWithImage(array $result, Collection $evidence): array
    {
        $projectsBySlug = $evidence->keyBy(fn (Project $p) => strtolower($p->slug));

        foreach ($result['references'] as $i => $ref) {
            $link = $ref['link'] ?? '';
            $project = null;

            if (preg_match('#/realisaties/([^/]+)#', $link, $m)) {
                $project = $projectsBySlug->get(strtolower($m[1]));
            }

            if (! $project) {
                $refName = strtolower($ref['project_name'] ?? '');
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
            $tags = is_array($project->tags) ? implode(', ', $project->tags) : ($project->tags ?? '');
            $desc = mb_substr(strip_tags($project->description ?? ''), 0, 120);

            return "{$project->name}|{$tags}|{$desc}|/{$locale}/realisaties/{$project->slug}";
        })->implode("\n");
    }

    /**
     * Ensure reference links include locale prefix for /realisaties/ and /expertise/ paths.
     *
     * @param  array{answer: string, references: array<int, array{project_name: string, why_relevant: string, link: string}>, confidence: string, follow_up: string|null}  $result
     * @return array{answer: string, references: array<int, array{project_name: string, why_relevant: string, link: string}>, confidence: string, follow_up: string|null}
     */
    private function ensureLocaleInReferences(array $result, string $locale): array
    {
        $prefix = "/{$locale}";
        foreach ($result['references'] as $i => $ref) {
            $link = $ref['link'] ?? '';
            if (str_starts_with($link, '/realisaties/') || str_starts_with($link, '/expertise/')) {
                if (! str_starts_with($link, $prefix)) {
                    $result['references'][$i]['link'] = $prefix . $link;
                }
            }
        }

        return $result;
    }

    /**
     * @param  array<int, array{role: string, content: string}>  $history
     * @return array{answer: string, references: array<int, array{project_name: string, why_relevant: string, link: string}>, confidence: string, follow_up: string|null}
     */
    private function callOpenAI(string $message, string $evidence, string $locale = 'en', array $history = []): array
    {
        $expertises = implode(', ', [
            "Web Development (/{$locale}/expertise/web-development)",
            "AI Integrations (/{$locale}/expertise/ai-integrations)",
            "Apps (/{$locale}/expertise/apps)",
            "IoT (/{$locale}/expertise/iot)",
            "Odoo ERP (/{$locale}/expertise/odoo)",
            "Robaws ERP (/{$locale}/expertise/robaws)",
        ]);

        $systemPrompt = <<<PROMPT
You are Libaro's assistant on their website. Libaro is a Belgian software company in Brugge that builds custom digital solutions: web apps, mobile apps, AI integrations, IoT, Odoo ERP, and Robaws ERP integrations.

Your job: answer the visitor's question by matching it to Libaro's real project experience and expertises. Be helpful, direct, and confident when the EVIDENCE supports it.

LIBARO EXPERTISES: {$expertises}

EVIDENCE is a list of real Libaro projects, one per line: name|tags|description|link.
- Search ALL fields (name, tags, AND description) for relevance. A project about "Robaws" may only mention it in the description.
- Only reference projects from the EVIDENCE. Never invent projects.
- You may also reference an expertise page if the question matches an expertise area.
- Max 3 references. Pick the most relevant ones.

If no matching projects exist: say Libaro builds custom software and can help, but has no matching project in the portfolio yet. Leave references [].

CRITICAL RULES:
- Respond in the EXACT same language as the user's question.
- Keep answer to 1-3 sentences. No fluff, no follow-up questions.
- Never invent clients, dates, metrics, or project names.
- set follow_up to null always.

JSON only:
{"answer":"string","references":[{"project_name":"string","why_relevant":"string","link":"string"}],"confidence":"low|medium|high","follow_up":null}
PROMPT;

        $model = config('openai.chat_model', 'gpt-4o-mini');
        $messages = [
            ['role' => ChatRole::SYSTEM->value, 'content' => $systemPrompt],
        ];
        foreach (array_slice($history, -6) as $turn) {
            $role = $turn['role'] === 'assistant' ? ChatRole::ASSISTANT->value : ChatRole::USER->value;
            $messages[] = ['role' => $role, 'content' => $turn['content']];
        }
        $messages[] = ['role' => ChatRole::USER->value, 'content' => "EVIDENCE:\n{$evidence}\n\nQ: {$message}"];

        try {
            $response = OpenAI::chat()->create([
                'model' => $model,
                'messages' => $messages,
                'temperature' => 0.2,
                'max_tokens' => 350,
                'response_format' => ['type' => 'json_object'],
            ]);
        } catch (\Throwable $e) {
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
            'answer' => (string) ($parsed['answer'] ?? ''),
            'references' => array_slice($parsed['references'] ?? [], 0, 3),
            'confidence' => $confidence->value,
            'follow_up' => $parsed['follow_up'] ?? null,
        ];
    }

    /**
     * @return array{answer: string, references: array<int, array{project_name: string, why_relevant: string, link: string}>, confidence: string, follow_up: string|null}
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
