@extends('layouts.app')

@section('title', $formation->title . ' - Spot Welding Pro')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Breadcrumb -->
        <nav class="mb-8">
            <ol class="flex items-center space-x-2 text-sm text-gray-400">
                <li><a href="{{ route('home') }}" class="hover:text-primary">Accueil</a></li>
                <li><span class="mx-2">/</span></li>
                <li><a href="{{ route('formations.index') }}" class="hover:text-primary">Formations</a></li>
                <li><span class="mx-2">/</span></li>
                <li class="text-white">{{ $formation->title }}</li>
            </ol>
        </nav>

        <div class="grid lg:grid-cols-3 gap-12">
            <!-- Main Content -->
            <div class="lg:col-span-2">
                <div class="bg-darkcard rounded-xl p-8 border border-gray-700">
                    <div class="flex items-center gap-3 mb-6">
                        <span class="px-4 py-2 bg-primary/20 text-primary font-medium rounded-full">
                            {{ $formation->level }}
                        </span>
                        @if($formation->is_bundle)
                        <span class="px-4 py-2 bg-secondary/20 text-secondary font-medium rounded-full">
                            Pack Complet
                        </span>
                        @endif
                    </div>

                    <h1 class="text-3xl md:text-4xl font-bold text-white mb-6">{{ $formation->title }}</h1>

                    <p class="text-xl text-gray-300 mb-8">{{ $formation->short_description }}</p>

                    <div class="prose prose-invert max-w-none">
                        {!! nl2br(e($formation->description)) !!}
                    </div>

                    @if($formation->table_of_contents)
                    <div class="mt-10">
                        <h2 class="text-2xl font-bold text-white mb-6">Table des matières</h2>
                        <div class="bg-darkbg rounded-lg p-6 border border-gray-700">
                            {!! nl2br(e($formation->table_of_contents)) !!}
                        </div>
                    </div>
                    @endif
                </div>

                <!-- Features -->
                <div class="mt-8 grid sm:grid-cols-2 gap-6">
                    <div class="bg-darkcard rounded-xl p-6 border border-gray-700">
                        <div class="w-12 h-12 bg-primary/20 rounded-lg flex items-center justify-center mb-4">
                            <svg class="w-6 h-6 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-white mb-2">Format PDF Premium</h3>
                        <p class="text-gray-400">Document professionnel optimisé pour l'impression et la lecture sur écran.</p>
                    </div>

                    <div class="bg-darkcard rounded-xl p-6 border border-gray-700">
                        <div class="w-12 h-12 bg-success/20 rounded-lg flex items-center justify-center mb-4">
                            <svg class="w-6 h-6 text-success" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-white mb-2">Téléchargement Instantané</h3>
                        <p class="text-gray-400">Accès immédiat après paiement, disponible 7 jours.</p>
                    </div>

                    <div class="bg-darkcard rounded-xl p-6 border border-gray-700">
                        <div class="w-12 h-12 bg-secondary/20 rounded-lg flex items-center justify-center mb-4">
                            <svg class="w-6 h-6 text-secondary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-white mb-2">Document Sécurisé</h3>
                        <p class="text-gray-400">PDF personnalisé avec watermark pour votre protection.</p>
                    </div>

                    <div class="bg-darkcard rounded-xl p-6 border border-gray-700">
                        <div class="w-12 h-12 bg-primary/20 rounded-lg flex items-center justify-center mb-4">
                            <svg class="w-6 h-6 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z"></path>
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-white mb-2">Support Expert</h3>
                        <p class="text-gray-400">Questions ? Notre équipe d'experts est là pour vous aider.</p>
                    </div>
                </div>
            </div>

            <!-- Sidebar - Purchase Card -->
            <div class="lg:col-span-1">
                <div class="sticky top-8">
                    <div class="bg-darkcard rounded-xl p-6 border border-primary/50 shadow-lg shadow-primary/10">
                        @if($formation->image)
                        <img src="{{ asset('storage/' . $formation->image) }}" alt="{{ $formation->title }}" class="w-full h-48 object-cover rounded-lg mb-6">
                        @else
                        <div class="w-full h-48 bg-gradient-to-br from-primary/20 to-secondary/20 rounded-lg flex items-center justify-center mb-6">
                            <svg class="w-16 h-16 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                        </div>
                        @endif

                        <div class="text-center mb-6">
                            @if($formation->original_price && $formation->original_price > $formation->price)
                            <div class="mb-2">
                                <span class="text-gray-500 line-through text-lg">{{ number_format($formation->original_price, 2, ',', ' ') }} €</span>
                                <span class="ml-2 px-2 py-1 bg-success/20 text-success text-sm font-medium rounded">
                                    -{{ round((1 - $formation->price / $formation->original_price) * 100) }}%
                                </span>
                            </div>
                            @endif
                            <div class="text-4xl font-bold text-primary">{{ number_format($formation->price, 2, ',', ' ') }} €</div>
                            <p class="text-gray-400 mt-1">TTC - Paiement unique</p>
                        </div>

                        <form action="{{ route('cart.add') }}" method="POST" class="space-y-4">
                            @csrf
                            <input type="hidden" name="formation_id" value="{{ $formation->id }}">

                            <button type="submit" class="w-full py-4 bg-primary hover:bg-primary/80 text-white font-bold rounded-xl transition-colors flex items-center justify-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                </svg>
                                Ajouter au panier
                            </button>
                        </form>

                        <div class="mt-6 pt-6 border-t border-gray-700">
                            <div class="flex items-center gap-3 text-gray-400 text-sm mb-3">
                                <svg class="w-5 h-5 text-success" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                <span>Paiement sécurisé (Stripe/PayPal)</span>
                            </div>
                            <div class="flex items-center gap-3 text-gray-400 text-sm mb-3">
                                <svg class="w-5 h-5 text-success" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                <span>Accès instantané après paiement</span>
                            </div>
                            <div class="flex items-center gap-3 text-gray-400 text-sm">
                                <svg class="w-5 h-5 text-success" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                <span>Satisfait ou remboursé 30 jours</span>
                            </div>
                        </div>
                    </div>

                    <!-- Expert Info -->
                    <div class="mt-6 bg-darkcard rounded-xl p-6 border border-gray-700">
                        <div class="flex items-center gap-4 mb-4">
                            <div class="w-16 h-16 bg-primary/20 rounded-full flex items-center justify-center">
                                <span class="text-2xl font-bold text-primary">MK</span>
                            </div>
                            <div>
                                <h4 class="text-white font-semibold">Mang-Ky Ha</h4>
                                <p class="text-gray-400 text-sm">Expert Soudage par Points</p>
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
