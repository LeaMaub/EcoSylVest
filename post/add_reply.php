<?php
require_once(__DIR__ . '/../db/config.php');
require_once(__DIR__ . '/../db/pdo.php');
require_once(__DIR__ . '/../app/session.php');

if ($_POST) {
    $content = $_POST['content'];
    $discussion_id = $_POST['discussion_id'];
    $user_id = $_SESSION['user']['ID'];

    $query = $pdo->prepare('INSERT INTO replies (content, user_id, discussion_id, date_creation) VALUES (:content, :user_id, :discussion_id, NOW())');
    $query->bindParam(':content', $content);
    $query->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $query->bindParam(':discussion_id', $discussion_id);
    
    if ($query->execute()) {
        header("Location: /replies.php?id=" . $discussion_id);
        exit();
    } else {
        print_r($query->errorInfo());
    }
}
