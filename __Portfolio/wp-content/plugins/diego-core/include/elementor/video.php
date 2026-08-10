<?php
namespace TPCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Group_Control_Background;
use \Elementor\Control_Media;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Tp Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class TP_Video extends Widget_Base {

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
		return 'tp-video';
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
		return __( 'TP Video', 'tpcore' );
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

	protected function register_controls(){
        $this->register_controls_section();
        $this->style_tab_content();
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

        // tp_video
        $this->start_controls_section(
            'tp_video',
            [
                'label' => esc_html__('Video', 'tpcore'),
            ]
        );

        $this->add_control(
            'tp_video_url',
            [
                'label' => esc_html__('Video', 'tpcore'),
                'type' => Controls_Manager::TEXT,
                'default' => 'https://www.youtube.com/watch?v=AjgD3CvWzS0',
                'title' => esc_html__('Video url', 'tpcore'),
                'label_block' => true,
            ]
        );

        $this->end_controls_section();
	}


	protected function style_tab_content(){
		$this->tp_section_style_controls('about_section', 'Section - Style', '.tp-el-section');
		$this->start_controls_section(
			'content_section',
			[
				'label' => esc_html__( 'Video', 'tpcore' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'video_control',
			[
				'label' => esc_html__( 'Video Dimension', 'tpcore' ),
				'type' => \Elementor\Controls_Manager::IMAGE_DIMENSIONS,
				'description' => esc_html__( 'Crop the original video size to any custom size. Set custom width or height to keep the original size ratio.', 'tpcore' ),
				'default' => [
					'width' => '',
					'height' => '',
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
	protected function render() {
		$settings = $this->get_settings_for_display();

		?>

		<?php if ( $settings['tp_design_style']  == 'layout-2' ) : 
            $bloginfo = get_bloginfo( 'name' );
		?> 
         

		<?php else:
         $bloginfo = get_bloginfo( 'name' );

		?>


        <!-- video area start -->
        <div class="tp-video-4-area">
            <div class="tp-video-4-wrap">
                <?php if(!empty($settings['tp_video_url'])) : ?>
                <video data-width="<?php echo esc_attr($settings['video_control']['width']); ?>" data-height="<?php echo esc_attr($settings['video_control']['height']); ?>" class="play-video" loop="" muted="" autoplay="" playsinline="">
                    <source src="<?php echo esc_url($settings["tp_video_url"]); ?>" type="video/mp4">
                </video>
                <?php endif; ?>
            </div>
        </div>
        <!-- video area end -->


        <?php endif; ?>

        <?php

	}

}

$widgets_manager->register( new TP_Video() );
