@extends('layouts.app')

@section('title', 'Nos Formations - Spot Welding Pro')

@section('content')
<div class="py-16 md:py-24">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="text-center mb-16">
            <span class="inline-block px-4 py-1.5 bg-cyber/10 border border-cyber/30 rounded-full text-cyber text-sm font-display tracking-wider mb-6">CATALOGUE</span>
            <h1 class="text-4xl md:text-5xl lg:text-6xl font-display font-black text-white mb-6">
                Nos <span class="gradient-text">Formations</span>
            </h1>
            <p class="text-xl text-gray-400 max-w-3xl mx-auto">
                Maîtrisez le soudage par points avec nos formations PDF complètes,
                conçues par un expert avec 15 ans d'expérience dans l'industrie.
            </p>
        </div>

        <!-- Formations Grid -->
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($formations as $formation)
            <div class="card-techno rounded-2xl overflow-hidden group glow-border">
                <!-- Level indicator -->
                <div class="h-1.5 bg-gradient-to-r
                    @if($formation->slug == 'formation-debutant') from-cyber to-cyber/50
                    @elseif($formation->slug == 'formation-intermediaire') from-neon to-neon/50
                    @elseif($formation->slug == 'formation-expert') from-plasma to-plasma/50
                    @else from-spark to-spark/50 @endif"></div>

                @if($formation->cover_image)
                <div class="relative h-48 overflow-hidden">
                    <img src="{{ asset('storage/' . $formation->cover_image) }}" alt="{{ $formation->name }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    <div class="absolute inset-0 bg-gradient-to-t from-abyss to-transparent"></div>
                </div>
                @else
                <div class="h-48 bg-gradient-to-br from-steel to-abyss flex items-center justify-center relative overflow-hidden">
                    <div class="absolute inset-0 opacity-10">
                        <svg class="w-full h-full" viewBox="0 0 100 100" fill="none">
                            <pattern id="grid-{{ $formation->id }}" width="10" height="10" patternUnits="userSpaceOnUse">
                                <path d="M 10 0 L 0 0 0 10" fill="none" stroke="currentColor" stroke-width="0.5" class="text-cyber"/>
                            </pattern>
                            <rect width="100" height="100" fill="url(#grid-{{ $formation->id }})"/>
                        </svg>
                    </div>
                    <svg class="w-20 h-20 text-cyber/30 relative" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                </div>
                @endif

                <div class="p-6">
                    <div class="flex items-center justify-between mb-4">
                        <span class="px-3 py-1 text-xs font-display font-semibold tracking-wider rounded-full
                            @if($formation->slug == 'formation-debutant') bg-cyber/10 text-cyber border border-cyber/30
                            @elseif($formation->slug == 'formation-intermediaire') bg-neon/10 text-neon border border-neon/30
                            @elseif($formation->slug == 'formation-expert') bg-plasma/10 text-plasma border border-plasma/30
                            @else bg-spark/10 text-spark border border-spark/30 @endif">
                            {{ strtoupper($formation->level_label ?? 'FORMATION') }}
                        </span>
                        @if($formation->is_bundle)
                        <span class="px-3 py-1 bg-spark/20 text-spark text-xs font-display font-semibold rounded-full border border-spark/30">
                            PACK
                        </span>
                        @endif
                    </div>

                    <h3 class="text-xl font-display font-bold text-white mb-2 group-hover:text-cyber transition-colors">{{ $formation->name }}</h3>
                    <p class="text-gray-400 mb-6 line-clamp-2 text-sm">{{ $formation->short_description }}</p>

                    <div class="flex items-center justify-between pt-4 border-t border-cyber/10">
                        <div>
                            @if($formation->is_on_sale)
                            <span class="text-gray-500 line-through text-sm">{{ number_format($formation->price, 0, ',', ' ') }}€</span>
                            @endif
                            <span class="price-tag text-2xl font-bold">{{ number_format($formation->current_price, 0, ',', ' ') }}€</span>
                        </div>
                        <a href="{{ route('formations.show', $formation->slug) }}"
                           class="btn-cyber px-4 py-2 rounded-lg font-display text-sm">
                            Voir détails
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <!-- CTA Section -->
        <div class="mt-20 relative">
            <div class="card-techno rounded-3xl p-8 md:p-12 text-center border-spark/30 overflow-hidden">
                <div class="absolute inset-0 bg-gradient-to-r from-cyber/5 via-neon/5 to-plasma/5"></div>
                <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-cyber via-neon to-plasma"></div>

                <div class="relative">
                    <span class="inline-flex items-center gap-2 px-4 py-1.5 bg-spark/20 border border-spark/40 rounded-full text-spark font-display font-bold text-sm tracking-wider mb-6">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z" />
                        </svg>
                        MEILLEURE OFFRE
                    </span>

                    <h2 class="text-3xl md:text-4xl font-display font-black text-white mb-4">
                        Pack Complet - <span class="gradient-text">Économisez 68€</span>
                    </h2>
                    <p class="text-gray-400 mb-8 max-w-2xl mx-auto text-lg">
                        Accédez à toutes nos formations avec le pack complet et bénéficiez d'une réduction exclusive.
                    </p>

                    @php
                        $bundle = $formations->where('is_bundle', true)->first();
                    @endphp
                    @if($bundle)
                    <a href="{{ route('formations.show', $bundle->slug) }}"
                       class="btn-neon px-8 py-4 rounded-xl font-display text-lg inline-flex items-center gap-3">
                        Découvrir le Pack Complet
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                        </svg>
                    </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
