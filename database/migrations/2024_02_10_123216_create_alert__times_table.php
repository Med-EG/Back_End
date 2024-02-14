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
        Schema::create('alert_times', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('alert_id');
            $table->foreign('alert_id')->references('alert_id')->on('medicine_alerts');
            $table->time('alert_time');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alert_times');
    }
};
