<?php
namespace TPCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Repeater;
use \Elementor\Utils;
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
class TP_About_Me extends Widget_Base {

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
		return 'about-me';
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
		return __( 'About Me', 'tp-core' );
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

    
        $this->start_controls_section(
         'tp_about_sec',
             [
               'label' => esc_html__( 'About Section', 'tpcore' ),
               'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
             ]
        );
        
        $this->add_control(
        'tp_about_title',
         [
            'label'       => esc_html__( 'About Title', 'tpcore' ),
            'type'        => \Elementor\Controls_Manager::TEXT,
            'default'     => esc_html__( 'About Me', 'tpcore' ),
            'placeholder' => esc_html__( 'Your Text', 'tpcore' ),
            'label_block' => true
         ]
        );
        
        $this->add_control(
        'tp_about_bg_text',
         [
            'label'       => esc_html__( 'About BG Text', 'tpcore' ),
            'type'        => \Elementor\Controls_Manager::TEXT,
            'default'     => esc_html__( 'About Me', 'tpcore' ),
            'placeholder' => esc_html__( 'Your Text', 'tpcore' ),
            'label_block' => true
         ]
        );

        $this->add_control(
         'tp_about_shape_switch',
         [
           'label'        => esc_html__( 'Enable Shape?', 'tpcore' ),
           'type'         => \Elementor\Controls_Manager::SWITCHER,
           'label_on'     => esc_html__( 'Show', 'tpcore' ),
           'label_off'    => esc_html__( 'Hide', 'tpcore' ),
           'return_value' => 'yes',
           'default'      => 'yes',
         ]
        );
        
        $this->add_control(
            'tp_slider_mouse_link',
            [
              'label'   => esc_html__( 'Mouse Scroll Link', 'tpcore' ),
              'type'        => \Elementor\Controls_Manager::URL,
              'default'     => [
                  'url'               => '#',
                  'is_external'       => true,
                  'nofollow'          => true,
                  'custom_attributes' => '',
                ],
                'placeholder' => esc_html__( 'Your Link', 'tpcore' ),
                'label_block' => true,

              ]
            );
   
        $this->add_control(
            'tp_slider_mouse_link_text',
             [
                'label'       => esc_html__( 'Mouse Scroll Text', 'tpcore' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => esc_html__( 'Scroll', 'tpcore' ),
                'placeholder' => esc_html__( 'Your Text', 'tpcore' ),
                'label_block' => true,
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
            'tp_image_signature',
            [
                'label' => esc_html__( 'Choose Signature Image', 'tp-core' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );
        $this->add_control(
            'tp_image_circle',
            [
                'label' => esc_html__( 'Choose Circle Image', 'tp-core' ),
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

        $this->tp_button_render_controls('tpbtn', 'Button', ['layout-1']);


        $this->tp_common_animation(null, 'desc_title', 'Animation - Title');

    }

    // style_tab_content
    protected function style_tab_content(){

        $this->tp_section_style_controls('about_section', 'Section - Style', '.tp-el-section');
        $this->tp_basic_style_controls('about_title', 'About - Title', '.tp-el-title');
        $this->tp_basic_style_controls('about_bg_section', 'About - BG Text', '.tp-el-bg-text');
        $this->tp_basic_style_controls('about_bg_scroll_text', 'About - Scroll Text', '.tp-el-scroll-text');
        $this->tp_link_controls_style('services_box_link_btn', 'About - Button', '.tp-el-btn');

        $this->start_controls_section(
            'tp_about_circle_styling',
            [
                'label' => esc_html__('Thumbnail Circle', 'tp-core'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );



        $this->add_control(
            'tp_about_circle_full_btn_normal_border_style',
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
                    '{{WRAPPER}} .tp-el-thumb-circle' => 'border-style: {{VALUE}} !important;;',
                ],
            ]
        );

        $this->add_responsive_control(
            'tp_about_circle_full_btn_normal_border_width',
            [
                'label' => esc_html__('Border Width', 'tp-core'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .tp-el-thumb-circle' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                ],
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'tp_about_circle_full_btn_normal_border_color',
            [
                'label' => esc_html__('Border Color', 'tp-core'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tp-el-thumb-circle' => 'border-color: {{VALUE}} !important;;',
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
		?>

		<?php if ( $settings['tp_design_style']  == 'layout-2' ):
            $this->add_render_attribute('title_args', 'class', 'section__title-4-2 tp-el-title');
            $bloginfo = get_bloginfo( 'name' );

        ?>
        



		<?php else:
            $this->tp_link_controls_render('tpbtn', 'tp-btn-border-sm tp-el-btn', $this->get_settings());

            $bloginfo = get_bloginfo( 'name' );

            if ( !empty($settings['tp_image']['url']) ) {
                $tp_image = !empty($settings['tp_image']['id']) ? wp_get_attachment_image_url( $settings['tp_image']['id'], $settings['thumbnail_size']) : $settings['tp_image']['url'];
                $tp_image_alt = get_post_meta($settings["tp_image"]["id"], "_wp_attachment_image_alt", true);
            }

            if ( !empty($settings['tp_image_signature']['url']) ) {
                $tp_image_signature = !empty($settings['tp_image_signature']['id']) ? wp_get_attachment_image_url( $settings['tp_image_signature']['id'], $settings['thumbnail_size']) : $settings['tp_image_signature']['url'];
                $tp_image_signature_alt = get_post_meta($settings["tp_image_signature"]["id"], "_wp_attachment_image_alt", true);
            }

            if ( !empty($settings['tp_image_circle']['url']) ) {
                $tp_image_circle = !empty($settings['tp_image_circle']['id']) ? wp_get_attachment_image_url( $settings['tp_image_circle']['id'], $settings['thumbnail_size']) : $settings['tp_image_circle']['url'];
                $tp_image_circle_alt = get_post_meta($settings["tp_image_circle"]["id"], "_wp_attachment_image_alt", true);
            }

		?>


            <!-- ab hero area start -->
            <div class="ab-hero__area ab-hero__customize ab-hero__ptb black-bg-3 p-relative z-index-1 fix tp-el-section">

            <?php if($settings['tp_about_shape_switch'] == 'yes') : ?>
               <div class="ab-hero__shape-1">
                  <img src="<?php echo get_template_directory_uri(); ?>/assets/img/hero/hero-shape-2-1.png" alt="<?php echo esc_attr($bloginfo); ?>">
               </div>
               <?php endif; ?>

               <?php if(!empty($settings['tp_about_title'])) : ?>
               <div class="ab-hero__text d-none d-lg-block col-md-4">
                  <span class="tp-el-bg-text"><?php echo tp_kses($settings['tp_about_bg_text']); ?></span>
               </div>
               <?php endif; ?>
               

               <?php if(!empty($settings['tp_slider_mouse_link'])) : ?>
               <div class="smooth">
                  <a href="<?php echo esc_url($settings['tp_slider_mouse_link']['url']); ?>" class="d-none d-xl-block">
                     <div class="tp-hero-3__scrool-down">
                        <span class="text tp-el-scroll-text"><?php echo esc_html($settings['tp_slider_mouse_link_text']); ?></span>
                        <span class="tp-el-scroll-text">
                           <svg width="14" height="93" viewBox="0 0 14 93" fill="none" xmlns="http://www.w3.org/2000/svg">
                              <path d="M14 85.8995C10.1308 85.8995 6.9999 88.9319 6.9999 92.6793" stroke="currentColor"
                                 stroke-width="2" stroke-miterlimit="10" />
                              <path d="M7 92.6793C7 88.9319 3.86911 85.8995 -0.000102413 85.8995" stroke="currentColor"
                                 stroke-width="2" stroke-miterlimit="10" />
                              <path d="M7 0L7 90" stroke="currentColor" stroke-width="2" stroke-miterlimit="10" />
                           </svg>
                        </span>
                     </div>
                  </a>
               </div>
               <?php endif; ?>  

               <div class="container">
                  <div class="row">
                     <div class="col-xl-6 col-lg-5">
                        <?php if(!empty($settings['tp_about_title'])) : ?>
                        <div class="ab-hero__title-box">
                           <h3 class="ab-hero__title tp-el-title <?php echo esc_attr($this->tp_common_animation_get($settings, 'desc_title')); ?>"><?php echo tp_kses($settings['tp_about_title']); ?></h3>
                        </div>
                        <?php endif; ?>

                        <?php if (!empty($settings['tp_' . $control_id .'_text']) && $settings['tp_' . $control_id .'_button_show'] == 'yes') : ?>
                        <div class="ab-hero__btn-box">
                           <a <?php echo $this->get_render_attribute_string( 'tp-button-arg' . $control_id .'' ); ?>>
                           <?php echo $settings['tp_' . $control_id .'_text']; ?>
                              <span>
                                 <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                       d="M15 10.3331V13.4442C15 13.8568 14.8361 14.2525 14.5444 14.5442C14.2527 14.8359 13.857 14.9998 13.4444 14.9998H2.55556C2.143 14.9998 1.74733 14.8359 1.45561 14.5442C1.16389 14.2525 1 13.8568 1 13.4442V10.3331"
                                       stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                       stroke-linejoin="round" />
                                    <path d="M4.11328 6.44458L8.00217 10.3335L11.8911 6.44458" stroke="currentColor"
                                       stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                    <path d="M8 10.3333V1" stroke="currentColor" stroke-width="1.5"
                                       stroke-linecap="round" stroke-linejoin="round" />
                                 </svg>
                              </span>
                           </a>
                        </div>
                        <?php endif; ?>
                     </div>


                     <?php if(!empty($tp_image)) : ?>
                     <div class="col-xl-6 col-lg-7">
                        <div class="ab-hero__right-box text-end p-relative mt-25 wow tpfadeLeft" data-wow-duration=".9s" data-wow-delay=".5s">
                            <?php if(!empty($tp_image)) : ?>
                            <div class="ab-hero__signature">
                                <img src="<?php echo esc_url($tp_image_signature); ?>" alt="<?php echo esc_attr($tp_image_signature_alt); ?>">
                           </div>
                           <?php endif; ?>

                           <?php if(!empty($tp_image_circle)) : ?>
                           <div class="ab-hero__circle tp-el-thumb-circle">
                              <img class="tp-rotate-center" src="<?php echo esc_url($tp_image_circle); ?>" alt="<?php echo esc_attr($tp_image_circle_alt); ?>">
                           </div>
                           <?php endif; ?>
                           <div class="ab-hero__big-img">
                              <img src="<?php echo esc_url($tp_image); ?>" alt="<?php echo esc_attr($tp_image_alt); ?>">
                           </div>

                        </div>
                     </div>
                     <?php endif; ?>
                  </div>
               </div>
            </div>
            <!-- ab hero area end -->

        <?php endif; ?>

        <?php
	}
}

$widgets_manager->register( new TP_About_Me() );
