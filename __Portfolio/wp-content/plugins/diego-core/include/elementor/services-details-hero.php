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
class TP_Services_Details_Info extends Widget_Base {

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
        return 'services-details-info';
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
        return __( 'Services Details Hero', 'tpcore' );
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

        $this->start_controls_section(
         'tp_services_sec',
             [
               'label' => esc_html__( 'Services Content', 'tpcore' ),
               'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
             ]
        );
        
        $this->add_control(
         'tp_services_subtitle',
         [
           'label'       => esc_html__( 'Subtitle', 'tpcore' ),
           'type'        => \Elementor\Controls_Manager::TEXT,
           'rows'        => 10,
           'default'     => esc_html__( 'Design Studio', 'tpcore' ),
           'placeholder' => esc_html__( 'Your Text', 'tpcore' ),
         ]
        );
        
        $this->add_control(
         'tp_services_title',
         [
           'label'       => esc_html__( 'Title', 'tpcore' ),
           'type'        => \Elementor\Controls_Manager::TEXTAREA,
           'rows'        => 10,
           'default'     => esc_html__( 'Logo and branding', 'tpcore' ),
           'placeholder' => esc_html__( 'Your Text', 'tpcore' ),
         ]
        );
        
        $this->add_control(
         'tp_services_desc',
         [
           'label'       => esc_html__( 'Description', 'tpcore' ),
           'type'        => \Elementor\Controls_Manager::TEXTAREA,
           'rows'        => 10,
           'default'     => esc_html__( 'Refined branding and web design ', 'tpcore' ),
           'placeholder' => esc_html__( 'Your Text', 'tpcore' ),
         ]
        );
        
        $this->end_controls_section();

                // _tp_image
                $this->start_controls_section(
                    '_tp_image_section',
                    [
                        'label' => esc_html__('Thumbnail Image', 'tp-core'),
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
        

                $this->add_group_control(
                    Group_Control_Image_Size::get_type(),
                    [
                        'name' => 'tp_image_size',
                        'default' => 'full',
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
        $this->tp_section_style_controls('services_section', 'Section - Style', '.tp-el-section');
        $this->tp_basic_style_controls('services_subtitle', 'Services - Subtitle', '.tp-el-subtitle');
        $this->tp_basic_style_controls('services_title', 'Services - Title', '.tp-el-title');
        $this->tp_basic_style_controls('services_description', 'Services - Description', '.tp-el-desc');

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
            $this->add_render_attribute('title_args', 'class', 'section__title-4 tp-el-title');
        ?>


        <?php else:
            $this->add_render_attribute('title_args', 'class', 'tp-section-title-3 tp_title_anim tp-el-title');
            $bloginfo = get_bloginfo( 'name' );


            if ( !empty($settings['tp_image']['url']) ) {
                $tp_image = !empty($settings['tp_image']['id']) ? wp_get_attachment_image_url( $settings['tp_image']['id'], $settings['tp_image_size_size']) : $settings['tp_image']['url'];
                $tp_image_alt = get_post_meta($settings["tp_image"]["id"], "_wp_attachment_image_alt", true);
            }
           
        ?>

            <!-- service-details-area-start -->
            <div class="service-details__area tp-el-section">
               <div class="container">
                  <div class="row">
                  <?php if(!empty($settings['tp_services_subtitle']) || !empty($settings['tp_services_title'])) : ?>
                     <div class="col-xl-12">
                        <div class="service-details__title-box mb-40">
                            <?php if(!empty($settings['tp_services_subtitle'])) : ?>
                            <span class="service-details__subtitle <?php echo esc_attr($this->tp_common_animation_get($settings, 'desc_title')); ?> tp-el-subtitle"><?php echo tp_kses($settings['tp_services_subtitle']); ?></span>
                            <?php endif; ?>

                            <?php if(!empty($settings['tp_services_title'])) : ?>
                            <h4 class="service-details__title tp-char-title tp-el-title"><?php echo tp_kses($settings['tp_services_title']); ?></h4>
                            <?php endif; ?>
                        </div>
                     </div>
                     <?php endif; ?>
                     <?php if(!empty($settings['tp_services_desc'])) : ?>
                     <div class="row">
                        <div class="offset-xxl-4 col-xxl-5 offset-xl-3 col-xl-6">
                           <div class="service-details__banner-text mb-80">
                              <p class="mb-30 tp_title_anim tp-el-desc"><?php echo tp_kses($settings['tp_services_desc']); ?></p>
                           </div>
                        </div>
                     </div>
                     <?php endif; ?>
                  </div>
               </div>
               <?php if(!empty($tp_image)) : ?>
               <div class="container-fluid">
                  <div class="row">
                     <div class="col-xl-12">
                        <div class="service-details__tab-wrapper text-center mb-120">
                           <div class="service-details__tab-thumb">
                              <img data-speed="0.4" src="<?php echo esc_url($tp_image); ?>" alt="<?php echo esc_attr($tp_image_alt); ?>">
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <?php endif; ?>
            </div>
            <!-- service-details-area-end -->

        <?php endif; ?>

        <?php
    }
}

$widgets_manager->register( new TP_Services_Details_Info() ); 