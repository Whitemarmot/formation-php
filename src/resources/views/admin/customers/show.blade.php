@extends('admin.layout')

@section('title', $customer->name)
@section('page-title', 'Profil client')

@section('content')
    <div class="mb-6">
        <a href="{{ route('admin.customers.index') }}" class="text-gray-600 hover:text-gray-800">
            <i class="fas fa-arrow-left mr-2"></i>Retour aux clients
        </a>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Main Content -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Orders -->
            <div class="bg-white rounded-lg shadow">
                <div class="p-6 border-b border-gray-200">
                    <h3 class="text-lg font-semibold">Historique des commandes</h3>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Commande</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Formations</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Total</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Statut</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Date</th>
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
                                        @foreach($order->items->take(2) as $item)
                                            <span class="inline-block bg-gray-100 rounded px-2 py-1 text-xs mr-1">
                                                {{ Str::limit($item->formation_name, 15) }}
                                            </span>
                                        @endforeach
                                        @if($order->items->count() > 2)
                                            <span class="text-xs text-gray-500">+{{ $order->items->count() - 2 }}</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 font-medium">
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
                                        {{ $order->created_at->format('d/m/Y') }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-8 text-center text-gray-500">
                                        Aucune commande
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Downloads -->
            @if($downloads->count() > 0)
                <div class="bg-white rounded-lg shadow">
                    <div class="p-6 border-b border-gray-200">
                        <h3 class="text-lg font-semibold">Telechargements</h3>
                    </div>
                    <div class="p-6">
                        <div class="space-y-3">
                            @foreach($downloads as $download)
                                <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                                    <div>
                                        <p class="font-medium">{{ $download->formation->name ?? 'Formation' }}</p>
                                        <p class="text-sm text-gray-500">
                                            Commande {{ $download->order->order_number ?? '-' }}
                                            &bull;
                                            {{ $download->download_count }} telechargement(s)
                                        </p>
                                    </div>
                                    <div class="text-right">
                                        @if($download->expires_at > now())
                                            <span class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-800">
                                                Expire le {{ $download->expires_at->format('d/m/Y') }}
                                            </span>
                                        @else
                                            <span class="px-2 py-1 text-xs rounded-full bg-red-100 text-red-800">Expire</span>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif
        </div>

        <!-- Sidebar -->
        <div class="space-y-6">
            <!-- Client Info -->
            <div class="bg-white rounded-lg shadow p-6">
                <div class="text-center mb-6">
                    <div class="w-20 h-20 rounded-full bg-accent/10 flex items-center justify-center text-accent text-3xl font-bold mx-auto mb-4">
                        {{ strtoupper(substr($customer->name, 0, 1)) }}
                    </div>
                    <h2 class="text-xl font-bold text-gray-800">{{ $customer->name }}</h2>
                    <p class="text-gray-500">{{ $customer->email }}</p>
                </div>

                <dl class="space-y-4">
                    @if($customer->company)
                        <div>
                            <dt class="text-xs text-gray-500 uppercase">Entreprise</dt>
                            <dd class="font-medium">{{ $customer->company }}</dd>
                        </div>
                    @endif
                    @if($customer->phone)
                        <div>
                            <dt class="text-xs text-gray-500 uppercase">Telephone</dt>
                            <dd>
                                <a href="tel:{{ $customer->phone }}" class="text-accent hover:underline">
                                    {{ $customer->phone }}
                                </a>
                            </dd>
                        </div>
                    @endif
                    @if($customer->city || $customer->country)
                        <div>
                            <dt class="text-xs text-gray-500 uppercase">Localisation</dt>
                            <dd>{{ $customer->city }}{{ $customer->city && $customer->country ? ', ' : '' }}{{ $customer->country }}</dd>
                        </div>
                    @endif
                    <div>
                        <dt class="text-xs text-gray-500 uppercase">Inscrit le</dt>
                        <dd>{{ $customer->created_at->format('d/m/Y a H:i') }}</dd>
                    </div>
                </dl>
            </div>

            <!-- Stats -->
            <div class="bg-white rounded-lg shadow p-6">
                <h3 class="font-semibold mb-4">Statistiques</h3>
                <dl class="space-y-4">
                    <div class="flex justify-between">
                        <dt class="text-gray-600">Commandes completees</dt>
                        <dd class="font-bold text-gray-900">{{ $customer->total_orders ?? 0 }}</dd>
                    </div>
                    <div class="flex justify-between">
                        <dt class="text-gray-600">Total depense</dt>
                        <dd class="font-bold text-gray-900">
                            {{ number_format($orders->where('status', 'completed')->sum('total'), 2, ',', ' ') }} &euro;
                        </dd>
                    </div>
                    <div class="flex justify-between">
                        <dt class="text-gray-600">Formations possedees</dt>
                        <dd class="font-bold text-gray-900">{{ count($ownedFormations) }}</dd>
                    </div>
                </dl>
            </div>

            <!-- Owned Formations -->
            @if(count($ownedFormations) > 0)
                <div class="bg-white rounded-lg shadow p-6">
                    <h3 class="font-semibold mb-4">Formations achetees</h3>
                    <div class="space-y-2">
                        @foreach($ownedFormations as $formation)
                            <a href="{{ route('admin.formations.show', $formation) }}"
                               class="block p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition">
                                <p class="font-medium text-sm">{{ $formation->name }}</p>
                                <p class="text-xs text-gray-500">Niveau {{ $formation->level }}</p>
                            </a>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection
