<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package diego
 */

get_header();

$blog_column = is_active_sidebar( 'blog-sidebar' ) ? 'col-xl-9 col-lg-8' : 'col-xl-12 col-lg-12';

?>

<div class="tp-blog-area tp-postbox-area postbox__area pt-120 pb-130">
    <div class="container">
        <div class="row">
            <div class="<?php print esc_attr( $blog_column );?> blog-post-items">
            	<div class="tp-postbox-wrapper pr-50">
	                <?php
						if ( have_posts() ):
					?>
					<div class="result-bar page-header d-none">
						<h1 class="page-title"><?php esc_html_e( 'Search Results For:', 'diego' );?> <?php print get_search_query();?></h1>
					</div>
					<?php
						while ( have_posts() ): the_post();
							get_template_part( 'template-parts/content', 'search' );
						endwhile;
					?>
					<div class="tp-pagination">
						<?php diego_pagination( '<i class="fas fa-angle-left"></i>', '<i class="fas fa-angle-right"></i>', '', [ 'class' => '' ] );?>
					</div>
					<?php
						else:
							get_template_part( 'template-parts/content', 'none' );
						endif;
					?>
            	</div>
            </div>
			<?php if ( is_active_sidebar( 'blog-sidebar' ) ): ?>
		        <div class="col-xl-3 col-lg-4">
		        	<div class="tp-sidebar-wrapper tp-sidebar-ml--24">
						<?php get_sidebar();?>
	            	</div>
	            </div>
			<?php endif;?>
        </div>
    </div>
</div>

<?php
get_footer();