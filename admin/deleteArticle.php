<?php
require_once __DIR__ . "/templates/header.php";
adminOnly();

require_once __DIR__ . "/../db/pdo.php";
require_once __DIR__ . "/../app/tools.php";
require_once __DIR__ . "/../app/articles.php";

$article = false;
$errors = [];
$messages = [];
if (isset($_GET["id"])) {
    $article =  getArticleById($pdo, (int)$_GET["id"]);
}
if ($article) {
    if (deleteArticle($pdo, $_GET["id"])) {
        $messages[] = "L'article a bien été supprimé";
        header('location: /admin/articles.php');
        exit();
    } else {
        $errors[] = "Une erreur s'est produite lors de la suppression";
    }
} else {
    $errors[] = "L'article n'existe pas";
}
?>
<div class="row text-center my-5">
    <h1>Supression article</h1>
    <?php foreach ($messages as $message) { ?>
        <div class="alert alert-success" role="alert">
            <?= $message; ?>
        </div>
    <?php } ?>
    <?php foreach ($errors as $error) { ?>
        <div class="alert alert-danger" role="alert">
            <?= $error; ?>
        </div>
    <?php } ?>
</div>

<?php
require_once('templates/footer.php');