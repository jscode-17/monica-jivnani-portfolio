<?php
namespace TPCore\Widgets;

use Elementor\Element_Section;
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
class TP_Services_Accordion extends Widget_Base {

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
        return 'services-accordion';
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
        return __( 'Services Accordion', 'tpcore' );
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
                ],
                'default' => 'layout-1',
            ]
        );

        $this->end_controls_section();


        $this->start_controls_section(
         'tp_services_sec',
             [
               'label' => esc_html__( 'Section Controls', 'tpcore' ),
               'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
             ]
        );
        
        $this->add_control(
        'tp_services_subtitle',
         [
            'label'       => esc_html__( 'Subtitle', 'tpcore' ),
            'type'        => \Elementor\Controls_Manager::TEXT,
            'default'     => esc_html__( 'Our Services', 'tpcore' ),
            'placeholder' => esc_html__( 'Your Text', 'tpcore' ),
            'label_block' => true,
         ]
        );

        $this->add_control(
         'tp_services_switch',
         [
           'label'        => esc_html__( 'Enable Shape?', 'tpcore' ),
           'type'         => \Elementor\Controls_Manager::SWITCHER,
           'label_on'     => esc_html__( 'Show', 'tpcore' ),
           'label_off'    => esc_html__( 'Hide', 'tpcore' ),
           'return_value' => 'yes',
           'default'      => 'yes',
         ]
        );

        $this->add_control(
            'tp_image',
            [
              'label'   => esc_html__( 'Upload Image', 'tpcore' ),
              'type'    => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                  'url' => \Elementor\Utils::get_placeholder_image_src(),
              ],
            ]
           );
        
        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'thumbnail_size',
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

        $this->add_control(
            'tp_service_subtitle',
             [
                'label'       => esc_html__( 'Subtitle', 'tpcore' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => esc_html__( 'Our Services', 'tpcore' ),
                'placeholder' => esc_html__( 'Placeholder Text', 'tpcore' ),
                'label_block' => true,
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
            'accordion_img',
            [
              'label'   => esc_html__( 'Upload Image', 'tpcore' ),
              'type'    => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                  'url' => \Elementor\Utils::get_placeholder_image_src(),
              ],
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
                        'accordion_title' => esc_html__( 'Visual Design', 'tpcore' ),
                    ],
                    [
                        'accordion_title' => esc_html__( 'Product Design', 'tpcore' ),
                    ],
                    [
                        'accordion_title' => esc_html__( 'Ui Kits / Design System', 'tpcore' ),
                    ],
                    [
                        'accordion_title' => esc_html__( 'Strategy', 'tpcore' ),
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
    }

    // style_tab_content
    protected function style_tab_content(){
        $this->tp_section_style_controls('services_section', 'Section - Style', '.tp-el-section');
        $this->tp_basic_style_controls('services_title', 'Services - Title', '.tp-el-title');


        $this->tp_link_controls_style('accordion_box_title', 'Accordion - Title', '.tp-el-acc-btn');
        $this->tp_basic_style_controls('accordion_box_number', 'Accordion - Number', '.tp-el-acc-number');
        $this->tp_basic_style_controls('accordion_box_subtitle', 'Accordion - Box - Subtitle', '.tp-el-acc-plus');
        $this->tp_basic_style_controls('accordion_box_description', 'Accordion - Box - Description', '.tp-el-acc-desc');
        $this->start_controls_section(
            'tp_features_box_img',
                [
                    'label' => esc_html__( 'Accordion Line Color', 'tpcore' ),
                    'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
                ]
            );
            
    
            $this->add_control(
                'tp_gradient_bg_color',
                [
                    'label' => esc_html__('Bottom Line Color', 'tp-core'),
                    'type' => Controls_Manager::COLOR,
                    'label_block' => true,
                    'selectors' => [
                        '{{WRAPPER}} .tp-el-acc-btn::after' => 'background: {{VALUE}};',
                    ],
                ]
            );
            
            $this->end_controls_section();
        $this->start_controls_section(
            'tp_acc_plus_img',
                [
                    'label' => esc_html__( 'Accordion Plus Color', 'tpcore' ),
                    'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
                ]
            );
            
    
            $this->add_control(
                'tp_acc_plus_color',
                [
                    'label' => esc_html__('Plus Line Color', 'tp-core'),
                    'type' => Controls_Manager::COLOR,
                    'label_block' => true,
                    'selectors' => [
                        '{{WRAPPER}} .tp-el-acc-plus span::after, {{WRAPPER}} .tp-el-acc-plus span::before' => 'background: {{VALUE}};',
                    ],
                ]
            );
            
            $this->end_controls_section();

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
            $this->add_render_attribute('title_args', 'class', 'tp-section-title tp_title_anim tp-el-title');
            $bloginfo = get_bloginfo( 'name' );

            if ( !empty($settings['tp_image']['url']) ) {
                $tp_image_url = !empty($settings['tp_image']['id']) ? wp_get_attachment_image_url( $settings['tp_image']['id'], $settings['thumbnail_size_size']) : $settings['tp_image']['url'];
                $tp_image_alt = get_post_meta($settings["tp_image"]["id"], "_wp_attachment_image_alt", true);
            }
            
        ?>
         

            <div class="tp-hero-2__bg black-bg-3 tp-hero-2__space-3 d-flex align-items-start justify-content-center z-index-1 p-relative fix tp-el-section">
               <div class="tp-hero-distort-2" data-background="<?php echo esc_url($tp_image_url); ?>"></div>
               <?php if($settings['tp_services_switch'] == 'yes') : ?>
               <div class="tp-hero-2__circle-wrapper">
                  <span class="tp-hero-2__circle-1"></span>
                  <span class="tp-hero-2__circle-2"></span>
                  <span class="tp-hero-2__circle-3"></span>
                  <span class="tp-hero-2__circle-4"></span>
               </div>
               <div class="tp-hero-2__boder-circle tp-hero-2__boder-circle-tr">
                  <span></span>
               </div>
                <?php endif; ?>
               <div class="container">
                  <div class="row">
                     <div class="col-xl-12">
                        <div class="tp-hero-2__service-accordion">
                            <?php if(!empty($settings['tp_services_subtitle'])) : ?>
                           <span class="tp-hero-2__service-title tp-el-title"> 
                               <?php echo tp_kses($settings['tp_services_subtitle']); ?>
                            </span>
                            <?php endif; ?>

                           <div class="accordion" id="faqaccordion-<?php echo esc_attr($this->get_id()); ?>">
                              <?php foreach ( $settings['accordions'] as $index => $item) :
                                    $collapsed = ($index == '0' ) ? '' : 'collapsed';
                                    $aria_expanded = ($index == '0' ) ? "true" : "false";
                                    $show = ($index == '0' ) ? "show" : "";
                                    $number =  $index > 9 ? "" : "0".$index+1;

                                    if ( !empty($item['accordion_img']['url']) ) {
                                        $accordion_img_url = !empty($item['accordion_img']['id']) ? wp_get_attachment_image_url( $item['accordion_img']['id'], $settings['thumbnail_size']) : $item['accordion_img']['url'];
                                        $accordion_img_alt = get_post_meta($item["accordion_img"]["id"], "_wp_attachment_image_alt", true);
                                    }
                                ?>
                              <div class="accordion-items tp-hero-2__accordion-item tp-hover-reveal-item active tp-el-acc-btn">
                                    <h2 class="accordion-header" id="headingOne-<?php echo esc_attr($index); ?>">
                                        <button class="accordion-buttons tp-el-acc-btn <?php echo esc_attr($collapsed); ?>" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne-<?php echo esc_attr($index); ?>" aria-expanded="true" aria-controls="collapseOne-<?php echo esc_attr($index); ?>">
                                            <svg width="18" height="17" viewBox="0 0 18 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" clip-rule="evenodd"  d="M16.8242 7.1633L18 8.35684L16.8246 9.55154L9.77214 16.7144L8.59672 15.5204L14.9017 9.11602H1.66227H0.831241H0V0H1.66227V7.42755H14.7336L8.59675 1.19401L9.77216 7.00782e-05L16.8242 7.1633Z" fill="white" fill-opacity="0.9" />
                                            </svg>

                                            <?php echo esc_html($item['accordion_title']); ?>
                                            <span class="tp-el-acc-number"><?php echo esc_html($number); ?></span>

                                            <span class="accordion-btn-wrap tp-el-acc-plus">
                                                <span class="accordion-btn"></span>
                                            </span>
                                        </button>
                                    </h2>
                                    

                                    <div class="tp-hover-reveal-bg" data-background="<?php echo esc_url($accordion_img_url) ?>"></div>

                                    <div id="collapseOne-<?php echo esc_attr($index); ?>" class="accordion-collapse collapse <?php echo esc_attr($show); ?>"
                                        data-bs-parent="#faqaccordion-<?php echo esc_attr($this->get_id()); ?>" aria-labelledby="headingOne-<?php echo esc_attr($index); ?>">
                                        <div class="accordion-body">
                                        <p class="tp-el-acc-desc"> <?php echo tp_kses($item['accordion_description']); ?> </p>
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
        <?php endif; ?>

        <?php
    }
}

$widgets_manager->register( new TP_Services_Accordion() ); 