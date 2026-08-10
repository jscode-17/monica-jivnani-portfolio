<?php
namespace TPCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Repeater;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Utils;
if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

/**
 * Tp Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class TP_Onepage_Slider extends Widget_Base
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
        return 'onepage-slider';
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
        return __('Onepage Slider', 'tpcore');
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
            '_section_price_tabs',
            [
                'label' => __('Advanced Tabs', 'tpcore'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'copyright_text',
            [
                'label' => esc_html__('Copyright Text', 'tpcore'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Diego All right reserved', 'tpcore'),
                'placeholder' => esc_html__('Placeholder Text', 'tpcore'),
                'label_block' => true
            ]
        );

        $this->add_control(
            'theme_toggle_switch',
            [
                'label' => esc_html__('Show Theme Toggle Switch?', 'textdomain'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'textdomain'),
                'label_off' => esc_html__('Hide', 'textdomain'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'title',
            [
                'type' => Controls_Manager::TEXT,
                'label' => __('Title', 'tpcore'),
                'default' => __('Tab Title', 'tpcore'),
                'placeholder' => __('Type Tab Title', 'tpcore'),
                'label_block' => true,
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );


        $repeater->add_control(
            'template',
            [
                'label' => __('Section Template', 'tpcore'),
                'placeholder' => __('Select a section template for as tab content', 'tpcore'),

                'type' => Controls_Manager::SELECT2,
                'options' => get_elementor_templates()
            ]
        );

        $this->add_control(
            'tabs',
            [
                'show_label' => false,
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'title_field' => '{{title}}',
                'default' => [
                    [
                        'title' => 'Slider 1',
                    ],
                    [
                        'title' => 'Slider 2',
                    ]
                ]
            ]
        );

        $this->end_controls_section();

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
            'tp_social_link_text',
            [
                'label' => esc_html__('Title', 'tpcore'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Social Title', 'tpcore'),
                'placeholder' => esc_html__('Your Text', 'tpcore'),
                'description' => esc_html__('This title only for demo purposes. It will not be visible on your site.', 'tpcore'),
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
            'tp_social_class',
            [
                'label' => esc_html__('Add Custom Class ?', 'tpcore'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('gmail', 'tpcore'),
                'placeholder' => esc_html__('Your Class Text', 'tpcore'),
                'label_block' => true
            ]
        );

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


    }

    // style_tab_content
    protected function style_tab_content()
    {
        $this->tp_section_style_controls('onepage_sec', 'Section - Style', '.tp-el-section');

        $this->tp_basic_style_controls('onepage_copyright', 'Copyright Text', '.tp-el-copyright');
        $this->tp_link_controls_style('hero_banner_social_btn', 'Section - Social', '.tp-el-social-btn a');

        $this->start_controls_section(
            'tp_onepage_slider_bg_sec',
            [
                'label' => esc_html__('Slider Progress Color', 'tp-core'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );


        $this->add_control(
            'tp_onepage_slider_progress_bar',
            [
                'label' => esc_html__('Backgrond Line Color', 'tp-core'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tp-el-scrollbar' => 'background-color: {{VALUE}} !important;',
                ],
            ]
        );


        $this->add_control(
            'tp_onepage_slider_progress_bar_bg',
            [
                'label' => esc_html__('Progressbar', 'tp-core'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tp-el-scrollbar span' => 'background-color: {{VALUE}} !important;',
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

        ?>


        <?php if ($settings['tp_design_style'] == 'layout-2'):
            $this->add_render_attribute('title_args', 'class', 'tp-section-title tp-el-title');
            ?>

        <?php else:
            $this->add_render_attribute('title_args', 'class', 'tp-section-title');
            $bloginfo = get_bloginfo('name');

            if (!empty($settings['background_image']['url'])) {
                $background_image = !empty($settings['background_image']['id']) ? wp_get_attachment_image_url($settings['background_image']['id'], $settings['background_image_size_size']) : $settings['background_image']['url'];
                $background_image_alt = get_post_meta($settings["background_image"]["id"], "_wp_attachment_image_alt", true);
            }
            ?>

            <div class="tp-onepage-slider">

                <div id="pagepiling">
                    <?php foreach ($settings['tabs'] as $key => $tab): ?>
                        <div class="section">
                            <?php echo \Elementor\Plugin::instance()->frontend->get_builder_content($tab['template'], true); ?>
                        </div>
                    <?php endforeach; ?>
                </div>

                <div class="tp-hero-2__area">
                    <div class="tp-hero__slider-wrapper">

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
                                            <a class="<?php echo esc_attr($item['tp_social_class']); ?>" <?php echo tp_implode_html_attributes($attrs); ?>>
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
                                            </a>
                                        </div>
                                    </div>
                                <?php endforeach; ?>

                            </div>
                            <span class="tp-hero-social-bar tp-hero-social-bar-2"></span>
                        </div>
                        <div class="tp-hero-2__bottom-wrap">
                            <div class="tp-hero-2__bottom-content">

                                <span class="tp-hero-2__bottom-copyright tp-el-copyright">
                                    <?php echo tp_kses($settings['copyright_text']); ?>
                                </span>

                                <?php if ($settings['theme_toggle_switch'] == 'yes'): ?>
                                    <div class="tp-hero-2__bottom-theme-toggle">
                                        <div class="tp-theme-toggle tp-theme-toggle-2 parallax-wrap">
                                            <label class="tp-theme-toggle-main themepure-theme-toggle parallax-element" for="this-s">
                                                <span id="tp-theme-toggle-light" class=" tp-theme-toggle-light">
                                                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M8.0448 11.0454C9.70165 11.0454 11.0448 9.7023 11.0448 8.04544C11.0448 6.38859 9.70165 5.04544 8.0448 5.04544C6.38795 5.04544 5.0448 6.38859 5.0448 8.04544C5.0448 9.7023 6.38795 11.0454 8.0448 11.0454Z"
                                                            fill="currentColor" />
                                                        <path d="M8 1.5V2.68182" stroke="currentColor" stroke-width="1.5"
                                                            stroke-linecap="round" stroke-linejoin="round" />
                                                        <path d="M8 13.3182V14.5" stroke="currentColor" stroke-width="1.5"
                                                            stroke-linecap="round" stroke-linejoin="round" />
                                                        <path d="M3.40198 3.40277L4.24107 4.24186" stroke="currentColor"
                                                            stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                                        <path d="M11.7584 11.7581L12.5975 12.5972" stroke="currentColor"
                                                            stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                                        <path d="M1.5 8H2.68182" stroke="currentColor" stroke-width="1.5"
                                                            stroke-linecap="round" stroke-linejoin="round" />
                                                        <path d="M13.3174 8H14.4992" stroke="currentColor" stroke-width="1.5"
                                                            stroke-linecap="round" stroke-linejoin="round" />
                                                        <path d="M3.40198 12.5972L4.24107 11.7581" stroke="currentColor"
                                                            stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                                        <path d="M11.7584 4.24186L12.5975 3.40277" stroke="currentColor"
                                                            stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                                    </svg>
                                                </span>
                                                <input id="this-s" type="checkbox" class="themepure-theme-toggle-input">
                                                <i class="tp-theme-toggle-slide"></i>
                                                <span id="tp-theme-toggle-dark" class="tp-theme-toggle-dark">
                                                    <svg width="12" height="12" viewBox="0 0 12 12" fill="none"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M12 6.54054C11.8949 7.67776 11.4681 8.76152 10.7696 9.66503C10.071 10.5685 9.12957 11.2544 8.05544 11.6424C6.9813 12.0304 5.81888 12.1044 4.70419 11.8559C3.5895 11.6073 2.56866 11.0465 1.7611 10.2389C0.953538 9.43135 0.39267 8.4105 0.144121 7.29581C-0.104428 6.18112 -0.0303768 5.0187 0.357609 3.94457C0.745595 2.87043 1.43147 1.929 2.33497 1.23045C3.23848 0.531888 4.32224 0.105093 5.45946 0C4.79365 0.900756 4.47327 2.01056 4.55656 3.12758C4.63986 4.24459 5.12132 5.2946 5.91336 6.08664C6.7054 6.87869 7.75541 7.36014 8.87242 7.44344C9.98944 7.52673 11.0992 7.20635 12 6.54054Z"
                                                            fill="currentColor" />
                                                    </svg>
                                                </span>
                                            </label>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="pagescroll-indication d-none d-xl-block tp-el-scrollbar">
                    <span></span>
                </div>
            </div>

        <?php endif; ?>

        <?php
    }

}
$widgets_manager->register(new TP_Onepage_Slider());