<?php
require_once __DIR__ . "/templates/header.php";
adminOnly();

require_once __DIR__ . "/../db/pdo.php";
require_once __DIR__ . "/../app/tools.php";
require_once __DIR__ . "/../app/carousel.php";

$carousel = false;
$errors = [];
$messages = [];
if (isset($_GET["id"])) {
    $carousel =  getCarouselById($pdo, (int)$_GET["id"]);
}
if ($carousel) {
    if (deleteCarousel($pdo, $_GET["id"])) {
        $messages[] = "La dernière nouvelle a bien été supprimée";
        header('location: /admin/carousel.php');
        exit();
    } else {
        $errors[] = "Une erreur s'est produite lors de la suppression";
    }
} else {
    $errors[] = "La dernière nouvelle n'existe pas";
}
?>
<div class="row text-center my-5">
    <h1>Supression de dernière nouvelle</h1>
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