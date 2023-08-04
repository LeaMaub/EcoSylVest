<?php
require_once __DIR__ . "/templates/header.php";
adminOnly();

require_once __DIR__ . "/../db/pdo.php";
require_once __DIR__ . "/../app/tools.php";
require_once __DIR__ . "/../app/discussions.php";

if (isset($_GET['ID'])) {
    $discussionId = $_GET['ID'];
} else {
    header('location: subjectForum.php');
}

$replies = getRepliesByDiscussionId($pdo, $discussionId);
?>

<h1 class='py-5 text-center'>Liste des publications</h1>

<div class="mx-5">
    <table class="table">
        <thead>
            <tr class='text-center'>
                <th scope="col">#</th>
                <th scope="col">Nom d'utilisateur</th>
                <th scope="col">Commentaire</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($replies as $reply) { ?>
                <tr class='text-start'>
                    <th scope="row"><?= $reply['ID'] ?></th>
                    <td><?= $reply['username'] ?></td>
                    <td><?= $reply['content'] ?></td>
                    <td><a href="deleteReplies.php?ID=<?= $reply['ID'] ?>" class="text-decoration-none link-secondary">Supprimer</a> </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>


<?php require_once __DIR__ . '/../templates/footer.php'; ?>