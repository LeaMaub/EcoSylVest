<?php 
require_once('/templates/header.php'); 
require_once('/app/articles.php')
?>

<div id="myCarousel" class="carousel slide mb-6 pointer-event my-5" data-bs-ride="carousel" data-bs-theme="light">
    <div class="carousel-indicators">
        <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="0" class="" aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="1" aria-label="Slide 2" class=""></button>
        <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="2" aria-label="Slide 3" class="active" aria-current="true"></button>
    </div>
    <div class="carousel-inner">
        <div class="carousel-item">
            <div class="bd-placeholder-img" style="background-image: url('/assets/images/carousel1.jpg'); opacity:0.5; width: 100%; height: 500px; background-size: cover; background-position: center center;">
            </div>
            <div class="container">
                <div class="carousel-caption text-start">
                    <h1>Les Tortues Marines</h1>
                    <p style="color: #2A3C24">Explorez la vie incroyable des tortues marines en profondeur.</p>
                    <p><a class="btn btn-lg btn-primary" href="/templates/signup.php">M'inscrire</a></p>
                </div>
            </div>
        </div>
        <div class="carousel-item">
            <div class="bd-placeholder-img" style="background-image: url('/assets/images/carousel2.jpg'); opacity:0.5; width: 100%; height: 500px; background-size: cover; background-position: center center;">
            </div>
            <div class="container">
                <div class="carousel-caption">
                    <h1>Les Lavandes de Valensole</h1>
                    <p style="color: #2A3C24">Découvrez les champs de lavande éblouissants de Valensole.</p>
                    <p><a class="btn btn-lg btn-primary" href="/templates/signup.php">M'inscrire</a></p>
                </div>
            </div>
        </div>
        <div class="carousel-item active">
            <div class="bd-placeholder-img" style="background-image: url('/assets/images/carousel3.jpg'); opacity:0.5; width: 100%; height: 500px; background-size: cover; background-position: center center;">
            </div>
            <div class="container">
                <div class="carousel-caption text-end">
                    <h1>Remèdes Homéopathiques : Guérison Naturelle</h1>
                    <p style="color: #2A3C24">Découvrez comment l'homéopathie peut améliorer votre bien-être quotidien.</p>
                    <p><a class="btn btn-lg btn-primary" href="/templates/signup.php">M'inscrire</a></p>
                </div>
            </div>
        </div>
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
        <div class="col-lg-4">
            <a href="#" class="d-flex flex-column align-items-center link-body-emphasis text-decoration-none">
                <img class="bd-placeholder-img rounded-circle cover-img" width="170" height="170" src="/assets/images/faune.jpg" alt="">
                <h2 class="fw-normal">Faune</h2>
            </a>
        </div>
        <div class="col-lg-4">
            <a href="#" class="d-flex flex-column align-items-center link-body-emphasis text-decoration-none">
                <img class="bd-placeholder-img rounded-circle cover-img" width="170" height="170" src="/assets/images/flore.jpg" alt="">
                <h2 class="fw-normal">Flore</h2>
            </a>
        </div>
        <div class="col-lg-4">
            <a href="#" class="d-flex flex-column align-items-center link-body-emphasis text-decoration-none">
                <img class="bd-placeholder-img rounded-circle cover-img" width="170" height="170" src="/assets/images/astuces.jpg" alt="">
                <h2 class="fw-normal">Astuces</h2>
            </a>
        </div>
    </div>

    <hr class="featurette-divider">

    <div class="row featurette">
        <div class="col-md-7 d-flex flex-column align-items-center justify-content-center">
            <h2 class="featurette-heading fw-normal lh-1">Le Règne Animal : Un Monde Fascinant<span class="text-body-secondary"> L'émerveillement à chaque coin de la forêt.</span></h2>
            <p class="lead my-5">
                Découvrez la diversité incroyable du règne animal, depuis les insectes jusqu'aux mammifères les plus majestueux. Que ce soit le chant mélodieux d'un
                oiseau ou le rugissement puissant d'un lion, chaque animal a sa place unique dans l'écosystème. Explorez avec nous les merveilles de la faune et comprenez
                pourquoi la préservation de ces espèces est vitale.
            </p>
        </div>
        <div class="col-md-5">
            <img class="bd-placeholder-img bd-placeholder-img-lg featurette-image img-fluid mx-auto" src="/assets/images/featurette1.jpg" alt="Image de la faune">
        </div>
    </div>

    <hr class="featurette-divider">

    <div class="row featurette">
        <div class="col-md-7 order-md-2 d-flex flex-column align-items-center justify-content-center">
            <h2 class="featurette-heading fw-normal lh-1">La Flore : Beauté et Bienfaits <span class="text-body-secondary">Un havre de paix.</span></h2>
            <p class="lead my-5">
                La flore joue un rôle crucial dans notre écosystème et notre santé. Les plantes purifient l'air que nous respirons, fournissent la nourriture que nous
                mangeons et constituent un habitat pour de nombreuses espèces. De plus, elles possèdent des propriétés curatives utilisées dans la médecine. Apprenez à
                connaître les plantes et leurs nombreux bienfaits pour nous et notre planète.
            </p>
        </div>
        <div class="col-md-5 order-md-1">
            <img class="bd-placeholder-img bd-placeholder-img-lg featurette-image img-fluid mx-auto" src="/assets/images/featurette2.jpg" alt="Image de la flore">
        </div>
    </div>

    <hr class="featurette-divider">

    <div class="row featurette">
        <div class="col-md-7 d-flex flex-column align-items-center justify-content-center">
            <h2 class="featurette-heading fw-normal lh-1">L'Homéopathie : Une Médecine Douce <span class="text-body-secondary">Soin naturel et holistique.</span></h2>
            <p class="lead my-5">
                L'homéopathie est une approche de guérison douce qui traite la personne dans sa globalité. Basée sur le principe de "simila similibus curentur" - "ce
                qui ressemble guérit ce qui ressemble" - elle utilise des remèdes naturels pour stimuler le système de défense de l'organisme. Explorez comment cette
                médecine douce peut améliorer votre bien-être et vous aider à maintenir un équilibre sain.
            </p>
        </div>
        <div class="col-md-5">
            <img class="bd-placeholder-img bd-placeholder-img-lg featurette-image img-fluid mx-auto" src="/assets/images/featurette3.jpg" alt="Image de l'homéopathie">
        </div>
    </div>

    <hr class="featurette-divider">

</div>

<?php require_once('templates/footer.php') ?>