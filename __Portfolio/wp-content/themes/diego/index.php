<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package diego
 */

get_header();

$blog_column = is_active_sidebar( 'blog-sidebar' ) ? 'col-lg-8' : 'col-xl-12 col-lg-12';

?>

<section class="tp-blog-area tp-postbox-area postbox__area tp-blog-sidebar-sticky-area pt-75 pb-130 ">
    <div class="container">
        <div class="row">
			<div class="<?php print esc_attr( $blog_column );?>">
				<div class="tp-postbox-wrapper postbox__wrapper">
					<?php
					
						if ( have_posts() ):
    					if ( is_home() && !is_front_page() ):
    				?>
					<header>
						<h1 class="page-title screen-reader-text"><?php single_post_title();?></h1>
					</header>
					<?php
						endif;?>
					<?php
						/* Start the Loop */
						while ( have_posts() ): the_post(); ?>
						<?php
							/*
							* Include the Post-Type-specific template for the content.
							* If you want to override this in a child theme, then include a file
							* called content-___.php (where ___ is the Post Type name) and that will be used instead.
							*/
							get_template_part( 'template-parts/content' );?>
						<?php
							endwhile;
						?>
		               		<div class="tp-pagination mt-20">
			               		<?php diego_pagination( '<i class="fal fa-arrow-left"></i>', '<i class="fal fa-arrow-right"></i>', '', ['class' => ''] );?>
			                </div>
						<?php
						else:
							get_template_part( 'template-parts/content', 'none' );
						endif;
					?>

				</div>
			</div>

			<?php if ( is_active_sidebar( 'blog-sidebar' ) ): ?>
		        <div class="col-lg-4">
		        	<div class="sidebar__wrapper tp-blog-sidebar-sticky">
						<?php get_sidebar();?>
	            	</div>
	            </div>
			<?php endif;?>
        </div>
    </div>
</section>

<?php
get_footer();
