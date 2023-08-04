<?php

function getArticle(PDO $pdo, int $limit = null, int $page = null):array
{
    $sql = 'SELECT * FROM articles ORDER BY ID DESC ';
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
    $articles = $query->fetchAll(PDO::FETCH_ASSOC);

    return $articles;
}

function getTotalArticles(PDO $pdo): int
{
    $query = $pdo->prepare('SELECT COUNT(*) as total FROM articles');
    $query->execute();
    $result = $query->fetch(PDO::FETCH_ASSOC);

    return $result['total'];
}

function getArticleById(PDO $pdo, int $id): array
{
    $query = $pdo->prepare('SELECT * FROM articles WHERE ID = :id');
    $query->bindParam(':id', $id, PDO::PARAM_INT);
    $query->execute();
    $article = $query->fetch(PDO::FETCH_ASSOC);

    return $article;
}

function getCategoryArticles(PDO $pdo, $category):array /* si deux type : array|bool */ 
{
    $query = $pdo->prepare('SELECT * FROM articles WHERE category = :category ORDER BY id DESC');
    $query->bindParam(':category', $category, PDO::PARAM_STR);
    $query->execute();
    $categoryArticles = $query->fetchAll(PDO::FETCH_ASSOC);

    return $categoryArticles;
}

function getOneArticle(PDO $pdo, $category): array 
{
    $query = $pdo->prepare('SELECT * FROM articles WHERE category = :category ORDER BY id DESC LIMIT 1');
    $query->bindParam(':category', $category, PDO::PARAM_STR);
    $query->execute();
    $oneArticle = $query->fetch(PDO::FETCH_ASSOC);

    return $oneArticle;
}

function saveArticle(PDO $pdo, string $title, string $subtitle, string $content, string|null $image, int $theme_id, string $category, int $id = null):bool 
{
    if ($id === null) {
        $query = $pdo->prepare("INSERT INTO articles (title, subtitle, content, image, theme_id, category) "
        ."VALUES(:title, :subtitle, :content, :image, :theme_id, :category)");
    } else {
        $query = $pdo->prepare("UPDATE `articles` SET `title` = :title, "
        ."`subtitle` = :subtitle, "
        ."`content` = :content, "
        ."image = :image, theme_id = :theme_id, category = :category WHERE `id` = :id;");
        $query->bindValue(':id', $id, $pdo::PARAM_INT);
    }    

    $query->bindValue(':title', $title, $pdo::PARAM_STR);
    $query->bindValue(':subtitle', $subtitle, $pdo::PARAM_STR);
    $query->bindValue(':content', $content, $pdo::PARAM_STR);
    $query->bindValue(':image',$image, $pdo::PARAM_STR);
    $query->bindValue(':theme_id',$theme_id, $pdo::PARAM_INT);
    $query->bindValue(':category', $category, PDO::PARAM_STR);

    return $query->execute();  
}

function deleteArticle(PDO $pdo, int $id):bool
{
    
    $query = $pdo->prepare("DELETE FROM articles WHERE id = :id");
    $query->bindValue(':id', $id, $pdo::PARAM_INT);

    $query->execute();
    if ($query->rowCount() > 0) {
        return true;
    } else {
        return false;
    }
}
