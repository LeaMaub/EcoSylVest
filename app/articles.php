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

function getArticleById(PDO $pdo, int $id): array
{
    $query = $pdo->prepare('SELECT * FROM articles WHERE id = :id');
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
