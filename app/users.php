<?php

function verifyUserLoginPassword(PDO $pdo, string $email, string $password):bool|array
{
    $query = $pdo->prepare('SELECT * FROM users WHERE email = :email');
    $query->bindValue(':email', $email, PDO::PARAM_STR);
    $query->execute();
    $user = $query->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password'])) {
        return $user;
    } else {
        return false;
    }
}

function saveAdmin(PDO $pdo, string $username, string $lastname, string $firstname, string $email, string $password): bool
{
    // Hashage du mot de passe
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $role = 'Admin';

    $query = $pdo->prepare("INSERT INTO users (username, lastname, firstname, email, password, role) VALUES (:username, :lastname, :firstname, :email, :password, :role)");
    $query->bindParam(':username', $username, PDO::PARAM_STR);
    $query->bindParam(':lastname', $lastname, PDO::PARAM_STR);
    $query->bindParam(':firstname', $firstname, PDO::PARAM_STR);
    $query->bindParam(':email', $email, PDO::PARAM_STR);
    $query->bindParam(':password', $hashed_password, PDO::PARAM_STR);
    $query->bindParam(':role', $role, PDO::PARAM_STR);

    return $query->execute();
}

function getAllUsers($pdo) {
    $query = $pdo->prepare("SELECT * FROM users");
    $query->execute();
    return $query->fetchAll(PDO::FETCH_ASSOC);
}

function getUserById(PDO $pdo, int $id): array
{
    $query = $pdo->prepare('SELECT * FROM users WHERE ID = :id');
    $query->bindParam(':id', $id, PDO::PARAM_INT);
    $query->execute();
    $users = $query->fetch(PDO::FETCH_ASSOC);

    return $users ? $users : [];
}

function banUser($pdo, $userId, $ban = true) {
    $bannedValue = $ban ? 1 : 0;
    $query = $pdo->prepare("UPDATE users SET banned = :banned WHERE ID = :id");
    $query->bindParam(':banned', $bannedValue, PDO::PARAM_INT);
    $query->bindParam(':id', $userId, PDO::PARAM_INT);

    return $query->execute();
}

function debanUser($pdo, $userId) {
    $bannedValue = 0; 
    $query = $pdo->prepare("UPDATE users SET banned = :banned WHERE ID = :id");
    $query->bindParam(':banned', $bannedValue, PDO::PARAM_INT);
    $query->bindParam(':id', $userId, PDO::PARAM_INT);

    return $query->execute();
}




