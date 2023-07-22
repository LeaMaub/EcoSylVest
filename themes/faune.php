<?php
require_once(__DIR__ . '/../templates/header.php');
require_once(__DIR__ . '/../app/articles.php');
?>
<main>
    <div class="position-relative overflow-hidden p-3 p-md-5 m-md-3 text-center bg-body-tertiary">
        <div class="col-md-6 p-lg-5 mx-auto my-5">
            <h1 class="display-3 fw-bold">La faune</h1>
            <div class="d-flex gap-3 justify-content-center lead fw-normal">
            </div>
        </div>
        <div class="product-device shadow-sm d-none d-md-block"></div>
        <div class="product-device product-device-2 shadow-sm d-none d-md-block"></div>
    </div>

    <?php foreach ($articles as $key => $article) { ?>
        <?php if ($key % 2 == 0) { ?>
            <div class="d-md-flex flex-md-equal w-100 my-md-3 ps-md-3 align-items-stretch">
                <div class= "me-md-3 pt-3 px-3 pt-md-5 px-md-5 text-center overflow-hidden" style="background-color: #A89F68; color: white;">
                    <div class="my-3 py-3">
                        <h2 style="color: #2A3C24" class="display-5"><?= $article['title'] ?></h2>
                        <p class="lead"><?= $article['content'] ?></p>
                    </div>
                    <div style="background-image: url('/uploads/articles/<?= $article['image'] ?>'); background-size: cover; background-position: center; width: 80%; height: 400px; border-radius: 21px 21px 0 0; margin: auto;"></div>
                </div>
            <?php } else { ?>
                <div class="me-md-3 pt-3 px-3 pt-md-5 px-md-5 text-center overflow-hidden" style="background-color: #CAD593;">
                    <div class="my-3 p-3">
                        <h2 class="display-5"><?= $article['title'] ?></h2>
                        <p class="lead" style="color: #2A3C24"><?= $article['content'] ?></p>
                    </div>
                    <div style="background-image: url('/uploads/articles/<?= $article['image'] ?>'); background-size: cover; background-position: center; width: 80%; height: 400px; border-radius: 21px 21px 0 0; margin: auto;"></div>
                </div>
            </div>
        <?php } ?>
    <?php } ?>
</main>



<?php require_once(__DIR__ . '/../templates/footer.php'); ?>