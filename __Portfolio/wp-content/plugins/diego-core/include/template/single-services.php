<?php
/**
 * The main template file
 *
 * @package  WordPress
 * @subpackage  tpcore
 */
get_header();

$post_column = is_active_sidebar( 'services-sidebar' ) ? 'col-lg-8 order-first order-lg-last' : 'col-xxl-10 col-xl-10 col-lg-10';
$post_column_center = is_active_sidebar( 'services-sidebar' ) ? '' : 'justify-content-center';

?>

         <!-- services area start -->
         <section class="services__area ">
               <?php 
                  if( have_posts() ) : 
                  while( have_posts() ) : 
                  the_post();
               ?>
               
               <?php the_content(); ?>

               <?php
                  endwhile; 
                  wp_reset_query();
                  endif;
               ?>
            
         </section>
         <!-- services area end -->


<?php get_footer();  ?>
