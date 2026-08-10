<?php
/**
 * The template for displaying Comments
 *
 * The area of the page that contains comments and the comment form.
 */
?>
<?php
// If the current post is protected by a password and the visitor has not yet 
// entered the password we will return early without loading the comments.
// ----------------------------------------------------------------------------------------
if ( post_password_required() ) {
    return;
}
?>

<?php if ( have_comments() || comments_open()) : ?>
<div id="comments" class="postbox__comment mb-95 blog-post-comment tp-postbox-details-comment-wrapper">

    <?php if ( get_comments_number() >= 1 ): ?>
    <div class="post-comments postbox__comment mb-95">

            <?php
                $comment_no = number_format_i18n( get_comments_number() );
                $comment_text = ( !empty( $comment_no ) AND ( $comment_no > 1 ) ) ? esc_html__( ' Comments', 'diego' ) : esc_html__( ' Comment ', 'diego' );
                $comment_no = ( !empty( $comment_no ) AND ( $comment_no > 0 ) ) ? '<h2 class="postbox__comment-title">' . esc_html( $comment_no . $comment_text ) . '</h2>' : ' ';
                print sprintf( "%s", $comment_no );
            ?>

        <div class="tp-postbox-details-comment-inner latest-comments postbox__comment-form">
            <ul>
                <?php
                    wp_list_comments( [
                        'style'       => 'ul',
                        'callback'    => 'diego_comment',
                        'avatar_size' => 90,
                        'short_ping'  => true,
                    ] );
                ?>
            </ul>
        </div>
    </div>
    <?php endif;?>

    <?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ): ?>
        <div class="comment-pagination mb-50 d-none">
            <nav id="comment-nav-below" class="comment-navigation" role="navigation">
                <h1 class="screen-reader-text"><?php esc_html_e( 'Comment navigation', 'diego' );?></h1>
                <div class="row">
                    <div class="col-md-6">
                        <div class="nav-previous "><?php previous_comments_link( esc_html__( '&larr; Older ', 'diego' ) );?></div>
                    </div>
                    <div class="col-md-6">
                        <div class="nav-next "><?php next_comments_link( esc_html__( 'Newer &rarr;', 'diego' ) );?></div>
                    </div>
                </div>
                <div class="clearfix"></div>
            </nav><!-- #comment-nav-below -->
        </div>
    <?php endif; // check for comment navigation ?>


    <?php
    $post_id = '';
    if ( null === $post_id )
        $post_id = get_the_ID();
    else
        $id      = $post_id;

    $commenter       = wp_get_current_commenter();
    $user            = wp_get_current_user();
    $user_identity   = $user->exists() ? $user->display_name : '';


    $req         = get_option( 'require_name_email' );
    $aria_req    = ( $req ? " aria-required='true'" : '' );

    $fields = array(
        'author' => '<div class="row">
                        <div class="col-xxl-4 col-xl-4 col-lg-6 col-md-6">
                            <div class="tp-postbox-details-input-box"> 
                                <div class="postbox__comment-input"> 
                                    <input id="author" class="tp-form-control inputText" name="author" type="text" value="' . esc_attr( $commenter[ 'comment_author' ] ) . '" size="30"' . $aria_req . ' />
                                    <span class="floating-label">'. esc_attr__('Your Name', 'diego').'</span>
                                    </div>
                            </div>
                        </div>',

        'email'  => '<div class="col-xxl-4 col-xl-4 col-lg-6 col-md-6"><div class="tp-postbox-details-input-box"> <div class="postbox__comment-input"> <input id="email" name="email" class="tp-form-control inputText" type="email" value="' . esc_attr( $commenter[ 'comment_author_email' ] ) . '" size="30"' . $aria_req . ' /><span class="floating-label">'. esc_attr__('Your Email', 'diego').'</span></div></div></div>',

        'url'    => '<div class="col-xxl-4 col-xl-4 col-lg-12"><div class="tp-postbox-details-input-box"><div class="postbox__comment-input"><input  id="url" name="url" class="tp-form-control inputText" type="url" value="' . esc_attr( $commenter[ 'comment_author_url' ] ) . '" size="30" /><span class="floating-label">'. esc_attr__('Your Website', 'diego').'</span></div></div></div></div>'
    );

    if ( is_user_logged_in() ) {
        $cl = 'loginformuser';
    } else {
        $cl = '';
    }
    $defaults = [
        'fields'             => $fields,
        'comment_field'      => '
            <div class="row post-input">
                <div class="col-md-12 ' . $cl . '">
                    <div class="tp-postbox-details-input-box"><div class="postbox__comment-input mb-15"><textarea class="tp-form-control textareaText msg-box" id="comment" name="comment" cols="45" rows="8" aria-required="true"></textarea><span class="floating-label-2">'. esc_attr__('Your Comment', 'diego').'</span>
                </div></div></div>
                <div class="clearfix"></div>
            </div>
        ',
        'submit_button'    => '<div class="col-xl-12"><div class="postbox__comment-btn"><button class="tp-btn-white-lg" type="submit"> <span> <i>' . esc_html__( 'Post Comment', 'diego' ) . '</i> </span> </button></div></div>',
        /** This filter is documented in wp-includes/link-template.php */
        'must_log_in'        => '
            <p class="must-log-in">
            '.esc_html__('You must be','diego').' <a href="'.esc_url(wp_login_url( apply_filters( 'the_permalink', get_permalink( $post_id ) ) )).'">'.esc_html__('logged in','diego').'</a> '.esc_html__('to post a comment.','diego').'
            </p>',
        /** This filter is documented in wp-includes/link-template.php */
        'logged_in_as'       => '
            <p class="logged-in-as">
            '.esc_html__('Logged in as','diego').' <a href="'.esc_url(get_edit_user_link()).'">'.esc_html($user_identity).'</a>. <a href="'.esc_url(wp_logout_url( apply_filters( 'the_permalink', get_permalink( $post_id ) ) )).'" title="'.esc_attr__('Log out of this account','diego').'">'.esc_html__('Log out?','diego').'</a>
            </p>',
        'id_form'            => 'commentform',
        'id_submit'          => 'submit',
        'class_submit'       => 'tp-btn',
        'title_reply'        => esc_html__( 'Leave a Reply', 'diego' ),
        'title_reply_to'     => esc_html__( 'Leave a Reply to %s', 'diego' ),
        'cancel_reply_link'  => esc_html__( 'Cancel reply', 'diego' ),
        'label_submit'       => esc_html__( 'Post Comment', 'diego' ),
        'format'             => 'xhtml',
    ];

    comment_form( $defaults );
    ?>

</div><!-- #comments -->
<?php endif;