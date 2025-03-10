<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class CertificateDepartment extends Model
{
    protected $primaryKey = "certificateDepartmentID" ;
    protected $fillable = [
        'certificateID' ,
        'departmentID'
    ];

    public function subjects() :BelongsToMany {
        return $this->belongsToMany(Subject::class , "subject_certificate_departments" , "certificateDepartmentID" , "subjectID");
    }
}
