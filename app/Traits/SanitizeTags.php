<?php

namespace App\Traits;

trait SanitizeTags
{
    /**
     * Sanitize the given string of tags
     * Remove all empty strings
     * Trim each string
     *
     * @param $tags
     * @return array
     */
    protected function sanitizeTags($tags): array
    {
        $tags = explode(',', $tags);

        $tags = array_filter($tags, function ($tag) {
            return ! empty(trim($tag));
        });

        return array_map('trim', $tags);
    }
}
