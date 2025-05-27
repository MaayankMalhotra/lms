<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WebinarEnrollment extends Model
{
    use HasFactory;
    protected $fillable = [
        'webinar_id',
        'name',
        'email',
        'phone',
        'comments',
    ];
    public function webinar()
    {
        return $this->belongsTo(Webinar::class);
    }
}
