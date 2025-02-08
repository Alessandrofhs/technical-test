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
            $table->string('NIK', 20)->nullable();
            $table->string('FirstName')->nullable();
            $table->string('LastName')->nullable();
            $table->string('Address')->nullable();
            $table->Char('Gender',1)->nullable();
            $table->string('PlaceOfBirth')->nullable();
            $table->dateTime('DateOfBirth')->nullable();
            $table->string('Email')->nullable();
            $table->string('Phone',20)->nullable();
            $table->foreignId('JobTitleID')->constrained('jobtitles')->onDelete('cascade');
            $table->dateTime('HireDate')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
