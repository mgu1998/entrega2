<?php

namespace Database\Factories;

use App\Models\Enterprise;
use App\Models\Ticket;
use Illuminate\Database\Eloquent\Factories\Factory;

class TicketFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Ticket::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $total = Enterprise::all()->count();
        $valor = rand(0, 100);
        if($valor > 69) {
            $valor = 1;
        } else {
            $valor = 0;
        }
        return [
            'identerprise' => $this->faker->numberBetween(1, $total),
            'name' => $this->faker->unique()->word(),
            'price' => $this->faker->randomFloat(2, 2, 100),
            'initialdate' => date("Y-m-d"),
            'finaldate' => date("Y-m-d"),
            'initialtime' => date("H:i:s"),
            'finaltime' => date("H:i:s"),
            'description' => $this->faker->paragraph,
            'active' => rand(0, 100) > 69 ? 1 : 0, //ternario
        ];
    }
}
