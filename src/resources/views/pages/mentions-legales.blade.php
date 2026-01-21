@extends('layouts.app')

@section('title', 'Mentions Legales - Spot Welding Pro')

@section('content')
<div class="py-16 md:py-24">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-4xl font-display font-black text-white mb-12">
            Mentions <span class="gradient-text">Legales</span>
        </h1>

        <div class="prose prose-invert prose-lg max-w-none">
            <div class="card-techno rounded-2xl p-8 mb-8">
                <h2 class="text-2xl font-display font-bold text-white mb-4">1. Editeur du Site</h2>
                <p class="text-gray-400">
                    <strong class="text-white">Spot Welding Pro</strong><br>
                    Entreprise individuelle<br>
                    Representant legal : Kangy Ham<br>
                    Email : contact@spotweldingpro.com
                </p>
            </div>

            <div class="card-techno rounded-2xl p-8 mb-8">
                <h2 class="text-2xl font-display font-bold text-white mb-4">2. Hebergement</h2>
                <p class="text-gray-400">
                    Le site est heberge par :<br>
                    <strong class="text-white">OVH SAS</strong><br>
                    2 rue Kellermann<br>
                    59100 Roubaix - France<br>
                    RCS Lille Metropole 424 761 419 00045
                </p>
            </div>

            <div class="card-techno rounded-2xl p-8 mb-8">
                <h2 class="text-2xl font-display font-bold text-white mb-4">3. Propriete Intellectuelle</h2>
                <p class="text-gray-400">
                    L'ensemble du contenu de ce site (textes, images, videos, formations PDF) est protege par le droit d'auteur.
                    Toute reproduction, meme partielle, est interdite sans autorisation ecrite prealable.
                </p>
                <p class="text-gray-400 mt-4">
                    Les formations PDF sont vendues sous licence personnelle et non-cessible. Chaque PDF est personnalise
                    avec les informations de l'acheteur (watermark).
                </p>
            </div>

            <div class="card-techno rounded-2xl p-8 mb-8">
                <h2 class="text-2xl font-display font-bold text-white mb-4">4. Donnees Personnelles</h2>
                <p class="text-gray-400">
                    Conformement a la loi Informatique et Libertes du 6 janvier 1978 modifiee et au RGPD,
                    vous disposez d'un droit d'acces, de rectification et de suppression de vos donnees personnelles.
                </p>
                <p class="text-gray-400 mt-4">
                    Pour exercer ces droits, contactez-nous a : <a href="mailto:privacy@spotweldingpro.com" class="text-cyber hover:underline">privacy@spotweldingpro.com</a>
                </p>
                <p class="text-gray-400 mt-4">
                    Pour plus d'informations, consultez notre <a href="{{ route('confidentialite') }}" class="text-cyber hover:underline">Politique de Confidentialite</a>.
                </p>
            </div>

            <div class="card-techno rounded-2xl p-8 mb-8">
                <h2 class="text-2xl font-display font-bold text-white mb-4">5. Cookies</h2>
                <p class="text-gray-400">
                    Ce site utilise des cookies necessaires a son fonctionnement (session, panier d'achat).
                    Ces cookies ne collectent aucune donnee personnelle a des fins publicitaires.
                </p>
            </div>

            <div class="card-techno rounded-2xl p-8">
                <h2 class="text-2xl font-display font-bold text-white mb-4">6. Litiges</h2>
                <p class="text-gray-400">
                    En cas de litige, une solution amiable sera recherchee avant toute action judiciaire.
                    Le present site est soumis au droit francais. Les tribunaux francais sont seuls competents.
                </p>
            </div>
        </div>

        <p class="text-gray-500 text-sm mt-12 text-center">
            Derniere mise a jour : Janvier 2025
        </p>
    </div>
</div>
@endsection
