<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package diego
 */

get_header();

$blog_column = is_active_sidebar( 'blog-sidebar' ) ? 'col-lg-8' : 'col-lg-12';
$diego_audio_url = function_exists( 'tpmeta_field' ) ? tpmeta_field( 'diego_post_audio' ) : NULL;
$gallery_images = function_exists('tpmeta_gallery_field') ? tpmeta_gallery_field('diego_post_gallery') : '';
$diego_video_url = function_exists( 'tpmeta_field' ) ? tpmeta_field( 'diego_post_video' ) : NULL;



$diego_blog_single_social = get_theme_mod('diego_blog_single_social', false);

$style_from_customizer = get_theme_mod('blog_details_layout', true);
$style_from_meta = function_exists('tpmeta_field') ? tpmeta_field('diego_blog_details_meta_layout') : NULL;


if($style_from_meta == 'classic'){
	$active_layout_2 = false;
}
elseif($style_from_meta == 'full_width'){
	$active_layout_2 = true;
}else{
	$active_layout_2 = $style_from_customizer;
}



$blog_details_thumbnail_layout_from_customizer = get_theme_mod('blog_details_thumbnail_layout', true);
$blog_details_thumbnail_layout_from_meta = function_exists('tpmeta_field') ? tpmeta_field('diego_blog_details_thumbnail_layout') : NULL;



if($blog_details_thumbnail_layout_from_meta == 'full_width_thumbnail'){
	$is_active_full_thumbnail = true;
}elseif($blog_details_thumbnail_layout_from_meta == 'box_width'){
	$is_active_full_thumbnail = false;
}
else{
	$is_active_full_thumbnail = $blog_details_thumbnail_layout_from_customizer;
}

$author_bio_avatar_size = 180;
$diego_blog_date = get_theme_mod( 'diego_blog_date', true );
$diego_blog_comments = get_theme_mod( 'diego_blog_comments', true );
$diego_blog_author = get_theme_mod( 'diego_blog_author', true );

?>



	<?php if($active_layout_2) : ?>


      <!-- blog area start -->
      <div class="blog-details__area blog-details-4__customize blog-details-4__bg tp-postbox-details-area tp-blog-area  postbox__area" data-background="<?php echo get_the_post_thumbnail_url( $post->ID);?>">
         <div class="container">
            <div class="row">

				<?php
					while ( have_posts() ):
					the_post();

					$categories = get_the_terms( $post->ID, 'category' );
				?>
               <div class="col-xxl-9 col-xl-10">
                  <div class="blog-list__title-box">
                     <div class="blog-list__text-sm mb-20">
						<?php if(!empty($categories[0]->name)) : ?>
                        <span class="category mr-10">
							<a href="<?php echo esc_url(get_category_link($categories[0]->term_id)); ?>"><?php echo esc_html($categories[0]->name); ?></a>
						</span>
						<?php endif; ?>

						<?php if(!empty($categories[1]->name)) : ?>
						<span class="category">
							<a href="<?php echo esc_url(get_category_link($categories[1]->term_id)); ?>"><?php echo esc_html($categories[1]->name); ?></a>
						</span>
						<?php endif; ?>
                     </div>

                     <h4 class="blog-list__title tp-char-animation">
					 <?php the_title();?>
					 </h4>
                  </div>
               </div>
               <div class="col-xl-12">
			   		<?php get_template_part( 'template-parts/blog/blog-details-meta-2' ); ?>
               </div>
			   <?php endwhile;  // End of the loop. ?>	

               <div class="row">
                  <div class="col-xl-12">
                     <div class="blog-details-4__scroll-down smooth">
                        <a href="#postbox">
                           <?php echo esc_html__('Scroll', 'diego'); ?>
                           <span>
                              <svg width="12" height="13" viewBox="0 0 12 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                                 <path d="M6 1.5V11.5" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                 <path d="M10.5 7L6 11.5L1.5 7" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                              </svg>    
                           </span>
                        </a>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- blog area end -->

      <!-- postbox area start -->
      <section class="postbox-details__area pt-100 pb-100 postbox__area tp-postbox-details-area">
         <div class="container">
            <div class="row">
               <div class="col-xxl-2 col-xl-2 col-lg-2">
			   		<?php if(!empty($diego_blog_single_social)) :?>
						<?php if(function_exists('diego_blog_single_social')): ?>
                  		<div class="postbox-details-4__social-wrap tp-blog-social-sticky ">
				  			<?php print diego_blog_single_social_2(); ?> 
                  		</div>
				  		<?php endif; ?>
					<?php endif; ?>
               </div>
               <div class="col-xxl-8 col-xl-9 col-lg-10">
                  <div id="postbox" class="tp-postbox-details-main-wrapper postbox-details__wrapper tp-blog-social-sticky-area p-relative">
                     <div class="postbox-details__text">
						<?php
							while ( have_posts() ):
							the_post();

							get_template_part( 'template-parts/content', get_post_format() );

						?>

						

						<?php
							get_template_part( 'template-parts/biography', get_post_format() );

							// If comments are open or we have at least one comment, load up the comment template.
							if ( comments_open() || get_comments_number() ):
								comments_template();
							endif;

							endwhile; // End of the loop.
						?>

					 </div>
                  </div>
               </div>
            </div>
         </div>
      </section>
      <!-- postbox area end -->

	<!-- default style -->
	<?php else: ?>


		<!-- breadcrumb area start -->
		<section class="tp-postbox-details-area tp-blog-area postbox__area blog-details__area blog-details__customize pt-200">
			<div class="tp-postbox-details-top">
				<div class="container">
					<div class="row">
						<div class="col-xl-10">
							<?php
								while ( have_posts() ):
								the_post();
							?>

							<div class="blog-list__title-box">
								<?php if ( !empty($categories) ): ?>
								<div class="blog-list__text-sm">
									<span class="category">
										<a href="<?php print esc_url(get_category_link($categories[0]->term_id)); ?>"><?php echo esc_html($categories[0]->name); ?></a>
									</span>
								</div>
								<?php endif; ?>
								<h4 class="blog-list__title tp-char-animation"><?php the_title();?></h4>
							</div>

							<?php get_template_part( 'template-parts/blog/blog-details-meta' ); ?>
							
							<?php endwhile;  // End of the loop. ?>	
						</div>

						<?php
							while ( have_posts() ):
							the_post();
						?>

						<?php if(!$is_active_full_thumbnail): ?>
						<div class="col-xl-12">
							<?php if ( has_post_format('image') ): ?>

							<!-- if post has image -->
							<?php if ( has_post_thumbnail() ): ?>
							<div class="tp-postbox-details-thumb">
								<?php the_post_thumbnail( 'full', ['class' => 'img-responsive'] );?>
							</div>
							<?php endif;?>


							<!-- if post has video -->
							<?php elseif ( has_post_format('video') ): ?>
									<?php if ( has_post_thumbnail() ): ?> 
										<div class="postbox__thumb tp-postbox-details-thumb tp-postbox-details-video">

										<?php the_post_thumbnail( 'full', ['class' => 'img-responsive'] );?>
											
										<?php if(!empty($diego_video_url)) : ?>
										<div class="postbox__play-btn">
											<a href="<?php print esc_url( $diego_video_url );?>" class="popup-video"><i class="fa-sharp fa-solid fa-play"></i></a>
										</div>
										<?php endif; ?>
										</div>
									<?php endif; ?>


							<!-- if post has audio -->
							<?php elseif ( has_post_format('audio') ): ?>
									<?php if ( !empty( $diego_audio_url ) ): ?>
										<div class="tp-postbox-details-thumb tp-postbox-details-audio">
											<?php echo wp_oembed_get( $diego_audio_url ); ?>
										</div>
									<?php endif; ?>

							<!-- if post has gallery -->
							<?php elseif ( has_post_format('gallery') ): ?>
									<?php if ( !empty( $gallery_images ) ): ?>
										<div class="postbox__thumb m-img">
											<div class="postbox__thumb-slider p-relative">
												<div class="swiper-container postbox__thumb-slider-active">
													<div class="swiper-wrapper">
													<?php foreach ( $gallery_images as $key => $image ): ?>
														<div class="swiper-slide">
															<img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>">
														</div>
														<?php endforeach;?>
													</div>
												</div>
												<div class="postbox__slider-arrow-wrap d-none d-sm-block">
													<button class="postbox-arrow-prev">
														<i class="fa-sharp fa-solid fa-arrow-left"></i>
													</button>
													<button class="postbox-arrow-next">
														<i class="fa-sharp fa-solid fa-arrow-right"></i>
													</button>
												</div>
											</div>
										</div>

									<?php endif; ?>
							<!-- defalut image format -->
							<?php else: ?>
									<?php if ( has_post_thumbnail() ): ?> 
									<div class="tp-postbox-details-thumb">
										<?php the_post_thumbnail( 'full', ['class' => 'img-responsive'] );?>
									</div>
									<?php endif;?>

							<?php endif;?>
						</div>
						<?php endif; ?>
						<?php endwhile;  // End of the loop. ?>	
					</div>
				</div>
				<?php if($is_active_full_thumbnail): ?>

					<div class="blog-details__big-thumb text-center cursor-style">
						<?php if ( has_post_format('image') ): ?>
							<!-- if post has image -->
							<?php if ( has_post_thumbnail() ): ?>
							<div class="tp-postbox-details-thumb">
								<?php the_post_thumbnail( 'full', ['class' => 'img-responsive', 'data-speed' => '0.7'] );?>
							</div>
							<?php endif;?>


							<!-- if post has video -->
							<?php elseif ( has_post_format('video') ): ?>
									<?php if ( has_post_thumbnail() ): ?> 
										<div class="postbox__thumb tp-postbox-details-thumb tp-postbox-details-video">

										<?php the_post_thumbnail( 'full', ['class' => 'img-responsive', 'data-speed' => '0.7'] );?>
											
										<?php if(!empty($diego_video_url)) : ?>
										<div class="postbox__play-btn">
											<a href="<?php print esc_url( $diego_video_url );?>" class="popup-video"><i class="fa-sharp fa-solid fa-play"></i></a>
										</div>
										<?php endif; ?>
										</div>
									<?php endif; ?>


							<!-- if post has audio -->
							<?php elseif ( has_post_format('audio') ): ?>
									<?php if ( !empty( $diego_audio_url ) ): ?>
										<div class="tp-postbox-details-thumb tp-postbox-details-audio">
											<?php echo wp_oembed_get( $diego_audio_url ); ?>
										</div>
									<?php endif; ?>

							<!-- if post has gallery -->
							<?php elseif ( has_post_format('gallery') ): ?>
									<?php if ( !empty( $gallery_images ) ): ?>
										<div class="postbox__thumb m-img">
											<div class="postbox__thumb-slider p-relative">
												<div class="swiper-container postbox__thumb-slider-active">
													<div class="swiper-wrapper">
													<?php foreach ( $gallery_images as $key => $image ): ?>
														<div class="swiper-slide">
															<img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>">
														</div>
														<?php endforeach;?>
													</div>
												</div>
												<div class="postbox__slider-arrow-wrap d-none d-sm-block">
													<button class="postbox-arrow-prev">
														<i class="fa-sharp fa-solid fa-arrow-left"></i>
													</button>
													<button class="postbox-arrow-next">
														<i class="fa-sharp fa-solid fa-arrow-right"></i>
													</button>
												</div>
											</div>
										</div>

									<?php endif; ?>
							<!-- defalut image format -->
							<?php else: ?>
									<?php if ( has_post_thumbnail() ): ?> 
									<div class="tp-postbox-details-thumb">
										<?php the_post_thumbnail( 'full', ['class' => 'img-responsive', 'data-speed' => '0.7'] );?>
									</div>
									<?php endif;?>

							<?php endif;?>
					</div>
				<?php endif; ?>
			</div>
			<div class="postbox-details__area pt-90 pb-120">
				<div class="container">
					<div class="row">
						<div class="<?php echo esc_attr($blog_column); ?>">
							
							<div class="tp-postbox-details-main-wrapper postbox-details__wrapper  tp-blog-sidebar-sticky-area-details tp-blog-social-sticky-area p-relative">
								<?php if(!empty($diego_blog_single_social)) :?>
									<?php if(function_exists('diego_blog_single_social')): ?>
										<?php print diego_blog_single_social(); ?> 
									<?php endif; ?>
	
								<?php endif; ?>
								<div class="tp-postbox-details-content postbox__text">
									<?php
										while ( have_posts() ):
										the_post();
			
										get_template_part( 'template-parts/content', get_post_format() );
		
									?>
	
									
	
									<?php
										get_template_part( 'template-parts/biography', get_post_format() );
		
										// If comments are open or we have at least one comment, load up the comment template.
										if ( comments_open() || get_comments_number() ):
											comments_template();
										endif;
		
										endwhile; // End of the loop.
									?>
								</div>
							</div>
							
						</div>
	
						<?php if ( is_active_sidebar( 'blog-sidebar' ) ): ?>
						<div class="col-lg-4">
							<div class="sidebar__wrapper tp-blog-sidebar-sticky-details pb-120">
								<?php get_sidebar();?>
							</div>
						</div>
						<?php endif;?>
					</div>
				</div>
			</div>
		</section>
		<!-- breadcrumb area end -->
	<?php endif; ?>

<?php
get_footer();
