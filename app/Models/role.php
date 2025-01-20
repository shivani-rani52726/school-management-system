<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class role extends Model
{
    // use HasUuids;
    protected $primaryKey='uuid';
    protected $fillable = ['role_name','discriptions'];
}
