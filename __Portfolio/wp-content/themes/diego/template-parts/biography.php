<?php
    $author_data = get_the_author_meta( 'description', get_query_var( 'author' ) );
    $author_name = get_the_author_meta( 'display_name', get_query_var( 'author' ) );
    $facebook_url = get_the_author_meta( 'diego_facebook' );
    $twitter_url = get_the_author_meta( 'diego_twitter' );
    $linkedin_url = get_the_author_meta( 'diego_linkedin' );
    $instagram_url = get_the_author_meta( 'diego_instagram' );
    $youtube_url = get_the_author_meta( 'diego_youtube' );
    $diego_write_by = get_the_author_meta( 'diego_write_by' );
    $diego_user_bio = get_the_author_meta( 'diego_user_bio' );
    $author_bio_avatar_size = 180;


    if ( $author_data != '' ):
?>

<div class="postbox-details__author-info-box mb-95 p-relative">
    <div class="postbox-details__author-wrap d-flex align-items-center">
        <div class="postbox-details__author-avata">
            <a href="<?php print esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) )?>">
                <?php print get_avatar( get_the_author_meta( 'user_email' ), $author_bio_avatar_size, '', '', [ 'class' => 'media-object img-circle' ] );?>  
            </a>
        </div>
        <div class="postbox-details__author-content">
            <h4><a href="<?php print esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) )?>"><?php print esc_html($author_name); ?></a></h4>
            <p><?php echo esc_html($diego_user_bio); ?></p>
        </div>
    </div>
    <div class="postbox-details__author-social-wrap">
        <div class="postbox-details__author-social-link">
        <?php if(!empty($facebook_url)) :?>
            <a href="<?php echo esc_url($facebook_url); ?>">
                <span>
                    <svg width="8" height="14" viewBox="0 0 8 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M7.7 0H5.6C4.67174 0 3.7815 0.368749 3.12513 1.02513C2.46875 1.6815 2.1 2.57174 2.1 3.5V5.6H0V8.4H2.1V14H4.9V8.4H7L7.7 5.6H4.9V3.5C4.9 3.31435 4.97375 3.1363 5.10503 3.00503C5.2363 2.87375 5.41435 2.8 5.6 2.8H7.7V0Z" fill="currentcolor" fill-opacity="0.7"></path>
                    </svg>
                </span>
            </a>
            <?php endif; ?>

            <?php if(!empty($twitter_url)) :?>
            <a href="<?php echo esc_url($twitter_url); ?>">
                <span>
                    <svg width="13" height="11" viewBox="0 0 13 11" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M13 0.00594201C12.4341 0.405088 11.8076 0.71037 11.1445 0.910033C10.7887 0.500835 10.3157 0.210805 9.78961 0.0791711C9.26353 -0.0524632 8.7097 -0.0193515 8.20305 0.174028C7.69639 0.367408 7.26135 0.711725 6.95676 1.16041C6.65217 1.6091 6.49273 2.1405 6.5 2.68276V3.27367C5.46156 3.3006 4.43257 3.07029 3.50469 2.60325C2.5768 2.13622 1.77882 1.44695 1.18182 0.596851C1.18182 0.596851 -1.18182 5.91503 4.13636 8.27867C2.9194 9.10474 1.46968 9.51895 0 9.46049C5.31818 12.415 11.8182 9.46049 11.8182 2.66503C11.8176 2.50044 11.8018 2.33625 11.7709 2.17458C12.374 1.57982 12.7996 0.828909 13 0.00594201Z" fill="currentcolor" fill-opacity="0.7"></path>
                    </svg>
                </span>
            </a>
            <?php endif; ?>

            <?php if(!empty($linkedin_url)) :?>
            <a href="<?php echo esc_url($linkedin_url); ?>">
                <span>
                    <svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M7.93792 3.78955C8.94295 3.78955 9.90682 4.1888 10.6175 4.89946C11.3282 5.61013 11.7274 6.574 11.7274 7.57903V12.0001H9.20108V7.57903C9.20108 7.24402 9.068 6.92273 8.83111 6.68584C8.59422 6.44896 8.27293 6.31587 7.93792 6.31587C7.60291 6.31587 7.28162 6.44896 7.04473 6.68584C6.80784 6.92273 6.67476 7.24402 6.67476 7.57903V12.0001H4.14844V7.57903C4.14844 6.574 4.54769 5.61013 5.25835 4.89946C5.96902 4.1888 6.93289 3.78955 7.93792 3.78955Z" fill="currentcolor" fill-opacity="0.7"></path>
                        <path d="M2.52632 4.4209H0V11.9999H2.52632V4.4209Z" fill="currentcolor" fill-opacity="0.7"></path>
                        <path d="M1.26316 2.52632C1.96079 2.52632 2.52632 1.96079 2.52632 1.26316C2.52632 0.565536 1.96079 0 1.26316 0C0.565536 0 0 0.565536 0 1.26316C0 1.96079 0.565536 2.52632 1.26316 2.52632Z" fill="currentcolor" fill-opacity="0.7"></path>
                    </svg>
                </span>
            </a>
            <?php endif; ?>

            <?php if(!empty($instagram_url)) :?>
            <a href="<?php echo esc_url($instagram_url); ?>"><i class="fa-brands fa-instagram"></i></a>
            <?php endif; ?>

            <?php if(!empty($youtube_url)) :?>
            <a href="<?php echo esc_url($youtube_url); ?>"><i class="fa-brands fa-youtube"></i></a>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php endif;?>
