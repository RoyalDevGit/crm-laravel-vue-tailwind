<?php

namespace App\Repositories\District;

use Epigra\TrGeoZones\Models\CityDistrict;

class DistrictRepository implements DistrictRepositoryInterface
{
    public $model;

    public function __construct(CityDistrict $district)
    {
        $this->model = $district;
    }

    public function all()
    {
        return $this->model->all();
    }
    public function where($field , $value){
        return $this->model->where($field,$value);
    }
    public function get(){
        return $this->model->get();
    }

    public function distinct($value){
        return $this->model->distinct($value);
    }
}
