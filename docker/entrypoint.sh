#!/bin/bash
set -e

# Générer un certificat SSL auto-signé si il n'existe pas
if [ ! -f /etc/apache2/ssl/perso.fosteo.crt ]; then
    echo "🔐 Génération du certificat SSL auto-signé..."
    
    openssl req -x509 -nodes -days 365 -newkey rsa:2048 \
        -keyout /etc/apache2/ssl/perso.fosteo.key \
        -out /etc/apache2/ssl/perso.fosteo.crt \
        -subj "/C=FR/ST=Essonne/L=Nozay/O=Fosteo/CN=perso.fosteo"
    
    echo "✅ Certificat SSL généré"
fi

# Activer le site SSL
a2ensite default-ssl

# Démarrer Apache
echo "🚀 Démarrage d'Apache avec SSL..."
apache2-foreground
