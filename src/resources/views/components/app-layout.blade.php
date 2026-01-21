@props(['title' => null, 'metaDescription' => null])

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? config('app.name') }}</title>
    <meta name="description" content="{{ $metaDescription ?? 'Formations PDF premium sur les soudeuses à points par Mang-Ky Ha, expert industriel batteries lithium.' }}">

    <!-- Favicon -->
    <link rel="icon" type="image/svg+xml" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='%23e94560'><path d='M13 10V3L4 14h7v7l9-11h-7z'/></svg>">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Rajdhani:wght@500;600;700&family=JetBrains+Mono&display=swap" rel="stylesheet">

    <!-- Tailwind CSS via CDN (for development) -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'dark': '#0f0f1a',
                        'dark-lighter': '#1a1a2e',
                        'dark-card': '#16213e',
                        'accent': '#e94560',
                        'accent-orange': '#f39c12',
                    },
                    fontFamily: {
                        'display': ['Rajdhani', 'sans-serif'],
                        'sans': ['Inter', 'sans-serif'],
                        'mono': ['JetBrains Mono', 'monospace'],
                    }
                }
            }
        }
    </script>

    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #0f0f1a;
            color: #eaeaea;
        }

        h1, h2, h3, h4, h5, h6 {
            font-family: 'Rajdhani', sans-serif;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 0.75rem 1.5rem;
            font-weight: 500;
            border-radius: 0.5rem;
            transition: all 0.2s;
        }

        .btn-primary {
            background: linear-gradient(to right, #e94560, rgba(233, 69, 96, 0.8));
            color: white;
            box-shadow: 0 4px 14px 0 rgba(233, 69, 96, 0.25);
        }

        .btn-primary:hover {
            background: linear-gradient(to right, rgba(233, 69, 96, 0.9), rgba(233, 69, 96, 0.7));
        }

        .btn-secondary {
            background: #16213e;
            color: white;
            border: 1px solid #374151;
        }

        .btn-secondary:hover {
            border-color: #e94560;
            color: #e94560;
        }

        .btn-lg {
            padding: 1rem 2rem;
            font-size: 1.125rem;
        }

        .card {
            background: #16213e;
            border-radius: 0.75rem;
            border: 1px solid #1f2937;
            overflow: hidden;
        }

        .card-hover:hover {
            border-color: rgba(233, 69, 96, 0.5);
            box-shadow: 0 10px 40px -10px rgba(233, 69, 96, 0.1);
        }

        .gradient-text {
            background: linear-gradient(to right, #e94560, #f39c12);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .hero-gradient {
            background: radial-gradient(ellipse at top, rgba(233, 69, 96, 0.15) 0%, transparent 50%),
                        radial-gradient(ellipse at bottom right, rgba(243, 156, 18, 0.1) 0%, transparent 50%);
        }

        .grid-bg {
            background-image:
                linear-gradient(rgba(233, 69, 96, 0.03) 1px, transparent 1px),
                linear-gradient(90deg, rgba(233, 69, 96, 0.03) 1px, transparent 1px);
            background-size: 50px 50px;
        }

        .level-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.25rem 0.75rem;
            border-radius: 9999px;
            font-size: 0.875rem;
            font-weight: 500;
        }

        .level-1 {
            background: rgba(34, 197, 94, 0.2);
            color: #4ade80;
            border: 1px solid rgba(34, 197, 94, 0.3);
        }

        .level-2 {
            background: rgba(243, 156, 18, 0.2);
            color: #f39c12;
            border: 1px solid rgba(243, 156, 18, 0.3);
        }

        .level-3 {
            background: rgba(233, 69, 96, 0.2);
            color: #e94560;
            border: 1px solid rgba(233, 69, 96, 0.3);
        }

        .badge {
            display: inline-flex;
            align-items: center;
            padding: 0.25rem 0.75rem;
            border-radius: 9999px;
            font-size: 0.75rem;
            font-weight: 500;
        }

        .badge-accent {
            background: rgba(233, 69, 96, 0.2);
            color: #e94560;
        }

        .section-title {
            font-size: 2.25rem;
            font-weight: 700;
            color: white;
            margin-bottom: 1rem;
        }

        .section-subtitle {
            font-size: 1.125rem;
            color: #9ca3af;
        }

        .price {
            font-size: 1.875rem;
            font-weight: 700;
            color: white;
        }

        .price-old {
            font-size: 1.125rem;
            color: #6b7280;
            text-decoration: line-through;
        }

        .stat-value {
            font-size: 2.5rem;
            font-weight: 700;
            color: white;
            font-family: 'Rajdhani', sans-serif;
        }

        .stat-label {
            font-size: 0.75rem;
            color: #9ca3af;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        .input {
            width: 100%;
            padding: 0.75rem 1rem;
            background: #1a1a2e;
            border: 1px solid #374151;
            border-radius: 0.5rem;
            color: white;
        }

        .input:focus {
            outline: none;
            border-color: #e94560;
            box-shadow: 0 0 0 2px rgba(233, 69, 96, 0.2);
        }

        .input::placeholder {
            color: #6b7280;
        }

        /* Scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: #0f0f1a;
        }

        ::-webkit-scrollbar-thumb {
            background: #16213e;
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #e94560;
        }
    </style>

    @stack('styles')
</head>
<body class="min-h-screen antialiased">
    <!-- Header -->
    <header class="sticky top-0 z-50 bg-dark-lighter/95 backdrop-blur-sm border-b border-gray-800">
        <div class="container mx-auto px-4">
            <div class="flex items-center justify-between h-16">
                <!-- Logo -->
                <a href="{{ route('home') }}" class="flex items-center gap-3 group">
                    <div class="w-10 h-10 bg-gradient-to-br from-accent to-accent-orange rounded-lg flex items-center justify-center">
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
                    <a href="{{ route('formateur') }}" class="text-gray-300 hover:text-white transition-colors">
                        Le Formateur
                    </a>
                    <a href="{{ route('contact') }}" class="text-gray-300 hover:text-white transition-colors">
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
                        @if($cartCount > 0)
                            <span class="absolute -top-1 -right-1 w-5 h-5 bg-accent text-white text-xs font-bold rounded-full flex items-center justify-center">
                                {{ $cartCount }}
                            </span>
                        @endif
                    </a>

                    <!-- Auth -->
                    @auth
                        <div class="relative group">
                            <button class="flex items-center gap-2 text-gray-300 hover:text-white">
                                <span class="hidden sm:inline">{{ auth()->user()->name }}</span>
                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>
                            <div class="absolute right-0 mt-2 w-48 bg-dark-lighter rounded-lg shadow-xl border border-gray-700 py-2 hidden group-hover:block">
                                <a href="{{ route('account.downloads') }}" class="block px-4 py-2 text-gray-300 hover:bg-gray-700 hover:text-white">
                                    Mes téléchargements
                                </a>
                                <a href="{{ route('account.orders') }}" class="block px-4 py-2 text-gray-300 hover:bg-gray-700 hover:text-white">
                                    Mes commandes
                                </a>
                                <a href="{{ route('account.profile') }}" class="block px-4 py-2 text-gray-300 hover:bg-gray-700 hover:text-white">
                                    Mon profil
                                </a>
                                @if(auth()->user()->isAdmin())
                                    <hr class="my-2 border-gray-700">
                                    <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2 text-accent hover:bg-gray-700">
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
                        <a href="{{ route('register') }}" class="btn btn-primary hidden sm:inline-flex">
                            S'inscrire
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </header>

    <!-- Flash Messages -->
    @if(session('success'))
        <div class="bg-green-900/50 border-b border-green-700 text-green-300 px-4 py-3">
            <div class="container mx-auto">
                {{ session('success') }}
            </div>
        </div>
    @endif

    @if(session('error'))
        <div class="bg-red-900/50 border-b border-red-700 text-red-300 px-4 py-3">
            <div class="container mx-auto">
                {{ session('error') }}
            </div>
        </div>
    @endif

    <!-- Main Content -->
    <main>
        {{ $slot }}
    </main>

    <!-- Footer -->
    <footer class="bg-dark-lighter border-t border-gray-800 mt-20">
        <div class="container mx-auto px-4 py-12">
            <div class="grid md:grid-cols-4 gap-8">
                <!-- Brand -->
                <div class="md:col-span-2">
                    <div class="flex items-center gap-3 mb-4">
                        <div class="w-10 h-10 bg-gradient-to-br from-accent to-accent-orange rounded-lg flex items-center justify-center">
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
                        <li><a href="{{ route('formations.level', 1) }}" class="hover:text-white transition-colors">Niveau Débutant</a></li>
                        <li><a href="{{ route('formations.level', 2) }}" class="hover:text-white transition-colors">Niveau Intermédiaire</a></li>
                        <li><a href="{{ route('formations.level', 3) }}" class="hover:text-white transition-colors">Niveau Expert</a></li>
                    </ul>
                </div>

                <!-- Légal -->
                <div>
                    <h4 class="font-display font-semibold text-white mb-4">Informations</h4>
                    <ul class="space-y-2 text-gray-400">
                        <li><a href="{{ route('mentions-legales') }}" class="hover:text-white transition-colors">Mentions légales</a></li>
                        <li><a href="{{ route('cgv') }}" class="hover:text-white transition-colors">CGV</a></li>
                        <li><a href="{{ route('confidentialite') }}" class="hover:text-white transition-colors">Confidentialité</a></li>
                        <li><a href="{{ route('contact') }}" class="hover:text-white transition-colors">Contact</a></li>
                    </ul>
                </div>
            </div>

            <div class="border-t border-gray-800 mt-12 pt-8 text-center text-gray-500 text-sm">
                <p>&copy; {{ date('Y') }} Spot Welding Pro. Tous droits réservés.</p>
            </div>
        </div>
    </footer>

    @stack('scripts')
</body>
</html>
