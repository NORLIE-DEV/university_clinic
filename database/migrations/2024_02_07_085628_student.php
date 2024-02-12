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
        Schema::create('student', function (Blueprint $table) {
            $table->string('student_id', 10)->primary();
            $table->string('first_name', 50);
            $table->string('middle_name', 50);
            $table->string('last_name', 50);
            $table->string('gender', 10);
            $table->string('civil_status', 15);
            $table->date('date_of_birth');
            $table->string('birthplace',100);
            $table->string('contact_number',20);
            $table->string('address',50);
            $table->string('email',50);
            $table->string('password',50);
            $table->string('department',20);
            $table->string('student_level',20);
            $table->string('course',20);
            $table->string('school_year_enrolled',20);
            $table->string('status', 20);
            $table->string('emergency_contact_name',20);
            $table->string('emergency_contact_number',20);
            $table->string('emergency_contact_address',20);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student');
    }
};
