<?php
require_once __DIR__ . "/templates/header.php";
adminOnly();

require_once __DIR__ . "/../db/pdo.php";
require_once __DIR__ . "/../app/tools.php";
require_once __DIR__ . "/../app/discussions.php";

$theme = null;
if (isset($_GET['theme'])) {
    $theme = $_GET['theme'];
}

$discussions = getThemedDiscussions($pdo, $theme);
?>

<h1 class='py-5 text-center'>Liste des publications</h1>

<div class="mx-5">
    <table class="table">
        <thead>
            <tr class='text-center'>
                <th scope="col">#</th>
                <th scope="col">Sujet</th>
                <th scope="col">Contenu</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($discussions as $discussion) { ?>
                <tr class='text-start'>
                    <th scope="row"><?= $discussion['ID'] ?></th>
                    <td><?= $discussion['subject'] ?></td>
                    <td><?= $discussion['content'] ?></td>
                    <td> <a href="replies.php?ID=<?= $discussion['ID'] ?>" class="text-decoration-none link-secondary">Gérer les commentaires</a> | <a href="deleteSubject.php?ID=<?= $discussion['ID'] ?>" class="text-decoration-none link-secondary">Supprimer</a> </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>


<?php require_once __DIR__ . '/../templates/footer.php'; ?>