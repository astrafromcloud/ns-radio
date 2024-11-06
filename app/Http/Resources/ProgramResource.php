<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ProgramResource extends ResourceCollection
{
    public static $wrap = null;
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return $this->collection->transform(function($item) {
            $broadcasters = $item->broadcasters;
            $names = $broadcasters->pluck('name')->toArray();
            return [
                'id' => $item->id,
                'name' => $item->name,
                'from' => $item->from,
                'to' => $item->to,
                'broadcasters_name' => $names,
                'image' => asset('/storage/' . $item->image),
            ];
        })->toArray();
    }
}
