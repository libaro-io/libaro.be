<?php

namespace App\Http\Resources;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin Project
 */
class ProjectResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'slug' => $this->slug,
            'name' => $this->name,
            'description' => $this->description,
            'type' => $this->projectType ? $this->projectType->getTranslatedName() : $this->getAttribute('type'),
            'is_product' => $this->is_product,
            'preview_image' => $this->preview_image,
            'carousel_images' => $this->carousel_images ?? [],
            'client' => ClientResource::make($this->whenLoaded('client')),
            'client_url' => $this->client_url,
            'tags' => collect($this->tags)
                ->reject(fn ($tag) => $this->projectType && $tag->slug['nl'] === $this->projectType->slug)
                ->map(fn ($tag) => $tag->getTranslatedName())
                ->values()
                ->all(),
            'blocks' => BlockResource::collection($this->whenLoaded('blocks')),
        ];
    }
}
