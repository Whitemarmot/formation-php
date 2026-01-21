@extends('layouts.app')

@section('title', $formation->name . ' - Spot Welding Pro')

@section('content')
<div class="py-12 md:py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Breadcrumb -->
        <nav class="mb-8">
            <ol class="flex items-center space-x-2 text-sm text-gray-400">
                <li><a href="{{ route('home') }}" class="hover:text-cyber transition-colors">Accueil</a></li>
                <li><span class="text-gray-600">/</span></li>
                <li><a href="{{ route('formations.index') }}" class="hover:text-cyber transition-colors">Formations</a></li>
                <li><span class="text-gray-600">/</span></li>
                <li class="text-white">{{ $formation->name }}</li>
            </ol>
        </nav>

        <div class="grid lg:grid-cols-3 gap-12">
            <!-- Main Content -->
            <div class="lg:col-span-2 space-y-8">
                <div class="card-techno rounded-2xl p-8 border-cyber/20">
                    <div class="flex flex-wrap items-center gap-3 mb-6">
                        <span class="px-4 py-1.5 font-display font-semibold text-sm tracking-wider rounded-full
                            @if($formation->slug == 'fondamentaux') bg-cyber/10 text-cyber border border-cyber/30
                            @elseif($formation->slug == 'maitrise') bg-neon/10 text-neon border border-neon/30
                            @elseif($formation->slug == 'excellence') bg-plasma/10 text-plasma border border-plasma/30
                            @else bg-spark/10 text-spark border border-spark/30 @endif">
                            {{ strtoupper($formation->level_label ?? 'FORMATION') }}
                        </span>
                        @if($formation->is_featured)
                        <span class="px-4 py-1.5 bg-spark/20 text-spark font-display font-semibold text-sm rounded-full border border-spark/30">
                            POPULAIRE
                        </span>
                        @endif
                    </div>

                    <h1 class="text-3xl md:text-4xl font-display font-black text-white mb-6">{{ $formation->name }}</h1>

                    <p class="text-xl text-gray-300 mb-8 leading-relaxed">{{ $formation->short_description }}</p>

                    <div class="prose prose-invert max-w-none prose-p:text-gray-400 prose-headings:font-display prose-headings:text-white prose-strong:text-cyber">
                        {!! $formation->description !!}
                    </div>

                    @if(!empty($formation->table_of_contents) && is_array($formation->table_of_contents))
                    <div class="mt-10 pt-8 border-t border-cyber/10">
                        <h2 class="text-2xl font-display font-bold text-white mb-6 flex items-center gap-3">
                            <svg class="w-6 h-6 text-cyber" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16" />
                            </svg>
                            Table des matières
                        </h2>
                        <div class="bg-steel/30 rounded-xl p-6 border border-cyber/10 space-y-2">
                            @foreach($formation->table_of_contents as $tocItem)
                                @if(is_array($tocItem))
                                <div class="flex items-baseline gap-3">
                                    <span class="text-cyber font-mono text-sm">p.{{ $tocItem['page'] ?? '?' }}</span>
                                    <span class="text-gray-300">{{ $tocItem['title'] ?? '' }}</span>
                                </div>
                                    @if(isset($tocItem['children']) && is_array($tocItem['children']))
                                        @foreach($tocItem['children'] as $childItem)
                                            @if(is_array($childItem))
                                            <div class="flex items-baseline gap-3 pl-6">
                                                <span class="text-cyber/70 font-mono text-sm">p.{{ $childItem['page'] ?? '?' }}</span>
                                                <span class="text-gray-400 text-sm">{{ $childItem['title'] ?? '' }}</span>
                                            </div>
                                            @endif
                                        @endforeach
                                    @endif
                                @endif
                            @endforeach
                        </div>
                    </div>
                    @endif
                </div>

                <!-- Features Grid -->
                <div class="grid sm:grid-cols-2 gap-6">
                    <div class="card-techno rounded-xl p-6">
                        <div class="w-12 h-12 bg-cyber/10 rounded-xl flex items-center justify-center mb-4 border border-cyber/20">
                            <svg class="w-6 h-6 text-cyber" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                            </svg>
                        </div>
                        <h3 class="text-lg font-display font-semibold text-white mb-2">Format PDF Premium</h3>
                        <p class="text-gray-400 text-sm">Document professionnel optimisé pour l'impression et la lecture sur écran.</p>
                    </div>

                    <div class="card-techno rounded-xl p-6">
                        <div class="w-12 h-12 bg-success/10 rounded-xl flex items-center justify-center mb-4 border border-success/20">
                            <svg class="w-6 h-6 text-success" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                            </svg>
                        </div>
                        <h3 class="text-lg font-display font-semibold text-white mb-2">Téléchargement Instantané</h3>
                        <p class="text-gray-400 text-sm">Accès immédiat après paiement, disponible pendant 7 jours.</p>
                    </div>

                    <div class="card-techno rounded-xl p-6">
                        <div class="w-12 h-12 bg-neon/10 rounded-xl flex items-center justify-center mb-4 border border-neon/20">
                            <svg class="w-6 h-6 text-neon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                            </svg>
                        </div>
                        <h3 class="text-lg font-display font-semibold text-white mb-2">Document Sécurisé</h3>
                        <p class="text-gray-400 text-sm">PDF personnalisé avec watermark pour votre protection.</p>
                    </div>

                    <div class="card-techno rounded-xl p-6">
                        <div class="w-12 h-12 bg-plasma/10 rounded-xl flex items-center justify-center mb-4 border border-plasma/20">
                            <svg class="w-6 h-6 text-plasma" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z"></path>
                            </svg>
                        </div>
                        <h3 class="text-lg font-display font-semibold text-white mb-2">Support Expert</h3>
                        <p class="text-gray-400 text-sm">Questions ? Notre équipe d'experts est là pour vous aider.</p>
                    </div>
                </div>
            </div>

            <!-- Sidebar - Purchase Card -->
            <div class="lg:col-span-1">
                <div class="sticky top-28">
                    <div class="card-techno rounded-2xl overflow-hidden border-cyber/30">
                        <!-- Top gradient -->
                        <div class="h-1.5 bg-gradient-to-r from-cyber via-neon to-plasma"></div>

                        @if($formation->cover_image)
                        <img src="{{ asset('storage/' . $formation->cover_image) }}" alt="{{ $formation->name }}" class="w-full h-48 object-cover">
                        @else
                        <div class="w-full h-48 bg-gradient-to-br from-steel to-abyss flex items-center justify-center relative overflow-hidden">
                            <div class="absolute inset-0 opacity-20">
                                <svg class="w-full h-full" viewBox="0 0 100 100" fill="none">
                                    <pattern id="grid-card" width="10" height="10" patternUnits="userSpaceOnUse">
                                        <path d="M 10 0 L 0 0 0 10" fill="none" stroke="currentColor" stroke-width="0.5" class="text-cyber"/>
                                    </pattern>
                                    <rect width="100" height="100" fill="url(#grid-card)"/>
                                </svg>
                            </div>
                            <svg class="w-20 h-20 text-cyber/30 relative" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                        </div>
                        @endif

                        <div class="p-6">
                            <div class="text-center mb-6">
                                @if($formation->is_on_sale)
                                <div class="mb-2 flex items-center justify-center gap-3">
                                    <span class="text-gray-500 line-through text-lg">{{ number_format($formation->price, 0, ',', ' ') }}€</span>
                                    <span class="px-2 py-1 bg-success/20 text-success text-sm font-display font-bold rounded">
                                        -{{ $formation->discount_percentage }}%
                                    </span>
                                </div>
                                @endif
                                <div class="price-tag text-5xl font-black">{{ number_format($formation->current_price, 0, ',', ' ') }}€</div>
                                <p class="text-gray-400 mt-2 text-sm">TTC - Paiement unique</p>
                            </div>

                            <form action="{{ route('cart.add', $formation->slug) }}" method="POST">
                                @csrf

                                <button type="submit" class="w-full btn-cyber py-4 rounded-xl font-display text-base flex items-center justify-center gap-3">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                    </svg>
                                    Ajouter au panier
                                </button>
                            </form>

                            <div class="mt-6 pt-6 border-t border-cyber/10 space-y-3">
                                <div class="flex items-center gap-3 text-gray-400 text-sm">
                                    <svg class="w-5 h-5 text-success flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    <span>Paiement sécurisé (Stripe/PayPal)</span>
                                </div>
                                <div class="flex items-center gap-3 text-gray-400 text-sm">
                                    <svg class="w-5 h-5 text-success flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    <span>Accès instantané après paiement</span>
                                </div>
                                <div class="flex items-center gap-3 text-gray-400 text-sm">
                                    <svg class="w-5 h-5 text-success flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    <span>Satisfait ou remboursé 30 jours</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Expert Info -->
                    <div class="mt-6 card-techno rounded-xl p-6">
                        <div class="flex items-center gap-4 mb-4">
                            <div class="w-14 h-14 bg-gradient-to-br from-cyber/20 to-neon/20 rounded-xl flex items-center justify-center border border-cyber/20">
                                <span class="text-xl font-display font-black gradient-text">MK</span>
                            </div>
                            <div>
                                <h4 class="text-white font-display font-semibold">Mang-Ky Ha</h4>
                                <p class="text-cyber text-sm">Expert Soudage par Points</p>
                            </div>
                        </div>
                        <p class="text-gray-400 text-sm">
                            15+ années d'expérience dans l'industrie automobile et la fabrication de batteries.
                            Formateur certifié et auteur de nombreuses publications techniques.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
