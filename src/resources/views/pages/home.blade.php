@extends('layouts.app')

@section('title', 'Formations Soudage par Points | Mang-Ky Ha - Expert Industriel')

@section('content')
    <!-- Hero Section -->
    <section class="relative min-h-[90vh] flex items-center overflow-hidden">
        <!-- Animated background elements -->
        <div class="absolute inset-0 overflow-hidden">
            <!-- Glowing orbs -->
            <div class="absolute top-1/4 -left-20 w-96 h-96 bg-cyber/20 rounded-full blur-[120px] animate-pulse"></div>
            <div class="absolute bottom-1/4 -right-20 w-80 h-80 bg-neon/20 rounded-full blur-[100px] animate-pulse" style="animation-delay: 1s;"></div>

            <!-- Diagonal lines -->
            <div class="absolute inset-0" style="background: repeating-linear-gradient(45deg, transparent, transparent 100px, rgba(0,245,255,0.02) 100px, rgba(0,245,255,0.02) 101px);"></div>

            <!-- Circuit pattern SVG -->
            <svg class="absolute bottom-0 left-0 w-full h-64 opacity-5" viewBox="0 0 1200 200" fill="none">
                <path d="M0 100 L100 100 L120 80 L200 80 L220 100 L400 100" stroke="currentColor" stroke-width="2" class="text-cyber"/>
                <path d="M400 100 L500 100 L520 120 L700 120 L720 100 L1200 100" stroke="currentColor" stroke-width="2" class="text-cyber"/>
                <circle cx="400" cy="100" r="5" fill="currentColor" class="text-cyber"/>
                <circle cx="720" cy="100" r="5" fill="currentColor" class="text-neon"/>
            </svg>
        </div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24">
            <div class="grid lg:grid-cols-2 gap-16 items-center">
                <!-- Text Content -->
                <div class="text-center lg:text-left">
                    <!-- Status badge -->
                    <div class="inline-flex items-center gap-3 px-5 py-2.5 bg-steel/50 border border-cyber/20 rounded-full mb-8 backdrop-blur-sm">
                        <span class="relative flex h-2.5 w-2.5">
                            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-success opacity-75"></span>
                            <span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-success"></span>
                        </span>
                        <span class="text-sm text-gray-300 font-medium tracking-wide">15 ans d'expertise industrielle</span>
                    </div>

                    <!-- Headline -->
                    <h1 class="text-4xl md:text-5xl lg:text-6xl font-display font-black text-white mb-6 leading-[1.1] tracking-tight">
                        Maîtrisez le
                        <span class="block gradient-text">Soudage par Points</span>
                        <span class="text-3xl md:text-4xl lg:text-5xl text-gray-400 font-bold">comme un Ingénieur</span>
                    </h1>

                    <!-- Subheadline -->
                    <p class="text-lg md:text-xl text-gray-400 mb-10 leading-relaxed max-w-xl mx-auto lg:mx-0">
                        Formations techniques 100% PDF par <span class="text-cyber font-semibold">Mang-Ky Ha</span> — Expert en soudage de batteries lithium pour l'industrie automobile.
                    </p>

                    <!-- CTA Buttons -->
                    <div class="flex flex-col sm:flex-row items-center justify-center lg:justify-start gap-4">
                        <a href="{{ route('formations.index') }}" class="btn-cyber px-8 py-4 rounded-xl font-display text-base flex items-center gap-3 w-full sm:w-auto justify-center">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                            </svg>
                            Découvrir les Formations
                        </a>
                        <a href="#pack-complet" class="btn-neon px-8 py-4 rounded-xl font-display text-base w-full sm:w-auto text-center">
                            Pack Complet -20%
                        </a>
                    </div>

                    <!-- Trust indicators -->
                    <div class="mt-12 flex flex-wrap items-center justify-center lg:justify-start gap-6 text-sm text-gray-500">
                        <div class="flex items-center gap-2">
                            <svg class="w-5 h-5 text-success" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            <span>Téléchargement immédiat</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <svg class="w-5 h-5 text-success" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            <span>Accès à vie</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <svg class="w-5 h-5 text-success" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            <span>Satisfait ou remboursé</span>
                        </div>
                    </div>
                </div>

                <!-- Hero Image / Visual -->
                <div class="relative hidden lg:block">
                    <div class="relative aspect-square max-w-lg mx-auto">
                        <!-- Decorative rings -->
                        <div class="absolute inset-0 border-2 border-cyber/20 rounded-full animate-pulse"></div>
                        <div class="absolute inset-8 border border-neon/20 rounded-full" style="animation: pulse 3s infinite; animation-delay: 0.5s;"></div>
                        <div class="absolute inset-16 border border-cyber/30 rounded-full" style="animation: pulse 3s infinite; animation-delay: 1s;"></div>

                        <!-- Central content -->
                        <div class="absolute inset-24 bg-gradient-to-br from-steel to-abyss rounded-full flex items-center justify-center border border-cyber/30 overflow-hidden manga-filter scanlines">
                            <img src="/images/formateur-original.jpg" alt="Mang-Ky Ha" class="w-full h-full object-cover" onerror="this.parentElement.innerHTML='<div class=\'text-6xl font-display font-black gradient-text\'>MK</div>'">
                        </div>

                        <!-- Floating badges -->
                        <div class="absolute top-12 -right-4 px-4 py-2 bg-abyss/90 backdrop-blur-sm border border-cyber/30 rounded-lg animate-float">
                            <span class="text-cyber font-display font-bold">15+ ANS</span>
                        </div>
                        <div class="absolute bottom-12 -left-4 px-4 py-2 bg-abyss/90 backdrop-blur-sm border border-neon/30 rounded-lg animate-float" style="animation-delay: 2s;">
                            <span class="text-neon font-display font-bold">50K+ SOUDURES</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Scroll indicator -->
        <div class="absolute bottom-8 left-1/2 -translate-x-1/2 flex flex-col items-center gap-2 text-gray-500 animate-bounce">
            <span class="text-xs tracking-widest uppercase">Scroll</span>
            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3" />
            </svg>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="py-16 border-y border-cyber/10 bg-abyss/50">
        <div class="max-w-7xl mx-auto px-4">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
                <div class="text-center group">
                    <div class="text-4xl md:text-5xl font-display font-black text-cyber mb-2 group-hover:scale-110 transition-transform">15+</div>
                    <div class="text-sm text-gray-400 uppercase tracking-wider">Années d'expérience</div>
                </div>
                <div class="text-center group">
                    <div class="text-4xl md:text-5xl font-display font-black text-neon mb-2 group-hover:scale-110 transition-transform">50K+</div>
                    <div class="text-sm text-gray-400 uppercase tracking-wider">Soudures analysées</div>
                </div>
                <div class="text-center group">
                    <div class="text-4xl md:text-5xl font-display font-black text-plasma mb-2 group-hover:scale-110 transition-transform">12</div>
                    <div class="text-sm text-gray-400 uppercase tracking-wider">Programmes véhicules</div>
                </div>
                <div class="text-center group">
                    <div class="text-4xl md:text-5xl font-display font-black text-spark mb-2 group-hover:scale-110 transition-transform">350+</div>
                    <div class="text-sm text-gray-400 uppercase tracking-wider">Pages de contenu</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Why Different Section -->
    <section class="py-24">
        <div class="max-w-7xl mx-auto px-4">
            <div class="text-center mb-16">
                <span class="inline-block px-4 py-1.5 bg-cyber/10 border border-cyber/30 rounded-full text-cyber text-sm font-display tracking-wider mb-6">POURQUOI NOUS</span>
                <h2 class="text-3xl md:text-4xl lg:text-5xl font-display font-black text-white mb-6">
                    Ce qui rend nos formations <span class="gradient-text">uniques</span>
                </h2>
                <p class="text-xl text-gray-400 max-w-2xl mx-auto">Du savoir industriel documenté, pas des tutoriels approximatifs.</p>
            </div>

            <div class="grid md:grid-cols-2 gap-8 max-w-5xl mx-auto">
                <!-- What we're NOT -->
                <div class="card-techno rounded-2xl p-8 relative overflow-hidden group">
                    <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-danger/50 to-transparent"></div>
                    <h3 class="text-xl font-display font-bold text-danger mb-6 flex items-center gap-3">
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                        Ce que nous ne sommes PAS
                    </h3>
                    <ul class="space-y-4">
                        @foreach(['Des tutoriels YouTube approximatifs', 'Des conseils génériques copiés-collés', 'De la théorie sans applications concrètes', 'Du contenu sponsorisé par un fabricant'] as $item)
                        <li class="flex items-start gap-3 text-gray-400">
                            <svg class="w-5 h-5 text-danger/60 mt-0.5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                            {{ $item }}
                        </li>
                        @endforeach
                    </ul>
                </div>

                <!-- What we ARE -->
                <div class="card-techno rounded-2xl p-8 relative overflow-hidden group border-success/20">
                    <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-success/50 to-transparent"></div>
                    <h3 class="text-xl font-display font-bold text-success mb-6 flex items-center gap-3">
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        Ce que nous sommes
                    </h3>
                    <ul class="space-y-4">
                        @foreach(['Protocoles industriels réels utilisés en production', 'Paramètres exacts (courant, temps, force) documentés', 'Retours d\'expérience sur +50 000 soudures analysées', 'Erreurs coûteuses et comment les éviter'] as $item)
                        <li class="flex items-start gap-3 text-gray-300">
                            <svg class="w-5 h-5 text-success mt-0.5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            {{ $item }}
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- Formations Section -->
    <section class="py-24 bg-abyss/30" id="formations">
        <div class="max-w-7xl mx-auto px-4">
            <div class="text-center mb-16">
                <span class="inline-block px-4 py-1.5 bg-neon/10 border border-neon/30 rounded-full text-neon text-sm font-display tracking-wider mb-6">NOS FORMATIONS</span>
                <h2 class="text-3xl md:text-4xl lg:text-5xl font-display font-black text-white mb-6">
                    Choisissez votre <span class="gradient-text">niveau</span>
                </h2>
                <p class="text-xl text-gray-400 max-w-2xl mx-auto">Du débutant sérieux à l'expert industriel, progressez à votre rythme.</p>
            </div>

            <div class="grid md:grid-cols-3 gap-8">
                @foreach($formations as $formation)
                <div class="card-techno rounded-2xl overflow-hidden group glow-border">
                    <!-- Level indicator -->
                    <div class="h-1.5 bg-gradient-to-r
                        @if($formation->slug == 'formation-debutant') from-cyber to-cyber/50
                        @elseif($formation->slug == 'formation-intermediaire') from-neon to-neon/50
                        @elseif($formation->slug == 'formation-expert') from-plasma to-plasma/50
                        @else from-spark to-spark/50 @endif"></div>

                    <div class="p-8">
                        <!-- Badge -->
                        <span class="inline-block px-3 py-1 text-xs font-display font-semibold tracking-wider rounded-full mb-6
                            @if($formation->slug == 'formation-debutant') bg-cyber/10 text-cyber border border-cyber/30
                            @elseif($formation->slug == 'formation-intermediaire') bg-neon/10 text-neon border border-neon/30
                            @elseif($formation->slug == 'formation-expert') bg-plasma/10 text-plasma border border-plasma/30
                            @else bg-spark/10 text-spark border border-spark/30 @endif">
                            {{ strtoupper($formation->level ?? 'FORMATION') }}
                        </span>

                        <h3 class="text-2xl font-display font-bold text-white mb-3">{{ $formation->title }}</h3>
                        <p class="text-gray-400 mb-6 line-clamp-2">{{ $formation->short_description }}</p>

                        <!-- Features -->
                        <ul class="space-y-3 mb-8">
                            <li class="flex items-center gap-3 text-sm text-gray-400">
                                <svg class="w-4 h-4 text-cyber" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                                Format PDF Premium
                            </li>
                            <li class="flex items-center gap-3 text-sm text-gray-400">
                                <svg class="w-4 h-4 text-cyber" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                                </svg>
                                Téléchargement instantané
                            </li>
                        </ul>

                        <!-- Price -->
                        <div class="flex items-end justify-between mb-6">
                            <div>
                                @if($formation->original_price && $formation->original_price > $formation->price)
                                <span class="text-gray-500 line-through text-sm">{{ number_format($formation->original_price, 0, ',', ' ') }}€</span>
                                @endif
                                <div class="price-tag text-3xl font-bold">{{ number_format($formation->price, 0, ',', ' ') }}€</div>
                            </div>
                            @if($formation->original_price && $formation->original_price > $formation->price)
                            <span class="px-2 py-1 bg-success/20 text-success text-xs font-display rounded">
                                -{{ round((1 - $formation->price / $formation->original_price) * 100) }}%
                            </span>
                            @endif
                        </div>

                        <!-- Actions -->
                        <div class="flex gap-3">
                            <a href="{{ route('formations.show', $formation->slug) }}" class="flex-1 px-4 py-3 text-center text-gray-300 bg-steel/50 hover:bg-steel rounded-lg transition-colors font-medium">
                                Détails
                            </a>
                            <form action="{{ route('cart.add', $formation->slug) }}" method="POST" class="flex-1">
                                @csrf
                                <button type="submit" class="w-full btn-cyber px-4 py-3 rounded-lg font-display text-sm">
                                    Ajouter
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Pack Complet Section -->
    <section class="py-24" id="pack-complet">
        <div class="max-w-5xl mx-auto px-4">
            <div class="relative card-techno rounded-3xl overflow-hidden border-spark/30">
                <!-- Decorative background -->
                <div class="absolute inset-0 bg-gradient-to-br from-cyber/5 via-transparent to-neon/5"></div>
                <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-cyber via-neon to-plasma"></div>

                <div class="relative p-8 md:p-12">
                    <!-- Badge -->
                    <div class="text-center mb-8">
                        <span class="inline-flex items-center gap-2 px-5 py-2 bg-spark/20 border border-spark/40 rounded-full text-spark font-display font-bold tracking-wider">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z" />
                            </svg>
                            MEILLEURE OFFRE
                        </span>
                    </div>

                    <h2 class="text-3xl md:text-4xl lg:text-5xl font-display font-black text-white text-center mb-4">
                        Pack Complet <span class="gradient-text">3 Formations</span>
                    </h2>
                    <p class="text-xl text-gray-400 text-center mb-12">Économisez 68€ avec le pack complet</p>

                    <div class="grid md:grid-cols-2 gap-12 items-center">
                        <!-- What's included -->
                        <div>
                            <h3 class="font-display font-semibold text-white mb-6 tracking-wider">CE QUI EST INCLUS :</h3>
                            <ul class="space-y-4">
                                @foreach($formations->where('is_bundle', false) as $formation)
                                <li class="flex items-center gap-4 p-3 bg-steel/30 rounded-lg border border-cyber/10">
                                    <svg class="w-6 h-6 text-success flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <span class="text-gray-300">{{ $formation->title }}</span>
                                    <span class="ml-auto text-gray-500">{{ number_format($formation->price, 0) }}€</span>
                                </li>
                                @endforeach
                                <li class="flex items-center gap-4 p-3 bg-spark/10 rounded-lg border border-spark/20">
                                    <svg class="w-6 h-6 text-spark flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v13m0-13V6a2 2 0 112 2h-2zm0 0V5.5A2.5 2.5 0 109.5 8H12zm-7 4h14M5 12a2 2 0 110-4h14a2 2 0 110 4M5 12v7a2 2 0 002 2h10a2 2 0 002-2v-7" />
                                    </svg>
                                    <span class="text-spark font-medium">Mises à jour gratuites à vie</span>
                                </li>
                            </ul>
                        </div>

                        <!-- Price and CTA -->
                        <div class="text-center">
                            <div class="mb-4">
                                <span class="text-2xl text-gray-500 line-through">347€</span>
                                <span class="ml-3 px-3 py-1 bg-success/20 text-success font-display font-bold rounded">-20%</span>
                            </div>
                            <div class="price-tag text-6xl font-black mb-2">279€</div>
                            <p class="text-gray-400 mb-8">Paiement unique • Accès immédiat</p>

                            @php
                                $bundleFormation = $formations->where('is_bundle', true)->first();
                            @endphp
                            @if($bundleFormation)
                            <form action="{{ route('cart.add', $bundleFormation->slug) }}" method="POST">
                                @csrf
                                <button type="submit" class="w-full btn-cyber px-8 py-5 rounded-xl font-display text-lg">
                                    Commander le Pack Complet
                                </button>
                            </form>
                            @endif

                            <p class="mt-6 text-sm text-gray-500 flex items-center justify-center gap-2">
                                <svg class="w-4 h-4 text-success" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                </svg>
                                Satisfait ou remboursé 30 jours
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Expert Section -->
    <section class="py-24 bg-abyss/30" id="formateur">
        <div class="max-w-7xl mx-auto px-4">
            <div class="grid lg:grid-cols-2 gap-16 items-center">
                <!-- Image -->
                <div class="relative order-2 lg:order-1">
                    <div class="relative max-w-md mx-auto">
                        <!-- Background decorations -->
                        <div class="absolute -inset-4 bg-gradient-to-br from-cyber/20 via-transparent to-neon/20 rounded-3xl blur-2xl"></div>

                        <!-- Main image container -->
                        <div class="relative aspect-[4/5] rounded-2xl overflow-hidden border-2 border-cyber/20 manga-filter scanlines">
                            <img src="/images/formateur-original.jpg" alt="Mang-Ky Ha - Expert Soudage" class="w-full h-full object-cover"
                                 onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                            <div class="hidden w-full h-full bg-gradient-to-br from-steel to-abyss items-center justify-center">
                                <span class="text-8xl font-display font-black gradient-text">MK</span>
                            </div>

                            <!-- Overlay gradient -->
                            <div class="absolute inset-0 bg-gradient-to-t from-void via-transparent to-transparent"></div>
                        </div>

                        <!-- Floating stats -->
                        <div class="absolute -top-6 -right-6 px-5 py-3 bg-abyss/95 backdrop-blur-sm border border-cyber/30 rounded-xl shadow-2xl animate-float">
                            <div class="text-2xl font-display font-black text-cyber">15+</div>
                            <div class="text-xs text-gray-400 uppercase tracking-wider">ans expertise</div>
                        </div>

                        <div class="absolute -bottom-6 -left-6 px-5 py-3 bg-abyss/95 backdrop-blur-sm border border-neon/30 rounded-xl shadow-2xl animate-float" style="animation-delay: 1.5s;">
                            <div class="text-2xl font-display font-black text-neon">50K+</div>
                            <div class="text-xs text-gray-400 uppercase tracking-wider">soudures</div>
                        </div>
                    </div>
                </div>

                <!-- Content -->
                <div class="order-1 lg:order-2">
                    <span class="inline-block px-4 py-1.5 bg-plasma/10 border border-plasma/30 rounded-full text-plasma text-sm font-display tracking-wider mb-6">VOTRE FORMATEUR</span>

                    <h2 class="text-3xl md:text-4xl lg:text-5xl font-display font-black text-white mb-6">
                        Mang-Ky <span class="gradient-text">Ha</span>
                    </h2>

                    <blockquote class="text-xl text-gray-300 italic mb-8 pl-6 border-l-4 border-cyber">
                        "J'ai passé 15 ans à souder des batteries pour des constructeurs automobiles que vous connaissez tous. Aujourd'hui, je transmets ce savoir."
                    </blockquote>

                    <ul class="space-y-4 mb-10">
                        @foreach([
                            'Ingénieur procédés - Spécialiste assemblage batteries',
                            'Ex-industrie automobile (R&D batteries haute performance)',
                            '+50 000 soudures analysées et documentées',
                            'Consultant indépendant depuis 2020'
                        ] as $item)
                        <li class="flex items-center gap-4 text-gray-300">
                            <span class="flex-shrink-0 w-8 h-8 bg-cyber/10 rounded-lg flex items-center justify-center">
                                <svg class="w-5 h-5 text-cyber" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                            </span>
                            {{ $item }}
                        </li>
                        @endforeach
                    </ul>

                    <a href="{{ route('formations.index') }}" class="btn-neon px-6 py-3 rounded-xl font-display inline-flex items-center gap-2">
                        Voir mes formations
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Final CTA Section -->
    <section class="py-24 relative overflow-hidden">
        <!-- Background effects -->
        <div class="absolute inset-0">
            <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[600px] h-[600px] bg-cyber/10 rounded-full blur-[150px]"></div>
        </div>

        <div class="relative max-w-4xl mx-auto px-4 text-center">
            <h2 class="text-3xl md:text-4xl lg:text-5xl font-display font-black text-white mb-6">
                Prêt à souder <span class="gradient-text">comme un Pro</span> ?
            </h2>
            <p class="text-xl text-gray-400 mb-10 max-w-2xl mx-auto">
                Choisissez votre niveau et commencez aujourd'hui. Téléchargement immédiat après paiement.
            </p>
            <a href="{{ route('formations.index') }}" class="btn-cyber px-10 py-5 rounded-xl font-display text-lg inline-flex items-center gap-3">
                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                </svg>
                Voir toutes les Formations
            </a>
        </div>
    </section>
@endsection
