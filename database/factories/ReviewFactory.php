<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Review>
 */
class ReviewFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "product_id" => function(){
                return \App\Models\Product::all()->random();
            },
            "customer" => $this->faker->name,
            "review" => $this->faker->paragraph,
            "star" => $this->faker->numberBetween(0,5)
        ];
    }
}
