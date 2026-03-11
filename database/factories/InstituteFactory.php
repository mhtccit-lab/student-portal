<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Institute>
 */
class InstituteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->unique()->randomElement([
                'Musa Global Training and Testing Center',
                'Musa Training and Testing Center',
                'Siddiqua Training and Testing Center',
                'Lamia Training and Testing Center',
                'Tasfia Training and Testing Center',
            ]),
            'address' => $this->faker->address,
            'code' => $this->faker->unique()->numerify('###-##-#####'),
            'status' => 'active'
        ];
    }
}
