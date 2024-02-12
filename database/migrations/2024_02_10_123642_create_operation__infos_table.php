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
        Schema::create('operation__infos', function (Blueprint $table) {
            $table->foreign('operation_id')->references('operation_id')->on('operations')->primary();
            $table->foreign('medical_record_id')->references('medical_record_id')->on('basic_medical_info');
            $table->foreign('doctor_id')->references('doctor_id')->on('doctors');
            $table->date('operation_date');
            $table->string('surgeon name');
            $table->text('operation_notes');
            $table->text('complications');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('operation__infos');
    }
};
