<?php 
require_once(__DIR__.'/app/mainMenu.php');
require_once(__DIR__.'/templates/header.php') 
?>

<div class="px-4 pt-5 my-5 text-center border-bottom">
    <h1 class="display-4 fw-bold text-body-emphasis">Un peu plus sur nous...</h1>
    <div class="col-lg-6 mx-auto">
        <p class="lead mb-4">Quickly design and customize responsive mobile-first sites with Bootstrap, the world’s most popular front-end open source toolkit, featuring Sass variables and mixins, responsive grid system, extensive prebuilt components, and powerful JavaScript plugins.</p>
    </div>
    <div class="overflow-hidden" style="max-height: 30vh;">
        <div class="container px-5">
            <img src="/assets/images/about.jpg" class="img-fluid border rounded-3 shadow-lg mb-4" alt="A propos" loading="lazy" width="700" height="500">
        </div>
    </div>
</div>

<?php require_once('templates/footer.php') ?>