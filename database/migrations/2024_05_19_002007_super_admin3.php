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
        Schema::create('superadmins', function (Blueprint $table) {
            $table->string('id')->unique()->nullable();
            $table->string('name');
            $table->string('email');
            $table->string('password');
            $table->string('gender');
            $table->string('phonenumber');
            $table->date('birthdate');
            $table->string('status');
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
