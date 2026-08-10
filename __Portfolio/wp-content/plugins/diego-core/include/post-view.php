<?php



function diego_blog_single_social(){
    $post_url = get_the_permalink();
 ?>    


    <div class="postbox-details__top-social tp-blog-social-sticky d-none d-xxl-inline-flex">
         <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo esc_url($post_url);?>">
            <span>
               <svg width="8" height="14" viewBox="0 0 8 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M7.7 0H5.6C4.67174 0 3.7815 0.368749 3.12513 1.02513C2.46875 1.6815 2.1 2.57174 2.1 3.5V5.6H0V8.4H2.1V14H4.9V8.4H7L7.7 5.6H4.9V3.5C4.9 3.31435 4.97375 3.1363 5.10503 3.00503C5.2363 2.87375 5.41435 2.8 5.6 2.8H7.7V0Z" fill="currentcolor" fill-opacity="0.7"/>
               </svg>
            </span>
         </a>
         <a href="https://twitter.com/share?url=<?php echo esc_url($post_url);?>">
            <span>
               <svg width="13" height="11" viewBox="0 0 13 11" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M13 0.00594201C12.4341 0.405088 11.8076 0.71037 11.1445 0.910033C10.7887 0.500835 10.3157 0.210805 9.78961 0.0791711C9.26353 -0.0524632 8.7097 -0.0193515 8.20305 0.174028C7.69639 0.367408 7.26135 0.711725 6.95676 1.16041C6.65217 1.6091 6.49273 2.1405 6.5 2.68276V3.27367C5.46156 3.3006 4.43257 3.07029 3.50469 2.60325C2.5768 2.13622 1.77882 1.44695 1.18182 0.596851C1.18182 0.596851 -1.18182 5.91503 4.13636 8.27867C2.9194 9.10474 1.46968 9.51895 0 9.46049C5.31818 12.415 11.8182 9.46049 11.8182 2.66503C11.8176 2.50044 11.8018 2.33625 11.7709 2.17458C12.374 1.57982 12.7996 0.828909 13 0.00594201Z" fill="currentcolor" fill-opacity="0.7"/>
               </svg>
            </span>
         </a>
         <a href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo esc_url($post_url);?>">
            <span>
               <svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M7.93792 3.78955C8.94295 3.78955 9.90682 4.1888 10.6175 4.89946C11.3282 5.61013 11.7274 6.574 11.7274 7.57903V12.0001H9.20108V7.57903C9.20108 7.24402 9.068 6.92273 8.83111 6.68584C8.59422 6.44896 8.27293 6.31587 7.93792 6.31587C7.60291 6.31587 7.28162 6.44896 7.04473 6.68584C6.80784 6.92273 6.67476 7.24402 6.67476 7.57903V12.0001H4.14844V7.57903C4.14844 6.574 4.54769 5.61013 5.25835 4.89946C5.96902 4.1888 6.93289 3.78955 7.93792 3.78955Z" fill="currentcolor" fill-opacity="0.7"/>
                  <path d="M2.52632 4.4209H0V11.9999H2.52632V4.4209Z" fill="currentcolor" fill-opacity="0.7"/>
                  <path d="M1.26316 2.52632C1.96079 2.52632 2.52632 1.96079 2.52632 1.26316C2.52632 0.565536 1.96079 0 1.26316 0C0.565536 0 0 0.565536 0 1.26316C0 1.96079 0.565536 2.52632 1.26316 2.52632Z" fill="currentcolor" fill-opacity="0.7"/>
               </svg>
            </span>
         </a>
      </div>
   <?php return false;
}

function diego_blog_single_social_2(){
    $post_url = get_the_permalink();
 ?>    


      <div>
         <p><?php echo esc_html__('Share :', 'tpcore'); ?></p>
      </div>
      <div class="postbox-details-4__top-social">
         <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo esc_url($post_url);?>">
            <span>
               <svg width="8" height="14" viewBox="0 0 8 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M7.7 0H5.6C4.67174 0 3.7815 0.368749 3.12513 1.02513C2.46875 1.6815 2.1 2.57174 2.1 3.5V5.6H0V8.4H2.1V14H4.9V8.4H7L7.7 5.6H4.9V3.5C4.9 3.31435 4.97375 3.1363 5.10503 3.00503C5.2363 2.87375 5.41435 2.8 5.6 2.8H7.7V0Z" fill="currentcolor" fill-opacity="0.7"/>
               </svg>
            </span>
         </a>
         <a href="https://twitter.com/share?url=<?php echo esc_url($post_url);?>">
            <span>
               <svg width="13" height="11" viewBox="0 0 13 11" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M13 0.00594201C12.4341 0.405088 11.8076 0.71037 11.1445 0.910033C10.7887 0.500835 10.3157 0.210805 9.78961 0.0791711C9.26353 -0.0524632 8.7097 -0.0193515 8.20305 0.174028C7.69639 0.367408 7.26135 0.711725 6.95676 1.16041C6.65217 1.6091 6.49273 2.1405 6.5 2.68276V3.27367C5.46156 3.3006 4.43257 3.07029 3.50469 2.60325C2.5768 2.13622 1.77882 1.44695 1.18182 0.596851C1.18182 0.596851 -1.18182 5.91503 4.13636 8.27867C2.9194 9.10474 1.46968 9.51895 0 9.46049C5.31818 12.415 11.8182 9.46049 11.8182 2.66503C11.8176 2.50044 11.8018 2.33625 11.7709 2.17458C12.374 1.57982 12.7996 0.828909 13 0.00594201Z" fill="currentcolor" fill-opacity="0.7"/>
               </svg>
            </span>
         </a>
         <a href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo esc_url($post_url);?>">
            <span>
               <svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M7.93792 3.78955C8.94295 3.78955 9.90682 4.1888 10.6175 4.89946C11.3282 5.61013 11.7274 6.574 11.7274 7.57903V12.0001H9.20108V7.57903C9.20108 7.24402 9.068 6.92273 8.83111 6.68584C8.59422 6.44896 8.27293 6.31587 7.93792 6.31587C7.60291 6.31587 7.28162 6.44896 7.04473 6.68584C6.80784 6.92273 6.67476 7.24402 6.67476 7.57903V12.0001H4.14844V7.57903C4.14844 6.574 4.54769 5.61013 5.25835 4.89946C5.96902 4.1888 6.93289 3.78955 7.93792 3.78955Z" fill="currentcolor" fill-opacity="0.7"/>
                  <path d="M2.52632 4.4209H0V11.9999H2.52632V4.4209Z" fill="currentcolor" fill-opacity="0.7"/>
                  <path d="M1.26316 2.52632C1.96079 2.52632 2.52632 1.96079 2.52632 1.26316C2.52632 0.565536 1.96079 0 1.26316 0C0.565536 0 0 0.565536 0 1.26316C0 1.96079 0.565536 2.52632 1.26316 2.52632Z" fill="currentcolor" fill-opacity="0.7"/>
               </svg>
            </span>
         </a>
      </div>
   <?php return false;
}

// shofy_product_single_social
function diego_product_single_social(){
    $post_url = get_the_permalink();
 ?>    
    <div class="tp-product-details-social">
        <span><?php echo esc_html__('Share:', 'tpcore');?> </span>
        <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo esc_url($post_url);?>" target="_blank"><i class="fa-brands fa-facebook-f"></i></a>
        <a href="https://twitter.com/share?url=<?php echo esc_url($post_url);?>" target="_blank"><i class="fa-brands fa-twitter"></i></a>
        <a href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo esc_url($post_url);?>" target="_blank"><i class="fa-brands fa-linkedin-in"></i></a>
        
    </div>

   <?php return false;
}


function theme_domain_reading_time() {
   global $post;
   // load the content
   $thecontent = $post->post_content;
   // count the number of words
   $words = str_word_count( strip_tags( $thecontent ) );
   // rounding off and deviding per 200 words per minute
   $m = floor( $words / 50 );

   // calculate the amount of read time
   $readtime = $m . ' min' . ( $m == 1 ? '' : 's' ) ;

   // return the readtime
   return $readtime;
}

function menu_item_onepage( $item_id, $item ) {
	$menu_item_onepage = get_post_meta( $item_id, '_menu_item_onepage', true );
	?>
	<div style="clear: both;">
	    <span class="description"><?php _e( "Data Atrribute", 'menu-item-desc' ); ?></span><br />
	    <input type="hidden" class="nav-menu-id" value="<?php echo $item_id ;?>" />
	    <div class="logged-input-holder">
	        <input type="text" name="menu_item_onepage[<?php echo $item_id ;?>]" id="menu-item-desc-<?php echo $item_id ;?>" value="<?php echo esc_attr( $menu_item_onepage ); ?>" />
	    </div>
	</div>
	<?php
}
add_action( 'wp_nav_menu_item_custom_fields', 'menu_item_onepage', 10, 2 );

function save_menu_item_onepage( $menu_id, $menu_item_db_id ) {
	if ( isset( $_POST['menu_item_onepage'][$menu_item_db_id]  ) ) {
		$sanitized_data = sanitize_text_field( $_POST['menu_item_onepage'][$menu_item_db_id] );
		update_post_meta( $menu_item_db_id, '_menu_item_onepage', $sanitized_data );
	} else {
		delete_post_meta( $menu_item_db_id, '_menu_item_onepage' );
	}
}
add_action( 'wp_update_nav_menu_item', 'save_menu_item_onepage', 10, 2 );


function diego_load_mores(){
   $page = $_POST['page'];
   
   $query = new WP_Query([
       'post_type' => 'post',
       'post_status' => 'publish',
       'posts_per_page' => 5,
       'paged' => $page
   ]);


   if ($query->have_posts()) : ?>
      <?php while ($query->have_posts()) : 
         $query->the_post();
         global $post;

         $categories = get_the_category($post->ID);
   ?>

<div class="col-xl-6 col-lg-6 col-md-6">
   <div class="blog-list__sm-item mb-60 pb-30">
      <?php if ( has_post_thumbnail() ): ?> 
      <div class="blog-list__sm-thumb">
         <a href="<?php the_permalink(); ?>">
            <?php the_post_thumbnail('thumbnail');?>
         </a>
      </div>
      <?php endif; ?>
      <div class="blog-list__sm-category">
        
         <?php if ( !empty($categories[0])): ?> 
         <span>
            <a href="<?php echo esc_url(get_category_link($categories[0]->term_id)); ?>"><?php echo esc_html($categories[0]->name); ?></a> / 
         </span>
         <?php endif; ?>

         <?php if ( !empty($categories[1])): ?> 
         <span>
            <a href="<?php echo esc_url(get_category_link($categories[1]->term_id)); ?>"><?php echo esc_html($categories[1]->name); ?></a>
         </span>
         <?php endif; ?>
      </div>
      <div class="blog-list__sm-title-box">
         <h4 class="blog-list__sm-title">
         <a href="<?php the_permalink(); ?>"><?php echo wp_trim_words(get_the_title(), $settings['tp_blog_title_word'], ''); ?></a>
         </h4>
      </div>
      <div class="blog-list__sm-author d-flex align-items-center">
         <div class="blog-list__sm-author-avata">
            <img src="assets/img/users/blog-list-avata-1.png" alt="">
         </div>
         <div class="blog-list__sm-author-content">
            <h4>Nitin Sharma</h4>
            <span><?php the_time( get_option('date_format') ); ?><i>.</i><?php echo theme_domain_reading_time(); ?> <?php echo esc_html__('read', 'tpcore'); ?></span>
         </div>
      </div>
   </div>
</div>


      <?php 
      endwhile; 
      wp_reset_query();
      endif;
}

// add_action('wp_ajax_diego_load_more', 'diego_load_more');
// add_action('wp_ajax_nopriv_diego_load_more', 'diego_load_more');