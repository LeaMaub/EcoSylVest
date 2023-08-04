<?php
require_once(__DIR__ . '/../db/config.php');
require_once(__DIR__ . '/../db/pdo.php');
require_once(__DIR__ . '/../app/session.php');

$reply_id = $_GET['reply_id'];
$user_id = $_SESSION['user']['ID'];

if (!filter_var($reply_id, FILTER_VALIDATE_INT)) {
    // Traitement de l'erreur: l'ID doit être un nombre entier
    exit();
}

$query = $pdo->prepare('SELECT * FROM reply_likes WHERE reply_id = :reply_id AND user_id = :user_id');
$query->bindParam(':reply_id', $reply_id);
$query->bindParam(':user_id', $user_id);
$query->execute();
if ($like = $query->fetch()) {
    // Si l'utilisateur a déjà aimé cette réponse, supprimer le like
    $query = $pdo->prepare('DELETE FROM reply_likes WHERE reply_id = :reply_id AND user_id = :user_id');
    $query->bindParam(':reply_id', $reply_id);
    $query->bindParam(':user_id', $user_id);
    $query->execute();
} else {
    $query = $pdo->prepare('INSERT INTO reply_likes (reply_id, user_id) VALUES (:reply_id, :user_id)');
    $query->bindParam(':reply_id', $reply_id);
    $query->bindParam(':user_id', $user_id);
    $query->execute();
}

// Récupérer le nouveau nombre de likes pour cette réponse
$query = $pdo->prepare('SELECT COUNT(*) as like_count FROM reply_likes WHERE reply_id = :reply_id');
$query->bindParam(':reply_id', $reply_id);
$query->execute();
$like_count = $query->fetch()['like_count'];

// Imprimer le nouveau nombre de likes
echo $like_count;

// Terminer le script ici
exit();
?>
