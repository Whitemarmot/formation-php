@extends('layouts.app')

@section('title', 'Conditions Generales de Vente - Spot Welding Pro')

@section('content')
<div class="py-16 md:py-24">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-4xl font-display font-black text-white mb-12">
            Conditions Generales de <span class="gradient-text">Vente</span>
        </h1>

        <div class="prose prose-invert prose-lg max-w-none space-y-8">
            <div class="card-techno rounded-2xl p-8">
                <h2 class="text-2xl font-display font-bold text-white mb-4">Article 1 - Objet</h2>
                <p class="text-gray-400">
                    Les presentes conditions generales de vente regissent les ventes de formations PDF
                    proposees par Spot Welding Pro sur le site spotweldingpro.com.
                </p>
            </div>

            <div class="card-techno rounded-2xl p-8">
                <h2 class="text-2xl font-display font-bold text-white mb-4">Article 2 - Produits</h2>
                <p class="text-gray-400">
                    Les produits proposes sont des formations au format PDF, telechargeables apres achat.
                    Chaque formation est personnalisee avec un watermark contenant les informations de l'acheteur
                    (nom, email, numero de commande).
                </p>
                <p class="text-gray-400 mt-4">
                    Les caracteristiques et contenus des formations sont presentes sur les fiches produits.
                    Les images sont non contractuelles.
                </p>
            </div>

            <div class="card-techno rounded-2xl p-8">
                <h2 class="text-2xl font-display font-bold text-white mb-4">Article 3 - Prix</h2>
                <p class="text-gray-400">
                    Les prix sont indiques en euros TTC. La TVA n'est pas applicable (regime de franchise en base de TVA).
                </p>
                <p class="text-gray-400 mt-4">
                    Les prix peuvent etre modifies a tout moment. Le prix applicable est celui affiche au moment de la commande.
                </p>
            </div>

            <div class="card-techno rounded-2xl p-8">
                <h2 class="text-2xl font-display font-bold text-white mb-4">Article 4 - Commande</h2>
                <p class="text-gray-400">
                    La commande est validee apres acceptation des presentes CGV et paiement integral.
                    Un email de confirmation est envoye avec le lien de telechargement.
                </p>
                <p class="text-gray-400 mt-4">
                    Le client dispose de 7 jours et 10 telechargements maximum pour recuperer ses formations.
                    En cas de probleme technique, le support peut regenerer les liens.
                </p>
            </div>

            <div class="card-techno rounded-2xl p-8">
                <h2 class="text-2xl font-display font-bold text-white mb-4">Article 5 - Paiement</h2>
                <p class="text-gray-400">
                    Le paiement s'effectue par carte bancaire (via Stripe) ou PayPal.
                    Les transactions sont securisees et nous ne conservons pas les donnees bancaires.
                </p>
            </div>

            <div class="card-techno rounded-2xl p-8">
                <h2 class="text-2xl font-display font-bold text-white mb-4">Article 6 - Livraison</h2>
                <p class="text-gray-400">
                    La livraison est immediate par telechargement. Des reception du paiement, le client recoit
                    un email avec un lien securise vers ses formations.
                </p>
                <p class="text-gray-400 mt-4">
                    Les formations sont egalement accessibles depuis l'espace client du site.
                </p>
            </div>

            <div class="card-techno rounded-2xl p-8">
                <h2 class="text-2xl font-display font-bold text-white mb-4">Article 7 - Droit de Retractation</h2>
                <p class="text-gray-400">
                    Conformement a l'article L221-28 du Code de la consommation, le droit de retractation
                    ne peut etre exerce pour les contenus numeriques fournis immediatement apres le paiement.
                </p>
                <p class="text-gray-400 mt-4">
                    Toutefois, nous offrons une <strong class="text-white">garantie satisfait ou rembourse de 30 jours</strong>.
                    Si la formation ne correspond pas a vos attentes, contactez-nous pour un remboursement.
                </p>
            </div>

            <div class="card-techno rounded-2xl p-8">
                <h2 class="text-2xl font-display font-bold text-white mb-4">Article 8 - Licence d'Utilisation</h2>
                <p class="text-gray-400">
                    L'achat d'une formation confere une licence d'utilisation personnelle et non-cessible.
                </p>
                <ul class="list-disc list-inside text-gray-400 mt-4 space-y-2">
                    <li>Vous pouvez : consulter, imprimer et utiliser la formation pour votre usage personnel ou professionnel</li>
                    <li>Vous ne pouvez pas : revendre, partager, distribuer ou publier le contenu</li>
                    <li>Le watermark personnalise ne doit pas etre retire ou masque</li>
                </ul>
                <p class="text-gray-400 mt-4">
                    Tout partage non autorise fera l'objet de poursuites.
                </p>
            </div>

            <div class="card-techno rounded-2xl p-8">
                <h2 class="text-2xl font-display font-bold text-white mb-4">Article 9 - Responsabilite</h2>
                <p class="text-gray-400">
                    Les formations sont fournies a titre informatif et educatif. L'application des techniques
                    decrites est sous la responsabilite de l'utilisateur.
                </p>
                <p class="text-gray-400 mt-4">
                    Spot Welding Pro ne peut etre tenu responsable des dommages directs ou indirects
                    resultant de l'utilisation des formations.
                </p>
            </div>

            <div class="card-techno rounded-2xl p-8">
                <h2 class="text-2xl font-display font-bold text-white mb-4">Article 10 - Service Client</h2>
                <p class="text-gray-400">
                    Pour toute question ou reclamation :<br>
                    Email : <a href="mailto:support@spotweldingpro.com" class="text-cyber hover:underline">support@spotweldingpro.com</a><br>
                    Delai de reponse : 24-48h ouvrables
                </p>
            </div>

            <div class="card-techno rounded-2xl p-8">
                <h2 class="text-2xl font-display font-bold text-white mb-4">Article 11 - Droit Applicable</h2>
                <p class="text-gray-400">
                    Les presentes CGV sont soumises au droit francais.
                    En cas de litige, une solution amiable sera recherchee. A defaut, les tribunaux francais seront competents.
                </p>
            </div>
        </div>

        <p class="text-gray-500 text-sm mt-12 text-center">
            Derniere mise a jour : Janvier 2025
        </p>
    </div>
</div>
@endsection
