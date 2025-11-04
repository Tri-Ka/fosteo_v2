<?php

    session_start();
    
    // Charger la configuration
    require_once(__DIR__ . '/../config.php');

    error_reporting(E_ERROR);

    $mailTo = MAIL_TO;
    $mailFrom = MAIL_FROM;

if (!function_exists('filter_var')) {
    define('FILTER_VALIDATE_EMAIL', 'email');

    function filter_var($value, $filter)
    {
        switch ($filter) {
            case FILTER_VALIDATE_EMAIL:
                if (preg_match("/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/", $value)) {
                    return true;
                } else {
                    return false;
                }

                break;
        }
    }
}

    $values = $_POST;
    $mailSent = false;
    $_SESSION['err'] = array();
    $getArray = '';

// Protection honeypot : si le champ caché est rempli, c'est un bot
if (!empty($values['website'])) {
    $_SESSION['err']['spam'] = array('err' => 'spam', 'description' => 'Bot détecté');
    header('Location: ../index.php');
    exit;
}

// Protection contre l'envoi trop rapide (honeypot temporel)
if (isset($values['form_timestamp'])) {
    $formTimestamp = intval($values['form_timestamp']);
    $currentTime = time();
    $timeDiff = $currentTime - $formTimestamp;
    
    // Si le formulaire est soumis en moins de 3 secondes, c'est probablement un bot
    if ($timeDiff < 3) {
        $_SESSION['err']['spam'] = array('err' => 'spam', 'description' => 'Soumission trop rapide');
        header('Location: ../index.php');
        exit;
    }
}

// Validation reCAPTCHA côté serveur
if (empty($values['g-recaptcha-response'])) {
    $_SESSION['err']['captcha'] = array('err' => 'captcha', 'description' => 'Captcha manquant');
    header('Location: ../index.php');
    exit;
}

// Vérification auprès de Google
$recaptchaSecret = RECAPTCHA_SECRET_KEY;
$recaptchaResponse = $values['g-recaptcha-response'];
$remoteIp = $_SERVER['REMOTE_ADDR'];

$verifyURL = 'https://www.google.com/recaptcha/api/siteverify';
$postData = http_build_query([
    'secret' => $recaptchaSecret,
    'response' => $recaptchaResponse,
    'remoteip' => $remoteIp
]);

$opts = [
    'http' => [
        'method' => 'POST',
        'header' => 'Content-Type: application/x-www-form-urlencoded',
        'content' => $postData
    ]
];

$context = stream_context_create($opts);
$response = file_get_contents($verifyURL, false, $context);
$responseData = json_decode($response);

// Pour reCAPTCHA v2, on vérifie seulement le succès
// Pour reCAPTCHA v3, on pourrait aussi vérifier le score
if (!$responseData->success) {
    $_SESSION['err']['captcha'] = array('err' => 'captcha', 'description' => 'Validation du captcha échouée');
    header('Location: ../index.php');
    exit;
}

foreach ($values as $k => $value) {
    if ($k == 'name' && '' == trim($value) ||
        $k == 'email' && '' == trim($value) ||
        $k == 'subject' && '' == trim($value) ||
        $k == 'message' && '' == trim($value)
    ) {
        $_SESSION['err'][$k] = 'empty field: '.$k;
    }

    if ($k == 'email') {
        if (!filter_var(trim($value), FILTER_VALIDATE_EMAIL)) {
            $_SESSION['err']['mail'] = array('err' => 'mail', 'description' => 'invalid e-mail: '.$value);
        }
    }
}

// Protection anti-spam : vérification de mots-clés suspects
$spamKeywords = ['viagra', 'cialis', 'casino', 'forex', 'bitcoin', 'crypto', 'loan', 'SEO', 'backlink', 'porn', 'xxx'];
$messageContent = strtolower($values['message'] . ' ' . $values['subject'] . ' ' . $values['name']);

foreach ($spamKeywords as $keyword) {
    if (strpos($messageContent, strtolower($keyword)) !== false) {
        $_SESSION['err']['spam'] = array('err' => 'spam', 'description' => 'Contenu suspect détecté');
        header('Location: ../index.php');
        exit;
    }
}

// Protection anti-spam : vérification de liens suspects
if (preg_match('/<a\s+href|http:\/\/|https:\/\/|www\./i', $values['message'])) {
    $linkCount = preg_match_all('/<a\s+href|http:\/\/|https:\/\/|www\./i', $values['message']);
    if ($linkCount > 2) {
        $_SESSION['err']['spam'] = array('err' => 'spam', 'description' => 'Trop de liens détectés');
        header('Location: ../index.php');
        exit;
    }
}

// Protection anti-spam : longueur du message
if (strlen($values['message']) > 5000 || strlen($values['message']) < 10) {
    $_SESSION['err']['spam'] = array('err' => 'spam', 'description' => 'Longueur du message invalide');
    header('Location: ../index.php');
    exit;
}

if (empty($_SESSION['err']) && !empty($values)) {
    $to = $mailTo;
    
    // Encoder le sujet en UTF-8 pour supporter les accents
    $subject = '=?UTF-8?B?'.base64_encode('Message de la part de '.strip_tags($values['name']).' : '.strip_tags($values['subject'])).'?=';
    
    $headers = 'From: '.strip_tags($mailFrom)."\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=UTF-8\r\n";

    $message = file_get_contents('../templates/_email.html', FILE_USE_INCLUDE_PATH);

    // Convertir les sauts de ligne en <br> pour l'affichage HTML
    $messageContent = nl2br(htmlspecialchars($values['message'], ENT_QUOTES, 'UTF-8'));
    
    $message = str_replace('%username%', htmlspecialchars($values['name'], ENT_QUOTES, 'UTF-8'), $message);
    $message = str_replace('%message%', $messageContent, $message);
    $message = str_replace('%mailaddress%', htmlspecialchars($values['email'], ENT_QUOTES, 'UTF-8'), $message);

    mail($to, $subject, $message, $headers);
    $_SESSION['success'] = 'Merci, votre message a bien été envoyé !';
    header('Location: ../index.php');
    exit;
}
