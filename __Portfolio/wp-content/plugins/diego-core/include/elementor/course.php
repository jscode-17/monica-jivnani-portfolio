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

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Tp Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class TP_Course extends Widget_Base {

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
    public function get_name() {
        return 'tp-course';
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
    public function get_title() {
        return __( 'Course', 'tpcore' );
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
    public function get_icon() {
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
    public function get_categories() {
        return [ 'tpcore' ];
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
    public function get_script_depends() {
        return [ 'tpcore' ];
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

    protected function register_controls(){
        $this->register_controls_section();
        $this->style_tab_content();
    }   
    protected function register_controls_section() {

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

        // Service group
        $this->start_controls_section(
            'tp_services',
            [
                'label' => esc_html__('Course List', 'tpcore'),
                'description' => esc_html__( 'Control all the style settings from Style tab', 'tpcore' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'repeater_condition',
            [
                'label' => __( 'Field condition', 'tpcore' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'style_1' => __( 'Style 1', 'tpcore' ),
                    'style_2' => __( 'Style 2', 'tpcore' ),
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
                'label' => __( 'Image', 'tpcore' ),
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'dynamic' => [
                    'active' => true,
                ],
            ]
        ); 


        $repeater->add_control(
            'tp_service_title', [
                'label' => esc_html__('Title', 'tpcore'),
                'description' => tp_get_allowed_html_desc( 'basic' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Course Title', 'tpcore'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'tp_course_meta',
            [
                'label' => esc_html__('Description', 'tpcore'),
                'description' => tp_get_allowed_html_desc( 'intermediate' ),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => ' 3 Hours 42 Mins / English ',
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'tp_service_brand_logo',
            [
                'label' => esc_html__('Brand Logo', 'tpcore'),
                'description' => tp_get_allowed_html_desc( 'intermediate' ),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => ' Brand Logo ',
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'tp_services_link_switcher',
            [
                'label' => esc_html__( 'Add Course link', 'tpcore' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Yes', 'tpcore' ),
                'label_off' => esc_html__( 'No', 'tpcore' ),
                'return_value' => 'yes',
                'default' => 'yes',
                'separator' => 'before',
            ]
        );
        $repeater->add_control(
            'tp_services_btn_text',
            [
                'label' => esc_html__('Price Text', 'tpcore'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('$99', 'tpcore'),
                'title' => esc_html__('Enter button text', 'tpcore'),
                'label_block' => true,
                'condition' => [
                    'tp_services_link_switcher' => 'yes',
                ],
            ]
        );
        $repeater->add_control(
            'tp_services_btn_old_text',
            [
                'label' => esc_html__('Old Price', 'tpcore'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('$120', 'tpcore'),
                'title' => esc_html__('Enter button text', 'tpcore'),
                'label_block' => true,
                'condition' => [
                    'tp_services_link_switcher' => 'yes',
                ],
            ]
        );
        $repeater->add_control(
            'tp_services_btn_save_text',
            [
                'label' => esc_html__('Old Price', 'tpcore'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Save Up To 355', 'tpcore'),
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
                'label' => esc_html__( 'Course Link Type', 'tpcore' ),
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
                'label' => esc_html__( 'Course Link', 'tpcore' ),
                'type' => \Elementor\Controls_Manager::URL,
                'dynamic' => [
                    'active' => true,
                ],
                'placeholder' => esc_html__( 'https://your-link.com', 'tpcore' ),
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
                'label' => esc_html__( 'Select Course Link Page', 'tpcore' ),
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
                'label' => esc_html__('Course - List', 'tpcore'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'tp_service_title' => esc_html__('Animation Basics / Volume 1', 'tpcore'),
                    ],
                    [
                        'tp_service_title' => esc_html__('Animation Basics / Volume 2', 'tpcore')
                    ],
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
    protected function style_tab_content(){
        $this->tp_section_style_controls('services_section_box', 'Course - Box - Style', '.tp-el-box');
        $this->tp_basic_style_controls('services_box_title', 'Course - Box - Title', '.tp-el-box-title');
        $this->tp_basic_style_controls('services_box_subtitle', 'Course - Box - Meta', '.tp-el-box-meta span');
        $this->tp_basic_style_controls('services_box_description', 'Course - Offer Text', '.tp-el-price-save');
        $this->tp_basic_style_controls('services_box_price', 'Course - Price New Text', '.tp-el-price-text span.new-price');
        $this->tp_basic_style_controls('services_box_price_old', 'Course - Price Old Text', '.tp-el-price-text span.old-price');
        $this->tp_link_controls_style('services_box_link_btn', 'Course - Box - Button', '.tp-el-price-btn');
        $this->tp_section_style_controls('services_logo', 'Course - Top Right Logo', '.tp-course-logo');
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
    protected function render() {
        $settings = $this->get_settings_for_display();

        ?>

        <?php if ( $settings['tp_design_style']  == 'layout-2' ):
            $this->add_render_attribute('title_args', 'class', 'section__title-4 tp-el-title');
        ?>


        <?php else:
            $this->add_render_attribute('title_args', 'class', 'tp-section-title tp-el-title');
            $bloginfo = get_bloginfo( 'name' );

        ?>

            <div class="tp-pcb-inner pl-70 pr-70">
                <div class="row gx-50">
                    <?php foreach ($settings['tp_service_list'] as $key => $item) :

                        if ( !empty($item['tp_services_image']['url']) ) {
                            $tp_services_image = !empty($item['tp_services_image']['id']) ? wp_get_attachment_image_url( $item['tp_services_image']['id'], $settings['thumbnail_size']) : $item['tp_services_image']['url'];
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
                    ?>
                    <div class="col-xl-6 col-lg-6 mb-70">
                        <div class="tp-course-item tp-el-box">
                            <?php if(!empty($tp_services_image)) : ?>
                            <div class="tp-course-thumb-wrap p-relative">
                                <div class="tp-course-thumb fix">
                                    <?php if ($item['tp_services_link_switcher'] == 'yes') : ?>
                                    <a href="<?php echo esc_url($link) ?>">
                                        <img class="w-100" src="<?php echo esc_url($tp_services_image); ?>" alt="<?php echo esc_url($tp_services_image_alt); ?>">
                                    </a>
                                    <?php else : ?>
                                        <img class="w-100" src="<?php echo esc_url($tp_services_image); ?>" alt="<?php echo esc_url($tp_services_image_alt); ?>">
                                    <?php endif; ?>
                                </div>

                                <?php if (!empty($item['tp_service_brand_logo'])) : ?>
                                <div class="tp-course-logo d-flex align-items-center">
                                <?php echo tp_kses($item['tp_service_brand_logo' ]); ?>
                                </div>
                                <?php endif; ?>

                            </div>
                            <?php endif; ?>
                            <div class="tp-course-content">
                                <?php if($item['tp_course_meta']) : ?>
                                <div class="tp-course-meta tp-el-box-meta">
                                    <span><?php echo tp_kses($item['tp_course_meta']); ?></span>
                                </div>
                                <?php endif; ?>

                                <h3 class="tp-course-title tp-el-box-title">
                                    <?php if ($item['tp_services_link_switcher'] == 'yes') : ?>
                                    <a href="<?php echo esc_url($link) ?>"><?php echo tp_kses($item['tp_service_title' ]); ?></a>
                                    <?php else : ?>
                                        <?php echo tp_kses($item['tp_service_title' ]); ?>
                                    <?php endif; ?>
                                </h3>

                                <?php if ($item['tp_services_link_switcher'] == 'yes') : ?>
                                <div class="tp-course-price-btn-box d-flex align-items-center">
                                    <a href="<?php echo esc_url($link) ?>" class="tp-course-price-btn tp-el-price-btn tp-el-price-text">

                                        <?php if (!empty($item['tp_services_btn_text'])) : ?>
                                        <span class="new-price"><?php echo tp_kses($item['tp_services_btn_text']); ?></span>
                                        <?php endif; ?>

                                        <?php if (!empty($item['tp_services_btn_old_text'])) : ?>
                                        <span class="old-price"><del><?php echo tp_kses($item['tp_services_btn_old_text']); ?></del></span>
                                        <?php endif; ?>
                                    </a>

                                    <?php if (!empty($item['tp_services_btn_text'])) : ?>
                                    <div class="tp-course-pirce-offer p-relative">
                                        <span>
                                            <svg width="60" height="51" viewBox="0 0 60 51" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M4.99903 50.134C6.57433 43.3833 8.8496 40.404 11.6064 39.3942C14.3632 38.3821 17.47 39.3406 20.5768 40.3012C22.721 40.977 24.9089 41.6665 26.9218 41.7906C29.0222 41.9213 30.9914 41.4401 32.698 39.7457C33.0918 39.339 33.442 38.679 33.6608 37.7993C34.0108 36.6058 34.2296 34.9813 34.3171 33.0754C34.7547 25.8451 33.8797 14.4651 34.9299 7.53443C35.1487 5.9412 35.4985 4.59017 35.9799 3.59618C36.4175 2.73122 36.9425 2.14674 37.6426 1.99802C38.2115 1.87664 38.8679 2.04667 39.6993 2.50813C41.0996 3.296 42.7623 4.9029 44.8627 7.50927C46.7006 9.79086 48.2325 12.3611 50.0266 14.6952C52.8271 18.3492 55.7588 22.0523 59.0406 24.984C59.2594 25.1693 59.5656 25.1508 59.7406 24.943C59.9594 24.7347 59.9158 24.4154 59.697 24.23C56.4589 21.3399 53.5709 17.6849 50.8141 14.0823C49.0638 11.7422 47.4886 9.16538 45.6507 6.87777C43.4628 4.13472 41.6687 2.46003 40.1809 1.6306C39.1307 1.01442 38.2115 0.8471 37.4238 1.00949C36.6362 1.17679 35.9362 1.69566 35.4111 2.52782C34.711 3.62898 34.2295 5.31516 33.9232 7.38516C32.8729 14.3404 33.7484 25.7615 33.3108 33.0174C33.2233 34.8359 33.0043 36.3871 32.698 37.5259C32.523 38.2012 32.3041 38.7217 31.954 39.0339C30.51 40.4981 28.8037 40.895 26.9658 40.7824C25.0405 40.6626 22.9401 39.9874 20.8397 39.3368C17.5578 38.3072 14.1882 37.3619 11.2564 38.4461C8.32458 39.532 5.69908 42.6479 4.03626 49.9055C3.94874 50.1772 4.12369 50.4489 4.38624 50.5118C4.64879 50.5747 4.95527 50.4058 4.99903 50.134Z" fill="currentcolor" />
                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                d="M3.54456 49.7407C3.5008 49.6702 3.41312 49.4783 3.36936 49.3197C3.10681 48.5488 2.84451 47.3525 2.757 47.0015C1.79431 43.8965 1.00666 40.4208 1.00666 37.0949C1.00666 36.8161 0.787614 36.5903 0.525064 36.5908C0.218755 36.5914 -0.00012207 36.8177 -0.00012207 37.0966C-0.00012207 40.5187 0.831287 44.0955 1.75021 47.2907C1.88149 47.6467 2.14404 48.861 2.40659 49.644C2.49411 49.9255 2.58188 50.1584 2.6694 50.305C2.75691 50.4253 2.84426 50.5078 2.93177 50.5598C3.10681 50.6943 3.36962 50.7599 3.63217 50.7511C3.93847 50.7413 4.28846 50.6401 4.63852 50.4685C5.38242 50.1328 6.2575 49.5188 6.95763 49.0332C7.35146 48.7544 7.70161 48.5166 7.9204 48.4438C9.80201 47.82 11.8585 48.4848 13.4338 50.6434C13.6088 50.8676 13.9154 50.9162 14.1342 50.7511C14.353 50.586 14.3966 50.2694 14.2654 50.0447C12.34 47.4559 9.88944 46.7358 7.61401 47.4848C7.04515 47.6653 5.82008 48.6615 4.72612 49.2979C4.37606 49.4799 4.06949 49.6297 3.80694 49.703C3.71943 49.7243 3.67567 49.7391 3.58815 49.7413C3.58815 49.7424 3.54456 49.744 3.54456 49.7407Z" fill="currentcolor" />
                                            </svg>
                                        </span>
                                        <p class="tp-el-price-save"><?php echo tp_kses($item['tp_services_btn_save_text']); ?></p>
                                    </div>
                                    <?php endif; ?>
                                </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>

        <?php endif; ?>

        <?php
    }
}

$widgets_manager->register( new TP_Course() ); 