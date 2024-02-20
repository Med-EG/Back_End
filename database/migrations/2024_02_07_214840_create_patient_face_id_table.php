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
        Schema::create('patient_face_id', function (Blueprint $table) {
            $table->id('image_id');
            $table->unsignedBigInteger('patient_id'); 
            $table->foreign('patient_id')->references('patient_id')->on('patients')->onDelete('CASCADE');
            $table->string('face_image');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patient_face_id');
    }
};
