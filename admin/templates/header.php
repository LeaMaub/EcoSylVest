<?php
require_once(__DIR__ . '/../../db/config.php');
require_once(__DIR__ . '/../../app/session.php');
require_once(__DIR__ . '/../../app/mainMenu.php');
require_once(__DIR__ . '/../../app/pageInfo.php');

adminOnly();

$pageInfo = getPageInfo($menuItems, $currentPage);
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Page réservée à l'administrateur du site">
    <title>Administration du site EcoSylVest</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="../../assets/css/override-bootstrap.css">
</head>

<body>
    <div class="container">
        <header class="d-flex justify-content-between py-3 mb-4 mt-5 border-bottom">
            <div class="d-flex align-items-center mb-2 mb-md-0 me-5">
                <a href="/" class="d-inline-flex align-items-center link-body-emphasis text-decoration-none">
                    <img src="../assets/images/logo.jpg" alt="Logo" class="rounded-circle" width="150">
                    <h1 class="mb-0 ml-3">EcoSylVest</h1>
                </a>
            </div>

            <div class="d-flex align-items-center my-5">
                <div class="d-flex flex-column flex-md-row align-items-center">
                    <ul class="nav mb-2 justify-content-center mb-md-0 me-5">
                        <?php foreach ($menuItems as $key => $menuItem) {
                            if (!array_key_exists('exclude', $menuItem)) { ?>
                                <li><a href="/<?= $key ?>" class="nav-link px-2 link-secondary"><?= htmlentities($menuItem['title']) ?></a></li>
                        <?php }
                        }
                        ?>
                        <li><a href="/admin/index.php" class="nav-link px-2 link-secondary">Tableau de bord</a></li>
                    </ul>

                    <div class="d-flex justify-content-center">
                        <?php if (isset($_SESSION['user'])) { ?>
                            <a href="/templates/logout.php" class="btn btn-outline-primary me-2">Déconnexion</a>
                        <?php } else { ?>
                            <a href="/templates/login.php" class="btn btn-outline-primary me-2">Connexion</a>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </header>
    </div>
</body>

</html>