<?php

function getAbout(PDO $pdo): array
{
    $query = $pdo->prepare('SELECT * FROM about');
    $query->execute();
    $about = $query->fetch(PDO::FETCH_ASSOC);

    return $about;
}


function saveAbout(PDO $pdo, string $title, string $content, string|null $image)
{
    $query = $pdo->prepare("UPDATE `about` SET `title` = :title, `content` = :content, `image` = :image");
    $query->bindValue(':title', $title, PDO::PARAM_STR);
    $query->bindValue(':content', $content, PDO::PARAM_STR);
    $query->bindValue(':image', $image, PDO::PARAM_STR);
    
    return $query->execute();  
}

