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
        Schema::create('employees', function (Blueprint $table) {
            $table->string('id')->unique();
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
            $table->string('employee_department', 50);
            $table->string('employee_position', 50);
            $table->string('status', 10);
            $table->string('emergency_contact_name', 20);
            $table->string('emergency_contact_number', 11);
            $table->string('emergency_contact_address', 100);
            $table->string('type')->default('employee');
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
        Schema::dropIfExists('employees');
    }
};
