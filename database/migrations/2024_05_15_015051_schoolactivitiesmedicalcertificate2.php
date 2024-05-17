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
        Schema::create('schoolactivitiesmedicalcertificates', function (Blueprint $table) {
            $table->id();
            $table->uuid('doctor_id')->nullable(); // Define doctor_id as UUID
            $table->foreign('doctor_id')->references('id')->on('doctors')->onDelete('cascade'); // Add foreign key constraint
            $table->uuid('patient_id')->nullable(); // Define patient_id as UUID
            $table->foreign('patient_id')->references('id')->on('patients')->onDelete('cascade'); // Correct the reference to the patients table
            $table->string('certificateID');
            $table->date('date_issue');
            $table->string('activity');
            $table->string('blood_pressure');
            $table->string('respiratory_rate');
            $table->string('pulse_rate');
            $table->string('height');
            $table->string('weight');
            $table->string('findings');
            $table->string('recomendations');
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
