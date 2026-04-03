@extends('layouts.app')

@section('title', $property->title)
@section('meta_description', Str::limit(strip_tags($property->description), 160))

@section('content')
<!-- Tailwind CDN & Config from Stitch -->
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<link href="https://fonts.googleapis.com/css2?family=Noto+Serif:ital,wght@0,400;0,700;1,400&family=Manrope:wght@300;400;600;800&display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
<script>
    tailwind.config = {
        darkMode: "class",
        theme: {
            extend: {
                colors: {
                    "surface-bright": "#f9f9f9",
                    "on-secondary": "#ffffff",
                    "outline": "#7f7667",
                    "secondary-fixed": "#f6e0ba",
                    "on-tertiary-container": "#233a65",
                    "inverse-surface": "#2f3131",
                    "on-primary-fixed": "#261900",
                    "on-surface-variant": "#4e4639",
                    "on-secondary-fixed": "#251a04",
                    "primary": "#775a19",
                    "surface-container-lowest": "#ffffff",
                    "tertiary-container": "#8fa5d6",
                    "on-background": "#1a1c1c",
                    "surface": "#f9f9f9",
                    "secondary": "#6c5c3f",
                    "surface-variant": "#e2e2e2",
                    "background": "#f9f9f9",
                    "surface-container-low": "#f3f3f3",
                    "inverse-on-surface": "#f0f1f1",
                    "primary-fixed-dim": "#e9c176",
                    "on-error-container": "#93000a",
                    "surface-dim": "#dadada",
                    "surface-container": "#eeeeee",
                    "inverse-primary": "#e9c176",
                    "on-primary-container": "#4e3700",
                    "surface-container-highest": "#e2e2e2",
                    "tertiary-fixed": "#d8e2ff",
                    "error": "#ba1a1a",
                    "on-tertiary-fixed": "#001a41",
                    "surface-tint": "#775a19",
                    "tertiary": "#485e8b",
                    "outline-variant": "#d1c5b4",
                    "on-error": "#ffffff",
                    "primary-container": "#c5a059",
                    "on-primary": "#ffffff",
                    "error-container": "#ffdad6",
                    "on-secondary-container": "#736244",
                    "primary-fixed": "#ffdea5",
                    "on-primary-fixed-variant": "#5d4201",
                    "secondary-container": "#f6e0ba",
                    "on-secondary-fixed-variant": "#534529",
                    "surface-container-high": "#e8e8e8",
                    "on-tertiary": "#ffffff",
                    "tertiary-fixed-dim": "#b0c6f9",
                    "on-surface": "#1a1c1c",
                    "on-tertiary-fixed-variant": "#304671",
                    "secondary-fixed-dim": "#d9c4a0"
                },
                fontFamily: {
                    "headline": ["Noto Serif", "serif"],
                    "body": ["Manrope", "sans-serif"],
                    "label": ["Manrope", "sans-serif"]
                },
                borderRadius: {"DEFAULT": "0px", "lg": "0px", "xl": "0px", "full": "9999px"},
            },
        },
    }
</script>
<style>
    .material-symbols-outlined {
        font-variation-settings: 'FILL' 0, 'wght' 300, 'GRAD' 0, 'opsz' 24;
    }
    .hide-scrollbar::-webkit-scrollbar {
        display: none;
    }
    .hide-scrollbar {
        -ms-overflow-style: none;
        scrollbar-width: none;
    }
    .stitch-page { 
        font-family: 'Manrope', sans-serif; 
        background-color: hsl(var(--bg));
        color: hsl(var(--text));
        transition: background-color 0.5s ease, color 0.5s ease;
    }
    .stitch-page ::selection {
        background-color: #c5a059;
        color: #4e3700;
    }
    .dark .stitch-page {
        background-color: hsl(var(--bg));
        color: hsl(var(--text));
    }
</style>

<div class="stitch-page pt-10" x-data="{ 
    videoModalOpen: false, 
    currentVideoUrl: '',
    scrollArchive(direction) {
        const container = this.$refs.archiveScroll;
        const scrollAmount = window.innerWidth * 0.4;
        container.scrollBy({ left: direction * scrollAmount, behavior: 'smooth' });
    }
}">

    <!-- Hero Section -->
    <section class="max-w-[1920px] mx-auto px-6 md:px-12 py-12 md:py-20 grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
        <div class="lg:col-span-5 flex flex-col order-2 lg:order-1">
            <span class="font-label uppercase tracking-[0.3rem] text-[10px] text-primary mb-6 block">
                {{ $property->location ?? 'Exclusive Location' }}
            </span>
            <h1 class="font-headline text-5xl md:text-7xl lg:text-8xl tracking-tighter leading-[0.9] mb-8 dark:text-white">
                {!! nl2br(e(wordwrap($property->title, 15, "\n"))) !!}
            </h1>
            <p class="font-headline text-3xl md:text-4xl text-primary mb-12">KES {{ number_format($property->price) }}</p>
            
            <div class="flex gap-10 font-body text-sm border-t border-outline-variant/30 dark:border-white/10 pt-8 mb-12">
                @if($property->bedrooms)
                <div class="flex flex-col">
                    <span class="opacity-50 text-[10px] uppercase tracking-widest mb-1 dark:text-white/60">Bedrooms</span>
                    <span class="font-bold dark:text-white">{{ str_pad($property->bedrooms, 2, '0', STR_PAD_LEFT) }}</span>
                </div>
                @endif
                @if($property->bathrooms)
                <div class="flex flex-col">
                    <span class="opacity-50 text-[10px] uppercase tracking-widest mb-1 dark:text-white/60">Bathrooms</span>
                    <span class="font-bold dark:text-white">{{ str_pad($property->bathrooms, 2, '0', STR_PAD_LEFT) }}</span>
                </div>
                @endif
                @if($property->sqft)
                <div class="flex flex-col">
                    <span class="opacity-50 text-[10px] uppercase tracking-widest mb-1 dark:text-white/60">Area</span>
                    <span class="font-bold dark:text-white">{{ number_format($property->sqft) }} Sq Ft</span>
                </div>
                @endif
            </div>
            
            <a href="mailto:{{ $property->agent->email }}" class="bg-primary hover:bg-surface-tint text-on-primary px-12 py-5 font-label text-xs uppercase tracking-[0.2rem] transition-all w-fit no-underline text-center">ACQUIRE THE MANOR</a>
        </div>
        
        <div class="lg:col-span-7 aspect-[4/3] md:aspect-[16/10] overflow-hidden order-1 lg:order-2 border border-outline-variant/30 dark:border-white/10">
            <img alt="{{ $property->title }}" class="w-full h-full object-cover" src="{{ $images->first()?->getUrl() ?? 'https://via.placeholder.com/1200x800' }}" />
        </div>
    </section>

    <!-- Admin Tools Section (Curation Studio) -->
    @auth
        @if(auth()->user()->hasRole('admin') || auth()->id() === $property->agent_id)
        <section class="px-6 md:px-12 mb-32 max-w-[1920px] mx-auto">
            <div class="py-12 border-y border-outline-variant/30 dark:border-white/10">
                <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-10">
                    <div>
                        <h3 class="font-label uppercase tracking-[0.3rem] text-primary text-[10px] mb-2">Curation Studio</h3>
                        <p class="font-headline text-3xl dark:text-white">Administrative Controls</p>
                    </div>
                    <div class="flex flex-wrap gap-4">
                        <a href="/admin/properties/{{ $property->id }}/edit" class="border border-outline px-8 py-3 font-label text-[10px] uppercase tracking-widest hover:bg-surface-container transition-colors no-underline text-on-surface dark:text-white dark:border-white/30 dark:hover:bg-white/10">Edit Artifact</a>
                    </div>
                </div>
            </div>
        </section>
        @endif
    @endauth

    <!-- Narrative Section -->
    <section class="max-w-[1920px] mx-auto px-6 md:px-12 mb-32">
        <div class="max-w-4xl mx-auto text-center">
            <h2 class="font-headline text-4xl mb-8 italic dark:text-white">The Narrative</h2>
            <div class="font-body text-on-surface-variant dark:text-on-surface leading-relaxed text-lg text-left md:text-center prose prose-stone dark:prose-invert mx-auto">
                {!! $property->description !!}
            </div>
        </div>
    </section>

    <!-- Amenities Section -->
    @php
        $amenitiesMap = [
            'has_pool' => ['label' => 'Swimming Pool', 'icon' => 'pool'],
            'has_gym' => ['label' => 'Fitness Center', 'icon' => 'fitness_center'],
            'has_garden' => ['label' => 'Private Garden', 'icon' => 'yard'],
            'has_solar_panels' => ['label' => 'Solar Energy', 'icon' => 'solar_power'],
            'has_parking' => ['label' => 'Ample Parking', 'icon' => 'local_parking'],
            'has_security' => ['label' => '24/7 Security', 'icon' => 'security'],
            'has_wifi' => ['label' => 'High-speed WiFi', 'icon' => 'wifi'],
            'is_furnished' => ['label' => 'Fully Furnished', 'icon' => 'chair'],
            'has_air_conditioning' => ['label' => 'Air Conditioning', 'icon' => 'ac_unit'],
            'has_balcony' => ['label' => 'Private Balcony', 'icon' => 'balcony'],
            'has_cctv' => ['label' => 'CCTV Surveillance', 'icon' => 'videocam'],
            'has_backup_generator' => ['label' => 'Power Backup', 'icon' => 'electric_bolt'],
            'has_water_tank' => ['label' => 'Water Storage', 'icon' => 'water_drop'],
            'has_elevator' => ['label' => 'Passenger Lift', 'icon' => 'elevator'],
            'has_borehole' => ['label' => 'Borehole Water', 'icon' => 'water_well'],
            'has_staff_quarters' => ['label' => 'Staff Quarters', 'icon' => 'meeting_room'],
            'has_fireplace' => ['label' => 'Cozy Fireplace', 'icon' => 'fireplace'],
            'has_pets_allowed' => ['label' => 'Pets Allowed', 'icon' => 'pets'],
        ];

        $hasAmenities = false;
        foreach ($amenitiesMap as $field => $data) {
            if ($property->$field) {
                $hasAmenities = true;
                break;
            }
        }
    @endphp

    @if($hasAmenities)
    <section class="max-w-[1920px] mx-auto px-6 md:px-12 mb-32">
        <div class="py-20 border-t border-b border-outline-variant/30 dark:border-white/10">
            <h2 class="font-headline text-4xl md:text-5xl italic mb-16 text-center dark:text-white">The Amenities</h2>
            <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-y-16 gap-x-8">
                @foreach($amenitiesMap as $field => $data)
                    @if($property->$field)
                        <div class="flex flex-col items-center text-center group">
                            <div class="w-16 h-16 rounded-full border border-outline-variant/30 dark:border-white/10 flex items-center justify-center mb-6 group-hover:border-primary group-hover:bg-primary-container/10 transition-all">
                                <span class="material-symbols-outlined text-3xl group-hover:scale-110 transition-transform dark:text-white">
                                    {{ $data['icon'] }}
                                </span>
                            </div>
                            <span class="font-label text-[10px] uppercase tracking-[0.2rem] text-on-surface-variant dark:text-on-surface group-hover:text-primary transition-colors">
                                {{ $data['label'] }}
                            </span>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    </section>
    @endif

    <!-- Visual Archive -->
    <section class="mb-32 overflow-hidden">
        <div class="px-6 md:px-12 mb-12 flex justify-between items-end max-w-[1920px] mx-auto">
            <h2 class="font-headline text-4xl md:text-5xl italic dark:text-white">The Visual Archive</h2>
            <div class="flex gap-4">
                <button @click="scrollArchive(-1)" class="w-12 h-12 border border-outline-variant/30 dark:border-white/10 flex items-center justify-center hover:bg-surface-container transition-colors dark:hover:bg-white/10 dark:text-white">
                    <span class="material-symbols-outlined font-light">chevron_left</span>
                </button>
                <button @click="scrollArchive(1)" class="w-12 h-12 border border-outline-variant/30 dark:border-white/10 flex items-center justify-center hover:bg-surface-container transition-colors dark:hover:bg-white/10 dark:text-white">
                    <span class="material-symbols-outlined font-light">chevron_right</span>
                </button>
            </div>
        </div>
        
        <div x-ref="archiveScroll" class="flex gap-6 overflow-x-auto px-6 md:px-12 hide-scrollbar pb-8 snap-x snap-mandatory">
            <!-- Images -->
            @foreach($images as $image)
            <div class="w-[85vw] sm:w-[45vw] md:w-[20vw] lg:w-[15vw] flex-shrink-0 snap-center aspect-[4/5] md:aspect-[3/4] border border-outline-variant/30 dark:border-white/10">
                <img class="w-full h-full object-cover" alt="Gallery image" src="{{ $image->getUrl() }}" loading="lazy" />
            </div>
            @endforeach

            <!-- Videos -->
            @foreach($videos as $video)
            <div class="w-[85vw] sm:w-[45vw] md:w-[20vw] lg:w-[15vw] flex-shrink-0 snap-center relative group cursor-pointer aspect-[4/5] md:aspect-[3/4] border border-outline-variant/30 dark:border-white/10" 
                 @click="currentVideoUrl = '{{ $video->getUrl() }}'; videoModalOpen = true">
                <!-- Video Thumbnail -->
                <div class="w-full h-full bg-surface-container-high dark:bg-white/5 flex items-center justify-center relative overflow-hidden">
                    <video class="w-full h-full object-cover opacity-80 group-hover:opacity-100 transition-opacity" muted loop playsinline>
                        <source src="{{ $video->getUrl() }}#t=0.1" type="{{ $video->mime_type }}">
                    </video>
                    <!-- Play Button Overlay -->
                    <div class="absolute inset-0 flex items-center justify-center">
                        <div class="w-20 h-20 rounded-full bg-primary/80 backdrop-blur-sm flex items-center justify-center text-white transform group-hover:scale-110 transition-transform shadow-xl">
                            <span class="material-symbols-outlined text-4xl ml-1">play_arrow</span>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </section>

    <!-- Details/Agent Section -->
    <section class="py-24 border-t border-outline-variant/30 dark:border-white/10 px-6 md:px-12">
        <div class="max-w-[1920px] mx-auto grid grid-cols-1 gap-16 md:gap-12 md:grid-cols-2">
            <div class="flex flex-col h-full border-l border-outline-variant/30 dark:border-white/10 pl-8">
                <span class="font-label text-[10px] tracking-[0.2rem] text-primary uppercase mb-6 block">Property Status</span>
                <h4 class="font-headline text-3xl mb-8 dark:text-white">{{ $property->status->getLabel() }}</h4>
                <p class="font-body text-sm text-on-surface-variant dark:text-on-surface italic mt-auto">Details curated precisely for the distinguished buyer.</p>
            </div>
            <div class="flex flex-col h-full border-l border-outline-variant/30 dark:border-white/10 pl-8">
                <span class="font-label text-[10px] tracking-[0.2rem] text-primary uppercase mb-6 block">Agent Assignment</span>
                <h4 class="font-headline text-3xl mb-8 dark:text-white">{{ $property->agent->name }}</h4>
                <p class="font-body text-[10px] text-on-surface-variant dark:text-on-surface uppercase tracking-[0.2rem] mt-auto">Global Luxury Division</p>
            </div>
        </div>
    </section>

    <!-- Final CTA -->
    <section class="py-32 px-6 md:px-12 text-center max-w-[1920px] mx-auto border-t border-outline-variant/30 dark:border-white/10 mt-12">
        <h2 class="font-headline text-4xl md:text-6xl mb-16 italic max-w-4xl mx-auto leading-tight dark:text-white">The opportunity to redefine your horizon.</h2>
        <div class="flex flex-col md:flex-row justify-center gap-6 mb-24">
            <a href="mailto:{{ $property->agent->email }}" class="bg-primary hover:bg-surface-tint text-on-primary px-16 py-6 font-label uppercase tracking-[0.2rem] text-xs transition-all no-underline inline-block">ACQUIRE THE MANOR</a>
            <button class="border border-primary text-primary hover:bg-primary hover:text-white px-16 py-6 font-label uppercase tracking-[0.2rem] text-xs transition-all">REQUEST DOSSIER</button>
        </div>
        <div class="flex justify-center gap-10 flex-wrap opacity-60">
            <span class="font-label text-[10px] tracking-[0.3rem] text-on-surface dark:text-white">#LUXURYREALESTATE</span>
            <span class="font-label text-[10px] tracking-[0.3rem] text-on-surface dark:text-white">#PAMOJA</span>
            <span class="font-label text-[10px] tracking-[0.3rem] text-on-surface dark:text-white">#CURATEDLIVING</span>
        </div>
    </section>

    <!-- Video Modal overlay -->
    <div x-show="videoModalOpen" 
         x-transition.opacity
         style="display: none;"
         class="fixed inset-0 z-[100] bg-black/95 flex items-center justify-center p-4 md:p-12">
        
        <!-- Close Button -->
        <button @click="videoModalOpen = false; currentVideoUrl = ''; $refs.videoPlayer.pause()" 
                class="absolute top-6 right-6 text-white hover:text-primary transition-colors z-50">
            <span class="material-symbols-outlined text-4xl">close</span>
        </button>

        <!-- Video Player -->
        <div class="w-full max-w-6xl aspect-video rounded-xl overflow-hidden shadow-2xl ring-1 ring-white/10" @click.away="videoModalOpen = false; currentVideoUrl = ''; $refs.videoPlayer.pause()">
            <video x-ref="videoPlayer" 
                   :src="currentVideoUrl" 
                   class="w-full h-full object-contain bg-black" 
                   controls 
                   autoplay>
            </video>
        </div>
    </div>
</div>
@endsection