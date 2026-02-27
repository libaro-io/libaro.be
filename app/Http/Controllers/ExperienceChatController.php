<?php

namespace App\Http\Controllers;

use App\Data\ExperienceChat\ChatAnswerResponse;
use App\Data\ExperienceChat\ChatHistoryTurn;
use App\Enums\ChatConfidence;
use App\Http\Requests\ExperienceChatFormatRequest;
use App\Http\Requests\ExperienceChatRequest;
use App\Services\ExperienceChatService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Throwable;

class ExperienceChatController extends Controller
{
    public function __invoke(ExperienceChatRequest $request, ExperienceChatService $service): JsonResponse
    {
        try {
            $locale = $this->resolveLocale($request->validated('locale'));
            $history = $this->parseHistory($request->validated('history', []));
            $result = $service->answer($request->validated('message'), $locale, $history);

            return response()->json($result->toArray());
        } catch (Throwable $e) {
            Log::error('[ExperienceChat] FAILED', [
                'exception' => get_class($e),
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString(),
            ]);

            $fallback = ChatAnswerResponse::fromArray([
                'answer' => 'Sorry, something went wrong. Please try again in a moment.',
                'references' => [],
                'confidence' => ChatConfidence::LOW->value,
                'follow_up' => null,
            ]);

            return response()->json($fallback->toArray(), 500);
        }
    }

    public function formatForContact(ExperienceChatFormatRequest $request, ExperienceChatService $service): JsonResponse
    {
        $locale = $this->resolveLocale($request->validated('locale'));
        $history = $this->parseHistory($request->validated('history'));
        $message = $service->formatMessageForContact($history, $locale);

        return response()->json(['message' => $message]);
    }

    /**
     * @param  array<int, array{role: string, content: string}>  $raw  Validated request history
     * @return array<int, ChatHistoryTurn>
     */
    private function parseHistory(array $raw): array
    {
        return array_map(fn (array $turn): ChatHistoryTurn => ChatHistoryTurn::fromArray($turn), $raw);
    }

    private function resolveLocale(?string $locale): string
    {
        $locale = $locale ?? request()->segment(1) ?? app()->getLocale();

        return in_array($locale, ['en', 'nl'], true) ? $locale : 'en';
    }
}
