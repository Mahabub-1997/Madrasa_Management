<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User; // Import the correct User model

class Salary extends Model
{
    protected $fillable = ['user_id', 'receiver', 'purpose', 'amount', 'month', 'year', 'type'];

    // Relationship to the user who created the salary
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Relationship to the receiver user
    public function receiverUser()
    {
        return $this->belongsTo(User::class, 'receiver');
    }
}
