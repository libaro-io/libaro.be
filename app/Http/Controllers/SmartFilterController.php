<?php

namespace App\Http\Controllers;

use App\Http\Requests\SmartFilterRequest;
use App\Services\SmartFilterService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Throwable;

class SmartFilterController extends Controller
{
    public function __invoke(SmartFilterRequest $request, SmartFilterService $service): JsonResponse
    {
        try {
            $locale = $this->resolveLocale($request->validated('locale'));
            $result = $service->filter($request->validated('message'), $locale);

            return response()->json($result);
        } catch (Throwable $e) {
            Log::error('[SmartFilter] FAILED', [
                'exception' => get_class($e),
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
            ]);

            return response()->json([
                'slugs' => [],
                'summary' => '',
            ], 500);
        }
    }

    private function resolveLocale(?string $locale): string
    {
        $locale = $locale ?? request()->segment(1) ?? app()->getLocale();

        return in_array($locale, ['en', 'nl'], true) ? $locale : 'en';
    }
}
