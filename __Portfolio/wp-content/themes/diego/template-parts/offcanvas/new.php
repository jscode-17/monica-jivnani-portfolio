         <!-- offcanvas area end -->
         <div class="tp-offcanvas-area">
      <div class="tp-offcanvas-bg is-left"></div>
      <div class="tp-offcanvas-bg is-right d-none d-md-block">
         <div class="tp-offcanvas-shape">
            <img class="tp-offcanvas-shape-1" src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/img/offcanvas/bg-shape-2.png" alt="">
         </div>
      </div>
      <div class="tp-offcanvas-wrapper-2">
         <div class="tp-offcanvas-left">
            <div class="tp-offcanvas-left-wrap d-flex justify-content-between align-items-center">
               <div class="tpoffcanvas__logo">
                  <img class="logo-white" data-width="<?php echo esc_attr($diego_offcanvas_logo_width); ?>" src="<?php echo esc_url($diego_offcanvas_logo_white); ?>" alt="<?php echo esc_attr__('logo', 'diego'); ?>">
                  <img class="logo-black" data-width="<?php echo esc_attr($diego_offcanvas_logo_width); ?>" src="<?php echo esc_url($diego_offcanvas_logo_black); ?>" alt="<?php echo esc_attr__('logo', 'diego'); ?>">
               </div>
               <div class="tp-offcanvas-close d-md-none text-end">
                  <button class="tp-offcanvas-close-btn tp-offcanvas-close-btn">
                     <span class="text">
                        <span><?php echo esc_html__('close', 'diego'); ?></span>
                     </span>
   
                     <span class="d-inline-block">
                        <span>
                           <svg width="38" height="38" viewBox="0 0 38 38" fill="none" xmlns="http://www.w3.org/2000/svg">
                              <path d="M9.80859 9.80762L28.1934 28.1924" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                              <path d="M9.80859 28.1924L28.1934 9.80761" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                           </svg>
                        </span>
                     </span>
                  </button>
               </div>
            </div>
            <div class="tp-main-menu-mobile menu-hover-active counter-row">
               <nav></nav>
            </div>
         </div>
         <div class="tp-offcanvas-right d-none d-md-block">
            <div class="tp-offcanvas-close text-end">
               <button class="tp-offcanvas-close-btn tp-offcanvas-close-btn">
                  <span class="text">
                     <span><?php echo esc_html__('close', 'diego'); ?></span>
                  </span>

                  <span class="d-inline-block">
                     <span>
                        <svg width="38" height="38" viewBox="0 0 38 38" fill="none"
                           xmlns="http://www.w3.org/2000/svg">
                           <path d="M9.80859 9.80762L28.1934 28.1924" stroke="currentColor" stroke-width="1.5"
                              stroke-linecap="round" stroke-linejoin="round" />
                           <path d="M9.80859 28.1924L28.1934 9.80761" stroke="currentColor" stroke-width="1.5"
                              stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                     </span>
                  </span>
                  
               </button>
            </div>
            <?php if($offcanvas_content) : ?>
            <div class="tp-offcanvas-right-inner d-flex flex-column justify-content-between h-100">
               
               <div class="tpoffcanvas__right-info">
               <?php if(!empty($diego_offcanvas_btn_text)): ?>
                  <div class="tpoffcanvas__tel">
                     <a href="<?php echo esc_url($diego_offcanvas_btn_url); ?>"><?php echo esc_html($diego_offcanvas_btn_text) ?></a>
                  </div>
                  <?php endif; ?>
                  <?php if(!empty($diego_offcanvas_mail_text)): ?>
                  <div class="tpoffcanvas__mail">
                     <a href="mailto:<?php echo esc_url($diego_offcanvas_mail_url); ?>"><?php echo esc_html($diego_offcanvas_mail_text) ?></a>
                  </div>
                  <?php endif; ?>

                  <?php if(!empty($diego_offcanvas_short_desc)): ?>
                  <div class="tpoffcanvas__text">
                     <p><?php echo esc_html($diego_offcanvas_short_desc); ?></p>
                  </div>
                  <?php endif; ?>
               </div>
               
               <div class="tpoffcanvas__social-link">
                  <?php echo diego_offcanvas_social_profiles(); ?>
               </div>
            </div>
            <?php endif; ?>
         </div>
      </div>
   </div>
   <!-- offcanvas area start -->