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
        Schema::create('medicalinformations', function (Blueprint $table) {
            $table->string('id')->unique()->nullable();
            $table->uuid('patient_id')->nullable(); // Change to UUID data type
            $table->foreign('patient_id')->references('id')->on('patients')->onDelete('cascade'); // Reference custom UUID primary key

            $table->string('illness')->nullable();
            $table->string('other_illness')->nullable();
            $table->string('food_allergy')->nullable();
            $table->string('medicine_allergy')->nullable();
            $table->string('insect_bite_allergy')->nullable();
            $table->string('other_allergy')->nullable();
            $table->string('vission_of_righteye')->nullable();
            $table->string('vission_of_lefteye')->nullable();
            $table->integer('blood_pressure');
            $table->integer('pulse_rate');
            $table->string('blood_pressure_category')->default('');
            $table->integer('body_temperature');
            $table->integer('height');
            $table->integer('weight');
            $table->string('bodymassindex')->nullable();
            $table->string('bodymassindex_category')->nullable();
            $table->string('injurie_status')->nullable();
            $table->string('dateofinjurie')->nullable();
            $table->string('name_of_hospital')->nullable();
            $table->string('immunization')->nullable();
            $table->string('other_immunization')->nullable();
            $table->string('familyhistory')->nullable();
            $table->string('other_familyhistory')->nullable();
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
