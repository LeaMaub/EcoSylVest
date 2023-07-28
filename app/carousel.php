<?php

function getCarousel(PDO $pdo, int $limit = null, int $page = null):array
{
    $sql = 'SELECT * FROM carousel ORDER BY ID DESC ';
    if($limit && !$page) {
        $sql .= 'LIMIT :limit';
    }
    if ($page) {
        $sql .= 'LIMIT :offset, :limit';
    }

    $query = $pdo->prepare($sql);

    if ($limit) {
        $query->bindValue(':limit', $limit, PDO::PARAM_INT);
    }
    if ($page) {
        $offset = ($page - 1) * $limit;
        $query->bindValue(':offset', $offset, PDO::PARAM_INT);
    }

    $query->execute();
    $carousel = $query->fetchAll(PDO::FETCH_ASSOC);

    return $carousel;
}

function getTotalCarousel(PDO $pdo): int
{
    $query = $pdo->prepare('SELECT COUNT(*) as total FROM carousel');
    $query->execute();
    $result = $query->fetch(PDO::FETCH_ASSOC);

    return $result['total'];
}