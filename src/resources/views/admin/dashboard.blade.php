@extends('admin.layout')

@section('title', 'Tableau de bord')
@section('page-title', 'Tableau de bord')

@section('content')
    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <!-- Total Revenue -->
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-green-100 text-green-600">
                    <i class="fas fa-euro-sign text-2xl"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm text-gray-500">Chiffre d'affaires total</p>
                    <p class="text-2xl font-bold text-gray-800">{{ number_format($totalRevenue, 2, ',', ' ') }} &euro;</p>
                </div>
            </div>
            <div class="mt-4 text-sm text-gray-500">
                <span class="text-green-600 font-medium">{{ number_format($monthlyRevenue, 2, ',', ' ') }} &euro;</span> ce mois
            </div>
        </div>

        <!-- Total Orders -->
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-blue-100 text-blue-600">
                    <i class="fas fa-shopping-cart text-2xl"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm text-gray-500">Commandes</p>
                    <p class="text-2xl font-bold text-gray-800">{{ $totalOrders }}</p>
                </div>
            </div>
            <div class="mt-4 text-sm text-gray-500">
                <span class="text-blue-600 font-medium">{{ $monthlyOrders }}</span> ce mois
            </div>
        </div>

        <!-- Total Customers -->
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-purple-100 text-purple-600">
                    <i class="fas fa-users text-2xl"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm text-gray-500">Clients</p>
                    <p class="text-2xl font-bold text-gray-800">{{ $totalCustomers }}</p>
                </div>
            </div>
        </div>

        <!-- Total Downloads -->
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-orange-100 text-orange-600">
                    <i class="fas fa-download text-2xl"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm text-gray-500">Telechargements</p>
                    <p class="text-2xl font-bold text-gray-800">{{ $totalDownloads }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Alerts -->
    @if($pendingOrders > 0 || $failedOrders > 0)
        <div class="mb-8 space-y-4">
            @if($pendingOrders > 0)
                <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4">
                    <div class="flex">
                        <i class="fas fa-exclamation-triangle text-yellow-400 mt-1"></i>
                        <div class="ml-3">
                            <p class="text-sm text-yellow-700">
                                <strong>{{ $pendingOrders }}</strong> commande(s) en attente de paiement
                                <a href="{{ route('admin.orders.index', ['status' => 'pending']) }}" class="underline ml-2">Voir</a>
                            </p>
                        </div>
                    </div>
                </div>
            @endif

            @if($failedOrders > 0)
                <div class="bg-red-50 border-l-4 border-red-400 p-4">
                    <div class="flex">
                        <i class="fas fa-times-circle text-red-400 mt-1"></i>
                        <div class="ml-3">
                            <p class="text-sm text-red-700">
                                <strong>{{ $failedOrders }}</strong> commande(s) echouee(s) dans les dernieres 24h
                                <a href="{{ route('admin.orders.index', ['status' => 'failed']) }}" class="underline ml-2">Voir</a>
                            </p>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Revenue Chart -->
        <div class="lg:col-span-2 bg-white rounded-lg shadow p-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Evolution du chiffre d'affaires</h3>
            <canvas id="revenueChart" height="120"></canvas>
        </div>

        <!-- Top Formations -->
        <div class="bg-white rounded-lg shadow p-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Meilleures ventes</h3>
            <div class="space-y-4">
                @forelse($topFormations as $formation)
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <span class="w-8 h-8 rounded-full bg-accent text-white flex items-center justify-center text-sm font-bold">
                                {{ $formation->level }}
                            </span>
                            <div class="ml-3">
                                <p class="text-sm font-medium text-gray-800">{{ Str::limit($formation->name, 25) }}</p>
                                <p class="text-xs text-gray-500">{{ $formation->price }} &euro;</p>
                            </div>
                        </div>
                        <span class="text-sm font-bold text-gray-600">{{ $formation->sales_count }} ventes</span>
                    </div>
                @empty
                    <p class="text-gray-500 text-sm">Aucune vente pour le moment</p>
                @endforelse
            </div>
        </div>
    </div>

    <!-- Recent Orders -->
    <div class="mt-8 bg-white rounded-lg shadow">
        <div class="p-6 border-b border-gray-200">
            <div class="flex justify-between items-center">
                <h3 class="text-lg font-semibold text-gray-800">Dernieres commandes</h3>
                <a href="{{ route('admin.orders.index') }}" class="text-accent hover:text-accent/80 text-sm">
                    Voir toutes <i class="fas fa-arrow-right ml-1"></i>
                </a>
            </div>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Commande</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Client</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Formations</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Total</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Statut</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Date</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($recentOrders as $order)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4">
                                <a href="{{ route('admin.orders.show', $order) }}" class="text-accent hover:underline font-medium">
                                    {{ $order->order_number }}
                                </a>
                            </td>
                            <td class="px-6 py-4">
                                <div>
                                    <p class="text-sm font-medium text-gray-900">{{ $order->customer_name }}</p>
                                    <p class="text-sm text-gray-500">{{ $order->customer_email }}</p>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-sm text-gray-900">
                                    @foreach($order->items->take(2) as $item)
                                        <span class="inline-block bg-gray-100 rounded px-2 py-1 text-xs mr-1 mb-1">
                                            {{ Str::limit($item->formation_name, 20) }}
                                        </span>
                                    @endforeach
                                    @if($order->items->count() > 2)
                                        <span class="text-gray-500 text-xs">+{{ $order->items->count() - 2 }}</span>
                                    @endif
                                </div>
                            </td>
                            <td class="px-6 py-4 text-sm font-medium text-gray-900">
                                {{ number_format($order->total, 2, ',', ' ') }} &euro;
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
                                {{ $order->created_at->format('d/m/Y H:i') }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-8 text-center text-gray-500">
                                Aucune commande pour le moment
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    const ctx = document.getElementById('revenueChart').getContext('2d');
    new Chart(ctx, {
        type: 'line',
        data: {
            labels: @json($revenueChart['labels']),
            datasets: [{
                label: 'Chiffre d\'affaires (EUR)',
                data: @json($revenueChart['revenues']),
                borderColor: '#e94560',
                backgroundColor: 'rgba(233, 69, 96, 0.1)',
                fill: true,
                tension: 0.4
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    display: false
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function(value) {
                            return value + ' \u20AC';
                        }
                    }
                }
            }
        }
    });
</script>
@endpush
