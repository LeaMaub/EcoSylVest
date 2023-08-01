<?php
require_once __DIR__ . '/templates/header.php';
adminOnly();
require_once __DIR__ . '/../db/pdo.php';
require_once __DIR__ . '/../app/tools.php';
require_once __DIR__ . '/../app/about.php';

$errors = [];
$messages = [];
$about = getAbout($pdo);

$image = $about['image'] ?? '../assets/images/about.jpg';

if (isset($_FILES["file"]["tmp_name"]) && $_FILES["file"]["tmp_name"] != '') {
    $checkImage = getimagesize($_FILES["file"]["tmp_name"]);
    if ($checkImage !== false) {
        $newImage = slugify(basename($_FILES["file"]["name"]));
        $newImage = uniqid() . '-' . $newImage;

        if (move_uploaded_file($_FILES["file"]["tmp_name"], __DIR__ . '/../assets/images/' . $newImage)) {
            if ($image && $image != 'about.jpg') {
                unlink(__DIR__ . '/../assets/images/' . $image);
            }
            $image = $newImage;
        } else {
            $errors[] = 'Le fichier n\'a pas été uploadé';
        }
    } else {
        $errors[] = 'Le fichier doit être une image';
    }
} else {
    if (isset($_POST['delete_image']) && $image != 'about.jpg') {
        unlink(__DIR__ . '/../assets/images/' . $image);
        $image = null;
    } else {
        $image = 'about.jpg';
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && !$errors) {
    $res = saveAbout($pdo, $_POST["title"] ?? '', $_POST["content"] ?? '', $image);
    if ($res) {
        $messages[] = "La section 'À propos' a bien été sauvegardée";
        $about = [
            'title' => '',
            'content' => '',
        ];
        header("Location: /admin/index.php");
        exit();
    } else {
        $errors[] = "La section 'À propos' n'a pas été sauvegardée";
    }
}
?>

<h1 class="text-center">Mise à jour de la section 'À propos'</h1>

<?php foreach ($messages as $message) { ?>
    <div class="alert alert-success" role="alert">
        <?= $message; ?>
    </div>
<?php } ?>
<?php foreach ($errors as $error) { ?>
    <div class="alert alert-danger" role="alert">
        <?= $error; ?>
    </div>
<?php } ?>
<?php if ($about !== false) { ?>
    <div class="mx-5">
        <form method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?= isset($about['ID']) ? $about['ID'] : ''; ?>">
            <div class="mb-3">
                <label for="title" class="form-label">Titre</label>
                <input type="text" class="form-control" id="title" name="title" value="<?= $about['title']; ?>">
            </div>
            <div class="mb-3">
                <label for="content" class="form-label">À propos</label>
                <textarea class="form-control" id="content" name="content"><?= $about['content']; ?></textarea>
            </div>
            <?php if (isset($about['image'])) { ?>
                <p>
                    <img src="<?= '../assets/images/' . $about['image'] ?>" alt="<?= $about['title'] ?>" width="200">
                    <input type="hidden" name="image" value="<?= $about['image']; ?>">
                    <input type="checkbox" name="delete_image" id="delete_image">
                    <label for="delete_image">Supprimer l'image actuelle</label>
                </p>
            <?php } else { ?>
                <p>
                    <img src="<?= '../assets/images/about.jpg' ?>" alt="Image par défaut" width="200">
                </p>
            <?php } ?>

            <div class="mb-3">
                <label for="file" class="form-label">Choisir une nouvelle image</label>
                <input type="file" class="form-control" name="file" id="file">
            </div>
            <div class="d-flex justify-content-center">
                <input type="submit" name="saveAbout" class="btn btn-primary" value="Mettre à jour">
            </div>
        </form>
    </div>
<?php } ?>

</form>
</div>

<?php
require_once __DIR__ . '/../templates/footer.php';
?>