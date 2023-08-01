<?php

function getPresentation(PDO $pdo): array
{
    $query = $pdo->prepare('SELECT * FROM presentation');
    $query->execute();
    $presentation = $query->fetch(PDO::FETCH_ASSOC);

    return $presentation;
}


function savePresentation(PDO $pdo, string $title, string $content, string|null $image)
{
    $query = $pdo->prepare("UPDATE `presentation` SET `title` = :title, `content` = :content, `image` = :image");
    $query->bindValue(':title', $title, PDO::PARAM_STR);
    $query->bindValue(':content', $content, PDO::PARAM_STR);
    $query->bindValue(':image', $image, PDO::PARAM_STR);
    
    return $query->execute();  
}

