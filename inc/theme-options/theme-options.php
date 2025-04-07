<?php
/*
 * Theme Options
 * @package momspace
 * @since 1.0.0
 * */

if ( !defined('ABSPATH') ){
    exit(); // exit if access directly
}

if( class_exists( 'CSF' ) ) {

  //
  // Set a unique slug-like ID
  $prefix = 'momspace';

  //
  // Create options
  CSF::createOptions( $prefix.'_theme_options', array(
    'menu_title' => esc_html__('Theme Option','momspace'),
    'menu_slug'  => 'momspace-theme-option',
    'menu_type' => 'menu',
    'enqueue_webfont'         => true,
    'show_footer' => false,
    'framework_title'      => esc_html__('momspace Theme Options','momspace'),
  ) );

  //
  // Create a section
  CSF::createSection( $prefix.'_theme_options', array(
    'title'  => esc_html__('General','momspace'),
    'icon'  => 'fa fa-wrench',
    'fields' => array(

		array(
			'type' => 'subheading',
			'content' => '<h3>' . esc_html__('Site Logo', 'momspace') . '</h3>',
		) ,
			
		array(
			'id' => 'theme_logo',
			'title' => esc_html__('Main Logo','momspace'),
			'type' => 'media',
			'library' => 'image',
			'desc' => esc_html__('Upload Your Static Logo Image on Header Static', 'momspace')
		), 
		
		
		array(
			'id' => 'logo_width',
			'type' => 'slider',
			'title' => esc_html__('Set Logo Width','momspace'),
			'min' => 0,
			'max' => 300,
			'step' => 1,
			'unit' => 'px',
			'default' => 102,
			'desc' => esc_html__('Set Logo Width in px. Default Width 184px.', 'momspace') ,
		) ,
		
	  
      array(
        'type' => 'subheading',
        'content' =>'<h3>'.esc_html__('Preloader','momspace').'</h3>'
      ),
	  
	  
      array(
        'id' => 'preloader_enable',
        'title' => esc_html__('Enable Preloader','momspace'),
        'type' => 'switcher',
        'desc' => esc_html__('Enable or Disable Preloader', 'momspace') ,
        'default' => true,
      ),
	  
      array(
        'type' => 'subheading',
        'content' =>'<h3>'.esc_html__('Back Top Options','momspace').'</h3>'
      ),
	  
	  
      array(
        'id' => 'back_top_enable',
        'title' => esc_html__('Scroll Top Button','momspace'),
        'type' => 'switcher',
        'desc' => esc_html__('Enable or Disable scroll button', 'momspace') ,
        'default' => true,
      ),
	  
	array(
		'type' => 'subheading',
		'content' =>'<h3>'.esc_html__('Theme Layout Options','momspace').'</h3>'
	),


	array(
	  'id'          => 'theme_border_type',
	  'type'        => 'select',
	  'title'       => 'Select Theme Border Style Type for Blocks',
	  'options'     => array(
		'rounded'  => 'Rounded Design',
		'solid'  => 'Flat Design',
	  ),
	  'default'     => 'rounded'
	),
		

    )
  ) );

  /*-------------------------------------------------------
     ** Entire Site Header  Options
   --------------------------------------------------------*/
  
    CSF::createSection( $prefix.'_theme_options', array(
    'title'  => esc_html__('Header','momspace'),
    'id' => 'header_options',
    'icon' => 'fa fa-header',
    'fields' => array(
      array(
        'type' => 'subheading',
        'content' =>'<h3>'.esc_html__('Header Layout','momspace').'</h3>'
      ),
        //
        // nav select
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
            'id' => 'theme_header_sticky',
            'title' => esc_html__('Sticky Header', 'momspace') ,
            'type' => 'switcher',
            'desc' => esc_html__('Enable Sticky Header', 'momspace') ,
            'default' => true,
    ) ,

 
	array(
        'type' => 'subheading',
        'content' =>'<h3>'.esc_html__('Header Top Bar','momspace').'</h3>'
      ),


   array(
        'id' => 'header_bg_enable',
        'title' => esc_html__('Enable Header Top Background','momspace'),
        'type' => 'switcher',
        'desc' => esc_html__('Enable or Disable Top bar background', 'momspace') ,
        'default' => false,
    ),


    array(
        'id' => 'topbar_bg_img',
        'title' => esc_html__('Set Top bar Background Image', 'momspace'),
        'type' => 'background',
        'desc' => esc_html__('Set Hedaer top bar background image.', 'momspace') ,
        'default' => array(
            'background-size' => 'cover',
            'background-position' => 'center center',
            'background-repeat' => 'no-repeat',
        ),
        'background_color' => false,
        'dependency' => array('header_bg_enable', '==', 'true')
    ),
    
    array(
        'id' => 'topbar_bg_color',
        'title' => esc_html__('Set Background Color', 'momspace'),
        'type' => 'color',
        'default' => 'rgba(255,53,36,1)',
        'desc' => esc_html__('Set color for Top bar background.', 'momspace') ,
        'dependency' => array('header_bg_enable', '==', 'true')
    ),


	  
	array(
        'id' => 'header_top_promo',
        'title' => esc_html__('Show Header Top Promotion Text','momspace'),
        'type' => 'switcher',
        'default' => true,
		'desc' => esc_html__('Enable Header Promotion', 'momspace') ,
    ),

	array(
		'id'         => 'promo_title',
		'type'       => 'text',
		'title'      => esc_html__('Promo Highlighted Title','momspace'),
		'default'    => esc_html__('New','momspace'),
		'desc'       => esc_html__('Type Title','momspace'),
		'dependency' => array( 'header_top_promo', '==', 'true' ),
	),
	
	array(
		'id'         => 'promo_text',
		'type'       => 'text',
		'title'      => esc_html__('Promo Text','momspace'),
		'default'    => esc_html__('Incredible offer for our exclusive subscribers!','momspace'),
		'desc'       => esc_html__('Type Promotion offer text','momspace'),
		'dependency' => array( 'header_top_promo', '==', 'true' ),
	),
	
	array(
		'id'         => 'promo_text_btn',
		'type'       => 'text',
		'title'      => esc_html__('Promo Button Text','momspace'),
		'default'    => esc_html__('Read More','momspace'),
		'desc'       => esc_html__('Type Promotion Button text','momspace'),
		'dependency' => array( 'header_top_promo', '==', 'true' ),
	),
	
	array(
		'id'         => 'promo_btn_link',
		'type'       => 'text',
		'title'      => esc_html__('Promo Button Link','momspace'),
		'default'    => esc_html__('#','momspace'),
		'desc'       => esc_html__('Type Promotion Button Link','momspace'),
		'dependency' => array( 'header_top_promo', '==', 'true' ),
	),
	  
	  
	array(
        'type' => 'subheading',
        'content' =>'<h3>'.esc_html__('Header Top Bar','momspace').'</h3>'
      ),
	  
      array(
        'id' => 'header_top_enable',
        'title' => esc_html__('Show Header Top','momspace'),
        'type' => 'switcher',
        'default' => true,
		'desc' => esc_html__('Enable Header Top', 'momspace') ,
      ),

		
		array(
			'id' => 'header_top_weather',
			'title' => esc_html__('Show weather box', 'momspace') ,
			'type' => 'switcher',
			'desc' => esc_html__('Enable Header weather box', 'momspace') ,
			'dependency' => array(
				'header_top_enable',
				'==',
				'true'
			) ,
			'default' => true,
		) ,
		
		array(
		'id'         => 'waether_text',
		'type'       => 'text',
		'title'      => esc_html__('Header Weather Text','momspace'),
		'default'    => esc_html__('38°C','momspace'),
		'desc'       => esc_html__('Type Header Weather Text','momspace'),
		'dependency' => array( 'header_top_enable', '==', 'true' ),
	),
		
		
		array(
			'id' => 'header_top_calender',
			'title' => esc_html__('Show Current Date', 'momspace') ,
			'type' => 'switcher',
			'desc' => esc_html__('Enable Header Current Date', 'momspace') ,
			'dependency' => array(
				'header_top_enable',
				'==',
				'true'
			) ,
			'default' => true,
		) ,
		
		array(
			'id' => 'top_text_btn_enable',
			'title' => esc_html__('Show Header Top Button', 'momspace') ,
			'type' => 'switcher',
			'desc' => esc_html__('Enable Header Top Button', 'momspace') ,
			'dependency' => array(
				'header_top_enable',
				'==',
				'true'
			) ,
			'default' => true,
		) ,
		
	
		array(
			'id'         => 'top_text_btn',
			'type'       => 'text',
			'title'      => esc_html__('Top Button Text', 'momspace') ,
			'default'    => esc_html__('Buy Theme', 'momspace') ,
			'desc'       => esc_html__('Type text', 'momspace') ,
			'dependency' => array( 'header_top_enable', '==', 'true' ),
		),
			
		array(
		'id'         => 'top_text_btn_link',
		'type'       => 'text',
		'title'      => esc_html__('Top Button Link', 'momspace') ,
		'default'    => esc_html__('#', 'momspace') ,
		'desc'       => esc_html__('Type Button Link', 'momspace') ,
		'dependency' => array( 'header_top_enable', '==', 'true' ),
	),
	
	
	array(
		'id' => 'top_bar_nav',
		'title' => esc_html__('Top Bar Menu','momspace'),
		'type' => 'switcher',
		'desc' => esc_html__('You can set menu on Top bar in Header Style 4','momspace'),
		'default' => false,
	),

	  
	       	
		
	array(
        'type' => 'subheading',
        'content' =>'<h3>'.esc_html__('Search Bar & Login Option','momspace').'</h3>'
      ),
	  
      array(
        'id' => 'search_bar_enable',
        'title' => esc_html__('Search Bar Display In Header','momspace'),
        'type' => 'switcher',
		'desc' => esc_html__('Enable or Disable Search Bar', 'momspace') ,
        'default' => true,
      ),
	  
	  array(
        'id' => 'login_btn_enable',
        'title' => esc_html__('Show Login Button','momspace'),
        'type' => 'switcher',
		'desc' => esc_html__('Enable or Disable Login Button', 'momspace') ,
        'default' => true,
      ), 
	  
	  array(
        'id' => 'register_btn_enable',
        'title' => esc_html__('Show Register Button','momspace'),
        'type' => 'switcher',
		'desc' => esc_html__('Enable or Disable Register Button', 'momspace') ,
        'default' => true,
      ),
	  
	  
		
	array(
        'type' => 'subheading',
        'content' =>'<h3>'.esc_html__('Social Options','momspace').'</h3>'
     ),	
	
      array(
        'id' => 'header_social_enable',
        'title' => esc_html__('Do You want to Show Header Social Icons','momspace'),
        'type' => 'switcher',
		'desc' => esc_html__('Enable or Disable Social Bar', 'momspace') ,
        'default' => false,
      ),
	  
		
	array(
        'id'     => 'social-icon',
        'type'   => 'repeater',
        'title'  => esc_html__('Repeater','momspace'),
        'dependency' => array('header_social_enable','==','true'),
        'fields' => array(
          array(
            'id'    => 'icon',
            'type'  => 'icon',
            'title' => esc_html__('Pick Up Your Social Icon','momspace'),
          ),
          array(
            'id'    => 'link',
            'type'  => 'text',
            'title' => esc_html__('Inter Social Url','momspace'),
          ),

        ),
      ),	
		
		

    )
  ));
  
   
    /*-------------------------------------
     ** Typography Options
     -------------------------------------*/
    CSF::createSection($prefix . '_theme_options', array(
        'title' => esc_html__('Typography', 'momspace') ,
		'id' => 'typography_options',
		'icon' => 'fa fa-font',
        'fields' => array(

            array(
                'type' => 'subheading',
                'content' => '<h3>' . esc_html__('Body', 'momspace') . '</h3>'
            ) ,

            array(
                'id' => 'body-typography',
                'type' => 'typography',
                'output' => 'body',
                'default' => array(
					'color' => '#555555',
                    'font-family' => 'Red Hat Display',
                    'font-weight' => '500',
                    'font-size' => '17',
                    'line-height' => '26',
					'letter-spacing' => false,
                    'subset' => 'latin-ext',
                    'type' => 'google',
                    'unit' => 'px',
                ) ,

            ) ,

            array(
                'type' => 'subheading',
                'content' => '<h3>' . esc_html__('Heading h1', 'momspace') . '</h3>'
            ) ,

            array(
                'id' => 'heading-one-typo',
                'type' => 'typography',

                'output' => 'h1',
                'default' => array(
                    'color' => '#272727',
                    'font-family' => 'Red Hat Display',
                    'font-weight' => '700',
					'font-size' => '42',
                    'line-height' => '50',
                    'subset' => 'latin-ext',
                    'text-align' => 'left',
                    'type' => 'google',
                    'unit' => 'px',
                    'letter-spacing' => false,
                ) ,
                'extra-styles' => array(
                    '300',
                    '400',
                    '500',
                    '600',
                    '800',
                    '900'
                ) ,
            ) ,

            array(
                'type' => 'subheading',
                'content' => '<h3>' . esc_html__('Heading h2', 'momspace') . '</h3>'
            ) ,

            array(
                'id' => 'heading-two-typo',
                'type' => 'typography',

                'output' => 'h2',
                'default' => array(
                    'color' => '#272727',
                    'font-family' => 'Red Hat Display',
                    'font-weight' => '700',
					'font-size' => '28',
                    'line-height' => '36',
                    'subset' => 'latin-ext',
                    'text-align' => 'left',
                    'type' => 'google',
                    'unit' => 'px',
                    'letter-spacing' => false,
                ) ,
                'extra-styles' => array(
                    '300',
                    '400',
                    '500',
                    '600',
                    '800',
                    '900'
                ) ,
            ) ,

            array(
                'type' => 'subheading',
                'content' => '<h3>' . esc_html__('Heading h3', 'momspace') . '</h3>'
            ) ,

            array(
                'id' => 'heading-three-typo',
                'type' => 'typography',

                'output' => 'h3',
                'default' => array(
                    'color' => '#272727',
                    'font-family' => 'Red Hat Display',
                    'font-weight' => '700',
					'font-size' => '24',
                    'line-height' => '28',
                    'subset' => 'latin-ext',
                    'text-align' => 'left',
                    'type' => 'google',
                    'unit' => 'px',
                    'letter-spacing' => false,
                ) ,
                'extra-styles' => array(
                    '300',
                    '400',
                    '500',
                    '600',
                    '800',
                    '900'
                ) ,
            ) ,

            array(
                'type' => 'subheading',
                'content' => '<h3>' . esc_html__('Heading h4', 'momspace') . '</h3>'
            ) ,

            array(
                'id' => 'heading-four-typo',
                'type' => 'typography',

                'output' => 'h4',
                'default' => array(
                    'color' => '#272727',
                    'font-family' => 'Red Hat Display',
                    'font-weight' => '700',
					'font-size' => '18',
                    'line-height' => '28',
                    'subset' => 'latin-ext',
                    'text-align' => 'left',
                    'type' => 'google',
                    'unit' => 'px',
                    'letter-spacing' => false,
                ) ,
                'extra-styles' => array(
                    '300',
                    '400',
                    '500',
                    '600',
                    '800',
                    '900'
                ) ,
            ) ,

            array(
                'type' => 'subheading',
                'content' => '<h3>' . esc_html__('Heading h5', 'momspace') . '</h3>'
            ) ,

            array(
                'id' => 'heading-five-typo',
                'type' => 'typography',

                'output' => 'h5',
                'default' => array(
                    'color' => '#272727',
                    'font-family' => 'Red Hat Display',
                    'font-weight' => '700',
					'font-size' => '14',
                    'line-height' => '24',
                    'subset' => 'latin-ext',
                    'text-align' => 'left',
                    'type' => 'google',
                    'unit' => 'px',
                    'letter-spacing' => false,
                ) ,
                'extra-styles' => array(
                    '300',
                    '400',
                    '500',
                    '600',
                    '800',
                    '900'
                ) ,
            ) ,

            array(
                'type' => 'subheading',
                'content' => '<h3>' . esc_html__('Heading h6', 'momspace') . '</h3>'
            ) ,

            array(
                'id' => 'heading-six-typo',
                'type' => 'typography',
                'output' => 'h6',
                'default' => array(
                    'color' => '#272727',
                    'font-family' => 'Red Hat Display',
                    'font-weight' => '700',
					'font-size' => '14',
                    'line-height' => '28',
                    'subset' => 'latin-ext',
                    'text-align' => 'left',
                    'type' => 'google',
                    'unit' => 'px',
                    'letter-spacing' => false,
                ) ,
                'extra-styles' => array(
                    '300',
                    '400',
                    '500',
                    '600',
                    '800',
                    '900'
                ) ,
            ) ,

        )
    ));
  
  
  
  

  /*-------------------------------------------------------
     ** Pages and Template
   --------------------------------------------------------*/

   // blog optoins
    CSF::createSection( $prefix.'_theme_options', array(
    'title'  => esc_html__('Blog','momspace'),
    'id' => 'blog_page',
    'icon' => 'fa fa-bookmark',
    'fields' => array(
      array(
        'type' => 'subheading',
        'content' =>'<h3>'.esc_html__('Blog Options','momspace').'</h3>'
      ),
	  
	  	array(
			'id'         => 'blog_title',
			'type'       => 'text',
			'title'      => esc_html__('Blog Page Title','momspace'),
			'default'    => esc_html__('Blog Page','momspace'),
			'desc'       => esc_html__('Type Blog Page Title','momspace'),
		),
		
		array(
			'id' => 'page-spacing-blog',
			'type' => 'spacing',
			'title' => esc_html__('Blog Page Spacing','momspace'),
			'output' => '.main-container.blog-spacing',
			'output_mode' => 'padding', // or margin, relative
			'default' => array(
				'top' => '80',
				'right' => '0',
				'bottom' => '80',
				'left' => '0',
				'unit' => 'px',
			) ,
		) ,
		
		array(
			'id' => 'blog_breadcrumb_enable',
			'title' => esc_html__('Breadcrumb', 'momspace') ,
			'type' => 'switcher',
			'desc' => esc_html__('Enable Breadcrumb', 'momspace') ,
			'default' => true,
		) ,
			
		

	 
    )
  ));
  
  
    // category 
	
  CSF::createSection( $prefix.'_theme_options', array(
    'title'  => esc_html__('Category','momspace'),
    'id' => 'cat_page',
    'icon' => 'fa fa-list-ul',
    'fields' => array(
      array(
        'type' => 'subheading',
        'content' => '<h3>' . esc_html__('Theme Category Options. You can Customize Each Catgeory by Editing Individually.', 'momspace') . '</h3>'
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
		
		array(
			'id' => 'page-spacing-category',
			'type' => 'spacing',
			'title' => esc_html__('Category Page Spacing','momspace'),
			'output' => '.main-container.cat-page-spacing',
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
  ));
  
  

  // blog single optoins
    CSF::createSection( $prefix.'_theme_options', array(
    'title'  => esc_html__('Single','momspace'),
    'id' => 'single_page',
    'icon' => 'fa fa-pencil-square-o',
    'fields' => array(
      array(
        'type' => 'subheading',
        'content' =>'<h3>'.esc_html__('Blog Single Page Option','momspace').'</h3>'
      ),
	  
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
		
		array(
			'id' => 'page-spacing-single',
			'type' => 'spacing',
			'title' => esc_html__('Single Blog Spacing','momspace'),
			'output' => '.single-one-bwrap',
			'output_mode' => 'padding', // or margin, relative
			'default' => array(
				'top' => '40',
				'right' => '0',
				'bottom' => '80',
				'left' => '0',
				'unit' => 'px',
			) ,
		) ,
		
		array(
			'id'         => 'blog_prev_title',
			'type'       => 'text',
			'title'      => esc_html__('Previous Post Text','momspace'),
			'default'    => esc_html__('Previous Post','momspace'),
			'desc'       => esc_html__('Type Previous Post Link Title','momspace'),
		),
		
		array(
			'id'         => 'blog_next_title',
			'type'       => 'text',
			'title'      => esc_html__('Next Post Text','momspace'),
			'default'    => esc_html__('Next Post','momspace'),
			'desc'       => esc_html__('Type Next Post Link Title','momspace'),
		),
			
		array(
			'id' => 'blog_single_cat',
			'title' => esc_html__('Show Catgeory','momspace'),
			'type' => 'switcher',
			'desc' => esc_html__('Show Category Name','momspace'),
			'default' => true,
		),
		
		array(
			'id' => 'blog_single_author',
			'title' => esc_html__('Show Author','momspace'),
			'type' => 'switcher',
			'desc' => esc_html__('Single Post Author','momspace'),
			'default' => true,
		),

		array(
			'id' => 'blog_nav',
			'title' => esc_html__('Show Navigation','momspace'),
			'type' => 'switcher',
			'desc' => esc_html__('Post Navigation','momspace'),
			'default' => true,
		),
		
		array(
			'id' => 'blog_tags',
			'title' => esc_html__('Show Tags','momspace'),
			'type' => 'switcher',
			'desc' => esc_html__('Show Post Tags','momspace'),
			'default' => true,
		),
		
		array(
			'id' => 'blog_related',
			'title' => esc_html__('Show Related Posts','momspace'),
			'type' => 'switcher',
			'desc' => esc_html__('Related Posts','momspace'),
			'default' => true,
		),
		
		array(
			'id' => 'blog_views',
			'title' => esc_html__('Show Post Views','momspace'),
			'type' => 'switcher',
			'desc' => esc_html__('Post views','momspace'),
			'default' => false,
		),


    )
  ));


  /*-------------------------------------------------------
       ** Woocommerce  Options
  --------------------------------------------------------*/
    
  CSF::createSection( $prefix.'_theme_options', array(
    'title'  => esc_html__('Shop','momspace'),
    'id' => 'cat_page',
    'icon' => 'fa fa-pencil-square-o',
    'fields' => array(
      array(
        'type' => 'subheading',
        'content' => '<h3>' . esc_html__('Shop Layout', 'momspace') . '</h3>'
      ),
      
      
        array(
            'id' => 'shop_layout',
            'type' => 'image_select',
            'title' => esc_html__('Shop Layout','momspace'),
            'options' => array(
             
                'right-sidebar' => momspace_IMG . '/admin/header-style/right-sidebar.png',
                'left-sidebar' => momspace_IMG . '/admin/header-style/left-sidebar.png',
                'no-sidebar' => momspace_IMG . '/admin/header-style/default.png',
            ),
            
            'default' => 'right-sidebar'
        ),
        
        
        array(
            'id' => 'single_shop_layout',
            'type' => 'image_select',
            'title' => esc_html__('Single Product Layout','momspace'),
            'options' => array(
             
                'right-sidebar' => momspace_IMG . '/admin/header-style/right-sidebar.png',
                'left-sidebar' => momspace_IMG . '/admin/header-style/left-sidebar.png',
                'no-sidebar' => momspace_IMG . '/admin/header-style/default.png',
            ),
            
            'default' => 'right-sidebar'
        ),

        array(
            'id'         => 'product_page_title',
            'type'       => 'text',
            'title'      => esc_html__('Poduct Page Title Text','momspace'),
            'default'    => esc_html__('Product Details','momspace'),
            'desc'       => esc_html__('Give Product Page Title Text','momspace'),
        ),


        array(
            'id' => 'related_product_show',
            'title' => esc_html__('Show or Hide Related Products', 'momspace') ,
            'type' => 'switcher',
            'desc' => esc_html__('Related Product Show or Hide', 'momspace') ,
            'default' => true,
        ) ,




    )
  )); 



  /*-------------------------------------------------------
       ** Footer  Options
  --------------------------------------------------------*/
  CSF::createSection( $prefix.'_theme_options', array(
    'title'  => esc_html__('Footer','momspace'),
    'id' => 'footer_options',
    'icon' => 'fa fa-copyright',
    'fields' => array(
      array(
        'type' => 'subheading',
        'content' =>'<h3>'.esc_html__('Footer Options','momspace').'</h3>'
      ),
	  
	array(
        'id' => 'footer_nav',
        'title' => esc_html__('Footer Right Menu','momspace'),
        'type' => 'switcher',
		'desc' => esc_html__('You can set Yes or No to show Footer menu','momspace'),
        'default' => false,
      ),
	  
	  
      array(
        'type' => 'subheading',
        'content' =>'<h3>'.esc_html__('Footer Copyright Area Options','momspace').'</h3>'
      ),

      array(
        'id' => 'copyright_text',
        'title' => esc_html__('Copyright Area Text','momspace'),
        'type' => 'textarea',
        'desc' => esc_html__('Footer Copyright Text','momspace'),
      ),


	  
    )
  ));


  // Backup section
  CSF::createSection( $prefix.'_theme_options', array(
    'title'  => esc_html__('Backup','momspace'),
    'id'    => 'backup_options',
    'icon'  => 'fa fa-window-restore',
    'fields' => array(
        array(
            'type' => 'backup',
        ),   
    )
  ) );
  

}