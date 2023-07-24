<?php

function getPageInfo($menu, $currentPage) {
    if (isset($menu[$currentPage])) {
        return [
            'title' => $menu[$currentPage]['title'],
            'head_title' => $menu[$currentPage]['head_title'],
            'meta_description' => $menu[$currentPage]['meta_description']
        ];
    } else {
        return [
            'title' => "EcoSylVest",
            'head_title' => "EcoSylVest",
            'meta_description' => "Description par défaut"
        ];
    }
}