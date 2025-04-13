<?php

// Получаем URL главной страницы
$home_url = home_url();


if (defined('BREADCRUMS_CLASS')) {
    $class = BREADCRUMS_CLASS;
} else {
    $class = '';
}
// Начинаем выводить хлебные крошки
echo '<nav class="simple-box pressure breadcrumbs '.$class.'" aria-label="breadcrumbs">';
echo '<a spa href="' . esc_url($home_url) . '">Главная</a> &gt; '; // Ссылка на главную страницу

// Проверяем, находимся ли мы на странице поста
if (is_single()) {
    // Получаем текущий пост
    global $post;
    // Получаем категории поста
    $categories = get_the_category($post->ID);

    // Если есть категории, выводим их
    if (!empty($categories)) {
        // Выводим первую категорию
        $first_category = $categories[0]; // Берем первую категорию
        echo '<a spa href="/articles/">Статьи</a> &gt; ';
        echo '<a spa href="' . esc_url(get_category_link($first_category->term_id)) . '">' . esc_html($first_category->name) . '</a> &gt; ';
    }

    // Выводим заголовок поста
    echo esc_html(get_the_title($post->ID));
} elseif (is_category()) {
    echo '<a spa href="/articles/">Статьи</a> &gt; ';
    // Если находимся на странице категории
    echo esc_html(single_cat_title('', false));
} elseif (is_home()) {
    echo 'Статьи';
} elseif (is_archive()) {
    echo esc_html(get_the_archive_title());
}

echo '</nav>';
