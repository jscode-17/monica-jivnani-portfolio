<?php


new \Kirki\Panel(
    'panel_id',
    [
        'priority'    => 10,
        'title'       => esc_html__( 'Diego Customizer', 'diego' ),
        'description' => esc_html__( 'Diego Customizer Description.', 'diego' ),
    ]
);

// header_top_section
function theme_settings(){
    // header_top_bar section 
    new \Kirki\Section(
        'theme_settings',
        [
            'title'       => esc_html__( 'Theme Settings', 'diego' ),
            'description' => esc_html__( 'Diego Theme Settings.', 'diego' ),
            'panel'       => 'panel_id',
            'priority'    => 100,
        ]
    );

    new \Kirki\Field\Select(
        [
            'settings'    => 'diego_theme_mode',
            'label'       => esc_html__( 'Select Default Theme Mode', 'diego' ),
            'section'     => 'theme_settings',
            'default'     => 'dark_mode',
            'placeholder' => esc_html__( 'Choose an option', 'diego' ),
            'choices'     => [
                'dark_mode' => esc_html__( 'Dark Mode', 'diego' ),
                'light_mode' => esc_html__( 'Light Mode', 'diego' ),
            ],
        ]
    );

    new \Kirki\Field\Checkbox_Switch(
        [
            'settings'    => 'diego_theme_btn_switch',
            'label'       => esc_html__( 'Theme Toggle Button Switch', 'diego' ),
            'description' => esc_html__( 'Theme Toggle Button On/Off', 'diego' ),
            'section'     => 'theme_settings',
            'default'     => 'on',
            'choices'     => [
                'on'  => esc_html__( 'Enable', 'diego' ),
                'off' => esc_html__( 'Disable', 'diego' ),
            ],
        ]
    );    


    new \Kirki\Field\Color(
        [
            'settings'    => 'body_bg_color',
            'label'       => __( 'Body BG Color', 'diego' ),
            'description' => esc_html__( 'You can change body bg color from here.', 'diego' ),
            'section'     => 'theme_settings',
            'default'     => '#0F183E',
        ]
    );

    new \Kirki\Field\Checkbox_Switch(
        [
            'settings'    => 'smooth_scroll_switch',
            'label'       => esc_html__( 'Scroll Effect Switch', 'diego' ),
            'description' => esc_html__( 'Scroll Effect On/Off', 'diego' ),
            'section'     => 'theme_settings',
            'default'     => 'off',
            'choices'     => [
                'on'  => esc_html__( 'Enable', 'diego' ),
                'off' => esc_html__( 'Disable', 'diego' ),
            ],
        ]
    );    

    new \Kirki\Field\Checkbox_Switch(
        [
            'settings'    => 'diego_awesome_cursor_switch',
            'label'       => esc_html__( 'Magic Cursor Switch', 'diego' ),
            'description' => esc_html__( 'Magic Cursor On/Off', 'diego' ),
            'section'     => 'theme_settings',
            'default'     => 'off',
            'choices'     => [
                'on'  => esc_html__( 'Enable', 'diego' ),
                'off' => esc_html__( 'Disable', 'diego' ),
            ],
        ]
    );   
    
    new \Kirki\Field\Checkbox_Switch(
        [
            'settings'    => 'diego_backtotop',
            'label'       => esc_html__( 'Back To Top Switch', 'diego' ),
            'description' => esc_html__( 'Back To Top On/Off', 'diego' ),
            'section'     => 'theme_settings',
            'default'     => 'off',
            'choices'     => [
                'on'  => esc_html__( 'Enable', 'diego' ),
                'off' => esc_html__( 'Disable', 'diego' ),
            ],
        ]
    ); 
}
theme_settings();

function header_main_section(){
    // header_top_bar section 
    new \Kirki\Section(
        'header_main_section',
        [
            'title'       => esc_html__( 'Header Main Settings', 'diego' ),
            'description' => esc_html__( 'Header Main Controls.', 'diego' ),
            'panel'       => 'panel_id',
            'priority'    => 101,
        ]
    );
    // header_top_bar section 

    new \Kirki\Field\Checkbox_Switch(
        [
            'settings'    => 'diego_header_elementor_switch',
            'label'       => esc_html__( 'Header Custom/Elementor Switch', 'diego' ),
            'description' => esc_html__( 'Header Custom/Elementor On/Off', 'diego' ),
            'section'     => 'header_main_section',
            'default'     => 'off',
            'choices'     => [
                'on'  => esc_html__( 'Enable', 'diego' ),
                'off' => esc_html__( 'Disable', 'diego' ),
            ],
        ]
    ); 

    new \Kirki\Field\Radio_Image(
        [
            'settings'    => 'header_layout_custom',
            'label'       => esc_html__( 'Chose Header Style', 'diego' ),
            'section'     => 'header_main_section',
            'priority'    => 10,
            'choices'     => [
                'header_1'   => get_template_directory_uri() . '/inc/img/header/header-1.png',
            ],
            'default'     => 'header_1',
            'active_callback' => [
                [
                    'setting' => 'diego_header_elementor_switch',
                    'operator' => '==',
                    'value' => false
                ]
            ]
        ]
    );

    $header_buildertype = array(
        'post_type'      => 'tp-header',
        'posts_per_page' => -1,
    );
    $header_buildertype_loop = get_posts($header_buildertype);

    $header_post_obj_arr = array();
    foreach($header_buildertype_loop as $post){
        $header_post_obj_arr[$post->ID] = $post->post_title;
    }


    wp_reset_query();


    new \Kirki\Field\Select(
        [
            'settings'    => 'diego_header_templates',
            'label'       => esc_html__( 'Elementor Header Template', 'diego' ),
            'section'     => 'header_main_section',
            'placeholder' => esc_html__( 'Choose an option', 'diego' ),
            'choices'     => $header_post_obj_arr,
            'active_callback' => [
                [
                    'setting' => 'diego_header_elementor_switch',
                    'operator' => '==',
                    'value' => true
                ]
            ]
        ]
    );
   
    new \Kirki\Field\Checkbox_Switch(
        [
            'settings'    => 'header_right_switch',
            'label'       => esc_html__( 'Header Right Switch', 'diego' ),
            'description' => esc_html__( 'Header Right On/Off', 'diego' ),
            'section'     => 'header_main_section',
            'default'     => 'off',
            'choices'     => [
                'on'  => esc_html__( 'Enable', 'diego' ),
                'off' => esc_html__( 'Disable', 'diego' ),
            ],
        ]
    ); 

    new \Kirki\Field\Checkbox_Switch(
        [
            'settings'    => 'diego_header_hamburger',
            'label'       => esc_html__( 'Header Hamburger Switch', 'diego' ),
            'description' => esc_html__( 'Header Hamburger On/Off', 'diego' ),
            'section'     => 'header_main_section',
            'default'     => 'off',
            'choices'     => [
                'on'  => esc_html__( 'Enable', 'diego' ),
                'off' => esc_html__( 'Disable', 'diego' ),
            ],
        ]
    ); 

    new \Kirki\Field\Text(
        [
            'settings' => 'diego_tel_text',
            'label'       => esc_html__( 'Header Contact Text', 'diego' ),
            'section'  => 'header_main_section',
            'default'  => esc_html__( 'Lets Talk', 'diego' ),
            'priority' => 10,
        ]
    );
    new \Kirki\Field\Text(
        [
            'settings' => 'diego_tel_link',
            'label'       => esc_html__( 'Header Contact URL', 'diego' ),
            'section'  => 'header_main_section',
            'default'  => esc_html__( '#', 'diego' ),
            'priority' => 10,
        ]
    );


  
}
header_main_section();

function header_logo_section(){
    // header_logo_section section 
    new \Kirki\Section(
        'header_logo_section',
        [
            'title'       => esc_html__( 'Header Logo', 'diego' ),
            'description' => esc_html__( 'Header Logo Settings.', 'diego' ),
            'panel'       => 'panel_id',
            'priority'    => 102,
        ]
    );

    // header_logo_section section 
    new \Kirki\Field\Image(
        [
            'settings'    => 'header_logo_white',
            'label'       => esc_html__( 'Header Logo White', 'diego' ),
            'description' => esc_html__( 'Theme White Logo Here', 'diego' ),
            'section'     => 'header_logo_section',
            'default'     => get_template_directory_uri() . '/assets/img/logo/logo.png',
        ]
    );
    new \Kirki\Field\Image(
        [
            'settings'    => 'header_logo_black',
            'label'       => esc_html__( 'Header Logo Black', 'diego' ),
            'description' => esc_html__( 'Theme Black Logo Here', 'diego' ),
            'section'     => 'header_logo_section',
            'default'     => get_template_directory_uri() . '/assets/img/logo/logo-black.png',
        ]
    );

    // Contacts Text 
    new \Kirki\Field\Text(
        [
            'settings' => 'diego_logo_width',
            'label'    => esc_html__( 'Logo Width', 'diego' ),
            'section'  => 'header_logo_section',
            'default'  => esc_html__( '120', 'diego' ),
            'priority' => 10,
        ]
    );
}
header_logo_section();

function preloader_section(){

    new \Kirki\Section(
        'preloader_section',
        [
            'title'       => esc_html__( 'Preloader Settings', 'diego' ),
            'description' => esc_html__( 'Preloader Controls.', 'diego' ),
            'panel'       => 'panel_id',
            'priority'    => 103,
        ]
    );
    

    new \Kirki\Field\Checkbox_Switch(
        [
            'settings'    => 'diego_preloader_switch',
            'label'       => esc_html__( 'Preloader Switch', 'diego' ),
            'description' => esc_html__( 'Preloader On/Off', 'diego' ),
            'section'     => 'preloader_section',
            'default'     => 'off',
            'choices'     => [
                'on'  => esc_html__( 'Enable', 'diego' ),
                'off' => esc_html__( 'Disable', 'diego' ),
            ],
        ]
    ); 

    new \Kirki\Field\Color(
        [
            'settings'    => 'diego_preloader_bg_color',
            'label'       => __( 'Preloader BG Color', 'diego' ),
            'description' => esc_html__( 'You can change preloader bg color from here.', 'diego' ),
            'section'     => 'preloader_section',
            'default'     => '#0F183E',
        ]
    );

    new \Kirki\Field\Text(
        [
            'settings' => 'diego_preloader_loading_text',
            'label'    => esc_html__( 'Preloader Loading Text', 'diego' ),
            'section'  => 'preloader_section',
            'default'  => esc_html__( 'Loading', 'diego' ),
            'priority' => 10,
        ]
    );  
}

preloader_section();



// offcanvas_side_section
function offcanvas_side_section(){
    // header_top_bar section 
    new \Kirki\Section(
        'offcanvas_side_section',
        [
            'title'       => esc_html__( 'Offcanvas Info', 'diego' ),
            'description' => esc_html__( 'Offcanvas Information.', 'diego' ),
            'panel'       => 'panel_id',
            'priority'    => 105,
        ]
    );

    new \Kirki\Field\Radio_Image(
        [
            'settings'    => 'choose_default_offcanvas',
            'label'       => esc_html__( 'Chose Offcanvas Style', 'diego' ),
            'section'     => 'offcanvas_side_section',
            'priority'    => 10,
            'choices'     => [
                'offcanvas_1'   => get_template_directory_uri() . '/inc/img/offcanvas/offcanvas-1.png',
            ],
            'default'     => 'offcanvas_1',
        ]
    );


    new \Kirki\Field\Image(
        [
            'settings'    => 'diego_offcanvas_logo_white',
            'label'       => esc_html__( 'Offcanvas Logo White', 'diego' ),
            'description' => esc_html__( 'Offcanvas Logo Here', 'diego' ),
            'section'     => 'offcanvas_side_section',
            'default'     => get_template_directory_uri() . '/assets/img/logo/logo.png',
        ]
    );   

    new \Kirki\Field\Image(
        [
            'settings'    => 'diego_offcanvas_logo_black',
            'label'       => esc_html__( 'Offcanvas Logo Black', 'diego' ),
            'description' => esc_html__( 'Offcanvas Logo Here', 'diego' ),
            'section'     => 'offcanvas_side_section',
            'default'     => get_template_directory_uri() . '/assets/img/logo/logo-black.png',
        ]
    );   
    new \Kirki\Field\Text(
        [
            'settings' => 'diego_offcanvas_logo_width',
            'label'    => esc_html__( 'Logo Width', 'diego' ),
            'section'  => 'offcanvas_side_section',
            'default'  => esc_html__( '120', 'diego' ),
            'priority' => 10,
        ]
    );

    new \Kirki\Field\Checkbox_Switch(
        [
            'settings'    => 'diego_offcanvas_content',
            'label'       => esc_html__( 'Offcanvas Content', 'diego' ),
            'description' => esc_html__( 'Offcanvas Content On/Off', 'diego' ),
            'section'     => 'offcanvas_side_section',
            'default'     => 'off',
            'choices'     => [
                'on'  => esc_html__( 'Enable', 'diego' ),
                'off' => esc_html__( 'Disable', 'diego' ),
            ],
        ]
    ); 


    new \Kirki\Field\Text(
        [
            'settings' => 'diego_offcanvas_btn_text',
            'label'    => esc_html__( 'Phone Text', 'diego' ),
            'section'  => 'offcanvas_side_section',
            'default'  => esc_html__( '+61404093 954', 'diego' ),
            'priority' => 10,
        ]
    );
    new \Kirki\Field\Text(
        [
            'settings' => 'diego_offcanvas_btn_url',
            'label'    => esc_html__( 'Phone URL', 'diego' ),
            'section'  => 'offcanvas_side_section',
            'default'  => esc_html__( 'tel:61404093 54', 'diego' ),
            'priority' => 10,
        ]
    );

    new \Kirki\Field\Text(
        [
            'settings' => 'diego_offcanvas_mail_text',
            'label'    => esc_html__( 'Mail Text', 'diego' ),
            'section'  => 'offcanvas_side_section',
            'default'  => esc_html__( 'hello contact@diego.com', 'diego' ),
            'priority' => 10,
        ]
    );

    new \Kirki\Field\Text(
        [
            'settings' => 'diego_offcanvas_mail_url',
            'label'    => esc_html__( 'Mail URL', 'diego' ),
            'section'  => 'offcanvas_side_section',
            'default'  => esc_html__( 'contact@diego.com', 'diego' ),
            'priority' => 10,
        ]
    );

    new \Kirki\Field\Text(
        [
            'settings' => 'diego_offcanvas_short_desc',
            'label'    => esc_html__( 'Short Desc', 'diego' ),
            'section'  => 'offcanvas_side_section',
            'default'  => esc_html__( 'If in doubt. reach out.', 'diego' ),
            'priority' => 10,
        ]
    );


    new \Kirki\Field\Text(
        [
            'settings' => 'diego_offcanvas_dribble_url',
            'label'    => esc_html__( 'Dribble URL', 'diego' ),
            'section'  => 'offcanvas_side_section',
            'default'  => esc_html__( '#', 'diego' ),
            'priority' => 10,
        ]
    );

    new \Kirki\Field\Text(
        [
            'settings' => 'diego_offcanvas_instagram_url',
            'label'    => esc_html__( 'Instagram URL', 'diego' ),
            'section'  => 'offcanvas_side_section',
            'default'  => esc_html__( '#', 'diego' ),
            'priority' => 10,
        ]
    );


    new \Kirki\Field\Text(
        [
            'settings' => 'diego_offcanvas_behance_url',
            'label'    => esc_html__( 'Behance URL', 'diego' ),
            'section'  => 'offcanvas_side_section',
            'default'  => esc_html__( '#', 'diego' ),
            'priority' => 10,
        ]
    );

    new \Kirki\Field\Text(
        [
            'settings' => 'diego_offcanvas_youtube_url',
            'label'    => esc_html__( 'Youtube URL', 'diego' ),
            'section'  => 'offcanvas_side_section',
            'default'  => esc_html__( '#', 'diego' ),
            'priority' => 10,
        ]
    );


}
offcanvas_side_section();


// header_logo_section
function header_breadcrumb_section(){
    // header_logo_section section 
    new \Kirki\Section(
        'header_breadcrumb_section',
        [
            'title'       => esc_html__( 'Breadcrumb', 'diego' ),
            'description' => esc_html__( 'Breadcrumb Settings.', 'diego' ),
            'panel'       => 'panel_id',
            'priority'    => 106,
        ]
    );

    // header_logo_section section 
    new \Kirki\Field\Image(
        [
            'settings'    => 'breadcrumb_image',
            'label'       => esc_html__( 'Breadcrumb Image', 'diego' ),
            'description' => esc_html__( 'Breadcrumb Image add/remove', 'diego' ),
            'section'     => 'header_breadcrumb_section',
        ]
    );

    new \Kirki\Field\Color(
        [
            'settings'    => 'breadcrumb_bg_color',
            'label'       => __( 'Breadcrumb BG Color', 'diego' ),
            'description' => esc_html__( 'You can change breadcrumb bg color from here.', 'diego' ),
            'section'     => 'header_breadcrumb_section',
            'default'     => '#0F183E',
        ]
    );

    new \Kirki\Field\Dimensions(
        [
            'settings'    => 'breadcrumb_padding',
            'label'       => esc_html__( 'Padding Control', 'diego' ),
            'description' => esc_html__( 'Padding', 'diego' ),
            'section'     => 'header_breadcrumb_section',
            'default'     => [
                'padding-top'  => '',
                'padding-bottom' => '',
            ],
        ]
    );
    new \Kirki\Field\Typography(
        [
            'settings'    => 'breadcrumb_typography',
            'label'       => esc_html__( 'Typography Control', 'diego' ),
            'description' => esc_html__( 'The full set of options.', 'diego' ),
            'section'     => 'header_breadcrumb_section',
            'priority'    => 10,
            'transport'   => 'auto',
            'default'     => [
                'font-family'     => '',
                'variant'         => '',
                'color'           => '',
                'font-size'       => '',
                'line-height'     => '',
                'text-align'      => '',
            ],
            'output'      => [
                [
                    'element' => '.tpbreadcrumb-title',
                ],
            ],
        ]
    );


}
header_breadcrumb_section();

function full_site_typography(){
    // header_logo_section section 
    new \Kirki\Section(
        'full_site_typography',
        [
            'title'       => esc_html__( 'Typography', 'diego' ),
            'description' => esc_html__( 'Typography Settings.', 'diego' ),
            'panel'       => 'panel_id',
            'priority'    => 107,
        ]
    );

    new \Kirki\Field\Typography(
        [
            'settings'    => 'full_site_typography_settings',
            'label'       => esc_html__( 'Typography Control', 'diego' ),
            'description' => esc_html__( 'The full set of options.', 'diego' ),
            'section'     => 'full_site_typography',
            'priority'    => 10,
            'transport'   => 'auto',
            'default'     => [
                'font-family'     => '',
                'variant'         => '',
                'color'           => '',
                'font-size'       => '',
                'line-height'     => '',
                'text-align'      => '',
            ],
            'output'      => [
                [
                    'element' => '.tpbreadcrumb-title',
                ],
            ],
        ]
    );
}
full_site_typography();


// footer layout
function footer_layout_section(){

    new \Kirki\Section(
        'footer_layout_section',
        [
            'title'       => esc_html__( 'Footer', 'diego' ),
            'description' => esc_html__( 'Footer Settings.', 'diego' ),
            'panel'       => 'panel_id',
            'priority'    => 110,
        ]
    );
    // footer_widget_number section 
    new \Kirki\Field\Select(
        [
            'settings'    => 'footer_widget_number',
            'label'       => esc_html__( 'Footer Widget Number', 'diego' ),
            'section'     => 'footer_layout_section',
            'default'     => '4',
            'placeholder' => esc_html__( 'Choose an option', 'diego' ),
            'choices'     => [
                '1' => esc_html__( '1', 'diego' ),
                '2' => esc_html__( '2', 'diego' ),
                '3' => esc_html__( '3', 'diego' ),
                '4' => esc_html__( '4', 'diego' ),
            ],
        ]
    );


    new \Kirki\Field\Checkbox_Switch(
        [
            'settings'    => 'diego_footer_elementor_switch',
            'label'       => esc_html__( 'Footer Custom/Elementor Switch', 'diego' ),
            'description' => esc_html__( 'Footer Custom/Elementor On/Off', 'diego' ),
            'section'     => 'footer_layout_section',
            'default'     => 'off',
            'choices'     => [
                'on'  => esc_html__( 'Enable', 'diego' ),
                'off' => esc_html__( 'Disable', 'diego' ),
            ],
        ]
    ); 

    new \Kirki\Field\Radio_Image(
        [
            'settings'    => 'footer_layout_custom',
            'label'       => esc_html__( 'Footer Layout Control', 'diego' ),
            'section'     => 'footer_layout_section',
            'priority'    => 10,
            'choices'     => [
                'footer_1'   => get_template_directory_uri() . '/inc/img/footer/footer-1.png',
            ],
            'default'     => 'footer_1',
            'active_callback' => [
                [
                    'setting' => 'diego_footer_elementor_switch',
                    'operator' => '==',
                    'value' => false
                ]
            ]
        ]
    );

    $footer_buildertype = array(
        'post_type'      => 'tp-footer',
        'posts_per_page' => -1,
    );
    $footer_buildertype_loop = get_posts($footer_buildertype);
    $footer_post_obj_arr = array();
    foreach($footer_buildertype_loop as $post){
        $footer_post_obj_arr[$post->ID] = $post->post_title;
    }

    wp_reset_postdata();

    new \Kirki\Field\Select(
        [
            'settings'    => 'diego_footer_templates',
            'label'       => esc_html__( 'Elementor Footer Template', 'diego' ),
            'section'     => 'footer_layout_section',
            'placeholder' => esc_html__( 'Choose an option', 'diego' ),
            'choices'     => $footer_post_obj_arr,
            'active_callback' => [
                [
                    'setting' => 'diego_footer_elementor_switch',
                    'operator' => '==',
                    'value' => true
                ]
            ]
        ]
    );

    new \Kirki\Field\Color(
        [
            'settings'    => 'diego_footer_bg_color',
            'label'       => __( 'Footer BG Color', 'diego' ),
            'description' => esc_html__( 'You can change footer bg color from here.', 'diego' ),
            'section'     => 'footer_layout_section',
            'default'     => '#162251',
        ]
    );

    new \Kirki\Field\Image(
        [
            'settings'    => 'diego_footer_bg',
            'label'       => esc_html__( 'Footer BG Image', 'diego' ),
            'description' => esc_html__( 'Footer BG Image', 'diego' ),
            'section'     => 'footer_layout_section',
            'default'     => '',
        ]
    );   

    new \Kirki\Field\Checkbox_Switch(
        [
            'settings'    => 'diego_footer_shape',
            'label'       => esc_html__( 'Shape On/Off', 'diego' ),
            'section'     => 'footer_layout_section',
            'default'     => false,
            'priority' => 10,
        ]
    ); 
    

    new \Kirki\Field\Text(
        [
            'settings' => 'diego_copyright',
            'label'    => esc_html__( 'Footer Copyright', 'diego' ),
            'section'  => 'footer_layout_section',
            'default'  => esc_html__( '© 2025 All Rights Reserved | WordPress Theme by Themepure', 'diego' ),
            'priority' => 10,
        ]
    );  
}
footer_layout_section();


// blog_section
function blog_section(){
    // blog_section section 
    new \Kirki\Section(
        'blog_section',
        [
            'title'       => esc_html__( 'Blog Section', 'diego' ),
            'description' => esc_html__( 'Blog Section Settings.', 'diego' ),
            'panel'       => 'panel_id',
            'priority'    => 109,
        ]
    );

    new \Kirki\Field\Checkbox_Switch(
        [
            'settings'    => 'blog_details_layout',
            'label'       => esc_html__( 'Blog Details Layout 2', 'diego' ),
            'section'     => 'blog_section',
            'default'     => false,
            'priority' => 10,
        ]
    ); 

    new \Kirki\Field\Checkbox_Switch(
        [
            'settings'    => 'blog_details_thumbnail_layout',
            'label'       => esc_html__( 'Blog Details Thumbnail Layout', 'diego' ),
            'section'     => 'blog_section',
            'description' => esc_html__( 'Details page thumbnail full width ON/OFF switch', 'diego' ),
            'default'     => true,
            'priority'    => 10,
        ]
    ); 

    new \Kirki\Field\Text(
        [
            'settings' => 'breadcrumb_blog_subtitle',
            'label'    => esc_html__( 'Blog Breadcrumb Subtitle', 'diego' ),
            'section'  => 'blog_section',
            'default'  => "Recent Articles",
            'priority' => 10,
        ]
    );

    new \Kirki\Field\Text(
        [
            'settings' => 'breadcrumb_blog_title',
            'label'    => esc_html__( 'Blog Breadcrumb Title', 'diego' ),
            'section'  => 'blog_section',
            'default'  => "From Our Blogs",
            'priority' => 10,
        ]
    );

    new \Kirki\Field\Checkbox_Switch(
        [
            'settings'    => 'diego_blog_btn_switch',
            'label'       => esc_html__( 'Blog BTN On/Off', 'diego' ),
            'section'     => 'blog_section',
            'default'     => true,
            'priority' => 10,
        ]
    ); 


    // blog_section BTN 
    new \Kirki\Field\Checkbox_Switch(
        [
            'settings' => 'diego_blog_cat',
            'label'    => esc_html__( 'Blog Category Meta On/Off', 'diego' ),
            'section'  => 'blog_section',
            'default'  => false,
            'priority' => 10,
        ]
    );

    // blog_section Author Meta 
    new \Kirki\Field\Checkbox_Switch(
        [
            'settings' => 'diego_blog_author',
            'label'    => esc_html__( 'Blog Author Meta On/Off', 'diego' ),
            'section'  => 'blog_section',
            'default'  => true,
            'priority' => 10,
        ]
    );
    // blog_section Date Meta 
    new \Kirki\Field\Checkbox_Switch(
        [
            'settings' => 'diego_blog_date',
            'label'    => esc_html__( 'Blog Date Meta On/Off', 'diego' ),
            'section'  => 'blog_section',
            'default'  => true,
            'priority' => 10,
        ]
    );

    // blog_section Comments Meta 
    new \Kirki\Field\Checkbox_Switch(
        [
            'settings' => 'diego_blog_comments',
            'label'    => esc_html__( 'Blog Comments Meta On/Off', 'diego' ),
            'section'  => 'blog_section',
            'default'  => true,
            'priority' => 10,
        ]
    );


    // blog_section Blog BTN text 
    new \Kirki\Field\Text(
        [
            'settings' => 'diego_blog_btn',
            'label'    => esc_html__( 'Blog Button Text', 'diego' ),
            'section'  => 'blog_section',
            'default'  => "Read More",
            'priority' => 10,
        ]
    );

    new \Kirki\Field\Checkbox_Switch(
        [
            'settings' => 'diego_blog_single_social',
            'label'    => esc_html__( 'Single Blog Social Share', 'diego' ),
            'section'  => 'blog_section',
            'default'  => false,
            'priority' => 10,
        ]
    );

}
blog_section();


// 404 section
function error_404_section(){
    // 404_section section 
    new \Kirki\Section(
        'error_404_section',
        [
            'title'       => esc_html__( '404 Page', 'diego' ),
            'description' => esc_html__( '404 Page Settings.', 'diego' ),
            'panel'       => 'panel_id',
            'priority'    => 109,
        ]
    );

    // 404_section 
    new \Kirki\Field\Text(
        [
            'settings' => 'diego_error_title',
            'label'    => esc_html__( 'Not Found Title', 'diego' ),
            'section'  => 'error_404_section',
            'default'  => "Oops! Page not found",
            'priority' => 10,
        ]
    );

    // 404_section description
    new \Kirki\Field\Textarea(
        [
            'settings' => 'diego_error_desc',
            'label'    => esc_html__( 'Not Found description', 'diego' ),
            'section'  => 'error_404_section',
            'default'  => "Whoops, this is embarassing. Looks like the page you were looking for was not found.",
            'priority' => 10,
        ]
    );

    // 404_section description
    new \Kirki\Field\Text(
        [
            'settings' => 'diego_error_link_text',
            'label'    => esc_html__( 'Error Link Text', 'diego' ),
            'section'  => 'error_404_section',
            'default'  => "Back To Home",
            'priority' => 10,
        ]
    );
}
error_404_section();

// 404 section
function diego_slug_setting(){
    new \Kirki\Section(
        'diego_slug_section',
        [
            'title'       => esc_html__( 'Slug Settings', 'diego' ),
            'description' => esc_html__( 'Slug Settings.', 'diego' ),
            'panel'       => 'panel_id',
            'priority'    => 109,
        ]
    );

    new \Kirki\Field\Text(
        [
            'settings' => 'diego_serv_slug',
            'label'    => esc_html__( 'Services Slug', 'diego' ),
            'section'  => 'diego_slug_section',
            'default'  => "services",
            'priority' => 10,
        ]
    );

    new \Kirki\Field\Text(
        [
            'settings' => 'diego_port_slug',
            'label'    => esc_html__( 'Portfolio Slug', 'diego' ),
            'section'  => 'diego_slug_section',
            'default'  => "portfolio",
            'priority' => 10,
        ]
    );
}
diego_slug_setting();