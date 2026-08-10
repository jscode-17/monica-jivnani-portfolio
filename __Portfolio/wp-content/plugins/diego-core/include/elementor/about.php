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
class TP_About extends Widget_Base {

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
		return 'about';
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
		return __( 'About', 'tp-core' );
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
        'tp_about_subtitle',
         [
            'label'       => esc_html__( 'About Subtitle', 'tpcore' ),
            'type'        => \Elementor\Controls_Manager::TEXT,
            'default'     => esc_html__( 'About Me', 'tpcore' ),
            'placeholder' => esc_html__( 'Your Text', 'tpcore' ),
            'label_block' => true
         ]
        );
        
        $this->add_control(
        'tp_about_stroke_text',
         [
            'label'       => esc_html__( 'About Stroke Text', 'tpcore' ),
            'type'        => \Elementor\Controls_Manager::TEXT,
            'default'     => esc_html__( 'About Me', 'tpcore' ),
            'placeholder' => esc_html__( 'Your Text', 'tpcore' ),
            'label_block' => true
         ]
        );
        
        $this->add_control(
         'tp_about_desc',
         [
           'label'       => esc_html__( 'About Description', 'tpcore' ),
           'type'        => \Elementor\Controls_Manager::TEXTAREA,
           'rows'        => 10,
           'default'     => esc_html__( 'Hello! I’m Diego a self-taught & award-winning Digital Designer & Developer', 'tpcore' ),
           'placeholder' => esc_html__( 'Your Text', 'tpcore' ),
           'label_block' => true
         ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
         'tp_award_sec',
             [
               'label' => esc_html__( 'Awarad', 'tpcore' ),
               'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
             ]
        );

        $this->add_control(
         'tp_award_switch',
         [
           'label'        => esc_html__( 'Enable Award Text ?', 'tpcore' ),
           'type'         => \Elementor\Controls_Manager::SWITCHER,
           'label_on'     => esc_html__( 'Show', 'tpcore' ),
           'label_off'    => esc_html__( 'Hide', 'tpcore' ),
           'return_value' => 'yes',
           'default'      => 'yes',
         ]
        );
        
        $this->add_control(
            'tp_box_icon_type',
            [
                'label' => esc_html__('Select Icon Type', 'tpcore'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'image',
                'options' => [
                    'image' => esc_html__('Image', 'tpcore'),
                    'icon' => esc_html__('Icon', 'tpcore'),
                    'svg' => esc_html__('SVG', 'tpcore'),
                ],
                'condition' => [
                    'tp_award_switch' => 'yes'
                ]
            ]
        );
        $this->add_control(
            'tp_box_icon_svg',
            [
                'show_label' => false,
                'type' => Controls_Manager::TEXTAREA,
                'label_block' => true,
                'placeholder' => esc_html__('SVG Code Here', 'tpcore'),
                'condition' => [
                    'tp_box_icon_type' => 'svg',
                    'tp_award_switch' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'tp_box_icon_image',
            [
                'label' => esc_html__('Upload Icon Image', 'tpcore'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'tp_box_icon_type' => 'image',
                    'tp_award_switch' => 'yes'
                ]
            ]
        );

        if (tp_is_elementor_version('<', '2.6.0')) {
            $this->add_control(
                'tp_box_icon',
                [
                    'show_label' => false,
                    'type' => Controls_Manager::ICON,
                    'label_block' => true,
                    'default' => 'fa fa-star',
                    'condition' => [
                        'tp_box_icon_type' => 'icon',
                        'tp_award_switch' => 'yes'
                    ]
                ]
            );
        } else {
            $this->add_control(
                'tp_box_selected_icon',
                [
                    'show_label' => false,
                    'type' => Controls_Manager::ICONS,
                    'fa4compatibility' => 'icon',
                    'label_block' => true,
                    'default' => [
                        'value' => 'fas fa-star',
                        'library' => 'solid',
                    ],
                    'condition' => [
                        'tp_box_icon_type' => 'icon',
                        'tp_award_switch' => 'yes'
                    ]
                ]
            );
        }
        
        $this->add_control(
        'tp_award_title',
         [
            'label'       => esc_html__( 'Award Title', 'tpcore' ),
            'type'        => \Elementor\Controls_Manager::TEXT,
            'default'     => esc_html__( 'Independent Of The Year', 'tpcore' ),
            'placeholder' => esc_html__( 'Your Text', 'tpcore' ),
            'label_block' => true,
            'condition' => [
                'tp_award_switch' => 'yes'
            ]
         ]
        );

        $this->add_control(
        'tp_award_subtitle',
         [
            'label'       => esc_html__( 'Award Subtitle', 'tpcore' ),
            'type'        => \Elementor\Controls_Manager::TEXT,
            'default'     => esc_html__( 'Annual Awards 2020 • awwwards.com', 'tpcore' ),
            'placeholder' => esc_html__( 'Your Text', 'tpcore' ),
            'label_block' => true,
            'condition' => [
                'tp_award_switch' => 'yes'
            ]
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
         'tp_about_fac_sec',
             [
               'label' => esc_html__( 'Fun Fact', 'tpcore' ),
               'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
             ]
        );
        
        
        $repeater = new \Elementor\Repeater();
        
         $repeater->add_control(
         'tp_about_fact_title',
           [
             'label'   => esc_html__( 'Fact Title', 'tpcore' ),
             'type'        => \Elementor\Controls_Manager::TEXT,
             'default'     => esc_html__( 'Fact Title', 'tpcore' ),
             'label_block' => true,
           ]
         );
         $repeater->add_control(
         'tp_about_fact_number',
           [
             'label'   => esc_html__( 'Fact Number', 'tpcore' ),
             'type'        => \Elementor\Controls_Manager::TEXT,
             'default'     => esc_html__( 'Project Delivered', 'tpcore' ),
             'label_block' => true,
           ]
         );
         
         $repeater->add_control(
         'tp_about_fact_unit',
           [
             'label'   => esc_html__( 'Fact Unit', 'tpcore' ),
             'type'        => \Elementor\Controls_Manager::TEXT,
             'default'     => esc_html__( '+', 'tpcore' ),
             'label_block' => true,
           ]
         );
         
         $this->add_control(
           'tp_about_fact_list',
           [
             'label'       => esc_html__( 'Fact List', 'tpcore' ),
             'type'        => \Elementor\Controls_Manager::REPEATER,
             'fields'      => $repeater->get_controls(),
             'default'     => [
               [
                 'tp_about_fact_title'   => esc_html__( 'Project Delivered', 'tpcore' ),
                 'tp_about_fact_number'   => esc_html__( '50', 'tpcore' ),
               ],
               [
                 'tp_about_fact_title'   => esc_html__( 'Years of Experience', 'tpcore' ),
                 'tp_about_fact_number'   => esc_html__( '102', 'tpcore' ),
               ],
               [
                 'tp_about_fact_title'   => esc_html__( 'Happy Clients', 'tpcore' ),
                 'tp_about_fact_number'   => esc_html__( '78', 'tpcore' ),
               ],
             ],
             'title_field' => '{{{ tp_about_fact_title }}}',
           ]
         );
        
        $this->end_controls_section();
        

	}

    // style_tab_content
    protected function style_tab_content(){

        $this->tp_section_style_controls('about_section', 'Section - Style', '.tp-el-section');
        $this->tp_basic_style_controls('about_subtitle', 'About - Subtitle', '.tp-el-subtitle');
        $this->tp_basic_style_controls('about_desc', 'About - Description', '.tp-el-desc');
        $this->tp_basic_style_controls('about_bg_text', 'About - BG Text', '.tp-el-bg-text');

        $this->tp_section_style_controls('services_section_box', 'Award - Box - Style', '.tp-el-box');
        $this->tp_basic_style_controls('services_box_title', 'Award - Box - Title', '.tp-el-box-title');
        $this->tp_basic_style_controls('services_box_description', 'Award - Box - Description', '.tp-el-box-desc');
        $this->tp_icon_style('services_box_icon', 'Award - Icon/Image/SVG', '.tp-el-box-icon span');

        $this->tp_section_style_controls('fact_section_box', 'Fact - Box - Style', '.tp-el-fact-box');
        $this->tp_basic_style_controls('fact_box_title', 'Fact - Box - Title', '.tp-el-fact-title');
        $this->tp_basic_style_controls('fact_box_description', 'Fact - Box - Description', '.tp-el-fact-desc');

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

            $bloginfo = get_bloginfo( 'name' );

            if ( !empty($settings['tp_image']['url']) ) {
                $tp_image = !empty($settings['tp_image']['id']) ? wp_get_attachment_image_url( $settings['tp_image']['id'], $settings['thumbnail_size']) : $settings['tp_image']['url'];
                $tp_image_alt = get_post_meta($settings["tp_image"]["id"], "_wp_attachment_image_alt", true);
            }

		?>

            <!-- about area start -->
            <section class="tp-about-area fix tp-el-section">
               <div class="container container-large">
                  <div class="tp-about-inner pt-145 pb-80">
                     <span class="tp-about-inner-border transition-3"></span>
                     <div class="row">
                        <div class="col-xl-5 col-lg-5">
                           <div class="tp-about-wrapper">
                            <?php if(!empty($settings['tp_about_stroke_text']) || !empty($settings['tp_about_stroke_text'])) : ?>
                              <div class="tp-section-title-wrapper p-relative mb-45">
                                <?php if(!empty($settings['tp_about_stroke_text'])) : ?>
                                 <span class="tp-section-subtitle-bg tp-el-bg-text"><?php echo tp_kses($settings['tp_about_stroke_text']); ?></span>
                                 <?php endif; ?>

                                 <?php if(!empty($settings['tp_about_subtitle'])) : ?>
                                 <span class="tp-section-subtitle tp-section-subtitle-1 tp-about-subtitle tp-el-subtitle"><?php echo tp_kses($settings['tp_about_subtitle']); ?></span>
                                <?php endif; ?>
                                
                              </div>
                              <?php endif; ?>
                              <div class="tp-about-thumb-wrapper p-relative z-index-1">
                                 <div class="tp-about-thumb p-relative z-index-1">
                                    <div class="tp-about-thumb-bg-shape include-bg" data-background="<?php echo get_template_directory_uri(); ?>/assets/img/about/shape/about-shape-1.png"></div>
                                    <img src="<?php echo esc_url($tp_image); ?>" alt="<?php echo esc_attr($tp_image_alt); ?>">
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="col-xl-7 col-lg-7">
                           <div class="tp-about-desc">
                           <?php if($settings['tp_award_switch'] == 'yes') : ?>
                              <div class="tp-about-award d-inline-block tp-el-box">
                                 <div class="tp-about-award-icon d-inline-block mr-15 tp-el-box-icon">
                                    <?php if($settings['tp_box_icon_type'] == 'icon') : ?>
                                        <?php if (!empty($settings['tp_box_icon']) || !empty($settings['tp_box_selected_icon']['value'])) : ?>
                                                <span><?php tp_render_icon($settings, 'tp_box_icon', 'tp_box_selected_icon'); ?></span>
                                        <?php endif; ?>
                                    <?php elseif( $settings['tp_box_icon_type'] == 'image' ) : ?>
                                        <span>
                                            <?php if (!empty($settings['tp_box_icon_image']['url'])): ?>
                                            <img src="<?php echo $settings['tp_box_icon_image']['url']; ?>" alt="<?php echo get_post_meta(attachment_url_to_postid($settings['tp_box_icon_image']['url']), '_wp_attachment_image_alt', true); ?>">
                                            <?php endif; ?>
                                        </span>
                                    <?php else : ?>
                                        <span>
                                            <?php if (!empty($settings['tp_box_icon_svg'])): ?>
                                            <?php echo $settings['tp_box_icon_svg']; ?>
                                            <?php endif; ?>
                                        </span>
                                    <?php endif; ?>
                                 </div>
                               
                                 <div class="tp-about-award-content d-inline-block">
                                    <?php if(!empty($settings['tp_award_title'])) : ?>
                                    <h4 class="tp-about-award-title tp-el-box-title"><?php echo tp_kses($settings['tp_award_title']); ?></h4>
                                    <?php endif; ?>

                                    <?php if(!empty($settings['tp_award_subtitle'])) : ?>
                                    <p class="tp-el-box-desc"><?php echo tp_kses($settings['tp_award_subtitle']); ?></p>
                                    <?php endif; ?>
                                 </div>
                              </div>
                              <?php endif; ?>
                              
                              <?php if(!empty($settings['tp_about_desc'])) : ?>
                              <div class="tp-about-desc-content mb-40">
                                 <p class="tp-el-desc"><?php echo tp_kses($settings['tp_about_desc']); ?></p>
                              </div>
                              <?php endif; ?>

                              <div class="tp-about-fact">
                                 <div class="row">

                                    <?php foreach ($settings['tp_about_fact_list'] as $item) :?>
                                    <div class="col-md-4 col-sm-6 mb-30">
                                       <div class="tp-about-fact-item tp-el-fact-box">
                                          <h4 class="tp-el-fact-title"><span data-purecounter-duration="2" data-purecounter-end="<?php echo esc_attr($item['tp_about_fact_number']); ?>" class="purecounter"></span><?php echo esc_attr($item['tp_about_fact_unit']); ?></h4>
                                          <p class="tp-el-fact-desc"><?php echo esc_attr($item['tp_about_fact_title']); ?></p>
                                       </div>
                                    </div>
                                    <?php endforeach; ?>

                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </section>
            <!-- about area end -->

        <?php endif; ?>

        <?php
	}
}

$widgets_manager->register( new TP_About() );
