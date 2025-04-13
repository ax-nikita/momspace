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

 if (is_child_theme()){
     $theme = wp_get_theme();
     $parent_theme = $theme->Template;
     $theme_info = wp_get_theme($parent_theme);
 }else{
     $theme_info = wp_get_theme();
 }

define('MOMSPACE_DEV_MODE',true);
$momspace_version = MOMSPACE_DEV_MODE ? time() : $theme_info->get('Version');
define('MOMSPACE_NAME',$theme_info->get('Name'));
define('MOMSPACE_VERSION',$momspace_version);
define('MOMSPACE_AUTHOR',$theme_info->get('Author'));
define('MOMSPACE_AUTHOR_URI',$theme_info->get('AuthorURI'));


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
define('MOMSPACE_THEME_OPTIONS',MOMSPACE_INC .'/theme-options');
define('MOMSPACE_THEME_OPTIONS_IMG',MOMSPACE_THEME_OPTIONS .'/img');
define('MOMSPACE_SVG', MOMSPACE_THEME_DIR . '/inc');
define('MOMSPACE_THEME_SVG',MOMSPACE_IMG_DIR .'/svg');

if ( ! function_exists( 'momspace_get_option' ) ) {
    function momspace_get_option( $option = '', $default = null ) {
        $options = get_option( 'momspace_theme_options' ); // Attention: Set your unique id of the framework
        return ( isset( $options[$option] ) ) ? $options[$option] : $default;
    }
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */

function momspace_setup(){

    // make the theme available for translation
    load_theme_textdomain( 'momspace', get_template_directory() . '/languages' );

    // add support for post formats
    add_theme_support('post-formats', [
        'standard', 'image', 'video', 'audio','gallery'
    ]);

    // add support for automatic feed links
    add_theme_support('automatic-feed-links');

    // let WordPress manage the document title
    add_theme_support('title-tag');

    // add editor style theme support
    function momspace_theme_add_editor_styles() {
        add_editor_style( 'custom-style.css' );
    }
    add_action( 'admin_init', 'momspace_theme_add_editor_styles' );

    // add support for post thumbnails
    add_theme_support('post-thumbnails');

    // hard crop center center
    set_post_thumbnail_size(770, 470, ['center', 'center']);
    add_image_size( 'momspace-box-slider-small', 96, 96, true );


    // HTML5 markup support for search form, comment form, and comments
    add_theme_support('html5', array(
        'search-form', 'comment-form', 'comment-list', 'gallery', 'caption'
    ));


    /**
     * Add support for core custom logo.
     *
     * @link https://codex.wordpress.org/Theme_Logo
     */
    add_theme_support( 'custom-logo', array(
        'height'      => 150,
        'width'       => 300,
        'flex-width'  => true,
        'flex-height' => true,
    ) );


    // Add theme support for selective refresh for widgets.
    add_theme_support( 'customize-selective-refresh-widgets' );


    /*
     * Enable support for wide alignment class for Gutenberg blocks.
     */
    add_theme_support( 'align-wide' );
    add_theme_support( 'editor-styles' );
    add_theme_support( 'wp-block-styles' );

}

add_action('after_setup_theme', 'momspace_setup');

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */

function momspace_widget_init() {


    register_sidebar( array (
        'name' => esc_html__('Blog widget area', 'momspace'),
        'id' => 'sidebar-1',
        'description' => esc_html__('Blog Sidebar Widget.', 'momspace'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',

    ) );

    register_sidebar( array(
        'name'          => esc_html__( 'Footer Widget Area One', 'momspace' ),
        'id'            => 'footer-widget-1',
        'description'   => esc_html__( 'Add Footer  widgets here.', 'momspace' ),
        'before_widget' => '<div id="%1$s" class="footer-widget widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="widget-title">',
        'after_title'   => '</h4>',
    ) );

    register_sidebar( array(
        'name'          => esc_html__( 'Footer Widget Area Two', 'momspace' ),
        'id'            => 'footer-widget-2',
        'description'   => esc_html__( 'Add Footer widgets here.', 'momspace' ),
        'before_widget' => '<div id="%1$s" class="footer-widget widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="widget-title">',
        'after_title'   => '</h4>',
    ) );

    register_sidebar( array(
        'name'          => esc_html__( 'Footer Widget Area Three', 'momspace' ),
        'id'            => 'footer-widget-3',
        'description'   => esc_html__( 'Add Footer widgets here.', 'momspace' ),
        'before_widget' => '<div id="%1$s" class="footer-widget widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="widget-title">',
        'after_title'   => '</h4>',
    ) );

    register_sidebar( array(
        'name'          => esc_html__( 'Footer Widget Area Four', 'momspace' ),
        'id'            => 'footer-widget-4',
        'description'   => esc_html__( 'Add Footer widgets here.', 'momspace' ),
        'before_widget' => '<div id="%1$s" class="footer-widget widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="widget-title">',
        'after_title'   => '</h4>',
    ) );

    register_sidebar( array(
        'name'          => esc_html__( 'Footer Widget Area Five', 'momspace' ),
        'id'            => 'footer-widget-5',
        'description'   => esc_html__( 'Add Footer widgets here.', 'momspace' ),
        'before_widget' => '<div id="%1$s" class="footer-widget widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="widget-title">',
        'after_title'   => '</h4>',
    ) );

}

add_action('widgets_init', 'momspace_widget_init');

function cc_mime_types($mimes) {
    $mimes['svg'] = 'image/svg+xml';
    return $mimes;
}
add_filter('upload_mimes', 'cc_mime_types');

/**
 * Enqueue scripts and styles.
 */
function my_custom_theme_scripts() {
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

function register_my_menus() {
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

function replace_submenu_class($classes) {
    // Удаляем класс sub-menu
    $classes = array_diff($classes, array('sub-menu'));

    // Добавляем класс dropdown-menu
    $classes[] = 'dropdown-menu';

    return $classes;
}
add_filter('nav_menu_submenu_css_class', 'replace_submenu_class');

function add_custom_classes($classes, $item) {
    // Добавляем класс nav-item к каждому li
    $classes[] = 'nav-item';

    return $classes;
}
add_filter('nav_menu_css_class', 'add_custom_classes', 10, 2);

function add_link_class($atts, $item, $args) {
    // Добавляем класс nav-link к каждой ссылке
    $atts['class'] =  $args->item_class . ' nav-link';
    $atts['spa'] = 'true';

    // Проверяем, есть ли подменю
    if (in_array('menu-item-has-children', $item->classes)) {
        $atts['class'] .= ' dropdown-toggle'; // Добавляем класс dropdown-toggle
    }

    return $atts;
}
add_filter('nav_menu_link_attributes', 'add_link_class', 10, 3);

function custom_wp_nav_menu($items, $args) {
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

function add_dropdown_classes($output, $item, $depth, $args) {
    if (in_array('menu-item-has-children', $item->classes)) {
        if ($depth === 0) { // Уровень главного меню
            return str_replace('<ul class="sub-menu"', '<ul class="dropdown-menu"', $output);
        }

        return str_replace('<li ', '<li class="dropdown " ', $output);
    }

    return $output;
}
add_filter('walker_nav_menu_start_el', 'add_dropdown_classes', 10, 4);

function modify_nav_menu_links($items, $args) {
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

/*
* Include codester helper functions
* @since 1.0.0
*/

if ( file_exists( MOMSPACE_INC.'/cs-framework-functions.php' ) ) {
    require_once  MOMSPACE_INC.'/cs-framework-functions.php';
}

/**
 * Theme option panel & Metaboxes.
 */
 if ( file_exists( MOMSPACE_THEME_OPTIONS.'/theme-options.php' ) ) {
     require_once  MOMSPACE_THEME_OPTIONS.'/theme-options.php';
 }

if ( file_exists( MOMSPACE_THEME_OPTIONS.'/theme-metabox.php' ) ) {
    require_once  MOMSPACE_THEME_OPTIONS.'/theme-metabox.php';
}

if ( file_exists( MOMSPACE_THEME_OPTIONS.'/theme-nav-options.php' ) ) {
    require_once  MOMSPACE_THEME_OPTIONS.'/theme-nav-options.php';
}

if ( file_exists( MOMSPACE_THEME_OPTIONS.'/theme-customizer.php' ) ) {
    require_once  MOMSPACE_THEME_OPTIONS.'/theme-customizer.php';
}


if ( file_exists( MOMSPACE_THEME_OPTIONS.'/theme-inline-styles.php' ) ) {
    require_once  MOMSPACE_THEME_OPTIONS.'/theme-inline-styles.php';
}

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function momspace_content_width() {
    $GLOBALS['content_width'] = apply_filters( 'momspace_content_width', 640 );
}

add_action( 'after_setup_theme', 'momspace_content_width', 0 );

/**
 * Nav menu fallback function
 */

function momspace_fallback_menu() {
    get_template_part( 'template-parts/default', 'menu' );
}


/**
 * Post List Load More Function
 */

function momspace_post_ajax_loading_cb()
{
    $settings =  $_POST['ajax_json_data'];
    //$show_gradient = (($settings['show_gradient']== 'yes') ? 'gradient-post' : '');

    $arg = [
        'post_type'   =>  'post',
        'post_status' => 'publish',
        'order'       => $settings['order'],
        'posts_per_page' => $settings['posts_per_page'],
        'paged'             => $_POST['paged'],
        'tag__in'           => $settings['tags'],
        'suppress_filters' => false,

    ];

    if(count($settings['terms'])){
        $arg['tax_query'] = array(
            array(
                'taxonomy' => 'category',
                'terms'    => $settings['terms'],
                'field' => 'id',
                'include_children' => true,
                'operator' => 'IN'
            ),
        );
    }

    switch($settings['post_sortby']){

        case 'title':
            $arg['orderby'] = 'title';
            break;


        case 'mostdiscussed':
            $arg['orderby'] = 'comment_count';
            break;
        default:
            $arg['orderby'] = 'date';
            break;
    }

    $allpostloding = new WP_Query($arg);
    $index = 0;

    while($allpostloding->have_posts()){ $allpostloding->the_post(); ?>

        <div class="grid-item post-grid-wrapper-two-inner post-list-inner">
            <div class="post-grid-content-two post-list-medium-content">

                <?php if($settings['show_author'] == 'yes'): ?>

                    <div class="author-name">
                        <?php printf('<div class="post_grid_author_img">%1$s<a href="%2$s">%3$s</a></div>',
                            get_avatar( get_the_author_meta( 'ID' ), 21 ),
                            esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
                            get_the_author()
                        ); ?>
                    </div>
                <?php endif; ?>

                <h3 class="post-title">
                    <a href="<?php the_permalink(); ?>"><?php echo esc_html( wp_trim_words(get_the_title(), $settings['post_title_crop'],'') ); ?></a>
                </h3>

                <?php if($settings['show_desc'] == 'yes'): ?>
                    <div class="post-excerpt-box">
                        <p><?php echo esc_html( wp_trim_words(get_the_excerpt(), $settings['desc_limit'] ,'') );?></p>
                    </div>
                <?php endif; ?>


                <div class="post-meta-items">

                    <?php if($settings['show_cat'] == 'yes'): ?>
                        <div class="category-box">
                            <?php require MOMSPACE_THEME_DIR . '/template-parts/cat-color.php'; ?>
                        </div>
                    <?php endif; ?>


                    <?php if($settings['show_date'] == 'yes'): ?>
                        <div class="date-box">
                            <?php echo esc_html(get_the_date( 'F j' )); ?>
                        </div>
                    <?php endif; ?>


                    <?php if($settings['show_read_time'] == 'yes'): ?>
                        <div class="read-time-box">
                            <?php echo momspace_reading_time(); ?>
                        </div>
                    <?php endif; ?>

                </div>

            </div>

            <div class="grid-thumbnail-two-wrap">
                <a href="<?php the_permalink(); ?>" class="post-grid-thumbnail-two">
                    <img src="<?php echo esc_attr(esc_url(get_the_post_thumbnail_url(null, 'full'))); ?>" alt="<?php the_title_attribute(); ?>">
                </a>
            </div>
        </div>


        <?php
        $index ++;
    }
    wp_reset_postdata();
    wp_die();

}

add_action( 'wp_ajax_nopriv_momspace_post_ajax_loading', 'momspace_post_ajax_loading_cb' );
add_action( 'wp_ajax_momspace_post_ajax_loading', 'momspace_post_ajax_loading_cb' );

// Загрузка поста

function print_post_card ($class = '' ) {
    ?>
    <div class="box article-card <?php echo $class; ?>">
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
            <span>#<?php the_category(', #'); ?></span>
        </div>
        <span class="article-card__title"><?php the_title(); ?></span>
        <a spa href="<?php the_permalink(); ?>" class="pink-arrow article-card__link">Читать далее</a>
    </div>
<?php
}

// Шаблоны де получения категорий поста

function get_post_categories($post_id) {
    // Получаем категории поста
    $categories = get_the_category($post_id);

    // Проверяем, есть ли категории
    if (!empty($categories)) {
        $category_info = []; // Массив для хранения имен и ссылок на категории
        foreach ($categories as $category) {
            // Получаем имя и ссылку на категорию
            $category_info[] = [
                'name' => $category->name, // Имя категории
                'link' => get_category_link($category->term_id) // Ссылка на категорию
            ];
        }
        return $category_info; // Возвращаем массив с информацией о категориях
    } else {
        return []; // Если категорий нет, возвращаем пустой массив
    }
}

// Кастомные функции
function transliterateen($input){
    $gost = array(
        "a"=>"а","b"=>"б","v"=>"в","g"=>"г","d"=>"д","e"=>"е","yo"=>"ё",
        "j"=>"ж","z"=>"з","i"=>"и","i"=>"й","k"=>"к",
        "l"=>"л","m"=>"м","n"=>"н","o"=>"о","p"=>"п","r"=>"р","s"=>"с","t"=>"т",
        "y"=>"у","f"=>"ф","h"=>"х","c"=>"ц",
        "ch"=>"ч","sh"=>"ш","sh"=>"щ","i"=>"ы","e"=>"е","u"=>"у","ya"=>"я","A"=>"А","B"=>"Б",
        "V"=>"В","G"=>"Г","D"=>"Д", "E"=>"Е","Yo"=>"Ё","J"=>"Ж","Z"=>"З","I"=>"И","I"=>"Й","K"=>"К","L"=>"Л","M"=>"М",
        "N"=>"Н","O"=>"О","P"=>"П",
        "R"=>"Р","S"=>"С","T"=>"Т","Y"=>"Ю","F"=>"Ф","H"=>"Х","C"=>"Ц","Ch"=>"Ч","Sh"=>"Ш",
        "Sh"=>"Щ","I"=>"Ы","E"=>"Е", "U"=>"У","Ya"=>"Я","'"=>"ь","'"=>"Ь","''"=>"ъ","''"=>"Ъ","j"=>"ї","i"=>"и","g"=>"ґ",
        "ye"=>"є","J"=>"Ї","I"=>"І",
        "G"=>"Ґ","YE"=>"Є"
    );
    return strtr($input, $gost);
}

function transliterate($input){
    $gost = array(
        "а"=>"a","б"=>"b","в"=>"v","г"=>"g","д"=>"d",
        "е"=>"e", "ё"=>"yo","ж"=>"j","з"=>"z","и"=>"i",
        "й"=>"i","к"=>"k","л"=>"l", "м"=>"m","н"=>"n",
        "о"=>"o","п"=>"p","р"=>"r","с"=>"s","т"=>"t",
        "у"=>"y","ф"=>"f","х"=>"h","ц"=>"c","ч"=>"ch",
        "ш"=>"sh","щ"=>"sh","ы"=>"i","э"=>"e","ю"=>"u",
        "я"=>"ya",
        "А"=>"A","Б"=>"B","В"=>"V","Г"=>"G","Д"=>"D",
        "Е"=>"E","Ё"=>"Yo","Ж"=>"J","З"=>"Z","И"=>"I",
        "Й"=>"I","К"=>"K","Л"=>"L","М"=>"M","Н"=>"N",
        "О"=>"O","П"=>"P","Р"=>"R","С"=>"S","Т"=>"T",
        "У"=>"Y","Ф"=>"F","Х"=>"H","Ц"=>"C","Ч"=>"Ch",
        "Ш"=>"Sh","Щ"=>"Sh","Ы"=>"I","Э"=>"E","Ю"=>"U",
        "Я"=>"Ya",
        "ь"=>"","Ь"=>"","ъ"=>"","Ъ"=>"",
        "ї"=>"j","і"=>"i","ґ"=>"g","є"=>"ye",
        "Ї"=>"J","І"=>"I","Ґ"=>"G","Є"=>"YE"
    );
    return strtr($input, $gost);
}

// Стили
function my_theme_enqueue_styles() {
    wp_enqueue_style('momspace-child-style', get_stylesheet_directory_uri() . '/assets/css/custom-style.css');
}
add_action('wp_enqueue_scripts', 'my_theme_enqueue_styles');

// Шаблоны

function my_custom_template($template) {
    if (is_singular('baby_name')) {
        $new_template = locate_template('template/single/single-baby_name.php');
        if ($new_template) {
            return $new_template;
        }
    }
    return $template;
}
add_filter('template_include', 'my_custom_template');

// Пермалинки

add_filter('term_link', 'custom_category_link', 10, 3);
function custom_category_link($termlink, $term, $taxonomy) {
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

function custom_baby_name_permalink($post_link, $id) {
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
function custom_baby_name_flush_rewrite_rules() {
    flush_rewrite_rules();
}
add_action('after_switch_theme', 'custom_baby_name_flush_rewrite_rules');

function custom_query_vars($vars) {
    $vars[] = 'gender';
    $vars[] = 'origin';
    $vars[] = 'filtervar';
    $vars[] = 'first_letter';
    return $vars;
}
add_filter('query_vars', 'custom_query_vars');

function custom_rewrite_rules() {

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
    add_rewrite_rule('articles/('.implode('|', $slugs).')/feed/(feed|rdf|rss|rss2|atom)/?', 'index.php?category_name=$matches[1]&feed=$matches[2]', 'top');
    add_rewrite_rule('articles/('.implode('|', $slugs).')/(feed|rdf|rss|rss2|atom)/?', 'index.php?category_name=$matches[1]&feed=$matches[2]', 'top');
    add_rewrite_rule('articles/('.implode('|', $slugs).')/embed/?', 'index.php?category_name=$matches[1]&embed=true', 'top');
    add_rewrite_rule('articles/('.implode('|', $slugs).')/page/?([0-9]{1,})/?', 'index.php?category_name=$matches[1]&paged=$matches[2]', 'top');
    add_rewrite_rule('articles/('.implode('|', $slugs).')/?', 'index.php?category_name=$matches[1]', 'top');

    add_rewrite_rule('articles/([^/]*)/?', 'index.php?name=$matches[1]', 'top');
}

add_action('init', 'custom_rewrite_rules');

if(isset($_GET['debag']) && $_GET['debag'] == '126') {
    $rules = get_option('rewrite_rules');
    error_log(print_r($rules, true));
    exit();
}

