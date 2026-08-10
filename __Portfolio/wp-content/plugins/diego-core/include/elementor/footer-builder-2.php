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
class TP_Footer_02 extends Widget_Base
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
    return 'tp-footer-2';
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
    return __('Footer Builder 2', 'tpcore');
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
      '_tp_image',
      [
        'label' => esc_html__('Site Logo', 'tp-core'),
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
        'name' => 'tp_image_size',
        'label' => __('Image Size', 'header-footer-elementor'),
        'default' => 'medium',
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
      'tp_footer_subtitle',
      [
        'label' => esc_html__('Footer Subtitle', 'tpcore'),
        'type' => \Elementor\Controls_Manager::TEXT,
        'default' => esc_html__('Contact Me ', 'tpcore'),
        'placeholder' => esc_html__('Your Text', 'tpcore'),
        'label_block' => true
      ]
    );

    $this->add_control(
      'tp_footer_title',
      [
        'label' => esc_html__('Footer Title', 'tpcore'),
        'type' => \Elementor\Controls_Manager::TEXT,
        'default' => esc_html__('Lets work Together ', 'tpcore'),
        'placeholder' => esc_html__('Your Text', 'tpcore'),
        'label_block' => true
      ]
    );
    $this->add_control(
      'tp_footer_desc',
      [
        'label' => esc_html__('Footer Description', 'tpcore'),
        'type' => \Elementor\Controls_Manager::TEXTAREA,
        'rows' => 10,
        'default' => esc_html__('A template made for professional designers, photographers and all peopl', 'tpcore'),
        'placeholder' => esc_html__('Your Text', 'tpcore'),
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

    // _tp_image
    $this->start_controls_section(
      '_tp_image_button',
      [
        'label' => esc_html__('Button', 'tp-core'),
      ]
    );
    $this->add_control(
      'tp_image_button',
      [
        'label' => esc_html__('Choose BG Image', 'tp-core'),
        'type' => \Elementor\Controls_Manager::MEDIA,
        'default' => [
          'url' => \Elementor\Utils::get_placeholder_image_src(),
        ],
      ]
    );


    $this->add_control(
      'tp_footer_btn_url',
      [
        'label' => esc_html__('Button Link', 'tpcore'),
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

    $this->add_group_control(
      Group_Control_Image_Size::get_type(),
      [
        'name' => 'thumbnail_button',
        'default' => 'full',
        'exclude' => [
          'custom'
        ]
      ]
    );
    $this->end_controls_section();

    $this->start_controls_section(
      'tp_footer_img_sec',
      [
        'label' => esc_html__('Thumbnail', 'tpcore'),
        'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
      ]
    );

    $this->add_control(
      'tp_image_2',
      [
        'label' => esc_html__('Upload Thumbanil', 'tpcore'),
        'type' => \Elementor\Controls_Manager::MEDIA,
        'default' => [
          'url' => \Elementor\Utils::get_placeholder_image_src(),
        ],
      ]
    );

    $this->add_group_control(
      Group_Control_Image_Size::get_type(),
      [
        'name' => 'thumbnail_image',
        'default' => 'full',
        'exclude' => [
          'custom'
        ]
      ]
    );

    $this->end_controls_section();

    $this->start_controls_section(
      'tp_footer_menu_sec',
      [
        'label' => esc_html__('Footer Menu', 'tpcore'),
        'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
      ]
    );


    $repeater = new \Elementor\Repeater();

    $repeater->add_control(
      'tp_footer_menu_title',
      [
        'label' => esc_html__('Menu Title', 'tpcore'),
        'type' => \Elementor\Controls_Manager::TEXT,
        'default' => esc_html__('Home', 'tpcore'),
        'label_block' => true,
      ]
    );

    $repeater->add_control(
      'tp_footer_menu_url',
      [
        'label' => esc_html__('Menu URL', 'tpcore'),
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
      'tp_footer_menu_list',
      [
        'label' => esc_html__('Menu List', 'tpcore'),
        'type' => \Elementor\Controls_Manager::REPEATER,
        'fields' => $repeater->get_controls(),
        'default' => [
          [
            'tp_footer_menu_title' => esc_html__('Home', 'tpcore'),
          ],
          [
            'tp_footer_menu_title' => esc_html__('About', 'tpcore'),
          ],
          [
            'tp_footer_menu_title' => esc_html__('Contact', 'tpcore'),
          ],
        ],
        'title_field' => '{{{ tp_footer_menu_title }}}',
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
        'label' => esc_html__('Social Title', 'tpcore'),
        'type' => \Elementor\Controls_Manager::TEXT,
        'default' => esc_html__('Contact Title', 'tpcore'),
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
        'label' => esc_html__('Social Repeater', 'tpcore'),
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
    $this->tp_common_animation(null, 'desc_animation', 'Animation - Description');

  }

  protected function style_tab_content()
  {

    $this->tp_section_style_controls('footer2_section', 'Section - Style', '.tp-el-section');
    $this->tp_basic_style_controls('footer2_subtitle', 'Footer - Subtitle', '.tp-el-subtitle');
    $this->tp_basic_style_controls('footer2_title', 'Footer - Title', '.tp-el-title');
    $this->tp_basic_style_controls('footer2_desc', 'Footer - Descriptions', '.tp-el-desc p');

    $this->tp_link_controls_style('footer_menu_links', 'Menu - Links', '.tp-el-menu ul li a');

    $this->tp_basic_style_controls('copyright', 'Footer Copyright', '.tp-el-copyright');

    $this->tp_icon_style('fact_box_icon', 'Social - Icon', '.tp-el-social-icon');
    $this->tp_link_controls_style('footer_btn', 'Footer - Button', '.tp-el-footer-btn');

    // $this->tp_section_style_controls('social_box', 'Box - Style', '.tp-el-social-box');
    // $this->tp_section_style_controls('social_box_bg', 'Box - BG', '.tp-el-social-box-bg::after');
    // $this->tp_basic_style_controls('wel_title', 'Social - Text', '.tp-el-social-title');
    // $this->tp_basic_style_controls('wel_desc', 'Social - Desc', '.tp-el-social-desc');

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
    $bloginfo = get_bloginfo('name');

    // group image size
    $size = $settings['tp_image_size_size'];

    if ('custom' !== $size) {
      $image_size = $size;
    } else {
      require_once ELEMENTOR_PATH . 'includes/libraries/bfi-thumb/bfi-thumb.php';
      $image_dimension = $settings['tp_image_size_custom_dimension'];
      $image_size = [
        // Defaults sizes.
        0 => null, // Width.
        1 => null, // Height.

        'bfi_thumb' => true,
        'crop' => true,
      ];
      $has_custom_size = false;
      if (!empty($image_dimension['width'])) {
        $has_custom_size = true;
        $image_size[0] = $image_dimension['width'];
      }

      if (!empty($image_dimension['height'])) {
        $has_custom_size = true;
        $image_size[1] = $image_dimension['height'];
      }

      if (!$has_custom_size) {
        $image_size = 'full';
      }
    }

    if (!empty($settings['tp_image']['url'])) {
      $tp_image = !empty($settings['tp_image']['id']) ? wp_get_attachment_image_url($settings['tp_image']['id'], $image_size, true) : $settings['tp_image']['url'];
      $tp_image_alt = get_post_meta($settings["tp_image"]["id"], "_wp_attachment_image_alt", true);
    }

    if (!empty($settings['tp_image_2']['url'])) {
      $tp_image_2 = !empty($settings['tp_image_2']['id']) ? wp_get_attachment_image_url($settings['tp_image_2']['id'], $settings['thumbnail_image_size'], true) : $settings['tp_image_2']['url'];
      $tp_image_2_alt = get_post_meta($settings["tp_image_2"]["id"], "_wp_attachment_image_alt", true);
    }

    if (!empty($settings['tp_image_button']['url'])) {
      $tp_image_button = !empty($settings['tp_image_button']['id']) ? wp_get_attachment_image_url($settings['tp_image_button']['id'], $settings['thumbnail_button_size'], true) : $settings['tp_image_button']['url'];
      $tp_image_button_alt = get_post_meta($settings["tp_image_button"]["id"], "_wp_attachment_image_alt", true);
    }

    // Link
    if ('2' == $settings['tp_footer_btn_url']) {
      $link = get_permalink($settings['tp_footer_btn_url']);
      $target = '_self';
      $rel = 'nofollow';
    } else {
      $link = !empty($settings['tp_footer_btn_url']['url']) ? $settings['tp_footer_btn_url']['url'] : '';
      $target = !empty($settings['tp_footer_btn_url']['is_external']) ? '_blank' : '';
      $rel = !empty($settings['tp_footer_btn_url']['nofollow']) ? 'nofollow' : '';
    }
    $attrs = array(
      'href' => $link,
      'target' => $target,
      'rel' => $rel,
    );

    ?>


    <!-- footer area start -->
    <footer>
      <div
        class="tp-footer-3__wrapper tp-footer-3__overlay-bg black-bg-2 p-relative z-index-1 fix tp-mouse-move-btn-section tp-el-section">
        <?php if ($settings['footer_shape_switch'] == 'yes'): ?>
          <div class="tp-footer-3__shape-1">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/img/footer/footer-shape.png"
              alt="<?php echo esc_attr($bloginfo); ?>">
          </div>
        <?php endif; ?>

        <div class="tp-footer-3__img">
          <img src="<?php echo esc_url($tp_image_2) ?>" alt="<?php echo esc_attr($tp_image_2_alt); ?>">
        </div>


        <div class="tp-footer-3__area pt-120 pb-120">
          <div class="container">
            <div class="row align-items-center">
              <div class="col-xl-7 col-lg-7">
                <div class="tp-footer-3__title-box">
                  <?php if (!empty($settings['tp_footer_subtitle'])): ?>
                    <span
                      class="tp-footer-3__subtitle tp-el-subtitle"><?php echo tp_kses($settings['tp_footer_subtitle']); ?></span>
                  <?php endif; ?>

                  <?php if (!empty($settings['tp_footer_title'])): ?>
                    <h3
                      class="tp-footer-3__title <?php echo esc_attr($this->tp_common_animation_get($settings, 'desc_title')) ?> tp-el-title">
                      <?php echo tp_kses($settings['tp_footer_title']); ?>
                    </h3>
                  <?php endif; ?>
                </div>
                <div class="tp-footer-3__widget">

                  <div class="tp-footer-3__widget-top d-flex align-items-center justify-content-between">
                    <?php if (!empty($tp_image)): ?>
                      <div class="tp-footer-3__logo">
                        <a href="<?php print esc_url(home_url('/')); ?>">
                          <img src="<?php echo esc_url($tp_image); ?>" alt="<?php echo esc_attr($tp_image_alt); ?>">
                        </a>
                      </div>
                    <?php endif; ?>

                    <div
                      class="tp-footer-3__menu <?php echo esc_attr($this->tp_common_animation_get($settings, 'desc_animation')) ?> tp-el-menu">
                      <ul>
                        <?php foreach ($settings['tp_footer_menu_list'] as $item):
                          // Link
                          if ('2' == $item['tp_footer_menu_url']) {
                            $link = get_permalink($item['tp_footer_menu_url']);
                            $target = '_self';
                            $rel = 'nofollow';
                          } else {
                            $link = !empty($item['tp_footer_menu_url']['url']) ? $item['tp_footer_menu_url']['url'] : '';
                            $target = !empty($item['tp_footer_menu_url']['is_external']) ? '_blank' : '';
                            $rel = !empty($item['tp_footer_menu_url']['nofollow']) ? 'nofollow' : '';
                          }
                          $attrs = array(
                            'href' => $link,
                            'target' => $target,
                            'rel' => $rel,
                          );
                          ?>
                          <li>
                            <a <?php echo tp_implode_html_attributes($attrs); ?>>
                              <?php echo tp_kses($item['tp_footer_menu_title']); ?>
                            </a>
                          </li>
                        <?php endforeach; ?>
                      </ul>
                    </div>
                  </div>

                  <?php if (!empty($settings['tp_footer_desc'])): ?>
                    <div
                      class="tp-footer-3__text <?php echo esc_attr($this->tp_common_animation_get($settings, 'desc_animation')) ?> tp-el-desc">
                      <p><?php echo tp_kses($settings['tp_footer_desc']); ?></p>
                    </div>
                  <?php endif; ?>

                </div>
              </div>
              <?php if (!empty($tp_image_button)): ?>
                <div class="col-xl-5 col-lg-5">
                  <div class="tp-footer-3__link text-xxl-start text-center">
                    <a class="p-relative d-inline-block tp-mouse-move-btn tp-el-footer-btn"
                      <?php echo tp_implode_html_attributes($attrs); ?>>
                      <img src="<?php echo esc_url($tp_image_button); ?>" alt="<?php echo esc_attr($tp_image_button_alt); ?>">
                      <span>
                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                          <path d="M1 15L15 1" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                            stroke-linejoin="round" />
                          <path d="M15 15V1H1" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                            stroke-linejoin="round" />
                        </svg>
                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                          <path d="M1 15L15 1" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                            stroke-linejoin="round" />
                          <path d="M15 15V1H1" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                            stroke-linejoin="round" />
                        </svg>
                      </span>
                    </a>
                  </div>
                </div>
              <?php endif; ?>
            </div>
          </div>
        </div>

        <div class="tp-copyright-3__area">
          <div class="tp-copyright-3__border-top">
            <div class="container">
              <div class="row align-items-center">
                <?php if (!empty($settings['copyright_text'])): ?>
                  <div class="col-xl-3 col-lg-3 col-md-3">
                    <div class="tp-copyright-3__left text-center text-md-start">
                      <p class="tp-el-copyright"><?php echo tp_kses($settings['copyright_text']) ?></p>
                    </div>
                  </div>
                <?php endif; ?>
                <div class="col-xl-9 col-lg-9 col-md-9">
                  <div class="tp-copyright-3__social text-end">
                    <ul>
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
                        <li>
                          <a <?php echo tp_implode_html_attributes($attrs); ?> class="tp-el-social-icon">
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
                            <?php echo tp_kses($item['tp_contact_info_title']); ?>
                          </a>
                        </li>
                      <?php endforeach; ?>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>
    </footer>
    <!-- footer area end -->

    <?php
  }
}

$widgets_manager->register(new TP_Footer_02());
