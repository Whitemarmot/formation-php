@extends('layouts.app')

@section('title', 'Paiement Annulé - Spot Welding Pro')

@section('content')
<div class="min-h-[70vh] flex items-center justify-center py-12 px-4">
    <div class="max-w-lg w-full text-center">
        <div class="bg-darkcard rounded-xl p-8 border border-warning/50 shadow-lg">
            <div class="w-20 h-20 bg-warning/20 rounded-full flex items-center justify-center mx-auto mb-6">
                <svg class="w-10 h-10 text-warning" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                </svg>
            </div>

            <h1 class="text-3xl font-bold text-white mb-4">Paiement Annulé</h1>
            <p class="text-gray-400 mb-8">
                Votre paiement a été annulé. Aucun montant n'a été débité de votre compte.
            </p>

            <div class="space-y-4">
                <a href="{{ route('cart.index') }}" class="block w-full py-3 bg-primary hover:bg-primary/80 text-white font-semibold rounded-lg transition-colors">
                    Retour au panier
                </a>
                <a href="{{ route('formations.index') }}" class="block w-full py-3 bg-darkbg hover:bg-gray-700 text-white font-medium rounded-lg transition-colors border border-gray-600">
                    Voir les formations
                </a>
            </div>

            <p class="text-sm text-gray-500 mt-6">
                Besoin d'aide ? <a href="mailto:contact@formation-soudure.com" class="text-primary hover:text-primary/80">Contactez-nous</a>
            </p>
        </div>
    </div>
</div>
@endsection
