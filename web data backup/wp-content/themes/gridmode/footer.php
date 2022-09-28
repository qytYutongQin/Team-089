<?php
/**
* The template for displaying the footer
*
* @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
*
* @package GridMode WordPress Theme
* @copyright Copyright (C) 2022 ThemesDNA
* @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
* @author ThemesDNA <themesdna@gmail.com>
*/
?>

</div>

</div><!--/#gridmode-content-wrapper -->
</div><!--/#gridmode-wrapper -->

<?php gridmode_bottom_wide_widgets(); ?>

<?php if ( 'before-footer' === gridmode_secondary_menu_location() ) { ?><?php gridmode_secondary_menu_area(); ?><?php } ?>

<?php gridmode_before_footer(); ?>

<?php if ( !(gridmode_hide_footer_widgets()) ) { ?>
<?php if ( is_active_sidebar( 'gridmode-footer-1' ) || is_active_sidebar( 'gridmode-footer-2' ) || is_active_sidebar( 'gridmode-footer-3' ) || is_active_sidebar( 'gridmode-footer-4' ) || is_active_sidebar( 'gridmode-top-footer' ) || is_active_sidebar( 'gridmode-bottom-footer' ) ) : ?>
<div class='gridmode-clearfix' id='gridmode-footer-blocks' itemscope='itemscope' itemtype='http://schema.org/WPFooter' role='contentinfo'>
<div class='gridmode-container gridmode-clearfix'>
<div class="gridmode-outer-wrapper">

<?php if ( is_active_sidebar( 'gridmode-top-footer' ) ) : ?>
<div class='gridmode-clearfix'>
<div class='gridmode-top-footer-block'>
<?php dynamic_sidebar( 'gridmode-top-footer' ); ?>
</div>
</div>
<?php endif; ?>

<?php if ( is_active_sidebar( 'gridmode-footer-1' ) || is_active_sidebar( 'gridmode-footer-2' ) || is_active_sidebar( 'gridmode-footer-3' ) || is_active_sidebar( 'gridmode-footer-4' ) ) : ?>
<div class='gridmode-footer-block-cols gridmode-clearfix'>

<div class="gridmode-footer-block-col gridmode-footer-4-col" id="gridmode-footer-block-1">
<?php dynamic_sidebar( 'gridmode-footer-1' ); ?>
</div>

<div class="gridmode-footer-block-col gridmode-footer-4-col" id="gridmode-footer-block-2">
<?php dynamic_sidebar( 'gridmode-footer-2' ); ?>
</div>

<div class="gridmode-footer-block-col gridmode-footer-4-col" id="gridmode-footer-block-3">
<?php dynamic_sidebar( 'gridmode-footer-3' ); ?>
</div>

<div class="gridmode-footer-block-col gridmode-footer-4-col" id="gridmode-footer-block-4">
<?php dynamic_sidebar( 'gridmode-footer-4' ); ?>
</div>

</div>
<?php endif; ?>

<?php if ( is_active_sidebar( 'gridmode-bottom-footer' ) ) : ?>
<div class='gridmode-clearfix'>
<div class='gridmode-bottom-footer-block'>
<?php dynamic_sidebar( 'gridmode-bottom-footer' ); ?>
</div>
</div>
<?php endif; ?>

</div>
</div>
</div><!--/#gridmode-footer-blocks-->
<?php endif; ?>
<?php } ?>

<div class='gridmode-clearfix' id='gridmode-copyright-area'>
<div class='gridmode-copyright-area-inside gridmode-container'>
<div class="gridmode-outer-wrapper">

<div class='gridmode-copyright-area-inside-content gridmode-clearfix'>
<?php if ( gridmode_get_option('footer_text') ) : ?>
  <p class='gridmode-copyright'><?php echo esc_html(gridmode_get_option('footer_text')); ?></p>
<?php else : ?>
  <p class='gridmode-copyright'><?php /* translators: %s: Year and site name. */ printf( esc_html__( 'Copyright &copy; %s', 'gridmode' ), esc_html(date_i18n(__('Y','gridmode'))) . ' ' . esc_html(get_bloginfo( 'name' ))  ); ?></p>
<?php endif; ?>
<p class='gridmode-credit'><a href="<?php echo esc_url( 'https://themesdna.com/' ); ?>"><?php /* translators: %s: Theme author. */ printf( esc_html__( 'Design by %s', 'gridmode' ), 'ThemesDNA.com' ); ?></a></p>
</div>

</div>
</div>
</div><!--/#gridmode-copyright-area -->

<?php if ( 'after-footer' === gridmode_secondary_menu_location() ) { ?><?php gridmode_secondary_menu_area(); ?><?php } ?>

<?php gridmode_after_footer(); ?>

<?php if ( gridmode_is_backtotop_active() ) { ?><button class="gridmode-scroll-top" title="<?php esc_attr_e('Scroll to Top','gridmode'); ?>"><i class="fas fa-arrow-up" aria-hidden="true"></i><span class="gridmode-sr-only"><?php esc_html_e('Scroll to Top', 'gridmode'); ?></span></button><?php } ?>

<?php wp_footer(); ?>
</body>
</html>