<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * "regcode","provcode","citycode","cityname","nscb_city_code","nscb_city_name","cityclassification","chartered","addedby","UserLevelID","dateupdated","status"
     */
    public function up(): void
    {
        Schema::create('municipalities', function (Blueprint $table) {
            $table->id();
            $table->string('regcode')->nullable();
            $table->string('provcode')->nullable();
            $table->string('citycode')->nullable();
            $table->string('cityname')->nullable();
            $table->string('nscb_city_code')->nullable();
            $table->string('nscb_city_name')->nullable();
            $table->string('cityclassification')->nullable();
            $table->string('chartered')->nullable();
            $table->string('addedby')->nullable();
            $table->string('UserLevelID')->nullable();
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
        Schema::dropIfExists('municipalities');
    }
};
