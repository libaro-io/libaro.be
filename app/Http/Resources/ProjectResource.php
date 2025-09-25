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
            'type' => $this->type,
            'image' => $this->image,
            'client' => ClientResource::make($this->whenLoaded('client')),
            'tags' => $this->tags,
            'blocks' => BlockResource::collection($this->whenLoaded('blocks')),
        ];
    }
}
