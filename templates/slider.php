<div id="home" class="carousel slide carousel-fade" data-ride="carousel">
    <?php include 'actions/flash.php'; ?>

    <div class="hidden">
        <?php for ($i = 1; $i < 10; $i++) : ?>
            <img src="img/fonds/<?php echo $i; ?>.jpg" alt="fond-<?php echo $i; ?>">
        <?php endfor; ?>
    </div>

    <div class="carousel-inner">
        <div class="item active">
            <div class="item-slide item-<?php echo rand(1, 9); ?>"></div>
            <div class="carousel-caption">
                <div class="container">
                    <div class="col-md-offset-2 col-md-8 col-sm-12" id="logo-container" data-scroll-top>
                        <img class="animated fadeInDown" src="img/logo-2.png" alt="logo" title="logo">
                        <h1 class="animated fadeInUp">Coline <span class="accent">FANZUTTI</span></h1>
                        <h2 class="animated fadeInUp">OSTÉOPATHE</h2>
                    </div>
                </div>
            </div>
            <div class="cache"></div>
        </div>
    </div>
</div>
