<?php

/* Template Name: Статьи */

query_posts(array(
    'post_type' => 'post',
    'posts_per_page' => get_option('posts_per_page', 7),
    'paged' => get_query_var('paged') ? get_query_var('paged') : 1
));

require_once(MOMSPACE_THEME_DIR . '/category.php');