<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Student>
 */
class StudentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'full_name_english' => $this->faker->name,
            'full_name_bangla' => $this->faker->name,

            'father_name' => $this->faker->name,
            'mother_name' => $this->faker->name,

            'gender' => $this->faker->randomElement(['Male','Female']),

            'current_address' => $this->faker->address,
            'permanent_address' => $this->faker->address,

            'phone' => $this->faker->phoneNumber,
            'email' => $this->faker->unique()->safeEmail,

            'date_of_birth' => $this->faker->date(),

            'district' => $this->faker->city,
            'police_station' => $this->faker->city,
            'postal_code' => $this->faker->postcode,

            'types_of_card' => 'nid',
            'card_number' => $this->faker->numerify('##########'),

            'passport_expiry_date' => now()->addYears(5),

            'card_file' => 'demo-card.jpg',
            'photo' => 'demo-photo.jpg',

            'reference_name' => $this->faker->name,

            'status' => 'active',
        ];
    }
}
