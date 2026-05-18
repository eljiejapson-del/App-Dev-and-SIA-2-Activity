<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     * * Adding 'image' here is CRITICAL for the bonus 
     * image upload functionality to work.
     */
    protected $fillable = [
        'title', 
        'platform', 
        'year_released', 
        'condition',
        'image'
    ];

    /**
     * The attributes that should be cast.
     *
     * This ensures the year is always handled as an integer 
     * instead of a string when retrieved from the database.
     */
    protected $casts = [
        'year_released' => 'integer',
    ];
}