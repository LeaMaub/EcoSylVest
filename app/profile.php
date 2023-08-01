<?php

function getProfileByUserId(PDO $pdo, int $userId): array
{
    $query = $pdo->prepare('SELECT * FROM profile WHERE user_id = :userId');
    $query->bindParam(':userId', $userId, PDO::PARAM_INT);
    $query->execute();
    $profile = $query->fetch(PDO::FETCH_ASSOC);

    return $profile ? $profile : [];
}

function updateProfile($pdo, $id, $description, $hobbies, $birthdate, $city, $image) {
    $query = 'UPDATE profile SET description = :description, hobbies = :hobbies, birthdate = :birthdate, city = :city, image = :image WHERE user_id = :user_id';
    $statement = $pdo->prepare($query);

    $statement->bindValue(':description', $description);
    $statement->bindValue(':hobbies', $hobbies);
    $statement->bindValue(':birthdate', $birthdate);
    $statement->bindValue(':city', $city);
    $statement->bindValue(':image', $image);
    $statement->bindValue(':user_id', $id);

    $statement->execute();
}

function insertProfile($pdo, $id, $description, $hobbies, $birthdate, $city, $image) {
    $query = 'INSERT INTO profile (user_id, description, hobbies, birthdate, city, image) VALUES (:user_id, :description, :hobbies, :birthdate, :city, :image)';
    $statement = $pdo->prepare($query);

    $statement->bindValue(':user_id', $id); 
    $statement->bindValue(':description', $description);
    $statement->bindValue(':hobbies', $hobbies);
    $statement->bindValue(':birthdate', $birthdate);
    $statement->bindValue(':city', $city);
    $statement->bindValue(':image', $image);

    $statement->execute();
}

function updatePassword($pdo, $user_id, $new_password) {
    $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
    $query = 'UPDATE users SET password = :password WHERE ID = :user_id';
    $statement = $pdo->prepare($query);

    $statement->bindValue(':password', $hashed_password);
    $statement->bindValue(':user_id', $user_id);

    $statement->execute();
}




