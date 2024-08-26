<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = fake()->jobTitle(); //generate jobtitle like xxx xxx xxx
        $nameArr = explode(' ', $name); //explode the name to parts with space separators
        $name = trim($nameArr[0]); // trim the space
        return [
            'name' => $name,
            'slug' => Str::slug($name),
        ];
    }
}
