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
        Schema::create('nurses', function (Blueprint $table) {
            $table->string('id')->unique()->nullable();
            $table->string('name', 25);
            $table->string('phone_number', 15);
            $table->string('email', 25)->unique();
            $table->string('password');
            $table->string('gender', 6);
            $table->string('specialties', 50);
            $table->string('bio', 100);
            $table->string('address', 100);
            $table->string('status', 10);
            $table->string('image')->nullable();
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
