@extends('admin.layout')

@section('title', 'Commande ' . $order->order_number)
@section('page-title', 'Details de la commande')

@section('content')
    <div class="mb-6">
        <a href="{{ route('admin.orders.index') }}" class="text-gray-600 hover:text-gray-800">
            <i class="fas fa-arrow-left mr-2"></i>Retour aux commandes
        </a>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Main Content -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Order Info -->
            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex items-start justify-between mb-6">
                    <div>
                        <h2 class="text-2xl font-bold text-gray-800">{{ $order->order_number }}</h2>
                        <p class="text-gray-500">{{ $order->created_at->format('d/m/Y a H:i') }}</p>
                    </div>
                    @php
                        $statusColors = [
                            'completed' => 'bg-green-100 text-green-800',
                            'pending' => 'bg-yellow-100 text-yellow-800',
                            'processing' => 'bg-blue-100 text-blue-800',
                            'failed' => 'bg-red-100 text-red-800',
                            'refunded' => 'bg-gray-100 text-gray-800',
                        ];
                    @endphp
                    <span class="px-3 py-1 rounded-full text-sm font-medium {{ $statusColors[$order->status] ?? 'bg-gray-100' }}">
                        {{ $order->status_label }}
                    </span>
                </div>

                <!-- Order Items -->
                <h3 class="font-semibold mb-4">Formations commandees</h3>
                <div class="border rounded-lg overflow-hidden">
                    <table class="w-full">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Formation</th>
                                <th class="px-4 py-2 text-right text-xs font-medium text-gray-500 uppercase">Prix</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @foreach($order->items as $item)
                                <tr>
                                    <td class="px-4 py-3">
                                        <p class="font-medium">{{ $item->formation_name }}</p>
                                        @if($item->formation)
                                            <a href="{{ route('admin.formations.show', $item->formation) }}"
                                               class="text-xs text-accent hover:underline">Voir la formation</a>
                                        @endif
                                    </td>
                                    <td class="px-4 py-3 text-right">{{ number_format($item->unit_price, 2, ',', ' ') }} &euro;</td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot class="bg-gray-50">
                            <tr>
                                <td class="px-4 py-2 text-right font-medium">Sous-total</td>
                                <td class="px-4 py-2 text-right">{{ number_format($order->subtotal, 2, ',', ' ') }} &euro;</td>
                            </tr>
                            @if($order->discount > 0)
                                <tr>
                                    <td class="px-4 py-2 text-right font-medium text-green-600">Reduction</td>
                                    <td class="px-4 py-2 text-right text-green-600">-{{ number_format($order->discount, 2, ',', ' ') }} &euro;</td>
                                </tr>
                            @endif
                            <tr class="border-t-2">
                                <td class="px-4 py-3 text-right font-bold">Total</td>
                                <td class="px-4 py-3 text-right font-bold text-lg">{{ number_format($order->total, 2, ',', ' ') }} &euro;</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>

            <!-- Downloads -->
            @if($order->downloads->count() > 0)
                <div class="bg-white rounded-lg shadow p-6">
                    <h3 class="font-semibold mb-4">Telechargements</h3>
                    <div class="space-y-3">
                        @foreach($order->downloads as $download)
                            <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                                <div>
                                    <p class="font-medium">{{ $download->formation->name ?? 'Formation' }}</p>
                                    <p class="text-sm text-gray-500">
                                        {{ $download->download_count }} telechargement(s)
                                        &bull;
                                        Expire le {{ $download->expires_at->format('d/m/Y') }}
                                    </p>
                                </div>
                                <div class="text-right">
                                    @if($download->expires_at > now())
                                        <span class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-800">Actif</span>
                                    @else
                                        <span class="px-2 py-1 text-xs rounded-full bg-red-100 text-red-800">Expire</span>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            <!-- Notes -->
            <div class="bg-white rounded-lg shadow p-6">
                <h3 class="font-semibold mb-4">Notes internes</h3>
                @if($order->notes)
                    <div class="bg-gray-50 rounded-lg p-4 mb-4 whitespace-pre-wrap text-sm">{{ $order->notes }}</div>
                @endif
                <form action="{{ route('admin.orders.add-note', $order) }}" method="POST">
                    @csrf
                    <textarea name="note" rows="2" placeholder="Ajouter une note..."
                              class="w-full border-gray-300 rounded-lg shadow-sm text-sm"></textarea>
                    <button type="submit" class="mt-2 bg-gray-600 text-white px-4 py-2 rounded-lg text-sm hover:bg-gray-700">
                        <i class="fas fa-plus mr-1"></i>Ajouter
                    </button>
                </form>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="space-y-6">
            <!-- Client Info -->
            <div class="bg-white rounded-lg shadow p-6">
                <h3 class="font-semibold mb-4">Client</h3>
                <dl class="space-y-3">
                    <div>
                        <dt class="text-xs text-gray-500 uppercase">Nom</dt>
                        <dd class="font-medium">{{ $order->customer_name }}</dd>
                    </div>
                    <div>
                        <dt class="text-xs text-gray-500 uppercase">Email</dt>
                        <dd>
                            <a href="mailto:{{ $order->customer_email }}" class="text-accent hover:underline">
                                {{ $order->customer_email }}
                            </a>
                        </dd>
                    </div>
                    @if($order->user)
                        <div>
                            <dt class="text-xs text-gray-500 uppercase">Compte</dt>
                            <dd>
                                <a href="{{ route('admin.customers.show', $order->user) }}" class="text-accent hover:underline">
                                    Voir le profil
                                </a>
                            </dd>
                        </div>
                    @else
                        <div>
                            <dt class="text-xs text-gray-500 uppercase">Compte</dt>
                            <dd class="text-gray-400">Achat en tant qu'invite</dd>
                        </div>
                    @endif
                </dl>
            </div>

            <!-- Payment Info -->
            <div class="bg-white rounded-lg shadow p-6">
                <h3 class="font-semibold mb-4">Paiement</h3>
                <dl class="space-y-3">
                    <div>
                        <dt class="text-xs text-gray-500 uppercase">Methode</dt>
                        <dd class="font-medium">
                            @if($order->payment_method == 'stripe')
                                <i class="fab fa-stripe text-blue-600"></i> Stripe
                            @elseif($order->payment_method == 'paypal')
                                <i class="fab fa-paypal text-blue-800"></i> PayPal
                            @elseif($order->payment_method == 'test')
                                <i class="fas fa-flask text-purple-600"></i> Test
                            @else
                                {{ $order->payment_method ?? '-' }}
                            @endif
                        </dd>
                    </div>
                    @if($order->payment_id)
                        <div>
                            <dt class="text-xs text-gray-500 uppercase">ID Transaction</dt>
                            <dd class="text-sm font-mono break-all">{{ $order->payment_id }}</dd>
                        </div>
                    @endif
                    @if($order->completed_at)
                        <div>
                            <dt class="text-xs text-gray-500 uppercase">Paye le</dt>
                            <dd>{{ $order->completed_at->format('d/m/Y H:i') }}</dd>
                        </div>
                    @endif
                </dl>
            </div>

            <!-- Actions -->
            <div class="bg-white rounded-lg shadow p-6">
                <h3 class="font-semibold mb-4">Actions</h3>

                <!-- Update Status -->
                <form action="{{ route('admin.orders.update-status', $order) }}" method="POST" class="mb-4">
                    @csrf
                    @method('PATCH')
                    <label class="block text-xs text-gray-500 uppercase mb-1">Modifier le statut</label>
                    <div class="flex gap-2">
                        <select name="status" class="flex-1 border-gray-300 rounded-lg shadow-sm text-sm">
                            <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>En attente</option>
                            <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>En cours</option>
                            <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>Completee</option>
                            <option value="failed" {{ $order->status == 'failed' ? 'selected' : '' }}>Echouee</option>
                            <option value="refunded" {{ $order->status == 'refunded' ? 'selected' : '' }}>Remboursee</option>
                        </select>
                        <button type="submit" class="bg-primary text-white px-3 py-2 rounded-lg text-sm hover:bg-primary/90">
                            <i class="fas fa-save"></i>
                        </button>
                    </div>
                </form>

                <!-- Resend Email -->
                @if($order->isCompleted())
                    <form action="{{ route('admin.orders.resend-email', $order) }}" method="POST">
                        @csrf
                        <button type="submit" class="w-full bg-blue-600 text-white px-4 py-2 rounded-lg text-sm hover:bg-blue-700">
                            <i class="fas fa-envelope mr-2"></i>Renvoyer l'email
                        </button>
                    </form>
                @endif
            </div>
        </div>
    </div>
@endsection
