<?php

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
