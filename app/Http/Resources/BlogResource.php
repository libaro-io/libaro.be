<?php

namespace App\Http\Resources;

use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin Blog
 */
class BlogResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'title' => $this->title,
            'description' => $this->description,
            'slug' => $this->slug,
            'date' => $this->publish_date?->translatedFormat('j F, Y'),
            'tags' => $this->tags,
            'link' => $this->link,
            'author' => $this->author,
            'image' => $this->image,
            'blocks' => BlockResource::collection($this->whenLoaded('blocks')),
        ];
    }
}
