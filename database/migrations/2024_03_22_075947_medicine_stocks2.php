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
        Schema::create('medicine_stocks', function (Blueprint $table) {
            $table->string('id')->unique()->nullable();
            $table->uuid('medicine_id')->nullable(); // Change to UUID data type
            $table->foreign('medicine_id')->references('id')->on('medicines')->onDelete('cascade'); // Reference custom UUID primary key
            $table->string('batch_id', 15)->unique();
            $table->date('date_recieve');
            $table->date('expiration_date');
            $table->integer('quantity');
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
