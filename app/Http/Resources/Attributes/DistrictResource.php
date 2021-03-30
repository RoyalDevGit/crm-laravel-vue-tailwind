<?php

namespace App\Http\Resources\Attributes;

use Illuminate\Http\Resources\Json\JsonResource;

class DistrictResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id ' => $this->id,
            'city_id' => $this->city_id,
            'ilce' => $this->ilce,
        ];
    }
}
