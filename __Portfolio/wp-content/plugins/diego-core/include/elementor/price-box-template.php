<?php
namespace TPCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Repeater;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Utils;
use \Elementor\Group_Control_Typography;
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
class TP_Price_Box_Template extends Widget_Base {

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
		return 'price-box-template';
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
		return __( 'Price Box Template', 'tpcore' );
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

        $this->tp_section_title_render_controls('adt', 'Section Title');


        $this->start_controls_section(
         'tp_price_temp_sec',
             [
               'label' => esc_html__( 'Price Template', 'tpcore' ),
               'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
             ]
        );
        
        $this->add_control(
            'price_template',
            [
                'label' => __('Section Template', 'tpcore'),
                'placeholder' => __('Select a section template for as tab content', 'tpcore'),
  
                'type' => Controls_Manager::SELECT2,
                'options' => get_elementor_templates()
            ]
        );
        
        $this->end_controls_section();
        
	}

    // style_tab_content
    protected function style_tab_content(){
        $this->tp_section_style_controls('about_section', 'Section - Style', '.tp-el-section');
        $this->start_controls_section(
            'tp_about_subtitle_styling',
            [
                'label' => esc_html__('Section - Subtitle', 'tp-core'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_group_control(
            Group_Control_TPGradient::get_type(),
            [
                'name' => 'tp_about_subtitle_advs',
                'label' => esc_html__('Color', 'tp-core'),
                'selector' => '{{WRAPPER}} .tp-el-subtitle',
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'tp_about_subtitle_typography',
                'label' => esc_html__('Typography', 'tp-core'),
                'selector' => '{{WRAPPER}} .tp-el-subtitle',
            ]
        );

        $this->add_control(
            'tp_about_subtitle_btn_normal_bg_color',
            [
                'label' => esc_html__('Background Color', 'tp-core'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tp-el-subtitle::after, {{WRAPPER}} .tp-el-subtitle::before' => 'background: {{VALUE}} !important;',
                ],
            ]
        );


        $this->add_control(
            'tp_about_subtitle_btn_normal_border_style',
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
                    '{{WRAPPER}} .tp-el-subtitle' => 'border-style: {{VALUE}} !important;;',
                ],
            ]
        );

        $this->add_responsive_control(
            'tp_about_subtitle_btn_normal_border_width',
            [
                'label' => esc_html__('Border Width', 'tp-core'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .tp-el-subtitle' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                ],
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'tp_about_subtitle_btn_normal_border_color',
            [
                'label' => esc_html__('Border Color', 'tp-core'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tp-el-subtitle' => 'border-color: {{VALUE}} !important;;',
                ],
            ]

        );

        $this->add_responsive_control(
            'tp_about_subtitle_padding',
            [
                'label' => esc_html__('Padding', 'tp-core'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .tp-el-subtitle' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' => 'before',
            ]
        );
        $this->add_responsive_control(
            'tp_about_subtitle_margin',
            [
                'label' => esc_html__('Margin', 'tp-core'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .tp-el-subtitle' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' => 'before',
            ]
        );
        $this->end_controls_section();

        $this->tp_basic_style_controls('about_title', 'Section - Title', '.tp-el-title');
        $this->tp_basic_style_controls('about_description', 'Section - Description', '.tp-el-content p');
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
            $this->add_render_attribute('title_args', 'class', 'tp-section-title tp-el-title');
        ?>

		<?php else: 
			$this->add_render_attribute('title_args', 'class', 'tp-section-title-5 mb-20 tp_text_invert tp-el-title');
			$bloginfo = get_bloginfo( 'name' );

            if ( !empty($settings['background_image']['url']) ) {
                $background_image = !empty($settings['background_image']['id']) ? wp_get_attachment_image_url( $settings['background_image']['id'], $settings['background_image_size_size']) : $settings['background_image']['url'];
                $background_image_alt = get_post_meta($settings["background_image"]["id"], "_wp_attachment_image_alt", true);
            }
		?>

            <!-- price area start -->
            <div class="tp-price-4-area black-bg-5 pt-150 pb-120 black-bg-6 tp-el-section">
               <div class="container container-1320">

                <?php if ( !empty($settings['tp_adt_section_title_show']) ) : ?>
                  <div class="tp-price-4-title-wrap mb-90">
                     <div class="row align-items-end">
                        <div class="col-xl-2">
                           <div class="tp-about-4-subtitle-box">
                              <?php if ( !empty($settings['tp_adt_sub_title']) ) : ?>
                                <span class="tp-section-subtitle-5 tp-el-subtitle"><?php echo tp_kses( $settings['tp_adt_sub_title'] ); ?></span>
                                <?php endif; ?>
                           </div>
                        </div>
                        <div class="col-xl-10">
                           <div class="tp-about-4-title-box tp-el-content">
                                <?php
                                    if ( !empty($settings['tp_adt_title' ]) ) :
                                        printf( '<%1$s %2$s>%3$s</%1$s>',
                                            tag_escape( $settings['tp_adt_title_tag'] ),
                                            $this->get_render_attribute_string( 'title_args' ),
                                            tp_kses( $settings['tp_adt_title' ] )
                                            );
                                    endif;
                                ?>

                              <?php if ( !empty($settings['tp_adt_description']) ) : ?>
                                    <p class="tp_text_invert"><?php echo tp_kses( $settings['tp_adt_description'] ); ?></p>
                                <?php endif; ?>
                           </div>
                        </div>
                     </div>
                  </div>
                  <?php endif; ?>

                  <?php echo \Elementor\Plugin::instance()->frontend->get_builder_content($settings['price_template'], true); ?>
               </div>
            </div>
            <!-- price area end -->

	    <?php endif; ?>

		<?php
	}

}
$widgets_manager->register( new TP_Price_Box_Template() );