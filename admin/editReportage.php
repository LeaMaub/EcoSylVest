<?php
require_once __DIR__ . '/templates/header.php';
adminOnly();
require_once __DIR__ . '/../db/pdo.php';
require_once __DIR__ . '/../app/tools.php';
require_once __DIR__ . '/../app/reportages.php';

$errors = [];
$messages = [];
$reportage = [
    'title' => '',
    'subtitle' => '',
    'content' => '',
];

if (isset($_GET['id'])) {
    $id = (int)$_GET['id'];
    $reportage = getReportageById($pdo, $id);
    if ($reportage === false) {
        $errors[] = "Le reportage n'existe pas";
    }
} else {

}

if (isset($_POST['saveReportage'])) {
    $image = null;
    if (isset($_FILES["file"]["tmp_name"]) && $_FILES["file"]["tmp_name"] != '') {
        $checkImage = getimagesize($_FILES["file"]["tmp_name"]);
        if ($checkImage !== false) {
            $image = slugify(basename($_FILES["file"]["name"]));
            $image = uniqid() . '-' . $image;

            if (move_uploaded_file($_FILES["file"]["tmp_name"], __DIR__ . '/../uploads/reportages/' . $image)) {
                if (isset($_POST['image'])) {
                    unlink(__DIR__ . '/../uploads/reportages/' . $_POST['image']);
                }
            } else {
                $errors[] = 'Le fichier n\'a pas été uploadé';
            }
        } else {
            $errors[] = 'Le fichier doit être une image';
        }
    } else {
        if (isset($_GET['id'])) {
            if (isset($_POST['delete_image'])) {
                unlink(__DIR__ . '/../uploads/reportages/' . $_POST['image']);
            } else {
                $image = $_POST['image'];
            }
        }
    }

    $reportage = [
        'title' => $_POST['title'],
        'subtitle' => $_POST['subtitle'],
        'content' => $_POST['content'],
        'image' => $image
    ];

    if (!$errors) {
        if (isset($_GET["id"])) {
            $id = (int)$_GET["id"];
        } else {
            $id = null;
        }

        $res = saveReportage($pdo, $_POST["title"], $_POST["subtitle"], $_POST["content"], $image, $id);

        if ($res) {
            $messages[] = "Le reportage a bien été sauvegardé";
            if (!isset($_GET["id"])) {
                $reportage = [
                    'title' => '',
                    'subtitle' => '',
                    'content' => '',
                ];
            }
            header("Location: /admin/reportages.php");
            exit();
        } else {
            $errors[] = "Le reportage n'a pas été sauvegardé";
        }
    }
}

?>

<h1 class="text-center">Mise à jour d'un reportage</h1>

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
<?php if ($reportage !== false) { ?>
    <div class="mx-5">
        <form method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?= isset($reportage['ID']) ? $reportage['ID'] : ''; ?>">
            <div class="mb-3">
                <label for="title" class="form-label">Titre</label>
                <input type="text" class="form-control" id="title" name="title" value="<?= $reportage['title']; ?>">
            </div>
            <div class="mb-3">
                <label for="subtitle" class="form-label">Sous-titre</label>
                <input type="text" class="form-control" id="subtitle" name="subtitle" value="<?= $reportage['subtitle']; ?>">
            </div>
            <div class="mb-3">
                <label for="content" class="form-label">Contenu</label>
                <textarea class="form-control" id="content" name="content" rows="8"><?= $reportage['content']; ?></textarea>
            </div>
            <?php if (isset($reportage['image'])) { ?>
                <p>
                    <img src="<?= '../uploads/reportages/' . $reportage['image'] ?>" alt="<?= $reportage['title'] ?>" width="200">
                    <input type="hidden" name="image" value="<?= $reportage['image']; ?>">
                    <input type="checkbox" name="delete_image" id="delete_image">
                    <label for="delete_image">Supprimer l'image actuelle</label>
                </p>
            <?php } ?>
            <div class="mb-3">
                <label for="file" class="form-label">Choisir une nouvelle image</label>
                <input type="file" class="form-control" name="file" id="file">
            </div>
            <div class="d-flex justify-content-center">
                <input type="submit" name="saveReportage" class="btn btn-primary" value="Mettre à jour">
            </div>
        </form>
    </div>
<?php } ?>

</form>
</div>

<?php
require_once __DIR__ . '/../templates/footer.php';
?>