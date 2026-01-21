@extends('layouts.app')

@section('title', 'Paiement Réussi - Spot Welding Pro')

@section('content')
<div class="min-h-[70vh] flex items-center justify-center py-12 px-4">
    <div class="max-w-lg w-full text-center">
        <div class="bg-darkcard rounded-xl p-8 border border-success/50 shadow-lg">
            <div class="w-20 h-20 bg-success/20 rounded-full flex items-center justify-center mx-auto mb-6">
                <svg class="w-10 h-10 text-success" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
            </div>

            <h1 class="text-3xl font-bold text-white mb-4">Paiement Réussi !</h1>
            <p class="text-gray-400 mb-8">
                Merci pour votre achat. Vos formations sont maintenant disponibles au téléchargement.
            </p>

            @if(isset($order))
            <div class="bg-darkbg rounded-lg p-4 mb-6 text-left">
                <p class="text-sm text-gray-400 mb-2">Commande #{{ $order->order_number }}</p>
                <p class="text-lg font-semibold text-white">{{ number_format($order->total_amount, 2, ',', ' ') }} €</p>
            </div>
            @endif

            <div class="space-y-4">
                <a href="{{ route('account.downloads') }}" class="block w-full py-3 bg-primary hover:bg-primary/80 text-white font-semibold rounded-lg transition-colors">
                    Accéder à mes téléchargements
                </a>
                <a href="{{ route('formations.index') }}" class="block w-full py-3 bg-darkbg hover:bg-gray-700 text-white font-medium rounded-lg transition-colors border border-gray-600">
                    Voir d'autres formations
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
