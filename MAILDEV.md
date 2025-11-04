# 📧 MailDev - Serveur Mail de Développement

## 🎯 Qu'est-ce que MailDev ?

MailDev est un serveur SMTP pour le développement qui intercepte tous les emails envoyés par votre application et les affiche dans une interface web, sans les envoyer réellement.

**Avantages :**
- ✅ Voir tous les emails envoyés
- ✅ Tester le formulaire de contact sans spammer
- ✅ Vérifier le contenu et le design des emails
- ✅ Aucun email n'est envoyé réellement

---

## 🚀 Démarrage

MailDev démarre automatiquement avec Docker Compose :

```bash
docker-compose up -d
```

---

## 🌐 Accès à l'Interface Web

**URL :** http://localhost:1080

Ouvrez cette URL dans votre navigateur pour voir tous les emails interceptés.

---

## 📨 Configuration

### Configuration Automatique (Docker)

Lorsque vous utilisez Docker, PHP est automatiquement configuré pour utiliser MailDev :

- **Serveur SMTP :** maildev
- **Port SMTP :** 1025
- **Interface web :** http://localhost:1080

Aucune configuration supplémentaire nécessaire ! ✅

---

## 🧪 Test du Formulaire de Contact

1. **Démarrez Docker :**
   ```bash
   docker-compose up -d
   ```

2. **Allez sur votre site :**
   - https://localhost

3. **Remplissez le formulaire de contact**

4. **Ouvrez MailDev :**
   - http://localhost:1080

5. **Vous verrez l'email apparaître** dans l'interface MailDev ! 📧

---

## 🔧 Fonctionnalités de MailDev

### Interface Web

- 📋 **Liste des emails** : Tous les emails interceptés
- 👁️ **Prévisualisation HTML** : Voir le rendu de l'email
- 📄 **Source** : Voir le code source complet
- 📎 **Pièces jointes** : Télécharger les pièces jointes
- 🗑️ **Suppression** : Effacer les emails de test

### API REST

MailDev expose aussi une API REST sur http://localhost:1080

---

## 📊 Ports Utilisés

| Service | Port | Description |
|---------|------|-------------|
| SMTP | 1025 | Serveur SMTP (utilisé par PHP) |
| Web | 1080 | Interface web MailDev |

---

## 🔍 Vérification

### Vérifier que MailDev tourne

```bash
docker-compose ps
```

Vous devriez voir :
```
fosteo_maildev   Up   0.0.0.0:1025->1025/tcp, 0.0.0.0:1080->1080/tcp
```

### Tester l'envoi d'email

Allez sur votre site et envoyez un message via le formulaire de contact. L'email apparaîtra dans MailDev à http://localhost:1080

---

## 🛑 Arrêter MailDev

```bash
docker-compose down
```

---

## 💡 Production

**Important :** MailDev est **uniquement pour le développement** !

En production :
- N'utilisez PAS MailDev
- Configurez un vrai serveur SMTP
- Les emails seront envoyés réellement

---

## 📝 Configuration PHP

PHP est configuré pour utiliser **msmtp** qui envoie les emails vers MailDev.

**Configuration automatique :**
- `sendmail_path = "/usr/bin/msmtp -t"`
- msmtp configuré dans `/etc/msmtprc`
- Serveur SMTP : maildev:1025

**Fichiers de configuration :**
- `docker/msmtprc` - Configuration msmtp

**Logs :**
```bash
# Voir les logs d'envoi
docker-compose exec web cat /tmp/msmtp.log
```

---

## 🎉 Avantages en Développement

- ✅ **Pas de spam** : Aucun email n'est envoyé réellement
- ✅ **Test illimité** : Testez autant de fois que vous voulez
- ✅ **Debug facile** : Voyez exactement ce qui est envoyé
- ✅ **Prévisualisation** : Vérifiez le rendu HTML
- ✅ **Historique** : Tous les emails restent accessibles

---

## 🔗 Liens Rapides

- **Interface MailDev :** http://localhost:1080
- **Site web :** https://localhost
- **Documentation officielle :** https://github.com/maildev/maildev
