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

function getUserById(PDO $pdo, int $id): array
{
    $query = $pdo->prepare('SELECT * FROM users WHERE ID = :id');
    $query->bindParam(':id', $id, PDO::PARAM_INT);
    $query->execute();
    $users = $query->fetch(PDO::FETCH_ASSOC);

    return $users ? $users : [];
}