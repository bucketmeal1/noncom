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
        Schema::create('past_medical_histories', function (Blueprint $table) {
            $table->id();
            $table->integer('consultation_id')->nullable();
            $table->string('past_medical_history_code')->nullable();
            $table->string('past_medical_history_desc')->nullable();
            $table->timestamps();
            

          
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('past_medical_histories');
    }
};
