<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'institute_id',
        'status',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    // User belongs to an institute (except super admin)
    public function institute()
    {
        return $this->belongsTo(Institute::class);
    }

    /*
    |--------------------------------------------------------------------------
    | Role Helpers
    |--------------------------------------------------------------------------
    */

    public function isSuperAdmin()
    {
        return $this->role === 'super_admin';
    }

    public function isInstituteAdmin()
    {
        return $this->role === 'institute_admin';
    }

    public function isStaff()
    {
        return $this->role === 'staff';
    }

    /*
    |--------------------------------------------------------------------------
    | Access Helpers
    |--------------------------------------------------------------------------
    */

    // Check if user can access an institute
    public function canAccessInstitute($instituteId)
    {
        return $this->isSuperAdmin() || $this->institute_id == $instituteId;
    }
}
