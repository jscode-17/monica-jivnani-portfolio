<?php
namespace TPCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Repeater;
use \Elementor\Utils;
use \Elementor\Group_Control_Typography;
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
class TP_Photograph_Portfolio extends Widget_Base
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
        return 'tp-photograph-portfolio';
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
        return __('Photograph Portfolio', 'tpcore');
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

        $this->tp_section_title_render_controls('award', 'Section Title');


        // _tp_image
        $this->start_controls_section(
            '_tp_image',
            [
                'label' => esc_html__('Shape Image', 'tp-core'),
            ]
        );

        $this->add_control(
            'tp_image',
            [
                'label' => esc_html__('Choose Image', 'tp-core'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'thumbnail_shape',
                'default' => 'full',
                'exclude' => [
                    'custom'
                ]
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


        $repeater = new \Elementor\Repeater();


        $repeater->add_control(
            'tp_services_image',
            [
                'type' => Controls_Manager::MEDIA,
                'label' => __('Image', 'tpcore'),
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'dynamic' => [
                    'active' => true,
                ],
            ]
        );


        $repeater->add_control(
            'tp_service_year',
            [
                'label' => esc_html__('Year', 'tpcore'),
                'description' => tp_get_allowed_html_desc('basic'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('2024', 'tpcore'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'tp_service_title',
            [
                'label' => esc_html__('Title', 'tpcore'),
                'description' => tp_get_allowed_html_desc('basic'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Portfolio Title', 'tpcore'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'tp_service_description',
            [
                'label' => esc_html__('Description', 'tpcore'),
                'description' => tp_get_allowed_html_desc('intermediate'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => 'Collections / Design / Wedding',
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'tp_services_link_switcher',
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
            'tp_services_link_type',
            [
                'label' => esc_html__('Portfolio Link Type', 'tpcore'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    '1' => 'Custom Link',
                    '2' => 'Internal Page',
                ],
                'default' => '1',
                'condition' => [
                    'tp_services_link_switcher' => 'yes'
                ]
            ]
        );
        $repeater->add_control(
            'tp_services_link',
            [
                'label' => esc_html__('Portfolio link', 'tpcore'),
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
                    'tp_services_link_type' => '1',
                    'tp_services_link_switcher' => 'yes',
                ]
            ]
        );
        $repeater->add_control(
            'tp_services_page_link',
            [
                'label' => esc_html__('Select Portfolio Link Page', 'tpcore'),
                'type' => \Elementor\Controls_Manager::SELECT2,
                'label_block' => true,
                'options' => tp_get_all_pages(),
                'condition' => [
                    'tp_services_link_type' => '2',
                    'tp_services_link_switcher' => 'yes',
                ]
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
                        'tp_service_title' => esc_html__('Wedding', 'tpcore'),
                    ],
                    [
                        'tp_service_title' => esc_html__('Event', 'tpcore')
                    ],
                    [
                        'tp_service_title' => esc_html__('Family Shoots', 'tpcore')
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

    }

    // style_tab_content
    protected function style_tab_content()
    {
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

        $this->tp_section_style_controls('services_section_box', 'Services - Box - Style', '.tp-el-box');
        $this->tp_basic_style_controls('services_box_title', 'Services - Box - Title', '.tp-el-box-title');
        $this->tp_basic_style_controls('services_box_year', 'Services - Box - Subtitle', '.tp-el-box-year');
        $this->tp_basic_style_controls('services_box_tag', 'Services - Box - Tag', '.tp-el-box-tag');
        $this->tp_link_controls_style('services_box_link_btn', 'Services - Box - Button', '.tp-el-box-btn');
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

        ?>

        <?php if ($settings['tp_design_style'] == 'layout-2'):
            $this->add_render_attribute('title_args', 'class', 'section__title-4 tp-el-title');
            ?>


        <?php else:
            $this->add_render_attribute('title_args', 'class', 'tp-section-title-5 mb-20 tp_text_invert tp-el-title');
            $bloginfo = get_bloginfo('name');


            if (!empty($settings['tp_image']['url'])) {
                $tp_image = !empty($settings['tp_image']['id']) ? wp_get_attachment_image_url($settings['tp_image']['id'], $settings['thumbnail_shape_size']) : $settings['tp_image']['url'];
                $tp_image_alt = get_post_meta($settings["tp_image"]["id"], "_wp_attachment_image_alt", true);
            }
            ?>

            <!-- about area start -->
            <div class="tp-project-4-2-area black-bg-6 pt-150 pb-150 tp-el-section">
                <div class="container container-1320">
                    <?php if (!empty($settings['tp_award_section_title_show'])): ?>
                        <div class="tp-project-4-2-title-wrap mb-90">
                            <div class="row align-items-end">
                                <?php if (!empty($settings['tp_award_sub_title'])): ?>
                                    <div class="col-xl-2">
                                        <div class="tp-about-4-subtitle-box">
                                            <span
                                                class="tp-section-subtitle-5 tp-el-subtitle"><?php echo tp_kses($settings['tp_award_sub_title']); ?></span>
                                        </div>
                                    </div>
                                <?php endif; ?>
                                <div class="col-xl-7 col-lg-8 col-md-8">
                                    <div class="tp-about-4-title-box tp-el-content">
                                        <?php
                                        if (!empty($settings['tp_award_title'])):
                                            printf(
                                                '<%1$s %2$s>%3$s</%1$s>',
                                                tag_escape($settings['tp_award_title_tag']),
                                                $this->get_render_attribute_string('title_args'),
                                                tp_kses($settings['tp_award_title'])
                                            );
                                        endif;
                                        ?>

                                        <?php if (!empty($settings['tp_award_description'])): ?>
                                            <p class="tp_text_invert"><?php echo tp_kses($settings['tp_award_description']); ?></p>
                                        <?php endif; ?>
                                    </div>
                                </div>

                                <?php if (!empty($settings['tp_image']['url'])): ?>
                                    <div class="col-xl-3 col-lg-4 col-md-4 d-none d-md-block">
                                        <div class="tp-about-4-shape text-end">
                                            <img src="<?php echo esc_url($tp_image); ?>" alt="<?php echo esc_attr($tp_image_alt) ?>">
                                        </div>
                                    </div>
                                <?php endif; ?>

                            </div>
                        </div>
                    <?php endif; ?>

                    <div class="row">
                        <div class="offset-xl-3 col-xl-9">
                            <div class="tp-project-4-2-wrap">

                                <?php foreach ($settings['tp_service_list'] as $key => $item):

                                    if (!empty($item['tp_services_image']['url'])) {
                                        $tp_services_image = !empty($item['tp_services_image']['id']) ? wp_get_attachment_image_url($item['tp_services_image']['id'], $settings['thumbnail_size']) : $item['tp_services_image']['url'];
                                        $tp_services_image_alt = get_post_meta($item["tp_services_image"]["id"], "_wp_attachment_image_alt", true);
                                    }
                                    // Link
                                    if ('2' == $item['tp_services_link_type']) {
                                        $link = get_permalink($item['tp_services_page_link']);
                                        $target = '_self';
                                        $rel = 'nofollow';
                                    } else {
                                        $link = !empty($item['tp_services_link']['url']) ? $item['tp_services_link']['url'] : '';
                                        $target = !empty($item['tp_services_link']['is_external']) ? '_blank' : '';
                                        $rel = !empty($item['tp_services_link']['nofollow']) ? 'nofollow' : '';
                                    }
                                    $attrs = array(
                                        'href' => $link,
                                        'target' => $target,
                                        'rel' => $rel,
                                    );
                                    ?>

                                    <div class="tp-project-4-2-item p-relative tp-hover-reveal-item active tp-el-box">

                                        <?php if ($item['tp_services_link_switcher'] == 'yes'): ?>
                                            <a <?php echo tp_implode_html_attributes($attrs); ?>>
                                            <?php endif; ?>
                                            <div class="tp-project-4-2-inner-item d-flex justify-content-between align-items-center">
                                                <div class="tp-project-4-2-content d-flex align-items-start">
                                                    <?php if (!empty($item['tp_service_year'])): ?>
                                                        <div class="tp-project-4-2-year">
                                                            <span
                                                                class="tp-el-box-year"><?php echo tp_kses($item['tp_service_year']); ?></span>
                                                        </div>
                                                    <?php endif; ?>
                                                    <div class="tp-project-4-2-title-box">

                                                        <?php if (!empty($item['tp_service_title'])): ?>
                                                            <h4 class="tp-project-4-2-title tp-el-box-title">
                                                                <?php echo tp_kses($item['tp_service_title']); ?>
                                                            </h4>
                                                        <?php endif; ?>

                                                        <?php if (!empty($item['tp_service_description'])): ?>
                                                            <span
                                                                class="tp-el-box-desc tp-el-box-tag"><?php echo tp_kses($item['tp_service_description']); ?></span>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>

                                                <?php if ($item['tp_services_link_switcher'] == 'yes'): ?>
                                                    <div class="tp-project-4-2-link">
                                                        <span class="tp-el-box-btn">
                                                            <svg width="26" height="21" viewBox="0 0 26 21" fill="none"
                                                                xmlns="http://www.w3.org/2000/svg">
                                                                <path d="M0 10.3965H26" stroke="currentcolor" stroke-width="2"
                                                                    stroke-miterlimit="10" />
                                                                <path d="M15.9307 0C15.9307 5.74655 20.4343 10.3965 26 10.3965"
                                                                    stroke="currentcolor" stroke-width="2" stroke-miterlimit="10" />
                                                                <path d="M26 10.3965C20.4343 10.3965 15.9307 15.0465 15.9307 20.793"
                                                                    stroke="currentcolor" stroke-width="2" stroke-miterlimit="10" />
                                                            </svg>
                                                        </span>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                            <?php if ($item['tp_services_link_switcher'] == 'yes'): ?>
                                            </a>
                                        <?php endif; ?>

                                        <div class="tp-hover-reveal-bg" data-background="<?php echo esc_url($tp_services_image); ?>">
                                        </div>

                                    </div>
                                <?php endforeach; ?>
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

$widgets_manager->register(new TP_Photograph_Portfolio());