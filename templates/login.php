<?php require_once('./headerLogin.php')?>

<div class="container col-xl-10 col-xxl-8 px-4 py-5">
    <div class="row align-items-center g-lg-5 py-5">
        <div class="col-lg-7 text-center text-lg-start">
            <h1 class="display-4 fw-bold lh-1 text-body-emphasis mb-3">Formulaire de connection centré verticalement</h1>
            <p class="col-lg-10 fs-4">Vous trouverez ci-dessous un exemple de formulaire entièrement construit avec les contrôles de formulaire de Bootstrap. Chaque groupe de formulaires requis possède un état de validation qui peut être déclenché en cas de tentative d'envoi du formulaire sans l'avoir complété.</p>
        </div>
        <div class="col-md-10 mx-auto col-lg-5">
            <form class="p-4 p-md-5 border rounded-3 bg-body-tertiary">
                <div class="form-floating mb-3">
                    <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com">
                    <label for="floatingInput">adresse e-mail</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="password" class="form-control" id="floatingPassword" placeholder="Password">
                    <label for="floatingPassword">Mot de passe</label>
                </div>
                <div class="checkbox mb-3">
                    <label>
                        <input type="checkbox" value="remember-me"> Se rappeler de moi
                    </label>
                </div>
                <button class="w-100 btn btn-lg btn-primary" type="submit">Se connecter</button>
                <hr class="my-4">
            </form>
        </div>
    </div>
</div>

<?php require_once('./footer.php')?>