<?php 

	/**
	 * Template part for displaying header layout one
	 *
	 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
	 *
	 * @package diego
	*/
	$diego_transparent_header = get_theme_mod( 'diego_transparent_header', false );
	$is_transparent_header = function_exists( 'tpmeta_field' ) ? tpmeta_field( 'enable_transparent_header' ) : NULL;
	
	
	$diego_sticky_switch = get_theme_mod( 'diego_sticky_switch', false );
	$enable_sticky = !empty($diego_sticky_switch) ? 'header__sticky' : '';
 
 
	$diego_tel_link   = get_theme_mod( 'diego_tel_link', __( '#', 'diego' ) );
	$diego_tel_text   = get_theme_mod( 'diego_tel_text', __( "Let's Talk", 'diego' ) );
 
	$header_cv_button_url   = get_theme_mod( 'header_cv_button_url', __( '#', 'diego' ) );
 
 
	// main header settings
	$diego_header_hamburger   = get_theme_mod( 'diego_header_hamburger', false );
	$header_right_switch      = get_theme_mod( 'header_right_switch', false );
	$diego_menu_col           = $header_right_switch ? 'col-xl-6 col-lg-7 d-none d-lg-block' : 'col-lg-10 d-none d-lg-block';
	$diego_menu_align         = $header_right_switch ? '' : 'd-flex align-items-center justify-content-end';

?>

      <!-- header area start -->
      <header>
      <div class="tp-header-3__area tp-header-transparent tp-header-3__ptlr slider-pt">
         <div class="container container-1720">
            <div class="row align-items-center">
               <div class="col-xl-6 col-lg-6 col-md-6 col-6">
                  <div class="tp-header-3__logo">
                  <?php diego_header_single_logo(); ?>
                  </div>
               </div>
               <div class="col-xl-6 d-none">
                  <div class="tp-header-4__menu text-center">
                     <nav class="tp-main-menu-content counter-row">
                     <?php diego_header_menu();?>
                     </nav>
                  </div>
               </div>
               <div class="col-xl-6 col-lg-6 col-md-6 col-6">
                  <div class="tp-header-3__right-action d-flex align-items-center justify-content-end">
                     <div class="tp-header-3__bar tp-magnetic-wrap">
                        <button class="tp-menu-bar tp-offcanvas-open-btn tp-magnetic-item not-hide-cursor tp-toggle-btn-box">
                           <svg width="32" height="10" viewBox="0 0 32 10" fill="none"
                              xmlns="http://www.w3.org/2000/svg">
                              <path d="M31 1H1" stroke="currentcolor" stroke-width="2" stroke-linecap="round" />
                              <path d="M31 9H1" stroke="currentcolor" stroke-width="2" stroke-linecap="round" />
                           </svg>
                        </button>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </header>
   <!-- header area end -->

   <?php do_action( 'diego_offcanvas_style' );?>