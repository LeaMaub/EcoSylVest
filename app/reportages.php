<?php

function getReportages(PDO $pdo): array
{
    $query = $pdo->prepare('SELECT * FROM reportages');
    $query->execute();
    $reportages = $query->fetchAll(PDO::FETCH_ASSOC);

    return $reportages;
}