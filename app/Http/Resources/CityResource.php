<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Facades\App;


class CityResource extends ResourceCollection
{
    public function toArray(Request $request): array
    {
        return $this->collection->transform(function ($item) {
            $locale = App::getLocale();

            if (!in_array($locale, ['ru', 'kk'])) {
                $locale = 'ru';
            }

            $name = $item->getTranslation('name', $locale);

            return [
                'name' => $name,
                'frequency' => $item->frequency,
            ];
        })->toArray(); // Convert the collection to an array
    }
}

