<?php
require_once(__DIR__.'/../db/config.php');
require_once(__DIR__.'/../db/pdo.php');
require_once(__DIR__ . '/../templates/header.php');
require_once(__DIR__ . '/../app/articles.php');

$categoryArticles = getCategoryArticles($pdo, 'Astuces');
?>
<main class="container-fluid">
    <div class="position-relative overflow-hidden p-3 p-md-5 m-md-3 text-center bg-body-tertiary">
        <div class="col-md-6 p-lg-5 mx-auto my-5">
            <h1 class="display-3 fw-bold">Nos astuces</h1>
            <div class="d-flex gap-3 justify-content-center lead fw-normal">
            </div>
        </div>
        <div class="product-device shadow-sm d-none d-md-block"></div>
        <div class="product-device product-device-2 shadow-sm d-none d-md-block"></div>
    </div>

    <div class="row justify-content-center">
        <?php foreach ($categoryArticles as $key => $article) { ?>
            <div class="col-md-6">
                <?php $isEven = (($key / 2 % 2 == 0) ^ ($key % 2 == 0)); ?>
                <a href="/resources/article.php?id=<?= $article['ID']?>" class="text-decoration-none">
                    <div class="card mb-4" style="background-color: <?= $isEven ? '#A89F68' : '#CAD593' ?>">
                        <div class="card-body" style="min-height: 350px;">
                            <h2 class="display-5" style="color: <?= $isEven ? '#CAD593' : '#2A3C24' ?>"><?= $article['title'], $article['subtitle'] ?></h2>
                            <p class="lead"><?= $article['content'] ?></p>
                        </div>
                        <div class="card-image" style="background-image: url('/uploads/articles/<?= $article['image'] ?>'); background-size: cover; background-position: center; width: 100%; height: 400px; border-radius: 21px 21px 0 0; margin: auto;"></div>
                    </div>
                </a>
            </div>
        <?php } ?>
    </div>
</main>

<?php require_once(__DIR__ . '/../templates/footer.php'); ?>
