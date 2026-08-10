<?php

// tp metabox 
add_filter( 'tp_meta_boxes', 'themepure_metabox' );

function themepure_metabox( $meta_boxes ) {
	
	$prefix     = 'diego';
	
	$meta_boxes[] = array(
		'metabox_id'       => $prefix . '_page_meta_box',
		'title'    => esc_html__( 'TP Page Info', 'diego' ),
		'post_type'=> ['page', 'portfolio', 'services', 'post'],
		'context'  => 'normal',
		'priority' => 'core',
		'fields'   => array( 
				
			
			array(
				
				'label'    => esc_html__( 'Logo Black', 'diego' ),
				'id'      => "{$prefix}_logo_black",
				'type'    => 'image',
				'default' => '',
			),
			
			array(
				
				'label'    => esc_html__( 'Logo White', 'diego' ),
				'id'      => "{$prefix}_logo_white",
				'type'    => 'image',
				'default' => '',
			),
			array(
				'label' => 'Logo Width',
				'id'    => "{$prefix}_logo_width",
				'type'  => 'text', // specify the type field
				'placeholder' => '',
				'default' => '', // do not remove default key
			),
			array(
				
				'label'           => esc_html__('Select Theme Mode', 'diego'),
				'id'              => "{$prefix}_theme_mode",
				'type'            => 'select',
				'default' 		=> 'select_theme_mode',
				'placeholder'     => esc_html__( 'Select Theme Mode', 'diego' ),
				'conditional' => array(),
				'options'         => array(
					'select_theme_mode' => esc_html__( 'Select Theme Mode', 'diego' ),
					'dark_mode' => esc_html__( 'Dark Mode', 'diego' ),
					'light_mode' => esc_html__( 'Light Mode', 'diego' ),
				),
				
			),
			array(
				'label'    => esc_html__( 'Disable Scroll Effect ?', 'diego' ),
				'id'      => "{$prefix}_scroll_effect",
				'type'    => 'switch',
				'default' => 'off',
				'conditional' => array()
			),	
			array(  
				'label'     => esc_html__( 'Change Body Background', 'diego' ),
				'id'      => "{$prefix}_body_bg",
				'type'      => 'colorpicker', // specify the type field
				'default'   => '',
				'conditional' => array()
			),
			array(
				'label'    => esc_html__( 'Enable Distort Background ?', 'diego' ),
				'id'      => "{$prefix}_green_bg",
				'type'    => 'switch',
				'default' => 'off',
				'conditional' => array()
			),	
			array(
				
				'label'    => esc_html__( 'Green Distort Background', 'diego' ),
				'id'      => "{$prefix}_distort_bg",
				'type'    => 'image',
				'default' => '',
				'conditional' => array(
					"{$prefix}_green_bg", "==", "on"
				)
			),
			array(
				'label'    => esc_html__( 'Show Breadcrumb?', 'diego' ),
				'id'      => "{$prefix}_check_bredcrumb",
				'type'    => 'switch',
				'default' => 'on',
				'conditional' => array()
			),		
			array(
				'label'    => esc_html__( 'Show Breadcrumb Image?', 'diego' ),
				'id'      => "{$prefix}_check_bredcrumb_img",
				'type'    => 'switch',
				'default' => 'on',
				'conditional' => array(
					"{$prefix}_check_bredcrumb", "==", "on"
				)
			), 

			array(  
				'label'     => esc_html__( 'Breadcrumb BG Color', 'diego' ),
				'id'        => "{$prefix}_bredcrumb_bg_color",
				'type'      => 'colorpicker',
				'default'   => '',
				'conditional' => array(
					"{$prefix}_check_bredcrumb", "==", "on"
				)
			),
            array(
				
				'label'    => esc_html__( 'Breadcrumb Background', 'diego' ),
				'id'      => "{$prefix}_breadcrumb_bg",
				'type'    => 'image',
				'default' => '',
				'conditional' => array(
					"{$prefix}_check_bredcrumb_img", "==", "on"
				)
			),


            array(
				'label' => 'Footer BG Color',
				'id'   	=> "{$prefix}_footer_bg_color",
				'type' 	=> 'colorpicker',
				'default' 	  => '',
				'conditional' => array()
			),




            // multiple buttons group field like multiple radio buttons
			array(
				'label'   => esc_html__( 'Header', 'diego' ),
				'id'      => "{$prefix}_header_tabs",
				'desc'    => '',
				'type'    => 'tabs',
				'choices' => array(
					'default' => esc_html__( 'Default', 'diego' ),
					'custom' => esc_html__( 'Custom', 'diego' ),
					'elementor' => esc_html__( 'Elementor', 'diego' ),
				),
				'default' => 'default',
				'conditional' => array()
			), 

            // select field dropdown
			array(
				
				'label'           => esc_html__('Select Header Style', 'diego'),
				'id'              => "{$prefix}_header_style",
				'type'            => 'select',
				'options'         => array(
					'header_1' => esc_html__( 'Header 1', 'diego' ),
				),
				'placeholder'     => esc_html__( 'Select a header', 'diego' ),
				'conditional' => array(
					"{$prefix}_header_tabs", "==", "custom"
				),
				'default' => 'header_1',
				'parent' => "{$prefix}_header_tabs"
			),

            // select field dropdown
			array(
				
				'label'           => esc_html__('Select Header Template', 'diego'),
				'id'              => "{$prefix}_header_templates",
				'type'            => 'select_posts',
				'placeholder'     => esc_html__( 'Select a template', 'diego' ),
                'post_type'       => 'tp-header',
				'conditional' => array(
					"{$prefix}_header_tabs", "==", "elementor"
				),
				'default' => '',
				'parent' => "{$prefix}_header_tabs"
			),


            // multiple buttons group field like multiple radio buttons
			array(
				'label'   => esc_html__( 'Footer', 'diego' ),
				'id'      => "{$prefix}_footer_tabs",
				'desc'    => '',
				'type'    => 'tabs',
				'choices' => array(
					'default' => esc_html__( 'Default', 'diego' ),
					'custom' => esc_html__( 'Custom', 'diego' ),
					'elementor' => esc_html__( 'Elementor', 'diego' ),
				),
				'default' => 'default',
				'conditional' => array()
			), 

            // select field dropdown
			array(
				
				'label'           => esc_html__('Select Footer Style', 'diego'),
				'id'              => "{$prefix}_footer_style",
				'type'            => 'select',
				'options'         => array(
					'footer_blank' => esc_html__( 'Footer Blank', 'diego' ),
					'footer_1' => esc_html__( 'Footer 1', 'diego' ),
				),
				'placeholder'     => esc_html__( 'Select a footer', 'diego' ),
				'conditional' => array(
					"{$prefix}_footer_tabs", "==", "custom"
				),
				'default' => 'footer_1',
				'parent' => "{$prefix}_footer_tabs"
			),

            // select field dropdown
			array(
				
				'label'           => esc_html__('Select Footer Template', 'diego'),
				'id'              => "{$prefix}_footer_templates",
				'type'            => 'select_posts',
				'placeholder'     => esc_html__( 'Select a template', 'diego' ),
                'post_type'       => 'tp-footer',
				'conditional' => array(
					"{$prefix}_footer_tabs", "==", "elementor"
				),
				'default' => '',
				'parent' => "{$prefix}_footer_tabs"
			),
			array(
				
				'label'           => esc_html__('Select Offcanvas Style', 'diego'),
				'id'              => "{$prefix}_offcanvas_style",
				'type'            => 'select',
				'options'         => array(
					'select_offcanvas' => esc_html__( 'Select Offcanvas', 'diego' ),
					'offcanvas-style-1' => esc_html__( 'Offcanvas 1', 'diego' ),
				),
				'placeholder'     => esc_html__( 'Select a offcanvas', 'diego' ),
				'default' => 'select_offcanvas',
			),
		),
	);

    $meta_boxes[] = array(
		'metabox_id'       => $prefix . '_post_gallery_meta',
		'title'    => esc_html__( 'TP Gallery Post', 'diego' ),
		'post_type'=> 'post',
		'context'  => 'normal',
		'priority' => 'core',
		'fields'   => array( 
            array(
				'label'    => esc_html__( 'Gallery', 'diego' ),
				'id'      => "{$prefix}_post_gallery",
				'type'    => 'gallery',
				'default' => '',
				'conditional' => array(),
			),
		),
		'post_format' => 'gallery'
	);    

    $meta_boxes[] = array(
		'metabox_id'       => $prefix . '_post_layout_meta',
		'title'    => esc_html__( 'Postbox Settings', 'diego' ),
		'post_type'=> 'post',
		'context'  => 'normal',
		'priority' => 'core',
		'fields'   => array(
			array(

				'label'           => esc_html__('Select Details Layout', 'diego'),
				'id'              => "{$prefix}_blog_details_meta_layout",
				'type'            => 'select',
				'options'         => array(
					'select_layout' => 'Default Layout',
					'classic' => 'Classic',
					'full_width' => 'Full Width',
				),
				'placeholder'     => 'Select an item',
				'conditional' => array(),
				'default' => 'select_layout'
			),
			array(

				'label'           => esc_html__('Select Details Thumbnail Layout', 'diego'),
				'id'              => "{$prefix}_blog_details_thumbnail_layout",
				'type'            => 'select',
				'options'         => array(
					'select_layout' => 'Default Layout',
					'full_width_thumbnail' => 'Full Witdh',
					'box_width' => 'Box Width',
				),
				'placeholder'     => 'Select an item',
				'conditional' => array(),
				'default' => 'select_layout'
			)
		),
	);    


	$meta_boxes[] = array(
		'metabox_id'       => $prefix . '_post_video_meta',
		'title'    => esc_html__( 'TP Video Post', 'diego' ),
		'post_type'=> 'post',
		'context'  => 'normal',
		'priority' => 'core',
		'fields'   => array( 
			array(
				'label'    => esc_html__( 'Video', 'diego' ),
				'id'      => "{$prefix}_post_video",
				'type'    => 'text',
				'default' => '',
				'conditional' => array(),
				'placeholder'     => esc_html__( 'Place your video url.', 'diego' ),
			),
		),
		'post_format' => 'video'
	);	

	$meta_boxes[] = array(
		'metabox_id'       => $prefix . '_post_audio_meta',
		'title'    => esc_html__( 'TP Audio Post', 'diego' ),
		'post_type'=> 'post',
		'context'  => 'normal',
		'priority' => 'core',
		'fields'   => array( 
			array(
				'label'    => esc_html__( 'Audio', 'diego' ),
				'id'      => "{$prefix}_post_audio",
				'type'    => 'text',
				'default' => '',
				'conditional' => array(),
				'placeholder'     => esc_html__( 'Place your audio url..', 'diego' ),
			),
		),
		'post_format' => 'audio'
	);

	$meta_boxes[] = array(
		'metabox_id'       => $prefix . '_product_single_feature',
		'title'    => esc_html__( 'Product Single Features', 'diego' ),
		'post_type'=> 'product',
		'context'  => 'normal',
		'priority' => 'core',
		'fields'   => array(
			array(
    
				'label'           => esc_html__('Product Single Layout', 'diego'),
				'id'              => "{$prefix}_product_single_layout",
				'type'            => 'select',
				'options'         => array(
					'default' => 'Default View',
					'list' => 'List View',
					'grid' => 'Grid View',
					'vertical' => 'Vertical Tab',
					'carousel' => 'Carousel View',
				),
				'placeholder'     => 'Select an item',
				'conditional' => array(),
				'default' => 'default'
			),

			array(
				'label'    => esc_html__( 'Video', 'diego' ),
				'id'      => "{$prefix}_product_signle__video",
				'type'    => 'text',
				'default' => '',
				'conditional' => array(),
				'placeholder'     => esc_html__( 'Place your video url.', 'diego' ),
			), 
			array(
				'label'    => esc_html__( 'Is Product On Trending?', 'diego' ),
				'id'      => "{$prefix}_product_on_trending",
				'type'    => 'switch',
				'default' => 'off',
			),
			array(
				'label'    => esc_html__( 'Is Product On Hot?', 'diego' ),
				'id'      => "{$prefix}_product_on_hot",
				'type'    => 'switch',
				'default' => 'off',
			),

			array(
				'label'     => esc_html__('Add Product Feature', 'diego'),
				'id'        => "{$prefix}_product_single_fea_meta",
				'type'      => 'repeater', // specify the type "repeater" (case sensitive)
				'conditional'   => array(),
				'default'       => array(),
				'fields'        => array(
					array(
						'label' => 'Enter Feature Text',
						'id'   	=> "{$prefix}_product_signle_fea",
						'type' 	=> 'textarea', // specify the type field
						'placeholder' => 'Your feature here...',
						'default' 	  => '',
						'conditional' => array()
					),
				)
			),

			array(
				
				'label'    => esc_html__( 'Product Main Thumbnail', 'diego' ),
				'id'      => "{$prefix}_get_img_thumbnail",
				'type'    => 'image',
				'default' => ''
			),
		),
	);
	
	return $meta_boxes;
}

function add_user_metas(){
    $meta = array(
        'id'    => 'diego_user_meta_sec',
        'label' => 'User Additional Information',
        'fields' => array(
            array(
                'id'    => 'diego_facebook',
                'label' => 'Facebook URL',
                'type'  => 'text',
                'default' => '',
                'placeholder' => 'Facebook URL...' ,
                'show_in_admin_table' => 1
            ),
            array(
                'id'    => 'diego_twitter',
                'label' => 'Twitter URL',
                'type'  => 'text',
                'default' => '',
                'placeholder' => 'Twitter URL...' ,
                'show_in_admin_table' => 1
            ),
            array(
                'id'    => 'diego_linkedin',
                'label' => 'Linkedin URL',
                'type'  => 'text',
                'default' => '',
                'placeholder' => 'Linkedin URL...' ,
                'show_in_admin_table' => 1
            ),
            array(
                'id'    => 'diego_instagram',
                'label' => 'Instagram URL',
                'type'  => 'text',
                'default' => '',
                'placeholder' => 'Instagram URL...' ,
                'show_in_admin_table' => 1
            ),
            array(
                'id'    => 'diego_youtube',
                'label' => 'Youtube URL',
                'type'  => 'text',
                'default' => '',
                'placeholder' => 'Instagram URL...' ,
                'show_in_admin_table' => 1
            ),
            array(
                'id'    => 'diego_user_bio',
                'label' => 'User BIO',
                'type'  => 'textarea',
                'default' => 'This a demo user bio for the testing purpose', 
                'placeholder' => 'Give a short bio...' ,
                'show_in_admin_table' => 1
            ),
            array(
                'id'    => 'user_is_bio',
                'label' => 'Is user bio?',
                'type'  => 'checkbox',
                'default' => 'off',
                'show_in_admin_table' => 0
            ),
            array(
                'id'    => 'user_role_select',
                'label' => 'User Role',
                'type'  => 'select',
                'options'   => array(
                    'administrator'     => 'Administrator',
                    'subscriber'        => 'Subscriber',
                    'editor'            => 'Editor',
                ),
                'default' => 'administrator', 
                'placeholder' => 'Select a role',
                'show_in_admin_table' => 0
            ),
        )
    );

    return $meta;
}
add_filter('tp_user_meta', 'add_user_metas');