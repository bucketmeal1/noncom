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
        Schema::create('cervical_cancers', function (Blueprint $table) {
            $table->id();
            $table->integer('consultation_id')->nullable();
            $table->string('consultation_date')->nullable();
            $table->string('risk_assessment')->nullable();
            $table->string('given_counseling')->nullable();
            $table->string('type_screening')->nullable();
            $table->string('result')->nullable();
            $table->string('treatment_management')->nullable();
            $table->date('return_schedule')->nullable();
            $table->string('remarks')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cervical_cancers');
    }
};
