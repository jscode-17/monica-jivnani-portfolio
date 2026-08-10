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

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

/**
 * Tp Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class TP_Portfolio_Slider extends Widget_Base
{

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
    public function get_name()
    {
        return 'tp-portfolio-slider';
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
    public function get_title()
    {
        return __('Portfolio Slider', 'tpcore');
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
    public function get_icon()
    {
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
    public function get_categories()
    {
        return ['tpcore'];
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
    public function get_script_depends()
    {
        return ['tpcore'];
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

    protected function register_controls()
    {
        $this->register_controls_section();
        $this->style_tab_content();
    }

    protected function register_controls_section()
    {

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



        // Button 
        $this->tp_button_render_controls('tpbtn', 'Button', ['layout-1']);

        // Portfolio group
        $this->start_controls_section(
            'tp_portfolio',
            [
                'label' => esc_html__('Portfolio List', 'tpcore'),
                'description' => esc_html__('Control all the style settings from Style tab', 'tpcore'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'tp_portfolio_switch',
            [
                'label' => esc_html__('Enable Shape ?', 'tpcore'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'tpcore'),
                'label_off' => esc_html__('Hide', 'tpcore'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'repeater_condition',
            [
                'label' => __('Field condition', 'tpcore'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'style_1' => __('Style 1', 'tpcore'),
                    'style_6' => __('Style 2', 'tpcore'),
                ],
                'default' => 'style_1',
                'frontend_available' => true,
                'style_transfer' => true,
            ]
        );


        $repeater->add_control(
            'tp_portfolio_image',
            [
                'label' => esc_html__('Upload Image', 'tpcore'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ]
            ]
        );
        $repeater->add_control(
            'tp_portfolio_cat',
            [
                'label' => esc_html__('Category', 'tpcore'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Category', 'tpcore'),
                'placeholder' => esc_html__('Your Category', 'tpcore'),
                'label_block' => true,
            ]
        );
        $repeater->add_control(
            'tp_portfolio_date',
            [
                'label' => esc_html__('Date', 'tpcore'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('2023', 'tpcore'),
                'placeholder' => esc_html__('Your Date', 'tpcore'),
                'label_block' => true,
            ]
        );
        $repeater->add_control(
            'tp_portfolio_title',
            [
                'label' => esc_html__('Title', 'tpcore'),
                'description' => tp_get_allowed_html_desc('basic'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Portfolio Title', 'tpcore'),
                'label_block' => true,
            ]
        );
        $repeater->add_control(
            'portfolio_link_text',
            [
                'label' => esc_html__('Link Text', 'tpcore'),
                'description' => tp_get_allowed_html_desc('basic'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('View Project', 'tpcore'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'tp_portfolio_link_switcher',
            [
                'label' => esc_html__('Add Portfolio link', 'tpcore'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'tpcore'),
                'label_off' => esc_html__('No', 'tpcore'),
                'return_value' => 'yes',
                'default' => 'yes',
                'separator' => 'before',
            ]
        );
        $repeater->add_control(
            'tp_portfolio_link_type',
            [
                'label' => esc_html__('Portfolio Link Type', 'tpcore'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    '1' => 'Custom Link',
                    '2' => 'Internal Page',
                ],
                'default' => '1',
                'condition' => [
                    'tp_portfolio_link_switcher' => 'yes'
                ]
            ]
        );
        $repeater->add_control(
            'tp_portfolio_link',
            [
                'label' => esc_html__('Portfolio Link', 'tpcore'),
                'type' => \Elementor\Controls_Manager::URL,
                'dynamic' => [
                    'active' => true,
                ],
                'placeholder' => esc_html__('https://your-link.com', 'tpcore'),
                'show_external' => true,
                'default' => [
                    'url' => '#',
                    'is_external' => false,
                    'nofollow' => false,
                ],
                'condition' => [
                    'tp_portfolio_link_type' => '1',
                    'tp_portfolio_link_switcher' => 'yes',
                ]
            ]
        );
        $repeater->add_control(
            'tp_portfolio_page_link',
            [
                'label' => esc_html__('Select Portfolio Link Page', 'tpcore'),
                'type' => \Elementor\Controls_Manager::SELECT2,
                'label_block' => true,
                'options' => tp_get_all_pages(),
                'condition' => [
                    'tp_portfolio_link_type' => '2',
                    'tp_portfolio_link_switcher' => 'yes',
                ]
            ]
        );


        $this->add_control(
            'tp_portfolio_list',
            [
                'label' => esc_html__('Portfolio - List', 'tpcore'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'description' => 'please add 5 sliders to work properly',
                'default' => [
                    [
                        'tp_portfolio_title' => esc_html__('Business Stratagy', 'tpcore'),
                    ],
                    [
                        'tp_portfolio_title' => esc_html__('Website Development', 'tpcore')
                    ],
                    [
                        'tp_portfolio_title' => esc_html__('Marketing & Reporting', 'tpcore')
                    ],
                    [
                        'tp_portfolio_title' => esc_html__('Marketing & Reporting', 'tpcore')
                    ],
                    [
                        'tp_portfolio_title' => esc_html__('Marketing & Reporting', 'tpcore')
                    ],
                ],
                'title_field' => '{{{ tp_portfolio_title }}}',
            ]
        );


        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'thumbnail', // // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `thumbnail_size` and `thumbnail_custom_dimension`.
                'exclude' => ['custom'],
                // 'default' => 'tp-post-thumb',
            ]
        );
        $this->end_controls_section();


    }

    // style_tab_content
    protected function style_tab_content()
    {


        $this->tp_section_style_controls('section_section', 'Section - Style', '.tp-el-section');


        $this->tp_basic_style_controls('portfolio_box_title', 'Portfolio - Title', '.tp-el-box-title');
        $this->tp_link_controls_style('portfolio_box_tag', 'Portfolio - Tag', '.tp-el-box-cat');
        $this->tp_link_controls_style('portfolio_box_date', 'Portfolio - Date', '.tp-el-box-date');

        $this->tp_link_controls_style('slider_btn', 'Slider - Arrow', '.tp-el-arrow');

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
    protected function render()
    {
        $settings = $this->get_settings_for_display();
        $control_id = 'tpbtn';
        ?>

        <?php if ($settings['tp_design_style'] == 'layout-2'):
            $this->add_render_attribute('title_args', 'class', 'section__title-5 tp-el-title');
            $bloginfo = get_bloginfo('name');

            ?>

        <?php else:
            $bloginfo = get_bloginfo('name');
            $this->add_render_attribute('title_args', 'class', 'tp-section-title tp_title_anim tp-el-title');

            $this->tp_link_controls_render('tpbtn', 'tp-hover-btn tp-hover-btn-item tp-btn-circle-2 d-flex align-items-center justify-content-center flex-column', $this->get_settings());
            ?>


            <div
                class="tp-hero-2__bg black-bg-3 tp-hero-2__space-4 d-flex align-items-center justify-content-start p-relative z-index-1 fix tp-el-section">

                <?php if ($settings['tp_portfolio_switch'] == 'yes'): ?>
                    <div class="tp-hero-2__boder-circle">
                        <span></span>
                    </div>
                    <div class="tp-portfolio-shape">
                        <img class="tp-portfolio-shape-2-1 tp-zoom-in-out"
                            src="<?php echo get_template_directory_uri(); ?>/assets/img/portfolio/shape-3.png"
                            alt="<?php echo esc_attr($bloginfo); ?>">
                    </div>
                <?php endif; ?>
                <div class="container">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="tp-3d-slide-container">

                                <span class="tp-3d-slide-arrow tp-3d-slide-arrow-left z-index-9 tp-el-arrow">
                                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M15 8H1" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                        <path d="M8 1L1 8L8 15" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                    </svg>
                                </span>

                                <span class="tp-3d-slide-arrow tp-3d-slide-arrow-right z-index-9 tp-el-arrow">
                                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M1 8H15" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                        <path d="M8 1L15 8L8 15" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                    </svg>
                                </span>

                                <div class="tp-3d-slide-wrapper" id="tp-3d-slide-wrapper">
                                    <?php foreach ($settings['tp_portfolio_list'] as $key => $item):
                                        if (!empty($item['tp_portfolio_image']['url'])) {
                                            $tp_portfolio_image_url = !empty($item['tp_portfolio_image']['id']) ? wp_get_attachment_image_url($item['tp_portfolio_image']['id'], $settings['thumbnail_size']) : $item['tp_portfolio_image']['url'];
                                            $tp_portfolio_image_alt = get_post_meta($item["tp_portfolio_image"]["id"], "_wp_attachment_image_alt", true);
                                        }

                                        // Link
                                        if ('2' == $item['tp_portfolio_link_type']) {
                                            $link = get_permalink($item['tp_portfolio_page_link']);
                                            $target = '_self';
                                            $rel = 'nofollow';
                                        } else {
                                            $link = !empty($item['tp_portfolio_link']['url']) ? $item['tp_portfolio_link']['url'] : '';
                                            $target = !empty($item['tp_portfolio_link']['is_external']) ? '_blank' : '';
                                            $rel = !empty($item['tp_portfolio_link']['nofollow']) ? 'nofollow' : '';
                                        }

                                        $attrs = array(
                                            'href' => $link,
                                            'target' => $target,
                                            'rel' => $rel,
                                        );

                                        $prev2 = $key == 0 ? 'prev-2' : '';
                                        $prev1 = $key == 1 ? 'prev-1' : '';
                                        $active = $key == 2 ? 'active' : '';
                                        $next1 = $key == 3 ? 'next-1' : '';
                                        $next2 = $key == 4 ? 'next-2' : '';

                                        $class = $prev1 . $prev2 . $active . $next1 . $next2;
                                        ?>
                                        <div class="tp-3d-slide tp-hover-reveal-text <?php echo esc_attr($class); ?>">

                                            <a <?php echo tp_implode_html_attributes($attrs); ?> class="tp-portfolio-item-2 include-bg"
                                                data-background="<?php echo esc_url($tp_portfolio_image_url); ?>">

                                                <div class="tp-portfolio-meta-2">
                                                    <?php if (!empty($item['tp_portfolio_cat'])): ?>
                                                        <span class="tp-el-box-cat"><?php echo tp_kses($item['tp_portfolio_cat']); ?></span>
                                                    <?php endif; ?>

                                                    <?php if (!empty($item['tp_portfolio_date'])): ?>
                                                        <span
                                                            class="tp-el-box-date"><?php echo tp_kses($item['tp_portfolio_date']); ?></span>
                                                    <?php endif; ?>
                                                </div>

                                                <h3 class="tp-portfolio-title-2 tp-el-box-title">
                                                    <?php echo tp_kses($item['tp_portfolio_title']); ?>
                                                </h3>

                                                <div class="tp-portfolio-view tp-portfolio-view-btn">
                                                    <span
                                                        class="tp-el-box-link-text"><?php echo tp_kses($item['portfolio_link_text']); ?></span>
                                                </div>
                                            </a>
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

$widgets_manager->register(new TP_Portfolio_Slider());
