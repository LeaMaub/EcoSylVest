<?php
$reply_id = $_GET['reply_id'];
$user_id = /* Récupérez l'ID de l'utilisateur connecté ici */;

$stmt = $pdo->prepare('SELECT * FROM reply_likes WHERE reply_id = ? AND user_id = ?');
$stmt->execute([$reply_id, $user_id]);
if ($like = $stmt->fetch()) {
    // Si l'utilisateur a déjà aimé cette réponse, supprimer le like
    $stmt = $pdo->prepare('DELETE FROM reply_likes WHERE reply_id = ? AND user_id = ?');
    $stmt->execute([$reply_id, $user_id]);
} else {
    $stmt = $pdo->prepare('INSERT INTO reply_likes (reply_id, user_id) VALUES (?, ?)');
    $stmt->execute([$reply_id, $user_id]);
}

// Rediriger l'utilisateur vers la page des réponses
header("Location: replies.php?id=" . /* ID de la discussion */);
