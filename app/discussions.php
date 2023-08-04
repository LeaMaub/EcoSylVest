<?php

function getDiscussions(PDO $pdo): array
{
    $query = $pdo->prepare('SELECT * FROM discussions');
    $query->execute();
    $discussions = $query->fetchAll(PDO::FETCH_ASSOC);

    return $discussions;
}

function getThemedDiscussions(PDO $pdo, $theme = null): array
{
    $sql = 'SELECT discussions.*, users.username FROM discussions LEFT JOIN users ON discussions.user_id = users.ID';
    if ($theme !== null) {
        $sql .= ' WHERE discussions.theme = :theme';
    }

    $query = $pdo->prepare($sql);
    if ($theme !== null) {
        $query->bindValue(':theme', $theme);
    }
    $query->execute();

    $discussions = $query->fetchAll(PDO::FETCH_ASSOC);

    foreach ($discussions as $key => $discussion) {
        switch ($discussion['theme']) {
            case 'Faune':
                $discussions[$key]['themeSvg'] = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512" width="30" height="30">
                <path d="M181.5 197.1l12.9 6.4c5.9 3 12.4 4.5 19.1 4.5c23.5 0 42.6-19.1 42.6-42.6V144c0-35.3-28.7-64-64-64H128c-35.3 0-64 28.7-64 64v21.4c0 23.5 19.1 42.6 42.6 42.6c6.6 0 13.1-1.5 19.1-4.5l12.9-6.4 8.4-4.2L135.1 185c-4.5-3-7.1-8-7.1-13.3V168c0-13.3 10.7-24 24-24h16c13.3 0 24 10.7 24 24v3.7c0 5.3-2.7 10.3-7.1 13.3l-11.8 7.9 8.4 4.2zm-8.6 49.4L160 240l-12.9 6.4c-12.6 6.3-26.5 9.6-40.5 9.6c-3.6 0-7.1-.2-10.6-.6v.6c0 35.3 28.7 64 64 64h64c17.7 0 32 14.3 32 32s-14.3 32-32 32H384V336 320c0-23.7 12.9-44.4 32-55.4c9.4-5.4 20.3-8.6 32-8.6V240c0-26.5 21.5-48 48-48c8.8 0 16 7.2 16 16v32 16 48c0 8.8 7.2 16 16 16s16-7.2 16-16V204.3c0-48.2-30.8-91-76.6-106.3l-8.5-2.8c-8-2.7-12.6-11.1-10.4-19.3s10.3-13.2 18.6-11.6l19.9 4C576 86.1 640 164.2 640 254.9l0 1.1h0c0 123.7-100.3 224-224 224h-1.1H256h-.6C132 480 32 380 32 256.6V256 216.8c-10.1-14.6-16-32.3-16-51.4V144l0-1.4C6.7 139.3 0 130.5 0 120c0-13.3 10.7-24 24-24h2.8C44.8 58.2 83.3 32 128 32h64c44.7 0 83.2 26.2 101.2 64H296c13.3 0 24 10.7 24 24c0 10.5-6.7 19.3-16 22.6l0 1.4v21.4c0 1.4 0 2.8-.1 4.3c12-6.2 25.7-9.6 40.1-9.6h8c17.7 0 32 14.3 32 32s-14.3 32-32 32h-8c-13.3 0-24 10.7-24 24v8h56.4c-15.2 17-24.4 39.4-24.4 64H320c-42.3 0-78.2-27.4-91-65.3c-5.1 .9-10.3 1.3-15.6 1.3c-14.1 0-27.9-3.3-40.5-9.6zM96 128a16 16 0 1 1 0 32 16 16 0 1 1 0-32zm112 16a16 16 0 1 1 32 0 16 16 0 1 1 -32 0z" fill="#2A3C24" />
            </svg>';
                break;
            case 'Flore':
                $discussions[$key]['themeSvg'] = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512" width="30" height="30">
                <path d="M384 312.7c-55.1 136.7-187.1 54-187.1 54-40.5 81.8-107.4 134.4-184.6 134.7-16.1 0-16.6-24.4 0-24.4 64.4-.3 120.5-42.7 157.2-110.1-41.1 15.9-118.6 27.9-161.6-82.2 109-44.9 159.1 11.2 178.3 45.5 9.9-24.4 17-50.9 21.6-79.7 0 0-139.7 21.9-149.5-98.1 119.1-47.9 152.6 76.7 152.6 76.7 1.6-16.7 3.3-52.6 3.3-53.4 0 0-106.3-73.7-38.1-165.2 124.6 43 61.4 162.4 61.4 162.4.5 1.6.5 23.8 0 33.4 0 0 45.2-89 136.4-57.5-4.2 134-141.9 106.4-141.9 106.4-4.4 27.4-11.2 53.4-20 77.5 0 0 83-91.8 172-20z" fill="#2A3C24" />
            </svg>';
                break;
            case 'Astuces' :
                $discussions[$key]['themeSvg'] = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" width="30" height="30">
                <path d="M288 0H160 128C110.3 0 96 14.3 96 32s14.3 32 32 32V196.8c0 11.8-3.3 23.5-9.5 33.5L10.3 406.2C3.6 417.2 0 429.7 0 442.6C0 480.9 31.1 512 69.4 512H378.6c38.3 0 69.4-31.1 69.4-69.4c0-12.8-3.6-25.4-10.3-36.4L329.5 230.4c-6.2-10.1-9.5-21.7-9.5-33.5V64c17.7 0 32-14.3 32-32s-14.3-32-32-32H288zM192 196.8V64h64V196.8c0 23.7 6.6 46.9 19 67.1L309.5 320h-171L173 263.9c12.4-20.2 19-43.4 19-67.1z" fill="#2A3C24" />
            </svg>';
                break;
            default:
                $discussions[$key]['themeSvg'] = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" width="30" height="30">
                <path d="M224 32C106 32 0 130.5 0 247.9 0 370.6 136.3 472 344.3 511.9c8.8 1.7 17.7-5.5 17.7-14.3V32c0-12.8-10.2-23.2-22.9-25.2-6.7-1-13.4-1.7-20.1-1.8zm121.6 359.4l-19.6-29.4c-3.2-4.8-9.8-6.1-15-3.7l-23.6 11.1v-49.8c0-5.6-3.5-10.7-8.9-12.9l-48-19.2v-38.4l23.2 8.7c5.9 2.2 12.6-.7 14-7.4l8.8-33.5 27.1 10.2c5.9 2.2 12.6-.7 14-7.4l8.8-33.5 27.1 10.2c6.1 2.3 12.9-.5 14.7-6.4l9.2-30.3h31.7l-10.4 31.7c-1.6 4.8 1.3 9.9 6.1 11.6l26.8 9.5-9-34.1c-1.6-4.8 1.3-9.9 6.1-11.6l26.8-9.5-9-34.1h31.7l-10.4 31.7c-1.6 4.8 1.3 9.9 6.1 11.6l26.8 9.5-9.5 36.2c-1.6 6.2-7.8 10.1-14.2 8.1l-26.8-10.2-8.1 30.8c-1.8 6.8-8.7 10.7-15.4 8.1l-27.1-10.2-8.1 30.8c-1.8 6.8-8.7 10.7-15.4 8.1l-27.1-10.2-8.8 33.5c-1.4 5.6-8.2 9.6-14 7.4l-22.4-8.4v38.4l48 19.2c5.3 2.2 8.9 7.3 8.9 12.9v49.8l-23.6-11.1c-5.2-2.4-11.8-.1-15 3.7l-19.6 29.4c-11.7-3.6-22.7-8.7-33.2-15.2z" fill="#F15A29"/></svg>';
                break;
        }
    }

    return $discussions;
}

function getThreeMessages(PDO $pdo, $date): array 
{
    $query = $pdo->prepare('SELECT * FROM articles WHERE date_creation = :date_creation ORDER BY date DESC LIMIT 3');
    $query->bindParam(':date_creation', $date, PDO::PARAM_STR);
    $query->execute();
    $threeMessages = $query->fetchAll(PDO::FETCH_ASSOC);

    return $threeMessages;
}

function getPictureUser(PDO $pdo, $userId)
{
    $query = $pdo->prepare("SELECT image FROM profile WHERE user_id = :user_id");
    $query->bindParam(":user_id", $userId, PDO::PARAM_INT);
    $query->execute();
    $picture = $query->fetch(PDO::FETCH_ASSOC);

    return $picture;
}

function getUsernameOfAuthor(PDO $pdo, $authorId)
{
    $query = $pdo->prepare("SELECT username FROM users WHERE ID = :id");
    $query->bindParam(":id", $authorId, PDO::PARAM_INT);
    $query->execute();
    $username = $query->fetch(PDO::FETCH_ASSOC);

    return $username;
}

function getDiscussionById(PDO $pdo, int $id): array
{
    $query = $pdo->prepare('SELECT * FROM discussions WHERE ID = :id');
    $query->bindParam(':id', $id, PDO::PARAM_INT);
    $query->execute();
    $discussion = $query->fetch(PDO::FETCH_ASSOC);

    return $discussion ? $discussion : [];
}

function createDiscussion(PDO $pdo, $subject, $content, $theme, $userId)
{
    $query = $pdo->prepare("INSERT INTO discussions (subject, content, theme, user_id, date_creation) VALUES (:subject, :content, :theme, :user_id, NOW())");
    $query->bindParam(':subject', $subject, PDO::PARAM_STR);
    $query->bindParam(':content', $content, PDO::PARAM_STR);
    $query->bindParam(':theme', $theme, PDO::PARAM_STR);
    $query->bindParam(':user_id', $userId, PDO::PARAM_INT);
    $query->execute();

    return true;
}

function deleteDiscussion(PDO $pdo, int $id):bool
{
    
    $query = $pdo->prepare("DELETE FROM discussions WHERE ID = :id");
    $query->bindValue(':id', $id, $pdo::PARAM_INT);

    $query->execute();
    if ($query->rowCount() > 0) {
        return true;
    } else {
        return false;
    }
}

function getRepliesByDiscussionId($pdo, $discussionId) {
    $query = $pdo->prepare('SELECT replies.ID, replies.content, replies.date_creation, users.username 
                            FROM replies
                            JOIN users ON replies.user_id = users.ID
                            WHERE replies.discussion_id = :discussion_id');
    $query->bindParam(':discussion_id', $discussionId, PDO::PARAM_INT);
    $query->execute();
    $replies = $query->fetchAll(PDO::FETCH_ASSOC);

    foreach ($replies as &$reply) {
        $reply_id = $reply['ID'];
        // Récupère le nombre de likes pour une réponse spécifique
        $query = $pdo->prepare('SELECT COUNT(*) as like_count FROM reply_likes WHERE reply_id = ?');
        $query->execute([$reply_id]);
        $like_count = $query->fetchColumn();

        // Ajoute le nombre de likes à chaque réponse
        $reply['like_count'] = $like_count;
    }

    return $replies;
}

function getRepliesById(PDO $pdo, int $id): array
{
    $query = $pdo->prepare('SELECT * FROM replies WHERE ID = :id');
    $query->bindParam(':id', $id, PDO::PARAM_INT);
    $query->execute();
    $reply = $query->fetch(PDO::FETCH_ASSOC);

    return $reply ? $reply : [];
}

function deleteReply($pdo, $id) {
    $pdo->beginTransaction();

    $query = $pdo->prepare('DELETE FROM reply_likes WHERE reply_id = :reply_id');
    $query->bindParam(':reply_id', $id);
    $query->execute();

    $query = $pdo->prepare('DELETE FROM replies WHERE ID = :id');
    $query->bindParam(':id', $id);
    $query->execute();

    $pdo->commit();

    return $query->rowCount() > 0;
}



