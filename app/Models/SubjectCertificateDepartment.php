<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubjectCertificateDepartment extends Model
{
    use HasFactory;

    protected $primaryKey = "subjectCertificateDepartmentID" ;
    protected $fillable = [
        'subjectID' ,
        'certificateDepartmentID'
    ];
}
