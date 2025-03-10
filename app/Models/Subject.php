<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    protected $primaryKey = "subjectID" ;
    protected $fillable = [
        'subjectName' 
    ];

    public function certificateDepartments(){
        return $this->belongsToMany(CertificateDepartment::class , "subject_certificate_departments" , "subjectID" , "certificateDepartmentID");
    }
}
