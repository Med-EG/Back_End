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
        Schema::create('doctors', function (Blueprint $table) {
            $table->id('doctor_id');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email');
            $table->string('password');
            $table->string('gender');
            $table->string('specialization');
            $table->text('education');
            $table->integer('license_id')->unique();
            $table->string('country');
            $table->string('city');
            $table->string('street');
            $table->integer('years_of_experince')->nullable();
            $table->string('scientific_degree');
            $table->string('doctor_image');
            $table->decimal('price');
            $table->integer('rating');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('doctors');
    }
};
