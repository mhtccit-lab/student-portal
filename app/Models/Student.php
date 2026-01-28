<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    /** @use HasFactory<\Database\Factories\StudentFactory> */
    use HasFactory;

    protected $fillable = [
        'full_name_english',
        'full_name_bangla',
        'gender',
        'current_address',
        'permanent_address',
        'phone',
        'email',
        'date_of_birth',
        'district',
        'police_station',
        'postal_code',
        'types_of_card',
        'card_number',
        'passport_expiry_date',
        'card_file',
        'photo',
        'institute_id',
        'trade_id',
        'course_id',
        'reference_name',
        'course_duration',
        'course_fee',
        'amount_receiver_name',
        'status',
    ];

    public function institute()
    {
        return $this->belongsTo(Institute::class);
    }

    public function trade()
    {
        return $this->belongsTo(Trade::class);
    }

    public function enrollments()
    {
        return $this->hasMany(StudentEnrollment::class);
    }
    // 🔥
    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    // public function courses()
    // {
    //     return $this->belongsToMany(Course::class, 'student_enrollments')
    //         ->withPivot(['enroll_date', 'status'])
    //         ->withTimestamps();
    // }
}
