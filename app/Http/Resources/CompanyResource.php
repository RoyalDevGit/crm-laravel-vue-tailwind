<?php

namespace App\Http\Resources;

use Epigra\TrGeoZones\Models\Country;
use Illuminate\Http\Resources\Json\JsonResource;

class CompanyResource extends JsonResource
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
            'company_name' => $this->company_name,
            'company_address' => $this->company_address,
            'company_main_country' => $this->company_main_country,
            'company_country' => $this->company_country,
            'company_city' => $this->company_city,
            'company_phone' => $this->company_phone,
            'company_author' => $this->company_author,
            'company_web_site' => $this->company_web_site,
            'tax_number' => $this->tax_number,
            'sector' => $this->sector,
            'field' => $this->field,
            'potential_fleet' => $this->potential_fleet,
            'is_active' => $this->is_active,
            'customer_type_id' => $this->customer_type_id,
            'status_id' => $this->status_id,
            'size_code_id' => $this->size_code_id,
            /*'user' => new UserResource($this->user),
            'status' => new StatusResource($this->status),
            'customer_type' => new CustomerTypeResource($this->customerType),
            'size_code' => new SizeCodeResource($this->sizeCode),*/
        ];
    }
}
