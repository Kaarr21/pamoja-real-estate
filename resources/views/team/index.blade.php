@extends('layouts.app')

@section('title', 'Our Team')

@section('content')
    <section class="section animate-fade-up" style="padding: 10rem 0 5rem;">
        <div class="container" style="text-align: center;">
            <h1 class="section-title">Curators of Heritage</h1>
            <p style="max-width: 700px; margin: 0 auto 5rem; font-size: 1.25rem; color: hsl(var(--text-muted));">Our team of dedicated professionals is here to guide you through every step of your luxury real estate journey.</p>

            <div class="property-grid">
                @forelse($members as $member)
                    <div class="property-card" style="text-align: left;">
                        <div class="property-image" style="background-image: url('{{ $member->getFirstMediaUrl('profile_images') ?: 'https://images.unsplash.com/photo-1560250097-0b93528c311a?auto=format&fit=crop&q=80&w=800' }}'); height: 400px;"></div>
                        <div class="property-info" style="padding: 2.5rem;">
                            <div style="text-transform: uppercase; letter-spacing: 0.1em; font-size: 0.75rem; font-weight: 700; color: hsl(var(--primary)); margin-bottom: 0.5rem;">
                                {{ $member->role }}
                            </div>
                            <h3 style="margin-bottom: 1rem; font-size: 1.75rem;">{{ $member->name }}</h3>
                            <div style="color: hsl(var(--text-muted)); font-size: 0.95rem; margin-bottom: 2rem; line-height: 1.8;">
                                {!! Str::limit(strip_tags($member->bio), 150) !!}
                            </div>
                            
                            <div style="display: flex; gap: 1.5rem; padding-top: 1.5rem; border-top: 1px solid hsla(var(--border) / 0.5);">
                                @if($member->linkedin_url)
                                    <a href="{{ $member->linkedin_url }}" target="_blank" style="color: hsl(var(--primary)); font-size: 0.8rem; font-weight: 600; text-transform: uppercase;">LinkedIn</a>
                                @endif
                                @if($member->instagram_url)
                                    <a href="{{ $member->instagram_url }}" target="_blank" style="color: hsl(var(--primary)); font-size: 0.8rem; font-weight: 600; text-transform: uppercase;">Instagram</a>
                                @endif
                            </div>
                        </div>
                    </div>
                @empty
                    <div style="grid-column: 1 / -1; text-align: center; padding: 6rem; background: hsl(var(--surface-low)); border-radius: var(--radius);">
                        <p style="color: hsl(var(--text-muted)); font-style: italic; font-size: 1.1rem;">Our curators are currently preparing the next exclusive collection. Please check back soon.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- Join Us Section -->
    <section class="section animate-fade-up" style="background-color: hsl(var(--surface-low)); text-align: center; padding: 8rem 0;">
        <div class="container">
            <h2 style="font-size: 3rem; margin-bottom: 2rem;">Join the Legacy</h2>
            <p style="max-width: 600px; margin: 0 auto 3.5rem; color: hsl(var(--text-muted)); font-size: 1.1rem;">
                Are you an exceptional real estate professional? We are always looking for visionary talent to join our curated team.
            </p>
            <a href="mailto:careers@pamoja.com" class="btn btn-outline" style="min-width: 250px;">Career Inquiries</a>
        </div>
    </section>
@endsection
