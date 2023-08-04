<?php
require_once('../db/config.php');
require_once('../db/pdo.php');

session_start();

if (!isset($_SESSION['user'])) {
    echo "Vous devez être connecté pour créer une discussion.";
    return;
}

$userId = $_SESSION['user']['ID']; // Récupération de l'ID utilisateur depuis la session

$postData = $_POST;
if (!isset($postData['subject'], $postData['content'], $postData['theme'])) {
    echo('Vous devez remplir tous les champs.');
    return;
}

$subject = $postData['subject'];
$theme = $postData['theme'];
$content = $postData['content'];

$insertMessage = $pdo->prepare('INSERT INTO discussions(subject, theme, content, user_id) VALUES (:subject, :theme, :content, :user_id)');
$insertMessage->execute([
    'subject' => $subject,
    'theme' => $theme,
    'content' => $content,
    'user_id' => $userId
]);

?>

<?php require_once('../templates/header.php'); ?>
        <h1 class="succes text-center mt-3">discussion ajoutée avec succès !</h1>
            
            <div class="d-flex justify-content-center align-items-center">
                <p class="text-center"><b>Votre message</b> : <?= strip_tags($content); ?></p>
            </div>
    <?php require_once('../templates/footer.php'); ?>