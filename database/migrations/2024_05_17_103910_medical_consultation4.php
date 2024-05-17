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
        Schema::create('medicalconsultations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('appointment_id')->nullable();

            $table->uuid('doctor_id')->nullable();
            $table->foreign('doctor_id')->references('id')->on('doctors')->onDelete('cascade');

            $table->uuid('patient_id')->nullable();
            $table->foreign('patient_id')->references('id')->on('patients')->onDelete('cascade');

            $table->uuid('nurse_id_1')->nullable();
            $table->uuid('nurse_id_2')->nullable();

            $table->integer('pulse_rate');
            $table->integer('respiratory_rate');
            $table->integer('blood_pressure');
            $table->integer('body_temp');
            $table->integer('height');
            $table->integer('weight');
            $table->json('chief_complaints')->nullable();
            $table->json('medicine_issuance')->nullable();
            $table->json('medicine_prescription')->nullable();
            $table->json('clinical_diagnosis')->nullable();
            $table->json('treatment_given')->nullable();
            $table->json('injuries')->nullable();
            $table->integer('vsud_pulse_rate')->nullable();
            $table->integer('vsud_respiratory_rate')->nullable();
            $table->integer('vsud_blood_pressure')->nullable();
            $table->integer('vsud_body_temp')->nullable();
            $table->string('vsud_conditional_findings')->nullable();
            $table->string('assistedBy');
            $table->string('other_assistant')->nullable();
            $table->string('transfferofcare')->nullable();
            $table->string('remarks')->nullable();
            $table->string('timeout');
            $table->string('consultation_method');
            $table->timestamps();

            $table->foreign('appointment_id')->references('id')->on('appointments')->onDelete('cascade');
            $table->foreign('nurse_id_1')->references('id')->on('nurses')->onDelete('cascade');
            $table->foreign('nurse_id_2')->references('id')->on('nurses')->onDelete('cascade');
        });
       
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medicalconsultations');
    }
};
