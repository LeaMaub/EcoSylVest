<?php
require_once('../admin/templates/header.php');
adminOnly();
require_once __DIR__ . "/../db/pdo.php";
require_once __DIR__ . "/../app/tools.php";
require_once __DIR__ . "/../app/reportages.php";

$errors = [];
$messages = [];
$reportages = [
    'title' => '',
    'subtitle' => '',
    'content' => '',
];

$reportage = [
    'title' => '',
    'subtitle' => '',
    'content' => '',
    'image' => ''
];

$pageTitle = "Formulaire ajout reportages";

if (isset($_POST['saveReportage'])) {

    //@todo gérer la gestion des erreurs sur les champs (champ vide etc.)

    $fileName = null;
    // Si un fichier est envoyé
    if (isset($_FILES["file"]["tmp_name"]) && $_FILES["file"]["tmp_name"] != '') {
        $checkImage = getimagesize($_FILES["file"]["tmp_name"]);
        if ($checkImage !== false) {
            $fileName = slugify(basename($_FILES["file"]["name"]));
            $fileName = uniqid() . '-' . $fileName;

            /* On déplace le fichier uploadé dans notre dossier upload, dirname(__DIR__) 
                permet de cibler le dossier parent car on se trouve dans admin
            */
            if (move_uploaded_file($_FILES["file"]["tmp_name"], dirname(__DIR__) . _REPORTAGES_IMAGES_FOLDER_ . $fileName)) {
                if (isset($_POST['image'])) {
                    // On supprime l'ancienne image si on a posté une nouvelle
                    unlink(dirname(__DIR__) . _REPORTAGES_IMAGES_FOLDER_ . $_POST['image']);
                }
            } else {
                $errors[] = 'Le fichier n\'a pas été uploadé';
            }
        } else {
            $errors[] = 'Le fichier doit être une image';
        }
    }
    /* 
    On stocke toutes les données envoyés dans un tableau pour pouvoir afficher
    les informations dans les champs. C'est utile pas exemple si on upload un mauvais
    fichier et qu'on ne souhaite pas perdre les données qu'on avait saisit.
    */
    $reportage = [
        'title' => $_POST['title'],
        'subtitle' => $_POST['subtitle'],
        'content' => $_POST['content'],
        'image' => $fileName ?? ''
    ];
    // Si il n'y a pas d'erreur on peut faire la sauvegarde
    if (!$errors) {
        // On passe toutes les données à la fonction saveArticle
        $res = saveReportage($pdo, $_POST["title"], $_POST["subtitle"], $_POST["content"], $fileName ?? null);

        if ($res) {
            $messages[] = "L'article a bien été sauvegardé";
            //On vide le tableau article pour avoir les champs de formulaire vides
            $reportage = [
                'title' => '',
                'subtitle' => '',
                'content' => '',
                'image' => ''
            ];
        } else {
            $errors[] = "L'article n'a pas été sauvegardé";
        }
    }
}

?>
<h1 class='text-center'><?= $pageTitle; ?></h1>

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

<div class="d-flex flex-column mx-5">
    <form method="POST" enctype="multipart/form-data">
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

        <p>
            <input type="file" name="file" id="file">
        </p>

        <div class="d-flex justify-content-center">
            <input type="submit" name="saveReportage" class="btn btn-primary" value="Enregistrer">
        </div>

    </form>
</div>

<?php require_once __DIR__ . "/../templates/footer.php"; ?>