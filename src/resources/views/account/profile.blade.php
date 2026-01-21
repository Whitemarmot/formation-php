@extends('layouts.app')

@section('title', 'Mon Profil - Spot Welding Pro')

@section('content')
<div class="py-16 md:py-24">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="mb-10">
            <nav class="mb-4">
                <ol class="flex items-center space-x-2 text-sm text-gray-400">
                    <li><a href="{{ route('home') }}" class="hover:text-cyber transition-colors">Accueil</a></li>
                    <li><span class="text-gray-600">/</span></li>
                    <li class="text-white">Mon Profil</li>
                </ol>
            </nav>
            <h1 class="text-3xl md:text-4xl font-display font-black text-white">
                Mon <span class="gradient-text">Profil</span>
            </h1>
        </div>

        @if(session('status') === 'profile-updated')
        <div class="mb-8 p-4 bg-success/10 border border-success/30 rounded-xl text-success flex items-center gap-3">
            <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
            </svg>
            Profil mis à jour avec succès.
        </div>
        @endif

        <!-- Profile Form -->
        <div class="card-techno rounded-2xl overflow-hidden border-cyber/30 mb-8">
            <div class="h-1.5 bg-gradient-to-r from-cyber via-neon to-plasma"></div>
            <div class="p-8">
                <div class="flex items-center gap-4 mb-8">
                    <div class="w-14 h-14 bg-gradient-to-br from-cyber/20 to-neon/20 rounded-xl flex items-center justify-center border border-cyber/30">
                        <svg class="w-7 h-7 text-cyber" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-xl font-display font-bold text-white">Informations personnelles</h2>
                        <p class="text-gray-400 text-sm">Gérez vos informations de compte</p>
                    </div>
                </div>

                <form method="POST" action="{{ route('account.profile.update') }}" class="space-y-6">
                    @csrf
                    @method('PATCH')

                    <div class="grid md:grid-cols-2 gap-6">
                        <div>
                            <label for="name" class="block text-sm font-display font-semibold text-gray-300 mb-2">Nom complet</label>
                            <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" required
                                   class="w-full px-4 py-3.5 bg-abyss/50 border border-cyber/20 rounded-xl text-white placeholder-gray-500 focus:border-cyber focus:ring-1 focus:ring-cyber transition-all">
                            @error('name')
                            <p class="mt-2 text-sm text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="email" class="block text-sm font-display font-semibold text-gray-300 mb-2">Email</label>
                            <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" required
                                   class="w-full px-4 py-3.5 bg-abyss/50 border border-cyber/20 rounded-xl text-white placeholder-gray-500 focus:border-cyber focus:ring-1 focus:ring-cyber transition-all">
                            @error('email')
                            <p class="mt-2 text-sm text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="phone" class="block text-sm font-display font-semibold text-gray-300 mb-2">Téléphone</label>
                            <input type="tel" id="phone" name="phone" value="{{ old('phone', $user->phone) }}"
                                   class="w-full px-4 py-3.5 bg-abyss/50 border border-cyber/20 rounded-xl text-white placeholder-gray-500 focus:border-cyber focus:ring-1 focus:ring-cyber transition-all">
                            @error('phone')
                            <p class="mt-2 text-sm text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="company" class="block text-sm font-display font-semibold text-gray-300 mb-2">Entreprise</label>
                            <input type="text" id="company" name="company" value="{{ old('company', $user->company) }}"
                                   class="w-full px-4 py-3.5 bg-abyss/50 border border-cyber/20 rounded-xl text-white placeholder-gray-500 focus:border-cyber focus:ring-1 focus:ring-cyber transition-all">
                            @error('company')
                            <p class="mt-2 text-sm text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="pt-4">
                        <button type="submit" class="btn-cyber px-8 py-4 rounded-xl font-display font-semibold flex items-center gap-3">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            Enregistrer les modifications
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Password Change -->
        <div class="card-techno rounded-2xl overflow-hidden border-neon/30">
            <div class="h-1.5 bg-gradient-to-r from-neon via-plasma to-spark"></div>
            <div class="p-8">
                <div class="flex items-center gap-4 mb-8">
                    <div class="w-14 h-14 bg-gradient-to-br from-neon/20 to-plasma/20 rounded-xl flex items-center justify-center border border-neon/30">
                        <svg class="w-7 h-7 text-neon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-xl font-display font-bold text-white">Modifier le mot de passe</h2>
                        <p class="text-gray-400 text-sm">Sécurisez votre compte</p>
                    </div>
                </div>

                @if(session('status') === 'password-updated')
                <div class="mb-6 p-4 bg-success/10 border border-success/30 rounded-xl text-success flex items-center gap-3">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    Mot de passe mis à jour avec succès.
                </div>
                @endif

                <form method="POST" action="{{ route('password.update') }}" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <div>
                        <label for="current_password" class="block text-sm font-display font-semibold text-gray-300 mb-2">Mot de passe actuel</label>
                        <input type="password" id="current_password" name="current_password" required
                               class="w-full px-4 py-3.5 bg-abyss/50 border border-neon/20 rounded-xl text-white placeholder-gray-500 focus:border-neon focus:ring-1 focus:ring-neon transition-all">
                        @error('current_password')
                        <p class="mt-2 text-sm text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="grid md:grid-cols-2 gap-6">
                        <div>
                            <label for="password" class="block text-sm font-display font-semibold text-gray-300 mb-2">Nouveau mot de passe</label>
                            <input type="password" id="password" name="password" required
                                   class="w-full px-4 py-3.5 bg-abyss/50 border border-neon/20 rounded-xl text-white placeholder-gray-500 focus:border-neon focus:ring-1 focus:ring-neon transition-all">
                            @error('password')
                            <p class="mt-2 text-sm text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="password_confirmation" class="block text-sm font-display font-semibold text-gray-300 mb-2">Confirmer le mot de passe</label>
                            <input type="password" id="password_confirmation" name="password_confirmation" required
                                   class="w-full px-4 py-3.5 bg-abyss/50 border border-neon/20 rounded-xl text-white placeholder-gray-500 focus:border-neon focus:ring-1 focus:ring-neon transition-all">
                        </div>
                    </div>

                    <div class="pt-4">
                        <button type="submit" class="btn-neon px-8 py-4 rounded-xl font-display font-semibold flex items-center gap-3">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"></path>
                            </svg>
                            Changer le mot de passe
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
