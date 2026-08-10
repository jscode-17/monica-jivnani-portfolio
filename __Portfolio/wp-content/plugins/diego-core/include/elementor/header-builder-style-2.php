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
class TP_Header_02 extends Widget_Base {

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
		return 'tp-header-2';
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
		return __( 'Header Builder Style 2', 'tpcore' );
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

      $this->start_controls_section(
       'tp_button_sec',
           [
             'label' => esc_html__( 'Button', 'tpcore' ),
             'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
           ]
      );
      
      $this->add_control(
       'header_cv_button_url',
       [
         'label'   => esc_html__( 'Button URL', 'tpcore' ),
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

     

       $this->add_control(
          'header_cv_button_icon',
            [
              'label' => esc_html__( 'Header Icon', 'tpcore' ),
              'type' => \Elementor\Controls_Manager::ICONS,
              'default' => [
                'value' => 'fas fa-circle',
                'library' => 'fa-solid',
            ],
              'recommended' => [
                'fa-solid' => [
                'circle',
                  'dot-circle',
                  'square-full',
                  ],
                  'fa-regular' => [
                  'circle',
                  'dot-circle',
                  'square-full',
                ],
              ],
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

         $this->add_control(
         'tp_offcanvas_welcome_text',
          [
             'label'       => esc_html__( 'Welcome Text', 'tpcore' ),
             'type'        => \Elementor\Controls_Manager::TEXT,
             'default'     => esc_html__( 'Welcome to Diego', 'tpcore' ),
             'placeholder' => esc_html__( 'Your Text', 'tpcore' ),
             'label_block' => true
          ]
         );

         $this->add_control(
          'tp_offcanvas_welcome_desc',
          [
            'label'       => esc_html__( 'Welcome Description', 'tpcore' ),
            'type'        => \Elementor\Controls_Manager::TEXTAREA,
            'rows'        => 10,
            'default'     => esc_html__( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit', 'tpcore' ),
            'placeholder' => esc_html__( 'Your Text', 'tpcore' ),
          ]
         );

        $this->end_controls_section();


        $this->start_controls_section(
         'tp_social_section',
         [
             'label' => __( 'Social Links', 'tpcore' ),
             'tab' => Controls_Manager::TAB_CONTENT,
         ]
     );
   
     $this->add_control(
     'tp_social_main_title',
      [
         'label'       => esc_html__( 'Title', 'tpcore' ),
         'type'        => \Elementor\Controls_Manager::TEXT,
         'default'     => esc_html__( 'Follow', 'tpcore' ),
         'placeholder' => esc_html__( 'Your Text', 'tpcore' ),
      ]
     );

   $repeater = new \Elementor\Repeater();

     $repeater->add_control(
         'repeater_condition',
         [
             'label' => __( 'Field condition', 'tpcore' ),
             'type' => Controls_Manager::SELECT,
             'options' => [
                 'style_1' => __( 'Style 1', 'tpcore' ),
                 'style_2' => __( 'Style 2', 'tpcore' ),
             ],
             'default' => 'style_1',
             'frontend_available' => true,
             'style_transfer' => true,
         ]
     );

     $repeater->add_control(
     'tp_social_link_text',
      [
         'label'       => esc_html__( 'Social Title', 'tpcore' ),
         'type'        => \Elementor\Controls_Manager::TEXT,
         'label_block' => true,
         'description' => esc_html__( 'This is only for showing the title, it wont show in frontend', 'tpcore' ),
         'default'     => esc_html__( 'Social 1', 'tpcore' ),
         'placeholder' => esc_html__( 'Your Text', 'tpcore' ),
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
     'tp_social_link',
     [
      'label'   => esc_html__( 'Social Link', 'tpcore' ),
      'type'        => \Elementor\Controls_Manager::URL,
      'default'     => [
         'url'               => '#',
         'is_external'       => true,
         'nofollow'          => true,
         'custom_attributes' => '',
        ],
        'placeholder' => esc_html__( 'Your Link Here', 'tpcore' ),
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
          'tp_social_link_text'   => esc_html__( 'Social 1', 'tpcore' ),
         ],
         [
          'tp_social_link_text'   => esc_html__( 'Social 2', 'tpcore' ),
         ],
         [
          'tp_social_link_text'   => esc_html__( 'Social 3', 'tpcore' ),
         ],
       ],
       'title_field' => '{{{ tp_social_link_text }}}',
      ]
    );

    $this->add_group_control(
         Group_Control_Image_Size::get_type(),
         [
             'name' => 'thumbnail', // // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `thumbnail_size` and `thumbnail_custom_dimension`.
             'exclude' => ['custom'],
         ]
     );
     $this->end_controls_section();

     $this->start_controls_section(
      'tp_portfolio_thumb_sec',
          [
            'label' => esc_html__( 'Thumbnails', 'tpcore' ),
            'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
          ]
     );
     
     
     $repeater = new \Elementor\Repeater();
     
     $repeater->add_control(
      'tp_portfolio_image',
      [
        'label'   => esc_html__( 'Upload Thumbnail', 'tpcore' ),
        'type'    => \Elementor\Controls_Manager::MEDIA,
          'default' => [
            'url' => \Elementor\Utils::get_placeholder_image_src(),
        ],
      ]
     );
     $repeater->add_control(
      'tp_portfolio_image_url',
      [
          'type' => Controls_Manager::TEXT,
          'label_block' => true,
          'label' => __( 'URL', 'tpcore' ),
          'default' => __( '#', 'tpcore' ),
          'placeholder' => __( 'Type url here', 'tpcore' ),
          'dynamic' => [
              'active' => true,
          ]
      ]
  );
      
      $this->add_control(
        'tp_portfolio_thumb_list',
        [
          'label'       => esc_html__( 'Thumbnail List', 'tpcore' ),
          'type'        => \Elementor\Controls_Manager::REPEATER,
          'fields'      => $repeater->get_controls(),
          'default'     => [
              [
                  'tp_portfolio_image' => [
                      'url' => Utils::get_placeholder_image_src(),
                  ],
              ],
              [
                  'tp_portfolio_image' => [
                      'url' => Utils::get_placeholder_image_src(),
                  ],
              ],
          
          ],
          'dynamic' => [
              'active' => true,
          ],
        ]
      );
     
      $this->add_group_control(
         Group_Control_Image_Size::get_type(),
         [
             'name' => 'tp_portfolio_size',
             'default' => 'full',
             'exclude' => [
                 'custom'
             ]
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
         'tp_contact_main_title',
          [
             'label'       => esc_html__( 'Title', 'tpcore' ),
             'type'        => \Elementor\Controls_Manager::TEXT,
             'default'     => esc_html__( 'Follow', 'tpcore' ),
             'placeholder' => esc_html__( 'Your Text', 'tpcore' ),
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
             'placeholder' => esc_html__( 'Your Text', 'tpcore' ),
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
             'placeholder' => esc_html__( 'Your Text', 'tpcore' ),
             'label_block' => true,
           ]
         );
        
         $this->add_control(
            'tp_offcanvas_address',
             [
                'label'       => esc_html__( 'Offcanvas Address', 'tpcore' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => esc_html__( 'New Jonshon St. New York', 'tpcore' ),
                'placeholder' => esc_html__( 'Your Text', 'tpcore' ),
                'label_block' => true
             ]
            );

        $this->add_control(
         'tp_offcanvas_address_url',
         [
           'label'   => esc_html__( 'Address URL', 'tpcore' ),
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
           'label'      => esc_html__( 'Menu Spacing', 'tpcore' ),
           'type'       => \Elementor\Controls_Manager::DIMENSIONS,
           'size_units' => [ 'px', '%', 'em' ],
           'selectors'  => [
             '{{WRAPPER}} .main-menu > nav > ul > li' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
           ],
         ]
       );

      $this->add_control(
         'tp_menu_submenu',
            [
               'label' => esc_html__('Submenu Background Color', 'tp-core'),
               'type' => Controls_Manager::COLOR,
               'selectors' => [
                  '{{WRAPPER}} .main-menu > nav > ul > li .submenu' => 'background: {{VALUE}} !important;',
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
            'label'   => esc_html__( 'Menu Typography', 'tpcore' ),
            'selector' => '{{WRAPPER}} .main-menu > nav > ul > li a',
          ]
        );

     $this->start_controls_tabs(
        'menu_normal_state',
      );
     
         $this->start_controls_tab(
            'menu_normal',
               [
                  'label'   => esc_html__( 'Normal', 'tpcore' ),
               ]
            );

            $this->add_control(
               'tp_menu_normal_color',
                  [
                     'label' => esc_html__('Menu Color', 'tp-core'),
                     'type' => Controls_Manager::COLOR,
                     'selectors' => [
                        '{{WRAPPER}}  .main-menu > nav > ul > li > a' => 'color: {{VALUE}} !important;',
                     ],
                  ]
               );
         
              $this->add_control(
               'tp_menu_normal_submenu_color',
                  [
                     'label' => esc_html__('Submenu Color', 'tp-core'),
                     'type' => Controls_Manager::COLOR,
                     'selectors' => [
                        '{{WRAPPER}} .main-menu > nav > ul > li .submenu > li > a' => 'color: {{VALUE}} !important;',
                     ],
                  ]
               );
         
              $this->add_control(
               'tp_menu_normal_line',
                  [
                     'label' => esc_html__('Menu Line Color', 'tp-core'),
                     'type' => Controls_Manager::COLOR,
                     'selectors' => [
                        '{{WRAPPER}} .main-menu > nav > ul > li > a::after' => 'background: {{VALUE}} !important;',
                     ],
                  ]
               );
         
         $this->end_controls_tab();

         $this->start_controls_tab(
            'menu_hover',
            [
               'label'   => esc_html__( 'Hover', 'tpcore' ),
            ]
            );

            $this->add_control(
               'tp_menu_hover_color',
                  [
                     'label' => esc_html__('Menu Hover Color', 'tp-core'),
                     'type' => Controls_Manager::COLOR,
                     'selectors' => [
                        '{{WRAPPER}} .main-menu > nav > ul > li:hover > a' => 'color: {{VALUE}} !important;',
                     ],
                  ]
               );
         
              $this->add_control(
               'tp_menu_hover_submenu_color',
                  [
                     'label' => esc_html__('Submenu Hover Color', 'tp-core'),
                     'type' => Controls_Manager::COLOR,
                     'selectors' => [
                        '{{WRAPPER}} .main-menu > nav > ul > li .submenu > li:hover > a' => 'color: {{VALUE}} !important;',
                     ],
                  ]
               );
         
              $this->add_control(
               'tp_menu_hover_line',
                  [
                     'label' => esc_html__('Menu Hover Line Color', 'tp-core'),
                     'type' => Controls_Manager::COLOR,
                     'selectors' => [
                        '{{WRAPPER}} .main-menu > nav > ul > li:hover > a::after' => 'background: {{VALUE}} !important;',
                     ],
                  ]
               );
         
         $this->end_controls_tab();
     
     $this->end_controls_tabs();



     $this->end_controls_section();
     
      $this->tp_link_controls_style('offcanvas_btn', 'Offcanvas - Button', '.tp-header-cv-btn');

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
               '{{WRAPPER}} .tp-hamburger-btn span::after, {{WRAPPER}} .tp-hamburger-btn span::before, {{WRAPPER}} .tp-hamburger-btn span' => 'background: {{VALUE}} !important;',
            ],
         ]
      );

     $this->end_controls_section();


      $this->start_controls_section(
         'tp_border_bottom_sec',
         [
             'label' => esc_html__('Header Border Color', 'tp-core'),
             'tab' => Controls_Manager::TAB_STYLE,
         ]
     );


     $this->add_control(
      'tp_border_bottom',
         [
            'label' => esc_html__('Background Color', 'tp-core'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
               '{{WRAPPER}} .tp-header-border' => 'background: {{VALUE}} !important;',
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



     $this->add_control(
      'tp_theme_toggle_btn_light',
         [
            'label' => esc_html__('Light Icon Color', 'tp-core'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
               '{{WRAPPER}} .tp-theme-toggle-light' => 'color: {{VALUE}} !important;',
            ],
         ]
      );

     $this->add_control(
      'tp_theme_toggle_btn_dark',
         [
            'label' => esc_html__('Dark Icon Color', 'tp-core'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
               '{{WRAPPER}} .tp-theme-toggle-dark' => 'color: {{VALUE}} !important;',
            ],
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
      $this->tp_section_style_controls('offcanvas_sec', 'Offcanvas - Style', '.tp-offcanvas-area-2');

      $this->tp_basic_style_controls('wel_title', 'Offcanvas - Heading', '.tp-offcanvas-content-title-2');
      $this->tp_basic_style_controls('wel_desc', 'Offcanvas - Description', '.tp-offcanvas-content-2 p');

      $this->tp_basic_style_controls('contact_title', 'Offcanvas - Contact - Title', '.tp-offcanvas-contact-2 .tp-offcanvas-contact-title-2');
      $this->tp_link_controls_style('contact_list', 'Offcanvas - Contact - List', '.tp-offcanvas-contact-2 ul li a');

      $this->tp_basic_style_controls('social_title', 'Offcanvas - Social - Title', '.tp-offcanvas-social-2 .tp-offcanvas-contact-title-2');
      $this->tp_link_controls_style('social_list', 'Offcanvas - Social - List', '.tp-offcanvas-social-2 ul li a');


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


         $menu_col = $settings['tp_header_right_switch'] == 'yes' ? 'col-xl-6 col-lg-7 d-none d-lg-block' : 'col-xl-10 col-lg-10 d-none d-lg-block';
         $menu_class = $settings['tp_header_right_switch'] == 'yes' ? '' : 'd-flex align-items-center justify-content-end';


         if ( ! empty( $settings['header_cv_button_url']['url'] ) ) {
            $this->add_link_attributes( 'tp-button-arg-header-cv', $settings['header_cv_button_url'] );
            $this->add_render_attribute('tp-button-arg-header-cv', 'class', 'tp-header-cv-btn tp-el-header-btn tp-el-btn');
         }

		?>


   <!-- header area start -->
   <header>
      <div class="tp-header-area tp-header-mob-space tp-header-transparent p-relative">
         <span class="tp-header-border"></span>
         <div class="container container-large">
            <div class="row align-items-center">

               <div class="col-xl-2 col-lg-2 col-md-5 col-6">
                  <div class="logo">
                     <a class="logo-white" href="<?php print esc_url( home_url( '/' ) );?>">
                        <img src="<?php echo esc_url($tp_image); ?>" alt="<?php echo esc_attr($tp_image_alt); ?>">
                     </a>
                     <a class="logo-black" href="<?php print esc_url( home_url( '/' ) );?>">
                        <img src="<?php echo esc_url($tp_image_black); ?>" alt="<?php echo esc_attr($tp_image_black_alt); ?>">
                     </a>
                  </div>
               </div>

               <div class="<?php echo esc_attr( $menu_col); ?>">
                  <div class="main-menu header-menu-main tp-el-menu <?php echo esc_attr($menu_class); ?>">
                     <nav class="tp-main-menu-content">
                      <?php echo $menu_html; ?>
                     </nav>
                  </div>
               </div>

               <?php if ( !$settings['tp_header_right_switch'] == 'yes' ): ?>
               <div class="col-md-8 col-6 d-lg-none">
                  <div class="d-flex align-items-center justify-content-end">
                     <div class="tp-header-hamburger ml-20">
                        <button class="tp-hamburger-btn tp-hamburger-btn-white tp-menu-bar tp-offcanvas-open-btn-2 tp-el-hamburger" type="button">
                           <span></span>
                        </button>
                     </div>
                  </div>
               </div>
               <?php endif; ?>


               <?php if ( $settings['tp_header_right_switch'] == 'yes' ): ?>
               <div class="col-xl-4 col-lg-3 col-md-7 col-6">
                  <div class="tp-header-right d-flex align-items-center justify-content-end">

                     <?php if($settings['tp_header_toggle'] == 'yes') : ?>
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
                     <?php endif; ?>

                     <?php if ($settings['header_cv_button_url']['url']): ?>
                     <div class="tp-header-cv ml-10 d-none d-md-block">
                        <a <?php echo $this->get_render_attribute_string( 'tp-button-arg-header-cv' ); ?>>
                           <?php \Elementor\Icons_Manager::render_icon( $settings['header_cv_button_icon'], [ 'aria-hidden' => 'true' ] ); ?>
                        </a>
                     </div>
                     <?php endif; ?>

                     
                     <?php if($settings['tp_header_hamburger'] == 'yes') : ?>
                     <div class="tp-header-hamburger ml-20">
                        <button class="tp-hamburger-btn tp-hamburger-btn-white tp-menu-bar tp-offcanvas-open-btn-2 tp-el-hamburger"
                           type="button">
                           <span></span>
                        </button>
                     </div>
                     <?php endif; ?>

                     
                     <?php if(!$settings['tp_header_hamburger'] == 'yes') : ?>
                     <div class="tp-header-hamburger ml-20 d-lg-none">
                        <button class="tp-hamburger-btn tp-hamburger-btn-white tp-menu-bar tp-offcanvas-open-btn-2 tp-el-hamburger"
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
                     <a class="logo-white" href="<?php print esc_url( home_url( '/' ) );?>">
                        <img src="<?php echo esc_url($tp_image); ?>" alt="<?php echo esc_attr($tp_image_alt); ?>">
                     </a>
                     <a class="logo-black" href="<?php print esc_url( home_url( '/' ) );?>">
                        <img src="<?php echo esc_url($tp_image_black); ?>" alt="<?php echo esc_attr($tp_image_black_alt); ?>">
                     </a>
                  </div>
               </div>


               <div class="<?php echo esc_attr( $menu_col); ?>">
                  <div class="main-menu header-menu-sticky text-center <?php echo esc_attr($menu_class); ?>">
                     <nav class="tp-main-menu-content">
                        <?php echo $menu_html; ?>
                     </nav>
                  </div>
               </div>

               <?php if ( !$settings['tp_header_right_switch'] == 'yes' ): ?>
               <div class="col-md-7 col-6 d-lg-none">
                  <div class="d-flex align-items-center justify-content-end">
                     <div class="tp-header-hamburger ml-20">
                        <button class="tp-hamburger-btn tp-hamburger-btn-white tp-menu-bar tp-offcanvas-open-btn-2"
                           type="button">
                           <span></span>
                        </button>
                     </div>
                  </div>
               </div>
               <?php endif; ?>



               <?php if ( $settings['tp_header_right_switch'] == 'yes' ): ?>
               <div class="col-xl-2 col-lg-3 col-md-7 col-6">
                  <div class="tp-header-right d-flex align-items-center justify-content-end">

                     <?php if($settings['tp_header_toggle'] == 'yes') : ?>
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
                     <?php endif; ?>

                     <?php if ($settings['header_cv_button_url']['url']): ?>
                     <div class="tp-header-cv ml-10 d-none d-md-block">
                        <a class="tp-header-cv-btn" href="<?php echo esc_url($settings['header_cv_button_url']['url']); ?>">
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

                     <?php if($settings['tp_header_hamburger'] == 'yes') : ?>
                     <div class="tp-header-hamburger ml-20">
                        <button class="tp-hamburger-btn tp-hamburger-btn-white tp-menu-bar tp-offcanvas-open-btn-2"
                           type="button">
                           <span></span>
                        </button>
                     </div>
                     <?php endif; ?>

                     <?php if(!$settings['tp_header_hamburger'] == 'yes') : ?>
                     <div class="tp-header-hamburger ml-20  d-lg-none">
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

   <?php include(TPCORE_ELEMENTS_PATH . '/header-side/header-side-2.php'); ?>


<?php 
	}
}

$widgets_manager->register( new TP_Header_02() );