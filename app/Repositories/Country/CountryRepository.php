<?php

namespace App\Repositories\Country;

use Epigra\TrGeoZones\Models\Country;

class CountryRepository implements CountryRepositoryInterface
{
    public $model;

    public function __construct(Country $country)
    {
        $this->model = $country;
    }

    public function all()
    {
        return $this->model->all();
    }
}
