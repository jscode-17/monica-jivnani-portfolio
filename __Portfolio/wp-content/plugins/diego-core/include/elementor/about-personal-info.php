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
class TP_About_Persoanl_Info extends Widget_Base {

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
		return 'about-personal-info';
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
		return __( 'About Personal Info', 'tp-core' );
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
             ]
        );
        
        $this->add_control(
         'tp_about_title',
         [
           'label'       => esc_html__( 'Title', 'tpcore' ),
           'type'        => \Elementor\Controls_Manager::TEXTAREA,
           'rows'        => 10,
           'default'     => esc_html__( 'Personal Info', 'tpcore' ),
           'placeholder' => esc_html__( 'Your Text', 'tpcore' ),
         ]
        );

        $this->add_control(
         'tp_about_desc',
         [
           'label'       => esc_html__( 'Description', 'tpcore' ),
           'type'        => \Elementor\Controls_Manager::TEXTAREA,
           'rows'        => 10,
           'default'     => esc_html__( 'Perceived end knowledge certainly day sweetness why cordially.', 'tpcore' ),
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
            'tp_box_icon_type',
            [
                'label' => esc_html__('Select Icon Type', 'tpcore'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'icon',
                'options' => [
                    'image' => esc_html__('Image', 'tpcore'),
                    'icon' => esc_html__('Icon', 'tpcore'),
                    'svg' => esc_html__('SVG', 'tpcore'),
                ],
                'condition' => [
                    'repeater_condition' => ['style_1'],
                ]
            ]
        );
        $repeater->add_control(
            'tp_box_icon_svg',
            [
                'show_label' => false,
                'type' => Controls_Manager::TEXTAREA,
                'label_block' => true,
                'placeholder' => esc_html__('SVG Code Here', 'tpcore'),
                'condition' => [
                    'tp_box_icon_type' => 'svg',
                    'repeater_condition' => ['style_1'],
                ]
            ]
        );

        $repeater->add_control(
            'tp_box_icon_image',
            [
                'label' => esc_html__('Upload Icon Image', 'tpcore'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'tp_box_icon_type' => 'image',
                    'repeater_condition' => ['style_1'],
                ]
            ]
        );

        if (tp_is_elementor_version('<', '2.6.0')) {
            $repeater->add_control(
                'tp_box_icon',
                [
                    'show_label' => false,
                    'type' => Controls_Manager::ICON,
                    'label_block' => true,
                    'default' => 'fa fa-star',
                    'condition' => [
                        'tp_box_icon_type' => 'icon',
                        'repeater_condition' => ['style_1'],
                    ]
                ]
            );
        } else {
            $repeater->add_control(
                'tp_box_selected_icon',
                [
                    'show_label' => false,
                    'type' => Controls_Manager::ICONS,
                    'fa4compatibility' => 'icon',
                    'label_block' => true,
                    'default' => [
                        'value' => 'fas fa-star',
                        'library' => 'solid',
                    ],
                    'condition' => [
                        'tp_box_icon_type' => 'icon',
                        'repeater_condition' => ['style_1'],
                    ]
                ]
            );
        }
           
        $repeater->add_control(
        'tp_footer_call_title',
          [
            'label'   => esc_html__( 'Contact Title', 'tpcore' ),
            'type'        => \Elementor\Controls_Manager::TEXT,
            'default'     => esc_html__( 'Contact Title', 'tpcore' ),
            'label_block' => true,
          ]
        );

        $repeater->add_control(
           'tp_footer_call_type',
           [
             'label'   => esc_html__( 'Select Type', 'tpcore' ),
             'type' => \Elementor\Controls_Manager::SELECT,
             'options' => [
               'email'  => esc_html__( 'Email', 'tpcore' ),
               'phone'  => esc_html__( 'Phone', 'tpcore' ),
               'map'  => esc_html__( 'Map', 'tpcore' ),
               'default'  => esc_html__( 'Default', 'tpcore' ),
             ],
             'default' => 'default',
           ]
          );
  
          $repeater->add_control(
           'tp_footer_call_default_url',
           [
             'label'   => esc_html__( 'Default URL', 'tpcore' ),
             'type'        => \Elementor\Controls_Manager::URL,
             'default'     => [
                 'url'               => '#',
                 'is_external'       => true,
                 'nofollow'          => true,
                 'custom_attributes' => '',
               ],
               'placeholder' => esc_html__( 'Your URL', 'tpcore' ),
               'label_block' => true,
               'condition' => [
                  'tp_footer_call_type' => 'default'
               ]
             ]
           );
           
          $repeater->add_control(
           'tp_footer_call_phone_url',
           [
             'label'   => esc_html__( 'Phone URL', 'tpcore' ),
             'type'        => \Elementor\Controls_Manager::URL,
             'default'     => [
                 'url'               => '#',
                 'is_external'       => true,
                 'nofollow'          => true,
                 'custom_attributes' => '',
               ],
               'placeholder' => esc_html__( 'Your URL', 'tpcore' ),
               'label_block' => true,
               'condition' => [
                  'tp_footer_call_type' => 'phone'
               ]
             ]
           );
          $repeater->add_control(
           'tp_footer_call_mail_url',
           [
             'label'   => esc_html__( 'Email URL', 'tpcore' ),
             'type'        => \Elementor\Controls_Manager::URL,
             'default'     => [
                 'url'               => '#',
                 'is_external'       => true,
                 'nofollow'          => true,
                 'custom_attributes' => '',
               ],
               'placeholder' => esc_html__( 'Your URL', 'tpcore' ),
               'label_block' => true,
               'condition' => [
                  'tp_footer_call_type' => 'email'
               ]
             ]
           );

          $repeater->add_control(
           'tp_footer_call_map_url',
           [
             'label'   => esc_html__( 'Map URL', 'tpcore' ),
             'type'        => \Elementor\Controls_Manager::URL,
             'default'     => [
                 'url'               => '#',
                 'is_external'       => true,
                 'nofollow'          => true,
                 'custom_attributes' => '',
               ],
               'placeholder' => esc_html__( 'Your URL', 'tpcore' ),
               'label_block' => true,
               'condition' => [
                  'tp_footer_call_type' => 'map'
               ]
             ]
           );
        
        $this->add_control(
          'tp_footer_call_list',
          [
            'label'       => esc_html__( 'Call Repeater', 'tpcore' ),
            'type'        => \Elementor\Controls_Manager::REPEATER,
            'fields'      => $repeater->get_controls(),
            'default'     => [
              [
                'tp_footer_call_title'   => esc_html__( '012 458 246', 'tpcore' ),
              ],
            ],
            'title_field' => '{{{ tp_footer_call_title }}}',
          ]
        );
        

        $this->end_controls_section();

        $this->start_controls_section(
            'tp_services',
            [
                'label' => esc_html__('Services List', 'tpcore'),
                'description' => esc_html__( 'Control all the style settings from Style tab', 'tpcore' ),
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
            '_section_price_tabs',
            [
                'label' => __('Right Side Templates', 'tpcore'),
                'tab' => Controls_Manager::TAB_CONTENT,
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

	}

    // style_tab_content
    protected function style_tab_content(){

        $this->tp_section_style_controls('about_section', 'Section - Style', '.tp-el-section');
        $this->tp_basic_style_controls('about_title', 'About - Title', '.tp-el-title');
        $this->tp_basic_style_controls('about_description', 'About - Description', '.tp-el-desc');
        
        $this->tp_link_controls_style('contact_icon_btn', 'Contact - Button', '.tp-el-social-btn');
        $this->tp_icon_style('contact_icon', 'Contact - Icon', '.tp-el-social-icon');
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
            $this->add_render_attribute('title_args', 'class', 'section__title-4-2 tp-el-title');
            $bloginfo = get_bloginfo( 'name' );

        ?>



		<?php else:

            $bloginfo = get_bloginfo( 'name' );


		?>

        

            <!-- ab personal info area start -->
            <div class="ab-personal-info__area black-bg-3 pb-30 tp-personal-info-pin-section tp-el-section">
               <div class="container">
                  <div class="row">
                     <div class="col-xl-6 col-lg-6">
                        <div class=" tp-personal-info-pin">
                            <div class="ab-personal-info__left-box mr-200">
                                <div class="tp-services-wrapper tp-services-capsule-wrapper p-relative"
                                    data-tp-throwable-scene="true">
                                    <div class="ab-personal-info__left-content">

                                        <?php if(!empty($settings['tp_about_title'])) : ?>
                                        <h4 class="ab-personal-info__left-content-title tp-el-title"><?php echo tp_kses($settings['tp_about_title']); ?></h4>
                                        <?php endif; ?>

                                        <?php if(!empty($settings['tp_about_desc'])) : ?>
                                        <p class="tp-el-desc"><?php echo tp_kses($settings['tp_about_desc']); ?></p>
                                        <?php endif; ?>


                                            <?php foreach ($settings['tp_footer_call_list'] as $item) : 
                                
                                                $contact_type = $item['tp_footer_call_type'];

                                                if($contact_type === 'mail'){
                                                    $contact_url = 'mailto:'.$item['tp_footer_call_mail_url']['url'];
                                                }
                                                elseif ($contact_type === 'phone') {
                                                    $contact_url = 'tel:'.$item['tp_footer_call_phone_url']['url'];
                                                }
                                                elseif ($contact_type === 'map') {
                                                    $contact_url = $item['tp_footer_call_map_url']['url'];
                                                }
                                                elseif ($contact_type === 'default') {
                                                    $contact_url = $item['tp_footer_call_default_url']['url'];
                                                }
                                                else{
                                                    $contact_url = "#";
                                                }

                                            ?>
                                        <a href="<?php echo esc_url($contact_url ); ?>" class="tp-el-social-btn">
                                                <?php if($item['tp_box_icon_type'] == 'icon') : ?>
                                                    <?php if (!empty($item['tp_box_icon']) || !empty($item['tp_box_selected_icon']['value'])) : ?>
                                                            <span class="tp-el-social-icon"><?php tp_render_icon($item, 'tp_box_icon', 'tp_box_selected_icon'); ?></span>
                                                    <?php endif; ?>
                                                <?php elseif( $item['tp_box_icon_type'] == 'image' ) : ?>
                                                    <?php if (!empty($item['tp_box_icon_image']['url'])): ?>
                                                    <span class="tp-el-social-icon">
                                                        <img src="<?php echo $item['tp_box_icon_image']['url']; ?>" alt="<?php echo get_post_meta(attachment_url_to_postid($item['tp_box_icon_image']['url']), '_wp_attachment_image_alt', true); ?>">
                                                    </span>
                                                    <?php endif; ?>
                                                <?php else : ?>
                                                    <?php if (!empty($item['tp_box_icon_svg'])): ?>
                                                    <span class="tp-el-social-icon">
                                                        <?php echo $item['tp_box_icon_svg']; ?>
                                                    </span>
                                                    <?php endif; ?>
                                                <?php endif; ?>
                                            <?php echo esc_html($item['tp_footer_call_title']); ?>
                                        </a>
                                        <?php endforeach; ?>

                                    </div>
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
                                            <p data-tp-throwable-el=""  class="elementor-repeater-item-<?php echo esc_attr($item['_id']); ?>">
                                                <span class="tp-services-capsule-item"><?php echo tp_kses($item['tp_service_title']); ?></span>
                                            </p>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                    
                                        
                                        <?php endforeach; ?>

                                    </div>
                                </div>
                            </div>
                        </div>
                     </div>
                     <div class="col-xl-6 col-lg-6">
                        <div class="ab-personal-info__right-wrap">

                            <?php foreach ($settings['tabs'] as $key => $tab){
                                    echo \Elementor\Plugin::instance()->frontend->get_builder_content($tab['template'], true);
                                }
                            ?>

                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <!-- ab personal info area end -->

        <?php endif; ?>

        <?php
	}
}

$widgets_manager->register( new TP_About_Persoanl_Info() );
