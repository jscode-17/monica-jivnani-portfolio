<?php
namespace TPCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Repeater;
use \Elementor\Utils;
use \Elementor\Group_Control_Box_Shadow;
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
class TP_Services_List extends Widget_Base
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
        return 'services-list';
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
        return __('Services List', 'tpcore');
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

        $this->tp_section_title_render_controls('services', 'Section Title');




        $this->start_controls_section(
            'tp_services_list_sec',
            [
                'label' => esc_html__('Shape Thumbnail', 'tpcore'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'tp_services_list_shape_thumb',
            [
                'label' => esc_html__('Upload Thumbnail', 'tpcore'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
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

        // Service group
        $this->start_controls_section(
            'tp_services',
            [
                'label' => esc_html__('Services List', 'tpcore'),
                'description' => esc_html__('Control all the style settings from Style tab', 'tpcore'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'tp_services_shape_switch',
            [
                'label' => esc_html__('Enable Shape?', 'tpcore'),
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
                'default' => 'image',
                'options' => [
                    'image' => esc_html__('Image', 'tpcore'),
                    'icon' => esc_html__('Icon', 'tpcore'),
                    'svg' => esc_html__('SVG', 'tpcore'),
                ],
                'condition' => [
                    'repeater_condition' => ['style_1', 'style_2'],
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
                    'repeater_condition' => ['style_1', 'style_2'],
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
                    'repeater_condition' => ['style_1', 'style_2'],
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
                        'repeater_condition' => ['style_1', 'style_2'],
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
                        'repeater_condition' => ['style_1', 'style_2'],
                    ]
                ]
            );
        }


        $repeater->add_control(
            'tp_service_title',
            [
                'label' => esc_html__('Title', 'tpcore'),
                'description' => tp_get_allowed_html_desc('basic'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Service Title', 'tpcore'),
                'label_block' => true,
            ]
        );


        $repeater->add_control(
            'tp_service_tag1',
            [
                'label' => esc_html__('Tag 1', 'tpcore'),
                'description' => tp_get_allowed_html_desc('basic'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('UI/UX Design', 'tpcore'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'tp_service_tag2',
            [
                'label' => esc_html__('Tag 2', 'tpcore'),
                'description' => tp_get_allowed_html_desc('basic'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Web Development', 'tpcore'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'tp_service_description',
            [
                'label' => esc_html__('Description', 'tpcore'),
                'description' => tp_get_allowed_html_desc('intermediate'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered.',
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'tp_services_link_switcher',
            [
                'label' => esc_html__('Add Services link', 'tpcore'),
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
                'label' => esc_html__('Service Link Type', 'tpcore'),
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
                'label' => esc_html__('Service Link', 'tpcore'),
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
                'label' => esc_html__('Select Service Link Page', 'tpcore'),
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
                        'tp_service_title' => esc_html__('Business Stratagy', 'tpcore'),
                    ],
                    [
                        'tp_service_title' => esc_html__('Website Development', 'tpcore')
                    ],
                    [
                        'tp_service_title' => esc_html__('Marketing & Reporting', 'tpcore')
                    ]
                ],
                'title_field' => '{{{ tp_service_title }}}',
            ]
        );
        $this->add_responsive_control(
            'tp_service_align',
            [
                'label' => esc_html__('Alignment', 'tpcore'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'text-left' => [
                        'title' => esc_html__('Left', 'tpcore'),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'text-center' => [
                        'title' => esc_html__('Center', 'tpcore'),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'text-right' => [
                        'title' => esc_html__('Right', 'tpcore'),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'toggle' => true,
                'separator' => 'before',
            ]
        );


        $this->end_controls_section();

        $this->tp_button_render_controls('tpbtn', 'Button', ['layout-1']);


        $this->tp_common_animation(null, 'desc_title', 'Animation - Title');
        $this->tp_common_animation(null, 'desc_animation', 'Animation - Description');

    }

    // style_tab_content
    protected function style_tab_content()
    {

        $this->tp_section_style_controls('services_list_section', 'Section - Style', '.tp-el-section');
        $this->tp_basic_style_controls('services_list_subtitle', 'Section - Subtitle', '.tp-el-subtitle');
        $this->tp_basic_style_controls('services_list_title', 'Section - Title', '.tp-el-title');
        $this->tp_basic_style_controls('services_list_desc', 'Section - Description', '.tp-el-content p');
        $this->tp_link_controls_style('services_list_btn', 'Section - Button', '.tp-el-services-btn');

        $this->tp_section_style_controls('services_list_section_box', 'Services - Style', '.tp-el-box');
        $this->start_controls_section(
            'tp_services_list_box_shadow_sec',
            [
                'label' => esc_html__('Services - Box Shadow', 'tp-core'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );


        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'tp_services_list_box_shadow',
                'label' => esc_html__('Box Shadow', 'tp-core'),
                'selector' => '{{WRAPPER}} .tp-el-box',
            ]
        );

        $this->end_controls_section();
        $this->tp_basic_style_controls('services_list_box_title', 'Services - Title', '.tp-el-box-title');
        $this->tp_basic_style_controls('services_list_box_description', 'Services - Description', '.tp-el-box-desc');
        $this->tp_link_controls_style('services_list_box_link_btn', 'Services - Tag', '.tp-el-tag span');
        $this->tp_icon_style('services_list_icon', 'Services - Icon', '.tp-el-icon span');



        $this->start_controls_section(
            'tp_ervices_list_styling',
            [
                'label' => esc_html__('Shape Background', 'tp-core'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );


        $this->add_control(
            'tp_ervices_list_bg_color',
            [
                'label' => esc_html__('Background Color', 'tp-core'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tp-el-svg-bg svg' => 'color: {{VALUE}} !important;',
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
            $this->add_render_attribute('title_args', 'class', 'section__title-4 tp-el-title');
            ?>


        <?php else:
            $this->add_render_attribute('title_args', 'class', 'tp-section-title-3 tp-el-title ' .
                $this->tp_common_animation_get($settings, 'desc_title'));
            $bloginfo = get_bloginfo('name');
            $this->tp_link_controls_render('tpbtn', 'tp-el-services-btn', $this->get_settings());


            if (!empty($settings['tp_services_list_shape_thumb']['url'])) {
                $tp_services_list_shape_thumb = !empty($settings['tp_services_list_shape_thumb']['id']) ? wp_get_attachment_image_url($settings['tp_services_list_shape_thumb']['id'], $settings['thumbnail_size']) : $settings['tp_services_list_shape_thumb']['url'];
                $tp_services_list_shape_thumb_alt = get_post_meta($settings["tp_services_list_shape_thumb"]["id"], "_wp_attachment_image_alt", true);
            }

            ?>

            <!-- service area start -->
            <div
                class="tp-service-3__area services-panel-area tp-service-3__overlay-bg black-bg-2 pt-150 pb-125 z-index-1 tp-el-section">


                <div class="tp-service-3__circle-img">
                    <?php if (!empty($tp_services_list_shape_thumb)): ?>
                        <span class="text-img">
                            <img src="<?php echo esc_url($tp_services_list_shape_thumb); ?>" alt="<?php echo esc_attr($bloginfo); ?>">
                        </span>
                    <?php endif; ?>

                    <?php if ($settings['tp_services_shape_switch'] == 'yes'): ?>
                        <div class="shape tp-el-svg-bg">
                            <svg width="260" height="70" viewBox="0 0 260 70" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M68.7285 34.1352C48.3941 10.6976 13.8796 0.514191 0 0.514191C93.4783 0.514191 276.081 -0.642708 258.863 0.514191C236.79 1.99739 217.224 6.94161 191.137 34.1352C140.468 93.9609 98.3272 68.2507 68.7285 34.1352Z"
                                    fill="currentcolor" />
                            </svg>
                        </div>
                    <?php endif; ?>
                </div>

                <?php if ($settings['tp_services_shape_switch'] == 'yes'): ?>
                    <div class="tp-service-3__shape-1">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/img/portfolio/shape-1.png"
                            alt="<?php echo esc_attr($bloginfo); ?>">
                    </div>
                    <div class="tp-service-3__shape-2 d-none d-lg-block">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/img/portfolio/shape-2.png"
                            alt="<?php echo esc_attr($bloginfo); ?>">
                    </div>
                    <div class="tp-service-3__shape-3">
                        <img data-speed="1.2" src="<?php echo get_template_directory_uri(); ?>/assets/img/portfolio/star.png"
                            alt="<?php echo esc_attr($bloginfo); ?>">
                    </div>
                <?php endif; ?>

                <div class="container">
                    <div class="row">
                        <?php if (!empty($settings['tp_services_section_title_show'])): ?>
                            <div class="col-xl-5 col-lg-5">
                                <div class="tp-service-3__title-box services-panel-pin tp-el-content">

                                    <?php if (!empty($settings['tp_services_sub_title'])): ?>
                                        <span
                                            class="tp-section-subtitle-3 <?php echo esc_attr($this->tp_common_animation_get($settings, 'desc_animation')) ?> tp-el-subtitle"><?php echo tp_kses($settings['tp_services_sub_title']); ?></span>
                                    <?php endif; ?>

                                    <?php
                                    if (!empty($settings['tp_services_title'])):
                                        printf(
                                            '<%1$s %2$s>%3$s</%1$s>',
                                            tag_escape($settings['tp_services_title_tag']),
                                            $this->get_render_attribute_string('title_args'),
                                            tp_kses($settings['tp_services_title'])
                                        );
                                    endif;
                                    ?>

                                    <?php if (!empty($settings['tp_services_description'])): ?>
                                        <p class="<?php echo esc_attr($this->tp_common_animation_get($settings, 'desc_animation')) ?>">
                                            <?php echo tp_kses($settings['tp_services_description']); ?>
                                        </p>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php endif; ?>
                        <div class="col-xl-7 col-lg-7">
                            <div class="tp-service-3__right-wrap">

                                <?php foreach ($settings['tp_service_list'] as $key => $item):
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
                                    <div class="tp-service-3__item d-flex align-items-start mb-25 services-panel tp-el-box">
                                        <div class="tp-service-3__icon tp-el-icon">
                                            <?php if ($item['tp_box_icon_type'] == 'icon'): ?>
                                                <?php if (!empty($item['tp_box_icon']) || !empty($item['tp_box_selected_icon']['value'])): ?>
                                                    <span><?php tp_render_icon($item, 'tp_box_icon', 'tp_box_selected_icon'); ?></span>
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
                                        </div>
                                        <div class="tp-service-3__content">
                                            <?php if (!empty($item['tp_service_title'])): ?>
                                                <h3 class="tp-service-3__content-title tp-el-box-title">
                                                    <?php if ($item['tp_services_link_switcher'] == 'yes'): ?>
                                                        <a <?php echo tp_implode_html_attributes($attrs); ?>><?php echo tp_kses($item['tp_service_title']); ?></a>
                                                    <?php else: ?>
                                                        <?php echo tp_kses($item['tp_service_title']); ?>
                                                    <?php endif; ?>
                                                </h3>
                                            <?php endif; ?>

                                            <?php if (!empty($item['tp_service_description'])): ?>
                                                <p class="tp-el-box-desc"><?php echo tp_kses($item['tp_service_description']); ?></p>
                                            <?php endif; ?>

                                            <?php if (!empty($item['tp_service_tag1']) || !empty($item['tp_service_tag2'])): ?>
                                                <div class="tp-service-3__content-tag tp-el-tag">
                                                    <?php if (!empty($item['tp_service_tag1'])): ?>
                                                        <span class="mr-5"><?php echo tp_kses($item['tp_service_tag1']); ?></span>
                                                    <?php endif; ?>

                                                    <?php if (!empty($item['tp_service_tag2'])): ?>
                                                        <span><?php echo tp_kses($item['tp_service_tag2']); ?></span>
                                                    <?php endif; ?>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                <?php endforeach; ?>

                                <?php if (!empty($settings['tp_' . $control_id . '_text']) && $settings['tp_' . $control_id . '_button_show'] == 'yes'): ?>
                                    <div class="tp-service-3__btn-box">
                                        <a <?php echo $this->get_render_attribute_string('tp-button-arg' . $control_id . ''); ?>>
                                            <?php echo $settings['tp_' . $control_id . '_text']; ?>
                                        </a>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- service area end -->

        <?php endif; ?>

        <?php
    }
}

$widgets_manager->register(new TP_Services_List());