<?php

/**
 * Template part for displaying post btn
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package diego
 */

$diego_blog_btn = get_theme_mod( 'diego_blog_btn', 'Read More' );
$diego_blog_btn_switch = get_theme_mod( 'diego_blog_btn_switch', true );

?>

<?php if ( !empty( $diego_blog_btn_switch ) ): ?>
<div class="postbox__read-more">
    <a href="<?php the_permalink();?>" class="tp-btn-border-lg"><?php print esc_html( $diego_blog_btn );?></a>
</div>
<?php endif;?>