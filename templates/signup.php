<?php require_once(__DIR__ . '/header.php'); ?>

<main>
    <div class="container col-xl-10 col-xxl-8 px-4 py-5">
        <div class="row align-items-center g-lg-5 py-5">
            <div class="d-flex justify-content-center">
                <div class="col-lg-7 text-center text-lg-center">
                    <img class="d-block mx-auto mb-4" src="/assets/images/logo.jpg" alt="" width="72" height="57">
                    <h1 class="display-4 fw-bold lh-1 text-body-emphasis mb-3">Inscription</h1>
                    <p class="col-lg-12 fs-4 mx-auto">
                        Bienvenue sur notre blog ! En vous inscrivant, vous pourrez créer votre propre profil, partager vos pensées sur notre forum et rejoindre 
                        notre communauté grandissante. 
                    </p>
                    <p class="col-lg-12 fs-5 mx-auto">
                        Chaque champ du formulaire est important pour nous aider à mieux vous connaître. Veillez donc à bien remplir chaque partie avant de soumettre 
                        le formulaire. Nous sommes impatients de vous accueillir parmi nous ! 
                    </p>
                </div>
            </div>

            <div class="col-md-10 mx-auto col-lg-8">
                <form class="p-4 p-md-5 border rounded-3 bg-body-tertiary needs-validation" novalidate="">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="firstName" placeholder="First Name" required="">
                        <label for="firstName">Prénom</label>
                        <div class="invalid-feedback">
                            Un prénom valide est requis.
                        </div>
                    </div>

                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="lastName" placeholder="Last Name" required="">
                        <label for="lastName">Nom</label>
                        <div class="invalid-feedback">
                            Un nom valide est requis.
                        </div>
                    </div>

                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="username" placeholder="Username" required="">
                        <label for="username">Nom d'utilisateur</label>
                        <div class="invalid-feedback">
                            Un nom d'utilisateur est requis.
                        </div>
                    </div>

                    <div class="form-floating mb-3">
                        <input type="email" class="form-control" id="email" placeholder="you@example.com">
                        <label for="email">Email</label>
                        <div class="invalid-feedback">
                            Veuillez entrer une adresse email valide pour les mises à jour d'expédition.
                        </div>
                    </div>

                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="address" placeholder="1234 Main St" required="">
                        <label for="address">Adresse</label>
                        <div class="invalid-feedback">
                            Veuillez entrer votre adresse de livraison.
                        </div>
                    </div>

                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="address2" placeholder="Apartment or suite">
                        <label for="address2">Adresse 2</label>
                    </div>

                    <div class="form-floating mb-3">
                        <select class="form-select" id="country" required="">
                            <option value="">Choisir...</option>
                            <option>France</option>
                            <option>Belgique</option>
                            <option>Suisse</option>
                        </select>
                        <label for="country">Pays</label>
                        <div class="invalid-feedback">
                            Veuillez sélectionner un pays valide.
                        </div>
                    </div>

                    <div class="form-floating mb-3">
                        <select class="form-select" id="state" required="">
                            <option value="">Choisir...</option>
                            <option>Provence-Alpes-Côte d'Azur</option>
                            <option>Occitanie</option>
                            <option>Auverge-rhône-Alpes</option>
                        </select>
                        <label for="state">Région</label>
                        <div class="invalid-feedback">
                            Veuillez fournir une région valide.
                        </div>
                    </div>

                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="zip" placeholder="" required="">
                        <label for="zip">Code Postal</label>
                        <div class="invalid-feedback">
                            Le code postal est requis.
                        </div>
                    </div>

                    <button class="w-100 btn btn-primary btn-lg" type="submit">S'inscrire</button>
                    <hr class="my-4">
                </form>
            </div>
        </div>
    </div>
</main>

<?php require_once('./footer.php') ?>