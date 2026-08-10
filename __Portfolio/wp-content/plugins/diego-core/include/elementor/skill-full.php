<?php
namespace TPCore\Widgets;

use Elementor\Widget_Base;
use \Elementor\Control_Media;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Css_Filter;
use \Elementor\Repeater;
use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Group_Control_Typography;
Use \Elementor\Core\Schemes\Typography;
use \Elementor\Utils;
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
class TP_Skill_Full extends Widget_Base {

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
		return 'skill-full';
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
		return __( 'Skill Full', 'tpcore' );
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
                ],
                'default' => 'layout-1',
            ]
		);

		$this->end_controls_section();

        $this->start_controls_section(
         'tp_exp_sec',
             [
               'label' => esc_html__( 'Experience Controls', 'tpcore' ),
               'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
             ]
        );
        
        $this->add_control(
        'tp_exp_title',
         [
            'label'       => esc_html__( 'Title', 'tpcore' ),
            'type'        => \Elementor\Controls_Manager::TEXT,
            'default'     => esc_html__( 'Experiences', 'tpcore' ),
            'placeholder' => esc_html__( 'Your Text', 'tpcore' ),
            'label_block' => true,
         ]
        );
        
        $this->add_control(
         'tp_exp_switch',
         [
           'label'        => esc_html__( 'Enable Shape?', 'textdomain' ),
           'type'         => \Elementor\Controls_Manager::SWITCHER,
           'label_on'     => esc_html__( 'Show', 'textdomain' ),
           'label_off'    => esc_html__( 'Hide', 'textdomain' ),
           'return_value' => 'yes',
           'default'      => 'yes',
         ]
        );

        $this->add_control(
            'tp_image',
            [
                'label' => esc_html__('Upload BG Image', 'tpcore'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ]
            ]
        );
        
        $repeater = new \Elementor\Repeater();
        
         $repeater->add_control(
         'tp_exp_item_title',
           [
             'label'   => esc_html__( 'Experience Title', 'tpcore' ),
             'type'        => \Elementor\Controls_Manager::TEXT,
             'default'     => esc_html__( 'Web Developer', 'tpcore' ),
             'label_block' => true,
           ]
         );
        
         $repeater->add_control(
         'tp_exp_item_year',
           [
             'label'   => esc_html__( 'Experience Year', 'tpcore' ),
             'type'        => \Elementor\Controls_Manager::TEXT,
             'default'     => esc_html__( '2012 - 2020', 'tpcore' ),
             'label_block' => true,
           ]
         );
        
         $repeater->add_control(
         'tp_exp_item_company',
           [
             'label'   => esc_html__( 'Company Title', 'tpcore' ),
             'type'        => \Elementor\Controls_Manager::TEXT,
             'default'     => esc_html__( 'Amazon Inc.', 'tpcore' ),
             'label_block' => true,
           ]
         );
         
         
         $this->add_control(
           'tp_exp_list',
           [
             'label'       => esc_html__( 'Experience List', 'tpcore' ),
             'type'        => \Elementor\Controls_Manager::REPEATER,
             'fields'      => $repeater->get_controls(),
             'default'     => [
               [
                 'tp_exp_item_title'   => esc_html__( 'Web Developer', 'tpcore' ),
               ],
               [
                 'tp_exp_item_title'   => esc_html__( 'Marketing Expart', 'tpcore' ),
               ],
               [
                 'tp_exp_item_title'   => esc_html__( 'SQA Engineer', 'tpcore' ),
               ],
             ],
             'title_field' => '{{{ tp_exp_item_title }}}',
           ]
         );
        
         $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'thumbnail_size', // // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `thumbnail_size` and `thumbnail_custom_dimension`.
                'exclude' => ['custom'],
                // 'default' => 'tp-post-thumb',
            ]
        );
        $this->end_controls_section();

        // Skill
        $this->start_controls_section(
            'tp_progress_bar',
            [
                'label' => esc_html__('Skill Items', 'tpcore'),
            ]
        );

        $this->add_control(
        'tp_skill_title',
         [
            'label'       => esc_html__( 'Skill Title', 'tpcore' ),
            'type'        => \Elementor\Controls_Manager::TEXT,
            'default'     => esc_html__( 'My Skills', 'tpcore' ),
            'placeholder' => esc_html__( 'Your Text', 'tpcore' ),
         ]
        );
        
        $repeater = new Repeater();

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
                'default' => 'image',
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
            'tp_skill_box_title',
            [
                'type' => Controls_Manager::TEXT,
                'label' => esc_html__( 'Skill Title', 'tpcore' ),
                'default' => esc_html__( 'Design', 'tpcore' ),
                'placeholder' => esc_html__( 'Type a skill name', 'tpcore' ),
            ]
        );

        $repeater->add_control(
            'tp_skill_num',
            [
                'label'       => esc_html__( 'Skill Number', 'tpcore' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => esc_html__( '85', 'tpcore' ),
                'placeholder' => esc_html__( 'Your Number', 'tpcore' ),
            ]
        );

        $repeater->add_control(
            'tp_skill_unit',
            [
                'label'       => esc_html__( 'Skill Unit', 'tpcore' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => esc_html__( '%', 'tpcore' ),
                'placeholder' => esc_html__( 'Your Number', 'tpcore' ),
            ]
        );

        $repeater->add_control(
            'want_customize',
            [
                'label' => esc_html__( 'Want To Customize?', 'tpcore' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Yes', 'tpcore' ),
                'label_off' => esc_html__( 'No', 'tpcore' ),
                'return_value' => 'yes',
                'description' => esc_html__( 'You can customize this item from here or customize from Style tab', 'tpcore' ),
                'style_transfer' => true,
            ]
        );
        
        
        $repeater->add_control(
            'services_background_color',
            [
                'label'       => esc_html__( 'Background Color', 'tpcore' ),
                'type'     => \Elementor\Controls_Manager::COLOR,
                'selectors' => ['{{WRAPPER}} {{CURRENT_ITEM}}' => 'background-color: {{VALUE}}'],
                'default' => '#fff',
                'condition' => ['want_customize' => 'yes'],
            ]
        );
        
        $repeater->add_control(
            'services_border_color',
            [
                'label'       => esc_html__( 'Border Color', 'tpcore' ),
                'type'     => \Elementor\Controls_Manager::COLOR,
                'selectors' => ['{{WRAPPER}} {{CURRENT_ITEM}}' => 'border-color: {{VALUE}}'],
                'default' => '#fff',
                'condition' => ['want_customize' => 'yes'],
            ]
        );
        $repeater->add_control(
            'services_color',
            [
                'label'       => esc_html__( 'Border Color', 'tpcore' ),
                'type'     => \Elementor\Controls_Manager::COLOR,
                'selectors' => ['{{WRAPPER}} {{CURRENT_ITEM}} i' => 'color: {{VALUE}}'],
                'default' => '#FF3366',
                'condition' => ['want_customize' => 'yes'],
            ]
        );

        $this->add_control(
            'tp_skill_list',
            [
                'label' => esc_html__('Skill - List', 'tpcore'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'tp_skill_box_title' => esc_html__('Business Stratagy', 'tpcore'),
                        'tp_skill_num' => '95',
                        'tp_skill_icon' => [
                            'url' => Utils::get_placeholder_image_src(),
                        ],
                    ],
                    [
                        'tp_skill_box_title' => esc_html__('Business Stratagy', 'tpcore'),
                        'tp_skill_num' => '95',
                        'tp_skill_icon' => [
                            'url' => Utils::get_placeholder_image_src(),
                        ],
                    ],
                    [
                        'tp_skill_box_title' => esc_html__('Business Stratagy', 'tpcore'),
                        'tp_skill_num' => '95',
                        'tp_skill_icon' => [
                            'url' => Utils::get_placeholder_image_src(),
                        ],
                    ],
                ],
                'title_field' => '{{{ tp_skill_box_title }}}',
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'thumbnail',
                'default' => 'thumbnail',
                'separator' => 'before',
                'exclude' => [
                    'custom'
                ]
            ]
        );

        $this->end_controls_section();
	}


    protected function style_tab_content(){
        $this->tp_section_style_controls('about_section', 'Section - Style', '.tp-el-section');
        $this->tp_basic_style_controls('about_title', 'Experience Section - Title', '.tp-el-title');
        
   
        $this->tp_section_style_controls('exp_section_box', 'Experience - Style', '.tp-el-box');
        $this->start_controls_section(
            'tp_about_subtitle_styling',
            [
                'label' => esc_html__('Experience Border - Color', 'tp-core'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );


        $this->add_control(
            'tp_exp_border_color',
            [
                'label' => esc_html__('Border Color', 'tp-core'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tp-el-box::after' => 'background: {{VALUE}} !important;',
                ],
            ]
        );

        $this->end_controls_section();

        $this->tp_basic_style_controls('exp_box_title', 'Experience - Title', '.tp-el-box-title');
        $this->tp_link_controls_style('exp_box_description', 'Experience - Year', '.tp-el-box-year');
        $this->tp_link_controls_style('exp_box_company', 'Experience - Company', '.tp-el-box-company');
   
        $this->tp_basic_style_controls('skill_title', 'Skill - Title', '.tp-el-skill-title');



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
                 

           
        ?>


		 <?php else:
				 $this->add_render_attribute('title_args', 'class', 'section__title mb-20 tp-el-title');

                 if ( !empty($settings['tp_image']['url']) ) {
                    $tp_image_url = !empty($settings['tp_image']['id']) ? wp_get_attachment_image_url( $settings['tp_image']['id'], $settings['thumbnail_size_size']) : $settings['tp_image']['url'];
                    $tp_image_alt = get_post_meta($settings["tp_image"]["id"], "_wp_attachment_image_alt", true);
                }
			 ?>

            <div class="tp-hero-2__bg black-bg-3 tp-hero-2__space-5 d-flex align-items-start justify-content-center z-index-1 p-relative fix tp-el-section">
              
                <div class="tp-hero-distort-2" data-background="<?php echo esc_url($tp_image_url); ?>"></div>
               
                <?php if($settings['tp_exp_switch'] == 'yes') : ?>
                <div class="tp-hero-2__boder-circle tp-hero-2__boder-circle-tr">
                  <span></span>
               </div>

               <div class="tp-hero-2__circle-wrapper tp-hero-2__circle-pos">
                  <span class="tp-hero-2__circle-1"></span>
                  <span class="tp-hero-2__circle-2"></span>
                  <span class="tp-hero-2__circle-3"></span>
               </div>
               <?php endif; ?>

               <div class="container">
                  <div class="row">
                     <div class="col-xl-12">
                        <div class="tp-hero-2__design-exp-wrap">

                        <?php if(!empty($settings['tp_exp_title'])) : ?>
                           <div class="tp-hero-2__design-exp-top-title">
                              <span class="tp-el-title"><?php echo tp_kses($settings['tp_exp_title']); ?></span>
                           </div>
                        
                           <?php endif; ?>
                           <ul>
                            <?php foreach ($settings['tp_exp_list'] as $key => $item): ?>
                              <li class="tp-el-box">
                                 <div class=" tp-hero-2__design-exp-item d-flex align-items-center justify-content-between">
                                    <div class="tp-hero-2__design-exp-meta d-md-flex align-items-center flex-wrap">
                                       <span class="tp-el-box-year"><?php echo tp_kses($item['tp_exp_item_year']) ?></span>
                                       <h4 class="tp-hero-2__design-exp-title tp-el-box-title"><?php echo tp_kses($item['tp_exp_item_title']) ?></h4>
                                    </div>
                                    <div class="tp-hero-2__design-exp-company">
                                       <span class="tp-el-box-company"><?php echo tp_kses($item['tp_exp_item_company']) ?></span>
                                    </div>
                                 </div>
                              </li>
                              <?php endforeach; ?>
                           </ul>
                        </div>

                        <div class="tp-hero-2__design-exp-skill-wrap">

                            <?php if(!empty($settings['tp_skill_title'])) : ?>
                           <div class="tp-hero-2__design-exp-top-title mb-30">
                              <span class="tp-el-skill-title">
                                <?php echo tp_kses($settings['tp_skill_title']); ?>
                              </span>
                           </div>
                           <?php endif; ?>

                           <div class="row row-cols-xl-5 row-cols-md-3">
                           <?php foreach ( $settings['tp_skill_list'] as $index => $item ) : ?>
                              <div class="col-xl">
                                 <div class=" tp-el-skill-box mb-20 tp-hero-2__design-exp-skill-item justify-content-center d-flex align-items-center elementor-repeater-item-<?php echo esc_attr($item['_id']); ?>">
                                    <div class="tp-hero-2__design-exp-skill-icon">
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
                                    </div>

                                    <div class="tp-hero-2__design-exp-skill-info">
                                       <span><span data-purecounter-duration="1" data-purecounter-end="<?php echo esc_attr($item['tp_skill_num']); ?>"  class="purecounter">0</span><?php echo esc_attr($item['tp_skill_unit']); ?></span>
                                       
                                       <?php if(!empty($item['tp_skill_box_title'])): ?>
                                       <i><?php echo tp_kses($item['tp_skill_box_title']); ?></i>
                                       <?php endif; ?>
                                
                                    </div>
                                 </div>
                              </div>
                              <?php endforeach; ?>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>

            </div>

		 <?php endif; ?>
		<?php
	}

}

$widgets_manager->register( new TP_Skill_Full() );