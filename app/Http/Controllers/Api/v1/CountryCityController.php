<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use Epigra\TrGeoZones\Models\City;
use Epigra\TrGeoZones\Models\Country;
use Illuminate\Http\Request;

class CountryCityController extends Controller
{
    public function country(){
        return response()->json(Country::all());
    }

    public function city(){
        $city = City::all();
        return response()->json($city);
    }
}
