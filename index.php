<?php
require_once(__DIR__.'/templates/header.php');
require_once(__DIR__.'/app/articles.php');
?>

<main class="d-flex flex-column justify-content-center">
    <div class="container my-5">
        <div class="row p-4 pb-0 pe-lg-0 pt-lg-5 align-items-center rounded-3 border shadow-lg">
            <div class="col-lg-7 p-3 p-lg-5 pt-lg-3">
                <h1 class="display-4 fw-bold lh-1 text-body-emphasis">EcoSylVest</h1>
                <p class="lead">
                    Découvrez et explorez EcoSylvestre, votre ressource en ligne la plus fiable dédiée à la nature, la faune et la flore. Plongez dans
                    notre contenu riche en informations, mettant en avant des astuces pratiques d'entretien et d'utilisation durable de la nature. Nous vous proposons
                    des articles détaillés, des guides illustrés et des conseils d'experts pour vous aider à comprendre et à préserver notre monde naturel. Joignez-vous
                    à nous pour un voyage d'apprentissage fascinant dans le royaume de la nature, où chaque article vous rapproche un peu plus des secrets sylvestres.
                </p>
                <div class="d-grid gap-2 d-md-flex justify-content-md-start mb-4 mb-lg-3">
                    <button type="button" class="btn btn-primary btn-lg px-4 me-md-2 fw-bold">Lire l'article</button>
                    <button type="button" class="btn btn-outline-secondary btn-lg px-4">Default</button>
                </div>
            </div>
            <div class="col-lg-4 offset-lg-1 p-0 overflow-hidden shadow-lg d-flex justify-content-center">
                <img class="rounded-lg-3" src="assets/images/logo" alt="forêt" width="720">
            </div>
        </div>
    </div>

    <div class="container my-3 d-flex justify-content-center">
        <div class="row text-center justify-content-around">
            <?php foreach ($articles as $key => $article) { ?>
                <div class="col-md-4 my-2">
                    <div class="card h-100">
                        <img src="/uploads/articles/<?= $article['image'] ?>" class="card-img-top" alt="<?= $article['title'] ?>">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title"><?= $article['title'] ?></h5>
                            <p class="card-text flex-grow-1">
                                <?= $article['content'] ?>
                            </p>
                            <a href="#" class="btn btn-primary mt-3">Lire plus...</a>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>

</main>

<?php require_once('templates/footer.php') ?>