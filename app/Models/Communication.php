<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Communication extends Model
{
    use HasFactory;

    protected $fillable = [
        'sender_id', 'sender_type', 'receiver_id', 'title', 'body',
    ];

    public function receiver()
    {
        return $this->belongsTo(User::class, 'receiver_id')->select('id', 'name');
    }
    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id')->select('id', 'name');
    }
}
