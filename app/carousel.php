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

function getCarouselById(PDO $pdo, int $id): array
{
    $query = $pdo->prepare('SELECT * FROM carousel WHERE ID = :id');
    $query->bindParam(':id', $id, PDO::PARAM_INT);
    $query->execute();
    $carousel = $query->fetch(PDO::FETCH_ASSOC);

    return $carousel ? $carousel : [];
}

function getTotalCarousel(PDO $pdo): int
{
    $query = $pdo->prepare('SELECT COUNT(*) as total FROM carousel');
    $query->execute();
    $result = $query->fetch(PDO::FETCH_ASSOC);

    return $result['total'];
}

function saveCarousel(PDO $pdo, string $title, string $subtitle, string|null $image, int $id = null):bool 
{
    if ($id === null) {
        $query = $pdo->prepare("INSERT INTO carousel (title, subtitle, image) "
        ."VALUES(:title, :subtitle, :image)");
    } else {
        $query = $pdo->prepare("UPDATE `carousel` SET `title` = :title, "
        ."`subtitle` = :subtitle, "
        ."image = :image WHERE `ID` = :id");
        
        $query->bindValue(':id', $id, $pdo::PARAM_INT);
    }

    $query->bindValue(':title', $title, $pdo::PARAM_STR);
    $query->bindValue(':subtitle', $subtitle, $pdo::PARAM_STR);
    $query->bindValue(':image',$image, $pdo::PARAM_STR);
    return $query->execute();  
}

function deleteCarousel(PDO $pdo, int $id):bool
{
    
    $query = $pdo->prepare("DELETE FROM carousel WHERE id = :id");
    $query->bindValue(':id', $id, $pdo::PARAM_INT);

    $query->execute();
    if ($query->rowCount() > 0) {
        return true;
    } else {
        return false;
    }
}