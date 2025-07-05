<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class DeveloperCollection extends ResourceCollection
{
    /** 
     * Transform the resource collection into an array.
    */
    public function toArray($request): array
    {
        return $this->collection->map(function ($developer) {
            return new DeveloperResource($developer);
        })->toArray();
    }
}
