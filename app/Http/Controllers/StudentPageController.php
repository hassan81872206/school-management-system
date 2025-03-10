<?php

namespace App\Http\Controllers;

use App\Models\CertificateDepartment;
use App\Models\Grade;
use App\Models\GradeUserClasseSubjectTerm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentPageController extends Controller
{
    public function index(){
        $student = Auth::user();
        $classe = $student->classe ;
        // return $classe ;
        $certificateDepartmentID = $classe->certificateDepartmentID ;
        // return $certificateDepartmentID ;
        $certificateDepartment = CertificateDepartment::find($certificateDepartmentID);
        // return $certificateDepartment ;
        $subjects = $certificateDepartment->subjects ;
        // return $subjects ;
        $gradeRelations = GradeUserClasseSubjectTerm::where("userID" , $student->userID)->get();
        $gradeSubjectTerms = [];
        foreach($gradeRelations as $gradeRelation){
            $grade = Grade::where("gradeID" , $gradeRelation->gradeID)->get();
            $gradeSubjectTerms[] = [$grade[0]->grade , $gradeRelation->subjectID , $gradeRelation->termID];
        }
        // return $gradeSubjectTerms ;
        return view("student.index" , ["subjects" => $subjects , "student" => $student , "gradeSubjectTerms" => $gradeSubjectTerms]);
    }
}
