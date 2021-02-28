<?php

namespace App\Providers;

use App\Repositories\City\CityRepositoryInterface;
use App\Repositories\Company\CompanyRepository;
use App\Repositories\Company\CompanyRepositoryInterface;
use App\Repositories\City\CityRepository;
use App\Repositories\Country\CountryRepository;
use App\Repositories\Country\CountryRepositoryInterface;
use App\Repositories\CustomerType\CustomerTypeRepository;
use App\Repositories\CustomerType\CustomerTypeRepositoryInterface;
use App\Repositories\SizeCode\SizeCodeRepository;
use App\Repositories\SizeCode\SizeCodeRepositoryInterface;
use App\Repositories\Status\StatusRepository;
use App\Repositories\Status\StatusRepositoryInterface;
use App\Repositories\User\UserRepository;
use App\Repositories\User\UserRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // Company Repository
        $this->app->bind(UserRepositoryInterface::class,UserRepository::class);
        $this->app->bind(CompanyRepositoryInterface::class,CompanyRepository::class);
        $this->app->bind(CustomerTypeRepositoryInterface::class,CustomerTypeRepository::class);
        $this->app->bind(SizeCodeRepositoryInterface::class,SizeCodeRepository::class);
        $this->app->bind(StatusRepositoryInterface::class,StatusRepository::class);
        $this->app->bind(CountryRepositoryInterface::class,CountryRepository::class);
        $this->app->bind(CityRepositoryInterface::class,CityRepository::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
