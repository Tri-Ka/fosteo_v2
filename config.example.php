<?php
/**
 * Configuration du site - EXEMPLE
 * 
 * Instructions :
 * 1. Copiez ce fichier et renommez-le en "config.php"
 * 2. Remplacez les valeurs par vos vraies clés
 * 3. Ne commitez JAMAIS le fichier config.php dans Git !
 */

// Configuration reCAPTCHA
// Pour obtenir vos clés : https://www.google.com/recaptcha/admin
define('RECAPTCHA_SITE_KEY', '6LeiMAITAAAAAL6ZpPTfLSY8uv2lqZZYpxfGbffZ'); // Clé publique (site key)
define('RECAPTCHA_SECRET_KEY', 'VOTRE_CLE_SECRETE_RECAPTCHA_ICI'); // Clé secrète (secret key)

// Configuration email
define('MAIL_TO', 'votre-email@example.com'); // Email de destination
define('MAIL_FROM', 'contact@votre-site.com'); // Email expéditeur
