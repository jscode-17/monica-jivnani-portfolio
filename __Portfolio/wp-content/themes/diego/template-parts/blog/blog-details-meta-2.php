<?php
    $author_data = get_the_author_meta( 'description', get_query_var( 'author' ) );
    $author_name = get_the_author_meta( 'diego_write_by');
    $facebook_url = get_the_author_meta( 'diego_facebook' );
    $twitter_url = get_the_author_meta( 'diego_twitter' );
    $linkedin_url = get_the_author_meta( 'diego_linkedin' );
    $instagram_url = get_the_author_meta( 'diego_instagram' );
    $diego_url = get_the_author_meta( 'diego_youtube' );
    $diego_write_by = get_the_author_meta( 'diego_write_by' );
    $author_bio_avatar_size = 180;


    $categories = get_the_terms( $post->ID, 'category' );
    $diego_blog_date = get_theme_mod( 'diego_blog_date', true );
    $diego_blog_comments = get_theme_mod( 'diego_blog_comments', true );
    $diego_blog_author = get_theme_mod( 'diego_blog_author', true );


?>

<div class="blog-details__meta mb-170">
    <?php if(!empty(get_author_posts_url( get_the_author_meta( 'ID' ) )) && !empty($diego_blog_author)) : ?>
        <span >
        <?php if(!empty(get_avatar(get_the_author_meta( 'user_email' ), $author_bio_avatar_size, '', '', [ 'class' => 'media-object img-circle' ]))) : ?>
        <a href="<?php print esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) );?>">
            <?php print get_avatar(get_avatar(get_the_author_meta( 'user_email' ), $author_bio_avatar_size, '', '', [ 'class' => 'media-object img-circle' ]) );?>
        </a>
        <?php endif; ?>
        <i><a href="<?php print esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) );?>"><?php the_author();?></a></i>
    </span>
    <?php endif; ?>

    <?php if ( !empty($diego_blog_date) ): ?>
    <span><?php the_time( get_option('date_format') ); ?></span>
    <?php endif; ?>

    <?php if ( !empty($diego_blog_comments) ): ?>
    <span><?php comments_number();?></span>
    <?php endif; ?>

</div>