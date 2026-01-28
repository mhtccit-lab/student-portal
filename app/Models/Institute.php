<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Institute extends Model
{
    /** @use HasFactory<\Database\Factories\InstituteFactory> */
    use HasFactory;
    
    protected $fillable = ['name', 'code', 'address', 'status'];

    public function trades()
    {
        return $this->hasMany(Trade::class);
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
