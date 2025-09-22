<?php

namespace App\Http\Resources;

use App\Filament\FilamentBlockType;
use App\Models\ProjectBlock;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin ProjectBlock
 */
class ProjectBlockResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'type' => FilamentBlockType::tryFrom($this->type),
            'data' => $this->content,
        ];
    }
}
