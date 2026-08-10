<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package diego
 */
$diego_scroll_effect_from_customizer = get_theme_mod( 'smooth_scroll_switch', false );
$diego_scroll_effect_from_meta = function_exists( 'tpmeta_field' ) ? tpmeta_field( 'diego_scroll_effect' ) : 'off';
$diego_scroll_effect = ($diego_scroll_effect_from_meta == 'on')  ? true : $diego_scroll_effect_from_customizer;
 ?>
  <?php do_action( 'diego_footer_style' ); ?>
  </div> <!-- black bg end -->
  <?php if($diego_scroll_effect) : ?>
 </div> <!-- smooth scroll end -->
</div> <!-- smooth scroll end -->
<?php else : ?>
</div>
<?php endif; ?>


<?php wp_footer(); ?>
    </body>
</html>
