<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Nationalitie extends Model
{
    protected $primaryKey = "nationalityID" ;
    protected $fillable = [
       'naationalityName'
    ];
}
