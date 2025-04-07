<?php
/**
 * The template for displaying catgeory pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package evior
 */

get_header();

$evior_cat_style = get_term_meta( get_queried_object_id(), 'evior', true );
$evior_cat_style_template = !empty( $evior_cat_style['evior_cat_layout'] )? $evior_cat_style['evior_cat_layout'] : '';
	
?>

	<!-- Category Breadcrumb -->
    <div class="theme-breadcrumb__Wrapper theme-breacrumb-area">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12">
					<h1 class="theme-breacrumb-title">
					<?php single_cat_title(); ?>
					</h1>
					
                </div>
            </div>
        </div>
    </div>
    <!-- Category Breadcrumb End -->

	<section id="main-content" class="blog main-container cat-page-spacing" role="main">
		<div class="container">
			<div class="row">
				<div class="<?php if(is_active_sidebar('sidebar-1')) { echo "col-lg-8"; } else { echo "col-lg-12";}?> col-md-12">
				
					<?php if (have_posts() ): ?>
					
					<?php 
				
						$evior_cat_global = evior_get_option( 'evior_cat_layout' ); //for global	  
						
						if( is_category() && !empty( $evior_cat_style  ) ) {
						 
						get_template_part( 'template-parts/category-templates/'.$evior_cat_style_template.'' ); 
						
						} elseif ( class_exists( 'CSF' ) && !empty( $evior_cat_global ) ) {
							
							get_template_part( 'template-parts/category-templates/'.$evior_cat_global.'' );
							
						} else {
							
							get_template_part( 'template-parts/category-templates/catt-one' ); 
						}
					?>
		
					<div class="theme-pagination-style">
						<?php
							the_posts_pagination(array(
							'next_text' => '<i class="fa fa-long-arrow-right"></i>',
							'prev_text' => '<i class="fa fa-long-arrow-left"></i>',
							'screen_reader_text' => ' ',
							'type'                => 'list'
						));
						?>
					</div>
					
					<?php else: ?>
						<?php get_template_part('template-parts/content', 'none'); ?>
					<?php endif; ?>
					<?php
if (is_category()) {
    $category = get_queried_object();
    if (!empty($category->description)) {
        echo '<div class="category-description">' . category_description() . '</div>';
    }
}
?>

				</div>
				
				<?php get_sidebar(); ?>
				
			</div>
		</div>
	</section>

<?php get_footer(); ?>
