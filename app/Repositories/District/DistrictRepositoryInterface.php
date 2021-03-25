<?php

namespace App\Repositories\District;

interface DistrictRepositoryInterface {

    public function all();

    public function where($field,$value);

    public function get();

    public function distinct($value);
}
