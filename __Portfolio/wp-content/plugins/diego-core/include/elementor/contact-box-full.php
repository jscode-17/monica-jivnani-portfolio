<?php
namespace TPCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Repeater;
use \Elementor\Utils;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Tp Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class TP_Contact_Box_Full extends Widget_Base {

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
		return 'contact-box-full';
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
		return __( 'Contact Box Full', 'tpcore' );
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


    protected static function get_profile_names()
    {
        return [
            'apple' => esc_html__('Apple', 'tpcore'),
            'behance' => esc_html__('Behance', 'tpcore'),
            'bitbucket' => esc_html__('BitBucket', 'tpcore'),
            'codepen' => esc_html__('CodePen', 'tpcore'),
            'delicious' => esc_html__('Delicious', 'tpcore'),
            'deviantart' => esc_html__('DeviantArt', 'tpcore'),
            'digg' => esc_html__('Digg', 'tpcore'),
            'dribbble' => esc_html__('Dribbble', 'tpcore'),
            'email' => esc_html__('Email', 'tpcore'),
            'facebook' => esc_html__('Facebook', 'tpcore'),
            'flickr' => esc_html__('Flicker', 'tpcore'),
            'foursquare' => esc_html__('FourSquare', 'tpcore'),
            'github' => esc_html__('Github', 'tpcore'),
            'houzz' => esc_html__('Houzz', 'tpcore'),
            'instagram' => esc_html__('Instagram', 'tpcore'),
            'jsfiddle' => esc_html__('JS Fiddle', 'tpcore'),
            'linkedin' => esc_html__('LinkedIn', 'tpcore'),
            'medium' => esc_html__('Medium', 'tpcore'),
            'pinterest' => esc_html__('Pinterest', 'tpcore'),
            'product-hunt' => esc_html__('Product Hunt', 'tpcore'),
            'reddit' => esc_html__('Reddit', 'tpcore'),
            'slideshare' => esc_html__('Slide Share', 'tpcore'),
            'snapchat' => esc_html__('Snapchat', 'tpcore'),
            'soundcloud' => esc_html__('SoundCloud', 'tpcore'),
            'spotify' => esc_html__('Spotify', 'tpcore'),
            'stack-overflow' => esc_html__('StackOverflow', 'tpcore'),
            'tripadvisor' => esc_html__('TripAdvisor', 'tpcore'),
            'tumblr' => esc_html__('Tumblr', 'tpcore'),
            'twitch' => esc_html__('Twitch', 'tpcore'),
            'twitter' => esc_html__('Twitter', 'tpcore'),
            'vimeo' => esc_html__('Vimeo', 'tpcore'),
            'vk' => esc_html__('VK', 'tpcore'),
            'website' => esc_html__('Website', 'tpcore'),
            'whatsapp' => esc_html__('WhatsApp', 'tpcore'),
            'wordpress' => esc_html__('WordPress', 'tpcore'),
            'xing' => esc_html__('Xing', 'tpcore'),
            'yelp' => esc_html__('Yelp', 'tpcore'),
            'youtube' => esc_html__('YouTube', 'tpcore'),
        ];
    }

    public function get_tp_contact_form(){
        if ( ! class_exists( 'WPCF7' ) ) {
            return;
        }
        $tp_cfa         = array();
        $tp_cf_args     = array( 'posts_per_page' => -1, 'post_type'=> 'wpcf7_contact_form' );
        $tp_forms       = get_posts( $tp_cf_args );
        $tp_cfa         = ['0' => esc_html__( 'Select Form', 'tpcore' ) ];
        if( $tp_forms ){
            foreach ( $tp_forms as $tp_form ){
                $tp_cfa[$tp_form->ID] = $tp_form->post_title;
            }
        }else{
            $tp_cfa[ esc_html__( 'No contact form found', 'tpcore' ) ] = 0;
        }
        return $tp_cfa;
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


        $this->start_controls_section(
            'tpcore_contact',
            [
                'label' => esc_html__('Contact Form', 'tpcore'),
            ]
        );


        $this->add_control(
        'tp_contact_title',
         [
            'label'       => esc_html__( 'Contact Title', 'tpcore' ),
            'type'        => \Elementor\Controls_Manager::TEXTAREA,
            'default'     => esc_html__( 'Lets Talk About', 'tpcore' ),
            'placeholder' => esc_html__( 'Your Text', 'tpcore' ),
         ]
        );



        $this->add_control(
         'tp_contact_shape_switch',
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
            'tpcore_select_contact_form',
            [
                'label'   => esc_html__( 'Select Form', 'tpcore' ),
                'type'    => Controls_Manager::SELECT,
                'default' => '0',
                'options' => $this->get_tp_contact_form(),
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
         '_tp_image_section',
         [
             'label' => esc_html__('Background Image', 'tp-core'),
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


     $this->start_controls_section(
      'tp_about_sec',
          [
            'label' => esc_html__( 'Contact Info', 'tpcore' ),
            'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
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

	}

	// style_tab_content
	protected function style_tab_content(){
        $this->tp_section_style_controls('comint_section', 'Section - Style', '.tp-el-section');
        $this->tp_basic_style_controls('contact_title', 'Section - Title', '.tp-el-title');

        $this->tp_basic_style_controls('coming_title', 'Contact - Title', '.tp-el-box-title');

        $this->tp_input_controls_style('coming_input', 'Form - Input', '.tp-el-box-input input', '.tp-el-box-input textarea');
        $this->tp_link_controls_style('coming_input_btn', 'Form - Button', '.tp-el-box-input button');

        $this->tp_section_style_controls('contact_social_box', 'Contact - Style', '.tp-el-contact-box');
        $this->tp_icon_style('contact_icon', 'Contact - Icon', '.tp-contact-info-icon span');
        $this->tp_basic_style_controls('contact_social_title', 'Contact - Title', '.tp-el-contact-title');

        // $this->tp_link_controls_style('coming_dka', 'Social - Button', '.tp-el-box-social a');
        // $this->tp_link_controls_style('coming_contact', 'Contact Info', '.tp-el-box-contact, .tp-el-box-contact a');
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

        $this->add_render_attribute('title_args', 'class', 'section__title-11 tp-el-title');  
        $bloginfo = get_bloginfo( 'name' );  

        if ( !empty($settings['tp_image']['url']) ) {
         $tp_image = !empty($settings['tp_image']['id']) ? wp_get_attachment_image_url( $settings['tp_image']['id'], $settings['tp_image_size_size']) : $settings['tp_image']['url'];
         $tp_image_alt = get_post_meta($settings["tp_image"]["id"], "_wp_attachment_image_alt", true);
     }


		?>


            <div class="tp-hero-2__bg black-bg-3 tp-hero-2__space-7 d-flex align-items-start justify-content-center z-index-1 p-relative fix tp-el-section">
               <div class="tp-hero-distort-2" data-background="<?php echo esc_url($tp_image); ?>"></div>
               
               <?php if($settings['tp_contact_shape_switch'] == 'yes') : ?>
               <div class="tp-hero-2__circle-wrapper contact-section">
                  <span class="tp-hero-2__circle-3"></span>
                  <span class="tp-hero-2__circle-5"></span>
                  <img class="contact-shape-1 tp-zoom-in-out" src="<?php echo get_template_directory_uri(); ?>/assets/img/contact/contact-shape-1.png" alt="<?php echo esc_attr($bloginfo); ?>">
                  <img class="contact-shape-2 tp-zoom-in-out" src="<?php echo get_template_directory_uri(); ?>/assets/img/contact/contact-shape-2.png" alt="<?php echo esc_attr($bloginfo); ?>">
               </div>
               <div class="tp-hero-2__boder-circle">
                  <span></span>
               </div>
               <?php endif; ?>

               <div class="container">
                  <div class="row">
                     <div class="col-xl-12">
                     <?php if(!empty($settings['tp_contact_title'])) : ?>
                        <div class="tp-contact-2__title-box text-center">
                           <h4 class="tp-contact-2__title tp-el-title"><?php echo tp_kses($settings['tp_contact_title']); ?></h4>   
                        </div>
                        <?php endif; ?>
                        <div class="tp-contact-2__top-info mb-80 d-flex align-items-center justify-content-center">

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
                           <div class="parallax-wrap">
                              <div class="parallax-element">
                                 <a href="<?php echo esc_url($contact_url ); ?>" class="tp-el-contact-box ">
                                    <?php if($item['tp_box_icon_type'] == 'icon') : ?>
                                          <?php if (!empty($item['tp_box_icon']) || !empty($item['tp_box_selected_icon']['value'])) : ?>
                                                <span class="tp-contact-info-icon"><?php tp_render_icon($item, 'tp_box_icon', 'tp_box_selected_icon'); ?></span>
                                          <?php endif; ?>
                                    <?php elseif( $item['tp_box_icon_type'] == 'image' ) : ?>
                                          <?php if (!empty($item['tp_box_icon_image']['url'])): ?>
                                          <span class="tp-contact-info-icon">
                                             <img src="<?php echo $item['tp_box_icon_image']['url']; ?>" alt="<?php echo get_post_meta(attachment_url_to_postid($item['tp_box_icon_image']['url']), '_wp_attachment_image_alt', true); ?>">
                                          </span>
                                          <?php endif; ?>
                                    <?php else : ?>
                                          <?php if (!empty($item['tp_box_icon_svg'])): ?>
                                          <span class="tp-contact-info-icon">
                                             <?php echo $item['tp_box_icon_svg']; ?>
                                          </span>
                                          <?php endif; ?>
                                    <?php endif; ?>
                                    <span class="tp-el-contact-title"><?php echo esc_html($item['tp_footer_call_title']); ?></span>
                                 </a>
                              </div>
                           </div>
                           <?php endforeach; ?>
                        </div>
                        <div class="tp-contact-2__bottom-info">
                           <div class="row justify-content-center">
                              <div class="col-xl-10">
                                <div class="tp-el-box-input">
                                    <?php if( !empty($settings['tpcore_select_contact_form']) ) : ?>
                                       <?php echo do_shortcode( '[contact-form-7  id="'.$settings['tpcore_select_contact_form'].'"]' ); ?>
                                    <?php else : ?>
                                       <?php echo '<div class="alert alert-info"><p class="m-0">' . __('Please Select contact form.', 'tpcore' ). '</p></div>'; ?>
                                    <?php endif; ?>
                                </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>

        <?php
	}
}

$widgets_manager->register( new TP_Contact_Box_Full() );
