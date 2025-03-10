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
        Schema::table('subject_teachers', function (Blueprint $table) {
            $table->dropForeign(["userID"]);
            $table->foreignId("userID")->change()->constrained("users")->references("userID")->onDelete("cascade");

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('subject_teachers', function (Blueprint $table) {
            $table->dropForeign(["userID"]);
            $table->foreignId("userID")->change()->constrained("users")->references("userID");

        });
    }
};
