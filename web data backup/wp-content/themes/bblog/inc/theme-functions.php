<?php
/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function bblog_content_width() {
  $GLOBALS['content_width'] = apply_filters( 'bblog_content_width', 640 );
}
add_action( 'after_setup_theme', 'bblog_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function bblog_widgets_init() {
  register_sidebar(
    array(
      'name'          => esc_html__( 'Sidebar', 'bblog' ),
      'id'            => 'sidebar-1',
      'description'   => esc_html__( 'Add widgets here.', 'bblog' ),
      'before_widget' => '<section id="%1$s" class="widget %2$s">',
      'after_widget'  => '</section>',
      'before_title'  => '<h2 class="widget-title">',
      'after_title'   => '</h2>',
    )
  );
}
add_action( 'widgets_init', 'bblog_widgets_init' );