<?php
/**
 * Moina Lite functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Moina Lite
 */

if ( ! defined( 'MOINA_LITE_VERSION' ) ) {
	$moina_lite_theme = wp_get_theme();
	define( 'MOINA_LITE_VERSION', $moina_lite_theme->get( 'Version' ) );
}


/**
 * Enqueue scripts and styles.
 */
function moina_lite_scripts() {
    wp_enqueue_style( 'moina-lite-parent-style', get_template_directory_uri() . '/style.css',array('bootstrap','slicknav','moina-default-block','moina-style'), '', 'all');
    wp_enqueue_style( 'moina-lite-main-style',get_stylesheet_directory_uri() . '/assets/css/main-style.css',array(), MOINA_LITE_VERSION, 'all');
}
add_action( 'wp_enqueue_scripts', 'moina_lite_scripts' );

/**
 * Custom excerpt length.
 */
function moina_lite_excerpt_length( $length ) {
    if ( is_admin() ) return $length;
    return 19;
}
add_filter( 'excerpt_length', 'moina_lite_excerpt_length', 999 );

/**
 * Load Padma Lite Customizer.
 */
require get_stylesheet_directory() . '/inc/customizer.php';

/**
 * Load Padma Lite Custom Style.
 */
require get_stylesheet_directory() . '/inc/custom-style.php';