<?php
require_once(__DIR__ . '/db/config.php');
require_once(__DIR__ . '/db/pdo.php');
require_once(__DIR__ . '/app/discussions.php');
require_once(__DIR__ . '/templates/header.php');

$theme = null;
if (isset($_GET['theme'])) {
    $theme = $_GET['theme'];
}
if (isset($_SESSION['user'])) {
    $userId = $_SESSION['user'];
} else {
    header("Location: /templates/login.php");
    exit;
}

$discussions = getThemedDiscussions($pdo, $theme);
$picture = getPictureUser($pdo, $userId);
$pictureUser = $picture ? $picture['image'] : '/assets/images/profilpicturesdefault.jpg';
$username = getUsernameOfAuthor($pdo, $userId);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $subject = $_POST['subject'];
    $content = $_POST['content'];

    $createDiscussion = createDiscussion($pdo, $subject, $content, $theme, $userId);
}

?>

<div class="d-flex">

    <div class="sidebar d-flex flex-column flex-shrink-0 bg-body-tertiary mt-5" style="width: 5.7rem; height: 8rem;">
        <ul class="nav nav-pills nav-flush flex-column mb-auto text-center">
            <li class="nav-item mb-3 text-center">
                <a href="forum.php" class="nav-link active py-3 border-bottom rounded-0" aria-current="page" data-bs-toggle="tooltip" data-bs-placement="right">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" width="60" height="60">
                        <path d="M575.8 255.5c0 18-15 32.1-32 32.1h-32l.7 160.2c0 2.7-.2 5.4-.5 8.1V472c0 22.1-17.9 40-40 40H456c-1.1 0-2.2 0-3.3-.1c-1.4 .1-2.8 .1-4.2 .1H416 392c-22.1 0-40-17.9-40-40V448 384c0-17.7-14.3-32-32-32H256c-17.7 0-32 14.3-32 32v64 24c0 22.1-17.9 40-40 40H160 128.1c-1.5 0-3-.1-4.5-.2c-1.2 .1-2.4 .2-3.6 .2H104c-22.1 0-40-17.9-40-40V360c0-.9 0-1.9 .1-2.8V287.6H32c-18 0-32-14-32-32.1c0-9 3-17 10-24L266.4 8c7-7 15-8 22-8s15 2 21 7L564.8 231.5c8 7 12 15 11 24z" fill="#a89f68" />
                    </svg>
                </a>
            </li>
            <li class="mb-3 text-center">
                <a href="?theme=Faune" class="nav-link py-3 border-bottom rounded-0" data-bs-toggle="tooltip" data-bs-placement="right">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512" width="60" height="60">
                        <path d="M181.5 197.1l12.9 6.4c5.9 3 12.4 4.5 19.1 4.5c23.5 0 42.6-19.1 42.6-42.6V144c0-35.3-28.7-64-64-64H128c-35.3 0-64 28.7-64 64v21.4c0 23.5 19.1 42.6 42.6 42.6c6.6 0 13.1-1.5 19.1-4.5l12.9-6.4 8.4-4.2L135.1 185c-4.5-3-7.1-8-7.1-13.3V168c0-13.3 10.7-24 24-24h16c13.3 0 24 10.7 24 24v3.7c0 5.3-2.7 10.3-7.1 13.3l-11.8 7.9 8.4 4.2zm-8.6 49.4L160 240l-12.9 6.4c-12.6 6.3-26.5 9.6-40.5 9.6c-3.6 0-7.1-.2-10.6-.6v.6c0 35.3 28.7 64 64 64h64c17.7 0 32 14.3 32 32s-14.3 32-32 32H384V336 320c0-23.7 12.9-44.4 32-55.4c9.4-5.4 20.3-8.6 32-8.6V240c0-26.5 21.5-48 48-48c8.8 0 16 7.2 16 16v32 16 48c0 8.8 7.2 16 16 16s16-7.2 16-16V204.3c0-48.2-30.8-91-76.6-106.3l-8.5-2.8c-8-2.7-12.6-11.1-10.4-19.3s10.3-13.2 18.6-11.6l19.9 4C576 86.1 640 164.2 640 254.9l0 1.1h0c0 123.7-100.3 224-224 224h-1.1H256h-.6C132 480 32 380 32 256.6V256 216.8c-10.1-14.6-16-32.3-16-51.4V144l0-1.4C6.7 139.3 0 130.5 0 120c0-13.3 10.7-24 24-24h2.8C44.8 58.2 83.3 32 128 32h64c44.7 0 83.2 26.2 101.2 64H296c13.3 0 24 10.7 24 24c0 10.5-6.7 19.3-16 22.6l0 1.4v21.4c0 1.4 0 2.8-.1 4.3c12-6.2 25.7-9.6 40.1-9.6h8c17.7 0 32 14.3 32 32s-14.3 32-32 32h-8c-13.3 0-24 10.7-24 24v8h56.4c-15.2 17-24.4 39.4-24.4 64H320c-42.3 0-78.2-27.4-91-65.3c-5.1 .9-10.3 1.3-15.6 1.3c-14.1 0-27.9-3.3-40.5-9.6zM96 128a16 16 0 1 1 0 32 16 16 0 1 1 0-32zm112 16a16 16 0 1 1 32 0 16 16 0 1 1 -32 0z" fill="#2A3C24" />
                    </svg>
                </a>
            </li>
            <li class="mb-3 text-center">
                <a href="?theme=Flore" class="nav-link py-3 border-bottom rounded-0" data-bs-toggle="tooltip" data-bs-placement="right">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512" width="60" height="60">
                        <path d="M384 312.7c-55.1 136.7-187.1 54-187.1 54-40.5 81.8-107.4 134.4-184.6 134.7-16.1 0-16.6-24.4 0-24.4 64.4-.3 120.5-42.7 157.2-110.1-41.1 15.9-118.6 27.9-161.6-82.2 109-44.9 159.1 11.2 178.3 45.5 9.9-24.4 17-50.9 21.6-79.7 0 0-139.7 21.9-149.5-98.1 119.1-47.9 152.6 76.7 152.6 76.7 1.6-16.7 3.3-52.6 3.3-53.4 0 0-106.3-73.7-38.1-165.2 124.6 43 61.4 162.4 61.4 162.4.5 1.6.5 23.8 0 33.4 0 0 45.2-89 136.4-57.5-4.2 134-141.9 106.4-141.9 106.4-4.4 27.4-11.2 53.4-20 77.5 0 0 83-91.8 172-20z" fill="#2A3C24" />
                    </svg>
                </a>
            </li>
            <li class="mb-3 text-center">
                <a href="?theme=Astuces" class="nav-link py-3 rounded-0" data-bs-toggle="tooltip" data-bs-placement="right">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" width="60" height="60">
                        <path d="M288 0H160 128C110.3 0 96 14.3 96 32s14.3 32 32 32V196.8c0 11.8-3.3 23.5-9.5 33.5L10.3 406.2C3.6 417.2 0 429.7 0 442.6C0 480.9 31.1 512 69.4 512H378.6c38.3 0 69.4-31.1 69.4-69.4c0-12.8-3.6-25.4-10.3-36.4L329.5 230.4c-6.2-10.1-9.5-21.7-9.5-33.5V64c17.7 0 32-14.3 32-32s-14.3-32-32-32H288zM192 196.8V64h64V196.8c0 23.7 6.6 46.9 19 67.1L309.5 320h-171L173 263.9c12.4-20.2 19-43.4 19-67.1z" fill="#2A3C24" />
                    </svg>
                </a>
            </li>
        </ul>
    </div>

    <div class="content d-flex flex-grow-1">
    <div class="container d-flex flex-column justify-content-center">
        <div class="row">
            <div class="col-lg-8 mx-auto my-3 p-2 bg-body rounded shadow-sm">
                <h6 class="border-bottom pb-2 mb-0 text-center display-6">Publications les plus récentes</h6>
                <?php foreach ($discussions as $key => $discussion) {
                    $authorId = $discussion['user_id'];
                    $username = getUsernameOfAuthor($pdo, $authorId);
                    $picture = getPictureUser($pdo, $authorId);
                    $pictureUser = $picture ? $picture['image'] : '/assets/images/profilpicturesdefault.jpg';
                    $additionalClass = $key >= 5 ? 'additional hidden-discussion' : 'additional';
                ?>
                <a href="replies.php?id=<?= $discussion['ID'] ?>" class="text-decoration-none">
                    <div class="d-flex justify-content-between text-body-secondary pt-3 mx-auto <?= $additionalClass ?>">
                        <div class="d-flex flex-direction-column">
                            <img src="<?= $pictureUser ?>" alt="Photo de profil" class="mr-2 rounded-profile-image">
                            <p class="pb-3 mb-0 small lh-sm">
                                <strong class="subject d-block text-gray-dark">
                                    <?= $discussion['subject'] ?>
                                </strong>
                                <strong class="d-block text-gray-dark mb-2">@<?= $username['username'] ?></strong>
                                <?= $discussion['content'] ?>
                                <br />
                                <br />
                                <?= $discussion['date_creation'] ?>
                            </p>
                        </div>
                        <?= $discussion['themeSvg'] ?>
                    </div>
                    </a>
                    <hr class="my-3 <?= $additionalClass ?>">
                <?php } ?>
                <div class="d-grid gap-2 d-md-flex justify-content-center mt-5">
                    <a href="#" class="btn btn-primary btn-lg px-4 me-md-2 fw-bold">Toutes les publications...</a>
                </div>
            </div>
        </div>
    </div>
</div>

</div>

<div class="container">
    <h2 class="mt-5 display-4 text-center">Créer une discussion</h2>
    <form action="<?= ('post/post_discussion.php'); ?>" method="post" class="mt-5">
        <div class="form-group">
            <label class="labelForum" for="subject"> Sujet de discussion </label>
            <input type="text" class="form-control" id="subject" name="subject" placeholder="Entrer le sujet">
        </div>
        <div class="form-group">
            <label class="labelForum" for="theme"> Thème </label>
            <select class="form-control" id="theme" name="theme">
                <option>Faune</option>
                <option>Flore</option>
                <option>Astuces</option>
            </select>
        </div>
        <div class="form-group">
            <label class="labelForum" for="content">Message</label>
            <textarea class="form-control" id="content" name="content" rows="3" placeholder="Entrez votre message ici"></textarea>
        </div>
        <div class="d-flex justify-content-center">
            <button type="submit" class="btn btn-primary mt-5">Soumettre</button>
        </div>
    </form>
</div>

<script src="script.js"></script>
<script defer src="https://use.fontawesome.com/releases/v5.15.4/js/all.js" integrity="sha384-rOA1PnstxnOBLzCLMcre8ybwbTmemjzdNlILg8O7z1lUkLXozs4DHonlDtnE7fpc" crossorigin="anonymous"></script>
<?php require_once(__DIR__ . '/templates/footer.php'); ?>