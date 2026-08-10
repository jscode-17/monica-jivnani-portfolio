<?php
namespace TPCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Repeater;
use \Elementor\Utils;
use \Elementor\Control_Media;
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Tp Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class TP_Hero_Slider extends Widget_Base {

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
		return 'tp-slider';
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
		return __( 'Hero Slider', 'tpcore' );
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
                    'layout-2' => esc_html__('Layout 2', 'tpcore'),
                    'layout-3' => esc_html__('Layout 3', 'tpcore'),
                ],
                'default' => 'layout-1',
            ]
        );
        $this->end_controls_section();

		
		$this->start_controls_section(
            'tp_main_slider',
            [
                'label' => esc_html__('Main Slider', 'tpcore'),
                'description' => esc_html__( 'Control all the style settings from Style tab', 'tpcore' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'tp_slider_arrows_enable',
            [
                'label'        => esc_html__( 'Enable Navigation Arrows', 'tpcore' ),
                'type'         => \Elementor\Controls_Manager::SWITCHER,
                'label_on'     => esc_html__( 'Show', 'tpcore' ),
                'label_off'    => esc_html__( 'Hide', 'tpcore' ),
                'return_value' => 'yes',
                'default'      => 'yes',
                'condition' => [
                    'tp_design_style' => ['layout-1', 'layout-3']
                ]
            ]
        );

        $this->add_control(
            'tp_slider_dots_enable',
            [
                'label'        => esc_html__( 'Enable Navigation Dots', 'tpcore' ),
                'type'         => \Elementor\Controls_Manager::SWITCHER,
                'label_on'     => esc_html__( 'Show', 'tpcore' ),
                'label_off'    => esc_html__( 'Hide', 'tpcore' ),
                'return_value' => 'yes',
                'default'      => 'yes',
            ]
        );

        $this->add_control(
            'tp_slider_shape',
               [
                   'label'        => esc_html__( 'Enable Shapae ?', 'tpcore' ),
                   'type'         => \Elementor\Controls_Manager::SWITCHER,
                   'label_on'     => esc_html__( 'Show', 'tpcore' ),
                   'label_off'    => esc_html__( 'Hide', 'tpcore' ),
                   'return_value' => 'yes',
                   'default'      => 'yes',
                   'condition' => [
                        'tp_design_style' => ['layout-1', 'layout-2']
                    ]
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
         'enable_light_bg',
         [
           'label'        => esc_html__( 'Enable Light BG', 'tpcore' ),
           'type'         => \Elementor\Controls_Manager::SWITCHER,
           'label_on'     => esc_html__( 'Show', 'tpcore' ),
           'label_off'    => esc_html__( 'Hide', 'tpcore' ),
           'return_value' => 'yes',
           'default'      => 'no',
           'condition' =>[
                'repeater_condition' => ['style_1']
            ]
         ]
        );

        $repeater->add_control(
            'tp_slider_image',
            [
                'label' => esc_html__('Upload Image', 'tpcore'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ]
            ]
        );

        $repeater->add_control(
            'tp_slider_sub_title',
            [
                'label' => esc_html__('Sub Title', 'tpcore'),
                'description' => tp_get_allowed_html_desc( 'basic' ),
                'type' => Controls_Manager::TEXT,
                'default' => 'Starting at 247',
                'placeholder' => esc_html__('Type Before Heading Text', 'tpcore'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'tp_slider_title',
            [
                'label' => esc_html__('Title', 'tpcore'),
                'description' => tp_get_allowed_html_desc( 'intermediate' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Grow business.', 'tpcore'),
                'placeholder' => esc_html__('Type Heading Text', 'tpcore'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'tp_slider_title_tag',
            [
                'label' => esc_html__('Title HTML Tag', 'tpcore'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'h1' => [
                        'title' => esc_html__('H1', 'tpcore'),
                        'icon' => 'eicon-editor-h1'
                    ],
                    'h2' => [
                        'title' => esc_html__('H2', 'tpcore'),
                        'icon' => 'eicon-editor-h2'
                    ],
                    'h3' => [
                        'title' => esc_html__('H3', 'tpcore'),
                        'icon' => 'eicon-editor-h3'
                    ],
                    'h4' => [
                        'title' => esc_html__('H4', 'tpcore'),
                        'icon' => 'eicon-editor-h4'
                    ],
                    'h5' => [
                        'title' => esc_html__('H5', 'tpcore'),
                        'icon' => 'eicon-editor-h5'
                    ],
                    'h6' => [
                        'title' => esc_html__('H6', 'tpcore'),
                        'icon' => 'eicon-editor-h6'
                    ]
                ],
                'default' => 'h2',
                'toggle' => false,
            ]
        );

        $repeater->add_control(
            'tp_slider_description',
            [
                'label' => esc_html__('Description', 'tpcore'),
                'description' => tp_get_allowed_html_desc( 'intermediate' ),
                'type' => Controls_Manager::TEXTAREA,
                'default' => esc_html__('There are many variations of passages of Lorem Ipsum available but the majority have suffered alteration.', 'tpcore'),
                'placeholder' => esc_html__('Type section description here', 'tpcore'),
            ]
        );

        $repeater->start_controls_tabs(
           '_tp_slider_features_section',
         );
        
        // first item start
        $repeater->start_controls_tab(
           'tp_slider_features_1',
           [
             'label'   => esc_html__( '1st Item', 'tpcore' ),
           ]
         );
         $repeater->add_control(
         'tp_slider_features_1_title',
          [
             'label'       => esc_html__( 'Feature Title', 'tpcore' ),
             'type'        => \Elementor\Controls_Manager::TEXT,
             'default'     => esc_html__( 'High-end Cosmetics', 'tpcore' ),
             'placeholder' => esc_html__( 'Your Text', 'tpcore' ),
             'label_block' => true
          ]
         );

         $repeater->add_control(
            'tp_box_icon_type',
            [
                'label' => esc_html__('Select Icon Type', 'tpcore'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'image',
                'options' => [
                    'image' => esc_html__('Image', 'tpcore'),
                    'icon' => esc_html__('Icon', 'tpcore'),
                    'svg' => esc_html__('SVG', 'tpcore'),
                ],
                'condition' => [
                    'repeater_condition' => ['style_2'],
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
                    'repeater_condition' => ['style_2'],
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
                    'repeater_condition' => ['style_2'],
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
                        'repeater_condition' => ['style_2'],
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
                        'repeater_condition' => ['style_2'],
                    ]
                ]
            );
        }
        
        $repeater->end_controls_tab();
        // first item end

        // second item start
        $repeater->start_controls_tab(
           'tp_slider_features_2',
           [
             'label'   => esc_html__( '2nd Item', 'tpcore' ),
           ]
         );
         $repeater->add_control(
         'tp_slider_features_2_title',
          [
             'label'       => esc_html__( 'Feature Title', 'tpcore' ),
             'type'        => \Elementor\Controls_Manager::TEXT,
             'default'     => esc_html__( 'High-end Cosmetics', 'tpcore' ),
             'placeholder' => esc_html__( 'Your Text', 'tpcore' ),
             'label_block' => true
          ]
         );

         $repeater->add_control(
            'tp_box_icon_2_type',
            [
                'label' => esc_html__('Select Icon Type', 'tpcore'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'image',
                'options' => [
                    'image' => esc_html__('Image', 'tpcore'),
                    'icon' => esc_html__('Icon', 'tpcore'),
                    'svg' => esc_html__('SVG', 'tpcore'),
                ],
                'condition' => [
                    'repeater_condition' => ['style_2'],
                ]
            ]
        );
        $repeater->add_control(
            'tp_box_icon_2_svg',
            [
                'show_label' => false,
                'type' => Controls_Manager::TEXTAREA,
                'label_block' => true,
                'placeholder' => esc_html__('SVG Code Here', 'tpcore'),
                'condition' => [
                    'tp_box_icon_2_type' => 'svg',
                    'repeater_condition' => ['style_2'],
                ]
            ]
        );

        $repeater->add_control(
            'tp_box_icon_2_image',
            [
                'label' => esc_html__('Upload Icon Image', 'tpcore'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'tp_box_icon_2_type' => 'image',
                    'repeater_condition' => ['style_2'],
                ]
            ]
        );

        if (tp_is_elementor_version('<', '2.6.0')) {
            $repeater->add_control(
                'tp_box_icon_2',
                [
                    'show_label' => false,
                    'type' => Controls_Manager::ICON,
                    'label_block' => true,
                    'default' => 'fa fa-star',
                    'condition' => [
                        'tp_box_icon_2_type' => 'icon',
                        'repeater_condition' => ['style_2'],
                    ]
                ]
            );
        } else {
            $repeater->add_control(
                'tp_box_selected_icon_2',
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
                        'tp_box_icon_2_type' => 'icon',
                        'repeater_condition' => ['style_2'],
                    ]
                ]
            );
        }
        
        $repeater->end_controls_tab();
        // second item end

        // third item start
        $repeater->start_controls_tab(
           'tp_slider_features_3',
           [
             'label'   => esc_html__( '3rd Item', 'tpcore' ),
           ]
         );
         $repeater->add_control(
         'tp_slider_features_3_title',
          [
             'label'       => esc_html__( 'Feature Title', 'tpcore' ),
             'type'        => \Elementor\Controls_Manager::TEXT,
             'default'     => esc_html__( 'High-end Cosmetics', 'tpcore' ),
             'placeholder' => esc_html__( 'Your Text', 'tpcore' ),
             'label_block' => true
          ]
         );

         $repeater->add_control(
            'tp_box_icon_3_type',
            [
                'label' => esc_html__('Select Icon Type', 'tpcore'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'image',
                'options' => [
                    'image' => esc_html__('Image', 'tpcore'),
                    'icon' => esc_html__('Icon', 'tpcore'),
                    'svg' => esc_html__('SVG', 'tpcore'),
                ],
                'condition' => [
                    'repeater_condition' => ['style_2'],
                ]
            ]
        );
        $repeater->add_control(
            'tp_box_icon_3_svg',
            [
                'show_label' => false,
                'type' => Controls_Manager::TEXTAREA,
                'label_block' => true,
                'placeholder' => esc_html__('SVG Code Here', 'tpcore'),
                'condition' => [
                    'tp_box_icon_3_type' => 'svg',
                    'repeater_condition' => ['style_2'],
                ]
            ]
        );

        $repeater->add_control(
            'tp_box_icon_3_image',
            [
                'label' => esc_html__('Upload Icon Image', 'tpcore'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'tp_box_icon_3_type' => 'image',
                    'repeater_condition' => ['style_2'],
                ]
            ]
        );

        if (tp_is_elementor_version('<', '2.6.0')) {
            $repeater->add_control(
                'tp_box_icon_3',
                [
                    'show_label' => false,
                    'type' => Controls_Manager::ICON,
                    'label_block' => true,
                    'default' => 'fa fa-star',
                    'condition' => [
                        'tp_box_icon_3_type' => 'icon',
                        'repeater_condition' => ['style_2'],
                    ]
                ]
            );
        } else {
            $repeater->add_control(
                'tp_box_selected_icon_3',
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
                        'tp_box_icon_3_type' => 'icon',
                        'repeater_condition' => ['style_2'],
                    ]
                ]
            );
        }
        
        $repeater->end_controls_tab();
        // second item end

        
        $repeater->end_controls_tabs();

		$repeater->add_control(
            'tp_btn_link_switcher',
            [
                'label' => esc_html__( 'Add Button link', 'tpcore' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Yes', 'tpcore' ),
                'label_off' => esc_html__( 'No', 'tpcore' ),
                'return_value' => 'yes',
                'default' => 'yes',
                'separator' => 'before',
            ]
        );

        $repeater->add_control(
            'tp_btn_btn_text',
            [
                'label' => esc_html__('Button Text', 'tpcore'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Button Text', 'tpcore'),
                'title' => esc_html__('Enter button text', 'tpcore'),
                'label_block' => true,
                'condition' => [
                    'tp_btn_link_switcher' => 'yes',
                ],
            ]
        );
        $repeater->add_control(
            'tp_btn_link_type',
            [
                'label' => esc_html__( 'Button Link Type', 'tpcore' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    '1' => 'Custom Link',
                    '2' => 'Internal Page',
                ],
                'default' => '1',
                'condition' => [
                    'tp_btn_link_switcher' => 'yes',
                ]
            ]
        );
        $repeater->add_control(
            'tp_btn_link',
            [
                'label' => esc_html__( 'Button Link', 'tpcore' ),
                'type' => \Elementor\Controls_Manager::URL,
                'dynamic' => [
                    'active' => true,
                ],
                'placeholder' => esc_html__( 'https://your-link.com', 'tpcore' ),
                'show_external' => true,
                'default' => [
                    'url' => '#',
                    'is_external' => false,
                    'nofollow' => false,
                ],
                'condition' => [
                    'tp_btn_link_type' => '1',
                    'tp_btn_link_switcher' => 'yes',
                ]
            ]
        );
        $repeater->add_control(
            'tp_btn_page_link',
            [
                'label' => esc_html__( 'Select Button Link Page', 'tpcore' ),
                'type' => \Elementor\Controls_Manager::SELECT2,
                'label_block' => true,
                'options' => tp_get_all_pages(),
                'condition' => [
                    'tp_btn_link_type' => '2',
                    'tp_btn_link_switcher' => 'yes',
                ]
            ]
        );

        $this->add_control(
            'slider_list',
            [
                'label' => esc_html__('Slider List', 'tpcore'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'tp_slider_title' => esc_html__('Grow business.', 'tpcore')
                    ],
                    [
                        'tp_slider_title' => esc_html__('Development.', 'tpcore')
                    ],
                    [
                        'tp_slider_title' => esc_html__('Marketing.', 'tpcore')
                    ],
                ],
                'title_field' => '{{{ tp_slider_title }}}',
            ]
        );
        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'thumbnail', // // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `thumbnail_size` and `thumbnail_custom_dimension`.
                'exclude' => ['custom'],
                // 'default' => 'tp-portfolio-thumb',
            ]
        );
        $this->end_controls_section();

                
	}

    
    protected function style_tab_content(){
        $this->tp_section_style_controls('about_section', 'Section - Style', '.tp-el-section');
        $this->tp_section_style_controls('services_section_box', 'Slider - Style', '.tp-el-box');
        $this->tp_basic_style_controls('slider_subtitle', 'Slider - Subtitle', '.tp-el-subtitle');
        $this->tp_basic_style_controls('slider_title', 'Slider - Title', '.tp-el-title');
        $this->tp_basic_style_controls('slider_description', 'Slider - Description', '.tp-el-content p');
        $this->tp_link_controls_style('slider_btn', 'Slider - Button', '.tp-el-btn');
        $this->tp_link_controls_style('slider_nav', 'Slider Nav - Button', '.tp-el-nav-btn');
        $this->tp_icon_style('fact_box_icon', 'Icon - Style', '.tp-el-box-icon span');
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
		?>

		<?php if ( $settings['tp_design_style']  == 'layout-2' ): 
            $bloginfo = get_bloginfo( 'name' );      
        ?>

         <!-- slider area start -->
         <section class="tp-slider-area p-relative z-index-1 tp-el-section">
            <div class="tp-slider-active-2 swiper-container">
               <div class="swiper-wrapper">
                    <?php foreach ($settings['slider_list'] as $item) :
                        $this->add_render_attribute('title_args', 'class', 'tp-slider-title-2 tp-el-title');

                        if ( !empty($item['tp_slider_image']['url']) ) {
                            $tp_slider_image_url = !empty($item['tp_slider_image']['id']) ? wp_get_attachment_image_url( $item['tp_slider_image']['id'], $settings['thumbnail_size']) : $item['tp_slider_image']['url'];
                            $tp_slider_image_alt = get_post_meta($item["tp_slider_image"]["id"], "_wp_attachment_image_alt", true);
                        }

                        // btn Link
                        if ('2' == $item['tp_btn_link_type']) {
                            $link = get_permalink($item['tp_btn_page_link']);
                            $target = '_self';
                            $rel = 'nofollow';
                        } else {
                            $link = !empty($item['tp_btn_link']['url']) ? $item['tp_btn_link']['url'] : '';
                            $target = !empty($item['tp_btn_link']['is_external']) ? '_blank' : '';
                            $rel = !empty($item['tp_btn_link']['nofollow']) ? 'nofollow' : '';
                        }

                    ?> 
                  <div class="tp-slider-item-2 tp-slider-height-2 p-relative swiper-slide grey-bg-5 d-flex align-items-end tp-el-box">

                  <?php if($settings['tp_slider_shape'] == 'yes'): ?>
                     <div class="tp-slider-2-shape">
                        <img class="tp-slider-2-shape-1" src="<?php echo get_template_directory_uri(); ?>/assets/img/slider/2/shape/shape-1.png" alt="<?php echo esc_attr($bloginfo); ?>">
                     </div>
                     <?php endif; ?>
                     <div class="container">
                        <div class="row align-items-center">
                           <div class="col-xl-6 col-lg-6 col-md-6">
                              <div class="tp-slider-content-2 tp-el-content">

                                <?php if (!empty($item['tp_slider_sub_title'])) : ?>
                                <span class="tp-el-subtitle"><?php echo tp_kses( $item['tp_slider_sub_title'] ); ?></span>
                                <?php endif; ?>

                                 <?php
                                    if ($item['tp_slider_title_tag']) :
                                        printf('<%1$s %2$s>%3$s</%1$s>',
                                            tag_escape($item['tp_slider_title_tag']),
                                            $this->get_render_attribute_string('title_args'),
                                            tp_kses($item['tp_slider_title'])
                                        );
                                    endif;
                                ?>

                                <?php if (!empty($item['tp_slider_description'])) : ?>
                                <p><?php echo tp_kses( $item['tp_slider_description'] ); ?></p>
                                <?php endif; ?> 

                                <?php if (!empty($link)) : ?>
                                <div class="tp-slider-btn-2">
                                    <a target="<?php echo esc_attr($target); ?>" rel="<?php echo esc_attr($rel); ?>" href="<?php echo esc_url($link); ?>"  class="tp-btn tp-btn-border tp-el-btn"><?php echo tp_kses($item['tp_btn_btn_text']); ?></a>
                                </div>
                                <?php endif; ?>                                     

                              </div>
                           </div>
                           <div class="col-xl-6 col-lg-6 col-md-6">
                              <div class="tp-slider-thumb-2-wrapper p-relative">

                                <?php if($settings['tp_slider_shape'] == 'yes'): ?>
                                <div class="tp-slider-thumb-2-shape">
                                    <img class="tp-slider-thumb-2-shape-1" src="<?php echo get_template_directory_uri(); ?>/assets/img/slider/2/shape/shape-2.png" alt="<?php echo esc_attr($bloginfo); ?>">
                                    <img class="tp-slider-thumb-2-shape-2" src="<?php echo get_template_directory_uri(); ?>/assets/img/slider/2/shape/shape-3.png" alt="<?php echo esc_attr($bloginfo); ?>">
                                </div>
                                <?php endif; ?>
                                 <div class="tp-slider-thumb-2 text-end">
                                    <span class="tp-slider-thumb-2-gradient"></span>
                                        <img src="<?php echo esc_url($tp_slider_image_url); ?>" alt="<?php echo esc_attr($tp_slider_image_alt); ?>">
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <?php endforeach; ?> 
               </div>
               
               <?php if($settings['tp_slider_dots_enable'] == 'yes') : ?>
                <div class="tp-swiper-dot tp-slider-2-dot"></div>
               <?php endif; ?>
            </div>
         </section>
         <!-- slider area end -->



		<?php else: 
            $bloginfo = get_bloginfo( 'name' );  
		?>

         <!-- slider area start -->
         <section class="tp-slider-area p-relative z-index-1 tp-el-section">
            <div class="tp-slider-active tp-slider-variation swiper-container">

               <div class="swiper-wrapper">
                    <?php foreach ($settings['slider_list'] as $item) :
                        $this->add_render_attribute('title_args', 'class', 'tp-slider-title tp-el-title');

                        if ( !empty($item['tp_slider_image']['url']) ) {
                            $tp_slider_image_url = !empty($item['tp_slider_image']['id']) ? wp_get_attachment_image_url( $item['tp_slider_image']['id'], $settings['thumbnail_size']) : $item['tp_slider_image']['url'];
                            $tp_slider_image_alt = get_post_meta($item["tp_slider_image"]["id"], "_wp_attachment_image_alt", true);
                        }

                        // btn Link
                        if ('2' == $item['tp_btn_link_type']) {
                            $link = get_permalink($item['tp_btn_page_link']);
                            $target = '_self';
                            $rel = 'nofollow';
                        } else {
                            $link = !empty($item['tp_btn_link']['url']) ? $item['tp_btn_link']['url'] : '';
                            $target = !empty($item['tp_btn_link']['is_external']) ? '_blank' : '';
                            $rel = !empty($item['tp_btn_link']['nofollow']) ? 'nofollow' : '';
                        }

                        if($item['enable_light_bg'] == 'yes'){
                            $light_class = 'is-light grey-bg-10';
                        }else{
                            $light_class = 'green-dark-bg';
                        }

                    ?> 
                  <div class="tp-slider-item tp-slider-height tp-el-box d-flex align-items-center swiper-slide <?php echo esc_attr($light_class ); ?>">

                    <?php if($settings['tp_slider_shape'] == 'yes'): ?>
                    <div class="tp-slider-shape">
                        <img class="tp-slider-shape-1" src="<?php echo get_template_directory_uri(); ?>/assets/img/slider/shape/slider-shape-1.png" alt="<?php echo esc_attr($bloginfo); ?>">
                        <img class="tp-slider-shape-2" src="<?php echo get_template_directory_uri(); ?>/assets/img/slider/shape/slider-shape-2.png" alt="<?php echo esc_attr($bloginfo); ?>">
                        <img class="tp-slider-shape-3" src="<?php echo get_template_directory_uri(); ?>/assets/img/slider/shape/slider-shape-3.png" alt="<?php echo esc_attr($bloginfo); ?>">
                        <img class="tp-slider-shape-4" src="<?php echo get_template_directory_uri(); ?>/assets/img/slider/shape/slider-shape-4.png" alt="<?php echo esc_attr($bloginfo); ?>">
                    </div>
                    <?php endif; ?>

                     <div class="container">
                        <div class="row align-items-center">
                           <div class="col-xl-5 col-lg-6 col-md-6">
                              <div class="tp-slider-content p-relative z-index-1 tp-el-content">

                                <?php if (!empty($item['tp_slider_sub_title'])) : ?>
                                <span class="tp-el-subtitle"><?php echo tp_kses( $item['tp_slider_sub_title'] ); ?></span>
                                <?php endif; ?>

                                <?php
                                    if ($item['tp_slider_title_tag']) :
                                        printf('<%1$s %2$s>%3$s</%1$s>',
                                            tag_escape($item['tp_slider_title_tag']),
                                            $this->get_render_attribute_string('title_args'),
                                            tp_kses($item['tp_slider_title'])
                                        );
                                    endif;
                                ?>

                                <?php if (!empty($item['tp_slider_description'])) : ?>
                                <p><?php echo tp_kses( $item['tp_slider_description'] ); ?></p>
                                <?php endif; ?> 

   
                                <?php if (!empty($link)) : ?>
                                 <div class="tp-slider-btn">
                                    <a target="<?php echo esc_attr($target); ?>" rel="<?php echo esc_attr($rel); ?>" href="<?php echo esc_url($link); ?>" class="tp-btn tp-btn-2 tp-btn-white tp-el-btn">
                                    <?php echo tp_kses($item['tp_btn_btn_text']); ?>
                                       <svg width="17" height="14" viewBox="0 0 17 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                          <path d="M16 6.99976L1 6.99976" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                          <path d="M9.9502 0.975414L16.0002 6.99941L9.9502 13.0244" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                       </svg>
                                    </a>
                                 </div>
                                 <?php endif; ?>                                 
                              </div>
                           </div>

                           <div class="col-xl-7 col-lg-6 col-md-6">
                              <div class="tp-slider-thumb text-end">
                                <img src="<?php echo esc_url($tp_slider_image_url); ?>" alt="<?php echo esc_attr($tp_slider_image_alt); ?>">
                              </div>
                           </div>

                        </div>
                     </div>
                  </div>
                  <?php endforeach; ?> 
               </div>

               <?php if($settings['tp_slider_arrows_enable'] == 'yes') : ?>
               <div class="tp-slider-arrow tp-swiper-arrow d-none d-lg-block">
                  <button type="button" class="tp-slider-button-prev tp-el-nav-btn">
                     <svg width="8" height="14" viewBox="0 0 8 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M7 13L1 7L7 1" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                     </svg>                        
                  </button>
                  <button type="button" class="tp-slider-button-next tp-el-nav-btn">
                     <svg width="8" height="14" viewBox="0 0 8 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M1 13L7 7L1 1" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                     </svg>                        
                  </button>
               </div>
               <?php endif; ?>

               <?php if($settings['tp_slider_dots_enable'] == 'yes') : ?>
               <div class="tp-slider-dot tp-swiper-dot"></div>
               <?php endif; ?>
            </div>
         </section>
         <!-- slider area end -->

         

         <?php endif; ?>


		<?php 
	}
}

$widgets_manager->register( new TP_Hero_Slider() );