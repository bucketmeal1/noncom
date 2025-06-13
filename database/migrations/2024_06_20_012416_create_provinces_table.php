<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * "regcode","provcode","provname","nscb_prov_code","nscb_prov_name","addedby","UserLevelID","dateupdated","status"
     */
    public function up(): void
    {
        Schema::create('provinces', function (Blueprint $table) {
            $table->id();
            $table->string('regcode')->nullable();
            $table->string('provcode')->nullable();
            $table->string('provname')->nullable();
            $table->string('nscb_prov_code')->nullable();
            $table->string('nscb_prov_name')->nullable();
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
        Schema::dropIfExists('provinces');
    }
};
