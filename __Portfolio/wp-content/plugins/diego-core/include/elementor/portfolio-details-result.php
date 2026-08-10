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
class TP_Portfolio_Details_Result extends Widget_Base {

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
		return 'tp-portfolio-details-result';
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
		return __( 'Portfolio Details Result', 'tpcore' );
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
            'tp_portfolio_details_result_sec',
                [
                  'label' => esc_html__( 'Fact List', 'tpcore' ),
                  'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
                ]
           );
           
           $this->add_control(
           'tp_portfolio_result_text',
            [
               'label'       => esc_html__( 'Title', 'tpcore' ),
               'type'        => \Elementor\Controls_Manager::TEXT,
               'default'     => esc_html__( 'Overview', 'tpcore' ),
               'placeholder' => esc_html__( 'Your Text', 'tpcore' ),
               'label_block' => true,
            ]
           );

           
           $repeater = new \Elementor\Repeater();
        
           $repeater->add_control(
           'tp_portfolio_fact_title',
             [
               'label'   => esc_html__( 'Fact Title', 'tpcore' ),
               'type'        => \Elementor\Controls_Manager::TEXT,
               'default'     => esc_html__( 'Default-value', 'tpcore' ),
               'label_block' => true,
             ]
           );
           $repeater->add_control(
           'tp_portfolio_fact_number',
             [
               'label'   => esc_html__( 'Fact Number', 'tpcore' ),
               'type'        => \Elementor\Controls_Manager::TEXT,
               'default'     => esc_html__( 'Project Delivered', 'tpcore' ),
               'label_block' => true,
             ]
           );
           
           $repeater->add_control(
           'tp_portfolio_fact_unit',
             [
               'label'   => esc_html__( 'Fact Unit', 'tpcore' ),
               'type'        => \Elementor\Controls_Manager::TEXT,
               'default'     => esc_html__( '+', 'tpcore' ),
               'label_block' => true,
             ]
           );
           
           $this->add_control(
             'tp_portfolio_fact_list',
             [
               'label'       => esc_html__( 'Fact List', 'tpcore' ),
               'type'        => \Elementor\Controls_Manager::REPEATER,
               'fields'      => $repeater->get_controls(),
               'default'     => [
                 [
                   'tp_portfolio_fact_title'   => esc_html__( 'Project Delivered', 'tpcore' ),
                   'tp_portfolio_fact_number'   => esc_html__( '50', 'tpcore' ),
                 ],
                 [
                   'tp_portfolio_fact_title'   => esc_html__( 'Years of Experience', 'tpcore' ),
                   'tp_portfolio_fact_number'   => esc_html__( '102', 'tpcore' ),
                 ],
                 [
                   'tp_portfolio_fact_title'   => esc_html__( 'Happy Clients', 'tpcore' ),
                   'tp_portfolio_fact_number'   => esc_html__( '78', 'tpcore' ),
                 ],
               ],
               'title_field' => '{{{ tp_portfolio_fact_title }}}',
             ]
           );
           
           $this->end_controls_section();

	}

        // style_tab_content
    protected function style_tab_content(){


        $this->tp_section_style_controls('section_section', 'Section - Style', '.tp-el-section');
        $this->tp_basic_style_controls('section_title', 'Section - Title', '.tp-el-title');


        $this->tp_section_style_controls('portfolio_box', 'Result - Box', '.tp-el-box');
        $this->tp_basic_style_controls('portfolio_box_title', 'Result - Title', '.tp-el-box-title');
        $this->tp_basic_style_controls('portfolio_box_tag', 'Result - Number', '.tp-el-box-number');
  
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

               <div class="porfolio-details__result-box pb-70">
                  <div class="row">
                  <?php if(!empty($settings['tp_portfolio_result_text'])): ?>
                     <div class="col-xl-5 col-lg-4">
                        <div class="porfolio-details__result-left">
                           <h4 class="porfolio-details__overview-title mb-40 tp-el-title"><?php echo tp_kses($settings['tp_portfolio_result_text']); ?></h4>
                        </div>
                     </div>
                     <?php endif; ?>

                     <div class="col-xl-7 col-lg-8">
                        <div class="porfolio-details__result-right">
                        <?php foreach ($settings['tp_portfolio_fact_list'] as $item) :?>
                           <div class="porfolio-details__result tp-el-box">
                              <span class="child-1 tp-el-box-number"><em data-purecounter-duration=".7" data-purecounter-end="<?php echo esc_attr($item['tp_portfolio_fact_number']); ?>" class="purecounter">0</em><?php echo esc_attr($item['tp_portfolio_fact_unit']); ?></span>
                              <span class="child-2 tp-el-box-title"><?php echo esc_attr($item['tp_portfolio_fact_title']); ?></span>
                           </div>
                           <?php endforeach; ?>
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

$widgets_manager->register( new TP_Portfolio_Details_Result() );