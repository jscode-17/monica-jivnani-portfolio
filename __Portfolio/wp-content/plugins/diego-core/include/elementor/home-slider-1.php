<?php
namespace TPCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Repeater;
use \Elementor\Utils;
use \Elementor\Control_Media;
if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

/**
 * Tp Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class TP_Home_Slider_1 extends Widget_Base
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
        return 'tp-home-slider-1';
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
        return __('Home Slider', 'tpcore');
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
                    'layout-2' => esc_html__('Layout 2', 'tpcore'),
                    'layout-3' => esc_html__('Layout 3', 'tpcore'),
                ],
                'default' => 'layout-1',
            ]
        );
        $this->end_controls_section();


        $this->start_controls_section(
            'tp_main_slider',
            [
                'label' => esc_html__('Main Slider', 'tpcore'),
                'description' => esc_html__('Control all the style settings from Style tab', 'tpcore'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
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
                    'style_2' => __('Style 2', 'tpcore'),
                ],
                'default' => 'style_1',
                'frontend_available' => true,
                'style_transfer' => true,
            ]
        );


        $repeater->add_control(
            'tp_slider_image',
            [
                'label' => esc_html__('Upload Image', 'tpcore'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ]
            ]
        );

        $repeater->add_control(
            'tp_slider_sub_title',
            [
                'label' => esc_html__('Sub Title', 'tpcore'),
                'description' => tp_get_allowed_html_desc('basic'),
                'type' => Controls_Manager::TEXT,
                'default' => 'Starting at 247',
                'placeholder' => esc_html__('Type Before Heading Text', 'tpcore'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'tp_slider_title',
            [
                'label' => esc_html__('Title', 'tpcore'),
                'description' => tp_get_allowed_html_desc('intermediate'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Grow business.', 'tpcore'),
                'placeholder' => esc_html__('Type Heading Text', 'tpcore'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'tp_slider_title_url',
            [
                'label' => esc_html__('URL', 'tpcore'),
                'type' => \Elementor\Controls_Manager::URL,
                'default' => [
                    'url' => '#',
                    'is_external' => true,
                    'nofollow' => true,
                    'custom_attributes' => '',
                ],
                'placeholder' => esc_html__('Your URL', 'tpcore'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'tp_slider_view_more_text',
            [
                'label' => esc_html__('View Demo Text', 'tpcore'),
                'description' => tp_get_allowed_html_desc('intermediate'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('View Demo', 'tpcore'),
                'placeholder' => esc_html__('Your Text', 'tpcore'),
                'label_block' => true,
                'condition' => [
                    'repeater_condition' => ['style_2']
                ]
            ]
        );


        $this->add_control(
            'slider_list',
            [
                'label' => esc_html__('Slider List', 'tpcore'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'tp_slider_title' => esc_html__('Grow business.', 'tpcore')
                    ],
                    [
                        'tp_slider_title' => esc_html__('Development.', 'tpcore')
                    ],
                    [
                        'tp_slider_title' => esc_html__('Marketing.', 'tpcore')
                    ],
                ],
                'title_field' => '{{{ tp_slider_title }}}',
            ]
        );
        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'thumbnail', // // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `thumbnail_size` and `thumbnail_custom_dimension`.
                'exclude' => ['custom'],
                // 'default' => 'tp-portfolio-thumb',
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section(
            'tp_slider_social_sec',
            [
                'label' => esc_html__('Social Content', 'tpcore'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'social_text',
            [
                'label' => esc_html__('Social Title', 'textdomain'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('FB', 'textdomain'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'social_url',
            [
                'label' => esc_html__('Social URL', 'tpcore'),
                'type' => \Elementor\Controls_Manager::URL,
                'default' => [
                    'url' => '#',
                    'is_external' => true,
                    'nofollow' => true,
                    'custom_attributes' => '',
                ],
                'placeholder' => esc_html__('Your URL', 'tpcore'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'social_list',
            [
                'label' => esc_html__('Social List', 'textdomain'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'social_text' => esc_html__('FB', 'textdomain'),
                    ],
                ],
                'title_field' => '{{{ social_text }}}',
            ]
        );

        $this->end_controls_section();

        $this->tp_button_render_controls('tpbtn', 'Button', ['layout-1', 'layout-2', 'layout-3']);
    }


    protected function style_tab_content()
    {
        $this->tp_section_style_controls('home_slider_section', 'Section - Style', '.tp-el-section');
        $this->tp_basic_style_controls('home_slider_subtitle', 'Slider - Subtitle', '.tp-el-subtitle');
        $this->tp_basic_style_controls('home_slider_title', 'Slider - Title', '.tp-el-title');
        $this->tp_link_controls_style('home_slider_portfolio_btn', 'Portfolio - Button', '.tp-el-port-btn');

        $this->tp_link_controls_style('footer_social_links', 'Social - Links', '.tp-el-home-social-btn');

        $this->start_controls_section(
            'tp_about_subtitle_styling',
            [
                'label' => esc_html__('Section - Subtitle', 'tp-core'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'tp_slider_dot_bg_color',
            [
                'label' => esc_html__('Navigation Background Color', 'tp-core'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tp-el-slider-dot .swiper-pagination-bullet, .tp-el-scrollbar .swiper-scrollbar-drag' => 'background: {{VALUE}} !important;',
                ],
            ]
        );

        $this->add_control(
            'tp_slider_dot_line_bg_color',
            [
                'label' => esc_html__('Navigation Line Background Color', 'tp-core'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tp-el-slider-dot .swiper-pagination-bullet::after, .tp-el-scrollbar ' => 'background: {{VALUE}} !important;',
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
    protected function render()
    {
        $settings = $this->get_settings_for_display();
        $control_id = 'tpbtn';
        ?>

        <?php if ($settings['tp_design_style'] == 'layout-2'):
            $bloginfo = get_bloginfo('name');

            $this->tp_link_controls_render('tpbtn', 'all-projects-btn tp-el-port-btn', $this->get_settings());
            ?>


            <!-- portfolio-showcase-area start -->
            <div class="portfolio-slider-2-area black-bg-5 fix tp-el-section">
                <div class="portfolio-slider-2-wrap p-relative">
                    <div class="portfolio-slider-2-wrap-box">
                        <div class="swiper-container portfolio-slider-2-active">
                            <div class="swiper-wrapper">
                                <?php foreach ($settings['slider_list'] as $key => $item):
                                    $this->add_render_attribute('title_args', 'class', 'tp-slider-title tp-el-title');

                                    if (!empty($item['tp_slider_image']['url'])) {
                                        $tp_slider_image_url = !empty($item['tp_slider_image']['id']) ? wp_get_attachment_image_url($item['tp_slider_image']['id'], $settings['thumbnail_size']) : $item['tp_slider_image']['url'];
                                        $tp_slider_image_alt = get_post_meta($item["tp_slider_image"]["id"], "_wp_attachment_image_alt", true);
                                    }

                                    // Link
                                    if ('2' == $item['tp_slider_title_url']) {
                                        $link = get_permalink($item['tp_slider_title_url']);
                                        $target = '_self';
                                        $rel = 'nofollow';
                                    } else {
                                        $link = !empty($item['tp_slider_title_url']['url']) ? $item['tp_slider_title_url']['url'] : '';
                                        $target = !empty($item['tp_slider_title_url']['is_external']) ? '_blank' : '';
                                        $rel = !empty($item['tp_slider_title_url']['nofollow']) ? 'nofollow' : '';
                                    }
                                    $attrs = array(
                                        'href' => $link,
                                        'target' => $target,
                                        'rel' => $rel,
                                    );
                                    ?>
                                    <div class="swiper-slide">
                                        <div class="portfolio-slider-2-item p-relative not-hide-cursor"
                                            data-cursor="<?php echo esc_attr($item['tp_slider_view_more_text']); ?>">

                                            <a class="cursor-hide" <?php echo tp_implode_html_attributes($attrs); ?>>
                                                <div class="portfolio-slider-2-thumb">
                                                    <img src="<?php echo esc_url($tp_slider_image_url); ?>" alt="<?php echo esc_attr($tp_slider_image_alt); ?>">
                                                </div>
                                                <div class="portfolio-slider-2-content text-center">
                                            
                                                    <?php if (!empty($item['tp_slider_title'])): ?>
                                                        <div class="portfolio-slider-2-title">
                                                            <div>
                                                                <span class="tp-el-title"><?php echo tp_kses($item['tp_slider_title']); ?></span>
                                                            </div>
                                                        </div>
                                                    <?php endif; ?>
                                            
                                                    <?php if (!empty($item['tp_slider_sub_title'])): ?>
                                                        <div class="portfolio-slider-2-subtitle">
                                                            <div>
                                                                <span class="tp-el-subtitle"><?php echo tp_kses($item['tp_slider_sub_title']); ?></span>
                                                            </div>
                                                        </div>
                                                    <?php endif; ?>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>

                    <div class="tp-scrollbar tp-el-scrollbar"></div>

                    <?php if (!empty($settings['tp_' . $control_id . '_text']) && $settings['tp_' . $control_id . '_button_show'] == 'yes'): ?>
                        <div class="port-showcase-slider-link d-none d-sm-block">
                            <a <?php echo $this->get_render_attribute_string('tp-button-arg' . $control_id . ''); ?>>
                                <span>
                                    <svg width="10" height="12" viewBox="0 0 10 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M10 5L5 0L0 5" fill="currentColor" />
                                        <path d="M10 7L5 12L0 7" fill="currentColor" />
                                    </svg>
                                </span>
                                <span><?php echo $settings['tp_' . $control_id . '_text']; ?></span>
                            </a>
                        </div>
                    <?php endif; ?>


                    <div class="port-showcase-slider-social d-flex align-items-center d-none d-sm-flex">
                        <?php foreach ($settings['social_list'] as $item):
                            // Link
                            if ('2' == $item['social_url']) {
                                $link = get_permalink($item['social_url']);
                                $target = '_self';
                                $rel = 'nofollow';
                            } else {
                                $link = !empty($item['social_url']['url']) ? $item['social_url']['url'] : '';
                                $target = !empty($item['social_url']['is_external']) ? '_blank' : '';
                                $rel = !empty($item['social_url']['nofollow']) ? 'nofollow' : '';
                            }
                            $attrs = array(
                                'href' => $link,
                                'target' => $target,
                                'rel' => $rel,
                            );
                            ?>
                            <a class="tp-hover-btn-item tp-hover-btn tp-magnetic-item not-hide-cursor tp-el-home-social-btn"
                                <?php echo tp_implode_html_attributes($attrs); ?>>
                                <?php echo tp_kses($item['social_text']) ?>
                            </a>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
            <!-- portfolio-showcase-area start -->


        <?php elseif ($settings['tp_design_style'] == 'layout-3'):

            $this->tp_link_controls_render('tpbtn', 'all-projects-btn tp-el-port-btn', $this->get_settings());
            ?>

            <!-- portfolio-showcase-area start -->
            <div class="portfolio-slider-2-area black-bg-5 portfolio-slider-3-style fix tp-el-section">
                <div class="portfolio-slider-2-wrap p-relative">
                    <div class="portfolio-slider-2-wrap-box pt-10">
                        <div class="swiper-container portfolio-slider-3-active">
                            <div class="swiper-wrapper">
                                <?php foreach ($settings['slider_list'] as $key => $item):
                                    $this->add_render_attribute('title_args', 'class', 'tp-slider-title tp-el-title');

                                    if (!empty($item['tp_slider_image']['url'])) {
                                        $tp_slider_image_url = !empty($item['tp_slider_image']['id']) ? wp_get_attachment_image_url($item['tp_slider_image']['id'], $settings['thumbnail_size']) : $item['tp_slider_image']['url'];
                                        $tp_slider_image_alt = get_post_meta($item["tp_slider_image"]["id"], "_wp_attachment_image_alt", true);
                                    }

                                    // Link
                                    if ('2' == $item['tp_slider_title_url']) {
                                        $link = get_permalink($item['tp_slider_title_url']);
                                        $target = '_self';
                                        $rel = 'nofollow';
                                    } else {
                                        $link = !empty($item['tp_slider_title_url']['url']) ? $item['tp_slider_title_url']['url'] : '';
                                        $target = !empty($item['tp_slider_title_url']['is_external']) ? '_blank' : '';
                                        $rel = !empty($item['tp_slider_title_url']['nofollow']) ? 'nofollow' : '';
                                    }
                                    $attrs = array(
                                        'href' => $link,
                                        'target' => $target,
                                        'rel' => $rel,
                                    );
                                    ?>
                                    <div class="swiper-slide">
                                        <a class="cursor-hide" <?php echo tp_implode_html_attributes($attrs); ?>>
                                            <div class="portfolio-slider-2-item p-relative not-hide-cursor"
                                                data-cursor="<?php echo esc_attr($item['tp_slider_view_more_text']); ?>">
                                                <div class="portfolio-slider-2-thumb">
                                                    <img src="<?php echo esc_url($tp_slider_image_url); ?>"
                                                        alt="<?php echo esc_attr($tp_slider_image_alt); ?>">
                                                </div>
                                                <div class="portfolio-slider-3-content">
                                                    <?php if (!empty($item['tp_slider_sub_title'])): ?>
                                                        <span
                                                            class="portfolio-slider-3-meta tp-el-subtitle"><?php echo tp_kses($item['tp_slider_sub_title']); ?></span>
                                                    <?php endif; ?>

                                                    <?php if (!empty($item['tp_slider_title'])): ?>
                                                        <h4 class="portfolio-slider-3-title tp-el-title">
                                                            <?php echo tp_kses($item['tp_slider_title']); ?></h4>
                                                    <?php endif; ?>
                                                </div>

                                            </div>
                                        </a>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                    <div class="tp-scrollbar tp-el-scrollbar"></div>

                    <?php if (!empty($settings['tp_' . $control_id . '_text']) && $settings['tp_' . $control_id . '_button_show'] == 'yes'): ?>
                        <div class="port-showcase-slider-link d-none d-sm-block">
                            <a <?php echo $this->get_render_attribute_string('tp-button-arg' . $control_id . ''); ?>>
                                <span>
                                    <svg width="10" height="12" viewBox="0 0 10 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M10 5L5 0L0 5" fill="currentColor" />
                                        <path d="M10 7L5 12L0 7" fill="currentColor" />
                                    </svg>
                                </span>
                                <span><?php echo $settings['tp_' . $control_id . '_text']; ?></span></span>
                            </a>
                        </div>
                    <?php endif; ?>

                    <div class="port-showcase-slider-social d-flex align-items-center d-none d-sm-flex">

                        <?php foreach ($settings['social_list'] as $item):
                            // Link
                            if ('2' == $item['social_url']) {
                                $link = get_permalink($item['social_url']);
                                $target = '_self';
                                $rel = 'nofollow';
                            } else {
                                $link = !empty($item['social_url']['url']) ? $item['social_url']['url'] : '';
                                $target = !empty($item['social_url']['is_external']) ? '_blank' : '';
                                $rel = !empty($item['social_url']['nofollow']) ? 'nofollow' : '';
                            }
                            $attrs = array(
                                'href' => $link,
                                'target' => $target,
                                'rel' => $rel,
                            );
                            ?>
                            <a 
                                class="tp-hover-btn-item tp-hover-btn tp-magnetic-item not-hide-cursor tp-el-home-social-btn" 
                                <?php echo tp_implode_html_attributes($attrs); ?>>
                                <?php echo tp_kses($item['social_text']) ?>
                            </a>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
            <!-- portfolio-showcase-area start -->
        <?php else:
            $bloginfo = get_bloginfo('name');

            $this->tp_link_controls_render('tpbtn', 'all-projects-btn tp-el-port-btn', $this->get_settings());
            ?>


            <!-- portfolio-showcase-area start -->
            <div id="showcase-slider-main" class="showcase-slider-main">

                <div class="port-showcase-slider-spaces p-relative">
                    <div class="port-showcase-slider-wrap tp-slider-parallax fix " id="showcase-slider-holder"
                        data-pattern-img="<?php echo get_template_directory_uri(); ?>/assets/img/webgl/1.jpg">
                        <div class="swiper-container parallax-slider-active p-relative" id="showcase-slider">
                            <div class="swiper-wrapper" id="trigger-slides">

                                <?php foreach ($settings['slider_list'] as $key => $item):
                                    $this->add_render_attribute('title_args', 'class', 'tp-slider-title tp-el-title');

                                    $class = $key == 0 ? 'active' : '';

                                    // Link
                                    if ('2' == $item['tp_slider_title_url']) {
                                        $link = get_permalink($item['tp_slider_title_url']);
                                        $target = '_self';
                                        $rel = 'nofollow';
                                    } else {
                                        $link = !empty($item['tp_slider_title_url']['url']) ? $item['tp_slider_title_url']['url'] : '';
                                        $target = !empty($item['tp_slider_title_url']['is_external']) ? '_blank' : '';
                                        $rel = !empty($item['tp_slider_title_url']['nofollow']) ? 'nofollow' : '';
                                    }
                                    $attrs = array(
                                        'href' => $link,
                                        'target' => $target,
                                        'rel' => $rel,
                                    );
                                    ?>
                                    <div class="swiper-slide">
                                        <div class="slide-wrap <?php echo esc_attr($class); ?>"
                                            data-slide="<?php echo esc_attr($key); ?>"></div>
                                        <div class="container">
                                            <div class="row">
                                                <div class="col-xl-12">
                                                    <div class="port-showcase-slider-item">
                                                        <div class="port-showcase-slider-content text-center">
                                                            <?php if (!empty($item['tp_slider_title'])): ?>
                                                                <div class="port-showcase-slider-title">
                                                                    <div>
                                                                        <span class="tp-el-title">
                                                                            <?php if (!empty($item['tp_slider_title'])): ?>
                                                                                <a <?php echo tp_implode_html_attributes($attrs); ?>>
                                                                                    <?php echo tp_kses($item['tp_slider_title']); ?>
                                                                                </a>
                                                                            <?php else:
                                                                                echo tp_kses($item['tp_slider_title']); ?>
                                                                            <?php endif; ?>
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                            <?php endif; ?>

                                                            <?php if (!empty($item['tp_slider_sub_title'])): ?>
                                                                <div class="port-showcase-slider-subtitle">
                                                                    <div>
                                                                        <span
                                                                            class="tp-el-subtitle"><?php echo tp_kses($item['tp_slider_sub_title']); ?></span>
                                                                    </div>
                                                                </div>
                                                            <?php endif; ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>

                            <?php if (!empty($settings['tp_' . $control_id . '_text']) && $settings['tp_' . $control_id . '_button_show'] == 'yes'): ?>
                                <div class="port-showcase-slider-link d-none d-sm-flex">
                                    <a <?php echo $this->get_render_attribute_string('tp-button-arg' . $control_id . ''); ?>>
                                        <span>
                                            <svg width="10" height="12" viewBox="0 0 10 12" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path d="M10 5L5 0L0 5" fill="currentColor" />
                                                <path d="M10 7L5 12L0 7" fill="currentColor" />
                                            </svg>
                                        </span>
                                        <span><?php echo $settings['tp_' . $control_id . '_text']; ?></span>
                                    </a>
                                </div>
                            <?php endif; ?>

                            <div class="tp-slider-dot tp-el-slider-dot"></div>

                            <div class="port-showcase-slider-social d-flex align-items-center d-none d-sm-flex">

                                <?php foreach ($settings['social_list'] as $item):
                                    // Link
                                    if ('2' == $item['social_url']) {
                                        $link = get_permalink($item['social_url']);
                                        $target = '_self';
                                        $rel = 'nofollow';
                                    } else {
                                        $link = !empty($item['social_url']['url']) ? $item['social_url']['url'] : '';
                                        $target = !empty($item['social_url']['is_external']) ? '_blank' : '';
                                        $rel = !empty($item['social_url']['nofollow']) ? 'nofollow' : '';
                                    }
                                    $attrs = array(
                                        'href' => $link,
                                        'target' => $target,
                                        'rel' => $rel,
                                    );
                                    
                                    ?>
                                    <a 
                                        class="tp-hover-btn-item tp-hover-btn tp-magnetic-item not-hide-cursor tp-el-home-social-btn"
                                        <?php echo tp_implode_html_attributes($attrs); ?>>
                                        <?php echo tp_kses($item['social_text']) ?>
                                    </a>
                                <?php endforeach; ?>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- portfolio-showcase-area end-->

                <!-- canvas slider -->
                <div id="canvas-slider" class="canvas-slider">

                    <?php foreach ($settings['slider_list'] as $key => $item):
                        $this->add_render_attribute('title_args', 'class', 'tp-slider-title tp-el-title');

                        if (!empty($item['tp_slider_image']['url'])) {
                            $tp_slider_image_url = !empty($item['tp_slider_image']['id']) ? wp_get_attachment_image_url($item['tp_slider_image']['id'], $settings['thumbnail_size']) : $item['tp_slider_image']['url'];
                            $tp_slider_image_alt = get_post_meta($item["tp_slider_image"]["id"], "_wp_attachment_image_alt", true);
                        }

                        ?>
                        <div class="slider-img" data-slide="<?php echo esc_attr($key); ?>">
                            <img class="slide-img" src="<?php echo esc_url($tp_slider_image_url); ?>"
                                alt="<?php echo esc_attr($tp_slider_image_alt); ?>">
                        </div>
                    <?php endforeach; ?>
                </div>
                <!--/canvas slider -->

            </div>


        <?php endif; ?>


    <?php
    }
}

$widgets_manager->register(new TP_Home_Slider_1());