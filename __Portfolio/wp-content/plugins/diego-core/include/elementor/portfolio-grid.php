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
class TP_Portfolio_Grid extends Widget_Base {

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
		return 'tp-portfolio-grid';
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
		return __( 'Portfolio Grid', 'tpcore' );
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


        // Portfolio group
        $this->start_controls_section(
            'tp_portfolio',
            [
                'label' => esc_html__('Portfolio List', 'tpcore'),
                'description' => esc_html__( 'Control all the style settings from Style tab', 'tpcore' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
        'tp_scroll_text',
         [
            'label'       => esc_html__( 'Scroll Text', 'textdomain' ),
            'type'        => \Elementor\Controls_Manager::TEXT,
            'default'     => esc_html__( 'Scroll to Explore', 'textdomain' ),
            'placeholder' => esc_html__( 'Your Text', 'textdomain' ),
            'label_block' => true
         ]
        );

        $this->add_control(
        'tp_case_studies',
         [
            'label'       => esc_html__( 'Case Selected Text', 'textdomain' ),
            'type'        => \Elementor\Controls_Manager::TEXT,
            'default'     => esc_html__( 'Selected Case Studies (04)', 'textdomain' ),
            'placeholder' => esc_html__( 'Your Text', 'textdomain' ),
            'label_block' => true
         ]
        );


        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'repeater_condition',
            [
                'label' => __( 'Field condition', 'tpcore' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'style_1' => __( 'Style 1', 'tpcore' ),
                    'style_2' => __( 'Style 2', 'tpcore' ),
                    'style_3' => __( 'Style 3', 'tpcore' ),
                ],
                'default' => 'style_1',
                'frontend_available' => true,
                'style_transfer' => true,
            ]
        );


        $repeater->add_control(
            'tp_portfolio_image',
            [
                'label' => esc_html__('Upload Image', 'tpcore'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ]
            ]
        );


        $repeater->add_control(
            'tp_portfolio_title', [
                'label' => esc_html__('Title', 'tpcore'),
                'description' => tp_get_allowed_html_desc( 'basic' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Portfolio Title', 'tpcore'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'tp_slider_view_more_text',
            [
                'label' => esc_html__('View Demo Text', 'tpcore'),
                'description' => tp_get_allowed_html_desc( 'intermediate' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('View Demo', 'tpcore'),
                'placeholder' => esc_html__('Your Text', 'tpcore'),
                'label_block' => true,
            ]
        );


        $repeater->add_control(
            'portfolio_link_text', [
                'label' => esc_html__('Link Text', 'tpcore'),
                'description' => tp_get_allowed_html_desc( 'basic' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('View Project', 'tpcore'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'tp_portfolio_link_switcher',
            [
                'label' => esc_html__( 'Add Portfolio link', 'tpcore' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Yes', 'tpcore' ),
                'label_off' => esc_html__( 'No', 'tpcore' ),
                'return_value' => 'yes',
                'default' => 'yes',
                'separator' => 'before',
            ]
        );
        $repeater->add_control(
            'tp_portfolio_link_type',
            [
                'label' => esc_html__( 'Portfolio Link Type', 'tpcore' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    '1' => 'Custom Link',
                    '2' => 'Internal Page',
                ],
                'default' => '1',
                'condition' => [
                    'tp_portfolio_link_switcher' => 'yes'
                ]
            ]
        );
        $repeater->add_control(
            'tp_portfolio_link',
            [
                'label' => esc_html__( 'Portfolio Link', 'tpcore' ),
                'type' => \Elementor\Controls_Manager::URL,
                'dynamic' => [
                    'active' => true,
                ],
                'placeholder' => esc_html__( 'https://your-link.com', 'tpcore' ),
                'show_external' => true,
                'default' => [
                    'url' => '#',
                    'is_external' => false,
                    'nofollow' => false,
                ],
                'condition' => [
                    'tp_portfolio_link_type' => '1',
                    'tp_portfolio_link_switcher' => 'yes',
                ]
            ]
        );
        $repeater->add_control(
            'tp_portfolio_page_link',
            [
                'label' => esc_html__( 'Select Portfolio Link Page', 'tpcore' ),
                'type' => \Elementor\Controls_Manager::SELECT2,
                'label_block' => true,
                'options' => tp_get_all_pages(),
                'condition' => [
                    'tp_portfolio_link_type' => '2',
                    'tp_portfolio_link_switcher' => 'yes',
                ]
            ]
        );


        $this->add_control(
            'tp_portfolio_list',
            [
                'label' => esc_html__('Portfolio - List', 'tpcore'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'tp_portfolio_title' => esc_html__('Business Stratagy', 'tpcore'),
                    ],
                    [
                        'tp_portfolio_title' => esc_html__('Website Development', 'tpcore')
                    ],
                    [
                        'tp_portfolio_title' => esc_html__('Marketing & Reporting', 'tpcore')
                    ],
                ],
                'title_field' => '{{{ tp_portfolio_title }}}',
            ]
        );


        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'thumbnail', // // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `thumbnail_size` and `thumbnail_custom_dimension`.
                'exclude' => ['custom'],
                // 'default' => 'tp-post-thumb',
            ]
        );
        $this->end_controls_section();


	}

        // style_tab_content
    protected function style_tab_content(){


        $this->tp_section_style_controls('section_section', 'Section - Style', '.tp-el-section');
        $this->tp_basic_style_controls('portfolio_left_text', 'Section - Left Text', '.tp-el-left-text span');
        $this->tp_basic_style_controls('portfolio_right_text', 'Section - Right Text', '.tp-el-right-text span');


        $this->tp_section_style_controls('portfolio_box', 'Portfolio - Box', '.tp-el-box');
        $this->tp_basic_style_controls('portfolio_box_title', 'Portfolio - Title', '.tp-el-box-title');
        // $this->tp_basic_style_controls('portfolio_box_tag', 'Portfolio - Tag', '.tp-el-box-cat');
        // $this->tp_basic_style_controls('portfolio_box_desc', 'Portfolio - Description', '.tp-el-box-desc');
        // $this->tp_basic_style_controls('portfolio_box_num', 'Portfolio - Number', '.tp-el-box-number');
        // $this->tp_basic_style_controls('portfolio_box_link', 'Portfolio - Link', '.tp-el-box-link');
  
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
            <div class="tp-project-3__area p-relative black-bg-3 pt-110 tp-el-section">
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
                                 <a href="<?php echo esc_url($link); ?>" target="<?php echo esc_url($target); ?>" rel="<?php echo esc_url($rel); ?>">
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

        <?php elseif($settings['tp_design_style'] == 'layout-3') : ?>
            <!-- portfolio-inner area start -->
            <div class="porfolio-inner__thumb-wrapper tp-portfolio-effect portfolio-list-scroll-text-animation p-relative fix  black-bg-3 pt-80 pb-50"
               data-scrub="0.0001">

               <?php if(!empty($settings['tp_portfolio_bg_text'])) :?>
               <div class="portfolio-list-scroll-text pb-80 d-flex align-items-center">
                    <p><?php echo tp_kses($settings['tp_portfolio_bg_text']); ?></p>
                    <p><?php echo tp_kses($settings['tp_portfolio_bg_text']); ?></p>
               </div>
               <?php endif; ?>

               
               <div class="container">
                  <div class="row grid gx-90">
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

                        $attrs = array(
                            'href' => $link,
                            'target' => $target,
                            'rel' => $rel,
                        );

                        $count = $key >= 9 ? $key+1 : '0' .$key+1
                    ?>
                     <div class="col-xl-6 grid-item tp-el-box">
                        <div class="tp-portfolio-item-wrapper">
                           <div class="tp-portfolio-item mb-70">
                                <?php if ($item['tp_portfolio_link_switcher'] == 'yes') : ?>
                                 <a <?php echo tp_implode_html_attributes($attrs); ?>>
                                 <?php endif; ?>

                                 <div class="tp-portfolio-thumb <?php echo ($item['tp_portfolio_image_height_switch'] == 'yes') ? 'img-4' : 'img-1'; ?> w-img fix ">

                                    <div class="tp-portfolio-thumb-img">
                                       <img data-speed="0.85" src="<?php echo esc_url($tp_portfolio_image_url); ?>" alt="<?php echo esc_url($tp_portfolio_image_alt); ?>">
                                    </div>
                                 </div>
                                 <div class="tp-portfolio-content">

                                    <h3 class="tp-portfolio-title tp-el-box-title"><?php echo tp_kses($item['tp_portfolio_title' ]); ?></h3>

                                    <div class="tp-portfolio-meta d-flex align-items-center">

                                       <span class="tp-portfolio-meta-count tp-el-box-number"><?php echo tp_kses($count); ?></span>

                                       <span class="tp-portfolio-meta-arrow tp-el-box-link">
                                          <svg width="42" height="13" viewBox="0 0 42 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                                             <path d="M35.4889 1L41 6.33338L35.4889 11.6667" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                             <path d="M0.999998 6.33179H41" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                          </svg>
                                       </span>

                                       <div class="tp-portfolio-meta-hover">
                                            <?php if (!empty($item['tp_portfolio_cat' ])): ?>
                                            <span class="tp-el-box-cat"><?php echo tp_kses($item['tp_portfolio_cat']); ?></span>
                                            <?php endif; ?>
                                            <span class="tp-portfolio-meta-link tp-el-box-link"><?php echo tp_kses($item['portfolio_link_text']); ?></span>
                                       </div>
                                    </div>
                                 </div>
                                <?php if ($item['tp_portfolio_link_switcher'] == 'yes') : ?>
                                    </a>
                                <?php endif; ?>
                           </div>
                        </div>
                     </div>
                     <?php endforeach; ?>  

                  </div>
               </div>
            </div>
            <!-- portfolio-inner area end -->
		<?php else:
            $bg_color = 'black-bg';
            $this->add_render_attribute('title_args', 'class', 'tp-section-title tp_title_anim tp-el-title');
		?>


            <!-- project area start -->
            <div class="tp-project-4-area black-bg-5 pb-200 cursor-style tp-el-section">
               <div class="container container-1760">

                <?php if(!empty($settings['tp_case_studies']) || !empty($settings['tp_scroll_text'])): ?>
                    <div class="tp-project-4-top-wrap mb-70">
                        <div class="row">
                            <?php if(!empty($settings['tp_scroll_text'])): ?>
                            <div class="col-xl-6 col-lg-6 col-sm-6">
                                <div class="tp-project-4-text tp-el-left-text">
                                    <span><?php echo tp_kses($settings['tp_scroll_text']); ?></span>
                                </div>
                            </div>
                            <?php endif; ?>

                            <?php if(!empty($settings['tp_case_studies'])): ?>
                            <div class="col-xl-6 col-lg-6 col-sm-6">
                                <div class="tp-project-4-text text-start text-sm-end tp-el-right-text">
                                    <span><?php echo tp_kses($settings['tp_case_studies']); ?></span>
                                </div>
                            </div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <?php endif; ?>

                  <div class="tp-project-4-wrapper">
                     <div class="tp-project-4-inner-wrap">


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

                            $attrs = array(
                                'href' => $link,
                                'target' => $target,
                                'rel' => $rel,
                            );
                        ?>
                        <div class="tp-project-4-item tp-el-box">
                           <div class="tp-project-4-thumb not-hide-cursor" data-cursor="<?php echo esc_attr($item['tp_slider_view_more_text']); ?>">
                                <a class="cursor-hide" <?php echo tp_implode_html_attributes($attrs); ?>>
                                    <img src="<?php echo esc_url($tp_portfolio_image_url); ?>" alt="<?php echo esc_url($tp_portfolio_image_alt); ?>">
                                </a>
                           </div>

                           <div class="tp-project-4-content">
                                
                                <h4 class="tp-project-4-title tp-el-box-title">
                                    <?php if ($item['tp_portfolio_link_switcher'] == 'yes') : ?>
                                    <a <?php echo tp_implode_html_attributes($attrs); ?>><?php echo tp_kses($item['tp_portfolio_title' ]); ?></a>
                                    <?php else: ?>
                                        <?php echo tp_kses($item['tp_portfolio_title' ]); ?>
                                    <?php endif; ?>  
                                </h4>
                               
                           </div>

                        </div>
                        <?php endforeach; ?>  
                     </div>
                  </div>
               </div>
            </div>
            <!-- project area end -->

        <?php endif; ?>

        <?php
	}
}

$widgets_manager->register( new TP_Portfolio_Grid() );