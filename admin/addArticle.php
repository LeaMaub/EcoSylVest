<?php
require_once('../admin/templates/header.php');
adminOnly();
require_once __DIR__ . "/../db/pdo.php";
require_once __DIR__ . "/../app/tools.php";
require_once __DIR__ . "/../app/articles.php";
require_once __DIR__ . "/../app/category.php";

$errors = [];
$messages = [];
$article = [
    'title' => '',
    'subtitle' => '',
    'content' => '',
    'theme_id' => ''
];

$themes = getThemes($pdo);

$pageTitle = "Formulaire ajout article";

if (isset($_POST['saveArticle'])) {

    $fileName = null;
    $theme_id = (int)$_POST['theme_id'];
    $category = '';
    $id = null; 

    if (isset($_FILES["file"]["tmp_name"]) && $_FILES["file"]["tmp_name"] != '') {
        $checkImage = getimagesize($_FILES["file"]["tmp_name"]);
        if ($checkImage !== false) {
            $fileName = slugify(basename($_FILES["file"]["name"]));
            $fileName = uniqid() . '-' . $fileName;

            if (move_uploaded_file($_FILES["file"]["tmp_name"], dirname(__DIR__) . _ARTICLES_IMAGES_FOLDER_ . $fileName)) {
                if (isset($_POST['image'])) {
                    unlink(dirname(__DIR__) . _ARTICLES_IMAGES_FOLDER_ . $_POST['image']);
                }
            } else {
                $errors[] = 'Le fichier n\'a pas été uploadé';
            }
        } else {
            $errors[] = 'Le fichier doit être une image';
        }
    }

    $theme = array_filter($themes, function($theme) use ($theme_id) {
        return $theme['id'] == $theme_id;
    });
    $theme = reset($theme);
    if ($theme) {
        $category = $theme['title'];
    }

    $article = [
        'title' => $_POST['title'],
        'subtitle' => $_POST['subtitle'],
        'content' => $_POST['content'],
        'theme_id' => $_POST['theme_id'],
        'image' => $fileName
    ];

    if (!$errors) {
        $res = saveArticle($pdo, $_POST["title"], $_POST["subtitle"], $_POST["content"], $fileName, $theme_id, $category, $id);

        if ($res) {
            $messages[] = "L'article a bien été sauvegardé";
            $article = [
                'title' => '',
                'subtitle' => '',
                'content' => '',
                'theme_id' => ''
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
            <input type="text" class="form-control" id="title" name="title" value="<?= $article['title']; ?>">
        </div>
        <div class="mb-3">
            <label for="subtitle" class="form-label">Sous-titre</label>
            <input type="text" class="form-control" id="subtitle" name="subtitle" value="<?= $article['subtitle']; ?>">
        </div>
        <div class="mb-3">
            <label for="content" class="form-label">Contenu</label>
            <textarea class="form-control" id="content" name="content" rows="8"><?= $article['content']; ?></textarea>
        </div>
        <div class="mb-3">
            <label for="theme" class="form-label">Catégorie</label>
            <select name="theme_id" id="theme_id" class="form-select">
                <?php foreach ($themes as $theme) { ?>
                    <option value="<?= $theme['id']; ?>" <?php if ($article['theme_id'] == $theme['id']) { ?>selected="selected" <?php }; ?>><?= $theme['title']; ?></option>
                <?php } ?>
            </select>
        </div>

        <p>
            <input type="file" name="file" id="file">
        </p>

        <div class="d-flex justify-content-center">
            <input type="submit" name="saveArticle" class="btn btn-primary" value="Enregistrer">
        </div>


    </form>
</div>

<?php require_once __DIR__ . "/../templates/footer.php"; ?>
