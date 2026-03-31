@extends('layouts.app')

@section('title', $about->title ?? 'About & Contact')

@section('content')
    <section class="section" style="padding-top: 8rem;">
        <div class="container">
            <div style="display: flex; gap: 4rem; align-items: center; flex-wrap: wrap;">
                <div style="flex: 1; min-width: 300px;">
                    <h1 style="font-size: 3.5rem; margin-bottom: 2rem;">{{ $about->title ?? 'The Pamoja Heritage' }}</h1>
                    <div class="rich-text" style="font-size: 1.1rem; color: var(--text-muted);">
                        @if($about)
                            {!! $about->body !!}
                        @else
                            <p style="margin-bottom: 1.5rem;">
                                Founded on the principles of integrity and excellence, Pamoja Real Estate is more than just a brokerage. We are curators of luxury living spaces, dedicated to matching extraordinary individuals with exceptional properties.
                            </p>
                            <p>
                                Our mission is to redefine the real estate experience through unparalleled service, deep market expertise, and a commitment to our clients' unique legacies.
                            </p>
                        @endif
                    </div>
                </div>
                <div style="flex: 1; min-width: 300px;">
                    <img src="{{ $about ? ($about->getFirstMediaUrl('hero_image') ?: 'https://images.unsplash.com/photo-1560518883-ce09059eeffa?auto=format&fit=crop&q=80&w=1000') : 'https://images.unsplash.com/photo-1560518883-ce09059eeffa?auto=format&fit=crop&q=80&w=1000' }}" alt="About Pamoja" style="width: 100%; border-radius: var(--radius); box-shadow: var(--shadow);">
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section class="section" style="background-color: var(--surface-low);">
        <div class="container">
            <div style="max-width: 800px; margin: 0 auto; text-align: center;">
                <h2 class="section-title">Get in Touch</h2>
                <p style="margin-bottom: 3rem; color: var(--text-muted);">Experience the Pamoja difference. Inquire about our exclusive listings or schedule a private consultation.</p>
                
                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 3rem; margin-bottom: 4rem;">
                    <div>
                        <h4 style="color: var(--primary-color); margin-bottom: 0.5rem; text-transform: uppercase; font-size: 0.8rem; letter-spacing: 0.1em;">Visit Our Office</h4>
                        <p>{!! nl2br(e($settings->contact_address ?? "Pamoja Towers, 15th Floor\nWestlands, Nairobi")) !!}</p>
                    </div>
                    <div>
                        <h4 style="color: var(--primary-color); margin-bottom: 0.5rem; text-transform: uppercase; font-size: 0.8rem; letter-spacing: 0.1em;">Email Us</h4>
                        <p>{{ $settings->contact_email ?? 'concierge@pamoja.com' }}</p>
                    </div>
                    <div>
                        <h4 style="color: var(--primary-color); margin-bottom: 0.5rem; text-transform: uppercase; font-size: 0.8rem; letter-spacing: 0.1em;">Call Us</h4>
                        <p>{{ $settings->contact_phone ?? '+254 700 000 000' }}</p>
                    </div>
                </div>

                <form style="display: grid; gap: 1.5rem; text-align: left; background: var(--surface); padding: 3rem; border-radius: var(--radius); shadow: var(--shadow);">
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem;">
                        <input type="text" placeholder="Full Name" style="padding: 1rem; border: 1px solid var(--surface-high); border-radius: var(--radius); background: var(--bg-color);">
                        <input type="email" placeholder="Email Address" style="padding: 1rem; border: 1px solid var(--surface-high); border-radius: var(--radius); background: var(--bg-color);">
                    </div>
                    <textarea placeholder="Your Message" rows="5" style="padding: 1rem; border: 1px solid var(--surface-high); border-radius: var(--radius); background: var(--bg-color); font-family: inherit;"></textarea>
                    <button type="submit" class="btn btn-primary" style="justify-self: center;">Send Inquiry</button>
                </form>
            </div>
        </div>
    </section>
@endsection
