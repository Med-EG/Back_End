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
        Schema::create('allergies_infos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('allergy_id');
            $table->foreign('allergy_id')->references('allergy_id')->on('allergies')->onDelete('CASCADE');
            $table->unsignedBigInteger('medical_record_id');
            $table->foreign('medical_record_id')->references('medical_record_id')->on('basic_medical_info')->onDelete('CASCADE');
            $table->unsignedBigInteger('doctor_id')->nullable();
            $table->foreign('doctor_id')->references('doctor_id')->on('doctors')->onDelete('SET NULL');
            $table->string('allergy_type');
            $table->string('severity_level')->nullable();
            $table->text('body_response')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('allergies_infos');
    }
};
