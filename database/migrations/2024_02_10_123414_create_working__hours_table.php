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
        Schema::create('working__hours', function (Blueprint $table) {
            $table->id('working_hour_id');
            $table->foreign('working_day_id')->references('working_day_id')->on('working_days');;
            $table->foreign('doctor_id')->references('doctor_id')->on('doctors');
            $table->time('start_time');
            $table->time('end_time');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('working__hours');
    }
};
