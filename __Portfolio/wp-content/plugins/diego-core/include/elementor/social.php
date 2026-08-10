<?php
namespace TPCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Repeater;
use \Elementor\Utils;
use \Elementor\Control_Media;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Tp Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class TP_Social extends Widget_Base {

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
		return 'tp-social';
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
		return __( 'Social Information', 'tpcore' );
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

    protected $nav_menu_index = 1;

    /**
     * Retrieve the menu index.
     *
     * Used to get index of nav menu.
     *
     * @since 1.3.0
     * @access protected
     *
     * @return string nav index.
     */
    protected function get_nav_menu_index() {
        return $this->nav_menu_index++;
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

    protected function register_controls_section(){
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
            'tp_list_sec',
                [
                  'label' => esc_html__( 'Social List', 'tpcore' ),
                  'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
                ]
           );
           
            $this->add_control(
                'email_text',
                [
                     'label' => esc_html__( 'Email Title', 'tpcore' ),
                     'type' => \Elementor\Controls_Manager::TEXT,
                     'default' => esc_html__( 'hello@yourwebsite.com', 'tpcore' ),
                     'label_block' => true,
                ]
            );

            $this->add_control(
            'email_url',
             [
                'label'       => esc_html__( 'Email URL', 'tpcore' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => esc_html__( 'hello@yourwebsite.com', 'tpcore' ),
                'placeholder' => esc_html__( 'Placeholder Text', 'tpcore' ),
                'label_block' => true,
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
            'tp_menu_subtitle',
                [
                'label'   => esc_html__( 'Subtitle', 'tpcore' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => esc_html__( 'Regular updates on', 'tpcore' ),
                'label_block' => true,
                'condition' => [
                        'repeater_condition' => ['style_2'],
                    ]
                ]
           );
           
           
           $repeater->add_control(
           'tp_menu_title',
             [
               'label'   => esc_html__( 'Title', 'tpcore' ),
               'type'        => \Elementor\Controls_Manager::TEXT,
               'default'     => esc_html__( 'Home', 'tpcore' ),
               'label_block' => true,
             ]
           );
           
             
   
           $repeater->add_control(
               'tp_services_link_type',
               [
                   'label' => esc_html__( 'Link Type', 'tpcore' ),
                   'type' => \Elementor\Controls_Manager::SELECT,
                   'options' => [
                       '1' => 'Custom Link',
                       '2' => 'Internal Page',
                   ],
                   'default' => '1',
               ]
           );
           $repeater->add_control(
               'tp_services_link',
               [
                   'label' => esc_html__( 'link', 'tpcore' ),
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
                       'tp_services_link_type' => '1',
                   ]
               ]
           );
           $repeater->add_control(
               'tp_services_page_link',
               [
                   'label' => esc_html__( 'Select Link Page', 'tpcore' ),
                   'type' => \Elementor\Controls_Manager::SELECT2,
                   'label_block' => true,
                   'options' => tp_get_all_pages(),
                   'condition' => [
                       'tp_services_link_type' => '2',
                   ]
               ]
           );
           
           $this->add_control(
             'tp_menu_list',
             [
               'label'       => esc_html__( 'Menu List', 'tpcore' ),
               'type'        => \Elementor\Controls_Manager::REPEATER,
               'fields'      => $repeater->get_controls(),
               'default'     => [
                 [
                   'tp_menu_title'   => esc_html__( 'Menu Item 1', 'tpcore' ),
                 ],
                 [
                   'tp_menu_title'   => esc_html__( 'Menu Item 2', 'tpcore' ),
                 ],
                 [
                   'tp_menu_title'   => esc_html__( 'Menu Item 3', 'tpcore' ),
                 ],
               ],
               'title_field' => '{{{ tp_menu_title }}}',
             ]
           );
   
           
           $this->end_controls_section();

    }

    protected function style_tab_content(){
        $this->tp_section_style_controls('comint_section', 'Section - Style', '.tp-el-section');
        $this->tp_basic_style_controls('about_title', 'Section - Subtitle', '.tp-el-subtitle');
        $this->tp_link_controls_style('services_box_link_btn', 'Email', '.tp-el-mail');
        $this->tp_link_controls_style('services_box_link', 'List - Link', '.tp-el-link');
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
        <?php if ( $settings['tp_design_style']  == 'layout-2' ):  ?>

            <div class="tp-footer-6-social-wrap d-flex align-items-center justify-content-between tp-el-section">

                <?php foreach ($settings['tp_menu_list'] as $key => $item) :
                    if ('2' == $item['tp_services_link_type']) {
                        $link = get_permalink($item['tp_services_page_link']);
                        $target = '_self';
                        $rel = 'nofollow';
                    } else {
                        $link = !empty($item['tp_services_link']['url']) ? $item['tp_services_link']['url'] : '';
                        $target = !empty($item['tp_services_link']['is_external']) ? '_blank' : '';
                        $rel = !empty($item['tp_services_link']['nofollow']) ? 'nofollow' : '';
                    }

                ?>
                <div class="tp-footer-6-social">
                    <?php if(!empty($item['tp_menu_subtitle'])) : ?>
                    <span class="tp-el-subtitle"><?php echo tp_kses($item['tp_menu_subtitle']); ?></span>
                    <?php endif; ?>

                    <a class="d-flex align-items-center tp-el-link" target="<?php echo esc_attr($target); ?>" rel="<?php echo esc_attr($rel); ?>" href="<?php echo esc_url($link); ?>">
                    <?php echo esc_html($item['tp_menu_title']); ?>
                        <span>
                            <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M1 13L13 1" stroke="currentcolor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M1 1H13V13" stroke="currentcolor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M1 13L13 1" stroke="currentcolor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M1 1H13V13" stroke="currentcolor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </span>
                    </a>
                </div>
                <?php endforeach; ?>
            </div>


        <?php else: ?>	

            <div class="tp-footer-5-info-box text-center tp-el-section">

            <?php if($settings['email_url']) : ?>
                <a class="tp-footer-5-info-mail tp-el-mail" href="<?php echo esc_attr($settings['email_url']) ?>">
                    <?php echo esc_html($settings['email_text']); ?>
                </a>
                <?php else : ?>
                    <span class="tp-footer-5-info-mail tp-el-mail"><?php echo esc_html($settings['email_text']); ?></span>
                <?php endif; ?>

                <div class="tp-footer-5-social">
                    <?php foreach ($settings['tp_menu_list'] as $key => $item) :
                        if ('2' == $item['tp_services_link_type']) {
                            $link = get_permalink($item['tp_services_page_link']);
                            $target = '_self';
                            $rel = 'nofollow';
                        } else {
                            $link = !empty($item['tp_services_link']['url']) ? $item['tp_services_link']['url'] : '';
                            $target = !empty($item['tp_services_link']['is_external']) ? '_blank' : '';
                            $rel = !empty($item['tp_services_link']['nofollow']) ? 'nofollow' : '';
                        }

                    ?>
                    <a class="tp-el-link" target="<?php echo esc_attr($target); ?>" rel="<?php echo esc_attr($rel); ?>" href="<?php echo esc_url($link); ?>">
                    <?php echo esc_html($item['tp_menu_title']); ?></a>
                    <?php endforeach; ?>
                </div>
                
            </div>
        <?php endif; ?>

        <?php 
	}
}

$widgets_manager->register( new TP_Social() );