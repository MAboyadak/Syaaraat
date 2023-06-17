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
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->unique();
            $table->string('phone')->unique();
            $table->integer('salary');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->enum('role', ['employee', 'manager'])->default('employee');
            $table->string('image')->nullable();
            $table->unsignedBigInteger('manager_id')->nullable();
            
            $table->foreign('manager_id')->references('id')->on('employees');
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
