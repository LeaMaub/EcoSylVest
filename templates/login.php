<?php
require_once(__DIR__ . '/header.php');
require_once(__DIR__ . '/../db/pdo.php');
require_once(__DIR__ . '/../app/users.php');

$errors = [];

if (isset($_POST['loginUser'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $user = verifyUserLoginPassword($pdo, $email, $password);
    if ($user) {
        if ($user['banned']) {
            $errors[] = "Votre compte a été banni. Veuillez contacter l'administrateur maublea@ert.fr pour plus d'informations.";
        } else {
            session_regenerate_id(true);
            $_SESSION['user'] = $user;
            if ($user['role'] === 'user') {
                header('location: http://ecosylvest.fr');
            exit;
            } elseif ($user['role'] === 'Admin') {
                header('location: http://ecosylvest.fr/admin/index.php');
            exit;
            }
        }
    } else {
        $errors[] = "Email ou mot de passe incorrect";
    }
}    
?>

<div class="container col-xl-10 col-xxl-8 px-4 py-5">
    <div class="row align-items-center g-lg-5 py-5">
        <div class="log-text col-lg-7 text-center text-lg-start">
            <h1 class="display-4 fw-bold lh-1 text-body-emphasis mb-3">Connexion</h1>
            <p class="col-lg-10 fs-4">Connectez-vous pour pouvoir communiquer avec les autres utilisateurs sur le forum et gérer votre profil !</p>
        </div>
        <div class="col-md-10 mx-auto col-lg-5">

            <?php foreach ($errors as $error) { ?>
                <div class="error-login">
                    <?= $error; ?>
                </div>
            <?php } ?>

            <form method="post" action="" class="p-4 p-md-5 border rounded-3 bg-body-tertiary">
                <div class="form-floating mb-3">
                    <input type="email" name="email" class="form-control" id="email" placeholder="name@example.com" required>
                    <label for="email">adresse e-mail</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="password" name="password" class="form-control" id="password" placeholder="Password" required>
                    <label for="password">Mot de passe</label>
                </div>
                <div class="checkbox mb-3">
                    <label>
                        <input type="checkbox" value="remember-me"> Se rappeler de moi
                    </label>
                </div>
                <input class="w-100 btn btn-lg btn-primary" type="submit" name="loginUser" value="Se connecter"></input>
                <hr class="my-4">
            </form>
        </div>
    </div>
</div>

<?php require_once('./footer.php') ?>