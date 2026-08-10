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
class TP_Portfolio_Details_Hero extends Widget_Base {

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
		return 'tp-portfolio-details-hero';
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
		return __( 'Portfolio Details Hero', 'tpcore' );
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

        $this->tp_section_title_render_controls('portfolio', 'Section Title');

        // _tp_image
        $this->start_controls_section(
            '_tp_image_section',
            [
                'label' => esc_html__('Thumbnail Image', 'tp-core'),
                'condition' => [
                    'tp_design_style' => ['layout-1']
               ]
            ]
        );

        $this->add_control(
            'tp_image',
            [
                'label' => esc_html__( 'Choose Image', 'tp-core' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_control(
            'tp_image_2',
            [
                'label' => esc_html__( 'Choose Image 2', 'tp-core' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_control(
            'tp_portfolio_mouse_link',
            [
              'label'   => esc_html__( 'Mouse Scroll Link', 'tpcore' ),
              'type'        => \Elementor\Controls_Manager::URL,
              'default'     => [
                  'url'               => '#',
                  'is_external'       => true,
                  'nofollow'          => true,
                  'custom_attributes' => '',
                ],
                'placeholder' => esc_html__( 'Your Link', 'tpcore' ),
                'label_block' => true,
              ]
            );
   
            $this->add_control(
            'tp_portfolio_mouse_link_text',
             [
                'label'       => esc_html__( 'Mouse Scroll Text', 'tpcore' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => esc_html__( 'Scroll', 'tpcore' ),
                'placeholder' => esc_html__( 'Your Text', 'tpcore' ),
                'label_block' => true,
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


        $this->tp_button_render_controls('tpbtn', 'Button' , ['layout-1']);

        $this->start_controls_section(
         'tp_portfolio_meta_sec',
             [
               'label' => esc_html__( 'Portfolio Meta', 'tpcore' ),
               'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
             ]
        );
        
        
        $repeater = new \Elementor\Repeater();
        
         $repeater->add_control(
         'tp_portfolio_meta_title',
           [
             'label'   => esc_html__( 'Meta Title', 'tpcore' ),
             'type'        => \Elementor\Controls_Manager::TEXT,
             'default'     => esc_html__( 'Default-value', 'tpcore' ),
             'label_block' => true,
           ]
         );
         
         $repeater->add_control(
         'tp_portfolio_meta_desc',
           [
             'label'   => esc_html__( 'Meta Description', 'tpcore' ),
             'type'        => \Elementor\Controls_Manager::TEXT,
             'default'     => esc_html__( 'Default-value', 'tpcore' ),
             'label_block' => true,
           ]
         );
         
         $this->add_control(
           'tp_portfolio_meta_list',
           [
             'label'       => esc_html__( 'Meta List', 'tpcore' ),
             'type'        => \Elementor\Controls_Manager::REPEATER,
             'fields'      => $repeater->get_controls(),
             'default'     => [
               [
                 'tp_portfolio_meta_title'   => esc_html__( 'Clients', 'tpcore' ),
                 'tp_portfolio_meta_desc'   => esc_html__( 'The Organic Crave', 'tpcore' ),
               ],
               [
                 'tp_portfolio_meta_title'   => esc_html__( 'Role in project', 'tpcore' ),
                 'tp_portfolio_meta_desc'   => esc_html__( 'UX/UI Design - branding', 'tpcore' ),
               ],
             ],
             'title_field' => '{{{ tp_portfolio_meta_title }}}',
           ]
         );
        
        $this->end_controls_section();

	}

        // style_tab_content
    protected function style_tab_content(){

        
        $this->tp_section_style_controls('section_section', 'Section - Style', '.tp-el-section');
        $this->tp_basic_style_controls('section_subtitle', 'Section - Subtitle', '.tp-el-subtitle');
        $this->tp_basic_style_controls('section_title', 'Section - Title', '.tp-el-title');
        $this->tp_basic_style_controls('section_description', 'Section - Description', '.tp-el-content p');
        $this->tp_basic_style_controls('about_bg_scroll_text', 'About - Scroll Text', '.tp-el-scroll-text');
        $this->tp_link_controls_style('portfolio_btn', 'Section - Button', '.tp-el-btn');
        
        
        $this->tp_basic_style_controls('portfolio_box_title', 'Portfolio - Title', '.tp-el-box-title');
        $this->tp_basic_style_controls('portfolio_box_desc', 'Portfolio - Description', '.tp-el-box-desc');
        $this->tp_section_style_controls('section_bottom_section', 'Bottom Thumb - Section', '.tp-el-bottom-section');
  
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

        $this->add_render_attribute('title_args', 'class', 'tp-section-title-4 mb-35 tp-el-title');
        $bloginfo = get_bloginfo( 'name' );  

        $this->tp_link_controls_render('tpbtn', 'tp-btn-border-md tp-el-btn', $this->get_settings());


        if ( !empty($settings['tp_image']['url']) ) {
            $tp_image = !empty($settings['tp_image']['id']) ? wp_get_attachment_image_url( $settings['tp_image']['id'], $settings['tp_image_size_size']) : $settings['tp_image']['url'];
            $tp_image_alt = get_post_meta($settings["tp_image"]["id"], "_wp_attachment_image_alt", true);
        }


        if ( !empty($settings['tp_image_2']['url']) ) {
            $tp_image_2 = !empty($settings['tp_image_2']['id']) ? wp_get_attachment_image_url( $settings['tp_image_2']['id'], $settings['tp_image_size_size']) : $settings['tp_image_2']['url'];
            $tp_image_2_alt = get_post_meta($settings["tp_image_2"]["id"], "_wp_attachment_image_alt", true);
        }

		?>
      <!-- porfolio details area start -->
      <div class="porfolio-details__area porfolio-details__color-customize p-relative smooth">
        <?php if(!empty($settings['tp_portfolio_mouse_link'])) : ?>   
        <a href="<?php echo esc_url($settings['tp_portfolio_mouse_link']['url']); ?>">
            <div class="tp-hero-3__scrool-down z-index-5">
                <span class="text tp-el-scroll-text"><?php echo esc_html($settings['tp_portfolio_mouse_link_text']); ?></span>
                <span class="tp-el-scroll-text">
                   <svg width="14" height="93" viewBox="0 0 14 93" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path d="M14 85.8995C10.1308 85.8995 6.9999 88.9319 6.9999 92.6793" stroke="currentColor" stroke-width="2" stroke-miterlimit="10"/>
                      <path d="M7 92.6793C7 88.9319 3.86911 85.8995 -0.000102413 85.8995" stroke="currentColor" stroke-width="2" stroke-miterlimit="10"/>
                      <path d="M7 0L7 90" stroke="currentColor" stroke-width="2" stroke-miterlimit="10"/>
                   </svg>
                </span>
             </div>
          </a>
          <?php endif; ?> 

         <div class="porfolio-details__hero-img">
            <img data-speed="1.1" src="<?php echo esc_url($tp_image);?>" alt="<?php echo esc_attr($tp_image_alt); ?>">
         </div>
      </div>

      <div class="porfolio-details__info-wrap black-bg-3 pt-120 pb-100 tp-el-section">
         <div class="container">
            <div class="row">
               <div class="col-xl-5 col-lg-4">
                  <div class="porfolio-details__left-info">

                  <?php foreach ($settings['tp_portfolio_meta_list'] as $key => $item) : ?>
                     <div class="porfolio-details__left-content">
                        <?php if ( !empty($item['tp_portfolio_meta_title']) ) : ?>
                        <h4 class="porfolio-details__left-info-title tp-el-box-title"><?php echo tp_kses($item['tp_portfolio_meta_title']); ?></h4>
                        <?php endif; ?>

                        <?php if ( !empty($item['tp_portfolio_meta_desc']) ) : ?>
                        <span class="tp-el-box-desc"><?php echo tp_kses($item['tp_portfolio_meta_desc']); ?></span>
                        <?php endif; ?>
                     </div>
                    <?php endforeach; ?>
                  </div>
               </div>
               <div class="col-xl-7 col-lg-8">
                  <div class="porfolio-details__right-info">
                  <?php if ( !empty($settings['tp_portfolio_section_title_show']) ) : ?>
                     <div class="porfolio-details__right-title-box tp-el-content">

                        <?php if ( !empty($settings['tp_portfolio_sub_title']) ) : ?>
                        <span class="tp-section-subtitle-4 mb-20 tp-el-subtitle"><?php echo tp_kses( $settings['tp_portfolio_sub_title'] ); ?></span>
                        <?php endif; ?>

                        <?php
                            if ( !empty($settings['tp_portfolio_title' ]) ) :
                                printf( '<%1$s %2$s>%3$s</%1$s>',
                                    tag_escape( $settings['tp_portfolio_title_tag'] ),
                                    $this->get_render_attribute_string( 'title_args' ),
                                    tp_kses( $settings['tp_portfolio_title' ] )
                                    );
                            endif;
                        ?>

                        <?php if ( !empty($settings['tp_portfolio_description']) ) : ?>
                            <p><?php echo tp_kses( $settings['tp_portfolio_description'] ); ?></p>
                        <?php endif; ?>

                     </div>
                     <?php endif; ?>

                     <?php if (!empty($settings['tp_' . $control_id .'_text']) && $settings['tp_' . $control_id .'_button_show'] == 'yes') : ?>
                     <div class="porfolio-details__right-btn">
                        <a <?php echo $this->get_render_attribute_string( 'tp-button-arg' . $control_id .'' ); ?>>
                        <?php echo $settings['tp_' . $control_id .'_text']; ?>
                           <span>
                              <svg width="11" height="11" viewBox="0 0 11 11" fill="none" xmlns="http://www.w3.org/2000/svg">
                                 <path d="M1 10L10 1" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                 <path d="M1 1H10V10" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                              </svg>
                           </span>
                        </a>
                     </div>
                     <?php endif; ?>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- porfolio details area end -->
           
      <?php if(!empty($tp_image_2)) : ?>
      <div class="porfolio-details__overview-wrapper black-bg-3 pb-100 tp-el-bottom-section">
         <div class="container">
            <div class="row">
               <div class="col-xl-12">
                  <div class="porfolio-details__overview-thumb">
                     <img data-speed="0.6" src="<?php echo esc_url($tp_image_2); ?>" alt="<?php echo esc_attr($tp_image_2_alt); ?>">
                  </div>
               </div>
            </div>
         </div>
      </div>
      <?php endif; ?>

        <?php
	}
}

$widgets_manager->register( new TP_Portfolio_Details_Hero() );