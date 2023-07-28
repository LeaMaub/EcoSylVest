<?php
require_once(__DIR__ . '/../db/config.php');
require_once(__DIR__ . '/../db/pdo.php');
require_once(__DIR__ . '/../app/register.php');
require_once(__DIR__ . '/header.php');

// Champ du formulaire
$formFields = ['firstname', 'lastname', 'username', 'email', 'password'];

// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    foreach ($formFields as $field) {
        $$field = $_POST[$field];
        $_SESSION['form_' . $field] = $_POST[$field];
    }

    $errors = validateFormData($_POST);

    if (!empty($errors)) {
        // Il y a des erreurs de validation
        $_SESSION['form_errors'] = $errors;
    } else {
        if (registerUser($pdo, $firstname, $lastname, $username, $email, $password)) {
            // Inscription réussie, rediriger l'utilisateur vers une page appropriée

            // Réinitialiser les variables de formulaire
            foreach ($formFields as $field) {
                unset($_SESSION['form_' . $field]);
            }

            header("Location: /../templates/login.php");
            exit();
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
                </div>
            </div>

            <div class="col-md-10 mx-auto col-lg-8">
                <form class="p-4 p-md-5 border rounded-3 bg-body-tertiary needs-validation" action="" method="post" novalidate="">
                    <?php foreach ($formFields as $field) { ?>
                        <div class="form-floating mb-3">
                            <input type="<?= $field == 'email' ? 'email' : ($field == 'password' ? 'password' : 'text'); ?>" class="form-control" id="<?= $field; ?>" name="<?= $field; ?>" placeholder="<?= isset($fieldLabels[$field]) ? $fieldLabels[$field] : ucfirst($field); ?>" required value="<?= htmlspecialchars(isset($_SESSION['form_' . $field]) ? $_SESSION['form_' . $field] : ''); ?>">
                            <label for="<?= $field; ?>"><?= isset($fieldLabels[$field]) ? $fieldLabels[$field] : ucfirst($field); ?></label>
                            <?php
                            if (isset($_SESSION['form_errors'][$field])) {
                                echo '<div class="error">' . $_SESSION['form_errors'][$field] . '</div>';
                                unset($_SESSION['form_errors'][$field]);
                            }
                            ?>
                        </div>
                    <?php } ?>

                    <button class="w-100 btn btn-primary btn-lg mt-5" type="submit">S'inscrire</button>
                    <hr class="my-4">
                </form>
            </div>
        </div>
    </div>
</main>

<?php require_once('./footer.php') ?>