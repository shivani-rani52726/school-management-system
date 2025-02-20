<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class TeacherDetail extends Model
{
    use HasUuids;
    protected $primaryKey = 'uuid';
    protected $fillable =['teacher_name','teacher_school_name','teacher_class','teacher_subject','aadhar_no','contact_no','address'];
    
    public function teacherName(){
        return $this->hasMany(teachersName::class, 'teacher_id');
    }
}
