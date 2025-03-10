<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Classe;
use App\Models\Gender;
use App\Models\Nationalitie;
use App\Models\Term;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Registered;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    { 
        $students = User::where("role" , "student")->paginate(15);
        return view("admin.student.index" , ["students" => $students]); 
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $genders = Gender::all();
        $nationalities = Nationalitie::all();
        $classes = Classe::where('nbrStud' , '<' , 30 )->get();
        return view("admin.student.create" , ["genders" => $genders , "nationalities" => $nationalities , "classes" => $classes]);
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
            "classeID" => ["required" , "integer" ,"exists:classes,classeID"] ,    
        ]);
        $classe = Classe::find($fields["classeID"]);
        if($classe->nbrStud < $classe->maxNbrStud){
            $classe->update([
                "nbrStud" => $classe->nbrStud + 1 
                
            ]);
            $user = User::create($fields);
            // Auth::login($user);
 
            // event(new Registered($user));
            // return to_route("verification.notice");

            return to_route("students.index")->with("success" , "Create Successfuly");
        }
        return to_route("students.create")->with("error" , "this Classe is full");

    }

    /**
     * Display the specified resource.
     */
    public function show(User $student)
    {
        // return $user ;
        if($student->role !== "student"){
            return to_route("students.index");
        }
        return view("admin.student.show" , ["student" => $student]);
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
    public function destroy(User $student)
    {
        $student->delete();
        // return to_route('students.index')->with("delete" , "Delete Successfuly");
        return response()->json(["delete"]);
    }

    public function classe(){
        return view("admin.classe");
    }

    public function editClasse(Request $request){
        $fields = $request->validate([
            "schoolarYear" => ["required" , "integer" , "max:3000"]
        ]);
        Classe::query()->update(["schoolarYear" => $fields["schoolarYear"] , "nbrStud" => 0]);
        return redirect("/dachboard");
    }

    public function terms(){
        $terms = Term::all();
        return view("admin.terms" , ["terms" => $terms]);
    }

    public function editTerm(Request $request){
        $fields = $request->validate([
            "termID" => ["required" , "integer" , "exists:terms,termID"]
        ]);

        $term = Term::where("active" , "yes")->update([
            "active" => "no"
        ]);
        // return $term ;
        $term = Term::find($fields["termID"]);
        $term->update([
            "active" => "yes" 
        ]);
        return redirect('/terms');
    }
}
