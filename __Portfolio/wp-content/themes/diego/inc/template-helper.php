<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package diego
 */

/** 
 *
 * diego header
 */
function get_header_style($style){
    if ( $style == 'header_2'  ) {
        get_template_part( 'template-parts/header/header-2' );
    }
    else{
        get_template_part( 'template-parts/header/header-1');
    }
}


function diego_check_header() {
    global $post;

    if(is_404()){
        $_id = get_the_ID();
    }else{
        
        $_id = (is_home()) ? get_option( 'page_for_posts') : $post->ID;
    }


    $tp_header_tabs = function_exists('tpmeta_field')? tpmeta_field('diego_header_tabs', $_id) : false;
    $tp_header_style_meta = function_exists('tpmeta_field')? tpmeta_field('diego_header_style') : '';
    $elementor_header_template_meta = function_exists('tpmeta_field')? tpmeta_field('diego_header_templates', $_id) : false;
   
    $diego_header_option_switch = get_theme_mod('diego_header_elementor_switch', false);
    $header_default_style_kirki = get_theme_mod( 'header_layout_custom', 'header_1' );
    $elementor_header_templates_kirki = get_theme_mod( 'diego_header_templates' );
    
    if($tp_header_tabs == 'default'){
        if($diego_header_option_switch){
            if($elementor_header_templates_kirki){
                echo \Elementor\Plugin::$instance->frontend->get_builder_content($elementor_header_templates_kirki);
            }
        }else{ 
            if($header_default_style_kirki){
                get_header_style($header_default_style_kirki);
            }else{
                get_template_part( 'template-parts/header/header-1' );
            }
        }
    }elseif($tp_header_tabs == 'custom'){
        if ($tp_header_style_meta) {
            get_header_style($tp_header_style_meta);
        }else{
            get_header_style($header_default_style_kirki);
        }  
    }elseif($tp_header_tabs == 'elementor'){
        if($elementor_header_template_meta){
            echo \Elementor\Plugin::$instance->frontend->get_builder_content($elementor_header_template_meta);
        }else{
            echo \Elementor\Plugin::$instance->frontend->get_builder_content($elementor_header_templates_kirki);
        }
    }else{
        if($diego_header_option_switch){

            if($elementor_header_templates_kirki){
                echo \Elementor\Plugin::$instance->frontend->get_builder_content($elementor_header_templates_kirki);
            }else{
                get_template_part( 'template-parts/header/header-1' );
            }
        }else{
            get_header_style($header_default_style_kirki);

        }
        
    }

}
add_action( 'diego_header_style', 'diego_check_header', 10 );


/* diego offcanvas */

function diego_check_offcanvas() {
    $diego_offcanvas_style = function_exists( 'tpmeta_field' ) ? tpmeta_field( 'diego_offcanvas_style' ) : NULL;
    $diego_default_offcanvas_style = get_theme_mod( 'choose_default_offcanvas', 'offcanvas_1' );

    if ( $diego_offcanvas_style == 'offcanvas-style-1' ) {
        get_template_part( 'template-parts/offcanvas/offcanvas-1' );

    }
    elseif($diego_offcanvas_style == 'offcanvas-style-2' ){
        get_template_part( 'template-parts/offcanvas/offcanvas-2' );
    }

    
    else{
        if ( $diego_default_offcanvas_style == 'offcanvas_2' ) {
            get_template_part( 'template-parts/offcanvas/offcanvas-2' );
        } 

        else {
            get_template_part( 'template-parts/offcanvas/offcanvas-1' );
        }
    }
}

add_action( 'diego_offcanvas_style', 'diego_check_offcanvas', 10 );




/**
 * [diego_header_lang description]
 * @return [type] [description]
 */
function diego_header_lang_defualt() {
   ?>

    <div class="tp-header-top-menu-item tp-header-lang">
        <span class="tp-header-lang-toggle" id="tp-header-lang-toggle"><?php print esc_html__( 'English', 'diego' );?></span>
        <?php do_action( 'diego_language' );?>
    </div>
<?php
}

/**
 * [diego_language_list description]
 * @return [type] [description]
 */
function _diego_language( $mar ) {
    return $mar;
}
function diego_language_list() {

    $mar = '';
    $languages = apply_filters( 'wpml_active_languages', NULL, 'orderby=id&order=desc' );
    if ( !empty( $languages ) ) {
        $mar = '<ul class="">';
        foreach ( $languages as $lan ) {
            $active = $lan['active'] == 1 ? 'active' : '';
            $mar .= '<li class="' . $active . '"><a href="' . $lan['url'] . '">' . $lan['translated_name'] . '</a></li>';
        }
        $mar .= '</ul>';
    } else {
        //remove this code when send themeforest reviewer team
        $mar .= '<ul class="">';
        $mar .= '<li><a href="#">' . esc_html__( 'English', 'diego' ) . '</a></li>';
        $mar .= '<li><a href="#">' . esc_html__( 'Spanish', 'diego' ) . '</a></li>';
        $mar .= '<li><a href="#">' . esc_html__( 'French', 'diego' ) . '</a></li>';
        $mar .= ' </ul>';
    }
    print _diego_language( $mar );
}
add_action( 'diego_language', 'diego_language_list' );





/**
 * [diego_offcanvas_language description]
 * @return [type] [description]
 */


 /**
 * [diego_header_lang description]
 * @return [type] [description]
 */
function diego_offcanvas_lang_defualt() {
    ?>
  
     <div class="offcanvas__select language">
         <div class="offcanvas__lang d-flex align-items-center justify-content-md-end">
             <div class="offcanvas__lang-img mr-15">
                 <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/img/icon/language-flag.png" alt="<?php echo esc_attr__('language', 'diego'); ?>">
             </div>
 
             <div class="offcanvas__lang-wrapper">
                 <span class="offcanvas__lang-selected-lang tp-lang-toggle" id="tp-offcanvas-lang-toggle"><?php echo esc_html__('English', 'diego'); ?></span> 
                 <?php do_action( 'diego_offcanvas_language' );?>
             </div>
         </div>
     </div>
 <?php
 }
function _diego_offcanvas_language( $mar ) {
    return $mar;
}
function diego_offcanvas_language_list() {

    $mar = '';
    $languages = apply_filters( 'wpml_active_languages', NULL, 'orderby=id&order=desc' );
    if ( !empty( $languages ) ) {
        $mar = '<ul class="offcanvas__lang-list tp-lang-list">';
        foreach ( $languages as $lan ) {
            $active = $lan['active'] == 1 ? 'active' : '';
            $mar .= '<li class="' . $active . '"><a href="' . $lan['url'] . '">' . $lan['translated_name'] . '</a></li>';
        }
        $mar .= '</ul>';
    } else {
        //remove this code when send themeforest reviewer team
        $mar .= '<ul class="offcanvas__lang-list tp-lang-list">';
        $mar .= '<li><a href="#">' . esc_html__( 'English', 'diego' ) . '</a></li>';
        $mar .= '<li><a href="#">' . esc_html__( 'Spanish', 'diego' ) . '</a></li>';
        $mar .= '<li><a href="#">' . esc_html__( 'French', 'diego' ) . '</a></li>';
        $mar .= ' </ul>';
    }
    print _diego_language( $mar );
}
add_action( 'diego_offcanvas_language', 'diego_offcanvas_language_list' );



/**
 * [diego_language_list description]
 * @return [type] [description]
 */
function _diego_footer_language( $mar ) {
    return $mar;
}
function diego_footer_language_list() {
    $mar = '';
    $languages = apply_filters( 'wpml_active_languages', NULL, 'orderby=id&order=desc' );
    if ( !empty( $languages ) ) {
        $mar = '<ul class="footer__lang-list tp-lang-list-2">';
        foreach ( $languages as $lan ) {
            $active = $lan['active'] == 1 ? 'active' : '';
            $mar .= '<li class="' . $active . '"><a href="' . $lan['url'] . '">' . $lan['translated_name'] . '</a></li>';
        }
        $mar .= '</ul>';
    } else {
        //remove this code when send themeforest reviewer team
        $mar .= '<ul class="footer__lang-list tp-lang-list-2">';
        $mar .= '<li><a href="#">' . esc_html__( 'English', 'diego' ) . '</a></li>';
        $mar .= '<li><a href="#">' . esc_html__( 'Spanish', 'diego' ) . '</a></li>';
        $mar .= '<li><a href="#">' . esc_html__( 'French', 'diego' ) . '</a></li>';
        $mar .= ' </ul>';
    }
    print _diego_footer_language( $mar );
}
add_action( 'diego_footer_language', 'diego_footer_language_list' );



// header logo
function diego_header_logo() { ?>
        <?php

            $diego_logo_white_dir = get_template_directory_uri() . '/assets/img/logo/logo.png';
            $diego_logo_black_dir = get_template_directory_uri() . '/assets/img/logo/logo-black.png';

            // logo from customizer
            $diego_logo_white = get_theme_mod( 'header_logo_white', $diego_logo_white_dir );
            $diego_logo_black = get_theme_mod( 'header_logo_black', $diego_logo_black_dir );
            $diego_site_logo_width = get_theme_mod( 'diego_logo_width', '120');

            // logo settings from meta
            $logo_black_from_page = function_exists( 'tpmeta_field' ) ? tpmeta_image_field( 'diego_logo_black' ) : NULL;
            $logo_white_from_page = function_exists( 'tpmeta_field' ) ? tpmeta_image_field( 'diego_logo_white' ) : NULL;
            $logo_width_from_page = function_exists('tpmeta_field')? tpmeta_field('diego_logo_width') : NULL;

    
            // logo final settings
            $logo_width = !empty($logo_width_from_page) ? $logo_width_from_page : $diego_site_logo_width;
            $logo_white = !empty($logo_white_from_page) ? $logo_white_from_page['url'] : $diego_logo_white;
            $logo_black = !empty($logo_black_from_page) ? $logo_black_from_page['url'] : $diego_logo_black;
        ?>
    

        <a class="standard-logo logo-white" href="<?php print esc_url( home_url( '/' ) );?>">
            <img data-width="<?php echo esc_attr($logo_width); ?>" height="auto" src="<?php print esc_url( $logo_white );?>" alt="<?php print esc_attr__( 'Diego Logo', 'diego' );?>">
        </a>
        <a class="standard-logo logo-black" href="<?php print esc_url( home_url( '/' ) );?>">
            <img data-width="<?php echo esc_attr($logo_width); ?>" height="auto" src="<?php print esc_url( $logo_black );?>" alt="<?php print esc_attr__( 'Diego Logo', 'diego' );?>">
        </a>
<?php
}

function diego_header_single_logo() { ?>
    <?php

        $diego_logo_white_dir = get_template_directory_uri() . '/assets/img/logo/logo-red-white.png';

        // logo from customizer
        $diego_logo_white = get_theme_mod( 'header_logo_white', $diego_logo_white_dir );
        $diego_site_logo_width = get_theme_mod( 'diego_logo_width', '120');

        // logo settings from meta
        $logo_white_from_page = function_exists( 'tpmeta_field' ) ? tpmeta_image_field( 'diego_logo_white' ) : NULL;
        $logo_width_from_page = function_exists('tpmeta_field')? tpmeta_field('diego_logo_width') : NULL;


        // logo final settings
        $logo_width = !empty($logo_width_from_page) ? $logo_width_from_page : $diego_site_logo_width;
        $logo_white = !empty($logo_white_from_page) ? $logo_white_from_page['url'] : $diego_logo_white;
        ?>

        <a href="<?php print esc_url( home_url( '/' ) );?>">
        <img data-width="<?php echo esc_attr($logo_width); ?>" height="auto" src="<?php print esc_url( $logo_white );?>" alt="<?php print esc_attr__( 'Diego Logo', 'diego' );?>">
        </a>
<?php
}

// header logo
function diego_header_double_logo() { ?>
    <?php
        $diego_logo = get_template_directory_uri() . '/assets/img/logo/logo.svg';
        $diego_logo_white = get_template_directory_uri() . '/assets/img/logo/logo-white.svg';

        $diego_site_logo_width = get_theme_mod( 'diego_logo_width', '135');

        $diego_site_logo = get_theme_mod( 'header_logo', $diego_logo );
        $diego_logo_white = get_theme_mod( 'header_secondary_logo', $diego_logo_white );

        ?>
    
        <a href="<?php print esc_url( home_url( '/' ) );?>">
            <img data-width="<?php echo esc_attr($diego_site_logo_width); ?>" height="auto" class="logo-light" src="<?php print esc_url( $diego_logo_white ); ?>" alt="<?php print esc_attr__( 'logo', 'diego' );?>">
            <img data-width="<?php echo esc_attr($diego_site_logo_width); ?>" height="auto" class="logo-dark" src="<?php print esc_url( $diego_site_logo );?>" alt="<?php print esc_attr__( 'logo', 'diego' );?>">
        </a>
<?php
}


// diego_footer_logo
function diego_footer_logo() { ?>
      <?php
        $diego_foooter_logo = function_exists( 'get_field' ) ? get_field( 'diego_footer_logo' ) : NULL;

        $diego_logo = get_template_directory_uri() . '/assets/img/logo/logo.svg';

        $diego_footer_logo_default = get_theme_mod( 'diego_footer_logo', $diego_logo );
        $diego_site_logo_width = get_theme_mod( 'diego_logo_width', '120');
      ?>

      <?php if ( !empty( $diego_foooter_logo ) ) : ?>
         <a href="<?php print esc_url( home_url( '/' ) );?>">
             <img data-width="<?php echo esc_attr($diego_site_logo_width); ?>" height="auto" src="<?php print esc_url( $diego_foooter_logo );?>" alt="<?php print esc_attr__( 'logo', 'diego' );?>" />
         </a>
      <?php else : ?>
         <a href="<?php print esc_url( home_url( '/' ) );?>">
             <img data-width="<?php echo esc_attr($diego_site_logo_width); ?>" height="auto" src="<?php print esc_url( $diego_footer_logo_default );?>" alt="<?php print esc_attr__( 'logo', 'diego' );?>" />
         </a>
      <?php endif; ?>
   <?php
}


// header logo
function diego_header_sticky_logo() {?>
    <?php
        $diego_sticky_logo = function_exists( 'get_field' ) ? get_field( 'diego_sticky_logo' ) : NULL;

        $logo_black_from_page = function_exists( 'tpmeta_field' ) ? tpmeta_image_field( 'diego_logo_black' ) : '';
        $logo_white_from_page = function_exists( 'tpmeta_field' ) ? tpmeta_image_field( 'diego_logo_white' ) : '';
        $logo_width_from_page = function_exists('tpmeta_field')? tpmeta_field('diego_logo_width') : '';

        $diego_logo = get_theme_mod( 'diego_sticky_logo', get_template_directory_uri() . '/assets/img/logo/logo-black-solid.svg' );
        $diego_secondary_logo = get_theme_mod( 'seconday_logo',  get_template_directory_uri() . '/assets/img/logo/logo.svg');
        $diego_site_logo_width = get_theme_mod( 'diego_logo_width', '120');


        $logo_width = !empty($logo_width_from_page) ? $logo_width_from_page : $diego_site_logo_width;
        $logo_white = !empty($logo_white_from_page) ? $logo_white_from_page : $diego_secondary_logo;
        $logo_black = !empty($logo_black_from_page) ? $logo_black_from_page : $diego_logo;


    ?>
        <?php if (!empty($diego_sticky_logo)) : ?>
        <a href="<?php print esc_url( home_url( '/' ) );?>">
            <img data-width="<?php echo esc_attr($diego_site_logo_width); ?>" height="auto" class="logo-dark" src="<?php print esc_url( $diego_logo );?>" alt="logo">
            <img data-width="<?php echo esc_attr($diego_site_logo_width); ?>" height="auto" class="logo-light" src="<?php print esc_url( $diego_secondary_logo );?>" alt="logo">
        </a>

        <?php else : ?>
        <a href="<?php print esc_url( home_url( '/' ) );?>">
            <img data-width="<?php echo esc_attr($logo_width); ?>" height="auto" class="logo-dark" src="<?php print esc_url( $logo_black );?>" alt="logo">
            <img data-width="<?php echo esc_attr($logo_width); ?>" height="auto" class="logo-light" src="<?php print esc_url( $logo_white );?>" alt="logo">
        </a>
        <?php endif; ?>
    <?php
}

function diego_mobile_logo() {
    // side info
    $diego_mobile_logo_hide = get_theme_mod( 'diego_mobile_logo_hide', false );

    $diego_site_logo = get_theme_mod( 'logo', get_template_directory_uri() . '/assets/img/logo/logo.png' );

    ?>

    <?php if ( !empty( $diego_mobile_logo_hide ) ): ?>
    <div class="side__logo mb-25">
        <a class="sideinfo-logo" href="<?php print esc_url( home_url( '/' ) );?>">
            <img src="<?php print esc_url( $diego_site_logo );?>" alt="<?php print esc_attr__( 'logo', 'diego' );?>" />
        </a>
    </div>
    <?php endif;?>



<?php }

/**
 * [diego_header_social_profiles description]
 * @return [type] [description]
 */
function diego_header_social_profiles() {
    $diego_topbar_fb_url = get_theme_mod( 'diego_topbar_fb_url', __( '#', 'diego' ) );
    $diego_topbar_twitter_url = get_theme_mod( 'diego_topbar_twitter_url', __( '#', 'diego' ) );
    $diego_topbar_instagram_url = get_theme_mod( 'diego_topbar_instagram_url', __( '#', 'diego' ) );
    $diego_topbar_linkedin_url = get_theme_mod( 'diego_topbar_linkedin_url', __( '#', 'diego' ) );
    $diego_topbar_youtube_url = get_theme_mod( 'diego_topbar_youtube_url', __( '#', 'diego' ) );
    ?>
        <ul>
        <?php if ( !empty( $diego_topbar_fb_url ) ): ?>
          <li><a href="<?php print esc_url( $diego_topbar_fb_url );?>"><span><i class="fab fa-facebook-f"></i></span></a></li>
        <?php endif;?>

        <?php if ( !empty( $diego_topbar_twitter_url ) ): ?>
            <li><a href="<?php print esc_url( $diego_topbar_twitter_url );?>"><span><i class="fab fa-twitter"></i></span></a></li>
        <?php endif;?>

        <?php if ( !empty( $diego_topbar_instagram_url ) ): ?>
            <li><a href="<?php print esc_url( $diego_topbar_instagram_url );?>"><span><i class="fab fa-instagram"></i></span></a></li>
        <?php endif;?>

        <?php if ( !empty( $diego_topbar_linkedin_url ) ): ?>
            <li><a href="<?php print esc_url( $diego_topbar_linkedin_url );?>"><span><i class="fab fa-linkedin"></i></span></a></li>
        <?php endif;?>

        <?php if ( !empty( $diego_topbar_youtube_url ) ): ?>
            <li><a href="<?php print esc_url( $diego_topbar_youtube_url );?>"><span><i class="fab fa-youtube"></i></span></a></li>
        <?php endif;?>
        </ul>

<?php
}

/**
 * [diego_offcanvas_social_profiles description]
 * @return [type] [description]
 */
function diego_offcanvas_social_profiles() {
    
    $diego_offcanvas_dribble_url = get_theme_mod( 'diego_offcanvas_dribble_url', __( '#', 'diego' ) );
    $diego_offcanvas_instagram_url = get_theme_mod( 'diego_offcanvas_instagram_url', __( '#', 'diego' ) );
    $diego_offcanvas_behance_url = get_theme_mod( 'diego_offcanvas_behance_url', __( '#', 'diego' ) );
    $diego_offcanvas_youtube_url = get_theme_mod( 'diego_offcanvas_youtube_url', __( '#', 'diego' ) );
    ?>

        <ul>

            <?php if ( !empty( $diego_offcanvas_dribble_url ) ): ?>
            <li>
                <a href="<?php print esc_url( $diego_offcanvas_dribble_url );?>"><?php echo esc_html__('Dribbble', 'diego'); ?></a>
            </li>
            <?php endif;?>

            <?php if ( !empty( $diego_offcanvas_instagram_url ) ): ?>
            <li>
                <a href="<?php print esc_url( $diego_offcanvas_instagram_url );?>"><?php echo esc_html__('Instagram', 'diego'); ?></a>
            </li>
            <?php endif;?>

            <?php if ( !empty( $diego_offcanvas_behance_url ) ): ?>
            <li>
                <a href="<?php print esc_url( $diego_offcanvas_behance_url );?>"><?php echo esc_html__('Behance', 'diego'); ?></a>
            </li>
            <?php endif;?>

            <?php if ( !empty( $diego_offcanvas_youtube_url ) ): ?>
            <li>
                <a href="<?php print esc_url( $diego_offcanvas_youtube_url );?>"><?php echo esc_html__('Youtube', 'diego'); ?></a>
            </li>
            <?php endif;?>
        </ul>
<?php
}

/**
 * [diego_offcanvas_social_profiles description]
 * @return [type] [description]
 */
function diego_offcanvas_social_profiles_2() {
    
    $diego_offcanvas_dribble_url = get_theme_mod( 'diego_offcanvas_dribble_url', __( '#', 'diego' ) );
    $diego_offcanvas_instagram_url = get_theme_mod( 'diego_offcanvas_instagram_url', __( '#', 'diego' ) );
    $diego_offcanvas_behance_url = get_theme_mod( 'diego_offcanvas_behance_url', __( '#', 'diego' ) );
    $diego_offcanvas_youtube_url = get_theme_mod( 'diego_offcanvas_youtube_url', __( '#', 'diego' ) );
    ?>

        <ul>
            <li>
                <a href="<?php print esc_url( $diego_offcanvas_instagram_url );?>">
                <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M11.25 1.5H4.75C2.95507 1.5 1.5 2.95507 1.5 4.75V11.25C1.5 13.0449 2.95507 14.5 4.75 14.5H11.25C13.0449 14.5 14.5 13.0449 14.5 11.25V4.75C14.5 2.95507 13.0449 1.5 11.25 1.5Z"
                        stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                    <path
                        d="M10.6016 7.5907C10.6818 8.13166 10.5894 8.68414 10.3375 9.16955C10.0856 9.65497 9.68711 10.0486 9.19862 10.2945C8.71014 10.5404 8.15656 10.6259 7.61663 10.5391C7.0767 10.4522 6.57791 10.1972 6.19121 9.81055C5.80451 9.42385 5.54959 8.92506 5.46271 8.38513C5.37583 7.8452 5.46141 7.29163 5.70728 6.80314C5.95315 6.31465 6.34679 5.91613 6.83221 5.66425C7.31763 5.41238 7.87011 5.31998 8.41107 5.4002C8.96287 5.48202 9.47372 5.73915 9.86817 6.1336C10.2626 6.52804 10.5197 7.0389 10.6016 7.5907Z"
                        stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                    <path d="M11.5742 4.42578H11.5842" stroke="currentColor" stroke-width="1.5"
                        stroke-linecap="round" stroke-linejoin="round" />
                </svg>
                </a>
            </li>
            <li>
                <a href="<?php print esc_url( $diego_offcanvas_dribble_url );?>">
                <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M2.50589 12.7494C4.57662 16.336 9.16278 17.5648 12.7494 15.4941C14.2113 14.65 15.2816 13.388 15.8962 11.9461C16.7895 9.85066 16.7208 7.37526 15.4941 5.25063C14.2674 3.12599 12.1581 1.82872 9.89669 1.55462C8.34063 1.366 6.71259 1.66183 5.25063 2.50589C1.66403 4.57662 0.435172 9.16278 2.50589 12.7494Z"
                        stroke="currentColor" stroke-width="1.5" />
                    <path
                        d="M12.7127 15.4292C12.7127 15.4292 12.0086 10.4867 10.5011 7.87559C8.99362 5.26451 5.28935 2.57155 5.28935 2.57155M5.68449 15.6124C6.79553 12.2606 12.34 8.54524 16.3975 9.43537M12.311 2.4082C11.1953 5.72344 5.75732 9.38453 1.71875 8.58915"
                        stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                </svg>
                </a>
            </li>
            <li>
                <a href="<?php print esc_url( $diego_offcanvas_behance_url );?>">
                <svg width="18" height="11" viewBox="0 0 18 11" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M1 5.5715H6.33342C7.62867 5.5715 8.61917 6.56199 8.61917 7.85725C8.61917 9.15251 7.62867 10.143 6.33342 10.143H1.76192C1.30477 10.143 1 9.83823 1 9.38108V1.76192C1 1.30477 1.30477 1 1.76192 1H5.5715C6.86676 1 7.85725 1.99049 7.85725 3.28575C7.85725 4.58101 6.86676 5.5715 5.5715 5.5715H1Z"
                        stroke="currentColor" stroke-width="1.5" stroke-miterlimit="10" />
                    <path
                        d="M10.9062 7.09454H17.0016C17.0016 5.41832 15.6301 4.04688 13.9539 4.04688C12.2777 4.04688 10.9062 5.41832 10.9062 7.09454ZM10.9062 7.09454C10.9062 8.77076 12.2777 10.1422 13.9539 10.1422H15.2492"
                        stroke="currentColor" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round"
                        stroke-linejoin="round" />
                    <path d="M16.1125 1.44434H11.668" stroke="currentColor" stroke-width="1.2"
                        stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
                </a>
            </li>
            <li>
                <a href="<?php print esc_url( $diego_offcanvas_youtube_url );?>">
                <svg width="18" height="14" viewBox="0 0 18 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M12.75 13H5.25C3 13 1.5 11.5 1.5 9.25V4.75C1.5 2.5 3 1 5.25 1H12.75C15 1 16.5 2.5 16.5 4.75V9.25C16.5 11.5 15 13 12.75 13Z"
                        stroke="currentColor" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round"
                        stroke-linejoin="round" />
                    <path
                        d="M8.70676 5.14837L10.8006 6.40465C11.5543 6.90716 11.5543 7.66093 10.8006 8.16344L8.70676 9.41972C7.86923 9.92224 7.19922 9.50348 7.19922 8.5822V6.06964C7.19922 4.98086 7.86923 4.64585 8.70676 5.14837Z"
                        fill="currentColor" />
                </svg>
                </a>
            </li>
        </ul>
<?php
}

function diego_footer_social_profiles() {
    $diego_footer_fb_url = get_theme_mod( 'diego_footer_fb_url', __( '#', 'diego' ) );
    $diego_footer_twitter_url = get_theme_mod( 'diego_footer_twitter_url', __( '#', 'diego' ) );
    $diego_footer_instagram_url = get_theme_mod( 'diego_footer_instagram_url', __( '#', 'diego' ) );
    $diego_footer_linkedin_url = get_theme_mod( 'diego_footer_linkedin_url', __( '#', 'diego' ) );
    $diego_footer_youtube_url = get_theme_mod( 'diego_footer_youtube_url', __( '#', 'diego' ) );
    ?>

        <?php if ( !empty( $diego_footer_fb_url ) ): ?>
            <a href="<?php print esc_url( $diego_footer_fb_url );?>">
                <i class="fab fa-facebook-f"></i>
            </a>
        <?php endif;?>

        <?php if ( !empty( $diego_footer_twitter_url ) ): ?>
            <a href="<?php print esc_url( $diego_footer_twitter_url );?>">
                <i class="fab fa-twitter"></i>
            </a>
        <?php endif;?>

        <?php if ( !empty( $diego_footer_instagram_url ) ): ?>
            <a href="<?php print esc_url( $diego_footer_instagram_url );?>">
                <i class="fab fa-instagram"></i>
            </a>
        <?php endif;?>

        <?php if ( !empty( $diego_footer_linkedin_url ) ): ?>
            <a href="<?php print esc_url( $diego_footer_linkedin_url );?>">
                <i class="fab fa-linkedin"></i>
            </a>
        <?php endif;?>

        <?php if ( !empty( $diego_footer_youtube_url ) ): ?>
            <a href="<?php print esc_url( $diego_footer_youtube_url );?>">
                <i class="fab fa-youtube"></i>
            </a>
        <?php endif;?>
<?php
}


/**
 * [diego_header_menu description]
 * @return [type] [description]
 */
function diego_header_menu() {
    ?>
    <?php
        wp_nav_menu( [
            'theme_location' => 'main-menu',
            'menu_class'     => '',
            'container'      => '',
            'fallback_cb'    => 'Diego_Navwalker_Class::fallback',
            'walker'         => new \TPCore\Widgets\Diego_Navwalker_Class,
        ] );
    ?>
    <?php
}

/**
 * [diego_header_menu description]
 * @return [type] [description]
 */
function diego_header_onepage_menu() {
    ?>
    <?php
        wp_nav_menu( [
            'theme_location' => 'onepage-main-menu',
            'menu_class'     => '',
            'container'      => '',
            'fallback_cb'    => 'Diego_Navwalker_Class::fallback',
            'walker'         => new \TPCore\Widgets\Diego_Navwalker_Class,
        ] );
    ?>
    <?php
}


/**
 * [diego_footer_menu description]
 * @return [type] [description]
 */
function diego_footer_menu() {
    wp_nav_menu( [
        'theme_location' => 'footer-menu',
        'menu_class'     => 'm-0 footer-list-inline-3',
        'container'      => '',
        'fallback_cb'    => 'Diego_Navwalker_Class::fallback',
        'walker'         => new \TPCore\Widgets\Diego_Navwalker_Class,
    ] );
}

/**
 * [diego_offcanvas_default_menu description]
 * @return [type] [description]
 */
function diego_offcanvas_default_menu() {
    wp_nav_menu( [
        'theme_location' => 'offcanvas-menu',
        'menu_class'     => '',
        'container'      => '',
        'fallback_cb'    => 'Diego_Navwalker_Class::fallback',
        'walker'         => new \TPCore\Widgets\Diego_Navwalker_Class,
    ] );
}

/**
 *
 * diego footer
 */
add_action( 'diego_footer_style', 'diego_check_footer', 10 );

function get_footer_style($style){
    if ( $style == 'footer_2'  ) {
        get_template_part( 'template-parts/footer/footer-2' );
    }
    elseif($style == 'footer_blank'){
        get_template_part( 'template-parts/footer/footer-blank' );
    }
    else{
        get_template_part( 'template-parts/footer/footer-1');
    }
}

function diego_check_footer() {
    $tp_footer_tabs = function_exists('tpmeta_field')? tpmeta_field('diego_footer_tabs') : false;
    $tp_footer_style_meta = function_exists('tpmeta_field')? tpmeta_field('diego_footer_style') : '';
    $elementor_footer_template_meta = function_exists('tpmeta_field')? tpmeta_field('diego_footer_templates') : false;

    
    $diego_footer_option_switch = get_theme_mod('diego_footer_elementor_switch', false);
    $footer_default_style_kirki = get_theme_mod( 'footer_layout_custom', 'footer_1' );
    $elementor_footer_templates_kirki = get_theme_mod( 'diego_footer_templates' );
    
    if($tp_footer_tabs == 'default'){
        if($diego_footer_option_switch){
            if($elementor_footer_templates_kirki){
                echo \Elementor\Plugin::$instance->frontend->get_builder_content($elementor_footer_templates_kirki);
            }
        }else{ 
            if($footer_default_style_kirki){
                get_footer_style($footer_default_style_kirki);
            }else{
                get_template_part( 'template-parts/footer/footer-1' );
            }
        }
    }elseif($tp_footer_tabs == 'custom'){
        if ($tp_footer_style_meta) {
            get_footer_style($tp_footer_style_meta);
        }else{
            get_footer_style($footer_default_style_kirki);
        }  
    }elseif($tp_footer_tabs == 'elementor'){
        if($elementor_footer_template_meta){
            echo \Elementor\Plugin::$instance->frontend->get_builder_content($elementor_footer_template_meta);
        }else{
            echo \Elementor\Plugin::$instance->frontend->get_builder_content($elementor_footer_templates_kirki);
        }
    }else{
        if($diego_footer_option_switch){

            if($elementor_footer_templates_kirki){
                echo \Elementor\Plugin::$instance->frontend->get_builder_content($elementor_footer_templates_kirki);
            }else{
                get_template_part( 'template-parts/footer/footer-1' );
            }
        }else{
            get_footer_style($footer_default_style_kirki);

        }
        
    }

}

// diego_copyright_text
function diego_copyright_text() {
   print get_theme_mod( 'diego_copyright', esc_html__( '© 2025 All Rights Reserved | WordPress Theme by Themepure', 'diego' ) );
}



/**
 *
 * pagination
 */
if ( !function_exists( 'diego_pagination' ) ) {

    function _diego_pagi_callback( $pagination ) {
        return $pagination;
    }

    //page navegation
    function diego_pagination( $prev, $next, $pages, $args ) {
        global $wp_query, $wp_rewrite;
        $menu = '';
        $wp_query->query_vars['paged'] > 1 ? $current = $wp_query->query_vars['paged'] : $current = 1;

        if ( $pages == '' ) {
            global $wp_query;
            $pages = $wp_query->max_num_pages;

            if ( !$pages ) {
                $pages = 1;
            }

        }

        $pagination = [
            'base'      => add_query_arg( 'paged', '%#%' ),
            'format'    => '',
            'total'     => $pages,
            'current'   => $current,
            'prev_text' => $prev,
            'next_text' => $next,
            'type'      => 'array',
        ];

        //rewrite permalinks
        if ( $wp_rewrite->using_permalinks() ) {
            $pagination['base'] = user_trailingslashit( trailingslashit( remove_query_arg( 's', get_pagenum_link( 1 ) ) ) . 'page/%#%/', 'paged' );
        }

        if ( !empty( $wp_query->query_vars['s'] ) ) {
            $pagination['add_args'] = ['s' => get_query_var( 's' )];

            
        }     

        $pagi = '';
        if ( paginate_links( $pagination ) != '' ) {
            $paginations = paginate_links( $pagination );
            $pagi .= '<ul>';
            foreach ( $paginations as $key => $pg ) {
                $pagi .= '<li>' . $pg . '</li>';
            }
            $pagi .= '</ul>';
        }

        print _diego_pagi_callback( $pagi );
    }
}


// preloader bg color
function diego_preloader_bg_color() {
    $color_code = get_theme_mod( 'diego_preloader_bg_color', '#0F183E' );

    wp_enqueue_style( 'diego-preloader-bg', DIEGO_THEME_CSS_DIR . 'diego-custom.css', [] );
    
    if ( $color_code != '' ) {
        $custom_css = '';
        $custom_css = "#loading{ background-color: " . $color_code . " !important}";
        wp_add_inline_style( 'diego-preloader-bg', $custom_css );
    }

}
add_action( 'wp_enqueue_scripts', 'diego_preloader_bg_color' );


// header top bg color
function diego_breadcrumb_bg_color() {
    $color_code = get_theme_mod( 'diego_breadcrumb_bg_color', '#e1e1e1' );
    wp_enqueue_style( 'diego-custom', DIEGO_THEME_CSS_DIR . 'diego-custom.css', [] );
    if ( $color_code != '' ) {
        $custom_css = '';
        $custom_css .= ".breadcrumb-bg.gray-bg{ background: " . $color_code . "}";

        wp_add_inline_style( 'diego-breadcrumb-bg', $custom_css );
    }
}
add_action( 'wp_enqueue_scripts', 'diego_breadcrumb_bg_color' );

// breadcrumb-spacing top
function diego_breadcrumb_spacing() {
    $padding_px = get_theme_mod( 'diego_breadcrumb_spacing', '160px' );
    wp_enqueue_style( 'diego-custom', DIEGO_THEME_CSS_DIR . 'diego-custom.css', [] );
    if ( $padding_px != '' ) {
        $custom_css = '';
        $custom_css .= ".breadcrumb-spacing{ padding-top: " . $padding_px . "}";

        wp_add_inline_style( 'diego-breadcrumb-top-spacing', $custom_css );
    }
}
add_action( 'wp_enqueue_scripts', 'diego_breadcrumb_spacing' );

// breadcrumb-spacing bottom
function diego_breadcrumb_bottom_spacing() {
    $padding_px = get_theme_mod( 'diego_breadcrumb_bottom_spacing', '160px' );
    wp_enqueue_style( 'diego-custom', DIEGO_THEME_CSS_DIR . 'diego-custom.css', [] );
    if ( $padding_px != '' ) {
        $custom_css = '';
        $custom_css .= ".breadcrumb-spacing{ padding-bottom: " . $padding_px . "}";

        wp_add_inline_style( 'diego-breadcrumb-bottom-spacing', $custom_css );
    }
}
add_action( 'wp_enqueue_scripts', 'diego_breadcrumb_bottom_spacing' );

// scrollup
function diego_scrollup_switch() {
    $scrollup_switch = get_theme_mod( 'diego_scrollup_switch', false );
    wp_enqueue_style( 'diego-custom', DIEGO_THEME_CSS_DIR . 'diego-custom.css', [] );
    if ( $scrollup_switch ) {
        $custom_css = '';
        $custom_css .= "#scrollUp{ display: none !important;}";

        wp_add_inline_style( 'diego-scrollup-switch', $custom_css );
    }
}
add_action( 'wp_enqueue_scripts', 'diego_scrollup_switch' );

// theme color
function diego_custom_color() {
    $color_code_primary          = get_theme_mod( 'diego_color_option_primary', '#0989FF' );
    $color_code_secondary = get_theme_mod( 'diego_color_option_secondary', '#821F40' );
    $color_code_brown     = get_theme_mod( 'diego_color_option_brown', '#BD844C' );
    $color_code_green     = get_theme_mod( 'diego_color_option_green', '#678E61' );
    wp_enqueue_style( 'diego-custom', DIEGO_THEME_CSS_DIR . 'diego-custom.css', [] );
    if ( ($color_code_primary != '') || ($color_code_secondary != '') || ($color_code_brown != '') || ($color_code_green != '') ) {
        $custom_css = '';
        $custom_css .= "html:root { --tp-theme-primary : " . $color_code_primary . "}";
        $custom_css .= "html:root { --tp-theme-secondary : " . $color_code_secondary . "}";
        $custom_css .= "html:root { --tp-theme-brown : " . $color_code_brown . "}";
        $custom_css .= "html:root { --tp-theme-green : " . $color_code_green . "}";

        wp_add_inline_style( 'diego-custom', $custom_css );
    }
}



// scroll to top color
function diego_custom_color_scrollup() {
    $color_code = get_theme_mod( 'diego_color_scrollup', '#03041C' );
    wp_enqueue_style( 'diego-custom', DIEGO_THEME_CSS_DIR . 'diego-custom.css', [] );
    if ( $color_code != '' ) {
        $custom_css = '';
        $custom_css .= "html .back-to-top-btn { background-color: " . $color_code . "}";
        wp_add_inline_style( 'diego-custom', $custom_css );
    }
}
add_action( 'wp_enqueue_scripts', 'diego_custom_color_scrollup' );


// diego_kses_intermediate
function diego_kses_intermediate( $string = '' ) {
    return wp_kses( $string, diego_get_allowed_html_tags( 'intermediate' ) );
}

function diego_get_allowed_html_tags( $level = 'basic' ) {
    $allowed_html = [
        'b'      => [],
        'i'      => [],
        'u'      => [],
        'em'     => [],
        'br'     => [],
        'abbr'   => [
            'title' => [],
        ],
        'span'   => [
            'class' => [],
        ],
        'strong' => [],
        'a'      => [
            'href'  => [],
            'title' => [],
            'class' => [],
            'id'    => [],
        ],
    ];

    if ($level === 'intermediate') {
        $allowed_html['a'] = [
            'href' => [],
            'title' => [],
            'class' => [],
            'id' => [],
        ];
        $allowed_html['div'] = [
            'class' => [],
            'id' => [],
        ];
        $allowed_html['img'] = [
            'src' => [],
            'class' => [],
            'alt' => [],
        ];
        $allowed_html['del'] = [
            'class' => [],
        ];
        $allowed_html['ins'] = [
            'class' => [],
        ];
        $allowed_html['bdi'] = [
            'class' => [],
        ];
        $allowed_html['i'] = [
            'class' => [],
            'data-rating-value' => [],
        ];
    }

    return $allowed_html;
}



// WP kses allowed tags
// ----------------------------------------------------------------------------------------
function diego_kses($raw){

   $allowed_tags = array(
      'a'                         => array(
         'class'   => array(),
         'href'    => array(),
         'rel'  => array(),
         'title'   => array(),
         'target' => array(),
      ),
      'abbr'                      => array(
         'title' => array(),
      ),
      'b'                         => array(),
      'blockquote'                => array(
         'cite' => array(),
      ),
      'cite'                      => array(
         'title' => array(),
      ),
      'code'                      => array(),
      'del'                    => array(
         'datetime'   => array(),
         'title'      => array(),
      ),
      'dd'                     => array(),
      'div'                    => array(
         'class'   => array(),
         'title'   => array(),
         'style'   => array(),
      ),
      'dl'                     => array(),
      'dt'                     => array(),
      'em'                     => array(),
      'h1'                     => array(),
      'h2'                     => array(),
      'h3'                     => array(),
      'h4'                     => array(),
      'h5'                     => array(),
      'h6'                     => array(),
      'i'                         => array(
         'class' => array(),
      ),
      'img'                    => array(
         'alt'  => array(),
         'class'   => array(),
         'height' => array(),
         'src'  => array(),
         'width'   => array(),
      ),
      'li'                     => array(
         'class' => array(),
      ),
      'ol'                     => array(
         'class' => array(),
      ),
      'p'                         => array(
         'class' => array(),
      ),
      'q'                         => array(
         'cite'    => array(),
         'title'   => array(),
      ),
      'span'                      => array(
         'class'   => array(),
         'title'   => array(),
         'style'   => array(),
      ),
      'iframe'                 => array(
         'width'         => array(),
         'height'     => array(),
         'scrolling'     => array(),
         'frameborder'   => array(),
         'allow'         => array(),
         'src'        => array(),
      ),
      'strike'                 => array(),
      'br'                     => array(),
      'strong'                 => array(),
      'data-wow-duration'            => array(),
      'data-wow-delay'            => array(),
      'data-wallpaper-options'       => array(),
      'data-stellar-background-ratio'   => array(),
      'ul'                     => array(
         'class' => array(),
      ),
      'svg' => array(
           'class' => true,
           'aria-hidden' => true,
           'aria-labelledby' => true,
           'role' => true,
           'xmlns' => true,
           'width' => true,
           'height' => true,
           'viewbox' => true, // <= Must be lower case!
       ),
       'g'     => array( 'fill' => true ),
       'title' => array( 'title' => true ),
       'path'  => array( 'd' => true, 'fill' => true,  ),
      );

   if (function_exists('wp_kses')) { // WP is here
      $allowed = wp_kses($raw, $allowed_tags);
   } else {
      $allowed = $raw;
   }

   return $allowed;
}

// / This code filters the Archive widget to include the post count inside the link /
add_filter( 'get_archives_link', 'diego_archive_count_span' );
function diego_archive_count_span( $links ) {
    $links = str_replace('</a>&nbsp;(', '<span > (', $links);
    $links = str_replace(')', ')</span></a> ', $links);
    return $links;
}


// / This code filters the Category widget to include the post count inside the link /
add_filter('wp_list_categories', 'diego_cat_count_span');
function diego_cat_count_span($links) {
  $links = str_replace('</a> (', '<span> (', $links);
  $links = str_replace(')', ')</span></a>', $links);
  return $links;
}