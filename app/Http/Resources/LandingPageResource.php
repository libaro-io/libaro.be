<?php

namespace App\Http\Resources;

use App\Models\LandingPage;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin LandingPage
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
            'slug' => $this->slug,
            'skill' => $this->skill,
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
