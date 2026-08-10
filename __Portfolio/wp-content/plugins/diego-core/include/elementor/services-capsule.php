<?php
namespace TPCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Repeater;
use \Elementor\Utils;
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
class TP_Services_Capsule extends Widget_Base {

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
        return 'services-capsule';
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
        return __( 'Services Capsule', 'tpcore' );
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

        $this->tp_section_title_render_controls('services', 'Section Title');

        // Service group
        $this->start_controls_section(
            'tp_services',
            [
                'label' => esc_html__('Services List', 'tpcore'),
                'description' => esc_html__( 'Control all the style settings from Style tab', 'tpcore' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
        'services_bg_text',
         [
            'label'       => esc_html__( 'Background Text', 'tpcore' ),
            'type'        => \Elementor\Controls_Manager::TEXT,
            'default'     => esc_html__( 'Services', 'tpcore' ),
            'placeholder' => esc_html__( 'Your Text', 'tpcore' ),
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
        'tp_service_title',
         [
            'label'       => esc_html__( 'Item Title', 'tpcore' ),
            'type'        => \Elementor\Controls_Manager::TEXT,
            'default'     => esc_html__( 'Digigal Agency', 'tpcore' ),
            'placeholder' => esc_html__( 'Placeholder Text', 'tpcore' ),
            'label_block' => true,
         ]
        );

        $repeater->add_control(
         'tp_service_title_img_switch',
         [
           'label'        => esc_html__( 'Add Image ?', 'tpcore' ),
           'type'         => \Elementor\Controls_Manager::SWITCHER,
           'label_on'     => esc_html__( 'Show', 'tpcore' ),
           'label_off'    => esc_html__( 'Hide', 'tpcore' ),
           'return_value' => 'yes',
           'default'      => 'no',
           
         ]
        );
        
        $repeater->add_control(
         'tp_service_title_img',
         [
           'label'   => esc_html__( 'Upload Image', 'tpcore' ),
           'type'    => \Elementor\Controls_Manager::MEDIA,
             'default' => [
               'url' => \Elementor\Utils::get_placeholder_image_src(),
           ],
           'condition' => [
            'tp_service_title_img_switch' => 'yes'
           ]
         ]
        );

        $repeater->add_control(
            'want_customize',
            [
                'label' => esc_html__( 'Want To Customize?', 'tpcore' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Yes', 'tpcore' ),
                'label_off' => esc_html__( 'No', 'tpcore' ),
                'return_value' => 'yes',
                'description' => esc_html__( 'You can customize this item from here or customize from Style tab', 'tpcore' ),
                'style_transfer' => true,
            ]
        );
        
        
        $repeater->add_control(
            'services_capsule_bg',
            [
                'label'       => esc_html__( 'Capsule Text Color', 'tpcore' ),
                'type'     => \Elementor\Controls_Manager::COLOR,
                'selectors' => ['{{WRAPPER}} {{CURRENT_ITEM}} span' => 'color: {{VALUE}}'],
                'default' => '#fff',
                'condition' => ['want_customize' => 'yes'],
            ]
        );
        
        $repeater->add_control(
            'services_capsule_text',
            [
                'label'       => esc_html__( 'Capsule BG Color', 'tpcore' ),
                'type'     => \Elementor\Controls_Manager::COLOR,
                'selectors' => ['{{WRAPPER}} {{CURRENT_ITEM}} span' => 'background-color: {{VALUE}}'],
                'default' => '#00CC97',
                'condition' => ['want_customize' => 'yes'],
            ]
        );

        $this->add_control(
            'tp_service_list',
            [
                'label' => esc_html__('Services - List', 'tpcore'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'tp_service_title' => esc_html__('Business Stratagy', 'tpcore'),
                    ],
                    [
                        'tp_service_title' => esc_html__('Website Development', 'tpcore')
                    ],
                    [
                        'tp_service_title' => esc_html__('Marketing & Reporting', 'tpcore')
                    ]
                ],
                'title_field' => '{{{ tp_service_title }}}',
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'thumbnail',
                'default' => 'medium_large',
                'separator' => 'before',
                'exclude' => [
                    'custom'
                ]
            ]
        );

        $this->end_controls_section();



		$this->start_controls_section(
            '_accordion',
            [
                'label' => esc_html__( 'Accordion', 'tpcore' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );



        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'accordion_title', [
                'label' => esc_html__( 'Accordion Item', 'tpcore' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__( 'This is accordion item title' , 'tpcore' ),
                'label_block' => true,
            ]
        );
        $repeater->add_control(
            'accordion_description',
            [
                'label' => esc_html__('Description', 'tpcore'),
                'description' => tp_get_allowed_html_desc( 'intermediate' ),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => 'Facilis fugiat hic ipsam iusto laudantium libero maiores minima molestiae mollitia repellat rerum sunt ullam voluptates? Perferendis, suscipit.',
                'label_block' => true,
            ]
        );

        $repeater->add_control(
         'accordion_default_key',
         [
           'label'        => esc_html__( 'Default Open?', 'textdomain' ),
           'type'         => \Elementor\Controls_Manager::SWITCHER,
           'label_on'     => esc_html__( 'Show', 'textdomain' ),
           'label_off'    => esc_html__( 'Hide', 'textdomain' ),
           'return_value' => 'yes',
           'default'      => 'no',
         ]
        );
        $this->add_control(
            'accordions',
            [
                'label' => esc_html__( 'Repeater Accordion', 'tpcore' ),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'accordion_title' => esc_html__( 'This is accordion item title #1', 'tpcore' ),
                    ],
                    [
                        'accordion_title' => esc_html__( 'This is accordion item title #2', 'tpcore' ),
                    ],
                    [
                        'accordion_title' => esc_html__( 'This is accordion item title #3', 'tpcore' ),
                    ],
                    [
                        'accordion_title' => esc_html__( 'This is accordion item title #4', 'tpcore' ),
                    ],
                ],
                'title_field' => '{{{ accordion_title }}}',
            ]
        );

        $this->add_control(
            'space_accordion_item',
            [
                'label' => esc_html__( 'Accordion space gap', 'tpcore' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .faq__wrapper .accordion-item' => 'margin-top: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->tp_common_animation(null, 'desc_title', 'Animation - Title');
        $this->tp_common_animation(null, 'desc_animation', 'Animation - Description');
    }

    // style_tab_content
    protected function style_tab_content(){
        $this->tp_section_style_controls('services_section', 'Section - Style', '.tp-el-section');
        $this->tp_basic_style_controls('services_subtitle', 'Services - Subtitle', '.tp-el-subtitle');
        $this->tp_basic_style_controls('services_title', 'Services - Title', '.tp-el-title');
        $this->tp_basic_style_controls('services_description', 'Services - Description', '.tp-el-content p');

        $this->tp_section_style_controls('services_section_left', 'Section Left - Style', '.tp-el-left-section');
        $this->tp_section_style_controls('services_section_right', 'Section Right - Style', '.tp-el-right-section');
        $this->tp_section_style_controls('services_section_box', 'Box - Style', '.tp-el-box');
        $this->tp_basic_style_controls('services_box_title', 'Services - Box - Title', '.tp-el-box-title');
        $this->tp_basic_style_controls('services_box_bg_text', 'Services - BG Text', '.tp-el-bg-text p');
        $this->tp_basic_style_controls('services_box_subtitle', 'Services - Box - Subtitle', '.tp-el-box-number span');
        $this->tp_basic_style_controls('services_box_description', 'Services - Box - Description', '.tp-el-box-desc');
    

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
            $this->add_render_attribute('title_args', 'class', 'section__title-4 tp-el-title');

        ?>


        <?php else:
            $this->add_render_attribute('title_args', 'class', 'tp-section-title tp-el-title ' . $this->tp_common_animation_get($settings, 'desc_title'));
            $bloginfo = get_bloginfo( 'name' );

            
        ?>
         

            <!-- service area start -->
            <section class="tp-services-area tp-sv tp-services-bg-text-animation fix tp-el-section">
               <div class="container container-large">
                  <div class="tp-services-inner pb-195 p-relative z-index-1">

                     <span class="tp-services-inner-border tp-vertical-line transition-3"></span>
                     <span class="tp-services-inner-border right tp-vertical-line transition-3"></span>

                     <?php if(!empty($settings['services_bg_text'])) : ?>
                     <div class="tp-services-bottom-text tp-services-bg-text tp-el-bg-text">
                        <p><?php echo tp_kses($settings['services_bg_text']); ?></p>
                     </div>
                     <?php endif; ?>
                     <div class="row gx-0">
                        <div class="col-xl-6 col-lg-7">
                           <div class="tp-services-wrapper tp-services-capsule-wrapper p-relative  pt-100 pr-70 tp-el-left-section"
                              data-tp-throwable-scene="true">

                              <?php if ( !empty($settings['tp_services_section_title_show']) ) : ?>
                              <div class="tp-section-title-wrapper mb-170 tp-el-content <?php echo esc_attr($this->tp_common_animation_get($settings, 'desc_animation')) ?>">
                                 <div class="tp-section-title-inner p-relative">

                                    <?php if ( !empty($settings['tp_services_sub_title']) ) : ?>
                                    <span class="tp-section-subtitle tp-el-subtitle">
                                        <?php echo tp_kses( $settings['tp_services_sub_title'] ); ?>
                                    </span>
                                    <?php endif; ?>

                                    <?php
                                        if ( !empty($settings['tp_services_title' ]) ) :
                                            printf( '<%1$s %2$s>%3$s</%1$s>',
                                                tag_escape( $settings['tp_services_title_tag'] ),
                                                $this->get_render_attribute_string( 'title_args' ),
                                                tp_kses( $settings['tp_services_title' ] )
                                                );
                                        endif;
                                    ?>

                                 </div>
                                 <?php if ( !empty($settings['tp_services_description']) ) : ?>
                                    <p><?php echo tp_kses( $settings['tp_services_description'] ); ?></p>
                                <?php endif; ?>
                              </div>
                              <?php endif; ?>

                              <div class="tp-services-capsule-item-wrapper">

                                <?php foreach ($settings['tp_service_list'] as $key => $item) :
                                    if ( !empty($item['tp_service_title_img']['url']) ) {
                                        $tp_service_title_img_url = !empty($item['tp_service_title_img']['id']) ? wp_get_attachment_image_url( $item['tp_service_title_img']['id'], $settings['thumbnail_size']) : $item['tp_service_title_img']['url'];
                                        $tp_service_title_img_alt = get_post_meta($item["tp_service_title_img"]["id"], "_wp_attachment_image_alt", true);
                                    }
                                ?>

                                    <?php if($item['tp_service_title_img_switch'] == 'yes') : ?>
                                        <p data-tp-throwable-el="" class="elementor-repeater-item-<?php echo esc_attr($item['_id']); ?>">
                                            <span class="">
                                                <img src="<?php echo esc_url($tp_service_title_img_url); ?>" alt="<?php echo esc_attr($tp_service_title_img_alt); ?>">
                                            </span>
                                        </p>
                                    <?php else : ?>
                                        <?php if(!empty($item['tp_service_title'])) : ?>
                                        <p data-tp-throwable-el="" class="elementor-repeater-item-<?php echo esc_attr($item['_id']); ?>">
                                            <span class="tp-services-capsule-item"><?php echo tp_kses($item['tp_service_title']); ?></span>
                                        </p>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                
                                 
                                 <?php endforeach; ?>
                              </div>
                           </div>
                        </div>
                        <div class="col-xl-6 col-lg-5">

                        <div class="tp-services-accordion tp-accordion tp-accordion-2 mt-90 pl-70 p-relative tp-el-right-section">
                              <span class="tp-services-accordion-border"></span>
                              <div class="accordion" id="faqaccordion-<?php echo esc_attr($this->get_id()); ?>">
                                <?php foreach ( $settings['accordions'] as $index => $item) :
                                    $number =  $index > 9 ? "" : "0".($index+1);

                                    $show = $item['accordion_default_key'] == 'yes' ? 'show' : '';
                                    $collapsed = $item['accordion_default_key'] == 'yes' ? '' : 'collapsed';
                                    $aria_expanded = $item['accordion_default_key'] == 'yes' ? 'true' : 'false';


                                ?>
                                 <div class="accordion-item tp-services-accordion-item tp-el-box">
                                    <h2 class="accordion-header" id="headingOne-<?php echo esc_attr($index); ?>">
                                       <button class="accordion-button tp-el-box-title tp-el-box-number <?php echo esc_attr($collapsed); ?>" type="button"
                                          data-bs-toggle="collapse" data-bs-target="#collapseOne-<?php echo esc_attr($index); ?>" aria-expanded="<?php echo esc_attr($aria_expanded); ?>"
                                          aria-controls="collapseOne-<?php echo esc_attr($index); ?>">
                                          <span><?php echo esc_html($number); ?></span>
                                          <?php echo esc_html($item['accordion_title']); ?>
                                       </button>
                                    </h2>
                                    <div id="collapseOne-<?php echo esc_attr($index); ?>" class="accordion-collapse collapse <?php echo esc_attr($show); ?>"
                                       aria-labelledby="headingOne-<?php echo esc_attr($index); ?>" data-bs-parent="#faqaccordion-<?php echo esc_attr($this->get_id()); ?>"">
                                       <div class="accordion-body tp-el-box-desc">
                                       <?php echo tp_kses($item['accordion_description']); ?>
                                       </div>
                                    </div>
                                    <span class="accordion-item-border"></span>
                                 </div>
                                 <?php endforeach; ?>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </section>
            <!-- service area end -->

        <?php endif; ?>

        <?php
    }
}

$widgets_manager->register( new TP_Services_Capsule() ); 