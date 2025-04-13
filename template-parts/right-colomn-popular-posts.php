<?php
$current_category = get_queried_object();

$args = array(
    'post_type' => 'post',
    'posts_per_page' => 5,
    'orderby' => 'comment_count', // Сортировка по количеству комментариев
    'order' => 'DESC',
    'cat' => $current_category->term_id,
);
$new_posts = new WP_Query($args);

if ($new_posts->have_posts()) {
    ?>
    <div class="box radius-30 back-blue articles-colmn pressure">
        <h3>Популярные статьи</h3>
        <?php

        while ($new_posts->have_posts()) {
            $new_posts->the_post();
            print_post_card('small-square');
        }
        wp_reset_postdata();
        ?>
    </div>
    <?php
}

