<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class subjectWithClass extends Model
{
    use HasUuids;
    protected $table = 'subject_with_classes';
    protected $primaryKey = 'uuid';
    protected $fillable =['class','subject_name'];

    public function className(){
        return $this->belongsTo(classStudent::class, 'class');
    }
}
