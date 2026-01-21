@extends('admin.layout')

@section('title', 'Clients')
@section('page-title', 'Gestion des clients')

@section('content')
    <!-- Stats -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
        <div class="bg-white rounded-lg shadow p-4">
            <p class="text-xs text-gray-500 uppercase">Total inscrits</p>
            <p class="text-2xl font-bold text-gray-800">{{ $stats['total'] }}</p>
        </div>
        <div class="bg-white rounded-lg shadow p-4">
            <p class="text-xs text-gray-500 uppercase">Avec commandes</p>
            <p class="text-2xl font-bold text-green-600">{{ $stats['with_orders'] }}</p>
        </div>
        <div class="bg-white rounded-lg shadow p-4">
            <p class="text-xs text-gray-500 uppercase">CA Total</p>
            <p class="text-2xl font-bold text-gray-800">{{ number_format($stats['total_revenue'] ?? 0, 0, ',', ' ') }} &euro;</p>
        </div>
    </div>

    <!-- Filters -->
    <div class="bg-white rounded-lg shadow p-4 mb-6">
        <form method="GET" action="{{ route('admin.customers.index') }}" class="flex flex-wrap gap-4 items-end">
            <div>
                <label for="search" class="block text-xs font-medium text-gray-500 mb-1">Recherche</label>
                <input type="text" name="search" id="search" value="{{ request('search') }}"
                       placeholder="Nom, email, entreprise..."
                       class="border-gray-300 rounded-lg shadow-sm text-sm">
            </div>
            <div>
                <label class="flex items-center">
                    <input type="checkbox" name="with_orders" value="1" {{ request('with_orders') ? 'checked' : '' }}
                           class="rounded border-gray-300 text-accent">
                    <span class="ml-2 text-sm text-gray-700">Avec commandes uniquement</span>
                </label>
            </div>
            <div class="flex gap-2">
                <button type="submit" class="bg-primary text-white px-4 py-2 rounded-lg text-sm hover:bg-primary/90">
                    <i class="fas fa-search mr-1"></i>Filtrer
                </button>
                <a href="{{ route('admin.customers.index') }}" class="border border-gray-300 px-4 py-2 rounded-lg text-sm hover:bg-gray-50">
                    Reset
                </a>
            </div>
            <div class="ml-auto">
                <a href="{{ route('admin.customers.export') }}"
                   class="bg-green-600 text-white px-4 py-2 rounded-lg text-sm hover:bg-green-700">
                    <i class="fas fa-download mr-1"></i>Export CSV
                </a>
            </div>
        </form>
    </div>

    <!-- Customers Table -->
    <div class="bg-white rounded-lg shadow overflow-hidden">
        <table class="w-full">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Client</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Entreprise</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Commandes</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Total depense</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Inscrit le</th>
                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse($customers as $customer)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4">
                            <div class="flex items-center">
                                <div class="w-10 h-10 rounded-full bg-accent/10 flex items-center justify-center text-accent font-bold mr-3">
                                    {{ strtoupper(substr($customer->name, 0, 1)) }}
                                </div>
                                <div>
                                    <p class="font-medium text-gray-900">{{ $customer->name }}</p>
                                    <p class="text-sm text-gray-500">{{ $customer->email }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-600">
                            {{ $customer->company ?? '-' }}
                        </td>
                        <td class="px-6 py-4">
                            <span class="font-medium">{{ $customer->total_orders ?? 0 }}</span>
                        </td>
                        <td class="px-6 py-4 font-medium">
                            {{ number_format($customer->total_spent ?? 0, 2, ',', ' ') }} &euro;
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-500">
                            {{ $customer->created_at->format('d/m/Y') }}
                        </td>
                        <td class="px-6 py-4 text-right">
                            <a href="{{ route('admin.customers.show', $customer) }}"
                               class="text-gray-600 hover:text-gray-800" title="Voir">
                                <i class="fas fa-eye"></i>
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-6 py-8 text-center text-gray-500">
                            Aucun client trouve
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="mt-6">
        {{ $customers->withQueryString()->links() }}
    </div>
@endsection
