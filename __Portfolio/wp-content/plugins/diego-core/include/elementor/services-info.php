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
class TP_Services_Info extends Widget_Base
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
        return 'services-info';
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
        return __('Services Info', 'tpcore');
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
            'tp_services_desc_sec',
            [
                'label' => esc_html__('Services Description', 'tpcore'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'tp_design_style' => 'layout-2'
                ]
            ]
        );

        $this->add_control(
            'tp_services_desc',
            [
                'label' => esc_html__('Description', 'tpcore'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'rows' => 10,
                'default' => esc_html__('Refined branding and web design ', 'tpcore'),
                'placeholder' => esc_html__('Placeholder Text', 'tpcore'),
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
                'condition' => [
                    'tp_design_style' => 'layout-1'
                ]
            ]
        );

        $this->add_control(
            'tp_services_subtitle',
            [
                'label' => esc_html__('Subtitle', 'tpcore'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'rows' => 10,
                'default' => esc_html__('Design', 'tpcore'),
                'placeholder' => esc_html__('Your Text', 'tpcore'),
                'label_block' => true
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


        $this->tp_common_animation(null, 'desc_title', 'Animation - Title');

    }

    // style_tab_content
    protected function style_tab_content()
    {
        $this->tp_section_style_controls('services_section', 'Section - Style', '.tp-el-section');
        $this->tp_basic_style_controls('services_title', 'Section - Title', '.tp-el-title');

        $this->tp_section_style_controls('services_section_box', 'Services - Box - Style', '.tp-el-box');
        $this->tp_basic_style_controls('services_box_title', 'Services - Box - Title', '.tp-el-box-title');
        $this->tp_icon_style('services_box_icon', 'Services - Icon/Image/SVG', '.tp-el-box-icon');
        $this->tp_link_controls_style('services_box_link_btn', 'Services - Box - Button', '.tp-el-box-link span');
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

            <div class="sv-inner__info-area tp-el-section">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-xl-9">
                            <?php if (!empty($settings['tp_services_desc'])): ?>
                                <div class="sv-inner__info-title-box mb-90 tp-el-box">
                                    <h4
                                        class="sv-inner__info-title <?php echo esc_attr($this->tp_common_animation_get($settings, 'desc_title')); ?> tp-el-title">
                                        <?php echo tp_kses($settings['tp_services_desc']); ?>
                                    </h4>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>

        <?php else:
            $this->add_render_attribute('title_args', 'class', 'tp-section-title-3 tp-el-title ' .
                $this->tp_common_animation_get($settings, 'desc_title'));
            $bloginfo = get_bloginfo('name');

            ?>

            <!-- service info area start -->
            <div class="sv-inner__info-area tp-el-section">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-xl-9">
                            <div class="row">
                                <?php if (!empty($settings['tp_services_subtitle'])): ?>
                                    <div class="col-xl-4">
                                        <div class="sv-inner__info-service">
                                            <h4 class="sv-inner__left-title tp-el-title">
                                                <span>
                                                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M8 0L9.69705 6.30295L16 8L9.69705 9.69705L8 16L6.30295 9.69705L0 8L6.30295 6.30295L8 0Z"
                                                            fill="currentcolor" />
                                                    </svg>
                                                </span>
                                                <?php echo tp_kses($settings['tp_services_subtitle']); ?>
                                            </h4>
                                        </div>
                                    </div>
                                <?php endif; ?>
                                <div class="col-xl-8">
                                    <div class="sv-inner__service-category-wrap">

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
                                            ?>
                                            <div class="sv-inner__service-category tp-el-box">
                                                <?php if ($item['tp_services_link_switcher'] == 'yes'): ?>
                                                    <a class="d-flex align-items-center justify-content-between"
                                                        href="<?php echo esc_url($link); ?>" target="<?php echo esc_attr($target); ?>"
                                                        rel="<?php echo esc_attr($rel); ?>">
                                                    <?php endif; ?>
                                                    <div class="sv-inner__service-category-content">
                                                        <?php if ($item['tp_box_icon_type'] == 'icon'): ?>
                                                            <?php if (!empty($item['tp_box_icon']) || !empty($item['tp_box_selected_icon']['value'])): ?>
                                                                <span
                                                                    class="tp-el-box-icon"><?php tp_render_icon($item, 'tp_box_icon', 'tp_box_selected_icon'); ?></span>
                                                            <?php endif; ?>
                                                        <?php elseif ($item['tp_box_icon_type'] == 'image'): ?>
                                                            <span class="tp-el-box-icon">
                                                                <?php if (!empty($item['tp_box_icon_image']['url'])): ?>
                                                                    <img src="<?php echo $item['tp_box_icon_image']['url']; ?>"
                                                                        alt="<?php echo get_post_meta(attachment_url_to_postid($item['tp_box_icon_image']['url']), '_wp_attachment_image_alt', true); ?>">
                                                                <?php endif; ?>
                                                            </span>
                                                        <?php else: ?>
                                                            <span class="tp-el-box-icon">
                                                                <?php if (!empty($item['tp_box_icon_svg'])): ?>
                                                                    <?php echo $item['tp_box_icon_svg']; ?>
                                                                <?php endif; ?>
                                                            </span>
                                                        <?php endif; ?>
                                                        <span
                                                            class="tp-el-box-title"><?php echo tp_kses($item['tp_service_title']); ?></span>
                                                    </div>

                                                    <?php if ($item['tp_services_link_switcher'] == 'yes'): ?>
                                                        <div class="sv-inner__service-category-link tp-el-box-link">
                                                            <span>
                                                                <svg width="12" height="12" viewBox="0 0 12 12" fill="none"
                                                                    xmlns="http://www.w3.org/2000/svg">
                                                                    <path d="M1 11L11 1" stroke="currentcolor" stroke-width="1.5"
                                                                        stroke-linecap="round" stroke-linejoin="round" />
                                                                    <path d="M1 1H11V11" stroke="currentcolor" stroke-width="1.5"
                                                                        stroke-linecap="round" stroke-linejoin="round" />
                                                                </svg>
                                                            </span>
                                                        </div>
                                                    <?php endif; ?>

                                                    <?php if ($item['tp_services_link_switcher'] == 'yes'): ?>
                                                    </a>
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
            <!-- service info area end -->

        <?php endif; ?>

        <?php
    }
}

$widgets_manager->register(new TP_Services_Info());