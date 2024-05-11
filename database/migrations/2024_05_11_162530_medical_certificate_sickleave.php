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
        Schema::create('sickleavemedicalcertificates', function (Blueprint $table) {
            $table->id();
            $table->uuid('doctor_id')->nullable(); // Define doctor_id as UUID
            $table->foreign('doctor_id')->references('id')->on('doctors')->onDelete('cascade'); // Add foreign key constraint
            $table->uuid('patient_id')->nullable(); // Define patient_id as UUID
            $table->foreign('patient_id')->references('id')->on('patients')->onDelete('cascade'); // Correct the reference to the patients table
            $table->string('certificateID');
            $table->date('absent_from');
            $table->date('absent_to');
            $table->integer('number_days_absent');
            $table->date('date_issue');
            $table->string('reason');
            $table->string('findings');
            $table->string('remarks');

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
