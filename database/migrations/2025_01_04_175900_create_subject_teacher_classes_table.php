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
        Schema::create('subject_teacher_classes', function (Blueprint $table) {
            $table->id("subjectTeacherClasseID");
            $table->foreignId("userID")->constrained("users")->references("userID")->onDelete("cascade");
            $table->foreignId("subjectID")->constrained("subjects")->references("subjectID");
            $table->foreignId("classeID")->constrained("classes")->references("classeID");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subject_teacher_classes');
    }
};
