<?php
if (session_status() == PHP_SESSION_NONE) {
    session_set_cookie_params([
        'lifetime' => 3600,
        'path' => '/',
        'domain' => _DOMAIN_ ,
        /* 'secure' => true, */
        'httponly' => true
    ]);
    session_start();
}

function adminOnly()
{
    if (!isset($_SESSION['user'])) {
        header('location: http://ecosylvest.fr/templates/login.php');
        exit;
    } else if ($_SESSION['user']['role'] != 'Admin') {
        header('location: http://ecosylvest.fr/index.php');
        exit;
    }
    
}