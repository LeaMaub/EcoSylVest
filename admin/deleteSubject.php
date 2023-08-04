<?php
require_once __DIR__ . "/templates/header.php";
adminOnly();

require_once __DIR__ . "/../db/pdo.php";
require_once __DIR__ . "/../app/tools.php";
require_once __DIR__ . "/../app/discussions.php";

$discussion = false;
$errors = [];
$messages = [];
if (isset($_GET['ID'])) {
    $discussion =  getDiscussionById($pdo, (int)$_GET['ID']);
}
if ($discussion) {
    if (deleteDiscussion($pdo, $_GET['ID'])) {
        $messages[] = "La publication a bien été supprimée";
        header('location: /admin/subjectForum.php');
        exit();
    } else {
        $errors[] = "Une erreur s'est produite lors de la suppression";
    }
} else {
    $errors[] = "La publication n'existe pas";
}
?>
<div class="row text-center my-5">
    <h1>Supression publication</h1>
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