<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fee extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_name',
        'student_id',
        'total_fees',
        'paid_fees',
        'due_fees',
        'due_date',
    ];
}

