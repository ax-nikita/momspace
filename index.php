<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package momspace
 */

get_header();

?>
        <?php get_template_part('template-parts/simple-box-main-page-swiper') ?>
        <?php get_template_part('template-parts/simple-box-planirovanie-beremenosty') ?>
        <?php get_template_part('template-parts/simple-box-kalendar-beremennisty') ?>

        <div loadVisible="true" class="row simple-box extra-padding" domLoader="<?php echo buildDomLoaderUrl('simple-box-posts-recommended-type-1'); ?>"></div>
        <div loadVisible="true" class="row simple-box back-lgreen" domLoader="<?php echo buildDomLoaderUrl('simple-box-about'); ?>"></div>

	<?php get_footer(); ?>
