<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ContactResource extends ResourceCollection
{
    public static $wrap = null;
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return $this->collection->transform(function ($contact) {
            return [
                'phones' => $contact->phones,
                'description' => $contact->description,
                'address' => $contact->address,
                'email' => $contact->email,
                'instagram_url' => $contact->instagram_url,
                'youtube_url' => $contact->youtube_url,
                'whatsapp_url' => $contact->whatsapp_url,
                'telegram_url' => $contact->telegram_url,
                'tiktok_url' => $contact->tiktok_url,
            ];
        })->toArray();
    }
}
