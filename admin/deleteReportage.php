<?php
require_once __DIR__ . "/templates/header.php";
adminOnly();

require_once __DIR__ . "/../db/pdo.php";
require_once __DIR__ . "/../app/tools.php";
require_once __DIR__ . "/../app/reportages.php";

$reportage = false;
$errors = [];
$messages = [];
if (isset($_GET["id"])) {
    $reportage =  getReportageById($pdo, (int)$_GET["id"]);
}
if ($reportage) {
    if (deleteReportage($pdo, $_GET["id"])) {
        $messages[] = "Le reportage a bien été supprimé";
        header('location: /admin/reportages.php');
        exit();
    } else {
        $errors[] = "Une erreur s'est produite lors de la suppression";
    }
} else {
    $errors[] = "Le reportage n'existe pas";
}
?>
<div class="row text-center my-5">
    <h1>Supression reportage</h1>
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