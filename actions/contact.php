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

// Basic language heuristic so we only accept messages that look French
function isFrenchText($text)
{
    if ('' === trim($text)) {
        return false;
    }

    static $frenchCommonWords = array(
        'bonjour' => true,
        'merci' => true,
        'salut' => true,
        'bien' => true,
        'santé' => true,
        'douleur' => true,
        'pour' => true,
        'avec' => true,
        'sans' => true,
        'dans' => true,
        'chez' => true,
        'entre' => true,
        'sur' => true,
        'sous' => true,
        'avant' => true,
        'après' => true,
        'pendant' => true,
        'depuis' => true,
        'toujours' => true,
        'souvent' => true,
        'jamais' => true,
        'je' => true,
        'tu' => true,
        'il' => true,
        'elle' => true,
        'nous' => true,
        'vous' => true,
        'ils' => true,
        'elles' => true,
        'mon' => true,
        'ma' => true,
        'mes' => true,
        'notre' => true,
        'nos' => true,
        'votre' => true,
        'vos' => true,
        'leur' => true,
        'leurs' => true,
        'un' => true,
        'une' => true,
        'des' => true,
        'le' => true,
        'la' => true,
        'les' => true,
        'du' => true,
        'de' => true,
        'au' => true,
        'aux' => true,
        'ce' => true,
        'cet' => true,
        'cette' => true,
        'ces' => true,
        'quand' => true,
        'comment' => true,
        'pourquoi' => true,
        'parce' => true,
        'que' => true,
        'donc' => true,
        'car' => true,
        'mais' => true,
        'ou' => true,
        'ni' => true,
        'rdv' => true,
        'rendez' => true,
        'ostéopathe' => true,
        'osteopathe' => true,
        'consultation' => true,
        'prise' => true,
        'contact' => true,
        'souhaite' => true,
        'souhaiterais' => true,
        'souhaiterai' => true,
        'cordialement' => true,
        'madame' => true,
        'monsieur' => true,
        'bonjour,' => true,
        'merci,' => true
    );

    $words = preg_split('/[^a-zàâçéèêëîïôûùüÿœæ]+/iu', strtolower($text), -1, PREG_SPLIT_NO_EMPTY);

    if (empty($words)) {
        return false;
    }

    $frenchHits = 0;
    $analyzedWords = 0;
    $accentedWordHits = 0;

    foreach ($words as $word) {
        if (strlen($word) <= 1) {
            continue;
        }

        $analyzedWords++;

        if (isset($frenchCommonWords[$word])) {
            $frenchHits++;
        }

        if (preg_match('/[àâçéèêëîïôûùüÿœæ]/u', $word)) {
            $accentedWordHits++;
        }
    }

    if (0 === $analyzedWords) {
        return false;
    }

    $accentMatches = (int) preg_match_all('/[àâçéèêëîïôûùüÿœæ]/iu', $text);
    $frenchApostrophes = preg_match("/\b(?:l'|d'|j'|qu')/iu", $text) ? 1 : 0;
    $frenchSuffixMatches = (int) preg_match_all('/\b[a-z]+(?:tion|eux|euse|ment|ette|ique|eur|ures?|able|aire|ence|ance|ette|age)\b/iu', $text);

    $frenchIndicatorsScore = ($frenchHits * 2) + ($accentMatches) + ($frenchApostrophes * 2) + $frenchSuffixMatches + $accentedWordHits;

    if ($analyzedWords <= 3) {
        if ($frenchHits >= 1 || $accentMatches >= 1) {
            return true;
        }

        return false;
    }

    if ($frenchIndicatorsScore >= 6) {
        return true;
    }

    if ($frenchHits >= 2 && ($accentMatches >= 1 || $frenchApostrophes || $accentedWordHits >= 1)) {
        return true;
    }

    if ($accentMatches >= 3) {
        return true;
    }

    if ($frenchHits >= 3) {
        return true;
    }

    return false;
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

if (!isFrenchText($values['message'] . ' ' . $values['subject'] . ' ' . $values['name'])) {
    $_SESSION['err']['spam'] = array('err' => 'spam', 'description' => 'Langue du message non autorisée');
    header('Location: ../index.php');
    exit;
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
