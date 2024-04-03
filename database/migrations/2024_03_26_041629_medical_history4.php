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
        Schema::create('medicalhistories', function (Blueprint $table) {
            $table->string('id')->unique()->nullable();
            $table->uuid('patient_id')->nullable(); // Change to UUID data type
            $table->foreign('patient_id')->references('id')->on('patients')->onDelete('cascade'); // Reference custom UUID primary key

            $table->string('father_first_name');
            $table->string('father_middle_name');
            $table->string('father_last_name');
            $table->string('father_cp_number');
            $table->string('father_email');
            $table->string('mother_first_name');
            $table->string('mother_middle_name');
            $table->string('mother_last_name');
            $table->string('mother_cp_number');
            $table->string('mother_email');
            $table->string('emergency_contact_name');
            $table->string('emergency_contact_number');
            $table->string('food_allergy')->nullable();
            $table->string('medicine_allergy')->nullable();
            $table->string('other_allergy')->nullable();
            $table->string('illness')->nullable();
            $table->string('other_illness')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
