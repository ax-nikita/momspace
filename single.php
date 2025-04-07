<?php
/**
 * The template for displaying 404.
 *
 * @package AmberyTheme
 * @version 1.0.0
 */
?>
	<!DOCTYPE html>
<html <?php language_attributes(); ?><?php ambery_schema_markup( 'html' ); ?> class="no-js no-svg">
	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
		<?php wp_head(); ?>
	</head>
<body <?php body_class(); ?><?php ambery_schema_markup( 'body' ); ?>>
<?php wp_body_open(); ?>
<div id="dtr-wrapper" class="clearfix">
<?php $heading 	=  get_theme_mod('ambery_404_heading', esc_html__('404','ambery'));
$text 		=  get_theme_mod('ambery_404_text', esc_html__('We are sorry, but something went wrong.','ambery'));
$subtext 	=  get_theme_mod('ambery_404_subtext', esc_html__('Oops...','ambery'));
$linktext	=  get_theme_mod('ambery_404_link_text', esc_html__('Back To Home','ambery')); ?>
	<div id="dtr-main-wrapper" class="container dtr-fullwidth">
		<main id="dtr-primary-section" class="dtr-content-area clearfix">
			<div class="dtr-primary-section-content">
				<div class="error-404 clearfix">
					<div class="row">
						<div class="col-12">
							<h2 class="heading-404"> <?php echo esc_html( $heading ); ?> </h2>
						</div>
						<div class="col-md-6 offset-md-3 error-form-wrapper">
							<h4 class="subtext-404"><?php echo wp_kses_post( $subtext ); ?></h4>
							<p class="text-404"><?php echo wp_kses_post( $text ); ?> </p>
						</div>
						<div class="col-12"> <a class="dtr-btn link-404" href="<?php echo esc_url( home_url( '/' ) ); ?>"> <?php echo esc_html( $linktext ); ?> </a> </div>
					</div>
				</div>
			</div>
		</main>
	</div>
	<!-- #content-wrapper -->
<?php get_footer();