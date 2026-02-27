<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Validated 'history' entries match the shape for \App\Data\ExperienceChat\ChatHistoryTurn::fromArray().
 */
class ExperienceChatFormatRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'locale' => 'nullable|string|in:en,nl',
            'history' => 'required|array|max:50',
            'history.*.role' => 'required|string|in:user,assistant',
            'history.*.content' => 'required|string|max:2000',
        ];
    }
}
