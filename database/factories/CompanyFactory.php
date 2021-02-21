<?php

namespace Database\Factories;

use App\Models\Company;
use App\Models\CustomerType;
use App\Models\SizeCode;
use App\Models\Status;
use App\Models\User;
use Epigra\TrGeoZones\Models\City;
use Epigra\TrGeoZones\Models\Country;
use Illuminate\Database\Eloquent\Factories\Factory;

class CompanyFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Company::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'company_name' => $this->faker->company,
            'company_address' => $this->faker->address,
            'company_main_country' => Country::all()->random()->id,
            'company_country' => Country::all()->random()->id,
            'company_city' => City::all()->random()->id,
            'company_phone' => $this->faker->phoneNumber,
            'company_author' => $this->faker->name,
            'company_web_site' => $this->faker->url,
            'tax_number' => $this->faker->randomNumber(),
            'sector' => $this->faker->companySuffix,
            'field' => null,
            'potential_fleet' => $this->faker->numberBetween(1,500),
            'is_active' => $this->faker->randomElement([0,1]),
            'user_id' => User::all()->random()->id,
            'status_id' => Status::all()->random()->id,
            'customer_type_id' => CustomerType::all()->random()->id,
            'size_code_id' => SizeCode::all()->random()->id,
        ];
    }
}
