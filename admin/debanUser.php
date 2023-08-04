<?php
require_once __DIR__ . "/../db/config.php";
require_once __DIR__ . "/../db/pdo.php";
require_once __DIR__ . "/../app/session.php";
require_once __DIR__ . "/../app/tools.php";
require_once __DIR__ . "/../app/users.php";

adminOnly();

if (isset($_GET['id'])) {
    $userId = (int)$_GET['id'];
    if (debanUser($pdo, $userId)) {
        
        header('Location: /admin/users.php');
        exit();
    }
}

header('Location: /admin/users.php');
exit();
?>
