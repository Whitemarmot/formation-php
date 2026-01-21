# Plan de Projet - Site de Formations PDF Soudeuses à Points

## Vision Globale

**Projet** : Plateforme e-commerce de formations PDF premium sur le soudage par points
**Formateur** : Kangy Ham - Expert batteries & procédés de soudage industriel
**Cible** : Professionnels, industriels, makers avancés, ingénieurs
**Stack** : Laravel 11 + MySQL + Docker + LaTeX pour PDFs

---

## 1. Architecture du Site

### 1.1 Arborescence des Pages

```
📁 PAGES PUBLIQUES
├── / (Landing page)
├── /formations (Catalogue)
│   ├── /formations/debutant
│   ├── /formations/intermediaire
│   └── /formations/expert
├── /formateur (Bio Kangy Ham)
├── /contact
├── /mentions-legales
├── /cgv
└── /politique-confidentialite

📁 PAGES AUTHENTIFIÉES (Client)
├── /compte
│   ├── /compte/commandes
│   ├── /compte/telechargements
│   └── /compte/profil
├── /panier
└── /checkout
    ├── /checkout/paiement
    └── /checkout/confirmation

📁 BACK-OFFICE ADMIN
├── /admin
│   ├── /admin/dashboard
│   ├── /admin/formations (CRUD)
│   ├── /admin/commandes
│   ├── /admin/clients
│   ├── /admin/statistiques
│   └── /admin/parametres
```

### 1.2 Parcours Utilisateur

```
VISITEUR → PROSPECT → ACHETEUR → CLIENT

1. Découverte
   Landing page → Lecture storytelling → Consultation catalogue

2. Considération
   Fiche formation → Lecture détails → Ajout panier

3. Conversion
   Panier → Checkout (guest ou compte) → Paiement Stripe/PayPal

4. Livraison
   Email confirmation → Lien téléchargement (PDF watermarké)

5. Fidélisation
   Email récap → Espace client → Upsell formations supérieures
```

---

## 2. Landing Page - Copywriting Complet

### 2.1 Hero Section

**Headline Principal :**
> Maîtrisez le Soudage par Points comme un Ingénieur Industriel

**Subheadline :**
> Formations techniques 100% PDF par Kangy Ham — 15 ans d'expertise en soudage de batteries lithium pour l'industrie automobile et aéronautique

**CTA Principal :**
> [Accéder aux Formations] → /formations

---

### 2.2 Proposition de Valeur

```
┌─────────────────────────────────────────────────────────────────┐
│  POURQUOI CES FORMATIONS SONT DIFFÉRENTES                       │
├─────────────────────────────────────────────────────────────────┤
│                                                                 │
│  ✗ Pas de tutoriels YouTube approximatifs                       │
│  ✗ Pas de conseils génériques copiés-collés                     │
│  ✗ Pas de théorie sans applications concrètes                   │
│                                                                 │
│  ✓ Protocoles industriels réels utilisés en production          │
│  ✓ Paramètres exacts (courant, temps, force) documentés         │
│  ✓ Retours d'expérience sur milliers de soudures analysées      │
│  ✓ Erreurs coûteuses et comment les éviter                      │
│                                                                 │
└─────────────────────────────────────────────────────────────────┘
```

---

### 2.3 Storytelling - Kangy Ham

```
╔═══════════════════════════════════════════════════════════════════╗
║                     QUI EST KANGY HAM ?                          ║
╠═══════════════════════════════════════════════════════════════════╣
║                                                                   ║
║  "J'ai passé 15 ans à souder des batteries pour des              ║
║   constructeurs automobiles que vous connaissez tous.             ║
║   Aujourd'hui, je transmets ce savoir."                           ║
║                                                                   ║
║  • Ingénieur procédés - Spécialiste assemblage batteries          ║
║  • Ex-industrie automobile (R&D batteries haute performance)      ║
║  • +50,000 soudures analysées et documentées                      ║
║  • Consultant indépendant depuis 2020                             ║
║                                                                   ║
║  Après avoir négocié mon départ avec un parachute confortable,    ║
║  j'ai décidé de partager mon expertise sans contrainte            ║
║  commerciale. Ces formations contiennent ce que j'aurais          ║
║  aimé trouver quand j'ai commencé.                                ║
║                                                                   ║
╚═══════════════════════════════════════════════════════════════════╝
```

---

### 2.4 Preuves d'Expertise

| Indicateur | Valeur |
|------------|--------|
| Années d'expérience | 15+ ans |
| Soudures analysées | +50,000 |
| Projets industriels | 12 programmes véhicules |
| Cellules travaillées | 18650, 21700, prismatiques, pouch |
| Matériaux maîtrisés | Nickel, Cuivre, Acier, Aluminium |

**Logos clients** (si autorisé) : Constructeurs auto / Tier 1 suppliers

---

### 2.5 Objections & Réponses

| Objection | Réponse |
|-----------|---------|
| "Je trouve tout gratuit sur YouTube" | Les vidéos montrent le comment, pas le pourquoi. Sans comprendre la physique du procédé, vous reproduirez les mêmes erreurs. |
| "C'est trop cher" | Une soudure défaillante sur un pack batterie peut coûter des milliers d'euros en SAV. Ces formations rentabilisent leur prix dès la première erreur évitée. |
| "PDF, c'est dépassé" | Format choisi volontairement : imprimable, annoter, accessible hors-ligne. Pas de streaming à bufferer. Votre documentation, pour toujours. |
| "Je suis débutant, c'est pour moi ?" | La formation Niveau 1 part des fondamentaux. Aucun prérequis en soudage. Seule la motivation compte. |

---

### 2.6 Section CTA Final

```
┌─────────────────────────────────────────────────────────────────┐
│                                                                 │
│     PRÊT À SOUDER COMME UN PRO ?                                │
│                                                                 │
│     Choisissez votre niveau et commencez aujourd'hui.           │
│                                                                 │
│     [Formation Débutant - 49€]                                  │
│     [Formation Intermédiaire - 99€]                             │
│     [Formation Expert - 199€]                                   │
│     [Pack Complet - 279€] ← Économisez 68€                      │
│                                                                 │
│     ✓ Téléchargement immédiat                                   │
│     ✓ PDF watermarké à votre nom                                │
│     ✓ Accès à vie                                               │
│     ✓ Mises à jour gratuites                                    │
│                                                                 │
└─────────────────────────────────────────────────────────────────┘
```

---

## 3. Offre Commerciale

### 3.1 Catalogue des Formations

| Formation | Prix | Pages | Public cible |
|-----------|------|-------|--------------|
| Niveau 1 - Fondamentaux | 49€ | ~80 | Débutants, makers |
| Niveau 2 - Maîtrise | 99€ | ~120 | Techniciens, semi-pro |
| Niveau 3 - Excellence | 199€ | ~150 | Ingénieurs, industriels |
| **Bundle Complet** | **279€** | ~350 | Tous niveaux |

---

### 3.2 Contenu Détaillé - Formation Niveau 1 "Fondamentaux"

**Titre** : Soudeuse à Points - Les Fondamentaux
**Sous-titre** : Comprendre, choisir et réussir ses premières soudures

#### Table des Matières

```
INTRODUCTION
├── Qu'est-ce que le soudage par points ?
├── Historique et applications industrielles
└── Pourquoi cette technique pour les batteries ?

MODULE 1 : PHYSIQUE DU SOUDAGE PAR RÉSISTANCE
├── 1.1 Principe de la soudure par résistance
│   ├── Loi de Joule : Q = R × I² × t
│   ├── Zones de fusion et zone affectée thermiquement (ZAT)
│   └── Diagramme temps-température d'une soudure
├── 1.2 Les 4 paramètres fondamentaux
│   ├── Courant (I) - Pourquoi les kA sont nécessaires
│   ├── Temps (t) - Millisecondes critiques
│   ├── Force (F) - L'importance de la pression
│   └── Résistance de contact - Le paramètre oublié
└── 1.3 Métallurgie simplifiée
    ├── Comportement du nickel pur
    ├── Comportement du cuivre
    └── Comportement de l'acier nickelé

MODULE 2 : ÉQUIPEMENTS ET COMPOSANTS
├── 2.1 Anatomie d'une soudeuse à points
│   ├── Source d'énergie (transformateur vs condensateurs)
│   ├── Circuit de commande
│   ├── Système mécanique (presse, poignée)
│   └── Électrodes
├── 2.2 Comparatif des technologies
│   ├── Soudeuses à transformateur (AC)
│   ├── Soudeuses à condensateurs (DC pulse)
│   └── Soudeuses inverter MFDC
├── 2.3 Soudeuses DIY vs industrielles
│   ├── Budget <500€ : options et limites
│   ├── Budget 500-2000€ : le semi-pro
│   └── Budget >2000€ : qualité industrielle
└── 2.4 Tableau comparatif détaillé

MODULE 3 : CHOIX DES ÉLECTRODES
├── 3.1 Matériaux d'électrodes
│   ├── Cuivre pur (Cu-ETP)
│   ├── Alliages CuCr, CuCrZr
│   ├── Tungstène et composites
│   └── Quand utiliser quoi ?
├── 3.2 Géométrie des électrodes
│   ├── Plates vs bombées
│   ├── Diamètre et surface de contact
│   └── Impact sur la densité de courant
└── 3.3 Entretien et durée de vie
    ├── Usure normale vs anormale
    ├── Fréquence de rafraîchissement
    └── Stockage et protection

MODULE 4 : PREMIERS PAS PRATIQUES
├── 4.1 Installation et sécurité
│   ├── Alimentation électrique requise
│   ├── Environnement de travail
│   ├── EPI obligatoires
│   └── Risques spécifiques batteries lithium
├── 4.2 Votre première soudure
│   ├── Préparation des pièces
│   ├── Positionnement des électrodes
│   ├── Paramètres de départ recommandés
│   └── Analyse visuelle du résultat
├── 4.3 Exercices progressifs
│   ├── Exercice 1 : Strip nickel sur nickel
│   ├── Exercice 2 : Strip nickel sur acier
│   └── Exercice 3 : Strip sur cellule 18650
└── 4.4 Journal de soudure (template fourni)

MODULE 5 : DIAGNOSTIC DES DÉFAUTS
├── 5.1 Les 10 défauts les plus courants
│   ├── Pas de soudure (cold weld)
│   ├── Projection de métal
│   ├── Perçage
│   ├── Collage d'électrode
│   ├── Soudure asymétrique
│   ├── Auréole de brûlure excessive
│   ├── Fissuration
│   ├── Déformation des pièces
│   ├── Résistance mécanique insuffisante
│   └── Résistance électrique trop élevée
├── 5.2 Arbre de diagnostic
│   └── Flowchart : Problème → Causes → Solutions
└── 5.3 Tableau paramètres vs défauts

ANNEXES
├── A. Glossaire technique (FR/EN)
├── B. Tableau de conversion des unités
├── C. Fournisseurs recommandés
├── D. Bibliographie et normes
└── E. Template journal de soudure
```

---

### 3.3 Contenu Détaillé - Formation Niveau 2 "Maîtrise"

**Titre** : Soudeuse à Points - Maîtrise Avancée
**Sous-titre** : Optimisation, batteries lithium et production en série

#### Table des Matières

```
INTRODUCTION
├── Prérequis (rappel Niveau 1)
├── Objectifs de cette formation
└── Comment utiliser ce document

MODULE 6 : OPTIMISATION DES PARAMÈTRES
├── 6.1 Fenêtre de soudabilité
│   ├── Concept de lobe de soudure
│   ├── Construction d'un diagramme I/t
│   ├── Limites d'expulsion et de collage
│   └── Zone optimale par matériau
├── 6.2 Méthode DOE (Design of Experiments)
│   ├── Plan d'expérience simplifié
│   ├── Facteurs à tester
│   ├── Analyse des résultats
│   └── Exemple complet pas-à-pas
├── 6.3 Influence des conditions ambiantes
│   ├── Température pièces
│   ├── Humidité et oxydation
│   └── Propreté des surfaces
└── 6.4 Tableaux de paramètres optimisés
    ├── Nickel 0.1mm sur 18650
    ├── Nickel 0.15mm sur 18650
    ├── Nickel 0.2mm sur 21700
    └── Cuivre nickelé sur pouch

MODULE 7 : SOUDAGE DE BATTERIES LITHIUM
├── 7.1 Spécificités des cellules
│   ├── Anatomie d'une 18650/21700
│   ├── Pôle positif vs négatif
│   ├── Sensibilité thermique
│   └── Risques d'emballement
├── 7.2 Configurations de packs
│   ├── Série vs parallèle
│   ├── Strips vs busbars
│   ├── Connexions par soudure vs mécaniques
│   └── Calcul des sections conductrices
├── 7.3 Protocoles de soudure batterie
│   ├── Séquence de soudure optimale
│   ├── Dissipation thermique
│   ├── Temps de refroidissement inter-points
│   └── Contrôle visuel et électrique
├── 7.4 Études de cas
│   ├── Pack ebike 36V 10Ah
│   ├── Pack powerwall 48V 100Ah
│   └── Pack outil portatif 20V
└── 7.5 Erreurs à ne jamais commettre
    └── Les 5 erreurs qui tuent les cellules

MODULE 8 : MATÉRIAUX AVANCÉS
├── 8.1 Le cuivre - défis et solutions
│   ├── Conductivité thermique élevée
│   ├── Paramètres adaptés
│   ├── Électrodes spéciales
│   └── Alternatives (brasure, clinchage)
├── 8.2 L'aluminium - mission impossible ?
│   ├── Pourquoi c'est difficile
│   ├── Solutions industrielles
│   └── Recommandation réaliste
├── 8.3 Assemblages hétérogènes
│   ├── Nickel/Cuivre
│   ├── Nickel/Acier
│   ├── Cuivre/Acier
│   └── Règles d'empilement
└── 8.4 Revêtements et traitements
    ├── Nickelage
    ├── Étamage
    └── Impact sur les paramètres

MODULE 9 : CONTRÔLE QUALITÉ
├── 9.1 Tests destructifs
│   ├── Test de pelage (peel test)
│   ├── Test de cisaillement
│   ├── Coupe métallographique
│   └── Interprétation des résultats
├── 9.2 Tests non destructifs
│   ├── Inspection visuelle normée
│   ├── Mesure de résistance électrique
│   ├── Test ultrasons (principe)
│   └── Thermographie infrarouge
├── 9.3 Critères d'acceptation
│   ├── Normes AWS, ISO
│   ├── Définir ses propres critères
│   └── Documentation qualité
└── 9.4 Plan de contrôle production
    ├── Fréquence d'échantillonnage
    ├── Carte de contrôle SPC
    └── Actions correctives

MODULE 10 : PRODUCTION EN PETITE SÉRIE
├── 10.1 Organiser son poste de travail
│   ├── Ergonomie et flux
│   ├── Stockage des composants
│   └── Gestion des déchets
├── 10.2 Outillages et gabarits
│   ├── Conception de gabarits
│   ├── Positionnement répétable
│   └── Exemples 3D imprimables
├── 10.3 Traçabilité
│   ├── Numérotation des packs
│   ├── Enregistrement des paramètres
│   └── Archivage
└── 10.4 Calcul de rentabilité
    ├── Temps de cycle
    ├── Coût par soudure
    └── Seuil de rentabilité

ANNEXES NIVEAU 2
├── F. Fiches techniques matériaux
├── G. Abaques de paramètres
├── H. Checklist contrôle qualité
├── I. Modèles de documentation
└── J. Sources bibliographiques avancées
```

---

### 3.4 Contenu Détaillé - Formation Niveau 3 "Excellence"

**Titre** : Soudeuse à Points - Excellence Industrielle
**Sous-titre** : Ingénierie avancée, automatisation et certification

#### Table des Matières

```
INTRODUCTION
├── Public cible de ce niveau
├── Prérequis (Niveaux 1 & 2)
└── Structure du document

MODULE 11 : DIMENSIONNEMENT ÉLECTRIQUE
├── 11.1 Calcul de puissance requise
│   ├── Bilan thermique d'une soudure
│   ├── Énergie par point (Joules)
│   ├── Puissance instantanée vs moyenne
│   └── Exemples de calcul
├── 11.2 Conception du circuit primaire
│   ├── Alimentation monophasée vs triphasée
│   ├── Dimensionnement des câbles
│   ├── Protection électrique
│   └── Compensation du facteur de puissance
├── 11.3 Transformateurs de soudage
│   ├── Principe de fonctionnement
│   ├── Rapport de transformation
│   ├── Caractéristiques à spécifier
│   └── Fournisseurs industriels
├── 11.4 Systèmes à condensateurs
│   ├── Dimensionnement du banc
│   ├── Charge et décharge
│   ├── Durée de vie et maintenance
│   └── Calcul du temps de recharge
└── 11.5 Technologie MFDC
    ├── Avantages du moyenne fréquence
    ├── Architecture typique
    ├── Critères de choix
    └── Retour sur investissement

MODULE 12 : AUTOMATISATION
├── 12.1 Niveaux d'automatisation
│   ├── Manuel assisté
│   ├── Semi-automatique
│   ├── Automatique
│   └── Robotisé
├── 12.2 Systèmes de positionnement
│   ├── Axes linéaires
│   ├── Tables rotatives
│   ├── Robots 6 axes
│   └── Cobots
├── 12.3 Commande et supervision
│   ├── Automates programmables (PLC)
│   ├── Interface homme-machine (IHM)
│   ├── Communication industrielle
│   └── Acquisition de données
├── 12.4 Exemple de cellule automatisée
│   ├── Cahier des charges
│   ├── Architecture proposée
│   ├── Estimation budgétaire
│   └── Planning d'intégration
└── 12.5 Maintenance préventive
    ├── Plan de maintenance type
    ├── Indicateurs de performance (OEE)
    └── Gestion des pièces de rechange

MODULE 13 : SIMULATION ET MODÉLISATION
├── 13.1 Modèles analytiques
│   ├── Équations de base
│   ├── Limitations
│   └── Cas d'usage
├── 13.2 Simulation par éléments finis
│   ├── Principe de la FEA
│   ├── Logiciels spécialisés
│   ├── Couplage électro-thermique
│   └── Interprétation des résultats
├── 13.3 Jumeaux numériques
│   ├── Concept et bénéfices
│   ├── Implémentation simplifiée
│   └── Retour d'expérience industriel
└── 13.4 Intelligence artificielle
    ├── Monitoring prédictif
    ├── Optimisation des paramètres
    └── Détection de défauts

MODULE 14 : NORMES ET CERTIFICATION
├── 14.1 Panorama normatif
│   ├── ISO 14373 (soudage par résistance)
│   ├── ISO 18278 (soudabilité)
│   ├── AWS C1.1 (recommandations)
│   ├── Normes automobiles (VDA, AIAG)
│   └── Normes batteries (UN 38.3, IEC 62619)
├── 14.2 Qualification du procédé
│   ├── PPAP / PQAP
│   ├── Validation initiale
│   ├── Revalidation périodique
│   └── Gestion des modifications
├── 14.3 Qualification du personnel
│   ├── Niveaux de compétence
│   ├── Formation et habilitation
│   └── Maintien des compétences
├── 14.4 Documentation qualité
│   ├── Dossier de validation
│   ├── Instruction de travail
│   ├── Fiche de contrôle
│   └── Rapport de non-conformité
└── 14.5 Audit et amélioration continue
    ├── Préparation d'audit
    ├── QRQC / 8D
    └── Kaizen soudage

MODULE 15 : TROUBLESHOOTING EXPERT
├── 15.1 Diagnostic avancé
│   ├── Mesure de résistance dynamique
│   ├── Analyse de la courbe de soudage
│   ├── Corrélation multi-paramètres
│   └── Outils de diagnostic
├── 15.2 Cas complexes résolus
│   ├── Cas 1 : Dérive progressive
│   ├── Cas 2 : Défauts intermittents
│   ├── Cas 3 : Non-reproductibilité
│   ├── Cas 4 : Soudure froide persistante
│   └── Cas 5 : Expulsion systématique
├── 15.3 Optimisation de l'existant
│   ├── Audit d'installation
│   ├── Benchmarking
│   └── Plan d'amélioration
└── 15.4 Veille technologique
    ├── Sources à suivre
    ├── Conférences et salons
    └── Réseau professionnel

ANNEXES NIVEAU 3
├── K. Extraits de normes
├── L. Templates documentation qualité
├── M. Spécifications type équipement
├── N. Glossaire technique complet
└── O. Index
```

---

## 4. Paywall & Monétisation

### 4.1 Structure de Paiement

| Type | Description |
|------|-------------|
| Paiement unique | Chaque formation achetable séparément |
| Bundle | Pack 3 formations avec réduction 20% |
| Guest checkout | Achat sans création de compte (email requis) |

### 4.2 Logique d'Accès Post-Paiement

```
PAIEMENT VALIDÉ
      │
      ├─→ Email confirmation envoyé immédiatement
      │   └── Contient : Récapitulatif + Lien téléchargement
      │
      ├─→ PDF watermarké généré dynamiquement
      │   └── Watermark : "Licence accordée à [email] - [date]"
      │
      ├─→ Lien téléchargement valide 7 jours
      │   └── Re-téléchargeable depuis espace client
      │
      └─→ Si compte créé :
          └── Accès permanent via /compte/telechargements
```

### 4.3 Stratégies d'Upsell/Cross-sell

| Moment | Action |
|--------|--------|
| Panier (Niveau 1) | "Passez au Bundle et économisez 68€" |
| Post-achat (Niveau 1) | Email J+7 : "Prêt pour le niveau suivant ?" |
| Post-achat (Niveau 2) | Email J+14 : "Devenez expert certifiable" |
| Anniversaire achat | Code promo -15% sur formation supérieure |

---

## 5. Spécifications Techniques

### 5.1 Stack Technologique

```
┌─────────────────────────────────────────────────────────────────┐
│                    ARCHITECTURE TECHNIQUE                        │
├─────────────────────────────────────────────────────────────────┤
│                                                                  │
│  ┌─────────────┐   ┌─────────────┐   ┌─────────────┐            │
│  │   NGINX     │   │   PHP 8.3   │   │   MySQL     │            │
│  │   Reverse   │──▶│   Laravel   │──▶│   8.0       │            │
│  │   Proxy     │   │   11.x      │   │             │            │
│  └─────────────┘   └─────────────┘   └─────────────┘            │
│                           │                                      │
│                           ▼                                      │
│                    ┌─────────────┐                               │
│                    │  TeX Live   │                               │
│                    │  (LaTeX)    │                               │
│                    └─────────────┘                               │
│                           │                                      │
│                           ▼                                      │
│                    ┌─────────────┐                               │
│                    │   PDFs      │                               │
│                    │ Watermarkés │                               │
│                    └─────────────┘                               │
│                                                                  │
│  Services externes :                                             │
│  • Stripe (paiements CB)                                         │
│  • PayPal (paiements alternatifs)                               │
│  • SMTP (emails transactionnels)                                │
│                                                                  │
└─────────────────────────────────────────────────────────────────┘
```

### 5.2 Containers Docker

| Container | Image | Port | Rôle |
|-----------|-------|------|------|
| nginx | nginx:alpine | 80, 443 | Reverse proxy, SSL |
| php | php:8.3-fpm | 9000 | Application Laravel |
| mysql | mysql:8.0 | 3306 | Base de données |
| redis | redis:alpine | 6379 | Cache, sessions, queues |
| latex | texlive/texlive | - | Génération PDFs |
| mailpit | mailpit/mailpit | 8025 | Dev : test emails |

### 5.3 Gestion des Paiements

**Stripe** (principal)
- Checkout Session hébergé
- Webhooks pour confirmation
- Facturation automatique

**PayPal** (alternatif)
- PayPal Checkout SDK
- Même logique webhook

### 5.4 Protection des PDFs

```
GÉNÉRATION PDF AVEC WATERMARK
─────────────────────────────

1. Compilation LaTeX → PDF de base (sans watermark)
   └── Stocké dans /storage/app/formations/

2. À chaque téléchargement :
   └── pdftk ajoute watermark overlay avec :
       • Nom du client
       • Email
       • Numéro de commande
       • Date d'achat

3. Lien signé avec expiration
   └── URL::signedRoute('download', ['order' => $id], now()->addDays(7))
```

---

## 6. Ton & Branding

### 6.1 Identité Visuelle

```
PALETTE DE COULEURS
───────────────────
Principal    : #1a1a2e (Bleu nuit profond)
Secondaire   : #16213e (Bleu acier)
Accent       : #e94560 (Rouge industriel)
Accent 2     : #f39c12 (Orange étincelle)
Texte        : #eaeaea (Gris clair)
Fond         : #0f0f1a (Noir profond)

TYPOGRAPHIE
───────────
Titres    : Rajdhani (Google Fonts) - Technique, angulaire
Corps     : Inter (Google Fonts) - Lisible, moderne
Code/Data : JetBrains Mono - Monospace technique

ÉLÉMENTS GRAPHIQUES
───────────────────
• Lignes techniques fines
• Grille en arrière-plan subtile
• Icônes filaires industrielles
• Photos réelles de soudures (macro)
• Schémas techniques vectoriels
```

### 6.2 Vocabulaire de Marque

| Utiliser | Éviter |
|----------|--------|
| Procédé | Technique magique |
| Paramètres | Astuces |
| Protocole | Hack |
| Données mesurées | À peu près |
| Formation | Cours en ligne |
| Industriel | Amateur |
| Ingénieur | Bricoleur |

### 6.3 Angle Différenciant

```
╔═══════════════════════════════════════════════════════════════════╗
║           CE QUE NOUS NE SOMMES PAS                               ║
╠═══════════════════════════════════════════════════════════════════╣
║                                                                   ║
║  ✗ Un influenceur qui soude dans son garage                      ║
║  ✗ Un vendeur de rêves avec "résultats garantis"                 ║
║  ✗ Une formation express "maîtrisez en 2h"                       ║
║  ✗ Du contenu sponsorisé par un fabricant                        ║
║                                                                   ║
╠═══════════════════════════════════════════════════════════════════╣
║           CE QUE NOUS SOMMES                                      ║
╠═══════════════════════════════════════════════════════════════════╣
║                                                                   ║
║  ✓ Un transfert de savoir industriel documenté                   ║
║  ✓ Des données mesurées sur des milliers de points               ║
║  ✓ Une méthodologie applicable en production                     ║
║  ✓ L'expérience sans le jargon corporate                         ║
║                                                                   ║
╚═══════════════════════════════════════════════════════════════════╝
```

---

## 7. Livrables Techniques à Développer

### 7.1 Structure du Projet Laravel

```
formation-php/
├── docker/
│   ├── nginx/
│   │   └── default.conf
│   ├── php/
│   │   └── Dockerfile
│   └── latex/
│       └── Dockerfile
├── docker-compose.yml
├── src/                          # Application Laravel
│   ├── app/
│   │   ├── Models/
│   │   │   ├── User.php
│   │   │   ├── Formation.php
│   │   │   ├── Order.php
│   │   │   └── Download.php
│   │   ├── Http/Controllers/
│   │   │   ├── HomeController.php
│   │   │   ├── FormationController.php
│   │   │   ├── CartController.php
│   │   │   ├── CheckoutController.php
│   │   │   ├── DownloadController.php
│   │   │   └── Admin/
│   │   │       ├── DashboardController.php
│   │   │       ├── FormationController.php
│   │   │       ├── OrderController.php
│   │   │       └── CustomerController.php
│   │   └── Services/
│   │       ├── PdfWatermarkService.php
│   │       ├── StripeService.php
│   │       └── PayPalService.php
│   ├── resources/
│   │   └── views/
│   │       ├── layouts/
│   │       ├── pages/
│   │       ├── formations/
│   │       ├── checkout/
│   │       └── admin/
│   └── ...
├── formations-latex/              # Sources LaTeX des PDFs
│   ├── commun/
│   │   ├── preambule.tex
│   │   ├── styles.sty
│   │   └── images/
│   ├── niveau-1/
│   │   └── formation-niveau-1.tex
│   ├── niveau-2/
│   │   └── formation-niveau-2.tex
│   └── niveau-3/
│       └── formation-niveau-3.tex
└── README.md
```

---

## 8. Planning de Développement

### Phase 1 : Infrastructure (2-3 jours)
- [ ] Configuration Docker complète
- [ ] Installation Laravel 11
- [ ] Configuration base de données
- [ ] Setup environnement de développement

### Phase 2 : Backend Core (3-4 jours)
- [ ] Modèles et migrations
- [ ] Authentification (Breeze/Fortify)
- [ ] CRUD Formations (admin)
- [ ] Système de panier

### Phase 3 : Paiements (2-3 jours)
- [ ] Intégration Stripe Checkout
- [ ] Intégration PayPal
- [ ] Webhooks et confirmation
- [ ] Génération factures

### Phase 4 : PDFs (2-3 jours)
- [ ] Templates LaTeX des 3 formations
- [ ] Service de watermark
- [ ] Système de téléchargement sécurisé
- [ ] Liens signés avec expiration

### Phase 5 : Frontend (3-4 jours)
- [ ] Landing page
- [ ] Pages formations
- [ ] Processus de checkout
- [ ] Espace client
- [ ] Design industriel/tech

### Phase 6 : Admin (2-3 jours)
- [ ] Dashboard statistiques
- [ ] Gestion commandes
- [ ] Gestion clients
- [ ] Export données

### Phase 7 : Finitions (1-2 jours)
- [ ] Tests fonctionnels
- [ ] Optimisation performances
- [ ] Documentation déploiement

---

## Prochaines Étapes

Je vais maintenant procéder au développement dans l'ordre suivant :

1. **Configuration Docker** - Création de tous les containers
2. **Installation Laravel** - Setup du projet
3. **Développement des fonctionnalités** - Backend puis frontend
4. **Génération des PDFs** - Templates LaTeX complets
5. **Tests et déploiement**

Voulez-vous que je commence ?
