<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * "regcode","regname","regabbrev","nscb_reg_code","nscb_reg_name","UserLevelID","addedby","dateupdated","status"
     */
    public function up(): void
    {
        Schema::create('regions', function (Blueprint $table) {
            $table->id();
            $table->string('regcode')->nullable();
            $table->string('regname')->nullable();
            $table->string('regabbrev')->nullable();
            $table->string('nscb_reg_code')->nullable();
            $table->string('nscb_reg_name')->nullable();
            $table->string('UserLevelID')->nullable();
            $table->string('addedby')->nullable();
            $table->string('dateupdated')->nullable();
            $table->string('status')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('regions');
    }
};
