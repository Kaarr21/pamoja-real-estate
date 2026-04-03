@extends('layouts.app')

@section('title', 'Home')

@section('content')
    <section class="hero" style="background-image: url('{{ $settings->getFirstMediaUrl('hero_image') ?: 'https://images.unsplash.com/photo-1600585154340-be6161a56a0c?auto=format&fit=crop&q=80&w=2000' }}'); background-size: cover; background-position: center;">
        <div class="container animate-fade-up">
            <h1>{{ $settings->hero_title ?? 'Discover Your Heritage' }}</h1>
            <p>{{ $settings->hero_subtitle ?? 'Premium real estate curated for excellence. Find your next masterpiece with Pamoja.' }}</p>
            <div class="hero-actions" style="display: flex; align-items: center; justify-content: center; gap: 1.5rem;">
                <a href="#sale" class="btn btn-primary">{{ $settings->hero_cta_primary ?? 'Browse for Sale' }}</a>
                <a href="#rent" class="btn btn-outline">{{ $settings->hero_cta_secondary ?? 'View Rentals' }}</a>
            </div>
        </div>
    </section>

    <!-- For Sale Section -->
    <section id="sale" class="section animate-fade-up" style="animation-delay: 0.2s;">
        <div class="container">
            <h2 class="section-title">Properties for Sale</h2>
            @if($forSale->isEmpty())
                <p style="text-align: center; color: hsl(var(--text-muted)); font-style: italic;">No luxury estates available for sale at the moment.</p>
            @else
                <div class="property-grid">
                    @foreach($forSale as $property)
                        <div class="property-card">
                            <a href="{{ route('properties.show', $property) }}">
                                <div class="property-image" style="background-image: url('{{ $property->getFirstMediaUrl('images') ?: 'https://images.unsplash.com/photo-1512917774080-9991f1c4c750?auto=format&fit=crop&q=80&w=800' }}')">
                                    <span class="property-badge">For Sale</span>
                                </div>
                            </a>
                            <div class="property-info">
                                <div class="property-location" style="text-transform: uppercase; letter-spacing: 0.1em; font-size: 0.75rem; font-weight: 700; color: hsl(var(--primary)); margin-bottom: 0.5rem;">
                                    {{ $property->location ?: 'Nairobi, Kenya' }}
                                </div>
                                <a href="{{ route('properties.show', $property) }}">
                                    <h3 style="margin-bottom: 1rem;">{{ $property->title }}</h3>
                                </a>
                                <div class="property-price">KES {{ number_format($property->price, 0) }}</div>
                                
                                <div class="property-meta">
                                    <div class="meta-item">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" style="width: 18px; height: 18px;">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 7.5l-9-5.25L3 7.5m18 0l-9 5.25m9-5.25v9l-9 5.25M3 7.5l9 5.25M3 7.5v9l9 5.25m0-9v9" />
                                        </svg>
                                        {{ (int)$property->bedrooms }} Beds
                                    </div>
                                    <div class="meta-item">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" style="width: 18px; height: 18px;">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 21v-4.875c0-.621.504-1.125 1.125-1.125h5.25c.621 0 1.125.504 1.125 1.125V21m0 0h4.5V3.545M12.75 21h7.5V10.75M2.25 21h1.5m18 0h.5M2.25 9l4.5-1.636M18.75 3l-1.5.545m0 6.205l3 1m1.5.5l-1.5-.5M6.75 7.364V3h-3.5v18m3.5-13.636l4.5-1.636m0 0L21 3" />
                                        </svg>
                                        {{ (int)$property->bathrooms }} Baths
                                    </div>
                                    <div class="meta-item">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" style="width: 18px; height: 18px;">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 3.75v16.5h16.5V3.75H3.75zM12 6.75v10.5m-3.75-3.75h7.5" />
                                        </svg>
                                        {{ number_format($property->sqft, 0) }} sqft
                                    </div>
                                </div>
                                
                                @can('update', $property)
                                    <div style="margin-top: 2rem; pt: 1rem; border-top: 1px solid hsla(var(--border) / 0.5);">
                                        <a href="{{ route('filament.admin.resources.properties.edit', $property) }}" class="btn btn-outline" style="padding: 0.5rem 1rem; font-size: 0.7rem; width: 100%;">
                                            Manage Listing
                                        </a>
                                    </div>
                                @endcan
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </section>

    <!-- For Rent Section -->
    <section id="rent" class="section animate-fade-up" style="background-color: hsl(var(--surface-low)); animation-delay: 0.4s;">
        <div class="container">
            <h2 class="section-title">Premium Rentals</h2>
            @if($forRent->isEmpty())
                <p style="text-align: center; color: hsl(var(--text-muted)); font-style: italic;">Our exclusive rental collection is currently fully occupied.</p>
            @else
                <div class="property-grid">
                    @foreach($forRent as $property)
                        <div class="property-card">
                            <a href="{{ route('properties.show', $property) }}">
                                <div class="property-image" style="background-image: url('{{ $property->getFirstMediaUrl('images') ?: 'https://images.unsplash.com/photo-1513584684374-8bdb7489feef?auto=format&fit=crop&q=80&w=800' }}')">
                                    <span class="property-badge">For Rent</span>
                                </div>
                            </a>
                            <div class="property-info">
                                <div class="property-location" style="text-transform: uppercase; letter-spacing: 0.1em; font-size: 0.75rem; font-weight: 700; color: hsl(var(--primary)); margin-bottom: 0.5rem;">
                                    {{ $property->location ?: 'Mombasa, Kenya' }}
                                </div>
                                <a href="{{ route('properties.show', $property) }}">
                                    <h3 style="margin-bottom: 1rem;">{{ $property->title }}</h3>
                                </a>
                                <div class="property-price">KES {{ number_format($property->price, 0) }} / mo</div>
                                
                                <div class="property-meta">
                                    <div class="meta-item">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" style="width: 18px; height: 18px;">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 7.5l-9-5.25L3 7.5m18 0l-9 5.25m9-5.25v9l-9 5.25M3 7.5l9 5.25M3 7.5v9l9 5.25m0-9v9" />
                                        </svg>
                                        {{ (int)$property->bedrooms }} Beds
                                    </div>
                                    <div class="meta-item">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" style="width: 18px; height: 18px;">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 21v-4.875c0-.621.504-1.125 1.125-1.125h5.25c.621 0 1.125.504 1.125 1.125V21m0 0h4.5V3.545M12.75 21h7.5V10.75M2.25 21h1.5m18 0h.5M2.25 9l4.5-1.636M18.75 3l-1.5.545m0 6.205l3 1m1.5.5l-1.5-.5M6.75 7.364V3h-3.5v18m3.5-13.636l4.5-1.636m0 0L21 3" />
                                        </svg>
                                        {{ (int)$property->bathrooms }} Baths
                                    </div>
                                    <div class="meta-item">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" style="width: 18px; height: 18px;">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 3.75v16.5h16.5V3.75H3.75zM12 6.75v10.5m-3.75-3.75h7.5" />
                                        </svg>
                                        {{ number_format($property->sqft, 0) }} sqft
                                    </div>
                                </div>

                                @can('update', $property)
                                    <div style="margin-top: 2rem; pt: 1rem; border-top: 1px solid hsla(var(--border) / 0.5);">
                                        <a href="{{ route('filament.admin.resources.properties.edit', $property) }}" class="btn btn-outline" style="padding: 0.5rem 1rem; font-size: 0.7rem; width: 100%;">
                                            Manage Listing
                                        </a>
                                    </div>
                                @endcan
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </section>

    <!-- Recently Sold Section -->
    <section id="sold" class="section animate-fade-up" style="animation-delay: 0.6s; border-top: 1px solid hsla(var(--border) / 0.5);">
        <div class="container" style="opacity: 0.75;">
            <h2 class="section-title">Recently Acquired</h2>
            @if($sold->isEmpty())
                <p style="text-align: center; color: hsl(var(--text-muted)); font-style: italic;">Curating our next collection of sold masterpieces.</p>
            @else
                <div class="property-grid">
                    @foreach($sold as $property)
                        <div class="property-card">
                            <a href="{{ route('properties.show', $property) }}">
                                <div class="property-image" style="filter: grayscale(1); background-image: url('{{ $property->getFirstMediaUrl('images') ?: 'https://images.unsplash.com/photo-1518780664697-55e3ad937233?auto=format&fit=crop&q=80&w=800' }}')">
                                    <span class="property-badge" style="background: hsl(var(--text)); color: hsl(var(--surface));">Sold</span>
                                </div>
                            </a>
                            <div class="property-info">
                                <div class="property-location" style="text-transform: uppercase; letter-spacing: 0.1em; font-size: 0.75rem; font-weight: 700; color: hsl(var(--text-muted)); margin-bottom: 0.5rem;">
                                    {{ $property->location }}
                                </div>
                                <a href="{{ route('properties.show', $property) }}">
                                    <h3 style="margin-bottom: 1rem;">{{ $property->title }}</h3>
                                </a>
                                <div class="property-price" style="color: hsl(var(--text-muted));">ARCHIVED</div>
                                
                                <div class="property-meta" style="opacity: 0.6;">
                                    <div class="meta-item">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" style="width: 18px; height: 18px;">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 7.5l-9-5.25L3 7.5m18 0l-9 5.25m9-5.25v9l-9 5.25M3 7.5l9 5.25M3 7.5v9l9 5.25m0-9v9" />
                                        </svg>
                                        {{ (int)$property->bedrooms }} Beds
                                    </div>
                                    <div class="meta-item">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" style="width: 18px; height: 18px;">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 21v-4.875c0-.621.504-1.125 1.125-1.125h5.25c.621 0 1.125.504 1.125 1.125V21m0 0h4.5V3.545M12.75 21h7.5V10.75M2.25 21h1.5m18 0h.5M2.25 9l4.5-1.636M18.75 3l-1.5.545m0 6.205l3 1m1.5.5l-1.5-.5M6.75 7.364V3h-3.5v18m3.5-13.636l4.5-1.636m0 0L21 3" />
                                        </svg>
                                        {{ (int)$property->bathrooms }} Baths
                                    </div>
                                </div>

                                @can('update', $property)
                                    <div style="margin-top: 2rem; pt: 1rem; border-top: 1px solid hsla(var(--border) / 0.5);">
                                        <a href="{{ route('filament.admin.resources.properties.edit', $property) }}" class="btn btn-outline" style="padding: 0.5rem 1rem; font-size: 0.7rem; width: 100%;">
                                            Manage Listing
                                        </a>
                                    </div>
                                @endcan
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </section>
@endsection
