<?php
use function TPCore\Widgets\tp_kses;
	/**
	 * Diego Footer full Widget
	 *
	 *
	 * @author 		ThemePure
	 * @category 	Widgets
	 * @package 	Diego/Widgets
	 * @version 	1.0.0
	 * @extends 	WP_Widget
	 */
	add_action('widgets_init', 'Deigo_About_Widget');
	function Deigo_About_Widget() {
		register_widget('Deigo_About_Widget');
	}
	
	
	class Deigo_About_Widget  extends WP_Widget{
		
		public function __construct(){
			parent::__construct('Deigo_About_Widget',esc_html__('Diego :: About (footer)','tpcore'),array(
				'description' => esc_html__('Diego About Widget For Footer','tpcore'),
			));
		}
		
		public function widget($args, $instance){
			extract($args);
			extract($instance);

			print $before_widget; 
			?>

    <?php if( !empty($footer_logo) ): ?>
    <div class="tp-footer-4__logo">
        <?php if(!empty($img_link)) : ?>
        <a href="<?php echo esc_url($img_link); ?>">
            <img src="<?php echo esc_url( $footer_logo ); ?>" height="auto" data-width="<?php echo esc_attr($logo_width); ?>"  alt="<?php echo esc_attr__('Diego Logo', 'tpcore');?>">
        </a>
        <?php else : ?>
        <img src="<?php echo esc_url( $footer_logo ); ?>" height="auto" data-width="<?php echo esc_attr($logo_width); ?>" alt="<?php echo esc_attr__('Diego Logo', 'tpcore');?>">
        <?php endif; ?>
    </div>
    <?php endif; ?>

    <?php if(!empty($short_description)) : ?>
    <div class="tp-footer-4__content">
        <p><?php echo tp_kses($short_description); ?></p>
    </div>
    <?php endif; ?>

    <div class="tp-footer-4__social">

        <?php if(!empty($facebook_link)) : ?>
        <a href="<?php echo esc_url($facebook_link); ?>"><i class="fab fa-facebook-f"></i></a>
        <?php endif; ?>
        <?php if(!empty($twitter_link)) : ?>
        <a href="<?php echo esc_url($twitter_link); ?>"><i class="fab fa-twitter"></i></a>
        <?php endif; ?>
        <?php if(!empty($instagram_link)) : ?>
        <a href="<?php echo esc_url($instagram_link); ?>"><i class="fab fa-instagram"></i></a>
        <?php endif; ?>
        <?php if(!empty($linkedin_link)) : ?>
        <a href="<?php echo esc_url($linkedin_link); ?>"><i class="fab fa-linkedin-in"></i></a>
        <?php endif; ?>


        <?php if(!empty($behance_link)) : ?>
        <!-- behance -->
        <a href="<?php echo esc_url($behance_link); ?>">
            <span>
                <svg width="17" height="11" viewBox="0 0 17 11" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M1 5.50008H6.25009C7.52511 5.50008 8.50013 6.47509 8.50013 7.75012C8.50013 9.02514 7.52511 10.0002 6.25009 10.0002H1.75001C1.30001 10.0002 1 9.70015 1 9.25014V1.75001C1 1.30001 1.30001 1 1.75001 1H5.50008C6.7751 1 7.75012 1.97502 7.75012 3.25004C7.75012 4.52506 6.7751 5.50008 5.50008 5.50008H1Z" stroke="currentcolor" stroke-width="1.5" stroke-miterlimit="10"/>
                    <path d="M9.99988 7.00005H16C16 5.35002 14.65 4 12.9999 4C11.3499 4 9.99988 5.35002 9.99988 7.00005ZM9.99988 7.00005C9.99988 8.65008 11.3499 10.0001 12.9999 10.0001H14.275" stroke="currentcolor" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M14.1249 2.125H11.8749" stroke="currentcolor" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </span>
        </a>
        <?php endif; ?>

        <?php if(!empty($dribble_link)) : ?>
        <!-- dribble -->
        <a href="<?php echo esc_url($dribble_link); ?>">
            <span>
                <svg width="18" height="17" viewBox="0 0 18 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M2.50589 12.2494C4.57662 15.836 9.16278 17.0648 12.7494 14.9941C14.2113 14.15 15.2816 12.888 15.8962 11.4461C16.7895 9.35066 16.7208 6.87526 15.4941 4.75063C14.2674 2.62599 12.1581 1.32872 9.89669 1.05462C8.34063 0.866 6.71259 1.16183 5.25063 2.00589C1.66403 4.07662 0.435172 8.66278 2.50589 12.2494Z" stroke="currentcolor" stroke-width="1.5"/>
                    <path d="M12.712 14.9291C12.712 14.9291 12.0079 9.98655 10.5004 7.37547C8.99289 4.76439 5.28862 2.07143 5.28862 2.07143M5.68375 15.1123C6.79479 11.7605 12.3392 8.04512 16.3967 8.93525M12.3103 1.90808C11.1945 5.22332 5.75659 8.88441 1.71802 8.08903" stroke="currentcolor" stroke-width="1.5" stroke-linecap="round"/>
                </svg>
            </span>
        </a>
        <?php endif; ?>

        <?php if(!empty($mail_link)) : ?>
        <!-- mail -->
        <a href="<?php echo esc_url($mail_link); ?>">
            <span>
                <svg width="17" height="15" viewBox="0 0 17 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M12.25 13.75H4.75C2.5 13.75 1 12.625 1 10V4.75C1 2.125 2.5 1 4.75 1L12.25 1C14.5 1 16 2.125 16 4.75V10C16 12.625 14.5 13.75 12.25 13.75Z" stroke="currentcolor" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M12.25 5.12488L9.9025 6.99988C9.13 7.61488 7.8625 7.61488 7.09 6.99988L4.75 5.12488" stroke="currentcolor" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </span>
        </a>
        <?php endif; ?>

        <?php if(!empty($youtube_link)) : ?>
        <!-- youtube -->
        <a href="<?php echo esc_url($youtube_link); ?>">
            <span>
                <svg width="18" height="14" viewBox="0 0 18 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M12.75 13H5.25C3 13 1.5 11.5 1.5 9.25V4.75C1.5 2.5 3 1 5.25 1H12.75C15 1 16.5 2.5 16.5 4.75V9.25C16.5 11.5 15 13 12.75 13Z" stroke="currentcolor" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M8.70822 5.14898L10.802 6.40526C11.5558 6.90777 11.5558 7.66154 10.802 8.16405L8.70822 9.42033C7.8707 9.92285 7.20068 9.50409 7.20068 8.58281V6.07025C7.20068 4.98147 7.8707 4.64646 8.70822 5.14898Z" fill="currentcolor"/>
                </svg>
            </span>
        </a>
        <?php endif; ?>
    </div>




<?php print $after_widget; ?>

<?php 
		}
		

		/**
		 * widget function.
		 *
		 * @see WP_Widget
		 * @access public
		 * @param array $instance
		 * @return void
		 */
		public function form($instance){

			//Image
            if ( isset( $instance[ 'footer_logo' ] ) ) {
                $footer_logo = $instance[ 'footer_logo' ];
            }else {
                $footer_logo = '';
            }

			$short_description = isset($instance['short_description'])? $instance['short_description']:'';
			$img_link = isset($instance['img_link'])? $instance['img_link']:'';
			$logo_width = isset($instance['logo_width'])? $instance['logo_width']:'';
			$facebook_link = isset($instance['facebook_link'])? $instance['facebook_link']:'';
			$twitter_link = isset($instance['twitter_link'])? $instance['twitter_link']:'';
			$instagram_link = isset($instance['instagram_link'])? $instance['instagram_link']:'';
			$linkedin_link = isset($instance['linkedin_link'])? $instance['linkedin_link']:'';
			$youtube_link = isset($instance['youtube_link'])? $instance['youtube_link']:'';
			$dribble_link = isset($instance['dribble_link'])? $instance['dribble_link']:'';
			$behance_link = isset($instance['behance_link'])? $instance['behance_link']:'';
			$mail_link = isset($instance['mail_link'])? $instance['mail_link']:'';

			?>

<p>
    <input value="<?php echo esc_attr( $footer_logo ); ?>"
        name="<?php echo $this->get_field_name( 'footer_logo' ); ?>" type="hidden" class="widefat img_val"
        type="text" />
    <img class="img_show" src="<?php echo esc_url( $footer_logo ); ?>" alt="">
</p>

<p>
    <button
        class="button about-up-btn"><?php ( empty( $footer_logo ) ) ?  esc_html_e( "Upload Image", "mechon" ) : esc_html_e( "Change Image", "mechon" ); ?></button>
</p>

<!-- img url -->
<p><label for="img_url"><?php esc_html_e('Logo Link', 'tpcore'); ?></label></p>
<input type="text" class="widefat" id="<?php echo esc_attr($this->get_field_id('img_link')); ?>"
    name="<?php echo esc_attr($this->get_field_name('img_link')); ?>" value="<?php echo esc_attr($img_link); ?>">

<!-- Logo Width -->
<p><label for="logo_width"><?php esc_html_e('Logo Width', 'tpcore'); ?></label></p>
<input type="text" class="widefat" id="<?php echo esc_attr($this->get_field_id('logo_width')); ?>" name="<?php echo esc_attr($this->get_field_name('logo_width')); ?>" value="<?php echo esc_attr($logo_width); ?>">

<!-- short description -->
<p><label for="short_description"><?php esc_html_e('Short Description:','tpcore'); ?></p>
<textarea class="widefat" cols="15" rows="3" id="<?php echo esc_attr($this->get_field_id('short_description')); ?>"
    name="<?php echo esc_attr($this->get_field_name('short_description')); ?>"><?php print esc_attr($short_description); ?></textarea>

<h3><?php esc_html_e('Social Links :', 'tpcore'); ?></h3>
<hr>

<!-- facebook -->
<p><label for="facebook_link"><?php esc_html_e('Facebook Link', 'tpcore'); ?></label></p>
<input type="text" class="widefat" id="<?php echo esc_attr($this->get_field_id('facebook_link')); ?>"
    name="<?php echo esc_attr($this->get_field_name('facebook_link')); ?>" value="<?php echo esc_attr($facebook_link); ?>">
<!-- twitter -->
<p><label for="tw_link"><?php esc_html_e('Twitter Link', 'tpcore'); ?></label></p>
<input type="text" class="widefat" id="<?php echo esc_attr($this->get_field_id('tw_link')); ?>"
    name="<?php echo esc_attr($this->get_field_name('twitter_link')); ?>" value="<?php echo esc_attr($twitter_link); ?>">
<!-- instagram -->
<p><label for="instagram_link"><?php esc_html_e('Instagram Link', 'tpcore'); ?></label></p>
<input type="text" class="widefat" id="<?php echo esc_attr($this->get_field_id('instagram_link')); ?>"
    name="<?php echo esc_attr($this->get_field_name('instagram_link')); ?>" value="<?php echo esc_attr($instagram_link); ?>">
<!-- linkedin -->
<p><label for="linkedin_link"><?php esc_html_e('Linkedin Link', 'tpcore'); ?></label></p>
<input type="text" class="widefat" id="<?php echo esc_attr($this->get_field_id('linkedin_link')); ?>"
    name="<?php echo esc_attr($this->get_field_name('linkedin_link')); ?>" value="<?php echo esc_attr($linkedin_link); ?>">
<!-- youtube -->
<p><label for="youtube_link"><?php esc_html_e('Youtube Link', 'tpcore'); ?></label></p>
<input type="text" class="widefat" id="<?php echo esc_attr($this->get_field_id('youtube_link')); ?>"
    name="<?php echo esc_attr($this->get_field_name('youtube_link')); ?>" value="<?php echo esc_attr($youtube_link); ?>"
    style="margin-bottom: 10px;">
<!-- Dribble -->
<p><label for="dribble_link"><?php esc_html_e('Dribble Link', 'tpcore'); ?></label></p>
<input type="text" class="widefat" id="<?php echo esc_attr($this->get_field_id('dribble_link')); ?>"
    name="<?php echo esc_attr($this->get_field_name('dribble_link')); ?>" value="<?php echo esc_attr($dribble_link); ?>"
    style="margin-bottom: 10px;">
<!-- Behance -->
<p><label for="behance_link"><?php esc_html_e('Behance Link', 'tpcore'); ?></label></p>
<input type="text" class="widefat" id="<?php echo esc_attr($this->get_field_id('behance_link')); ?>"
    name="<?php echo esc_attr($this->get_field_name('behance_link')); ?>" value="<?php echo esc_attr($behance_link); ?>"
    style="margin-bottom: 10px;">
<!-- Email -->
<p><label for="mail_link"><?php esc_html_e('Mail Link', 'tpcore'); ?></label></p>
<input type="text" class="widefat" id="<?php echo esc_attr($this->get_field_id('mail_link')); ?>"
    name="<?php echo esc_attr($this->get_field_name('mail_link')); ?>" value="<?php echo esc_attr($mail_link); ?>"
    style="margin-bottom: 10px;">

<script>
    jQuery(function ($) {
        'use strict';
        /**
         *
         * About Widget About Us upload
         *
         */
        $(function () {
            $(".img_show").css({
                "margin": "0 auto",
                "display": "block",
                "max-width": "80%"
            });
            $(document).on('widget-updated', function (event, widget) {
                var widget_id = $(widget).attr('id');
                if (widget_id.indexOf('mechon_aboutus_widget') != -1) {
                    $imgval = $(".img_val").val();
                    $(".img_show").attr("src", $imgval);
                    $(".img_show").css({
                        "margin": "0 auto",
                        "display": "block",
                        "max-width": "80%"
                    });
                }
            });
            $("body").off("click", ".about-up-btn");
            $("body").on("click", ".about-up-btn", function (e) {

                let frame = wp.media({
                    title: 'Select or Upload Media About Us',
                    button: {
                        text: 'Use this About Us'
                    },
                    multiple: false
                });

                frame.on("select", function () {
                    // Get media attachment details from the frame state
                    let $img = frame.state().get('selection').first().toJSON();

                    $(".img_show").attr("src", $img.url);
                    $(".img_val").val($img.url);

                    $(".img_val").trigger('change');

                    $(".about-up-btn").text("Change Image");
                });

                // Open Media Modal
                frame.open();
                e.preventDefault();
            });
        });
    });
</script>

<?php
		}
				
		public function update( $new_instance, $old_instance ) {
			$instance = array();
			$instance['footer_logo'] = ( ! empty( $new_instance['footer_logo'] ) ) ? strip_tags( $new_instance['footer_logo'] ) : '';
			$instance['short_description'] = ( ! empty( $new_instance['short_description'] ) ) ? strip_tags( $new_instance['short_description'] ) : '';
			$instance['img_link'] = ( ! empty( $new_instance['img_link'] ) ) ? strip_tags( $new_instance['img_link'] ) : '';
			$instance['logo_width'] = ( ! empty( $new_instance['logo_width'] ) ) ? strip_tags( $new_instance['logo_width'] ) : '';
			$instance['facebook_link'] = ( ! empty( $new_instance['facebook_link'] ) ) ? strip_tags( $new_instance['facebook_link'] ) : '';
			$instance['twitter_link'] = ( ! empty( $new_instance['twitter_link'] ) ) ? strip_tags( $new_instance['twitter_link'] ) : '';
			$instance['instagram_link'] = ( ! empty( $new_instance['instagram_link'] ) ) ? strip_tags( $new_instance['instagram_link'] ) : '';
			$instance['linkedin_link'] = ( ! empty( $new_instance['linkedin_link'] ) ) ? strip_tags( $new_instance['linkedin_link'] ) : '';
			$instance['youtube_link'] = ( ! empty( $new_instance['youtube_link'] ) ) ? strip_tags( $new_instance['youtube_link'] ) : '';
			$instance['dribble_link'] = ( ! empty( $new_instance['dribble_link'] ) ) ? strip_tags( $new_instance['dribble_link'] ) : '';
			$instance['behance_link'] = ( ! empty( $new_instance['behance_link'] ) ) ? strip_tags( $new_instance['behance_link'] ) : '';
			$instance['mail_link'] = ( ! empty( $new_instance['mail_link'] ) ) ? strip_tags( $new_instance['mail_link'] ) : '';
			return $instance;
		}
	}