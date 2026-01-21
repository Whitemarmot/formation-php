@extends('layouts.app')

@section('title', 'Inscription - Spot Welding Pro')

@section('content')
<div class="min-h-[70vh] flex items-center justify-center py-12 px-4">
    <div class="max-w-md w-full">
        <div class="bg-darkcard rounded-xl p-8 border border-gray-700 shadow-lg">
            <div class="text-center mb-8">
                <h1 class="text-3xl font-bold text-white mb-2">Créer un compte</h1>
                <p class="text-gray-400">Rejoignez Spot Welding Pro</p>
            </div>

            <form method="POST" action="{{ route('register') }}" class="space-y-6">
                @csrf

                <div>
                    <label for="name" class="block text-sm font-medium text-gray-300 mb-2">Nom complet</label>
                    <input type="text" id="name" name="name" value="{{ old('name') }}" required autofocus
                           class="w-full px-4 py-3 bg-darkbg border border-gray-600 rounded-lg text-white placeholder-gray-500 focus:border-primary focus:ring-1 focus:ring-primary transition-colors"
                           placeholder="Jean Dupont">
                    @error('name')
                    <p class="mt-2 text-sm text-danger">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="email" class="block text-sm font-medium text-gray-300 mb-2">Email</label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" required
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

                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-300 mb-2">Confirmer le mot de passe</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" required
                           class="w-full px-4 py-3 bg-darkbg border border-gray-600 rounded-lg text-white placeholder-gray-500 focus:border-primary focus:ring-1 focus:ring-primary transition-colors"
                           placeholder="••••••••">
                </div>

                <button type="submit" class="w-full py-3 bg-primary hover:bg-primary/80 text-white font-semibold rounded-lg transition-colors">
                    Créer mon compte
                </button>
            </form>

            <div class="mt-6 text-center">
                <p class="text-gray-400">
                    Déjà un compte ?
                    <a href="{{ route('login') }}" class="text-primary hover:text-primary/80 font-medium">
                        Se connecter
                    </a>
                </p>
            </div>
        </div>
    </div>
</div>
@endsection
