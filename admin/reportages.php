<?php
require_once __DIR__ . '/templates/header.php';
require_once __DIR__ . '/../db/pdo.php';
require_once __DIR__ . '/../app/reportages.php';

if (isset($_GET['page'])) {
    $page = (int)$_GET['page'];
} else {
    $page = 1;
}

$reportages = getReportages($pdo, _ADMIN_ITEM_PER_PAGE_, $page);

$totalReportages = getTotalReportages($pdo);

$totalPages = ceil($totalReportages / _ADMIN_ITEM_PER_PAGE_);
?>

<h1 class='py-5 text-center'>Liste des reportages</h1>

<div class="mx-5">
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
            <?php foreach ($reportages as $reportage) { ?>
                <tr>
                    <th scope="row"><?= $reportage['ID'] ?></th>
                    <td><?= $reportage['title'] ?></td>
                    <td><?= $reportage['subtitle'] ?></td>
                    <td> <a href="editReportage.php?id=<?= $reportage['ID'] ?>" class="text-decoration-none link-secondary">Modifier </a> | <a href="deleteReportage.php?id=<?= $reportage['ID'] ?>" class="text-decoration-none link-secondary">Supprimer</a> </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>


<?php if ($totalPages > 1) { ?>
    <nav aria-label="..." class="d-flex justify-content-center">
        <ul class="pagination pagination-sm">
            <?php for ($i = 1; $i <= $totalPages; $i++) { ?>
                <li class="page-item <?php if ($i === $page) {echo 'active';} ?>">
                    <a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a>
                </li>
            <?php } ?>
        </ul>
    </nav>
<?php } ?>

<?php
require_once __DIR__ . '/../templates/footer.php';
?>