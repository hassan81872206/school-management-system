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
        Schema::create('subject_certificate_departments', function (Blueprint $table) {
            $table->id("subjectCertificateDepartmentID");
            $table->foreignId("subjectID")->constrained("subjects")->references("subjectID");
            $table->foreignId("certificateDepartmentID")->constrained("certificate_departments")->references("certificateDepartmentID");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subject_certificate_departments');
    }
};
