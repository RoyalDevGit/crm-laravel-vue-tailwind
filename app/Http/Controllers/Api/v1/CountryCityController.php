<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Repositories\City\CityRepositoryInterface;
use App\Repositories\Country\CountryRepositoryInterface;
use Illuminate\Support\Facades\Response;


class CountryCityController extends Controller
{
    public $countryRepository;
    public $cityRepository;

    /**
     * Handle the incoming request.
     *
     * @param CountryRepositoryInterface $countryRepository
     */

    public function __construct(CountryRepositoryInterface $countryRepository,CityRepositoryInterface $cityRepository)
    {
        $this->countryRepository= $countryRepository;
        $this->cityRepository= $cityRepository;
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
}
