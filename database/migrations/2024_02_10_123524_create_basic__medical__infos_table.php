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
        Schema::create('basic_medical_info', function (Blueprint $table) {
            $table->id('medical_record_id');
            $table->unsignedBigInteger('patient_id');
            $table->foreign('patient_id')->references('patient_id')->on('patients');
            $table->float('weight');
            $table->float('height');
            $table->string('blood_type');
            $table->boolean('alcoholic');
            $table->string('alcoholic_level');
            $table->boolean('smoker');
            $table->string('smoking_level');
            $table->string('job');
            $table->string('marital_status');
            $table->text('past_fracrues')->nullable;
            $table->string('sleeping_hours');
            $table->string('sleeping_quality');
            $table->text('father');
            $table->text('mother');
            $table->text('second_degree');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('basic_medical_info');
    }
};
