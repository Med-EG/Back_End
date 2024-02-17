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
        Schema::create('doctor_appointments', function (Blueprint $table) {
            $table->id('appointment_id');
            $table->unsignedBigInteger('patient_id'); 
            $table->foreign('patient_id')->references('patient_id')->on('patients')->onDelete('CASCADE');
            $table->unsignedBigInteger('doctor_id');
            $table->foreign('doctor_id')->references('doctor_id')->on('doctors')->onDelete('CASCADE');
            $table->string('working_hour_id');
            $table->string('working_day_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('doctor_appointments');
    }
};
