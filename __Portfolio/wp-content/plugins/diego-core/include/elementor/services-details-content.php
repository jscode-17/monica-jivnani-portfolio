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
class TP_Services_Details_Content extends Widget_Base {

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
        return 'services-details-content';
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
        return __( 'Services Details Content', 'tpcore' );
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
         'tp_services_title',
         [
           'label'       => esc_html__( 'Title', 'tpcore' ),
           'type'        => \Elementor\Controls_Manager::TEXTAREA,
           'rows'        => 10,
           'default'     => esc_html__( 'Your logo is at the heart of your identity.', 'tpcore' ),
           'placeholder' => esc_html__( 'Your Text', 'tpcore' ),
         ]
        );
        
        $this->add_control(
         'tp_services_desc',
         [
           'label'       => esc_html__( 'Description', 'tpcore' ),
           'type'        => \Elementor\Controls_Manager::TEXTAREA,
           'rows'        => 10,
           'default'     => esc_html__( 'Great user experience design lets users focus on the task they have to complete and evokes emotion without distracting them.!', 'tpcore' ),
           'placeholder' => esc_html__( 'Your Text', 'tpcore' ),
         ]
        );
        
        $this->add_control(
         'tp_services_bottom_desc',
         [
           'label'       => esc_html__( 'Bottom Description', 'tpcore' ),
           'type'        => \Elementor\Controls_Manager::TEXTAREA,
           'rows'        => 10,
           'default'     => esc_html__( 'Great user experience design lets users focus on the task they have to complete and evokes emotion without distracting them.!', 'tpcore' ),
           'placeholder' => esc_html__( 'Your Text', 'tpcore' ),
         ]
        );
        
        $this->end_controls_section();

        $this->start_controls_section(
         'tp_services_details_list_sec',
             [
               'label' => esc_html__( 'Feature List', 'tpcore' ),
               'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
             ]
        );
        
        
        $repeater = new \Elementor\Repeater();
        
         $repeater->add_control(
         'tp_services_features_title',
           [
             'label'   => esc_html__( 'Features Title', 'tpcore' ),
             'type'        => \Elementor\Controls_Manager::TEXT,
             'default'     => esc_html__( 'Graphic research and production', 'tpcore' ),
             'label_block' => true,
           ]
         );
         
         $this->add_control(
           'tp_services_features_list',
           [
             'label'       => esc_html__( 'Feature Title', 'tpcore' ),
             'type'        => \Elementor\Controls_Manager::REPEATER,
             'fields'      => $repeater->get_controls(),
             'default'     => [
               [
                 'tp_services_features_title'   => esc_html__( 'Graphic research and production', 'tpcore' ),
               ],
               [
                 'tp_services_features_title'   => esc_html__( 'Presentation of your logo on different media', 'tpcore' ),
               ],
               [
                 'tp_services_features_title'   => esc_html__( 'Advice on the graphic orientation of your logo or its redesign', 'tpcore' ),
               ],
               [
                 'tp_services_features_title'   => esc_html__( 'Delivery of your logo in professional formats', 'tpcore' ),
               ],
             ],
             'title_field' => '{{{ tp_services_features_title }}}',
           ]
         );
        
        $this->end_controls_section();

        $this->start_controls_section(
         'tp_services_thumb_sec',
             [
               'label' => esc_html__( 'Thumbnails', 'tpcore' ),
               'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
             ]
        );
        
        
        $repeater = new \Elementor\Repeater();
        
        $repeater->add_control(
         'tp_image',
         [
           'label'   => esc_html__( 'Upload Thumbnail', 'tpcore' ),
           'type'    => \Elementor\Controls_Manager::MEDIA,
             'default' => [
               'url' => \Elementor\Utils::get_placeholder_image_src(),
           ],
         ]
        );
         
         $this->add_control(
           'tp_services_thumb_list',
           [
             'label'       => esc_html__( 'Thumbnail List', 'tpcore' ),
             'type'        => \Elementor\Controls_Manager::REPEATER,
             'fields'      => $repeater->get_controls(),
             'default'     => [
               [
                 'tp_services_thumb_title'   => esc_html__( '01', 'tpcore' ),
               ],
               [
                 'tp_services_thumb_title'   => esc_html__( '02', 'tpcore' ),
               ],
             ],
             'title_field' => '{{{ tp_services_thumb_title }}}',
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
    }

    // style_tab_content
    protected function style_tab_content(){
        $this->tp_section_style_controls('services_section', 'Section - Style', '.tp-el-section');
        $this->tp_basic_style_controls('services_highlight_description', 'Services - Highlight Description', '.tp-el-highlight-desc');
        $this->tp_basic_style_controls('services_description', 'Services - Description', '.tp-el-desc');
        $this->tp_basic_style_controls('services_description_bottom', 'Services - Bottom Description', '.tp-el-desc-bottom');

        $this->tp_basic_style_controls('services_box_title', 'List - Title', '.tp-el-list-title');
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


            
           
        ?>

            <div class="service-details__left-wrap tp-el-section">

                <?php if(!empty($settings['tp_services_title']) || !empty($settings['tp_services_desc'])) : ?>
                <div class="service-details__left-text pb-20">
                    <?php if(!empty($settings['tp_services_title'])) : ?>
                    <p class="text-1 tp_title_anim tp-el-highlight-desc"><?php echo tp_kses($settings['tp_services_title']); ?></p>
                    <?php endif; ?>

                    <?php if(!empty($settings['tp_services_desc'])) : ?>
                    <p class="tp-el-desc"><?php echo tp_kses($settings['tp_services_desc']); ?></p>
                    <?php endif; ?>
                </div>
                <?php endif; ?>

                <div class="service-details__fea-list">
                    <ul>
                        <?php foreach ($settings['tp_services_features_list'] as $key => $item) : ?>
                            
                            <?php if(!empty($item['tp_services_features_title'])) : ?>
                            <li class="tp-el-list-title"><?php echo tp_kses($item['tp_services_features_title']); ?></li>
                            <?php endif; ?>

                        <?php endforeach; ?>
                    </ul>
                </div>

                <div class="service-details__sm-thumb-wrap mb-60">
                    <div class="row">
                        <?php foreach ($settings['tp_services_thumb_list'] as $key => $item) : 
                            if ( !empty($item['tp_image']['url']) ) {
                                $tp_image = !empty($item['tp_image']['id']) ? wp_get_attachment_image_url( $item['tp_image']['id'], $settings['tp_image_size_size']) : $item['tp_image']['url'];
                                $tp_image_alt = get_post_meta($item["tp_image"]["id"], "_wp_attachment_image_alt", true);
                            }
                        ?>
                        <?php if(!empty($tp_image)) : ?>
                        <div class="col-xl-6 col-lg-6 col-md-6 mb-20">
                            <div class="service-details__sm-thumb">
                                <img src="<?php echo esc_url($tp_image); ?>" alt="<?php echo esc_attr($tp_image_alt); ?>">
                            </div>
                        </div>
                        <?php endif; ?>

                        <?php endforeach; ?>
                        
                    </div>
                </div>
                <?php if(!empty($settings['tp_services_bottom_desc'])) : ?>
                <div class="service-details__left-text">
                    <p class="tp-el-desc-bottom"><?php echo tp_kses($settings['tp_services_bottom_desc']); ?></p>
                </div>
                <?php endif; ?>
            </div>

        <?php endif; ?>

        <?php
    }
}

$widgets_manager->register( new TP_Services_Details_Content() ); 