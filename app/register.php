<?php

function registerUser($pdo, $firstname, $lastname, $username, $email, $password, $adress1, $adress2, $pays, $region, $code_postal) {
    // Vérifiez si le nom d'utilisateur existe déjà
    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->execute([$username]);

    if ($stmt->rowCount() > 0) {
        // Nom d'utilisateur déjà pris
        $_SESSION['error'] = 'Nom d\'utilisateur déjà pris';
        return false;
    }

    // Vérifiez si l'email existe déjà
    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);

    if ($stmt->rowCount() > 0) {
        // Email déjà utilisé
        $_SESSION['error_email'] = 'Email déjà utilisé';
        return false;
    }

    // Hasher le mot de passe
    $hash = password_hash($password, PASSWORD_BCRYPT);
    $role = 'user';

    // Insérer l'utilisateur dans la base de données
    $stmt = $pdo->prepare("INSERT INTO users (firstname, lastname, adress1, adress2, pays, region, code_postal, email, password, username, role) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

    $stmt->bindParam(1, $firstname);
    $stmt->bindParam(2, $lastname);
    $stmt->bindParam(3, $adress1);
    $stmt->bindParam(4, $adress2);
    $stmt->bindParam(5, $pays);
    $stmt->bindParam(6, $region);
    $stmt->bindParam(7, $code_postal);
    $stmt->bindParam(8, $email);
    $stmt->bindParam(9, $hash);
    $stmt->bindParam(10, $username);
    $stmt->bindParam(11, $role);

    $stmt->execute();

    return $stmt->rowCount() > 0;
}

function validateFormData($data) {
    $errors = [];

    $fieldLabels = [
        'firstname' => 'Prénom',
        'lastname' => 'Nom',
        'username' => 'Nom d\'utilisateur',
        'email' => 'Email',
        'password' => 'Mot de passe',
        'adress1' => 'Adresse',
        'adress2' => 'Adresse 2',
        'pays' => 'Pays',
        'region' => 'Région',
        'code_postal' => 'Code Postal'
    ];

    foreach ($data as $key => $value) {
        if (empty($value)) {
            $label = isset($fieldLabels[$key]) ? $fieldLabels[$key] : $key;
            $errors[$key] = 'Le champ ' . $label . ' est requis.';
        }
    }

    return $errors;
}
?>
