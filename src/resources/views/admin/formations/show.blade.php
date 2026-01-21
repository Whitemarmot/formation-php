@extends('admin.layout')

@section('title', $formation->name)
@section('page-title', 'Details de la formation')

@section('content')
    <div class="mb-6 flex justify-between items-center">
        <a href="{{ route('admin.formations.index') }}" class="text-gray-600 hover:text-gray-800">
            <i class="fas fa-arrow-left mr-2"></i>Retour aux formations
        </a>
        <a href="{{ route('admin.formations.edit', $formation) }}"
           class="bg-accent hover:bg-accent/90 text-white px-4 py-2 rounded-lg transition">
            <i class="fas fa-edit mr-2"></i>Modifier
        </a>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Main Info -->
        <div class="lg:col-span-2 space-y-6">
            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex items-start justify-between mb-4">
                    <div>
                        <h2 class="text-2xl font-bold text-gray-800">{{ $formation->name }}</h2>
                        @if($formation->subtitle)
                            <p class="text-gray-600 mt-1">{{ $formation->subtitle }}</p>
                        @endif
                    </div>
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium
                        {{ $formation->level == 1 ? 'bg-green-100 text-green-800' : '' }}
                        {{ $formation->level == 2 ? 'bg-blue-100 text-blue-800' : '' }}
                        {{ $formation->level == 3 ? 'bg-purple-100 text-purple-800' : '' }}">
                        Niveau {{ $formation->level }}
                    </span>
                </div>

                @if($formation->short_description)
                    <p class="text-gray-700 mb-4">{{ $formation->short_description }}</p>
                @endif

                <div class="prose max-w-none">
                    {!! nl2br(e($formation->description)) !!}
                </div>
            </div>

            <!-- Recent Sales -->
            <div class="bg-white rounded-lg shadow">
                <div class="p-6 border-b border-gray-200">
                    <h3 class="text-lg font-semibold">Ventes recentes</h3>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Commande</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Client</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Prix</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Date</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @forelse($recentSales as $item)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4">
                                        <a href="{{ route('admin.orders.show', $item->order) }}" class="text-accent hover:underline">
                                            {{ $item->order->order_number }}
                                        </a>
                                    </td>
                                    <td class="px-6 py-4">
                                        <p class="text-sm font-medium">{{ $item->order->customer_name }}</p>
                                        <p class="text-xs text-gray-500">{{ $item->order->customer_email }}</p>
                                    </td>
                                    <td class="px-6 py-4">{{ number_format($item->unit_price, 2, ',', ' ') }} &euro;</td>
                                    <td class="px-6 py-4 text-sm text-gray-500">
                                        {{ $item->created_at->format('d/m/Y') }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-6 py-8 text-center text-gray-500">
                                        Aucune vente pour cette formation
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="space-y-6">
            <!-- Cover Image -->
            @if($formation->cover_image)
                <div class="bg-white rounded-lg shadow p-4">
                    <img src="{{ Storage::url($formation->cover_image) }}"
                         alt="{{ $formation->name }}"
                         class="w-full rounded-lg">
                </div>
            @endif

            <!-- Stats -->
            <div class="bg-white rounded-lg shadow p-6">
                <h3 class="text-lg font-semibold mb-4">Statistiques</h3>
                <dl class="space-y-4">
                    <div class="flex justify-between">
                        <dt class="text-gray-600">Ventes totales</dt>
                        <dd class="font-bold text-gray-900">{{ $formation->sales_count ?? 0 }}</dd>
                    </div>
                    <div class="flex justify-between">
                        <dt class="text-gray-600">Chiffre d'affaires</dt>
                        <dd class="font-bold text-gray-900">{{ number_format(($formation->sales_count ?? 0) * $formation->price, 2, ',', ' ') }} &euro;</dd>
                    </div>
                    <div class="flex justify-between">
                        <dt class="text-gray-600">Pages</dt>
                        <dd class="font-bold text-gray-900">{{ $formation->page_count ?? '-' }}</dd>
                    </div>
                </dl>
            </div>

            <!-- Details -->
            <div class="bg-white rounded-lg shadow p-6">
                <h3 class="text-lg font-semibold mb-4">Details</h3>
                <dl class="space-y-4">
                    <div class="flex justify-between">
                        <dt class="text-gray-600">Prix</dt>
                        <dd class="font-bold text-gray-900">{{ $formation->price }} &euro;</dd>
                    </div>
                    @if($formation->sale_price)
                        <div class="flex justify-between">
                            <dt class="text-gray-600">Prix promo</dt>
                            <dd class="font-bold text-accent">{{ $formation->sale_price }} &euro;</dd>
                        </div>
                    @endif
                    <div class="flex justify-between">
                        <dt class="text-gray-600">Statut</dt>
                        <dd>
                            @if($formation->is_active)
                                <span class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-800">Active</span>
                            @else
                                <span class="px-2 py-1 text-xs rounded-full bg-gray-100 text-gray-800">Inactive</span>
                            @endif
                        </dd>
                    </div>
                    <div class="flex justify-between">
                        <dt class="text-gray-600">Mise en avant</dt>
                        <dd>
                            @if($formation->is_featured)
                                <span class="text-accent"><i class="fas fa-star"></i> Oui</span>
                            @else
                                <span class="text-gray-400">Non</span>
                            @endif
                        </dd>
                    </div>
                    <div class="flex justify-between">
                        <dt class="text-gray-600">PDF</dt>
                        <dd>
                            @if($formation->pdf_path)
                                <span class="text-green-600"><i class="fas fa-check-circle"></i> Present</span>
                            @else
                                <span class="text-red-600"><i class="fas fa-times-circle"></i> Absent</span>
                            @endif
                        </dd>
                    </div>
                    <div class="flex justify-between">
                        <dt class="text-gray-600">Slug</dt>
                        <dd class="text-sm text-gray-700">{{ $formation->slug }}</dd>
                    </div>
                    <div class="flex justify-between">
                        <dt class="text-gray-600">Cree le</dt>
                        <dd class="text-sm text-gray-700">{{ $formation->created_at->format('d/m/Y H:i') }}</dd>
                    </div>
                </dl>
            </div>
        </div>
    </div>
@endsection
