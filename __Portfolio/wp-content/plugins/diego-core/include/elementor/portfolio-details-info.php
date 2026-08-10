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
class TP_Portfolio_Details_Info extends Widget_Base {

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
		return 'tp-portfolio-details-info';
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
		return __( 'Portfolio Details Information', 'tpcore' );
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
         'tp_port_meta_sec',
             [
               'label' => esc_html__( 'Portfolio Meta', 'tpcore' ),
               'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
             ]
        );

        $this->add_control(
            'tp_meta_sec_title',
            [
                'label'       => esc_html__( 'Heading', 'tpcore' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => esc_html__( 'Project Details', 'tpcore' ),
                'placeholder' => esc_html__( 'Your Text', 'tpcore' ),
                'label_block' => true
            ]
        );
        
        $this->add_control(
         'tp_meta_sec_desc_title',
         [
           'label'       => esc_html__( 'Description Heading', 'tpcore' ),
           'type'        => \Elementor\Controls_Manager::TEXT,
           'rows'        => 10,
           'default'     => esc_html__( 'Description: ', 'tpcore' ),
           'placeholder' => esc_html__( 'Your Text', 'tpcore' ),
         ]
        );
        
        $this->add_control(
         'tp_meta_sec_desc',
         [
           'label'       => esc_html__( 'Description', 'tpcore' ),
           'type'        => \Elementor\Controls_Manager::TEXTAREA,
           'rows'        => 10,
           'default'     => esc_html__( 'Lorem ipsum dolor sit amet conseur adipisci inerene. Maecenas ', 'tpcore' ),
           'placeholder' => esc_html__( 'Your Text', 'tpcore' ),
         ]
        );
        
        $repeater = new \Elementor\Repeater();
        
         $repeater->add_control(
         'tp_meta_title',
           [
             'label'   => esc_html__( 'Title', 'tpcore' ),
             'type'        => \Elementor\Controls_Manager::TEXT,
             'default'     => esc_html__( 'Clients', 'tpcore' ),
             'label_block' => true,
           ]
         );
         $repeater->add_control(
         'tp_meta_desc',
           [
             'label'   => esc_html__( 'Description', 'tpcore' ),
             'type'        => \Elementor\Controls_Manager::TEXT,
             'default'     => esc_html__( 'The Organic Crave', 'tpcore' ),
             'label_block' => true,
           ]
         );
         
         
         $this->add_control(
           'tp_meta_list',
           [
             'label'       => esc_html__( 'Meta List', 'tpcore' ),
             'type'        => \Elementor\Controls_Manager::REPEATER,
             'fields'      => $repeater->get_controls(),
             'default'     => [
               [
                 'tp_meta_title'   => esc_html__( 'Clients', 'tpcore' ),
                 'tp_meta_desc'   => esc_html__( 'The Organic Crave ', 'tpcore' ),
               ],
               [
                 'tp_meta_title'   => esc_html__( 'Year', 'tpcore' ),
                 'tp_meta_desc'   => esc_html__( '20/01/2018 ', 'tpcore' ),
               ],
               [
                 'tp_meta_title'   => esc_html__( 'Role', 'tpcore' ),
                 'tp_meta_desc'   => esc_html__( 'Fashion design ', 'tpcore' ),
               ],
             ],
             'title_field' => '{{{ tp_meta_title }}}',
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

        $this->tp_button_render_controls('tpbtn', 'Button', ['layout-1']);
	}

        // style_tab_content
    protected function style_tab_content(){


        $this->tp_section_style_controls('section_section', 'Section - Style', '.tp-el-section');
        $this->tp_basic_style_controls('section_title', 'Section - Title', '.tp-el-title');
        $this->tp_basic_style_controls('section_title_desc', 'Section - Description Title', '.tp-el-desc-title');
        $this->tp_basic_style_controls('section_description', 'Section - Description', '.tp-el-desc');
        


        $this->tp_section_style_controls('portfolio_box', 'Portfolio - Box', '.tp-el-box');
        $this->tp_basic_style_controls('portfolio_box_title', 'Meta - Title', '.tp-el-meta-title');
        $this->tp_basic_style_controls('portfolio_box_meta_desc', 'Meta - Description', '.tp-el-meta-desc');

        $this->tp_link_controls_style('portfolio_btn', 'Section - Button', '.tp-el-btn');
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
        $control_id = 'tpbtn';
            if ( !empty($settings['tp_image']['url']) ) {
                $tp_image = !empty($settings['tp_image']['id']) ? wp_get_attachment_image_url( $settings['tp_image']['id'], $settings['tp_image_size_size']) : $settings['tp_image']['url'];
                $tp_image_alt = get_post_meta($settings["tp_image"]["id"], "_wp_attachment_image_alt", true);
            }

            $this->tp_link_controls_render('tpbtn', 'tp-btn-4-1-price sm tp-el-btn', $this->get_settings());
        ?>

            <!-- hero area start -->
            <div class="tp-port-3-area black-bg-5 tp-el-section">
               <div class="tp-port-3-content-wrap pt-140">
                  <div class="container container-1350">
                     <div class="row">
                        <div class="col-xl-5 col-lg-4">
                        <div class="tp-port-3-content-left">
                            <?php if(!empty($settings['tp_meta_sec_title'])) : ?>
                            <h4 class="tp-port-3-content-title tp-el-title"><?php echo tp_kses($settings['tp_meta_sec_title']); ?></h4>
                            <?php endif; ?>

                            <div class="tp-port-3-content-info-wrap">
                            <?php foreach($settings['tp_meta_list'] as $key => $item) : ?>
                                <div class="tp-port-3-content-info d-flex align-content-start tp-el-box">
                                    <?php if(!empty($item['tp_meta_title'])) : ?>
                                    <span class="tp-el-meta-title"><?php echo tp_kses($item['tp_meta_title']); ?></span>
                                    <?php endif; ?>

                                    <?php if(!empty($item['tp_meta_desc'])) : ?>
                                    <span class="tp-el-meta-desc"><?php echo tp_kses($item['tp_meta_desc']); ?></span>
                                    <?php endif; ?>
                                </div>
                                <?php endforeach; ?>
                            </div>

                            <?php if(!empty($settings['tp_meta_sec_desc_title']) || !empty($settings['tp_meta_sec_desc'])) : ?>
                            <div class="tp-port-3-content-description mb-40">
                                <?php if(!empty($settings['tp_meta_sec_desc_title'])) : ?>
                                <span class="tp-el-desc-title"><?php echo tp_kses($settings['tp_meta_sec_desc_title']); ?></span>
                                <?php endif; ?>

                                <?php if(!empty($settings['tp_meta_sec_desc'])) : ?>
                                <p class="tp-el-desc"><?php echo tp_kses($settings['tp_meta_sec_desc']); ?></p>
                                <?php endif; ?>
                            </div>
                            <?php endif; ?>

                            <?php if (!empty($settings['tp_' . $control_id .'_text']) && $settings['tp_' . $control_id .'_button_show'] == 'yes') : ?>
                            <div class="tp-port-2-title-box">
                                <a <?php echo $this->get_render_attribute_string( 'tp-button-arg' . $control_id .'' ); ?>>  <?php echo $settings['tp_' . $control_id .'_text']; ?></a>
                            </div>
                            <?php endif; ?>

                            </div>
                        </div>
                        <div class="col-xl-7 col-lg-8">
                            <div class="tp-port-3-thumb-right cursor-style">
                                <?php foreach ($settings['tp_portfolio_thumb_list'] as $key => $item) : 
                                    if ( !empty($item['tp_image']['url']) ) {
                                        $tp_image = !empty($item['tp_image']['id']) ? wp_get_attachment_image_url( $item['tp_image']['id'], $settings['tp_image_size_size']) : $item['tp_image']['url'];
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
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <!-- hero area end -->

        <?php
	}
}

$widgets_manager->register( new TP_Portfolio_Details_Info() );