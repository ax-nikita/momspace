<?php
    $current_category = get_queried_object();

    // Получаем все посты из текущей рубрики
    $args = array(
        'category' => $current_category->term_id,
        'posts_per_page' => -1 // Получаем все посты без ограничения
    );

    $posts = get_posts($args);

    // Массив для хранения уникальных тегов
    $cats = array();

    // Проходим по постам и собираем теги
    foreach ($posts as $post) {
        $post_cats = get_post_categories($post->ID);
        if (!empty($post_cats)) {
            foreach ($post_cats as $cat) {
                $cats[$cat['name']] = $cat['link']; // Используем ID тега как ключ для уникальности
            }
        }
    }

    // Выводим теги
    if (!empty($cats) && sizeof($cats) > 1) {
        echo '<div class="simple-box__flex-list gap-10">';
        echo '<input type="checkbox" class="tag-more">';
        foreach ($cats as $cat_name => $cat_link) {
            if($current_category->name != $cat_name) {
                echo '<a spa class="box tag" href="'.$cat_link.'">' . esc_html($cat_name) . '</a> ';
            }
        }
        if (sizeof($cats) > 5) {
            echo '<div class="box tag more" data-id="custom-label" for=".tag-more"><span
                    class="more__txt-more">Показать еще</span><span class="more__txt-hide">Скрыть</span></div>';
        }
        echo '</div>';
    }

    wp_reset_postdata();
?>
