<?php

namespace App\Http\Resources;

use App\Models\Broadcaster;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ProgramResource extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return $this->collection->transform(function($item) {
            return [
                'id' => $item->id,
                'name' => $item->name,
                'from' => $item->from,
                'to' => $item->to,
                'broadcaster_name' => optional(Broadcaster::find($item->broadcaster_id))->name,
                'image' => asset('/storage/' . $item->image),
            ];
        })->toArray();
    }
}
