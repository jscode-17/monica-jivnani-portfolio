<?php
/**
 * 
 * Demo Imports
 */

function tp_ocdi_import_files() {
    
    return array(
      array(
        'import_file_name'           => 'Home Freelancer',
        'local_import_file'             => trailingslashit( get_template_directory() ) .'sample-data/contents-demo.xml',
        'local_import_widget_file' => trailingslashit( get_template_directory() ) . 'sample-data/widget-settings.json',
        'local_import_customizer_file' => trailingslashit( get_template_directory() ) . 'sample-data/customizer-data.dat',
        'import_preview_image_url' => plugins_url( 'assets/img/demo/home-1.jpg', dirname(__FILE__) ),
        'preview_url'                => 'https://wp.aqlova.com/diego/',
      ),
      array(
        'import_file_name'           => 'Fashion Designer',
        'local_import_file'             => trailingslashit( get_template_directory() ) .'sample-data/contents-demo.xml',
        'local_import_widget_file' => trailingslashit( get_template_directory() ) . 'sample-data/widget-settings.json',
        'local_import_customizer_file' => trailingslashit( get_template_directory() ) . 'sample-data/customizer-data.dat',
        'import_preview_image_url' => plugins_url( 'assets/img/demo/home-5.jpg', dirname(__FILE__) ),
        'preview_url'                => 'https://wp.aqlova.com/diego/home-fashion-designer/',
      ),
      array(
        'import_file_name'           => 'Photographer',
        'local_import_file'             => trailingslashit( get_template_directory() ) .'sample-data/contents-demo.xml',
        'local_import_widget_file' => trailingslashit( get_template_directory() ) . 'sample-data/widget-settings.json',
        'local_import_customizer_file' => trailingslashit( get_template_directory() ) . 'sample-data/customizer-data.dat',
        'import_preview_image_url' => plugins_url( 'assets/img/demo/home-4.jpg', dirname(__FILE__) ),
        'preview_url'                => 'https://wp.aqlova.com/diego/home-photographer/',
      ),
      array(
        'import_file_name'           => 'Interface Designer',
        'local_import_file'             => trailingslashit( get_template_directory() ) .'sample-data/contents-demo.xml',
        'local_import_widget_file' => trailingslashit( get_template_directory() ) . 'sample-data/widget-settings.json',
        'local_import_customizer_file' => trailingslashit( get_template_directory() ) . 'sample-data/customizer-data.dat',
        'import_preview_image_url' => plugins_url( 'assets/img/demo/home-2.jpg', dirname(__FILE__) ),
        'preview_url'                => 'https://wp.aqlova.com/diego/home-interface-designer/',
      ),
      array(
        'import_file_name'           => 'Web Developer',
        'local_import_file'             => trailingslashit( get_template_directory() ) .'sample-data/contents-demo.xml',
        'local_import_widget_file' => trailingslashit( get_template_directory() ) . 'sample-data/widget-settings.json',
        'local_import_customizer_file' => trailingslashit( get_template_directory() ) . 'sample-data/customizer-data.dat',
        'import_preview_image_url' => plugins_url( 'assets/img/demo/home-3.jpg', dirname(__FILE__) ),
        'preview_url'                => 'https://wp.aqlova.com/diego/home-web-developer/',
      ),
      array(
        'import_file_name'           => 'Slider Classic',
        'local_import_file'             => trailingslashit( get_template_directory() ) .'sample-data/contents-demo.xml',
        'local_import_widget_file' => trailingslashit( get_template_directory() ) . 'sample-data/widget-settings.json',
        'local_import_customizer_file' => trailingslashit( get_template_directory() ) . 'sample-data/customizer-data.dat',
        'import_preview_image_url' => plugins_url( 'assets/img/demo/home-6.jpg', dirname(__FILE__) ),
        'preview_url'                => 'https://wp.aqlova.com/diego/home-slider-classic/',
      ),
      array(
        'import_file_name'           => 'Slider Metro',
        'local_import_file'             => trailingslashit( get_template_directory() ) .'sample-data/contents-demo.xml',
        'local_import_widget_file' => trailingslashit( get_template_directory() ) . 'sample-data/widget-settings.json',
        'local_import_customizer_file' => trailingslashit( get_template_directory() ) . 'sample-data/customizer-data.dat',
        'import_preview_image_url' => plugins_url( 'assets/img/demo/home-7.jpg', dirname(__FILE__) ),
        'preview_url'                => 'https://wp.aqlova.com/diego/home-slider-metro/',
      ),
      array(
        'import_file_name'           => 'Slider Elegant',
        'local_import_file'             => trailingslashit( get_template_directory() ) .'sample-data/contents-demo.xml',
        'local_import_widget_file' => trailingslashit( get_template_directory() ) . 'sample-data/widget-settings.json',
        'local_import_customizer_file' => trailingslashit( get_template_directory() ) . 'sample-data/customizer-data.dat',
        'import_preview_image_url' => plugins_url( 'assets/img/demo/home-8.jpg', dirname(__FILE__) ),
        'preview_url'                => 'https://wp.aqlova.com/diego/home-slider-elegant/',
      ),
    );
}
add_filter( 'ocdi/import_files', 'tp_ocdi_import_files' );


function tp_ocdi_page($tp_page_name = 'Home'){
    $posts = get_posts(
        array(
            'post_type'              => 'page',
            'title'                  => $tp_page_name,
            'post_status'            => 'all',
            'posts_per_page'         => 1,
            'no_found_rows'          => true,
            'ignore_sticky_posts'    => true,
            'update_post_term_cache' => false,
            'update_post_meta_cache' => false,
            'orderby'                => 'post_date ID',
            'order'                  => 'ASC',
        )
    );

    if ( ! empty( $posts ) ) {
        $page_got_by_title = $posts[0];
    } else {
        $page_got_by_title = null;
    }

    return $page_got_by_title;

}


// after demo imports
function tp_ocdi_after_import_setup( $demo ) {
    $front_page_id = "";
    $blog_page_id = "";
    if( "Home Freelancer" == $demo['import_file_name'] ){
        // Assign front page and posts page (blog page).
        $front_page_id = tp_ocdi_page( 'Home' );
        $blog_page_id  = tp_ocdi_page( 'Blog' );
    }
    else if( "Fashion Designer" == $demo['import_file_name'] ){
        // Assign front page and posts page (blog page).
        $front_page_id = tp_ocdi_page( 'Fashion Designer' );
        $blog_page_id  = tp_ocdi_page( 'Blog' );
    }
    else if( "Photographer" == $demo['import_file_name'] ){
        // Assign front page and posts page (blog page).
        $front_page_id = tp_ocdi_page( 'Photographer' );
        $blog_page_id  = tp_ocdi_page( 'Blog' );
    }
    else if( "Interface Designer" == $demo['import_file_name'] ){
        // Assign front page and posts page (blog page).
        $front_page_id = tp_ocdi_page( 'Interface Designer' );
        $blog_page_id  = tp_ocdi_page( 'Blog' );
    }
    else if( "Web Developer" == $demo['import_file_name'] ){
        // Assign front page and posts page (blog page).
        $front_page_id = tp_ocdi_page( 'Web Developer' );
        $blog_page_id  = tp_ocdi_page( 'Blog' );
    }
    else if( "Home Slider Classic" == $demo['import_file_name'] ){
        // Assign front page and posts page (blog page).
        $front_page_id = tp_ocdi_page( 'Home Slider Classic' );
        $blog_page_id  = tp_ocdi_page( 'Blog' );
    }
    else if( "Home Slider Elegant" == $demo['import_file_name'] ){
        // Assign front page and posts page (blog page).
        $front_page_id = tp_ocdi_page( 'Home Slider Elegant' );
        $blog_page_id  = tp_ocdi_page( 'Blog' );
    }
    else if( "Home Slider Metro" == $demo['import_file_name'] ){
        // Assign front page and posts page (blog page).
        $front_page_id = tp_ocdi_page( 'Home Slider Metro' );
        $blog_page_id  = tp_ocdi_page( 'Blog' );
    }

    update_option( 'show_on_front', 'page' );
    update_option( 'page_on_front', $front_page_id->ID );
    update_option( 'page_for_posts', $blog_page_id->ID );


    // Assign menus to their locations.
    $main_menu = get_term_by( 'name', 'Main Menu', 'nav_menu' );
 
    set_theme_mod( 'nav_menu_locations', [
            'main-menu' => $main_menu->term_id, // replace 'main-menu' here with the menu location identifier from register_nav_menu() function in your theme.
        ]
    );

    // woocommerce default settings reset
    if ( class_exists( 'woocommerce' ) ) {
        update_option( 'woocommerce_shop_page_id', '10' );
        update_option( 'woocommerce_cart_page_id', '11' );
        update_option( 'woocommerce_checkout_page_id', '12' );
        update_option( 'woocommerce_myaccount_page_id', '13' );
    }
 
}
add_action( 'ocdi/after_import', 'tp_ocdi_after_import_setup' );



function tp_ocdi_plugin_page_setup( $default_settings ) {
    $default_settings['parent_slug'] = 'themes.php';
    $default_settings['page_title']  = esc_html__( 'One Click Demo Import' , 'one-click-demo-import' );
    $default_settings['menu_title']  = esc_html__( 'Import Theme Demos' , 'one-click-demo-import' );
    $default_settings['capability']  = 'import';
    $default_settings['menu_slug']   = 'one-click-demo-import';
 
    return $default_settings;
}
add_filter( 'ocdi/plugin_page_setup', 'tp_ocdi_plugin_page_setup' );