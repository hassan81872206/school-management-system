<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubjectTeacherClasse extends Model
{
    protected $primaryKey = "subjectTeacherClasseID" ;
    protected $fillable = [
        'userID' ,
        'subjectID' ,
        'classeID'
    ];
}
