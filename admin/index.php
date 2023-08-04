<?php require_once('../admin/templates/header.php'); ?>

<h1 class="text-center">Tableau de bord Administrateur</h1>
<div>
<ul class="nav mb-2 justify-content-center mb-md-0 me-5">
<li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Gestion du/des administrateur(s)
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="addAdmin.php">Ajouter</a></li>
                                <li><a class="dropdown-item" href="admins.php">Supprimer</a></li>
                            </ul>
</li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Modifier les articles
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="addArticle.php">Ajouter</a></li>
                                <li><a class="dropdown-item" href="articles.php">Modifier/Supprimer</a></li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Modifier les reportages
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="addReportage.php">Ajouter</a></li>
                                <li><a class="dropdown-item" href="reportages.php">Modifier/Supprimer</a></li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Modifier les dernières nouvelle
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="addCarousel.php">Ajouter</a></li>
                                <li><a class="dropdown-item" href="carousel.php">Modifier/Supprimer</a></li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Gestion du forum
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="subjectForum.php">Supprimer un commentaire ou une publication</a></li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Modifier une page
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="editAccueil.php">Accueil</a></li>
                                <li><a class="dropdown-item" href="editAbout.php">À propos</a></li>
                            </ul>
                        </li>
                        <li><a href="users.php" class="nav-link px-2 link-secondary">Bannir/Débannir un utilisateur</a></li>
                    </ul>
</div>
<?php require_once('../templates/footer.php'); ?>