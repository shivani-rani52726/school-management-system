<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class teachersName extends Model
{
    use HasUuids;
    protected $table = 'teachers_names';
    protected $primaryKey = 'uuid';
    protected $fillable =['school_name','teacher_name'];

    
    public function schoolDetail(){
        return $this->belongsTo(SchoolDetails::class, 'school_name');
    }
    public function teacherDetail(){
        return $this->belongsTo(TeacherDetail::class, 'teacher_name');
    }
    
}
