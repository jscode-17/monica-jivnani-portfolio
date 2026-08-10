<?php
namespace TPCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Repeater;
use \Elementor\Utils;
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
class TP_Brand extends Widget_Base
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
        return 'tp-brand';
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
        return __('Brand', 'tpcore');
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
                ],
                'default' => 'layout-1',
            ]
        );


        $this->end_controls_section();


        $this->start_controls_section(
            'tp_brand_section',
            [
                'label' => __('Brand Item', 'tpcore'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'tp_brand_title',
            [
                'label' => esc_html__('Title', 'tpcore'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Trusted By', 'tpcore'),
                'placeholder' => esc_html__('Your Text', 'tpcore'),
                'label_block' => true,
                'condition' => [
                    'tp_design_style' => 'layout-1'
                ]
            ]
        );

        $repeater = new Repeater();

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
            'tp_brand_image',
            [
                'type' => Controls_Manager::MEDIA,
                'label' => __('Image', 'tpcore'),
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->add_control(
            'tp_brand_image_light',
            [
                'type' => Controls_Manager::MEDIA,
                'label' => __('Upload Dark Image', 'tpcore'),
                'description' => 'This image for light version',
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'dynamic' => [
                    'active' => true,
                ],
                'condition' => [
                    'repeater_condition' => ['style_2']
                ]
            ]
        );


        $repeater->add_control(
            'tp_brand_url',
            [
                'label' => esc_html__('URL', 'tpcore'),
                'type' => Controls_Manager::URL,
                'default' => [
                    'url' => '#',
                    'is_external' => true,
                    'nofollow' => true,
                    'custom_attributes' => '',
                ],
                'placeholder' => esc_html__('Type url here', 'tpcore'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'tp_brand_slides',
            [
                'show_label' => false,
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'title_field' => esc_html__('Brand Item', 'tpcore'),
                'default' => [
                    [
                        'tp_brand_image' => [
                            'url' => Utils::get_placeholder_image_src(),
                        ],
                    ],
                    [
                        'tp_brand_image' => [
                            'url' => Utils::get_placeholder_image_src(),
                        ],
                    ],
                ],
                'dynamic' => [
                    'active' => true,
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'thumbnail',
                'default' => 'medium_large',
                'separator' => 'before',
                'exclude' => [
                    'custom'
                ]
            ]
        );

        $this->end_controls_section();
    }


    // style_tab_content
    protected function style_tab_content()
    {
        $this->tp_section_style_controls('brand_section', 'Section - Style', '.tp-el-section');
        $this->tp_basic_style_controls('brand_title', 'Brand - Title', '.tp-el-title');


        $this->start_controls_section(
            'tp_brand_item_styling',
            [
                'label' => esc_html__('Brand - Item', 'tp-core'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );


        $this->add_control(
            'tp_brand_item_full_btn_normal_bg_color',
            [
                'label' => esc_html__('Background Color', 'tp-core'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tp-el-brand-item' => 'background: {{VALUE}} !important;',
                ],
            ]
        );

        $this->add_control(
            'tp_brand_item_full_btn_normal_bg_color_hover',
            [
                'label' => esc_html__('Background Color :: Hover', 'tp-core'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tp-el-brand-item:hover' => 'background: {{VALUE}} !important;',
                ],
            ]
        );


        $this->add_control(
            'tp_brand_item_full_btn_normal_border_style',
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
                    '{{WRAPPER}} .tp-el-brand-item' => 'border-style: {{VALUE}} !important;;',
                ],
            ]
        );

        $this->add_responsive_control(
            'tp_brand_item_full_btn_normal_border_width',
            [
                'label' => esc_html__('Border Width', 'tp-core'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .tp-el-brand-item' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                ],
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'tp_brand_item_full_btn_normal_border_color',
            [
                'label' => esc_html__('Border Color', 'tp-core'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tp-el-brand-item' => 'border-color: {{VALUE}} !important;',
                ],
            ]

        );
        $this->add_control(
            'tp_brand_item_full_btn_normal_border_hover_color',
            [
                'label' => esc_html__('Border Color :: Hover', 'tp-core'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tp-el-brand-item:hover' => 'border-color: {{VALUE}} !important;',
                ],
            ]

        );

        $this->add_responsive_control(
            'tp_brand_item_full_padding',
            [
                'label' => esc_html__('Padding', 'tp-core'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .tp-el-brand-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' => 'before',
            ]
        );
        $this->add_responsive_control(
            'tp_brand_item_full_margin',
            [
                'label' => esc_html__('Margin', 'tp-core'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .tp-el-brand-item' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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

        ?>

        <?php if ($settings['tp_design_style'] == 'layout-2'):
            $this->add_render_attribute('title_args', 'class', 'tp-title tp-el-title');
            ?>

            <!-- brand area start -->
            <div class="ab-brand__area black-bg-3 pb-100 ab-brand__plr tp-el-section">
                <div class="container-fluid">
                    <div class="row gx-20">
                        <div class="col-xl-12">
                            <div class="tp-about-brand-slider">
                                <div class="tp-about-brand-slider-active swiper-container">
                                    <div class="swiper-wrapper">
                                        <?php foreach ($settings['tp_brand_slides'] as $item):
                                            if (!empty($item['tp_brand_image']['url'])) {
                                                $tp_brand_image_url = !empty($item['tp_brand_image']['id']) ? wp_get_attachment_image_url($item['tp_brand_image']['id'], $settings['thumbnail_size']) : $item['tp_brand_image']['url'];
                                                $tp_brand_image_alt = get_post_meta($item["tp_brand_image"]["id"], "_wp_attachment_image_alt", true);
                                            }
                                            if (!empty($item['tp_brand_image_light']['url'])) {
                                                $tp_brand_image_light_url = !empty($item['tp_brand_image_light']['id']) ? wp_get_attachment_image_url($item['tp_brand_image_light']['id'], $settings['thumbnail_size']) : $item['tp_brand_image_light']['url'];
                                                $tp_brand_image_light_alt = get_post_meta($item["tp_brand_image_light"]["id"], "_wp_attachment_image_alt", true);
                                            }

                                            // Link
                                            if ('2' == $item['tp_brand_url']) {
                                                $link = get_permalink($item['tp_brand_url']);
                                                $target = '_self';
                                                $rel = 'nofollow';
                                            } else {
                                                $link = !empty($item['tp_brand_url']['url']) ? $item['tp_brand_url']['url'] : '';
                                                $target = !empty($item['tp_brand_url']['is_external']) ? '_blank' : '';
                                                $rel = !empty($item['tp_brand_url']['nofollow']) ? 'nofollow' : '';
                                            }
                                            $attrs = array(
                                                'href' => $link,
                                                'target' => $target,
                                                'rel' => $rel,
                                            );
                                            ?>
                                            <div class="swiper-slide">
                                                <div class="ab-brand__item wow tpfadeUp tp-el-brand-item" data-wow-duration=".9s"
                                                    data-wow-delay=".3s">
                                                    <?php if (!empty($item['tp_brand_image']['url'])): ?>
                                                        <a <?php echo tp_implode_html_attributes($attrs); ?>>
                                                            <img class="dark" src="<?php echo esc_url($tp_brand_image_url); ?>"
                                                                alt="<?php echo esc_url($tp_brand_image_alt); ?>">
                                                            <img class="light" src="<?php echo esc_url($tp_brand_image_light_url); ?>"
                                                                alt="<?php echo esc_url($tp_brand_image_light_alt); ?>">
                                                        </a>

                                                    <?php else: ?>
                                                        <img class="dark" src="<?php echo esc_url($tp_brand_image_url); ?>"
                                                            alt="<?php echo esc_url($tp_brand_image_alt); ?>">
                                                        <img class="light" src="<?php echo esc_url($tp_brand_image_light_url); ?>"
                                                            alt="<?php echo esc_url($tp_brand_image_light_alt); ?>">
                                                    <?php endif; ?>
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
            <!-- brand area end -->

        <?php else: ?>

            <!-- brand area start -->
            <section class="tp-brand-area p-relative tp-el-section">
                <span class="tp-brand-border transition-3"></span>
                <div class="container container-large">
                    <div class="tp-brand-inner p-relative">
                        <span class="tp-brand-inner-border left tp-vertical-line"></span>
                        <span class="tp-brand-inner-border right tp-vertical-line"></span>

                        <div class="row align-items-center">
                            <?php if (!empty($settings['tp_brand_title'])): ?>
                                <div class="col-xl-3 col-lg-3 col-md-5">
                                    <h3 class="tp-brand-title tp-el-title"><?php echo tp_kses($settings['tp_brand_title']); ?></h3>
                                </div>
                            <?php endif; ?>
                            <div class="col-xl-9 col-lg-9 col-md-7">
                                <div class="tp-brand-slider">
                                    <div class="tp-brand-slider-active swiper-container">
                                        <div class="swiper-wrapper align-items-center">
                                            <?php foreach ($settings['tp_brand_slides'] as $item):
                                                if (!empty($item['tp_brand_image']['url'])) {
                                                    $tp_brand_image_url = !empty($item['tp_brand_image']['id']) ? wp_get_attachment_image_url($item['tp_brand_image']['id'], $settings['thumbnail_size']) : $item['tp_brand_image']['url'];
                                                    $tp_brand_image_alt = get_post_meta($item["tp_brand_image"]["id"], "_wp_attachment_image_alt", true);
                                                }

                                                // Link
                                                if ('2' == $item['tp_brand_url']) {
                                                    $link = get_permalink($item['tp_brand_url']);
                                                    $target = '_self';
                                                    $rel = 'nofollow';
                                                } else {
                                                    $link = !empty($item['tp_brand_url']['url']) ? $item['tp_brand_url']['url'] : '';
                                                    $target = !empty($item['tp_brand_url']['is_external']) ? '_blank' : '';
                                                    $rel = !empty($item['tp_brand_url']['nofollow']) ? 'nofollow' : '';
                                                }
                                                $attrs = array(
                                                    'href' => $link,
                                                    'target' => $target,
                                                    'rel' => $rel,
                                                );
                                                ?>
                                                <div class="tp-brand-item swiper-slide text-end">
                                                    <?php if (!empty($item['tp_brand_image']['url'])): ?>
                                                        <a <?php echo tp_implode_html_attributes($attrs); ?>>
                                                            <img src="<?php echo esc_url($tp_brand_image_url); ?>"
                                                                alt="<?php echo esc_url($tp_brand_image_alt); ?>">
                                                        </a>

                                                    <?php else: ?>
                                                        <img src="<?php echo esc_url($tp_brand_image_url); ?>"
                                                            alt="<?php echo esc_url($tp_brand_image_alt); ?>">
                                                    <?php endif; ?>
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
            <!-- brand area end -->

        <?php endif; ?>

        <?php
    }


}

$widgets_manager->register(new TP_Brand());
