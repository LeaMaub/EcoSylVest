<?php 
require_once(__DIR__.'/templates/header.php');
require_once(__DIR__.'/db/pdo.php');
require_once(__DIR__.'/app/mainMenu.php');
require_once(__DIR__.'/app/about.php');

$about = getAbout($pdo);
?>

<div class="px-4 pt-5 my-5 text-center border-bottom">
    <h1 class="display-4 fw-bold text-body-emphasis"><?= $about['title'] ?></h1>
    <div class="col-lg-6 mx-auto">
        <p class="lead mb-4"><?= $about['content'] ?></p>
    </div>
    <div class="overflow-hidden" style="max-height: 30vh;">
        <div class="container px-5">
            <img src="/assets/images/<?= $about['image'] ?>" class="img-fluid border rounded-3 shadow-lg mb-4" alt="A propos" loading="lazy" width="700" height="500">
        </div>
    </div>
</div>

<?php require_once('templates/footer.php') ?>