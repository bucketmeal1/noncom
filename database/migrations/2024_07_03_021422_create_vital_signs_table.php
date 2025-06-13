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
        Schema::create('vital_signs', function (Blueprint $table) {
            $table->id();
            $table->integer('consultation_id')->nullable();
            $table->string('consultation_date')->nullable();
            $table->string('systolic');
            $table->string('diastolic');
            $table->string('body_temperature');
            $table->string('pulse_rate');
            $table->string('repiratory_rate');
            $table->string('blood_oxygen');
            

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vital_signs');
    }
};
