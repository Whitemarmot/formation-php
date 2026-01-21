@extends('admin.layout')

@section('title', 'Commandes')
@section('page-title', 'Gestion des commandes')

@section('content')
    <!-- Stats -->
    <div class="grid grid-cols-2 md:grid-cols-5 gap-4 mb-6">
        <div class="bg-white rounded-lg shadow p-4">
            <p class="text-xs text-gray-500 uppercase">Total</p>
            <p class="text-2xl font-bold text-gray-800">{{ $stats['total'] }}</p>
        </div>
        <div class="bg-white rounded-lg shadow p-4">
            <p class="text-xs text-gray-500 uppercase">Completees</p>
            <p class="text-2xl font-bold text-green-600">{{ $stats['completed'] }}</p>
        </div>
        <div class="bg-white rounded-lg shadow p-4">
            <p class="text-xs text-gray-500 uppercase">En attente</p>
            <p class="text-2xl font-bold text-yellow-600">{{ $stats['pending'] }}</p>
        </div>
        <div class="bg-white rounded-lg shadow p-4">
            <p class="text-xs text-gray-500 uppercase">Echouees</p>
            <p class="text-2xl font-bold text-red-600">{{ $stats['failed'] }}</p>
        </div>
        <div class="bg-white rounded-lg shadow p-4">
            <p class="text-xs text-gray-500 uppercase">CA Total</p>
            <p class="text-2xl font-bold text-gray-800">{{ number_format($stats['revenue'], 0, ',', ' ') }} &euro;</p>
        </div>
    </div>

    <!-- Filters -->
    <div class="bg-white rounded-lg shadow p-4 mb-6">
        <form method="GET" action="{{ route('admin.orders.index') }}" class="flex flex-wrap gap-4 items-end">
            <div>
                <label for="search" class="block text-xs font-medium text-gray-500 mb-1">Recherche</label>
                <input type="text" name="search" id="search" value="{{ request('search') }}"
                       placeholder="Numero, email, nom..."
                       class="border-gray-300 rounded-lg shadow-sm text-sm">
            </div>
            <div>
                <label for="status" class="block text-xs font-medium text-gray-500 mb-1">Statut</label>
                <select name="status" id="status" class="border-gray-300 rounded-lg shadow-sm text-sm">
                    <option value="">Tous</option>
                    <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>En attente</option>
                    <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Completees</option>
                    <option value="failed" {{ request('status') == 'failed' ? 'selected' : '' }}>Echouees</option>
                    <option value="refunded" {{ request('status') == 'refunded' ? 'selected' : '' }}>Remboursees</option>
                </select>
            </div>
            <div>
                <label for="from_date" class="block text-xs font-medium text-gray-500 mb-1">Du</label>
                <input type="date" name="from_date" id="from_date" value="{{ request('from_date') }}"
                       class="border-gray-300 rounded-lg shadow-sm text-sm">
            </div>
            <div>
                <label for="to_date" class="block text-xs font-medium text-gray-500 mb-1">Au</label>
                <input type="date" name="to_date" id="to_date" value="{{ request('to_date') }}"
                       class="border-gray-300 rounded-lg shadow-sm text-sm">
            </div>
            <div class="flex gap-2">
                <button type="submit" class="bg-primary text-white px-4 py-2 rounded-lg text-sm hover:bg-primary/90">
                    <i class="fas fa-search mr-1"></i>Filtrer
                </button>
                <a href="{{ route('admin.orders.index') }}" class="border border-gray-300 px-4 py-2 rounded-lg text-sm hover:bg-gray-50">
                    Reset
                </a>
            </div>
            <div class="ml-auto">
                <a href="{{ route('admin.orders.export', request()->query()) }}"
                   class="bg-green-600 text-white px-4 py-2 rounded-lg text-sm hover:bg-green-700">
                    <i class="fas fa-download mr-1"></i>Export CSV
                </a>
            </div>
        </form>
    </div>

    <!-- Orders Table -->
    <div class="bg-white rounded-lg shadow overflow-hidden">
        <table class="w-full">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Commande</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Client</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Formations</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Total</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Paiement</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Statut</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Date</th>
                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse($orders as $order)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4">
                            <a href="{{ route('admin.orders.show', $order) }}" class="text-accent hover:underline font-medium">
                                {{ $order->order_number }}
                            </a>
                        </td>
                        <td class="px-6 py-4">
                            <p class="text-sm font-medium text-gray-900">{{ $order->customer_name }}</p>
                            <p class="text-xs text-gray-500">{{ $order->customer_email }}</p>
                        </td>
                        <td class="px-6 py-4">
                            @foreach($order->items->take(2) as $item)
                                <span class="inline-block bg-gray-100 rounded px-2 py-1 text-xs mr-1 mb-1">
                                    {{ Str::limit($item->formation_name, 15) }}
                                </span>
                            @endforeach
                            @if($order->items->count() > 2)
                                <span class="text-gray-500 text-xs">+{{ $order->items->count() - 2 }}</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 font-medium">
                            {{ number_format($order->total, 2, ',', ' ') }} &euro;
                            @if($order->discount > 0)
                                <span class="text-xs text-green-600 block">-{{ number_format($order->discount, 2, ',', ' ') }} &euro;</span>
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            <span class="text-sm text-gray-600">
                                @if($order->payment_method == 'stripe')
                                    <i class="fab fa-stripe text-blue-600"></i> Stripe
                                @elseif($order->payment_method == 'paypal')
                                    <i class="fab fa-paypal text-blue-800"></i> PayPal
                                @elseif($order->payment_method == 'test')
                                    <i class="fas fa-flask text-purple-600"></i> Test
                                @else
                                    {{ $order->payment_method ?? '-' }}
                                @endif
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            @php
                                $statusColors = [
                                    'completed' => 'bg-green-100 text-green-800',
                                    'pending' => 'bg-yellow-100 text-yellow-800',
                                    'processing' => 'bg-blue-100 text-blue-800',
                                    'failed' => 'bg-red-100 text-red-800',
                                    'refunded' => 'bg-gray-100 text-gray-800',
                                ];
                            @endphp
                            <span class="px-2 py-1 text-xs rounded-full {{ $statusColors[$order->status] ?? 'bg-gray-100' }}">
                                {{ $order->status_label }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-500">
                            {{ $order->created_at->format('d/m/Y') }}<br>
                            <span class="text-xs">{{ $order->created_at->format('H:i') }}</span>
                        </td>
                        <td class="px-6 py-4 text-right">
                            <a href="{{ route('admin.orders.show', $order) }}"
                               class="text-gray-600 hover:text-gray-800" title="Voir">
                                <i class="fas fa-eye"></i>
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="px-6 py-8 text-center text-gray-500">
                            Aucune commande trouvee
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="mt-6">
        {{ $orders->withQueryString()->links() }}
    </div>
@endsection
