<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package momspace
 */
 
$momspace_preloader = momspace_get_option('preloader_enable', true);
 
if(isset($_GET['domLoader'])) :
    echo '<main>';
else :
?>



<!DOCTYPE html>
  <html <?php language_attributes(); ?>> 
    <head>
        <meta charset="<?php bloginfo('charset'); ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <script>
            let
                oldpage = '';
            window.addEventListener('popstate', function(event) {
                // Перезагружаем страницу при переходе назад
                if(history.state != null) {
                    window.location.reload();
                }
            });
        </script>
		<?php wp_head(); ?>
    </head>
	
	
    <body <?php body_class(); ?> >
		
		<?php wp_body_open(); ?>

		<!-- Theme Preloader -->
		<?php if($momspace_preloader == true) :?>
		<div id="preloader">
			<div class="loader loader-1">
			  <div class="loader-outter"></div>
			  <div class="loader-inner"></div>
			</div>
		</div>
		<?php endif; ?>

		<!-- Post Progressbar -->
		<div class="momspace-progress-container">
			<div class="momspace-progress-bar" id="momspaceBar"></div>
		</div>

		<div class="content-wrapper">
      
		<?php
		
		// Select Header Style
		
		$momspace_nav_global = momspace_get_option( 'nav_menu' ); // Global
		$momspace_nav_style =  get_post_meta( get_the_ID(), 'momspace_post_meta', true ); // Post Metabox

        get_template_part( 'template-parts/header' );

        endif;
        ?>
		