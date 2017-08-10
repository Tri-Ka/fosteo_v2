<?php
    error_reporting(E_ERROR);

    $mailTo = 'fanzutti.osteo@gmail.com';

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

    $message = '<html><body>';
    $message .= '<table style="border: 1px solid #ddd; width: 500px; margin: 100px; box-shadow: 0px 0px 25px rgba(90, 90, 90, 0.3);">';
    $message .= '<tr style="background: #3c4755; color: #e9e9e9; font-size: 20px;">';
    $message .= '<td style="padding: 15px;">Nouveau message de la part de : <strong>'.$values['name'].'</strong></td>';
    $message .= '</tr><tr>';
    $message .= '<td style="padding: 30px; color: #333">'.nl2br(strip_tags($values['message'])).'</td>';
    $message .= '</tr><tr>';
    $message .= '<tr style="background: #3c4755; color: #e9e9e9;">';
    $message .= '<td style="padding: 15px;">Son adresse mail: <strong style="color: #e46948 !important">'.$values['email'].'</strong></td>';
    $message .= '</tr>';
    $message .= '</table>';
    $message .= '</body></html>';

    mail($to, $subject, $message, $headers);

    $_SESSION['success'] = 'Merci, votre message a bien été envoyé';
    header('Location: ../index.php');
}

?>

<section id="contact" class="page-section">
    <div class="container">
        <div class="row page-heading">
            <div class="col-md-8 col-sm-8">
                <h3 class="page-title">Me contacter</h3>
                <p class="page-subtitle">Pour toutes questions ou demande de rendez-vous</p>
            </div>
            <div class="col-md-4 col-sm-4 hidden-xs text-right">
                <p class="page-icon"><i class="fa fa-envelope"></i></p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-9 col-sm-12">
                <div class="row">
                    <form action="index.php#contact" method="post" class="contact-form">
                        <fieldset class="col-md-4 col-sm-6 col-xs-12">
                            <input type="text" id="name" name="name" placeholder="Votre nom" required>
                        </fieldset>
                        <fieldset class="col-md-4 col-sm-6 col-xs-12">
                            <input type="email" id="email" name="email" placeholder="Votre adresse e-mail" required>
                        </fieldset>
                        <fieldset class="col-md-4 col-sm-12 col-xs-12">
                            <input type="text" id="subject" name="subject" placeholder="Le sujet de votre message" required>
                        </fieldset>
                        <fieldset class="col-md-12 col-sm-12 col-xs-12">
                            <textarea name="message" id="message" cols="30" rows="6" placeholder="Votre message" required></textarea>
                        </fieldset>
                        <fieldset class="col-md-12 col-sm-12 col-xs-12">
                            <input type="submit" class="button default" value="Envoyer">
                        </fieldset>
                    </form>
                </div>
            </div>
            <div class="col-md-3 col-sm-12">
                <div class="contact-info">
                    <ul class="social-icons">
                        <li><h4><a href="tel:0687358180" class="fa fa-phone"></a> 06 87 35 81 80</h4></li>
                        <li><a href="mailto:fanzutti.osteo@gmail.com" class="fa fa-envelope"></a> fanzutti.osteo@gmail.com</li>
                        <li><a href="https://www.linkedin.com/in/coline-fanzutti-07a172103" class="fa fa-linkedin"></a> Accéder à mon Linkedin</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
