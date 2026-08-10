<?php 

/**
 * Template part for displaying post meta
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package diego
 */

$diego_blog_date = get_theme_mod( 'diego_blog_date', true );
?>

<?php if ( !empty($diego_blog_date) ): ?>
<div class="postbox__date">
    <span><?php echo get_the_date('M', $post->ID) ?></span>
    <h5><?php echo get_the_date('j', $post->ID) ?></h5>
</div>
<?php endif;?>