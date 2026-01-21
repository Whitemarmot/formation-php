# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Projet

Plateforme e-commerce Laravel 11 pour la vente de formations PDF en soudure avec watermarking personnalisé et gestion de licences. Les PDFs sont générés via LaTeX et watermarkés à la volée lors du téléchargement.

## Commandes Principales (Makefile)

```bash
# Développement
make install              # Setup complet (Docker, migrations, seeds)
make start / stop         # Démarrer/arrêter les conteneurs
make dev                  # Démarrer avec phpMyAdmin (port 8080)

# Base de données
make migrate              # Lancer les migrations
make migrate-fresh        # Reset DB + seeds
make seed                 # Exécuter les seeders

# Tests & Qualité
make test                 # PHPUnit
make test-coverage        # Rapport de couverture
make lint                 # Vérification code style (Pint)
make lint-fix             # Correction automatique

# Frontend
make npm-dev              # Build dev (Vite)
make npm-build            # Build production

# PDF
make pdf-compile          # Compiler tous les PDFs LaTeX
make pdf-single file="..." # Compiler un seul PDF

# Utilitaires
make cache-clear          # Vider tous les caches
make queue                # Lancer le worker de queue
make composer cmd="..."   # Commandes Composer
```

## Architecture

```
formation-php/
├── src/                          # Application Laravel
│   ├── app/
│   │   ├── Http/Controllers/
│   │   │   ├── Admin/            # CRUD formations, commandes, clients
│   │   │   ├── CartController    # Panier (session-based)
│   │   │   ├── CheckoutController # Paiement Stripe/PayPal
│   │   │   └── DownloadController # Téléchargements signés + watermark
│   │   ├── Models/
│   │   │   ├── Formation.php     # Produits (soft deletes)
│   │   │   ├── Order.php         # Commandes (numéro auto ORD-YYYYMMDD-XXXX)
│   │   │   ├── Download.php      # Tracking téléchargements (expiry + limits)
│   │   │   └── Cart.php          # Helper panier session (pas Eloquent)
│   │   └── Services/
│   │       └── PdfWatermarkService.php  # Watermarking multi-méthodes
│   └── routes/web.php            # Routes principales
│
├── formations-latex/             # Sources LaTeX des formations
│   ├── commun/                   # Préambule partagé
│   └── niveau-{1,2,3}/           # Cours par niveau
│
├── docker/
│   ├── php/                      # PHP 8.3-fpm + pdftk + ghostscript
│   ├── latex/                    # Conteneur LaTeX (texlive)
│   │   └── compile.sh            # Script compilation + watermark
│   └── nginx/                    # Reverse proxy
│
└── docker-compose.yml            # 10 services orchestrés
```

## Stack Technique

- **Backend**: Laravel 11, PHP 8.3
- **Base de données**: MySQL 8.0
- **Cache/Sessions/Queue**: Redis
- **Paiement**: Stripe + PayPal
- **Auth**: Laravel Breeze + Spatie Permission (rôle `admin`)
- **PDF**: LaTeX (LuaLaTeX) → pdftk/Ghostscript pour watermark
- **Tests**: PHPUnit, Laravel Pint

## Logique Métier Clé

### Produits
- 3 niveaux de formation : Débutant (49€), Intermédiaire (99€), Expert (199€)
- Bundle : 20% de réduction si les 3 formations sont dans le panier (279€)

### Panier
Le panier est géré en session via `Cart.php` (méthodes statiques). La réduction bundle est calculée automatiquement.

### Watermarking PDF
`PdfWatermarkService` utilise une cascade de méthodes :
1. Conteneur Docker LaTeX (préféré)
2. pdftk (fallback)
3. Ghostscript (alternatif)
4. Copie sans watermark (dernier recours)

Le watermark inclut : nom client, email, numéro de commande, date.

### Téléchargements
- URLs signées avec expiration (60 min par défaut)
- Limite : 10 téléchargements par commande, validité 7 jours
- Tracking IP/User-Agent

## Conventions

- **Routes** : URLs en français snake_case (`/panier`, `/formations`, `/compte`)
- **Interface** : Entièrement en français
- **Tables DB** : Noms au singulier (`formation`, `order`)
- **Admin** : Préfixe `/admin`, nécessite rôle `admin`

## Services Docker

| Service | Port | Description |
|---------|------|-------------|
| nginx | 80 | Reverse proxy |
| php | - | Laravel app |
| mysql | 3306 | Base de données |
| redis | 6379 | Cache/Sessions |
| mailpit | 8025 | Test emails |
| phpmyadmin | 8080 | Admin DB (profil dev) |

## Fichiers Importants

- `src/routes/web.php` - Toutes les routes
- `src/app/Services/PdfWatermarkService.php` - Logique watermark
- `src/app/Models/Cart.php` - Calculs panier et bundle
- `src/app/Http/Controllers/CheckoutController.php` - Intégration paiement
- `docker/latex/compile.sh` - Compilation PDF
- `PLAN_PROJET.md` - Spécifications détaillées du projet
