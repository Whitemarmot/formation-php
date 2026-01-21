@extends('layouts.app')

@section('title', 'Paiement Réussi - Spot Welding Pro')

@section('content')
<div class="min-h-[70vh] flex items-center justify-center py-16 px-4 relative">
    <!-- Background Effects -->
    <div class="absolute inset-0 overflow-hidden pointer-events-none">
        <div class="absolute top-1/3 left-1/3 w-96 h-96 bg-success/10 rounded-full blur-3xl animate-pulse-cyber"></div>
        <div class="absolute bottom-1/3 right-1/3 w-96 h-96 bg-cyber/10 rounded-full blur-3xl animate-pulse-cyber" style="animation-delay: 1s;"></div>
    </div>

    <div class="max-w-lg w-full relative">
        <div class="card-techno rounded-2xl overflow-hidden border-success/30">
            <!-- Top gradient bar -->
            <div class="h-1.5 bg-gradient-to-r from-success via-cyber to-neon"></div>

            <div class="p-8 text-center">
                <!-- Success Icon with Animation -->
                <div class="relative w-24 h-24 mx-auto mb-8">
                    <div class="absolute inset-0 bg-success/20 rounded-full animate-ping"></div>
                    <div class="relative w-full h-full bg-gradient-to-br from-success/20 to-cyber/20 rounded-full flex items-center justify-center border-2 border-success/50">
                        <svg class="w-12 h-12 text-success" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                    </div>
                </div>

                <h1 class="text-3xl md:text-4xl font-display font-black text-white mb-4">
                    Paiement <span class="text-success">Réussi</span> !
                </h1>
                <p class="text-gray-400 mb-8 text-lg">
                    Merci pour votre achat. Vos formations sont maintenant disponibles au téléchargement.
                </p>

                @if(isset($order))
                <div class="bg-abyss/50 rounded-xl p-6 mb-8 border border-success/20">
                    <div class="flex items-center justify-between mb-4">
                        <span class="text-sm text-gray-500 font-mono">Commande</span>
                        <span class="text-cyber font-mono">#{{ $order->order_number }}</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-gray-400 font-display">Total payé</span>
                        <span class="price-tag text-3xl font-black">{{ number_format($order->total_amount, 2, ',', ' ') }} €</span>
                    </div>
                </div>
                @endif

                <div class="space-y-4">
                    <a href="{{ route('account.downloads') }}" class="btn-cyber w-full py-4 rounded-xl font-display font-semibold flex items-center justify-center gap-3">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                        </svg>
                        Accéder à mes téléchargements
                    </a>
                    <a href="{{ route('formations.index') }}" class="btn-neon w-full py-4 rounded-xl font-display font-semibold flex items-center justify-center gap-3">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                        </svg>
                        Voir d'autres formations
                    </a>
                </div>

                <!-- Confetti decoration -->
                <div class="mt-8 flex items-center justify-center gap-2 text-gray-500 text-sm">
                    <svg class="w-4 h-4 text-spark" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 2L9.19 8.63 2 9.24l5.46 4.73L5.82 21 12 17.27 18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2z"/>
                    </svg>
                    <span>Un email de confirmation vous a été envoyé</span>
                    <svg class="w-4 h-4 text-spark" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 2L9.19 8.63 2 9.24l5.46 4.73L5.82 21 12 17.27 18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2z"/>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Decorative elements -->
        <div class="absolute -bottom-4 -right-4 w-24 h-24 border border-success/20 rounded-2xl -z-10"></div>
        <div class="absolute -top-4 -left-4 w-16 h-16 border border-cyber/20 rounded-xl -z-10"></div>
    </div>
</div>
@endsection
