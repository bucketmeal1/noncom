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
        Schema::create('risk_screenings', function (Blueprint $table) {
            $table->id();
            $table->integer('consultation_id')->nullable();
            $table->double('fbs_result')->nullable();
            $table->date('fbs_date')->nullable();
            $table->double('rbs_result')->nullable();
            $table->date('rbs_date')->nullable();
            $table->string('polyphagia')->nullable();
            $table->string('polydipsia')->nullable();
            $table->string('polyuria')->nullable();
            $table->double('total_cholesterol')->nullable();
            $table->date('total_cholesterol_date')->nullable();
            $table->double('hdl')->nullable();
            $table->date('hdl_date')->nullable();
            $table->double('ldl')->nullable();
            $table->date('ldl_date')->nullable();
            $table->double('vldl')->nullable();
            $table->date('vldl_date')->nullable();
            $table->double('triglyceride')->nullable();
            $table->date('triglyceride_date')->nullable();
            $table->double('protein')->nullable();
            $table->date('protein_date')->nullable();
            $table->double('ketones')->nullable();
            $table->date('ketones_date')->nullable();
            $table->string('breathlessness')->nullable();
            $table->string('chronic_cough')->nullable();
            $table->string('sputum')->nullable();
            $table->string('chest_tightness')->nullable();
            $table->string('wheezing')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('risk_screenings');
    }
};
