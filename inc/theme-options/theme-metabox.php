<?php
/*
 * Theme Metabox
 * @package momspace
 * @since 1.0.0
 * */

if ( !defined('ABSPATH') ){
    exit(); // exit if access directly
}

if ( class_exists('CSF') ){

    $prefix = 'momspace';

	/*-------------------------------------
		Category Taxonomy Options
	-------------------------------------*/
	
	
// Create taxonomy options
  CSF::createTaxonomyOptions( $prefix, array(
	'title'     => esc_html__('Catgeory Options','momspace'),
    'taxonomy'  => 'category',
    'data_type' => 'serialize', // The type of the database save options. `serialize` or `unserialize`
  ) );

  //
  // Create a section
  CSF::createSection( $prefix, array(
    'fields' => array(

	array(
	
	  'id'          => 'cat-color',
	  'type'        => 'color',
	  'title'       => esc_html__('Select Category Color','momspace'),
	  'default' => '#ffbc00',
	  	  
	),
	
	array(
	  'id'    => 'cat-bg',
	  'type'  => 'upload',
	  'title' => esc_html__('Upload','momspace'),
	),

	   array(
		'id' => 'momspace_cat_layout',
		'type' => 'image_select',
		'title' => esc_html__('Select Category Layout','momspace'),
		'options' => array(
			'catt-one' => momspace_IMG . '/admin/page/style1.png',
			'catt-two' => momspace_IMG . '/admin/page/style2.png',
		),
		'default' => 'catt-one'
	),

    )
  ) );
	
	
	/*-------------------------------------
		Post Format Options
	-------------------------------------*/
	CSF::createMetabox('theme_postvideo_options',array(
		'title' => esc_html__('Video Post Format Options','momspace'),
		'post_type' => 'post',
		'post_formats' => 'video',
		'data_type'          => 'serialize',
		'context'            => 'advanced',
		'priority'           => 'default',
	));
	
	CSF::createSection('theme_postvideo_options',array(
		'fields' => array(
			array(
				'id' => 'textm',
				'type' => 'text',
				'title' => esc_html__('Upload Video For Post','momspace'),
				'desc' => esc_html__('Upload Video Post','momspace'),
			)
		)
	));

	
	/*-------------------------------------
       Page Options
   -------------------------------------*/
   	  $post_metabox = 'momspace_post_meta';
	  
	  CSF::createMetabox( $post_metabox, array(
	    'title'     => esc_html__('Page Options','momspace'),
	    'post_type' => 'page',
	  ) );

	  //
	  // Create a section
	  CSF::createSection( $post_metabox, array(
	    'title'  => 'Nav Menu Option',
	    'fields' => array(
	     array(
                'type'    => 'subheading',
                'content' => esc_html__('Nav Menu Option','momspace'),
	       ),
	      //
		
		array(
            'id' => 'nav_menu',
            'type' => 'image_select',
            'title' => esc_html__('Select Header Navigation Style','momspace'),
            'options' => array(
                'nav-style-one' => momspace_IMG . '/admin/header-style/style1.png',
                'nav-style-two' => momspace_IMG . '/admin/header-style/style2.png',
				'nav-style-three' => momspace_IMG . '/admin/header-style/style2.png',
            ),
            'default' => 'nav-style-three'
        ),
		
		
		array(
			'id' => 'page_title_enable',
			'title' => esc_html__('Show Page Title','momspace'),
			'type' => 'switcher',
			'default' => true,
			'desc' => esc_html__('Show Page Title Bar', 'momspace') ,
		),
		
		
		array(
			'id' => 'page-spacing-padding',
			'type' => 'spacing',
			'title' => esc_html__('Theme Page Spacing', 'momspace') ,
			'output' => 'body.page .main-container',
			'output_mode' => 'padding', // or margin, relative
			'default' => array(
				'top' => '80',
				'right' => '0',
				'bottom' => '80',
				'left' => '0',
				'unit' => 'px',
			) ,
		) ,
		
		
		
		
		

	    )
	  ) );	
	  
	/*-------------------------------------
       Post Options
   -------------------------------------*/
   	  $single_blog_metabox = 'momspace_blog_post_meta';
	  
	  CSF::createMetabox( $single_blog_metabox, array(
	    'title'     => esc_html__('Post Options', 'momspace') ,
	    'post_type' => 'post',
	  ) );

	  //
	  // Create a section
	  CSF::createSection( $single_blog_metabox, array(
	    'title'  => esc_html__('Single Post Layout Option', 'momspace') ,
	    'fields' => array(
	     array(
                'type'    => 'subheading',
                'content' => esc_html__('Single Post Layout Option','momspace'),
	       ),
	      //
		
		array(
				'id' => 'momspace_single_blog_layout',
				'type' => 'image_select',
				'title' => esc_html__('Select Single Blog Style','momspace'),
				'options' => array(
					'single-one' => momspace_IMG . '/admin/page/blog-1.png',
					'single-two' => momspace_IMG . '/admin/page/blog-2.png',
				),
				'default' => 'single-one'
			),
		

	    )
	  ) );	
	  





}//endif