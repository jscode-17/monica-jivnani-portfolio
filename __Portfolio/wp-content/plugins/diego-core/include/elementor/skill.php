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
class TP_Skill extends Widget_Base {

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
		return 'skill-bar';
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
		return __( 'Skill', 'tpcore' );
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
            'label'       => esc_html__( 'Title', 'tpcore' ),
            'type'        => \Elementor\Controls_Manager::TEXTAREA,
            'default'     => esc_html__( 'Skills', 'tpcore' ),
            'placeholder' => esc_html__( 'Your Text', 'tpcore' ),
            'label_block' => true,
            'condition' => [
                'tp_design_style' => 'layout-2'
            ]
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
                'label_block' => true,
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
                'placeholder' => esc_html__( 'Your Unit', 'tpcore' ),
                'condition' => [
                    'repeater_condition' => ['style_1'],
                ]
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
        $this->tp_section_style_controls('skill_section', 'Section - Style', '.tp-el-section');
        $this->tp_basic_style_controls('skill_section_title', 'Section - Title', '.tp-el-section-title');
        
        
        $this->tp_section_style_controls('services_section_box', 'Box - Style', '.tp-el-box');
        $this->tp_section_style_controls('about_secti', 'Thumb Box - Style', '.tp-el-thumb-box');
        $this->tp_icon_style('section_icon', 'Box - Icon', '.tp-el-box-icon span');
        $this->tp_basic_style_controls('services_box_title', 'Box - Title', '.tp-el-box-title');
        $this->tp_link_controls_style('services_box_description', 'Box - Number', '.tp-el-box-number');
        $this->tp_section_style_controls('services_section_bar', 'Bar - Style', '.tp-el-box-bar');
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

            <div class="ab-personal-info__skill mb-85 wow tpfadeRight tp-el-section" data-wow-duration=".9s" data-wow-delay=".3s">

                <?php if(!empty($settings['tp_skill_title'])) : ?>
                <h4 class="ab-personal-info__right-title tp-el-section-title"><?php echo tp_kses($settings['tp_skill_title']); ?></h4>
                <?php endif; ?>

                <div class="p-progress-bar-wrap">
                <?php foreach ( $settings['tp_skill_list'] as $index => $item ) : ?>
                    <div class="tp-progress-bar-item tp-el-box">

                        <?php if(!empty($item['tp_skill_box_title'])): ?>
                        <label class="tp-el-box-title"><?php echo tp_kses($item['tp_skill_box_title']); ?></label>
                        <?php endif; ?>

                        <div class="tp-progress-bar">
                            <div class="progress">
                                <div class="progress-bar wow slideInLeft tp-el-box-bar" data-wow-delay=".1s" data-wow-duration="2s"  role="progressbar" data-width="<?php echo esc_attr($item['tp_skill_num']); ?>%" aria-valuenow="<?php echo esc_attr($item['tp_skill_num']); ?>"  aria-valuemin="0">
                                    <span class="tp-el-box-number"><?php echo esc_attr($item['tp_skill_num']).esc_html__('%', 'tpcore') ; ?></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>


		 <?php else:
				 $this->add_render_attribute('title_args', 'class', 'section__title mb-20 tp-el-title');
			 ?>

                <div class="tp-skill-tab-content tp-skill-radius tp-el-section">
                    <div class="row">
                        <?php foreach ( $settings['tp_skill_list'] as $index => $item ) : ?>
                        <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                            <div class="tp-skill-item text-center d-flex justify-content-center flex-column align-items-center tp-el-box">
                                <div class="tp-skill-thumb d-flex align-items-center justify-content-center flex-column tp-el-thumb-box">
                                    <div class="tp-skill-icon tp-el-box-icon">
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
                                    <h3 class="tp-skill-count tp-el-box-number"><span data-purecounter-duration="1" data-purecounter-end="<?php echo esc_attr($item['tp_skill_num']); ?>"  class="purecounter">0</span><?php echo esc_attr($item['tp_skill_unit']); ?></h3>
                                </div>

                                <?php if(!empty($item['tp_skill_box_title'])): ?>
                                <div class="tp-skill-content">
                                    <h3 class="tp-skill-title tp-el-box-title"><?php echo tp_kses($item['tp_skill_box_title']); ?></h3>
                                </div>
                                <?php endif; ?>

                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            

		 <?php endif; ?>
		<?php
	}

}

$widgets_manager->register( new TP_Skill() );