<?php
namespace TPCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Utils;
use \Elementor\Control_Media;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Group_Control_Text_Shadow;
use \Elementor\Group_Control_Typography;
use \Elementor\Core\Schemes\Typography;
use \Elementor\Group_Control_Background;
use \Elementor\Repeater;


if (!defined('ABSPATH'))
   exit; // Exit if accessed directly

/**
 * Tp Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class TP_Footer_01 extends Widget_Base
{

   use \TPCore\Widgets\TPCoreElementFunctions;

   /**
    * Retrieve the widget name.
    *
    * @since 1.0.0
    *
    * @access public
    *
    * @return string Widget name.
    */
   public function get_name()
   {
      return 'tp-footer';
   }

   /**
    * Retrieve the widget title.
    *
    * @since 1.0.0
    *
    * @access public
    *
    * @return string Widget title.
    */
   public function get_title()
   {
      return __('Footer Builder', 'tpcore');
   }

   /**
    * Retrieve the widget icon.
    *
    * @since 1.0.0
    *
    * @access public
    *
    * @return string Widget icon.
    */
   public function get_icon()
   {
      return 'tp-icon';
   }

   /**
    * Retrieve the list of categories the widget belongs to.
    *
    * Used to determine where to display the widget in the editor.
    *
    * Note that currently Elementor supports only one category.
    * When multiple categories passed, Elementor uses the first one.
    *
    * @since 1.0.0
    *
    * @access public
    *
    * @return array Widget categories.
    */
   public function get_categories()
   {
      return ['tpcore'];
   }

   /**
    * Retrieve the list of scripts the widget depended on.
    *
    * Used to set scripts dependencies required to run the widget.
    *
    * @since 1.0.0
    *
    * @access public
    *
    * @return array Widget scripts dependencies.
    */
   public function get_script_depends()
   {
      return ['tpcore'];
   }


   /**
    * Menu index.
    *
    * @access protected
    * @var $nav_menu_index
    */
   protected $nav_menu_index = 1;

   /**
    * Retrieve the menu index.
    *
    * Used to get index of nav menu.
    *
    * @since 1.3.0
    * @access protected
    *
    * @return string nav index.
    */
   protected function get_nav_menu_index()
   {
      return $this->nav_menu_index++;
   }

   /**
    * Retrieve the list of available menus.
    *
    * Used to get the list of available menus.
    *
    * @since 1.3.0
    * @access private
    *
    * @return array get WordPress menus list.
    */
   private function get_available_menus()
   {

      $menus = wp_get_nav_menus();

      $options = [];

      foreach ($menus as $menu) {
         $options[$menu->slug] = $menu->name;
      }

      return $options;
   }



   protected static function get_profile_names()
   {
      return [
         '500px' => esc_html__('500px', 'tpcore'),
         'apple' => esc_html__('Apple', 'tpcore'),
         'behance' => esc_html__('Behance', 'tpcore'),
         'bitbucket' => esc_html__('BitBucket', 'tpcore'),
         'codepen' => esc_html__('CodePen', 'tpcore'),
         'delicious' => esc_html__('Delicious', 'tpcore'),
         'deviantart' => esc_html__('DeviantArt', 'tpcore'),
         'digg' => esc_html__('Digg', 'tpcore'),
         'dribbble' => esc_html__('Dribbble', 'tpcore'),
         'email' => esc_html__('Email', 'tpcore'),
         'facebook' => esc_html__('Facebook', 'tpcore'),
         'flickr' => esc_html__('Flicker', 'tpcore'),
         'foursquare' => esc_html__('FourSquare', 'tpcore'),
         'github' => esc_html__('Github', 'tpcore'),
         'houzz' => esc_html__('Houzz', 'tpcore'),
         'instagram' => esc_html__('Instagram', 'tpcore'),
         'jsfiddle' => esc_html__('JS Fiddle', 'tpcore'),
         'linkedin' => esc_html__('LinkedIn', 'tpcore'),
         'medium' => esc_html__('Medium', 'tpcore'),
         'pinterest' => esc_html__('Pinterest', 'tpcore'),
         'product-hunt' => esc_html__('Product Hunt', 'tpcore'),
         'reddit' => esc_html__('Reddit', 'tpcore'),
         'slideshare' => esc_html__('Slide Share', 'tpcore'),
         'snapchat' => esc_html__('Snapchat', 'tpcore'),
         'soundcloud' => esc_html__('SoundCloud', 'tpcore'),
         'spotify' => esc_html__('Spotify', 'tpcore'),
         'stack-overflow' => esc_html__('StackOverflow', 'tpcore'),
         'tripadvisor' => esc_html__('TripAdvisor', 'tpcore'),
         'tumblr' => esc_html__('Tumblr', 'tpcore'),
         'twitch' => esc_html__('Twitch', 'tpcore'),
         'twitter' => esc_html__('Twitter', 'tpcore'),
         'vimeo' => esc_html__('Vimeo', 'tpcore'),
         'vk' => esc_html__('VK', 'tpcore'),
         'website' => esc_html__('Website', 'tpcore'),
         'whatsapp' => esc_html__('WhatsApp', 'tpcore'),
         'wordpress' => esc_html__('WordPress', 'tpcore'),
         'xing' => esc_html__('Xing', 'tpcore'),
         'yelp' => esc_html__('Yelp', 'tpcore'),
         'youtube' => esc_html__('YouTube', 'tpcore'),
      ];
   }



   /**
    * Register the widget controls.
    *
    * Adds different input fields to allow the user to change and customize the widget settings.
    *
    * @since 1.0.0
    *
    * @access protected
    */

   protected function register_controls()
   {
      $this->register_controls_section();
      $this->style_tab_content();
   }

   protected function register_controls_section()
   {

      // layout Panel
      $this->start_controls_section(
         'tp_layout',
         [
            'label' => esc_html__('Design Layout', 'tpcore'),
         ]
      );
      $this->add_control(
         'tp_design_style',
         [
            'label' => esc_html__('Select Layout', 'tpcore'),
            'type' => Controls_Manager::SELECT,
            'options' => [
               'layout-1' => esc_html__('Layout 1', 'tpcore'),
            ],
            'default' => 'layout-1',
         ]
      );

      $this->end_controls_section();

      $this->start_controls_section(
         'tp_footer_sec',
         [
            'label' => esc_html__('Footer Contents', 'tpcore'),
            'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
         ]
      );

      $this->add_control(
         'tp_footer_title',
         [
            'label' => esc_html__('Footer Title', 'tpcore'),
            'type' => \Elementor\Controls_Manager::TEXT,
            'default' => esc_html__('Lets talk about ', 'tpcore'),
            'placeholder' => esc_html__('Your Text', 'tpcore'),
            'label_block' => true
         ]
      );
      $this->add_control(
         'copyright_text',
         [
            'label' => esc_html__('Copyright Text', 'tpcore'),
            'type' => \Elementor\Controls_Manager::TEXTAREA,
            'rows' => 10,
            'default' => esc_html__('©2024 Diego, All Rights Reserved • Credits', 'tpcore'),
            'placeholder' => esc_html__('Your Text', 'tpcore'),
         ]
      );
      $this->add_control(
         'copyright_right_text',
         [
            'label' => esc_html__('Footer Bottom Right', 'tpcore'),
            'type' => \Elementor\Controls_Manager::TEXT,
            'default' => esc_html__('2024 Portfolio ', 'tpcore'),
            'placeholder' => esc_html__('Your Text', 'tpcore'),
            'label_block' => true
         ]
      );

      $this->add_control(
         'footer_shape_switch',
         [
            'label' => esc_html__('Hide Shape ?', 'tpcore'),
            'type' => \Elementor\Controls_Manager::SWITCHER,
            'label_on' => esc_html__('Show', 'tpcore'),
            'label_off' => esc_html__('Hide', 'tpcore'),
            'return_value' => 'yes',
            'default' => 'yes',
         ]
      );
      $this->end_controls_section();

      $this->tp_button_render_controls('tpbtn', 'Button 1', ['layout-1']);
      $this->tp_button_render_controls('tpbtn2', 'Button 2', ['layout-1']);

      // _tp_image
      $this->start_controls_section(
         '_tp_image',
         [
            'label' => esc_html__('Background Image', 'tp-core'),
         ]
      );
      $this->add_control(
         'tp_image',
         [
            'label' => esc_html__('Choose Image', 'tp-core'),
            'type' => \Elementor\Controls_Manager::MEDIA,
            'default' => [
               'url' => \Elementor\Utils::get_placeholder_image_src(),
            ],
         ]
      );

      $this->add_group_control(
         Group_Control_Image_Size::get_type(),
         [
            'name' => 'thumbnail',
            'default' => 'full',
            'exclude' => [
               'custom'
            ]
         ]
      );
      $this->end_controls_section();

      // contact repeater start
      $this->start_controls_section(
         'tp_footer_social_sec',
         [
            'label' => esc_html__('Footer Social Info', 'tpcore'),
            'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
         ]
      );


      $repeater = new \Elementor\Repeater();

      $repeater->add_control(
         'repeater_condition',
         [
            'label' => __('Field condition', 'tpcore'),
            'type' => Controls_Manager::SELECT,
            'options' => [
               'style_1' => __('Style 1', 'tpcore'),
               'style_2' => __('Style 2', 'tpcore'),
            ],
            'default' => 'style_1',
            'frontend_available' => true,
            'style_transfer' => true,
         ]
      );


      $repeater->add_control(
         'tp_box_icon_type',
         [
            'label' => esc_html__('Select Icon Type', 'tpcore'),
            'type' => \Elementor\Controls_Manager::SELECT,
            'default' => 'icon',
            'options' => [
               'image' => esc_html__('Image', 'tpcore'),
               'icon' => esc_html__('Icon', 'tpcore'),
               'svg' => esc_html__('SVG', 'tpcore'),
            ],
            'condition' => [
               'repeater_condition' => ['style_1'],
            ]
         ]
      );
      $repeater->add_control(
         'tp_box_icon_svg',
         [
            'show_label' => false,
            'type' => Controls_Manager::TEXTAREA,
            'label_block' => true,
            'placeholder' => esc_html__('SVG Code Here', 'tpcore'),
            'condition' => [
               'tp_box_icon_type' => 'svg',
               'repeater_condition' => ['style_1'],
            ]
         ]
      );

      $repeater->add_control(
         'tp_box_icon_image',
         [
            'label' => esc_html__('Upload Icon Image', 'tpcore'),
            'type' => Controls_Manager::MEDIA,
            'default' => [
               'url' => Utils::get_placeholder_image_src(),
            ],
            'condition' => [
               'tp_box_icon_type' => 'image',
               'repeater_condition' => ['style_1'],
            ]
         ]
      );

      if (tp_is_elementor_version('<', '2.6.0')) {
         $repeater->add_control(
            'tp_box_icon',
            [
               'show_label' => false,
               'type' => Controls_Manager::ICON,
               'label_block' => true,
               'default' => 'fa fa-star',
               'condition' => [
                  'tp_box_icon_type' => 'icon',
                  'repeater_condition' => ['style_1'],
               ]
            ]
         );
      } else {
         $repeater->add_control(
            'tp_box_selected_icon',
            [
               'show_label' => false,
               'type' => Controls_Manager::ICONS,
               'fa4compatibility' => 'icon',
               'label_block' => true,
               'default' => [
                  'value' => 'fas fa-star',
                  'library' => 'solid',
               ],
               'condition' => [
                  'tp_box_icon_type' => 'icon',
                  'repeater_condition' => ['style_1'],
               ]
            ]
         );
      }

      $repeater->add_control(
         'tp_contact_info_title',
         [
            'label' => esc_html__('Contact Title', 'tpcore'),
            'type' => \Elementor\Controls_Manager::TEXT,
            'default' => esc_html__('Contact Title', 'tpcore'),
            'label_block' => true,
         ]
      );

      $repeater->add_control(
         'tp_contact_info_subtitle',
         [
            'label' => esc_html__('Contact Subtitle', 'tpcore'),
            'type' => \Elementor\Controls_Manager::TEXT,
            'default' => esc_html__('Contact Subtitle', 'tpcore'),
            'label_block' => true,
         ]
      );



      $repeater->add_control(
         'tp_contact_url',
         [
            'label' => esc_html__('URL', 'tpcore'),
            'type' => \Elementor\Controls_Manager::URL,
            'default' => [
               'url' => '#',
               'is_external' => true,
               'nofollow' => true,
               'custom_attributes' => '',
            ],
            'placeholder' => esc_html__('Your Text', 'tpcore'),
            'label_block' => true,
         ]
      );


      $this->add_control(
         'tp_footer_contact_list',
         [
            'label' => esc_html__('Contact Repeater', 'tpcore'),
            'type' => \Elementor\Controls_Manager::REPEATER,
            'fields' => $repeater->get_controls(),
            'default' => [
               [
                  'tp_contact_info_title' => esc_html__('Facebook', 'tpcore'),
               ],
               [
                  'tp_contact_info_title' => esc_html__('Twitter', 'tpcore'),
               ],
            ],
            'title_field' => '{{{ tp_contact_info_title }}}',
         ]
      );

      $this->end_controls_section();

      $this->tp_common_animation(null, 'desc_title', 'Animation - Title');

   }

   protected function style_tab_content()
   {
      $this->tp_section_style_controls('footer_section', 'Section - Style', '.tp-el-section');
      $this->tp_basic_style_controls('footer_title', 'Footer - Title', '.tp-el-title');
      $this->tp_link_controls_style('footer_btn_left', 'Footer Left - Button', '.tp-el-btn-green');
      $this->tp_link_controls_style('footer_btn_right', 'Footer Right - Button', '.tp-el-btn-white');
      $this->tp_basic_style_controls('copyright', 'Footer Copyright', '.tp-el-copyright');
      $this->tp_basic_style_controls('copyright_right', 'Footer Copyright Right', '.tp-el-copyright-right');

      $this->tp_section_style_controls('footer_social_box', 'Box - Style', '.tp-el-social-box');
      $this->tp_section_style_controls('footer_social_box_bg', 'Box - BG', '.tp-el-social-box-bg::after');
      $this->tp_icon_style('footer_social_box_icon', 'Social - Icon', '.tp-el-social-icon span');
      $this->tp_basic_style_controls('footer_social_title', 'Social - Text', '.tp-el-social-title');
      $this->tp_basic_style_controls('footer_social_desc', 'Social - Desc', '.tp-el-social-desc');

   }

   /**
    * Render the widget output on the frontend.
    *
    * Written in PHP and used to generate the final HTML.
    *
    * @since 1.0.0
    *
    * @access protected
    */
   protected function render()
   {
      $settings = $this->get_settings_for_display();
      $control_id = 'tpbtn';
      $control_id2 = 'tpbtn2';

      $this->tp_link_controls_render('tpbtn', 'tp-btn-green w-100 tp-el-btn-green', $this->get_settings());
      $this->tp_link_controls_render('tpbtn2', 'tp-btn-white-xl w-100 tp-el-btn-white', $this->get_settings());

      if (!empty($settings['tp_image']['url'])) {
         $tp_image = !empty($settings['tp_image']['id']) ? wp_get_attachment_image_url($settings['tp_image']['id'], $settings['thumbnail_size']) : $settings['tp_image']['url'];
         $tp_image_alt = get_post_meta($settings["tp_image"]["id"], "_wp_attachment_image_alt", true);
      }
      ?>


      <footer>
         <div class="tp-footer-bg tp-footer-bg-light p-relative fix z-index-1 theme-bg-2 tp-el-section"
            data-background="<?php echo esc_url($tp_image); ?>">
            <?php if ($settings['footer_shape_switch'] == 'yes'): ?>
               <div class="tp-footer-circle-1">
                  <span></span>
               </div>

               <div class="tp-footer-circle-2">
                  <span></span>
               </div>
               <div class="tp-footer-circle-3" data-speed=".7">
                  <span></span>
               </div>
            <?php endif; ?>
            <!-- footer area start -->
            <div class="tp-footer-area pt-120 pb-80">
               <div class="container">
                  <?php if (!empty($settings['tp_footer_title'])): ?>
                     <div class="row">
                        <div class="col-xl-12">
                           <div class="tp-footer-content text-center">
                              <h3 class="tp-footer-title big 
                                 <?php echo $this->tp_common_animation_get($settings, 'desc_title'); ?> tp-el-title">
                                 <?php echo tp_kses($settings['tp_footer_title']); ?>
                              </h3>
                           </div>
                        </div>
                     </div>
                  <?php endif; ?>

                  <div class="tp-footer-btn-box">
                     <div class="row">
                        <?php if (!empty($settings['tp_' . $control_id . '_text']) && $settings['tp_' . $control_id . '_button_show'] == 'yes'): ?>
                           <div class="col-xl-6 col-lg-6 col-md-6">
                              <div class="tp-footer-btn text-center ">
                                 <a <?php echo $this->get_render_attribute_string('tp-button-arg' . $control_id . ''); ?>>
                                    <div>
                                       <span><?php echo $settings['tp_' . $control_id . '_text']; ?></span>
                                    </div>
                                 </a>
                              </div>
                           </div>
                        <?php endif; ?>

                        <?php if (!empty($settings['tp_' . $control_id2 . '_text']) && $settings['tp_' . $control_id2 . '_button_show'] == 'yes'): ?>
                           <div class="col-xl-6 col-lg-6 col-md-6">
                              <div class="tp-footer-btn text-center ">
                                 <a <?php echo $this->get_render_attribute_string('tp-button-arg' . $control_id2 . ''); ?>>
                                    <div>
                                       <span><?php echo $settings['tp_' . $control_id2 . '_text']; ?></span>
                                    </div>
                                 </a>
                              </div>
                           </div>
                        <?php endif; ?>
                     </div>
                  </div>

                  <div class="row gx-50">
                     <?php foreach ($settings['tp_footer_contact_list'] as $key => $item):
                        // Link
                        if ('2' == $item['tp_contact_url']) {
                           $link = get_permalink($item['tp_contact_url']);
                           $target = '_self';
                           $rel = 'nofollow';
                        } else {
                           $link = !empty($item['tp_contact_url']['url']) ? $item['tp_contact_url']['url'] : '';
                           $target = !empty($item['tp_contact_url']['is_external']) ? '_blank' : '';
                           $rel = !empty($item['tp_contact_url']['nofollow']) ? 'nofollow' : '';
                        }
                        $attrs = array(
                           'href' => $link,
                           'target' => $target,
                           'rel' => $rel,
                        );
                        ?>
                        <div class="col-xl-4 col-lg-4 col-md-6 mb-30">
                           <a <?php echo tp_implode_html_attributes($attrs); ?>>
                              <div
                                 class="tp-footer-social-item d-flex align-items-center justify-content-between tp-el-social-box tp-el-social-box-bg">
                                 <span class="tp-footer-anim-border"></span>
                                 <div class="tp-footer-social-text z-index-1">
                                    <?php if (!empty($item['tp_contact_info_title'])): ?>
                                       <span
                                          class="child-1 tp-el-social-title"><?php echo tp_kses($item['tp_contact_info_title']); ?></span>
                                    <?php endif; ?>

                                    <?php if (!empty($item['tp_contact_info_subtitle'])): ?>
                                       <span
                                          class="child-2 tp-el-social-desc"><?php echo tp_kses($item['tp_contact_info_subtitle']); ?></span>
                                    <?php endif; ?>

                                 </div>
                                 <div class="tp-footer-social-icon z-index-1 tp-el-social-icon">
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
                                 </div>
                              </div>
                           </a>
                        </div>
                     <?php endforeach; ?>
                  </div>

               </div>
            </div>
            <!-- footer area end -->

            <?php if (!empty($settings['copyright_text']) || !empty($settings['copyright_right_text'])): ?>
               <!-- copyright area start -->
               <div class="tp-copyright-area pb-20">
                  <div class="container">
                     <div class="row">
                        <div class="col-xl-6 col-md-6">
                           <div class="tp-copyright-content-left text-center text-md-start">
                              <p class="tp-el-copyright"><?php echo tp_kses($settings['copyright_text']); ?></p>
                           </div>
                        </div>
                        <div class="col-xl-6 col-md-6">
                           <div class="tp-copyright-content-right text-center text-md-end">
                              <span
                                 class="tp-el-copyright-right"><?php echo tp_kses($settings['copyright_right_text']); ?></span>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <!-- copyright area end -->
            <?php endif; ?>
         </div>
      </footer>



   <?php
   }
}

$widgets_manager->register(new TP_Footer_01());
