<?php

$posts_per_page = get_query_var('posts_per_page') ?? round((int) get_query_var('this_page_posts') / 2);
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
$offset = ($paged - 1) * $posts_per_page;

$args = array(
    'post_type' => 'post',
    'posts_per_page' => $posts_per_page,
    'offset' => $offset,
    'orderby' => 'date',
    'order' => 'DESC',
    'category' => get_query_var('category_id') ?? -1,
);

$new_posts = new WP_Query($args);

if ($new_posts->have_posts()) {
    ?>
    <div class="box radius-30 articles-colmn">
        <h3 class="green-heart">Новые статьи</h3>
        <?php

        while ($new_posts->have_posts()) {
            $new_posts->the_post();
            print_post_card('small');
        }
        wp_reset_postdata();
        ?>
    </div>
    <?php
}