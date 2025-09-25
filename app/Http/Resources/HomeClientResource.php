<?php

namespace App\Http\Resources;

use App\Models\Client;
use Illuminate\Http\Resources\Json\JsonResource;
use Spatie\MediaLibrary\InteractsWithMedia;

/**
 * @mixin Client
 */
class HomeClientResource extends JsonResource
{
    use InteractsWithMedia;
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray($request){
        return [
            'id' => $this->id,
            'name' => $this->name,
            'image' => 'https://placehold.co/400x600',
        ];
    }
}
