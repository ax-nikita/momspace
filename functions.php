<?php

/**
 * Evior functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package evior
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

define('EVIOR_DEV_MODE',true);
$evior_version = EVIOR_DEV_MODE ? time() : $theme_info->get('Version');
define('EVIOR_NAME',$theme_info->get('Name'));
define('EVIOR_VERSION',$evior_version);
define('EVIOR_AUTHOR',$theme_info->get('Author'));
define('EVIOR_AUTHOR_URI',$theme_info->get('AuthorURI'));


/**
 * Define Const for theme Dir
 * @since 1.0.0
 * */

define('EVIOR_THEME_URI', get_template_directory_uri());
define('EVIOR_IMG', EVIOR_THEME_URI . '/assets/images');
define('EVIOR_CSS', EVIOR_THEME_URI . '/assets/css');
define('EVIOR_JS', EVIOR_THEME_URI . '/assets/js');
define('EVIOR_THEME_DIR', get_template_directory());
define('EVIOR_IMG_DIR', EVIOR_THEME_DIR . '/assets/images');
define('EVIOR_CSS_DIR', EVIOR_THEME_DIR . '/assets/css');
define('EVIOR_JS_DIR', EVIOR_THEME_DIR . '/assets/js');
define('EVIOR_INC', EVIOR_THEME_DIR . '/inc');
define('EVIOR_THEME_OPTIONS',EVIOR_INC .'/theme-options');
define('EVIOR_THEME_OPTIONS_IMG',EVIOR_THEME_OPTIONS .'/img');

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */

function evior_setup(){

    // make the theme available for translation
    load_theme_textdomain( 'evior', get_template_directory() . '/languages' );

    // add support for post formats
    add_theme_support('post-formats', [
        'standard', 'image', 'video', 'audio','gallery'
    ]);

    // add support for automatic feed links
    add_theme_support('automatic-feed-links');

    // let WordPress manage the document title
    add_theme_support('title-tag');

    // add editor style theme support
    function evior_theme_add_editor_styles() {
        add_editor_style( 'custom-style.css' );
    }
    add_action( 'admin_init', 'evior_theme_add_editor_styles' );

    // add support for post thumbnails
    add_theme_support('post-thumbnails');

    // hard crop center center
    set_post_thumbnail_size(770, 470, ['center', 'center']);
    add_image_size( 'evior-box-slider-small', 96, 96, true );


    // register navigation menus
    register_nav_menus(
        [
            'primary' => esc_html__('Primary Menu', 'evior'),
            'footermenu' => esc_html__('Footer Menu', 'evior'),
            'topmenu' => esc_html__('Top Bar Menu', 'evior'),
        ]
    );


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

add_action('after_setup_theme', 'evior_setup');

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */

function evior_widget_init() {


    register_sidebar( array (
        'name' => esc_html__('Blog widget area', 'evior'),
        'id' => 'sidebar-1',
        'description' => esc_html__('Blog Sidebar Widget.', 'evior'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',

    ) );

    register_sidebar( array(
        'name'          => esc_html__( 'Footer Widget Area One', 'evior' ),
        'id'            => 'footer-widget-1',
        'description'   => esc_html__( 'Add Footer  widgets here.', 'evior' ),
        'before_widget' => '<div id="%1$s" class="footer-widget widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="widget-title">',
        'after_title'   => '</h4>',
    ) );

    register_sidebar( array(
        'name'          => esc_html__( 'Footer Widget Area Two', 'evior' ),
        'id'            => 'footer-widget-2',
        'description'   => esc_html__( 'Add Footer widgets here.', 'evior' ),
        'before_widget' => '<div id="%1$s" class="footer-widget widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="widget-title">',
        'after_title'   => '</h4>',
    ) );

    register_sidebar( array(
        'name'          => esc_html__( 'Footer Widget Area Three', 'evior' ),
        'id'            => 'footer-widget-3',
        'description'   => esc_html__( 'Add Footer widgets here.', 'evior' ),
        'before_widget' => '<div id="%1$s" class="footer-widget widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="widget-title">',
        'after_title'   => '</h4>',
    ) );

    register_sidebar( array(
        'name'          => esc_html__( 'Footer Widget Area Four', 'evior' ),
        'id'            => 'footer-widget-4',
        'description'   => esc_html__( 'Add Footer widgets here.', 'evior' ),
        'before_widget' => '<div id="%1$s" class="footer-widget widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="widget-title">',
        'after_title'   => '</h4>',
    ) );

    register_sidebar( array(
        'name'          => esc_html__( 'Footer Widget Area Five', 'evior' ),
        'id'            => 'footer-widget-5',
        'description'   => esc_html__( 'Add Footer widgets here.', 'evior' ),
        'before_widget' => '<div id="%1$s" class="footer-widget widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="widget-title">',
        'after_title'   => '</h4>',
    ) );

}

add_action('widgets_init', 'evior_widget_init');


/**
 * Enqueue scripts and styles.
 */
function evior_scripts() {

    wp_enqueue_style( 'font-awesome', EVIOR_CSS . '/font-awesome.css');
    wp_enqueue_style( 'icon-font',  EVIOR_CSS . '/icon-font.css' );
    wp_enqueue_style( 'remix-icon',  EVIOR_CSS . '/remix-icon.css' );
    wp_enqueue_style( 'animate',  EVIOR_CSS . '/animate.css' );
    wp_enqueue_style( 'magnific-popup',  EVIOR_CSS . '/magnific-popup.css' );
    wp_enqueue_style( 'owl-carousel',  EVIOR_CSS . '/owl.carousel.min.css' );
    wp_enqueue_style( 'owl-theme',  EVIOR_CSS . '/owl.theme.min.css' );
    wp_enqueue_style( 'slick',  EVIOR_CSS . '/slick.css' );
    wp_enqueue_style( 'slicknav',  EVIOR_CSS . '/slicknav.css' );
    wp_enqueue_style( 'swiper',  EVIOR_CSS . '/swiper.min.css' );
    wp_enqueue_style( 'flickity',  EVIOR_CSS . '/flickity.min.css' );
    wp_enqueue_style( 'theme-fonts', EVIOR_CSS . '/theme-fonts.css', array(), '1.0', 'all');

    // theme css


    if (is_rtl()) {
        wp_enqueue_style( 'bootstrap', EVIOR_CSS . '/bootstrap.min.css', array(), '4.0', 'all');
        wp_enqueue_style( 'evior-main',  EVIOR_CSS . '/main.css' );
        wp_enqueue_style( 'evior-rtl',  EVIOR_CSS . '/rtl.css' );
        wp_enqueue_style( 'evior-responsive',  EVIOR_CSS . '/responsive.css' );

    } else {
        wp_enqueue_style( 'bootstrap', EVIOR_CSS . '/bootstrap.min.css', array(), '4.0', 'all');
        wp_enqueue_style( 'evior-main',  EVIOR_CSS . '/main.css' );
        wp_enqueue_style( 'evior-responsive',  EVIOR_CSS . '/responsive.css' );
    }

    wp_enqueue_style( 'evior-style', get_stylesheet_uri() );


    wp_enqueue_script( 'bootstrap',  EVIOR_JS . '/bootstrap.min.js', array( 'jquery' ),  '4.0', true );
    wp_enqueue_script( 'popper',  EVIOR_JS . '/popper.min.js', array( 'jquery' ),  '1.0', true );
    wp_enqueue_script( 'jquery-magnific-popup',  EVIOR_JS . '/jquery.magnific-popup.min.js', array( 'jquery' ),  '1.0', true );
    wp_enqueue_script( 'jquery-appear',  EVIOR_JS . '/jquery.appear.min.js', array( 'jquery' ),  '1.0', true );
    wp_enqueue_script( 'owl-carousel',  EVIOR_JS . '/owl.carousel.min.js', array( 'jquery' ),  '1.0', true );
    wp_enqueue_script( 'jquery-easypiechart', EVIOR_JS . '/jquery.easypiechart.min.js', array( 'jquery' ), '1.0', true );
    wp_enqueue_script( 'slick', EVIOR_JS . '/slick.js', array( 'jquery' ), '1.0', true );
    wp_enqueue_script( 'swiper', EVIOR_JS . '/swiper.min.js', array( 'jquery' ), '1.0', true );
    wp_enqueue_script( 'jquery-slicknav', EVIOR_JS . '/jquery.slicknav.min.js', array( 'jquery' ), '1.0', true );
    wp_enqueue_script( 'jquery-flickity', EVIOR_JS . '/flickity.min.js', array( 'jquery' ), '1.0', true );

    // Custom JS Scripts

    wp_enqueue_script( 'evior-scripts',  EVIOR_JS . '/scripts.js', array( 'jquery' ),  '1.0', true );



    wp_localize_script( 'evior-scripts', 'evior_ajax', array(

        'ajax_url' => admin_url( 'admin-ajax.php' ),

    ) );


    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }


}

add_action( 'wp_enqueue_scripts', 'evior_scripts' );


/*
* Include codester helper functions
* @since 1.0.0
*/

if ( file_exists( EVIOR_INC.'/cs-framework-functions.php' ) ) {
    require_once  EVIOR_INC.'/cs-framework-functions.php';
}

/**
 * Theme option panel & Metaboxes.
 */
 if ( file_exists( EVIOR_THEME_OPTIONS.'/theme-options.php' ) ) {
     require_once  EVIOR_THEME_OPTIONS.'/theme-options.php';
 }

if ( file_exists( EVIOR_THEME_OPTIONS.'/theme-metabox.php' ) ) {
    require_once  EVIOR_THEME_OPTIONS.'/theme-metabox.php';
}

if ( file_exists( EVIOR_THEME_OPTIONS.'/theme-nav-options.php' ) ) {
    require_once  EVIOR_THEME_OPTIONS.'/theme-nav-options.php';
}

if ( file_exists( EVIOR_THEME_OPTIONS.'/theme-customizer.php' ) ) {
    require_once  EVIOR_THEME_OPTIONS.'/theme-customizer.php';
}


if ( file_exists( EVIOR_THEME_OPTIONS.'/theme-inline-styles.php' ) ) {
    require_once  EVIOR_THEME_OPTIONS.'/theme-inline-styles.php';
}


/**
 * Required plugin installer
 */
require get_template_directory() . '/inc/required-plugins.php';


/**
 * Custom template tags & functions for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';
require get_template_directory() . '/inc/template-functions.php';

/**
 * Nav walker class for this theme.
 */
require get_template_directory() . '/inc/theme-nav-walker.php';

/**
 * Load WooCommerce compatibility file.
 */
if ( class_exists( 'woocommerce' ) ) {
    require get_template_directory() . '/inc/woocommerce.php';
}


/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function evior_content_width() {
    $GLOBALS['content_width'] = apply_filters( 'evior_content_width', 640 );
}

add_action( 'after_setup_theme', 'evior_content_width', 0 );

/**
 * Nav menu fallback function
 */

function evior_fallback_menu() {
    get_template_part( 'template-parts/default', 'menu' );
}


/**
 * Post List Load More Function
 */

function evior_post_ajax_loading_cb()
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
                            <?php require EVIOR_THEME_DIR . '/template-parts/cat-color.php'; ?>
                        </div>
                    <?php endif; ?>


                    <?php if($settings['show_date'] == 'yes'): ?>
                        <div class="date-box">
                            <?php echo esc_html(get_the_date( 'F j' )); ?>
                        </div>
                    <?php endif; ?>


                    <?php if($settings['show_read_time'] == 'yes'): ?>
                        <div class="read-time-box">
                            <?php echo evior_reading_time(); ?>
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

add_action( 'wp_ajax_nopriv_evior_post_ajax_loading', 'evior_post_ajax_loading_cb' );
add_action( 'wp_ajax_evior_post_ajax_loading', 'evior_post_ajax_loading_cb' );

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
    wp_enqueue_style('evior-child-style', get_stylesheet_directory_uri() . '/assets/css/custom-style.css');
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
}

add_action('init', 'custom_rewrite_rules');

if(isset($_GET['debag']) && $_GET['debag'] == '126') {
    $rules = get_option('rewrite_rules');
    error_log(print_r($rules, true));
    exit();
}

