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
class TP_Text_Slider extends Widget_Base {

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
		return 'tp-text-slider';
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
		return __( 'Text Slider', 'tpcore' );
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
         'tp_text_slider_sec',
             [
               'label' => esc_html__( 'Slider Content', 'tpcore' ),
               'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
             ]
        );
        
        
        $repeater = new \Elementor\Repeater();
        
         $repeater->add_control(
         'tp_text_slider_title',
           [
             'label'   => esc_html__( 'Text', 'tpcore' ),
             'type'        => \Elementor\Controls_Manager::TEXTAREA,
             'default'     => esc_html__( 'Interior Photography', 'tpcore' ),
             'label_block' => true,
           ]
         );
         
         $this->add_control(
           'tp_text_slider_list',
           [
             'label'       => esc_html__( 'Text Slider List', 'tpcore' ),
             'type'        => \Elementor\Controls_Manager::REPEATER,
             'fields'      => $repeater->get_controls(),
             'default'     => [
               [
                 'tp_text_slider_title'   => esc_html__( 'Fashion', 'tpcore' ),
               ],
               [
                 'tp_text_slider_title'   => esc_html__( 'Brand Promotion', 'tpcore' ),
               ],
               [
                 'tp_text_slider_title'   => esc_html__( 'Family Photoshoot', 'tpcore' ),
               ],
             ],
             'title_field' => '{{{ tp_text_slider_title }}}',
           ]
         );
        
        $this->end_controls_section();

    }

    // style_tab_content
    protected function style_tab_content(){
  
        $this->tp_section_style_controls('team_section', 'Section - Style', '.tp-el-section');
        $this->tp_section_style_controls('team_item', 'Slider - Style', '.tp-el-box');
        $this->tp_basic_style_controls('team_subtitle', 'Slider - Title', '.tp-el-title span');

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

		<!--	testimonial style 2 -->
		<?php if ( $settings['tp_design_style']  == 'layout-2' ): 
            $this->add_render_attribute('title_args', 'class', 'tp-section-title-3 tp-el-title');
        ?>

        <div class="tp-footer-5-text-slide tp-el-section">
            <div class="swiper-container tp-footer-5-slide-active" data-sliderSpeed="180000" data-autoPlay="true">
                <div class="swiper-wrapper">

                    <?php foreach ($settings['tp_text_slider_list'] as $index => $item) : ?>
                    <div class="swiper-slide">
                        <div class="tp-footer-5-text-wrap tp-el-title">
                            <span class="tp-footer-5-text"><?php echo tp_kses($item['tp_text_slider_title']); ?></span>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>

        <?php elseif($settings['tp_design_style']  == 'layout-3' ) : ?>
            <!-- Text slider start  -->
            <div class="tp-text-slider-4-area tp-text-slider-5-style black-bg-5 fix tp-el-section">
               <div class="tp-text-slider-4-wrap tp-el-box">
                  <div class="swiper-container tp-text-slider-4-active" data-sliderSpeed="30000" data-autoPlay="true">
                     <div class="swiper-wrapper">

                     <?php foreach ($settings['tp_text_slider_list'] as $index => $item) : ?>
                        <div class="swiper-slide">
                           <div class="tp-text-slider-4-item d-flex align-items-center tp-el-title">
                              <span><?php echo tp_kses($item['tp_text_slider_title']); ?></span>
                           </div>
                        </div>
                        <?php endforeach; ?>

                     </div>
                  </div>
               </div>
            </div>
            <!-- Text slider end -->

		<!-- default style -->
		<?php else:
            $this->add_render_attribute('title_args', 'class', 'tp-section-title tp-el-title');
            $bloginfo = get_bloginfo( 'name' );
            
        ?>

            <!-- Text slider start  -->
            <div class="tp-text-slider-4-area black-bg-6 fix tp-el-section">
                <div class="tp-text-slider-4-wrap tp-el-box">
                    <div class="swiper-container tp-text-slider-4-active" data-sliderSpeed="30000" data-autoPlay="true">
                        <div class="swiper-wrapper">

                        <?php foreach ($settings['tp_text_slider_list'] as $index => $item) : ?>
                            <div class="swiper-slide">
                                <div class="tp-text-slider-4-item d-flex align-items-center tp-el-title">
                                    <span><?php echo tp_kses($item['tp_text_slider_title']); ?></span>
                                </div>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Text slider end -->

        <?php endif; ?>

        <?php
	}
}

$widgets_manager->register( new TP_Text_Slider() );
