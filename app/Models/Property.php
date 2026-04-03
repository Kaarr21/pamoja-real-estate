<?php

namespace App\Models;

use App\Enums\PropertyStatus;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Property extends Model implements HasMedia
{
    use HasSlug, InteractsWithMedia;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'price',
        'status', // App\Enums\PropertyStatus
        'bedrooms',
        'bathrooms',
        'sqft',
        'is_featured',
        'location',
        'agent_id',
        'has_pool',
        'has_pets_allowed',
        'has_gym',
        'has_garden',
        'has_solar_panels',
        'has_parking',
        'has_security',
        'has_wifi',
        'is_furnished',
        'has_air_conditioning',
        'has_balcony',
        'has_cctv',
        'has_backup_generator',
        'has_water_tank',
        'has_elevator',
        'has_borehole',
        'has_staff_quarters',
        'has_fireplace',
        'seo_title',
        'seo_description',
        'seo_keywords',
    ];

    /**
     * Get the options for generating the slug.
     */
    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug');
    }

    /**
     * Register media collections.
     */
    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('images')
            ->acceptsMimeTypes(['image/jpeg', 'image/png', 'image/webp']);

        $this->addMediaCollection('videos')
            ->acceptsMimeTypes(['video/mp4', 'video/quicktime']);
    }

    /**
     * Get the agent that owns the property.
     */
    public function agent(): BelongsTo
    {
        return $this->belongsTo(User::class, 'agent_id');
    }

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'status' => PropertyStatus::class,
            'price' => 'decimal:2',
            'is_featured' => 'boolean',
            'has_pool' => 'boolean',
            'has_pets_allowed' => 'boolean',
            'has_gym' => 'boolean',
            'has_garden' => 'boolean',
            'has_solar_panels' => 'boolean',
            'has_parking' => 'boolean',
            'has_security' => 'boolean',
            'has_wifi' => 'boolean',
            'is_furnished' => 'boolean',
            'has_air_conditioning' => 'boolean',
            'has_balcony' => 'boolean',
            'has_cctv' => 'boolean',
            'has_backup_generator' => 'boolean',
            'has_water_tank' => 'boolean',
            'has_elevator' => 'boolean',
            'has_borehole' => 'boolean',
            'has_staff_quarters' => 'boolean',
            'has_fireplace' => 'boolean',
        ];
    }
}
