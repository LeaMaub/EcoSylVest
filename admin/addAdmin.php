<?php
require_once('../admin/templates/header.php');
adminOnly();
require_once __DIR__ . "/../db/pdo.php";
require_once __DIR__ . "/../app/tools.php";
require_once __DIR__ . "/../app/users.php";

$errors = [];
$messages = [];
$users = [
    'username' => '',
    'lastname' => '',
    'firstname' => '',
    'email' => '',
    'password' => ''
];

$pageTitle = "Formulaire ajout administrateur";

if (isset($_POST['saveAdmin'])) {


    if (!$errors) {
        
        $res = saveAdmin($pdo, $_POST["username"], $_POST["lastname"], $_POST["firstname"], $_POST["email"], $_POST["password"]);

        if ($res) {
            $messages[] = "Le nouvel administrateur a bien été enregistré";
            
            $users = [
                'username' => '',
                'lastname' => '',
                'firstname' => '',
                'email' => '',
                'password' => ''
            ];
        } else {
            $errors[] = "Le nouvel administrateur n'a pas été enregistré";
        }
    }
}

?>
<h1 class='text-center'><?= $pageTitle; ?></h1>

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

<div class="d-flex flex-column mx-5">
    <form method="POST" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="text" class="form-control" id="email" name="email" value="<?= $users['email']; ?>">
        </div>
        <div class="mb-3">
            <label for="username" class="form-label">Nom d'utilisateur</label>
            <input type="text" class="form-control" id="username" name="username" value="<?= $users['username']; ?>">
        </div>
        <div class="mb-3">
            <label for="lastname" class="form-label">Nom</label>
            <input type="text" class="form-control" id="lastname" name="lastname" value="<?= $users['lastname']; ?>">
        </div>
        <div class="mb-3">
            <label for="firstname" class="form-label">Prénom</label>
            <input class="form-control" id="firstname" name="firstname" rows="8"><?= $users['firstname']; ?></input>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Mot de passe</label>
            <input type="password" class="form-control" id="password" name="password" value="">
        </div>
        <div class="d-flex justify-content-center">
            <input type="submit" name="saveAdmin" class="btn btn-primary" value="Enregistrer">
        </div>

    </form>
</div>

<?php require_once __DIR__ . "/../templates/footer.php"; ?>