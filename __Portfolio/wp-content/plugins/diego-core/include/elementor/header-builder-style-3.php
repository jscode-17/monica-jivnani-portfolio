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
class TP_Header_03 extends Widget_Base {

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
		return 'tp-header-3';
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
		return __( 'Header Builder Style 3', 'tpcore' );
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
      
      $this->add_control(
      'tp_contact_mail',
       [
          'label'       => esc_html__( 'Mail Text', 'tpcore' ),
          'type'        => \Elementor\Controls_Manager::TEXT,
          'default'     => esc_html__( 'Diego@mail.com', 'tpcore' ),
          'placeholder' => esc_html__( 'Your Text', 'tpcore' ),
          'label_block' => true
       ]
      );
      $this->add_control(
       'tp_contact_mail_url',
       [
         'label'   => esc_html__( 'Mail URL', 'tpcore' ),
         'type'        => \Elementor\Controls_Manager::URL,
         'default'     => [
             'url'               => '#',
             'is_external'       => true,
             'nofollow'          => true,
             'custom_attributes' => '',
           ],
           'placeholder' => esc_html__( 'Your Text', 'tpcore' ),
           'label_block' => true,
         ]
       );
      
      $this->end_controls_section();


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

         $menus = $this->get_available_menus();

        if ( ! empty( $menus ) ) {
            $this->add_control(
                'menu_offcanvas',
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
                'menu_offcanvas',
                [
                    'type'            => Controls_Manager::RAW_HTML,
                    /* translators: %s Nav menu URL */
                    'raw'             => sprintf( __( '<strong>There are no menus in your site.</strong><br>Go to the <a href="%s" target="_blank">Menus screen</a> to create one.', 'header-footer-elementor' ), admin_url( 'nav-menus.php?action=edit&menu=0' ) ),
                    'content_classes' => 'elementor-panel-alert elementor-panel-alert-info',
                ]
            );
        }

        $this->add_control(
            'menu_last_item_offcanvas',
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
        $this->tp_link_controls_style('header_btn', 'Header - Button BG', '.tp-header-3__btn a');
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

        $args2 = [
            'echo'        => false,
            'menu'        => $settings['menu_offcanvas'],
            'menu_class'  => 'tp-nav-menu',
            'menu_id'     => 'menu-' . $this->get_nav_menu_index() . '-' . $this->get_id(),
            'fallback_cb' => 'Diego_Navwalker_Class::fallback',
            'container'   => '',
            'walker'         => new Diego_Navwalker_Class,
        ];

        $menu_html_offcanvas = wp_nav_menu( $args2 );



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

              
       $menu_col = $settings['tp_header_right_switch'] == 'yes' ? 'col-xl-7 d-none d-xl-block' : 'col-xl-10 d-none d-xl-block';
       $menu_class = $settings['tp_header_right_switch'] == 'yes' ? '' : 'd-flex align-items-center justify-content-end';
      
		?>


   <!-- header area start -->
   <header>
      <div class="tp-header-2__area tp-header-2__plr tp-header-2__transparent ">
         <div class="container-fluid">
            <div class="row align-items-center">
               <div class="col-xl-2 col-lg-5 col-md-4 col-6">
                  <div class="tp-header-2__logo">
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
                        <div class="tp-header-2__main-menu text-center">
                            <nav id="onePageMenu">
                                <?php echo $menu_html; ?>
                            </nav>
                            <div class="d-none">
                                <nav class="tp-main-menu-content">
                                    <?php echo $menu_html_offcanvas; ?>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>

                <?php if ( !$settings['tp_header_right_switch'] == 'yes' ): ?>
                  <div class="col-lg-7 col-nd-8 col-6 d-xl-none">
                     <div class="d-flex align-items-center justify-content-end">
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
               <?php endif; ?>


                <?php if ( $settings['tp_header_right_switch'] == 'yes' ): ?>
               <div class="col-xl-3 col-lg-7 col-md-8 col-6">
                  <div class="tp-header-2__right-box d-flex align-items-center justify-content-end">
                    <?php if(!empty($settings['tp_contact_mail'])) : ?>
                     <div class="tp-header-2__maito d-none d-sm-block">
                        <span>
                           <svg width="18" height="16" viewBox="0 0 18 16" fill="none"  xmlns="http://www.w3.org/2000/svg">
                              <path d="M13.0005 14.6H5.00049C2.60049 14.6 1.00049 13.4 1.00049 10.6V5C1.00049 2.2 2.60049 1 5.00049 1L13.0005 1C15.4005 1 17.0005 2.2 17.0005 5V10.6C17.0005 13.4 15.4005 14.6 13.0005 14.6Z" stroke="currentcolor" stroke-opacity="0.8" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
                              <path d="M13.0005 5.39984L10.4965 7.39984C9.67248 8.05584 8.32048 8.05584 7.49648 7.39984L5.00049 5.39984"  stroke="currentcolor" stroke-opacity="0.8" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
                           </svg>
                        </span>
                        <a href="mailto:<?php echo esc_url($settings['tp_contact_mail_url']['url']) ?>"><?php echo esc_html($settings['tp_contact_mail']); ?></a>
                     </div>
                     <?php endif; ?>

                     <?php if($settings['tp_header_hamburger'] == 'yes') : ?>
                     <div class="tp-header-2__bar parallax-wrap">
                        <button class="tp-menu-bar parallax-element tp-offcanvas-open-btn">
                           <i>
                              <span></span>
                              <span></span>
                           </i>
                        </button>
                     </div>
                     <?php endif; ?>

                     <?php if(!$settings['tp_header_hamburger'] == 'yes') : ?>
                     <div class="tp-header-2__bar parallax-wrap d-xl-none">
                        <button class="tp-menu-bar parallax-element tp-offcanvas-open-btn">
                           <i>
                              <span></span>
                              <span></span>
                           </i>
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



   <?php include(TPCORE_ELEMENTS_PATH . '/header-side/header-side-1.php'); ?>


<?php 
	}
}

$widgets_manager->register( new TP_Header_03() );