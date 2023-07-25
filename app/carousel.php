<?php

function getCarousel(PDO $pdo): array
{
    $query = $pdo->prepare('SELECT * FROM carousel');
    $query->execute();
    $latestNews = $query->fetchAll(PDO::FETCH_ASSOC);

    return $latestNews;
}