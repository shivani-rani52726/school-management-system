<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudyMaterial extends Model
{
    use HasFactory;
    protected $fillable = [
        'title', 'material_type', 'class_name', 'subject_name', 'due_date', 'file_name'
    ];
    
}

