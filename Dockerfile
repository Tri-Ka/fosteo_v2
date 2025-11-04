FROM php:8.1-apache

# Installer les extensions PHP nécessaires
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Installer msmtp pour l'envoi d'emails
RUN apt-get update && \
    apt-get install -y msmtp msmtp-mta && \
    rm -rf /var/lib/apt/lists/*

# Activer les modules Apache nécessaires
RUN a2enmod rewrite ssl

# Configurer Apache pour utiliser le répertoire courant
RUN sed -i 's!/var/www/html!/var/www/html!g' /etc/apache2/sites-available/000-default.conf
RUN sed -i 's!AllowOverride None!AllowOverride All!g' /etc/apache2/apache2.conf

# Copier les fichiers du site
COPY . /var/www/html/

# Désactiver le .htaccess de production (qui redirige vers le vrai site)
RUN if [ -f /var/www/html/.htaccess ]; then \
        mv /var/www/html/.htaccess /var/www/html/.htaccess.prod; \
    fi

# Utiliser le .htaccess pour Docker (si disponible)
RUN if [ -f /var/www/html/.htaccess.docker ]; then \
        cp /var/www/html/.htaccess.docker /var/www/html/.htaccess; \
    fi

# Définir les permissions
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html

# Créer le répertoire pour les certificats SSL
RUN mkdir -p /etc/apache2/ssl

# Copier la configuration SSL
COPY docker/apache-ssl.conf /etc/apache2/sites-available/default-ssl.conf

# Copier et configurer msmtp
COPY docker/msmtprc /etc/msmtprc
RUN chmod 644 /etc/msmtprc

# Configurer PHP pour utiliser msmtp comme sendmail
RUN echo 'sendmail_path = "/usr/bin/msmtp -t"' > /usr/local/etc/php/conf.d/mail.ini

# Exposer les ports 80 et 443
EXPOSE 80 443

# Script de démarrage pour générer le certificat et démarrer Apache
COPY docker/entrypoint.sh /entrypoint.sh
RUN chmod +x /entrypoint.sh

ENTRYPOINT ["/entrypoint.sh"]
