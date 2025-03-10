<?php

namespace App\Providers;

use App\Models\User;
use App\Models\Classe;
use App\Models\Subject;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrapFive() ;
        Route::model('student' , User::class);
        Route::model('classeID' , Classe::class);
        Route::model('subjectID' , Subject::class);
        Route::model('user' , User::class);

    }
}
