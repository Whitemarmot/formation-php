<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', config('app.name'))</title>
    <meta name="description" content="@yield('meta_description', 'Formations PDF premium sur les soudeuses à points par Kangy Ham, expert industriel batteries lithium.')">

    <!-- Fonts - Distinctive choices -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;500;600;700;800;900&family=Source+Sans+3:ital,wght@0,300;0,400;0,500;0,600;0,700;1,400&display=swap" rel="stylesheet">

    <!-- Tailwind CSS via CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        // Techno-Manga Industriel palette
                        void: '#0a0a0f',
                        abyss: '#12121a',
                        steel: '#1a1a2e',
                        gunmetal: '#252540',
                        cyber: '#00f5ff',
                        neon: '#ff6b35',
                        plasma: '#ff3366',
                        spark: '#ffd93d',
                        success: '#00ff88',
                        warning: '#ffaa00',
                        danger: '#ff4757',
                    },
                    fontFamily: {
                        display: ['Orbitron', 'sans-serif'],
                        body: ['Source Sans 3', 'sans-serif'],
                    },
                    animation: {
                        'glow': 'glow 2s ease-in-out infinite alternate',
                        'scan': 'scan 3s linear infinite',
                        'float': 'float 6s ease-in-out infinite',
                        'pulse-cyber': 'pulse-cyber 2s cubic-bezier(0.4, 0, 0.6, 1) infinite',
                        'slide-up': 'slide-up 0.6s ease-out forwards',
                        'fade-in': 'fade-in 0.8s ease-out forwards',
                    }
                }
            }
        }
    </script>

    <!-- Custom Styles -->
    <style>
        :root {
            --cyber: #00f5ff;
            --neon: #ff6b35;
            --plasma: #ff3366;
            --void: #0a0a0f;
            --abyss: #12121a;
        }

        body {
            background-color: var(--void);
            font-family: 'Source Sans 3', sans-serif;
        }

        /* Scrollbar styling */
        ::-webkit-scrollbar { width: 8px; }
        ::-webkit-scrollbar-track { background: var(--abyss); }
        ::-webkit-scrollbar-thumb {
            background: linear-gradient(180deg, var(--cyber), var(--neon));
            border-radius: 4px;
        }

        /* Animations */
        @keyframes glow {
            from { filter: drop-shadow(0 0 5px var(--cyber)); }
            to { filter: drop-shadow(0 0 20px var(--cyber)); }
        }

        @keyframes scan {
            0% { transform: translateY(-100%); opacity: 0; }
            50% { opacity: 0.5; }
            100% { transform: translateY(100vh); opacity: 0; }
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
        }

        @keyframes pulse-cyber {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.5; }
        }

        @keyframes slide-up {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @keyframes fade-in {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        /* Noise texture overlay */
        .noise-bg::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            opacity: 0.03;
            pointer-events: none;
            background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 200 200' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='noise'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.65' numOctaves='3' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23noise)'/%3E%3C/svg%3E");
            z-index: 9999;
        }

        /* Grid pattern background */
        .grid-bg {
            background-image:
                linear-gradient(rgba(0, 245, 255, 0.03) 1px, transparent 1px),
                linear-gradient(90deg, rgba(0, 245, 255, 0.03) 1px, transparent 1px);
            background-size: 50px 50px;
        }

        /* Cyber button */
        .btn-cyber {
            position: relative;
            background: linear-gradient(135deg, var(--cyber) 0%, #0099aa 100%);
            color: var(--void);
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .btn-cyber::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
            transition: left 0.5s ease;
        }

        .btn-cyber:hover::before {
            left: 100%;
        }

        .btn-cyber:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 40px rgba(0, 245, 255, 0.4);
        }

        /* Neon button */
        .btn-neon {
            position: relative;
            background: transparent;
            border: 2px solid var(--neon);
            color: var(--neon);
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            transition: all 0.3s ease;
        }

        .btn-neon:hover {
            background: var(--neon);
            color: var(--void);
            box-shadow: 0 0 30px rgba(255, 107, 53, 0.5);
        }

        /* Gradient text */
        .gradient-text {
            background: linear-gradient(135deg, var(--cyber) 0%, var(--neon) 50%, var(--plasma) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        /* Card styling */
        .card-techno {
            background: linear-gradient(135deg, rgba(26, 26, 46, 0.8) 0%, rgba(18, 18, 26, 0.9) 100%);
            border: 1px solid rgba(0, 245, 255, 0.1);
            backdrop-filter: blur(10px);
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }

        .card-techno:hover {
            border-color: rgba(0, 245, 255, 0.3);
            transform: translateY(-5px);
            box-shadow:
                0 20px 60px rgba(0, 0, 0, 0.5),
                0 0 40px rgba(0, 245, 255, 0.1);
        }

        /* Manga filter for images */
        .manga-filter {
            filter: contrast(1.1) saturate(0.9);
            position: relative;
        }

        .manga-filter::after {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg,
                rgba(0, 245, 255, 0.1) 0%,
                transparent 50%,
                rgba(255, 107, 53, 0.1) 100%);
            mix-blend-mode: overlay;
            pointer-events: none;
        }

        /* Scan line effect */
        .scanlines::after {
            content: '';
            position: absolute;
            inset: 0;
            background: repeating-linear-gradient(
                0deg,
                transparent,
                transparent 2px,
                rgba(0, 0, 0, 0.1) 2px,
                rgba(0, 0, 0, 0.1) 4px
            );
            pointer-events: none;
            opacity: 0.3;
        }

        /* Glowing border */
        .glow-border {
            position: relative;
        }

        .glow-border::before {
            content: '';
            position: absolute;
            inset: -2px;
            background: linear-gradient(45deg, var(--cyber), var(--neon), var(--plasma), var(--cyber));
            border-radius: inherit;
            z-index: -1;
            opacity: 0;
            transition: opacity 0.3s ease;
            animation: border-rotate 3s linear infinite;
            background-size: 300% 300%;
        }

        .glow-border:hover::before {
            opacity: 1;
        }

        @keyframes border-rotate {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        /* Navigation link hover effect */
        .nav-link {
            position: relative;
            color: #9ca3af;
            transition: color 0.3s ease;
        }

        .nav-link::after {
            content: '';
            position: absolute;
            bottom: -4px;
            left: 0;
            width: 0;
            height: 2px;
            background: linear-gradient(90deg, var(--cyber), var(--neon));
            transition: width 0.3s ease;
        }

        .nav-link:hover {
            color: #fff;
        }

        .nav-link:hover::after {
            width: 100%;
        }

        /* Price tag styling */
        .price-tag {
            font-family: 'Orbitron', sans-serif;
            color: var(--cyber);
            text-shadow: 0 0 20px rgba(0, 245, 255, 0.5);
        }

        /* Alpine.js cloak */
        [x-cloak] { display: none !important; }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .grid-bg {
                background-size: 30px 30px;
            }
        }
    </style>

    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    @stack('styles')
</head>
<body class="min-h-screen bg-void text-gray-200 font-body antialiased noise-bg grid-bg">
    <!-- Animated scan line -->
    <div class="fixed inset-0 pointer-events-none z-50 overflow-hidden opacity-20">
        <div class="absolute w-full h-1 bg-gradient-to-r from-transparent via-cyber to-transparent animate-scan"></div>
    </div>

    <!-- Header -->
    <header class="sticky top-0 z-40 bg-abyss/90 backdrop-blur-xl border-b border-cyber/10" x-data="{ mobileOpen: false }">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-20">
                <!-- Logo -->
                <a href="{{ route('home') }}" class="flex items-center gap-4 group">
                    <div class="relative w-12 h-12">
                        <div class="absolute inset-0 bg-gradient-to-br from-cyber to-neon rounded-xl opacity-20 group-hover:opacity-40 transition-opacity"></div>
                        <div class="absolute inset-0 flex items-center justify-center">
                            <svg class="w-7 h-7 text-cyber animate-glow" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                            </svg>
                        </div>
                        <div class="absolute inset-0 border border-cyber/30 rounded-xl"></div>
                    </div>
                    <div class="hidden sm:block">
                        <span class="block font-display font-bold text-lg text-white tracking-wider">SPOT WELDING</span>
                        <span class="block text-xs text-cyber tracking-[0.3em] uppercase">Pro Academy</span>
                    </div>
                </a>

                <!-- Navigation Desktop -->
                <nav class="hidden md:flex items-center gap-10">
                    <a href="{{ route('home') }}" class="nav-link font-medium">Accueil</a>
                    <a href="{{ route('formations.index') }}" class="nav-link font-medium">Formations</a>
                    <a href="{{ route('formateur') }}" class="nav-link font-medium">Le Formateur</a>
                    <a href="{{ route('contact') }}" class="nav-link font-medium">Contact</a>
                </nav>

                <!-- Actions -->
                <div class="flex items-center gap-4">
                    <!-- Cart -->
                    <a href="{{ route('cart.index') }}" class="relative p-3 text-gray-400 hover:text-cyber transition-colors group">
                        <div class="absolute inset-0 bg-cyber/5 rounded-lg opacity-0 group-hover:opacity-100 transition-opacity"></div>
                        <svg class="w-6 h-6 relative" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                        @php
                            $cartCount = session('cart') ? count(session('cart')) : 0;
                        @endphp
                        @if($cartCount > 0)
                            <span class="absolute -top-1 -right-1 w-5 h-5 bg-neon text-void text-xs font-bold rounded-full flex items-center justify-center font-display">
                                {{ $cartCount }}
                            </span>
                        @endif
                    </a>

                    <!-- Auth -->
                    @auth
                        <div class="relative" x-data="{ open: false }">
                            <button @click="open = !open" class="flex items-center gap-2 px-4 py-2 text-gray-300 hover:text-white bg-steel/50 rounded-lg border border-cyber/10 hover:border-cyber/30 transition-all">
                                <span class="hidden sm:inline font-medium">{{ auth()->user()->name }}</span>
                                <svg class="w-4 h-4 transition-transform" :class="{ 'rotate-180': open }" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>
                            <div x-show="open" @click.away="open = false" x-cloak
                                 x-transition:enter="transition ease-out duration-200"
                                 x-transition:enter-start="opacity-0 scale-95"
                                 x-transition:enter-end="opacity-100 scale-100"
                                 x-transition:leave="transition ease-in duration-150"
                                 x-transition:leave-start="opacity-100 scale-100"
                                 x-transition:leave-end="opacity-0 scale-95"
                                 class="absolute right-0 mt-2 w-56 bg-abyss/95 backdrop-blur-xl rounded-xl shadow-2xl border border-cyber/20 py-2 overflow-hidden">
                                <a href="{{ route('account.downloads') }}" class="flex items-center gap-3 px-4 py-3 text-gray-300 hover:bg-cyber/10 hover:text-cyber transition-colors">
                                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" /></svg>
                                    Mes téléchargements
                                </a>
                                <a href="{{ route('account.orders') }}" class="flex items-center gap-3 px-4 py-3 text-gray-300 hover:bg-cyber/10 hover:text-cyber transition-colors">
                                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" /></svg>
                                    Mes commandes
                                </a>
                                <a href="{{ route('account.profile') }}" class="flex items-center gap-3 px-4 py-3 text-gray-300 hover:bg-cyber/10 hover:text-cyber transition-colors">
                                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
                                    Mon profil
                                </a>
                                @if(auth()->user()->hasRole('admin'))
                                    <div class="my-2 border-t border-cyber/10"></div>
                                    <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-4 py-3 text-neon hover:bg-neon/10 transition-colors">
                                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
                                        Administration
                                    </a>
                                @endif
                                <div class="my-2 border-t border-cyber/10"></div>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="flex items-center gap-3 w-full px-4 py-3 text-gray-400 hover:bg-danger/10 hover:text-danger transition-colors">
                                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" /></svg>
                                        Déconnexion
                                    </button>
                                </form>
                            </div>
                        </div>
                    @else
                        <a href="{{ route('login') }}" class="hidden sm:block text-gray-300 hover:text-white transition-colors font-medium">
                            Connexion
                        </a>
                        <a href="{{ route('register') }}" class="btn-cyber px-5 py-2.5 rounded-lg font-display text-sm">
                            S'inscrire
                        </a>
                    @endauth

                    <!-- Mobile menu button -->
                    <button @click="mobileOpen = !mobileOpen" class="md:hidden p-2 text-gray-400 hover:text-white">
                        <svg x-show="!mobileOpen" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                        <svg x-show="mobileOpen" x-cloak class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Mobile menu -->
            <div x-show="mobileOpen" x-cloak
                 x-transition:enter="transition ease-out duration-200"
                 x-transition:enter-start="opacity-0 -translate-y-2"
                 x-transition:enter-end="opacity-100 translate-y-0"
                 class="md:hidden py-4 border-t border-cyber/10">
                <nav class="flex flex-col gap-2">
                    <a href="{{ route('home') }}" class="px-4 py-3 text-gray-300 hover:text-cyber hover:bg-cyber/5 rounded-lg transition-colors">Accueil</a>
                    <a href="{{ route('formations.index') }}" class="px-4 py-3 text-gray-300 hover:text-cyber hover:bg-cyber/5 rounded-lg transition-colors">Formations</a>
                    <a href="{{ route('formateur') }}" class="px-4 py-3 text-gray-300 hover:text-cyber hover:bg-cyber/5 rounded-lg transition-colors">Le Formateur</a>
                    <a href="{{ route('contact') }}" class="px-4 py-3 text-gray-300 hover:text-cyber hover:bg-cyber/5 rounded-lg transition-colors">Contact</a>
                    @guest
                        <a href="{{ route('login') }}" class="px-4 py-3 text-gray-300 hover:text-cyber hover:bg-cyber/5 rounded-lg transition-colors">Connexion</a>
                    @endguest
                </nav>
            </div>
        </div>
    </header>

    <!-- Flash Messages -->
    @if(session('success'))
        <div class="bg-success/10 border-b border-success/30 text-success px-4 py-4" x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)">
            <div class="max-w-7xl mx-auto flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
                    {{ session('success') }}
                </div>
                <button @click="show = false" class="text-success/70 hover:text-success">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                </button>
            </div>
        </div>
    @endif

    @if(session('error'))
        <div class="bg-danger/10 border-b border-danger/30 text-danger px-4 py-4" x-data="{ show: true }" x-show="show">
            <div class="max-w-7xl mx-auto flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                    {{ session('error') }}
                </div>
                <button @click="show = false" class="text-danger/70 hover:text-danger">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                </button>
            </div>
        </div>
    @endif

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-abyss border-t border-cyber/10 mt-24">
        <div class="max-w-7xl mx-auto px-4 py-16">
            <div class="grid md:grid-cols-12 gap-12">
                <!-- Brand -->
                <div class="md:col-span-5">
                    <div class="flex items-center gap-4 mb-6">
                        <div class="relative w-12 h-12">
                            <div class="absolute inset-0 bg-gradient-to-br from-cyber to-neon rounded-xl opacity-20"></div>
                            <div class="absolute inset-0 flex items-center justify-center">
                                <svg class="w-7 h-7 text-cyber" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                                </svg>
                            </div>
                            <div class="absolute inset-0 border border-cyber/30 rounded-xl"></div>
                        </div>
                        <span class="font-display font-bold text-xl text-white tracking-wider">SPOT WELDING PRO</span>
                    </div>
                    <p class="text-gray-400 leading-relaxed mb-6 max-w-md">
                        Formations professionnelles sur le soudage par points par <span class="text-cyber">Kangy Ham</span>,
                        expert industriel avec 15 ans d'expérience dans l'assemblage de batteries lithium haute performance.
                    </p>
                    <div class="flex items-center gap-4">
                        <span class="px-3 py-1 bg-cyber/10 border border-cyber/30 rounded-full text-cyber text-xs font-display tracking-wider">CERTIFIÉ</span>
                        <span class="px-3 py-1 bg-neon/10 border border-neon/30 rounded-full text-neon text-xs font-display tracking-wider">EXPERT</span>
                    </div>
                </div>

                <!-- Formations -->
                <div class="md:col-span-3">
                    <h4 class="font-display font-semibold text-white mb-6 tracking-wider">FORMATIONS</h4>
                    <ul class="space-y-4 text-gray-400">
                        <li><a href="{{ route('formations.index') }}" class="hover:text-cyber transition-colors flex items-center gap-2">
                            <span class="w-1.5 h-1.5 bg-cyber rounded-full"></span>
                            Toutes les formations
                        </a></li>
                        <li><a href="{{ route('formations.index') }}" class="hover:text-cyber transition-colors flex items-center gap-2">
                            <span class="w-1.5 h-1.5 bg-neon rounded-full"></span>
                            Pack Complet
                        </a></li>
                    </ul>
                </div>

                <!-- Legal -->
                <div class="md:col-span-2">
                    <h4 class="font-display font-semibold text-white mb-6 tracking-wider">LEGAL</h4>
                    <ul class="space-y-4 text-gray-400">
                        <li><a href="{{ route('mentions-legales') }}" class="hover:text-cyber transition-colors">Mentions legales</a></li>
                        <li><a href="{{ route('cgv') }}" class="hover:text-cyber transition-colors">CGV</a></li>
                        <li><a href="{{ route('confidentialite') }}" class="hover:text-cyber transition-colors">Confidentialite</a></li>
                    </ul>
                </div>

                <!-- Contact -->
                <div class="md:col-span-2">
                    <h4 class="font-display font-semibold text-white mb-6 tracking-wider">CONTACT</h4>
                    <ul class="space-y-4 text-gray-400">
                        <li><a href="{{ route('contact') }}" class="hover:text-cyber transition-colors">Nous contacter</a></li>
                        <li><a href="{{ route('formateur') }}" class="hover:text-cyber transition-colors">Le formateur</a></li>
                    </ul>
                </div>
            </div>

            <div class="border-t border-cyber/10 mt-12 pt-8 flex flex-col md:flex-row items-center justify-between gap-4">
                <p class="text-gray-500 text-sm">&copy; {{ date('Y') }} Spot Welding Pro. Tous droits réservés.</p>
                <div class="flex items-center gap-6 text-gray-500 text-sm">
                    <span class="flex items-center gap-2">
                        <svg class="w-4 h-4 text-cyber" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" /></svg>
                        Paiement sécurisé
                    </span>
                    <span class="flex items-center gap-2">
                        <svg class="w-4 h-4 text-neon" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" /></svg>
                        Téléchargement instantané
                    </span>
                </div>
            </div>
        </div>
    </footer>

    @stack('scripts')
</body>
</html>
