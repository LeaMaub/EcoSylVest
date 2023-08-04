<?php
require_once __DIR__ . "/templates/header.php";
adminOnly();
require_once __DIR__ . "/../db/config.php";
require_once __DIR__ . "/../db/pdo.php";
require_once __DIR__ . "/../app/tools.php";
require_once __DIR__ . "/../app/users.php";


$users = getAllUsers($pdo);
?>

<h1 class='py-5 text-center'>Liste des utilisateurs</h1>

<div class="mx-5">
    <table class="table">
        <thead>
            <tr class='text-center'>
                <th scope="col">#</th>
                <th scope="col">Nom d'utilisateur</th>
                <th scope="col">Nom</th>
                <th scope="col">Prénom</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $user) { 
                if ($user['role'] === 'Admin') continue;
                ?>
                <tr class='text-start <?= $user['banned'] ? 'banned' : '' ?>'>
                    <th scope="row"><?= $user['ID'] ?></th>
                    <td><?= $user['username'] ?></td>
                    <td><?= $user['lastname'] ?></td>
                    <td><?= $user['firstname'] ?></td>
                    <td><a href="debanUser.php?id=<?= $user['ID'] ?>" class="text-decoration-none link-secondary">Débannir </a> | <a href="banUser.php?id=<?= $user['ID'] ?>" class="text-decoration-none link-secondary">Bannir</a> </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>


<?php require_once __DIR__ . '/../templates/footer.php'; ?>