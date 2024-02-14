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
        Schema::create('allergies_info', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('allergy_id');
            $table->foreign('allergy_id')->references('allergy_id')->on('allergies');
            $table->unsignedBigInteger('medical_record_id');
            $table->foreign('medical_record_id')->references('medical_record_id')->on('basic_medical_info');
            $table->unsignedBigInteger('doctor_id');
            $table->foreign('doctor_id')->references('doctor_id')->on('doctors');
            $table->string('allergy_type');
            $table->string('severity_level');
            $table->text("body_response");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('allergies_info');
    }
};
