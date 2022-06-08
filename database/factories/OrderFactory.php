<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'user_id' => function(){
                return \App\Models\User::all()->random();
            },
            'customerName' => $this->faker->firstNameMale,
            'customerLastName' => $this->faker->lastName,
            'customerEmail' => $this->faker->email,
            'customerPhone' => $this->faker->phoneNumber,
            'customerAddress' => $this->faker->address,
            'comment' => $this->faker->paragraph,
            'total' => $this->faker->randomFloat(2, 1.00, 999.00),
        ];
    }
}
