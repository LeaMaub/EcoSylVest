<?php

function getPresentation(PDO $pdo): array
{
    $query = $pdo->prepare('SELECT * FROM presentation');
    $query->execute();
    $presentation = $query->fetch(PDO::FETCH_ASSOC);

    return $presentation;
}