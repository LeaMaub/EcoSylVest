<?php
require_once('../admin/templates/header.php');
adminOnly();
require_once __DIR__ . "/../db/pdo.php";
require_once __DIR__ . "/../app/tools.php";
require_once __DIR__ . "/../app/carousel.php";

$errors = [];
$messages = [];
$carousel = [
    'title' => '',
    'subtitle' => '',
];

$pageTitle = "Formulaire ajout de dernières nouvelles";

if (isset($_POST['saveCarousel'])) {

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
            if (move_uploaded_file($_FILES["file"]["tmp_name"], dirname(__DIR__) . _CAROUSEL_IMAGES_FOLDER_ . $fileName)) {
                if (isset($_POST['image'])) {
                    // On supprime l'ancienne image si on a posté une nouvelle
                    unlink(dirname(__DIR__) . _CAROUSEL_IMAGES_FOLDER_ . $_POST['image']);
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
    $carousel = [
        'title' => $_POST['title'],
        'subtitle' => $_POST['subtitle'],
        'image' => $fileName
    ];
    // Si il n'y a pas d'erreur on peut faire la sauvegarde
    if (!$errors) {
        // On passe toutes les données à la fonction saveArticle
        $res = saveCarousel($pdo, $_POST["title"], $_POST["subtitle"], $fileName);

        if ($res) {
            $messages[] = "La dernière nouvelle a bien été sauvegardée";
            //On vide le tableau article pour avoir les champs de formulaire vides
            $article = [
                'title' => '',
                'subtitle' => '',
            ];
        } else {
            $errors[] = "La dernière nouvelle n'a pas été sauvegardée";
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
            <input type="text" class="form-control" id="title" name="title" value="<?= $carousel['title']; ?>">
        </div>
        <div class="mb-3">
            <label for="subtitle" class="form-label">Sous-titre</label>
            <input type="text" class="form-control" id="subtitle" name="subtitle" value="<?= $carousel['subtitle']; ?>">
        </div>

        <p>
            <input type="file" name="file" id="file">
        </p>

        <div class="d-flex justify-content-center">
            <input type="submit" name="saveCarousel" class="btn btn-primary" value="Enregistrer">
        </div>


    </form>
</div>

<?php require_once __DIR__ . "/../templates/footer.php"; ?>