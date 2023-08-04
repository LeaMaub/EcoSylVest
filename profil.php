<?php
require_once __DIR__ . '/templates/header.php';
require_once __DIR__ . '/db/pdo.php';
require_once __DIR__ . '/app/users.php';
require_once __DIR__ . '/app/profile.php';

$user = null;
$profile = null;

if (isset($_SESSION['user'])) {
    $id = $_SESSION['user']['ID'];
    $user = getUserById($pdo, $id);
    $profile = getProfileByUserId($pdo, $id);
} else {
    header('Location: /templates/login.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $description = $_POST['description'] ?? $profile['description'];
    $hobbies = $_POST['hobbies'] ?? $profile['hobbies'];
    $birthdate = $_POST['birthdate'] ?? $profile['birthdate'];
    $city = $_POST['city'] ?? $profile['city'];
    $image = isset($profile['image']) ? $profile['image'] : ''; // Garder l'image existante par défaut
    $current_password = $_POST['password'] ?? '';
    $new_password = $_POST['new_password'] ?? '';
    $confirm_password = $_POST['confirm_password'] ?? '';

    $password_errors = [];

    if (!empty($current_password) && !empty($new_password) && !empty($confirm_password)) {
        if (password_verify($current_password, $user['password'])) {
            if ($new_password === $confirm_password) {
                updatePassword($pdo, $id, $new_password);
            } else {
                $password_errors[] = "Le nouveau mot de passe et la confirmation ne correspondent pas.";
            }
        } else {
            $password_errors[] = "Le mot de passe actuel fourni n'est pas correct.";
        }
    }

    if (isset($_FILES['profile_pic']) && !empty($_FILES['profile_pic']['tmp_name'])) {
        $errors = array();
        $file_name = $_FILES['profile_pic']['name'];
        $file_size = $_FILES['profile_pic']['size'];
        $file_tmp = $_FILES['profile_pic']['tmp_name'];
        $file_type = $_FILES['profile_pic']['type'];

        // Vérification de la taille du fichier 
        if ($file_size > 10 * 1024 * 1024) { // 10 MB
            $errors[] = "Le fichier est trop grand. Taille maximale : 10MB.";
        }

        $temp = explode('.', $file_name);
        $file_ext = strtolower(end($temp));

        $extensions = array("jpeg", "jpg", "png");

        if (in_array($file_ext, $extensions) === false) {
            $errors[] = "Ce type d'extension n'est pas autorisé, choisissez une extension JPEG, JPG ou PNG s'il vous plaît.";
        }

        if (empty($errors) == true) {
            $unique_name = uniqid() . '.' . $file_ext;
            move_uploaded_file($file_tmp, "uploads/newprofile/" . $unique_name);
            $image = "uploads/newprofile/" . $unique_name;
        } else {
            print_r($errors);
        }
    }

    if ($profile) {
        updateProfile($pdo, $id, $description, $hobbies, $birthdate, $city, $image);
    } else {
        insertProfile($pdo, $id, $description, $hobbies, $birthdate, $city, $image);
    }

    $profile = getProfileByUserId($pdo, $id);
}
?>

<main>

    <div class="container">

        <div class="profile-header d-flex align-items-center justify-content-center">
            <img id="profile-image" src="<?= isset($profile) && isset($profile['image']) ? $profile['image'] : ''; ?>" alt="Photo de profil">
            <h1 class="text-center">Mon profil</h1>
        </div>

        <form method="POST" enctype="multipart/form-data">
            <div class="form-group d-flex align-items-center justify-content-center my-4">
                <label for="profile_pic"></label>
                <input type="file" id="profile_pic" name="profile_pic">
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea class="form-control" id="description" name="description"><?= isset($profile) && isset($profile['description']) ? htmlspecialchars($profile['description'], ENT_QUOTES, 'UTF-8') : ''; ?></textarea>
            </div>
            <div class="form-group">
                <label for="hobbies">Passions</label>
                <input type="text" class="form-control" id="hobbies" name="hobbies" value="<?= isset($profile) && isset($profile['hobbies']) ? htmlspecialchars($profile['hobbies'], ENT_QUOTES, 'UTF-8') : ''; ?>">
            </div>
            <div class="form-group">
                <label for="birthdate">Date de naissance</label>
                <input type="date" class="form-control" id="birthdate" name="birthdate" value="<?= isset($profile) && isset($profile['birthdate']) ? $profile['birthdate'] : ''; ?>">
            </div>
            <div class="form-group">
                <label for="city">Ville</label>
                <input type="text" class="form-control" id="city" name="city" value="<?= isset($profile) && isset($profile['city']) ? htmlspecialchars($profile['city'], ENT_QUOTES, 'UTF-8') : ''; ?>">
            </div>
            <h2>Informations du compte</h2>
            <div class="user-info">
                <h5>Prénom : </h5>
                <p><?= isset($user) && isset($user['firstname']) ? $user['firstname'] : ''; ?></p>
            </div>
            <div class="user-info">
                <h5>Nom : </h5>
                <p><?= isset($user) && isset($user['lastname']) ? $user['lastname'] : ''; ?></p>
            </div>
            <div class="user-info">
                <h5>Email : </h5>
                <p><?= isset($user) && isset($user['email']) ? $user['email'] : ''; ?></p>
                <button class="btn btn-primary modify-email-button">Modifier</button>
            </div>
            <h2>Modifier le mot de passe</h2>
            <div class="form-group">
                <label for="password">Mot de passe actuel</label>
                <input type="password" class="form-control" id="password" name="password">
            </div>
            <div class="form-group">
                <label for="new_password">Nouveau mot de passe</label>
                <input type="password" class="form-control" id="new_password" name="new_password">
            </div>
            <div class="form-group">
                <label for="confirm_password">Confirmez le nouveau mot de passe</label>
                <input type="password" class="form-control" id="confirm_password" name="confirm_password">
            </div>

            <?php if (!empty($password_errors)) : ?>
                <div class="error-messages">
                    <?php foreach ($password_errors as $error) : ?>
                        <p class="error"><?= $error; ?></p>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

            <div class="d-flex justify-content-center mt-5">
                <button type="submit" class="btn btn-primary">Mettre à jour</button>
            </div>

        </form>
    </div>

</main>

<?php require_once __DIR__ . '/templates/footer.php'; ?>