<?php

namespace App\Http\Resources;

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
            'person_name' => $this->person_name,
            'companies' => new CompanyResource($this->companies),
            'person_email' => $this->person_email,
            'person_phone' => $this->person_phone,
            'user' => new UserResource($this->user),
            'is_active' => $this->is_active,
        ];
    }
}
