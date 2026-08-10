<?php
namespace TPCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Repeater;
use \Elementor\Utils;
use \Elementor\Group_Control_Typography;
use \Elementor\Control_Media;
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
class TP_About_Me_2 extends Widget_Base {

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
		return 'about-me-2';
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
		return __( 'About Me 2', 'tp-core' );
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
		return [ 'tp-core' ];
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
		return [ 'tp-core' ];
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
                'label' => esc_html__('Design Layout', 'tp-core'),
            ]
        );
        $this->add_control(
            'tp_design_style',
            [
                'label' => esc_html__('Select Layout', 'tp-core'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'layout-1' => esc_html__('Layout 1', 'tp-core'),
                ],
                'default' => 'layout-1',
            ]
        );

        $this->end_controls_section();

        $this->tp_section_title_render_controls('about', 'Section - Title & Desciption', ['layout-1']);

    
        $this->start_controls_section(
         'tp_about_sec',
             [
               'label' => esc_html__( 'About Section', 'tpcore' ),
               'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
             ]
        );
        

        $this->add_control(
         'tp_about_short_desc',
         [
           'label'       => esc_html__( 'About Short Desc', 'tpcore' ),
           'type'        => \Elementor\Controls_Manager::TEXTAREA,
           'rows'        => 10,
           'default'     => esc_html__( 'Photography was always my passion and my dream job. It’s even difficult for me to call it
           a job, as I consider my profession as a hobby of my life.', 'tpcore' ),
           'placeholder' => esc_html__( 'Your Text', 'tpcore' ),
         ]
        );


        $this->end_controls_section();

        // _tp_image
		$this->start_controls_section(
            '_tp_image',
            [
                'label' => esc_html__('Thumbnail', 'tp-core'),
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
            'tp_image_2',
            [
                'label' => esc_html__( 'Choose Small Image', 'tp-core' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );
        $this->add_control(
            'tp_image_shape',
            [
                'label' => esc_html__( 'Choose Shape Image', 'tp-core' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'thumbnail',
                'default' => 'full',
                'exclude' => [
                    'custom'
                ]
            ]
        );
        $this->end_controls_section();
        

        $this->start_controls_section(
            'tp_fact',
            [
                'label' => esc_html__('Fact List', 'tpcore'),
                'description' => esc_html__( 'Control all the style settings from Style tab', 'tpcore' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
   

        $repeater = new \Elementor\Repeater();


        $repeater->add_control(
            'tp_fact_number', [
                'label' => esc_html__('Number', 'tpcore'),
                'description' => tp_get_allowed_html_desc( 'basic' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('100', 'tpcore'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'tp_fact_number_unit', [
                'label' => esc_html__('Number Quantity', 'tpcore'),
                'description' => tp_get_allowed_html_desc( 'basic' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('+', 'tpcore'),
                'label_block' => true,
            ]
        );
        $repeater->add_control(
            'tp_fact_title',
            [
                'label' => esc_html__('Title', 'tpcore'),
                'description' => tp_get_allowed_html_desc( 'intermediate' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Food', 'tpcore'),
                'label_block' => true,
            ]
        );             


        $this->add_control(
            'tp_fact_list',
            [
                'label' => esc_html__('Fact - List', 'tpcore'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'tp_fact_title' => esc_html__('Years', 'tpcore'),
                        'tp_fact_number' => esc_html__('17', 'tpcore'),
                    ],
                    [
                        'tp_fact_title' => esc_html__('People', 'tpcore'),
                        'tp_fact_number' => esc_html__('100', 'tpcore'),
                    ]
                ],
                'title_field' => '{{{ tp_fact_title }}}',
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

        $this->tp_basic_style_controls('about_description_2', 'About - Description', '.tp-el-box-desc');
        $this->tp_basic_style_controls('fact_title', 'Fact - Title', '.tp-el-fact-title');
        $this->tp_basic_style_controls('fact_number', 'Fact - Number', '.tp-el-fact-number');

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
            $this->add_render_attribute('title_args', 'class', 'section__title-4-2 tp-el-title');
            $bloginfo = get_bloginfo( 'name' );

        ?>



		<?php else:


            if ( !empty($settings['tp_image']['url']) ) {
                $tp_image = !empty($settings['tp_image']['id']) ? wp_get_attachment_image_url( $settings['tp_image']['id'], $settings['thumbnail_size']) : $settings['tp_image']['url'];
                $tp_image_alt = get_post_meta($settings["tp_image"]["id"], "_wp_attachment_image_alt", true);
            }

            if ( !empty($settings['tp_image_2']['url']) ) {
                $tp_image_2 = !empty($settings['tp_image_2']['id']) ? wp_get_attachment_image_url( $settings['tp_image_2']['id'], $settings['thumbnail_size']) : $settings['tp_image_2']['url'];
                $tp_image_2_alt = get_post_meta($settings["tp_image_2"]["id"], "_wp_attachment_image_alt", true);
            }

            if ( !empty($settings['tp_image_shape']['url']) ) {
                $tp_image_shape = !empty($settings['tp_image_shape']['id']) ? wp_get_attachment_image_url( $settings['tp_image_shape']['id'], $settings['thumbnail_size']) : $settings['tp_image_shape']['url'];
                $tp_image_shape_alt = get_post_meta($settings["tp_image_shape"]["id"], "_wp_attachment_image_alt", true);
            }


            $this->add_render_attribute('title_args', 'class', 'tp-section-title-5 mb-20 tp_text_invert tp-el-title');
		?>


            <!-- about area start -->
            <div class="tp-about-4-area black-bg-6 pt-150 pb-120 tp-el-section">
               <div class="container container-1320">

               <?php if ( !empty($settings['tp_about_section_title_show']) ) : ?>
                  <div class="tp-about-4-border">
                     <div class="row align-items-end">
                        <?php if(!empty($settings['tp_about_sub_title'])) : ?>
                        <div class="col-xl-2">
                           <div class="tp-about-4-subtitle-box">
                                <span class="tp-section-subtitle-5 tp-el-subtitle">
                                    <i><?php echo tp_kses( $settings['tp_about_sub_title'] ); ?></i>
                                </span>
                           </div>
                        </div>
                        <?php endif; ?>
                        <div class="col-xl-7 col-lg-8 col-md-8">
                           <div class="tp-about-4-title-box tp-el-content">

                                <?php
                                    if ( !empty($settings['tp_about_title' ]) ) :
                                        printf( '<%1$s %2$s>%3$s</%1$s>',
                                            tag_escape( $settings['tp_about_title_tag'] ),
                                            $this->get_render_attribute_string( 'title_args' ),
                                            tp_kses( $settings['tp_about_title' ] )
                                            );
                                    endif;
                                ?>

                                 <?php if ( !empty($settings['tp_about_description']) ) : ?>
                                <p class="tp_text_invert"><?php echo tp_kses( $settings['tp_about_description'] ); ?></p>
                                <?php endif; ?>
                           </div>
                        </div>

                        <?php if(!empty($settings['tp_image_shape']['url'])) : ?>
                        <div class="col-xl-3 col-lg-4 col-md-4 d-none d-md-block">
                           <div class="tp-about-4-shape text-end">
                              <img src="<?php echo esc_url($tp_image_shape); ?>" alt="<?php echo esc_attr($tp_image_shape_alt) ?>">
                           </div>
                        </div>
                        <?php endif; ?>
                     </div>
                  </div>
                  <?php endif; ?>

                  <div class="row align-items-center">
                     <div class="col-lg-5 col-md-6">
                        <div class="tp-about-4-thumb-box">
                        <?php if(!empty($tp_image)) : ?>
                        <div class="tp-about-4-thumb">
                            <img src="<?php echo esc_url($tp_image); ?>" alt="<?php echo esc_attr($tp_image_alt) ?>" data-speed="1.1">
                        </div>
                        <?php endif; ?>
                        </div>
                     </div>
                     <div class="col-lg-5 col-md-6">
                        <div class="tp-about-4-content-wrap">
                            <?php if(!empty($settings['tp_about_short_desc'])) : ?>
                           <div class="tp-about-4-content">
                              <p class="tp-el-box-desc"><?php echo tp_kses($settings['tp_about_short_desc']); ?></p>
                           </div>
                           <?php endif; ?>

                            <div class="tp-about-4-funfact  p-relative">
                                <span class="border-line d-none d-sm-inline-block"></span>

                                <div class="tp-about-4-funfact-item d-flex flex-wrap">

                                    <?php foreach ($settings['tp_fact_list'] as $key => $item) : ?>
                                    <span class="cols">
                                        <?php if (!empty($item['tp_fact_title' ])): ?>
                                        <i class="tp-el-fact-title"><?php echo tp_kses($item['tp_fact_title' ]); ?></i>
                                        <?php endif; ?> 
                                        <em class="tp-el-fact-number"><?php echo tp_kses($item['tp_fact_number' ]); ?><span><?php echo tp_kses($item['tp_fact_number_unit' ]); ?></span></em>
                                    </span>
                           
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                     </div>
                     <div class="col-lg-2 col-md-4">
                        <div class="tp-about-4-thumb-sm">
                            <img  src="<?php echo esc_url($tp_image_2); ?>" alt="" data-speed="0.9" data-lag="0">
                        </div>
                    </div>
                  </div>
               </div>
            </div>
            <!-- about area end -->

        <?php endif; ?>

        <?php
	}
}

$widgets_manager->register( new TP_About_Me_2() );
