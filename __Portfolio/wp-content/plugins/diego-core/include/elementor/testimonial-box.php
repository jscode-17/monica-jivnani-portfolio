<?php
namespace TPCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Repeater;
use \Elementor\Utils;
use TPCore\Elementor\Controls\Group_Control_TPBGGradient;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Tp Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class TP_Testimonial_Box extends Widget_Base {

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
		return 'tp-testimonial-box';
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
		return __( 'Testimonial Box', 'tpcore' );
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
         'tp_testimonial_sec',
             [
               'label' => esc_html__( 'Testimonial Content', 'tpcore' ),
               'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
             ]
        );
        
        $this->add_control(
         'tp_testimonial_content',
         [
           'label'       => esc_html__( 'Review Text', 'tpcore' ),
           'type'        => \Elementor\Controls_Manager::TEXTAREA,
           'rows'        => 10,
           'default'     => esc_html__( 'Diego is one of the top Framer Experts in our community. Im a huge fan of his work and his Swiss typographic style.', 'tpcore' ),
           'placeholder' => esc_html__( 'Your Text', 'tpcore' ),
         ]
        );
        
        $this->add_control(
        'tp_testimonial_user_name',
         [
            'label'       => esc_html__( 'Reviewer Name', 'tpcore' ),
            'type'        => \Elementor\Controls_Manager::TEXT,
            'default'     => esc_html__( 'Polina Viola', 'tpcore' ),
            'placeholder' => esc_html__( 'Your Text', 'tpcore' ),
            'label_block' => true
         ]
        );

        $this->end_controls_section();

            // _tp_image
            $this->start_controls_section(
                '_tp_image_section',
                [
                    'label' => esc_html__('Background Image', 'tp-core'),
                ]
            );

            $this->add_control(
                'background_image',
                [
                    'label' => esc_html__( 'Choose BG Image', 'tp-core' ),
                    'type' => \Elementor\Controls_Manager::MEDIA,
                    'default' => [
                        'url' => \Elementor\Utils::get_placeholder_image_src(),
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
  
        $this->tp_section_style_controls('team_section', 'Section - Style', '.tp-el-section');
        

        $this->tp_basic_style_controls('team_content', 'Testimonial - Content', '.tp-el-box-desc');
        $this->tp_basic_style_controls('team_content_user', 'Testimonial - User Name', '.tp-el-user-name');
        $this->tp_basic_style_controls('team_content_quote', 'Testimonial - Quote', '.tp-el-box-quote');

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

		<!--	testimonial style 2 -->
		<?php if ( $settings['tp_design_style']  == 'layout-2' ): 
            $this->add_render_attribute('title_args', 'class', 'tp-section-title-3 tp-el-title');
            $bloginfo = get_bloginfo( 'name' );

            $this->tp_link_controls_render('tpbtn', 'tp-btn-pink', $this->get_settings());
        ?>


		<!-- default style -->
		<?php else:
            $bloginfo = get_bloginfo( 'name' );

            if ( !empty($settings['background_image']['url']) ) {
                $background_image = !empty($settings['background_image']['id']) ? wp_get_attachment_image_url( $settings['background_image']['id'], $settings['tp_image_size_size']) : $settings['background_image']['url'];
                $background_image_alt = get_post_meta($settings["background_image"]["id"], "_wp_attachment_image_alt", true);
            }
            
        ?>


            <!-- testimonail area start -->
            <div class="tp-testimonial-5-area coffe-bg pt-180 pb-180 p-relative z-index-1 cursor-style tp-el-section">
                <?php if(!empty($background_image)) : ?>
               <div class="tp-testimonial-5-bg">
                  <img src="<?php echo esc_url($background_image); ?>" alt="<?php echo esc_attr($background_image_alt); ?>">
               </div>
               <?php endif; ?>
               <div class="container">
                  <div class="row">
                     <div class="col-xl-7">
                        <div class="tp-testimonial-5-content z-index-5 p-relative">
                            <?php if(!empty($settings['tp_testimonial_content'])) : ?>
                            <p class="tp-el-box-desc"><?php echo tp_kses($settings['tp_testimonial_content']); ?></p>
                            <?php endif; ?>

                            <?php if(!empty($settings['tp_testimonial_user_name'])) : ?>
                           <span class="tp-el-user-name"><?php echo tp_kses($settings['tp_testimonial_user_name']); ?></span>
                           <?php endif; ?>

                            <em class="quote-shape tp-el-box-quote">
                                <svg width="115" height="94" viewBox="0 0 115 94" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M64.8433 93V53.8755L94.7075 1H113L91.7105 47.6382H114.29V93H64.8433ZM1 93V53.8755L31.4358 1H49.7283L28.4389 47.6382H50.4464V93H1Z" fill="currentcolor"/>
                                    <path d="M64.5933 93V93.25H64.8433H114.29H114.54V93V47.6382V47.3882H114.29H92.0995L113.227 1.10382L113.389 0.75H113H94.7075H94.5615L94.4898 0.877054L64.6257 53.7525L64.5933 53.8098V53.8755V93ZM0.75 93V93.25H1H50.4464H50.6964V93V47.6382V47.3882H50.4464H28.8278L49.9558 1.10382L50.1173 0.75H49.7283H31.4358H31.2912L31.2191 0.875283L0.783331 53.7508L0.75 53.8087V53.8755V93Z" stroke="currentcolor" stroke-opacity="0.2" stroke-width="0.5"/>
                                </svg>
                            </em>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <!-- testimonail area end -->


        <?php endif; ?>

        <?php
	}
}

$widgets_manager->register( new TP_Testimonial_Box() );
