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
        Schema::create('dentalconsultations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('appointment_id')->nullable(); // Use unsignedBigInteger for regular auto-incrementing integer ID
            $table->foreign('appointment_id')->references('id')->on('appointments')->onDelete('cascade'); // Adjust foreign key constraint
            $table->uuid('doctor_id')->nullable(); // Define doctor_id as UUID
            $table->foreign('doctor_id')->references('id')->on('doctors')->onDelete('cascade'); // Add foreign key constraint
            $table->uuid('patient_id')->nullable(); // Define patient_id as UUID
            $table->foreign('patient_id')->references('id')->on('patients')->onDelete('cascade'); // Correct the reference to the patients table
            $table->uuid('nurse_id_1')->nullable(); // Define patient_id as UUID
            $table->foreign('nurse_id_1')->references('id')->on('nurses')->onDelete('cascade'); // Correct the reference to the patients table
            $table->uuid('nurse_id_2')->nullable(); // Define patient_id as UUID
            $table->foreign('nurse_id_2')->references('id')->on('nurses')->onDelete('cascade'); // Correct the reference to the patients table

            //medicine issuance
            $table->json('medicine_issuance')->nullable();
            //medicine prescription
            $table->json('medicine_prescription')->nullable();

            $table->string('oral_health_condition')->nullable();
            $table->string('services_rendered')->nullable();


            $table->string('other_assistant')->nullable();
            $table->string('follow_up')->nullable();
            $table->string('remarks')->nullable();

            $table->string('consultation_method');
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
