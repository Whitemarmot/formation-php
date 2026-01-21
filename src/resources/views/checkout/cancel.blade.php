@extends('layouts.app')

@section('title', 'Paiement Annulé - Spot Welding Pro')

@section('content')
<div class="min-h-[70vh] flex items-center justify-center py-16 px-4 relative">
    <!-- Background Effects -->
    <div class="absolute inset-0 overflow-hidden pointer-events-none">
        <div class="absolute top-1/3 right-1/3 w-96 h-96 bg-spark/10 rounded-full blur-3xl animate-pulse-cyber"></div>
        <div class="absolute bottom-1/3 left-1/3 w-96 h-96 bg-neon/10 rounded-full blur-3xl animate-pulse-cyber" style="animation-delay: 1.5s;"></div>
    </div>

    <div class="max-w-lg w-full relative">
        <div class="card-techno rounded-2xl overflow-hidden border-spark/30">
            <!-- Top gradient bar -->
            <div class="h-1.5 bg-gradient-to-r from-spark via-neon to-plasma"></div>

            <div class="p-8 text-center">
                <!-- Warning Icon -->
                <div class="w-24 h-24 bg-gradient-to-br from-spark/20 to-neon/20 rounded-full flex items-center justify-center mx-auto mb-8 border-2 border-spark/50">
                    <svg class="w-12 h-12 text-spark" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                    </svg>
                </div>

                <h1 class="text-3xl md:text-4xl font-display font-black text-white mb-4">
                    Paiement <span class="text-spark">Annulé</span>
                </h1>
                <p class="text-gray-400 mb-8 text-lg">
                    Votre paiement a été annulé. Aucun montant n'a été débité de votre compte.
                </p>

                <!-- Info box -->
                <div class="bg-abyss/50 rounded-xl p-6 mb-8 border border-spark/20">
                    <div class="flex items-start gap-4 text-left">
                        <div class="w-10 h-10 bg-spark/10 rounded-lg flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5 text-spark" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-white font-display font-semibold mb-1">Pas de panique !</h3>
                            <p class="text-gray-400 text-sm">Vos articles sont toujours dans votre panier. Vous pouvez reprendre votre commande quand vous le souhaitez.</p>
                        </div>
                    </div>
                </div>

                <div class="space-y-4">
                    <a href="{{ route('cart.index') }}" class="btn-cyber w-full py-4 rounded-xl font-display font-semibold flex items-center justify-center gap-3">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                        Retour au panier
                    </a>
                    <a href="{{ route('formations.index') }}" class="btn-neon w-full py-4 rounded-xl font-display font-semibold flex items-center justify-center gap-3">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                        </svg>
                        Voir les formations
                    </a>
                </div>

                <p class="text-sm text-gray-500 mt-8 flex items-center justify-center gap-2">
                    <svg class="w-4 h-4 text-cyber" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    Besoin d'aide ? <a href="mailto:contact@formation-soudure.com" class="text-cyber hover:text-cyber/80 transition-colors">Contactez-nous</a>
                </p>
            </div>
        </div>

        <!-- Decorative elements -->
        <div class="absolute -bottom-4 -left-4 w-24 h-24 border border-spark/20 rounded-2xl -z-10"></div>
        <div class="absolute -top-4 -right-4 w-16 h-16 border border-neon/20 rounded-xl -z-10"></div>
    </div>
</div>
@endsection
