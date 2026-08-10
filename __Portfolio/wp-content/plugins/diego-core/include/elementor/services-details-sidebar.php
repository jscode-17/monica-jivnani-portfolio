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
class TP_Services_Details_Sidebar extends Widget_Base {

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
        return 'services-details-sidebar';
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
        return __( 'Services Details Sidebar', 'tpcore' );
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
         'tp_services_sidebar_sec',
             [
               'label' => esc_html__( 'Services Sidebar Content', 'tpcore' ),
               'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
             ]
        );
        
        $this->add_control(
         'tp_services_sidebar_title',
         [
           'label'       => esc_html__( 'Title', 'tpcore' ),
           'type'        => \Elementor\Controls_Manager::TEXTAREA,
           'rows'        => 10,
           'default'     => esc_html__( 'Logo Design', 'tpcore' ),
           'placeholder' => esc_html__( 'Your Text', 'tpcore' ),
         ]
        );
        
        $this->add_control(
         'tp_services_sidebar_desc',
         [
           'label'       => esc_html__( 'Description', 'tpcore' ),
           'type'        => \Elementor\Controls_Manager::TEXTAREA,
           'rows'        => 10,
           'default'     => esc_html__( 'Refined branding and web design ', 'tpcore' ),
           'placeholder' => esc_html__( 'Your Text', 'tpcore' ),
         ]
        );
        
        $this->end_controls_section();

        $this->tp_button_render_controls('tpbtn', 'Button', ['layout-1']);

        $this->start_controls_section(
         'tp_services_sidebar_tag_sec',
             [
               'label' => esc_html__( 'Tags', 'tpcore' ),
               'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
             ]
        );

        $this->add_control(
            'tp_services_sidebar_text',
              [
                'label'   => esc_html__( 'Side Title', 'tpcore' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => esc_html__( ' Full list of services ', 'tpcore' ),
                'label_block' => true,
              ]
            );
   
        
        
        $repeater = new \Elementor\Repeater();
        
         $repeater->add_control(
         'tp_services_sidebar_tag_title',
           [
             'label'   => esc_html__( 'Tag Title', 'tpcore' ),
             'type'        => \Elementor\Controls_Manager::TEXT,
             'default'     => esc_html__( 'Strategy', 'tpcore' ),
             'label_block' => true,
           ]
         );

         $repeater->add_control(
          'tp_services_sidebar_tag_url',
          [
            'label'   => esc_html__( 'URL', 'tpcore' ),
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
           'tp_services_sidebar_tag_list',
           [
             'label'       => esc_html__( 'Tag List', 'tpcore' ),
             'type'        => \Elementor\Controls_Manager::REPEATER,
             'fields'      => $repeater->get_controls(),
             'default'     => [
               [
                 'tp_services_sidebar_tag_title'   => esc_html__( 'Strategy', 'tpcore' ),
               ],
               [
                 'tp_services_sidebar_tag_title'   => esc_html__( 'Branding', 'tpcore' ),
               ],
               [
                 'tp_services_sidebar_tag_title'   => esc_html__( 'Development', 'tpcore' ),
               ],
             ],
             'title_field' => '{{{ tp_services_sidebar_tag_title }}}',
           ]
         );
        
        $this->end_controls_section();
    }

    // style_tab_content
    protected function style_tab_content(){
        $this->tp_section_style_controls('services_section', 'Services - Style', '.tp-el-section');
        $this->tp_basic_style_controls('services_box_title', 'Services - Box - Title', '.tp-el-title');
        $this->tp_basic_style_controls('services_box_subtitle', 'Services - Box - Subtitle', '.tp-el-subtitle');
        $this->tp_basic_style_controls('services_box_text', 'Services - Rotate Text', '.tp-el-rotate-text');
        $this->tp_basic_style_controls('services_box_description', 'Services - Box - Description', '.tp-el-desc');
        $this->tp_link_controls_style('services_box_link_tag', 'Services - Tag', '.tp-el-tag');
        $this->tp_link_controls_style('services_box_link_btn', 'Services - Button', '.tp-el-btn');

        $this->start_controls_section(
          'tp_btn_dot_media_style',
          [
              'label' => esc_html__('Button Dot', 'tp-core'),
              'tab' => Controls_Manager::TAB_STYLE,
          ]
      );


      $this->add_control(
          'tp_btn_dot_area_background',
          [
              'label' => esc_html__('Color', 'tp-core'),
              'type' => Controls_Manager::COLOR,
              'selectors' => [
                  '{{WRAPPER}} .tp-el-btn::after' => 'background-color: {{VALUE}} !important;',
              ],
          ]
      );



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

        $this->tp_link_controls_render('tpbtn', 'tp-btn-white tp-el-btn', $this->get_settings());

            $this->add_render_attribute('title_args', 'class', 'tp-section-title-3 tp_title_anim tp-el-title');
            $bloginfo = get_bloginfo( 'name' );

           
        ?>


            <div class="service-details__right-wrap fix p-relative tp-el-section">
                <?php if(!empty($settings['tp_services_sidebar_text'])) : ?>
                <div class="service-details__rotate-text">
                    <span class="tp-el-rotate-text"><?php echo tp_kses($settings['tp_services_sidebar_text']); ?></span>
                </div>
                <?php endif; ?>

                <div class="service-details__right-category">

                <?php foreach ($settings['tp_services_sidebar_tag_list'] as $key => $item) :?>
                    <a class="tp-el-tag" href="<?php echo tp_kses($item['tp_services_sidebar_tag_url']['url']); ?>"><?php echo tp_kses($item['tp_services_sidebar_tag_title']); ?></a>
                    <?php endforeach; ?>
                </div>

                <div class="service-details__right-text-box">

                    <?php if(!empty($settings['tp_services_sidebar_title'])) : ?>
                    <h4 class="tp-el-title"><?php echo tp_kses($settings['tp_services_sidebar_title']); ?></h4>
                    <?php endif; ?>

                    <?php if(!empty($settings['tp_services_sidebar_desc'])) : ?>
                    <p class="mb-20 tp-el-desc"><?php echo tp_kses($settings['tp_services_sidebar_desc']); ?></p>
                    <?php endif; ?>


                    <?php if (!empty($settings['tp_' . $control_id .'_text']) && $settings['tp_' . $control_id .'_button_show'] == 'yes') : ?>
                    <a  <?php echo $this->get_render_attribute_string( 'tp-button-arg' . $control_id .'' ); ?>>
                    <?php echo $settings['tp_' . $control_id .'_text']; ?>
                        <span>
                            <svg width="12" height="12" viewBox="0 0 12 12" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path d="M4.9297 10.3651C5.12061 10.2162 5.29376 10.043 5.64006 9.69671L9.95722 5.37954C10.0616 5.27517 10.0138 5.0954 9.87438 5.04702C9.36479 4.87022 8.70189 4.53829 8.0818 3.9182C7.46171 3.29811 7.12978 2.63521 6.95299 2.12562C6.9046 1.98617 6.72483 1.9384 6.62046 2.04278L2.30329 6.35994L2.30328 6.35995C1.95699 6.70624 1.78385 6.87939 1.63494 7.0703C1.45928 7.29551 1.30868 7.53919 1.18581 7.79701C1.08164 8.01558 1.00421 8.24789 0.849336 8.71249L0.649225 9.31283L0.331026 10.2674L0.0326691 11.1625C-0.0435433 11.3911 0.0159628 11.6432 0.186379 11.8136C0.356795 11.984 0.608868 12.0435 0.837505 11.9673L1.73258 11.669L2.68717 11.3508L3.28751 11.1507C3.75211 10.9958 3.98442 10.9184 4.20299 10.8142C4.46082 10.6913 4.70449 10.5407 4.9297 10.3651Z"  fill="currentcolor" />
                                <path d="M11.3089 4.02783C12.2304 3.10641 12.2304 1.61249 11.3089 0.691067C10.3875 -0.230356 8.89359 -0.230356 7.97217 0.691067L7.83337 0.82986C7.69944 0.963792 7.63876 1.15087 7.67222 1.3373C7.69327 1.45458 7.73229 1.62603 7.80327 1.83063C7.94522 2.23979 8.21329 2.77689 8.7182 3.2818C9.22311 3.78671 9.76021 4.05478 10.1694 4.19673C10.374 4.26772 10.5454 4.30673 10.6627 4.32778C10.8491 4.36124 11.0362 4.30056 11.1701 4.16663L11.3089 4.02783Z"  fill="currentcolor" />
                            </svg>
                        </span>
                    </a>
                    <?php endif; ?>  
                </div>
            </div>


        <?php
    }
}

$widgets_manager->register( new TP_Services_Details_Sidebar() ); 