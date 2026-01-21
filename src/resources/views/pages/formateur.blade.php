@extends('layouts.app')

@section('title', 'Kangy Ham - Expert Soudage par Points | Spot Welding Pro')

@section('content')
<div class="py-16 md:py-24">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Hero Section -->
        <div class="grid lg:grid-cols-2 gap-16 items-center mb-24">
            <!-- Image -->
            <div class="relative">
                <div class="relative max-w-md mx-auto">
                    <div class="absolute -inset-4 bg-gradient-to-br from-cyber/20 via-transparent to-neon/20 rounded-3xl blur-2xl"></div>
                    <div class="relative aspect-[4/5] rounded-2xl overflow-hidden border-2 border-cyber/20">
                        <img src="/images/formateur-original.jpg" alt="Kangy Ham - Expert Soudage" class="w-full h-full object-cover"
                             onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                        <div class="hidden w-full h-full bg-gradient-to-br from-steel to-abyss items-center justify-center">
                            <span class="text-8xl font-display font-black gradient-text">KH</span>
                        </div>
                        <div class="absolute inset-0 bg-gradient-to-t from-void via-transparent to-transparent"></div>
                    </div>

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
            <div>
                <span class="inline-block px-4 py-1.5 bg-plasma/10 border border-plasma/30 rounded-full text-plasma text-sm font-display tracking-wider mb-6">VOTRE FORMATEUR</span>

                <h1 class="text-4xl md:text-5xl lg:text-6xl font-display font-black text-white mb-6">
                    Kangy <span class="gradient-text">Ham</span>
                </h1>

                <p class="text-xl text-gray-300 mb-8">
                    Ingenieur Procedes - Specialiste assemblage batteries lithium haute performance
                </p>

                <blockquote class="text-lg text-gray-300 italic mb-8 pl-6 border-l-4 border-cyber">
                    "J'ai passe 15 ans a souder des batteries pour des constructeurs automobiles que vous connaissez tous. Aujourd'hui, je transmets ce savoir."
                </blockquote>
            </div>
        </div>

        <!-- Parcours Section -->
        <div class="mb-24">
            <h2 class="text-3xl font-display font-bold text-white mb-12 text-center">
                Mon <span class="gradient-text">Parcours</span>
            </h2>

            <div class="grid md:grid-cols-3 gap-8">
                <div class="card-techno rounded-2xl p-8 text-center">
                    <div class="w-16 h-16 bg-cyber/10 rounded-full flex items-center justify-center mx-auto mb-6 border border-cyber/30">
                        <svg class="w-8 h-8 text-cyber" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-display font-bold text-white mb-3">Formation Initiale</h3>
                    <p class="text-gray-400">Diplome d'ingenieur en genie des materiaux, specialisation procedes d'assemblage metalliques.</p>
                </div>

                <div class="card-techno rounded-2xl p-8 text-center">
                    <div class="w-16 h-16 bg-neon/10 rounded-full flex items-center justify-center mx-auto mb-6 border border-neon/30">
                        <svg class="w-8 h-8 text-neon" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-display font-bold text-white mb-3">Industrie Automobile</h3>
                    <p class="text-gray-400">15 ans chez des equipementiers Tier 1, R&D batteries haute performance pour vehicules electriques.</p>
                </div>

                <div class="card-techno rounded-2xl p-8 text-center">
                    <div class="w-16 h-16 bg-plasma/10 rounded-full flex items-center justify-center mx-auto mb-6 border border-plasma/30">
                        <svg class="w-8 h-8 text-plasma" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-display font-bold text-white mb-3">Formateur & Consultant</h3>
                    <p class="text-gray-400">Depuis 2020, consultant independant et formateur specialise en soudage par points et assemblage batteries.</p>
                </div>
            </div>
        </div>

        <!-- Expertise Section -->
        <div class="mb-24">
            <h2 class="text-3xl font-display font-bold text-white mb-12 text-center">
                Domaines d'<span class="gradient-text">Expertise</span>
            </h2>

            <div class="grid md:grid-cols-2 gap-8">
                <div class="card-techno rounded-xl p-6 flex items-start gap-4">
                    <div class="w-12 h-12 bg-cyber/10 rounded-lg flex items-center justify-center flex-shrink-0 border border-cyber/20">
                        <svg class="w-6 h-6 text-cyber" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                        </svg>
                    </div>
                    <div>
                        <h4 class="text-lg font-display font-semibold text-white mb-2">Soudage par Resistance</h4>
                        <p class="text-gray-400">Soudage par points, par bossage, par molette. Maitrise des parametres et optimisation des cycles.</p>
                    </div>
                </div>

                <div class="card-techno rounded-xl p-6 flex items-start gap-4">
                    <div class="w-12 h-12 bg-neon/10 rounded-lg flex items-center justify-center flex-shrink-0 border border-neon/20">
                        <svg class="w-6 h-6 text-neon" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 3v2m6-2v2M9 19v2m6-2v2M5 9H3m2 6H3m18-6h-2m2 6h-2M7 19h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2zM9 9h6v6H9V9z" />
                        </svg>
                    </div>
                    <div>
                        <h4 class="text-lg font-display font-semibold text-white mb-2">Batteries Lithium</h4>
                        <p class="text-gray-400">Assemblage de packs batteries, soudage des collecteurs, gestion thermique des soudures.</p>
                    </div>
                </div>

                <div class="card-techno rounded-xl p-6 flex items-start gap-4">
                    <div class="w-12 h-12 bg-plasma/10 rounded-lg flex items-center justify-center flex-shrink-0 border border-plasma/20">
                        <svg class="w-6 h-6 text-plasma" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                        </svg>
                    </div>
                    <div>
                        <h4 class="text-lg font-display font-semibold text-white mb-2">Controle Qualite</h4>
                        <p class="text-gray-400">Methodes de test destructif et non-destructif, analyse metallurgique, interpretation des defauts.</p>
                    </div>
                </div>

                <div class="card-techno rounded-xl p-6 flex items-start gap-4">
                    <div class="w-12 h-12 bg-spark/10 rounded-lg flex items-center justify-center flex-shrink-0 border border-spark/20">
                        <svg class="w-6 h-6 text-spark" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                    </div>
                    <div>
                        <h4 class="text-lg font-display font-semibold text-white mb-2">Optimisation Process</h4>
                        <p class="text-gray-400">Industrialisation, amelioration continue, reduction des couts et des rebuts en production.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- CTA Section -->
        <div class="card-techno rounded-2xl p-12 text-center border-cyber/30">
            <h2 class="text-3xl font-display font-bold text-white mb-4">
                Pret a apprendre avec un expert ?
            </h2>
            <p class="text-gray-400 mb-8 max-w-2xl mx-auto">
                Decouvrez mes formations et beneficiez de 15 ans d'experience industrielle condensee en guides pratiques et actionables.
            </p>
            <a href="{{ route('formations.index') }}" class="btn-cyber px-8 py-4 rounded-xl font-display inline-flex items-center gap-3">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                </svg>
                Voir les Formations
            </a>
        </div>
    </div>
</div>
@endsection
