<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/*
 * @mixin \App\Models\LandingPage
 */
class LandingPageResource extends JsonResource
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
            'block' => [
                'title' => $this->text1,
                'subtitle' => trans('landing.expertise'),
                'text' => $this->text2,
                'image_index' => $this->image_index,
            ],
            'projects' => ProjectResource::collection($this->whenLoaded('projects')),
        ];
    }
}
