@extends('layouts.app')

@section('title', 'Mes Commandes - Spot Welding Pro')

@section('content')
<div class="py-16 md:py-24">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="mb-10">
            <nav class="mb-4">
                <ol class="flex items-center space-x-2 text-sm text-gray-400">
                    <li><a href="{{ route('home') }}" class="hover:text-cyber transition-colors">Accueil</a></li>
                    <li><span class="text-gray-600">/</span></li>
                    <li class="text-white">Mes Commandes</li>
                </ol>
            </nav>
            <h1 class="text-3xl md:text-4xl font-display font-black text-white">
                Mes <span class="gradient-text">Commandes</span>
            </h1>
        </div>

        @if($orders->isEmpty())
        <div class="card-techno rounded-2xl p-12 text-center border-cyber/20">
            <div class="w-20 h-20 bg-gradient-to-br from-neon/10 to-plasma/10 rounded-2xl flex items-center justify-center mx-auto mb-6 border border-neon/20">
                <svg class="w-10 h-10 text-neon/50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                </svg>
            </div>
            <h2 class="text-2xl font-display font-bold text-white mb-3">Aucune commande</h2>
            <p class="text-gray-400 mb-8 max-w-md mx-auto">Vous n'avez pas encore passé de commande. Découvrez nos formations professionnelles.</p>
            <a href="{{ route('formations.index') }}" class="btn-neon px-8 py-4 rounded-xl font-display inline-flex items-center gap-3">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                </svg>
                Voir les formations
            </a>
        </div>
        @else
        <div class="space-y-6">
            @foreach($orders as $order)
            <div class="card-techno rounded-xl overflow-hidden">
                <div class="h-1 bg-gradient-to-r
                    @if($order->status === 'completed') from-success to-cyber
                    @elseif($order->status === 'pending') from-spark to-neon
                    @else from-danger to-plasma @endif"></div>
                <div class="p-6">
                    <div class="flex flex-wrap items-center justify-between gap-4 mb-6">
                        <div>
                            <p class="text-sm text-gray-500 font-mono">Commande #{{ $order->order_number }}</p>
                            <p class="price-tag text-2xl font-black mt-1">{{ number_format($order->total_amount, 2, ',', ' ') }} €</p>
                        </div>
                        <div class="text-right">
                            <span class="inline-flex items-center gap-2 px-4 py-2 text-sm font-display font-semibold rounded-full
                                @if($order->status === 'completed') bg-success/10 text-success border border-success/30
                                @elseif($order->status === 'pending') bg-spark/10 text-spark border border-spark/30
                                @else bg-danger/10 text-danger border border-danger/30 @endif">
                                @if($order->status === 'completed')
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                @elseif($order->status === 'pending')
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                @else
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                                @endif
                                {{ ucfirst($order->status) }}
                            </span>
                            <p class="text-sm text-gray-500 mt-2 flex items-center justify-end gap-1.5">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                                {{ $order->created_at->format('d/m/Y H:i') }}
                            </p>
                        </div>
                    </div>

                    <div class="border-t border-cyber/10 pt-6">
                        <h4 class="text-sm font-display font-semibold text-gray-400 mb-4 flex items-center gap-2">
                            <svg class="w-4 h-4 text-cyber" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                            </svg>
                            Formations
                        </h4>
                        <ul class="space-y-3">
                            @foreach($order->items as $item)
                            <li class="flex items-center justify-between p-3 bg-abyss/50 rounded-lg border border-cyber/10">
                                <span class="text-white font-display">{{ $item->formation->title }}</span>
                                <span class="text-cyber font-mono">{{ number_format($item->price, 2, ',', ' ') }} €</span>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <div class="mt-8">
            {{ $orders->links() }}
        </div>
        @endif
    </div>
</div>
@endsection
