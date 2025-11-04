.PHONY: help start stop restart build logs shell clean

# Variables
DOCKER_COMPOSE = docker-compose
CONTAINER_NAME = fosteo_web

help: ## Afficher l'aide
	@echo "🐳 Docker - Site Fosteo"
	@echo ""
	@echo "Commandes disponibles :"
	@grep -E '^[a-zA-Z_-]+:.*?## .*$$' $(MAKEFILE_LIST) | sort | awk 'BEGIN {FS = ":.*?## "}; {printf "  \033[36m%-15s\033[0m %s\n", $$1, $$2}'

start: ## Démarrer le site
	@echo "🚀 Démarrage du site..."
	$(DOCKER_COMPOSE) up -d
	@echo "✅ Site démarré : https://perso.fosteo"
	@echo "⚠️  Acceptez le certificat auto-signé dans votre navigateur"

stop: ## Arrêter le site
	@echo "🛑 Arrêt du site..."
	$(DOCKER_COMPOSE) down
	@echo "✅ Site arrêté"

restart: ## Redémarrer le site
	@echo "🔄 Redémarrage du site..."
	$(DOCKER_COMPOSE) restart
	@echo "✅ Site redémarré"

build: ## Reconstruire l'image
	@echo "🔨 Reconstruction de l'image..."
	$(DOCKER_COMPOSE) up -d --build
	@echo "✅ Image reconstruite"

logs: ## Voir les logs
	$(DOCKER_COMPOSE) logs -f

shell: ## Accéder au shell du conteneur
	$(DOCKER_COMPOSE) exec web bash

status: ## Voir le statut
	$(DOCKER_COMPOSE) ps

clean: ## Nettoyer (supprime conteneurs et volumes)
	@echo "🧹 Nettoyage..."
	$(DOCKER_COMPOSE) down -v
	@echo "✅ Nettoyage terminé"

hosts: ## Ajouter l'entrée au fichier hosts
	@echo "📝 Ajout de l'entrée hosts..."
	@sudo sh -c 'echo "127.0.0.1 perso.fosteo" >> /etc/hosts'
	@echo "✅ Entrée ajoutée"

install: hosts start ## Installation complète (hosts + démarrage)
	@echo "✅ Installation terminée : https://perso.fosteo"
