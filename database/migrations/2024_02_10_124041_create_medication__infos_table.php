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
        Schema::create('medication_infos', function (Blueprint $table) {
            $table->foreign('medicine_id')->references('medicine_id')->on('medications')->primary();
            $table->foreign('medical_record_id')->references('medical_record_id')->on('basic_medical_info');
            $table->foreign('doctor_id')->references('doctor_id')->on('doctors');
            $table->string('dose');
            $table->string('frequency');
            $table->text('notes');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medication__infos');
    }
};
