<?php 

   /**
    * Template part for displaying header side information
    *
    * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
    *
    * @package diego
   */

   $diego_offcanvas_logo_white = get_theme_mod( 'diego_offcanvas_logo_white', get_template_directory_uri() . '/assets/img/logo/logo.png' );
   $diego_offcanvas_logo_black = get_theme_mod( 'diego_offcanvas_logo_black', get_template_directory_uri() . '/assets/img/logo/logo-black.png' );
   $diego_offcanvas_logo_width = get_theme_mod( 'diego_offcanvas_logo_width', '120');
   // offcanvas Default Menu
   $offcanvas_content = get_theme_mod( 'diego_offcanvas_content', false );



   // offcanvas btn
   $diego_offcanvas_btn_text = get_theme_mod( 'diego_offcanvas_btn_text', __( '+61404093 954', 'diego' ) );
   $diego_offcanvas_btn_url = get_theme_mod( 'diego_offcanvas_btn_url', __( '+61404093 954', 'diego' ) );

   // offcanvas mail
   $diego_offcanvas_mail_text = get_theme_mod( 'diego_offcanvas_mail_text', __( ' hello contact@diego.com', 'diego' ) );
   $diego_offcanvas_mail_url = get_theme_mod( 'diego_offcanvas_mail_url', __( 'contact@diego.com', 'diego' ) );

   // offcanvas address
   $diego_offcanvas_address_text = get_theme_mod( 'diego_offcanvas_address_text', __( 'Avenue de Roma 158b, Lisboa', 'diego' ) );
   $diego_offcanvas_address_url = get_theme_mod( 'diego_offcanvas_address_url', __( '#', 'diego' ) );

   $diego_offcanvas_welcome_text = get_theme_mod( 'diego_offcanvas_welcome_text', __( 'Hello There!', 'diego' ) );
   $diego_offcanvas_short_desc = get_theme_mod( 'diego_offcanvas_short_desc', __( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit,', 'diego' ) );

   $diego_offcanvas_contact_title = get_theme_mod( 'diego_offcanvas_contact_title', __( 'Information', 'diego' ) );
   $diego_offcanvas_social_title = get_theme_mod( 'diego_offcanvas_social_title', __( 'Follow Us', 'diego' ) );
?>

<div class="tp-offcanvas-area-2 tp-menu-2">
      <div class="tp-offcanvas-shape">
         <img class="tp-offcanvas-shape-2" src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/img/offcanvas/bg-shape-3.png" alt="">
      </div>
      <div class="tp-offcanvas-circle-1">
         <span></span>
      </div>
      <div class="tp-offcanvas-circle-2">
         <span></span>
      </div>
      <div class="tp-offcanvas-wrapper">
         <div class="tp-offcanvas-top-2 d-flex align-items-center justify-content-between">
            <div class="tp-offcanvas-logo-2">
                  <img class="logo-white" data-width="<?php echo esc_attr($diego_offcanvas_logo_width); ?>" src="<?php echo esc_url($diego_offcanvas_logo_white); ?>" alt="<?php echo esc_attr__('logo', 'diego'); ?>">
                  <img class="logo-black" data-width="<?php echo esc_attr($diego_offcanvas_logo_width); ?>" src="<?php echo esc_url($diego_offcanvas_logo_black); ?>" alt="<?php echo esc_attr__('logo', 'diego'); ?>">
            </div>
            <div class="tp-offcanvas-close-2">
               <button class="tp-offcanvas-close-btn-2 tp-offcanvas-open-btn-2">
                  <svg width="37" height="38" viewBox="0 0 37 38" fill="none" xmlns="http://www.w3.org/2000/svg">
                     <path d="M9.19141 9.80762L27.5762 28.1924" stroke="currentColor" stroke-width="1.5"
                        stroke-linecap="round" stroke-linejoin="round" />
                     <path d="M9.19141 28.1924L27.5762 9.80761" stroke="currentColor" stroke-width="1.5"
                        stroke-linecap="round" stroke-linejoin="round" />
                  </svg>
               </button>
            </div>
         </div>
         <div class="tp-offcanvas-main-2">
         <?php if($offcanvas_content) : ?>
            <div class="tp-offcanvas-content-2">
               <?php if(!empty($diego_offcanvas_welcome_text)) : ?>
               <h3 class="tp-offcanvas-content-title-2"><?php echo esc_html($diego_offcanvas_welcome_text); ?></h3>
               <?php endif; ?>

               <?php if(!empty($diego_offcanvas_short_desc)) : ?>
               <p><?php echo esc_html($diego_offcanvas_short_desc); ?></p>
               <?php endif; ?>
            </div>
            <?php endif; ?>
            <div class="tp-main-menu-mobile d-lg-none">
               <nav></nav>
            </div>
            <?php if($offcanvas_content) : ?>

            <div class="tp-offcanvas-contact-2">
               <h3 class="tp-offcanvas-contact-title-2"><?php echo esc_html($diego_offcanvas_contact_title); ?></h3>

               <ul>
               <?php if(!empty($diego_offcanvas_btn_text)) : ?>
                  <li><a href="tel:<?php echo esc_url($diego_tel_link); ?>"><?php echo esc_html($diego_offcanvas_btn_text); ?></a></li>
                  <?php endif; ?>
                  <?php if(!empty($diego_offcanvas_mail_text)) : ?>
                  <li><a href="mailto:<?php echo esc_url($diego_offcanvas_mail_url); ?>"><?php echo esc_html($diego_offcanvas_mail_text) ?></a></li>
                  <?php endif; ?>
                  <?php if(!empty($diego_offcanvas_address_text)) : ?>
                  <li><a href="<?php echo esc_html($diego_offcanvas_address_url) ?>"><?php echo esc_html($diego_offcanvas_address_text) ?></a></li>
                  <?php endif; ?>
               </ul>
            </div>
            <div class="tp-offcanvas-social-2">
               <h3 class="tp-offcanvas-contact-title-2"><?php echo esc_html($diego_offcanvas_social_title); ?></h3>
               <?php echo diego_offcanvas_social_profiles_2(); ?>
            </div>
            <?php endif; ?>
         </div>
      </div>
   </div>