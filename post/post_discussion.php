<?php
require_once('../db/config.php');
require_once('../db/pdo.php');

$postData = $_POST;
if(!isset($postData['subject'], ['content'], ['theme'], ['username'])){
    echo('Vous devez remplir tous les champs.');
    return;
}

$subject = $postData['subject'];
$username = $postData['username'];
$theme = $postData['theme'];
$content = $postData['content'];

$insertMessage = $db->prepare('INSERT INTO discussions(subject, username, theme, content) VALUES (:subject, :username, :theme, :content)');
$insertMessage->execute([
    'subject'=>$subject,
    'username'=>$username,
    'theme'=>$theme,
    'content'=>$content,
]);
?>

<?php require_once('/templates/header.php'); ?>
        <h1 class="succes">discussion ajoutée avec succès !</h1>
            
            <div class="">
                <p class=""><b>Votre message</b> : <?= strip_tags($content); ?></p>
            </div>
    <?php require_once($rootPath.'/templates/footer.php'); ?>