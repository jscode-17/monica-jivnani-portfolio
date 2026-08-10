<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package diego
 */

if ( is_single() ) : ?>
    <?php get_template_part( 'template-parts/content' ); ?>
<?php else: ?>
    
    <?php get_template_part( 'template-parts/content' ); ?>
    
<?php endif;?>