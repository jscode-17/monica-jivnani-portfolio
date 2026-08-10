<?php
namespace TPCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Group_Control_Typography;
use \Elementor\Group_Control_Box_Shadow;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Tp Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class TP_Blog_Post extends Widget_Base {

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
		return 'blogpost';
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
		return __( 'Blog Post', 'tpcore' );
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

        $this->tp_section_title_render_controls('blog', 'Section Title', ['layout-2', 'layout-3']);
		$this->tp_button_render_controls('tpbtn', 'Button', ['layout-2']);
        // Blog Query
		$this->tp_query_controls('blog', 'Blog');

        // layout Panel
        $this->tp_post_layout('post', 'Blog');

        // tp_post__columns_section
        $this->tp_columns('col', 'Blog Column');


		$this->tp_common_animation(null, 'desc_title', 'Animation - Title');
		$this->tp_common_animation(null, 'desc_animation', 'Animation - Description');

	}

    // style_tab_content
    protected function style_tab_content(){
        $this->tp_section_style_controls('blog_section', 'Section - Style', '.tp-el-section');
        $this->tp_basic_style_controls('blog_subtitle', 'Blog - Subtitle', '.tp-el-subtitle');
        $this->tp_basic_style_controls('blog_title', 'Blog - Title', '.tp-el-title');
        $this->tp_basic_style_controls('blog_description', 'Blog - Description', '.tp-el-content p');
        $this->tp_link_controls_style('blog_box_btn', 'Blog - Button', '.tp-el-blog-btn');
        $this->tp_link_controls_style('blog_box_btn_bg', 'Blog - Button BG', '.tp-el-blog-btn::after');

		$this->tp_section_style_controls('blog_box', 'Box - Style', '.tp-el-box');
        $this->tp_basic_style_controls('blog_box_title', 'Box - Title', '.tp-el-box-title');
        $this->tp_link_controls_style('blog_box_tag', 'Box - Tag', '.tp-el-box-category span, .tp-el-box-category span.category');
        $this->tp_basic_style_controls('blog_box_meta', 'Box - Meta', '.tp-el-box-meta span');

        $this->tp_link_controls_style('blog_box_author', 'Box - Author', '.tp-el-author-name');
        $this->tp_link_controls_style('blog_box_author_meta', 'Box - Author Meta', '.tp-el-author-meta');

        $this->tp_link_controls_style('blog_box_slider', 'Slider - Arrow', '.tp-el-arrow button');
        
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

	 function diego_load_more($query){
		$settings = $this->get_settings_for_display();
		$page = isset($_POST['page']) ? $_POST['page'] : 1;
		
		// $query = new \WP_Query([
		// 	'post_type' => 'post',
		// 	'post_status' => 'publish',
		// 	'posts_per_page' => 5,
		// 	'paged' => $page
		// ]);
		// $query = array_merge(, ['paged' => $page]);
		$query->query['paged'] = $page;
	 

		if ($query->have_posts()) : ?>
		   <?php while ($query->have_posts()) : 
			  $query->the_post();
			  global $post;
	 
			  $categories = get_the_category($post->ID);
		?>
	 
	 <div class="col-xl-6 col-lg-6 col-md-6">
		<div class="blog-list__sm-item mb-60 pb-30">
		   <?php if ( has_post_thumbnail() ): ?> 
		   <div class="blog-list__sm-thumb">
			  <a href="<?php the_permalink(); ?>">
				 <?php the_post_thumbnail('thumbnail');?>
			  </a>
		   </div>
		   <?php endif; ?>
		   <div class="blog-list__sm-category">
			 
			  <?php if ( !empty($categories[0])): ?> 
			  <span>
				 <a href="<?php echo esc_url(get_category_link($categories[0]->term_id)); ?>"><?php echo esc_html($categories[0]->name); ?></a> / 
			  </span>
			  <?php endif; ?>
	 
			  <?php if ( !empty($categories[1])): ?> 
			  <span>
				 <a href="<?php echo esc_url(get_category_link($categories[1]->term_id)); ?>"><?php echo esc_html($categories[1]->name); ?></a>
			  </span>
			  <?php endif; ?>
		   </div>
		   <div class="blog-list__sm-title-box">
			  <h4 class="blog-list__sm-title">
			  <a href="<?php the_permalink(); ?>"><?php echo wp_trim_words(get_the_title(), $settings['tp_blog_title_word'], ''); ?></a>
			  </h4>
		   </div>
		   <div class="blog-list__sm-author d-flex align-items-center">
			  <div class="blog-list__sm-author-avata">
				 <img src="assets/img/users/blog-list-avata-1.png" alt="">
			  </div>
			  <div class="blog-list__sm-author-content">
				 <h4>Nitin Sharma</h4>
				 <span><?php the_time( get_option('date_format') ); ?><i>.</i><?php echo theme_domain_reading_time(); ?> <?php echo esc_html__('read', 'tpcore'); ?></span>
			  </div>
		   </div>
		</div>
	 </div>
	 
	 
		   <?php 
		   endwhile; 
		   wp_reset_query();
		   endif;
	 }
	 
	 

	protected function render() {
		$control_id = 'tpbtn';
		$settings = $this->get_settings_for_display();
        /**
         * Setup the post arguments.
        */
        $query_args = TP_Helper::get_query_args('post', 'category', $this->get_settings());

        // The Query
        $query = new \WP_Query($query_args);


        ?>

        <?php if ( $settings['tp_design_style']  == 'layout-2' ): 
			$this->add_render_attribute('title_args', 'class', 'tp-section-title-3 tp-el-title ' .
			$this->tp_common_animation_get($settings, 'desc_title'));
			$bloginfo = get_bloginfo( 'name' );
			$this->tp_link_controls_render('tpbtn', 'tp-btn-blue tp-el-blog-btn', $this->get_settings());
        ?>


            <!-- blog area start -->
            <div class="tp-blog-3__area black-bg-3 pt-70 pb-50 fix tp-el-section">
               <div class="container">


                  <div class="tp-blog-3__title-wrap mb-60">
                     <div class="row align-items-end">
					 <?php if ( !empty($settings['tp_blog_section_title_show']) ) : ?>
                        <div class="col-xl-6 col-lg-8 col-md-8">
                           <div class="tp-blog-3__title-box tp-el-content">

							  	<?php if ( !empty($settings['tp_blog_sub_title']) ) : ?>
								<span class="tp-section-subtitle-3 <?php echo esc_attr($this->tp_common_animation_get($settings, 'desc_animation')) ?> tp-el-subtitle"><?php echo tp_kses( $settings['tp_blog_sub_title'] ); ?></span>
								<?php endif; ?>

								<?php
									if ( !empty($settings['tp_blog_title' ]) ) :
										printf( '<%1$s %2$s>%3$s</%1$s>',
											tag_escape( $settings['tp_blog_title_tag'] ),
											$this->get_render_attribute_string( 'title_args' ),
											tp_kses( $settings['tp_blog_title' ] )
											);
									endif;
								?>
                           
                           		<?php if ( !empty($settings['tp_blog_description']) ) : ?>
                            	<p class="tp_title_anim"><?php echo tp_kses( $settings['tp_blog_description'] ); ?></p>
                        		<?php endif; ?>
                           </div>
                        </div>
						<?php endif; ?>

						<?php if (!empty($settings['tp_' . $control_id .'_text']) && $settings['tp_' . $control_id .'_button_show'] == 'yes') : ?>
                        <div class="col-xl-6 col-lg-4 col-md-4">
                           <div class="tp-blog-3__btn text-start text-md-end">
                              <a <?php echo $this->get_render_attribute_string( 'tp-button-arg' . $control_id .'' ); ?>>
                                 <span class="text"> <?php echo $settings['tp_' . $control_id .'_text']; ?></span>
                                 <span class="icon">
                                    <svg width="11" height="11" viewBox="0 0 11 11" fill="none" xmlns="http://www.w3.org/2000/svg">
                                       <path d="M1 1L10 10" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                       <path d="M10 1V10H1" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                 </span>
                              </a>
                           </div>
                        </div>
						<?php endif; ?>
                     </div>
                  </div>

                  <div class="row gx-50">
				  	<?php if ($query->have_posts()) : ?>
						<?php while ($query->have_posts()) : 
							$query->the_post();
							global $post;

							$categories = get_the_category($post->ID);
					?>
                     <div class="col-xl-6">
                        <div class="tp-blog-3__item mb-70 tp-el-box">
                           <div class="tp-blog-3__content">
                              <h4 class="tp-blog-3__content-title tp-el-box-title">
								<a href="<?php the_permalink(); ?>"><?php echo wp_trim_words(get_the_title(), $settings['tp_blog_title_word'], ''); ?></a>
								</h4>
                              <div class="tp-blog-3__meta-box mb-30 d-flex flex-wrap align-items-center justify-content-between">
                                 <div class="tp-blog-3__category tp-el-box-category">
									<?php if ( !empty($categories[0])): ?> 
                                    <span>
										<a href="<?php echo esc_url(get_category_link($categories[0]->term_id)); ?>"><?php echo esc_html($categories[0]->name); ?></a>
									</span>
									<?php endif; ?>
                                 </div>
                                 <div class="tp-blog-3__meta tp-el-box-meta">
                                    <span><?php the_time( get_option('date_format') ); ?></span>
                                    <span><?php echo theme_domain_reading_time(); ?> <?php echo esc_html__('read', 'tpcore'); ?></span>
                                 </div>
                              </div>
                           </div>
						   <?php if ( has_post_thumbnail() ): ?> 
                           <div class="tp-blog-3__thumb">
								<a href="<?php the_permalink(); ?>">
									<?php the_post_thumbnail( $post->ID, $settings['thumbnail_size'] );?>
								</a>
                           </div>
						   <?php endif; ?>
                 
                        </div>
                     </div>
					 <?php endwhile; wp_reset_query(); ?>
            		<?php endif; ?>
                  </div>
               </div>
            </div>
            <!-- blog area end -->

		<?php elseif ( $settings['tp_design_style']  == 'layout-3' ): 
			$this->add_render_attribute('title_args', 'class', 'blog-list__title tp-char-animation tp-el-title');
			$bloginfo = get_bloginfo( 'name' );
			$this->tp_link_controls_render('tpbtn', 'tp-btn-black-lg tp-load-more-btn', $this->get_settings());
        ?>

            <!-- blog area start -->
            <div class="blog-list__area fix tp-el-section">
               <div class="container">

			   <?php if ( !empty($settings['tp_blog_section_title_show']) ) : ?>
                  <div class="row">
                     <div class="blog-list__title-box mb-90 tp-el-content">

						<?php if ( !empty($settings['tp_blog_sub_title']) ) : ?>
						<span class="blog-list__subtitle tp-char-animation tp-el-subtitle"><?php echo tp_kses( $settings['tp_blog_sub_title'] ); ?></span>
						<?php endif; ?>

						<?php
							if ( !empty($settings['tp_blog_title' ]) ) :
								printf( '<%1$s %2$s>%3$s</%1$s>',
									tag_escape( $settings['tp_blog_title_tag'] ),
									$this->get_render_attribute_string( 'title_args' ),
									tp_kses( $settings['tp_blog_title' ] )
									);
							endif;
						?>
					
						<?php if ( !empty($settings['tp_blog_description']) ) : ?>
						<p class="tp-char-animation"><?php echo tp_kses( $settings['tp_blog_description'] ); ?></p>
						<?php endif; ?>
                     </div>
                  </div>
				  <?php endif; ?>
                  <div class="row">
                     <div class="col-xl-12">
                        <div class="blog-list__tab-wrap">
							<div class="blog-list__wrapper">
								<!-- data here -->
								<div class="row">
									<?php if ($query->have_posts()) : ?>
										<?php while ($query->have_posts()) : 
											$query->the_post();
											global $post;

											$categories = get_the_category($post->ID);
											$author_bio_avatar_size = 180;
									?>
									<div class="col-xl-6 col-lg-6 col-md-6">
										<div class="blog-list__sm-item mb-60 pb-30 tp-el-box">
											<?php if ( has_post_thumbnail() ): ?> 
											<div class="blog-list__sm-thumb">
												<a href="<?php the_permalink(); ?>">
													<?php the_post_thumbnail('thumbnail');?>
												</a>
											</div>
											<?php endif; ?>
											<div class="blog-list__sm-category tp-el-box-category">
												
												<?php if ( !empty($categories[0])): ?> 
												<span>
													<a href="<?php echo esc_url(get_category_link($categories[0]->term_id)); ?>"><?php echo esc_html($categories[0]->name); ?></a>
												</span>
												<?php endif; ?>
										
												<?php if ( !empty($categories[1])): ?> 
												<span>
													<a href="<?php echo esc_url(get_category_link($categories[1]->term_id)); ?>"><?php echo esc_html($categories[1]->name); ?></a>
												</span>
												<?php endif; ?>
											</div>


											<div class="blog-list__sm-title-box">
												<h4 class="blog-list__sm-title tp-el-box-title">
													<a href="<?php the_permalink(); ?>"><?php echo wp_trim_words(get_the_title(), $settings['tp_blog_title_word'], ''); ?></a>
												</h4>
											</div>

											<?php if(!empty(get_author_posts_url( get_the_author_meta( 'ID' ) ))) : ?>
											<div class="blog-list__sm-author d-flex align-items-center">
												<div class="blog-list__sm-author-avata">
													<?php if(!empty(get_avatar(get_the_author_meta( 'user_email' ), $author_bio_avatar_size, '', '', [ 'class' => 'media-object img-circle' ]))) : ?>
													<a href="<?php print esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) );?>">
														<?php print get_avatar(get_avatar(get_the_author_meta( 'user_email' ), $author_bio_avatar_size, '', '', [ 'class' => 'media-object img-circle' ]) );?>
													</a>
													<?php endif; ?>
												</div>
												<div class="blog-list__sm-author-content">
													<h4 class="tp-el-author-name">
													<a href="<?php print esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) );?>"> <?php print get_the_author();?></a>
													</h4>
													<span class="tp-el-author-meta"><?php the_time( get_option('date_format') ); ?><i>.</i><?php echo theme_domain_reading_time(); ?> <?php echo esc_html__('read', 'tpcore'); ?></span>
												</div>
											</div>
											<?php endif;?>

										</div>
									</div>
										<?php endwhile; wp_reset_query(); ?>
            						<?php endif; ?>

								</div>
									
							</div>
							
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <!-- blog area end -->

		<?php elseif ( $settings['tp_design_style']  == 'layout-4' ): 
			$this->add_render_attribute('title_args', 'class', 'tp-section-title-3 tp-el-title ' .
			$this->tp_common_animation_get($settings, 'desc_title'));
			$bloginfo = get_bloginfo( 'name' );
			$this->tp_link_controls_render('tpbtn', 'tp-btn-black-lg tp-load-more-btn', $this->get_settings());
        ?>

            <!-- blog area start -->
            <div class="blog-list__area fix tp-el-section">
               <div class="container">
                  <div class="row">
                     <div class="col-xl-12">
                        <div class="blog-list__tab-wrap">
							<div class="blog-list__slider-main">
								<div class="blog-list__slider-wrap mb-80">
									<div class="swiper-container blog-list__slider-active p-relative">
										<div class="blog-list__scrollbar"></div>
											<div class="swiper-wrapper">
												<?php if ($query->have_posts()) : ?>
													<?php while ($query->have_posts()) : 
														$query->the_post();
														global $post;

														$categories = get_the_category($post->ID);
														$author_bio_avatar_size = 180;
												?>
												<div class="swiper-slide">
													<div class="blog-list__slider-item tp-el-box">
														<div class="row align-items-center">
															<div class="col-xl-8">
																<div class="blog-list__slider-title-box">
																	<h4 class="blog-list__slider-title tp-el-box-title">
																		<a href="<?php the_permalink(); ?>"><?php echo wp_trim_words(get_the_title(), $settings['tp_blog_title_word'], ''); ?></a>
																	</h4>
																</div>
															</div>
														</div>
														<div class="blog-list__author-wrap mb-20">
															<div class="row align-items-end">
															<?php if(!empty(get_author_posts_url( get_the_author_meta( 'ID' ) ))) : ?>
																<div class="col-xl-3 col-lg-3 col-md-4 mb-20">
																	<div class="blog-list__author-info d-flex align-items-center">
																		<div class="blog-list__author-avata">
																			<?php if(!empty(get_avatar(get_the_author_meta( 'user_email' ), $author_bio_avatar_size, '', '', [ 'class' => 'media-object img-circle' ]))) : ?>
																			<a href="<?php print esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) );?>">
																				<?php print get_avatar(get_avatar(get_the_author_meta( 'user_email' ), $author_bio_avatar_size, '', '', [ 'class' => 'media-object img-circle' ]) );?>
																			</a>
																			<?php endif; ?>
																		</div>
																		<div class="blog-list__author-details">
																			<h4 class="blog-list__author-title tp-el-author-name">
																				<a href="<?php print esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) );?>"> <?php print get_the_author();?></a>
																			</h4>
																		</div>
																	</div>
																</div>
																<?php endif;?>
																<div class="col-xl-6 col-lg-6 col-md-8 mb-20">
																	<div class="blog-list__meta-box text-start text-lg-center d-flex align-items-center justify-content-end">

																		<?php if ( !empty($categories[0])): ?> 
																		<div class="tp-el-box-category">
																			<span class="category">
																				<a href="<?php echo esc_url(get_category_link($categories[0]->term_id)); ?>"><?php echo esc_html($categories[0]->name); ?></a>
																			</span>
																		</div>
																		<?php endif; ?>
																		<span class="tp-el-box-meta">
																			<span><?php the_time( get_option('date_format') ); ?></span>
																			<span><?php echo theme_domain_reading_time(); ?> <?php echo esc_html__('read', 'tpcore'); ?></span>
																		</span>
																	</div>
																</div>
															</div>
														</div>
														<?php if ( has_post_thumbnail() ): ?> 
														<div class="row">
															<div class="col-xl-12">
																<div class="blog-list__slider-thumb">
																	<a href="<?php the_permalink(); ?>">
																		<?php the_post_thumbnail( $post->ID, $settings['thumbnail_size'] );?>
																	</a>
																</div>
															</div>
														</div>
														<?php endif; ?>
													</div>
												</div>
												<?php endwhile; wp_reset_query(); ?>
												<?php endif; ?>
											</div>
										<div class="blog-list__arrow-box d-none d-md-block tp-el-arrow">
											<button class="blog-list__arrow-next"><i class="fa-solid fa-angle-left"></i></button>
											<button class="blog-list__arrow-prev"><i class="fa-solid fa-angle-right"></i></button>
										</div>
									</div>
								</div>
							</div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <!-- blog area end -->
        <?php else: 

        ?>

         <div class="tp-blog-inner">
            <div class="row gx-45">
             <?php if ($query->have_posts()) : ?>
                  <?php while ($query->have_posts()) : 
                     $query->the_post();
                     global $post;

                     $categories = get_the_category($post->ID);
               ?>
               <div class="col-xl-4 col-lg-4 mb-70">
                  <div class="tp-blog-item tp-el-box">
                  <?php if ( has_post_thumbnail() ): ?> 
                     <div class="tp-blog-thumb fix">
                        <a href="<?php the_permalink(); ?>">
                              <?php the_post_thumbnail( $post->ID, $settings['thumbnail_size'] );?>
                        </a>
                     </div>
                     <?php endif; ?>
                     <div class="tp-blog-content">
                        <h4 class="tp-blog-title-sm tp-el-box-title">
                           <a href="<?php the_permalink(); ?>"><?php echo wp_trim_words(get_the_title(), $settings['tp_blog_title_word'], ''); ?></a>
                        </h4>
                        <div class="tp-blog-meta d-flex justify-content-between align-items-center tp-el-box-meta">
                           <span><?php the_time( get_option('date_format') ); ?></span>
                           <span>
                           <?php if ( !empty($categories[0])): ?> 
                              <a href="<?php echo esc_url(get_category_link($categories[0]->term_id)); ?>"><?php echo esc_html($categories[0]->name); ?></a> / 
                              <?php endif; ?>
                              <?php if ( !empty($categories[1])): ?> 
                              <a href="<?php echo esc_url(get_category_link($categories[1]->term_id)); ?>"><?php echo esc_html($categories[1]->name); ?></a>
                              <?php endif; ?>
                           </span>
                        </div>
                     </div>
                  </div>
               </div>
               <?php endwhile; wp_reset_query(); ?>
            <?php endif; ?>
            </div>
         </div>
         

    	<?php endif; ?>

       <?php
	}

}

$widgets_manager->register( new TP_Blog_Post() );