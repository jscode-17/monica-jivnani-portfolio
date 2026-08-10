<?php 

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function diego_widgets_init() {

    /**
     * blog sidebar
     */
    register_sidebar( [
        'name'          => esc_html__( 'Blog Sidebar', 'diego' ),
        'id'            => 'blog-sidebar',
        'description'   => esc_html__( 'Set Your Blog Widget', 'diego' ),
        'before_widget' => '<div id="%1$s" class="sidebar__widget tp-sidebar-widget mb-60 %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="sidebar__widget-title">',
        'after_title'   => '</h3>',
    ] );

    $footer_widgets = get_theme_mod( 'footer_widget_number', 4 );

    // footer default
    for ( $num = 1; $num <= $footer_widgets; $num++ ) {
        register_sidebar( [
            'name'          => sprintf( esc_html__( 'Footer %1$s', 'diego' ), $num ),
            'id'            => 'footer-' . $num,
            'description'   => sprintf( esc_html__( 'Footer column %1$s', 'diego' ), $num ),
            'before_widget' => '<div id="%1$s" class="tp-footer-4__widget tp-footer-widget mb-40 footer-col-4-'.$num.' %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h4 class="tp-footer-4__widget-title">',
            'after_title'   => '</h4>',
        ] );
    }  

}
add_action( 'widgets_init', 'diego_widgets_init' );