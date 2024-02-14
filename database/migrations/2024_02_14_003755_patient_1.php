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
        Schema::create('patients', function (Blueprint $table) {
            $table->string('id')->unique()->nullable();
            $table->string('student_id', 50)->nullable();
            $table->string('employee_id', 50)->nullable();
            $table->foreign('student_id')->references('id')->on('students')->onDelete('cascade'); // Corrected foreign key constraint
            $table->foreign('employee_id')->references('id')->on('employees')->onDelete('cascade'); // Corrected foreign key constraint
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patients');
    }
};
