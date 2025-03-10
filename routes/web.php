<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\StudentPageController;
use App\Http\Controllers\TeacherPageController;

Route::get('/', function () {
    return view('welcome');
})->name("login");

Route::post("/login" , [AuthController::class , 'login']);
Route::get("/logout" , [AuthController::class , "logout"]);

Route::get("/dachboard" , function(){
    return view("admin.dachboard");
})->middleware(["auth" , "isAdmin"]);

Route::resource("/students" , StudentController::class)->middleware(["auth" , "isAdmin"]);

Route::resource("/teachers" , TeacherController::class)->middleware(["auth" , "isAdmin"]);

Route::get('/classes' , [StudentController::class , "classe"])->middleware(["auth" , "isAdmin"]);
Route::post('/classes' , [StudentController::class , "editClasse"])->middleware(["auth" , "isAdmin"]);
Route::get("/terms" , [StudentController::class , 'terms'])->middleware(["auth" , "isAdmin"]);
Route::post("/terms" , [StudentController::class , 'editTerm'])->middleware(["auth" , "isAdmin"]);


Route::get('/teacher' , [TeacherPageController::class , "teacher"])->name("teacher")->middleware("auth");
Route::get('/classe/{classe}/{subject}' , [TeacherPageController::class , "classe"])->middleware("auth");
Route::post("/addGrade/{user}/{classeID}/{subjectID}" , [TeacherPageController::class , 'addGrade'])->middleware("auth");

Route::get('/image' , function(){
    return view("image");
});
Route::post('/image' , [AuthController::class , 'image']);
Route::get("/studentPage" , [StudentPageController::class , "index"])->middleware("auth");

// Route::get('/email/verify', [AuthController::class , 'verifyNotice'])->middleware('auth')->name('verification.notice');

 
// Route::get('/email/verify/{id}/{hash}', [AuthController::class , 'verifyEmail'] )->middleware(['auth', 'signed'])->name('verification.verify');

 
// Route::post('/email/verification-notification', [AuthController::class , "resendEmail"])->middleware(['auth', 'throttle:6,1'])->name('verification.send');