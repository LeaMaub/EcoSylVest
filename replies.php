<?php
require_once(__DIR__ . '/db/config.php');
require_once(__DIR__ . '/db/pdo.php');
require_once(__DIR__ . '/app/discussions.php');
require_once(__DIR__ . '/templates/header.php');

// Récupérer l'ID de la discussion depuis l'URL
$discussionId = $_GET['id'];

// Récupérer les détails de la discussion et les réponses depuis la base de données
$discussion = getDiscussionById($pdo, $discussionId);
$replies = getRepliesByDiscussionId($pdo, $discussionId);


// Continuer avec le code HTML pour afficher la discussion et les réponses
?>
<div class="content d-flex flex-grow-1">
    <div class="container d-flex flex-column justify-content-center">
        <div class="row">
            <div class="col-lg-12 mx-auto my-3 p-2 bg-body rounded shadow-sm">
                <h6 class="border-bottom pb-2 mb-0 text-center display-6"><?= $discussion['subject'] ?></h6>
                <p class="subjectContent mt-3"><?= $discussion['content'] ?></p>
                <br />
                <div class="date">
                    <?= $discussion['date_creation'] ?>
                </div>
                <br />
                <?php foreach ($replies as $reply) { ?>
                    <div class='reply mb-1'>
                        <strong>@<?= $reply['username'] ?></strong>
                        <br />
                        <?= $reply['content'] ?>
                        <br />
                        <div class="text-end date">
                            <a href="like_reply.php?reply_id=<?= $reply['ID'] ?>" class="like-button text-decoration-none">
                                <i class="fa-regular fa-thumbs-up" id="like-icon-<?= $reply['ID'] ?>"></i>
                                <span id="like-count-<?= $reply['ID'] ?>"><?= $reply['like_count'] ?></span>
                            </a>
                            <br />
                            <?= $reply['date_creation'] ?>
                        </div>
                    </div>
                <?php } ?>
                <form action="/post/add_reply.php" method="post" class="d-flex justify-content-center flex-column align-items-center">
                    <input type="hidden" name="discussion_id" value="<?= $discussionId ?>" />
                    <textarea name="content" class="replies"></textarea>
                    <input type="submit" class="btn btn-primary mt-2" value="Répondre" />
                </form>
            </div>
        </div>
    </div>
</div>