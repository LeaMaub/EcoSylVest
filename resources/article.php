<?php
require_once(__DIR__.'/../db/config.php');
require_once(__DIR__.'/../db/pdo.php');
require_once(__DIR__.'/../app/articles.php');
require_once(__DIR__.'/../app/mainMenu.php');

$articleId = $_GET['id'];
$article = getArticleById($pdo, $articleId);

require_once(__DIR__ . '/../templates/header.php');
$mainMenu['article.php'] = ['head_title' => htmlentities($article['title']), 'meta_description' => htmlentities(substr($article['content'], 0, 50)), 'exclude' => true];
?>

<div class="container my-5">
    <div class="row p-4 pb-0 pe-lg-0 pt-lg-5 align-items-center rounded-3 border shadow-lg">
        <div class="col-lg-7 p-3 p-lg-5 pt-lg-3">
            <h1 class="display-4 fw-bold lh-1 text-body-emphasis"><?= htmlentities($article['title'])?></h1>
            <p class="lead"><?= htmlentities($article['content'])?></p>
            <div class="d-grid gap-2 d-md-flex justify-content-md-start mb-4 mb-lg-3">
            </div>
        </div>
        <div class="col-lg-4 offset-lg-1 p-0 overflow-hidden shadow-lg">
            <img class="rounded-lg-3" src="/uploads/articles/<?= htmlentities($article['image'])?>" alt="<?= htmlentities($article['title'])?>" width="720">
        </div>
    </div>
</div>


<?php require_once(__DIR__ . '/../templates/footer.php'); ?>