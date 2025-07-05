<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DeveloperResource extends JsonResource
{
    /** 
     * Transform the resource into an array.
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'nickname' => $this->nickname,
            'name' => $this->name,
            'birth_date' => $this->birth_date->format('Y-m-d'),
            'stack' => $this->stacks->isNotEmpty() 
                ? $this->stacks->pluck('name')->toArray() 
                : null,
        ];
    }
}
