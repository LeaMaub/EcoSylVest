<?php
require_once(__DIR__ . '/../db/config.php');
require_once(__DIR__ . '/../db/pdo.php');
require_once(__DIR__ . '/../templates/header.php');
require_once(__DIR__ . '/../app/articles.php');

$categoryArticles = getCategoryArticles($pdo, 'Flore');
?>
<main class="container-fluid">
    <div class="themeTitle position-relative overflow-hidden mx-5 my-5 text-center">
        <div class="col-md-6 p-lg-5 mx-auto my-5">
            <h1 class="display-3 fw-bold">La flore</h1>
        </div>
    </div>
    
    <div class="row justify-content-center">
        <?php foreach ($categoryArticles as $key => $article) { ?>
            <div class="col-md-5">
                <?php $isEven = (($key / 2 % 2 == 0) ^ ($key % 2 == 0)); ?>
                <a href="/resources/article.php?id=<?= $article['ID'] ?>" class="text-decoration-none">
                    <div class="card mb-4" style="background-color: <?= $isEven ? '#A89F68' : '#CAD593' ?>">
                        <div class="card-body" style="min-height: 350px;">
                            <h2 class="display-5" style="color: <?= $isEven ? '#CAD593' : '#2A3C24' ?>"><?= $article['title'], $article['subtitle'] ?></h2>
                            <p class="lead"><?= substr($article['content'], 0, 320) ?>...</p>
                        </div>
                        <div class="card-image" style="background-image: url('/uploads/articles/<?= $article['image'] ?>'); background-size: cover; background-position: center; width: 100%; height: 400px; border-radius: 21px 21px 0 0; margin: auto;"></div>
                    </div>
                </a>
            </div>
        <?php } ?>
    </div>
</main>

<?php require_once(__DIR__ . '/../templates/footer.php'); ?>