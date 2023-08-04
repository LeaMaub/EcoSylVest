<?php

function getReportages(PDO $pdo, int $limit = null, int $page = null):array
{
    $sql = 'SELECT * FROM reportages ORDER BY ID DESC ';
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
    $reportages = $query->fetchAll(PDO::FETCH_ASSOC);

    return $reportages;
}

function getReportageById(PDO $pdo, int $id): array
{
    $query = $pdo->prepare('SELECT * FROM reportages WHERE ID = :id');
    $query->bindParam(':id', $id, PDO::PARAM_INT);
    $query->execute();
    $reportage = $query->fetch(PDO::FETCH_ASSOC);

    return $reportage ? $reportage : [];
}


function getTotalReportages(PDO $pdo): int
{
    $query = $pdo->prepare('SELECT COUNT(*) as total FROM reportages');
    $query->execute();
    $result = $query->fetch(PDO::FETCH_ASSOC);

    return $result['total'];
}

function saveReportage(PDO $pdo, string $title, string $subtitle, string $content, string $image = null, int $id = null):bool 
{
    if ($id === null) {
        $query = $pdo->prepare("INSERT INTO reportages (title, subtitle, content, image) "
        ."VALUES(:title, :subtitle, :content, :image)");
    } else {
        $query = $pdo->prepare("UPDATE `reportages` SET `title` = :title, "
        ."`subtitle` = :subtitle, "
        ."`content` = :content, "
        ."image = :image WHERE `id` = :id;");
        
        $query->bindValue(':id', $id, $pdo::PARAM_INT);
    }

    $query->bindValue(':title', $title, $pdo::PARAM_STR);
    $query->bindValue(':subtitle', $subtitle, $pdo::PARAM_STR);
    $query->bindValue(':content', $content, $pdo::PARAM_STR);
    
    $query->bindValue(':image', $image ?? '../assets/images/default.jpg', $pdo::PARAM_STR);
    return $query->execute();  
}

function deleteReportage(PDO $pdo, int $id):bool
{
    
    $query = $pdo->prepare("DELETE FROM reportages WHERE ID = :id");
    $query->bindValue(':id', $id, $pdo::PARAM_INT);

    $query->execute();
    if ($query->rowCount() > 0) {
        return true;
    } else {
        return false;
    }
}
