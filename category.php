<?php
/**
 * The template for displaying catgeory pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package momspace
 */

get_header();

$momspace_cat_style = get_term_meta(get_queried_object_id(), 'momspace', true);
$momspace_cat_style_template = !empty($momspace_cat_style['momspace_cat_layout']) ? $momspace_cat_style['momspace_cat_layout'] : '';

define('BREADCRUMS_CLASS', 'back-lblue');
get_template_part( 'template-parts/breadcrumbs' );
?>

<div class="simple-box pressure back-lblue">
    <h1><?php single_cat_title(); ?></h1>
    <div class="simple-box__flex-list gap-10">
        <input type="checkbox" class="tag-more">
        <div class="box tag">Планирование беременности</div>
        <div class="box tag">Беременность</div>
        <div class="box tag">Все о родах</div>
        <div class="box tag">Грудное вскармливание</div>
        <div class="box tag">Дети</div>
        <div class="box tag">Семья</div>
        <div class="box tag">Обучение</div>
        <div class="box tag">Еда</div>
        <div class="box tag">Отдых и досуг</div>
        <div class="box tag">Гороскопы</div>
        <div class="box tag">Дом</div>
        <div class="box tag">Здоровье</div>
        <div class="box tag">Еда</div>
        <div class="box tag">Отдых и досуг</div>
        <div class="box tag">Гороскопы</div>
        <div class="box tag">Дом</div>
        <div class="box tag">Здоровье</div>
        <div class="box tag">Еда</div>
        <div class="box tag">Отдых и досуг</div>
        <div class="box tag">Гороскопы</div>
        <div class="box tag">Дом</div>
        <div class="box tag">Здоровье</div>
        <div class="box tag">Еда</div>
        <div class="box tag">Отдых и досуг</div>
        <div class="box tag">Гороскопы</div>
        <div class="box tag">Дом</div>
        <div class="box tag">Здоровье</div>
        <div class="box tag more" data-id="custom-label" for=".tag-more"><span
                    class="more__txt-more">Показать еще</span><span class="more__txt-hide">Скрыть</span></div>
    </div>
</div>
<div class="simple-box pressure back-lblue">
    <h2 class="font-size-1-5 padding-bottom-30">Читают сейчас</h2>
    <div class="simple-box__wrapper articles-box type-2">
        <div class="articles-box__more">
            <button class="btn w-100 radius-76">Показать еще</button>
        </div>

        <div class="right-colmn">
            <?php
                get_template_part( 'template-parts/right-colomn-new-posts' );
                get_template_part( 'template-parts/right-colomn-popular-posts' );
            ?>
        </div>

        <?php if (have_posts()) {

            the_post();

            print_post_card('large green color-tag');

            if (have_posts()) {

                echo '<div class="articles-box__auto-list gap-20">';

                while (have_posts()) {
                    the_post();
                    print_post_card('black color-tag');
                }

                echo '</div>';
            }

        } else {

        }
        ?>
    </div>
</div>
<div class="simple-box pressure padding-bottom-69 back-lblue">
    <div class="theme-pagination-style">
        <ul class="page-numbers">
            <li><a class="box number page-numbers prev" href="https://momspace.ru/names/page/2/">
                    <svg width="10" height="16" viewBox="0 0 10 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M1.81958 1.49878L8.10596 7.78516L1.81958 14.0715" stroke="#FF56AD" stroke-width="2"
                              stroke-linecap="round"/>
                    </svg>
                </a></li>
            <li><span aria-current="page" class="box number page-numbers current">1</span></li>
            <li><a class="box number page-numbers" href="https://momspace.ru/names/page/2/">2</a></li>
            <li><a class="box number page-numbers" href="https://momspace.ru/names/page/3/">3</a></li>
            <li><span class="box number page-numbers dots">…</span></li>
            <li><a class="box number page-numbers" href="https://momspace.ru/names/page/259/">259</a></li>
            <li><a class="box number page-numbers next" href="https://momspace.ru/names/page/2/">
                    <svg width="10" height="16" viewBox="0 0 10 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M1.81958 1.49878L8.10596 7.78516L1.81958 14.0715" stroke="#FF56AD" stroke-width="2"
                              stroke-linecap="round"/>
                    </svg>
                </a></li>
        </ul>
    </div>
</div>

<?php get_footer(); ?>
