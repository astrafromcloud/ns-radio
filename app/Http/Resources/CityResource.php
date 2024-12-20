<?php
//
//namespace App\Http\Resources;
//
//use App\Models\City;
//use Illuminate\Http\Request;
//use Illuminate\Http\Resources\Json\ResourceCollection;
//use Illuminate\Support\Facades\App;
//
//
//class CityResource extends ResourceCollection
//{
//
//    public static $wrap = null;
//    public function toArray(Request $request): array
//    {
//        return $this->collection->transform(function ($item) {
//            $cities = City::all();
//            $locale = app()->getLocale();
//
////            if (!in_array($locale, ['ru', 'kk'])) {
////                $locale = 'ru';
////            }
//
//            $data = $cities->map(function ($city) use ($locale) {
//                return [
//                    'name' => $city->getTranslation('name', $locale),
//                    'frequency' => $city->frequency
//                ];
//            });
//
//            return response()->json($data);
//        })->toArray(); // Convert the collection to an array
//    }
//}
//


namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CityResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'name' => $this['name'],
            'weather' => $this['weather'][0] ?? null,
            'conditions' => $this['weather'][1] ?? null,
            'frequency' => $this['frequency'],
        ];
    }
}
