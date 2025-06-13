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
        Schema::create('personnels', function (Blueprint $table) {
            $table->id();
            $table->string('ref_attendant')->nullable();
            $table->string('personnel_license_no')->nullable();
            $table->string('personnel_ptr_no')->nullable();
            $table->string('s2Lic_number')->nullable();
            $table->string('personnel_philhealth')->nullable();
            $table->string('phic_accreditation_no')->nullable();
            $table->string('personnel_TIN')->nullable();
            $table->string('personnel_lname')->nullable();
            $table->string('personnel_fname')->nullable();
            $table->string('personnel_mname')->nullable();
            $table->string('sex_code')->nullable();
            $table->string('personnel_birthdate')->nullable();
            $table->string('hired_code')->nullable();
            $table->string('personnel_status_code')->nullable();
            $table->string('personnel_active')->nullable();
            $table->string('current_user_login')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('personnels');
    }
};
