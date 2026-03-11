<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Trade;
use App\Models\Course;
use App\Models\Student;
use App\Models\Institute;
use App\Models\StudentEnrollment;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {

    //users
        User::factory()->create([
            'name' => 'Yeahyea Sarker | Admin User',
            'email' => 'test@example.com',
            'password' => bcrypt('password'),
        ]);

    // Create Institutes
    $institutes = Institute::factory(5)->create();

    foreach ($institutes as $institute) {

        // Create Trades under each Institute
        $trades = Trade::factory(3)->create([
            'institute_id' => $institute->id
        ]);

        foreach ($trades as $trade) {

            // Create Courses under each Trade
            Course::factory(3)->create([
                'trade_id' => $trade->id
            ]);
        }
    }

    // Students
    $students = Student::factory(50)->create();

    // Get all courses
    $courses = Course::with('trade')->get();

    foreach ($students as $student) {

        $course = $courses->random();

        StudentEnrollment::create([

            'student_id' => $student->id,

            'institute_id' => $course->trade->institute_id,

            'trade_id' => $course->trade_id,

            'course_id' => $course->id,

            'course_type' => fake()->randomElement(['NSDA','Takamol']),

            'course_fee' => $course->price,

            'course_duration' => $course->duration,

            'amount_paid' => 3000,

            'amount_due' => $course->price - 3000,

            'amount_receiver_name' => 'Admin',

            'enroll_date' => now(),

            'status' => 'enrolled'
        ]);
    }
    }
}
