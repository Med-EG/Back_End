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
        Schema::create('patient_emergency_contacts', function (Blueprint $table) {
            $table->id('contact_id');
            $table->unsignedBigInteger('patient_id'); 
            $table->foreign('patient_id')->references('patient_id')->on('patients')->onDelete('CASCADE');
            $table->integer('emergency_contact');
            $table->string('contact_name');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patient_contact_numbers');
    }
};
