<?php

namespace App\Http\Resources;

use App\Models\BroadcasterViewType;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class BroadcasterResource extends ResourceCollection
{

    // without data
    public static $wrap = null;
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return $this->collection->transform(function ($item) {

            $programs = $item->programs;

            return [
                'id' => $item->id,
                'name' => $item->name,
                'image_path' => asset('storage/' . $item->image_path),
                'bio' => $item->bio,
                'programs' => $programs->pluck('name'),
                'instagram_url' => $item->instagram_url,
                'youtube_url' => $item->youtube_url,
                'whatsapp_url' => $item->whatsapp_url,
                'telegram_url' => $item->telegram_url,
                'tiktok_url' => $item->tiktok_url,
                'created_at' => $item->created_at,
                'updated_at' => $item->updated_at,
            ];
        })->toArray();
    }
}
