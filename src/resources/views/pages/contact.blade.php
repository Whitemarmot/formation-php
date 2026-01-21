@extends('layouts.app')

@section('title', 'Contact - Spot Welding Pro')

@section('content')
<div class="py-16 md:py-24">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <span class="inline-block px-4 py-1.5 bg-cyber/10 border border-cyber/30 rounded-full text-cyber text-sm font-display tracking-wider mb-6">CONTACT</span>
            <h1 class="text-4xl md:text-5xl font-display font-black text-white mb-6">
                Une <span class="gradient-text">Question</span> ?
            </h1>
            <p class="text-xl text-gray-400 max-w-2xl mx-auto">
                N'hesitez pas a nous contacter pour toute question concernant nos formations ou pour un projet specifique.
            </p>
        </div>

        <div class="grid md:grid-cols-2 gap-8 mb-16">
            <!-- Email -->
            <div class="card-techno rounded-2xl p-8 text-center">
                <div class="w-16 h-16 bg-cyber/10 rounded-full flex items-center justify-center mx-auto mb-6 border border-cyber/30">
                    <svg class="w-8 h-8 text-cyber" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                </div>
                <h3 class="text-xl font-display font-bold text-white mb-3">Email</h3>
                <a href="mailto:contact@spotweldingpro.com" class="text-cyber hover:underline text-lg">contact@spotweldingpro.com</a>
                <p class="text-gray-400 mt-4 text-sm">Reponse sous 24-48h ouvrables</p>
            </div>

            <!-- Support -->
            <div class="card-techno rounded-2xl p-8 text-center">
                <div class="w-16 h-16 bg-neon/10 rounded-full flex items-center justify-center mx-auto mb-6 border border-neon/30">
                    <svg class="w-8 h-8 text-neon" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                </div>
                <h3 class="text-xl font-display font-bold text-white mb-3">Support Technique</h3>
                <a href="mailto:support@spotweldingpro.com" class="text-neon hover:underline text-lg">support@spotweldingpro.com</a>
                <p class="text-gray-400 mt-4 text-sm">Pour les problemes de telechargement</p>
            </div>
        </div>

        <!-- FAQ rapide -->
        <div class="card-techno rounded-2xl p-8 mb-16">
            <h2 class="text-2xl font-display font-bold text-white mb-8 text-center">Questions Frequentes</h2>

            <div class="space-y-6">
                <div class="border-b border-cyber/10 pb-6">
                    <h3 class="text-lg font-display font-semibold text-white mb-2">Comment acceder a ma formation apres achat ?</h3>
                    <p class="text-gray-400">Apres le paiement, vous recevez un email avec un lien de telechargement. Vous pouvez aussi acceder a vos formations dans votre espace client.</p>
                </div>

                <div class="border-b border-cyber/10 pb-6">
                    <h3 class="text-lg font-display font-semibold text-white mb-2">Les formations sont-elles mises a jour ?</h3>
                    <p class="text-gray-400">Oui, nous mettons regulierement a jour nos formations. Vous avez acces aux mises a jour gratuitement.</p>
                </div>

                <div class="border-b border-cyber/10 pb-6">
                    <h3 class="text-lg font-display font-semibold text-white mb-2">Proposez-vous des formations sur mesure ?</h3>
                    <p class="text-gray-400">Oui, nous pouvons creer des formations personnalisees pour les entreprises. Contactez-nous pour un devis.</p>
                </div>

                <div>
                    <h3 class="text-lg font-display font-semibold text-white mb-2">Quelle est votre politique de remboursement ?</h3>
                    <p class="text-gray-400">Nous offrons une garantie satisfait ou rembourse de 30 jours sur toutes nos formations.</p>
                </div>
            </div>
        </div>

        <!-- Info supplementaire -->
        <div class="text-center">
            <p class="text-gray-500 mb-4">Vous etes une entreprise ?</p>
            <p class="text-gray-400">
                Nous proposons des tarifs groupe et des formations sur mesure pour les equipes industrielles.
                <br>
                <a href="mailto:entreprises@spotweldingpro.com" class="text-cyber hover:underline">entreprises@spotweldingpro.com</a>
            </p>
        </div>
    </div>
</div>
@endsection
