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
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->uuid('doctor_id')->nullable(); // Define doctor_id as UUID
            $table->foreign('doctor_id')->references('id')->on('doctors')->onDelete('cascade'); // Add foreign key constraint
            $table->uuid('patient_id')->nullable(); // Define patient_id as UUID
            $table->foreign('patient_id')->references('id')->on('patients')->onDelete('cascade'); // Correct the reference to the patients table
            $table->string('full_name');
            $table->string('phone_number')->nullable();
            $table->date('date');
            $table->time('start_time');
            $table->time('end_time');
            $table->string('appointment_status')->default('booked');
            $table->text('notes')->nullable();
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
