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
        Schema::create('users', function (Blueprint $table) {
            $table->string('id')->unique()->nullable();
            $table->string('name',25);
            $table->string('phone_number',15);
            $table->string('email',25)->unique();
            $table->string('password',30);
            $table->timestamp('email_verified_at')->nullable();
            $table->string('role',10);
            $table->string('status',10);
            $table->rememberToken();
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
