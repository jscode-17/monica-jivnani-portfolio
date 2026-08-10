<?php
namespace TPCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Repeater;
use \Elementor\Utils;
use TPCore\Elementor\Controls\Group_Control_TPBGGradient;

if (!defined('ABSPATH'))
	exit; // Exit if accessed directly

/**
 * Tp Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class TP_Instagram_Post extends Widget_Base
{

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
	public function get_name()
	{
		return 'tp-instagram';
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
	public function get_title()
	{
		return __('Instagram Post', 'tpcore');
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
	public function get_icon()
	{
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
	public function get_categories()
	{
		return ['tpcore'];
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
	public function get_script_depends()
	{
		return ['tpcore'];
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

	protected function register_controls()
	{
		$this->register_controls_section();
		$this->style_tab_content();
	}


	protected function register_controls_section()
	{

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
			'tp_instagram_section',
			[
				'label' => __('Instagram Slider', 'tpcore'),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'tp_follow_text',
			[
				'label' => esc_html__('Follow Text', 'tpcore'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__('FOLLOW ME ON INSTAGRAM @Diego ', 'tpcore'),
				'placeholder' => esc_html__('Placeholder Text', 'tpcore'),
				'label_block' => true,
				'condition' => [
					'tp_design_style' => 'layout-1'
				]
			]
		);

		$repeater = new \Elementor\Repeater();


		$repeater->add_control(
			'tp_image',
			[
				'label' => esc_html__('Upload Image', 'tpcore'),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
		);

		$repeater->add_control(
			'tp_insta_link',
			[
				'label' => esc_html__('Instagram Link', 'tpcore'),
				'type' => \Elementor\Controls_Manager::URL,
				'default' => [
					'url' => '#',
					'is_external' => true,
					'nofollow' => true,
					'custom_attributes' => '',
				],
				'placeholder' => esc_html__('Your Link Here', 'tpcore'),
				'label_block' => true,
			]
		);

		$this->add_control(
			'tp_insta_list',
			[
				'label' => esc_html__('Instagram List', 'tpcore'),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'tp_insta_title' => esc_html__('Image 1', 'tpcore'),
					],
					[
						'tp_insta_title' => esc_html__('Image 2', 'tpcore'),
					],
					[
						'tp_insta_title' => esc_html__('Image 3', 'tpcore'),
					],
					[
						'tp_insta_title' => esc_html__('Image 4', 'tpcore'),
					],
				],
				'title_field' => '{{{ tp_insta_title }}}',
			]
		);

		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name' => 'thumbnail', // // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `thumbnail_size` and `thumbnail_custom_dimension`.
				'exclude' => ['custom'],
			]
		);
		$this->end_controls_section();
	}


	// style_tab_content
	protected function style_tab_content()
	{

		$this->tp_section_style_controls('blog_section', 'Section - Style', '.tp-el-section');
		$this->tp_basic_style_controls('blog_title', 'Section - Title', '.tp-el-title');
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
	protected function render()
	{
		$settings = $this->get_settings_for_display();

		?>

		<?php if ($settings['tp_design_style'] == 'layout-2'):
			$this->add_render_attribute('title_args', 'class', 'tp-title tp-el-title');
			?>

			<div class="tp-insta-5-area">
				<div class="container container-1350">
					<div class="tp-footer-6-instagram-wrap">
						<div class="row">
							<?php foreach ($settings['tp_insta_list'] as $key => $item):
								if (!empty($item['tp_image']['url'])) {
									$tp_image_url = !empty($item['tp_image']['id']) ? wp_get_attachment_image_url($item['tp_image']['id'], $settings['thumbnail_size']) : $item['tp_image']['url'];
									$tp_image_alt = get_post_meta($item["tp_image"]["id"], "_wp_attachment_image_alt", true);
								}

								if ('2' == $item['tp_insta_link']) {
									$link = get_permalink($item['tp_insta_link']);
									$target = '_self';
									$rel = 'nofollow';
								} else {
									$link = !empty($item['tp_insta_link']['url']) ? $item['tp_insta_link']['url'] : '';
									$target = !empty($item['tp_insta_link']['is_external']) ? '_blank' : '';
									$rel = !empty($item['tp_insta_link']['nofollow']) ? 'nofollow' : '';
								}
								$attrs = array(
									'href' => $link,
									'target' => $target,
									'rel' => $rel,
								);
								?>
								<div class="col-xl-3 col-lg-3 col-md-6">
									<div class="tp-footer-6-instagram-thumb fix mb-30">
										<?php if (!empty($link)): ?>
											<a <?php echo tp_implode_html_attributes($attrs); ?>>
											<?php endif; ?>
											<img src="<?php echo esc_url($tp_image_url) ?>" alt="<?php esc_attr($tp_image_alt); ?>">
											<?php if (!empty($link)): ?>
											</a>
										<?php endif; ?>
									</div>
								</div>
							<?php endforeach; ?>
						</div>
					</div>
				</div>
			</div>


		<?php else: ?>

			<!-- instagram area start -->
			<div class="tp-insta-4-area black-bg-5 pt-120 cursor-style tp-el-section">

				<?php if (!empty($settings['tp_follow_text'])): ?>
					<div class="row justify-content-center gx-0">
						<div class="col-xl-3 col-lg-4">
							<div class="tp-insta-4-title-box text-center mb-60">
								<h4 class="tp-insta-4-title tp-el-title"><?php echo tp_kses($settings['tp_follow_text']); ?></h4>
							</div>
						</div>
					</div>
				<?php endif; ?>

				<div class="row gx-0 row-cols-xl-5 row-cols-lg-5 row-cols-md-3 row-cols-sm-2">

					<?php foreach ($settings['tp_insta_list'] as $key => $item):
						if (!empty($item['tp_image']['url'])) {
							$tp_image_url = !empty($item['tp_image']['id']) ? wp_get_attachment_image_url($item['tp_image']['id'], $settings['thumbnail_size']) : $item['tp_image']['url'];
							$tp_image_alt = get_post_meta($item["tp_image"]["id"], "_wp_attachment_image_alt", true);
						}

						if ('2' == $item['tp_insta_link']) {
							$link = get_permalink($item['tp_insta_link']);
							$target = '_self';
							$rel = 'nofollow';
						} else {
							$link = !empty($item['tp_insta_link']['url']) ? $item['tp_insta_link']['url'] : '';
							$target = !empty($item['tp_insta_link']['is_external']) ? '_blank' : '';
							$rel = !empty($item['tp_insta_link']['nofollow']) ? 'nofollow' : '';
						}
						$attrs = array(
							'href' => $link,
							'target' => $target,
							'rel' => $rel,
						);
						?>
						<div class="col-xl">
							<div class="tp-insta-4-thumb fix">
								<?php if (!empty($link)): ?>
									<a class="hide-cursor" <?php echo tp_implode_html_attributes($attrs); ?>>
									<?php endif; ?>
									<img src="<?php echo esc_url($tp_image_url) ?>" alt="<?php esc_attr($tp_image_alt); ?>">
									<?php if (!empty($link)): ?>
									</a>
								<?php endif; ?>
							</div>
						</div>
					<?php endforeach; ?>
				</div>
			</div>
			<!-- instagram area end -->

		<?php endif; ?>

		<?php
	}


}

$widgets_manager->register(new TP_Instagram_Post());
