<?php
namespace TPCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Repeater;
use \Elementor\Utils;
use TPCore\Elementor\Controls\Group_Control_TPBGGradient;
use TPCore\Elementor\Controls\Group_Control_TPGradient;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

/**
 * Tp Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class TP_Portfolio_Fashion extends Widget_Base
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
        return 'tp-portfolio-fashion';
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
        return __('Fashion Portfolio', 'tpcore');
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


        // Service group
        $this->start_controls_section(
            'tp_services',
            [
                'label' => esc_html__('Portfolio List', 'tpcore'),
                'description' => esc_html__('Control all the style settings from Style tab', 'tpcore'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'tp_services_main_title',
            [
                'label' => esc_html__('Main Title', 'tpcore'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Portfolio', 'tpcore'),
                'placeholder' => esc_html__('Your Text', 'tpcore'),
                'label_block' => true
            ]
        );


        $repeater = new \Elementor\Repeater();


        $repeater->add_control(
            'tp_services_image',
            [
                'type' => Controls_Manager::MEDIA,
                'label' => __('Left Image', 'tpcore'),
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'dynamic' => [
                    'active' => true,
                ],
            ]
        );


        $repeater->add_control(
            'tp_service_meta',
            [
                'label' => esc_html__('Left Meta', 'tpcore'),
                'description' => tp_get_allowed_html_desc('basic'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Modelling - 2024', 'tpcore'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'tp_service_title',
            [
                'label' => esc_html__('Left Title', 'tpcore'),
                'description' => tp_get_allowed_html_desc('basic'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Portfolio Title', 'tpcore'),
                'label_block' => true,
            ]
        );


        $repeater->add_control(
            'tp_services_link',
            [
                'label' => esc_html__('Left Portfolio link', 'tpcore'),
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
            ]
        );


        $repeater->add_control(
            'tp_services_image_2',
            [
                'type' => Controls_Manager::MEDIA,
                'label' => __('Right Image', 'tpcore'),
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'dynamic' => [
                    'active' => true,
                ],
            ]
        );


        $repeater->add_control(
            'tp_service_meta_2',
            [
                'label' => esc_html__('Right Meta', 'tpcore'),
                'description' => tp_get_allowed_html_desc('basic'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Modelling - 2024', 'tpcore'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'tp_service_title_2',
            [
                'label' => esc_html__('Right Title', 'tpcore'),
                'description' => tp_get_allowed_html_desc('basic'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Portfolio Title', 'tpcore'),
                'label_block' => true,
            ]
        );


        $repeater->add_control(
            'tp_services_link_2',
            [
                'label' => esc_html__('Right Portfolio link', 'tpcore'),
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
            ]
        );


        $this->add_control(
            'tp_service_list',
            [
                'label' => esc_html__('Services - List', 'tpcore'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'tp_service_title' => esc_html__('Hannah & John', 'tpcore'),
                        'tp_service_title_2' => esc_html__('Siyantika Glory', 'tpcore'),
                    ],
                    [
                        'tp_service_title' => esc_html__('Space Talk', 'tpcore'),
                        'tp_service_title_2' => esc_html__('Mission Mars', 'tpcore')
                    ],
                    [
                        'tp_service_title' => esc_html__('Line City', 'tpcore'),
                        'tp_service_title_2' => esc_html__('Gravity Seen', 'tpcore'),
                    ],
                    [
                        'tp_service_title' => esc_html__('Carribean Sea', 'tpcore'),
                        'tp_service_title_2' => esc_html__('Shahnewaz Story', 'tpcore')
                    ]
                ],
                'title_field' => '{{{ tp_service_title }}}',
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

        $this->tp_button_render_controls('tpbtn', 'Button', ['layout-1']);

    }

    // style_tab_content
    protected function style_tab_content()
    {
        $this->tp_section_style_controls('section_section', 'Section - Style', '.tp-el-section');
        $this->tp_basic_style_controls('services_section_title', 'Section - Title', '.tp-el-title');

        $this->start_controls_section(
            'tp_services_section_box_area_styling',
            [
                'label' => esc_html__('Portfolio - Style', 'tp-core'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'tp_services_section_boxarea_background',
                'label' => esc_html__('Background', 'tp-core'),
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .tp-el-box',
            ]
        );

        $this->add_control(
            'tp_services_box_btn_normal_border_style',
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
                    '{{WRAPPER}} .tp-el-box' => 'border-style: {{VALUE}} !important;;',
                ],
            ]
        );

        $this->add_responsive_control(
            'tp_services_box_btn_normal_border_width',
            [
                'label' => esc_html__('Border Width', 'tp-core'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .tp-el-box' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                ],
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'tp_services_box_btn_normal_border_color',
            [
                'label' => esc_html__('Border Color', 'tp-core'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tp-el-box' => 'border-color: {{VALUE}} !important;;',
                ],
            ]

        );

        $this->add_responsive_control(
            'tp_services_section_box_area_padding',
            [
                'label' => esc_html__('Padding', 'tp-core'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .tp-el-box' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                ],
                'separator' => 'before',
            ]
        );
        $this->add_responsive_control(
            'tp_services_section_box_area_margin',
            [
                'label' => esc_html__('Margin', 'tp-core'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .tp-el-box' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                ],
                'separator' => 'before',
            ]
        );
        $this->end_controls_section();

        $this->tp_basic_style_controls('services_box_title', 'Portfolio - Title', '.tp-el-box-title');
        $this->tp_basic_style_controls('services_box_subtitle', 'Portfolio - Meta', '.tp-el-box-meta');
        $this->tp_basic_style_controls('portfolio_box_link', 'Portfolio - Link', '.tp-el-btn');
        $this->start_controls_section(
            'tp_portfolio_link_area_styling',
            [
                'label' => esc_html__('Portfolio - Link Box', 'tp-core'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'tp_portfolio_link_area_background',
                'label' => esc_html__('Background', 'tp-core'),
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .tp-el-btn-box',
            ]
        );

        $this->add_control(
            'tp_portfolio_link_btn_normal_border_style',
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
                    '{{WRAPPER}} .tp-el-btn-box' => 'border-style: {{VALUE}} !important;;',
                ],
            ]
        );

        $this->add_responsive_control(
            'tp_portfolio_link_btn_normal_border_width',
            [
                'label' => esc_html__('Border Width', 'tp-core'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .tp-el-btn-box' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                ],
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'tp_portfolio_link_btn_normal_border_color',
            [
                'label' => esc_html__('Border Color', 'tp-core'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tp-el-btn-box' => 'border-color: {{VALUE}} !important;;',
                ],
            ]

        );

        $this->add_responsive_control(
            'tp_portfolio_link_area_padding',
            [
                'label' => esc_html__('Padding', 'tp-core'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .tp-el-btn-box' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                ],
                'separator' => 'before',
            ]
        );
        $this->add_responsive_control(
            'tp_portfolio_link_area_margin',
            [
                'label' => esc_html__('Margin', 'tp-core'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .tp-el-btn-box' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                ],
                'separator' => 'before',
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
            $this->add_render_attribute('title_args', 'class', 'section__title-4 tp-el-title');
            ?>


        <?php else:
            $this->add_render_attribute('title_args', 'class', 'tp-section-title-5 mb-20 tp_text_invert tp-el-title');
            $bloginfo = get_bloginfo('name');
            $this->tp_link_controls_render('tpbtn', '.tp-el-btn', $this->get_settings());

            if (!empty($settings['tp_image']['url'])) {
                $tp_image = !empty($settings['tp_image']['id']) ? wp_get_attachment_image_url($settings['tp_image']['id'], $settings['thumbnail_shape_size']) : $settings['tp_image']['url'];
                $tp_image_alt = get_post_meta($settings["tp_image"]["id"], "_wp_attachment_image_alt", true);
            }
            ?>

            <!-- portfolio area start -->
            <div class="tp-project-5-2-area pt-120 pb-130 coffe-bg z-index-1 tp-el-section">
                <div class="container container-1790">
                    <?php if (!empty($settings['tp_services_main_title'])): ?>
                        <div class="row">
                            <div class="col-xl-12">
                                <div class="tp-project-5-2-title-box mb-170 text-center">
                                    <h4 class="tp-project-5-2-title tp-el-title">
                                        <?php echo tp_kses($settings['tp_services_main_title']); ?>
                                    </h4>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                    <div class="tp-project-5-2-wrap z-index-1">
                        <?php foreach ($settings['tp_service_list'] as $key => $item):

                            if (!empty($item['tp_services_image']['url'])) {
                                $tp_services_image = !empty($item['tp_services_image']['id']) ? wp_get_attachment_image_url($item['tp_services_image']['id'], $settings['thumbnail_size']) : $item['tp_services_image']['url'];
                                $tp_services_image_alt = get_post_meta($item["tp_services_image"]["id"], "_wp_attachment_image_alt", true);
                            }

                            if (!empty($item['tp_services_image_2']['url'])) {
                                $tp_services_image_2 = !empty($item['tp_services_image_2']['id']) ? wp_get_attachment_image_url($item['tp_services_image_2']['id'], $settings['thumbnail_size']) : $item['tp_services_image_2']['url'];
                                $tp_services_image_2_alt = get_post_meta($item["tp_services_image_2"]["id"], "_wp_attachment_image_alt", true);
                            }


                            $link = !empty($item['tp_services_link']['url']) ? $item['tp_services_link']['url'] : '';
                            $target = !empty($item['tp_services_link']['is_external']) ? '_blank' : '';
                            $rel = !empty($item['tp_services_link']['nofollow']) ? 'nofollow' : '';

                            $link2 = !empty($item['tp_services_link_2']['url']) ? $item['tp_services_link_2']['url'] : '';
                            $target2 = !empty($item['tp_services_link_2']['is_external']) ? '_blank' : '';
                            $rel2 = !empty($item['tp_services_link_2']['nofollow']) ? 'nofollow' : '';

                            ?>

                            <?php if (($key % 2) == 0): ?>

                                <div class="tp-project-5-2-item-wrap">
                                    <div class="row align-items-center justify-content-between">
                                        <div class="col-xxl-3 col-xl-4 col-lg-6 col-md-6">
                                            <?php if (!empty($link)): ?>
                                                <a class="cursor-hide" href="<?php echo esc_url($link); ?>"
                                                    target="<?php echo esc_attr($target); ?>" rel="<?php echo esc_attr($rel); ?>">
                                                    <div class="tp-project-5-2-item not-hide-cursor tp-el-box" data-cursor="View<br>Demo">
                                                        <div class="tp-project-5-2-thumb">
                                                            <img src="<?php echo esc_url($tp_services_image); ?>"
                                                                alt="<?php echo esc_attr($tp_services_image_alt); ?>">
                                                        </div>
                                                        <div class="tp-project-5-2-content">
                                                            <?php if (!empty($item['tp_service_meta'])): ?>
                                                                <span class="tp-el-box-meta"><?php echo tp_kses($item['tp_service_meta']); ?></span>
                                                            <?php endif; ?>

                                                            <?php if (!empty($item['tp_service_title'])): ?>
                                                                <h4 class="tp-project-5-2-title-sm tp-el-box-title">
                                                                    <?php echo tp_kses($item['tp_service_title']); ?>
                                                                </h4>
                                                            <?php endif; ?>
                                                        </div>
                                                    </div>
                                                </a>
                                            <?php endif; ?>
                                        </div>
                                        <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6">
                                            <?php if (!empty($link2)): ?>
                                                <a class="cursor-hide" href="<?php echo esc_url($link2); ?>"
                                                    target="<?php echo esc_attr($target2); ?>" rel="<?php echo esc_attr($rel2); ?>">

                                                    <div class="tp-project-5-2-item not-hide-cursor tp-el-box" data-cursor="View<br>Demo">
                                                        <div class="tp-project-5-2-thumb">
                                                            <img src="<?php echo esc_url($tp_services_image_2); ?>"
                                                                alt="<?php echo esc_attr($tp_services_image_2_alt); ?>">
                                                        </div>
                                                        <div class="tp-project-5-2-content">

                                                            <?php if (!empty($item['tp_service_meta_2'])): ?>
                                                                <span
                                                                    class="tp-el-box-meta"><?php echo tp_kses($item['tp_service_meta_2']); ?></span>
                                                            <?php endif; ?>

                                                            <?php if (!empty($item['tp_service_title_2'])): ?>
                                                                <h4 class="tp-project-5-2-title-sm tp-el-box-title">
                                                                    <?php echo tp_kses($item['tp_service_title_2']); ?>
                                                                </h4>
                                                            <?php endif; ?>
                                                        </div>
                                                    </div>
                                                </a>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>

                            <?php else: ?>

                                <div class="tp-project-5-2-item-wrap">
                                    <div class="row align-items-center justify-content-between">
                                        <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6">
                                            <?php if (!empty($link)): ?>
                                                <a class="cursor-hide" href="<?php echo esc_url($link); ?>"
                                                    target="<?php echo esc_attr($target); ?>" rel="<?php echo esc_attr($rel); ?>">

                                                    <div class="tp-project-5-2-item space-left not-hide-cursor" data-cursor="View<br>Demo">
                                                        <div class="tp-project-5-2-thumb">
                                                            <img src="<?php echo esc_url($tp_services_image); ?>"
                                                                alt="<?php echo esc_attr($tp_services_image_alt); ?>">
                                                        </div>
                                                        <div class="tp-project-5-2-content">
                                                            <?php if (!empty($item['tp_service_meta'])): ?>
                                                                <span><?php echo tp_kses($item['tp_service_meta']); ?></span>
                                                            <?php endif; ?>

                                                            <?php if (!empty($item['tp_service_title'])): ?>
                                                                <h4 class="tp-project-5-2-title-sm">
                                                                    <?php echo tp_kses($item['tp_service_title']); ?>
                                                                </h4>
                                                            <?php endif; ?>
                                                        </div>
                                                    </div>
                                                </a>
                                            <?php endif; ?>
                                        </div>
                                        <div class="col-xxl-3 col-xl-4 col-lg-5 col-md-6">
                                            <?php if (!empty($link2)): ?>
                                                <a class="cursor-hide" href="<?php echo esc_url($link2); ?>"
                                                    target="<?php echo esc_attr($target2); ?>" rel="<?php echo esc_attr($rel2); ?>">
                                                    <div class="tp-project-5-2-item not-hide-cursor" data-cursor="View<br>Demo">
                                                        <div class="tp-project-5-2-thumb">
                                                            <img src="<?php echo esc_url($tp_services_image_2); ?>"
                                                                alt="<?php echo esc_attr($tp_services_image_2_alt); ?>">
                                                        </div>
                                                        <div class="tp-project-5-2-content">
                                                            <?php if (!empty($item['tp_service_meta_2'])): ?>
                                                                <span><?php echo tp_kses($item['tp_service_meta_2']); ?></span>
                                                            <?php endif; ?>

                                                            <?php if (!empty($item['tp_service_title_2'])): ?>
                                                                <h4 class="tp-project-5-2-title-sm">
                                                                    <?php echo tp_kses($item['tp_service_title_2']); ?>
                                                                </h4>
                                                            <?php endif; ?>
                                                        </div>
                                                    </div>
                                                </a>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>

                            <?php endif; ?>

                        <?php endforeach; ?>


                    </div>


                    <?php if (!empty($settings['tp_' . $control_id . '_text']) && $settings['tp_' . $control_id . '_button_show'] == 'yes'): ?>
                        <div class="row justify-content-center">
                            <div class="col-xl-3 col-lg-4 col-md-6">
                                <div class="tp-project-5-2-btn text-center p-relative tp-el-btn-box">
                                    <div class="tp-project-5-2-shape d-none d-lg-block">
                                        <span>
                                            <svg width="205" height="209" viewBox="0 0 205 209" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path d="M17.9992 110.499C79.4994 235.001 90.4995 23.4983 192.778 88.2089"
                                                    stroke="#CFC292" stroke-width="1.5" />
                                                <path d="M191.52 76.8785C188.858 81.4883 190.33 87.3118 194.811 89.8989"
                                                    stroke="#CFC292" stroke-width="1.5" stroke-miterlimit="10" />
                                                <path d="M194.814 89.8969C190.333 87.3098 184.553 88.9466 181.892 93.5563"
                                                    stroke="#CFC292" stroke-width="1.5" stroke-miterlimit="10" />
                                            </svg>
                                        </span>
                                    </div>
                                    <a <?php echo $this->get_render_attribute_string('tp-button-arg' . $control_id . ''); ?>>
                                        <?php echo $settings['tp_' . $control_id . '_text']; ?>
                                        <span>
                                            <svg width="14" height="14" viewBox="0 0 14 14" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path d="M1 13L13 1" stroke="currentcolor" stroke-width="1.5" stroke-linecap="round"
                                                    stroke-linejoin="round" />
                                                <path d="M1 1H13V13" stroke="currentcolor" stroke-width="1.5" stroke-linecap="round"
                                                    stroke-linejoin="round" />
                                            </svg>
                                        </span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>

                </div>
            </div>
            <!-- portfolio area end -->


        <?php endif; ?>

        <?php
    }
}

$widgets_manager->register(new TP_Portfolio_Fashion());