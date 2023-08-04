<?php
require_once __DIR__ . "/templates/header.php";
adminOnly();
require_once __DIR__ . "/../db/config.php";
require_once __DIR__ . "/../db/pdo.php";


if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];

    $query = $pdo->prepare("DELETE FROM users WHERE ID = :id AND role = 'Admin'");
    $query->bindParam(':id', $id, PDO::PARAM_INT);

    $result = $query->execute();

    if ($result) {
        $message = "L'administrateur a été supprimé avec succès.";
    } else {
        $message = "Il y a eu une erreur dans la suppression de l'administrateur.";
    }
} else {
    $message = "ID d'administrateur invalide.";
}

?>
<h1 class='text-center'>Suppression de l'administrateur</h1>
<div class="alert success" role="alert">
    <?= $message; ?>
</div>
<a href="admins.php" class="btn btn-primary">Retour à la liste des administrateurs</a>
<?php require_once __DIR__ . '/../templates/footer.php'; ?>
