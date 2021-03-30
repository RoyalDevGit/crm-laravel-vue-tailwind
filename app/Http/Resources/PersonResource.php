<?php

namespace App\Http\Resources;

use App\Http\Resources\Attributes\CitiesResource;
use App\Http\Resources\Attributes\CountriesResource;
use App\Http\Resources\Attributes\DistrictResource;
use Illuminate\Http\Resources\Json\JsonResource;

class PersonResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'person_first_name' => $this->person_first_name,
            'person_last_name' => $this->person_last_name,
            'person_gender' => $this->person_gender,
            'person_title' => $this->person_title,
            'person_department' => $this->person_department,
            'person_email' => $this->person_email,
            'person_phone' => $this->person_phone,
            'person_phone2' => $this->person_phone2,
            'preferred_contact' => $this->preferred_contact,
            'skype' => $this->skype,
            'social_media' => $this->social_media,
            'lead_source' => $this->lead_source,
            'address' => $this->address,
            'mod_id' => $this->mod->id,
            'mod' => $this->mod,
            'companies_id' => $this->companies->id,
            'person_countries' => $this->person_countries,
            'person_cities' => $this->person_cities,
            'person_district' => $this->person_district,
            'is_active' => $this->is_active,
        ];
    }
}
