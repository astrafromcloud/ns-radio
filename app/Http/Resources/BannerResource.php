<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class BannerResource extends ResourceCollection
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return $this->collection->transform(function ($item) {
            return [
                'image_url' => asset('storage/'.$item->image_url),
                'video_url' => asset('storage/'.$item->video_url),
                'description' => $item->description,
            ];
        })->toArray();
    }
}
