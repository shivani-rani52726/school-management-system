<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class schoolDetails extends Model
{
    use HasUuids;
    protected $primaryKey = 'uuid';
    protected $fillable = ['school_name','principal_name','city_name','district_name','contact_no','school_email','established_year','school_website'];

    public function schoolName(){
        return $this->hasMany(teachersName::class, 'school_id');
    }
}
