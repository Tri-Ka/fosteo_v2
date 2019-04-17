<?php session_start(); ?>

<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="fr"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang="fr"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang="fr"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="fr"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Coline FANZUTTI - Ostéopathe</title>
        <meta name="description" content="Coline FANZUTTI, Ostéopathe DO à Nozay - 91620, 15 rue des Maraîchers. Ostéopathie générale, nourrissons et femmes enceintes. Consultations en cabinet ou à domicile. Rendez-vous en ligne">
        <meta name="keywords" content="ostéopathe, ostéopathie, nozay, 91, essonne, orsay, evry, massy, marcoussis, villejust, les ulis, la ville-du-bois, ballainvilliers, saulx-les-chartreux, montlhéry, villiers-sur-orge, douleur, dos, cou, lombalgie, cervicalgie, céphalée, nourrisson, bébé, enceinte, grossesse, sport, rendez-vous en ligne">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0" />
        <meta property="og:url"                content="http://www.fanzutti-osteopathe.com"/>
        <meta property="og:title"              content="Coline Fanzutti - Ostéopathe" />
        <meta property="og:description"        content="Bienvenue sur le site de Coline FANZUTTI, Ostéopathe à Nozay - 91620, 15 rue des Maraîchers" />
        <meta property="og:image"              content="http://www.fanzutti-osteopathe.com/img/og-fb.jpg" />
        <link rel="stylesheet" href="css/normalize.css">
        <link rel="stylesheet" href="css/font-awesome.min.css">
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/animate.css">
        <link rel="stylesheet" href="css/main.css?v=4">
        <link rel="shortcut icon" href="favicon.ico?v2">
        <script src='https://www.google.com/recaptcha/api.js?hl=fr'></script>
    </head>
    <body>
        <!--[if lt IE 7]>
            <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->

        <?php include 'templates/slider.php'; ?>
        <?php include 'templates/navigation.html'; ?>
        <?php include 'templates/about.html'; ?>
        <?php include 'templates/doctolib.html'; ?>
        <?php include 'templates/osteo.html'; ?>
        <?php include 'templates/when.html'; ?>
        <?php include 'templates/seance.html'; ?>
        <?php include 'templates/address.html'; ?>
        <?php include 'templates/photos.html'; ?>
        <?php include 'templates/contact.html'; ?>
        <?php include 'templates/footer.php'; ?>

        <script src="js/vendor/modernizr-2.6.2.min.js"></script>
        <script src="js/vendor/jquery-1.10.2.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/plugins.js"></script>
        <script src="js/main.js"></script>

        <script>
            (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
            (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
            m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
            })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

            ga('create', 'UA-72167472-1', 'auto');
            ga('send', 'pageview');

            var fbxhr = new XMLHttpRequest();
            fbxhr.open("POST", "https://graph.facebook.com", true);
            fbxhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            fbxhr.send("id=http://www.fanzutti-osteopathe.com&scrape=true");
        </script>
    </body>
</html>
