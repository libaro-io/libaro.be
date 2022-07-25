<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ArticleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'visible' => 'required|boolean',
            'author' => 'nullable|string|max:255',
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:articles,slug,' . optional($this->article)->id,
            'tags' => 'nullable|string',
            'body' => 'required|string',
            'link' => 'nullable|url|max:255',
            'publish_date' => 'nullable|date',
            'image_1' => 'nullable|image',
            'image_2' => 'nullable|image'
        ];
    }
}
