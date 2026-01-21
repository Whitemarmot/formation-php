@extends('layouts.app')

@section('title', 'Mes Téléchargements - Spot Welding Pro')

@section('content')
<div class="py-12">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-3xl font-bold text-white mb-8">Mes Téléchargements</h1>

        @if($downloads->isEmpty())
        <div class="bg-darkcard rounded-xl p-12 text-center border border-gray-700">
            <svg class="w-16 h-16 text-gray-500 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
            </svg>
            <h2 class="text-xl font-semibold text-white mb-2">Aucun téléchargement</h2>
            <p class="text-gray-400 mb-6">Vous n'avez pas encore de formations à télécharger.</p>
            <a href="{{ route('formations.index') }}" class="inline-block px-6 py-3 bg-primary hover:bg-primary/80 text-white font-medium rounded-lg transition-colors">
                Voir les formations
            </a>
        </div>
        @else
        <div class="space-y-4">
            @foreach($downloads as $download)
            <div class="bg-darkcard rounded-xl p-6 border border-gray-700">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-4">
                        <div class="w-14 h-14 bg-gradient-to-br from-primary/20 to-secondary/20 rounded-lg flex items-center justify-center">
                            <svg class="w-7 h-7 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-white">{{ $download->formation->title }}</h3>
                            <p class="text-gray-400 text-sm">
                                Expire le {{ $download->expires_at->format('d/m/Y') }}
                                @if($download->download_count > 0)
                                • {{ $download->download_count }} téléchargement(s)
                                @endif
                            </p>
                        </div>
                    </div>
                    <div>
                        @if($download->expires_at->isFuture())
                        <a href="{{ route('download.file', $download->token) }}"
                           class="inline-flex items-center gap-2 px-4 py-2 bg-primary hover:bg-primary/80 text-white font-medium rounded-lg transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                            </svg>
                            Télécharger
                        </a>
                        @else
                        <span class="inline-flex items-center gap-2 px-4 py-2 bg-gray-700 text-gray-400 font-medium rounded-lg cursor-not-allowed">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            Expiré
                        </span>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @endif
    </div>
</div>
@endsection
