<?php
namespace TPCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Repeater;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Utils;
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Tp Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class TP_Advanced_Tab extends Widget_Base {

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
		return 'advanced-tab';
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
		return __( 'Advanced Tab', 'tpcore' );
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

        $this->tp_section_title_render_controls('adt', 'Section Title');



		$this->start_controls_section(
            '_section_price_tabs',
            [
                'label' => __('Advanced Tabs', 'tpcore'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
         'adt_shape_switch',
         [
           'label'        => esc_html__( 'Enable Shapes ?', 'tpcore' ),
           'type'         => \Elementor\Controls_Manager::SWITCHER,
           'label_on'     => esc_html__( 'Show', 'tpcore' ),
           'label_off'    => esc_html__( 'Hide', 'tpcore' ),
           'return_value' => 'yes',
           'default'      => 'yes',
           'condition' => [
            'tp_design_style' => 'layout-1'
        ]
         ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'title',
            [
                'type' => Controls_Manager::TEXT,
                'label' => __('Title', 'tpcore'),
                'default' => __('Tab Title', 'tpcore'),
                'placeholder' => __('Type Tab Title', 'tpcore'),
                'label_block' => true,
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->add_control(
            'active_tab',
            [
                'label' => __('Is Active Tab?', 'tpcore'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __('Yes', 'tpcore'),
                'label_off' => __('No', 'tpcore'),
                'return_value' => 'yes',
                'default' => 'yes',
                'frontend_available' => true,
            ]
        );

        $repeater->add_control(
            'template',
            [
                'label' => __('Section Template', 'tpcore'),
                'placeholder' => __('Select a section template for as tab content', 'tpcore'),
  
                'type' => Controls_Manager::SELECT2,
                'options' => get_elementor_templates()
            ]
        );

        $this->add_control(
            'tabs',
            [
                'show_label' => false,
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'title_field' => '{{title}}',
                'default' => [
                    [
                        'title' => 'Tech',
                    ],
                    [
                        'title' => 'Design',
                    ]
                ]
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            '_tp_image_section',
            [
                'label' => esc_html__('Background Image', 'tp-core'),
                'condition' => [
                    'tp_design_style' => 'layout-1'
                ]
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
                'name' => 'background_image_size',
                'default' => 'full',
                'exclude' => [
                    'custom'
                ]
            ]
        );
        $this->end_controls_section();

        $this->tp_common_animation(null, 'desc_title', 'Animation - Title');
        $this->tp_common_animation(null, 'desc_animation', 'Animation - Description');

        
	}

    // style_tab_content
    protected function style_tab_content(){
        $this->tp_section_style_controls('fact_section', 'Section - Style', '.tp-el-section');
        $this->tp_basic_style_controls('about_subtitle', 'Section - Subtitle', '.tp-el-subtitle');
        $this->tp_basic_style_controls('about_title', 'Section - Title', '.tp-el-title');
        $this->tp_basic_style_controls('about_description', 'Section - Description', '.tp-el-content p');

        $this->tp_link_controls_style('about_tab_btn', 'Tab - Button', '.tp-el-tab-btn');
        $this->tp_link_controls_style('tab_item_active', 'Tab - Item Active', '.tp-el-tab-btn.active');
        $this->tp_section_style_controls('about_tab_btn_line', 'Tab - Line', '.tp-el-tab-line');
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
            $this->add_render_attribute('title_args', 'class', 'tp-section-title tp-el-title ' .
                $this->tp_common_animation_get($settings, 'desc_title'));
        ?>
            <!-- price area start -->
            <section class="tp-pcb-area pt-80 pb-70 tp-el-section">
               <div class="container">
               <?php if ( !empty($settings['tp_adt_section_title_show']) ) : ?>
                  <div class="row justify-content-center">
                     <div class="col-xl-6">
                        <div class="tp-pcb-section-title-wrapper">
                            <div class="tp-section-title-wrapper mb-30 text-start text-md-center tp-el-content">
                               <div class="tp-section-title-inner <?php echo esc_attr($this->tp_common_animation_get($settings, 'desc_animation')) ?> p-relative">
                                  <?php if ( !empty($settings['tp_adt_sub_title']) ) : ?>
                                <span class="tp-section-subtitle tp-el-subtitle"><?php echo tp_kses( $settings['tp_adt_sub_title'] ); ?></span>
                                <?php endif; ?>
                                
                                <?php
                                    if ( !empty($settings['tp_adt_title' ]) ) :
                                        printf( '<%1$s %2$s>%3$s</%1$s>',
                                            tag_escape( $settings['tp_adt_title_tag'] ),
                                            $this->get_render_attribute_string( 'title_args' ),
                                            tp_kses( $settings['tp_adt_title' ] )
                                            );
                                    endif;
                                ?>
    
                                <?php if ( !empty($settings['tp_adt_description']) ) : ?>
                                    <p><?php echo tp_kses( $settings['tp_adt_description'] ); ?></p>
                                <?php endif; ?>
                               </div>
                            </div>
                        </div>
                     </div>
                  </div>
                  <?php endif; ?>
               </div>
               <div class="container">
                  <div class="row">
                     <div class="col-xl-12">
                        <div class="tp-pcb-tab blog-btn-tab mb-80 d-flex justify-content-center">
                           <ul class="nav nav-tabs" id="myTab2" role="tablist">
                                <?php foreach ($settings['tabs'] as $key => $tab):
                                    $active = ($key == 0) ? 'active' : '';
                                ?>
                              <li class="nav-items" role="presentation">
                                <button class="nav-links tp-el-tab-btn <?php echo esc_attr($active); ?>" id="pcb-tab-<?php echo esc_attr($key); ?>" data-bs-toggle="tab" data-bs-target="#pcb-<?php echo esc_attr($key); ?>" type="button" role="tab" aria-controls="pcb-tab-<?php echo esc_attr($key); ?>" aria-selected="true"><?php echo tp_kses($tab['title']); ?></button>
                              </li>
                              <?php endforeach; ?>
                            </ul>                           
                            <span id="blog-btn-bg" class="tp-el-tab-line"></span>
                        </div>
                     </div>
                  </div>
                  <div class="tp-pcb-tab-wrapper">
                     <div class="row">
                        <div class="tab-content" id="myTabContent2">
                            <?php foreach ($settings['tabs'] as $key => $tab):
                                $active = ($key == 0) ? 'show active' : '';
                            ?>
                            <div class="tab-pane fade <?php echo esc_attr($active); ?>" id="pcb-<?php echo esc_attr($key); ?>" role="tabpanel" aria-labelledby="pcb-tab-<?php echo esc_attr($key); ?>">
                                <?php echo \Elementor\Plugin::instance()->frontend->get_builder_content($tab['template'], true); ?>
                            </div>
                            <?php endforeach; ?>
                         </div>
                     </div>
                  </div>
               </div>
            </section>
            <!-- price area end -->

		<?php else: 
			$this->add_render_attribute('title_args', 'class', 'tp-section-title tp-el-title ' .
            $this->tp_common_animation_get($settings, 'desc_title'));
			$bloginfo = get_bloginfo( 'name' );

            if ( !empty($settings['background_image']['url']) ) {
                $background_image = !empty($settings['background_image']['id']) ? wp_get_attachment_image_url( $settings['background_image']['id'], $settings['background_image_size_size']) : $settings['background_image']['url'];
                $background_image_alt = get_post_meta($settings["background_image"]["id"], "_wp_attachment_image_alt", true);
            }
		?>


            <!-- skill area start -->
            <section class="tp-skill-area pt-115 pb-105 p-relative z-index-1 fix theme-bg-2 tp-el-section" data-background="<?php echo esc_url( $background_image ); ?>">
                <?php if(!empty($settings['adt_shape_switch'])) : ?>
                <div class="tp-skill-shape">
                  <span class="tp-skill-shape-1"></span>
                  <span class="tp-skill-shape-2"></span>
               </div>
               <?php endif; ?>
               <div class="container">
               <?php if ( !empty($settings['tp_adt_section_title_show']) ) : ?>
                  <div class="row">
                     <div class="col-xl-12">
                        <div class="tp-skill-section-title">
                           <div class="tp-section-title-wrapper mb-30 text-center tp-el-content <?php echo esc_attr($this->tp_common_animation_get($settings, 'desc_animation')) ?>">
                              <div class="tp-section-title-inner <?php echo esc_attr($this->tp_common_animation_get($settings, 'desc_animation')) ?> p-relative">
                                    <?php if ( !empty($settings['tp_adt_sub_title']) ) : ?>
                                    <span class="tp-section-subtitle tp-el-subtitle"><?php echo tp_kses( $settings['tp_adt_sub_title'] ); ?></span>
                                    <?php endif; ?>
                                    <?php
                                        if ( !empty($settings['tp_adt_title' ]) ) :
                                            printf( '<%1$s %2$s>%3$s</%1$s>',
                                                tag_escape( $settings['tp_adt_title_tag'] ),
                                                $this->get_render_attribute_string( 'title_args' ),
                                                tp_kses( $settings['tp_adt_title' ] )
                                                );
                                        endif;
                                    ?>
                              </div>
                              <?php if ( !empty($settings['tp_adt_description']) ) : ?>
                                    <p><?php echo tp_kses( $settings['tp_adt_description'] ); ?></p>
                                <?php endif; ?>
                           </div>
                        </div>
                     </div>
                  </div>
                  <?php endif; ?>
                  <div class="row">
                     <div class="col-xl-12">
                        <div class="tp-skill-tab tp-tab d-flex align-items-center justify-content-center mb-70">
                           <nav>
                              <div class="nav nav-tabs tp-marker-tab" id="nav-tab" role="tablist">
                                <?php foreach ($settings['tabs'] as $key => $tab):
			                        	$active = ($key == 0) ? 'active' : '';
			                        ?>
                                 <button class="nav-link tp-el-tab-btn <?php echo esc_attr($active); ?>" id="nav-design-tab-<?php echo esc_attr($key); ?>" data-bs-toggle="tab" data-bs-target="#nav-design-<?php echo esc_attr($key); ?>" type="button" role="tab" aria-controls="nav-design-<?php echo esc_attr($key); ?>"    aria-selected="false"><?php echo tp_kses($tab['title']); ?></button>
                                 <?php endforeach; ?>
                                 
                                 <span id="lineMarker" class="tp-el-tab-line"></span>
                              </div>
                           </nav>
                                                     
                        </div>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-xl-12">
                        <div class="tab-content" id="nav-tabContent">
                           <?php foreach ($settings['tabs'] as $key => $tab):
                                $active = ($key == 0) ? 'show active' : '';
                            ?>
                            <div class="tab-pane fade <?php echo esc_attr($active); ?>" id="nav-design-<?php echo esc_attr($key); ?>" role="tabpanel" aria-labelledby="nav-design-tab-<?php echo esc_attr($key); ?>">
                                <?php echo \Elementor\Plugin::instance()->frontend->get_builder_content($tab['template'], true); ?>
                            </div>
                            <?php endforeach; ?>
                        </div>
                     </div>
                  </div>
               </div>
            </section>
            <!-- skill area end -->

	    <?php endif; ?>

		<?php
	}

}
$widgets_manager->register( new TP_Advanced_Tab() );