<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trade extends Model
{
    /** @use HasFactory<\Database\Factories\TradeFactory> */
    use HasFactory;
    
    protected $fillable = ['institute_id', 'name', 'description', 'status'];

    public function institute()
    {
        return $this->belongsTo(Institute::class);
    }

    public function courses()
    {
        return $this->hasMany(Course::class);
    }
}
