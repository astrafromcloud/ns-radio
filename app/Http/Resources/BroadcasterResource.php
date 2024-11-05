<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BroadcasterResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'image_path' => asset('storage/' . $this->image_path),
            'bio' => $this->bio,
            'instagram_url' => $this->instagram_url,
            'youtube_url' => $this->youtube_url,
            'whatsapp_url' => $this->whatsapp_url,
            'telegram_url' => $this->telegram_url,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
