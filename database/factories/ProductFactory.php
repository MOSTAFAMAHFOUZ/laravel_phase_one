<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->title(),
            'category_id' => Category::all()->random(1)->first()->id,
            'description' => $this->faker->sentence(),
            'price' => $this->faker->buildingNumber,
            'qty' => $this->faker->buildingNumber,
            'image' => rand(1,20).".jpg",
        ];
    }
}
