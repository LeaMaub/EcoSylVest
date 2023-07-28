<?php
require_once __DIR__ . '/templates/header.php';
adminOnly();
require_once __DIR__ . '/../db/pdo.php';
require_once __DIR__ . '/../app/tools.php';
require_once __DIR__ . '/../app/articles.php';
require_once __DIR__ . '/../app/category.php';

$errors = [];
$messages = [];
$article = [
    'title' => '',
    'content' => '',
    'theme_id' => '',
];

$themes = getThemes($pdo);

if (isset($_GET['id'])) {
    $id = (int)$_GET['id'];
    $article = getArticleById($pdo, $id);
    if ($article === false) {
        $errors[] = "L'article n'existe pas";
    }
} else {
    // Redirect to error page or something similar
    // if no id is provided
}

if (isset($_POST['saveArticle'])) {
    $image = null;
    if (isset($_FILES["file"]["tmp_name"]) && $_FILES["file"]["tmp_name"] != '') {
        $checkImage = getimagesize($_FILES["file"]["tmp_name"]);
        if ($checkImage !== false) {
            $image = slugify(basename($_FILES["file"]["name"]));
            $image = uniqid() . '-' . $image;

            if (move_uploaded_file($_FILES["file"]["tmp_name"], __DIR__ . '/../uploads/' . $image)) {
                if (isset($_POST['image'])) {
                    unlink(__DIR__ . '/../uploads/' . $_POST['image']);
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
                unlink(__DIR__ . '/../uploads/' . $_POST['image']);
            } else {
                $image = $_POST['image'];
            }
        }
    }

    $article = [
        'title' => $_POST['title'],
        'content' => $_POST['content'],
        'theme_id' => $_POST['theme_id'],
        'image' => $image
    ];

    if (!$errors) {
        if (isset($_GET["id"])) {
            $id = (int)$_GET["id"];
        } else {
            $id = null;
        }

        $res = saveArticle($pdo, $_POST["title"], $_POST["content"], $image, (int)$_POST["theme_id"], $id);

        if ($res) {
            $messages[] = "L'article a bien été sauvegardé";
            if (!isset($_GET["id"])) {
                $article = [
                    'title' => '',
                    'content' => '',
                    'theme_id' => '',
                ];
            }
            header("Location: /admin/articles.php");
            exit();
        } else {
            $errors[] = "L'article n'a pas été sauvegardé";
        }
    }
}

?>

<h1 class="text-center">Mise à jour d'un article</h1>

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
<?php if ($article !== false) { ?>
    <div class="mx-5">
        <form method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?= isset($article['ID']) ? $article['ID'] : ''; ?>">
            <div class="mb-3">
                <label for="title" class="form-label">Titre</label>
                <input type="text" class="form-control" id="title" name="title" value="<?= $article['title']; ?>">
            </div>
            <div class="mb-3">
                <label for="content" class="form-label">Contenu</label>
                <textarea class="form-control" id="content" name="content" rows="8"><?= $article['content']; ?></textarea>
            </div>
            <div class="mb-3">
                <label for="theme" class="form-label">Thème</label>
                <select name="theme_id" id="theme" class="form-select">
                    <?php foreach ($themes as $theme) { ?>
                        <option value="<?= $theme['id']; ?>" <?php if ($article['theme_id'] == $theme['id']) { ?>selected="selected" <?php }; ?>><?= $theme['title']; ?></option>
                    <?php } ?>
                </select>
            </div>
            <?php if (isset($article['image'])) { ?>
                <p>
                    <img src="<?= '../uploads/articles/' . $article['image'] ?>" alt="<?= $article['title'] ?>" width="200">
                    <input type="hidden" name="image" value="<?= $article['image']; ?>">
                    <input type="checkbox" name="delete_image" id="delete_image">
                    <label for="delete_image">Supprimer l'image actuelle</label>
                </p>
            <?php } ?>
            <div class="mb-3">
                <label for="file" class="form-label">Choisir une nouvelle image</label>
                <input type="file" class="form-control" name="file" id="file">
            </div>
            <div class="d-flex justify-content-center">
                <input type="submit" name="saveArticle" class="btn btn-primary" value="Mettre à jour">
            </div>
        </form>
    </div>
<?php } ?>

</form>
</div>

<?php
require_once __DIR__ . '/../templates/footer.php';
?>