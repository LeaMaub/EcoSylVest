<?php
require_once(__DIR__ . '/../app/mainMenu.php');
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?= $menuItems[$currentPage]['meta_description'] ?>">
    <title><?= $menuItems[$currentPage]['head_title'] ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="../assets/css/override-bootstrap.css">
</head>

<body>
    <div class="container">
        <header class="d-flex flex-wrap align-items-center justify-content-between py-3 mb-4 border-bottom">

            <div class="d-flex align-items-center mb-2 mb-md-0">
                <a href="/" class="d-inline-flex align-items-center link-body-emphasis text-decoration-none">
                    <img src="../assets/images/logo.jpg" alt="Logo" class="rounded-circle" width="150">
                    <h1 class="mb-0 ml-3">EcoSylVest</h1>
                </a>
            </div>


            <div class="d-flex flex-column flex-md-row align-items-center">
                <ul class="nav mb-2 justify-content-center mb-md-0 me-5">
                    <?php foreach ($mainMenu as $key => $menuItem) { ?>
                        <li><a href="/<?= $key ?>" class="nav-link px-2 link-secondary"><?= $menuItem['title'] ?></a></li>
                    <?php } ?>
                </ul>

                <div class="text-end">
                    <?php foreach ($buttonsMenu as $key => $buttonMenu) { ?>
                        <a href="/templates/<?= $key ?>" class="btn btn-outline-primary me-2"><?= $buttonMenu['title'] ?></a>
                    <?php } ?>
                </div>
            </div>
        </header>
    </div>
</body>

</html>