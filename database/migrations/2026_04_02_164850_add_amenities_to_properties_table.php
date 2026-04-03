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
        Schema::table('properties', function (Blueprint $table) {
            // Amenities
            $table->boolean('has_pool')->default(false);
            $table->boolean('has_pets_allowed')->default(false);
            $table->boolean('has_gym')->default(false);
            $table->boolean('has_garden')->default(false);
            $table->boolean('has_solar_panels')->default(false);
            $table->boolean('has_parking')->default(false);
            $table->boolean('has_security')->default(false);
            $table->boolean('has_wifi')->default(false);
            $table->boolean('is_furnished')->default(false);
            $table->boolean('has_air_conditioning')->default(false);
            $table->boolean('has_balcony')->default(false);
            $table->boolean('has_cctv')->default(false);
            $table->boolean('has_backup_generator')->default(false);
            $table->boolean('has_water_tank')->default(false);
            $table->boolean('has_elevator')->default(false);
            $table->boolean('has_borehole')->default(false);
            $table->boolean('has_staff_quarters')->default(false);
            $table->boolean('has_fireplace')->default(false);

            // SEO
            $table->string('seo_title')->nullable();
            $table->text('seo_description')->nullable();
            $table->string('seo_keywords')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('properties', function (Blueprint $table) {
            $table->dropColumn([
                'has_pool', 'has_pets_allowed', 'has_gym', 'has_garden', 
                'has_solar_panels', 'has_parking', 'has_security', 'has_wifi', 
                'is_furnished', 'has_air_conditioning', 'has_balcony', 'has_cctv', 
                'has_backup_generator', 'has_water_tank', 'has_elevator', 
                'has_borehole', 'has_staff_quarters', 'has_fireplace',
                'seo_title', 'seo_description', 'seo_keywords'
            ]);
        });
    }
};
