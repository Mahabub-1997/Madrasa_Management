<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    use HasFactory;

    // Add 'purpose' to the fillable array to allow mass assignment
    protected $fillable = [
        'purpose',
        'amount',
        'month',
        'year',
        'date',
        'type',
    ];
}
