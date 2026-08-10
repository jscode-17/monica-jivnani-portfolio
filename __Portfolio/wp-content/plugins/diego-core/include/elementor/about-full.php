<?php
namespace TPCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Repeater;
use \Elementor\Utils;
use \Elementor\Control_Media;
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
class TP_About_Full extends Widget_Base
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
        return 'about-full';
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
        return __('About Full', 'tp-core');
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
        return ['tp-core'];
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
        return ['tp-core'];
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
                'label' => esc_html__('About Section', 'tpcore'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'tp_about_subtitle',
            [
                'label' => esc_html__('About Subtitle', 'tpcore'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('About Me', 'tpcore'),
                'placeholder' => esc_html__('Your Text', 'tpcore'),
                'label_block' => true
            ]
        );
        $this->add_control(
            'tp_about_title',
            [
                'label' => esc_html__('About Title', 'tpcore'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Im Diego', 'tpcore'),
                'placeholder' => esc_html__('Your Text', 'tpcore'),
                'label_block' => true
            ]
        );

        $this->add_control(
            'tp_about_highlight_text',
            [
                'label' => esc_html__('About Highlight Text', 'tpcore'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('I am a UI Designer building usable human', 'tpcore'),
                'placeholder' => esc_html__('Your Text', 'tpcore'),
                'label_block' => true
            ]
        );

        $this->add_control(
            'tp_about_desc',
            [
                'label' => esc_html__('About Description', 'tpcore'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'rows' => 10,
                'default' => esc_html__('Hello! I’m Diego a self-taught & award-winning Digital Designer & Developer', 'tpcore'),
                'placeholder' => esc_html__('Your Text', 'tpcore'),
                'label_block' => true
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            '_tp_image',
            [
                'label' => esc_html__('Thumbnail', 'tp-core'),
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

        $this->add_control(
            'tp_about_exp_year',
            [
                'label' => esc_html__('Experience Year', 'tpcore'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('12', 'tpcore'),
                'placeholder' => esc_html__('Your Text', 'tpcore'),
                'label_block' => true
            ]
        );

        $this->add_control(
            'tp_about_exp_desc',
            [
                'label' => esc_html__('Experience Description', 'tpcore'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => esc_html__('Years Of Working Experience', 'tpcore'),
                'placeholder' => esc_html__('Your Text', 'tpcore'),
                'label_block' => true
            ]
        );

        $this->add_control(
            'about_shape_switch',
            [
                'label' => esc_html__('Enable Shape ?', 'tpcore'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'tpcore'),
                'label_off' => esc_html__('Hide', 'tpcore'),
                'return_value' => 'yes',
                'default' => 'yes',
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

        $this->tp_button_render_controls('tpbtn', 'Button 1', ['layout-1']);

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
                'label_block' => true
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
            'tp_brand_urls',
            [
                'label' => esc_html__('URL', 'tpcore'),
                'type' => Controls_Manager::URL,
                'default' => [
                    'url' => '#',
                    'is_external' => true,
                    'nofollow' => true,
                    'custom_attributes' => '',
                ],
                'placeholder' => esc_html__('Type URL here', 'tpcore'),
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
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'brand',
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

        $this->tp_section_style_controls('about_full_section', 'Section - Style', '.tp-el-section');
        $this->tp_basic_style_controls('about_full_subtitle', 'About - Subtitle', '.tp-el-subtitle');
        $this->tp_basic_style_controls('about_full_title', 'About - Title', '.tp-el-title');
        $this->tp_basic_style_controls('about_full_highlight', 'About - Highlight Description', '.tp-el-highlight-desc');
        $this->tp_basic_style_controls('about_full_description', 'About - Description', '.tp-el-desc');
        $this->tp_link_controls_style('about_full_box_link_btn', 'About - Button', '.tp-el-full-about-btn');

        $this->tp_basic_style_controls('about_full_brand_title', 'Brand - Title', '.tp-el-brand-title');


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
                    '{{WRAPPER}} .tp-el-brand-item' => 'border-color: {{VALUE}} !important;;',
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
        $control_id = 'tpbtn';
        ?>

        <?php if ($settings['tp_design_style'] == 'layout-2'):
            $this->add_render_attribute('title_args', 'class', 'section__title-4-2 tp-el-title');
            $bloginfo = get_bloginfo('name');

            ?>



        <?php else:

            $bloginfo = get_bloginfo('name');

            if (!empty($settings['tp_image']['url'])) {
                $tp_image = !empty($settings['tp_image']['id']) ? wp_get_attachment_image_url($settings['tp_image']['id'], $settings['thumbnail_size']) : $settings['tp_image']['url'];
                $tp_image_alt = get_post_meta($settings["tp_image"]["id"], "_wp_attachment_image_alt", true);
            }

            $this->tp_link_controls_render('tpbtn', 'tp-hero-2__exp-link tp-el-full-about-btn', $this->get_settings());


            ?>

            <div
                class="tp-hero-2__bg black-bg-3 tp-hero-2__space-2 d-flex align-items-start justify-content-center p-relative z-index-1 tp-el-section">
                <?php if ($settings['about_shape_switch'] == 'yes'): ?>
                    <div class="tp-hero-2__boder-circle">
                        <span></span>
                    </div>
                <?php endif; ?>
                <div class="container">

                    <div class="tp-hero-2__exp-thumb-main p-relative">
                        <?php if ($settings['about_shape_switch'] == 'yes'): ?>
                            <div class="tp-hero-2__circle-img-wrap">
                                <div class="tp-hero-2__circle-img p-relative">
                                    <img class="img-1"
                                        src="<?php echo get_template_directory_uri(); ?>/assets/img/hero/hero-circle-2.png" alt="">
                                    <div class="tp-hero-2__circle-img-2">
                                        <img src="<?php echo get_template_directory_uri(); ?>/assets/img/hero/hero-circle-1.png"
                                            alt="<?php echo esc_attr($tp_image_alt); ?>">
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                        <div class="row align-items-center z-index-5">

                            <?php if (!empty($tp_image)): ?>
                                <div class="col-xl-4 col-lg-4 col-md-4">
                                    <div class="tp-hero-2__exp-thumb-wrap p-relative text-end">
                                        <div class="tp-hero-2__exp-thumb-bg">
                                            <img src="<?php echo esc_url($tp_image); ?>" alt="<?php echo esc_attr($tp_image_alt); ?>">
                                        </div>
                                        <div class="tp-hero-2__exp-thumb-text">
                                            <span><?php echo tp_kses($settings['tp_about_exp_year']); ?></span>
                                            <p><?php echo tp_kses($settings['tp_about_exp_desc']); ?></p>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>

                            <div class="col-xl-8 col-lg-8 col-md-8">
                                <div class="tp-hero-2__exp-info">

                                    <?php if (!empty($settings['tp_about_subtitle'])): ?>
                                        <span class="tp-hero-2__exp-subtitle tp-el-subtitle">
                                            <?php echo tp_kses($settings['tp_about_subtitle']); ?>
                                        </span>
                                    <?php endif; ?>

                                    <?php if (!empty($settings['tp_about_title'])): ?>
                                        <h4 class="tp-hero-2__exp-title tp-el-title"><?php echo tp_kses($settings['tp_about_title']); ?>
                                        </h4>
                                    <?php endif; ?>

                                    <?php if (!empty($settings['tp_about_highlight_text'])): ?>
                                        <p class="child-1 tp-el-highlight-desc">
                                            <?php echo tp_kses($settings['tp_about_highlight_text']); ?>
                                        </p>
                                    <?php endif; ?>

                                    <?php if (!empty($settings['tp_about_desc'])): ?>
                                        <p class="child-2 tp-el-desc"><?php echo tp_kses($settings['tp_about_desc']); ?></p>
                                    <?php endif; ?>


                                    <?php if (!empty($settings['tp_' . $control_id . '_text']) && $settings['tp_' . $control_id . '_button_show'] == 'yes'): ?>
                                        <a <?php echo $this->get_render_attribute_string('tp-button-arg' . $control_id . ''); ?>>
                                            <?php echo $settings['tp_' . $control_id . '_text']; ?>
                                            <svg width="22" height="10" viewBox="0 0 22 10" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path d="M1 5.00012H20.1997" stroke="currentcolor" stroke-width="1.5"
                                                    stroke-linecap="round" stroke-linejoin="round" />
                                                <path d="M17 1L20.9999 4.99993L17 8.99987" stroke="currentcolor" stroke-width="1.5"
                                                    stroke-linecap="round" stroke-linejoin="round" />
                                            </svg>
                                        </a>
                                    <?php endif; ?>


                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="tp-hero-2__exp-brand-wrap">
                        <?php if (!empty($settings['tp_brand_title'])): ?>
                            <span class="tp-hero-2__exp-brand-title tp-el-brand-title">
                                <?php echo tp_kses($settings['tp_brand_title']); ?>
                            </span>
                        <?php endif; ?>

                        <div class="row row-cols-lg-4 row-cols-md-2 ">
                            <?php foreach ($settings['tp_brand_slides'] as $item):
                                if (!empty($item['tp_brand_image']['url'])) {
                                    $tp_brand_image_url = !empty($item['tp_brand_image']['id']) ? wp_get_attachment_image_url($item['tp_brand_image']['id'], $settings['brand_size']) : $item['tp_brand_image']['url'];
                                    $tp_brand_image_alt = get_post_meta($item["tp_brand_image"]["id"], "_wp_attachment_image_alt", true);
                                }

                                // Link
                                if ('2' == $item['tp_brand_urls']) {
                                    $link = get_permalink($item['tp_brand_urls']);
                                    $target = '_self';
                                    $rel = 'nofollow';
                                } else {
                                    $link = !empty($item['tp_brand_urls']['url']) ? $item['tp_brand_urls']['url'] : '';
                                    $target = !empty($item['tp_brand_urls']['is_external']) ? '_blank' : '';
                                    $rel = !empty($item['tp_brand_urls']['nofollow']) ? 'nofollow' : '';
                                }
                                $attrs = array(
                                    'href' => $link,
                                    'target' => $target,
                                    'rel' => $rel,
                                );
                                ?>
                                <div class="col-xl mb-10">
                                    <div class="tp-hero-2__exp-brand tp-el-brand-item">
                                        <?php if (!empty($item['tp_brand_url'])): ?>
                                            <a <?php echo tp_implode_html_attributes($attrs); ?>>
                                                <img src="<?php echo esc_url($tp_brand_image_url); ?>"
                                                    alt="<?php echo esc_url($tp_brand_image_alt); ?>">
                                            </a>

                                        <?php else: ?>
                                            <img src="<?php echo esc_url($tp_brand_image_url); ?>"
                                                alt="<?php echo esc_url($tp_brand_image_alt); ?>">
                                        <?php endif; ?>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>

                    </div>
                </div>
            </div>

        <?php endif; ?>

        <?php
    }
}

$widgets_manager->register(new TP_About_Full());
