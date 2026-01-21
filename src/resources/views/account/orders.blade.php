@extends('layouts.app')

@section('title', 'Mes Commandes - Spot Welding Pro')

@section('content')
<div class="py-12">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-3xl font-bold text-white mb-8">Mes Commandes</h1>

        @if($orders->isEmpty())
        <div class="bg-darkcard rounded-xl p-12 text-center border border-gray-700">
            <svg class="w-16 h-16 text-gray-500 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
            </svg>
            <h2 class="text-xl font-semibold text-white mb-2">Aucune commande</h2>
            <p class="text-gray-400 mb-6">Vous n'avez pas encore passé de commande.</p>
            <a href="{{ route('formations.index') }}" class="inline-block px-6 py-3 bg-primary hover:bg-primary/80 text-white font-medium rounded-lg transition-colors">
                Voir les formations
            </a>
        </div>
        @else
        <div class="space-y-4">
            @foreach($orders as $order)
            <div class="bg-darkcard rounded-xl p-6 border border-gray-700">
                <div class="flex flex-wrap items-center justify-between gap-4 mb-4">
                    <div>
                        <p class="text-sm text-gray-400">Commande #{{ $order->order_number }}</p>
                        <p class="text-lg font-semibold text-white">{{ number_format($order->total_amount, 2, ',', ' ') }} €</p>
                    </div>
                    <div class="text-right">
                        <span class="inline-block px-3 py-1 text-sm font-medium rounded-full
                            @if($order->status === 'completed') bg-success/20 text-success
                            @elseif($order->status === 'pending') bg-warning/20 text-warning
                            @else bg-danger/20 text-danger @endif">
                            {{ ucfirst($order->status) }}
                        </span>
                        <p class="text-sm text-gray-400 mt-1">{{ $order->created_at->format('d/m/Y H:i') }}</p>
                    </div>
                </div>

                <div class="border-t border-gray-700 pt-4">
                    <h4 class="text-sm font-medium text-gray-400 mb-2">Formations</h4>
                    <ul class="space-y-2">
                        @foreach($order->items as $item)
                        <li class="flex items-center justify-between text-sm">
                            <span class="text-white">{{ $item->formation->title }}</span>
                            <span class="text-gray-400">{{ number_format($item->price, 2, ',', ' ') }} €</span>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            @endforeach
        </div>

        <div class="mt-6">
            {{ $orders->links() }}
        </div>
        @endif
    </div>
</div>
@endsection
