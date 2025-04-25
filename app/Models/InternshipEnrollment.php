<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InternshipEnrollment extends Model
{
    protected $fillable = [
        'user_id', 'internship_id', 'email', 'name', 'phone',
        'payment_id', 'amount', 'status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function internship()
    {
        return $this->belongsTo(Internship::class);
    }

    // public function submissions()
    // {
    //     return $this->hasMany(InternshipSubmission::class);
    // }
}