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
class TP_Testimonial_Slider extends Widget_Base {

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
		return 'tp-testimonial-slider';
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
		return __( 'Testimonial Slider', 'tpcore' );
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
                    'layout-3' => esc_html__('Layout 3', 'tpcore'),
                ],
                'default' => 'layout-1',
            ]
        );

        $this->end_controls_section();

        $this->tp_section_title_render_controls('testimonial', 'Section Title', ['layout-1']);

        $this->tp_button_render_controls('tpbtn', 'Button 1', ['layout-2']);


        $this->start_controls_section(
         'tp_testimonial_sec',
             [
               'label' => esc_html__( 'Testimonial Section', 'tpcore' ),
               'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
               'condition' => [
                'tp_design_style' => 'layout-2'
               ]
             ]
        );
        
        $this->add_control(
        'tp_testimonial_sec_title',
         [
            'label'       => esc_html__( 'Title', 'tpcore' ),
            'type'        => \Elementor\Controls_Manager::TEXT,
            'default'     => esc_html__( 'What Our Clients Say', 'tpcore' ),
            'placeholder' => esc_html__( 'Your Text', 'tpcore' ),
            'label_block' => true
         ]
        );
        
        $this->add_control(
        'tp_testimonial_sec_desc',
         [
            'label'       => esc_html__( 'Description', 'tpcore' ),
            'type'        => \Elementor\Controls_Manager::TEXTAREA,
            'default'     => esc_html__( 'Ratign is given', 'tpcore' ),
            'placeholder' => esc_html__( 'Your Text', 'tpcore' ),
            'label_block' => true
         ]
        );

        $this->add_control(
         'tp_testimonial_switch',
         [
           'label'        => esc_html__( 'Enable Shape?', 'tpcore' ),
           'type'         => \Elementor\Controls_Manager::SWITCHER,
           'label_on'     => esc_html__( 'Show', 'tpcore' ),
           'label_off'    => esc_html__( 'Hide', 'tpcore' ),
           'return_value' => 'yes',
           'default'      => 'yes',
         ]
        );
        
        $this->end_controls_section();

        // Review group
        $this->start_controls_section(
            'review_list',
            [
                'label' => esc_html__( 'Review List', 'tpcore' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
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
                ],
                'default' => 'style_1',
                'frontend_available' => true,
                'style_transfer' => true,
            ]
        );


        $repeater->add_control(
            'bg_image',
            [
                'label' => esc_html__( 'Background Image', 'tpcore' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->add_control(
            'reviewer_image',
            [
                'label' => esc_html__( 'Reviewer Image', 'tpcore' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );
        $repeater->add_control(
            'reviewer_name', [
                'label' => esc_html__( 'Reviewer Name', 'tpcore' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__( 'Rasalina William' , 'tpcore' ),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'reviewer_title', [
                'label' => esc_html__( 'Reviewer Title', 'tpcore' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__( '- CEO at YES Germany' , 'tpcore' ),
                'label_block' => true,
            ]
        );
        $repeater->add_control(
            'review_content',
            [
                'label' => esc_html__( 'Review Content', 'tpcore' ),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'rows' => 10,
                'default' => 'Aklima The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections Bonorum et Malorum original.',
                'placeholder' => esc_html__( 'Type your review content here', 'tpcore' ),
            ]
        );

        $repeater->add_control(
            'review_rating',
            [
                'label' => esc_html__('Select Rating', 'tpcore'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => '5',
                'options' => [
                    '5' => esc_html__('Rating 5', 'tpcore'),
                    '4' => esc_html__('Rating 4', 'tpcore'),
                    '3' => esc_html__('Rating 3', 'tpcore'),
                    '2' => esc_html__('Rating 2', 'tpcore'),
                    '1' => esc_html__('Rating 1', 'tpcore'),
                ],   
                            
            ]
        );
        $repeater->add_control(
            'review_rating_text', [
                'label' => esc_html__( 'Rating Title', 'tpcore' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__( '5.0 Star Rating' , 'tpcore' ),
                'label_block' => true,
                'condition' => [
                  'repeater_condition' => ['style_1']
                  ] 
            ]
        );

        $repeater->add_control(
         'review_shape_switch',
         [
           'label'        => esc_html__( 'Enable Shape ?', 'tpcore' ),
           'type'         => \Elementor\Controls_Manager::SWITCHER,
           'label_on'     => esc_html__( 'Show', 'tpcore' ),
           'label_off'    => esc_html__( 'Hide', 'tpcore' ),
           'return_value' => 'yes',
           'default'      => 'yes',
           'condition' => [
            'repeater_condition' => ['style_2']
            ] 
         ]
        );

        $this->add_control(
            'reviews_list',
            [
                'label' => esc_html__( 'Review List', 'tpcore' ),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' =>  $repeater->get_controls(),
                'default' => [
                    [
                        'reviewer_name' => esc_html__( 'Rasalina William', 'tpcore' ),
                        'reviewer_title' => esc_html__( 'CEO at YES Germany', 'tpcore' ),
                        'review_content' => esc_html__( 'Construction can be defined as the art of building something. These construction quotes will put into perspective the fact that construction can be', 'tpcore' ),
                    ],
                    [
                        'reviewer_name' => esc_html__( 'Rasalina William', 'tpcore' ),
                        'reviewer_title' => esc_html__( 'CEO at YES Germany', 'tpcore' ),
                        'review_content' => esc_html__( 'Construction can be defined as the art of building something. These construction quotes will put into perspective the fact that construction can be', 'tpcore' ),
                    ],
                    [
                        'reviewer_name' => esc_html__( 'Rasalina William', 'tpcore' ),
                        'reviewer_title' => esc_html__( 'CEO at YES Germany', 'tpcore' ),
                        'review_content' => esc_html__( 'Construction can be defined as the art of building something. These construction quotes will put into perspective the fact that construction can be', 'tpcore' ),
                    ],

                ],
                'title_field' => '{{{ reviewer_name }}}',
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'thumbnail_size',
                'default' => 'thumbnail',
                'exclude' => ['custom'],
                'separator' => 'none',
            ]
        );

      $this->end_controls_section();
      
      $this->tp_common_animation(null, 'desc_title', 'Animation - Title');
      $this->tp_common_animation(null, 'desc_animation', 'Animation - Description');
    }

    // style_tab_content
    protected function style_tab_content(){
  
        $this->tp_section_style_controls('team_section', 'Section - Style', '.tp-el-section');
        $this->tp_basic_style_controls('team_subtitle', 'Section - Subtitle', '.tp-el-subtitle');
        $this->tp_basic_style_controls('team_title', 'Section - Title', '.tp-el-title');
        $this->tp_basic_style_controls('team_description', 'Section - Description', '.tp-el-content p');
        $this->tp_link_controls_style('services_btn', 'Testimonial - Button', '.tp-el-btn');
        
        $this->tp_section_style_controls('team_section_box', 'Box - Style', '.tp-el-box');
        $this->tp_basic_style_controls('testimonial_section_desc', 'Testimonial Section - Description', '.tp-el-testimonial-desc');
        $this->tp_basic_style_controls('team_content_subtitle', 'Testimonial - Subtitle', '.tp-el-box-subtitle');
        $this->tp_basic_style_controls('team_content', 'Testimonial - Content', '.tp-el-box-desc');
        $this->tp_basic_style_controls('team_content_rating', 'Testimonial - Rating', '.tp-el-box-rating span');
        $this->tp_basic_style_controls('team_content_rating_text', 'Testimonial - Rating Text', '.tp-el-box-rating-text');
        $this->tp_basic_style_controls('team_content_user', 'Testimonial - User Name', '.tp-el-user-name');
        $this->tp_basic_style_controls('team_content_designation', 'Testimonial - User Designation', '.tp-el-user-designation');
        $this->tp_link_controls_style('services_box_link_btn', 'Testimonial - Arrow - Button', '.tp-el-arrow');

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

            $this->tp_link_controls_render('tpbtn', 'tp-btn-pink tp-el-btn', $this->get_settings());
        ?>
            <div class="tp-portfolio-home-2 tp-hero-2__bg black-bg-3 tp-hero-2__space-6 d-flex align-items-start justify-content-center p-relative z-index-1 fix tp-el-section">
               <?php if($settings['tp_testimonial_switch']) : ?>
                <div class="tp-testimonial-2__star-shape">
                  <img src="<?php echo get_template_directory_uri(); ?>/assets/img/testimonial/testi-star.png" alt="<?php echo esc_attr($bloginfo); ?>">
               </div>
               <div class="tp-hero-2__boder-circle">
                  <span></span>
               </div>
                <?php endif; ?>
               <div class="container">
                  <div class="tp-testimonial-2__title-wrap">
                     <div class="row align-items-end">
                        <div class="col-xl-8 col-lg-8 col-md-8">
                            <?php if(!empty($settings['tp_testimonial_sec_title'])) : ?>
                           <div class="tp-testimonial-2__title-box">
                              <h4 class="tp-testimonial-2__title tp-el-title"><?php echo tp_kses($settings['tp_testimonial_sec_title']); ?></h4>
                           </div>
                           <?php endif; ?>
                        </div>
                        <div class="col-xl-4 col-lg-4 col-md-4">
                           <div class="tp-testimonial-2__arrow-box text-end d-flex align-items-center justify-content-end">
                              <button class="tp-testimonial-2__slider-next tp-hover-arrow-down tp-el-arrow">
                                 <span>
                                    <svg width="14" height="14" viewBox="0 0 14 14" fill="none"
                                       xmlns="http://www.w3.org/2000/svg">
                                       <path d="M13 1L1 13" stroke="currentcolor" stroke-opacity="0.9" stroke-width="2"
                                          stroke-linecap="round" stroke-linejoin="round" />
                                       <path d="M13 13H1V1" stroke="currentcolor" stroke-opacity="0.9" stroke-width="2"
                                          stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                    <svg width="14" height="14" viewBox="0 0 14 14" fill="none"
                                       xmlns="http://www.w3.org/2000/svg">
                                       <path d="M13 1L1 13" stroke="currentcolor" stroke-opacity="0.9" stroke-width="2"
                                          stroke-linecap="round" stroke-linejoin="round" />
                                       <path d="M13 13H1V1" stroke="currentcolor" stroke-opacity="0.9" stroke-width="2"
                                          stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                 </span>
                              </button>
                              <button class="tp-testimonial-2__slider-prev tp-hover-arrow-up tp-el-arrow">
                                 <span>
                                    <svg width="14" height="14" viewBox="0 0 14 14" fill="none"
                                       xmlns="http://www.w3.org/2000/svg">
                                       <path d="M1 13L13 1" stroke="currentcolor" stroke-opacity="0.9" stroke-width="2"
                                          stroke-linecap="round" stroke-linejoin="round" />
                                       <path d="M1 1H13V13" stroke="currentcolor" stroke-opacity="0.9" stroke-width="2"
                                          stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                    <svg width="14" height="14" viewBox="0 0 14 14" fill="none"
                                       xmlns="http://www.w3.org/2000/svg">
                                       <path d="M1 13L13 1" stroke="currentcolor" stroke-opacity="0.9" stroke-width="2"
                                          stroke-linecap="round" stroke-linejoin="round" />
                                       <path d="M1 1H13V13" stroke="currentcolor" stroke-opacity="0.9" stroke-width="2"
                                          stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                 </span>
                              </button>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-xl-4 col-lg-4 col-md-5">
                        <div class="tp-testimonial-2__left-box">
                           <div class="tp-testimonial-2__btn-box ">

                           <?php if (!empty($settings['tp_' . $control_id .'_text']) && $settings['tp_' . $control_id .'_button_show'] == 'yes') : ?>
                              <div class="parallax-wrap d-inline-block">
                                 <div class="parallax-element">
                                    <a <?php echo $this->get_render_attribute_string( 'tp-button-arg' . $control_id .'' ); ?>>
                                       <span>
                                          <svg class="icon-1" width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                             <path d="M1 10.9995L11 0.999512" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                             <path d="M1 0.999512H11V10.9995" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                          </svg>
                                       </span>
                                       <span data-hover="<?php echo esc_attr($settings['tp_' . $control_id .'_text']); ?>">
                                       <?php echo $settings['tp_' . $control_id .'_text']; ?>
                                       </span>
                                    </a>
                                 </div>
                              </div>
                              <?php endif; ?>

                              
                       

                              <?php if(!empty($settings['tp_testimonial_sec_desc'])) : ?>
                              <span class="tp-testimonial-2__review-text tp-el-testimonial-desc"><?php echo tp_kses($settings['tp_testimonial_sec_desc']); ?></span>
                                <?php endif; ?>
                           </div>
                           <?php if($settings['tp_testimonial_switch']) : ?>
                           <div class="tp-testimonial-2__shape-img text-center">
                              <img src="<?php echo get_template_directory_uri(); ?>/assets/img/testimonial/testimonia-2-1.png" alt="<?php echo esc_attr($bloginfo); ?>">
                           </div>
                           <?php endif; ?>
                        </div>
                     </div>
                     <div class="col-xl-8 col-lg-8 col-md-7">
                        <div class="tp-testimonial-2__slider-wrapper">
                           <div class="swiper-container tp-testimonial-2__slider-active">
                              <div class="swiper-wrapper">
                              <?php foreach ($settings['reviews_list'] as $index => $item) :
                                     if ( !empty($item['reviewer_image']['url']) ) {
                                        $tp_reviewer_image = !empty($item['reviewer_image']['id']) ? wp_get_attachment_image_url( $item['reviewer_image']['id'], $settings['thumbnail_size_size']) : $item['reviewer_image']['url'];
                                        $tp_reviewer_image_alt = get_post_meta($item["reviewer_image"]["id"], "_wp_attachment_image_alt", true);
                                    }
                                ?>
                                 <div class="swiper-slide">
                                    <div class="tp-testimonial-2__slider-item tp-el-box">
                                    <?php if ( !empty($item['review_content']) ) : ?>
                                       <div class="tp-testimonial-2__slider-text">
                                          <p class="tp-el-box-desc"><?php echo tp_kses($item['review_content']); ?></p>
                                       </div>
                                        <?php endif; ?>


                                       <div class="tp-testimonial-2__author d-flex align-items-center">
                                        <?php if ( !empty($tp_reviewer_image) ) : ?>
                                          <div class="tp-testimonial-2__avata">
                                            <img src="<?php echo esc_url($tp_reviewer_image); ?>" alt="<?php echo esc_url($tp_reviewer_image_alt); ?>">
                                          </div>
                                          <?php endif; ?>
                                          
                                       
                                        
                                          <div class="tp-testimonial-2__author-info">

                                             <?php if ( !empty($item['reviewer_name']) ) : ?>
                                            <h4 class="tp-testimonial-2__author-title tp-el-user-name"><?php echo tp_kses($item['reviewer_name']); ?></h4>
                                            <?php endif; ?>

                                            <?php if ( !empty($item['reviewer_title']) ) : ?>
                                            <span class="tp-el-user-designation"><?php echo tp_kses($item['reviewer_title']); ?></span>
                                            <?php endif; ?>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                                 <?php endforeach; ?>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>

         <?php elseif ( $settings['tp_design_style']  == 'layout-3' ): 
            $bloginfo = get_bloginfo( 'name' );
         ?>
            <!-- testimonial area start -->
            <section class="tp-testimonial-area sv-inner__customize pt-25 pb-160 tp-el-section">
               <div class="container">
                  <div class="row">
                     <div class="col-xl-12">
                        <div class="tp-testimonial-slider ml-70 mr-70">
                           <div class="tp-testimonial-slider-active-2 swiper-container">
                              <div class="swiper-wrapper">
                              <?php foreach ($settings['reviews_list'] as $index => $item) :
                                    if ( !empty($item['bg_image']['url']) ) {
                                        $tp_bg_image = !empty($item['bg_image']['id']) ? wp_get_attachment_image_url( $item['bg_image']['id'], $settings['thumbnail_size_size']) : $item['bg_image']['url'];
                                        $tp_bg_image_alt = get_post_meta($item["bg_image"]["id"], "_wp_attachment_image_alt", true);
                                    }
                                ?>
                                 <div class="swiper-slide">
                                    <div class="tp-testimonial-item theme-bg-2 tp-el-box" data-background="<?php echo esc_url($tp_bg_image) ?>">
                                       <div class="tp-testimonial-quote">
                                          <img src="<?php echo get_template_directory_uri(); ?>/assets/img/testimonial/quote.svg" alt="<?php echo esc_attr($bloginfo); ?>">
                                       </div>

                                       <div class="tp-testimonial-item-top d-flex align-items-center">
                                          <div class="tp-testimonial-rating tp-el-box-rating">
                                          <?php for ($i=0; $i < $item['review_rating']; $i++) : ?>
                                             <span>
                                                <svg width="14" height="14" viewBox="0 0 14 14" fill="none" ßxmlns="http://www.w3.org/2000/svg">
                                                   <path  d="M7 0L9.163 4.60778L14 5.35121L10.5 8.93586L11.326 14L7 11.6078L2.674 14L3.5 8.93586L0 5.35121L4.837 4.60778L7 0Z" fill="currentColor" />
                                                </svg>
                                             </span>
                                            <?php endfor; ?>  
                                          </div>
                                          <p class="tp-el-box-rating-text"><?php echo tp_kses($item['review_rating_text']); ?></p>
                                       </div>

                                       <?php if ( !empty($item['review_content']) ) : ?>
                                       <div class="tp-testimonial-content">
                                            <p class="tp-el-box-desc"><?php echo tp_kses($item['review_content']); ?></p>
                                        </div>
                                        <?php endif; ?>

                                    </div>
                                 </div>
                                 <?php endforeach; ?>
                              </div>
                           </div>
                           <div class="tp-testimonial-thumb-slider">
                              <div class="tp-testimonial-nav-2 swiper-container">
                                 <div class="swiper-wrapper">
                                 <?php foreach ($settings['reviews_list'] as $index => $item) :
                                        if ( !empty($item['reviewer_image']['url']) ) {
                                            $tp_reviewer_image = !empty($item['reviewer_image']['id']) ? wp_get_attachment_image_url( $item['reviewer_image']['id'], $settings['thumbnail_size_size']) : $item['reviewer_image']['url'];
                                            $tp_reviewer_image_alt = get_post_meta($item["reviewer_image"]["id"], "_wp_attachment_image_alt", true);
                                        }
                                    ?>
                                    <div class="swiper-slide">
                                       <div class="tp-testimonial-user-item d-flex justify-content-center align-items-center">

                                        <?php if ( !empty($tp_reviewer_image) ) : ?>
                                        <div class="tp-testimonial-user-thumb">
                                            <img src="<?php echo esc_url($tp_reviewer_image); ?>" alt="<?php echo esc_url($tp_reviewer_image_alt); ?>">
                                        </div>
                                        <?php endif; ?>
                                        
                                        <div class="tp-testimonial-user-content">
                                            <?php if ( !empty($item['reviewer_name']) ) : ?>
                                            <h3 class="tp-testimonial-user-title tp-el-user-name"><?php echo tp_kses($item['reviewer_name']); ?></h3>
                                            <?php endif; ?>

                                            <?php if ( !empty($item['reviewer_title']) ) : ?>
                                            <span class="tp-testimonial-user-designation tp-el-user-designation"><?php echo tp_kses($item['reviewer_title']); ?></span>
                                            <?php endif; ?>
                                        </div>
                                       </div>
                                    </div>
                                    <?php endforeach; ?>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </section>
            <!-- testimonial area end -->

		<!-- default style -->
		<?php else:
            $this->add_render_attribute('title_args', 'class', 'tp-section-title tp-el-title ' .
            $this->tp_common_animation_get($settings, 'desc_title'));
            $bloginfo = get_bloginfo( 'name' );
            
        ?>


            <!-- testimonial area start -->
            <section class="tp-testimonial-area tp-bg-light pt-25 pb-80 tp-el-section">
               <div class="container">
                   <?php if ( !empty($settings['tp_testimonial_section_title_show']) ) : ?>
                  <div class="row">
                     <div class="col-xl-12">
                        <div class="tp-testimonial-section-title">
                           <div class="tp-section-title-wrapper <?php echo esc_attr($this->tp_common_animation_get($settings, 'desc_animation')) ?> mb-50 text-center tp-el-content">
                              <div class="tp-section-title-inner <?php echo esc_attr($this->tp_common_animation_get($settings, 'desc_animation')) ?> p-relative">
                                
                                <?php if ( !empty($settings['tp_testimonial_sub_title']) ) : ?>
                                <span class="tp-section-subtitle tp-el-subtitle"><?php echo tp_kses( $settings['tp_testimonial_sub_title'] ); ?></span>
                                <?php endif; ?>

                                 <?php
                                        if ( !empty($settings['tp_testimonial_title' ]) ) :
                                            printf( '<%1$s %2$s>%3$s</%1$s>',
                                                tag_escape( $settings['tp_testimonial_title_tag'] ),
                                                $this->get_render_attribute_string( 'title_args' ),
                                                tp_kses( $settings['tp_testimonial_title' ] )
                                                );
                                        endif;
                                    ?>
                              </div>
                                <?php if ( !empty($settings['tp_testimonial_description']) ) : ?>
                                    <p><?php echo tp_kses( $settings['tp_testimonial_description'] ); ?></p>
                                <?php endif; ?>
                           </div>
                        </div>
                     </div>    
                  </div>
                  <?php endif; ?>
                  <div class="row">
                     <div class="col-xl-12">
                        <div class="tp-testimonial-slider ml-70 mr-70">

                           <div class="tp-testimonial-slider-active swiper-container">
                              <div class="swiper-wrapper">

                              <?php foreach ($settings['reviews_list'] as $index => $item) :
                                    if ( !empty($item['bg_image']['url']) ) {
                                        $tp_bg_image = !empty($item['bg_image']['id']) ? wp_get_attachment_image_url( $item['bg_image']['id'], $settings['thumbnail_size_size']) : $item['bg_image']['url'];
                                        $tp_bg_image_alt = get_post_meta($item["bg_image"]["id"], "_wp_attachment_image_alt", true);
                                    }
                                ?>
                                 <div class="swiper-slide">
                                    <div class="tp-testimonial-item theme-bg-2 tp-el-box" data-background="<?php echo esc_url($tp_bg_image) ?>">
                                       <div class="tp-testimonial-quote">
                                          <img src="<?php echo get_template_directory_uri(); ?>/assets/img/testimonial/quote.svg" alt="<?php echo esc_attr($bloginfo); ?>">
                                       </div>

                                       <div class="tp-testimonial-item-top d-flex align-items-center">
                                          <div class="tp-testimonial-rating tp-el-box-rating">
                                          <?php for ($i=0; $i < $item['review_rating']; $i++) : ?>
                                             <span>
                                                <svg width="14" height="14" viewBox="0 0 14 14" fill="none" ßxmlns="http://www.w3.org/2000/svg">
                                                   <path  d="M7 0L9.163 4.60778L14 5.35121L10.5 8.93586L11.326 14L7 11.6078L2.674 14L3.5 8.93586L0 5.35121L4.837 4.60778L7 0Z" fill="currentColor" />
                                                </svg>
                                             </span>
                                            <?php endfor; ?>  
                                          </div>
                                          <p class="tp-el-box-rating-text"><?php echo tp_kses($item['review_rating_text']); ?></p>
                                       </div>

                                       <?php if ( !empty($item['review_content']) ) : ?>
                                       <div class="tp-testimonial-content">
                                            <p class="tp-el-box-desc"><?php echo tp_kses($item['review_content']); ?></p>
                                        </div>
                                        <?php endif; ?>

                                    </div>
                                 </div>
                                 <?php endforeach; ?>
                              </div>
                           </div>

                           <div class="tp-testimonial-thumb-slider">
                              <div class="tp-testimonial-nav swiper-container">
                                 <div class="swiper-wrapper">

                                    <?php foreach ($settings['reviews_list'] as $index => $item) :
                                        if ( !empty($item['reviewer_image']['url']) ) {
                                            $tp_reviewer_image = !empty($item['reviewer_image']['id']) ? wp_get_attachment_image_url( $item['reviewer_image']['id'], $settings['thumbnail_size_size']) : $item['reviewer_image']['url'];
                                            $tp_reviewer_image_alt = get_post_meta($item["reviewer_image"]["id"], "_wp_attachment_image_alt", true);
                                        }
                                    ?>
                                    <div class="swiper-slide">
                                       <div class="tp-testimonial-user-item d-flex justify-content-center align-items-center">

                                        <?php if ( !empty($tp_reviewer_image) ) : ?>
                                        <div class="tp-testimonial-user-thumb">
                                            <img src="<?php echo esc_url($tp_reviewer_image); ?>" alt="<?php echo esc_url($tp_reviewer_image_alt); ?>">
                                        </div>
                                        <?php endif; ?>
                                        
                                        <div class="tp-testimonial-user-content">
                                            <?php if ( !empty($item['reviewer_name']) ) : ?>
                                            <h3 class="tp-testimonial-user-title tp-el-user-name"><?php echo tp_kses($item['reviewer_name']); ?></h3>
                                            <?php endif; ?>

                                            <?php if ( !empty($item['reviewer_title']) ) : ?>
                                            <span class="tp-testimonial-user-designation tp-el-user-designation"><?php echo tp_kses($item['reviewer_title']); ?></span>
                                            <?php endif; ?>
                                        </div>
                                        <span class="tp-testimonial-user-border"></span>
                                       </div>
                                    </div>
                                    <?php endforeach; ?>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </section>
            <!-- testimonial area end -->

        <?php endif; ?>

        <?php
	}
}

$widgets_manager->register( new TP_Testimonial_Slider() );
