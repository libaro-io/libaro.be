<?php

return [

    /*
    |--------------------------------------------------------------------------
    | OpenAI API Key
    |--------------------------------------------------------------------------
    |
    | Used to authenticate with the OpenAI API (e.g. experience chat).
    | Get your key at https://platform.openai.com/api-keys
    */
    'api_key' => env('OPENAI_API_KEY'),

    /*
    |--------------------------------------------------------------------------
    | OpenAI Organization (optional)
    |--------------------------------------------------------------------------
    |
    | Set if your API key is scoped to an organization.
    */
    'organization' => env('OPENAI_ORGANIZATION'),

    /*
    |--------------------------------------------------------------------------
    | Base URL & Timeout
    |--------------------------------------------------------------------------
    |
    | Only set OPENAI_BASE_URL for a custom endpoint. Leave unset for default.
    */
    'base_uri' => env('OPENAI_BASE_URL') ?: 'https://api.openai.com/v1',
    'request_timeout' => (int) env('OPENAI_REQUEST_TIMEOUT', 30),

    /*
    |--------------------------------------------------------------------------
    | Chat Model
    |--------------------------------------------------------------------------
    |
    | Model used for experience chat (e.g. gpt-4o-mini).
    */
    'chat_model' => env('OPENAI_CHAT_MODEL', 'gpt-4o-mini'),
];
