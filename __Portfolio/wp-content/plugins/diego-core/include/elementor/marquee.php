<?php
namespace TPCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Repeater;
use \Elementor\Utils;
use TPCore\Elementor\Controls\Group_Control_TPBGGradient;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Tp Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class TP_Marquee extends Widget_Base {

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
		return 'tp-marquee';
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
		return __( 'Marquee Slider', 'tpcore' );
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
         'tp_marquee_sec',
             [
               'label' => esc_html__( 'Slider Content', 'tpcore' ),
               'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
             ]
        );
        
        
        $repeater = new \Elementor\Repeater();
        
         $repeater->add_control(
         'tp_marquee_text',
           [
             'label'   => esc_html__( 'Marquee Title', 'tpcore' ),
             'type'        => \Elementor\Controls_Manager::TEXTAREA,
             'default'     => esc_html__( 'Diego Template', 'tpcore' ),
             'label_block' => true,
           ]
         );
         
         $this->add_control(
           'tp_marquee_slides',
           [
             'label'       => esc_html__( 'Marquee List', 'tpcore' ),
             'type'        => \Elementor\Controls_Manager::REPEATER,
             'fields'      => $repeater->get_controls(),
             'default'     => [
               [
                 'tp_marquee_text'   => esc_html__( 'Diego Template', 'tpcore' ),
               ],
               [
                 'tp_marquee_text'   => esc_html__( 'Diego Design', 'tpcore' ),
               ],
               [
                 'tp_marquee_text'   => esc_html__( 'UI/UX Designer', 'tpcore' ),
               ],
               [
                 'tp_marquee_text'   => esc_html__( 'Developer', 'tpcore' ),
               ],
             ],
             'title_field' => '{{{ tp_marquee_text }}}',
           ]
         );
        
        $this->end_controls_section();
	}


    // style_tab_content
    protected function style_tab_content(){
        $this->tp_section_style_controls('services_section', 'Section - Style', '.tp-el-section');
        $this->tp_basic_style_controls('services_box_title', 'Services - Box - Title', '.tp-el-box-title p');
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

		<?php if ( $settings['tp_design_style']  == 'layout-2' ) : 
            $this->add_render_attribute('title_args', 'class', 'tp-title tp-el-title');
        ?>

        <?php else : ?>


        <!-- marquee area start -->
        <div class="tp-marquee-area z-index-5 ">
            <div class="tp-marquee-wrapper">
                <div class="tp-marquee-slider fix">
                    <div class="tp-marquee-slider-active tp-el-section d-flex align-items-center ">
                        <?php foreach ($settings['tp_marquee_slides'] as $item) :?>
                        <div class="tp-marquee-item tp-el-box-title">
                            <p><?php echo tp_kses($item['tp_marquee_text']); ?></p>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
        <!-- marquee area end -->

	   <?php endif; ?>

		<?php
	}


}

$widgets_manager->register( new TP_Marquee() );
