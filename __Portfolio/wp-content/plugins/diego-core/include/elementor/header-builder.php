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
Use \Elementor\Core\Schemes\Typography;
use \Elementor\Group_Control_Background;
use \Elementor\Repeater;


if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Tp Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class TP_Header_01 extends Widget_Base {

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
	public function get_name() {
		return 'tp-header';
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
	public function get_title() {
		return __( 'Header Builder', 'tpcore' );
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
	public function get_icon() {
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
	public function get_categories() {
		return [ 'tpcore' ];
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
	public function get_script_depends() {
		return [ 'tpcore' ];
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
    protected function get_nav_menu_index() {
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
    private function get_available_menus() {

        $menus = wp_get_nav_menus();

        $options = [];

        foreach ( $menus as $menu ) {
            $options[ $menu->slug ] = $menu->name;
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

    protected function register_controls(){
        $this->register_controls_section();
        $this->style_tab_content();
    } 

	protected function register_controls_section() {

      $this->start_controls_section(
         'tp_layout',
         [
             'label' => esc_html__('Design Layout', 'tp-core'),
         ]
     );
     $this->add_control(
         'tp_design_style',
         [
             'label' => esc_html__('Select Layout', 'tp-core'),
             'type' => Controls_Manager::SELECT,
             'options' => [
                 'layout-1' => esc_html__('Layout 1', 'tp-core'),
             ],
             'default' => 'layout-1',
         ]
     );

     $this->end_controls_section();

      $this->start_controls_section(
       'tp_header_sec',
           [
             'label' => esc_html__( 'Header Controls', 'tpcore' ),
             'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
           ]
      );
      
      $this->add_control(
       'tp_header_right_switch',
         [
            'label'        => esc_html__( 'Enable Header Right?', 'tpcore' ),
            'type'         => \Elementor\Controls_Manager::SWITCHER,
            'label_on'     => esc_html__( 'Show', 'tpcore' ),
            'label_off'    => esc_html__( 'Hide', 'tpcore' ),
            'return_value' => 'yes',
            'default'      => 'yes',
         ]
      );

      $this->add_control(
         'tp_header_toggle',
           [
              'label'        => esc_html__( 'Theme Toggle Switch', 'tpcore' ),
              'type'         => \Elementor\Controls_Manager::SWITCHER,
              'label_on'     => esc_html__( 'Enable', 'tpcore' ),
              'label_off'    => esc_html__( 'Disable', 'tpcore' ),
              'return_value' => 'yes',
              'default'      => 'yes',
           ]
        );
        
        $this->add_control(
         'tp_header_hamburger',
           [
              'label'        => esc_html__( 'Hamburger Switch', 'tpcore' ),
              'type'         => \Elementor\Controls_Manager::SWITCHER,
              'label_on'     => esc_html__( 'Enable', 'tpcore' ),
              'label_off'    => esc_html__( 'Disable', 'tpcore' ),
              'return_value' => 'yes',
              'default'      => 'yes',
           ]
        );
      
      
      $this->end_controls_section();

      $this->tp_button_render_controls('tpbtn', 'Button', ['layout-1']);

		// _tp_image
		$this->start_controls_section(
            '_tp_image',
            [
                'label' => esc_html__('Site Logo', 'tp-core'),
            ]
        );

        $this->add_control(
            'tp_image',
            [
                'label' => esc_html__( 'Choose Image', 'tp-core' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_control(
            'tp_image_black',
            [
                'label' => esc_html__( 'Choose Black Image', 'tp-core' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );
        
		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name'    => 'tp_image_size',
				'label'   => __( 'Image Size', 'header-footer-elementor' ),
				'default' => 'medium',
			]
		);

        $this->end_controls_section();


		$this->start_controls_section(
            'section_menu',
            [
                'label' => __( 'Menu', 'header-footer-elementor' ),
            ]
        );

        $menus = $this->get_available_menus();

        if ( ! empty( $menus ) ) {
            $this->add_control(
                'menu',
                [
                    'label'        => __( 'Menu', 'header-footer-elementor' ),
                    'type'         => Controls_Manager::SELECT,
                    'options'      => $menus,
                    'default'      => array_keys( $menus )[0],
                    'save_default' => true,
                    /* translators: %s Nav menu URL */
                    'description'  => sprintf( __( 'Go to the <a href="%s" target="_blank">Menus screen</a> to manage your menus.', 'header-footer-elementor' ), admin_url( 'nav-menus.php' ) ),
                ]
            );
        } else {
            $this->add_control(
                'menu',
                [
                    'type'            => Controls_Manager::RAW_HTML,
                    /* translators: %s Nav menu URL */
                    'raw'             => sprintf( __( '<strong>There are no menus in your site.</strong><br>Go to the <a href="%s" target="_blank">Menus screen</a> to create one.', 'header-footer-elementor' ), admin_url( 'nav-menus.php?action=edit&menu=0' ) ),
                    'content_classes' => 'elementor-panel-alert elementor-panel-alert-info',
                ]
            );
        }

        $this->add_control(
            'menu_last_item',
            [
                'label'     => __( 'Last Menu Item', 'header-footer-elementor' ),
                'type'      => Controls_Manager::SELECT,
                'options'   => [
                    'none' => __( 'Default', 'header-footer-elementor' ),
                    'cta'  => __( 'Button', 'header-footer-elementor' ),
                ],
                'default'   => 'none',
                'condition' => [
                    'layout!' => 'expandible',
                ],
            ]
        );

        $this->end_controls_section();


        $this->start_controls_section(
         'tp_offcanvas_secs',
             [
               'label' => esc_html__( 'Offcanvas Controls', 'tpcore' ),
               'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
             ]
        );
        

        $this->add_control(
               'tp_side_logo',
               [
                  'label' => esc_html__( 'Choose Logo', 'tp-core' ),
                  'type' => \Elementor\Controls_Manager::MEDIA,
                  'default' => [
                     'url' => \Elementor\Utils::get_placeholder_image_src(),
                  ],
               ]
         );

        $this->add_control(
               'tp_side_logo_black',
               [
                  'label' => esc_html__( 'Choose Black Logo', 'tp-core' ),
                  'type' => \Elementor\Controls_Manager::MEDIA,
                  'default' => [
                     'url' => \Elementor\Utils::get_placeholder_image_src(),
                  ],
               ]
         );
         
         $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
               'name'    => 'tp_side_logo_size',
               'label'   => __( 'Image Size', 'header-footer-elementor' ),
               'default' => 'medium',
            ]
         );

         $this->add_control(
          'tp_offcanvas_shape_switch',
          [
            'label'        => esc_html__( 'Enable Shape?', 'tpcore' ),
            'type'         => \Elementor\Controls_Manager::SWITCHER,
            'label_on'     => esc_html__( 'Show', 'tpcore' ),
            'label_off'    => esc_html__( 'Hide', 'tpcore' ),
            'return_value' => 'yes',
            'default'      => 'yes',
          ]
         );

        $this->end_controls_section();

        $this->start_controls_section(
         'tp_offcanvas_social_sec',
             [
               'label' => esc_html__( 'Offcanvas Social', 'tpcore' ),
               'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
             ]
        );
        
        
        $repeater = new \Elementor\Repeater();
        
         $repeater->add_control(
         'tp_social_text',
           [
             'label'   => esc_html__( 'Social Text', 'tpcore' ),
             'type'        => \Elementor\Controls_Manager::TEXT,
             'default'     => esc_html__( 'Facebook', 'tpcore' ),
             'label_block' => true,
           ]
         );

         $repeater->add_control(
          'tp_social_url',
          [
            'label'   => esc_html__( 'Social URL', 'tpcore' ),
            'type'        => \Elementor\Controls_Manager::URL,
            'default'     => [
                'url'               => '#',
                'is_external'       => true,
                'nofollow'          => true,
                'custom_attributes' => '',
              ],
              'placeholder' => esc_html__( 'Your URL', 'tpcore' ),
              'label_block' => true,
            ]
          );
         
         $this->add_control(
           'tp_social_list',
           [
             'label'       => esc_html__( 'Social List', 'tpcore' ),
             'type'        => \Elementor\Controls_Manager::REPEATER,
             'fields'      => $repeater->get_controls(),
             'default'     => [
               [
                 'tp_social_text'   => esc_html__( 'Facebook', 'tpcore' ),
               ],
             ],
             'title_field' => '{{{ tp_social_text }}}',
           ]
         );
        
        $this->end_controls_section();

        $this->start_controls_section(
         'tp_offcanvas_contact_sec',
             [
               'label' => esc_html__( 'Offcanvas Contact', 'tpcore' ),
               'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
             ]
        );
        
        $this->add_control(
        'tp_offcanvas_phone',
         [
            'label'       => esc_html__( 'Offcanvas Phone', 'tpcore' ),
            'type'        => \Elementor\Controls_Manager::TEXT,
            'default'     => esc_html__( '123 455 7895', 'tpcore' ),
            'placeholder' => esc_html__( 'Your Text', 'tpcore' ),
            'label_block' => true
         ]
        );

        $this->add_control(
         'tp_offcanvas_phone_url',
         [
           'label'   => esc_html__( 'Phone URL', 'tpcore' ),
           'type'        => \Elementor\Controls_Manager::URL,
           'default'     => [
               'url'               => '#',
               'is_external'       => true,
               'nofollow'          => true,
               'custom_attributes' => '',
             ],
             'placeholder' => esc_html__( 'Placeholder Text', 'tpcore' ),
             'label_block' => true,
           ]
         );
        
         $this->add_control(
            'tp_offcanvas_mail',
             [
                'label'       => esc_html__( 'Offcanvas Mail', 'tpcore' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => esc_html__( 'Diego@mail.com', 'tpcore' ),
                'placeholder' => esc_html__( 'Your Text', 'tpcore' ),
                'label_block' => true
             ]
            );

        $this->add_control(
         'tp_offcanvas_mail_url',
         [
           'label'   => esc_html__( 'Mail URL', 'tpcore' ),
           'type'        => \Elementor\Controls_Manager::URL,
           'default'     => [
               'url'               => '#',
               'is_external'       => true,
               'nofollow'          => true,
               'custom_attributes' => '',
             ],
             'placeholder' => esc_html__( 'Placeholder Text', 'tpcore' ),
             'label_block' => true,
           ]
         );
        
         $this->add_control(
          'tp_offcanvas_contact_desc',
          [
            'label'       => esc_html__( 'Description', 'tpcore' ),
            'type'        => \Elementor\Controls_Manager::TEXTAREA,
            'rows'        => 10,
            'default'     => esc_html__( 'If in doubt. Reach out', 'tpcore' ),
            'placeholder' => esc_html__( 'Your Text', 'tpcore' ),
          ]
         );

        $this->end_controls_section();

	}

   protected function style_tab_content(){
      $this->start_controls_section(
         'tp_menu__sec',
         [
             'label' => esc_html__('Menu Settings', 'tp-core'),
             'tab' => Controls_Manager::TAB_STYLE,
         ]
     );

     $this->add_control(
         'tp_menu_spacing',
         [
            'label' => esc_html__( 'Margin Right', 'tpcore' ),
            'type' => \Elementor\Controls_Manager::SLIDER,
            'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
            'range' => [
               'px' => [
                  'min' => 0,
                  'max' => 1000,
                  'step' => 5,
               ],
               '%' => [
                  'min' => 0,
                  'max' => 100,
               ],
            ],
            'default' => [
               'unit' => 'px',
               'size' => 40,
            ],
            'selectors' => [
               '{{WRAPPER}} .tp-header-4__menu  > nav > ul > li:not(:last-child)' => 'margin-right: {{SIZE}}{{UNIT}};',
            ],
         ]
      );

      $this->add_control(
         'tp_menu_submenu',
            [
               'label' => esc_html__('Submenu Background Color', 'tp-core'),
               'type' => Controls_Manager::COLOR,
               'selectors' => [
                  '{{WRAPPER}} .tp-header-4__menu  > nav > ul > li .submenu' => 'background: {{VALUE}} !important;',
               ],
            ]
      );

      $this->add_control(
         'tp_sticky_menu_bg',
            [
               'label' => esc_html__('Stickey Menu Background Color', 'tp-core'),
               'type' => Controls_Manager::COLOR,
               'selectors' => [
                  '{{WRAPPER}} .tp-header-area.tp-header-sticky-cloned::before' => 'background: {{VALUE}} !important;',
               ],
            ]
      );

      $this->add_group_control(
          \Elementor\Group_Control_Typography::get_type(),
          [
            'name' => 'tp_menu_typo',
            'label'   => esc_html__( 'Menu Typography', 'textdomain' ),
            'selector' => '{{WRAPPER}} .tp-header-4__menu  > nav > ul > li a',
          ]
        );

     $this->start_controls_tabs(
        'menu_normal_state',
      );
     
         $this->start_controls_tab(
            'menu_normal',
               [
                  'label'   => esc_html__( 'Normal', 'textdomain' ),
               ]
            );

            $this->add_control(
               'tp_menu_normal_color',
                  [
                     'label' => esc_html__('Menu Color', 'tp-core'),
                     'type' => Controls_Manager::COLOR,
                     'selectors' => [
                        '{{WRAPPER}}  .tp-header-4__menu  > nav > ul > li > a' => 'color: {{VALUE}} !important;',
                     ],
                  ]
               );
         
              $this->add_control(
               'tp_menu_normal_submenu_color',
                  [
                     'label' => esc_html__('Submenu Color', 'tp-core'),
                     'type' => Controls_Manager::COLOR,
                     'selectors' => [
                        '{{WRAPPER}} .tp-header-4__menu  > nav > ul > li .submenu > li > a' => 'color: {{VALUE}} !important;',
                     ],
                  ]
               );
         
              $this->add_control(
               'tp_menu_normal_line',
                  [
                     'label' => esc_html__('Menu Line Color', 'tp-core'),
                     'type' => Controls_Manager::COLOR,
                     'selectors' => [
                        '{{WRAPPER}} .tp-header-4__menu  > nav > ul > li > a::after' => 'background: {{VALUE}} !important;',
                     ],
                  ]
               );
         
         $this->end_controls_tab();

         $this->start_controls_tab(
            'menu_hover',
            [
               'label'   => esc_html__( 'Hover', 'textdomain' ),
            ]
            );

            $this->add_control(
               'tp_menu_hover_color',
                  [
                     'label' => esc_html__('Menu Hover Color', 'tp-core'),
                     'type' => Controls_Manager::COLOR,
                     'selectors' => [
                        '{{WRAPPER}} .tp-header-4__menu  > nav > ul > li:hover > a' => 'color: {{VALUE}} !important;',
                     ],
                  ]
               );
         
              $this->add_control(
               'tp_menu_hover_submenu_color',
                  [
                     'label' => esc_html__('Submenu Hover Color', 'tp-core'),
                     'type' => Controls_Manager::COLOR,
                     'selectors' => [
                        '{{WRAPPER}} .tp-header-4__menu  > nav > ul > li .submenu > li:hover > a' => 'color: {{VALUE}} !important;',
                     ],
                  ]
               );
         
              $this->add_control(
               'tp_menu_hover_line',
                  [
                     'label' => esc_html__('Menu Hover Line Color', 'tp-core'),
                     'type' => Controls_Manager::COLOR,
                     'selectors' => [
                        '{{WRAPPER}} .tp-header-4__menu  > nav > ul > li:hover > a::after' => 'background: {{VALUE}} !important;',
                     ],
                  ]
               );
         
         $this->end_controls_tab();
     
     $this->end_controls_tabs();



     $this->end_controls_section();
     
      $this->tp_link_controls_style('header_btn', 'Header - Button', '.tp-header-3__btn a');
      $this->start_controls_section(
         'tp_btn_dot_media_style',
         [
             'label' => esc_html__('Header - Button BG', 'tp-core'),
             'tab' => Controls_Manager::TAB_STYLE,
         ]
     );


     $this->add_control(
         'tp_btn_dot_area_background',
         [
             'label' => esc_html__('Color', 'tp-core'),
             'type' => Controls_Manager::COLOR,
             'selectors' => [
                 '{{WRAPPER}} .tp-header-3__btn a::after' => 'background-color: {{VALUE}} !important;',
             ],
         ]
     );



     $this->end_controls_section();

     $this->start_controls_section(
      'tp_theme_toggle_btn_sec',
      [
          'label' => esc_html__('Theme Toggle Button', 'tp-core'),
          'tab' => Controls_Manager::TAB_STYLE,
      ]
  );

  $this->add_group_control(
     \Elementor\Group_Control_Background::get_type(),
     [
        'name'     => 'tp_theme_toggle_normal_bg_style',
        'label'   => esc_html__( 'Background ', 'tpcore' ),
        'types'    => [ 'classic', 'gradient', 'video' ],
        'selector' => '{{WRAPPER}} .tp-theme-toggle-main',
     ]
   );


   $this->add_control(
      'tp_theme_toggle_normal_border_style',
      [
         'label' => esc_html__('Border Style', 'tp-core'),
         'type' => Controls_Manager::SELECT,
         'options' => [
            '' => esc_html__('Default', 'tp-core'),
            'none' => esc_html__('None', 'tp-core'),
            'solid' => esc_html__('Solid', 'tp-core'),
            'double' => esc_html__('Double', 'tp-core'),
            'dotted' => esc_html__('Dotted', 'tp-core'),
            'dashed' => esc_html__('Dashed', 'tp-core'),
            'groove' => esc_html__('Groove', 'tp-core'),
         ],
         'selectors' => [
            '{{WRAPPER}} .tp-theme-toggle-main' => 'border-style: {{VALUE}} !important;;',
         ],
      ]
   );

   $this->add_responsive_control(
      'tp_theme_toggle_normal_border_width',
      [
         'label' => esc_html__('Border Width', 'tp-core'),
         'type' => Controls_Manager::DIMENSIONS,
         'size_units' => ['px', '%', 'em'],
         'selectors' => [
            '{{WRAPPER}} .tp-theme-toggle-main' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
         ],
         'separator' => 'before',
      ]
   );

   $this->add_control(
         'tp_theme_toggle_normal_border_color',
         [
            'label' => esc_html__('Border Color', 'tp-core'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
               '{{WRAPPER}} .tp-theme-toggle-main' => 'border-color: {{VALUE}} !important;;',
            ],
         ]

   );

   $this->end_controls_section();

       $this->start_controls_section(
          'tp_header_hamburger_btn_sec',
          [
              'label' => esc_html__('Hamburger Button', 'tp-core'),
              'tab' => Controls_Manager::TAB_STYLE,
          ]
      );
 
 
      $this->add_control(
         'tp_header_hamburger_btn',
            [
               'label' => esc_html__('Background Color', 'tp-core'),
               'type' => Controls_Manager::COLOR,
               'selectors' => [
                  '{{WRAPPER}} .tp-header-3__bar button' => 'color: {{VALUE}} !important;',
               ],
            ]
       );
 
      $this->end_controls_section();

      $this->start_controls_section(
          'tp_offcanvas_bg_sec',
          [
              'label' => esc_html__('Offcanvas Background', 'tp-core'),
              'tab' => Controls_Manager::TAB_STYLE,
          ]
      );
      
      $this->add_group_control(
         \Elementor\Group_Control_Background::get_type(),
         [
            'name'     => 'tp_offcanvas_left_bg',
            'label'   => esc_html__( 'Left BG Color', 'tpcore' ),
            'types'    => [ 'classic', 'gradient', 'video' ],
            'selector' => '{{WRAPPER}} .tp-offcanvas-bg.is-left',
         ]
       );
      
      $this->add_group_control(
         \Elementor\Group_Control_Background::get_type(),
         [
            'name'     => 'tp_offcanvas_right_bg',
            'label'   => esc_html__( 'Right BG Color', 'tpcore' ),
            'types'    => [ 'classic', 'gradient', 'video' ],
            'selector' => '{{WRAPPER}} .tp-offcanvas-bg.is-right',
         ]
       );

      $this->end_controls_section();

      $this->tp_link_controls_style('contact_list', 'Offcanvas - Tel', '.tpoffcanvas__tel a');
      $this->tp_link_controls_style('contact_mail', 'Offcanvas - Mail', '.tpoffcanvas__mail a');
      $this->tp_link_controls_style('contact_text', 'Offcanvas - Text', '.tpoffcanvas__text p');
      $this->tp_link_controls_style('social_list', 'Offcanvas - Social', '.tpoffcanvas__social-link ul li a');
      
 
      $this->start_controls_section(
          'tp_offcanvas_menu__sec',
          [
              'label' => esc_html__('Menu Settings', 'tp-core'),
              'tab' => Controls_Manager::TAB_STYLE,
          ]
      );
 

       $this->add_control(
        'tp_offcanvas_menu_spacing',
          [
            'label'      => esc_html__( 'Menu Spacing', 'tpcore' ),
            'type'       => \Elementor\Controls_Manager::DIMENSIONS,
            'size_units' => [ 'px', '%', 'em' ],
            'selectors'  => [
              '{{WRAPPER}} .tp-offcanvas-wrapper-2 .tp-main-menu-mobile > nav ul > li > a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
          ]
        );
 
        $this->add_group_control(
          \Elementor\Group_Control_Typography::get_type(),
          [
            'name' => 'tp_offcanvas_menu_typo',
            'label'   => esc_html__( 'Menu Typography', 'tpcore' ),
            'selector' => '{{WRAPPER}} .tp-offcanvas-wrapper-2 .tp-main-menu-mobile > nav ul > li > a',
          ]
        );

      $this->start_controls_tabs(
         'tp_offcanvas_menu_normal_state',
       );
      
          $this->start_controls_tab(
             'tp_offcanvas_menu_normal',
                [
                   'label'   => esc_html__( 'Normal', 'tpcore' ),
                ]
             );
 
             $this->add_control(
                'tp_offcanvas_menu_normal_color',
                   [
                      'label' => esc_html__('Menu Color', 'tp-core'),
                      'type' => Controls_Manager::COLOR,
                      'selectors' => [
                         '{{WRAPPER}} .tp-offcanvas-wrapper-2 .tp-main-menu-mobile > nav ul > li > a' => 'color: {{VALUE}} !important;',
                      ],
                   ]
                );
          
          
          $this->end_controls_tab();
 
          $this->start_controls_tab(
             'tp_offcanvas_menu_hover',
             [
                'label'   => esc_html__( 'Hover', 'tpcore' ),
             ]
             );
 
             $this->add_control(
                'tp_offcanvas_menu_hover_color',
                   [
                      'label' => esc_html__('Menu Hover Color', 'tpcore'),
                      'type' => Controls_Manager::COLOR,
                      'selectors' => [
                         '{{WRAPPER}} .tp-offcanvas-wrapper-2 .tp-main-menu-mobile > nav ul > li:hover > a' => 'color: {{VALUE}} !important;',
                      ],
                   ]
                );

          $this->end_controls_tab();
      
      $this->end_controls_tabs();
 
 
      $this->end_controls_section();

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
	protected function render() {
		$settings = $this->get_settings_for_display();
      $control_id = 'tpbtn';
      
        $menus = $this->get_available_menus();

        if ( empty( $menus ) ) {
            return false;
        }

        require_once get_parent_theme_file_path(). '/inc/class-navwalker.php';

        $args = [
            'echo'        => false,
            'menu'        => $settings['menu'],
            'menu_class'  => 'tp-nav-menu',
            'menu_id'     => 'menu-' . $this->get_nav_menu_index() . '-' . $this->get_id(),
            'fallback_cb' => 'Diego_Navwalker_Class::fallback',
            'container'   => '',
            'walker'         => new Diego_Navwalker_Class,
        ];

        $menu_html = wp_nav_menu( $args );



        // group image size
        $size = $settings['tp_image_size_size'];        

		if ( 'custom' !== $size ) {
			$image_size = $size;
		} else {
        	require_once ELEMENTOR_PATH . 'includes/libraries/bfi-thumb/bfi-thumb.php';
			$image_dimension = $settings['tp_image_size_custom_dimension'];
			$image_size = [
				// Defaults sizes.
				0           => null, // Width.
				1           => null, // Height.

				'bfi_thumb' => true,
				'crop'      => true,
			];
			$has_custom_size = false;
			if ( ! empty( $image_dimension['width'] ) ) {
				$has_custom_size = true;
				$image_size[0]   = $image_dimension['width'];
			}

			if ( ! empty( $image_dimension['height'] ) ) {
				$has_custom_size = true;
				$image_size[1]   = $image_dimension['height'];
			}

			if ( ! $has_custom_size ) {
				$image_size = 'full';
			}
		}

        // side logo image size
        $side_logo_size = $settings['tp_side_logo_size_size'];       

		if ( 'custom' !== $side_logo_size ) {
			$side_logo_image_size = $side_logo_size;
		} else {
        	require_once ELEMENTOR_PATH . 'includes/libraries/bfi-thumb/bfi-thumb.php';
			$side_logo_image_dimension = $settings['tp_side_logo_size_custom_dimension'];
			$side_logo_image_size = [
				// Defaults sizes.
				0           => null, // Width.
				1           => null, // Height.

				'bfi_thumb' => true,
				'crop'      => true,
			];
			$side_logo_has_custom_size = false;
			if ( ! empty( $side_logo_image_dimension['width'] ) ) {
				$side_logo_has_custom_size = true;
				$side_logo_image_size[0]   = $side_logo_image_dimension['width'];
			}

			if ( ! empty( $side_logo_image_dimension['height'] ) ) {
				$side_logo_has_custom_size = true;
				$side_logo_image_size[1]   = $side_logo_image_dimension['height'];
			}

			if ( ! $side_logo_has_custom_size ) {
				$side_logo_image_size = 'full';
			}
		}



	    if ( !empty($settings['tp_image']['url']) ) {
	        $tp_image = !empty($settings['tp_image']['id']) ? wp_get_attachment_image_url( $settings['tp_image']['id'], $image_size, true) : $settings['tp_image']['url'];
	        $tp_image_alt = get_post_meta($settings["tp_image"]["id"], "_wp_attachment_image_alt", true);
	    }	    

	    if ( !empty($settings['tp_image_black']['url']) ) {
	        $tp_image_black = !empty($settings['tp_image_black']['id']) ? wp_get_attachment_image_url( $settings['tp_image_black']['id'], $image_size, true) : $settings['tp_image_black']['url'];
	        $tp_image_black_alt = get_post_meta($settings["tp_image_black"]["id"], "_wp_attachment_image_alt", true);
	    }	    

	    if ( !empty($settings['tp_side_logo']['url']) ) {
	        $tp_side_logo = !empty($settings['tp_side_logo']['id']) ? wp_get_attachment_image_url( $settings['tp_side_logo']['id'], $side_logo_image_size, true) : $settings['tp_side_logo']['url'];
	        $tp_side_logo_alt = get_post_meta($settings["tp_side_logo"]["id"], "_wp_attachment_image_alt", true);
	    }

	    if ( !empty($settings['tp_side_logo_black']['url']) ) {
	        $tp_side_logo_black = !empty($settings['tp_side_logo_black']['id']) ? wp_get_attachment_image_url( $settings['tp_side_logo_black']['id'], $side_logo_image_size, true) : $settings['tp_side_logo_black']['url'];
	        $tp_side_logo_black_alt = get_post_meta($settings["tp_side_logo_black"]["id"], "_wp_attachment_image_alt", true);
	    }

       $this->tp_link_controls_render('tpbtn', 'tp-btn-white tp-el-btn', $this->get_settings());
      
       $menu_col = $settings['tp_header_right_switch'] == 'yes' ? 'col-xl-7 d-none d-xl-block' : 'col-xl-10 d-none d-xl-block';
       $menu_class = $settings['tp_header_right_switch'] == 'yes' ? '' : 'd-flex align-items-center justify-content-end';

		?>


   <header>
      <!-- header area start -->
      <div class="tp-header-4__area tp-header-transparent tp-header-4__mob-ptb tp-header-4__plr header tp-el-section">
         <div class="container-fluid">
            <div class="row align-items-center">
               <div class="col-xl-2 col-lg-6 col-md-6 col-6">
                  <div class="tp-header-3__logo">

                     <a class="logo-white" href="<?php print esc_url( home_url( '/' ) );?>">
                        <img src="<?php echo esc_url($tp_image); ?>" alt="<?php echo esc_attr($tp_image_alt); ?>">
                     </a>
                     <a class="logo-black" href="<?php print esc_url( home_url( '/' ) );?>">
                        <img src="<?php echo esc_url($tp_image_black); ?>" alt="<?php echo esc_attr($tp_image_black_alt); ?>">
                     </a>
                  </div>
               </div>


               <div class="<?php echo esc_attr( $menu_col); ?>">
                  <div class="<?php echo esc_attr($menu_class); ?>">
                     <div class="tp-header-4__menu text-center">
                        <nav class="tp-main-menu-content">
                           <?php echo $menu_html; ?>
                        </nav>
                     </div>
                  </div>
               </div>

               <?php if ( !$settings['tp_header_right_switch'] == 'yes' ): ?>
                  <div class="col-lg-6 col-6 d-xl-none">
                     <div class="d-flex align-items-center justify-content-end">
                        <div class="tp-header-3__bar">
                           <button class="tp-menu-bar tp-offcanvas-open-btn tp-el-hamburger-btn">
                              <svg width="32" height="10" viewBox="0 0 32 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                                 <path d="M31 1H1" stroke="currentcolor" stroke-width="2" stroke-linecap="round" />
                                 <path d="M31 9H1" stroke="currentcolor" stroke-width="2" stroke-linecap="round" />
                              </svg>
                           </button>
                        </div>
                     </div>
                  </div>
               <?php endif; ?>



               <?php if ( $settings['tp_header_right_switch'] === 'yes' ) : ?>
               <div class="col-xl-3 col-lg-6 col-md-6 col-6">
                  <div class="tp-header-3__right-action d-flex align-items-center justify-content-end">

                  <?php if($settings['tp_header_toggle'] == 'yes') : ?>
                     <div class="tp-theme-toggle-single">
                        <label class="tp-theme-toggle-main themepure-theme-toggle">
                           <span class="dark">
                              <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                 <path d="M14 7.63063C13.8774 8.95738 13.3795 10.2218 12.5645 11.2759C11.7495 12.33 10.6512 13.1301 9.39801 13.5828C8.14485 14.0354 6.78869 14.1218 5.48822 13.8319C4.18775 13.5419 2.99676 12.8875 2.05461 11.9454C1.11246 11.0032 0.458115 9.81225 0.168141 8.51178C-0.121832 7.21131 -0.0354396 5.85515 0.41721 4.60199C0.86986 3.34883 1.67005 2.2505 2.72413 1.43552C3.77822 0.620536 5.04262 0.122609 6.36937 0C5.5926 1.05088 5.21881 2.34566 5.31599 3.64884C5.41317 4.95202 5.97487 6.17704 6.89892 7.10109C7.82296 8.02513 9.04798 8.58683 10.3512 8.68401C11.6543 8.78119 12.9491 8.4074 14 7.63063Z" fill="white" />
                              </svg>
                           </span>
                           <input type="checkbox" class="themepure-theme-toggle-input">
                           <span class="light">
                              <svg width="21" height="20" viewBox="0 0 21 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                 <path d="M10.0581 14.2166C12.3522 14.2166 14.212 12.3569 14.212 10.0628C14.212 7.7687 12.3522 5.90897 10.0581 5.90897C7.76403 5.90897 5.9043 7.7687 5.9043 10.0628C5.9043 12.3569 7.76403 14.2166 10.0581 14.2166Z"  fill="#FFC05A" />
                                 <path d="M10 1V2.63636" stroke="#FFC05A" stroke-width="2" stroke-linecap="round"  stroke-linejoin="round" />
                                 <path d="M10 17.3637V19.0001" stroke="#FFC05A" stroke-width="2" stroke-linecap="round"  stroke-linejoin="round" />
                                 <path d="M3.63477 3.63455L4.79658 4.79637" stroke="#FFC05A" stroke-width="2"  stroke-linecap="round" stroke-linejoin="round" />
                                 <path d="M15.2031 15.2036L16.3649 16.3654" stroke="#FFC05A" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                 <path d="M1 10.0001H2.63636" stroke="#FFC05A" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                 <path d="M17.3652 10.0001H19.0016" stroke="#FFC05A" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                 <path d="M3.63477 16.3654L4.79658 15.2036" stroke="#FFC05A" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                 <path d="M15.2031 4.79637L16.3649 3.63455" stroke="#FFC05A" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                              </svg>
                           </span>
                        </label>
                     </div>
                     <?php endif; ?>

                     <?php if (!empty($settings['tp_' . $control_id .'_text']) && $settings['tp_' . $control_id .'_button_show'] == 'yes') : ?>
                     <div class="tp-header-3__btn d-none d-md-block">
                        <a <?php echo $this->get_render_attribute_string( 'tp-button-arg' . $control_id .'' ); ?>>
                        <?php echo $settings['tp_' . $control_id .'_text']; ?>
                           <span>
                              <svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                 <path  d="M4.9297 10.3651C5.12061 10.2162 5.29376 10.043 5.64006 9.69671L9.95722 5.37954C10.0616 5.27517 10.0138 5.0954 9.87438 5.04702C9.36479 4.87022 8.70189 4.53829 8.0818 3.9182C7.46171 3.29811 7.12978 2.63521 6.95299 2.12562C6.9046 1.98617 6.72483 1.9384 6.62046 2.04278L2.30329 6.35994L2.30328 6.35995C1.95699 6.70624 1.78385 6.87939 1.63494 7.0703C1.45928 7.29551 1.30868 7.53919 1.18581 7.79701C1.08164 8.01558 1.00421 8.24789 0.849336 8.71249L0.649225 9.31283L0.331026 10.2674L0.0326691 11.1625C-0.0435433 11.3911 0.0159628 11.6432 0.186379 11.8136C0.356795 11.984 0.608868 12.0435 0.837505 11.9673L1.73258 11.669L2.68717 11.3508L3.28751 11.1507C3.75211 10.9958 3.98442 10.9184 4.20299 10.8142C4.46082 10.6913 4.70449 10.5407 4.9297 10.3651Z" fill="currentcolor" />
                                 <path d="M11.3089 4.02783C12.2304 3.10641 12.2304 1.61249 11.3089 0.691067C10.3875 -0.230356 8.89359 -0.230356 7.97217 0.691067L7.83337 0.82986C7.69944 0.963792 7.63876 1.15087 7.67222 1.3373C7.69327 1.45458 7.73229 1.62603 7.80327 1.83063C7.94522 2.23979 8.21329 2.77689 8.7182 3.2818C9.22311 3.78671 9.76021 4.05478 10.1694 4.19673C10.374 4.26772 10.5454 4.30673 10.6627 4.32778C10.8491 4.36124 11.0362 4.30056 11.1701 4.16663L11.3089 4.02783Z" fill="currentcolor" />
                              </svg>
                           </span>
                        </a>
                     </div>
                     <?php endif; ?>


                          
                     <?php if($settings['tp_header_hamburger'] == 'yes') : ?>
                     <div class="tp-header-3__bar">
                        <button class="tp-menu-bar tp-offcanvas-open-btn tp-el-hamburger-btn">
                           <svg width="32" height="10" viewBox="0 0 32 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                              <path d="M31 1H1" stroke="currentcolor" stroke-width="2" stroke-linecap="round" />
                              <path d="M31 9H1" stroke="currentcolor" stroke-width="2" stroke-linecap="round" />
                           </svg>
                        </button>
                     </div>
                     <?php endif; ?>
                          
                     <?php if(!$settings['tp_header_hamburger'] == 'yes') : ?>
                     <div class="tp-header-3__bar d-xl-none">
                        <button class="tp-menu-bar tp-offcanvas-open-btn tp-el-hamburger-btn">
                           <svg width="32" height="10" viewBox="0 0 32 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                              <path d="M31 1H1" stroke="currentcolor" stroke-width="2" stroke-linecap="round" />
                              <path d="M31 9H1" stroke="currentcolor" stroke-width="2" stroke-linecap="round" />
                           </svg>
                        </button>
                     </div>
                     <?php endif; ?>
                  </div>
               </div>
               <?php endif; ?>
            </div>
         </div>
      </div>
      <!-- header area end -->
   </header>

   <header>
      <!-- header area start -->
      <div class="tp-header-4__area tp-header-transparent tp-header-4__mob-ptb tp-header-4__plr tp-int-menu tp-header-sticky-cloned">
         <div class="container-fluid">
            <div class="row align-items-center">
               <div class="col-xl-2 col-lg-6 col-md-6 col-6">
                  <div class="tp-header-3__logo">
                     <a class="logo-white" href="<?php print esc_url( home_url( '/' ) );?>">
                        <img src="<?php echo esc_url($tp_image); ?>" alt="<?php echo esc_attr($tp_image_alt); ?>">
                     </a>
                     <a class="logo-black" href="<?php print esc_url( home_url( '/' ) );?>">
                        <img src="<?php echo esc_url($tp_image_black); ?>" alt="<?php echo esc_attr($tp_image_black_alt); ?>">
                     </a>
                  </div>
               </div>


               <div class="<?php echo esc_attr( $menu_col); ?>">
                  <div class="<?php echo esc_attr($menu_class); ?>">
                     <div class="tp-header-4__menu text-center">
                        <nav class="tp-main-menu-content">
                           <?php echo $menu_html; ?>
                        </nav>
                     </div>
                  </div>
               </div>

               <?php if ( !$settings['tp_header_right_switch'] == 'yes' ): ?>
                  <div class="col-lg-6 col-6 d-xl-none">
                     <div class="d-flex align-items-center justify-content-end">
                        <div class="tp-header-3__bar">
                           <button class="tp-menu-bar tp-offcanvas-open-btn">
                              <svg width="32" height="10" viewBox="0 0 32 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                                 <path d="M31 1H1" stroke="currentcolor" stroke-width="2" stroke-linecap="round" />
                                 <path d="M31 9H1" stroke="currentcolor" stroke-width="2" stroke-linecap="round" />
                              </svg>
                           </button>
                        </div>
                     </div>
                  </div>
               <?php endif; ?>



               <?php if ( $settings['tp_header_right_switch'] === 'yes' ) : ?>
               <div class="col-xl-3 col-lg-6 col-md-6 col-6">
                  <div class="tp-header-3__right-action d-flex align-items-center justify-content-end">

                  <?php if($settings['tp_header_toggle'] == 'yes') : ?>
                     <div class="tp-theme-toggle-single">
                        <label class="tp-theme-toggle-main themepure-theme-toggle">
                           <span class="dark">
                              <svg width="14" height="14" viewBox="0 0 14 14" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                 <path
                                    d="M14 7.63063C13.8774 8.95738 13.3795 10.2218 12.5645 11.2759C11.7495 12.33 10.6512 13.1301 9.39801 13.5828C8.14485 14.0354 6.78869 14.1218 5.48822 13.8319C4.18775 13.5419 2.99676 12.8875 2.05461 11.9454C1.11246 11.0032 0.458115 9.81225 0.168141 8.51178C-0.121832 7.21131 -0.0354396 5.85515 0.41721 4.60199C0.86986 3.34883 1.67005 2.2505 2.72413 1.43552C3.77822 0.620536 5.04262 0.122609 6.36937 0C5.5926 1.05088 5.21881 2.34566 5.31599 3.64884C5.41317 4.95202 5.97487 6.17704 6.89892 7.10109C7.82296 8.02513 9.04798 8.58683 10.3512 8.68401C11.6543 8.78119 12.9491 8.4074 14 7.63063Z"
                                    fill="white" />
                              </svg>
                           </span>
                           <input type="checkbox" class="themepure-theme-toggle-input">
                           <span class="light">
                              <svg width="21" height="20" viewBox="0 0 21 20" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                 <path
                                    d="M10.0581 14.2166C12.3522 14.2166 14.212 12.3569 14.212 10.0628C14.212 7.7687 12.3522 5.90897 10.0581 5.90897C7.76403 5.90897 5.9043 7.7687 5.9043 10.0628C5.9043 12.3569 7.76403 14.2166 10.0581 14.2166Z"
                                    fill="#FFC05A" />
                                 <path d="M10 1V2.63636" stroke="#FFC05A" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" />
                                 <path d="M10 17.3637V19.0001" stroke="#FFC05A" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" />
                                 <path d="M3.63477 3.63455L4.79658 4.79637" stroke="#FFC05A" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round" />
                                 <path d="M15.2031 15.2036L16.3649 16.3654" stroke="#FFC05A" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round" />
                                 <path d="M1 10.0001H2.63636" stroke="#FFC05A" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" />
                                 <path d="M17.3652 10.0001H19.0016" stroke="#FFC05A" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round" />
                                 <path d="M3.63477 16.3654L4.79658 15.2036" stroke="#FFC05A" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round" />
                                 <path d="M15.2031 4.79637L16.3649 3.63455" stroke="#FFC05A" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round" />
                              </svg>
                           </span>
                        </label>
                     </div>
                     <?php endif; ?>

                     <?php if (!empty($settings['tp_' . $control_id .'_text']) && $settings['tp_' . $control_id .'_button_show'] == 'yes') : ?>
                     <div class="tp-header-3__btn d-none d-md-block">
                        <a <?php echo $this->get_render_attribute_string( 'tp-button-arg' . $control_id .'' ); ?>>
                        <?php echo $settings['tp_' . $control_id .'_text']; ?>
                           <span>
                              <svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                 <path  d="M4.9297 10.3651C5.12061 10.2162 5.29376 10.043 5.64006 9.69671L9.95722 5.37954C10.0616 5.27517 10.0138 5.0954 9.87438 5.04702C9.36479 4.87022 8.70189 4.53829 8.0818 3.9182C7.46171 3.29811 7.12978 2.63521 6.95299 2.12562C6.9046 1.98617 6.72483 1.9384 6.62046 2.04278L2.30329 6.35994L2.30328 6.35995C1.95699 6.70624 1.78385 6.87939 1.63494 7.0703C1.45928 7.29551 1.30868 7.53919 1.18581 7.79701C1.08164 8.01558 1.00421 8.24789 0.849336 8.71249L0.649225 9.31283L0.331026 10.2674L0.0326691 11.1625C-0.0435433 11.3911 0.0159628 11.6432 0.186379 11.8136C0.356795 11.984 0.608868 12.0435 0.837505 11.9673L1.73258 11.669L2.68717 11.3508L3.28751 11.1507C3.75211 10.9958 3.98442 10.9184 4.20299 10.8142C4.46082 10.6913 4.70449 10.5407 4.9297 10.3651Z" fill="currentcolor" />
                                 <path d="M11.3089 4.02783C12.2304 3.10641 12.2304 1.61249 11.3089 0.691067C10.3875 -0.230356 8.89359 -0.230356 7.97217 0.691067L7.83337 0.82986C7.69944 0.963792 7.63876 1.15087 7.67222 1.3373C7.69327 1.45458 7.73229 1.62603 7.80327 1.83063C7.94522 2.23979 8.21329 2.77689 8.7182 3.2818C9.22311 3.78671 9.76021 4.05478 10.1694 4.19673C10.374 4.26772 10.5454 4.30673 10.6627 4.32778C10.8491 4.36124 11.0362 4.30056 11.1701 4.16663L11.3089 4.02783Z" fill="currentcolor" />
                              </svg>
                           </span>
                        </a>
                     </div>
                     <?php endif; ?>

                     <?php if($settings['tp_header_hamburger'] == 'yes') : ?>
                     <div class="tp-header-3__bar">
                        <button class=" tp-menu-bar tp-offcanvas-open-btn">
                           <svg width="32" height="10" viewBox="0 0 32 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                              <path d="M31 1H1" stroke="currentcolor" stroke-width="2" stroke-linecap="round" />
                              <path d="M31 9H1" stroke="currentcolor" stroke-width="2" stroke-linecap="round" />
                           </svg>
                        </button>
                     </div>
                     <?php endif; ?>

                     <?php if(!$settings['tp_header_hamburger'] == 'yes') : ?>
                     <div class="tp-header-3__bar  d-xl-none">
                        <button class=" tp-menu-bar tp-offcanvas-open-btn">
                           <svg width="32" height="10" viewBox="0 0 32 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                              <path d="M31 1H1" stroke="currentcolor" stroke-width="2" stroke-linecap="round" />
                              <path d="M31 9H1" stroke="currentcolor" stroke-width="2" stroke-linecap="round" />
                           </svg>
                        </button>
                     </div>
                     <?php endif; ?>
                  </div>
               </div>
               <?php endif; ?>
            </div>
         </div>
      </div>
      <!-- header area start -->
   </header>




   <?php include(TPCORE_ELEMENTS_PATH . '/header-side/header-side-1.php'); ?>


<?php 
	}
}

$widgets_manager->register( new TP_Header_01() );
