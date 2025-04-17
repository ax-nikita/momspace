<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package momspace
 */
 
get_header();

?>
    <div class="simple-box">
        <div class="simple-box__section">
            <h1>Error <?php esc_html_e('404', 'momspace'); ?></h1>
            <h3><?php esc_html_e('Упс!...Похоже страница не найдена!', 'momspace'); ?></h3>
            <a spa href="<?php echo esc_url(home_url('/')); ?>" class="btn btn-primary solid blank"><i class="icofont-home"></i> <?php esc_html_e('Go Home Page', 'momspace'); ?></a>
        </div>
    </div>

<?php get_footer(); ?>
