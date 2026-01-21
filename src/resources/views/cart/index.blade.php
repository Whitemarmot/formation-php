@extends('layouts.app')

@section('title', 'Panier - Spot Welding Pro')

@section('content')
<div class="py-16 md:py-24">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-3xl md:text-4xl font-display font-black text-white mb-8">
            Votre <span class="gradient-text">Panier</span>
        </h1>

        @if($items->isEmpty())
        <div class="card-techno rounded-2xl p-12 text-center">
            <div class="w-20 h-20 bg-steel rounded-full flex items-center justify-center mx-auto mb-6">
                <svg class="w-10 h-10 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                </svg>
            </div>
            <h2 class="text-2xl font-display font-bold text-white mb-3">Votre panier est vide</h2>
            <p class="text-gray-400 mb-8 max-w-md mx-auto">Découvrez nos formations professionnelles sur le soudage par points.</p>
            <a href="{{ route('formations.index') }}" class="btn-cyber px-8 py-4 rounded-xl font-display inline-flex items-center gap-3">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                </svg>
                Voir les formations
            </a>
        </div>
        @else
        <div class="space-y-6">
            <!-- Cart Items -->
            @foreach($items as $item)
            <div class="card-techno rounded-xl p-6 flex flex-col sm:flex-row items-start sm:items-center gap-6">
                <div class="flex-shrink-0 w-20 h-20 bg-gradient-to-br from-cyber/10 to-neon/10 rounded-xl flex items-center justify-center border border-cyber/20">
                    <svg class="w-10 h-10 text-cyber" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                </div>
                <div class="flex-grow">
                    <h3 class="text-lg font-display font-semibold text-white">{{ $item['formation']->name }}</h3>
                    <p class="text-gray-400 text-sm">{{ $item['formation']->level_label ?? 'Formation PDF' }}</p>
                </div>
                <div class="flex items-center gap-6 w-full sm:w-auto">
                    <p class="price-tag text-2xl font-bold">{{ number_format($item['formation']->price, 0, ',', ' ') }}€</p>
                    <form action="{{ route('cart.remove', $item['formation_id']) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="p-2 text-gray-500 hover:text-danger transition-colors">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                            </svg>
                        </button>
                    </form>
                </div>
            </div>
            @endforeach

            <!-- Total & Checkout -->
            <div class="card-techno rounded-2xl p-8 border-cyber/30">
                <div class="flex items-center justify-between mb-8">
                    <span class="text-xl text-gray-300 font-display">Total</span>
                    <span class="price-tag text-4xl font-black">{{ number_format($total, 0, ',', ' ') }}€</span>
                </div>

                <div class="grid sm:grid-cols-2 gap-4">
                    <a href="{{ route('checkout.stripe') }}" class="flex items-center justify-center gap-3 py-4 px-6 bg-[#635BFF] hover:bg-[#635BFF]/80 text-white font-display font-semibold rounded-xl transition-all hover:scale-[1.02]">
                        <svg class="w-6 h-6" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M13.976 9.15c-2.172-.806-3.356-1.426-3.356-2.409 0-.831.683-1.305 1.901-1.305 2.227 0 4.515.858 6.09 1.631l.89-5.494C18.252.975 15.697 0 12.165 0 9.667 0 7.589.654 6.104 1.872 4.56 3.147 3.757 4.992 3.757 7.218c0 4.039 2.467 5.76 6.476 7.219 2.585.92 3.445 1.574 3.445 2.583 0 .98-.84 1.545-2.354 1.545-1.875 0-4.965-.921-6.99-2.109l-.9 5.555C5.175 22.99 8.385 24 11.714 24c2.641 0 4.843-.624 6.328-1.813 1.664-1.305 2.525-3.236 2.525-5.732 0-4.128-2.524-5.851-6.594-7.305h.003z"/>
                        </svg>
                        Payer avec Stripe
                    </a>
                    <a href="{{ route('checkout.paypal') }}" class="flex items-center justify-center gap-3 py-4 px-6 bg-[#0070BA] hover:bg-[#0070BA]/80 text-white font-display font-semibold rounded-xl transition-all hover:scale-[1.02]">
                        <svg class="w-6 h-6" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M7.076 21.337H2.47a.641.641 0 0 1-.633-.74L4.944.901C5.026.382 5.474 0 5.998 0h7.46c2.57 0 4.578.543 5.69 1.81 1.01 1.15 1.304 2.42 1.012 4.287-.023.143-.047.288-.077.437-.983 5.05-4.349 6.797-8.647 6.797h-2.19c-.524 0-.968.382-1.05.9l-1.12 7.106zm14.146-14.42a3.35 3.35 0 0 0-.607-.541c-.013.076-.026.175-.041.254-.59 3.025-2.566 6.082-8.558 6.082h-2.19c-1.717 0-3.146 1.27-3.4 2.922l-.757 4.793-.343 2.177a.767.767 0 0 0 .757.886h4.606c.472 0 .87-.343.943-.806l.038-.21.75-4.76.049-.266c.073-.463.471-.806.944-.806h.594c3.851 0 6.866-1.564 7.748-6.087.37-1.889.176-3.463-.533-4.638z"/>
                        </svg>
                        Payer avec PayPal
                    </a>
                </div>

                <p class="text-center text-gray-500 text-sm mt-6 flex items-center justify-center gap-2">
                    <svg class="w-4 h-4 text-success" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                    </svg>
                    Paiement 100% sécurisé • Satisfait ou remboursé 30 jours
                </p>
            </div>
        </div>
        @endif
    </div>
</div>
@endsection
