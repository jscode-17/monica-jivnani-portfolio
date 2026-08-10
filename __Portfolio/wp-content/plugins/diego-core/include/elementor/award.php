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
class TP_Award extends Widget_Base
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
        return 'tp-award';
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
        return __('Award List', 'tpcore');
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

        // Service group
        $this->start_controls_section(
            'tp_services',
            [
                'label' => esc_html__('Award List', 'tpcore'),
                'description' => esc_html__('Control all the style settings from Style tab', 'tpcore'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );


        $this->add_control(
            'tp_image',
            [
                'label' => esc_html__('Upload Shape Image', 'tpcore'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );


        $this->add_control(
            'enable_style_2',
            [
                'label' => esc_html__('Enable Style 2 ?', 'tpcore'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'tpcore'),
                'label_off' => esc_html__('Hide', 'tpcore'),
                'return_value' => 'yes',
                'default' => 'no',
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
            'tp_service_description',
            [
                'label' => esc_html__('Description', 'tpcore'),
                'description' => tp_get_allowed_html_desc('intermediate'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => 'Future 2024',
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
            'tp_services_btn_text',
            [
                'label' => esc_html__('Button Text', 'tpcore'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Button Text', 'tpcore'),
                'title' => esc_html__('Enter button text', 'tpcore'),
                'label_block' => true,
                'condition' => [
                    'tp_services_link_switcher' => 'yes',
                ],
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
                'label' => esc_html__('Service Link link', 'tpcore'),
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


        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'thumbnail', // // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `thumbnail_size` and `thumbnail_custom_dimension`.
                'exclude' => ['custom'],
                // 'default' => 'tp-post-thumb',
            ]
        );
        $this->end_controls_section();

        $this->tp_common_animation(null, 'desc_title', 'Animation - Title');
        $this->tp_common_animation(null, 'desc_animation', 'Animation - Description');

    }

    // style_tab_content
    protected function style_tab_content()
    {

        $this->tp_section_style_controls('fact_section', 'Section - Style', '.tp-el-section');
        $this->tp_basic_style_controls('about_subtitle', 'Section - Subtitle', '.tp-el-subtitle');
        $this->tp_basic_style_controls('about_title', 'Section - Title', '.tp-el-title');
        $this->tp_basic_style_controls('about_description', 'Section - Description', '.tp-el-content p');

        $this->tp_section_style_controls('services_section_box', 'Award - Box - Style', '.tp-el-box');
        $this->tp_basic_style_controls('services_box_title', 'Award - Box - Title', '.tp-el-box-title');
        $this->tp_basic_style_controls('services_box_description', 'Award - Box - Description', '.tp-el-box-desc');
        $this->tp_link_controls_style('services_box_link_btn', 'Award - Box - Button', '.tp-el-box-btn');
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
            $this->add_render_attribute('title_args', 'class', 'section__title-4 tp-el-title ' .
                $this->tp_common_animation_get($settings, 'desc_title'));
            ?>


        <?php else:
            $this->add_render_attribute('title_args', 'class', 'tp-section-title tp-el-title ' .
                $this->tp_common_animation_get($settings, 'desc_title'));
            $bloginfo = get_bloginfo('name');

            $style2 = ($settings['enable_style_2'] == 'yes') ? 'tp-award-area tp-award-customize black-bg-3 pb-50 pt-120 tp-el-section' : 'tp-award-area pt-120 pb-120 tp-bg-light p-relative tp-el-section';

            if (!empty($settings['tp_image']['url'])) {
                $tp_image = !empty($settings['tp_image']['id']) ? wp_get_attachment_image_url($settings['tp_image']['id'], $settings['thumbnail_size']) : $settings['tp_image']['url'];
                $tp_image_alt = get_post_meta($settings["tp_image"]["id"], "_wp_attachment_image_alt", true);
            }
            ?>

            <!-- award area start -->
            <section class="<?php echo esc_attr($style2); ?>">
                <div class="container">
                    <div class="tp-award-inner p-relative pb-80">
                        <?php if (!($settings['enable_style_2'] == 'yes')): ?>
                            <span class="tp-award-bottom-border"></span>
                        <?php endif; ?>
                        <div class="row">
                            <div class="col-xl-5">
                                <div class="tp-award-wrapper">
                                    <?php if (!empty($settings['tp_award_section_title_show'])): ?>
                                        <div class="tp-section-title-wrapper mb-30 p-relative z-index-1">
                                            <div
                                                class="tp-section-title-inner <?php echo esc_attr($this->tp_common_animation_get($settings, 'desc_animation')) ?> p-relative tp-el-desc">

                                                <?php if (!empty($settings['tp_award_sub_title'])): ?>
                                                    <span
                                                        class="tp-section-subtitle tp-award-subtitle tp-el-subtitle"><?php echo tp_kses($settings['tp_award_sub_title']); ?></span>
                                                <?php endif; ?>

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
                                                    <p><?php echo tp_kses($settings['tp_award_description']); ?></p>
                                                <?php endif; ?>
                                            </div>

                                            <?php if (!empty($tp_image)): ?>
                                                <div class="tp-award-shape-wrapper">
                                                    <img class="tp-award-shape-1" data-speed="1" data-lag="0.1"
                                                        src="<?php echo esc_url($tp_image); ?>"
                                                        alt="<?php echo esc_attr($tp_image_alt); ?>">
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    <?php endif; ?>


                                </div>
                            </div>
                            <div class="col-xl-7">
                                <div class="tp-award-item-wrapper pt-35 pl-70 p-relative z-index-1">
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
                                        <div class="tp-award-item p-relative tp-hover-reveal-item tp-el-box">
                                            <?php if ($item['tp_services_link_switcher'] == 'yes'): ?>
                                                <a <?php echo tp_implode_html_attributes($attrs); ?> class="d-block">
                                                <?php endif; ?>
                                                <div
                                                    class="tp-award-item-inner d-flex align-items-center justify-content-between flex-wrap">
                                                    <div class="tp-award-arrow">
                                                        <svg width="16" height="15" viewBox="0 0 16 15" fill="none"
                                                            xmlns="http://www.w3.org/2000/svg">
                                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                                d="M14.9549 6.36738L16 7.4283L14.9552 8.49026L8.68634 14.8572L7.64153 13.7959L13.2459 8.10313H1.47758H0.738881H0V0H1.47758V6.60227H13.0966L7.64155 1.06134L8.68637 6.22918e-05L14.9549 6.36738Z"
                                                                fill="currentColor" />
                                                        </svg>
                                                    </div>
                                                    <div class="tp-award-content">
                                                        <?php if (!empty($item['tp_service_title'])): ?>
                                                            <h3 class="tp-award-title tp-el-box-title">
                                                                <?php echo tp_kses($item['tp_service_title']); ?></h3>
                                                        <?php endif; ?>

                                                        <?php if (!empty($item['tp_service_description'])): ?>
                                                            <p class="tp-el-box-desc">
                                                                <?php echo tp_kses($item['tp_service_description']); ?></p>
                                                        <?php endif; ?>
                                                    </div>

                                                    <?php if ($item['tp_services_link_switcher'] == 'yes'): ?>
                                                        <div class="tp-award-btn-wrapper">
                                                            <span class="tp-award-btn tp-el-box-btn">
                                                                <span>
                                                                    <svg width="13" height="13" viewBox="0 0 13 13" fill="none"
                                                                        xmlns="http://www.w3.org/2000/svg">
                                                                        <path d="M12 1L1 12" stroke="currentColor" stroke-width="1.5"
                                                                            stroke-linecap="round" stroke-linejoin="round" />
                                                                        <path d="M3.18762 1.01897L11.9991 1L11.9809 9.81215"
                                                                            stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                                                            stroke-linejoin="round" />
                                                                    </svg>
                                                                    <svg width="13" height="13" viewBox="0 0 13 13" fill="none"
                                                                        xmlns="http://www.w3.org/2000/svg">
                                                                        <path d="M12 1L1 12" stroke="currentColor" stroke-width="1.5"
                                                                            stroke-linecap="round" stroke-linejoin="round" />
                                                                        <path d="M3.18762 1.01897L11.9991 1L11.9809 9.81215"
                                                                            stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                                                            stroke-linejoin="round" />
                                                                    </svg>
                                                                </span>
                                                            </span>
                                                        </div>
                                                    <?php endif; ?>

                                                </div>
                                                <?php if ($item['tp_services_link_switcher'] == 'yes'): ?>
                                                </a>
                                            <?php endif; ?>
                                            <div class="tp-hover-reveal-bg"
                                                data-background="<?php echo esc_url($tp_services_image); ?>"></div>
                                            <span class="tp-award-inner-border"></span>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- award area end -->

        <?php endif; ?>

        <?php
    }
}

$widgets_manager->register(new TP_Award());