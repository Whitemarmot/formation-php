@extends('layouts.app')

@section('title', 'Inscription - Spot Welding Pro')

@section('content')
<div class="min-h-[70vh] flex items-center justify-center py-16 px-4 relative">
    <!-- Background Effects -->
    <div class="absolute inset-0 overflow-hidden pointer-events-none">
        <div class="absolute top-1/3 right-1/4 w-96 h-96 bg-neon/10 rounded-full blur-3xl animate-pulse-cyber"></div>
        <div class="absolute bottom-1/3 left-1/4 w-96 h-96 bg-plasma/10 rounded-full blur-3xl animate-pulse-cyber" style="animation-delay: 1.5s;"></div>
    </div>

    <div class="max-w-md w-full relative">
        <div class="card-techno rounded-2xl overflow-hidden border-neon/30">
            <!-- Top gradient bar -->
            <div class="h-1.5 bg-gradient-to-r from-neon via-plasma to-spark"></div>

            <div class="p-8">
                <div class="text-center mb-8">
                    <!-- Icon -->
                    <div class="w-16 h-16 bg-gradient-to-br from-neon/20 to-plasma/20 rounded-2xl flex items-center justify-center mx-auto mb-6 border border-neon/30">
                        <svg class="w-8 h-8 text-neon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                        </svg>
                    </div>
                    <h1 class="text-3xl font-display font-black text-white mb-2">Créer un compte</h1>
                    <p class="text-gray-400">Rejoignez Spot Welding Pro</p>
                </div>

                <form method="POST" action="{{ route('register') }}" class="space-y-5">
                    @csrf

                    <div>
                        <label for="name" class="block text-sm font-display font-semibold text-gray-300 mb-2">Nom complet</label>
                        <div class="relative">
                            <input type="text" id="name" name="name" value="{{ old('name') }}" required autofocus
                                   class="w-full px-4 py-3.5 bg-abyss/50 border border-neon/20 rounded-xl text-white placeholder-gray-500 focus:border-neon focus:ring-1 focus:ring-neon transition-all"
                                   placeholder="Jean Dupont">
                            <div class="absolute inset-y-0 right-0 flex items-center pr-4 pointer-events-none">
                                <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                            </div>
                        </div>
                        @error('name')
                        <p class="mt-2 text-sm text-danger flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            {{ $message }}
                        </p>
                        @enderror
                    </div>

                    <div>
                        <label for="email" class="block text-sm font-display font-semibold text-gray-300 mb-2">Email</label>
                        <div class="relative">
                            <input type="email" id="email" name="email" value="{{ old('email') }}" required
                                   class="w-full px-4 py-3.5 bg-abyss/50 border border-neon/20 rounded-xl text-white placeholder-gray-500 focus:border-neon focus:ring-1 focus:ring-neon transition-all"
                                   placeholder="votre@email.com">
                            <div class="absolute inset-y-0 right-0 flex items-center pr-4 pointer-events-none">
                                <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"></path>
                                </svg>
                            </div>
                        </div>
                        @error('email')
                        <p class="mt-2 text-sm text-danger flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            {{ $message }}
                        </p>
                        @enderror
                    </div>

                    <div>
                        <label for="password" class="block text-sm font-display font-semibold text-gray-300 mb-2">Mot de passe</label>
                        <div class="relative">
                            <input type="password" id="password" name="password" required
                                   class="w-full px-4 py-3.5 bg-abyss/50 border border-neon/20 rounded-xl text-white placeholder-gray-500 focus:border-neon focus:ring-1 focus:ring-neon transition-all"
                                   placeholder="••••••••">
                            <div class="absolute inset-y-0 right-0 flex items-center pr-4 pointer-events-none">
                                <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                </svg>
                            </div>
                        </div>
                        @error('password')
                        <p class="mt-2 text-sm text-danger flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            {{ $message }}
                        </p>
                        @enderror
                    </div>

                    <div>
                        <label for="password_confirmation" class="block text-sm font-display font-semibold text-gray-300 mb-2">Confirmer le mot de passe</label>
                        <div class="relative">
                            <input type="password" id="password_confirmation" name="password_confirmation" required
                                   class="w-full px-4 py-3.5 bg-abyss/50 border border-neon/20 rounded-xl text-white placeholder-gray-500 focus:border-neon focus:ring-1 focus:ring-neon transition-all"
                                   placeholder="••••••••">
                            <div class="absolute inset-y-0 right-0 flex items-center pr-4 pointer-events-none">
                                <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                                </svg>
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="w-full btn-neon py-4 rounded-xl font-display font-semibold text-base flex items-center justify-center gap-3 mt-6">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                        </svg>
                        Créer mon compte
                    </button>
                </form>

                <div class="mt-8 pt-6 border-t border-neon/10 text-center">
                    <p class="text-gray-400">
                        Déjà un compte ?
                        <a href="{{ route('login') }}" class="text-cyber hover:text-cyber/80 font-display font-semibold transition-colors">
                            Se connecter
                        </a>
                    </p>
                </div>
            </div>
        </div>

        <!-- Decorative elements -->
        <div class="absolute -bottom-4 -left-4 w-24 h-24 border border-neon/20 rounded-2xl -z-10"></div>
        <div class="absolute -top-4 -right-4 w-16 h-16 border border-plasma/20 rounded-xl -z-10"></div>
    </div>
</div>
@endsection
