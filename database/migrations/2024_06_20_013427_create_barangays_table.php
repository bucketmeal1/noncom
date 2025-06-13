<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * "regcode","provcode","citycode","bgycode","bgyname","nscb_brgy_code","nscb_brgy_name","addedby","UserLevelID","dateupdated","status"
     */
    public function up(): void
    {
        Schema::create('barangays', function (Blueprint $table) {
            $table->id();
            $table->string('regcode')->nullable();
            $table->string('provcode')->nullable();
            $table->string('citycode')->nullable();
            $table->string('bgycode')->nullable();
            $table->string('bgyname')->nullable();
            $table->string('nscb_brgy_code')->nullable();
            $table->string('nscb_brgy_name')->nullable();
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
        Schema::dropIfExists('barangays');
    }
};
