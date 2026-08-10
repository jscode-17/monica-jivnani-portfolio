<?php
use function TPCore\Widgets\tp_implode_html_attributes;
include_once(TPCORE_ADDONS_DIR . '/include/common-functions.php');
?>
<!-- offcanvas area end -->
<div class="tp-offcanvas-area tp-offcanvas-update-bg-2">
   <div class="tp-offcanvas-bg is-left"></div>
   <div class="tp-offcanvas-bg is-right d-none d-md-block">
      <?php if ($settings['tp_offcanvas_shape_switch'] == 'yes'): ?>
         <div class="tp-offcanvas-shape">
            <img class="tp-offcanvas-shape-1"
               src="<?php echo get_template_directory_uri(); ?>/assets/img/offcanvas/bg-shape-2.png" alt="">
         </div>
      <?php endif; ?>

   </div>
   <div class="tp-offcanvas-wrapper-2">
      <div class="tp-offcanvas-left">
         <div class="tp-offcanvas-left-wrap d-flex justify-content-between align-items-center">
            <div class="tpoffcanvas__logo">
               <a href="<?php print esc_url(home_url('/')); ?>">
                  <img class="logo-white" src="<?php echo esc_url($tp_side_logo); ?>"
                     alt="<?php echo esc_attr($tp_side_logo_alt); ?>">
                  <img class="logo-black" src="<?php echo esc_url($tp_side_logo_black); ?>"
                     alt="<?php echo esc_attr($tp_side_logo_black_alt); ?>">
               </a>
            </div>
            <div class="tp-offcanvas-close d-md-none text-end">
               <button class="tp-offcanvas-close-btn tp-offcanvas-close-btn">
                  <span class="text">
                     <span><?php echo esc_html__('close', 'diego'); ?></span>
                  </span>

                  <span class="d-inline-block">
                     <span>
                        <svg width="38" height="38" viewBox="0 0 38 38" fill="none" xmlns="http://www.w3.org/2000/svg">
                           <path d="M9.80859 9.80762L28.1934 28.1924" stroke="currentColor" stroke-width="1.5"
                              stroke-linecap="round" stroke-linejoin="round" />
                           <path d="M9.80859 28.1924L28.1934 9.80761" stroke="currentColor" stroke-width="1.5"
                              stroke-linecap="round" stroke-linejoin="round" />
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
                     <svg width="38" height="38" viewBox="0 0 38 38" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M9.80859 9.80762L28.1934 28.1924" stroke="currentColor" stroke-width="1.5"
                           stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M9.80859 28.1924L28.1934 9.80761" stroke="currentColor" stroke-width="1.5"
                           stroke-linecap="round" stroke-linejoin="round" />
                     </svg>
                  </span>
               </span>

            </button>
         </div>

         <div class="tp-offcanvas-right-inner d-flex flex-column justify-content-between h-100">

            <div class="tpoffcanvas__right-info">
               <?php if (!empty($settings['tp_offcanvas_phone'])): ?>
                  <div class="tpoffcanvas__tel">
                     <a
                        href="<?php echo esc_url($settings['tp_offcanvas_phone_url']['url']); ?>"><?php echo esc_html($settings['tp_offcanvas_phone']); ?></a>
                  </div>
               <?php endif; ?>

               <?php if (!empty($settings['tp_offcanvas_mail'])): ?>
                  <div class="tpoffcanvas__mail">
                     <a
                        href="mailto:<?php echo esc_url($settings['tp_offcanvas_mail_url']['url']); ?>"><?php echo esc_html($settings['tp_offcanvas_mail']); ?></a>
                  </div>
               <?php endif; ?>

               <?php if (!empty($settings['tp_offcanvas_contact_desc'])): ?>
                  <div class="tpoffcanvas__text">
                     <p><?php echo esc_html($settings['tp_offcanvas_contact_desc']); ?></p>
                  </div>
               <?php endif; ?>
            </div>

            <div class="tpoffcanvas__social-link">
               <ul>
                  <?php foreach ($settings['tp_social_list'] as $key => $item):
                     $link = !empty($item['tp_social_url']['url']) ? $item['tp_social_url']['url'] : '';
                     $target = !empty($item['tp_social_url']['is_external']) ? '_blank' : '';
                     $rel = !empty($item['tp_social_url']['nofollow']) ? 'nofollow' : '';

                     $attrs = array(
                        'href' => $link,
                        'target' => $target,
                        'rel' => $rel,
                     );
                     ?>
                     <?php if (!empty($item['tp_social_text'])): ?>
                        <li>
                           <a <?php echo tp_implode_html_attributes($attrs); ?>><?php echo esc_html($item['tp_social_text']); ?></a>
                        </li>
                     <?php endif; ?>
                  <?php endforeach; ?>
               </ul>
            </div>
         </div>
      </div>
   </div>
</div>
<!-- offcanvas area start -->