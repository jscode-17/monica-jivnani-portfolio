<?php
namespace TPCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Repeater;
use \Elementor\Utils;
use \Elementor\Group_Control_Typography;
use \Elementor\Group_Control_Box_Shadow;
use TPCore\Elementor\Controls\Group_Control_TPBGGradient;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Tp Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class TP_Portfolio_Details_Meta extends Widget_Base {

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
		return 'tp-portfolio-details-meta';
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
		return __( 'Portfolio Details Meta', 'tpcore' );
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
         'tp_port_meta_sec',
             [
               'label' => esc_html__( 'Portfolio Meta', 'tpcore' ),
               'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
             ]
        );
        
        
        $repeater = new \Elementor\Repeater();
        
         $repeater->add_control(
         'tp_meta_title',
           [
             'label'   => esc_html__( 'Title', 'tpcore' ),
             'type'        => \Elementor\Controls_Manager::TEXT,
             'default'     => esc_html__( 'Clients', 'tpcore' ),
             'label_block' => true,
           ]
         );
         $repeater->add_control(
         'tp_meta_desc',
           [
             'label'   => esc_html__( 'Description', 'tpcore' ),
             'type'        => \Elementor\Controls_Manager::TEXT,
             'default'     => esc_html__( 'The Organic Crave', 'tpcore' ),
             'label_block' => true,
           ]
         );
         
         
         $this->add_control(
           'tp_meta_list',
           [
             'label'       => esc_html__( 'Meta List', 'tpcore' ),
             'type'        => \Elementor\Controls_Manager::REPEATER,
             'fields'      => $repeater->get_controls(),
             'default'     => [
               [
                 'tp_meta_title'   => esc_html__( 'Clients', 'tpcore' ),
                 'tp_meta_desc'   => esc_html__( 'The Organic Crave ', 'tpcore' ),
               ],
               [
                 'tp_meta_title'   => esc_html__( 'Year', 'tpcore' ),
                 'tp_meta_desc'   => esc_html__( '20/01/2018 ', 'tpcore' ),
               ],
               [
                 'tp_meta_title'   => esc_html__( 'Role', 'tpcore' ),
                 'tp_meta_desc'   => esc_html__( 'Fashion design ', 'tpcore' ),
               ],
             ],
             'title_field' => '{{{ tp_meta_title }}}',
           ]
         );
        
        $this->end_controls_section();


	}

        // style_tab_content
    protected function style_tab_content(){


        $this->tp_section_style_controls('section_section', 'Section - Style', '.tp-el-section');

        $this->tp_section_style_controls('portfolio_box', 'Portfolio - Box', '.tp-el-box');
        $this->tp_basic_style_controls('portfolio_box_title', 'Portfolio - Title', '.tp-el-title');
        $this->tp_basic_style_controls('portfolio_box_desc', 'Portfolio - Description', '.tp-el-desc');
  
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

            if ( !empty($settings['tp_image']['url']) ) {
                $tp_image = !empty($settings['tp_image']['id']) ? wp_get_attachment_image_url( $settings['tp_image']['id'], $settings['tp_image_size_size']) : $settings['tp_image']['url'];
                $tp_image_alt = get_post_meta($settings["tp_image"]["id"], "_wp_attachment_image_alt", true);
            }
        ?>

        <div class="tp-port-2-info d-flex align-items-center tp-el-section">

        <?php foreach($settings['tp_meta_list'] as $key => $item) : ?>
            <div class="tp-port-2-info-item tp-el-box">

                <?php if(!empty($item['tp_meta_title'])) : ?>
                <h5 class="tp-port-2-info-title tp-el-title"><?php echo tp_kses($item['tp_meta_title']); ?></h5>
                <?php endif; ?>

                <?php if(!empty($item['tp_meta_desc'])) : ?>
                <span class="tp-el-desc"><?php echo tp_kses($item['tp_meta_desc']); ?></span>
                <?php endif; ?>

            </div>
        <?php endforeach; ?>

        </div>

        <?php
	}
}

$widgets_manager->register( new TP_Portfolio_Details_Meta() );