@extends('layouts.app')

@section('title', 'Nos Formations - Spot Welding Pro')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="text-center mb-12">
            <h1 class="text-4xl font-bold text-white mb-4">
                Nos <span class="text-primary">Formations</span>
            </h1>
            <p class="text-xl text-gray-400 max-w-3xl mx-auto">
                Maîtrisez le soudage par points avec nos formations PDF complètes,
                conçues par un expert avec 15 ans d'expérience dans l'industrie.
            </p>
        </div>

        <!-- Formations Grid -->
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($formations as $formation)
            <div class="bg-darkcard rounded-xl overflow-hidden border border-gray-700 hover:border-primary transition-colors duration-300">
                @if($formation->image)
                <img src="{{ asset('storage/' . $formation->image) }}" alt="{{ $formation->title }}" class="w-full h-48 object-cover">
                @else
                <div class="w-full h-48 bg-gradient-to-br from-primary/20 to-secondary/20 flex items-center justify-center">
                    <svg class="w-16 h-16 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                </div>
                @endif

                <div class="p-6">
                    <div class="flex items-center justify-between mb-3">
                        <span class="px-3 py-1 bg-primary/20 text-primary text-sm font-medium rounded-full">
                            {{ $formation->level }}
                        </span>
                        @if($formation->is_bundle)
                        <span class="px-3 py-1 bg-secondary/20 text-secondary text-sm font-medium rounded-full">
                            Pack
                        </span>
                        @endif
                    </div>

                    <h3 class="text-xl font-bold text-white mb-2">{{ $formation->title }}</h3>
                    <p class="text-gray-400 mb-4 line-clamp-3">{{ $formation->short_description }}</p>

                    <div class="flex items-center justify-between">
                        <div>
                            @if($formation->original_price && $formation->original_price > $formation->price)
                            <span class="text-gray-500 line-through text-sm">{{ number_format($formation->original_price, 2, ',', ' ') }} €</span>
                            @endif
                            <span class="text-2xl font-bold text-primary">{{ number_format($formation->price, 2, ',', ' ') }} €</span>
                        </div>
                        <a href="{{ route('formations.show', $formation->slug) }}"
                           class="px-4 py-2 bg-primary hover:bg-primary/80 text-white font-medium rounded-lg transition-colors">
                            Voir détails
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <!-- CTA Section -->
        <div class="mt-16 bg-gradient-to-r from-primary/20 to-secondary/20 rounded-2xl p-8 md:p-12 text-center border border-primary/30">
            <h2 class="text-3xl font-bold text-white mb-4">Pack Complet - Économisez 68€</h2>
            <p class="text-gray-300 mb-6 max-w-2xl mx-auto">
                Accédez à toutes nos formations avec le pack complet et bénéficiez d'une réduction exclusive.
            </p>
            <a href="{{ route('formations.show', 'pack-complet') }}"
               class="inline-block px-8 py-4 bg-secondary hover:bg-secondary/80 text-dark font-bold rounded-xl transition-colors">
                Découvrir le Pack Complet
            </a>
        </div>
    </div>
</div>
@endsection
