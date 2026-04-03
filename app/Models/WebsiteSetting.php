<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class WebsiteSetting extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected $fillable = [
        'site_name',
        'logo_text',
        'hero_title',
        'hero_subtitle',
        'hero_cta_primary',
        'hero_cta_secondary',
        'contact_email',
        'contact_phone',
        'contact_address',
        'facebook_url',
        'instagram_url',
        'linkedin_url',
        'twitter_url',
        'meta_description',
        'footer_copy',
    ];

    /**
     * Register media collections.
     */
    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('hero_image')
            ->singleFile()
            ->acceptsMimeTypes(['image/jpeg', 'image/png', 'image/webp']);
    }

    /**
     * Get the current settings record.
     */
    public static function current(): self
    {
        return static::firstOrCreate([], [
            'site_name' => 'Pamoja Real Estate',
            'logo_text' => 'PAMOJA',
            'hero_title' => 'Discover Your Heritage',
            'hero_cta_primary' => 'Browse for Sale',
            'hero_cta_secondary' => 'View Rentals',
            'contact_email' => 'concierge@pamoja.com',
            'contact_phone' => '+254 700 000 000',
            'footer_copy' => 'Crafted for Luxury & Excellence',
        ]);
    }
}
