<?php

/**
 * diego_scripts description
 * @return [type] [description]
 */
function diego_scripts() {

    /**
     * all css files
    */

    wp_enqueue_style( 'diego-fonts', diego_fonts_url(), array(), time() );
    if( is_rtl() ){
        wp_enqueue_style( 'bootstrap-rtl', DIEGO_THEME_CSS_DIR.'bootstrap-rtl.css', array() );
    }else{
        wp_enqueue_style( 'bootstrap', DIEGO_THEME_CSS_DIR.'bootstrap.css', array() );
    }
    wp_enqueue_style( 'spacing', DIEGO_THEME_CSS_DIR . 'spacing.css', [] );
    wp_enqueue_style( 'animate', DIEGO_THEME_CSS_DIR . 'animate.css', [] );
    wp_enqueue_style( 'diego-custom-animation', DIEGO_THEME_CSS_DIR . 'custom-animation.css', [] );
    wp_enqueue_style( 'slick', DIEGO_THEME_CSS_DIR . 'slick.css', [] );
    wp_enqueue_style( 'swiper-bundle', DIEGO_THEME_CSS_DIR . 'swiper-bundle.css', [] );
    wp_enqueue_style( 'pagepiling', DIEGO_THEME_CSS_DIR . 'pagepiling.css', [] );
    wp_enqueue_style( 'fullpage', DIEGO_THEME_CSS_DIR . 'fullpage.css', [] );
    wp_enqueue_style( 'nice-select', DIEGO_THEME_CSS_DIR . 'nice-select.css', [] );
    wp_enqueue_style( 'hover-reveal', DIEGO_THEME_CSS_DIR . 'hover-reveal.css', [] );
    wp_enqueue_style( 'font-awesome-pro', DIEGO_THEME_CSS_DIR . 'font-awesome-pro.css', [] );
    wp_enqueue_style( 'magnific-popup', DIEGO_THEME_CSS_DIR . 'magnific-popup.css', [] );

    wp_enqueue_style( 'diego', DIEGO_THEME_CSS_DIR . 'diego-core.css', [], time() );
    wp_enqueue_style( 'diego-unit', DIEGO_THEME_CSS_DIR . 'diego-unit.css', [], time() );
    wp_enqueue_style( 'diego-custom', DIEGO_THEME_CSS_DIR . 'diego-custom.css', [] );
    wp_enqueue_style( 'diego-style', get_stylesheet_uri() );

    // all js
    wp_enqueue_script( 'bootstrap-bundle', DIEGO_THEME_JS_DIR . 'bootstrap-bundle.js', [ 'jquery' ], '', true );
    wp_enqueue_script( 'swiper-bundle', DIEGO_THEME_JS_DIR . 'swiper-bundle.js', [ 'jquery' ], false, true );
    wp_enqueue_script( 'slick', DIEGO_THEME_JS_DIR . 'slick.js', [ 'jquery' ], false, true );
    wp_enqueue_script( 'magnific-popup', DIEGO_THEME_JS_DIR . 'magnific-popup.js', [ 'jquery' ], '', true );
    wp_enqueue_script( 'nice-select', DIEGO_THEME_JS_DIR . 'nice-select.js', [ 'jquery' ], '', true );
    wp_enqueue_script( 'purecounter', DIEGO_THEME_JS_DIR . 'purecounter.js', [ 'jquery' ], false, true );
    wp_enqueue_script( 'isotope-pkgd', DIEGO_THEME_JS_DIR . 'isotope-pkgd.js', [ 'imagesloaded' ], false, true );
    wp_enqueue_script( 'charming', DIEGO_THEME_JS_DIR . 'charming.js', [ 'jquery' ], false, true );
    wp_enqueue_script( 'gsap-js', DIEGO_THEME_JS_DIR . 'gsap.js', array(), false, true );
    wp_enqueue_script( 'gsap-scroll-smoother-js', DIEGO_THEME_JS_DIR . 'gsap-scroll-smoother.js', [ 'gsap-js' ], '', true );
    wp_enqueue_script( 'gsap-scroll-to-plugin-js', DIEGO_THEME_JS_DIR . 'gsap-scroll-to-plugin.js', [ 'gsap-js' ], '', true );
    wp_enqueue_script( 'gsap-scroll-trigger-js', DIEGO_THEME_JS_DIR . 'gsap-scroll-trigger.js', [ 'gsap-js' ], '', true );
    wp_enqueue_script( 'gsap-split-text-js', DIEGO_THEME_JS_DIR . 'gsap-split-text.js', [ 'gsap-js' ], '', true );
    wp_enqueue_script( 'tp-webgl-js', DIEGO_THEME_JS_DIR . 'webgl.js', [ 'jquery' ], '', true );
    wp_enqueue_script( 'three-js', DIEGO_THEME_JS_DIR . 'three.js', [ 'gsap-js' ], '', true );
    wp_enqueue_script( 'hammer-js', DIEGO_THEME_JS_DIR . 'hammer.js', [ 'jquery' ], '', true );
    wp_enqueue_script( 'matter-js', DIEGO_THEME_JS_DIR . 'matter.js', [ 'jquery' ], '', true );
    wp_enqueue_script( 'throwable-js', DIEGO_THEME_JS_DIR . 'throwable.js', [ 'jquery' ], '', true );
    wp_enqueue_script( 'tween-max-js', DIEGO_THEME_JS_DIR . 'tween-max.js', [ 'jquery' ], '', true );
    wp_enqueue_script( 'headroom-js', DIEGO_THEME_JS_DIR . 'headroom.min.js', [ 'jquery' ], '', true );
    wp_enqueue_script( 'hover-reveal-js', DIEGO_THEME_JS_DIR . 'hover-reveal.js', [ 'jquery' ], '', true );
    wp_enqueue_script( 'animated-headline', DIEGO_THEME_JS_DIR . 'animated-headline.js', [ 'jquery' ], false, true );
    wp_enqueue_script( 'pagepiling-js', DIEGO_THEME_JS_DIR . 'pagepiling.js', [ 'jquery' ], '', true );
    wp_enqueue_script( 'scroll-magic-js', DIEGO_THEME_JS_DIR . 'scroll-magic.js', [ 'jquery' ], '', true );
    wp_enqueue_script( 'wow', DIEGO_THEME_JS_DIR . 'wow.js', [ 'jquery' ], false, true );
    wp_enqueue_script( 'diego-dark-light', DIEGO_THEME_JS_DIR . 'theme-settings.js', [ 'jquery' ], false, true );
    wp_enqueue_script( 'tp-cursor', DIEGO_THEME_JS_DIR . 'tp-cursor.js', [ 'gsap-js' ], '', true );
    wp_enqueue_script( 'diego-main', DIEGO_THEME_JS_DIR . 'main.js', ['gsap-js' ], time(), true );

    wp_localize_script( 'diego-main', 'diego_admin_ajax', array(
        'ajax_url'	   => admin_url( 'admin-ajax.php' ),
    ));


    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }
}
add_action( 'wp_enqueue_scripts', 'diego_scripts' );

/*
Register Fonts
 */
function diego_fonts_url() {
    $font_url = '';

    /*
    Translators: If there are characters in your language that are not supported
    by chosen font(s), translate this to 'off'. Do not translate into your own language.
     */
    if ( 'off' !== _x( 'on', 'Google font: on or off', 'diego' ) ) {
        $font_url = 'https://fonts.googleapis.com/css2?'. urlencode('family=Abril+Fatface&family=DM+Sans:wght@400;500;700&family=EB+Garamond:wght@400;500;600;700;800&family=Kufam:wght@400;500;600;700&family=Poppins:wght@300;400;500;600;700;800;900&family=Playfair+Display:wght@400;500;600;700;900&display=swap');
    }
    return $font_url;
}