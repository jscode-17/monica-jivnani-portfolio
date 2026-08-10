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
class TP_Portfolio_Details_Navigation extends Widget_Base {

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
        return 'portfolio-details-navigation';
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
        return __( 'Portfolio Details Navigation', 'tpcore' );
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
                    'layout-2' => esc_html__('Layout 2', 'tpcore'),
                    'layout-3' => esc_html__('Layout 3', 'tpcore'),
                ],
                'default' => 'layout-1',
            ]
        );


        $this->end_controls_section();

    }

    // style_tab_content
    protected function style_tab_content(){
        $this->tp_section_style_controls('services_section', 'Navigation - Style', '.tp-el-section');
        
        $this->tp_section_style_controls('services_section_box', 'Navigation - Box', '.tp-el-box');
        $this->tp_basic_style_controls('services_box_title', 'Navigation Title', '.tp-el-title');
        $this->tp_link_controls_style('services_box_link_btn', 'Services Arrow', '.tp-el-arrow');
        $this->tp_basic_style_controls('services_box_icon', 'Navigation Icon', '.tp-el-icon');
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

            $prev_post = get_adjacent_post(false, '', true);
            $next_post = get_adjacent_post(false, '', false);
        ?>

        <?php if ( $settings['tp_design_style']  == 'layout-2' ): 
            $bloginfo = get_bloginfo( 'name' );      
        ?>

        <div class="tp-port-2-navigation-style">
            <div class="porfolio-details__navigation-wrap ">
                <div class="row align-items-center gx-0">
                    <div class="col-xl-4 col-lg-4 col-md-4 col-12">
                        <div class="porfolio-details__navigation-content text-center text-md-start">
                            <?php if ( get_previous_post_link() ): ?>
                                <a href="<?php echo get_permalink($prev_post->ID) ?>">
                                    <i class="fa-regular fa-arrow-left"></i>
                                    <span><?php echo esc_html__('Previous', 'tpcore'); ?></span>
                                </a>
                                <h4>
                                    <a href="<?php echo get_permalink($prev_post->ID) ?>"><?php print get_previous_post_link( '%link ', '%title' );?></a>
                                </h4>
                            <?php else : ?>
                                <h4><?php echo esc_html__('No Post Available', 'tpcore'); ?></h4>
                            <?php endif;?>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-4 col-md-4 col-12">
                        <div class="porfolio-details__navigation-bar porfolio-details__navigation-bar-2  text-center">
                                <span>
                                    <svg  width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path class="path-1" opacity="0.5" d="M1 5.21053C1 3.22567 1 2.23323 1.61662 1.61662C2.23323 1 3.22567 1 5.21053 1C7.19539 1 8.18782 1 8.80444 1.61662C9.42105 2.23323 9.42105 3.22567 9.42105 5.21053C9.42105 7.19539 9.42105 8.18782 8.80444 8.80444C8.18782 9.42105 7.19539 9.42105 5.21053 9.42105C3.22567 9.42105 2.23323 9.42105 1.61662 8.80444C1 8.18782 1 7.19539 1 5.21053Z" stroke="currentcolor" stroke-width="1.5"/>
                                    <path class="path-1" opacity="0.5" d="M12.5781 16.7896C12.5781 14.8048 12.5781 13.8123 13.1947 13.1957C13.8114 12.5791 14.8038 12.5791 16.7887 12.5791C18.7735 12.5791 19.7659 12.5791 20.3826 13.1957C20.9992 13.8123 20.9992 14.8048 20.9992 16.7896C20.9992 18.7745 20.9992 19.7669 20.3826 20.3835C19.7659 21.0002 18.7735 21.0002 16.7887 21.0002C14.8038 21.0002 13.8114 21.0002 13.1947 20.3835C12.5781 19.7669 12.5781 18.7745 12.5781 16.7896Z" stroke="currentcolor" stroke-width="1.5"/>
                                    <path class="path-2" d="M1 16.7895C1 14.8046 1 13.8122 1.61662 13.1956C2.23323 12.5789 3.22567 12.5789 5.21053 12.5789C7.19539 12.5789 8.18782 12.5789 8.80444 13.1956C9.42105 13.8122 9.42105 14.8046 9.42105 16.7895C9.42105 18.7743 9.42105 19.7668 8.80444 20.3834C8.18782 21 7.19539 21 5.21053 21C3.22567 21 2.23323 21 1.61662 20.3834C1 19.7668 1 18.7743 1 16.7895Z" stroke="currentcolor" stroke-width="1.5"/>
                                    <path class="path-2" d="M12.5781 5.21053C12.5781 3.22567 12.5781 2.23323 13.1947 1.61662C13.8114 1 14.8038 1 16.7887 1C18.7735 1 19.7659 1 20.3826 1.61662C20.9992 2.23323 20.9992 3.22567 20.9992 5.21053C20.9992 7.19539 20.9992 8.18782 20.3826 8.80444C19.7659 9.42105 18.7735 9.42105 16.7887 9.42105C14.8038 9.42105 13.8114 9.42105 13.1947 8.80444C12.5781 8.18782 12.5781 7.19539 12.5781 5.21053Z" stroke="currentcolor" stroke-width="1.5"/>
                                    </svg>
                                </span>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-4 col-md-4 col-12">
                        <div class="porfolio-details__navigation-content next text-center text-md-end">
                            <?php if ( get_next_post_link() ): ?>
                                <a href="<?php echo get_permalink($next_post->ID) ?>">
                                    <span><?php echo esc_html__('Next', 'tpcore'); ?></span>
                                    <i class="fa-regular fa-arrow-right"></i>
                                </a>
                                <h4>
                                    <a href="<?php echo get_permalink($next_post->ID) ?>"><?php print get_next_post_link( '%link ', '%title' );?></a>
                                </h4>
                            <?php else : ?>
                                <h4><?php echo esc_html__('No Post Available', 'tpcore'); ?></h4>
                            <?php endif;?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php elseif ( $settings['tp_design_style']  == 'layout-3' ): 
            $bloginfo = get_bloginfo( 'name' );      
        ?>

        <div class="tp-port-3-navigation-style">
                <div class="container container-1350">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="porfolio-details__navigation-wrap">
                                <div class="row align-items-center gx-0">
                                    <div class="col-xl-4 col-lg-4 col-md-4 col-12">
                                        <div class="porfolio-details__navigation-content text-center text-md-start">
                                            <?php if ( get_previous_post_link() ): ?>
                                            <a href="<?php echo get_permalink($prev_post->ID) ?>">
                                                <i class="fa-regular fa-arrow-left"></i>
                                                <span><?php echo esc_html__('Previous', 'tpcore'); ?></span>
                                            </a>
                                            <h4>
                                                <a href="<?php echo get_permalink($prev_post->ID) ?>"><?php print get_previous_post_link( '%link ', '%title' );?></a>
                                            </h4>
                                        <?php else : ?>
                                            <h4><?php echo esc_html__('No Post Available', 'tpcore'); ?></h4>
                                        <?php endif;?>
                                        </div>
                                    </div>
                                    <div class="col-xl-4 col-lg-4 col-md-4 col-12">
                                        <div class="porfolio-details__navigation-bar porfolio-details__navigation-bar-2 text-center">
                                                <span>
                                                    <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path class="path-1" opacity="0.5" d="M1 5.21053C1 3.22567 1 2.23323 1.61662 1.61662C2.23323 1 3.22567 1 5.21053 1C7.19539 1 8.18782 1 8.80444 1.61662C9.42105 2.23323 9.42105 3.22567 9.42105 5.21053C9.42105 7.19539 9.42105 8.18782 8.80444 8.80444C8.18782 9.42105 7.19539 9.42105 5.21053 9.42105C3.22567 9.42105 2.23323 9.42105 1.61662 8.80444C1 8.18782 1 7.19539 1 5.21053Z" stroke="currentcolor" stroke-width="1.5"/>
                                                        <path class="path-1" opacity="0.5" d="M12.5781 16.7896C12.5781 14.8048 12.5781 13.8123 13.1947 13.1957C13.8114 12.5791 14.8038 12.5791 16.7887 12.5791C18.7735 12.5791 19.7659 12.5791 20.3826 13.1957C20.9992 13.8123 20.9992 14.8048 20.9992 16.7896C20.9992 18.7745 20.9992 19.7669 20.3826 20.3835C19.7659 21.0002 18.7735 21.0002 16.7887 21.0002C14.8038 21.0002 13.8114 21.0002 13.1947 20.3835C12.5781 19.7669 12.5781 18.7745 12.5781 16.7896Z" stroke="currentcolor" stroke-width="1.5"/>
                                                        <path class="path-2" d="M1 16.7895C1 14.8046 1 13.8122 1.61662 13.1956C2.23323 12.5789 3.22567 12.5789 5.21053 12.5789C7.19539 12.5789 8.18782 12.5789 8.80444 13.1956C9.42105 13.8122 9.42105 14.8046 9.42105 16.7895C9.42105 18.7743 9.42105 19.7668 8.80444 20.3834C8.18782 21 7.19539 21 5.21053 21C3.22567 21 2.23323 21 1.61662 20.3834C1 19.7668 1 18.7743 1 16.7895Z" stroke="currentcolor" stroke-width="1.5"/>
                                                        <path class="path-2" d="M12.5781 5.21053C12.5781 3.22567 12.5781 2.23323 13.1947 1.61662C13.8114 1 14.8038 1 16.7887 1C18.7735 1 19.7659 1 20.3826 1.61662C20.9992 2.23323 20.9992 3.22567 20.9992 5.21053C20.9992 7.19539 20.9992 8.18782 20.3826 8.80444C19.7659 9.42105 18.7735 9.42105 16.7887 9.42105C14.8038 9.42105 13.8114 9.42105 13.1947 8.80444C12.5781 8.18782 12.5781 7.19539 12.5781 5.21053Z" stroke="currentcolor" stroke-width="1.5"/>
                                                    </svg>
                                                </span>
                                        </div>
                                    </div>
                                    <div class="col-xl-4 col-lg-4 col-md-4 col-12">
                                        <div class="porfolio-details__navigation-content next text-center text-md-end">
                                            <?php if ( get_next_post_link() ): ?>
                                                <a href="<?php echo get_permalink($next_post->ID) ?>">
                                                    <span><?php echo esc_html__('Next', 'tpcore'); ?></span>
                                                    <i class="fa-regular fa-arrow-right"></i>
                                                </a>
                                                <h4>
                                                    <a href="<?php echo get_permalink($next_post->ID) ?>"><?php print get_next_post_link( '%link ', '%title' );?></a>
                                                </h4>
                                            <?php else : ?>
                                                <h4><?php echo esc_html__('No Post Available', 'tpcore'); ?></h4>
                                            <?php endif;?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        <?php else: 
            $bloginfo = get_bloginfo( 'name' );  
		?>

            <div class="porfolio-details__overview-wrapper black-bg-3 tp-el-section">
                <div class="container">
                    <div class="row">
                        <div class="porfolio-details__navigation-wrap pb-125 tp-el-box">
                            <div class="row align-items-center gx-0">
                                <div class="col-xl-4 col-lg-4 col-md-4 col-12">
                                    <div class="porfolio-details__navigation-content text-center text-md-start">
                                        <?php if ( get_previous_post_link() ): ?>
                                            <a class="tp-el-arrow" href="<?php echo get_permalink($prev_post->ID) ?>">
                                                <i class="fa-regular fa-arrow-left"></i>
                                                <span><?php echo esc_html__('Previous', 'tpcore'); ?></span>
                                            </a>
                                            <h4 class="tp-el-title">
                                                <a href="<?php echo get_permalink($prev_post->ID) ?>"><?php print get_previous_post_link( '%link ', '%title' );?></a>
                                            </h4>
                                        <?php else : ?>
                                            <h4 class="tp-el-title"><?php echo esc_html__('No Post Available', 'tpcore'); ?></h4>
                                        <?php endif;?>
                                    </div>
                                </div>
                                <div class="col-xl-4 col-lg-4 col-md-4 col-12">
                                    <div class="porfolio-details__navigation-bar text-center">
                                        <span class="tp-el-icon">
                                            <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path opacity="0.5" d="M1 5.21053C1 3.22567 1 2.23323 1.61662 1.61662C2.23323 1 3.22567 1 5.21053 1C7.19539 1 8.18782 1 8.80444 1.61662C9.42105 2.23323 9.42105 3.22567 9.42105 5.21053C9.42105 7.19539 9.42105 8.18782 8.80444 8.80444C8.18782 9.42105 7.19539 9.42105 5.21053 9.42105C3.22567 9.42105 2.23323 9.42105 1.61662 8.80444C1 8.18782 1 7.19539 1 5.21053Z" stroke="currentColor" stroke-width="1.5"/>
                                                <path opacity="0.5" d="M12.5781 16.7896C12.5781 14.8048 12.5781 13.8123 13.1947 13.1957C13.8114 12.5791 14.8038 12.5791 16.7887 12.5791C18.7735 12.5791 19.7659 12.5791 20.3826 13.1957C20.9992 13.8123 20.9992 14.8048 20.9992 16.7896C20.9992 18.7745 20.9992 19.7669 20.3826 20.3835C19.7659 21.0002 18.7735 21.0002 16.7887 21.0002C14.8038 21.0002 13.8114 21.0002 13.1947 20.3835C12.5781 19.7669 12.5781 18.7745 12.5781 16.7896Z" stroke="currentColor" stroke-width="1.5"/>
                                                <path d="M1 16.7896C1 14.8048 1 13.8123 1.61662 13.1957C2.23323 12.5791 3.22567 12.5791 5.21053 12.5791C7.19539 12.5791 8.18782 12.5791 8.80444 13.1957C9.42105 13.8123 9.42105 14.8048 9.42105 16.7896C9.42105 18.7745 9.42105 19.7669 8.80444 20.3835C8.18782 21.0002 7.19539 21.0002 5.21053 21.0002C3.22567 21.0002 2.23323 21.0002 1.61662 20.3835C1 19.7669 1 18.7745 1 16.7896Z" stroke="currentColor" stroke-width="1.5"/>
                                                <path d="M12.5781 5.21053C12.5781 3.22567 12.5781 2.23323 13.1947 1.61662C13.8114 1 14.8038 1 16.7887 1C18.7735 1 19.7659 1 20.3826 1.61662C20.9992 2.23323 20.9992 3.22567 20.9992 5.21053C20.9992 7.19539 20.9992 8.18782 20.3826 8.80444C19.7659 9.42105 18.7735 9.42105 16.7887 9.42105C14.8038 9.42105 13.8114 9.42105 13.1947 8.80444C12.5781 8.18782 12.5781 7.19539 12.5781 5.21053Z" stroke="currentColor" stroke-width="1.5"/>
                                            </svg>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-xl-4 col-lg-4 col-md-4 col-12">
                                    <div class="porfolio-details__navigation-content next text-center text-md-end">

                                        <?php if ( get_next_post_link() ): ?>
                                            <a class="tp-el-arrow" href="<?php echo get_permalink($next_post->ID) ?>">
                                                <span><?php echo esc_html__('Next', 'tpcore'); ?></span>
                                                <i class="fa-regular fa-arrow-right"></i>
                                            </a>
                                            <h4 class="tp-el-title">
                                                <a href="<?php echo get_permalink($next_post->ID) ?>"><?php print get_next_post_link( '%link ', '%title' );?></a>
                                            </h4>
                                        <?php else : ?>
                                            <h4 class="tp-el-title"><?php echo esc_html__('No Post Available', 'tpcore'); ?></h4>
                                        <?php endif;?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php endif; ?>
        <?php
    }
}

$widgets_manager->register( new TP_Portfolio_Details_Navigation() ); 