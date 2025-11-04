# 🔐 HTTPS avec Certificat Auto-Signé

## ⚠️ Avertissement de Sécurité

Lorsque vous accédez à **https://perso.fosteo**, votre navigateur affichera un avertissement car le certificat SSL est **auto-signé** (non validé par une autorité de certification).

**C'est normal et attendu pour le développement local !**

---

## 🌐 Comment Accepter le Certificat

### Chrome / Edge / Brave

1. Vous verrez : "Votre connexion n'est pas privée"
2. Cliquez sur **"Avancé"**
3. Cliquez sur **"Continuer vers perso.fosteo (dangereux)"**
4. ✅ Le site s'affiche !

### Firefox

1. Vous verrez : "Avertissement : risque probable de sécurité"
2. Cliquez sur **"Avancé..."**
3. Cliquez sur **"Accepter le risque et continuer"**
4. ✅ Le site s'affiche !

### Safari

1. Cliquez sur **"Afficher les détails"**
2. Cliquez sur **"Visiter ce site web"**
3. Confirmez avec **"Visiter"**
4. ✅ Le site s'affiche !

---

## 🔒 Pourquoi Cet Avertissement ?

Le conteneur Docker génère automatiquement un **certificat SSL auto-signé** à chaque démarrage. Ce certificat :

✅ **Active HTTPS** (connexion chiffrée)
✅ **Parfait pour le développement local**
❌ **Non validé par une autorité reconnue** (Let's Encrypt, DigiCert, etc.)

Pour la **production**, vous devez utiliser un **vrai certificat SSL** (gratuit avec Let's Encrypt).

---

## 🎯 Pour Éviter l'Avertissement (Optionnel)

### Option 1 : Ajouter le Certificat aux Certificats de Confiance

**Linux :**
```bash
# Extraire le certificat du conteneur
docker cp fosteo_web:/etc/apache2/ssl/perso.fosteo.crt /tmp/

# Ajouter aux certificats de confiance (Ubuntu/Debian)
sudo cp /tmp/perso.fosteo.crt /usr/local/share/ca-certificates/
sudo update-ca-certificates

# Redémarrer le navigateur
```

**Windows :**
1. Extraire le certificat : `docker cp fosteo_web:/etc/apache2/ssl/perso.fosteo.crt C:\temp\`
2. Double-cliquer sur le fichier `.crt`
3. Cliquer sur "Installer le certificat..."
4. Choisir "Ordinateur local"
5. Sélectionner "Placer tous les certificats dans le magasin suivant"
6. Choisir "Autorités de certification racines de confiance"
7. Terminer et redémarrer le navigateur

**macOS :**
```bash
# Extraire le certificat
docker cp fosteo_web:/etc/apache2/ssl/perso.fosteo.crt ~/Desktop/

# Ouvrir Trousseau d'accès et importer le certificat
# Marquer comme "Toujours faire confiance"
```

### Option 2 : Utiliser mkcert (Recommandé pour le Dev)

**mkcert** génère des certificats locaux reconnus automatiquement :

```bash
# Installer mkcert
# Ubuntu/Debian
sudo apt install mkcert

# macOS
brew install mkcert

# Initialiser mkcert
mkcert -install

# Générer le certificat pour perso.fosteo
cd /home/etienne/projects/fosteo_v2
mkdir -p docker/ssl
mkcert -key-file docker/ssl/perso.fosteo.key -cert-file docker/ssl/perso.fosteo.crt perso.fosteo

# Modifier docker/entrypoint.sh pour utiliser ces certificats
```

Puis dans `docker/entrypoint.sh`, remplacez la génération par :
```bash
# Copier les certificats mkcert
cp /var/www/html/docker/ssl/perso.fosteo.crt /etc/apache2/ssl/
cp /var/www/html/docker/ssl/perso.fosteo.key /etc/apache2/ssl/
```

---

## 📌 Résumé

**Pour le développement :**
- ✅ Acceptez simplement l'avertissement du navigateur
- ⏱️ Prend 5 secondes à chaque première visite

**Pour éviter l'avertissement :**
- 🔧 Utilisez **mkcert** (solution propre)
- 🔐 Ou ajoutez manuellement le certificat aux certificats de confiance

**Pour la production :**
- 🌍 Utilisez **Let's Encrypt** (certificat SSL gratuit et reconnu)
