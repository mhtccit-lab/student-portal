<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Student extends Model
{
    /** @use HasFactory<\Database\Factories\StudentFactory> */
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'full_name_english',
        'full_name_bangla',
        'father_name',
        'mother_name',
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
        'reference_name',
        'status',
    ];
    protected $dates = ['deleted_at'];

    // public function institute()
    // {
    //     return $this->belongsTo(Institute::class);
    // }

    // public function trade()
    // {
    //     return $this->belongsTo(Trade::class);
    // }

    public function enrollments()
    {
        return $this->hasMany(StudentEnrollment::class);
    }
    // // 🔥
    // public function course()
    // {
    //     return $this->belongsTo(Course::class);
    // }

    // public function courses()
    // {
    //     return $this->belongsToMany(Course::class, 'student_enrollments')
    //         ->withPivot(['enroll_date', 'status'])
    //         ->withTimestamps();
    // }

    protected static function booted()
    {
        static::deleting(function ($student) {

            if ($student->photo && Storage::disk('public')->exists($student->photo)) {
                Storage::disk('public')->delete($student->photo);
            }

            if ($student->card_file && Storage::disk('public')->exists($student->card_file)) {
                Storage::disk('public')->delete($student->card_file);
            }

        });
    }
}
