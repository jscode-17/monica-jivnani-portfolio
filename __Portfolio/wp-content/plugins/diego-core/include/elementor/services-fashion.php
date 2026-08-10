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
class TP_Fashion_Service extends Widget_Base
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
        return 'tp-service-portfolio';
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
        return __('Fashion Services', 'tpcore');
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

        $this->start_controls_section(
            'tp_fashion_services_sec',
            [
                'label' => esc_html__('Section Contents', 'tpcore'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'tp_fashion_left_text',
            [
                'label' => esc_html__('Left Title', 'tpcore'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Services', 'tpcore'),
                'placeholder' => esc_html__('Placeholder Text', 'tpcore'),
                'label_block' => true
            ]
        );

        $this->add_control(
            'tp_fashion_mid_text',
            [
                'label' => esc_html__('Right Title', 'tpcore'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('MY EXTERTISE IN THIS AREA ', 'tpcore'),
                'placeholder' => esc_html__('Placeholder Text', 'tpcore'),
                'label_block' => true
            ]
        );

        $this->end_controls_section();

        $this->tp_button_render_controls('tpbtn', 'Button', ['layout-1']);

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
                'default' => 'Fashion & Life Style',
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
                        'tp_service_title' => esc_html__('Modelling', 'tpcore'),
                    ],
                    [
                        'tp_service_title' => esc_html__('Acting', 'tpcore')
                    ],
                    [
                        'tp_service_title' => esc_html__('Costume', 'tpcore')
                    ],
                    [
                        'tp_service_title' => esc_html__('Artist', 'tpcore')
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
        $this->tp_section_style_controls('services_sectio', 'Section - Style', '.tp-el-section');
        $this->tp_section_style_controls('services_section_box', 'Services - Style', '.tp-el-box');
        $this->tp_section_style_controls('services_section_hover_box', 'Services - Style', '.tp-el-box-hover-bg');
        $this->tp_basic_style_controls('services_box_title', 'Services - Title', '.tp-el-box-title');
        $this->tp_basic_style_controls('services_box_subtitle', 'Services - Subtitle', '.tp-el-box-subtitle');
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

            $this->tp_link_controls_render('tpbtn', 'tp-project-5-section-link tp-el-btn', $this->get_settings());

            ?>

            <!-- project area start -->
            <div class="tp-project-5-area coffe-bg pb-140 z-index-1 tp-el-section">
                <div class="tp-project-5-section-box pb-130 ">
                    <div class="container container-1790">
                        <div class="row">
                            <div class="col-xl-12">
                                <div class="d-flex justify-content-between align-items-center">

                                    <?php if (!empty($settings['tp_fashion_left_text'])): ?>
                                        <span
                                            class="tp-project-5-section-subtitle tp-el-left-text"><?php echo tp_kses($settings['tp_fashion_left_text']); ?></span>
                                    <?php endif; ?>

                                    <?php if (!empty($settings['tp_fashion_left_text'])): ?>
                                        <h4 class="tp-project-5-section-title tp-el-middle-text">
                                            <?php echo tp_kses($settings['tp_fashion_mid_text']); ?>
                                        </h4>
                                    <?php endif; ?>

                                    <?php if (!empty($settings['tp_' . $control_id . '_text']) && $settings['tp_' . $control_id . '_button_show'] == 'yes'): ?>
                                        <a <?php echo $this->get_render_attribute_string('tp-button-arg' . $control_id . ''); ?>>
                                            <?php echo $settings['tp_' . $control_id . '_text']; ?></a>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tp-project-5-wrap p-relative">
                    <div class="row justify-content-center">
                        <div class="col-xl-12">
                            <div class="tp-project-5-title-wrap">

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

                                    $num = $key + 1;

                                    if (!empty($item['tp_services_image']['url'])) {
                                        $tp_services_image = !empty($item['tp_services_image']['id']) ? wp_get_attachment_image_url($item['tp_services_image']['id'], $settings['thumbnail_size']) : $item['tp_services_image']['url'];
                                        $tp_services_image_alt = get_post_meta($item["tp_services_image"]["id"], "_wp_attachment_image_alt", true);
                                    }

                                    if (!empty($item['tp_services_image_2']['url'])) {
                                        $tp_services_image_2 = !empty($item['tp_services_image_2']['id']) ? wp_get_attachment_image_url($item['tp_services_image_2']['id'], $settings['thumbnail_size']) : $item['tp_services_image_2']['url'];
                                        $tp_services_image_2_alt = get_post_meta($item["tp_services_image_2"]["id"], "_wp_attachment_image_alt", true);
                                    }
                                    ?>
                                    <div class="tp-project-5-title-box text-center tp-el-box"
                                        rel="tp-project-5-thumb-box-<?php echo esc_attr($num); ?>">
                                        <div class="tp-project-5-title-box-bg tp-el-box-hover-bg"></div>

                                        <div class="tp-project-5-thumb-box d-flex justify-content-between align-items-end">
                                            <div class="tp-project-5-thumb thumb-1">
                                                <img src="<?php echo esc_url($tp_services_image); ?>"
                                                    alt="<?php echo esc_attr($tp_services_image_alt); ?>">
                                            </div>
                                            <div class="tp-project-5-thumb thumb-2">
                                                <img src="<?php echo esc_url($tp_services_image_2); ?>"
                                                    alt="<?php echo esc_attr($tp_services_image_2_alt); ?>">
                                            </div>
                                        </div>

                                        <h4 class="tp-project-5-title tp-el-box-title">
                                            <?php if ($item['tp_services_link_switcher'] == 'yes'): ?>
                                                <a <?php echo tp_implode_html_attributes($attrs); ?>><?php echo tp_kses($item['tp_service_title']); ?></a>
                                            <?php endif; ?>
                                        </h4>

                                        <?php if (!empty($item['tp_service_description'])): ?>
                                            <span class="tp-el-box-subtitle"><?php echo tp_kses($item['tp_service_description']); ?></span>
                                        <?php endif; ?>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
            <!-- project area end -->

        <?php endif; ?>

        <?php
    }
}

$widgets_manager->register(new TP_Fashion_Service());