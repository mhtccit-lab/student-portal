<?php

namespace Database\Factories;

use App\Models\Institute;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Trade>
 */
class TradeFactory extends Factory
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
                'Computer Office Application',
                'Electrical Wiring',
                'Graphic Design',
                'Computer Hardware',
                'Web Development',
                'Networking',
            ]),
            'status' => 'active'
        ];
    }
}
