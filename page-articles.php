<?php

/* Template Name: Статьи */

query_posts(array(
    'post_type' => 'post',
    'posts_per_page' => -1 // Получаем все посты
));

require_once ('category.php');