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
class TP_Portfolio_Hero extends Widget_Base {

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
		return 'tp-portfolio-hero';
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
		return __( 'Portfolio Hero', 'tpcore' );
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
            'tp_portfolio_thumb_sec',
                [
                  'label' => esc_html__( 'Thumbnails', 'tpcore' ),
                  'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
                ]
           );
           
           $this->add_control(
            'tp_portfolio_title',
            [
              'label'       => esc_html__( 'Title', 'tpcore' ),
              'type'        => \Elementor\Controls_Manager::TEXTAREA,
              'rows'        => 10,
              'default'     => esc_html__( 'Award-Winning Projects ', 'tpcore' ),
              'placeholder' => esc_html__( 'Placeholder Text', 'tpcore' ),
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
                    'tp_portfolio_thumb_title'   => esc_html__( '01', 'tpcore' ),
                  ],
                  [
                    'tp_portfolio_thumb_title'   => esc_html__( '02', 'tpcore' ),
                  ],
                ],
                'title_field' => '{{{ tp_portfolio_thumb_title }}}',
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

        $this->tp_common_animation(null, 'desc_title', 'Animation - Title');


    }

        // style_tab_content
    protected function style_tab_content(){


        $this->tp_section_style_controls('section_section', 'Section - Style', '.tp-el-section');
        $this->tp_section_style_controls('section_overlay', 'Overlay - Style', '.tp-el-overlay::after');
        $this->tp_basic_style_controls('section_title', 'Section - Title', '.tp-el-title');
  
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
            $this->add_render_attribute('title_args', 'class', 'tp-section-title-3 tp_title_anim tp-el-title');
            $bloginfo = get_bloginfo( 'name' );  

        ?>
            <!-- project area start -->
            <div class="tp-project-3__area p-relative black-bg-3 pt-110">
               <div class="container">
               <?php if ( !empty($settings['tp_portfolio_section_title_show']) ) : ?>
                  <div class="row">
                     <div class="col-xl-12">
                        <div class="tp-project-3__title-box pb-30 text-center portfolio-sec-pin">

                           <?php if ( !empty($settings['tp_portfolio_sub_title']) ) : ?>
                            <span class="tp-section-subtitle-3 tp_title_anim tp-el-subtitle"><?php echo tp_kses( $settings['tp_portfolio_sub_title'] ); ?></span>
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
                     </div>
                  </div>
                  <?php endif; ?>
                  <div class="row">
                     <div class="col-xl-12">
                        <div class="tp-portfolio-item-wrapper-3">
                            <?php foreach ($settings['tp_portfolio_list'] as $key => $item) :
                                if ( !empty($item['tp_portfolio_image']['url']) ) {
                                    $tp_portfolio_image_url = !empty($item['tp_portfolio_image']['id']) ? wp_get_attachment_image_url( $item['tp_portfolio_image']['id'], $settings['thumbnail_size']) : $item['tp_portfolio_image']['url'];
                                    $tp_portfolio_image_alt = get_post_meta($item["tp_portfolio_image"]["id"], "_wp_attachment_image_alt", true);
                                }

                                // Link
                                if ('2' == $item['tp_portfolio_link_type']) {
                                    $link = get_permalink($item['tp_portfolio_page_link']);
                                    $target = '_self';
                                    $rel = 'nofollow';
                                } else {
                                    $link = !empty($item['tp_portfolio_link']['url']) ? $item['tp_portfolio_link']['url'] : '';
                                    $target = !empty($item['tp_portfolio_link']['is_external']) ? '_blank' : '';
                                    $rel = !empty($item['tp_portfolio_link']['nofollow']) ? 'nofollow' : '';
                                }
                            ?>
                                <div class="tp-portfolio-item-3 portfolio-panel pb-80 tp-hover-reveal-text">
                                <?php if ($item['tp_portfolio_link_switcher'] == 'yes') : ?>
                                 <a href="<?php echo esc_url($link); ?>">
                                 <?php endif; ?>
                                 <img src="<?php echo esc_url($tp_portfolio_image_url); ?>" alt="<?php echo esc_attr($tp_portfolio_image_alt); ?>">
                                 <span></span>
                                 <div class="tp-portfolio-view-btn-3">
                                    <span><?php echo tp_kses($item['portfolio_link_text']); ?></span>
                                 </div>
                            <?php if ($item['tp_portfolio_link_switcher'] == 'yes') : ?>
                                </a>
                            <?php endif; ?>
                           </div>
                           <?php endforeach; ?> 
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <!-- project area end -->


		<?php else:
            $bg_color = 'black-bg';
            $this->add_render_attribute('title_args', 'class', 'tp-section-title tp-el-title ' .
            $this->tp_common_animation_get($settings, 'desc_title'));

		?>


            <!-- portfolio-slider area end -->
            <div class="porfolio-inner__slider-area porfolio-inner__ptb black-bg-3 p-relative fix tp-el-section">
               <div class="container-fluid">
                  <div class="row">
                     <div class="col-xl-12">
                        <div class="porfolio-inner__overlay tp-el-overlay">
                            <?php if(!empty($settings['tp_portfolio_title'])) : ?>
                           <div class="porfolio-inner__text-1">
                              <h4 class="porfolio-inner__slider-title tp_title_anim tp-el-title"><?php echo tp_kses($settings['tp_portfolio_title']); ?></h4>
                            </div>
                            <?php endif; ?>


                           <div class="porfolio-inner__slider-active">

                                <?php foreach ($settings['tp_portfolio_thumb_list'] as $key => $item) : 
                                    if ( !empty($item['tp_image']['url']) ) {
                                        $tp_image = !empty($item['tp_image']['id']) ? wp_get_attachment_image_url( $item['tp_image']['id'], $settings['tp_image_size_size']) : $item['tp_image']['url'];
                                        $tp_image_alt = get_post_meta($item["tp_image"]["id"], "_wp_attachment_image_alt", true);
                                    }
                                ?>
                                <?php if(!empty($tp_image)) : ?>
                                <div class="porfolio-inner__thumb">
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
            <!-- portfolio-slider area start -->

            

        <?php endif; ?>

        <?php
	}
}

$widgets_manager->register( new TP_Portfolio_Hero() );