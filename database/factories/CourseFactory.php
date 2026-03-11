<?php

namespace Database\Factories;

use App\Models\Trade;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Course>
 */
class CourseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->randomElement([
                'Basic Course',
                'Advanced Course',
                'Professional Course'
            ]),
            'duration' => $this->faker->numberBetween(3,12),
            'price' => $this->faker->numberBetween(5000,20000),
            'status' => 'active'
        ];
    }
}
