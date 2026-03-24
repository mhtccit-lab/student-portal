<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StudentEnrollment extends Model
{
    use SoftDeletes, HasFactory;
    // Optional but recommended (explicit)
    protected $table = 'student_enrollments';

    protected $fillable = [
        'student_id',
        'institute_id',
        'trade_id',
        'course_id',
        'course_type',
        'course_fee',
        'course_duration',
        'amount_paid',
        'amount_due',
        'amount_receiver_name',
        'enroll_date',
        'status',
    ];
    protected $dates = ['enroll_date'];

    // Relationships
    public function student()
    {
        return $this->belongsTo(Student::class)->withTrashed();
    }

    public function institute()
    {
        return $this->belongsTo(Institute::class);
    }

    public function trade()
    {
        return $this->belongsTo(Trade::class);
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
