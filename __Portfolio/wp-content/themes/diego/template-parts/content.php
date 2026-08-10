<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package diego
 */

 $diego_audio_url = function_exists( 'tpmeta_field' ) ? tpmeta_field( 'diego_post_audio' ) : NULL;
 $gallery_images = function_exists('tpmeta_gallery_field') ? tpmeta_gallery_field('diego_post_gallery') : '';
 $diego_video_url = function_exists( 'tpmeta_field' ) ? tpmeta_field( 'diego_post_video' ) : NULL;



if ( is_single() ) : ?>
    <!-- details start -->
    <article id="post-<?php the_ID();?>" <?php post_class( 'tp-postbox-details-article' );?>>
        <div class="tp-postbox-details-article-inner ">
        <!-- content start -->            
            <?php the_content();?>

            <?php
                wp_link_pages( [
                    'before'      => '<div class="page-links">' . esc_html__( 'Pages:', 'diego' ),
                    'after'       => '</div>',
                    'link_before' => '<span class="page-number">',
                    'link_after'  => '</span>',
                ] );
            ?>
        </div>

            <?php if(has_tag()) :?>
            <div class="tagcloud pb-35">
                <?php print diego_get_tag(); ?> 
            </div>
            <?php endif ?>
                               
    </article>
    <!-- details end -->
<?php else: ?>

    <article id="post-<?php the_ID();?>" <?php post_class( 'postbox__item tp-postbox-item format-image mb-60' );?> >
        
        <!-- if post has thumbnail -->
        <?php if ( has_post_format('image') ): ?>  
            <?php if ( has_post_thumbnail() ): ?>   
                <div class="postbox__thumb">
                    <a href="<?php the_permalink();?>">
                        <?php the_post_thumbnail( 'full', ['class' => 'img-responsive'] );?>
                    </a>
                    <?php get_template_part( 'template-parts/blog/blog-date' ); ?>
                </div>
            <?php endif; ?>

        <!-- if post has video -->
        <?php elseif ( has_post_format('video') ): ?> 
            <?php if ( has_post_thumbnail() ): ?> 
            <div class="postbox__thumb">

                <a href="<?php the_permalink();?>">
                    <?php the_post_thumbnail( 'full', ['class' => 'img-responsive'] );?>
                </a>
                <?php get_template_part( 'template-parts/blog/blog-date' ); ?>

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
            <div class="postbox__thumb tp-postbox-audio p-relative">
                <?php echo wp_oembed_get( $diego_audio_url ); ?>
                <?php get_template_part( 'template-parts/blog/blog-date' ); ?>
            </div>
            <?php endif; ?>
        
            <!-- if post has gallery -->
            <?php elseif ( has_post_format('gallery') ): ?> 
                <?php if ( !empty( $gallery_images ) ): ?>
                <div class="postbox__thumb w-img">
                <?php get_template_part( 'template-parts/blog/blog-date' ); ?>
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

        <?php else: ?>
            <?php if ( has_post_thumbnail() ): ?>   
            <div class="postbox__thumb">
                <a href="<?php the_permalink();?>">
                    <?php the_post_thumbnail( 'full', ['class' => 'img-responsive'] );?>
                </a>
                <?php get_template_part( 'template-parts/blog/blog-date' ); ?>
            </div>
            <?php endif; ?>
        <?php endif; ?>


        <div class="postbox__content">
            <?php get_template_part( 'template-parts/blog/blog-meta' ); ?>

            <h3 class="postbox__title">
                <a href="<?php the_permalink();?>"><?php the_title();?></a>
            </h3>
            <div class="postbox__text">
                <?php the_excerpt();?>
            </div>

            <!-- blog btn -->
            <?php get_template_part( 'template-parts/blog/blog-btn' ); ?>
        </div>

    </article>
<?php endif;?>