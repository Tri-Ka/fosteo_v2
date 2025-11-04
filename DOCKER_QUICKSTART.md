# 🐳 Docker - Démarrage Rapide

## ⚡ Démarrer en 2 Commandes

```bash
# 1. Démarrer Docker
docker-compose up -d

# 2. Ouvrir le site
# https://localhost

# 3. Voir les emails (MailDev)
# http://localhost:1080
```

**📧 MailDev** intercepte tous les emails envoyés pour les visualiser sans les envoyer réellement.

---

## ⚠️ Certificat SSL

Votre navigateur affichera un avertissement car le certificat est auto-signé (développement local).

**Cliquez sur "Avancé" → "Continuer vers localhost"**

C'est normal ! ✅

---

## 🛑 Arrêter

```bash
docker-compose down
```

---

## 📝 Logs

```bash
docker-compose logs -f
```

---

## � Redémarrer

```bash
docker-compose restart
```

---

## 🔨 Reconstruire

Après modification du Dockerfile :

```bash
docker-compose down
docker-compose build --no-cache
docker-compose up -d
```

---

## 📚 Plus d'Infos

Voir [DOCKER_README.md](DOCKER_README.md) pour la documentation complète.
