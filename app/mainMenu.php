<?php
$menuItems = [
    'index.php' => ['title' => 'Accueil', 'head_title' => 'EcoSylVest',  'meta_description' => 'Découvrez EcoSylVest, votre guide pour explorer le monde naturel. Plongez dans les mystères de la faune et de la flore, découvrez des astuces homéopathiques pour un mode de vie plus sain et engagez-vous dans des discussions captivantes sur notre forum dédié. Rejoignez-nous pour apprendre, partager et protéger notre planète.', 'type' => 'main'],
    'news.php' => ['title' => 'Actualités', 'head_title' => 'EcoSylVest - Actualités',  'meta_description' => 'Restez à jour avec les dernières nouvelles et découvertes sur la faune, la flore et l\'homéopathie avec EcoSylVest.', 'type' => 'main'],
    'forum.php' => ['title' => 'Forum', 'head_title' => 'EcoSylVest - Forum',  'meta_description' => 'Rejoignez la conversation sur notre forum EcoSylVest. Partagez vos idées et expériences sur la faune, la flore et l\'homéopathie.', 'type' => 'main'],
    'about.php' => ['title' => 'À propos', 'head_title' => 'EcoSylVest - À propos',  'meta_description' => 'Apprenez-en plus sur EcoSylVest, votre guide dédié à la faune, la flore et l\'homéopathie. Découvrez notre mission et notre équipe.', 'type' => 'main'],
    'profil.php' => ['title' => 'Profil', 'head_title' => 'EcoSylVest - Profil',  'meta_description' => 'Accédez à votre profil sur EcoSylVest. Gérez vos préférences, participez à notre forum et restez connecté à la nature.', 'type' => 'main']
];

$currentPage = basename($_SERVER['PHP_SELF']); // Récupère le nom du fichier de la page actuelle