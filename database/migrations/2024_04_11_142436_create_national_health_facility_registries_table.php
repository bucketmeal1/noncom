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
        Schema::create('national_health_facility_registries', function (Blueprint $table) {
            $table->id();
            $table->string("health_facility_code")->nullable();
            $table->string("health_facility_code_short")->nullable();
            $table->string("facility_name")->nullable();
            // $table->string("old_facility_name_1")->nullable();
            // $table->string("old_facility_name_2")->nullable();
            // $table->string("old_facility_name_3")->nullable();
            $table->string("facility_major_type")->nullable();
            $table->string("health_facility_type")->nullable();
            // $table->string("category")->nullable();
            $table->string("ownership_major_classification")->nullable();
            $table->string("ownership_sub_classification_for_government_facilities")->nullable();
            $table->string("ownership_sub_classification_for_private_facilities")->nullable();
            $table->string("street_name_and_number")->nullable();
            $table->string("building_name_and_number")->nullable();
            $table->string("region_name")->nullable();
            $table->string("region_psgc")->nullable();
            $table->string("province_name")->nullable();
            $table->string("province_psgc")->nullable();
            $table->string("municipality_name")->nullable();
            $table->string("municipality_psgc")->nullable();
            $table->string("barangay_name")->nullable();
            $table->string("barangay_psgc")->nullable();
            $table->string("zip_code")->nullable();
            $table->string("landline_number")->nullable();
            $table->string("landline_number2")->nullable();
            $table->string("fax_number")->nullable();
            $table->string("email_address")->nullable();
            $table->string("alternate_email_address")->nullable();
            $table->string("official_website")->nullable();
            $table->string("service_capability")->nullable();
            $table->string("bed_capacity")->nullable();
            $table->string("licensing_status")->nullable();
            $table->string("license_validity_date")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('national_health_facility_registries');
    }
};
