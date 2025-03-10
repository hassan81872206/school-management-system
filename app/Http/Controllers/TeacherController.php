<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Classe;
use App\Models\ClasseTeacher;
use App\Models\Gender;
use App\Models\Nationalitie;
use App\Models\Subject;
use App\Models\SubjectTeacher;
use App\Models\SubjectTeacherClasse;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $teachers = User::where("role" , "teacher")->paginate(15);
        return view("admin.teacher.index" , ["teachers" => $teachers]); 
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $genders = Gender::all();
        $nationalities = Nationalitie::all();
        $classes = Classe::all();
        $subjects = Subject::all();
        return view("admin.teacher.create" , ["genders" => $genders , "nationalities" => $nationalities , "classes" => $classes , "subjects" => $subjects]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $fields = $request->validate([
            "fName" => ["required" , "string" , "max:10"],
            "lName" => ["required" , "string" , "max:10"],
            "father" => ["required" , "string" , "max:10"],
            "mother" => ["required" , "string" , "max:10"],
            "address" => ["required" , "min:3"],
            "phone" => ["required" , "min:8" , "max:8" , "unique:users,phone"],
            "birthdate" => ["required" , "date"],
            "email" => ["required" , "email" , "unique:users,email" ],
            "password" => ["required" , "min:8"],
            "genderID" => ["required" , "integer" , "exists:genders,genderID"] ,    
            "nationalityID" => ["required" , "integer" , "exists:nationalities,nationalityID"] ,    
            "classeID" => ["required" , "array" ] , 
            "classeID.*" => ["required" , "integer" , "exists:classes,classeID"],
            "subjectID" => ["required" , "array" ] , 
            "subjectID.*" => ["required" , "integer" , "exists:subjects,subjectID"],    
        ]);

        // check subject and classe => lezem ykouno equal 
        if(count($fields["subjectID"]) === count($fields["classeID"])){
            $array = [] ;
            for($i = 0 ; $i < count($fields["subjectID"]) ; $i++){
                $array [] = [$fields["subjectID"][$i] , $fields["classeID"][$i] ];
                $classe = Classe::find($fields["classeID"][$i]);
                $certificateDepartment = $classe->certificateDepartmentID ;
                $subject = Subject::find($fields["subjectID"][$i]);
                $certificateDepartments = $subject->certificateDepartments ;
                $true = [] ;                                                                            
                foreach($certificateDepartments as $a){
                    if($a->certificateDepartmentID == $certificateDepartment){
                        $true[] += true ; 
                    }else{
                        $true[]+= false ;
                    }
                }
                $complete = "no";
                foreach($true as $t){
                    if($t === 1){
                        $complete = "true";
                        break ;
                    }
                }
                if($complete == "no" ){
                    return to_route("teachers.create")->with("error1" , "You canoot place this subject in this classe");
                }
                // return "true" ;
                

            }for($i = 0 ; $i < count($array) ; $i++){
                for($j = 0 ; $j < count($array) ; $j++){
                    if($i !== $j){
                        if($array[$i][0] === $array[$j][0] && $array[$i][1] === $array[$j][1]){
                            return to_route("teachers.create")->with("error1" , "You cannot put the same subject and classe twice");
                        }
                    }
                }
            }
            // return "true" ;
            $user = User::create([
                "fName" => $fields['fName'],
                "lName" => $fields['lName'],
                "father" => $fields['father'],
                "mother" => $fields['mother'],
                "address" => $fields['address'],
                "phone" => $fields['phone'],
                "birthdate" => $fields['birthdate'],
                "email" => $fields['email'],
                "password" => $fields['password'],
                "role" => "teacher",
                "genderID" => $fields["genderID"],
                "nationalityID" => $fields["nationalityID"],
            ]);
            for($i = 0 ; $i < count($fields["classeID"]) ; $i++){
                SubjectTeacherClasse::create([
                    "userID" => $user->userID ,
                    "subjectID" => $fields["subjectID"][$i],
                    "classeID" => $fields["classeID"][$i]
                ]);
            }
            foreach($fields["classeID"] as $classe){
                        
                            ClasseTeacher::create([
                                'classeID' => $classe,
                                'userID' => $user->userID
                            ]);
                        }
                        foreach($fields["subjectID"] as $subject){
                            SubjectTeacher::create([
                                'subjectID' => $subject,
                                'userID' => $user->userID
                            ]);
                        }

            // Auth::login($user);
 
            // event(new Registered($user));
            // return to_route("verification.notice");

            return to_route("teachers.index")->with("success" , "Create Successfuly");
        
        // return to_route("students.create")->with("error" , "this Classe is full");
        }else{
            return to_route("teachers.create")->with("error1" , "Each classe Should have a subject");
        }
    
    }

    /**
     * Display the specified resource.
     */
    public function show(User $teacher)
    {
        if($teacher->role !== "teacher"){
            return to_route("teachers.index");
        }
        $classes =  $teacher->classes ;
        $subjects = $teacher->subjects ;
        return view("admin.teacher.show" , ["student" => $teacher , "classes" => $classes , "subjects" => $subjects]);
 
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $teacher)
    {
        $teacher->delete();
        return to_route('teachers.index')->with("delete" , "Delete Successfuly");

    }
}
