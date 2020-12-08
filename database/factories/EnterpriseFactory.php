<?php

namespace Database\Factories;

use App\Models\Enterprise;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class EnterpriseFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Enterprise::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->regexify('[A-Z]{1}[a-z]{4}') . ' ' . $this->faker->regexify('[A-Z]{1}[a-z]{6}'), //Str::random(6) .  ' ' . Str::random(9), //$this->faker->unique()->word(),
            'phone' => $this->faker->numerify('958######'),
            'contactperson' => $this->faker->name(),
            'address' => $this->faker->address(),
            'taxnumber' => $this->faker->regexify('[A-Z]{1}[0-9]{8}'),
        ];
    }
}
