<?php
namespace TPCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Repeater;
use \Elementor\Utils;
use \Elementor\Control_Media;
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
class TP_About_Info extends Widget_Base {

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
		return 'about-info';
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
		return __( 'About Info', 'tp-core' );
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
		return [ 'tp-core' ];
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
		return [ 'tp-core' ];
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
                'label' => esc_html__('Design Layout', 'tp-core'),
            ]
        );
        $this->add_control(
            'tp_design_style',
            [
                'label' => esc_html__('Select Layout', 'tp-core'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'layout-1' => esc_html__('Layout 1', 'tp-core'),
                    'layout-2' => esc_html__('Layout 2', 'tp-core'),
                ],
                'default' => 'layout-1',
            ]
        );

        $this->end_controls_section();

    
        $this->start_controls_section(
         'tp_about_sec',
             [
               'label' => esc_html__( 'About Info', 'tpcore' ),
               'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			   'condition' => [
					'tp_design_style' => 'layout-1'
			   ]
             ]
        );
        
        $this->add_control(
         'tp_about_info_text',
         [
           'label'       => esc_html__( 'Info Content', 'tpcore' ),
           'type'        => \Elementor\Controls_Manager::TEXTAREA,
           'rows'        => 10,
           'default'     => esc_html__( 'I’m Diego a self though & self learned designer', 'tpcore' ),
           'placeholder' => esc_html__( 'Your Text', 'tpcore' ),
         ]
        );

        $this->end_controls_section();

		$this->tp_section_title_render_controls('about', 'Section - Title & Desciption', ['layout-2']);

		$this->tp_common_animation(null, 'desc_title', 'Animation - Title');
		$this->tp_common_animation(null, 'desc_animation', 'Animation - Description');

	}

    // style_tab_content
    protected function style_tab_content(){
		
        $this->tp_section_style_controls('about_section', 'Section - Style', '.tp-el-section');
        $this->tp_basic_style_controls('about_subtitle', 'About - Subtitle', '.tp-el-subtitle');
        $this->tp_basic_style_controls('about_title', 'About - Title', '.tp-el-title');
        $this->tp_basic_style_controls('about_description', 'About - Description', '.tp-el-content p');
        $this->tp_basic_style_controls('about_info_text', 'About - Info Text', '.tp-el-about-info > div');

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
		?>

		<?php if ( $settings['tp_design_style']  == 'layout-2' ):
            $this->add_render_attribute('title_args', 'class', 'tp-section-title-5 fs-140 tp-split-in-right tp-el-title ' . $this->tp_common_animation_get($settings, 'desc_title'));
            $bloginfo = get_bloginfo( 'name' );

        ?>

            <!-- about area strat -->
            <div class="tp-about-5-area coffe-bg pt-140 pb-120 tp-el-section">
               <div class="container">
                  <div class="row">
                     <div class="col-xl-12">
					 <?php if ( !empty($settings['tp_about_section_title_show']) ) : ?>
                        <div class="tp-about-5-title-wrap text-xl-end text-center">
                           <div class="tp-about-5-title-box text-center p-relative tp-el-content">
						   	<?php if(!empty($settings['tp_about_sub_title'])) : ?>
                              <span class="tp-about-5-subtitle <?php echo esc_attr($this->tp_common_animation_get($settings, 'desc_animation')); ?> tp-split-in-right tp-el-subtitle "><?php echo tp_kses( $settings['tp_about_sub_title'] ); ?></span>
                        	<?php endif; ?>

							<?php
								if ( !empty($settings['tp_about_title' ]) ) :
									printf( '<%1$s %2$s>%3$s</%1$s>',
										tag_escape( $settings['tp_about_title_tag'] ),
										$this->get_render_attribute_string( 'title_args' ),
										tp_kses( $settings['tp_about_title' ] )
										);
								endif;
							?>
							
							<?php if ( !empty($settings['tp_about_description']) ) : ?>
							<p class=""><?php echo tp_kses( $settings['tp_about_description'] ); ?></p>
							<?php endif; ?>
                           </div>
                        </div>
						<?php endif; ?>
                     </div>
                  </div>
               </div>
            </div>
            <!-- about area end -->



		<?php else:

            $bloginfo = get_bloginfo( 'name' );
		?>
            <!-- ab info area start -->
            <div id="about-info-area" class="ab-info__area black-bg-3 pb-160 tp-el-section">
               <div class="container">
                  <div class="row">
                     <div class="col-xl-12">
						<?php if(!empty($settings['tp_about_info_text'])) : ?>
                        <div class="ab-info__text tp-el-about-info">
                           <div>
						   		<?php echo tp_kses($settings['tp_about_info_text']); ?>
                           </div>
                        </div>
						<?php endif; ?>
                     </div>
                  </div>
               </div>
            </div>
            <!-- ab info area end -->

        <?php endif; ?>

        <?php
	}
}

$widgets_manager->register( new TP_About_Info() );
