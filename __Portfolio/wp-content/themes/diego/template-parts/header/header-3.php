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


   // main header settings
   $diego_header_hamburger   = get_theme_mod( 'diego_header_hamburger', false );
   $header_right_switch      = get_theme_mod( 'header_right_switch', false );
   $diego_menu_col           = $header_right_switch ? 'col-xl-7 d-none d-xl-block' : 'col-xl-10 d-none d-xl-block';
   $diego_menu_align         = $header_right_switch ? 'text-center' : 'text-end';
?>


<div class="tp-header-4__menu text-center">
   <nav class="tp-main-menu-content menu-hover-active counter-row">
   <?php diego_header_menu();?>
   </nav>
</div>

   <!-- header area start -->
   <header>
      <div class="tp-header-2__area tp-header-2__plr tp-header-2__transparent ">
         <div class="container-fluid">
            <div class="row align-items-center">
               <div class="col-xl-2 col-lg-5 col-md-4 col-6">
                  <div class="tp-header-2__logo">
                     <?php diego_header_logo(); ?>
                  </div>
               </div>
               <div class="col-xl-7 d-none d-xl-block">
                  <div class="tp-header-2__main-menu text-center">
                     <nav id="onePageMenu">
                        <?php diego_header_onepage_menu();?>
                     </nav>

                  </div>
               </div>
               <div class="col-xl-3 col-lg-7 col-md-8 col-6">
                  <div class="tp-header-2__right-box d-flex align-items-center justify-content-end">

                  <?php if(!empty($diego_tel_text)) : ?>
                     <div class="tp-header-2__maito d-none d-sm-block">
                        <span>
                           <svg width="18" height="16" viewBox="0 0 18 16" fill="none"
                              xmlns="http://www.w3.org/2000/svg">
                              <path
                                 d="M13.0005 14.6H5.00049C2.60049 14.6 1.00049 13.4 1.00049 10.6V5C1.00049 2.2 2.60049 1 5.00049 1L13.0005 1C15.4005 1 17.0005 2.2 17.0005 5V10.6C17.0005 13.4 15.4005 14.6 13.0005 14.6Z"
                                 stroke="currentcolor" stroke-opacity="0.8" stroke-width="1.5" stroke-miterlimit="10"
                                 stroke-linecap="round" stroke-linejoin="round" />
                              <path
                                 d="M13.0005 5.39984L10.4965 7.39984C9.67248 8.05584 8.32048 8.05584 7.49648 7.39984L5.00049 5.39984"
                                 stroke="currentcolor" stroke-opacity="0.8" stroke-width="1.5" stroke-miterlimit="10"
                                 stroke-linecap="round" stroke-linejoin="round" />
                           </svg>
                        </span>
                        <a href="<?php echo esc_url($diego_tel_link); ?>"> <?php echo esc_html($diego_tel_text); ?></a>
                     </div>
                     <?php endif; ?>

                     <div class="tp-header-2__bar parallax-wrap">
                        <button class="tp-menu-bar parallax-element tp-offcanvas-open-btn">
                           <i>
                              <span></span>
                              <span></span>
                           </i>
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