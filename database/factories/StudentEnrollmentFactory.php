<?php

namespace Database\Factories;

use App\Models\Course;
use App\Models\Institute;
use App\Models\Student;
use App\Models\Trade;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\StudentEnrollment>
 */
class StudentEnrollmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $courseFee = $this->faker->numberBetween(8000,20000);
        $paid = $this->faker->numberBetween(2000,$courseFee);

        return [

            'student_id' => Student::inRandomOrder()->first()->id,

            'institute_id' => Institute::inRandomOrder()->first()->id,

            'trade_id' => Trade::inRandomOrder()->first()->id,

            'course_id' => Course::inRandomOrder()->first()->id,

            'course_type' => $this->faker->randomElement(['NSDA','Takamol']),

            'course_fee' => $courseFee,

            'course_duration' => $this->faker->numberBetween(3,12),

            'amount_paid' => $paid,

            'amount_due' => $courseFee - $paid,

            'amount_receiver_name' => $this->faker->name,

            'enroll_date' => now(),

            'status' => 'enrolled'
        ];
    }
}
