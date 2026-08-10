<?php
namespace TPCore\Widgets;

?>

<div class="tp-offcanvas-area-2 tp-menu-2">
   <?php if ($settings['tp_offcanvas_shape_switch'] == 'yes'): ?>
      <div class="tp-offcanvas-shape">
         <img class="tp-offcanvas-shape-2"
            src="<?php echo get_template_directory_uri(); ?>/assets/img/offcanvas/bg-shape-3.png"
            alt="<?php echo esc_attr__('diego', 'tpcore'); ?>">
      </div>
      <div class="tp-offcanvas-circle-1">
         <span></span>
      </div>
      <div class="tp-offcanvas-circle-2">
         <span></span>
      </div>
   <?php endif; ?>
   <div class="tp-offcanvas-wrapper">
      <div class="tp-offcanvas-top-2 d-flex align-items-center justify-content-between">
         <div class="tp-offcanvas-logo-2">
            <a href="<?php print esc_url(home_url('/')); ?>">
               <img class="logo-white" src="<?php echo esc_url($tp_side_logo); ?>"
                  alt="<?php echo esc_attr($tp_side_logo_alt); ?>">
               <img class="logo-black" src="<?php echo esc_url($tp_side_logo_black); ?>"
                  alt="<?php echo esc_attr($tp_side_logo_black_alt); ?>">
            </a>
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

         <div class="tp-offcanvas-content-2">
            <?php if (!empty($settings['tp_offcanvas_welcome_text'])): ?>
               <h3 class="tp-offcanvas-content-title-2"><?php echo esc_html($settings['tp_offcanvas_welcome_text']); ?>
               </h3>
            <?php endif; ?>

            <?php if (!empty($settings['tp_offcanvas_welcome_desc'])): ?>
               <p><?php echo esc_html($settings['tp_offcanvas_welcome_desc']); ?></p>
            <?php endif; ?>
         </div>

         <div class="tp-main-menu-mobile d-lg-none">
            <nav></nav>
         </div>

         <?php if (count($settings['tp_portfolio_thumb_list']) > 0): ?>
            <div class="tp-offcanvas-gallery">
               <div class="row gx-2">
                  <?php foreach ($settings['tp_portfolio_thumb_list'] as $key => $item):
                     if (!empty($item['tp_portfolio_image']['url'])) {
                        $tp_portfolio_image = !empty($item['tp_portfolio_image']['id']) ? wp_get_attachment_image_url($item['tp_portfolio_image']['id'], $settings['tp_portfolio_size_size']) : $item['tp_portfolio_image']['url'];
                        $tp_portfolio_image_alt = get_post_meta($item["tp_portfolio_image"]["id"], "_wp_attachment_image_alt", true);
                     }
                     ?>
                     <div class="col-md-3 col-3">
                        <?php if (!empty($tp_portfolio_image)): ?>
                           <div class="tp-offcanvas-gallery-img fix">

                              <?php if (!empty($item['tp_portfolio_image_url'])): ?>
                                 <a href="<?php echo esc_url($item['tp_portfolio_image_url']); ?>">
                                 <?php endif; ?>

                                 <img src="<?php echo esc_url($tp_portfolio_image); ?>"
                                    alt="<?php echo esc_attr($tp_portfolio_image_alt); ?>">

                                 <?php if (!empty($item['tp_portfolio_image_url'])): ?>
                                 </a>
                              <?php endif; ?>
                           </div>
                        <?php endif; ?>
                     </div>
                  <?php endforeach; ?>
               </div>
            </div>
         <?php endif; ?>

         <div class="tp-offcanvas-contact-2">
            <?php if (!empty($settings['tp_contact_main_title'])): ?>
               <h3 class="tp-offcanvas-contact-title-2"><?php echo esc_html($settings['tp_contact_main_title']); ?></h3>
            <?php endif; ?>
            <ul>

               <?php
               $phone_link = !empty($settings['tp_offcanvas_phone_url']['url']) ? $settings['tp_offcanvas_phone_url']['url'] : '';
               $phone_target = !empty($settings['tp_offcanvas_phone_url']['is_external']) ? '_blank' : '';
               $phone_rel = !empty($settings['tp_offcanvas_phone_url']['nofollow']) ? 'nofollow' : '';

               $phone_attrs = array(
                  'href' => $phone_link,
                  'target' => $phone_target,
                  'rel' => $phone_rel,
               );

               $mail_link = !empty($settings['tp_offcanvas_mail_url']['url']) ? $settings['tp_offcanvas_mail_url']['url'] : '';
               $mail_target = !empty($settings['tp_offcanvas_mail_url']['is_external']) ? '_blank' : '';
               $mail_rel = !empty($settings['tp_offcanvas_mail_url']['nofollow']) ? 'nofollow' : '';

               $mail_attrs = array(
                  'href' => $mail_link,
                  'target' => $mail_target,
                  'rel' => $mail_rel,
               );

               $address_link = !empty($settings['tp_offcanvas_address_url']['url']) ? $settings['tp_offcanvas_address_url']['url'] : '';
               $address_target = !empty($settings['tp_offcanvas_address_url']['is_external']) ? '_blank' : '';
               $address_rel = !empty($settings['tp_offcanvas_address_url']['nofollow']) ? 'nofollow' : '';

               $address_attrs = array(
                  'href' => $address_link,
                  'target' => $address_target,
                  'rel' => $address_rel,
               );

               ?>

               <?php if (!empty($settings['tp_offcanvas_phone'])): ?>
                  <li><a <?php echo tp_implode_html_attributes($phone_attrs); ?>><?php echo esc_html($settings['tp_offcanvas_phone']); ?></a></li>
               <?php endif; ?>
               <?php if (!empty($settings['tp_offcanvas_mail'])): ?>
                  <li><a <?php echo tp_implode_html_attributes($mail_attrs); ?>><?php echo esc_html($settings['tp_offcanvas_mail']); ?></a></li>
               <?php endif; ?>
               <?php if (!empty($settings['tp_offcanvas_address'])): ?>
                  <li><a <?php echo tp_implode_html_attributes($address_attrs); ?>><?php echo esc_html($settings['tp_offcanvas_address']); ?></a></li>
               <?php endif; ?>
            </ul>
         </div>
         <div class="tp-offcanvas-social-2">

            <?php if (!empty($settings['tp_social_main_title'])): ?>
               <h3 class="tp-offcanvas-contact-title-2"><?php echo esc_html($settings['tp_social_main_title']); ?></h3>
            <?php endif; ?>

            <ul>

               <?php foreach ($settings['tp_social_list'] as $key => $item):

                  $link = !empty($item['tp_social_link']['url']) ? $item['tp_social_link']['url'] : '';
                  $target = !empty($item['tp_social_link']['is_external']) ? '_blank' : '';
                  $rel = !empty($item['tp_social_link']['nofollow']) ? 'nofollow' : '';

                  $attrs = array(
                     'href' => $link,
                     'target' => $target,
                     'rel' => $rel,
                  );

                  ?>
                  <li>
                     <a <?php echo tp_implode_html_attributes($attrs); ?>>
                        <?php if ($item['tp_box_icon_type'] == 'icon'): ?>
                           <?php if (!empty($item['tp_box_icon']) || !empty($item['tp_box_selected_icon']['value'])): ?>
                              <span><?php tp_render_icon($item, 'tp_box_icon', 'tp_box_selected_icon'); ?></span>
                           <?php endif; ?>
                        <?php elseif ($item['tp_box_icon_type'] == 'image'): ?>
                           <span>
                              <?php if (!empty($item['tp_box_icon_image']['url'])): ?>
                                 <img src="<?php echo $item['tp_box_icon_image']['url']; ?>"
                                    alt="<?php echo get_post_meta(attachment_url_to_postid($item['tp_box_icon_image']['url']), '_wp_attachment_image_alt', true); ?>">
                              <?php endif; ?>
                           </span>
                        <?php else: ?>
                           <span>
                              <?php if (!empty($item['tp_box_icon_svg'])): ?>
                                 <?php echo $item['tp_box_icon_svg']; ?>
                              <?php endif; ?>
                           </span>
                        <?php endif; ?>
                     </a>
                  </li>
               <?php endforeach; ?>
            </ul>
         </div>

      </div>
   </div>
</div>

<div class="tp-offcanvas-blur-overlay"></div>