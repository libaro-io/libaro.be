<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ShowcaseRequest extends FormRequest
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
            'pin_on_homepage' => 'required|boolean',
            'name' => 'required|unique:showcases,name,' . optional($this->showcase)->id . '|max:255',
            'slug' => 'required|unique:showcases,slug,' . optional($this->showcase)->id . '|max:255',
            'type' => 'required|max:255',
            'client_id' => 'nullable|exists:clients,id',
            'date' => 'nullable|date',
            'description' => 'required',
            'tags' => 'nullable|string',
            'client_url' => 'nullable|max:255|url',
            'image_card' => $this->showcase ? 'image' : 'required|image',
            'image_header' => 'nullable|image',
            'image_extra' => 'nullable|image',
            'image_logo' => 'nullable|image',
        ];
    }
}
