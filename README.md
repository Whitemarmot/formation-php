# Spot Welding Pro - Plateforme de Formations PDF

Plateforme e-commerce de vente de formations PDF premium sur le soudage par points, développée avec Laravel 11.

## Aperçu

- **Formateur** : Kangy Ham - Expert batteries & procédés de soudage industriel
- **Produit** : Formations 100% PDF téléchargeables
- **Stack** : Laravel 11 + MySQL + Docker + LaTeX

## Fonctionnalités

- Landing page avec design industriel/tech
- Catalogue de formations (3 niveaux : Débutant, Intermédiaire, Expert)
- Panier avec réduction bundle (-20% pour le pack complet)
- Paiement Stripe et PayPal
- PDFs watermarkés avec nom/email du client
- Espace client avec téléchargements
- Back-office admin complet

## Installation

### Prérequis

- Docker & Docker Compose
- Make (optionnel, facilite les commandes)

### Installation rapide

```bash
# Cloner le projet
git clone <repo-url>
cd formation-php

# Copier la configuration
cp .env.example .env

# Installer et démarrer
make install

# Ou sans Make :
docker compose build
docker compose up -d
docker compose exec php composer install
docker compose exec php php artisan key:generate
docker compose exec php php artisan migrate --seed
docker compose exec php php artisan storage:link
```

### Accès

| Service | URL | Identifiants |
|---------|-----|--------------|
| Application | http://localhost | - |
| Mailpit (emails) | http://localhost:8025 | - |
| phpMyAdmin | http://localhost:8080 | formation_user / formation_password |
| Admin | http://localhost/admin | admin@formation-soudure.com / changeme |

## Structure du Projet

```
formation-php/
├── docker/                 # Configuration Docker
│   ├── nginx/             # Config Nginx
│   ├── php/               # Dockerfile PHP + config
│   ├── mysql/             # Scripts SQL init
│   └── latex/             # Dockerfile LaTeX
├── docker-compose.yml     # Orchestration
├── src/                   # Application Laravel
│   ├── app/
│   │   ├── Http/Controllers/
│   │   ├── Models/
│   │   └── Services/
│   ├── resources/views/
│   ├── routes/
│   └── database/
├── formations-latex/      # Sources LaTeX des PDFs
│   ├── commun/           # Préambule partagé
│   ├── niveau-1/
│   ├── niveau-2/
│   └── niveau-3/
├── PLAN_PROJET.md        # Documentation complète
└── Makefile              # Commandes utilitaires
```

## Commandes Utiles

```bash
# Démarrer/arrêter
make start
make stop

# Logs
make logs
make logs-php

# Shell
make shell          # Container PHP
make mysql          # Shell MySQL

# Laravel
make migrate
make migrate-fresh  # Reset + seeds
make cache-clear

# Compilation PDFs
make pdf-compile    # Tous les PDFs
make pdf-single file="niveau-1/formation-niveau-1.tex"

# Tests
make test
make lint
```

## Configuration

### Stripe

```env
STRIPE_KEY=pk_test_xxxxx
STRIPE_SECRET=sk_test_xxxxx
STRIPE_WEBHOOK_SECRET=whsec_xxxxx
```

Configurer le webhook Stripe vers : `https://votredomaine.com/webhook/stripe`

### PayPal

```env
PAYPAL_MODE=sandbox
PAYPAL_SANDBOX_CLIENT_ID=xxxxx
PAYPAL_SANDBOX_CLIENT_SECRET=xxxxx
```

## Formations

| Formation | Prix | Pages | Public |
|-----------|------|-------|--------|
| Niveau 1 - Fondamentaux | 49€ | ~80 | Débutants |
| Niveau 2 - Maîtrise | 99€ | ~120 | Techniciens |
| Niveau 3 - Excellence | 199€ | ~150 | Ingénieurs |
| **Bundle** | **279€** | ~350 | Tous |

## Génération des PDFs

Les PDFs sont générés avec LaTeX (LuaLaTeX) et watermarkés à la volée lors du téléchargement.

```bash
# Compiler un PDF
docker compose exec latex lualatex /workspace/niveau-1/formation-niveau-1.tex

# Avec watermark
docker compose exec latex /usr/local/bin/compile.sh \
    /workspace/niveau-1/formation-niveau-1.tex \
    "client@email.com" \
    "Nom Client" \
    "ORD-20240101-XXXX"
```

## Déploiement Production

1. Configurer les variables d'environnement de production
2. Mettre `APP_DEBUG=false` et `APP_ENV=production`
3. Configurer SSL (certificat + config Nginx)
4. Configurer les credentials Stripe/PayPal en mode live
5. Configurer un vrai serveur SMTP
6. Optimiser les caches :

```bash
make cache-optimize
```

## Sécurité

- PDFs watermarkés avec identité client
- Liens de téléchargement signés et expirables
- Limite de téléchargements par commande
- Protection CSRF sur tous les formulaires
- Validation des entrées utilisateur

## Licence

Propriétaire - Tous droits réservés.

## Support

Pour toute question : contact@formation-soudure.com
