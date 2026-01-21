@extends('layouts.app')

@section('title', 'Mes Téléchargements - Spot Welding Pro')

@section('content')
<div class="py-16 md:py-24">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="mb-10">
            <nav class="mb-4">
                <ol class="flex items-center space-x-2 text-sm text-gray-400">
                    <li><a href="{{ route('home') }}" class="hover:text-cyber transition-colors">Accueil</a></li>
                    <li><span class="text-gray-600">/</span></li>
                    <li class="text-white">Mes Téléchargements</li>
                </ol>
            </nav>
            <h1 class="text-3xl md:text-4xl font-display font-black text-white">
                Mes <span class="gradient-text">Téléchargements</span>
            </h1>
        </div>

        @if($downloads->isEmpty())
        <div class="card-techno rounded-2xl p-12 text-center border-cyber/20">
            <div class="w-20 h-20 bg-gradient-to-br from-cyber/10 to-neon/10 rounded-2xl flex items-center justify-center mx-auto mb-6 border border-cyber/20">
                <svg class="w-10 h-10 text-cyber/50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                </svg>
            </div>
            <h2 class="text-2xl font-display font-bold text-white mb-3">Aucun téléchargement</h2>
            <p class="text-gray-400 mb-8 max-w-md mx-auto">Vous n'avez pas encore de formations à télécharger. Découvrez nos formations professionnelles.</p>
            <a href="{{ route('formations.index') }}" class="btn-cyber px-8 py-4 rounded-xl font-display inline-flex items-center gap-3">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                </svg>
                Voir les formations
            </a>
        </div>
        @else
        <div class="space-y-4">
            @foreach($downloads as $download)
            <div class="card-techno rounded-xl overflow-hidden group">
                <div class="h-1 bg-gradient-to-r {{ $download->expires_at->isFuture() ? 'from-success to-cyber' : 'from-gray-600 to-gray-700' }}"></div>
                <div class="p-6">
                    <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
                        <div class="flex items-center gap-4">
                            <div class="w-14 h-14 bg-gradient-to-br from-cyber/20 to-neon/20 rounded-xl flex items-center justify-center border border-cyber/20 flex-shrink-0">
                                <svg class="w-7 h-7 text-cyber" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-lg font-display font-semibold text-white group-hover:text-cyber transition-colors">{{ $download->formation->title }}</h3>
                                <div class="flex flex-wrap items-center gap-3 mt-1">
                                    <span class="text-gray-400 text-sm flex items-center gap-1.5">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                        </svg>
                                        Expire le {{ $download->expires_at->format('d/m/Y') }}
                                    </span>
                                    @if($download->download_count > 0)
                                    <span class="text-gray-500 text-sm flex items-center gap-1.5">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                                        </svg>
                                        {{ $download->download_count }} téléchargement(s)
                                    </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="w-full sm:w-auto">
                            @if($download->expires_at->isFuture())
                            <a href="{{ route('download.file', $download->token) }}"
                               class="btn-cyber px-6 py-3 rounded-xl font-display text-sm flex items-center justify-center gap-2 w-full sm:w-auto">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                                </svg>
                                Télécharger
                            </a>
                            @else
                            <span class="inline-flex items-center justify-center gap-2 px-6 py-3 bg-steel/50 text-gray-500 font-display text-sm rounded-xl cursor-not-allowed w-full sm:w-auto">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                Expiré
                            </span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @endif
    </div>
</div>
@endsection
