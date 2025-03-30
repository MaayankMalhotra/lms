<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'course_code_id',
        'logo',
        'duration',
        'placed_learner',
        'slug',
        'rating',
        'price',
    ];
    
    public function recordings()
    {
        return $this->hasMany(Recording::class, 'course_id');
    }
}
