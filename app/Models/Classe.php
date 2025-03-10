<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Classe extends Model
{
    protected $primaryKey = "classeID" ;
    protected $fillable = [
        'languageID' ,
        'sectionID' ,
        'certificateDepartmentID' ,
        'roomNbr',
        'nbrStud',
        'maxNbrStud',
        'schoolarYear'
    ];

    public function teachers(){
        return $this->belongsToMany(User::class , "classe_teachers" , "classeID" , "userID");
    }

    public function students() : HasMany {
        return $this->hasMany(User::class , "classeID" , "classeID");
    }
}
