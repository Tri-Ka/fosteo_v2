# Site Fosteo - Ostéopathe Coline Fanzutti

Site web professionnel pour Coline Fanzutti, ostéopathe à Nozay (Essonne).

---

## 🚀 Développement Local (Docker)

### Prérequis
- Docker
- Docker Compose

### Démarrage Rapide

```bash
# Démarrer le site
docker-compose up -d

# Accéder au site
# https://localhost

# Accéder à MailDev (voir les emails)
# http://localhost:1080
```

**📖 Documentation complète :** Voir [DOCKER_QUICKSTART.md](DOCKER_QUICKSTART.md)

---

## 🛡️ Protection Anti-Spam

Le formulaire de contact inclut plusieurs niveaux de protection :

- ✅ Validation reCAPTCHA côté serveur
- ✅ Honeypot (champ caché)
- ✅ Détection de soumissions rapides
- ✅ Filtrage de mots-clés spam
- ✅ Limitation des liens

### Configuration Requise

1. Créez `config.php` depuis `config.example.php`
2. Ajoutez votre clé secrète Google reCAPTCHA
3. Configurez les emails

**📖 Documentation complète :** Voir [INSTALLATION.md](INSTALLATION.md)

---

## 📁 Structure du Projet

```
fosteo_v2/
├── index.php              # Page principale
├── config.php             # Configuration (à créer)
├── actions/               # Scripts backend
│   └── contact.php        # Traitement formulaire contact
├── templates/             # Templates HTML
├── css/                   # Styles
├── js/                    # Scripts JavaScript
├── img/                   # Images
├── docker/                # Configuration Docker
│   ├── apache-ssl.conf    # Config Apache SSL
│   └── entrypoint.sh      # Script démarrage
├── Dockerfile             # Image Docker
└── docker-compose.yml     # Orchestration Docker
```

---

## 🔧 Commandes Utiles

### Docker

```bash
# Démarrer
docker-compose up -d

# Arrêter
docker-compose down

# Voir les logs
docker-compose logs -f

# Reconstruire
docker-compose build --no-cache
docker-compose up -d

# Accéder au shell
docker-compose exec web bash
```

### Make (optionnel)

```bash
make start      # Démarrer
make stop       # Arrêter
make restart    # Redémarrer
make logs       # Voir les logs
make shell      # Accéder au shell
```

---

## 🌐 Production

### Déploiement

1. Uploadez les fichiers sur votre serveur
2. Configurez `config.php` avec vos vraies clés
3. Vérifiez que `.htaccess` est actif pour les redirections HTTPS
4. Testez le formulaire de contact

### Configuration Apache (Production)

- PHP 7.4+ ou 8.x
- Extensions : mysqli, pdo, pdo_mysql
- mod_rewrite activé
- Certificat SSL Let's Encrypt recommandé

---

## 📚 Documentation

- **[DOCKER_QUICKSTART.md](DOCKER_QUICKSTART.md)** - Démarrage Docker rapide
- **[DOCKER_README.md](DOCKER_README.md)** - Documentation Docker complète
- **[MAILDEV.md](MAILDEV.md)** - Serveur mail de développement
- **[INSTALLATION.md](INSTALLATION.md)** - Configuration anti-spam
- **[ANTI_SPAM_README.md](ANTI_SPAM_README.md)** - Détails protection anti-spam
- **[HTTPS_CERTIFICATE.md](HTTPS_CERTIFICATE.md)** - Certificats SSL en développement

---

## ⚙️ Technologies

- **Backend** : PHP 8.1
- **Frontend** : HTML5, CSS3, JavaScript
- **Serveur** : Apache 2.4
- **Sécurité** : Google reCAPTCHA v2, Filtres anti-spam
- **Dev** : Docker, Docker Compose

---

## 📝 Notes

- Le fichier `config.php` n'est pas versionné (voir `.gitignore`)
- Le certificat SSL en développement est auto-signé
- Le `.htaccess` de production redirige vers HTTPS et le domaine principal
- Docker utilise une version modifiée du `.htaccess` pour éviter les redirections

---

## 🔐 Sécurité

**Ne JAMAIS commiter :**
- `config.php` (contient la clé secrète reCAPTCHA)
- Fichiers de configuration sensibles

**Déjà protégés dans `.gitignore`**

---

## 📞 Contact

Site web : [www.fanzutti-osteopathe.com](https://www.fanzutti-osteopathe.com)
