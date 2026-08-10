<?php 

/**
 * Template part for displaying footer layout one
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package diego
*/
global $post, $title; 

$_id = get_the_ID();

if ( is_single() && 'product' == get_post_type() ) { 
    $_id = $post->ID;
} 
elseif ( function_exists("is_shop") AND is_shop()  ) { 
    $_id = wc_get_page_id('shop');
} 
elseif ( is_home() && get_option( 'page_for_posts' ) ) {
    $_id = get_option( 'page_for_posts' );
}


$footer_bg_img = get_theme_mod( 'diego_footer_bg' );
$diego_footer_shape = get_theme_mod( 'diego_footer_shape', false );
$diego_footer_logo = get_theme_mod( 'diego_footer_logo' );
$diego_footer_top_space = function_exists( 'tpmeta_field' ) ? tpmeta_field( 'diego_footer_top_space' ) : '0';

$diego_footer_payment = get_theme_mod( 'footer_payment_img' );
$diego_footer_payment_url_from_page = function_exists( 'tpmeta_image_field' ) ? tpmeta_image_field( 'diego_footer_payment' ) : '';
$diego_footer_payment = !empty( $diego_footer_payment_url_from_page['url'] ) ? $diego_footer_payment_url_from_page['url'] : $diego_footer_payment;


$diego_copyright_center = $diego_footer_payment ? 'col-sm-6' : 'col-sm-12 text-center';
$diego_footer_bg_url_from_page = function_exists( 'tpmeta_field' ) ? tpmeta_field( 'diego_footer_bg' ) : '';
$diego_footer_bg_color_from_page = function_exists( 'tpmeta_field' ) ? tpmeta_field( 'diego_footer_bg_color', $_id ) : '';

$footer_bg_color = get_theme_mod( 'diego_footer_bg_color', '#162251' );

// bg image
$bg_img = !empty( $diego_footer_bg_url_from_page['url'] ) ? $diego_footer_bg_url_from_page['url'] : $footer_bg_img;

// bg color
$bg_color = !empty( $diego_footer_bg_color_from_page ) ? $diego_footer_bg_color_from_page : $footer_bg_color;




// footer_columns
$footer_columns = 0;
$footer_widgets = get_theme_mod( 'footer_widget_number', 4 );

for ( $num = 1; $num <= $footer_widgets; $num++ ) {
    $footer_columns++;
}




switch ( $footer_columns ) {
case '1':
    $footer_class[1] = 'col-lg-12';
    break;
case '2':
    $footer_class[1] = 'col-lg-6 col-md-6';
    $footer_class[2] = 'col-lg-6 col-md-6';
    break;
case '3':
    $footer_class[1] = 'col-xl-4 col-lg-6 col-md-5';
    $footer_class[2] = 'col-xl-4 col-lg-6 col-md-7';
    $footer_class[3] = 'col-xl-4 col-lg-6';
    break;
case '4':
    $footer_class[1] = 'col-xl-4 col-lg-4 col-md-8';
    $footer_class[2] = 'col-xl-2 col-lg-2 col-md-4';
    $footer_class[3] = 'col-xl-3 col-lg-3 col-md-8';
    $footer_class[4] = 'col-xl-3 col-lg-3 col-md-4';
    break;
default:
    $footer_class = 'col-xl-3 col-lg-3 col-md-6';
    break;
}

?>

<!-- footer area start -->
<footer>
<div class="tp-footer-4__main-wrapper black-bg-2 p-relative z-index-1 fix include-bg" data-background="<?php echo esc_url($bg_img); ?>" data-bg-color="<?php print esc_attr( $bg_color );?>">
<?php if ( is_active_sidebar('footer-1') OR is_active_sidebar('footer-2') OR is_active_sidebar('footer-3') OR is_active_sidebar('footer-4') ): ?>
   <div class="tp-footer-4__area pt-80 pb-60">

    <?php if($diego_footer_shape): ?>
      <div class="tp-footer-4__shape">
         <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/img/footer/footer-shape-2.png" alt="<?php echo esc_attr__('footer-shape', 'diego'); ?>">
      </div>
      <?php endif; ?>

      <div class="container">
         <div class="row align-items-start">

                <?php
                    for ( $num = 1; $num <= $footer_widgets; $num++ ) {
                        print '<div class="' . esc_attr( $footer_class[$num] ) . '">';
                        dynamic_sidebar( 'footer-' . $num );
                        print '</div>';
                    }
                ?>
         </div>
      </div>
   </div>
   <?php endif; ?>
   <!-- footer area end -->
   <div class="tp-copyright-4__area tp-copyright-4__bdr-top pt-20 pb-20">
      <div class="container">
         <div class="row">
            <div class="col-xl-12">
               <div class="tp-copyright-4__text text-center">
                  <span><?php print diego_copyright_text(); ?></span>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>

</footer>