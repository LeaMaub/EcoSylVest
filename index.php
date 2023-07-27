<?php
require_once(__DIR__ . '/templates/header.php');
require_once(__DIR__ . '/db/pdo.php');
require_once(__DIR__ . '/app/presentation.php');
require_once(__DIR__ . '/app/articles.php');
require_once(__DIR__ . '/app/mainMenu.php');

$presentation = getPresentation($pdo);

$fauneArticle = getOneArticle($pdo, 'Faune');
$floreArticle = getOneArticle($pdo, 'Flore');
$astucesArticle = getOneArticle($pdo, 'Astuces');

$oneArticle = [$fauneArticle, $floreArticle, $astucesArticle];
?>

<main class="d-flex flex-column justify-content-center">
    <div class="container my-5">
        <div class="row p-4 pb-0 pe-lg-0 pt-lg-5 align-items-center rounded-3 border shadow-lg">
            <div class="col-lg-7 p-3 p-lg-5 pt-lg-3">
                <h1 class="display-4 fw-bold lh-1 text-body-emphasis"><?= $presentation['title'] ?></h1>
                <p class="lead">
                    <?= $presentation['content'] ?>
                </p>
            </div>
            <div class="col-lg-4 offset-lg-1 p-0 overflow-hidden shadow-lg d-flex justify-content-center">
                <img class="rounded-lg-3" src="assets/images/<?= $presentation['image'] ?>" alt="<?= $presentation['title'] ?>" width="720">
            </div>
        </div>
    </div>

    <div class="container my-3 d-flex justify-content-center">
        <div class="row text-center justify-content-around">
            <?php foreach ($oneArticle as $key => $article) { ?>
                <div class="col-md-4 my-2">
                    <div class="card h-100">
                        <img src="/uploads/articles/<?= htmlentities($article['image']) ?>" class="card-img-top" alt="<?= htmlentities($article['title']) ?>">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title"><?= htmlentities($article['title']) ?></h5>
                            <p class="card-text flex-grow-1">
                                <?= htmlentities($article['content']) ?>
                            </p>
                            <a href="/resources/article.php?id=<?= $article['ID'] ?>" class="btn btn-primary mt-3">Lire plus...</a>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>

</main>

<?php require_once('templates/footer.php') ?>