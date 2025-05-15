<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class StudentDetail extends Model
{
    use HasUuids;
    protected $primaryKey = 'uuid';
    protected $table = 'student_details';
    protected $fillable = ['stu_name','rollNo','class','father_name','mother_name','aadhar_number','address','contact_number'];


    public function classStudent()
    {
        return $this->belongsTo(classStudent::class, 'class', 'uuid');
    }

}