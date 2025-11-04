# 🛡️ Configuration Anti-Spam

## ⚡ Configuration Rapide

### 1. Créer le fichier de configuration

```bash
cp config.example.php config.php
```

### 2. Obtenir votre clé secrète Google reCAPTCHA

1. Allez sur : https://www.google.com/recaptcha/admin
2. Connectez-vous avec votre compte Google
3. Trouvez votre site
4. **Copiez la "Clé secrète"** (Secret Key)

### 3. Configurer config.php

Ouvrez `config.php` et remplacez :

```php
define('RECAPTCHA_SECRET_KEY', 'VOTRE_CLE_SECRETE_GOOGLE_RECAPTCHA_ICI');
```

Par votre vraie clé secrète.

### 4. Vérifier les emails

```php
define('MAIL_TO', 'fanzutti.osteo@gmail.com');
define('MAIL_FROM', 'contact@fanzutti-osteopathe.com');
```

### 5. Tester

Testez le formulaire de contact sur votre site.

---

## ✅ Protections Incluses

- ✅ Validation reCAPTCHA côté serveur
- ✅ Honeypot (champ caché)
- ✅ Détection de soumissions rapides
- ✅ Filtrage de mots-clés spam
- ✅ Limitation des liens
- ✅ Validation de longueur

---

## 🔧 Vérification (Optionnel)

Uploadez `check_config.php` sur votre serveur et ouvrez-le dans votre navigateur.

**⚠️ Supprimez-le après vérification !**

---

## 📚 Plus d'Infos

Voir [ANTI_SPAM_README.md](ANTI_SPAM_README.md) pour la documentation technique complète.
