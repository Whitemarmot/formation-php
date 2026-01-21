@extends('layouts.app')

@section('title', 'Connexion - Spot Welding Pro')

@section('content')
<div class="min-h-[70vh] flex items-center justify-center py-12 px-4">
    <div class="max-w-md w-full">
        <div class="bg-darkcard rounded-xl p-8 border border-gray-700 shadow-lg">
            <div class="text-center mb-8">
                <h1 class="text-3xl font-bold text-white mb-2">Connexion</h1>
                <p class="text-gray-400">Accédez à vos formations</p>
            </div>

            @if(session('status'))
            <div class="mb-4 p-4 bg-success/20 border border-success/50 rounded-lg text-success text-sm">
                {{ session('status') }}
            </div>
            @endif

            <form method="POST" action="{{ route('login') }}" class="space-y-6">
                @csrf

                <div>
                    <label for="email" class="block text-sm font-medium text-gray-300 mb-2">Email</label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus
                           class="w-full px-4 py-3 bg-darkbg border border-gray-600 rounded-lg text-white placeholder-gray-500 focus:border-primary focus:ring-1 focus:ring-primary transition-colors"
                           placeholder="votre@email.com">
                    @error('email')
                    <p class="mt-2 text-sm text-danger">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-gray-300 mb-2">Mot de passe</label>
                    <input type="password" id="password" name="password" required
                           class="w-full px-4 py-3 bg-darkbg border border-gray-600 rounded-lg text-white placeholder-gray-500 focus:border-primary focus:ring-1 focus:ring-primary transition-colors"
                           placeholder="••••••••">
                    @error('password')
                    <p class="mt-2 text-sm text-danger">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center justify-between">
                    <label class="flex items-center">
                        <input type="checkbox" name="remember" class="w-4 h-4 rounded border-gray-600 bg-darkbg text-primary focus:ring-primary">
                        <span class="ml-2 text-sm text-gray-400">Se souvenir de moi</span>
                    </label>
                    @if(Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="text-sm text-primary hover:text-primary/80">
                        Mot de passe oublié ?
                    </a>
                    @endif
                </div>

                <button type="submit" class="w-full py-3 bg-primary hover:bg-primary/80 text-white font-semibold rounded-lg transition-colors">
                    Se connecter
                </button>
            </form>

            <div class="mt-6 text-center">
                <p class="text-gray-400">
                    Pas encore de compte ?
                    <a href="{{ route('register') }}" class="text-primary hover:text-primary/80 font-medium">
                        S'inscrire
                    </a>
                </p>
            </div>
        </div>
    </div>
</div>
@endsection
