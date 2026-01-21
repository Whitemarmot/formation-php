<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Administration') - {{ config('app.name') }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#1a1a2e',
                        secondary: '#16213e',
                        accent: '#e94560',
                        'accent-2': '#f39c12',
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-gray-100 min-h-screen">
    <div class="flex">
        <!-- Sidebar -->
        <aside class="w-64 bg-primary min-h-screen fixed left-0 top-0 text-white">
            <div class="p-6 border-b border-gray-700">
                <h1 class="text-xl font-bold">
                    <i class="fas fa-cog mr-2"></i>Administration
                </h1>
            </div>

            <nav class="mt-6">
                <a href="{{ route('admin.dashboard') }}"
                   class="flex items-center px-6 py-3 hover:bg-secondary transition {{ request()->routeIs('admin.dashboard') ? 'bg-secondary border-l-4 border-accent' : '' }}">
                    <i class="fas fa-chart-line w-6"></i>
                    <span>Tableau de bord</span>
                </a>

                <a href="{{ route('admin.formations.index') }}"
                   class="flex items-center px-6 py-3 hover:bg-secondary transition {{ request()->routeIs('admin.formations.*') ? 'bg-secondary border-l-4 border-accent' : '' }}">
                    <i class="fas fa-book w-6"></i>
                    <span>Formations</span>
                </a>

                <a href="{{ route('admin.orders.index') }}"
                   class="flex items-center px-6 py-3 hover:bg-secondary transition {{ request()->routeIs('admin.orders.*') ? 'bg-secondary border-l-4 border-accent' : '' }}">
                    <i class="fas fa-shopping-cart w-6"></i>
                    <span>Commandes</span>
                </a>

                <a href="{{ route('admin.customers.index') }}"
                   class="flex items-center px-6 py-3 hover:bg-secondary transition {{ request()->routeIs('admin.customers.*') ? 'bg-secondary border-l-4 border-accent' : '' }}">
                    <i class="fas fa-users w-6"></i>
                    <span>Clients</span>
                </a>

                <hr class="my-4 border-gray-700">

                <a href="{{ route('home') }}"
                   class="flex items-center px-6 py-3 hover:bg-secondary transition">
                    <i class="fas fa-external-link-alt w-6"></i>
                    <span>Voir le site</span>
                </a>

                <form method="POST" action="{{ route('logout') }}" class="mt-4">
                    @csrf
                    <button type="submit" class="flex items-center px-6 py-3 w-full text-left hover:bg-secondary transition text-red-400">
                        <i class="fas fa-sign-out-alt w-6"></i>
                        <span>Déconnexion</span>
                    </button>
                </form>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 ml-64">
            <!-- Top Bar -->
            <header class="bg-white shadow-sm px-8 py-4 flex justify-between items-center">
                <h2 class="text-xl font-semibold text-gray-800">@yield('page-title', 'Administration')</h2>
                <div class="flex items-center space-x-4">
                    <span class="text-gray-600">{{ auth()->user()->name }}</span>
                    <div class="w-10 h-10 rounded-full bg-accent flex items-center justify-center text-white font-bold">
                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                    </div>
                </div>
            </header>

            <!-- Flash Messages -->
            @if (session('success'))
                <div class="mx-8 mt-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            @if (session('error'))
                <div class="mx-8 mt-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                    <span class="block sm:inline">{{ session('error') }}</span>
                </div>
            @endif

            <!-- Page Content -->
            <div class="p-8">
                @yield('content')
            </div>
        </main>
    </div>

    @stack('scripts')
</body>
</html>
