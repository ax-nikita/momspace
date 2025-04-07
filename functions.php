<?php

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

