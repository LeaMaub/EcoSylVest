<?php

function getThemes(PDO $pdo, int $limit = null, int $page = null):array
{
    $sql = 'SELECT * FROM themes';
    $query = $pdo->prepare($sql);
    $query->execute();
    $themes = $query->fetchAll(PDO::FETCH_ASSOC);

    return $themes;
}

$currentTheme = basename($_SERVER['PHP_SELF']);