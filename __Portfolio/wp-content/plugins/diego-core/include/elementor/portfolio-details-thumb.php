<?php
namespace TPCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Repeater;
use \Elementor\Utils;
use \Elementor\Group_Control_Typography;
use \Elementor\Group_Control_Box_Shadow;
use TPCore\Elementor\Controls\Group_Control_TPBGGradient;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Tp Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class TP_Portfolio_Details_Thumb extends Widget_Base {

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
		return 'tp-portfolio-details-thumb';
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
		return __( 'Portfolio Details Thumb', 'tpcore' );
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
                ],
                'default' => 'layout-1',
            ]
            );

        $this->end_controls_section();

        $this->start_controls_section(
            'tp_portfolio_thumb_sec',
                [
                  'label' => esc_html__( 'Thumbnails', 'tpcore' ),
                  'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
                ]
           );
           
           
           $repeater = new \Elementor\Repeater();
           
           $repeater->add_control(
            'tp_image',
            [
              'label'   => esc_html__( 'Upload Thumbnail', 'tpcore' ),
              'type'    => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                  'url' => \Elementor\Utils::get_placeholder_image_src(),
              ],
            ]
           );
            
            $this->add_control(
              'tp_portfolio_thumb_list',
              [
                'label'       => esc_html__( 'Thumbnail List', 'tpcore' ),
                'type'        => \Elementor\Controls_Manager::REPEATER,
                'fields'      => $repeater->get_controls(),
                'default'     => [
                    [
                        'tp_brand_image' => [
                            'url' => Utils::get_placeholder_image_src(),
                        ],
                    ],
                    [
                        'tp_brand_image' => [
                            'url' => Utils::get_placeholder_image_src(),
                        ],
                    ],
                
                ],
                'dynamic' => [
                    'active' => true,
                ],
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


	}

        // style_tab_content
    protected function style_tab_content(){


        $this->tp_section_style_controls('section_section', 'Section - Style', '.tp-el-section');

  
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
            $bloginfo = get_bloginfo( 'name' );      
        ?>

            <div class="tp-port-3-thumb-right cursor-style tp-el-section">
                <?php foreach ($settings['tp_portfolio_thumb_list'] as $key => $item) : 
                    if ( !empty($item['tp_image']['url']) ) {
                        $tp_image = !empty($item['tp_image']['id']) ? wp_get_attachment_image_url( $item['tp_image']['id'], $item['tp_image_size_size']) : $item['tp_image']['url'];
                        $tp_image_alt = get_post_meta($item["tp_image"]["id"], "_wp_attachment_image_alt", true);
                    }
                ?>
                     <?php if(!empty($tp_image)) : ?>
                        <div class="tp-port-3-thumb mb-40">
                            <img src="<?php echo esc_url($tp_image); ?>" alt="<?php echo esc_attr($tp_image_alt); ?>">
                        </div>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>



        <?php else: 
            $bloginfo = get_bloginfo( 'name' );  

		?>

        <div class="porfolio-details__overview-wrapper black-bg-3 tp-el-section">
            <div class="container">
                <div class="row">
                    <div class="porfolio-details__thumb-box tp-project-3__area">
                        <div class="row">
                            <div class="col-xl-12">
                                <div class="tp-portfolio-item-wrapper-3">
                                    <?php foreach ($settings['tp_portfolio_thumb_list'] as $key => $item) : 
                                        if ( !empty($item['tp_image']['url']) ) {
                                            $tp_image = !empty($item['tp_image']['id']) ? wp_get_attachment_image_url( $item['tp_image']['id'], $settings['tp_image_size_size']) : $item['tp_image']['url'];
                                            $tp_image_alt = get_post_meta($item["tp_image"]["id"], "_wp_attachment_image_alt", true);
                                        }
                                    ?>
                                      <?php if(!empty($tp_image)) : ?>
                                    <div class="tp-portfolio-item-3 portfolio-panel pb-80 tp-hover-reveal-text">
                                        <img src="<?php echo esc_url($tp_image); ?>" alt="<?php echo esc_attr($tp_image_alt); ?>">
                                        <span></span>
                                    </div>
                                    <?php endif; ?>
                                    <?php endforeach; ?>
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

$widgets_manager->register( new TP_Portfolio_Details_Thumb() );