<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class GuestResource extends ResourceCollection
{
    public static $wrap = null;
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return $this->collection->transform(function ($item) {

            return [
                'id' => $item->id,
                'name' => $item->name,
                'program' => $item->program,
                'image_url' => asset('/storage/'.$item->image_url),
                'views' => $item->views,
                'hashtag' => $item->hashtag,
                'video_url' => $item->video_url,
                'video_type' => $item->video_type,
                'created_at' => Carbon::parse($item->created_at)->toDateTimeString(),
                'updated_at' => Carbon::parse($item->updated_at)->toDateTimeString(),
            ];
        })->toArray();
    }
}
