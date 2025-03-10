<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gender extends Model
{
    protected $primaryKey = "genderID" ;
    protected $fillable = [
       'genderName'
    ];
}
