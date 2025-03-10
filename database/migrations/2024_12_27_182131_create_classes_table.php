<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('classes', function (Blueprint $table) {
            $table->id("classeID");
            $table->foreignId("languageID")->constrained("languages")->references("languageID");     
            $table->foreignId("sectionID")->constrained("sections")->references("sectionID");     
            $table->foreignId("certificateDepartmentID")->constrained("certificate_departments")->references("certificateDepartmentID");     
            $table->string("roomNbr" , length:15);
            $table->unsignedSmallInteger("nbrStud");
            $table->unsignedSmallInteger("maxNbrStud");
            $table->string("schoolarYear" , length:4);                
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('classes');
    }
};
