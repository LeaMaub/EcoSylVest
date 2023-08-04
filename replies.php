<?php
require_once(__DIR__ . '/db/config.php');
require_once(__DIR__ . '/db/pdo.php');
require_once(__DIR__ . '/app/discussions.php');
require_once(__DIR__ . '/templates/header.php');

if (!isset($_SESSION['user'])) {
    header("Location: templates/login.php"); 
    exit();
}

$discussionId = $_GET['id'];

$discussion = getDiscussionById($pdo, $discussionId);
$replies = getRepliesByDiscussionId($pdo, $discussionId);

?>
<div class="content d-flex flex-grow-1">
    <div class="container d-flex flex-column justify-content-center">
        <div class="row">
            <div class="col-lg-12 mx-auto my-3 p-2 bg-body rounded shadow-sm">
                <h6 class="border-bottom pb-2 mb-0 text-center display-6"><?= htmlspecialchars($discussion['subject']) ?></h6>
                <div class="px-3 py-3">
                    <p class="subjectContent mt-3"><?= htmlspecialchars($discussion['content']) ?></p>
                    <br />
                    <div class="text-end date">
                        <?= $discussion['date_creation'] ?>
                    </div>
                </div>
                <br />
                <?php foreach ($replies as $reply) { ?>
                    <div class='reply mb-1'>
                        <strong>@<?= htmlspecialchars($reply['username']) ?></strong>
                        <br />
                        <?= htmlspecialchars($reply['content']) ?>
                        <br />
                        <div class="text-end date">
                            <a href="#" class="like-button text-decoration-none" data-reply-id="<?= $reply['ID'] ?>" data-discussion-id="<?= $discussionId ?>">
                                <i class="fa-regular fa-thumbs-up" style="color: #2a3c24" id="like-icon-<?= $reply['ID'] ?>"></i>
                                <span id="like-count-<?= $reply['ID'] ?>" style="color: #2a3c24"><?= $reply['like_count'] ?></span>
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
<script src="like.js"></script>
<?php require_once(__DIR__ . '/templates/footer.php'); ?>