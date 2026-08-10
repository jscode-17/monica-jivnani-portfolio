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
class TP_Price extends Widget_Base
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
        return 'tp-price';
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
        return __('Price', 'tpcore');
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

        $this->tp_section_title_render_controls('price', 'Section Title', ['layout-2']);

        $this->start_controls_section(
            'tp_price_sec',
            [
                'label' => esc_html__('Price Section', 'tpcore'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
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
            'tp_price_box_title',
            [
                'label' => esc_html__('Title', 'tpcore'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('1 Month', 'tpcore'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'tp_price_box_subtitle',
            [
                'label' => esc_html__('Subtitle', 'tpcore'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Paid monthly', 'tpcore'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'tp_price_box_offer_text',
            [
                'label' => esc_html__('Offer Text', 'tpcore'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Cancel Anytime', 'tpcore'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'tp_price_box_save_offer',
            [
                'label' => esc_html__('Save Offer Text', 'tpcore'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Save $800', 'tpcore'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'tp_price_box_ammout',
            [
                'label' => esc_html__('Ammount', 'tpcore'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('1300', 'tpcore'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'tp_price_box_period',
            [
                'label' => esc_html__('Period', 'tpcore'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('mo', 'tpcore'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'tp_price_box_message',
            [
                'label' => esc_html__('Free Task', 'tpcore'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('You can order 1 free task', 'tpcore'),
                'label_block' => true,
            ]
        );
        $repeater->add_control(
            'portfolio_link_text',
            [
                'label' => esc_html__('Link Text', 'tpcore'),
                'description' => tp_get_allowed_html_desc('basic'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('View Project', 'tpcore'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'tp_portfolio_link_switcher',
            [
                'label' => esc_html__('Add Price link', 'tpcore'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'tpcore'),
                'label_off' => esc_html__('No', 'tpcore'),
                'return_value' => 'yes',
                'default' => 'yes',
                'separator' => 'before',
            ]
        );
        $repeater->add_control(
            'tp_portfolio_link_type',
            [
                'label' => esc_html__('Price Link Type', 'tpcore'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    '1' => 'Custom Link',
                    '2' => 'Internal Page',
                ],
                'default' => '1',
                'condition' => [
                    'tp_portfolio_link_switcher' => 'yes'
                ]
            ]
        );
        $repeater->add_control(
            'tp_portfolio_link',
            [
                'label' => esc_html__('Price Link', 'tpcore'),
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
                    'tp_portfolio_link_type' => '1',
                    'tp_portfolio_link_switcher' => 'yes',
                ]
            ]
        );
        $repeater->add_control(
            'tp_portfolio_page_link',
            [
                'label' => esc_html__('Select Price Link Page', 'tpcore'),
                'type' => \Elementor\Controls_Manager::SELECT2,
                'label_block' => true,
                'options' => tp_get_all_pages(),
                'condition' => [
                    'tp_portfolio_link_type' => '2',
                    'tp_portfolio_link_switcher' => 'yes',
                ]
            ]
        );
        $this->add_control(
            'tp_price_list',
            [
                'label' => esc_html__('Price List', 'tpcore'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'tp_price_box_title' => esc_html__('1 Month', 'tpcore'),
                    ],
                    [
                        'tp_price_box_title' => esc_html__('3 Month', 'tpcore'),
                    ],
                ],
                'title_field' => '{{{ tp_price_box_title }}}',
            ]
        );


        $this->end_controls_section();


        $this->tp_common_animation(null, 'desc_title', 'Animation - Title');
    }


    // style_tab_content
    protected function style_tab_content()
    {
        $this->tp_section_style_controls('services_section', 'Section - Style', '.tp-el-section');

        $this->tp_section_style_controls('team_section_box', 'Box - Style', '.tp-el-box');
        $this->tp_basic_style_controls('team_content_title', 'Testimonial - Title', '.tp-el-box-title');
        $this->tp_basic_style_controls('team_content_subtitle', 'Testimonial - Subtitle', '.tp-el-box-subtitle');
        $this->tp_basic_style_controls('team_content_offer_text', 'Testimonial - Offer Text', '.tp-el-offer-text');
        $this->tp_basic_style_controls('team_content_save_text', 'Testimonial - Save Text', '.tp-el-save-offer');
        $this->tp_basic_style_controls('team_content_msg_text', 'Testimonial - Message Text', '.tp-el-box-message');
        $this->tp_basic_style_controls('team_content_ammount_text', 'Testimonial - Ammount Text', '.tp-el-box-ammount');
        $this->tp_link_controls_style('services_link_btn', 'Section - Button', '.tp-el-box-btn');
        $this->tp_link_controls_style('services_link_btn_2', 'Section - Button 2', '.tp-el-box-btn-2');
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
            $this->add_render_attribute('title_args', 'class', 'tp-section-title-3 tp-el-title ' .
                $this->tp_common_animation_get($settings, 'desc_title'));
            ?>

            <div class="sv-inner__price-area sv-inner__price-customize pb-70 tp-el-section">
                <div class="container">
                    <?php if (!empty($settings['tp_price_section_title_show'])): ?>
                        <div class="row">
                            <div class="col-xl-12">
                                <div class="sv-inner__price-title-box text-center tp-el-content">
                                    <?php if (!empty($settings['tp_price_sub_title'])): ?>
                                        <span
                                            class="tp-section-subtitle-3 <?php echo esc_attr($this->tp_common_animation_get($settings, 'desc_title')); ?> tp-el-subtitle"><?php echo tp_kses($settings['tp_price_sub_title']); ?></span>
                                    <?php endif; ?>

                                    <?php
                                    if (!empty($settings['tp_price_title'])):
                                        printf(
                                            '<%1$s %2$s>%3$s</%1$s>',
                                            tag_escape($settings['tp_price_title_tag']),
                                            $this->get_render_attribute_string('title_args'),
                                            tp_kses($settings['tp_price_title'])
                                        );
                                    endif;
                                    ?>

                                    <?php if (!empty($settings['tp_price_description'])): ?>
                                        <p class="<?php echo esc_attr($this->tp_common_animation_get($settings, 'desc_title')); ?>">
                                            <?php echo tp_kses($settings['tp_price_description']); ?>
                                        </p>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                    <div class="tp-price-inner">
                        <div class="row">
                            <?php foreach ($settings['tp_price_list'] as $key => $item):
                                // Link
                                if ('2' == $item['tp_portfolio_link_type']) {
                                    $link = get_permalink($item['tp_portfolio_page_link']);
                                    $target = '_self';
                                    $rel = 'nofollow';
                                } else {
                                    $link = !empty($item['tp_portfolio_link']['url']) ? $item['tp_portfolio_link']['url'] : '';
                                    $target = !empty($item['tp_portfolio_link']['is_external']) ? '_blank' : '';
                                    $rel = !empty($item['tp_portfolio_link']['nofollow']) ? 'nofollow' : '';
                                }
                                $attrs = array(
                                    'href' => $link,
                                    'target' => $target,
                                    'rel' => $rel,
                                );

                                $mb = $item['repeater_condition'] == 'style_2' ? 'mb-125' : 'mb-100';
                                $body_mb = $item['repeater_condition'] == 'style_2' ? '' : 'mb-35';
                                $btn = $item['repeater_condition'] == 'style_2' ? 'tp-btn-price-border-white tp-el-box-btn-2' : 'tp-btn-price-white tp-el-box-btn';
                                ?>
                                <div class="col-xl-4 col-lg-4 col-md-6 mb-70">
                                    <div class="tp-price-item tp-el-box">
                                        <div class="tp-price-head <?php echo esc_attr($mb); ?> text-center">

                                            <?php if (!empty($item['tp_price_box_title'])): ?>
                                                <h4 class="tp-price-head-title tp-el-box-title">
                                                    <?php echo tp_kses($item['tp_price_box_title']); ?>
                                                </h4>
                                            <?php endif; ?>

                                            <?php if (!empty($item['tp_price_box_subtitle'])): ?>
                                                <span
                                                    class="tp-el-box-subtitle"><?php echo tp_kses($item['tp_price_box_subtitle']); ?></span>
                                            <?php endif; ?>
                                        </div>
                                        <div class="tp-price-body <?php echo esc_attr($body_mb); ?> text-center">

                                            <?php if (!empty($item['tp_price_box_offer_text'])): ?>
                                                <span
                                                    class="tp-el-offer-text"><?php echo tp_kses($item['tp_price_box_offer_text']); ?></span>
                                            <?php endif; ?>

                                            <?php if (!empty($item['tp_price_box_save_offer'])): ?>
                                                <span
                                                    class="tp-price-radius-border tp-el-save-offer"><?php echo tp_kses($item['tp_price_box_save_offer']); ?></span>
                                            <?php endif; ?>

                                            <?php if (!empty($item['tp_price_box_message'])): ?>
                                                <span
                                                    class="tp-price-text tp-el-box-message"><?php echo tp_kses($item['tp_price_box_message']); ?></span>
                                            <?php endif; ?>

                                            <?php if (!empty($item['tp_price_box_ammout']) || !empty($item['tp_price_box_period'])): ?>
                                                <h4 class="tp-price-body-title tp-el-box-ammount">
                                                    <?php echo tp_kses($item['tp_price_box_ammout']); ?>/<?php echo tp_kses($item['tp_price_box_period']); ?>
                                                </h4>
                                            <?php endif; ?>

                                        </div>

                                        <?php if ($item['tp_portfolio_link_switcher'] == 'yes'): ?>
                                            <div class="tp-price-btn-box text-center">
                                                <a class="<?php echo esc_attr($btn); ?>" <?php echo tp_implode_html_attributes($attrs); ?>>
                                                    <div>
                                                        <span><?php echo tp_kses($item['portfolio_link_text']); ?></span>
                                                    </div>
                                                </a>
                                            </div>
                                        <?php endif; ?>

                                    </div>
                                </div>
                            <?php endforeach; ?>

                        </div>
                    </div>
                </div>
            </div>

        <?php else: ?>

            <div class="tp-price-inner tp-el-section">
                <div class="row">
                    <?php foreach ($settings['tp_price_list'] as $key => $item):
                        // Link
                        if ('2' == $item['tp_portfolio_link_type']) {
                            $link = get_permalink($item['tp_portfolio_page_link']);
                            $target = '_self';
                            $rel = 'nofollow';
                        } else {
                            $link = !empty($item['tp_portfolio_link']['url']) ? $item['tp_portfolio_link']['url'] : '';
                            $target = !empty($item['tp_portfolio_link']['is_external']) ? '_blank' : '';
                            $rel = !empty($item['tp_portfolio_link']['nofollow']) ? 'nofollow' : '';
                        }
                        $attrs = array(
                            'href' => $link,
                            'target' => $target,
                            'rel' => $rel,
                        );

                        $mb = $item['repeater_condition'] == 'style_2' ? 'mb-125' : 'mb-100';
                        $body_mb = $item['repeater_condition'] == 'style_2' ? '' : 'mb-35';
                        $btn = $item['repeater_condition'] == 'style_2' ? 'tp-btn-price-border tp-el-box-btn-2' : 'tp-btn-price tp-el-box-btn';

                        ?>
                        <div class="col-xl-4 col-lg-4 col-md-6 mb-70">
                            <div class="tp-price-item tp-el-box">
                                <div class="tp-price-head <?php echo esc_attr($mb); ?> text-center">

                                    <?php if (!empty($item['tp_price_box_title'])): ?>
                                        <h4 class="tp-price-head-title tp-el-box-title"><?php echo tp_kses($item['tp_price_box_title']); ?>
                                        </h4>
                                    <?php endif; ?>

                                    <?php if (!empty($item['tp_price_box_subtitle'])): ?>
                                        <span class="tp-el-box-subtitle"><?php echo tp_kses($item['tp_price_box_subtitle']); ?></span>
                                    <?php endif; ?>
                                </div>
                                <div class="tp-price-body <?php echo esc_attr($body_mb); ?> text-center">

                                    <?php if (!empty($item['tp_price_box_offer_text'])): ?>
                                        <span class="tp-el-offer-text"><?php echo tp_kses($item['tp_price_box_offer_text']); ?></span>
                                    <?php endif; ?>

                                    <?php if (!empty($item['tp_price_box_save_offer'])): ?>
                                        <span
                                            class="tp-price-radius-border tp-el-save-offer"><?php echo tp_kses($item['tp_price_box_save_offer']); ?></span>
                                    <?php endif; ?>

                                    <?php if (!empty($item['tp_price_box_message'])): ?>
                                        <span
                                            class="tp-price-text tp-el-box-message"><?php echo tp_kses($item['tp_price_box_message']); ?></span>
                                    <?php endif; ?>

                                    <?php if (!empty($item['tp_price_box_ammout']) || !empty($item['tp_price_box_period'])): ?>
                                        <h4 class="tp-price-body-title tp-el-box-ammount">
                                            <?php echo tp_kses($item['tp_price_box_ammout']); ?>/<?php echo tp_kses($item['tp_price_box_period']); ?>
                                        </h4>
                                    <?php endif; ?>

                                </div>

                                <?php if ($item['tp_portfolio_link_switcher'] == 'yes'): ?>
                                    <div class="tp-price-btn-box text-center">
                                        <a class="<?php echo esc_attr($btn); ?>" <?php echo tp_implode_html_attributes($attrs); ?>>
                                            <div>
                                                <span><?php echo tp_kses($item['portfolio_link_text']); ?></span>
                                            </div>
                                        </a>
                                    </div>
                                <?php endif; ?>

                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>


        <?php endif; ?>

        <?php
    }


}

$widgets_manager->register(new TP_Price());
