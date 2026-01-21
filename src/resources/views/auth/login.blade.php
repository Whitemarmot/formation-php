@extends('layouts.app')

@section('title', 'Connexion - Spot Welding Pro')

@section('content')
<div class="min-h-[70vh] flex items-center justify-center py-16 px-4 relative">
    <!-- Background Effects -->
    <div class="absolute inset-0 overflow-hidden pointer-events-none">
        <div class="absolute top-1/4 left-1/4 w-96 h-96 bg-cyber/10 rounded-full blur-3xl animate-pulse-cyber"></div>
        <div class="absolute bottom-1/4 right-1/4 w-96 h-96 bg-neon/10 rounded-full blur-3xl animate-pulse-cyber" style="animation-delay: 1s;"></div>
    </div>

    <div class="max-w-md w-full relative">
        <div class="card-techno rounded-2xl overflow-hidden border-cyber/30">
            <!-- Top gradient bar -->
            <div class="h-1.5 bg-gradient-to-r from-cyber via-neon to-plasma"></div>

            <div class="p-8">
                <div class="text-center mb-8">
                    <!-- Icon -->
                    <div class="w-16 h-16 bg-gradient-to-br from-cyber/20 to-neon/20 rounded-2xl flex items-center justify-center mx-auto mb-6 border border-cyber/30">
                        <svg class="w-8 h-8 text-cyber" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"></path>
                        </svg>
                    </div>
                    <h1 class="text-3xl font-display font-black text-white mb-2">Connexion</h1>
                    <p class="text-gray-400">Accédez à vos formations</p>
                </div>

                @if(session('status'))
                <div class="mb-6 p-4 bg-success/10 border border-success/30 rounded-xl text-success text-sm flex items-center gap-3">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    {{ session('status') }}
                </div>
                @endif

                <form method="POST" action="{{ route('login') }}" class="space-y-6">
                    @csrf

                    <div>
                        <label for="email" class="block text-sm font-display font-semibold text-gray-300 mb-2">Email</label>
                        <div class="relative">
                            <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus
                                   class="w-full px-4 py-3.5 bg-abyss/50 border border-cyber/20 rounded-xl text-white placeholder-gray-500 focus:border-cyber focus:ring-1 focus:ring-cyber transition-all"
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
                                   class="w-full px-4 py-3.5 bg-abyss/50 border border-cyber/20 rounded-xl text-white placeholder-gray-500 focus:border-cyber focus:ring-1 focus:ring-cyber transition-all"
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

                    <div class="flex items-center justify-between">
                        <label class="flex items-center cursor-pointer group">
                            <input type="checkbox" name="remember" class="w-4 h-4 rounded border-cyber/30 bg-abyss text-cyber focus:ring-cyber focus:ring-offset-0">
                            <span class="ml-2 text-sm text-gray-400 group-hover:text-gray-300 transition-colors">Se souvenir de moi</span>
                        </label>
                        @if(Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="text-sm text-cyber hover:text-cyber/80 transition-colors">
                            Mot de passe oublié ?
                        </a>
                        @endif
                    </div>

                    <button type="submit" class="w-full btn-cyber py-4 rounded-xl font-display font-semibold text-base flex items-center justify-center gap-3">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>
                        </svg>
                        Se connecter
                    </button>
                </form>

                <div class="mt-8 pt-6 border-t border-cyber/10 text-center">
                    <p class="text-gray-400">
                        Pas encore de compte ?
                        <a href="{{ route('register') }}" class="text-neon hover:text-neon/80 font-display font-semibold transition-colors">
                            S'inscrire
                        </a>
                    </p>
                </div>
            </div>
        </div>

        <!-- Decorative elements -->
        <div class="absolute -bottom-4 -right-4 w-24 h-24 border border-cyber/20 rounded-2xl -z-10"></div>
        <div class="absolute -top-4 -left-4 w-16 h-16 border border-neon/20 rounded-xl -z-10"></div>
    </div>
</div>
@endsection
