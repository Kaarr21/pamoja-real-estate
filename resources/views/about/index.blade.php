@extends('layouts.app')

@section('title', $about->title ?? 'About Pamoja')

@section('content')
    <section class="hero" style="background-image: url('{{ $about->getFirstMediaUrl('hero_image') ?: 'https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?auto=format&fit=crop&q=80&w=2000' }}'); background-size: cover; background-position: center; padding: 10rem 0;">
        <div class="container animate-fade-up">
            <h1 style="color: white; text-shadow: 0 4px 12px rgba(0,0,0,0.3); font-family: 'Noto Serif', serif;">{{ $about->title ?? 'About Pamoja' }}</h1>
        </div>
    </section>

    <section class="section animate-fade-up" style="animation-delay: 0.2s; padding: 5rem 0;">
        <div class="container">
            <div style="max-width: 800px; margin: 0 auto;">
                <h2 style="margin-bottom: 2.5rem; color: hsl(var(--primary)); text-align: center; font-family: 'Noto Serif', serif;">Our Heritage & Vision</h2>
                <div class="prose" style="font-size: 1.15rem; line-height: 2; color: hsl(var(--text-muted));">
                    @if($about && $about->body)
                        {!! $about->body !!}
                    @else
                        <p style="margin-bottom: 1.8rem;">
                            Founded on the principles of integrity and excellence, Pamoja Real Estate is more than just a brokerage. We are curators of luxury living spaces, dedicated to matching extraordinary individuals with exceptional properties.
                        </p>
                        <p>
                            Our mission is to redefine the real estate experience through unparalleled service, deep market expertise, and a commitment to our clients' unique legacies.
                        </p>
                    @endif
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section class="section animate-fade-up" style="background-color: hsl(var(--surface-low)); padding: 5rem 0; animation-delay: 0.4s;">
        <div class="container">
            <div style="max-width: 800px; margin: 0 auto; text-align: center;">
                <h2 class="section-title" style="font-family: 'Noto Serif', serif;">Get in Touch</h2>
                <p style="margin-bottom: 3rem; color: hsl(var(--text-muted));">Experience the Pamoja difference. Inquire about our exclusive listings or schedule a private consultation.</p>
                
                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 3rem; margin-bottom: 4rem;">
                    <div>
                        <h4 style="color: hsl(var(--primary)); margin-bottom: 0.5rem; text-transform: uppercase; font-size: 0.8rem; letter-spacing: 0.1em;">Visit Our Office</h4>
                        <p>{!! nl2br(e($settings->contact_address ?? "Pamoja Towers, 15th Floor\nWestlands, Nairobi")) !!}</p>
                    </div>
                    <div>
                        <h4 style="color: hsl(var(--primary)); margin-bottom: 0.5rem; text-transform: uppercase; font-size: 0.8rem; letter-spacing: 0.1em;">Email Us</h4>
                        <p>{{ $settings->contact_email ?? 'concierge@pamoja.com' }}</p>
                    </div>
                    <div>
                        <h4 style="color: hsl(var(--primary)); margin-bottom: 0.5rem; text-transform: uppercase; font-size: 0.8rem; letter-spacing: 0.1em;">Call Us</h4>
                        <p>{{ $settings->contact_phone ?? '+254 700 000 000' }}</p>
                    </div>
                </div>

                <form class="glass" style="display: grid; gap: 1.5rem; text-align: left; padding: 3rem; border-radius: var(--radius); border: 1px solid hsla(var(--border) / 0.3);">
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem;">
                        <input type="text" placeholder="Full Name" style="padding: 1rem; border: 1px solid hsla(var(--border) / 0.5); border-radius: var(--radius); background: hsla(var(--surface) / 0.5); color: inherit;">
                        <input type="email" placeholder="Email Address" style="padding: 1rem; border: 1px solid hsla(var(--border) / 0.5); border-radius: var(--radius); background: hsla(var(--surface) / 0.5); color: inherit;">
                    </div>
                    <textarea placeholder="Your Message" rows="5" style="padding: 1rem; border: 1px solid hsla(var(--border) / 0.5); border-radius: var(--radius); background: hsla(var(--surface) / 0.5); color: inherit; font-family: inherit;"></textarea>
                    <button type="submit" class="btn btn-primary" style="justify-self: center; min-width: 200px;">Send Inquiry</button>
                </form>
            </div>
        </div>
    </section>
@endsection
