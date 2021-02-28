<?php

namespace App\Repositories\City;

use Epigra\TrGeoZones\Models\City;

class CityRepository implements CityRepositoryInterface
{
    public $model;

    public function __construct(City $city)
    {
        $this->model = $city;
    }

    public function all()
    {
        return $this->model->all();
    }
}
