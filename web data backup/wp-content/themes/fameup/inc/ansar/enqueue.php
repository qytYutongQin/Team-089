<?php function fameup_scripts() {

	wp_enqueue_style('bootstrap', get_template_directory_uri() . '/css/bootstrap.css');

	wp_enqueue_style( 'fameup-style', get_stylesheet_uri() );

	wp_style_add_data( 'fameup-style', 'rtl', 'replace' );

	wp_enqueue_style('font-awesome',get_template_directory_uri().'/css/font-awesome.css');

	wp_enqueue_style('all-css',get_template_directory_uri().'/css/all.css');

	fameup_color_css();

	wp_enqueue_style('fameup-dark', get_template_directory_uri() . '/css/colors/dark.css');

	wp_enqueue_style('swiper-bundle-css', get_template_directory_uri() . '/css/swiper-bundle.css');
	
	wp_enqueue_style('smartmenus',get_template_directory_uri().'/css/jquery.smartmenus.bootstrap.css');	

	wp_enqueue_style('animate',get_template_directory_uri().'/css/animate.css');	

	/* Js script */

	wp_enqueue_script( 'fameup-navigation', get_template_directory_uri() . '/js/navigation.js', array('jquery'));

	wp_enqueue_script('bootstrap', get_template_directory_uri() . '/js/bootstrap.js', array('jquery'));

	wp_enqueue_script('swiper-bundle', get_template_directory_uri() . '/js/swiper-bundle.js', array('jquery'));

	$fameup_wow_animation_enable = get_theme_mod('fameup_wow_animation_enable','true');
	if($fameup_wow_animation_enable == true) {
	wp_enqueue_script('wow', get_template_directory_uri() . '/js/wow.js', array('jquery'));
	}

	wp_enqueue_script('fameup-jquery-marquee-min', get_template_directory_uri() . '/js/jquery.marquee.min.js' , array('jquery'));
	
	wp_enqueue_script('fameup_main-js', get_template_directory_uri() . '/js/main.js' , array('jquery'));

	wp_enqueue_script('smartmenus-js', get_template_directory_uri() . '/js/jquery.smartmenus.js');

	wp_enqueue_script('bootstrap-smartmenus-js', get_template_directory_uri() . '/js/jquery.smartmenus.bootstrap.js' , array('jquery'));

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action('wp_enqueue_scripts', 'fameup_scripts');
function fameup_admin_enqueue( $hook ) {

	wp_enqueue_script( 'media-upload' );

	wp_enqueue_media();

	wp_enqueue_style( 'fameup-admin-style', get_template_directory_uri() . '/css/admin-style.css' );



}
add_action( 'admin_enqueue_scripts', 'fameup_admin_enqueue' );
//Custom Color
function fameup_custom_js() {
    
	wp_enqueue_script('fameup_custom', get_template_directory_uri() . '/js/custom.js' , array('jquery'));

	wp_enqueue_script('fameup-dark', get_template_directory_uri() . '/js/dark.js' , array('jquery'));

	theme_options_color();

	$header_time_enable = get_theme_mod('header_time_enable','true'); 
 if($header_time_enable == 'true') { 
 
 $fameup_date_time_show_type = get_theme_mod('fameup_date_time_show_type','fameup_default'); 

 if($fameup_date_time_show_type == 'fameup_default'){

wp_enqueue_script('fameup-custom-time', get_template_directory_uri() . '/js/custom-time.js' , array('jquery')); 

} }
}
add_action('wp_footer','fameup_custom_js');


/**
 * Fix skip link focus in IE11.
 *
 * This does not enqueue the script because it is tiny and because it is only for IE11,
 * thus it does not warrant having an entire dedicated blocking script being loaded.
 *
 * @link https://git.io/vWdr2
 */
function fameup_skip_link_focus_fix() {
	// The following is minified via `terser --compress --mangle -- js/skip-link-focus-fix.js`.
	?>
	<script>
	/(trident|msie)/i.test(navigator.userAgent)&&document.getElementById&&window.addEventListener&&window.addEventListener("hashchange",function(){var t,e=location.hash.substring(1);/^[A-z0-9_-]+$/.test(e)&&(t=document.getElementById(e))&&(/^(?:a|select|input|button|textarea)$/i.test(t.tagName)||(t.tabIndex=-1),t.focus())},!1);
	</script>
	<?php
}
add_action( 'wp_print_footer_scripts', 'fameup_skip_link_focus_fix' );

//Footer widget text color
function fameup_footer_text_color()
{
$fameup_footer_text_color = get_theme_mod('fameup_footer_text_color');
if($fameup_footer_text_color)
{ ?>
	<style>
		footer .bs-widget p, footer .site-title a, footer .site-title a:hover , footer .site-description, footer .site-description:hover, footer .bs-widget h6, footer .mg_contact_widget .bs-widget h6 {
	
			color: <?php echo esc_attr($fameup_footer_text_color); ?>;
		}
	</style>
<?php }
$fameup_footer_copy_bg = get_theme_mod('fameup_footer_copy_bg');
if($fameup_footer_copy_bg){ ?>
	<style>
		footer .bs-footer-copyright {
    		background: <?php echo esc_attr($fameup_footer_copy_bg); ?>;
		}
	</style>
<?php }
$fameup_footer_copy_text = get_theme_mod('fameup_footer_copy_text');
if($fameup_footer_copy_text)
{ ?>
	<style>
		footer .bs-footer-copyright p, footer .bs-footer-copyright a {
    		color: <?php echo esc_attr($fameup_footer_copy_text); ?>;
		}
	</style>
<?php } }
add_action('wp_footer','fameup_footer_text_color');


function fameup_customizer_scripts() {
	
		wp_enqueue_style( 'fameup-customizer-styles', get_template_directory_uri() . '/css/customizer-controls.css' );
}
add_action( 'customize_controls_print_footer_scripts', 'fameup_customizer_scripts' );

function fameup_menu(){ ?>
	<script>
jQuery('a,input').bind('focus', function() {
   if(!jQuery(this).closest(".menu-item").length && ( jQuery(window).width() <= 992) ) {
	    jQuery('.navbar-collapse').removeClass('show');
	}})
</script>
<?php } 
add_action( 'wp_footer', 'fameup_menu' );
?>