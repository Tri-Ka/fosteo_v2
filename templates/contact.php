<section id="contact" class="page-section">
    <div class="container">
        <div class="text-center marged-bottom--big">
            <a href="https://www.doctolib.fr/osteopathe/evry/coline-fanzutti" 
               class="button default" target="_blank" rel="noopener" 
               title="Prendre rendez-vous en ligne avec Coline Fanzutti, ostéopathe à Nozay">
                <strong>Prendre rendez-vous en ligne</strong>
            </a>
        </div>

        <div class="row page-heading">
            <div class="col-md-8 col-sm-8">
                <h2 class="page-title">Me contacter</h2>
                <p>Vous avez des questions ou souhaitez prendre un rendez-vous ? N’hésitez pas à me contacter, je vous répondrai rapidement avec plaisir.</p>
            </div>
            <div class="col-md-4 col-sm-4 hidden-xs text-right" aria-hidden="true">
                <p class="page-icon"><i class="fa fa-envelope" aria-hidden="true"></i></p>
            </div>
        </div>

        <div class="row">
            <div class="col-md-9 col-sm-12">
                <form action="actions/contact.php" method="post" class="row contact-form" aria-label="Formulaire de contact ostéopathe">
                    <!-- Champ honeypot (piège à bots) - invisible pour les humains -->
                    <input type="text" name="website" style="display:none;" tabindex="-1" autocomplete="off">
                    
                    <!-- Timestamp pour détecter les soumissions trop rapides -->
                    <input type="hidden" name="form_timestamp" value="<?php echo time(); ?>">
                    
                    <fieldset class="col-sm-6 col-xs-12">
                        <label for="name" class="sr-only">Votre nom</label>
                        <input type="text" id="name" name="name" placeholder="Votre nom complet" required>
                    </fieldset>
                    <fieldset class="col-sm-6 col-xs-12">
                        <label for="email" class="sr-only">Votre adresse e-mail</label>
                        <input type="email" id="email" name="email" placeholder="Votre adresse e-mail" required>
                    </fieldset>
                    <fieldset class="col-xs-12">
                        <label for="subject" class="sr-only">Sujet du message</label>
                        <input type="text" id="subject" name="subject" placeholder="Objet de votre message" required>
                    </fieldset>
                    <fieldset class="col-xs-12">
                        <label for="message" class="sr-only">Votre message</label>
                        <textarea name="message" id="message" cols="30" rows="6" placeholder="Votre message" required></textarea>
                    </fieldset>
                    <fieldset class="col-xs-12">
                        <div class="g-recaptcha marged-bottom" data-sitekey="6LeiMAITAAAAAL6ZpPTfLSY8uv2lqZZYpxfGbffZ"></div>
                    </fieldset>
                    <fieldset class="col-xs-12">
                        <input type="submit" class="button default" value="Envoyer">
                    </fieldset>
                </form>
            </div>
            

            <div class="col-md-3 col-sm-12">
                <aside class="contact-info" aria-label="Informations de contact">
                    <ul class="social-icons">
                        <li><h4><a href="tel:0687358180" class="fa fa-phone"  title="Téléphone - appeler Coline Fanzutti"></a> 06 87 35 81 80</h4></li>
                        <li><a href="mailto:fanzutti.osteo@gmail.com" title="Envoyer un email à Coline Fanzutti" class="fa fa-envelope"></a> fanzutti.osteo@gmail.com</li>
                    </ul>
                </aside>
            </div>
        </div>
    </div>
</section>
