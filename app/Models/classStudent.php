<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class classStudent extends Model
{
    use HasUuids;
    protected $primaryKey = 'uuid';
    protected $fillable = ['class'];

    public function className(){
        return $this->hasMany(classStudent::class, 'class');
    }
}
