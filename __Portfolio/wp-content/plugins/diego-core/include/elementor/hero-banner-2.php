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

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

/**
 * Tp Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class TP_Hero_Banner_2 extends Widget_Base
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
        return 'hero-banner-2';
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
        return __('Hero Banner 2', 'tp-core');
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
                    'layout-2' => esc_html__('Layout 2', 'tp-core'),
                ],
                'default' => 'layout-1',
            ]
        );

        $this->end_controls_section();


        $this->start_controls_section(
            'hero_content_sec',
            [
                'label' => esc_html__('Hero Content', 'tpcore'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );


        $this->add_control(
            'tp_slider_title',
            [
                'label' => esc_html__('Title', 'tpcore'),
                'description' => tp_get_allowed_html_desc('intermediate'),
                'type' => Controls_Manager::TEXTAREA,
                'default' => esc_html__('Grow business.', 'tpcore'),
                'placeholder' => esc_html__('Type Heading Text', 'tpcore'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'tp_slider_desc',
            [
                'label' => esc_html__('Descriptions', 'tpcore'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'rows' => 10,
                'default' => esc_html__('A Creative Fashion Designer', 'tpcore'),
                'placeholder' => esc_html__('Your Text', 'tpcore'),
            ]
        );

        $this->add_control(
            'tp_slider_short_desc',
            [
                'label' => esc_html__('Short Description', 'tpcore'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'rows' => 10,
                'default' => esc_html__('I fell in love ', 'tpcore'),
                'placeholder' => esc_html__('Your Text', 'tpcore'),
                'condition' => ['tp_design_style' => 'layout-2']
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


        $this->end_controls_section();


        // _tp_image
        $this->start_controls_section(
            '_tp_image_section',
            [
                'label' => esc_html__('Thumbnail Image', 'tp-core'),
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
            'tp_image_2',
            [
                'label' => esc_html__('Choose Image 2', 'tp-core'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
                'condition' => ['tp_design_style' => 'layout-2']
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

        $this->tp_button_render_controls('tpbtn', 'Button', ['layout-2']);

        $this->start_controls_section(
            'tp_social_section',
            [
                'label' => __('Social Links', 'tpcore'),
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
            'tp_social_link',
            [
                'label' => esc_html__('Social Link', 'tpcore'),
                'type' => \Elementor\Controls_Manager::URL,
                'default' => [
                    'url' => '#',
                    'is_external' => true,
                    'nofollow' => true,
                    'custom_attributes' => '',
                ],
                'placeholder' => esc_html__('Your Link Here', 'tpcore'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'want_customize',
            [
                'label' => esc_html__('Want To Customize?', 'tpcore'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'tpcore'),
                'label_off' => esc_html__('No', 'tpcore'),
                'return_value' => 'yes',
                'description' => esc_html__('You can customize this item from here or customize from Style tab', 'tpcore'),
                'style_transfer' => true,
            ]
        );


        $repeater->add_control(
            'services_capsule_bg',
            [
                'label' => esc_html__('Hover BG Color', 'tpcore'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}}:hover' => 'background-color: {{VALUE}}; border-color: {{VALUE}}'
                ],
                'default' => '#fff',
                'condition' => ['want_customize' => 'yes'],
            ]
        );

        $this->add_control(
            'tp_social_list',
            [
                'label' => esc_html__('Social List', 'tpcore'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'tp_social_link_text' => esc_html__('Social 1', 'tpcore'),
                    ],
                    [
                        'tp_social_link_text' => esc_html__('Social 2', 'tpcore'),
                    ],
                    [
                        'tp_social_link_text' => esc_html__('Social 3', 'tpcore'),
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
    protected function style_tab_content()
    {
        $this->tp_section_style_controls('about_section', 'Section - Style', '.tp-el-section');
        $this->tp_basic_style_controls('about_title', 'Section - Title', '.tp-el-title');
        $this->tp_basic_style_controls('about_desc', 'Section - Description', '.tp-el-content p');
        $this->tp_link_controls_style('services_box_link_btn', 'Section - Button', '.tp-el-btn');
        $this->tp_link_controls_style('services_box_social_btn', 'Section - Social', '.tp-el-social-btn a');

        $this->tp_basic_style_controls('photo_title', 'Photographer - Title', '.tp-el-photographer-title-1');
        $this->tp_basic_style_controls('photo_title_2', 'Photographer - Title (Middle)', '.tp-el-photographer-title-2 span');


        $this->start_controls_section(
            'tp_short_desc_styling',
            [
                'label' => esc_html__('Fashion Short Description', 'tp-core'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_TPGradient::get_type(),
            [
                'name' => 'tp_short_desc_advs',
                'label' => esc_html__('Color', 'tp-core'),
                'selector' => '{{WRAPPER}}  .tp-el-short-desc p',
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'tp_short_desc_typography',
                'label' => esc_html__('Typography', 'tp-core'),
                'selector' => '{{WRAPPER}} .tp-el-short-desc p',
            ]
        );

        $this->add_control(
            'tp_short_desc_btn_normal_border_color',
            [
                'label' => esc_html__('Background Color', 'tp-core'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tp-el-short-desc::after' => 'background-color: {{VALUE}} !important;;',
                ],
            ]

        );


        $this->add_responsive_control(
            'tp_short_desc_padding',
            [
                'label' => esc_html__('Padding', 'tp-core'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .tp-el-short-desc' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' => 'before',
            ]
        );
        $this->add_responsive_control(
            'tp_short_desc_margin',
            [
                'label' => esc_html__('Margin', 'tp-core'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .tp-el-short-desc' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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

            if (!empty($settings['tp_image']['url'])) {
                $tp_image = !empty($settings['tp_image']['id']) ? wp_get_attachment_image_url($settings['tp_image']['id'], $settings['tp_image_size_size']) : $settings['tp_image']['url'];
                $tp_image_alt = get_post_meta($settings["tp_image"]["id"], "_wp_attachment_image_alt", true);
            }

            if (!empty($settings['tp_image_2']['url'])) {
                $tp_image_2 = !empty($settings['tp_image_2']['id']) ? wp_get_attachment_image_url($settings['tp_image_2']['id'], $settings['tp_image_size_size']) : $settings['tp_image_2']['url'];
                $tp_image_2_alt = get_post_meta($settings["tp_image_2"]["id"], "_wp_attachment_image_alt", true);
            }
            $this->add_render_attribute('title_args', 'class', 'tp-hero-5-title tp-split-in-right tp-el-title ' .
                $this->tp_common_animation_get($settings, 'desc_title'));

            $this->tp_link_controls_render('tpbtn', 'tp-btn-cream-bdr tp-el-btn', $this->get_settings());
            ?>

            <!-- hero area start -->
            <div class="tp-hero-5-area coffe-bg p-relative tp-el-section">
                <div class="container container-1760">
                    <div class="tp-hero-5-bdr-left tp-hero-5-ptb">
                        <div class="row">
                            <div class="col-xxl-3 tp-hero-5-thumb-wrap">
                                <div class="tp-hero-5-thumb-wrap">
                                    <?php if (!empty($settings['tp_slider_short_desc'])): ?>
                                        <div class="tp-hero-5-thumb-content tp-el-short-desc">
                                            <p>
                                                <?php echo tp_kses($settings['tp_slider_short_desc']); ?>
                                            </p>
                                        </div>
                                    <?php endif; ?>
                                    <div class="tp-hero-5-thumb-sm">
                                        <img src="<?php echo esc_url($tp_image_2); ?>"
                                            alt="<?php echo esc_attr($tp_image_2_alt); ?>" data-speed="auto">
                                    </div>
                                </div>
                            </div>
                            <div class="col-xxl-9">
                                <div class="tp-hero-5-title-box z-index-5 mb-120 tp-el-content <?php echo esc_attr($this->tp_common_animation_get($settings, 'desc_animation')) ?>">
                                    <?php
                                    if (!empty($settings['tp_slider_title'])):
                                        printf(
                                            '<%1$s %2$s>%3$s</%1$s>',
                                            tag_escape($settings['tp_slider_title_tag']),
                                            $this->get_render_attribute_string('title_args'),
                                            tp_kses($settings['tp_slider_title'])
                                        );
                                    endif;
                                    ?>

                                    <?php if (!empty($settings['tp_slider_desc'])): ?>
                                        <p class="<?php echo $this->tp_common_animation_get($settings, 'desc_title'); ?> tp-split-in-right">
                                            <?php echo tp_kses($settings['tp_slider_desc']); ?>
                                        </p>
                                    <?php endif; ?>

                                    <!-- button start -->
                                    <?php if (!empty($settings['tp_' . $control_id .'_text']) && $settings['tp_' . $control_id .'_button_show'] == 'yes') : ?>
                                        <a <?php echo $this->get_render_attribute_string( 'tp-button-arg' . $control_id .'' ); ?>>
                                            <?php echo $settings['tp_' . $control_id .'_text']; ?>
                                        </a>
                                    <?php endif; ?>
                                    <!-- button end -->

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tp-hero-5-big-thumb">
                    <img src="<?php echo esc_url($tp_image); ?>" alt="<?php echo esc_attr($tp_image_alt); ?>">
                </div>
            </div>
            <!-- hero area end -->

        <?php else:
            // main img
            if (!empty($settings['tp_image']['url'])) {
                $tp_image = !empty($settings['tp_image']['id']) ? wp_get_attachment_image_url($settings['tp_image']['id'], $settings['tp_image_size_size']) : $settings['tp_image']['url'];
                $tp_image_alt = get_post_meta($settings["tp_image"]["id"], "_wp_attachment_image_alt", true);
            }

            $this->add_render_attribute('title_args', 'class', 'tp-hero-4-title tp-el-title ' .
                $this->tp_common_animation_get($settings, 'desc_title'));
            ?>

            <!-- hero area start -->
            <div class="tp-hero-4-area tp-hero-4-height black-bg-5 tp-hero-4-overlay fix cursor-style tp-el-section">
                <div class="tp-hero-social-wrapper tp-hero-social-wrapper-2 d-none d-xxl-block">
                    <span class="tp-hero-social-bar"></span>
                    <div class="tp-hero-social">

                        <?php foreach ($settings['tp_social_list'] as $key => $item):
                            // Link
                            if ('2' == $item['tp_social_link']) {
                                $link = get_permalink($item['tp_social_link']);
                                $target = '_self';
                                $rel = 'nofollow';
                            } else {
                                $link = !empty($item['tp_social_link']['url']) ? $item['tp_social_link']['url'] : '';
                                $target = !empty($item['tp_social_link']['is_external']) ? '_blank' : '';
                                $rel = !empty($item['tp_social_link']['nofollow']) ? 'nofollow' : '';
                            }
                            $attrs = array(
                                'href' => $link,
                                'target' => $target,
                                'rel' => $rel,
                            );
                            
                            ?>
                            <div class="parallax-wrap">
                                <div class="parallax-element tp-el-social-btn">
                                    <a class="elementor-repeater-item-<?php echo esc_attr($item['_id']); ?>"
                                        <?php echo tp_implode_html_attributes($attrs); ?>>
                                        <?php if ($item['tp_box_icon_type'] == 'icon'): ?>
                                            <?php if (!empty($item['tp_box_icon']) || !empty($item['tp_box_selected_icon']['value'])): ?>
                                                <span>
                                                    <?php tp_render_icon($item, 'tp_box_icon', 'tp_box_selected_icon'); ?>
                                                </span>
                                            <?php endif; ?>
                                        <?php elseif ($item['tp_box_icon_type'] == 'image'): ?>
                                            <span>
                                                <?php if (!empty($item['tp_box_icon_image']['url'])): ?>
                                                    <img src="<?php echo $item['tp_box_icon_image']['url']; ?>"
                                                        alt="<?php echo get_post_meta(attachment_url_to_postid($item['tp_box_icon_image']['url']), '_wp_attachment_image_alt', true); ?>">
                                                <?php endif; ?>
                                            </span>
                                        <?php else: ?>
                                            <span>
                                                <?php if (!empty($item['tp_box_icon_svg'])): ?>
                                                    <?php echo $item['tp_box_icon_svg']; ?>
                                                <?php endif; ?>
                                            </span>
                                        <?php endif; ?>
                                    </a>
                                </div>
                            </div>
                        <?php endforeach; ?>

                    </div>
                    <span class="tp-hero-social-bar tp-hero-social-bar-2"></span>
                </div>
                <div class="container">
                    <?php if (!empty($tp_image)): ?>
                        <div class="row justify-content-center">
                            <div class="col-xl-10">
                                <div class="tp-hero-4-thumb-wrapper">
                                    <span class="overlay"></span>
                                    <div class="tp-hero-4-thumb text-center" data-lag="0.7" data-speed="auto">
                                        <img src="<?php echo esc_url($tp_image); ?>" alt="<?php echo esc_attr($tp_image_alt); ?>">
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="tp-hero-4-title-box z-index-5 text-center tp-el-photographer-title-1  tp-el-photographer-title-2" data-lag="0.5" data-stagger="0.08">
                                <?php
                                if (!empty($settings['tp_slider_title'])):
                                    printf(
                                        '<%1$s %2$s>%3$s</%1$s>',
                                        tag_escape($settings['tp_slider_title_tag']),
                                        $this->get_render_attribute_string('title_args'),
                                        tp_kses($settings['tp_slider_title'])
                                    );
                                endif;
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- hero area end -->

        <?php endif; ?>

        <?php

    }

}

$widgets_manager->register(new TP_Hero_Banner_2());