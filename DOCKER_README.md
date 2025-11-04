# 🐳 Docker - Site Fosteo

## 🚀 Démarrage Rapide

### Prérequis
- Docker installé
- Docker Compose installé

### Configuration de l'URL locale

Pour accéder au site via `http://perso.fosteo`, ajoutez cette ligne à votre fichier hosts :

**Windows** : `C:\Windows\System32\drivers\etc\hosts`
**Linux/Mac** : `/etc/hosts`

```
127.0.0.1 perso.fosteo
```

### Démarrer le site

```bash
# Construire et démarrer le conteneur
docker-compose up -d

# Vérifier que le conteneur tourne
docker-compose ps

# Voir les logs
docker-compose logs -f
```

Le site sera accessible à : **https://perso.fosteo**

⚠️ **Certificat auto-signé** : Votre navigateur affichera un avertissement de sécurité. C'est normal en développement local. Cliquez sur "Avancé" puis "Accepter le risque et continuer".

### Commandes utiles

```bash
# Arrêter le conteneur
docker-compose down

# Redémarrer
docker-compose restart

# Reconstruire (après modification du Dockerfile)
docker-compose up -d --build

# Accéder au shell du conteneur
docker-compose exec web bash

# Voir les logs Apache
docker-compose exec web tail -f /var/log/apache2/error.log
```

## 📁 Structure Docker

- **Dockerfile** : Image PHP 8.1 avec Apache et SSL
- **docker-compose.yml** : Configuration du service
- **docker/apache-ssl.conf** : Configuration Apache SSL
- **docker/entrypoint.sh** : Script de génération du certificat SSL
- **.dockerignore** : Fichiers exclus de l'image

## 🔧 Configuration

### PHP Extensions installées
- mysqli
- pdo
- pdo_mysql

### Apache
- mod_rewrite activé
- mod_ssl activé (HTTPS)
- AllowOverride All (pour .htaccess)
- Ports 80 et 443 exposés
- Certificat SSL auto-signé généré automatiquement
- Redirection HTTP → HTTPS

## 🛠️ Personnalisation

### Changer le port

Dans `docker-compose.yml`, modifiez :
```yaml
ports:
  - "8080:80"   # Utilise le port 8080 au lieu de 80
  - "8443:443"  # Utilise le port 8443 au lieu de 443
```

Accédez ensuite à : https://perso.fosteo:8443

### Changer l'URL

1. Modifiez `APACHE_SERVER_NAME` dans `docker-compose.yml`
2. Mettez à jour votre fichier hosts

## 📝 Notes

- Les fichiers sont montés en volume, les modifications sont immédiates
- Le fichier `config.php` n'est pas copié dans l'image (voir .dockerignore)
- Assurez-vous que `config.php` existe localement avec votre clé reCAPTCHA
- Le certificat SSL est auto-signé (valide pour le développement uniquement)
- HTTP (port 80) redirige automatiquement vers HTTPS (port 443)

## ⚠️ Production

Cette configuration est pour le **développement local**.

Pour la production, considérez :
- Utiliser une image optimisée
- Utiliser un vrai certificat SSL (Let's Encrypt)
- Configurer les variables d'environnement
- Ne pas monter les fichiers en volume
- Utiliser un serveur mail configuré
- Renforcer la sécurité Apache
