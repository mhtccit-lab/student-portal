<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    /** @use HasFactory<\Database\Factories\CourseFactory> */
    use HasFactory;

     protected $fillable = ['trade_id', 'name', 'duration', 'price', 'status'];

    public function trade()
    {
        return $this->belongsTo(Trade::class);
    }

    public function enrollments()
    {
        return $this->hasMany(StudentEnrollment::class);
    }

    public function students()
    {
        return $this->belongsToMany(Student::class, 'student_enrollments')
            ->withPivot(['enroll_date', 'status'])
            ->withTimestamps();
    }
}
