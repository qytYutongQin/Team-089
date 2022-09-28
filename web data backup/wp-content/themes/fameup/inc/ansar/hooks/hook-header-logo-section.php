<?php
if (!function_exists('fameup_header_logo_section')) :
/**
 *  Header
 *
 * @since Fameup
 *
 */
function fameup_header_logo_section()
{
?>
<!-- Main Menu Area-->
      <?php $background_image = get_theme_support( 'custom-header', 'default-image' );
            if ( has_header_image() ) {
              $background_image = get_header_image();
            } ?>
            <div class="bs-header-main" style='background-image: url("<?php echo esc_url( $background_image ); ?>" );'>
            <?php $remove_header_image_overlay = get_theme_mod('remove_header_image_overlay',false); ?>
              <div class="inner" <?php if($remove_header_image_overlay == false) { 
            $fameup_header_overlay_color = get_theme_mod('fameup_header_overlay_color','rgba(255,255,255,0.73)');?> style="background-color:<?php echo esc_attr($fameup_header_overlay_color);?>;" <?php } ?>>
          <div class="container">
            <div class="row">
              <div class="navbar-header">
                  <?php the_custom_logo(); 
                  if (display_header_text()) : ?>
                  <div class="site-branding-text">
                  <h1 class="site-title"> <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php echo esc_html(get_bloginfo( 'name' )); ?></a></h1>
                  <p class="site-description"><?php echo esc_html(get_bloginfo( 'description' )); ?></p>
                  </div>
                  <?php endif; ?>
                </div>
                <?php do_action('fameup_action_banner_advertisement'); ?>
            </div>
          </div>
        </div>
      </div>
      <!-- /Main Menu Area-->
<?php 
}
endif;
add_action('fameup_action_header_logo_section', 'fameup_header_logo_section', 4);