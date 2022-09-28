<?php
/**
 * Add a new page under Appearance
 */

function dalmatian_blog_getting_started_menu() {

	add_theme_page( esc_html__( 'Getting Started', 'dalmatian-blog' ), esc_html__( 'Getting Started', 'dalmatian-blog' ), 'edit_theme_options', 'dalmatian-blog-get-started', 'dalmatian_blog_getting_started_page' );
}
add_action( 'admin_menu', 'dalmatian_blog_getting_started_menu' );

/**
 * Enqueue styles for the help page.
 */
function dalmatian_blog_admin_scripts() {

	wp_enqueue_style( 'dalmatian-blog-admin-style', get_template_directory_uri() . '/inc/getting-started/getting-started.css', array(), DALMATIAN_BLOG_VERSION );
}
add_action( 'admin_enqueue_scripts', 'dalmatian_blog_admin_scripts' );

/**
 * Add the theme page
 */
function dalmatian_blog_getting_started_page() { ?>

<div class="main-info">

	<?php get_template_part( 'inc/getting-started/template-parts/main', 'info' ); ?>

</div>
<div class="top-wrapper">

	<?php get_template_part( 'inc/getting-started/template-parts/free-vs', 'pro' ); ?>

	<?php get_template_part( 'inc/getting-started/template-parts/faq' ); ?>


</div>
	<?php
}