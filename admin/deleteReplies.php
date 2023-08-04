<?php
require_once __DIR__ . "/templates/header.php";
adminOnly();

require_once __DIR__ . "/../db/pdo.php";
require_once __DIR__ . "/../app/tools.php";
require_once __DIR__ . "/../app/discussions.php";

$reply = false;
$errors = [];
$messages = [];
if (isset($_GET['ID'])) {
    $reply =  getRepliesById($pdo, (int)$_GET['ID']);
}
if ($reply) {
    if (deleteReply($pdo, $_GET['ID'])) {
        $messages[] = "Le commentaire a bien été supprimé";
        header('location: /admin/replies.php');
        exit();
    } else {
        $errors[] = "Une erreur s'est produite lors de la suppression";
    }
} else {
    $errors[] = "Le commentaire n'existe pas";
}
?>
<div class="row text-center my-5">
    <h1>Supression commentaire</h1>
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
require_once __DIR__ . '/../templates/footer.php';
?>