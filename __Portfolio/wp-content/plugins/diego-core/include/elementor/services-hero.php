<?php
namespace TPCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Repeater;
use \Elementor\Utils;
use TPCore\Elementor\Controls\Group_Control_TPBGGradient;
use TPCore\Elementor\Controls\Group_Control_TPGradient;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Tp Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class TP_Services_Hero extends Widget_Base {

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
        return 'services-hero';
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
        return __( 'Services Hero', 'tpcore' );
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
                ],
                'default' => 'layout-1',
            ]
        );


        $this->end_controls_section();

        $this->tp_section_title_render_controls('services', 'Section Title');


        // Service group
        $this->start_controls_section(
            'tp_services',
            [
                'label' => esc_html__('Feature List', 'tpcore'),
                'description' => esc_html__( 'Control all the style settings from Style tab', 'tpcore' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );


        $repeater = new \Elementor\Repeater();



        $repeater->add_control(
            'tp_service_title', [
                'label' => esc_html__('Title', 'tpcore'),
                'description' => tp_get_allowed_html_desc( 'basic' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Service Title', 'tpcore'),
                'label_block' => true,
            ]
        );




        $this->add_control(
            'tp_service_list',
            [
                'label' => esc_html__('Feature - List', 'tpcore'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'tp_service_title' => esc_html__(' Over 40 Websites Built With Envato ', 'tpcore'),
                    ],
                    [
                        'tp_service_title' => esc_html__(' Visual Designer for 10+ years ', 'tpcore')
                    ],
                    [
                        'tp_service_title' => esc_html__(' UI/UX Designer, Envato ', 'tpcore')
                    ]
                ],
                'title_field' => '{{{ tp_service_title }}}',
            ]
        );
        $this->add_responsive_control(
            'tp_service_align',
            [
                'label' => esc_html__( 'Alignment', 'tpcore' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'text-left' => [
                        'title' => esc_html__( 'Left', 'tpcore' ),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'text-center' => [
                        'title' => esc_html__( 'Center', 'tpcore' ),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'text-right' => [
                        'title' => esc_html__( 'Right', 'tpcore' ),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'toggle' => true,
                'separator' => 'before',
            ]
        );


        $this->end_controls_section();

		$this->start_controls_section(
            'tp_brand_section',
            [
                'label' => __( 'Slider One', 'tpcore' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new Repeater();



        $repeater->add_control(
            'tp_image',
            [
                'type' => Controls_Manager::MEDIA,
                'label' => __( 'Image', 'tpcore' ),
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );


        $this->add_control(
            'tp_service_slides',
            [
                'show_label' => false,
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'title_field' => esc_html__( 'Slider Item', 'tpcore' ),
                'default' => [
                    [
                        'tp_image' => [
                            'url' => Utils::get_placeholder_image_src(),
                        ],
                    ],
                    [
                        'tp_image' => [
                            'url' => Utils::get_placeholder_image_src(),
                        ],
                    ],
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'thumbnail',
                'default' => 'medium_large',
                'separator' => 'before',
                'exclude' => [
                    'custom'
                ]
            ]
        );

        $this->end_controls_section();

		$this->start_controls_section(
            'tp_brand_section_2',
            [
                'label' => __( 'Slider Two', 'tpcore' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new Repeater();



        $repeater->add_control(
            'tp_image_2',
            [
                'type' => Controls_Manager::MEDIA,
                'label' => __( 'Image', 'tpcore' ),
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );


        $this->add_control(
            'tp_service_slides_2',
            [
                'show_label' => false,
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'title_field' => esc_html__( 'Slider Item', 'tpcore' ),
                'default' => [
                    [
                        'tp_image_2' => [
                            'url' => Utils::get_placeholder_image_src(),
                        ],
                    ],
                    [
                        'tp_image_2' => [
                            'url' => Utils::get_placeholder_image_src(),
                        ],
                    ],
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'thumbnail_2',
                'default' => 'medium_large',
                'separator' => 'before',
                'exclude' => [
                    'custom'
                ]
            ]
        );

        $this->end_controls_section();


        $this->tp_common_animation(null, 'desc_title', 'Animation - Title');

    }

    // style_tab_content
    protected function style_tab_content(){

        $this->tp_section_style_controls('hero_banner_section', 'Section - Style', '.tp-el-section');
        $this->tp_basic_style_controls('hero_banner_subtitle', 'Section - Subtitle', '.tp-el-subtitle');
        $this->tp_basic_style_controls('hero_banner_title', 'Section - Title', '.tp-el-title');
        $this->tp_basic_style_controls('hero_banner_desc', 'Section - Description', '.tp-el-content p');

        $this->tp_section_style_controls('services_section_box', 'Services - Box - Style', '.tp-el-list');
        $this->tp_basic_style_controls('services_box_title', 'Services - Box - Title', '.tp-el-list-title');
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
        ?>

        <?php if ( $settings['tp_design_style']  == 'layout-2' ):
            $this->add_render_attribute('title_args', 'class', 'section__title-4 tp-el-title');
        ?>


        <?php else:
            $this->add_render_attribute('title_args', 'class', 'sv-inner__slider-title tp-el-title ' .
            $this->tp_common_animation_get($settings, 'desc_title'));
            $bloginfo = get_bloginfo( 'name' );

        ?>
         

            <!-- service-slider area start -->
            <div class="sv-inner__slider-area black-bg-3 sv-inner__slider-plr tp-el-section">
               <div class="container-fluid">
                  <div class="row align-items-center">
                     <div class="col-xl-6 col-lg-6">
                        <div class="sv-inner__slider-content-main d-flex justify-content-xl-end justify-content-start">
                           <div class="sv-inner__slider-content-wrap">
                           <?php if ( !empty($settings['tp_services_section_title_show']) ) : ?>
                              <div class="sv-inner__slider-title-box tp-el-content">

                                <?php if ( !empty($settings['tp_services_sub_title']) ) : ?>
                                <span class="sv-inner__slider-subtitle <?php echo esc_attr($this->tp_common_animation_get($settings, 'desc_title')); ?> tp-el-subtitle"><?php echo tp_kses( $settings['tp_services_sub_title'] ); ?></span>
                                <?php endif; ?>

                                 <?php
                                    if ( !empty($settings['tp_services_title' ]) ) :
                                        printf( '<%1$s %2$s>%3$s</%1$s>',
                                            tag_escape( $settings['tp_services_title_tag'] ),
                                            $this->get_render_attribute_string( 'title_args' ),
                                            tp_kses( $settings['tp_services_title' ] )
                                            );
                                    endif;
                                ?>

                                <?php if ( !empty($settings['tp_services_description']) ) : ?>
                                    <p class="<?php echo esc_attr($this->tp_common_animation_get($settings, 'desc_title')); ?>"><?php echo tp_kses( $settings['tp_services_description'] ); ?></p>
                                <?php endif; ?>

                              </div>
                              <?php endif; ?>

                              <div class="sv-inner__service-list-wrap">

                                <?php 
                                    foreach ($settings['tp_service_list'] as $key => $item) : 
                                        switch ($key) {
                                            case 0:
                                                $class = 'list-1';
                                                break;
                                            
                                            case 1:
                                                $class = 'list-2';
                                                break;
                                            
                                            case 2:
                                                $class = 'list-3';
                                                break;
                                            
                                            default:
                                                $class = '';
                                                break;
                                        }
                                    ?>
                                 <div class="sv-inner__service-list <?php echo esc_attr($class); ?> wow tpfadeUp " data-wow-duration=".9s" data-wow-delay=".3s">
                                    <span class="tp-el-list"> 
                                        <span class=" tp-el-list-title"><?php echo tp_kses($item['tp_service_title' ]); ?></span>
                                    </span>
                                 </div>
                                 <?php endforeach; ?>

                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="col-xl-6 col-lg-6">
                        <div class="sv-inner__slider-main">
                           <div class="row">
                              <div class="col-xl-6 col-lg-6 col-md-6">
                                 <div class="sv-inner__slider-wrapper">
                                    <div class="sv-inner__slider-active-1">

                                        <?php foreach ($settings['tp_service_slides'] as $item) :
                                            if ( !empty($item['tp_image']['url']) ) {
                                                $tp_image_url = !empty($item['tp_image']['id']) ? wp_get_attachment_image_url( $item['tp_image']['id'], $settings['thumbnail_size']) : $item['tp_image']['url'];
                                                $tp_image_alt = get_post_meta($item["tp_image"]["id"], "_wp_attachment_image_alt", true);
                                            }
                                        ?>
                                       <div class="sv-inner__slider-item">
                                          <img src="<?php echo esc_url($tp_image_url); ?>" alt="<?php echo esc_attr($tp_image_alt); ?>">
                                       </div>
                                       <?php endforeach; ?>
                                    </div>
                                 </div>
                              </div>
                              <div class="col-xl-6 col-lg-6 col-md-6">
                                 <div class="sv-inner__slider-wrapper-2">
                                    <div class="sv-inner__slider-active-2">
                                    <?php foreach ($settings['tp_service_slides_2'] as $item) :
                                            if ( !empty($item['tp_image_2']['url']) ) {
                                                $tp_image_2_url = !empty($item['tp_image_2']['id']) ? wp_get_attachment_image_url( $item['tp_image_2']['id'], $settings['thumbnail_2_size']) : $item['tp_image_2']['url'];
                                                $tp_image_2_alt = get_post_meta($item["tp_image_2"]["id"], "_wp_attachment_image_alt", true);
                                            }
                                        ?>
                                       <div class="sv-inner__slider-item">
                                            <img src="<?php echo esc_url($tp_image_2_url); ?>" alt="<?php echo esc_attr($tp_image_2_alt); ?>">
                                       </div>
                                       <?php endforeach; ?>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>

                     </div>
                  </div>
               </div>
            </div>
            <!-- service-slider area end -->

        <?php endif; ?>

        <?php
    }
}

$widgets_manager->register( new TP_Services_Hero() ); 