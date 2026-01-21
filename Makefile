# Makefile pour le projet Formation PDF
# Usage: make <commande>

.PHONY: help install start stop restart build logs shell mysql redis artisan composer test lint clean pdf

# Variables
DOCKER_COMPOSE = docker compose
PHP_CONTAINER = formation_php
MYSQL_CONTAINER = formation_mysql
LATEX_CONTAINER = formation_latex

# Couleurs
GREEN = \033[0;32m
YELLOW = \033[0;33m
RED = \033[0;31m
NC = \033[0m

## Aide
help: ## Affiche cette aide
	@echo "$(GREEN)Commandes disponibles:$(NC)"
	@grep -E '^[a-zA-Z_-]+:.*?## .*$$' $(MAKEFILE_LIST) | sort | awk 'BEGIN {FS = ":.*?## "}; {printf "  $(YELLOW)%-15s$(NC) %s\n", $$1, $$2}'

## Installation
install: ## Installation complète du projet
	@echo "$(GREEN)>>> Installation du projet...$(NC)"
	@cp .env.example .env 2>/dev/null || true
	$(DOCKER_COMPOSE) build
	$(DOCKER_COMPOSE) up -d
	@echo "$(YELLOW)>>> Attente du démarrage de MySQL...$(NC)"
	@sleep 10
	$(DOCKER_COMPOSE) exec php composer install
	$(DOCKER_COMPOSE) exec php php artisan key:generate
	$(DOCKER_COMPOSE) exec php php artisan migrate --seed
	$(DOCKER_COMPOSE) exec php php artisan storage:link
	@echo "$(GREEN)>>> Installation terminée!$(NC)"
	@echo "$(YELLOW)>>> Application: http://localhost$(NC)"
	@echo "$(YELLOW)>>> Mailpit: http://localhost:8025$(NC)"
	@echo "$(YELLOW)>>> phpMyAdmin: http://localhost:8080 (docker compose --profile dev up)$(NC)"

## Docker
start: ## Démarre les containers
	$(DOCKER_COMPOSE) up -d
	@echo "$(GREEN)>>> Containers démarrés$(NC)"

stop: ## Arrête les containers
	$(DOCKER_COMPOSE) down
	@echo "$(YELLOW)>>> Containers arrêtés$(NC)"

restart: ## Redémarre les containers
	$(DOCKER_COMPOSE) restart
	@echo "$(GREEN)>>> Containers redémarrés$(NC)"

build: ## Rebuild les containers
	$(DOCKER_COMPOSE) build --no-cache
	@echo "$(GREEN)>>> Containers reconstruits$(NC)"

logs: ## Affiche les logs
	$(DOCKER_COMPOSE) logs -f

logs-php: ## Logs du container PHP
	$(DOCKER_COMPOSE) logs -f php

logs-nginx: ## Logs du container Nginx
	$(DOCKER_COMPOSE) logs -f nginx

## Shells
shell: ## Ouvre un shell dans le container PHP
	$(DOCKER_COMPOSE) exec php bash

shell-root: ## Ouvre un shell root dans le container PHP
	$(DOCKER_COMPOSE) exec -u root php bash

mysql: ## Ouvre un shell MySQL
	$(DOCKER_COMPOSE) exec mysql mysql -u formation_user -pformation_password formation_db

redis: ## Ouvre un shell Redis
	$(DOCKER_COMPOSE) exec redis redis-cli

## Laravel
artisan: ## Exécute une commande artisan (usage: make artisan cmd="migrate")
	$(DOCKER_COMPOSE) exec php php artisan $(cmd)

migrate: ## Lance les migrations
	$(DOCKER_COMPOSE) exec php php artisan migrate
	@echo "$(GREEN)>>> Migrations exécutées$(NC)"

migrate-fresh: ## Reset et relance les migrations avec seeds
	$(DOCKER_COMPOSE) exec php php artisan migrate:fresh --seed
	@echo "$(GREEN)>>> Base de données réinitialisée$(NC)"

seed: ## Lance les seeders
	$(DOCKER_COMPOSE) exec php php artisan db:seed
	@echo "$(GREEN)>>> Seeds exécutés$(NC)"

cache-clear: ## Vide tous les caches Laravel
	$(DOCKER_COMPOSE) exec php php artisan cache:clear
	$(DOCKER_COMPOSE) exec php php artisan config:clear
	$(DOCKER_COMPOSE) exec php php artisan route:clear
	$(DOCKER_COMPOSE) exec php php artisan view:clear
	@echo "$(GREEN)>>> Caches vidés$(NC)"

cache-optimize: ## Optimise les caches pour la production
	$(DOCKER_COMPOSE) exec php php artisan config:cache
	$(DOCKER_COMPOSE) exec php php artisan route:cache
	$(DOCKER_COMPOSE) exec php php artisan view:cache
	@echo "$(GREEN)>>> Caches optimisés$(NC)"

queue: ## Lance le worker de queue
	$(DOCKER_COMPOSE) exec php php artisan queue:work --tries=3

## Composer
composer: ## Exécute une commande composer (usage: make composer cmd="require package")
	$(DOCKER_COMPOSE) exec php composer $(cmd)

composer-install: ## Install les dépendances
	$(DOCKER_COMPOSE) exec php composer install

composer-update: ## Met à jour les dépendances
	$(DOCKER_COMPOSE) exec php composer update

## Tests
test: ## Lance tous les tests
	$(DOCKER_COMPOSE) exec php php artisan test

test-coverage: ## Lance les tests avec couverture
	$(DOCKER_COMPOSE) exec php php artisan test --coverage

lint: ## Vérifie le code avec Pint
	$(DOCKER_COMPOSE) exec php ./vendor/bin/pint --test

lint-fix: ## Corrige le code avec Pint
	$(DOCKER_COMPOSE) exec php ./vendor/bin/pint

## PDF
pdf-compile: ## Compile tous les PDFs LaTeX
	$(DOCKER_COMPOSE) exec latex /usr/local/bin/compile.sh /workspace/niveau-1/formation-niveau-1.tex
	$(DOCKER_COMPOSE) exec latex /usr/local/bin/compile.sh /workspace/niveau-2/formation-niveau-2.tex
	$(DOCKER_COMPOSE) exec latex /usr/local/bin/compile.sh /workspace/niveau-3/formation-niveau-3.tex
	@echo "$(GREEN)>>> PDFs compilés$(NC)"

pdf-single: ## Compile un PDF spécifique (usage: make pdf-single file="niveau-1/formation-niveau-1.tex")
	$(DOCKER_COMPOSE) exec latex /usr/local/bin/compile.sh /workspace/$(file)

## Nettoyage
clean: ## Nettoie les fichiers temporaires
	$(DOCKER_COMPOSE) exec php php artisan cache:clear
	$(DOCKER_COMPOSE) exec php php artisan config:clear
	rm -rf src/storage/logs/*.log
	@echo "$(GREEN)>>> Nettoyage terminé$(NC)"

clean-all: ## Supprime tous les containers et volumes
	$(DOCKER_COMPOSE) down -v --remove-orphans
	docker system prune -f
	@echo "$(RED)>>> Tout a été supprimé$(NC)"

## Dev tools
dev: ## Lance l'environnement de développement avec tous les outils
	$(DOCKER_COMPOSE) --profile dev up -d
	@echo "$(GREEN)>>> Environnement de dev démarré$(NC)"
	@echo "$(YELLOW)>>> phpMyAdmin: http://localhost:8080$(NC)"

npm-install: ## Install les dépendances NPM
	$(DOCKER_COMPOSE) exec php npm install

npm-dev: ## Lance le build dev (Vite)
	$(DOCKER_COMPOSE) exec php npm run dev

npm-build: ## Lance le build production (Vite)
	$(DOCKER_COMPOSE) exec php npm run build
