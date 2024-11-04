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
                'image_url' => $item->image_url ? asset('storage/'.$item->image_url) : null,
                'video_url' => $item->video_url ? asset('storage/'.$item->video_url) : null,
                'description' => $item->description,
            ];
        })->toArray();
    }
}
