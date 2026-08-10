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
      <div class="tp-header-area tp-header-mob-space tp-header-transparent p-relative">
         <span class="tp-header-border"></span>
         <div class="container container-large">
            <div class="row align-items-center">
               <div class="col-xl-2 col-lg-2 col-md-4 col-6">
                  <div class="logo">
                     <?php diego_header_logo(); ?>
                  </div>
               </div>
               <div class="<?php echo esc_attr($diego_menu_col); ?>">
                  <div class="main-menu header-menu-main <?php echo esc_attr($diego_menu_align); ?>">
                     <nav class="tp-main-menu-content">
                     <?php diego_header_menu();?>
                     </nav>
                  </div>
               </div>

               <?php if ( $header_right_switch == false): ?>
                  <div class="col-md-8 col-6 d-lg-none">
                     <div class="tp-header-hamburger ml-20 text-end">
                        <button class="tp-hamburger-btn tp-hamburger-btn-white tp-menu-bar tp-offcanvas-open-btn-2"
                           type="button">
                           <span></span>
                        </button>
                     </div>
                  </div>
                  <?php endif; ?>

               <?php if ( $header_right_switch ): ?>
               <div class="col-xl-4 col-lg-3 col-md-7 col-6">
                  <div class="tp-header-right d-flex align-items-center justify-content-end">

                     <div class="tp-theme-toggle ">
                        <label class="tp-theme-toggle-main themepure-theme-toggle" for="this-s">
                           <span class=" tp-theme-toggle-light">
                              <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                 <path
                                    d="M8.0448 11.0454C9.70165 11.0454 11.0448 9.7023 11.0448 8.04544C11.0448 6.38859 9.70165 5.04544 8.0448 5.04544C6.38795 5.04544 5.0448 6.38859 5.0448 8.04544C5.0448 9.7023 6.38795 11.0454 8.0448 11.0454Z"
                                    fill="currentColor" />
                                 <path d="M8 1.5V2.68182" stroke="currentColor" stroke-width="1.5"
                                    stroke-linecap="round" stroke-linejoin="round" />
                                 <path d="M8 13.3182V14.5" stroke="currentColor" stroke-width="1.5"
                                    stroke-linecap="round" stroke-linejoin="round" />
                                 <path d="M3.40198 3.40277L4.24107 4.24186" stroke="currentColor" stroke-width="1.5"
                                    stroke-linecap="round" stroke-linejoin="round" />
                                 <path d="M11.7584 11.7581L12.5975 12.5972" stroke="currentColor" stroke-width="1.5"
                                    stroke-linecap="round" stroke-linejoin="round" />
                                 <path d="M1.5 8H2.68182" stroke="currentColor" stroke-width="1.5"
                                    stroke-linecap="round" stroke-linejoin="round" />
                                 <path d="M13.3174 8H14.4992" stroke="currentColor" stroke-width="1.5"
                                    stroke-linecap="round" stroke-linejoin="round" />
                                 <path d="M3.40198 12.5972L4.24107 11.7581" stroke="currentColor" stroke-width="1.5"
                                    stroke-linecap="round" stroke-linejoin="round" />
                                 <path d="M11.7584 4.24186L12.5975 3.40277" stroke="currentColor" stroke-width="1.5"
                                    stroke-linecap="round" stroke-linejoin="round" />
                              </svg>
                           </span>
                           <input type="checkbox" class="themepure-theme-toggle-input" id="this-s">
                           <i class="tp-theme-toggle-slide"></i>
                           <span class="tp-theme-toggle-dark">
                              <svg width="12" height="12" viewBox="0 0 12 12" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                 <path
                                    d="M12 6.54054C11.8949 7.67776 11.4681 8.76152 10.7696 9.66503C10.071 10.5685 9.12957 11.2544 8.05544 11.6424C6.9813 12.0304 5.81888 12.1044 4.70419 11.8559C3.5895 11.6073 2.56866 11.0465 1.7611 10.2389C0.953538 9.43135 0.39267 8.4105 0.144121 7.29581C-0.104428 6.18112 -0.0303768 5.0187 0.357609 3.94457C0.745595 2.87043 1.43147 1.929 2.33497 1.23045C3.23848 0.531888 4.32224 0.105093 5.45946 0C4.79365 0.900756 4.47327 2.01056 4.55656 3.12758C4.63986 4.24459 5.12132 5.2946 5.91336 6.08664C6.7054 6.87869 7.75541 7.36014 8.87242 7.44344C9.98944 7.52673 11.0992 7.20635 12 6.54054Z"
                                    fill="currentColor" />
                              </svg>
                           </span>
                        </label>
                     </div>

                     <?php if ( $header_cv_button_url ): ?>
                     <div class="tp-header-cv ml-10 d-none d-md-block">
                        <a class="tp-header-cv-btn" href="<?php echo esc_url($header_cv_button_url); ?>">
                           <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                              xmlns="http://www.w3.org/2000/svg">
                              <path d="M1 8C1 11.866 4.13401 15 8 15C11.866 15 15 11.866 15 8" stroke="currentColor"
                                 stroke-width="1.5" stroke-linecap="round" />
                              <path d="M8 1L8 9.75M8 9.75L10.625 7.125M8 9.75L5.375 7.125" stroke="currentColor"
                                 stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                           </svg>
                        </a>
                     </div>
                     <?php endif; ?>

                     <?php if($diego_header_hamburger) : ?>
                     <div class="tp-header-hamburger ml-20">
                        <button class="tp-hamburger-btn tp-hamburger-btn-white tp-menu-bar tp-offcanvas-open-btn-2"
                           type="button">
                           <span></span>
                        </button>
                     </div>
                     <?php endif; ?>
                  </div>
               </div>
               <?php endif; ?>
            </div>
         </div>
      </div>
   </header>
   <!-- header area end -->

   <!-- header area start -->
   <header>
      <div class="tp-header-area tp-header-mob-space tp-header-transparent p-relative tp-int-menu tp-header-sticky-cloned">
         <div class="container container-large">
            <div class="row align-items-center">
               <div class="col-xl-2 col-lg-2 col-md-5 col-6">
                  <div class="logo">
                     <?php diego_header_logo(); ?>
                  </div>
               </div>
               <div class="<?php echo esc_attr($diego_menu_col); ?>">
                  <div class="main-menu header-menu-sticky <?php echo esc_attr($diego_menu_align); ?>">
                     <nav class="tp-main-menu-content">
                        <?php diego_header_menu();?>
                     </nav>
                  </div>
               </div>
               <?php if ( $header_right_switch == false): ?>
                  <div class="col-md-8 col-6 d-lg-none">
                     <div class="tp-header-hamburger ml-20 text-end">
                        <button class="tp-hamburger-btn tp-hamburger-btn-white tp-menu-bar tp-offcanvas-open-btn-2"
                           type="button">
                           <span></span>
                        </button>
                     </div>
                  </div>
                  <?php endif; ?>

                  <?php if ( $header_right_switch ): ?>
               <div class="col-xl-4 col-lg-3 col-md-7 col-6">
                  <div class="tp-header-right d-flex align-items-center justify-content-end">
                     <div class="tp-theme-toggle ">
                        <label class="tp-theme-toggle-main themepure-theme-toggle" for="this-ss">
                           <span id="tp-theme-toggle-light" class=" tp-theme-toggle-light">
                              <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                 <path
                                    d="M8.0448 11.0454C9.70165 11.0454 11.0448 9.7023 11.0448 8.04544C11.0448 6.38859 9.70165 5.04544 8.0448 5.04544C6.38795 5.04544 5.0448 6.38859 5.0448 8.04544C5.0448 9.7023 6.38795 11.0454 8.0448 11.0454Z"
                                    fill="currentColor" />
                                 <path d="M8 1.5V2.68182" stroke="currentColor" stroke-width="1.5"
                                    stroke-linecap="round" stroke-linejoin="round" />
                                 <path d="M8 13.3182V14.5" stroke="currentColor" stroke-width="1.5"
                                    stroke-linecap="round" stroke-linejoin="round" />
                                 <path d="M3.40198 3.40277L4.24107 4.24186" stroke="currentColor" stroke-width="1.5"
                                    stroke-linecap="round" stroke-linejoin="round" />
                                 <path d="M11.7584 11.7581L12.5975 12.5972" stroke="currentColor" stroke-width="1.5"
                                    stroke-linecap="round" stroke-linejoin="round" />
                                 <path d="M1.5 8H2.68182" stroke="currentColor" stroke-width="1.5"
                                    stroke-linecap="round" stroke-linejoin="round" />
                                 <path d="M13.3174 8H14.4992" stroke="currentColor" stroke-width="1.5"
                                    stroke-linecap="round" stroke-linejoin="round" />
                                 <path d="M3.40198 12.5972L4.24107 11.7581" stroke="currentColor" stroke-width="1.5"
                                    stroke-linecap="round" stroke-linejoin="round" />
                                 <path d="M11.7584 4.24186L12.5975 3.40277" stroke="currentColor" stroke-width="1.5"
                                    stroke-linecap="round" stroke-linejoin="round" />
                              </svg>
                           </span>
                           <input id="this-ss" type="checkbox" class="themepure-theme-toggle-input">
                           <i class="tp-theme-toggle-slide"></i>
                           <span id="tp-theme-toggle-dark" class="tp-theme-toggle-dark">
                              <svg width="12" height="12" viewBox="0 0 12 12" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                 <path
                                    d="M12 6.54054C11.8949 7.67776 11.4681 8.76152 10.7696 9.66503C10.071 10.5685 9.12957 11.2544 8.05544 11.6424C6.9813 12.0304 5.81888 12.1044 4.70419 11.8559C3.5895 11.6073 2.56866 11.0465 1.7611 10.2389C0.953538 9.43135 0.39267 8.4105 0.144121 7.29581C-0.104428 6.18112 -0.0303768 5.0187 0.357609 3.94457C0.745595 2.87043 1.43147 1.929 2.33497 1.23045C3.23848 0.531888 4.32224 0.105093 5.45946 0C4.79365 0.900756 4.47327 2.01056 4.55656 3.12758C4.63986 4.24459 5.12132 5.2946 5.91336 6.08664C6.7054 6.87869 7.75541 7.36014 8.87242 7.44344C9.98944 7.52673 11.0992 7.20635 12 6.54054Z"
                                    fill="currentColor" />
                              </svg>
                           </span>
                        </label>
                     </div>

                  <?php if ( $header_cv_button_url ): ?>
                     <div class="tp-header-cv ml-10 d-none d-md-block">
                        <a class="tp-header-cv-btn" href="<?php echo esc_url($header_cv_button_url); ?>">
                           <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                              xmlns="http://www.w3.org/2000/svg">
                              <path d="M1 8C1 11.866 4.13401 15 8 15C11.866 15 15 11.866 15 8" stroke="currentColor"
                                 stroke-width="1.5" stroke-linecap="round" />
                              <path d="M8 1L8 9.75M8 9.75L10.625 7.125M8 9.75L5.375 7.125" stroke="currentColor"
                                 stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                           </svg>
                        </a>
                     </div>
                     <?php endif; ?>

                     <?php if($diego_header_hamburger) : ?>
                     <div class="tp-header-hamburger ml-20">
                        <button class="tp-hamburger-btn tp-hamburger-btn-white tp-menu-bar tp-offcanvas-open-btn-2"
                           type="button">
                           <span></span>
                        </button>
                     </div>
                     <?php endif; ?>
                  </div>
               </div>
               <?php endif; ?>
            </div>
         </div>
      </div>
   </header>
   <!-- header area end -->

      <?php do_action( 'diego_offcanvas_style' );?>