<?php

    session_start();

    error_reporting(E_ERROR);

    $mailTo = 'fanzutti.osteo@gmail.com';
    // $mailTo = 'datcharrye@gmail.com';

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

    foreach ($values as $k => $value) {
        if (
            $k == 'name' && '' == trim($value) ||
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

    if (empty($_SESSION['err']) && !empty($values)) {
        $to = $mailTo;
        $subject = 'Message de la part de '.strip_tags($values['name']).' : '.strip_tags($values['subject']);
        $headers = 'From: '.strip_tags($values['email'])."\r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

        $message = file_get_contents('../templates/_email.html', FILE_USE_INCLUDE_PATH);

        $message = str_replace('%username%', $values['name'], $message);
        $message = str_replace('%message%', $values['message'], $message);
        $message = str_replace('%mailaddress%', $values['email'], $message);

        mail($to, $subject, $message, $headers);
        $_SESSION['success'] = 'Merci, votre message a bien été envoyé !';
        header('Location: ../index.php');
        exit;
    }
