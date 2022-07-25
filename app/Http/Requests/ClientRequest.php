<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClientRequest extends FormRequest
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
            'name' => 'required|unique:clients,name,' . optional($this->client)->id . '|max:255',
            'weight' => 'required|integer',
            'logo' => $this->client ? 'image' : 'image|required'
        ];
    }

}
