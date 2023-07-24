<?php
require_once(__DIR__.'/db/config.php');
require_once(__DIR__.'/db/pdo.php');
require_once(__DIR__.'/app/mainMenu.php');
require_once(__DIR__.'/templates/header.php');
require_once(__DIR__.'/app/latestNews.php');
require_once(__DIR__.'/app/themeSelections.php');
require_once(__DIR__.'/app/reportages.php');
?>

<div id="myCarousel" class="carousel slide mb-6 pointer-event my-5" data-bs-ride="carousel" data-bs-theme="light">
    <div class="carousel-indicators">
        <?php foreach ($latestNews as $key => $latestNew) { ?>
            <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="<?= $key ?>" class="<?= $key == 0 ? 'active' : '' ?>" aria-label="Slide <?= $key + 1 ?>"></button>
        <?php } ?>
    </div>
    <div class="carousel-inner">
        <?php foreach ($latestNews as $key => $latestNew) { ?>
            <div class="carousel-item <?= $key == 0 ? 'active' : '' ?>">
                <div class="bd-placeholder-img" style="background-image: url('/uploads/latestNews/<?= $latestNew['image'] ?>'); opacity:0.5; width: 100%; height: 500px; background-size: cover; background-position: center center;">
                </div>
                <div class="container">
                    <div class="carousel-caption text-start">
                        <h1><?= $latestNew['title'] ?></h1>
                        <p style="color: #2A3C24"><?= $latestNew['content'] ?></p>
                        <p><a class="btn btn-lg btn-primary" href="/templates/signup.php">M'inscrire</a></p>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#myCarousel" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#myCarousel" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>


<div class="container marketing">


    <div class="row">
        <?php foreach ($themeSelections as $key => $themeSelection) { ?>
            <div class="col-lg-4">
                <a href="/themes/<?= $key ?>" class="d-flex flex-column align-items-center link-body-emphasis text-decoration-none">
                    <img class="bd-placeholder-img rounded-circle cover-img" width="170" height="170" src="/assets/images/<?= $themeSelection['image'] ?>" alt="<?= $themeSelection['title'] ?>">
                    <h2 class="fw-normal"><?= $themeSelection['title'] ?></h2>
                </a>
            </div>
        <?php } ?>
    </div>

    <?php foreach ($reportages as $key => $reportage) { ?>
        <hr class="featurette-divider">

        <div class="row featurette">
            <?php if ($key % 2 == 0) { ?>
                <div class="col-md-7 d-flex flex-column align-items-center justify-content-center">
                    <h2 class="featurette-heading fw-normal lh-1"><?= $reportage['title'] ?><span class="text-body-secondary"><?= $reportage['subtitle'] ?></span></h2>
                    <p class="lead my-5">
                        <?= $reportage['content'] ?>
                    </p>
                </div>
                <div class="col-md-5">
                    <img class="bd-placeholder-img bd-placeholder-img-lg featurette-image img-fluid mx-auto" src="/uploads/reportages/<?= $reportage['image'] ?>" alt="Image de la faune">
                </div>
            <?php } else { ?>
                <div class="col-md-5">
                    <img class="bd-placeholder-img bd-placeholder-img-lg featurette-image img-fluid mx-auto" src="/uploads/reportages/<?= $reportage['image'] ?>" alt="Image de la faune">
                </div>
                <div class="col-md-7 d-flex flex-column align-items-center justify-content-center">
                    <h2 class="featurette-heading fw-normal lh-1"><?= $reportage['title'] ?><span class="text-body-secondary"><?= $reportage['subtitle'] ?></span></h2>
                    <p class="lead my-5">
                        <?= $reportage['content'] ?>
                    </p>
                </div>
            <?php } ?>
        </div>
    <?php } ?>


</div>

<?php require_once('templates/footer.php') ?>