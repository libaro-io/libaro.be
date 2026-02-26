<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class ExperienceChatRequest extends FormRequest
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
            'message' => 'required|string|max:500',
            'locale' => 'nullable|string|in:en,nl',
            'history' => 'nullable|array',
            'history.*.role' => 'required|string|in:user,assistant',
            'history.*.content' => 'required|string|max:2000',
        ];
    }
}
