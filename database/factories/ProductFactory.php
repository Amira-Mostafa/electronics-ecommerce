<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // $type = fake()->randomElement($productSuffix);
        // $name = $type == 'I' ? fake()->name() : fake()->company(); //if the faker char is I it's gonna print a person name, otherwise a companyname

        $productSuffix = ['Glasses', 'Shirt', 'Sweater', 'Pants', 'Shoes', 'Hats'];
        $name = fake()->name() . ' ' . Arr::random($productSuffix); //i tell it to give me a random element from the array mentioned
        return [
            'name' => $name, //i tell it to give me a random element from the array mentioned
            'slug' => Str::slug($name),
            'description' => fake()->realText(200),
            'price' => fake()->numberBetween(1000, 10000),
        ];
    }
}
