<?php session_start(); ?>

<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="fr"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang="fr"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang="fr"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="fr"> <!--<![endif]-->
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Coline FANZUTTI - Ostéopathe à Nozay, Essonne (91620)</title>
    <meta name="description" content="Coline FANZUTTI, ostéopathe DO diplômée, vous accueille à Nozay (91620) au 15 rue des Maraîchers. Soins ostéopathiques pour tous âges, femmes enceintes, nourrissons et sportifs." />
    <meta name="keywords" content="ostéopathe, ostéopathie, Nozay, Essonne, Coline Fanzutti, nourrissons, femmes enceintes, douleurs dos, lombalgie, cervicalgie, sport, rendez-vous en ligne" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    
    <!-- Open Graph -->
    <meta property="og:type" content="website" />
    <meta property="og:url" content="https://www.fanzutti-osteopathe.com" />
    <meta property="og:title" content="Coline Fanzutti - Ostéopathe à Nozay" />
    <meta property="og:description" content="Ostéopathe diplômée à Nozay, spécialisée en ostéopathie générale, nourrissons et femmes enceintes." />
    <meta property="og:image" content="https://www.fanzutti-osteopathe.com/img/og-fb.jpg" />

    <!-- Favicons -->
    <link rel="shortcut icon" href="favicon.ico?v2" type="image/x-icon" />
    <link rel="canonical" href="https://www.fanzutti-osteopathe.com" />

    <!-- Styles -->
    <link rel="stylesheet" href="css/normalize.min.css" />
    <link rel="stylesheet" href="css/font-awesome.min.css" />
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <link rel="stylesheet" href="css/animate.min.css" />
    <link rel="stylesheet" href="css/main.css?v=6" />

    <!-- Google reCAPTCHA -->
    <script src="https://www.google.com/recaptcha/api.js?hl=fr" async defer></script>

    <!-- Modernizr -->
    <script src="js/vendor/modernizr-2.6.2.min.js" defer></script>
</head>

<body>
    <!-- Header / Navigation -->
    <?php include 'templates/slider.php'; ?>
    <?php include 'templates/navigation.html'; ?>

    <!-- Main Content -->
    <main role="main" id="main-content">
        <?php include 'templates/about.html'; ?>
        <?php include 'templates/doctolib.html'; ?>
        <?php include 'templates/osteo.html'; ?>
        <?php include 'templates/when.html'; ?>
        <?php include 'templates/seance.html'; ?>
        <?php include 'templates/address.html'; ?>
        <?php include 'templates/photos.html'; ?>
        <?php include 'templates/contact.html'; ?>
    </main>

    <!-- Footer -->
    <?php include 'templates/footer.php'; ?>

    <!-- Scripts -->
    <script src="js/vendor/jquery-1.10.2.min.js" defer></script>
    <script src="js/bootstrap.min.js" defer></script>
    <script src="js/plugins.min.js" defer></script>
    <script src="js/main.min.js" defer></script>

    <script>
        // Google Analytics (GA4 update conseillé)
        (function(i,s,o,g,r,a,m){
            i['GoogleAnalyticsObject']=r; i[r]=i[r]||function(){
                (i[r].q=i[r].q||[]).push(arguments)
            }, i[r].l=1*new Date(); a=s.createElement(o),
            m=s.getElementsByTagName(o)[0]; a.async=1; a.src=g; m.parentNode.insertBefore(a,m)
        })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

        ga('create', 'UA-72167472-1', 'auto');
        ga('send', 'pageview');

        // Facebook scraper
        fetch("https://graph.facebook.com", {
            method: "POST",
            headers: {"Content-Type": "application/x-www-form-urlencoded"},
            body: "id=http://www.fanzutti-osteopathe.com&scrape=true"
        });
    </script>
</body>
</html>
