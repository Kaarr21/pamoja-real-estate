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
        Schema::create('website_settings', function (Blueprint $table) {
            $table->id();
            
            // Branding
            $table->string('site_name')->default('Pamoja Real Estate');
            $table->string('logo_text')->default('PAMOJA');
            
            // Hero Section
            $table->string('hero_title')->default('Discover Your Heritage');
            $table->text('hero_subtitle')->nullable();
            $table->string('hero_cta_primary')->default('Browse for Sale');
            $table->string('hero_cta_secondary')->default('View Rentals');
            
            // Contact Info
            $table->string('contact_email')->default('concierge@pamoja.com');
            $table->string('contact_phone')->default('+254 700 000 000');
            $table->text('contact_address')->nullable();
            
            // Social Media
            $table->string('facebook_url')->nullable();
            $table->string('instagram_url')->nullable();
            $table->string('linkedin_url')->nullable();
            $table->string('twitter_url')->nullable();
            
            // SEO
            $table->text('meta_description')->nullable();
            
            // Footer
            $table->string('footer_copy')->default('Crafted for Luxury & Excellence');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('website_settings');
    }
};
