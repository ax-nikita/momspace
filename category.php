<?php
/**
 * The template for displaying catgeory pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package momspace
 */

get_header();


define('BREADCRUMS_CLASS', 'back-lblue');
get_template_part('template-parts/breadcrumbs');

get_template_part('template-parts/simple-box-category-top');

$posts_per_page = get_query_var('posts_per_page');
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
$offset = ($paged - 1) * $posts_per_page;

$current_tag = get_queried_object();

$args = array(
    'post_type' => 'post',
    'posts_per_page' => $posts_per_page,
    'offset' => $offset,
    'orderby' => 'date',
    'order' => 'DESC',
    'category' => $current_tag->term_id,
);

$posts = new WP_Query( $args );

?>

<div class="simple-box pressure back-lblue content">
    <h2 class="font-size-1-5 padding-bottom-30">Читают сейчас</h2>

    <div class="simple-box__wrapper articles-box type-2">
        <div loadVisible="true" class="sidebar" domLoader="<?php echo buildDomLoaderUrl('sidebar'); ?>"></div>

        <?php if ($posts->have_posts()) {
            $posts->the_post();

            print_post_card('large color-tag');

            if ($posts->have_posts()) {

                echo '<div class="articles-box__auto-list gap-20">';

                while ($posts->have_posts()) {
                    $posts->the_post();
                    print_post_card('black color-tag');
                }

                echo '</div>';
            }
        } else {

        }
        ?>
    </div>
</div>

<div data-id="pagination" class="simple-box pressure padding-bottom-69 back-lblue">
    <?php $big = 999999999; // уникальное число

    if(is_home()) {
        $total_posts = wp_count_posts()->publish;
    } else {
        $total_posts = count_posts_in_current_category();
    }

    $total_pages = ceil($total_posts / get_query_var('posts_per_page'));

    $current_url = remove_query_arg(array_keys($_GET), esc_url(get_pagenum_link($big)));
    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

    $links = paginate_links(array(
        'next_text' => '<svg width="10" height="16" viewBox="0 0 10 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M1.81958 1.49878L8.10596 7.78516L1.81958 14.0715" stroke="#FF56AD" stroke-width="2"
                              stroke-linecap="round"/>
                    </svg>',
        'prev_text' => '<svg width="10" height="16" viewBox="0 0 10 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M1.81958 1.49878L8.10596 7.78516L1.81958 14.0715" stroke="#FF56AD" stroke-width="2"
                              stroke-linecap="round"/>
                    </svg>',
        'screen_reader_text' => ' ',
        'type' => 'array',
        'base' => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
        'current' => $paged,
        'total' => $total_pages,
    ));

    if (is_array($links)) {
        ?>
        <div class="theme-pagination-style">
            <?php
            if($paged < $total_pages) {
                echo '<div class="theme-pagination-style__more">
                <button class="btn w-100 radius-76">Показать еще</button>
            </div>';
            }
            ?>

            <ul class="page-numbers">
        <?php
        foreach ($links as $link) {
            // Заменяем класс на нужный
            $link = str_replace(['page-numbers', 'class=', '?domLoader'], ['box number page-numbers', 'spa class=', ''], $link);
            echo '<li>'. $link. '</li>';
        }
        ?>
            </ul>
        </div>
                <?php
    }

    wp_reset_postdata();
    ?>

</div>

<?php get_footer(); ?>
