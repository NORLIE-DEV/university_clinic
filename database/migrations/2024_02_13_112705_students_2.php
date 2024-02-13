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
        Schema::create('students', function (Blueprint $table) {
            $table->string('student_id')->unique();
            $table->string('first_name', 25);
            $table->string('middle_name', 25);
            $table->string('last_name', 25);
            $table->string('gender', 6);
            $table->string('civil_status', 6);
            $table->date('date_of_birth');
            $table->string('birth_place', 100);
            $table->string('permanent_address', 100);
            $table->string('contact_number', 11);
            $table->string('email', 25)->unique();
            $table->string('password');
            $table->string('student_department', 50);
            $table->string('student_level', 50);
            $table->string('course', 50);
            $table->string('school_year_enrolled', 50);
            $table->string('status', 10);
            $table->string('emergency_contact_name', 20);
            $table->string('emergency_contact_number', 11);
            $table->string('emergency_contact_address', 100);
            $table->string('image')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
