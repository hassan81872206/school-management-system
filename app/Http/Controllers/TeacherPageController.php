<?php

namespace App\Http\Controllers;

use App\Models\Term;
use App\Models\User;
use App\Models\Grade;
use App\Models\Classe;
use App\Models\GradeUserClasseSubjectTerm;
use App\Models\Subject;
use App\Models\SubjectTeacherClasse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TeacherPageController extends Controller
{
    public function teacher(){
        $teacher = Auth::user();
        $classes = $teacher->classes ; 
        // return $classes ;
        return view("teacher.index" , ["classes" => $classes]);
    }

    public function classe(Classe $classe , Subject $subject){
        $teacher = Auth::user();
        $continue = SubjectTeacherClasse::where("userID" , $teacher->userID)->where("classeID" , $classe->classeID)->where("subjectID" , $subject->subjectID)->get();
        if(count($continue) == 0){
            return "error" ;
        }
        $gradeRelations = GradeUserClasseSubjectTerm::where("classeID" , $classe->classeID)->where("subjectID" , $subject->subjectID)->get();
        // return $gradeRelations ;
        $terms = Term::where("active" , "yes")->get();
        $gradeStudent = [];
        foreach($gradeRelations as $gradeRelation){
            if($gradeRelation->role === "student"){
                $grade = Grade::where("gradeID" , $gradeRelation->gradeID)->get();
                $gradeStudent[] = [$grade[0]->grade , $gradeRelation->userID , $gradeRelation->termID];
            }
        }
        $students = $classe->students ;
        // return $students ;
        // $terms = Term::where("active" , "yes")->get();

        return view("teacher.classe" , ["classe" => $classe , "subject" => $subject , "students" => $students , "terms" => $terms , "gradeStudents" => $gradeStudent]);
    }

    public function addGrade(Request $request , User $student , Classe $classe , Subject $subject){
        $fields = $request->validate([
            "grade" => ["required" , "numeric" , "max:100"],
            "termID" => ["required" , "integer" , "exists:terms,termID"]
        ]);

        $continue = GradeUserClasseSubjectTerm::where("userID" , $student->userID)->where("classeID" , $classe->classeID)->where("subjectID" , $subject->subjectID)->where("termID" , $fields["termID"])->get();
        if(count($continue) == 0){
        $grade = Grade::create([
            "grade" => $fields["grade"]
        ]);  
        
        GradeUserClasseSubjectTerm::create([
            "gradeID" => $grade->gradeID ,
            "userID" => $student->userID ,
            "classeID" => $classe->classeID ,
            "subjectID" => $subject->subjectID ,
            "termID" => $fields["termID"]
        ]);
        $teacher = Auth::user();
        GradeUserClasseSubjectTerm::create([
            "gradeID" => $grade->gradeID ,
            "userID" => $teacher->userID ,
            "classeID" => $classe->classeID ,
            "subjectID" => $subject->subjectID ,
            "termID" => $fields["termID"],
            "role" => "teacher"
        ]);

        return redirect("/teacher");
    }else{
        return "error" ;
    }
    }
}
