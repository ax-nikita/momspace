<?php

/**
 * momspace functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package momspace
 */


/**
 * define theme info
 * @since 1.0.0
 * */

if (is_child_theme()) {
    $theme = wp_get_theme();
    $parent_theme = $theme->Template;
    $theme_info = wp_get_theme($parent_theme);
} else {
    $theme_info = wp_get_theme();
}

define('MOMSPACE_DEV_MODE', true);
$momspace_version = MOMSPACE_DEV_MODE ? time() : $theme_info->get('Version');
define('MOMSPACE_NAME', $theme_info->get('Name'));
define('MOMSPACE_VERSION', $momspace_version);
define('MOMSPACE_AUTHOR', $theme_info->get('Author'));
define('MOMSPACE_AUTHOR_URI', $theme_info->get('AuthorURI'));


/**
 * Define Const for theme Dir
 * @since 1.0.0
 * */

define('MOMSPACE_THEME_URI', get_template_directory_uri());
define('MOMSPACE_IMG', MOMSPACE_THEME_URI . '/assets/images');
define('MOMSPACE_CSS', MOMSPACE_THEME_URI . '/assets/css');
define('MOMSPACE_JS', MOMSPACE_THEME_URI . '/assets/js');
define('MOMSPACE_THEME_DIR', get_template_directory());
define('MOMSPACE_IMG_DIR', MOMSPACE_THEME_DIR . '/assets/images');
define('MOMSPACE_CSS_DIR', MOMSPACE_THEME_DIR . '/assets/css');
define('MOMSPACE_JS_DIR', MOMSPACE_THEME_DIR . '/assets/js');
define('MOMSPACE_INC', MOMSPACE_THEME_DIR . '/inc');
define('MOMSPACE_THEME_OPTIONS', MOMSPACE_INC . '/theme-options');
define('MOMSPACE_THEME_OPTIONS_IMG', MOMSPACE_THEME_OPTIONS . '/img');
define('MOMSPACE_SVG', MOMSPACE_THEME_DIR . '/inc');
define('MOMSPACE_THEME_SVG', MOMSPACE_IMG_DIR . '/svg');
define('MOMSPACE_THEME_LIBS', MOMSPACE_THEME_DIR . '/libs');
define('MOMSPACE_THEME_DOMLOADER_TEMPLATES_DIR', 'templates-parts');
define('MOMSPACE_THEME_DOMLOADER_TEMPLATES', MOMSPACE_THEME_URI . '/' . MOMSPACE_THEME_DOMLOADER_TEMPLATES_DIR);

if (!function_exists('momspace_get_option')) {
    function momspace_get_option($option = '', $default = null)
    {
        $options = get_option('momspace_theme_options'); // Attention: Set your unique id of the framework
        return (isset($options[$option])) ? $options[$option] : $default;
    }
}

// Кастомные функции
function transliterateen($input)
{
    $gost = array(
        "a" => "а", "b" => "б", "v" => "в", "g" => "г", "d" => "д", "e" => "е", "yo" => "ё",
        "j" => "ж", "z" => "з", "i" => "и", "i" => "й", "k" => "к",
        "l" => "л", "m" => "м", "n" => "н", "o" => "о", "p" => "п", "r" => "р", "s" => "с", "t" => "т",
        "y" => "у", "f" => "ф", "h" => "х", "c" => "ц",
        "ch" => "ч", "sh" => "ш", "sh" => "щ", "i" => "ы", "e" => "е", "u" => "у", "ya" => "я", "A" => "А", "B" => "Б",
        "V" => "В", "G" => "Г", "D" => "Д", "E" => "Е", "Yo" => "Ё", "J" => "Ж", "Z" => "З", "I" => "И", "I" => "Й", "K" => "К", "L" => "Л", "M" => "М",
        "N" => "Н", "O" => "О", "P" => "П",
        "R" => "Р", "S" => "С", "T" => "Т", "Y" => "Ю", "F" => "Ф", "H" => "Х", "C" => "Ц", "Ch" => "Ч", "Sh" => "Ш",
        "Sh" => "Щ", "I" => "Ы", "E" => "Е", "U" => "У", "Ya" => "Я", "'" => "ь", "'" => "Ь", "''" => "ъ", "''" => "Ъ", "j" => "ї", "i" => "и", "g" => "ґ",
        "ye" => "є", "J" => "Ї", "I" => "І",
        "G" => "Ґ", "YE" => "Є"
    );
    return strtr($input, $gost);
}

if (!function_exists('mb_ucwords')) {
    function mb_ucwords($str)
    {
        return mb_convert_case($str, MB_CASE_TITLE, "UTF-8");
    }
}

function transliterate($input)
{
    $gost = array(
        "а" => "a", "б" => "b", "в" => "v", "г" => "g", "д" => "d",
        "е" => "e", "ё" => "yo", "ж" => "j", "з" => "z", "и" => "i",
        "й" => "i", "к" => "k", "л" => "l", "м" => "m", "н" => "n",
        "о" => "o", "п" => "p", "р" => "r", "с" => "s", "т" => "t",
        "у" => "y", "ф" => "f", "х" => "h", "ц" => "c", "ч" => "ch",
        "ш" => "sh", "щ" => "sh", "ы" => "i", "э" => "e", "ю" => "u",
        "я" => "ya",
        "А" => "A", "Б" => "B", "В" => "V", "Г" => "G", "Д" => "D",
        "Е" => "E", "Ё" => "Yo", "Ж" => "J", "З" => "Z", "И" => "I",
        "Й" => "I", "К" => "K", "Л" => "L", "М" => "M", "Н" => "N",
        "О" => "O", "П" => "P", "Р" => "R", "С" => "S", "Т" => "T",
        "У" => "Y", "Ф" => "F", "Х" => "H", "Ц" => "C", "Ч" => "Ch",
        "Ш" => "Sh", "Щ" => "Sh", "Ы" => "I", "Э" => "E", "Ю" => "U",
        "Я" => "Ya",
        "ь" => "", "Ь" => "", "ъ" => "", "Ъ" => "",
        "ї" => "j", "і" => "i", "ґ" => "g", "є" => "ye",
        "Ї" => "J", "І" => "I", "Ґ" => "G", "Є" => "YE"
    );
    return strtr($input, $gost);
}

function buildDomLoaderUrl($url, $type = 'post', $param_array = false)
{
    global $wp_query;

    $queried = get_queried_object();

    $posts_per_page = round(sizeof($wp_query->posts ?? []) / 2);

    if (!$param_array) {
        $array = [
            'post_type' => $type,
            'posts_per_page' => get_option('posts_per_page', 7),
            'paged' => get_query_var('paged') ? get_query_var('paged') : 1,
            'this_page_posts' => $posts_per_page,
            'category_id' => $queried->term_id ?? -1,
            'taxonomy' => 1,
            'domLoader' => ''
        ];
    } else {
        $array['domLoader'] = '';
    }

    return '/' . MOMSPACE_THEME_DOMLOADER_TEMPLATES_DIR . '/' . $url . '?' . http_build_query($array);
}

function upFirstLetter($str, $encoding = 'UTF-8')
{
    return mb_strtoupper(mb_substr($str, 0, 1, $encoding), $encoding)
        . mb_substr($str, 1, null, $encoding);
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */

function momspace_setup()
{

    // make the theme available for translation
    load_theme_textdomain('momspace', get_template_directory() . '/languages');

    // add support for post formats
    add_theme_support('post-formats', [
        'standard', 'image', 'video', 'audio', 'gallery'
    ]);

    // add support for automatic feed links
    add_theme_support('automatic-feed-links');

    // let WordPress manage the document title
    add_theme_support('title-tag');

    // add editor style theme support
    function momspace_theme_add_editor_styles()
    {
        add_editor_style('custom-style.css');
    }

    add_action('admin_init', 'momspace_theme_add_editor_styles');

    // add support for post thumbnails
    add_theme_support('post-thumbnails');

    // hard crop center center
    set_post_thumbnail_size(770, 470, ['center', 'center']);
    add_image_size('momspace-box-slider-small', 96, 96, true);


    // HTML5 markup support for search form, comment form, and comments
    add_theme_support('html5', array(
        'search-form', 'comment-form', 'comment-list', 'gallery', 'caption'
    ));


    /**
     * Add support for core custom logo.
     *
     * @link https://codex.wordpress.org/Theme_Logo
     */
    add_theme_support('custom-logo', array(
        'height' => 150,
        'width' => 300,
        'flex-width' => true,
        'flex-height' => true,
    ));


    // Add theme support for selective refresh for widgets.
    add_theme_support('customize-selective-refresh-widgets');


    /*
     * Enable support for wide alignment class for Gutenberg blocks.
     */
    add_theme_support('align-wide');
    add_theme_support('editor-styles');
    add_theme_support('wp-block-styles');

}

add_action('after_setup_theme', 'momspace_setup');

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */

function momspace_widget_init()
{


    register_sidebar(array(
        'name' => esc_html__('Blog widget area', 'momspace'),
        'id' => 'sidebar-1',
        'description' => esc_html__('Blog Sidebar Widget.', 'momspace'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',

    ));

    register_sidebar(array(
        'name' => esc_html__('Footer Widget Area One', 'momspace'),
        'id' => 'footer-widget-1',
        'description' => esc_html__('Add Footer  widgets here.', 'momspace'),
        'before_widget' => '<div id="%1$s" class="footer-widget widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h4 class="widget-title">',
        'after_title' => '</h4>',
    ));

    register_sidebar(array(
        'name' => esc_html__('Footer Widget Area Two', 'momspace'),
        'id' => 'footer-widget-2',
        'description' => esc_html__('Add Footer widgets here.', 'momspace'),
        'before_widget' => '<div id="%1$s" class="footer-widget widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h4 class="widget-title">',
        'after_title' => '</h4>',
    ));

    register_sidebar(array(
        'name' => esc_html__('Footer Widget Area Three', 'momspace'),
        'id' => 'footer-widget-3',
        'description' => esc_html__('Add Footer widgets here.', 'momspace'),
        'before_widget' => '<div id="%1$s" class="footer-widget widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h4 class="widget-title">',
        'after_title' => '</h4>',
    ));

    register_sidebar(array(
        'name' => esc_html__('Footer Widget Area Four', 'momspace'),
        'id' => 'footer-widget-4',
        'description' => esc_html__('Add Footer widgets here.', 'momspace'),
        'before_widget' => '<div id="%1$s" class="footer-widget widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h4 class="widget-title">',
        'after_title' => '</h4>',
    ));

    register_sidebar(array(
        'name' => esc_html__('Footer Widget Area Five', 'momspace'),
        'id' => 'footer-widget-5',
        'description' => esc_html__('Add Footer widgets here.', 'momspace'),
        'before_widget' => '<div id="%1$s" class="footer-widget widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h4 class="widget-title">',
        'after_title' => '</h4>',
    ));

}

add_action('widgets_init', 'momspace_widget_init');

function cc_mime_types($mimes)
{
    $mimes['svg'] = 'image/svg+xml';
    return $mimes;
}

add_filter('upload_mimes', 'cc_mime_types');

/**
 * Enqueue scripts and styles.
 */
function my_custom_theme_scripts()
{
    // Подключаем Bootstrap CSS
    wp_enqueue_style('bootstrap-css', MOMSPACE_CSS . '/bootstrap.min.css');

    // Подключаем Swiper CSS
    wp_enqueue_style('swiper-css', 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css');

    // Подключаем основной CSS файл
    wp_enqueue_style('main-css', MOMSPACE_CSS . '/style.css');

    // Подключаем jQuery (если не подключен)
    wp_enqueue_script('jquery');

    // Подключаем Swiper JS
    wp_enqueue_script('swiper-js', 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js', array('jquery'), null, true);

    // Подключаем ваш JS файл
    wp_enqueue_script('custom-js', get_template_directory_uri() . '/assets/js/custom.js', array('jquery'), null, true);

    wp_enqueue_script('axnikitaJS', get_template_directory_uri() . '/assets/js/axnikitaJS.js', [], null, true);
}

add_action('wp_enqueue_scripts', 'my_custom_theme_scripts');

function register_my_menus()
{
    register_nav_menus(
        array(
            'header-top' => esc_html__('Header Menu', 'momspace'),
            'header-bottom' => esc_html__('Header Bottom Menu', 'momspace'),
            'footer-menu-sections' => esc_html__('Footer Sections', 'momspace'),
            'footer-menu-articles' => esc_html__('Footer Articles', 'momspace'),
            'footer-menu-development' => esc_html__('Footer Development', 'momspace'),
        )
    );
}

add_action('init', 'register_my_menus');

function replace_submenu_class($classes)
{
    // Удаляем класс sub-menu
    $classes = array_diff($classes, array('sub-menu'));

    // Добавляем класс dropdown-menu
    $classes[] = 'dropdown-menu';

    return $classes;
}

add_filter('nav_menu_submenu_css_class', 'replace_submenu_class');

function add_custom_classes($classes, $item)
{
    // Добавляем класс nav-item к каждому li
    $classes[] = 'nav-item';

    return $classes;
}

add_filter('nav_menu_css_class', 'add_custom_classes', 10, 2);

function add_link_class($atts, $item, $args)
{
    // Добавляем класс nav-link к каждой ссылке
    $atts['class'] = $args->item_class . ' nav-link';
    $atts['spa'] = 'true';

    // Проверяем, есть ли подменю
    if (in_array('menu-item-has-children', $item->classes)) {
        $atts['class'] .= ' dropdown-toggle'; // Добавляем класс dropdown-toggle
    }

    return $atts;
}

add_filter('nav_menu_link_attributes', 'add_link_class', 10, 3);

function custom_wp_nav_menu($items, $args)
{
    if ($args->theme_location == 'header-top') {
        // Добавляем элемент с иконкой "sandwich" только в начале
        $sandwich_icon = '<li class="nav-item"><label class="sandwich" for="open-nav-menu">
                            <svg xmlns="http://www.w3.org/2000/svg" width="38" height="27" viewBox="0 0 38 27" fill="none">
                                <path d="M2 1.5H23.1846" stroke="#231F20" stroke-width="3" stroke-linecap="round"/>
                                <path d="M2 13.5H36.4756" stroke="#231F20" stroke-width="3" stroke-linecap="round"/>
                                <path d="M2 25.5H26.5186" stroke="#231F20" stroke-width="3" stroke-linecap="round"/>
                            </svg>
                        </label></li>';

        // Объединяем иконку с остальными элементами меню

        $items = $sandwich_icon . $items;

    }

    return $items;
}

add_filter('wp_nav_menu_items', 'custom_wp_nav_menu', 10, 2);

function add_dropdown_classes($output, $item, $depth, $args)
{
    if (in_array('menu-item-has-children', $item->classes)) {
        if ($depth === 0) { // Уровень главного меню
            return str_replace('<ul class="sub-menu"', '<ul class="dropdown-menu"', $output);
        }

        return str_replace('<li ', '<li class="dropdown " ', $output);
    }

    return $output;
}

add_filter('walker_nav_menu_start_el', 'add_dropdown_classes', 10, 4);

function modify_nav_menu_links($items, $args)
{
    // Проверяем, что это нужное меню (можно указать имя или ID меню)
    // Например, если у вас меню с именем 'primary', используйте:
    // if ($args->theme_location == 'primary') {

    // Заменяем ссылки, содержащие "СЕРВИС"
    $pattern = '/<a([^>]*)>(.*?) СЕРВИС<\/a>/i';
    $replacement = '<a$1 service>$2</a>';

    // Выполняем замену
    $items = preg_replace($pattern, $replacement, $items);

    return $items;
}

// Применяем функцию к меню
add_filter('wp_nav_menu_items', 'modify_nav_menu_links', 10, 2);

function count_posts_in_current_category() {
    //#OPTIMIZE Ну это дич
    // Получаем текущую категорию
    $current_category = get_queried_object();

    // Проверяем, является ли это объектом категории
    if (isset($current_category->term_id)) {
        // Получаем количество постов в текущей категории
        $args = [
            'category' => $current_category->term_id,
            'post_type' => 'post', // Указываем тип поста
            'posts_per_page' => -1, // Получаем все посты
            'post_status' => 'publish' // Только опубликованные посты
        ];

        $posts = get_posts($args);
        return count($posts); // Возвращаем количество постов
    }

    return 0; // Если категория не найдена, возвращаем 0
}

// Загрузка поста

function print_post_card($class = '')
{

    $categories = get_post_categories(get_the_ID());
    ?>
    <div class="box article-card <?php echo $class; ?>" style="
    <?php
    echo '--gadient-color: '.$categories[0]['color1'].';
            --font-color: '.$categories[0]['color2'];
    ?>">
        <div class="article-card__date">
            <?php the_date(); ?>
        </div>
        <div class="social">
            <span class="social__likes">42</span>
            <span class="social__comments">11</span>
            <span class="social__views">256</span>
        </div>
        <div class="article-card__img">
            <?php the_post_thumbnail('full'); ?>
            <div class="article-card__img__filter"></div>
            <div class="article-card__img__rubric">
            <?php
                $categories = get_post_categories(get_the_ID());

                foreach ($categories as $cat) {
                    echo '<span style="--gadient-color:'.$cat['color1'].';--font-color:'.$cat['color2'].';"><a spa href="'.$cat['link'].'">'.$cat['name'].'</a></span>';
                }
            ?>
            </div>
        </div>
        <span class="article-card__title"><?php the_title(); ?></span>
        <a spa href="<?php the_permalink(); ?>" class="pink-arrow article-card__link">Читать далее</a>
    </div>
    <?php
}

// Ежедневки

function extract_tags_from_content($content): array
{
    require_once(MOMSPACE_THEME_LIBS . "/simple_html_dom.php");
    // Удаляем HTML-теги
    $html = new simple_html_dom();
    $html->load($content);

    $tags = [];

    if ($html) {
        foreach ($html->find('div.article-content__tags') as $tags_el) {
            foreach ($tags_el->find('span') as $tag) {
                $tag = $tag->text();
                $tag = str_replace('#', '', $tag);
                $tag = upFirstLetter($tag);

                $tags[$tag] = true;
            }
        }
    }
    return array_keys($tags);
}

function update_post_tags()
{
    global $wpdb;

    try {
        // Получаем посты с непустым содержимым и без отключенного парсинга тегов
        $query = "
        SELECT p.ID 
        FROM {$wpdb->posts} p 
        LEFT JOIN {$wpdb->postmeta} pm ON p.ID = pm.post_id AND pm.meta_key = 'disable_tag_parsing' AND pm.meta_value = 'true'
        WHERE p.post_type = 'post' 
        AND p.post_status = 'publish' 
        AND p.post_content != '' 
        AND pm.post_id IS NULL
    ";

        $post_ids = $wpdb->get_col($query);

        foreach ($post_ids as $post_id) {
            $post = get_post($post_id);
            $tags = extract_tags_from_content($post->post_content);

            if (!empty($tags)) {
                wp_set_post_terms($post_id, $tags, 'post_tag', false);
            }
        }
        wp_reset_postdata();
    } catch (Throwable $ex) {
        error_log($ex->getMessage());
    }
}

// Привязываем функцию к событию
add_action('save_post', 'update_post_tags');

// Функции получения категорий поста

function get_post_categories($post_id)
{
    // Получаем категории поста
    $categories = get_the_category($post_id);



    // Проверяем, есть ли категории
    if (!empty($categories)) {
        $category_info = []; // Массив для хранения имен и ссылок на категории
        foreach ($categories as $category) {
            // Получаем имя и ссылку на категорию
            $category_info[] = [
                'name' => $category->name, // Имя категории
                'link' => get_category_link($category->term_id), // Ссылка на категорию
                'color1' => get_field('czvet_kategorii', 'category_' .$category->term_id), // Цвет категории
                'color2' => get_field('dopolnitelnyj_czvet_kategorii', 'category_' . $category->term_id), // Цвет категории
            ];
        }
        return $category_info; // Возвращаем массив с информацией о категориях
    } else {
        return []; // Если категорий нет, возвращаем пустой массив
    }
}

// Стили
function my_theme_enqueue_styles()
{
    wp_enqueue_style('momspace-child-style', get_stylesheet_directory_uri() . '/assets/css/custom-style.css');
}

add_action('wp_enqueue_scripts', 'my_theme_enqueue_styles');

// Шаблоны

function my_custom_template_include($template)
{
    // Проверяем, является ли это страницей
    if (is_page()) {
        // Путь к вашему шаблону в подпапке

        $slug = get_page_template_slug();
        $new_template = locate_template('page-templates/' . (empty(get_page_template_slug()) ? 'page.php' : $slug));

        // Проверяем, найден ли шаблон
        if ($new_template) {
            return $new_template; // Возвращаем новый шаблон, если он найден
        }
    } else if (is_single()) {
        // Получаем тип поста
        $post_type = get_post_type();

        // Указываем путь к вашему шаблону в подпапке
        $new_template = locate_template('single-templates/' . $post_type . '.php');
        // Проверяем, найден ли шаблон
        if ($new_template) {
            return $new_template; // Возвращаем новый шаблон, если он найден
        }
    }


    return $template; // Возвращаем оригинальный шаблон, если новый не найден
}

add_filter('template_include', 'my_custom_template_include');

// Пермалинки

add_filter('term_link', 'custom_category_link', 10, 3);
function custom_category_link($termlink, $term, $taxonomy)
{
    if ($taxonomy == 'category') {
        return home_url('/articles/' . $term->slug . '/');

    }
    return $termlink;
}

// ########### Имена ######################

function create_name_post_type()
{
    register_post_type('baby_name',
        array(
            'labels' => array(
                'name' => __('Имена'),
                'singular_name' => __('Имя')
            ),
            'public' => true,
            'has_archive' => true,
            'rewrite' => array('slug' => 'service/names'),
            'supports' => array('title', 'editor', 'thumbnail'),
        )
    );
}

add_action('init', 'create_name_post_type');

function custom_baby_name_permalink($post_link, $id)
{
    // Получаем пост по ID
    $post = get_post($id);

    // Проверяем, что это пост типа 'baby_name'
    if ($post->post_type === 'baby_name') {
        // Получаем метаданные

        // Получаем название поста
        $post_name = $post->post_name;

        // Формируем новый permalink
        $post_link = home_url("/names/{$post_name}/");
    }

    return $post_link;
}

add_filter('post_type_link', 'custom_baby_name_permalink', 10, 2);

// Обновляем пермалинки при активации плагина или темы
function custom_baby_name_flush_rewrite_rules()
{
    flush_rewrite_rules();
}

add_action('after_switch_theme', 'custom_baby_name_flush_rewrite_rules');

function custom_query_vars($vars)
{
    $vars[] = 'gender';
    $vars[] = 'origin';
    $vars[] = 'filtervar';
    $vars[] = 'first_letter';
    return $vars;
}

add_filter('query_vars', 'custom_query_vars');

function custom_rewrite_rules()
{

    // assets

    if (preg_match('/^\/' . MOMSPACE_THEME_DOMLOADER_TEMPLATES_DIR . '\/(.*)\?(.*)domLoader=$/', $_SERVER['REQUEST_URI'], $matches)) {
        $template_path = get_template_directory() . '/template-parts/' . $matches[1] . '.php';
        if (file_exists($template_path)) {
            query_posts(array(
                'post_type' => $_GET['post_type'] ?? 'post',
                'posts_per_page' => $_GET['posts_per_page'],
                'paged' => $_GET['paged'] ?? 1,
                'this_page_posts' => $_GET['this_page_posts'] ?? -1,
                'category_id' => $_GET['category_id'] ?? -1,
                'taxonomy' => $_GET['taxonomy'] ?? '',
            ));

            get_template_part('template-parts/' . $matches[1]);
            exit;
        }
    }

    if (preg_match('/^\/assets\/images\/svg\/(.*)$/', $_SERVER['REQUEST_URI'], $matches)) {
        $image_path = get_template_directory() . '/assets/images/svg/' . $matches[1];
        if (file_exists($image_path)) {
            header('Content-Type: image/svg+xml');
            readfile($image_path);
            exit;
        }
    }

    if (preg_match('/^\/assets\/images\/(.*)$/', $_SERVER['REQUEST_URI'], $matches)) {
        $image_path = get_template_directory() . '/assets/images/' . $matches[1];
        if (file_exists($image_path)) {
            header('Content-Type: image/png');
            readfile($image_path);
            exit;
        }
    }

    if (preg_match('/^\/assets\/js\/(.*)$/', $_SERVER['REQUEST_URI'], $matches)) {
        $image_path = get_template_directory() . '/assets/js/' . $matches[1];
        if (file_exists($image_path)) {
            header('Content-Type: application/javascript');
            readfile($image_path);
            exit;
        }
    }

    // tags
    add_rewrite_rule('tag/([^/]+)/page/?([0-9]{1,})/?', 'index.php?tag=$matches[1]&paged=$matches[2]', 'top');
    add_rewrite_rule('tag/([^/]+)/?', 'index.php?tag=$matches[1]', 'top');

    // names

    // Правило для пагинации
    add_rewrite_rule(
        '^names/(any|unisex|male|female)/([^/]+)/([^/]+)/page/([0-9]+)/?$',
        'index.php?pagename=names&gender=$matches[1]&origin=$matches[2]&first_letter=$matches[3]&paged=$matches[4]',
        'top'
    );

    // Правило для gender и filtervar
    add_rewrite_rule(
        '^names/(any|unisex|male|female)/([^/]+)/page/([0-9]+)/?$',
        'index.php?pagename=names&gender=$matches[1]&filtervar=$matches[2]&paged=$matches[3]',
        'top'
    );

    // Правило для пагинации без filtervar и first_letter
    add_rewrite_rule(
        '^names/(any|unisex|male|female)/page/([0-9]+)/?$',
        'index.php?pagename=names&gender=$matches[1]&paged=$matches[2]',
        'top'
    );

    // Правило для gender, origin и first_letter
    add_rewrite_rule(
        '^names/(any|unisex|male|female)/([^/]+)/([^/]+)/?$',
        'index.php?pagename=names&gender=$matches[1]&origin=$matches[2]&first_letter=$matches[3]',
        'top'
    );

    // Правило для gender и filtervar
    add_rewrite_rule(
        '^names/(any|unisex|male|female)/([^/]+)/?$',
        'index.php?pagename=names&gender=$matches[1]&filtervar=$matches[2]',
        'top'
    );

    // Правило для gender
    add_rewrite_rule(
        '^names/(any|unisex|male|female)/?$',
        'index.php?pagename=names&gender=$matches[1]',
        'top'
    );

    //Правило для страницы имен
    add_rewrite_rule('^names/([^/]+)/?$', 'index.php?baby_name=$matches[1]', 'top');

    $categories = get_categories(array('hide_empty' => false));

    $slugs = [];

    foreach ($categories as $category) {
        $slugs[] = $category->slug;
    }

    //Правила для рубрик
    add_rewrite_rule('articles/(' . implode('|', $slugs) . ')/feed/(feed|rdf|rss|rss2|atom)/?', 'index.php?category_name=$matches[1]&feed=$matches[2]', 'top');
    add_rewrite_rule('articles/(' . implode('|', $slugs) . ')/(feed|rdf|rss|rss2|atom)/?', 'index.php?category_name=$matches[1]&feed=$matches[2]', 'top');
    add_rewrite_rule('articles/(' . implode('|', $slugs) . ')/embed/?', 'index.php?category_name=$matches[1]&embed=true', 'top');
    add_rewrite_rule('articles/(' . implode('|', $slugs) . ')/page/([0-9]+)/?', 'index.php?category_name=$matches[1]&paged=$matches[2]', 'top');
    add_rewrite_rule('articles/(' . implode('|', $slugs) . ')/?', 'index.php?category_name=$matches[1]', 'top');

    add_rewrite_rule('articles/page/([0-9]+)/?$', 'index.php?pagename=articles&paged=$matches[1]', 'top');
    add_rewrite_rule('articles/([^/]*)/?', 'index.php?name=$matches[1]', 'top');
}

add_action('init', 'custom_rewrite_rules');

if (isset($_GET['debag']) && $_GET['debag'] == '126') {
    $rules = get_option('rewrite_rules');
    echo '<pre>' . print_r($rules, true) . '</pre>';
    exit();
}

