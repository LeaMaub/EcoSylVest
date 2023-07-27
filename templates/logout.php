<?php
require_once(__DIR__ . '/../db/config.php');
require_once(__DIR__ . '/../app/session.php');
session_destroy();
unset($_SESSION);
header('location: login.php');