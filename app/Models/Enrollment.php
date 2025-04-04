<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Enrollment extends Model
{
    protected $fillable = ['email', 'batch_id', 'user_id', 'status', 'created_at', 'updated_at'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function batch()
    {
        return $this->belongsTo(Batch::class);
    }
    public function payment()
    {
        return $this->hasOne(Payment::class);
    }
    public function canBeApproved()
    {
        return $this->status === 'pending';
    }
}
