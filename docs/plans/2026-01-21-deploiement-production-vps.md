# Guide de Mise en Production - VPS OVH

## Vue d'ensemble

Déploiement de la plateforme Formation PHP sur un VPS OVH avec :
- **Traefik** comme reverse proxy central (SSL automatique)
- **Docker Compose** pour l'orchestration
- **GitHub Actions** pour le CI/CD
- **Stack isolée** (MySQL + Redis dédiés au projet)

---

## Prérequis

- VPS OVH avec 4 Go RAM minimum
- Domaine configuré chez OVH
- Compte GitHub avec accès au repository
- Accès SSH au VPS

---

## Partie 1 : Préparation du VPS

### 1.1 Connexion et mise à jour

```bash
ssh root@IP_DU_VPS

# Mise à jour système
apt update && apt upgrade -y
```

### 1.2 Créer un utilisateur dédié (ne pas utiliser root)

```bash
# Créer l'utilisateur
adduser deploy
usermod -aG sudo deploy

# Configurer SSH pour cet utilisateur
mkdir -p /home/deploy/.ssh
cp ~/.ssh/authorized_keys /home/deploy/.ssh/
chown -R deploy:deploy /home/deploy/.ssh
chmod 700 /home/deploy/.ssh
chmod 600 /home/deploy/.ssh/authorized_keys

# Désactiver login root SSH (optionnel mais recommandé)
# Éditer /etc/ssh/sshd_config : PermitRootLogin no
# systemctl restart sshd
```

### 1.3 Installer Docker

```bash
# En tant que deploy (ou root)
sudo apt install -y ca-certificates curl gnupg

# Ajouter la clé GPG Docker
sudo install -m 0755 -d /etc/apt/keyrings
curl -fsSL https://download.docker.com/linux/ubuntu/gpg | sudo gpg --dearmor -o /etc/apt/keyrings/docker.gpg
sudo chmod a+r /etc/apt/keyrings/docker.gpg

# Ajouter le repository
echo \
  "deb [arch=$(dpkg --print-architecture) signed-by=/etc/apt/keyrings/docker.gpg] https://download.docker.com/linux/ubuntu \
  $(. /etc/os-release && echo "$VERSION_CODENAME") stable" | \
  sudo tee /etc/apt/sources.list.d/docker.list > /dev/null

# Installer Docker
sudo apt update
sudo apt install -y docker-ce docker-ce-cli containerd.io docker-buildx-plugin docker-compose-plugin

# Ajouter l'utilisateur deploy au groupe docker
sudo usermod -aG docker deploy

# Vérifier l'installation
docker --version
docker compose version
```

### 1.4 Configurer le firewall

```bash
sudo apt install -y ufw

# Règles de base
sudo ufw default deny incoming
sudo ufw default allow outgoing
sudo ufw allow ssh
sudo ufw allow 80/tcp
sudo ufw allow 443/tcp

# Activer
sudo ufw enable
sudo ufw status
```

### 1.5 Créer les répertoires

```bash
# En tant que deploy
sudo mkdir -p /opt/traefik
sudo mkdir -p /var/www/formation-php
sudo chown -R deploy:deploy /opt/traefik /var/www
```

---

## Partie 2 : Installation de Traefik

### 2.1 Créer le réseau Docker partagé

```bash
docker network create traefik-public
```

### 2.2 Créer les fichiers Traefik

```bash
cd /opt/traefik
```

**Fichier `/opt/traefik/docker-compose.yml`** :

```yaml
services:
  traefik:
    image: traefik:v3.0
    container_name: traefik
    restart: always
    ports:
      - "80:80"
      - "443:443"
    volumes:
      - /var/run/docker.sock:/var/run/docker.sock:ro
      - ./traefik.yml:/traefik.yml:ro
      - ./acme.json:/acme.json
    networks:
      - traefik-public
    labels:
      # Dashboard Traefik
      - "traefik.enable=true"
      - "traefik.http.routers.traefik.rule=Host(`traefik.TONDOMAINE.fr`)"
      - "traefik.http.routers.traefik.tls.certresolver=letsencrypt"
      - "traefik.http.routers.traefik.service=api@internal"
      - "traefik.http.routers.traefik.middlewares=auth"
      # Authentification Basic pour le dashboard
      - "traefik.http.middlewares.auth.basicauth.users=admin:$$apr1$$HASH_MOT_DE_PASSE"

networks:
  traefik-public:
    external: true
```

**Fichier `/opt/traefik/traefik.yml`** :

```yaml
api:
  dashboard: true
  insecure: false

entryPoints:
  web:
    address: ":80"
    http:
      redirections:
        entryPoint:
          to: websecure
          scheme: https
  websecure:
    address: ":443"

providers:
  docker:
    endpoint: "unix:///var/run/docker.sock"
    exposedByDefault: false
    network: traefik-public

certificatesResolvers:
  letsencrypt:
    acme:
      email: ton-email@example.com
      storage: /acme.json
      httpChallenge:
        entryPoint: web

log:
  level: INFO
```

### 2.3 Générer le mot de passe pour le dashboard

```bash
# Installer htpasswd
sudo apt install -y apache2-utils

# Générer le hash (remplacer MOT_DE_PASSE)
htpasswd -nb admin MOT_DE_PASSE

# Résultat : admin:$apr1$xxxxx$yyyyyyy
# Dans docker-compose.yml, doubler les $ : admin:$$apr1$$xxxxx$$yyyyyyy
```

### 2.4 Créer le fichier de certificats

```bash
touch /opt/traefik/acme.json
chmod 600 /opt/traefik/acme.json
```

### 2.5 Démarrer Traefik

```bash
cd /opt/traefik
docker compose up -d

# Vérifier les logs
docker logs traefik -f
```

---

## Partie 3 : Configuration du Projet

### 3.1 Fichiers à créer dans le repository

Ces fichiers doivent être créés et committés dans ton repository Git.

**Fichier `docker-compose.prod.yml`** (à la racine du projet) :

```yaml
services:
  nginx:
    image: nginx:alpine
    container_name: formation_nginx
    restart: always
    volumes:
      - ./src:/var/www/html:ro
      - ./docker/nginx/prod.conf:/etc/nginx/conf.d/default.conf:ro
    labels:
      - "traefik.enable=true"
      - "traefik.http.routers.formation.rule=Host(`formations.TONDOMAINE.fr`)"
      - "traefik.http.routers.formation.tls.certresolver=letsencrypt"
      - "traefik.http.services.formation.loadbalancer.server.port=80"
    networks:
      - traefik-public
      - formation-internal
    depends_on:
      - php

  php:
    build:
      context: ./docker/php
      dockerfile: Dockerfile.prod
    container_name: formation_php
    restart: always
    working_dir: /var/www/html
    volumes:
      - ./src:/var/www/html
      - ./formations-latex:/var/www/latex:ro
    env_file:
      - .env.production
    networks:
      - formation-internal
    depends_on:
      - mysql
      - redis

  mysql:
    image: mysql:8.0
    container_name: formation_mysql
    restart: always
    volumes:
      - mysql_data:/var/lib/mysql
      - ./docker/mysql/init.sql:/docker-entrypoint-initdb.d/init.sql:ro
    env_file:
      - .env.production
    environment:
      MYSQL_ROOT_PASSWORD: ${DB_ROOT_PASSWORD}
      MYSQL_DATABASE: ${DB_DATABASE}
      MYSQL_USER: ${DB_USERNAME}
      MYSQL_PASSWORD: ${DB_PASSWORD}
    command: --default-authentication-plugin=mysql_native_password
    networks:
      - formation-internal

  redis:
    image: redis:alpine
    container_name: formation_redis
    restart: always
    command: redis-server --appendonly yes
    volumes:
      - redis_data:/data
    networks:
      - formation-internal

  queue:
    build:
      context: ./docker/php
      dockerfile: Dockerfile.prod
    container_name: formation_queue
    restart: always
    working_dir: /var/www/html
    volumes:
      - ./src:/var/www/html
      - ./formations-latex:/var/www/latex:ro
    env_file:
      - .env.production
    command: php artisan queue:work --tries=3 --timeout=300
    networks:
      - formation-internal
    depends_on:
      - php
      - redis

  scheduler:
    build:
      context: ./docker/php
      dockerfile: Dockerfile.prod
    container_name: formation_scheduler
    restart: always
    working_dir: /var/www/html
    volumes:
      - ./src:/var/www/html
    env_file:
      - .env.production
    command: sh -c "while true; do php artisan schedule:run --verbose --no-interaction & sleep 60; done"
    networks:
      - formation-internal
    depends_on:
      - php

networks:
  traefik-public:
    external: true
  formation-internal:
    driver: bridge

volumes:
  mysql_data:
  redis_data:
```

**Fichier `docker/php/Dockerfile.prod`** :

```dockerfile
FROM php:8.3-fpm-alpine

# Dépendances système
RUN apk add --no-cache \
    libpng-dev \
    libjpeg-turbo-dev \
    freetype-dev \
    libzip-dev \
    icu-dev \
    oniguruma-dev \
    poppler-utils \
    ghostscript

# Extensions PHP
RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) \
        pdo_mysql \
        gd \
        zip \
        intl \
        opcache \
        bcmath \
        mbstring

# Extension Redis
RUN apk add --no-cache autoconf g++ make \
    && pecl install redis \
    && docker-php-ext-enable redis \
    && apk del autoconf g++ make

# Configuration PHP production
RUN mv "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini"

# Opcache optimisé pour production
RUN echo "opcache.enable=1" >> "$PHP_INI_DIR/conf.d/opcache.ini" \
    && echo "opcache.memory_consumption=128" >> "$PHP_INI_DIR/conf.d/opcache.ini" \
    && echo "opcache.interned_strings_buffer=8" >> "$PHP_INI_DIR/conf.d/opcache.ini" \
    && echo "opcache.max_accelerated_files=10000" >> "$PHP_INI_DIR/conf.d/opcache.ini" \
    && echo "opcache.validate_timestamps=0" >> "$PHP_INI_DIR/conf.d/opcache.ini" \
    && echo "opcache.revalidate_freq=0" >> "$PHP_INI_DIR/conf.d/opcache.ini"

# Configuration PHP
RUN echo "memory_limit=256M" >> "$PHP_INI_DIR/conf.d/custom.ini" \
    && echo "upload_max_filesize=50M" >> "$PHP_INI_DIR/conf.d/custom.ini" \
    && echo "post_max_size=50M" >> "$PHP_INI_DIR/conf.d/custom.ini" \
    && echo "max_execution_time=300" >> "$PHP_INI_DIR/conf.d/custom.ini"

# Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

# Permissions
RUN addgroup -g 1000 -S www && adduser -u 1000 -S www -G www
USER www
```

**Fichier `docker/nginx/prod.conf`** :

```nginx
server {
    listen 80;
    server_name _;
    root /var/www/html/public;
    index index.php;

    # Logs
    access_log /var/log/nginx/access.log;
    error_log /var/log/nginx/error.log;

    # Sécurité headers
    add_header X-Frame-Options "SAMEORIGIN" always;
    add_header X-Content-Type-Options "nosniff" always;
    add_header X-XSS-Protection "1; mode=block" always;
    add_header Referrer-Policy "strict-origin-when-cross-origin" always;

    # Gzip
    gzip on;
    gzip_vary on;
    gzip_min_length 1024;
    gzip_types text/plain text/css application/json application/javascript text/xml application/xml application/xml+rss text/javascript;

    # Cache assets statiques
    location ~* \.(jpg|jpeg|png|gif|ico|css|js|woff|woff2|ttf|svg)$ {
        expires 30d;
        add_header Cache-Control "public, immutable";
    }

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location ~ \.php$ {
        fastcgi_pass php:9000;
        fastcgi_index index.php;
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
        include fastcgi_params;
        fastcgi_buffer_size 128k;
        fastcgi_buffers 4 256k;
        fastcgi_busy_buffers_size 256k;
    }

    location ~ /\.(?!well-known).* {
        deny all;
    }
}
```

**Fichier `.env.production.example`** (template, à copier en `.env.production` sur le serveur) :

```env
APP_NAME="Formations Soudeuse"
APP_ENV=production
APP_KEY=
APP_DEBUG=false
APP_URL=https://formations.TONDOMAINE.fr

LOG_CHANNEL=stack
LOG_LEVEL=error

DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=formation_db
DB_USERNAME=formation_user
DB_PASSWORD=GENERER_MOT_DE_PASSE_FORT
DB_ROOT_PASSWORD=GENERER_MOT_DE_PASSE_FORT_ROOT

REDIS_HOST=redis
REDIS_PASSWORD=null
REDIS_PORT=6379

CACHE_DRIVER=redis
SESSION_DRIVER=redis
QUEUE_CONNECTION=redis

MAIL_MAILER=smtp
MAIL_HOST=ssl0.ovh.net
MAIL_PORT=465
MAIL_USERNAME=contact@TONDOMAINE.fr
MAIL_PASSWORD=MOT_DE_PASSE_EMAIL
MAIL_ENCRYPTION=ssl
MAIL_FROM_ADDRESS=contact@TONDOMAINE.fr
MAIL_FROM_NAME="${APP_NAME}"

STRIPE_KEY=pk_live_xxx
STRIPE_SECRET=sk_live_xxx
STRIPE_WEBHOOK_SECRET=whsec_xxx

PAYPAL_CLIENT_ID=xxx
PAYPAL_SECRET=xxx
PAYPAL_MODE=live
```

**Fichier `.github/workflows/deploy.yml`** :

```yaml
name: Deploy to Production

on:
  push:
    branches:
      - main

jobs:
  deploy:
    name: Deploy
    runs-on: ubuntu-latest

    steps:
      - name: Checkout code
        uses: actions/checkout@v4

      - name: Deploy to VPS
        uses: appleboy/ssh-action@v1.0.3
        with:
          host: ${{ secrets.VPS_HOST }}
          username: ${{ secrets.VPS_USER }}
          key: ${{ secrets.VPS_SSH_KEY }}
          script: |
            cd /var/www/formation-php

            # Pull des dernières modifications
            git pull origin main

            # Build des images si nécessaire
            docker compose -f docker-compose.prod.yml build --pull

            # Démarrer/redémarrer les conteneurs
            docker compose -f docker-compose.prod.yml up -d

            # Attendre que PHP soit prêt
            sleep 5

            # Installer les dépendances Composer (en prod)
            docker compose -f docker-compose.prod.yml exec -T php composer install --no-dev --optimize-autoloader

            # Migrations
            docker compose -f docker-compose.prod.yml exec -T php php artisan migrate --force

            # Cache Laravel
            docker compose -f docker-compose.prod.yml exec -T php php artisan config:cache
            docker compose -f docker-compose.prod.yml exec -T php php artisan route:cache
            docker compose -f docker-compose.prod.yml exec -T php php artisan view:cache
            docker compose -f docker-compose.prod.yml exec -T php php artisan event:cache

            # Redémarrer PHP et queue pour opcache
            docker compose -f docker-compose.prod.yml restart php queue

            # Nettoyage images Docker non utilisées
            docker image prune -f

      - name: Notify success
        if: success()
        run: echo "Deployment successful!"
```

---

## Partie 4 : Configuration DNS OVH

### 4.1 Accéder à la zone DNS

1. Connecte-toi à l'espace client OVH
2. Va dans **Noms de domaine** > **TONDOMAINE.fr** > **Zone DNS**

### 4.2 Ajouter les enregistrements

| Type | Sous-domaine | Cible | TTL |
|------|--------------|-------|-----|
| A | formations | IP_DU_VPS | 3600 |
| A | traefik | IP_DU_VPS | 3600 |

### 4.3 Configuration SMTP OVH

1. Va dans **Emails** > **TONDOMAINE.fr**
2. Crée une adresse email `contact@TONDOMAINE.fr`
3. Note le mot de passe pour le fichier `.env.production`

**Paramètres SMTP OVH** :
- Serveur : `ssl0.ovh.net`
- Port : `465` (SSL) ou `587` (TLS)
- Authentification : Adresse email complète

---

## Partie 5 : Configuration GitHub

### 5.1 Générer une clé SSH pour le déploiement

Sur ta machine locale :

```bash
# Générer une clé dédiée au déploiement
ssh-keygen -t ed25519 -C "github-deploy" -f ~/.ssh/github_deploy_key

# Afficher la clé publique (à ajouter sur le VPS)
cat ~/.ssh/github_deploy_key.pub

# Afficher la clé privée (à ajouter dans GitHub Secrets)
cat ~/.ssh/github_deploy_key
```

### 5.2 Ajouter la clé publique sur le VPS

```bash
# Sur le VPS, en tant que deploy
echo "CONTENU_CLE_PUBLIQUE" >> ~/.ssh/authorized_keys
```

### 5.3 Configurer les Secrets GitHub

1. Va dans ton repository GitHub
2. **Settings** > **Secrets and variables** > **Actions**
3. Clique **New repository secret** pour chaque :

| Nom | Valeur |
|-----|--------|
| `VPS_HOST` | IP de ton VPS OVH |
| `VPS_USER` | `deploy` |
| `VPS_SSH_KEY` | Contenu complet de `~/.ssh/github_deploy_key` (clé privée) |

---

## Partie 6 : Premier Déploiement

### 6.1 Cloner le repository sur le VPS

```bash
# En tant que deploy
cd /var/www
git clone git@github.com:TON_USERNAME/formation-php.git
cd formation-php
```

### 6.2 Configurer Git pour le VPS

```bash
# Générer une clé SSH pour le VPS (pour git pull)
ssh-keygen -t ed25519 -C "vps-deploy"
cat ~/.ssh/id_ed25519.pub
# Ajouter cette clé comme Deploy Key dans GitHub (Settings > Deploy keys)
```

### 6.3 Créer le fichier .env.production

```bash
cp .env.production.example .env.production
nano .env.production
# Remplir toutes les valeurs (mots de passe, clés API, etc.)
```

### 6.4 Générer la clé Laravel

```bash
# Démarrer temporairement pour générer la clé
docker compose -f docker-compose.prod.yml up -d php

docker compose -f docker-compose.prod.yml exec php php artisan key:generate

# Copier la clé générée dans .env.production
```

### 6.5 Lancer le premier déploiement

```bash
# Build et démarrage
docker compose -f docker-compose.prod.yml build
docker compose -f docker-compose.prod.yml up -d

# Vérifier que tout tourne
docker compose -f docker-compose.prod.yml ps

# Voir les logs si problème
docker compose -f docker-compose.prod.yml logs -f

# Installer les dépendances
docker compose -f docker-compose.prod.yml exec php composer install --no-dev --optimize-autoloader

# Migrations
docker compose -f docker-compose.prod.yml exec php php artisan migrate --force

# Seeders (si première installation)
docker compose -f docker-compose.prod.yml exec php php artisan db:seed --force

# Cache
docker compose -f docker-compose.prod.yml exec php php artisan config:cache
docker compose -f docker-compose.prod.yml exec php php artisan route:cache
docker compose -f docker-compose.prod.yml exec php php artisan view:cache

# Créer le lien storage
docker compose -f docker-compose.prod.yml exec php php artisan storage:link
```

### 6.6 Vérifier le site

1. Ouvre `https://formations.TONDOMAINE.fr`
2. Vérifie que le SSL est actif (cadenas vert)
3. Teste le dashboard Traefik : `https://traefik.TONDOMAINE.fr`

---

## Partie 7 : Commandes Utiles

### Gestion des conteneurs

```bash
cd /var/www/formation-php

# Voir l'état
docker compose -f docker-compose.prod.yml ps

# Logs en temps réel
docker compose -f docker-compose.prod.yml logs -f
docker compose -f docker-compose.prod.yml logs -f php  # Un seul service

# Redémarrer
docker compose -f docker-compose.prod.yml restart
docker compose -f docker-compose.prod.yml restart php queue  # Services spécifiques

# Arrêter
docker compose -f docker-compose.prod.yml down

# Reconstruire après modification Dockerfile
docker compose -f docker-compose.prod.yml build --no-cache php
docker compose -f docker-compose.prod.yml up -d
```

### Commandes Laravel

```bash
# Artisan
docker compose -f docker-compose.prod.yml exec php php artisan COMMANDE

# Exemples courants
docker compose -f docker-compose.prod.yml exec php php artisan cache:clear
docker compose -f docker-compose.prod.yml exec php php artisan config:clear
docker compose -f docker-compose.prod.yml exec php php artisan queue:restart
docker compose -f docker-compose.prod.yml exec php php artisan tinker
```

### Base de données

```bash
# Accéder à MySQL
docker compose -f docker-compose.prod.yml exec mysql mysql -u formation_user -p

# Backup
docker compose -f docker-compose.prod.yml exec mysql mysqldump -u root -p formation_db > backup_$(date +%Y%m%d).sql

# Restore
docker compose -f docker-compose.prod.yml exec -T mysql mysql -u root -p formation_db < backup.sql
```

### Traefik

```bash
cd /opt/traefik

# Logs
docker logs traefik -f

# Redémarrer
docker compose restart

# Voir les certificats
cat acme.json | jq '.letsencrypt.Certificates'
```

---

## Partie 8 : Sécurité et Maintenance

### 8.1 Backups automatiques

Créer un script `/opt/scripts/backup.sh` :

```bash
#!/bin/bash
BACKUP_DIR="/opt/backups"
DATE=$(date +%Y%m%d_%H%M%S)

mkdir -p $BACKUP_DIR

# Backup MySQL
docker compose -f /var/www/formation-php/docker-compose.prod.yml exec -T mysql \
  mysqldump -u root -p$DB_ROOT_PASSWORD formation_db | gzip > $BACKUP_DIR/db_$DATE.sql.gz

# Backup fichiers uploadés
tar -czf $BACKUP_DIR/storage_$DATE.tar.gz /var/www/formation-php/src/storage/app

# Garder les 7 derniers backups
find $BACKUP_DIR -name "*.gz" -mtime +7 -delete

echo "Backup completed: $DATE"
```

Ajouter au cron :

```bash
crontab -e
# Ajouter :
0 3 * * * /opt/scripts/backup.sh >> /var/log/backup.log 2>&1
```

### 8.2 Mises à jour de sécurité

```bash
# Mettre à jour le système
sudo apt update && sudo apt upgrade -y

# Mettre à jour les images Docker
docker compose -f docker-compose.prod.yml pull
docker compose -f docker-compose.prod.yml up -d

# Mettre à jour Traefik
cd /opt/traefik
docker compose pull
docker compose up -d
```

### 8.3 Monitoring

```bash
# Espace disque
df -h

# Mémoire
free -m

# Conteneurs
docker stats --no-stream
```

---

## Checklist Récapitulative

### Sur le VPS
- [ ] Créer utilisateur `deploy`
- [ ] Installer Docker
- [ ] Configurer le firewall (UFW)
- [ ] Créer le réseau `traefik-public`
- [ ] Installer et démarrer Traefik
- [ ] Cloner le repository
- [ ] Créer `.env.production`
- [ ] Premier déploiement manuel

### Sur GitHub
- [ ] Ajouter les fichiers de production au repo
- [ ] Configurer les secrets (VPS_HOST, VPS_USER, VPS_SSH_KEY)
- [ ] Ajouter la Deploy Key pour le VPS

### Sur OVH
- [ ] Configurer les enregistrements DNS (A records)
- [ ] Créer l'adresse email pour SMTP

### Vérifications finales
- [ ] Site accessible en HTTPS
- [ ] Dashboard Traefik fonctionnel
- [ ] Déploiement automatique après push sur main
- [ ] Emails transactionnels fonctionnels
- [ ] Paiements Stripe/PayPal en mode live
