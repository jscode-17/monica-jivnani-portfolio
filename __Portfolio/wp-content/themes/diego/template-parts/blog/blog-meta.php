<?php 

/**
 * Template part for displaying post meta
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package diego
 */

$categories = get_the_terms( $post->ID, 'category' );

$diego_blog_date = get_theme_mod( 'diego_blog_date', true );
$diego_blog_comments = get_theme_mod( 'diego_blog_comments', true );
$diego_blog_author = get_theme_mod( 'diego_blog_author', true );
$diego_blog_cat = get_theme_mod( 'diego_blog_cat', false );

?>
<div class="postbox__meta">
    <?php if ( !empty($diego_blog_cat) ): ?>
        <?php if ( !empty( $categories[0]->name ) ): ?>
        <span><a href="<?php print esc_url(get_category_link($categories[0]->term_id)); ?>"><?php echo esc_html($categories[0]->name); ?></a></span>
        <?php endif;?>
    <?php endif;?>

    <?php if ( !empty($diego_blog_comments) ): ?>
    <i></i>
    <span><a href="<?php comments_link();?>"> <?php comments_number();?></a></span>
    <?php endif;?>

    <?php if ( !empty($diego_blog_author) ): ?>
    <i></i>
    <span><a href="<?php print esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) );?>"> <?php print get_the_author();?></a></span>
    <?php endif;?>

</div>
