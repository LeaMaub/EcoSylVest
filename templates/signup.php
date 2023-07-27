<?php
require_once(__DIR__ . '/../db/config.php');
require_once(__DIR__ . '/../db/pdo.php');
require_once(__DIR__ . '/../app/register.php');
require_once(__DIR__ . '/header.php');

// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $adress1 = $_POST['adress1'];
    $adress2 = $_POST['adress2'];
    $pays = $_POST['pays'];
    $region = $_POST['region'];
    $code_postal = $_POST['code_postal'];

    $errors = validateFormData($_POST);

    if (!empty($errors)) {
        // Il y a des erreurs de validation
        $_SESSION['form_errors'] = $errors;
    } else {

        // Stocker les valeurs de formulaire dans des variables de session
        $_SESSION['form_firstname'] = $firstname;
        $_SESSION['form_lastname'] = $lastname;
        $_SESSION['form_username'] = $username;
        $_SESSION['form_email'] = $email;
        $_SESSION['form_adress1'] = $adress1;
        $_SESSION['form_adress2'] = $adress2;
        $_SESSION['form_pays'] = $pays;
        $_SESSION['form_region'] = $region;
        $_SESSION['form_code_postal'] = $code_postal;

        if (registerUser($pdo, $firstname, $lastname, $username, $email, $password, $adress1, $adress2, $pays, $region, $code_postal)) {
            // Inscription réussie, rediriger l'utilisateur vers une page appropriée

            // Réinitialiser les variables de formulaire
            unset($_SESSION['form_firstname']);
            unset($_SESSION['form_lastname']);
            unset($_SESSION['form_username']);
            unset($_SESSION['form_email']);
            unset($_SESSION['form_password']);
            unset($_SESSION['form_adress1']);
            unset($_SESSION['form_adress2']);
            unset($_SESSION['form_pays']);
            unset($_SESSION['form_region']);
            unset($_SESSION['form_code_postal']);

            header("Location: /../templates/login.php");
            exit();
        } else {
        }
    }
}
?>

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
                <form class="p-4 p-md-5 border rounded-3 bg-body-tertiary needs-validation" action="" method="post" novalidate="">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="firstame" name="firstname" placeholder="First Name" required value="<?= htmlspecialchars(isset($_SESSION['form_firstname']) ? $_SESSION['form_firstname'] : ''); ?>">
                        <label for="firstame">Prénom</label>
                        <?php
                        if (isset($_SESSION['form_errors']['firstname'])) {
                            echo '<div class="error">' . $_SESSION['form_errors']['firstname'] . '</div>';
                            unset($_SESSION['form_errors']['firstname']);
                        }
                        ?>
                    </div>

                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="lastame" name="lastname" placeholder="Last Name" required value="<?= htmlspecialchars(isset($_SESSION['form_lastname']) ? $_SESSION['form_lastname'] : ''); ?>">
                        <label for="lastame">Nom</label>
                        <?php
                        if (isset($_SESSION['form_errors']['lastname'])) {
                            echo '<div class="error">' . $_SESSION['form_errors']['lastname'] . '</div>';
                            unset($_SESSION['form_errors']['lastname']);
                        }
                        ?>
                    </div>

                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="username" name="username" placeholder="Username" required>
                        <label for="username">Nom d'utilisateur</label>
                        <?php
                        if (isset($_SESSION['error'])) {
                            echo '<div class="warning">' . $_SESSION['error'] . '</div>';
                            unset($_SESSION['error']);  // effacer le message après l'affichage
                        }

                        if (isset($_SESSION['form_errors']['username'])) {
                            echo '<div class="error">' . $_SESSION['form_errors']['username'] . '</div>';
                            unset($_SESSION['form_errors']['username']);
                        }
                        ?>
                    </div>

                    <div class="form-floating mb-3">
                        <input type="email" class="form-control" id="email" name="email" placeholder="you@example.com" required value="<?= htmlspecialchars(isset($_SESSION['form_email']) ? $_SESSION['form_email'] : ''); ?>">
                        <label for="email">Email</label>
                        <?php
                        if (isset($_SESSION['error_email'])) {
                            echo '<div class="warning">' . $_SESSION['error_email'] . '</div>';
                            unset($_SESSION['error_email']);  // effacer le message après l'affichage
                        }

                        if (isset($_SESSION['form_errors']['email'])) {
                            echo '<div class="error">' . $_SESSION['form_errors']['email'] . '</div>';
                            unset($_SESSION['form_errors']['email']);
                        }
                        ?>
                    </div>

                    <div class="form-floating mb-3">
                        <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                        <label for="password">Mot de passe</label>
                        <?php
                        if (isset($_SESSION['form_errors']['password'])) {
                            echo '<div class="error">' . $_SESSION['form_errors']['password'] . '</div>';
                            unset($_SESSION['form_errors']['password']);
                        }
                        ?>
                    </div>

                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="adress1" name="adress1" placeholder="1234 Main St" required value="<?= htmlspecialchars(isset($_SESSION['form_adress1']) ? $_SESSION['form_adress1'] : ''); ?>">
                        <label for="adress1">Adresse</label>
                        <?php
                        if (isset($_SESSION['form_errors']['adress1'])) {
                            echo '<div class="error">' . $_SESSION['form_errors']['adress1'] . '</div>';
                            unset($_SESSION['form_errors']['adress1']);
                        }
                        ?>
                    </div>

                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="adress2" name="adress2" placeholder="Apartment or suite" value="<?= htmlspecialchars(isset($_SESSION['form_adress2']) ? $_SESSION['form_adress2'] : ''); ?>">
                        <label for="adress2">Adresse 2</label>
                    </div>

                    <div class="form-floating mb-3">
                        <select class="form-select" id="pays" name="pays" required value="<?= htmlspecialchars(isset($_SESSION['form_pays']) ? $_SESSION['form_pays'] : ''); ?>">
                            <option value="">Choisir...</option>
                            <option>France</option>
                            <option>Belgique</option>
                            <option>Suisse</option>
                        </select>
                        <label for="pays">Pays</label>
                        <?php
                        if (isset($_SESSION['form_errors']['pays'])) {
                            echo '<div class="error">' . $_SESSION['form_errors']['pays'] . '</div>';
                            unset($_SESSION['form_errors']['pays']);
                        }
                        ?>
                    </div>

                    <div class="form-floating mb-3">
                        <select class="form-select" id="region" name="region" required value="<?= htmlspecialchars(isset($_SESSION['form_region']) ? $_SESSION['form_region'] : ''); ?>">
                            <option value="">Choisir...</option>
                            <option>Provence-Alpes-Côte d'Azur</option>
                            <option>Occitanie</option>
                            <option>Auverge-rhône-Alpes</option>
                        </select>
                        <label for="region">Région</label>
                        <?php
                        if (isset($_SESSION['form_errors']['region'])) {
                            echo '<div class="error">' . $_SESSION['form_errors']['region'] . '</div>';
                            unset($_SESSION['form_errors']['region']);
                        }
                        ?>
                    </div>

                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="code_postal" name="code_postal" placeholder="" required value="<?= htmlspecialchars(isset($_SESSION['form_code_postal']) ? $_SESSION['form_code_postal'] : ''); ?>">
                        <label for="code_postal">Code Postal</label>
                        <?php
                        if (isset($_SESSION['form_errors']['code_postal'])) {
                            echo '<div class="error">' . $_SESSION['form_errors']['code_postal'] . '</div>';
                            unset($_SESSION['form_errors']['code_postal']);
                        }
                        ?>
                    </div>

                    <button class="w-100 btn btn-primary btn-lg" type="submit">S'inscrire</button>
                    <hr class="my-4">
                </form>
            </div>
        </div>
    </div>
</main>

<?php require_once('./footer.php') ?>