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
class TP_Portfolio_Details_Overview extends Widget_Base {

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
		return 'tp-portfolio-details-overview';
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
		return __( 'Portfolio Details Overview', 'tpcore' );
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


        $this->start_controls_section(
            'tp_portfolio_details_overview_sec',
                [
                  'label' => esc_html__( 'Feature List', 'tpcore' ),
                  'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
                ]
           );
           
           $this->add_control(
           'tp_portfolio_overview_text',
            [
               'label'       => esc_html__( 'Title', 'tpcore' ),
               'type'        => \Elementor\Controls_Manager::TEXT,
               'default'     => esc_html__( 'Overview', 'tpcore' ),
               'placeholder' => esc_html__( 'Your Text', 'tpcore' ),
               'label_block' => true,
            ]
           );

           $this->add_control(
            'tp_portfolio_overview_desc',
            [
              'label'       => esc_html__( 'Description', 'tpcore' ),
              'type'        => \Elementor\Controls_Manager::TEXTAREA,
              'rows'        => 10,
              'default'     => esc_html__( 'The technology that drives some of the best ', 'tpcore' ),
              'placeholder' => esc_html__( 'Your Text', 'tpcore' ),
            ]
           );

           
           $repeater = new \Elementor\Repeater();
           
            $repeater->add_control(
            'tp_portfolio_features_title',
              [
                'label'   => esc_html__( 'Features Title', 'tpcore' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => esc_html__( 'Graphic research and production', 'tpcore' ),
                'label_block' => true,
              ]
            );
            
            $this->add_control(
              'tp_portfolio_features_list',
              [
                'label'       => esc_html__( 'Feature Title', 'tpcore' ),
                'type'        => \Elementor\Controls_Manager::REPEATER,
                'fields'      => $repeater->get_controls(),
                'default'     => [
                  [
                    'tp_portfolio_features_title'   => esc_html__( 'Graphic research and production', 'tpcore' ),
                  ],
                  [
                    'tp_portfolio_features_title'   => esc_html__( 'Presentation of your logo on different media', 'tpcore' ),
                  ],
                  [
                    'tp_portfolio_features_title'   => esc_html__( 'Advice on the graphic orientation of your logo or its redesign', 'tpcore' ),
                  ],
                  [
                    'tp_portfolio_features_title'   => esc_html__( 'Delivery of your logo in professional formats', 'tpcore' ),
                  ],
                ],
                'title_field' => '{{{ tp_portfolio_features_title }}}',
              ]
            );
           
           $this->end_controls_section();

	}

        // style_tab_content
    protected function style_tab_content(){


        $this->tp_section_style_controls('section_section', 'Section - Style', '.tp-el-section');
        $this->tp_basic_style_controls('section_title', 'Section - Title', '.tp-el-title');


        $this->tp_basic_style_controls('portfolio_box_heading', 'List - Heading', '.tp-el-list-desc');
        $this->tp_basic_style_controls('portfolio_box_title', 'List - Item', '.tp-el-box-title');

  
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
      <div class="porfolio-details__overview-wrapper black-bg-3 tp-el-section">
         <div class="container">
            <div class="row">
               
               <div class="porfolio-details__overview-box mt-120 pb-135">
                  <div class="row">
                    <?php if(!empty($settings['tp_portfolio_overview_text'])): ?>
                     <div class="col-xl-5 col-lg-4">
                        <div class="porfolio-details__overview-left">
                           <h4 class="porfolio-details__overview-title mb-40 tp-el-title"><?php echo tp_kses($settings['tp_portfolio_overview_text']); ?></h4>
                        </div>
                     </div>
                     <?php endif; ?>

                     <div class="col-xl-7 col-lg-8">
                        <div class="porfolio-details__overview-right">
                            <?php if(!empty($settings['tp_portfolio_overview_desc'])): ?>
                            <p class="tp-el-list-desc"><?php echo tp_kses($settings['tp_portfolio_overview_desc']); ?></p>
                            <?php endif; ?>

                           <div class="porfolio-details__overview-list">
                              <ul>
                              <?php foreach ($settings['tp_portfolio_features_list'] as $key => $item) : ?>
                            
                                    <?php if(!empty($item['tp_portfolio_features_title'])) : ?>
                                    <li class="tp-el-box-title"><?php echo tp_kses($item['tp_portfolio_features_title']); ?></li>
                                    <?php endif; ?>

                                <?php endforeach; ?>
                              </ul>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>

        <?php
	}
}

$widgets_manager->register( new TP_Portfolio_Details_Overview() );