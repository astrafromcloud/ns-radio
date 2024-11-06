<?php

namespace App\Http\Resources;

use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class BannerResource extends ResourceCollection
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
                'content' => asset('storage/' . $item->content),
            ];
        })->toArray();
    }
}
