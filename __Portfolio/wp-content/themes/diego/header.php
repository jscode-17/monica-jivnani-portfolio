<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package diego
 */
$theme_mode_from_page       = function_exists('tpmeta_field') ? tpmeta_field('diego_theme_mode') : NULL;
$theme_mode_from_customizer = get_theme_mod('diego_theme_mode', 'dark_mode');

if($theme_mode_from_page == 'dark_mode'){
    $theme_mode = 'dark_mode';
}
elseif($theme_mode_from_page == 'light_mode'){
    $theme_mode = 'light_mode';
}else{
    $theme_mode = $theme_mode_from_customizer;
}


?>

<!doctype html>
<html <?php language_attributes();?> data-theme-mode="<?php echo esc_attr($theme_mode); ?>">
<head>
	<meta charset="<?php bloginfo( 'charset' );?>">
    <?php if ( is_singular() && pings_open( get_queried_object() ) ): ?>
    <?php endif;?>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<?php wp_head();?>
</head>

<body <?php body_class('tp-magic-cursor');?>>

    <?php wp_body_open();?>

   
    
    <?php
        $diego_preloader = get_theme_mod( 'diego_preloader_switch', true );
        $diego_awesome_cursor = get_theme_mod( 'diego_awesome_cursor_switch', true );
        $diego_preloader_loading_text = get_theme_mod( 'diego_preloader_loading_text', __( 'Loading', 'diego' ) );

        $diego_backtotop = get_theme_mod( 'diego_backtotop', true );
        $diego_scroll_effect_from_customizer = get_theme_mod( 'smooth_scroll_switch', true );
        $diego_scroll_effect_from_meta = function_exists( 'tpmeta_field' ) ? tpmeta_field( 'diego_scroll_effect' ) : 'off';
        
        $enable_distor_bg = function_exists( 'tpmeta_field' ) ? tpmeta_field( 'diego_green_bg' ) : 'off';
        $distort_bg = function_exists( 'tpmeta_field' ) ? tpmeta_image_field( 'diego_distort_bg' ) : '';


        $distort_bg_class = ($enable_distor_bg == 'on') ? 'tp-page-wrapper bg-center bg-repeat' : '';
        $distort_bg_url = !empty($distort_bg['url']) ? $distort_bg['url'] : '';


        $bg_color_from_customizer = get_theme_mod( 'body_bg_color', '#0F183E' );
        $bg_color_from_page       = function_exists('tpmeta_field')? tpmeta_field('diego_body_bg') : '';
        
        $bg_color = !empty($bg_color_from_page) ?  $bg_color_from_page : $bg_color_from_customizer;

        $diego_scroll_effect = ($diego_scroll_effect_from_meta == 'on')  ? false : $diego_scroll_effect_from_customizer;



        

    ?>

    <?php if(!empty($diego_preloader)) :?>

        <!-- pre loader area start -->
        <div id="loading" class="my-loader-class">
            <div id="loading-center">
                <div id="loading-center-absolute">
                    <!-- loading content here -->
                    <div class="preloader__content text-center">
                        <div class="preloader__top-text d-flex align-items-center justify-content-between">
                            <?php if(!empty($diego_preloader_loading_text)) :?>
                            <p class="preloader__loading text-start"><?php echo esc_html($diego_preloader_loading_text); ?></p>
                            <?php endif; ?>
                            <h2 id="tp-loading-number" class="text-end"></h2>
                        </div>
                        <div id="tp-loading-bar" class="preloader__bar">
                            <div id="tp-loading-line" class="preloader__bar-inner"></div>
                        </div>
                    </div>
                </div>
            </div>  
        </div>
        <!-- pre loader area end -->
      <?php endif; ?>

    <?php if(!empty($diego_backtotop)) :?>
    <!-- back to top start -->
    <div class="back-to-top-wrapper">
        <button id="back_to_top" type="button" class="back-to-top-btn">
            <svg width="12" height="7" viewBox="0 0 12 7" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M11 6L6 1L1 6" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                stroke-linejoin="round" />
            </svg>
        </button>
    </div>
    <!-- back to top end -->
    <?php endif; ?>

    <?php if($diego_awesome_cursor) : ?>
       <!-- Begin magic cursor 
   ======================== -->
   <div id="magic-cursor">
      <div id="ball">
        <div id="ovarlayCross">
            <svg width="37" height="38" viewBox="0 0 37 38" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M9.19141 9.80762L27.5762 28.1924" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                <path d="M9.19141 28.1924L27.5762 9.80761" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
            </svg>
        </div>
      </div>
      
   </div>
   <!-- End magic cursor -->
   <?php endif; ?>

    
    <div id="awesome-cursor" class="d-none">
      <div id="awesome-cursor-circle">
         <div id="awesome-cursor-loader"></div>
         <div id="awesome-cursor-play" class="">
            <span class="awesome-cursor-play-start"><?php echo esc_html__('Play', 'diego'); ?></span>
            <span class="awesome-cursor-play-stop"><?php echo esc_html__('Stop', 'diego'); ?></span>
         </div>
      </div>
   </div>
  

    <!-- header start -->
    <?php do_action( 'diego_header_style' );?>
    <!-- header end -->


    <?php if($diego_scroll_effect) : 
            /*
                This is for enable or disable the scroll effect
            */
        ?>
        <?php if($enable_distor_bg == 'on') : 
        /*
            If enablde distort bg then body backgrond color should use along with his div
            thats why multiplu conditions applied here.
        */    
        ?>
    <div id="smooth-wrapper" class="<?php echo esc_attr($distort_bg_class); ?>" data-bg-color="<?php echo esc_attr($bg_color); ?>" data-background="<?php echo esc_url($distort_bg_url); ?>">
        <?php else:  ?>
        <div id="smooth-wrapper" class="<?php echo esc_attr($distort_bg_class); ?>" data-background="<?php echo esc_url($distort_bg_url); ?>">
        <?php endif; // scroll if ends. other if ends in the footer php?>

        <div id="smooth-content">
            <?php else: ?>
                <div class="<?php echo esc_attr($distort_bg_class); ?>" data-background="<?php echo esc_url($distort_bg_url); ?>">
            <?php endif; // distort if ends?>

            <?php if($enable_distor_bg == 'on') : 
                /*
                    if distort bg on then don't need to apply bg color in this div
                    because bg color applied with distort background's div
                */    
            ?>
            <div>
            <?php else:  ?>
            <div class="main-content black-bg-3" data-bg-color="<?php echo esc_attr($bg_color); ?>">
            <?php endif; // distort if ends?>

            <!-- wrapper-box start -->
            <?php do_action( 'diego_before_main_content' );?>