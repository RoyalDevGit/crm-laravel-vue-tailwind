<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Repositories\City\CityRepositoryInterface;
use App\Repositories\Country\CountryRepositoryInterface;
use App\Repositories\District\DistrictRepositoryInterface;
use Illuminate\Support\Facades\Response;


class CountryCityController extends Controller
{
    public $countryRepository;
    public $cityRepository;
    public $districtRepository;

    /**
     * Handle the incoming request.
     *
     * @param CountryRepositoryInterface $countryRepository
     * @param CityRepositoryInterface $cityRepository
     * @param DistrictRepositoryInterface $districtRepository
     */

    public function __construct(CountryRepositoryInterface $countryRepository,CityRepositoryInterface $cityRepository,DistrictRepositoryInterface $districtRepository)
    {
        $this->countryRepository= $countryRepository;
        $this->cityRepository= $cityRepository;
        $this->districtRepository= $districtRepository;
    }

    public function country(): \Illuminate\Http\JsonResponse
    {
        return Response::json($this->countryRepository->all());
    }

    public function city(): \Illuminate\Http\JsonResponse
    {
        $city = $this->cityRepository->all();
        return Response::json($city);
    }

    public function district(int $id): \Illuminate\Http\JsonResponse
    {
        $district = $this->districtRepository->where('city_id',$id)->distinct('ilce')->get();
        return Response::json($district);
    }
}
