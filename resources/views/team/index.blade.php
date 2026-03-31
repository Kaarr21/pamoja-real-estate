@extends('layouts.app')

@section('title', 'Our Team')

@section('content')
    <section class="section" style="padding-top: 8rem; text-align: center;">
        <div class="container">
            <h1 style="font-size: 3.5rem; margin-bottom: 1.5rem;">The Curators of Heritage</h1>
            <p style="max-width: 700px; margin: 0 auto 4rem; color: var(--text-muted); font-size: 1.1rem;">
                Meet the extraordinary individuals who bring the Pamoja vision to life. Our team is composed of dedicated experts committed to excellence in luxury real estate.
            </p>

            <div class="property-grid" style="grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));">
                @forelse($members as $member)
                    <div style="background: var(--surface); border-radius: var(--radius); padding: 3rem 2rem; text-align: center; box-shadow: var(--shadow); transition: var(--transition);">
                        <div style="width: 150px; height: 150px; border-radius: 50%; margin: 0 auto 2rem; background: var(--surface-high); background-image: url('{{ $member->getFirstMediaUrl('profile_image') ?: "https://ui-avatars.com/api/?name=" . urlencode($member->name) . "&background=C5A059&color=fff&size=150" }}'); background-size: cover; background-position: center;">
                        </div>
                        <h3 style="font-size: 1.75rem; margin-bottom: 0.5rem;">{{ $member->name }}</h3>
                        <p style="color: var(--primary-color); font-weight: 600; text-transform: uppercase; font-size: 0.75rem; letter-spacing: 0.1em; margin-bottom: 1.5rem;">
                            {{ $member->role }}
                        </p>
                        <div style="color: var(--text-muted); font-size: 0.95rem; margin-bottom: 2rem; line-height: 1.6;">
                            {!! $member->bio !!}
                        </div>
                        
                        <div style="display: flex; justify-content: center; gap: 1rem;">
                            @if($member->linkedin_url)
                                <a href="{{ $member->linkedin_url }}" target="_blank" style="color: var(--primary-color);">LinkedIn</a>
                            @endif
                            @if($member->instagram_url)
                                <a href="{{ $member->instagram_url }}" target="_blank" style="color: var(--primary-color);">Instagram</a>
                            @endif
                        </div>
                    </div>
                @empty
                    <div style="grid-column: 1 / -1; text-align: center; padding: 4rem; background: var(--surface-low); border-radius: var(--radius);">
                        <p style="color: var(--text-muted); font-style: italic;">Our curators are currently preparing the next exclusive collection. Please check back soon.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- Join Us Section -->
    <section class="section" style="background-color: var(--surface-low); text-align: center;">
        <div class="container">
            <h2 style="font-size: 2.5rem; margin-bottom: 1.5rem;">Join the Legacy</h2>
            <p style="max-width: 600px; margin: 0 auto 3rem; color: var(--text-muted);">
                Are you an exceptional real estate professional? We are always looking for visionary talent to join our curated team.
            </p>
            <a href="/about" class="btn btn-primary">Career Inquiries</a>
        </div>
    </section>
@endsection
