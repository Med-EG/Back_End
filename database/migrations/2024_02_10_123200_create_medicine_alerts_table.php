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
        Schema::create('medicine_alerts', function (Blueprint $table) {
            $table->id('alert_id');
            $table->unsignedBigInteger('patient_id'); 
            $table->foreign('patient_id')->references('patient_id')->on('patients')->onDelete('CASCADE');
            $table->string('medicine_name');
            $table->string('medicine_dose');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medicine_alerts');
    }
};
