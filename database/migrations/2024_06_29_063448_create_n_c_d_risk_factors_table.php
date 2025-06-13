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
        Schema::create('ncd_risk_factors', function (Blueprint $table) {
            $table->id();
            $table->integer('consultation_id')->nullable();
            $table->string('smoking')->nullable();
            $table->string('excessive_alcohol')->nullable();
            $table->string('highfat')->nullable();
            $table->string('highsalt')->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ncd_risk_factors');
    }
};
