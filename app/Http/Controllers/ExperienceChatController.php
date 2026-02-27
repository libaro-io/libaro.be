<?php

namespace App\Http\Controllers;

use App\Enums\ChatConfidence;
use App\Http\Requests\ExperienceChatRequest;
use App\Services\ExperienceChatService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;

class ExperienceChatController extends Controller
{
    public function __invoke(ExperienceChatRequest $request, ExperienceChatService $service): JsonResponse
    {
        try {
            $locale = $request->validated('locale')
                ?? $request->segment(1)
                ?? app()->getLocale();
            if (! in_array($locale, ['en', 'nl'], true)) {
                $locale = 'en';
            }

            $history = $request->validated('history', []);
            $result = $service->answer($request->validated('message'), $locale, $history);

            return response()->json($result);
        } catch (\Throwable $e) {
            Log::error('[ExperienceChat] FAILED', [
                'exception' => get_class($e),
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString(),
            ]);

            return response()->json([
                'answer' => 'Sorry, something went wrong. Please try again in a moment.',
                'references' => [],
                'confidence' => ChatConfidence::LOW->value,
                'follow_up' => null,
            ], 500);
        }
    }
}
