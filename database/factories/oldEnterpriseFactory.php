<?php

namespace Database\Factories;

use App\Models\Enterprise;
use Illuminate\Database\Eloquent\Factories\Factory;

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
        /*
        lexify - takes given string and replaces ? with random letters
        asciify - takes given string and replaces * with random ascii characters
        numerify - takes given string and replaces # with random digits
        bothify - combines the lexify and numerify
        $this->faker->text()
        $this->faker->word()
        $this->faker->name()
        $this->faker->address()
        Str::random(20)
        $total = App\Type::all()->count();
        $faker->numberBetween(1, $total)
        $faker->randomFloat(2, 10, 150)
        date("Y-m-d H:i:s")
        substr($this->faker->text(), 1, 20)
        */
        return [
            'name' => $this->faker->name(),
            'phone' => $this->faker->numerify('#########'), //Str::random(15),
            'contactperson' => $this->faker->word() . ' ' . $this->faker->word(),
            'address' => $this->faker->address(),
            'taxnumber' => $this->faker->regexify('[A-Z]{1}[0-9]{8}'),
        ];
    }
}
