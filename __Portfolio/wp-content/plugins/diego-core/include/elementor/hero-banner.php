<?php
namespace TPCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Group_Control_Background;
use \Elementor\Control_Media;
use \Elementor\Repeater;
use \Elementor\Group_Control_Typography;
use \Elementor\Group_Control_Box_Shadow;
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
class TP_Hero_Banner extends Widget_Base {

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
		return 'hero-banner';
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
		return __( 'Hero Banner', 'tp-core' );
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
                    'layout-2' => esc_html__('Layout 2', 'tp-core'),
                    'layout-3' => esc_html__('Layout 3', 'tp-core'),
                ],
                'default' => 'layout-1',
            ]
        );

        $this->end_controls_section();


        $this->start_controls_section(
         'hero_content_sec',
             [
               'label' => esc_html__( 'Hero Content', 'tpcore' ),
               'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
             ]
        );
        
        $this->add_control(
         'tp_stroke_image',
         [
           'label'   => esc_html__( 'Upload Stroke Image', 'tpcore' ),
           'type'    => \Elementor\Controls_Manager::MEDIA,
             'default' => [
               'url' => \Elementor\Utils::get_placeholder_image_src(),
           ],
           'condition' => [
                'tp_design_style' => ['layout-2']
           ]
         ]
        );

        $this->add_control(
            'tp_slider_sub_title',
            [
                'label' => esc_html__('Sub Title', 'tpcore'),
                'description' => tp_get_allowed_html_desc( 'basic' ),
                'type' => Controls_Manager::TEXT,
                'default' => 'Starting at 247',
                'placeholder' => esc_html__('Type Before Heading Text', 'tpcore'),
                'label_block' => true,
                'condition' => [
                    'tp_design_style' => ['layout-1', 'layout-2']
               ]
            ]
        );

        $this->add_control(
            'tp_slider_title',
            [
                'label' => esc_html__('Title', 'tpcore'),
                'description' => tp_get_allowed_html_desc( 'intermediate' ),
                'type' => Controls_Manager::TEXTAREA,
                'default' => esc_html__('Grow business.', 'tpcore'),
                'placeholder' => esc_html__('Type Heading Text', 'tpcore'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'tp_slider_title_tag',
            [
                'label' => esc_html__('Title HTML Tag', 'tpcore'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'h1' => [
                        'title' => esc_html__('H1', 'tpcore'),
                        'icon' => 'eicon-editor-h1'
                    ],
                    'h2' => [
                        'title' => esc_html__('H2', 'tpcore'),
                        'icon' => 'eicon-editor-h2'
                    ],
                    'h3' => [
                        'title' => esc_html__('H3', 'tpcore'),
                        'icon' => 'eicon-editor-h3'
                    ],
                    'h4' => [
                        'title' => esc_html__('H4', 'tpcore'),
                        'icon' => 'eicon-editor-h4'
                    ],
                    'h5' => [
                        'title' => esc_html__('H5', 'tpcore'),
                        'icon' => 'eicon-editor-h5'
                    ],
                    'h6' => [
                        'title' => esc_html__('H6', 'tpcore'),
                        'icon' => 'eicon-editor-h6'
                    ]
                ],
                'default' => 'h2',
                'toggle' => false,
            ]
        );

        $this->add_control(
            'tp_slider_description',
            [
                'label' => esc_html__('Description', 'tpcore'),
                'description' => tp_get_allowed_html_desc( 'intermediate' ),
                'type' => Controls_Manager::TEXTAREA,
                'default' => esc_html__('There are many variations of passages of Lorem Ipsum available but the majority have suffered alteration.', 'tpcore'),
                'placeholder' => esc_html__('Type section description here', 'tpcore'),
                'condition' => [
                    'tp_design_style' => ['layout-1', 'layout-3']
               ]
            ]
        );

        $this->add_control(
            'tp_slider_bottom_text',
            [
                'label' => esc_html__('Bottom Title', 'tpcore'),
                'description' => tp_get_allowed_html_desc( 'intermediate' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Visual designer', 'tpcore'),
                'placeholder' => esc_html__('Type Bottom Text', 'tpcore'),
                'label_block' => true,
                'condition' => [
                    'tp_design_style' => ['layout-1']
               ]
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
             'condition' => [
                'tp_design_style' => ['layout-1', 'layout-3']
           ]
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
             'condition' => [
                'tp_design_style' => ['layout-3']
           ]
          ]
         );
        
        $this->end_controls_section();

        
        $this->tp_button_render_controls('tpbtn', 'Button' , ['layout-1', 'layout-3']);

        // _tp_image
        $this->start_controls_section(
            '_tp_image_section',
            [
                'label' => esc_html__('Thumbnail Image', 'tp-core'),
                'condition' => [
                    'tp_design_style' => ['layout-1', 'layout-2']
               ]
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
            'background_image',
            [
                'label' => esc_html__( 'Choose BG Image', 'tp-core' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'tp_design_style' => ['layout-2']
               ]
            ]
        );

        $this->add_control(
            'tp_hero_shape_image_1',
            [
                'label' => esc_html__( 'Choose Shape Image', 'tp-core' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'tp_design_style' => ['layout-1', 'layout-2']
               ]
            ]
        );

        $this->add_control(
            'tp_hero_shape_image_2',
            [
                'label' => esc_html__( 'Choose Shape Image 2', 'tp-core' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'tp_design_style' => 'layout-1'
               ]
            ]
        );

        $this->add_control(
         'tp_slider_thumb_shape_switch',
         [
           'label'        => esc_html__( 'Enable Shape?', 'tpcore' ),
           'type'         => \Elementor\Controls_Manager::SWITCHER,
           'label_on'     => esc_html__( 'Show', 'tpcore' ),
           'label_off'    => esc_html__( 'Hide', 'tpcore' ),
           'return_value' => 'yes',
           'default'      => 'yes',
           'condition' => [
            'tp_design_style' => ['layout-2']
       ]
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


        $this->start_controls_section(
         'tp_slider_shape',
             [
               'label' => esc_html__( 'Hero Shape Switch', 'tpcore' ),
               'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
             ]
        );

        $this->add_control(
         'tp_slider_shape_switch',
         [
           'label'        => esc_html__( 'Shape On/Off', 'tpcore' ),
           'type'         => \Elementor\Controls_Manager::SWITCHER,
           'label_on'     => esc_html__( 'Show', 'tpcore' ),
           'label_off'    => esc_html__( 'Hide', 'tpcore' ),
           'return_value' => 'yes',
           'default'      => 'yes',
         ]
        );
        
        $this->end_controls_section();


        $this->start_controls_section(
            'tp_social_section',
            [
                'label' => __( 'Social Links', 'tpcore' ),
                'tab' => Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'tp_design_style' => ['layout-1', 'layout-3']
               ]
            ]
        );
		
		$repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'repeater_condition',
            [
                'label' => __( 'Field condition', 'tpcore' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'style_1' => __( 'Style 1', 'tpcore' ),
                    'style_2' => __( 'Style 2', 'tpcore' ),
                ],
                'default' => 'style_1',
                'frontend_available' => true,
                'style_transfer' => true,
            ]
        );

        $repeater->add_control(
            'tp_box_icon_type',
            [
                'label' => esc_html__('Select Icon Type', 'tpcore'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'icon',
                'options' => [
                    'image' => esc_html__('Image', 'tpcore'),
                    'icon' => esc_html__('Icon', 'tpcore'),
                    'svg' => esc_html__('SVG', 'tpcore'),
                ],
                'condition' => [
                    'repeater_condition' => ['style_1'],
                ]
            ]
        );
        $repeater->add_control(
            'tp_box_icon_svg',
            [
                'show_label' => false,
                'type' => Controls_Manager::TEXTAREA,
                'label_block' => true,
                'placeholder' => esc_html__('SVG Code Here', 'tpcore'),
                'condition' => [
                    'tp_box_icon_type' => 'svg',
                    'repeater_condition' => ['style_1'],
                ]
            ]
        );

        $repeater->add_control(
            'tp_box_icon_image',
            [
                'label' => esc_html__('Upload Icon Image', 'tpcore'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'tp_box_icon_type' => 'image',
                    'repeater_condition' => ['style_1'],
                ]
            ]
        );

        if (tp_is_elementor_version('<', '2.6.0')) {
            $repeater->add_control(
                'tp_box_icon',
                [
                    'show_label' => false,
                    'type' => Controls_Manager::ICON,
                    'label_block' => true,
                    'default' => 'fa fa-star',
                    'condition' => [
                        'tp_box_icon_type' => 'icon',
                        'repeater_condition' => ['style_1'],
                    ]
                ]
            );
        } else {
            $repeater->add_control(
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
                        'repeater_condition' => ['style_1'],
                    ]
                ]
            );
        }

        $repeater->add_control(
        'tp_social_link_text',
         [
            'label'       => esc_html__( 'Social Title', 'tpcore' ),
            'type'        => \Elementor\Controls_Manager::TEXT,
            'default'     => esc_html__( 'Facebook', 'tpcore' ),
            'placeholder' => esc_html__( 'Your Text', 'tpcore' ),
            'condition' => [
                'repeater_condition' => ['style_2'],
            ]
         ]
        );

		 $repeater->add_control(
		  'tp_social_link',
		  [
			'label'   => esc_html__( 'Social Link', 'tpcore' ),
			'type'        => \Elementor\Controls_Manager::URL,
			'default'     => [
				'url'               => '#',
				'is_external'       => true,
				'nofollow'          => true,
				'custom_attributes' => '',
			  ],
			  'placeholder' => esc_html__( 'Your Link Here', 'tpcore' ),
			  'label_block' => true,
			]
		  );
		 
		 $this->add_control(
		   'tp_social_list',
		   [
			 'label'       => esc_html__( 'Social List', 'tpcore' ),
			 'type'        => \Elementor\Controls_Manager::REPEATER,
			 'fields'      => $repeater->get_controls(),
			 'default'     => [
			   [
				 'tp_social_link_text'   => esc_html__( 'Social 1', 'tpcore' ),
			   ],
			   [
				 'tp_social_link_text'   => esc_html__( 'Social 2', 'tpcore' ),
			   ],
			   [
				 'tp_social_link_text'   => esc_html__( 'Social 3', 'tpcore' ),
			   ],
			 ],
			 'title_field' => '{{{ tp_social_link_text }}}',
		   ]
		 );

		 $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'thumbnail', // // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `thumbnail_size` and `thumbnail_custom_dimension`.
                'exclude' => ['custom'],
            ]
        );
        $this->end_controls_section();

        $this->tp_common_animation(null, 'desc_title', 'Animation - Title');
        $this->tp_common_animation(null, 'desc_animation', 'Animation - Description');        

	}
    
    // style_tab_content
    protected function style_tab_content(){
        $this->tp_section_style_controls('hero_banner_section', 'Section - Style', '.tp-el-section');
        $this->tp_basic_style_controls('hero_banner_subtitle', 'Section - Subtitle', '.tp-el-subtitle');
        $this->tp_basic_style_controls('hero_banner_title', 'Section - Title', '.tp-el-title');
        $this->tp_basic_style_controls('hero_banner_desc', 'Section - Description', '.tp-el-desc');
        $this->tp_link_controls_style('hero_banner_link_btn', 'Section - Button', '.tp-el-hero-btn');
        $this->tp_basic_style_controls('hero_banner_bg_text', 'Section - BG Text', '.tp-el-bg-title p');
        $this->tp_link_controls_style('hero_banner_social_btn', 'Section - Social', '.tp-el-social-btn a');


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
                    '{{WRAPPER}} .tp-el-hero-btn-dot, {{WRAPPER}} .tp-el-hero-btn-bg::after' => 'background-color: {{VALUE}} !important;',
                ],
            ]
        );



        $this->end_controls_section();

        $this->tp_basic_style_controls('about_bg_scroll_text', 'Hero - Scroll Text', '.tp-el-scroll-text');



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

            if ( !empty($settings['tp_image']['url']) ) {
                $tp_image = !empty($settings['tp_image']['id']) ? wp_get_attachment_image_url( $settings['tp_image']['id'], $settings['tp_image_size_size']) : $settings['tp_image']['url'];
                $tp_image_alt = get_post_meta($settings["tp_image"]["id"], "_wp_attachment_image_alt", true);
            }

            if ( !empty($settings['tp_hero_shape_image_1']['url']) ) {
                $tp_hero_shape_image_1 = !empty($settings['tp_hero_shape_image_1']['id']) ? wp_get_attachment_image_url( $settings['tp_hero_shape_image_1']['id'], $settings['tp_image_size_size']) : $settings['tp_hero_shape_image_1']['url'];
                $tp_hero_shape_image_1_alt = get_post_meta($settings["tp_hero_shape_image_1"]["id"], "_wp_attachment_image_alt", true);
            }

            if ( !empty($settings['background_image']['url']) ) {
                $background_image = !empty($settings['background_image']['id']) ? wp_get_attachment_image_url( $settings['background_image']['id'], $settings['tp_image_size_size']) : $settings['background_image']['url'];
                $background_image_alt = get_post_meta($settings["background_image"]["id"], "_wp_attachment_image_alt", true);
            }

            if ( !empty($settings['tp_stroke_image']['url']) ) {
                $tp_stroke_image = !empty($settings['tp_stroke_image']['id']) ? wp_get_attachment_image_url( $settings['tp_stroke_image']['id'], $settings['tp_image_size_size']) : $settings['tp_stroke_image']['url'];
                $tp_stroke_image_alt = get_post_meta($settings["tp_stroke_image"]["id"], "_wp_attachment_image_alt", true);
            }

            $bloginfo = get_bloginfo( 'name' );
            $this->add_render_attribute('title_args', 'class', 'tp-hero-title-2 tp-el-title');

        ?>

            <div class="tp-mouse-move-section tp-hero-2__bg black-bg-3 tp-hero-2__space-1 d-flex align-items-end justify-content-center z-index-1 p-relative fix tp-el-section">
               <div class="tp-hero-distort-2" data-background="<?php echo esc_url($background_image) ?>"></div>

               <?php if($settings['tp_slider_shape_switch'] == 'yes'): ?>
                <div class="tp-hero-2__circle-wrapper">
                    <span class="tp-hero-2__circle-1 tp-mouse-move-element"></span>
                    <span class="tp-hero-2__circle-2 tp-mouse-move-element"></span>
                    <span class="tp-hero-2__circle-3 tp-mouse-move-element"></span>
                    <span class="tp-hero-2__circle-4 tp-mouse-move-element"></span>
                </div>
                <?php endif; ?>

                <div class="container">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="tp-hero-content-2">
                                <div class="tp-hero-title-2-wrapper text-center">
                                    <?php
                                        if ( !empty($settings['tp_slider_title' ]) ) :
                                            printf( '<%1$s %2$s>%3$s</%1$s>',
                                                tag_escape( $settings['tp_slider_title_tag'] ),
                                                $this->get_render_attribute_string( 'title_args' ),
                                                tp_kses( $settings['tp_slider_title' ] )
                                                );
                                        endif;
                                    ?>
                                    <br>
                                    <span class="stroke-text d-flex align-items-end justify-content-center">
                                        <img src="<?php echo esc_url($tp_stroke_image);?>" alt="<?php echo esc_attr($tp_stroke_image_alt); ?>">

                                        <?php if (!empty($settings['tp_slider_sub_title'])) : ?>
                                        <span class="location-text d-flex align-items-end text-start d-none d-lg-flex tp-el-subtitle">
                                            <span class="d-none d-md-block"><?php echo tp_kses( $settings['tp_slider_sub_title'] ); ?></span>
                                        </span>
                                        <?php endif; ?>
                                    </span>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="tp-hero-2__thumb-wrap p-relative text-center">
                                <div class="tp-hero-2__thumb z-index-5">
                                    <img class="tp-mouse-move-element" src="<?php echo esc_url($tp_image);?>" alt="<?php echo esc_attr($tp_image_alt); ?>">
                                </div>
                                <?php if(!empty($tp_hero_shape_image_1)): ?>
                                <div class="tp-hero-2__thumb-shape d-none d-md-block">
                                    <span>
                                    
                                    <img src="<?php echo esc_url($tp_hero_shape_image_1);?>" alt="<?php echo esc_attr($tp_hero_shape_image_1_alt); ?>">
                                
                                    </span>
                                </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <?php elseif($settings['tp_design_style']  == 'layout-3') : 
                $this->tp_link_controls_render('tpbtn', 'tp-btn-blue tp-el-hero-btn tp-el-hero-btn-bg', $this->get_settings());
                $this->add_render_attribute('title_args', 'class', 'tp-hero-3__title tp-el-title ' .
                $this->tp_common_animation_get($settings, 'desc_title'));
                ?>
                    <!-- hero area start -->
                    <div class="tp-hero-3__area black-bg-3 tp-hero-3__ptb z-index-1 smooth p-relative tp-btn-trigger-3 tp-el-section">

                    <?php if($settings['tp_slider_shape_switch'] == 'yes'): ?>
                        <div class="tp-hero-3__shape-1">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/img/hero/hero-shape-2-1.png" alt="">
                        </div>
                        <div class="tp-hero-3__shape-2">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/img/hero/hero-shape-2-2.png" alt="">
                        </div>
                        <?php endif; ?>

                        <div class="tp-hero-3__social-wrap d-none d-lg-inline-flex tp-el-social-btn">
                            <?php foreach ($settings['tp_social_list'] as $key => $item) : 
                                $link = !empty($item['tp_social_link']['url']) ? $item['tp_social_link']['url'] : '';
                                $target = !empty($item['tp_social_link']['is_external']) ? '_blank' : '';
                                $rel = !empty($item['tp_social_link']['nofollow']) ? 'nofollow' : '';

                            ?>
                            <a target="<?php echo esc_attr($target); ?>" rel="<?php echo esc_attr($rel); ?>" href="<?php echo esc_url($link); ?>"><?php echo esc_html($item['tp_social_link_text']); ?></a>
                            <?php endforeach; ?>
                        </div>

                        <?php if(!empty($settings['tp_slider_mouse_link'])) : ?>
                        <a href="<?php echo esc_url($settings['tp_slider_mouse_link']['url']); ?>">
                            <div class="tp-hero-3__scrool-down d-none d-lg-inline-flex">
                                <span class="text tp-el-scroll-text"><?php echo esc_html($settings['tp_slider_mouse_link_text']); ?></span>
                                <span class="tp-el-scroll-text">
                                    <svg width="14" height="93" viewBox="0 0 14 93" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M14 85.8995C10.1308 85.8995 6.9999 88.9319 6.9999 92.6793" stroke="currentColor" stroke-width="2" stroke-miterlimit="10"/>
                                        <path d="M7 92.6793C7 88.9319 3.86911 85.8995 -0.000102413 85.8995" stroke="currentColor" stroke-width="2" stroke-miterlimit="10"/>
                                        <path d="M7 0L7 90" stroke="currentColor" stroke-width="2" stroke-miterlimit="10"/>
                                    </svg>
                                </span>
                            </div>
                        </a>
                        <?php endif; ?>  

                        <div class="container">
                            <div class="row">
                                <div class="col-xl-12">
                                    <div class="tp-hero-3__content">
                                    
                                        <?php
                                            if ( !empty($settings['tp_slider_title' ]) ) :
                                                printf( '<%1$s %2$s>%3$s</%1$s>',
                                                    tag_escape( $settings['tp_slider_title_tag'] ),
                                                    $this->get_render_attribute_string( 'title_args' ),
                                                    tp_kses( $settings['tp_slider_title' ] )
                                                    );
                                            endif;
                                        ?>
                                    </div>
                                    <div class="tp-hero-3__btn-box <?php echo esc_attr($this->tp_common_animation_get($settings, 'desc_animation')) ?> d-flex align-items-center justify-content-start justify-content-md-center">
                                        <?php if ($settings['tp_' . $control_id .'_button_show'] == 'yes') : ?>
                                        <div class="tp-btn-bounce-3">
                                            <a <?php echo $this->get_render_attribute_string( 'tp-button-arg' . $control_id .'' ); ?>>
                                                <span class="text"> <?php echo tp_kses($settings['tp_' . $control_id .'_text']); ?></span>
                                                <span class="icon">
                                                    <svg width="11" height="11" viewBox="0 0 11 11" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M1 1L10 10" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                        <path d="M10 1V10H1" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                    </svg>
                                                </span>
                                            </a>
                                        </div>
                                        <?php endif; ?>
                              
                                        <?php if (!empty($settings['tp_slider_description'])) : ?>
                                        <p class="tp-el-desc <?php echo esc_attr($this->tp_common_animation_get($settings, 'desc_animation')) ?>"><?php echo tp_kses( $settings['tp_slider_description'] ); ?></p>
                                        <?php endif; ?>  
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- hero area end -->

		<?php else: 
            // main img
            if ( !empty($settings['tp_image']['url']) ) {
                $tp_image = !empty($settings['tp_image']['id']) ? wp_get_attachment_image_url( $settings['tp_image']['id'], $settings['tp_image_size_size']) : $settings['tp_image']['url'];
                $tp_image_alt = get_post_meta($settings["tp_image"]["id"], "_wp_attachment_image_alt", true);
            }

            // main shape img
            if ( !empty($settings['tp_hero_shape_image_1']['url']) ) {
                $tp_hero_shape_image_1 = !empty($settings['tp_hero_shape_image_1']['id']) ? wp_get_attachment_image_url( $settings['tp_hero_shape_image_1']['id'], $settings['tp_image_size_size']) : $settings['tp_hero_shape_image_1']['url'];
                $tp_hero_shape_image_1_alt = get_post_meta($settings["tp_hero_shape_image_1"]["id"], "_wp_attachment_image_alt", true);
            }
            // main shape img
            if ( !empty($settings['tp_hero_shape_image_2']['url']) ) {
                $tp_hero_shape_image_2 = !empty($settings['tp_hero_shape_image_2']['id']) ? wp_get_attachment_image_url( $settings['tp_hero_shape_image_2']['id'], $settings['tp_image_size_size']) : $settings['tp_hero_shape_image_2']['url'];
                $tp_hero_shape_image_2_alt = get_post_meta($settings["tp_hero_shape_image_2"]["id"], "_wp_attachment_image_alt", true);
            }

            $this->tp_link_controls_render('tpbtn', 'tp-hover-btn tp-hover-btn-item tp-btn-circle square tp-el-hero-btn', $this->get_settings());

            $bloginfo = get_bloginfo( 'name' );
			$this->add_render_attribute('title_args', 'class', 'tp-hero-title cd-headline clip tp-el-title ' . 
            $this->tp_common_animation_get($settings, 'desc_title'));
            
		?>

            <!-- hero area start -->
            <section class="tp-hero-area p-relative tp-btn-trigger z-index-1 fix theme-bg-2 tp-el-section">
               <div class="tp-hero-social-wrapper">
                  <span class="tp-hero-social-bar"></span>
                  <div class="tp-hero-social tp-el-social-btn">

                  <?php foreach ($settings['tp_social_list'] as $key => $item) : 

                        $link = !empty($item['tp_social_link']['url']) ? $item['tp_social_link']['url'] : '';
                        $target = !empty($item['tp_social_link']['is_external']) ? '_blank' : '';
                        $rel = !empty($item['tp_social_link']['nofollow']) ? 'nofollow' : '';
                    ?>
                     <a target="<?php echo esc_attr($target); ?>" rel="<?php echo esc_attr($rel); ?>" href="<?php echo esc_url($link); ?>">

                        <?php if($item['tp_box_icon_type'] == 'icon') : ?>
                            <?php if (!empty($item['tp_box_icon']) || !empty($item['tp_box_selected_icon']['value'])) : ?>
                                    <span><?php tp_render_icon($item, 'tp_box_icon', 'tp_box_selected_icon'); ?></span>
                            <?php endif; ?>
                        <?php elseif( $item['tp_box_icon_type'] == 'image' ) : ?>
                            <span>
                                <?php if (!empty($item['tp_box_icon_image']['url'])): ?>
                                <img src="<?php echo $item['tp_box_icon_image']['url']; ?>" alt="<?php echo get_post_meta(attachment_url_to_postid($item['tp_box_icon_image']['url']), '_wp_attachment_image_alt', true); ?>">
                                <?php endif; ?>
                            </span>
                        <?php else : ?>
                            <span>
                                <?php if (!empty($item['tp_box_icon_svg'])): ?>
                                <?php echo $item['tp_box_icon_svg']; ?>
                                <?php endif; ?>
                            </span>
                        <?php endif; ?>
                     </a>
                     <?php endforeach; ?>

                  </div>
               </div>
               <?php if($settings['tp_slider_shape_switch'] == 'yes'): ?>
               <div class="tp-hero-shape">
                  <div class="tp-hero-shape-1 background-white-mode include-bg" data-background="<?php echo get_template_directory_uri(); ?>/assets/img/hero/hero-overlay.png"></div>
                  <div class="tp-hero-shape-1 background-dark-mode include-bg" data-background="<?php echo get_template_directory_uri(); ?>/assets/img/hero/hero-overlay-2.png"></div>
                  <span class="tp-hero-shape-2"></span>
               </div>
               <?php endif; ?>

               <?php if(!empty($settings['tp_slider_bottom_text'])) : ?>
               <div class="tp-hero-bottom-text-wrapper">
                  <div class="tp-hero-bottom-text tp-el-bg-title">
                     <p><?php echo tp_kses($settings['tp_slider_bottom_text']); ?></p>
                     <p><?php echo tp_kses($settings['tp_slider_bottom_text']); ?></p>
                  </div>
                  <div class="tp-hero-bottom-text tp-el-bg-title">
                     <p><?php echo tp_kses($settings['tp_slider_bottom_text']); ?></p>
                     <p><?php echo tp_kses($settings['tp_slider_bottom_text']); ?></p>
                  </div>
               </div>
               <?php endif; ?>

               <div class="container">
                  <div class="row align-items-end">
                     <div class="col-xl-7 col-lg-7 col-md-12">
                        <div class="tp-hero-left-wrapper">
                           <div class="tp-hero-content p-relative z-index-1 <?php echo esc_attr($this->tp_common_animation_get($settings, 'desc_animation')) ?>">

                            <?php if (!empty($settings['tp_slider_sub_title'])) : ?>
                            <span class="tp-el-subtitle"><?php echo tp_kses( $settings['tp_slider_sub_title'] ); ?></span>
                            <?php endif; ?>

                              <?php
                                    if ( !empty($settings['tp_slider_title' ]) ) :
                                        printf( '<%1$s %2$s>%3$s</%1$s>',
                                            tag_escape( $settings['tp_slider_title_tag'] ),
                                            $this->get_render_attribute_string( 'title_args' ),
                                            tp_kses( $settings['tp_slider_title' ] )
                                            );
                                    endif;
                                ?>

                                <?php if (!empty($settings['tp_slider_description'])) : ?>
                                <p class="tp-el-desc"><?php echo tp_kses( $settings['tp_slider_description'] ); ?></p>
                                <?php endif; ?>  

                                <?php if ($settings['tp_' . $control_id .'_button_show'] == 'yes') : ?>
                              <div class="tp-hero-btn wrap ">
                                 <div class="tp-hover-btn-wrapper tp-btn-bounce">
                                    <a <?php echo $this->get_render_attribute_string( 'tp-button-arg' . $control_id .'' ); ?> class="">
                                       <span class="tp-btn-circle-text">
                                       <?php echo tp_kses($settings['tp_' . $control_id .'_text']); ?>
                                       </span>
                                       <span class="tp-btn-circle-arrow">
                                          <svg width="12" height="12" viewBox="0 0 12 12" fill="none"
                                             xmlns="http://www.w3.org/2000/svg">
                                             <path d="M11 1L1 11" stroke="currentColor" stroke-width="1.5"
                                                stroke-linecap="round" stroke-linejoin="round" />
                                             <path d="M2.98874 1.01725L10.9991 1L10.9826 9.01105" stroke="currentColor"
                                                stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                          </svg>
                                       </span>
                                       <i class="tp-btn-circle-dot tp-el-hero-btn-dot"></i>
                                    </a>
                                 </div>
                              </div>
                              <?php endif; ?>


                              <?php if(!empty($settings['tp_slider_mouse_link'])) : ?>
                              <div class="tp-hero-scroll smooth">
                                 <a href="<?php echo esc_url($settings['tp_slider_mouse_link']['url']); ?>">
                                    <span class="tp-hero-scroll-bar"></span>
                                    <span class="tp-hero-scroll-mouse"></span>
                                 </a>
                              </div>
                              <?php endif; ?>
                           </div>
                        </div>
                     </div>
                     <div class="col-xl-5 col-lg-5 col-md-12">
                        <div class="tp-hero-thumb-wrapper text-center text-lg-end p-relative z-index-1">

                           <div class="tp-hero-thumb-shape">
                            <?php if(!empty($tp_hero_shape_image_1)): ?>
                              <img class="tp-hero-thumb-shape-1" data-speed="1.4" src="<?php echo esc_url($tp_hero_shape_image_1);?>" alt="<?php echo esc_attr($tp_hero_shape_image_1_alt); ?>">
                            <?php endif; ?>

                            <?php if(!empty($tp_hero_shape_image_2)): ?>
                              <img class="tp-hero-thumb-shape-2 d-none d-xl-block" data-speed="1.2" src="<?php echo esc_url($tp_hero_shape_image_2);?>" alt="<?php echo esc_attr($tp_hero_shape_image_2_alt); ?>">
                              <?php endif; ?>
                              <span class="tp-hero-thumb-shape-3"></span>
                           </div>

                           <div class="tp-hero-thumb">
                              <img src="<?php echo esc_url($tp_image);?>" alt="<?php echo esc_attr($tp_image_alt); ?>">
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </section>
            <!-- hero area end -->

        <?php endif; ?>

        <?php 
		
	}

}

$widgets_manager->register( new TP_Hero_Banner() );