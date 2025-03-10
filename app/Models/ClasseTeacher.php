<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClasseTeacher extends Model
{
    protected $primaryKey = "classeTeacher" ;
    protected $fillable = [
        'classeID' , 
        'userID' 
    ];
}
