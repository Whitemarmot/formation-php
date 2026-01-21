@extends('layouts.app')

@section('title', 'Politique de Confidentialite - Spot Welding Pro')

@section('content')
<div class="py-16 md:py-24">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-4xl font-display font-black text-white mb-12">
            Politique de <span class="gradient-text">Confidentialite</span>
        </h1>

        <div class="prose prose-invert prose-lg max-w-none space-y-8">
            <div class="card-techno rounded-2xl p-8">
                <h2 class="text-2xl font-display font-bold text-white mb-4">Introduction</h2>
                <p class="text-gray-400">
                    Spot Welding Pro s'engage a proteger votre vie privee. Cette politique decrit comment nous collectons,
                    utilisons et protegeons vos donnees personnelles conformement au RGPD.
                </p>
            </div>

            <div class="card-techno rounded-2xl p-8">
                <h2 class="text-2xl font-display font-bold text-white mb-4">1. Donnees Collectees</h2>
                <p class="text-gray-400 mb-4">Nous collectons les donnees suivantes :</p>
                <ul class="list-disc list-inside text-gray-400 space-y-2">
                    <li><strong class="text-white">Donnees d'identification</strong> : nom, prenom, adresse email</li>
                    <li><strong class="text-white">Donnees de commande</strong> : historique des achats, formations achetees</li>
                    <li><strong class="text-white">Donnees techniques</strong> : adresse IP, navigateur (pour les telechargements)</li>
                    <li><strong class="text-white">Donnees de paiement</strong> : traitees par Stripe/PayPal (nous ne stockons pas vos donnees bancaires)</li>
                </ul>
            </div>

            <div class="card-techno rounded-2xl p-8">
                <h2 class="text-2xl font-display font-bold text-white mb-4">2. Finalites du Traitement</h2>
                <p class="text-gray-400 mb-4">Vos donnees sont utilisees pour :</p>
                <ul class="list-disc list-inside text-gray-400 space-y-2">
                    <li>Gerer votre compte client</li>
                    <li>Traiter vos commandes et livrer vos formations</li>
                    <li>Personnaliser les PDF avec watermark (protection contre le piratage)</li>
                    <li>Vous envoyer des emails transactionnels (confirmation, telechargement)</li>
                    <li>Repondre a vos demandes de support</li>
                    <li>Ameliorer nos services (statistiques anonymisees)</li>
                </ul>
            </div>

            <div class="card-techno rounded-2xl p-8">
                <h2 class="text-2xl font-display font-bold text-white mb-4">3. Base Legale</h2>
                <p class="text-gray-400">
                    Le traitement de vos donnees repose sur :
                </p>
                <ul class="list-disc list-inside text-gray-400 mt-4 space-y-2">
                    <li><strong class="text-white">L'execution du contrat</strong> : pour traiter vos commandes</li>
                    <li><strong class="text-white">L'interet legitime</strong> : pour la securite et la prevention de la fraude</li>
                    <li><strong class="text-white">Le consentement</strong> : pour les communications marketing (optionnel)</li>
                </ul>
            </div>

            <div class="card-techno rounded-2xl p-8">
                <h2 class="text-2xl font-display font-bold text-white mb-4">4. Duree de Conservation</h2>
                <p class="text-gray-400">
                    Vos donnees sont conservees :
                </p>
                <ul class="list-disc list-inside text-gray-400 mt-4 space-y-2">
                    <li>Donnees de compte : tant que le compte est actif, puis 3 ans apres la derniere activite</li>
                    <li>Donnees de commande : 10 ans (obligations comptables)</li>
                    <li>Donnees de telechargement : 1 an</li>
                </ul>
            </div>

            <div class="card-techno rounded-2xl p-8">
                <h2 class="text-2xl font-display font-bold text-white mb-4">5. Partage des Donnees</h2>
                <p class="text-gray-400">
                    Vos donnees peuvent etre partagees avec :
                </p>
                <ul class="list-disc list-inside text-gray-400 mt-4 space-y-2">
                    <li><strong class="text-white">Stripe / PayPal</strong> : pour le traitement des paiements</li>
                    <li><strong class="text-white">OVH</strong> : hebergement des donnees (serveurs en France)</li>
                    <li><strong class="text-white">Service email</strong> : pour l'envoi des emails transactionnels</li>
                </ul>
                <p class="text-gray-400 mt-4">
                    Nous ne vendons jamais vos donnees a des tiers.
                </p>
            </div>

            <div class="card-techno rounded-2xl p-8">
                <h2 class="text-2xl font-display font-bold text-white mb-4">6. Vos Droits</h2>
                <p class="text-gray-400 mb-4">
                    Conformement au RGPD, vous disposez des droits suivants :
                </p>
                <ul class="list-disc list-inside text-gray-400 space-y-2">
                    <li><strong class="text-white">Droit d'acces</strong> : obtenir une copie de vos donnees</li>
                    <li><strong class="text-white">Droit de rectification</strong> : corriger vos donnees</li>
                    <li><strong class="text-white">Droit a l'effacement</strong> : supprimer vos donnees</li>
                    <li><strong class="text-white">Droit a la portabilite</strong> : recevoir vos donnees dans un format standard</li>
                    <li><strong class="text-white">Droit d'opposition</strong> : vous opposer a certains traitements</li>
                </ul>
                <p class="text-gray-400 mt-4">
                    Pour exercer ces droits : <a href="mailto:privacy@spotweldingpro.com" class="text-cyber hover:underline">privacy@spotweldingpro.com</a>
                </p>
            </div>

            <div class="card-techno rounded-2xl p-8">
                <h2 class="text-2xl font-display font-bold text-white mb-4">7. Securite</h2>
                <p class="text-gray-400">
                    Nous mettons en oeuvre des mesures techniques et organisationnelles appropriees pour proteger vos donnees :
                </p>
                <ul class="list-disc list-inside text-gray-400 mt-4 space-y-2">
                    <li>Connexion HTTPS securisee</li>
                    <li>Chiffrement des mots de passe</li>
                    <li>Acces restreint aux donnees</li>
                    <li>Sauvegardes regulieres</li>
                </ul>
            </div>

            <div class="card-techno rounded-2xl p-8">
                <h2 class="text-2xl font-display font-bold text-white mb-4">8. Cookies</h2>
                <p class="text-gray-400">
                    Notre site utilise uniquement des cookies essentiels :
                </p>
                <ul class="list-disc list-inside text-gray-400 mt-4 space-y-2">
                    <li><strong class="text-white">Session</strong> : maintenir votre connexion</li>
                    <li><strong class="text-white">Panier</strong> : sauvegarder votre panier d'achat</li>
                    <li><strong class="text-white">CSRF</strong> : securite des formulaires</li>
                </ul>
                <p class="text-gray-400 mt-4">
                    Nous n'utilisons pas de cookies publicitaires ou de tracking.
                </p>
            </div>

            <div class="card-techno rounded-2xl p-8">
                <h2 class="text-2xl font-display font-bold text-white mb-4">9. Contact</h2>
                <p class="text-gray-400">
                    Pour toute question concernant cette politique ou vos donnees personnelles :<br><br>
                    <strong class="text-white">Delegue a la Protection des Donnees</strong><br>
                    Email : <a href="mailto:privacy@spotweldingpro.com" class="text-cyber hover:underline">privacy@spotweldingpro.com</a>
                </p>
                <p class="text-gray-400 mt-4">
                    Vous pouvez egalement introduire une reclamation aupres de la CNIL : <a href="https://www.cnil.fr" class="text-cyber hover:underline" target="_blank" rel="noopener">www.cnil.fr</a>
                </p>
            </div>
        </div>

        <p class="text-gray-500 text-sm mt-12 text-center">
            Derniere mise a jour : Janvier 2025
        </p>
    </div>
</div>
@endsection
