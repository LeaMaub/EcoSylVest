<?php
$fieldLabels = [
    'firstname' => 'Prénom',
    'lastname' => 'Nom',
    'username' => 'Nom d\'utilisateur',
    'email' => 'Email',
    'password' => 'Mot de passe',
];

function registerUser($pdo, $firstname, $lastname, $username, $email, $password) {
    $errorFields = ['username' => 'Nom d\'utilisateur déjà pris', 'email' => 'Email déjà utilisé'];

    // Ajoutez cette ligne pour suivre si une erreur a été rencontrée
    $hasError = false;

    foreach ($errorFields as $field => $errorMsg) {
        // Vérifiez si le nom d'utilisateur ou l'email existe déjà
        $query = $pdo->prepare("SELECT * FROM users WHERE $field = ?");
        $query->execute([${$field}]);

        if ($query->rowCount() > 0) {
            // Nom d'utilisateur ou Email déjà utilisé
            $_SESSION['form_errors'][$field] = $errorMsg;
            // Marquez qu'une erreur a été rencontrée
            $hasError = true;
        }
    }

    if ($hasError) {
        // Si une erreur a été rencontrée, retournez false
        return false;
    }

    // Hasher le mot de passe
    $password = password_hash($password, PASSWORD_BCRYPT);
    $role = 'user';

    // Insérer l'utilisateur dans la base de données
    $query = $pdo->prepare("INSERT INTO users (firstname, lastname, email, password, username, role) VALUES (:firstname, :lastname, :email, :password, :username, :role)");

    $query->bindParam(':firstname', $firstname, PDO::PARAM_STR);
    $query->bindParam(':lastname', $lastname, PDO::PARAM_STR);
    $query->bindParam(':email', $email, PDO::PARAM_STR);
    $query->bindParam(':password', $password, PDO::PARAM_STR);
    $query->bindParam(':username', $username, PDO::PARAM_STR);
    $query->bindParam(':role', $role, PDO::PARAM_STR);

    $query->execute();

    return $query->rowCount() > 0;
}

function validateFormData($data) {
    $errors = [];

    foreach ($data as $key => $value) {
        if (empty($value)) {
            $label = isset($fieldLabels[$key]) ? $fieldLabels[$key] : $key;
            $errors[$key] = 'Le champ ' . $label . ' est requis.';
        }
    }

    return $errors;
}

?>

