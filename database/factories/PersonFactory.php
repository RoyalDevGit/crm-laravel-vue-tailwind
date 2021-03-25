<?php

namespace Database\Factories;

use App\Models\Company;
use App\Models\Mod;
use App\Models\Person;
use App\Models\User;
use Epigra\TrGeoZones\Models\City;
use Epigra\TrGeoZones\Models\CityDistrict;
use Epigra\TrGeoZones\Models\Country;
use Illuminate\Database\Eloquent\Factories\Factory;

class PersonFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Person::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'person_first_name' => $this->faker->firstName,
            'person_last_name' => $this->faker->lastName,
            'person_gender' => $this->faker->randomElement(['Erkek','Kadın']),
            'person_title' => $this->faker->title,
            'person_department' => $this->faker->company,
            'person_email' => $this->faker->companyEmail,
            'person_phone' => $this->faker->phoneNumber,
            'person_phone2' => $this->faker->phoneNumber,
            'preferred_contact' => $this->faker->firstName ." ". $this->faker->lastName,
            'mod_id' => Mod::all()->random()->id,
            'skype' => $this->faker->safeEmail,
            'address' => $this->faker->address,
            'person_countries' => Country::all()->random()->id,
            'companies_id' => Company::all()->random()->id,
            'user_id' => User::all()->random()->id,
            'person_cities' => City::all()->random()->id,
            'person_district' => CityDistrict::all()->random()->id,
            'is_active' => $this->faker->randomElement([0,1]),
        ];
    }
}
