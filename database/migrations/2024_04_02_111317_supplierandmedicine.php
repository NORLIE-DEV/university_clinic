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
        //
        Schema::create('suppliers', function (Blueprint $table) {
            $table->uuid('id')->primary(); // Use UUID for primary key
            $table->string('name', 25);
            $table->string('contact_number', 11);
            $table->string('email', 30)->unique();
            $table->string('address', 100);
            $table->string('image')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('medicines', function (Blueprint $table) {
            $table->string('id')->unique()->nullable();
            $table->uuid('supplier_id')->nullable(); // Change to UUID data type
            $table->foreign('supplier_id')->references('id')->on('suppliers')->onDelete('cascade');
            $table->string('name', 50);
            $table->string('generic_name', 50);
            $table->string('description', 100);
            $table->string('dosage', 25);
            $table->string('medicine_types', 15);
            $table->string('image')->nullable();
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
