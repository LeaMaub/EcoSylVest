<?php require_once('../admin/templates/header.php'); ?>

<h1 class="text-center">Tableau de bord Administrateur</h1>
<div>
<ul class="nav mb-2 justify-content-center mb-md-0 me-5">
                        <li><a href="#" class="nav-link px-2 link-secondary">Ajouter/supprimer un administrateur</a></li>
                        <li><a href="articles.php" class="nav-link px-2 link-secondary">Ajouter/supprimer un article</a></li>
                        <li><a href="#" class="nav-link px-2 link-secondary">Ajouter/supprimer un reportage</a></li>
                        <li><a href="#" class="nav-link px-2 link-secondary">Modifier les dernières nouvelles</a></li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Gestion du forum
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="#">Supprimer un sujet</a></li>
                                <li><a class="dropdown-item" href="#">Supprimer un commentaire</a></li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Modifier une page
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="#">Accueil</a></li>
                                <li><a class="dropdown-item" href="#">À propos</a></li>
                            </ul>
                        </li>
                    </ul>
</div>
<?php require_once('../templates/footer.php'); ?>