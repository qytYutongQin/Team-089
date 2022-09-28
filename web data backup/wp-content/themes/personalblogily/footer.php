<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package personalblogily
 */

?>
</div>
</div><!-- #content -->

<footer id="colophon" class="site-footer clearfix">

	<div class="content-wrap">
		<?php if ( is_active_sidebar( 'footerwidget-1' ) ) : ?>
			<div class="footer-column-wrapper">
				<div class="footer-column-three footer-column-left">
					<?php dynamic_sidebar( 'footerwidget-1' ); ?>
				</div>
			<?php endif; ?>

			<?php if ( is_active_sidebar( 'footerwidget-2' ) ) : ?>
				<div class="footer-column-three footer-column-middle">
					<?php dynamic_sidebar( 'footerwidget-2' ); ?>
				</div>
			<?php endif; ?>

			<?php if ( is_active_sidebar( 'footerwidget-3' ) ) : ?>
				<div class="footer-column-three footer-column-right">
					<?php dynamic_sidebar( 'footerwidget-3' ); ?>				
				</div>
			<?php endif; ?>

		</div>

		<?php if ( get_theme_mod( 'footer_copyright_control' ) == '' ) : ?>
			<div class="site-info">
				&copy;
				<?php echo esc_html(date_i18n(__('Y','personalblogily'))); ?> 
				<?php bloginfo( 'name' ); ?> 
				<span class="footer-info-right">
					<?php echo esc_html_e(' |', 'personalblogily') ?> <?php echo esc_html_e('Powered by Superbs ', 'personalblogily') ?> <a href="https://superbthemes.com/personalblogily/"><?php echo esc_html_e('Personal Blog theme', 'personalblogily') ?></a> 
					
				</span>
			</div>
		<?php else : ?>

		</div>

	<?php endif; ?>


</footer><!-- #colophon -->
</div><!-- #page -->

<div id="smobile-menu" class="mobile-only"></div>
<div id="mobile-menu-overlay"></div>

<?php wp_footer(); ?>
</body>
</html>
