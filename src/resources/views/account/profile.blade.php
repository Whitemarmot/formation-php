@extends('layouts.app')

@section('title', 'Mon Profil - Spot Welding Pro')

@section('content')
<div class="py-12">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-3xl font-bold text-white mb-8">Mon Profil</h1>

        @if(session('status') === 'profile-updated')
        <div class="mb-6 p-4 bg-success/20 border border-success/50 rounded-lg text-success">
            Profil mis à jour avec succès.
        </div>
        @endif

        <div class="bg-darkcard rounded-xl p-8 border border-gray-700">
            <form method="POST" action="{{ route('account.profile.update') }}" class="space-y-6">
                @csrf
                @method('PATCH')

                <div class="grid md:grid-cols-2 gap-6">
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-300 mb-2">Nom complet</label>
                        <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" required
                               class="w-full px-4 py-3 bg-darkbg border border-gray-600 rounded-lg text-white placeholder-gray-500 focus:border-primary focus:ring-1 focus:ring-primary transition-colors">
                        @error('name')
                        <p class="mt-2 text-sm text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-300 mb-2">Email</label>
                        <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" required
                               class="w-full px-4 py-3 bg-darkbg border border-gray-600 rounded-lg text-white placeholder-gray-500 focus:border-primary focus:ring-1 focus:ring-primary transition-colors">
                        @error('email')
                        <p class="mt-2 text-sm text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="phone" class="block text-sm font-medium text-gray-300 mb-2">Téléphone</label>
                        <input type="tel" id="phone" name="phone" value="{{ old('phone', $user->phone) }}"
                               class="w-full px-4 py-3 bg-darkbg border border-gray-600 rounded-lg text-white placeholder-gray-500 focus:border-primary focus:ring-1 focus:ring-primary transition-colors">
                        @error('phone')
                        <p class="mt-2 text-sm text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="company" class="block text-sm font-medium text-gray-300 mb-2">Entreprise</label>
                        <input type="text" id="company" name="company" value="{{ old('company', $user->company) }}"
                               class="w-full px-4 py-3 bg-darkbg border border-gray-600 rounded-lg text-white placeholder-gray-500 focus:border-primary focus:ring-1 focus:ring-primary transition-colors">
                        @error('company')
                        <p class="mt-2 text-sm text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="pt-4">
                    <button type="submit" class="px-6 py-3 bg-primary hover:bg-primary/80 text-white font-semibold rounded-lg transition-colors">
                        Enregistrer les modifications
                    </button>
                </div>
            </form>
        </div>

        <!-- Password Change -->
        <div class="mt-8 bg-darkcard rounded-xl p-8 border border-gray-700">
            <h2 class="text-xl font-semibold text-white mb-6">Modifier le mot de passe</h2>

            @if(session('status') === 'password-updated')
            <div class="mb-6 p-4 bg-success/20 border border-success/50 rounded-lg text-success">
                Mot de passe mis à jour avec succès.
            </div>
            @endif

            <form method="POST" action="{{ route('password.update') }}" class="space-y-6">
                @csrf
                @method('PUT')

                <div>
                    <label for="current_password" class="block text-sm font-medium text-gray-300 mb-2">Mot de passe actuel</label>
                    <input type="password" id="current_password" name="current_password" required
                           class="w-full px-4 py-3 bg-darkbg border border-gray-600 rounded-lg text-white placeholder-gray-500 focus:border-primary focus:ring-1 focus:ring-primary transition-colors">
                    @error('current_password')
                    <p class="mt-2 text-sm text-danger">{{ $message }}</p>
                    @enderror
                </div>

                <div class="grid md:grid-cols-2 gap-6">
                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-300 mb-2">Nouveau mot de passe</label>
                        <input type="password" id="password" name="password" required
                               class="w-full px-4 py-3 bg-darkbg border border-gray-600 rounded-lg text-white placeholder-gray-500 focus:border-primary focus:ring-1 focus:ring-primary transition-colors">
                        @error('password')
                        <p class="mt-2 text-sm text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="password_confirmation" class="block text-sm font-medium text-gray-300 mb-2">Confirmer le mot de passe</label>
                        <input type="password" id="password_confirmation" name="password_confirmation" required
                               class="w-full px-4 py-3 bg-darkbg border border-gray-600 rounded-lg text-white placeholder-gray-500 focus:border-primary focus:ring-1 focus:ring-primary transition-colors">
                    </div>
                </div>

                <div class="pt-4">
                    <button type="submit" class="px-6 py-3 bg-secondary hover:bg-secondary/80 text-dark font-semibold rounded-lg transition-colors">
                        Changer le mot de passe
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
