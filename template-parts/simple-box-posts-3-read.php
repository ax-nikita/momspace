<?php

$args = array(
    'post_type' => 'post',
    'posts_per_page' => 3,
    'orderby' => 'comment_count', // Сортировка по количеству комментариев
    'order' => 'DESC',
    'category' => get_query_var('category_id'),
);

$new_posts = new WP_Query($args);

if ($new_posts->have_posts()) {
    ?>
    <div class="simple-box pressure padding-bottom-69 back-lblue">
        <h2 class="font-size-1-5 padding-bottom-30"><b>Сегодня читают</b></h2>
        <div class="simple-box__wrapper articles-box type-3">
            <?php

            while ($new_posts->have_posts()) {
                $new_posts->the_post();
                print_post_card('green border-0 color-tag');
            }
            wp_reset_postdata();
            ?>
        </div>
    </div>
    <?php
}
?>