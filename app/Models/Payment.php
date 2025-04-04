<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $table = 'payments'; // Table name

    protected $fillable = ['enrollment_id', 'user_id', 'batch_id', 'payment_id', 'amount', 'status', 'created_at', 'updated_at'];
    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }

    public function batch()
    {
        return $this->belongsTo(Batch::class);
    }
}