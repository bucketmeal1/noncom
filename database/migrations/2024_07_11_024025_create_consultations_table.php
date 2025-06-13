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
        Schema::create('consultations', function (Blueprint $table) {
            $table->id();
            $table->string('patient_id');
            $table->string('nature_visit')->nullable();
            $table->string('consultation_type')->nullable();
            $table->date('consultation_date')->nullable();
            $table->double('patient_height')->nullable();
            $table->double('patient_weight')->nullable();
            $table->double('bmi')->nullable();
            $table->string('classification')->nullable();
            $table->timestamps();
        });
    }


    
    public function down(): void
    {
        Schema::dropIfExists('consultations');
    }
};
