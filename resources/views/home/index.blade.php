@extends('layouts.app')

@section('title', 'Home')

@section('content')
    <section class="hero">
        <div class="container">
            <h1>{{ $settings->hero_title ?? 'Discover Your Heritage' }}</h1>
            <p>{{ $settings->hero_subtitle ?? 'Premium real estate curated for excellence. Find your next masterpiece with Pamoja.' }}</p>
            <div class="hero-actions" style="display: flex; align-items: center; gap: 1rem;">
                <a href="#sale" class="btn btn-primary">{{ $settings->hero_cta_primary ?? 'Browse for Sale' }}</a>
                <a href="#rent" class="btn btn-outline">{{ $settings->hero_cta_secondary ?? 'View Rentals' }}</a>
                @auth
                    @if(auth()->user()->hasRole(['admin', 'agent', 'panel_user', 'super_admin']))
                        <a href="{{ route('filament.admin.resources.properties.create') }}" class="btn btn-primary" style="background: var(--accent-color); border-color: var(--accent-color);">
                            List Your Property
                        </a>
                    @endif
                @endauth
            </div>
        </div>
    </section>

    <!-- For Sale Section -->
    <section id="sale" class="section">
        <div class="container">
            <h2 class="section-title">Properties for Sale</h2>
            @if($forSale->isEmpty())
                <p style="text-align: center; color: var(--text-muted);">No luxury estates available for sale at the moment.</p>
            @else
                <div class="property-grid">
                    @foreach($forSale as $property)
                        <div class="property-card">
                            <div class="property-image" style="background-image: url('{{ $property->getFirstMediaUrl('images') ?: 'https://images.unsplash.com/photo-1512917774080-9991f1c4c750?auto=format&fit=crop&q=80&w=800' }}')">
                                <span class="property-status">For Sale</span>
                            </div>
                            <div class="property-info">
                                <h3>{{ $property->title }}</h3>
                                <div class="property-price">KES {{ number_format($property->price, 2) }}</div>
                                <div class="property-location">{{ $property->location ?: 'Nairobi, Kenya' }}</div>
                                
                                @can('update', $property)
                                    <div style="margin-top: 1rem; border-top: 1px solid var(--border-color); pt: 0.5rem;">
                                        <a href="{{ route('filament.admin.resources.properties.edit', $property) }}" class="btn btn-outline btn-sm" style="font-size: 0.8rem; padding: 0.25rem 0.75rem;">
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
    <section id="rent" class="section" style="background-color: var(--surface-low);">
        <div class="container">
            <h2 class="section-title">Premium Rentals</h2>
            @if($forRent->isEmpty())
                <p style="text-align: center; color: var(--text-muted);">Our exclusive rental collection is currently fully occupied.</p>
            @else
                <div class="property-grid">
                    @foreach($forRent as $property)
                        <div class="property-card">
                            <div class="property-image" style="background-image: url('{{ $property->getFirstMediaUrl('images') ?: 'https://images.unsplash.com/photo-1513584684374-8bdb7489feef?auto=format&fit=crop&q=80&w=800' }}')">
                                <span class="property-status" style="background: var(--primary-color);">For Rent</span>
                            </div>
                            <div class="property-info">
                                <h3>{{ $property->title }}</h3>
                                <div class="property-price">KES {{ number_format($property->price, 2) }} / mo</div>
                                <div class="property-location">{{ $property->location ?: 'Mombasa, Kenya' }}</div>

                                @can('update', $property)
                                    <div style="margin-top: 1rem; border-top: 1px solid var(--border-color); pt: 0.5rem;">
                                        <a href="{{ route('filament.admin.resources.properties.edit', $property) }}" class="btn btn-outline btn-sm" style="font-size: 0.8rem; padding: 0.25rem 0.75rem;">
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
    <section id="sold" class="section">
        <div class="container">
            <h2 class="section-title">Recently Acquired</h2>
            @if($sold->isEmpty())
                <p style="text-align: center; color: var(--text-muted);">Curating our next collection of sold masterpieces.</p>
            @else
                <div class="property-grid">
                    @foreach($sold as $property)
                        <div class="property-card" style="opacity: 0.8;">
                            <div class="property-image" style="background-image: url('{{ $property->getFirstMediaUrl('images') ?: 'https://images.unsplash.com/photo-1518780664697-55e3ad937233?auto=format&fit=crop&q=80&w=800' }}')">
                                <span class="property-status" style="background: #1c1b1b;">Sold</span>
                            </div>
                            <div class="property-info">
                                <h3>{{ $property->title }}</h3>
                                <div class="property-price">SOLD</div>
                                <div class="property-location">{{ $property->location }}</div>

                                @can('update', $property)
                                    <div style="margin-top: 1rem; border-top: 1px solid var(--border-color); pt: 0.5rem;">
                                        <a href="{{ route('filament.admin.resources.properties.edit', $property) }}" class="btn btn-outline btn-sm" style="font-size: 0.8rem; padding: 0.25rem 0.75rem;">
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
