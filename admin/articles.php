<?php
require_once __DIR__ . '/templates/header.php';
require_once __DIR__ . '/../db/pdo.php';
require_once __DIR__ . '/../app/articles.php';

if (isset($_GET['page'])) {
    $page = (int)$_GET['page'];
} else {
    $page = 1;
}

$articles = getArticle($pdo, _ADMIN_ITEM_PER_PAGE_, $page);
?>

<h1 class='py-5 text-center'>Liste des articles</h1>

<table class="table">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Titre</th>
            <th scope="col">Sous-titre</th>
            <th scope="col">Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($articles as $article) { ?>
        <tr>
            <th scope="row"><?= $article['ID']?></th>
            <td><?= $article['title']?></td>
            <td><?= $article['subtitle']?></td>
            <td>Modifier | Supprimer</td>
        </tr>
        <?php } ?>
    </tbody>
</table>

<?php
require_once __DIR__ . '/../templates/footer.php';
?>