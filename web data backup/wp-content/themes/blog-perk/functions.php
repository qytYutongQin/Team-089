<?php
/**
 * Theme functions and definitions
 *
 * @package Blog Perk
 */
if ( ! function_exists( 'blogperk_enqueue_styles' ) ) :
	/**
	 * @since 0.1
	 */
	function blogperk_enqueue_styles() {
		wp_enqueue_style( 'fameup-style-parent', get_template_directory_uri() . '/style.css' );
		wp_enqueue_style( 'blogperk-style', get_stylesheet_directory_uri() . '/style.css', array( 'fameup-style-parent' ), '1.0' );
		wp_enqueue_style('bootstrap', get_template_directory_uri() . '/css/bootstrap.css');
		blogperk_color_css();
		if(is_rtl()){
		wp_enqueue_style( 'fameup_style_rtl', trailingslashit( get_template_directory_uri() ) . 'style-rtl.css' );
	    }
		
	}

endif;
add_action( 'wp_enqueue_scripts', 'blogperk_enqueue_styles', 9999 );


/* color css file. */
require( get_stylesheet_directory() . '/css/colors/color-css.php');


require( get_stylesheet_directory() . '/customizer-default.php');

require( get_stylesheet_directory() . '/inc/ansar/hooks/hook-front-page-main-banner-section.php');

function blogperk_theme_setup() {

//Load text domain for translation-ready
load_theme_textdomain('blogperk', get_stylesheet_directory() . '/languages');

// custom header Support
			$args = array(
			'default-image'		=>  '',
			'width'			=> '1600',
			'height'		=> '600',
			'flex-height'		=> false,
			'flex-width'		=> false,
			'header-text'		=> true,
			'default-text-color'	=> '#fff'
		);
		add_theme_support( 'custom-header', $args );
} 
add_action( 'after_setup_theme', 'blogperk_theme_setup' );

function blogperk_remove_some_widgets(){
// Unregister Frontpage sidebar
unregister_sidebar( 'front-page-sidebar' );
}
add_action( 'widgets_init', 'blogperk_remove_some_widgets', 11 );

function blogperk_menu(){ ?>
<script>
jQuery('a,input').bind('focus', function() {
    if(!jQuery(this).closest(".menu-item").length && ( jQuery(window).width() <= 992) ) {
    jQuery('.navbar-collapse').removeClass('show');
}})
</script>
<?php }
add_action( 'wp_footer', 'blogperk_menu' );