@extends('layouts.app')

@section('title', 'Paiement - Spot Welding Pro')

@section('content')
<div class="py-16 md:py-24">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-3xl md:text-4xl font-display font-black text-white mb-8">
            Finaliser votre <span class="gradient-text">Commande</span>
        </h1>

        @if(session('error'))
        <div class="bg-danger/10 border border-danger/30 rounded-xl p-4 mb-8 flex items-center gap-3">
            <svg class="w-5 h-5 text-danger flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <span class="text-danger">{{ session('error') }}</span>
        </div>
        @endif

        @if($testMode ?? false)
        <div class="bg-warning/10 border border-warning/30 rounded-xl p-4 mb-8 flex items-center gap-3">
            <svg class="w-5 h-5 text-warning flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
            </svg>
            <span class="text-warning font-medium">MODE TEST ACTIVE - Aucun paiement reel ne sera effectue</span>
        </div>
        @endif

        <div class="grid lg:grid-cols-5 gap-8">
            <!-- Formulaire -->
            <div class="lg:col-span-3">
                <form action="{{ route('checkout.process') }}{{ ($testMode ?? false) ? '?testmode=spotwelding2025' : '' }}" method="POST" class="space-y-6">
                    @csrf

                    <!-- Informations client -->
                    <div class="card-techno rounded-2xl p-6">
                        <h2 class="text-xl font-display font-bold text-white mb-6 flex items-center gap-3">
                            <span class="w-8 h-8 bg-cyber/20 rounded-full flex items-center justify-center text-cyber text-sm font-bold">1</span>
                            Vos informations
                        </h2>

                        <div class="space-y-4">
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-300 mb-2">Nom complet</label>
                                <input type="text" id="name" name="name" required
                                    value="{{ old('name', auth()->user()?->name ?? '') }}"
                                    class="w-full px-4 py-3 bg-abyss/50 border border-steel/30 rounded-xl text-white placeholder-gray-500 focus:outline-none focus:border-cyber/50 focus:ring-1 focus:ring-cyber/50 transition-colors"
                                    placeholder="Jean Dupont">
                                @error('name')
                                <p class="text-danger text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-300 mb-2">Adresse email</label>
                                <input type="email" id="email" name="email" required
                                    value="{{ old('email', auth()->user()?->email ?? '') }}"
                                    class="w-full px-4 py-3 bg-abyss/50 border border-steel/30 rounded-xl text-white placeholder-gray-500 focus:outline-none focus:border-cyber/50 focus:ring-1 focus:ring-cyber/50 transition-colors"
                                    placeholder="jean@exemple.com">
                                @error('email')
                                <p class="text-danger text-sm mt-1">{{ $message }}</p>
                                @enderror
                                <p class="text-gray-500 text-sm mt-2">Vous recevrez vos liens de telechargement a cette adresse</p>
                            </div>
                        </div>
                    </div>

                    <!-- Mode de paiement -->
                    <div class="card-techno rounded-2xl p-6">
                        <h2 class="text-xl font-display font-bold text-white mb-6 flex items-center gap-3">
                            <span class="w-8 h-8 bg-cyber/20 rounded-full flex items-center justify-center text-cyber text-sm font-bold">2</span>
                            Mode de paiement
                        </h2>

                        <div class="space-y-3">
                            <label class="block cursor-pointer">
                                <input type="radio" name="payment_method" value="stripe" class="peer hidden" checked>
                                <div class="flex items-center gap-4 p-4 bg-abyss/50 border-2 border-steel/30 rounded-xl peer-checked:border-[#635BFF] peer-checked:bg-[#635BFF]/5 transition-all">
                                    <div class="w-12 h-12 bg-[#635BFF]/20 rounded-lg flex items-center justify-center">
                                        <svg class="w-7 h-7 text-[#635BFF]" viewBox="0 0 24 24" fill="currentColor">
                                            <path d="M13.976 9.15c-2.172-.806-3.356-1.426-3.356-2.409 0-.831.683-1.305 1.901-1.305 2.227 0 4.515.858 6.09 1.631l.89-5.494C18.252.975 15.697 0 12.165 0 9.667 0 7.589.654 6.104 1.872 4.56 3.147 3.757 4.992 3.757 7.218c0 4.039 2.467 5.76 6.476 7.219 2.585.92 3.445 1.574 3.445 2.583 0 .98-.84 1.545-2.354 1.545-1.875 0-4.965-.921-6.99-2.109l-.9 5.555C5.175 22.99 8.385 24 11.714 24c2.641 0 4.843-.624 6.328-1.813 1.664-1.305 2.525-3.236 2.525-5.732 0-4.128-2.524-5.851-6.594-7.305h.003z"/>
                                        </svg>
                                    </div>
                                    <div class="flex-grow">
                                        <p class="font-display font-semibold text-white">Carte bancaire</p>
                                        <p class="text-gray-500 text-sm">Via Stripe - Visa, Mastercard, etc.</p>
                                    </div>
                                    <div class="w-5 h-5 border-2 border-steel/50 rounded-full peer-checked:border-[#635BFF] peer-checked:bg-[#635BFF] flex items-center justify-center">
                                        <svg class="w-3 h-3 text-white hidden peer-checked:block" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" />
                                        </svg>
                                    </div>
                                </div>
                            </label>

                            <label class="block cursor-pointer">
                                <input type="radio" name="payment_method" value="paypal" class="peer hidden">
                                <div class="flex items-center gap-4 p-4 bg-abyss/50 border-2 border-steel/30 rounded-xl peer-checked:border-[#0070BA] peer-checked:bg-[#0070BA]/5 transition-all">
                                    <div class="w-12 h-12 bg-[#0070BA]/20 rounded-lg flex items-center justify-center">
                                        <svg class="w-7 h-7 text-[#0070BA]" viewBox="0 0 24 24" fill="currentColor">
                                            <path d="M7.076 21.337H2.47a.641.641 0 0 1-.633-.74L4.944.901C5.026.382 5.474 0 5.998 0h7.46c2.57 0 4.578.543 5.69 1.81 1.01 1.15 1.304 2.42 1.012 4.287-.023.143-.047.288-.077.437-.983 5.05-4.349 6.797-8.647 6.797h-2.19c-.524 0-.968.382-1.05.9l-1.12 7.106zm14.146-14.42a3.35 3.35 0 0 0-.607-.541c-.013.076-.026.175-.041.254-.59 3.025-2.566 6.082-8.558 6.082h-2.19c-1.717 0-3.146 1.27-3.4 2.922l-.757 4.793-.343 2.177a.767.767 0 0 0 .757.886h4.606c.472 0 .87-.343.943-.806l.038-.21.75-4.76.049-.266c.073-.463.471-.806.944-.806h.594c3.851 0 6.866-1.564 7.748-6.087.37-1.889.176-3.463-.533-4.638z"/>
                                        </svg>
                                    </div>
                                    <div class="flex-grow">
                                        <p class="font-display font-semibold text-white">PayPal</p>
                                        <p class="text-gray-500 text-sm">Paiement securise via PayPal</p>
                                    </div>
                                    <div class="w-5 h-5 border-2 border-steel/50 rounded-full peer-checked:border-[#0070BA] peer-checked:bg-[#0070BA] flex items-center justify-center">
                                        <svg class="w-3 h-3 text-white hidden peer-checked:block" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" />
                                        </svg>
                                    </div>
                                </div>
                            </label>

                            @if($testMode ?? false)
                            <label class="block cursor-pointer">
                                <input type="radio" name="payment_method" value="test" class="peer hidden" checked>
                                <div class="flex items-center gap-4 p-4 bg-abyss/50 border-2 border-steel/30 rounded-xl peer-checked:border-warning peer-checked:bg-warning/5 transition-all">
                                    <div class="w-12 h-12 bg-warning/20 rounded-lg flex items-center justify-center">
                                        <svg class="w-7 h-7 text-warning" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                        </svg>
                                    </div>
                                    <div class="flex-grow">
                                        <p class="font-display font-semibold text-warning">Mode Test</p>
                                        <p class="text-gray-500 text-sm">Simuler un paiement (developpement uniquement)</p>
                                    </div>
                                    <div class="w-5 h-5 border-2 border-steel/50 rounded-full peer-checked:border-warning peer-checked:bg-warning flex items-center justify-center">
                                        <svg class="w-3 h-3 text-void hidden peer-checked:block" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" />
                                        </svg>
                                    </div>
                                </div>
                            </label>
                            @endif
                        </div>
                        @error('payment_method')
                        <p class="text-danger text-sm mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Bouton de paiement -->
                    <button type="submit" class="w-full btn-cyber py-4 rounded-xl font-display font-bold text-lg flex items-center justify-center gap-3 transition-all hover:scale-[1.02]">
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                        </svg>
                        Payer {{ number_format($total, 0, ',', ' ') }} EUR
                    </button>

                    <p class="text-center text-gray-500 text-sm flex items-center justify-center gap-2">
                        <svg class="w-4 h-4 text-success" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                        </svg>
                        Paiement 100% securise - Satisfait ou rembourse 30 jours
                    </p>
                </form>
            </div>

            <!-- Recapitulatif -->
            <div class="lg:col-span-2">
                <div class="card-techno rounded-2xl p-6 sticky top-8">
                    <h2 class="text-lg font-display font-bold text-white mb-6">Recapitulatif</h2>

                    <div class="space-y-4 mb-6">
                        @foreach($items as $item)
                        <div class="flex items-start gap-3">
                            <div class="flex-shrink-0 w-10 h-10 bg-gradient-to-br from-cyber/10 to-neon/10 rounded-lg flex items-center justify-center border border-cyber/20">
                                <svg class="w-5 h-5 text-cyber" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                            </div>
                            <div class="flex-grow min-w-0">
                                <p class="text-white font-medium truncate">{{ $item['formation']->name }}</p>
                                <p class="text-gray-500 text-sm">Formation PDF</p>
                            </div>
                            <p class="text-white font-semibold">{{ number_format($item['formation']->price, 0, ',', ' ') }} EUR</p>
                        </div>
                        @endforeach
                    </div>

                    <div class="border-t border-steel/20 pt-4 space-y-2">
                        <div class="flex justify-between text-gray-400">
                            <span>Sous-total</span>
                            <span>{{ number_format($subtotal, 0, ',', ' ') }} EUR</span>
                        </div>
                        @if($hasBundleDiscount)
                        <div class="flex justify-between text-success">
                            <span>Reduction Pack (-20%)</span>
                            <span>-{{ number_format($discount, 0, ',', ' ') }} EUR</span>
                        </div>
                        @endif
                        <div class="flex justify-between text-white text-xl font-display font-bold pt-2 border-t border-steel/20">
                            <span>Total</span>
                            <span class="price-tag">{{ number_format($total, 0, ',', ' ') }} EUR</span>
                        </div>
                    </div>

                    <div class="mt-6 p-4 bg-cyber/5 border border-cyber/20 rounded-xl">
                        <div class="flex items-start gap-3">
                            <svg class="w-5 h-5 text-cyber flex-shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <div class="text-sm">
                                <p class="text-gray-300 font-medium">Acces immediat</p>
                                <p class="text-gray-500">Telechargez vos formations des la confirmation du paiement.</p>
                            </div>
                        </div>
                    </div>

                    <a href="{{ route('cart.index') }}" class="mt-4 flex items-center justify-center gap-2 text-gray-400 hover:text-white transition-colors text-sm">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                        Modifier le panier
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
