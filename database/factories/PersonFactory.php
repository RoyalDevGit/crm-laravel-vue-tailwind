<?php

namespace Database\Factories;

use App\Models\Company;
use App\Models\Person;
use App\Models\User;
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
            'person_name' => $this->faker->name,
            'companies_id' => Company::all()->random()->id,
            'person_email' => $this->faker->companyEmail,
            'person_phone' => $this->faker->phoneNumber,
            'user_id' => User::all()->random()->id,
            'is_active' => $this->faker->randomElement([0,1]),
        ];
    }
}
