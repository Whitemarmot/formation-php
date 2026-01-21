@extends('layouts.app')

@section('title', 'Panier - Spot Welding Pro')

@section('content')
<div class="py-12">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-3xl font-bold text-white mb-8">Votre panier</h1>

        @if($items->isEmpty())
        <div class="bg-darkcard rounded-xl p-12 text-center border border-gray-700">
            <svg class="w-16 h-16 text-gray-500 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
            </svg>
            <h2 class="text-xl font-semibold text-white mb-2">Votre panier est vide</h2>
            <p class="text-gray-400 mb-6">Découvrez nos formations professionnelles sur le soudage par points.</p>
            <a href="{{ route('formations.index') }}" class="inline-block px-6 py-3 bg-primary hover:bg-primary/80 text-white font-medium rounded-lg transition-colors">
                Voir les formations
            </a>
        </div>
        @else
        <div class="space-y-6">
            <!-- Cart Items -->
            @foreach($items as $item)
            <div class="bg-darkcard rounded-xl p-6 border border-gray-700 flex items-center gap-6">
                <div class="flex-shrink-0 w-24 h-24 bg-gradient-to-br from-primary/20 to-secondary/20 rounded-lg flex items-center justify-center">
                    <svg class="w-10 h-10 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                </div>
                <div class="flex-grow">
                    <h3 class="text-lg font-semibold text-white">{{ $item->formation->title }}</h3>
                    <p class="text-gray-400 text-sm">{{ $item->formation->level }}</p>
                </div>
                <div class="text-right">
                    <p class="text-xl font-bold text-primary">{{ number_format($item->formation->price, 2, ',', ' ') }} €</p>
                    <form action="{{ route('cart.remove', $item->id) }}" method="POST" class="mt-2">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-sm text-danger hover:text-danger/80 transition-colors">
                            Retirer
                        </button>
                    </form>
                </div>
            </div>
            @endforeach

            <!-- Total & Checkout -->
            <div class="bg-darkcard rounded-xl p-6 border border-primary/50">
                <div class="flex items-center justify-between mb-6">
                    <span class="text-xl text-gray-300">Total</span>
                    <span class="text-3xl font-bold text-primary">{{ number_format($total, 2, ',', ' ') }} €</span>
                </div>

                <div class="grid sm:grid-cols-2 gap-4">
                    <a href="{{ route('checkout.stripe') }}" class="flex items-center justify-center gap-2 py-4 bg-[#635BFF] hover:bg-[#635BFF]/80 text-white font-semibold rounded-xl transition-colors">
                        <svg class="w-6 h-6" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M13.976 9.15c-2.172-.806-3.356-1.426-3.356-2.409 0-.831.683-1.305 1.901-1.305 2.227 0 4.515.858 6.09 1.631l.89-5.494C18.252.975 15.697 0 12.165 0 9.667 0 7.589.654 6.104 1.872 4.56 3.147 3.757 4.992 3.757 7.218c0 4.039 2.467 5.76 6.476 7.219 2.585.92 3.445 1.574 3.445 2.583 0 .98-.84 1.545-2.354 1.545-1.875 0-4.965-.921-6.99-2.109l-.9 5.555C5.175 22.99 8.385 24 11.714 24c2.641 0 4.843-.624 6.328-1.813 1.664-1.305 2.525-3.236 2.525-5.732 0-4.128-2.524-5.851-6.594-7.305h.003z"/>
                        </svg>
                        Payer avec Stripe
                    </a>
                    <a href="{{ route('checkout.paypal') }}" class="flex items-center justify-center gap-2 py-4 bg-[#0070BA] hover:bg-[#0070BA]/80 text-white font-semibold rounded-xl transition-colors">
                        <svg class="w-6 h-6" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M7.076 21.337H2.47a.641.641 0 0 1-.633-.74L4.944.901C5.026.382 5.474 0 5.998 0h7.46c2.57 0 4.578.543 5.69 1.81 1.01 1.15 1.304 2.42 1.012 4.287-.023.143-.047.288-.077.437-.983 5.05-4.349 6.797-8.647 6.797h-2.19c-.524 0-.968.382-1.05.9l-1.12 7.106zm14.146-14.42a3.35 3.35 0 0 0-.607-.541c-.013.076-.026.175-.041.254-.59 3.025-2.566 6.082-8.558 6.082h-2.19c-1.717 0-3.146 1.27-3.4 2.922l-.757 4.793-.343 2.177a.767.767 0 0 0 .757.886h4.606c.472 0 .87-.343.943-.806l.038-.21.75-4.76.049-.266c.073-.463.471-.806.944-.806h.594c3.851 0 6.866-1.564 7.748-6.087.37-1.889.176-3.463-.533-4.638z"/>
                        </svg>
                        Payer avec PayPal
                    </a>
                </div>

                <p class="text-center text-gray-500 text-sm mt-4">
                    Paiement 100% sécurisé • Satisfait ou remboursé 30 jours
                </p>
            </div>
        </div>
        @endif
    </div>
</div>
@endsection
