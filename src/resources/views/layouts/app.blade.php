<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', config('app.name'))</title>
    <meta name="description" content="@yield('meta_description', 'Formations PDF premium sur les soudeuses à points par Mang-Ky Ha, expert industriel batteries lithium.')">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Rajdhani:wght@500;600;700&display=swap" rel="stylesheet">

    <!-- Tailwind CSS via CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        dark: '#0F0F1A',
                        darkbg: '#0F0F1A',
                        darkcard: '#16213E',
                        primary: '#E94560',
                        secondary: '#F39C12',
                        success: '#22C55E',
                        warning: '#F59E0B',
                        danger: '#EF4444',
                    },
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                        display: ['Rajdhani', 'sans-serif'],
                    }
                }
            }
        }
    </script>
    <style>
        body { background-color: #0F0F1A; }
    </style>

    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    @stack('styles')
</head>
<body class="min-h-screen bg-darkbg text-gray-200 font-sans antialiased">
    <!-- Header -->
    <header class="sticky top-0 z-50 bg-darkcard/95 backdrop-blur-sm border-b border-gray-700">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <!-- Logo -->
                <a href="{{ route('home') }}" class="flex items-center gap-3 group">
                    <div class="w-10 h-10 bg-gradient-to-br from-primary to-secondary rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                        </svg>
                    </div>
                    <div class="hidden sm:block">
                        <span class="block font-display font-bold text-white leading-tight">SPOT WELDING</span>
                        <span class="block text-xs text-gray-400 leading-tight">Formations Pro</span>
                    </div>
                </a>

                <!-- Navigation Desktop -->
                <nav class="hidden md:flex items-center gap-8">
                    <a href="{{ route('formations.index') }}" class="text-gray-300 hover:text-white transition-colors">
                        Formations
                    </a>
                    <a href="#" class="text-gray-300 hover:text-white transition-colors">
                        Le Formateur
                    </a>
                    <a href="#" class="text-gray-300 hover:text-white transition-colors">
                        Contact
                    </a>
                </nav>

                <!-- Actions -->
                <div class="flex items-center gap-4">
                    <!-- Cart -->
                    <a href="{{ route('cart.index') }}" class="relative p-2 text-gray-400 hover:text-white transition-colors">
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                        @php
                            $cartCount = session('cart') ? count(session('cart')) : 0;
                        @endphp
                        @if($cartCount > 0)
                            <span class="absolute -top-1 -right-1 w-5 h-5 bg-primary text-white text-xs font-bold rounded-full flex items-center justify-center">
                                {{ $cartCount }}
                            </span>
                        @endif
                    </a>

                    <!-- Auth -->
                    @auth
                        <div class="relative" x-data="{ open: false }">
                            <button @click="open = !open" class="flex items-center gap-2 text-gray-300 hover:text-white">
                                <span class="hidden sm:inline">{{ auth()->user()->name }}</span>
                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>
                            <div x-show="open" @click.away="open = false" x-cloak class="absolute right-0 mt-2 w-48 bg-darkcard rounded-lg shadow-xl border border-gray-700 py-2">
                                <a href="{{ route('account.downloads') }}" class="block px-4 py-2 text-gray-300 hover:bg-gray-700 hover:text-white">
                                    Mes téléchargements
                                </a>
                                <a href="{{ route('account.orders') }}" class="block px-4 py-2 text-gray-300 hover:bg-gray-700 hover:text-white">
                                    Mes commandes
                                </a>
                                <a href="{{ route('account.profile') }}" class="block px-4 py-2 text-gray-300 hover:bg-gray-700 hover:text-white">
                                    Mon profil
                                </a>
                                @if(auth()->user()->hasRole('admin'))
                                    <hr class="my-2 border-gray-700">
                                    <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2 text-primary hover:bg-gray-700">
                                        Administration
                                    </a>
                                @endif
                                <hr class="my-2 border-gray-700">
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="w-full text-left px-4 py-2 text-gray-300 hover:bg-gray-700 hover:text-white">
                                        Déconnexion
                                    </button>
                                </form>
                            </div>
                        </div>
                    @else
                        <a href="{{ route('login') }}" class="text-gray-300 hover:text-white transition-colors">
                            Connexion
                        </a>
                        <a href="{{ route('register') }}" class="hidden sm:inline-flex px-4 py-2 bg-primary hover:bg-primary/80 text-white font-medium rounded-lg transition-colors">
                            S'inscrire
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </header>

    <!-- Flash Messages -->
    @if(session('success'))
        <div class="bg-success/20 border-b border-success/50 text-success px-4 py-3">
            <div class="max-w-7xl mx-auto">
                {{ session('success') }}
            </div>
        </div>
    @endif

    @if(session('error'))
        <div class="bg-danger/20 border-b border-danger/50 text-danger px-4 py-3">
            <div class="max-w-7xl mx-auto">
                {{ session('error') }}
            </div>
        </div>
    @endif

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-darkcard border-t border-gray-700 mt-20">
        <div class="max-w-7xl mx-auto px-4 py-12">
            <div class="grid md:grid-cols-4 gap-8">
                <!-- Brand -->
                <div class="md:col-span-2">
                    <div class="flex items-center gap-3 mb-4">
                        <div class="w-10 h-10 bg-gradient-to-br from-primary to-secondary rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                            </svg>
                        </div>
                        <span class="font-display font-bold text-xl text-white">SPOT WELDING PRO</span>
                    </div>
                    <p class="text-gray-400 max-w-md">
                        Formations professionnelles sur le soudage par points par Mang-Ky Ha,
                        expert industriel avec 15 ans d'expérience dans l'assemblage de batteries lithium.
                    </p>
                </div>

                <!-- Liens -->
                <div>
                    <h4 class="font-display font-semibold text-white mb-4">Formations</h4>
                    <ul class="space-y-2 text-gray-400">
                        <li><a href="{{ route('formations.index') }}" class="hover:text-white transition-colors">Toutes les formations</a></li>
                    </ul>
                </div>

                <!-- Légal -->
                <div>
                    <h4 class="font-display font-semibold text-white mb-4">Informations</h4>
                    <ul class="space-y-2 text-gray-400">
                        <li><a href="#" class="hover:text-white transition-colors">Mentions légales</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">CGV</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Contact</a></li>
                    </ul>
                </div>
            </div>

            <div class="border-t border-gray-700 mt-12 pt-8 text-center text-gray-500 text-sm">
                <p>&copy; {{ date('Y') }} Spot Welding Pro. Tous droits réservés.</p>
            </div>
        </div>
    </footer>

    <style>
        [x-cloak] { display: none !important; }
    </style>

    @stack('scripts')
</body>
</html>
