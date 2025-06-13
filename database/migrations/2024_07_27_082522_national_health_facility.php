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
        Schema::create('national_health_facility', function (Blueprint $table) {
            $table->id();
            $table->string('fac_id')->nullable();
            $table->string('fhudcode')->nullable();
            $table->string('fhudname')->nullable();
            $table->string('fhudaddress')->nullable();
            $table->string('regcode')->nullable();
            $table->string('provcode')->nullable();
            $table->string('ctycode')->nullable();
            $table->string('bgycode')->nullable();
            $table->string('zipcode')->nullable();
            $table->string('fhudtelno1')->nullable();
            $table->string('mobile_number')->nullable();
            $table->string('fhudfaxno')->nullable();
            $table->string('fhudemail')->nullable();
            $table->string('lat')->nullable();
            $table->string('lng')->nullable();
            $table->string('facility_type_code')->nullable();
            $table->string('head_lname')->nullable();
            $table->string('head_fname')->nullable();
            $table->string('head_mname')->nullable();
            $table->string('fhudheadpos')->nullable();
            $table->string('statflag')->nullable();
            $table->string('citycode')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('national_health_facility');
    }
};
