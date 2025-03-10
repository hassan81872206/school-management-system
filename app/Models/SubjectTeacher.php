<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubjectTeacher extends Model
{
    protected $primaryKey = "subjectTeacherID" ;
    protected $fillable = [
        'subjectID' , 
        'userID' 
    ];
}
