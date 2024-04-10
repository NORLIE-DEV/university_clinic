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
        Schema::create('timings', function (Blueprint $table) {
            $table->string('id')->unique()->nullable();
            $table->uuid('doctor_id')->nullable(); // Change to UUID data type
            $table->foreign('doctor_id')->references('id')->on('doctors')->onDelete('cascade'); // Reference custom UUID primary key
            $table->string('day');
            $table->string('shift');
            $table->time('start_time');
            $table->time('end_time');
            $table->string('average_consultation_time')->nullable();
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
