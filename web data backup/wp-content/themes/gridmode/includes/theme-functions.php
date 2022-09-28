<?php
/**
* Theme Functions
*
* @package GridMode WordPress Theme
* @copyright Copyright (C) 2022 ThemesDNA
* @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
* @author ThemesDNA <themesdna@gmail.com>
*/

/**
 * This function return a value of given theme option name from database.
 *
 * @since 1.0.0
 *
 * @param string $option Theme option to return.
 * @return mixed The value of theme option.
 */
function gridmode_get_option($option) {
    $gridmode_options = get_option('gridmode_options');
    if ((is_array($gridmode_options)) && (array_key_exists($option, $gridmode_options))) {
        return $gridmode_options[$option];
    }
    else {
        return '';
    }
}

function gridmode_is_option_set($option) {
    $gridmode_options = get_option('gridmode_options');
    if ((is_array($gridmode_options)) && (array_key_exists($option, $gridmode_options))) {
        return true;
    } else {
        return false;
    }
}

if ( ! function_exists( 'gridmode_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function gridmode_setup() {
    
    global $wp_version;

    /*
     * Make theme available for translation.
     * Translations can be filed in the /languages/ directory.
     * If you're building a theme based on GridMode, use a find and replace
     * to change 'gridmode' to the name of your theme in all the template files.
     */
    load_theme_textdomain( 'gridmode', get_template_directory() . '/languages' );

    // Add default posts and comments RSS feed links to head.
    add_theme_support( 'automatic-feed-links' );

    /*
     * Let WordPress manage the document title.
     * By adding theme support, we declare that this theme does not use a
     * hard-coded <title> tag in the document head, and expect WordPress to
     * provide it for us.
     */
    add_theme_support( 'title-tag' );

    /*
     * Enable support for Post Thumbnails on posts and pages.
     *
     * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
     */
    add_theme_support( 'post-thumbnails' );

    if ( function_exists( 'add_image_size' ) ) {
        add_image_size( 'gridmode-1218w-autoh-image', 1218, 9999, false );
        add_image_size( 'gridmode-880w-autoh-image', 880, 9999, false );
        add_image_size( 'gridmode-360w-270h-image', 360, 270, true );
    }

    // This theme uses wp_nav_menu() in one location.
    register_nav_menus( array(
    'primary' => esc_html__('Primary Menu', 'gridmode'),
    'secondary' => esc_html__('Secondary Menu', 'gridmode')
    ) );

    /*
     * Switch default core markup for search form, comment form, and comments
     * to output valid HTML5.
     */
    $markup = array( 'comment-list', 'comment-form', 'search-form', 'gallery', 'caption', 'navigation-widgets' );
    add_theme_support( 'html5', $markup );

    /*
    * Enable support for Post Formats.
    *
    * See: https://codex.wordpress.org/Post_Formats
    */
    add_theme_support( 'post-formats', array(
        'aside', 'image', 'video', 'quote', 'link', 'gallery', 'status', 'audio', 'chat'
    ) );

    add_theme_support( 'custom-logo', array(
        'height'      => 37,
        'width'       => 280,
        'flex-height' => true,
        'flex-width'  => true,
        'header-text' => array( 'site-title', 'site-description' ),
    ) );

    // Support for Custom Header
    add_theme_support( 'custom-header', apply_filters( 'gridmode_custom_header_args', array(
    'default-image'          => '',
    'default-text-color'     => 'ffffff',
    'width'                  => 1920,
    'height'                 => 400,
    'flex-width'            => true,
    'flex-height'            => true,
    'wp-head-callback'       => 'gridmode_header_style',
    'uploads'                => true,
    ) ) );

    // Set up the WordPress core custom background feature.
    $background_args = array(
            'default-color'          => 'fffaf0',
            'default-image'          => get_template_directory_uri() .'/assets/images/background.png',
            'default-repeat'         => 'repeat',
            'default-position-x'     => 'left',
            'default-position-y'     => 'top',
            'default-size'     => 'auto',
            'default-attachment'     => 'fixed',
            'wp-head-callback'       => '_custom_background_cb',
            'admin-head-callback'    => 'admin_head_callback_func',
            'admin-preview-callback' => 'admin_preview_callback_func',
    );
    add_theme_support( 'custom-background', apply_filters( 'gridmode_custom_background_args', $background_args) );
    
    // Support for Custom Editor Style
    add_editor_style( 'assets/css/editor-style.css' );

    // Add support for responsive embedded content.
    add_theme_support( 'responsive-embeds' );

    // Add support for Block Styles.
    add_theme_support( 'wp-block-styles' );

    if ( !(gridmode_get_option('enable_widgets_block_editor')) ) {
        remove_theme_support( 'widgets-block-editor' );
    }

}
endif;
add_action( 'after_setup_theme', 'gridmode_setup' );


/**
* Layout Functions
*/

function gridmode_hide_footer_widgets() {
    $hide_footer_widgets = FALSE;

    if ( gridmode_get_option('hide_footer_widgets') ) {
        $hide_footer_widgets = TRUE;
    }

    return apply_filters( 'gridmode_hide_footer_widgets', $hide_footer_widgets );
}

function gridmode_is_header_content_active() {
    $header_content_active = TRUE;

    if ( gridmode_get_option('hide_header_content') ) {
        $header_content_active = FALSE;
    }

    return apply_filters( 'gridmode_is_header_content_active', $header_content_active );
}

function gridmode_is_primary_menu_active() {
    $primary_menu_active = TRUE;

    if ( gridmode_get_option('disable_primary_menu') ) {
        $primary_menu_active = FALSE;
    }

    return apply_filters( 'gridmode_is_primary_menu_active', $primary_menu_active );
}

function gridmode_is_secondary_menu_active() {
    $secondary_menu_active = TRUE;

    if ( gridmode_get_option('disable_secondary_menu') ) {
        $secondary_menu_active = FALSE;
    }

    return apply_filters( 'gridmode_is_secondary_menu_active', $secondary_menu_active );
}

function gridmode_is_social_buttons_active() {
    $social_buttons_active = TRUE;

    if ( gridmode_get_option('hide_social_buttons') ) {
        $social_buttons_active = FALSE;
    }

    return apply_filters( 'gridmode_is_social_buttons_active', $social_buttons_active );
}

function gridmode_is_fitvids_active() {
    $fitvids_active = TRUE;

    if ( gridmode_get_option('disable_fitvids') ) {
        $fitvids_active = FALSE;
    }

    return apply_filters( 'gridmode_is_fitvids_active', $fitvids_active );
}

function gridmode_is_backtotop_active() {
    $backtotop_active = TRUE;

    if ( gridmode_get_option('disable_backtotop') ) {
        $backtotop_active = FALSE;
    }

    return apply_filters( 'gridmode_is_backtotop_active', $backtotop_active );
}

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function gridmode_content_width() {
    $content_width = 868;

    if ( is_singular() ) {
        if ( is_page_template( array( 'template-full-width-page.php', 'template-full-width-post.php' ) ) ) {
           $content_width = 1206;
        } else {
            $content_width = 868;
        }
    } else {
        $content_width = 1206;
    }

    $GLOBALS['content_width'] = apply_filters( 'gridmode_content_width', $content_width ); /* phpcs:ignore WPThemeReview.CoreFunctionality.PrefixAllGlobals.NonPrefixedVariableFound */
}
add_action( 'template_redirect', 'gridmode_content_width', 0 );

function gridmode_post_summaries_style() {
   $summaries_style = 'grid';
    if ( gridmode_get_option('post_summaries_style') ) {
        $summaries_style = gridmode_get_option('post_summaries_style');
    }
   return apply_filters( 'gridmode_post_summaries_style', $summaries_style );
}

function gridmode_grid_post_class() {
    global $post;

    $post_class = '';
    $post_class .= 'gridmode-4-col';
    $post_class .= ' gridmode-360w-270h-grid-thumbnail gridmode-small-height-grid-thumbnail';

    if ( is_sticky($post->ID) ) {
        $post_class .= ' gridmode-grid-sticky-post';
    }

    return apply_filters( 'gridmode_grid_post_class', $post_class );
}


/**
* Register widget area.
*
* @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
*/

function gridmode_widgets_init() {

register_sidebar(array(
    'id' => 'gridmode-sidebar-one',
    'name' => esc_html__( 'Sidebar 1 Widgets', 'gridmode' ),
    'description' => esc_html__( 'This widget area is located on the left-hand side of your web page.', 'gridmode' ),
    'before_widget' => '<div id="%1$s" class="gridmode-side-widget widget gridmode-widget-box %2$s"><div class="gridmode-widget-box-inside">',
    'after_widget' => '</div></div>',
    'before_title' => '<div class="gridmode-widget-header"><h2 class="gridmode-widget-title"><span class="gridmode-widget-title-inside">',
    'after_title' => '</span></h2></div>'));

register_sidebar(array(
    'id' => 'gridmode-home-fullwidth-widgets',
    'name' => esc_html__( 'Top Full Width Widgets (Default HomePage)', 'gridmode' ),
    'description' => esc_html__( 'This full-width widget area is located after the header of your website. Widgets of this widget area are displayed on the default homepage of your website (when you are showing your latest posts on homepage).', 'gridmode' ),
    'before_widget' => '<div id="%1$s" class="gridmode-main-widget widget gridmode-widget-box %2$s"><div class="gridmode-widget-box-inside">',
    'after_widget' => '</div></div>',
    'before_title' => '<div class="gridmode-widget-header"><h2 class="gridmode-widget-title"><span class="gridmode-widget-title-inside">',
    'after_title' => '</span></h2></div>'));

register_sidebar(array(
    'id' => 'gridmode-fullwidth-widgets',
    'name' => esc_html__( 'Top Full Width Widgets (Everywhere)', 'gridmode' ),
    'description' => esc_html__( 'This full-width widget area is located after the header of your website. Widgets of this widget area are displayed on every page of your website.', 'gridmode' ),
    'before_widget' => '<div id="%1$s" class="gridmode-main-widget widget gridmode-widget-box %2$s"><div class="gridmode-widget-box-inside">',
    'after_widget' => '</div></div>',
    'before_title' => '<div class="gridmode-widget-header"><h2 class="gridmode-widget-title"><span class="gridmode-widget-title-inside">',
    'after_title' => '</span></h2></div>'));

register_sidebar(array(
    'id' => 'gridmode-home-top-widgets',
    'name' => esc_html__( 'Above Content Widgets (Default HomePage)', 'gridmode' ),
    'description' => esc_html__( 'This widget area is located at the top of the main content (above posts) of your website. Widgets of this widget area are displayed on the default homepage of your website (when you are showing your latest posts on homepage).', 'gridmode' ),
    'before_widget' => '<div id="%1$s" class="gridmode-main-widget widget gridmode-widget-box %2$s"><div class="gridmode-widget-box-inside">',
    'after_widget' => '</div></div>',
    'before_title' => '<div class="gridmode-widget-header"><h2 class="gridmode-widget-title"><span class="gridmode-widget-title-inside">',
    'after_title' => '</span></h2></div>'));

register_sidebar(array(
    'id' => 'gridmode-top-widgets',
    'name' => esc_html__( 'Above Content Widgets (Everywhere)', 'gridmode' ),
    'description' => esc_html__( 'This widget area is located at the top of the main content (above posts) of your website. Widgets of this widget area are displayed on every page of your website.', 'gridmode' ),
    'before_widget' => '<div id="%1$s" class="gridmode-main-widget widget gridmode-widget-box %2$s"><div class="gridmode-widget-box-inside">',
    'after_widget' => '</div></div>',
    'before_title' => '<div class="gridmode-widget-header"><h2 class="gridmode-widget-title"><span class="gridmode-widget-title-inside">',
    'after_title' => '</span></h2></div>'));

register_sidebar(array(
    'id' => 'gridmode-home-left-top-widgets',
    'name' => esc_html__( 'Top Left Widgets (Default HomePage)', 'gridmode' ),
    'description' => esc_html__( 'This widget area is located at the left top of your website. Widgets of this widget area are displayed on the default homepage of your website (when you are showing your latest posts on homepage).', 'gridmode' ),
    'before_widget' => '<div id="%1$s" class="gridmode-main-widget widget gridmode-widget-box %2$s"><div class="gridmode-widget-box-inside">',
    'after_widget' => '</div></div>',
    'before_title' => '<div class="gridmode-widget-header"><div class="gridmode-widget-header-inside"><h2 class="gridmode-widget-title"><span class="gridmode-widget-title-inside">',
    'after_title' => '</span></h2></div></div>'));

register_sidebar(array(
    'id' => 'gridmode-left-top-widgets',
    'name' => esc_html__( 'Top Left Widgets (Everywhere)', 'gridmode' ),
    'description' => esc_html__( 'This widget area is located at the left top of your website. Widgets of this widget area are displayed on every page of your website.', 'gridmode' ),
    'before_widget' => '<div id="%1$s" class="gridmode-main-widget widget gridmode-widget-box %2$s"><div class="gridmode-widget-box-inside">',
    'after_widget' => '</div></div>',
    'before_title' => '<div class="gridmode-widget-header"><div class="gridmode-widget-header-inside"><h2 class="gridmode-widget-title"><span class="gridmode-widget-title-inside">',
    'after_title' => '</span></h2></div></div>'));

register_sidebar(array(
    'id' => 'gridmode-home-right-top-widgets',
    'name' => esc_html__( 'Top Right Widgets (Default HomePage)', 'gridmode' ),
    'description' => esc_html__( 'This widget area is located at the right top of your website. Widgets of this widget area are displayed on the default homepage of your website (when you are showing your latest posts on homepage).', 'gridmode' ),
    'before_widget' => '<div id="%1$s" class="gridmode-main-widget widget gridmode-widget-box %2$s"><div class="gridmode-widget-box-inside">',
    'after_widget' => '</div></div>',
    'before_title' => '<div class="gridmode-widget-header"><div class="gridmode-widget-header-inside"><h2 class="gridmode-widget-title"><span class="gridmode-widget-title-inside">',
    'after_title' => '</span></h2></div></div>'));

register_sidebar(array(
    'id' => 'gridmode-right-top-widgets',
    'name' => esc_html__( 'Top Right Widgets (Everywhere)', 'gridmode' ),
    'description' => esc_html__( 'This widget area is located at the right top of your website. Widgets of this widget area are displayed on every page of your website.', 'gridmode' ),
    'before_widget' => '<div id="%1$s" class="gridmode-main-widget widget gridmode-widget-box %2$s"><div class="gridmode-widget-box-inside">',
    'after_widget' => '</div></div>',
    'before_title' => '<div class="gridmode-widget-header"><div class="gridmode-widget-header-inside"><h2 class="gridmode-widget-title"><span class="gridmode-widget-title-inside">',
    'after_title' => '</span></h2></div></div>'));

register_sidebar(array(
    'id' => 'gridmode-home-bottom-widgets',
    'name' => esc_html__( 'Below Content Widgets (Default HomePage)', 'gridmode' ),
    'description' => esc_html__( 'This widget area is located at the bottom of the main content (below posts) of your website. Widgets of this widget area are displayed on the default homepage of your website (when you are showing your latest posts on homepage).', 'gridmode' ),
    'before_widget' => '<div id="%1$s" class="gridmode-main-widget widget gridmode-widget-box %2$s"><div class="gridmode-widget-box-inside">',
    'after_widget' => '</div></div>',
    'before_title' => '<div class="gridmode-widget-header"><h2 class="gridmode-widget-title"><span class="gridmode-widget-title-inside">',
    'after_title' => '</span></h2></div>'));

register_sidebar(array(
    'id' => 'gridmode-bottom-widgets',
    'name' => esc_html__( 'Below Content Widgets (Everywhere)', 'gridmode' ),
    'description' => esc_html__( 'This widget area is located at the bottom of the main content (below posts) of your website. Widgets of this widget area are displayed on every page of your website.', 'gridmode' ),
    'before_widget' => '<div id="%1$s" class="gridmode-main-widget widget gridmode-widget-box %2$s"><div class="gridmode-widget-box-inside">',
    'after_widget' => '</div></div>',
    'before_title' => '<div class="gridmode-widget-header"><h2 class="gridmode-widget-title"><span class="gridmode-widget-title-inside">',
    'after_title' => '</span></h2></div>'));

register_sidebar(array(
    'id' => 'gridmode-home-fullwidth-bottom-widgets',
    'name' => esc_html__( 'Bottom Full Width Widgets (Default HomePage)', 'gridmode' ),
    'description' => esc_html__( 'This full-width widget area is located before the footer of your website. Widgets of this widget area are displayed on the default homepage of your website (when you are showing your latest posts on homepage).', 'gridmode' ),
    'before_widget' => '<div id="%1$s" class="gridmode-main-widget widget gridmode-widget-box %2$s"><div class="gridmode-widget-box-inside">',
    'after_widget' => '</div></div>',
    'before_title' => '<div class="gridmode-widget-header"><h2 class="gridmode-widget-title"><span class="gridmode-widget-title-inside">',
    'after_title' => '</span></h2></div>'));

register_sidebar(array(
    'id' => 'gridmode-fullwidth-bottom-widgets',
    'name' => esc_html__( 'Bottom Full Width Widgets (Everywhere)', 'gridmode' ),
    'description' => esc_html__( 'This full-width widget area is located before the footer of your website. Widgets of this widget area are displayed on every page of your website.', 'gridmode' ),
    'before_widget' => '<div id="%1$s" class="gridmode-main-widget widget gridmode-widget-box %2$s"><div class="gridmode-widget-box-inside">',
    'after_widget' => '</div></div>',
    'before_title' => '<div class="gridmode-widget-header"><h2 class="gridmode-widget-title"><span class="gridmode-widget-title-inside">',
    'after_title' => '</span></h2></div>'));

register_sidebar(array(
    'id' => 'gridmode-single-post-bottom-widgets',
    'name' => esc_html__( 'Single Post Bottom Widgets', 'gridmode' ),
    'description' => esc_html__( 'This widget area is located at the bottom of single post of any post type (except attachments and pages).', 'gridmode' ),
    'before_widget' => '<div id="%1$s" class="gridmode-main-widget widget gridmode-widget-box %2$s"><div class="gridmode-widget-box-inside">',
    'after_widget' => '</div></div>',
    'before_title' => '<div class="gridmode-widget-header"><h2 class="gridmode-widget-title"><span class="gridmode-widget-title-inside">',
    'after_title' => '</span></h2></div>'));

register_sidebar(array(
    'id' => 'gridmode-top-footer',
    'name' => esc_html__( 'Footer Top Widgets', 'gridmode' ),
    'description' => esc_html__( 'This widget area is located on the top of the footer of your website.', 'gridmode' ),
    'before_widget' => '<div id="%1$s" class="gridmode-footer-widget widget %2$s">',
    'after_widget' => '</div>',
    'before_title' => '<h2 class="gridmode-widget-title"><span class="gridmode-widget-title-inside">',
    'after_title' => '</span></h2>'));

register_sidebar(array(
    'id' => 'gridmode-footer-1',
    'name' => esc_html__( 'Footer 1 Widgets', 'gridmode' ),
    'description' => esc_html__( 'This widget area is the column 1 of the footer of your website.', 'gridmode' ),
    'before_widget' => '<div id="%1$s" class="gridmode-footer-widget widget %2$s">',
    'after_widget' => '</div>',
    'before_title' => '<h2 class="gridmode-widget-title"><span class="gridmode-widget-title-inside">',
    'after_title' => '</span></h2>'));

register_sidebar(array(
    'id' => 'gridmode-footer-2',
    'name' => esc_html__( 'Footer 2 Widgets', 'gridmode' ),
    'description' => esc_html__( 'This widget area is the column 2 of the footer of your website.', 'gridmode' ),
    'before_widget' => '<div id="%1$s" class="gridmode-footer-widget widget %2$s">',
    'after_widget' => '</div>',
    'before_title' => '<h2 class="gridmode-widget-title"><span class="gridmode-widget-title-inside">',
    'after_title' => '</span></h2>'));

register_sidebar(array(
    'id' => 'gridmode-footer-3',
    'name' => esc_html__( 'Footer 3 Widgets', 'gridmode' ),
    'description' => esc_html__( 'This widget area is the column 3 of the footer of your website.', 'gridmode' ),
    'before_widget' => '<div id="%1$s" class="gridmode-footer-widget widget %2$s">',
    'after_widget' => '</div>',
    'before_title' => '<h2 class="gridmode-widget-title"><span class="gridmode-widget-title-inside">',
    'after_title' => '</span></h2>'));

register_sidebar(array(
    'id' => 'gridmode-footer-4',
    'name' => esc_html__( 'Footer 4 Widgets', 'gridmode' ),
    'description' => esc_html__( 'This widget area is the column 4 of the footer of your website.', 'gridmode' ),
    'before_widget' => '<div id="%1$s" class="gridmode-footer-widget widget %2$s">',
    'after_widget' => '</div>',
    'before_title' => '<h2 class="gridmode-widget-title"><span class="gridmode-widget-title-inside">',
    'after_title' => '</span></h2>'));

register_sidebar(array(
    'id' => 'gridmode-bottom-footer',
    'name' => esc_html__( 'Footer Bottom Widgets', 'gridmode' ),
    'description' => esc_html__( 'This widget area is located on the bottom of the footer of your website.', 'gridmode' ),
    'before_widget' => '<div id="%1$s" class="gridmode-footer-widget widget %2$s">',
    'after_widget' => '</div>',
    'before_title' => '<h2 class="gridmode-widget-title"><span class="gridmode-widget-title-inside">',
    'after_title' => '</span></h2>'));

register_sidebar(array(
    'id' => 'gridmode-404-widgets',
    'name' => esc_html__( '404 Page Widgets', 'gridmode' ),
    'description' => esc_html__( 'This widget area is located on the 404(not found) page of your website.', 'gridmode' ),
    'before_widget' => '<div id="%1$s" class="gridmode-main-widget widget gridmode-widget-box %2$s"><div class="gridmode-widget-box-inside">',
    'after_widget' => '</div></div>',
    'before_title' => '<div class="gridmode-widget-header"><h2 class="gridmode-widget-title"><span class="gridmode-widget-title-inside">',
    'after_title' => '</span></h2></div>'));

}
add_action( 'widgets_init', 'gridmode_widgets_init' );

function gridmode_sidebar_one_widgets() {
    dynamic_sidebar( 'gridmode-sidebar-one' );
}

function gridmode_top_wide_widgets() { ?>
<?php if ( is_active_sidebar( 'gridmode-home-fullwidth-widgets' ) || is_active_sidebar( 'gridmode-fullwidth-widgets' ) ) : ?>
<div class="gridmode-outer-wrapper">
<div class="gridmode-top-wrapper-outer gridmode-clearfix">
<div class="gridmode-featured-posts-area gridmode-top-wrapper gridmode-clearfix">
<?php if ( is_front_page() && is_home() && !is_paged() ) { ?>
<?php dynamic_sidebar( 'gridmode-home-fullwidth-widgets' ); ?>
<?php } ?>

<?php dynamic_sidebar( 'gridmode-fullwidth-widgets' ); ?>
</div>
</div>
</div>
<?php endif; ?>
<?php }

function gridmode_bottom_wide_widgets() { ?>
<?php if ( is_active_sidebar( 'gridmode-home-fullwidth-bottom-widgets' ) || is_active_sidebar( 'gridmode-fullwidth-bottom-widgets' ) ) : ?>
<div class="gridmode-outer-wrapper">
<div class="gridmode-bottom-wrapper-outer gridmode-clearfix">
<div class="gridmode-featured-posts-area gridmode-bottom-wrapper gridmode-clearfix">
<?php if ( is_front_page() && is_home() && !is_paged() ) { ?>
<?php dynamic_sidebar( 'gridmode-home-fullwidth-bottom-widgets' ); ?>
<?php } ?>

<?php dynamic_sidebar( 'gridmode-fullwidth-bottom-widgets' ); ?>
</div>
</div>
</div>
<?php endif; ?>
<?php }

function gridmode_top_widgets() { ?>
<?php if ( is_active_sidebar( 'gridmode-home-top-widgets' ) || is_active_sidebar( 'gridmode-top-widgets' ) ) : ?>
<div class="gridmode-featured-posts-area gridmode-featured-posts-area-top gridmode-clearfix">
<?php if ( is_front_page() && is_home() && !is_paged() ) { ?>
<?php dynamic_sidebar( 'gridmode-home-top-widgets' ); ?>
<?php } ?>

<?php dynamic_sidebar( 'gridmode-top-widgets' ); ?>
</div>
<?php endif; ?>
<?php }

function gridmode_top_left_right_widgets() { ?>
<div class="gridmode-left-right-wrapper gridmode-clearfix">
<?php if ( is_active_sidebar( 'gridmode-home-left-top-widgets' ) || is_active_sidebar( 'gridmode-left-top-widgets' ) ) : ?>
<div class="gridmode-left-top-wrapper">
<div class="gridmode-featured-posts-area gridmode-featured-posts-area-top gridmode-clearfix">
<?php if ( is_front_page() && is_home() && !is_paged() ) { ?>
<?php dynamic_sidebar( 'gridmode-home-left-top-widgets' ); ?>
<?php } ?>

<?php dynamic_sidebar( 'gridmode-left-top-widgets' ); ?>
</div>
</div>
<?php endif; ?>

<?php if ( is_active_sidebar( 'gridmode-home-right-top-widgets' ) || is_active_sidebar( 'gridmode-right-top-widgets' ) ) : ?>
<div class="gridmode-right-top-wrapper">
<div class="gridmode-featured-posts-area gridmode-featured-posts-area-top gridmode-clearfix">
<?php if ( is_front_page() && is_home() && !is_paged() ) { ?>
<?php dynamic_sidebar( 'gridmode-home-right-top-widgets' ); ?>
<?php } ?>

<?php dynamic_sidebar( 'gridmode-right-top-widgets' ); ?>
</div>
</div>
<?php endif; ?>
</div>
<?php }

function gridmode_bottom_widgets() { ?>
<?php if ( is_active_sidebar( 'gridmode-home-bottom-widgets' ) || is_active_sidebar( 'gridmode-bottom-widgets' ) ) : ?>
<div class='gridmode-featured-posts-area gridmode-featured-posts-area-bottom gridmode-clearfix'>
<?php if ( is_front_page() && is_home() && !is_paged() ) { ?>
<?php dynamic_sidebar( 'gridmode-home-bottom-widgets' ); ?>
<?php } ?>

<?php dynamic_sidebar( 'gridmode-bottom-widgets' ); ?>
</div>
<?php endif; ?>
<?php }

function gridmode_404_widgets() { ?>
<?php if ( is_active_sidebar( 'gridmode-404-widgets' ) ) : ?>
<div class="gridmode-featured-posts-area gridmode-featured-posts-area-top gridmode-clearfix">
<?php dynamic_sidebar( 'gridmode-404-widgets' ); ?>
</div>
<?php endif; ?>
<?php }

function gridmode_post_bottom_widgets() {
    if ( is_singular() ) {
        global $post;
        if ( is_active_sidebar( 'gridmode-single-post-bottom-widgets' ) ) : ?>
            <div class="gridmode-featured-posts-area gridmode-clearfix">
            <?php dynamic_sidebar( 'gridmode-single-post-bottom-widgets' ); ?>
            </div>
        <?php endif;
    }
}


/**
* Post share buttons
*/

function gridmode_share_text() {
    $sharetext = esc_html__( 'Share:', 'gridmode' );
    if ( gridmode_get_option('hide_share_text') ) {return;}
    if ( gridmode_get_option('share_text') ) {
        $sharetext = gridmode_get_option('share_text');
    }
    return apply_filters( 'gridmode_share_text', $sharetext );
}

function gridmode_social_sharing_buttons() {
        global $post;

        // Get current page URL 
        $posturl = rawurlencode(get_permalink($post->ID));

        // Get current page title
        $posttitle = rawurlencode(the_title_attribute('echo=0'));

        // Construct sharing URL without using any script
        $twitter_url = 'https://twitter.com/intent/tweet?text='.$posttitle.'&amp;url='.$posturl;
        $facebook_url = 'https://www.facebook.com/sharer.php?u='.$posturl;
        $linkedin_url = 'https://www.linkedin.com/shareArticle?mini=true&amp;title='.$posttitle.'&amp;url='.$posturl;

        $postthumb = '';
        $postthumb_attributes = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full', false );
        $postthumb = isset($postthumb_attributes[0]) ? $postthumb_attributes[0] : '';

        if(!empty($postthumb)) {
            $pinterest_url = 'https://pinterest.com/pin/create/button/?url='.$posturl.'&amp;media='.$postthumb.'&amp;description='.$posttitle;
        }

        // Add sharing button at the end of page/page content
        $socialcontent = '<div class="gridmode-share-buttons gridmode-clearfix"><span class="gridmode-share-text">'.esc_html(gridmode_share_text()).' </span>';
        if ( !(gridmode_get_option('hide_share_twitter')) ) {
            $socialcontent .= '<a class="gridmode-share-buttons-twitter" href="'.esc_url($twitter_url).'" target="_blank" rel="nofollow" title="'.esc_attr__('Tweet This!', 'gridmode').'"><i class="fab fa-twitter" aria-hidden="true"></i>'.esc_html__('Twitter', 'gridmode').'</a>';
        }
        if ( !(gridmode_get_option('hide_share_facebook')) ) {
            $socialcontent .= '<a class="gridmode-share-buttons-facebook" href="'.esc_url($facebook_url).'" target="_blank" rel="nofollow" title="'.esc_attr__('Share this on Facebook', 'gridmode').'"><i class="fab fa-facebook-f" aria-hidden="true"></i>'.esc_html__('Facebook', 'gridmode').'</a>';
        }
        if ( !(gridmode_get_option('hide_share_pinterest')) && !(empty($postthumb)) ) {
            $socialcontent .= '<a class="gridmode-share-buttons-pinterest" href="'.esc_url($pinterest_url).'" target="_blank" rel="nofollow" title="'.esc_attr__('Share this on Pinterest', 'gridmode').'"><i class="fab fa-pinterest" aria-hidden="true"></i>'.esc_html__('Pinterest', 'gridmode').'</a>';
        }
        if ( !(gridmode_get_option('hide_share_linkedin')) ) {
            $socialcontent .= '<a class="gridmode-share-buttons-linkedin" href="'.esc_url($linkedin_url).'" target="_blank" rel="nofollow" title="'.esc_attr__('Share this on Linkedin', 'gridmode').'"><i class="fab fa-linkedin-in" aria-hidden="true"></i>'.esc_html__('Linkedin', 'gridmode').'</a>';
        }
        $socialcontent .= '</div>';

        return apply_filters( 'gridmode_social_sharing_buttons', $socialcontent );
}

function gridmode_grid_sharing_buttons() {
        global $post;

        // Get current page URL
        $posturl = rawurlencode(get_permalink($post->ID));

        // Get current page title
        $posttitle = rawurlencode(the_title_attribute('echo=0'));

        // Construct sharing URL without using any script
        $twitter_url = 'https://twitter.com/intent/tweet?text='.$posttitle.'&amp;url='.$posturl;
        $facebook_url = 'https://www.facebook.com/sharer.php?u='.$posturl;
        $linkedin_url = 'https://www.linkedin.com/shareArticle?mini=true&amp;title='.$posttitle.'&amp;url='.$posturl;

        $postthumb = '';
        $postthumb_attributes = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full', false );
        $postthumb = isset($postthumb_attributes[0]) ? $postthumb_attributes[0] : '';

        if(!empty($postthumb)) {
            $pinterest_url = 'https://pinterest.com/pin/create/button/?url='.$posturl.'&amp;media='.$postthumb.'&amp;description='.$posttitle;
        }

        // Add sharing button at the end of page/page content
        $sharecontent = '<div class="gridmode-grid-share-buttons-wrapper"><div class="gridmode-grid-share-buttons gridmode-clearfix">';
        if ( !(gridmode_get_option('hide_share_twitter_home')) ) {
            $sharecontent .= '<a class="gridmode-grid-share-button gridmode-grid-share-button-twitter" href="'.esc_url($twitter_url).'" target="_blank" rel="nofollow" aria-label="'.esc_attr__('Tweet', 'gridmode').' : '.the_title_attribute('echo=0').'"><i class="fab fa-twitter" aria-hidden="true" title="'.esc_attr__('Tweet This!', 'gridmode').'"></i></a>';
        }
        if ( !(gridmode_get_option('hide_share_facebook_home')) ) {
            $sharecontent .= '<a class="gridmode-grid-share-button gridmode-grid-share-button-facebook" href="'.esc_url($facebook_url).'" target="_blank" rel="nofollow" aria-label="'.esc_attr__('Share on Facebook', 'gridmode').' : '.the_title_attribute('echo=0').'"><i class="fab fa-facebook-f" aria-hidden="true" title="'.esc_attr__('Share this on Facebook', 'gridmode').'"></i></a>';
        }
        if ( !(gridmode_get_option('hide_share_pinterest_home')) && !(empty($postthumb)) ) {
            $sharecontent .= '<a class="gridmode-grid-share-button gridmode-grid-share-button-pinterest" href="'.esc_url($pinterest_url).'" target="_blank" rel="nofollow" aria-label="'.esc_attr__('Share on Pinterest', 'gridmode').': '.the_title_attribute('echo=0').'"><i class="fab fa-pinterest" aria-hidden="true" title="'.esc_attr__('Share this on Pinterest', 'gridmode').'"></i></a>';
        }
        if ( !(gridmode_get_option('hide_share_linkedin_home')) ) {
            $sharecontent .= '<a class="gridmode-grid-share-button gridmode-grid-share-button-linkedin" href="'.esc_url($linkedin_url).'" target="_blank" rel="nofollow" aria-label="'.esc_attr__('Share on Linkedin', 'gridmode').' : '.the_title_attribute('echo=0').'"><i class="fab fa-linkedin-in" aria-hidden="true" title="'.esc_attr__('Share this on Linkedin', 'gridmode').'"></i></a>';
        }
        $sharecontent .= '</div></div>';

        return apply_filters( 'gridmode_grid_sharing_buttons', $sharecontent );
}


/**
* Social buttons
*/

function gridmode_social_buttons() { ?>
<div class='gridmode-social-icons'>
    <?php if ( gridmode_get_option('twitterlink') ) : ?>
            <a href="<?php echo esc_url( gridmode_get_option('twitterlink') ); ?>" target="_blank" rel="nofollow" class="gridmode-header-social-icon-twitter" aria-label="<?php esc_attr_e('Twitter Button','gridmode'); ?>"><i class="fab fa-twitter" aria-hidden="true" title="<?php esc_attr_e('Twitter','gridmode'); ?>"></i></a><?php endif; ?>
    <?php if ( gridmode_get_option('facebooklink') ) : ?>
            <a href="<?php echo esc_url( gridmode_get_option('facebooklink') ); ?>" target="_blank" rel="nofollow" class="gridmode-header-social-icon-facebook" aria-label="<?php esc_attr_e('Facebook Button','gridmode'); ?>"><i class="fab fa-facebook-f" aria-hidden="true" title="<?php esc_attr_e('Facebook','gridmode'); ?>"></i></a><?php endif; ?>
    <?php if ( gridmode_get_option('googlelink') ) : ?>
            <a href="<?php echo esc_url( gridmode_get_option('googlelink') ); ?>" target="_blank" rel="nofollow" class="gridmode-header-social-icon-google-plus" aria-label="<?php esc_attr_e('Google Plus Button','gridmode'); ?>"><i class="fab fa-google-plus-g" aria-hidden="true" title="<?php esc_attr_e('Google Plus','gridmode'); ?>"></i></a><?php endif; ?>
    <?php if ( gridmode_get_option('pinterestlink') ) : ?>
            <a href="<?php echo esc_url( gridmode_get_option('pinterestlink') ); ?>" target="_blank" rel="nofollow" class="gridmode-header-social-icon-pinterest" aria-label="<?php esc_attr_e('Pinterest Button','gridmode'); ?>"><i class="fab fa-pinterest" aria-hidden="true" title="<?php esc_attr_e('Pinterest','gridmode'); ?>"></i></a><?php endif; ?>
    <?php if ( gridmode_get_option('linkedinlink') ) : ?>
            <a href="<?php echo esc_url( gridmode_get_option('linkedinlink') ); ?>" target="_blank" rel="nofollow" class="gridmode-header-social-icon-linkedin" aria-label="<?php esc_attr_e('Linkedin Button','gridmode'); ?>"><i class="fab fa-linkedin-in" aria-hidden="true" title="<?php esc_attr_e('Linkedin','gridmode'); ?>"></i></a><?php endif; ?>
    <?php if ( gridmode_get_option('instagramlink') ) : ?>
            <a href="<?php echo esc_url( gridmode_get_option('instagramlink') ); ?>" target="_blank" rel="nofollow" class="gridmode-header-social-icon-instagram" aria-label="<?php esc_attr_e('Instagram Button','gridmode'); ?>"><i class="fab fa-instagram" aria-hidden="true" title="<?php esc_attr_e('Instagram','gridmode'); ?>"></i></a><?php endif; ?>
    <?php if ( gridmode_get_option('flickrlink') ) : ?>
            <a href="<?php echo esc_url( gridmode_get_option('flickrlink') ); ?>" target="_blank" rel="nofollow" class="gridmode-header-social-icon-flickr" aria-label="<?php esc_attr_e('Flickr Button','gridmode'); ?>"><i class="fab fa-flickr" aria-hidden="true" title="<?php esc_attr_e('Flickr','gridmode'); ?>"></i></a><?php endif; ?>
    <?php if ( gridmode_get_option('youtubelink') ) : ?>
            <a href="<?php echo esc_url( gridmode_get_option('youtubelink') ); ?>" target="_blank" rel="nofollow" class="gridmode-header-social-icon-youtube" aria-label="<?php esc_attr_e('Youtube Button','gridmode'); ?>"><i class="fab fa-youtube" aria-hidden="true" title="<?php esc_attr_e('Youtube','gridmode'); ?>"></i></a><?php endif; ?>
    <?php if ( gridmode_get_option('vimeolink') ) : ?>
            <a href="<?php echo esc_url( gridmode_get_option('vimeolink') ); ?>" target="_blank" rel="nofollow" class="gridmode-header-social-icon-vimeo" aria-label="<?php esc_attr_e('Vimeo Button','gridmode'); ?>"><i class="fab fa-vimeo-v" aria-hidden="true" title="<?php esc_attr_e('Vimeo','gridmode'); ?>"></i></a><?php endif; ?>
    <?php if ( gridmode_get_option('soundcloudlink') ) : ?>
            <a href="<?php echo esc_url( gridmode_get_option('soundcloudlink') ); ?>" target="_blank" rel="nofollow" class="gridmode-header-social-icon-soundcloud" aria-label="<?php esc_attr_e('SoundCloud Button','gridmode'); ?>"><i class="fab fa-soundcloud" aria-hidden="true" title="<?php esc_attr_e('SoundCloud','gridmode'); ?>"></i></a><?php endif; ?>
    <?php if ( gridmode_get_option('messengerlink') ) : ?>
            <a href="<?php echo esc_url( gridmode_get_option('messengerlink') ); ?>" target="_blank" rel="nofollow" class="gridmode-header-social-icon-messenger" aria-label="<?php esc_attr_e('Messenger Button','gridmode'); ?>"><i class="fab fa-facebook-messenger" aria-hidden="true" title="<?php esc_attr_e('Messenger','gridmode'); ?>"></i></a><?php endif; ?>
    <?php if ( gridmode_get_option('whatsapplink') ) : ?>
            <a href="<?php echo esc_url( gridmode_get_option('whatsapplink') ); ?>" target="_blank" rel="nofollow" class="gridmode-header-social-icon-whatsapp" aria-label="<?php esc_attr_e('WhatsApp Button','gridmode'); ?>"><i class="fab fa-whatsapp" aria-hidden="true" title="<?php esc_attr_e('WhatsApp','gridmode'); ?>"></i></a><?php endif; ?>
    <?php if ( gridmode_get_option('tiktoklink') ) : ?>
            <a href="<?php echo esc_url( gridmode_get_option('tiktoklink') ); ?>" target="_blank" rel="nofollow" class="gridmode-header-social-icon-tiktok" aria-label="<?php esc_attr_e('TikTok Button','gridmode'); ?>"><i class="fab fa-tiktok" aria-hidden="true" title="<?php esc_attr_e('TikTok','gridmode'); ?>"></i></a><?php endif; ?>
    <?php if ( gridmode_get_option('lastfmlink') ) : ?>
            <a href="<?php echo esc_url( gridmode_get_option('lastfmlink') ); ?>" target="_blank" rel="nofollow" class="gridmode-header-social-icon-lastfm" aria-label="<?php esc_attr_e('Lastfm Button','gridmode'); ?>"><i class="fab fa-lastfm" aria-hidden="true" title="<?php esc_attr_e('Lastfm','gridmode'); ?>"></i></a><?php endif; ?>
    <?php if ( gridmode_get_option('mediumlink') ) : ?>
            <a href="<?php echo esc_url( gridmode_get_option('mediumlink') ); ?>" target="_blank" rel="nofollow" class="gridmode-header-social-icon-medium" aria-label="<?php esc_attr_e('Medium Button','gridmode'); ?>"><i class="fab fa-medium-m" aria-hidden="true" title="<?php esc_attr_e('Medium','gridmode'); ?>"></i></a><?php endif; ?>
    <?php if ( gridmode_get_option('githublink') ) : ?>
            <a href="<?php echo esc_url( gridmode_get_option('githublink') ); ?>" target="_blank" rel="nofollow" class="gridmode-header-social-icon-github" aria-label="<?php esc_attr_e('Github Button','gridmode'); ?>"><i class="fab fa-github" aria-hidden="true" title="<?php esc_attr_e('Github','gridmode'); ?>"></i></a><?php endif; ?>
    <?php if ( gridmode_get_option('bitbucketlink') ) : ?>
            <a href="<?php echo esc_url( gridmode_get_option('bitbucketlink') ); ?>" target="_blank" rel="nofollow" class="gridmode-header-social-icon-bitbucket" aria-label="<?php esc_attr_e('Bitbucket Button','gridmode'); ?>"><i class="fab fa-bitbucket" aria-hidden="true" title="<?php esc_attr_e('Bitbucket','gridmode'); ?>"></i></a><?php endif; ?>
    <?php if ( gridmode_get_option('tumblrlink') ) : ?>
            <a href="<?php echo esc_url( gridmode_get_option('tumblrlink') ); ?>" target="_blank" rel="nofollow" class="gridmode-header-social-icon-tumblr" aria-label="<?php esc_attr_e('Tumblr Button','gridmode'); ?>"><i class="fab fa-tumblr" aria-hidden="true" title="<?php esc_attr_e('Tumblr','gridmode'); ?>"></i></a><?php endif; ?>
    <?php if ( gridmode_get_option('digglink') ) : ?>
            <a href="<?php echo esc_url( gridmode_get_option('digglink') ); ?>" target="_blank" rel="nofollow" class="gridmode-header-social-icon-digg" aria-label="<?php esc_attr_e('Digg Button','gridmode'); ?>"><i class="fab fa-digg" aria-hidden="true" title="<?php esc_attr_e('Digg','gridmode'); ?>"></i></a><?php endif; ?>
    <?php if ( gridmode_get_option('deliciouslink') ) : ?>
            <a href="<?php echo esc_url( gridmode_get_option('deliciouslink') ); ?>" target="_blank" rel="nofollow" class="gridmode-header-social-icon-delicious" aria-label="<?php esc_attr_e('Delicious Button','gridmode'); ?>"><i class="fab fa-delicious" aria-hidden="true" title="<?php esc_attr_e('Delicious','gridmode'); ?>"></i></a><?php endif; ?>
    <?php if ( gridmode_get_option('stumblelink') ) : ?>
            <a href="<?php echo esc_url( gridmode_get_option('stumblelink') ); ?>" target="_blank" rel="nofollow" class="gridmode-header-social-icon-stumbleupon" aria-label="<?php esc_attr_e('Stumbleupon Button','gridmode'); ?>"><i class="fab fa-stumbleupon" aria-hidden="true" title="<?php esc_attr_e('Stumbleupon','gridmode'); ?>"></i></a><?php endif; ?>
    <?php if ( gridmode_get_option('mixlink') ) : ?>
            <a href="<?php echo esc_url( gridmode_get_option('mixlink') ); ?>" target="_blank" rel="nofollow" class="gridmode-header-social-icon-mix" aria-label="<?php esc_attr_e('Mix Button','gridmode'); ?>"><i class="fab fa-mix" aria-hidden="true" title="<?php esc_attr_e('Mix','gridmode'); ?>"></i></a><?php endif; ?>
    <?php if ( gridmode_get_option('redditlink') ) : ?>
            <a href="<?php echo esc_url( gridmode_get_option('redditlink') ); ?>" target="_blank" rel="nofollow" class="gridmode-header-social-icon-reddit" aria-label="<?php esc_attr_e('Reddit Button','gridmode'); ?>"><i class="fab fa-reddit" aria-hidden="true" title="<?php esc_attr_e('Reddit','gridmode'); ?>"></i></a><?php endif; ?>
    <?php if ( gridmode_get_option('dribbblelink') ) : ?>
            <a href="<?php echo esc_url( gridmode_get_option('dribbblelink') ); ?>" target="_blank" rel="nofollow" class="gridmode-header-social-icon-dribbble" aria-label="<?php esc_attr_e('Dribbble Button','gridmode'); ?>"><i class="fab fa-dribbble" aria-hidden="true" title="<?php esc_attr_e('Dribbble','gridmode'); ?>"></i></a><?php endif; ?>
    <?php if ( gridmode_get_option('flipboardlink') ) : ?>
            <a href="<?php echo esc_url( gridmode_get_option('flipboardlink') ); ?>" target="_blank" rel="nofollow" class="gridmode-header-social-icon-flipboard" aria-label="<?php esc_attr_e('Flipboard Button','gridmode'); ?>"><i class="fab fa-flipboard" aria-hidden="true" title="<?php esc_attr_e('Flipboard','gridmode'); ?>"></i></a><?php endif; ?>
    <?php if ( gridmode_get_option('bloggerlink') ) : ?>
            <a href="<?php echo esc_url( gridmode_get_option('bloggerlink') ); ?>" target="_blank" rel="nofollow" class="gridmode-header-social-icon-blogger" aria-label="<?php esc_attr_e('Blogger Button','gridmode'); ?>"><i class="fab fa-blogger" aria-hidden="true" title="<?php esc_attr_e('Blogger','gridmode'); ?>"></i></a><?php endif; ?>
    <?php if ( gridmode_get_option('etsylink') ) : ?>
            <a href="<?php echo esc_url( gridmode_get_option('etsylink') ); ?>" target="_blank" rel="nofollow" class="gridmode-header-social-icon-etsy" aria-label="<?php esc_attr_e('Etsy Button','gridmode'); ?>"><i class="fab fa-etsy" aria-hidden="true" title="<?php esc_attr_e('Etsy','gridmode'); ?>"></i></a><?php endif; ?>
    <?php if ( gridmode_get_option('behancelink') ) : ?>
            <a href="<?php echo esc_url( gridmode_get_option('behancelink') ); ?>" target="_blank" rel="nofollow" class="gridmode-header-social-icon-behance" aria-label="<?php esc_attr_e('Behance Button','gridmode'); ?>"><i class="fab fa-behance" aria-hidden="true" title="<?php esc_attr_e('Behance','gridmode'); ?>"></i></a><?php endif; ?>
    <?php if ( gridmode_get_option('amazonlink') ) : ?>
            <a href="<?php echo esc_url( gridmode_get_option('amazonlink') ); ?>" target="_blank" rel="nofollow" class="gridmode-header-social-icon-amazon" aria-label="<?php esc_attr_e('Amazon Button','gridmode'); ?>"><i class="fab fa-amazon" aria-hidden="true" title="<?php esc_attr_e('Amazon','gridmode'); ?>"></i></a><?php endif; ?>
    <?php if ( gridmode_get_option('meetuplink') ) : ?>
            <a href="<?php echo esc_url( gridmode_get_option('meetuplink') ); ?>" target="_blank" rel="nofollow" class="gridmode-header-social-icon-meetup" aria-label="<?php esc_attr_e('Meetup Button','gridmode'); ?>"><i class="fab fa-meetup" aria-hidden="true" title="<?php esc_attr_e('Meetup','gridmode'); ?>"></i></a><?php endif; ?>
    <?php if ( gridmode_get_option('mixcloudlink') ) : ?>
            <a href="<?php echo esc_url( gridmode_get_option('mixcloudlink') ); ?>" target="_blank" rel="nofollow" class="gridmode-header-social-icon-mixcloud" aria-label="<?php esc_attr_e('Mixcloud Button','gridmode'); ?>"><i class="fab fa-mixcloud" aria-hidden="true" title="<?php esc_attr_e('Mixcloud','gridmode'); ?>"></i></a><?php endif; ?>
    <?php if ( gridmode_get_option('slacklink') ) : ?>
            <a href="<?php echo esc_url( gridmode_get_option('slacklink') ); ?>" target="_blank" rel="nofollow" class="gridmode-header-social-icon-slack" aria-label="<?php esc_attr_e('Slack Button','gridmode'); ?>"><i class="fab fa-slack" aria-hidden="true" title="<?php esc_attr_e('Slack','gridmode'); ?>"></i></a><?php endif; ?>
    <?php if ( gridmode_get_option('snapchatlink') ) : ?>
            <a href="<?php echo esc_url( gridmode_get_option('snapchatlink') ); ?>" target="_blank" rel="nofollow" class="gridmode-header-social-icon-snapchat" aria-label="<?php esc_attr_e('Snapchat Button','gridmode'); ?>"><i class="fab fa-snapchat" aria-hidden="true" title="<?php esc_attr_e('Snapchat','gridmode'); ?>"></i></a><?php endif; ?>
    <?php if ( gridmode_get_option('spotifylink') ) : ?>
            <a href="<?php echo esc_url( gridmode_get_option('spotifylink') ); ?>" target="_blank" rel="nofollow" class="gridmode-header-social-icon-spotify" aria-label="<?php esc_attr_e('Spotify Button','gridmode'); ?>"><i class="fab fa-spotify" aria-hidden="true" title="<?php esc_attr_e('Spotify','gridmode'); ?>"></i></a><?php endif; ?>
    <?php if ( gridmode_get_option('yelplink') ) : ?>
            <a href="<?php echo esc_url( gridmode_get_option('yelplink') ); ?>" target="_blank" rel="nofollow" class="gridmode-header-social-icon-yelp" aria-label="<?php esc_attr_e('Yelp Button','gridmode'); ?>"><i class="fab fa-yelp" aria-hidden="true" title="<?php esc_attr_e('Yelp','gridmode'); ?>"></i></a><?php endif; ?>
    <?php if ( gridmode_get_option('wordpresslink') ) : ?>
            <a href="<?php echo esc_url( gridmode_get_option('wordpresslink') ); ?>" target="_blank" rel="nofollow" class="gridmode-header-social-icon-wordpress" aria-label="<?php esc_attr_e('WordPress Button','gridmode'); ?>"><i class="fab fa-wordpress" aria-hidden="true" title="<?php esc_attr_e('WordPress','gridmode'); ?>"></i></a><?php endif; ?>
    <?php if ( gridmode_get_option('twitchlink') ) : ?>
            <a href="<?php echo esc_url( gridmode_get_option('twitchlink') ); ?>" target="_blank" rel="nofollow" class="gridmode-header-social-icon-twitch" aria-label="<?php esc_attr_e('Twitch Button','gridmode'); ?>"><i class="fab fa-twitch" aria-hidden="true" title="<?php esc_attr_e('Twitch','gridmode'); ?>"></i></a><?php endif; ?>
    <?php if ( gridmode_get_option('telegramlink') ) : ?>
            <a href="<?php echo esc_url( gridmode_get_option('telegramlink') ); ?>" target="_blank" rel="nofollow" class="gridmode-header-social-icon-telegram" aria-label="<?php esc_attr_e('Telegram Button','gridmode'); ?>"><i class="fab fa-telegram" aria-hidden="true" title="<?php esc_attr_e('Telegram','gridmode'); ?>"></i></a><?php endif; ?>
    <?php if ( gridmode_get_option('bandcamplink') ) : ?>
            <a href="<?php echo esc_url( gridmode_get_option('bandcamplink') ); ?>" target="_blank" rel="nofollow" class="gridmode-header-social-icon-bandcamp" aria-label="<?php esc_attr_e('Bandcamp Button','gridmode'); ?>"><i class="fab fa-bandcamp" aria-hidden="true" title="<?php esc_attr_e('Bandcamp','gridmode'); ?>"></i></a><?php endif; ?>
    <?php if ( gridmode_get_option('quoralink') ) : ?>
            <a href="<?php echo esc_url( gridmode_get_option('quoralink') ); ?>" target="_blank" rel="nofollow" class="gridmode-header-social-icon-quora" aria-label="<?php esc_attr_e('Quora Button','gridmode'); ?>"><i class="fab fa-quora" aria-hidden="true" title="<?php esc_attr_e('Quora','gridmode'); ?>"></i></a><?php endif; ?>
    <?php if ( gridmode_get_option('foursquarelink') ) : ?>
            <a href="<?php echo esc_url( gridmode_get_option('foursquarelink') ); ?>" target="_blank" rel="nofollow" class="gridmode-header-social-icon-foursquare" aria-label="<?php esc_attr_e('Foursquare Button','gridmode'); ?>"><i class="fab fa-foursquare" aria-hidden="true" title="<?php esc_attr_e('Foursquare','gridmode'); ?>"></i></a><?php endif; ?>
    <?php if ( gridmode_get_option('deviantartlink') ) : ?>
            <a href="<?php echo esc_url( gridmode_get_option('deviantartlink') ); ?>" target="_blank" rel="nofollow" class="gridmode-header-social-icon-deviantart" aria-label="<?php esc_attr_e('DeviantArt Button','gridmode'); ?>"><i class="fab fa-deviantart" aria-hidden="true" title="<?php esc_attr_e('DeviantArt','gridmode'); ?>"></i></a><?php endif; ?>
    <?php if ( gridmode_get_option('imdblink') ) : ?>
            <a href="<?php echo esc_url( gridmode_get_option('imdblink') ); ?>" target="_blank" rel="nofollow" class="gridmode-header-social-icon-imdb" aria-label="<?php esc_attr_e('IMDB Button','gridmode'); ?>"><i class="fab fa-imdb" aria-hidden="true" title="<?php esc_attr_e('IMDB','gridmode'); ?>"></i></a><?php endif; ?>
    <?php if ( gridmode_get_option('vklink') ) : ?>
            <a href="<?php echo esc_url( gridmode_get_option('vklink') ); ?>" target="_blank" rel="nofollow" class="gridmode-header-social-icon-vk" aria-label="<?php esc_attr_e('VK Button','gridmode'); ?>"><i class="fab fa-vk" aria-hidden="true" title="<?php esc_attr_e('VK','gridmode'); ?>"></i></a><?php endif; ?>
    <?php if ( gridmode_get_option('codepenlink') ) : ?>
            <a href="<?php echo esc_url( gridmode_get_option('codepenlink') ); ?>" target="_blank" rel="nofollow" class="gridmode-header-social-icon-codepen" aria-label="<?php esc_attr_e('Codepen Button','gridmode'); ?>"><i class="fab fa-codepen" aria-hidden="true" title="<?php esc_attr_e('Codepen','gridmode'); ?>"></i></a><?php endif; ?>
    <?php if ( gridmode_get_option('jsfiddlelink') ) : ?>
            <a href="<?php echo esc_url( gridmode_get_option('jsfiddlelink') ); ?>" target="_blank" rel="nofollow" class="gridmode-header-social-icon-jsfiddle" aria-label="<?php esc_attr_e('JSFiddle Button','gridmode'); ?>"><i class="fab fa-jsfiddle" aria-hidden="true" title="<?php esc_attr_e('JSFiddle','gridmode'); ?>"></i></a><?php endif; ?>
    <?php if ( gridmode_get_option('stackoverflowlink') ) : ?>
            <a href="<?php echo esc_url( gridmode_get_option('stackoverflowlink') ); ?>" target="_blank" rel="nofollow" class="gridmode-header-social-icon-stackoverflow" aria-label="<?php esc_attr_e('Stack Overflow Button','gridmode'); ?>"><i class="fab fa-stack-overflow" aria-hidden="true" title="<?php esc_attr_e('Stack Overflow','gridmode'); ?>"></i></a><?php endif; ?>
    <?php if ( gridmode_get_option('stackexchangelink') ) : ?>
            <a href="<?php echo esc_url( gridmode_get_option('stackexchangelink') ); ?>" target="_blank" rel="nofollow" class="gridmode-header-social-icon-stackexchange" aria-label="<?php esc_attr_e('Stack Exchange Button','gridmode'); ?>"><i class="fab fa-stack-exchange" aria-hidden="true" title="<?php esc_attr_e('Stack Exchange','gridmode'); ?>"></i></a><?php endif; ?>
    <?php if ( gridmode_get_option('bsalink') ) : ?>
            <a href="<?php echo esc_url( gridmode_get_option('bsalink') ); ?>" target="_blank" rel="nofollow" class="gridmode-header-social-icon-buysellads" aria-label="<?php esc_attr_e('BuySellAds Button','gridmode'); ?>"><i class="fab fa-buysellads" aria-hidden="true" title="<?php esc_attr_e('BuySellAds','gridmode'); ?>"></i></a><?php endif; ?>
    <?php if ( gridmode_get_option('web500pxlink') ) : ?>
            <a href="<?php echo esc_url( gridmode_get_option('web500pxlink') ); ?>" target="_blank" rel="nofollow" class="gridmode-header-social-icon-web500px" aria-label="<?php esc_attr_e('500px Button','gridmode'); ?>"><i class="fab fa-500px" aria-hidden="true" title="<?php esc_attr_e('500px','gridmode'); ?>"></i></a><?php endif; ?>
    <?php if ( gridmode_get_option('ellolink') ) : ?>
            <a href="<?php echo esc_url( gridmode_get_option('ellolink') ); ?>" target="_blank" rel="nofollow" class="gridmode-header-social-icon-ello" aria-label="<?php esc_attr_e('Ello Button','gridmode'); ?>"><i class="fab fa-ello" aria-hidden="true" title="<?php esc_attr_e('Ello','gridmode'); ?>"></i></a><?php endif; ?>
    <?php if ( gridmode_get_option('discordlink') ) : ?>
            <a href="<?php echo esc_url( gridmode_get_option('discordlink') ); ?>" target="_blank" rel="nofollow" class="gridmode-header-social-icon-discord" aria-label="<?php esc_attr_e('Discord Button','gridmode'); ?>"><i class="fab fa-discord" aria-hidden="true" title="<?php esc_attr_e('Discord','gridmode'); ?>"></i></a><?php endif; ?>
    <?php if ( gridmode_get_option('goodreadslink') ) : ?>
            <a href="<?php echo esc_url( gridmode_get_option('goodreadslink') ); ?>" target="_blank" rel="nofollow" class="gridmode-header-social-icon-goodreads" aria-label="<?php esc_attr_e('Goodreads Button','gridmode'); ?>"><i class="fab fa-goodreads" aria-hidden="true" title="<?php esc_attr_e('Goodreads','gridmode'); ?>"></i></a><?php endif; ?>
    <?php if ( gridmode_get_option('odnoklassnikilink') ) : ?>
            <a href="<?php echo esc_url( gridmode_get_option('odnoklassnikilink') ); ?>" target="_blank" rel="nofollow" class="gridmode-header-social-icon-odnoklassniki" aria-label="<?php esc_attr_e('Odnoklassniki Button','gridmode'); ?>"><i class="fab fa-odnoklassniki" aria-hidden="true" title="<?php esc_attr_e('Odnoklassniki','gridmode'); ?>"></i></a><?php endif; ?>
    <?php if ( gridmode_get_option('houzzlink') ) : ?>
            <a href="<?php echo esc_url( gridmode_get_option('houzzlink') ); ?>" target="_blank" rel="nofollow" class="gridmode-header-social-icon-houzz" aria-label="<?php esc_attr_e('Houzz Button','gridmode'); ?>"><i class="fab fa-houzz" aria-hidden="true" title="<?php esc_attr_e('Houzz','gridmode'); ?>"></i></a><?php endif; ?>
    <?php if ( gridmode_get_option('pocketlink') ) : ?>
            <a href="<?php echo esc_url( gridmode_get_option('pocketlink') ); ?>" target="_blank" rel="nofollow" class="gridmode-header-social-icon-pocket" aria-label="<?php esc_attr_e('Pocket Button','gridmode'); ?>"><i class="fab fa-get-pocket" aria-hidden="true" title="<?php esc_attr_e('Pocket','gridmode'); ?>"></i></a><?php endif; ?>
    <?php if ( gridmode_get_option('xinglink') ) : ?>
            <a href="<?php echo esc_url( gridmode_get_option('xinglink') ); ?>" target="_blank" rel="nofollow" class="gridmode-header-social-icon-xing" aria-label="<?php esc_attr_e('XING Button','gridmode'); ?>"><i class="fab fa-xing" aria-hidden="true" title="<?php esc_attr_e('XING','gridmode'); ?>"></i></a><?php endif; ?>
    <?php if ( gridmode_get_option('googleplaylink') ) : ?>
            <a href="<?php echo esc_url( gridmode_get_option('googleplaylink') ); ?>" target="_blank" rel="nofollow" class="gridmode-header-social-icon-googleplay" aria-label="<?php esc_attr_e('Google Play Button','gridmode'); ?>"><i class="fab fa-google-play" aria-hidden="true" title="<?php esc_attr_e('Google Play','gridmode'); ?>"></i></a><?php endif; ?>
    <?php if ( gridmode_get_option('slidesharelink') ) : ?>
            <a href="<?php echo esc_url( gridmode_get_option('slidesharelink') ); ?>" target="_blank" rel="nofollow" class="gridmode-header-social-icon-slideshare" aria-label="<?php esc_attr_e('SlideShare Button','gridmode'); ?>"><i class="fab fa-slideshare" aria-hidden="true" title="<?php esc_attr_e('SlideShare','gridmode'); ?>"></i></a><?php endif; ?>
    <?php if ( gridmode_get_option('dropboxlink') ) : ?>
            <a href="<?php echo esc_url( gridmode_get_option('dropboxlink') ); ?>" target="_blank" rel="nofollow" class="gridmode-header-social-icon-dropbox" aria-label="<?php esc_attr_e('Dropbox Button','gridmode'); ?>"><i class="fab fa-dropbox" aria-hidden="true" title="<?php esc_attr_e('Dropbox','gridmode'); ?>"></i></a><?php endif; ?>
    <?php if ( gridmode_get_option('paypallink') ) : ?>
            <a href="<?php echo esc_url( gridmode_get_option('paypallink') ); ?>" target="_blank" rel="nofollow" class="gridmode-header-social-icon-paypal" aria-label="<?php esc_attr_e('PayPal Button','gridmode'); ?>"><i class="fab fa-paypal" aria-hidden="true" title="<?php esc_attr_e('PayPal','gridmode'); ?>"></i></a><?php endif; ?>
    <?php if ( gridmode_get_option('viadeolink') ) : ?>
            <a href="<?php echo esc_url( gridmode_get_option('viadeolink') ); ?>" target="_blank" rel="nofollow" class="gridmode-header-social-icon-viadeo" aria-label="<?php esc_attr_e('Viadeo Button','gridmode'); ?>"><i class="fab fa-viadeo" aria-hidden="true" title="<?php esc_attr_e('Viadeo','gridmode'); ?>"></i></a><?php endif; ?>
    <?php if ( gridmode_get_option('wikipedialink') ) : ?>
            <a href="<?php echo esc_url( gridmode_get_option('wikipedialink') ); ?>" target="_blank" rel="nofollow" class="gridmode-header-social-icon-wikipedia" aria-label="<?php esc_attr_e('Wikipedia Button','gridmode'); ?>"><i class="fab fa-wikipedia-w" aria-hidden="true" title="<?php esc_attr_e('Wikipedia','gridmode'); ?>"></i></a><?php endif; ?>
    <?php if ( gridmode_get_option('skypeusername') ) : ?>
            <a href="skype:<?php echo esc_html( gridmode_get_option('skypeusername') ); ?>?chat" class="gridmode-header-social-icon-skype" aria-label="<?php esc_attr_e('Skype Button','gridmode'); ?>"><i class="fab fa-skype" aria-hidden="true" title="<?php esc_attr_e('Skype','gridmode'); ?>"></i></a><?php endif; ?>
    <?php if ( gridmode_get_option('emailaddress') ) : ?>
            <a href="mailto:<?php echo esc_html( gridmode_get_option('emailaddress') ); ?>" class="gridmode-header-social-icon-email" aria-label="<?php esc_attr_e('Email Us Button','gridmode'); ?>"><i class="far fa-envelope" aria-hidden="true" title="<?php esc_attr_e('Email Us','gridmode'); ?>"></i></a><?php endif; ?>
    <?php if ( gridmode_get_option('rsslink') ) : ?>
            <a href="<?php echo esc_url( gridmode_get_option('rsslink') ); ?>" target="_blank" rel="nofollow" class="gridmode-header-social-icon-rss" aria-label="<?php esc_attr_e('RSS Button','gridmode'); ?>"><i class="fas fa-rss" aria-hidden="true" title="<?php esc_attr_e('RSS','gridmode'); ?>"></i></a><?php endif; ?>
    <?php if ( gridmode_get_option('show_login_button') ) { ?><?php if (is_user_logged_in()) : ?><a href="<?php echo esc_url( wp_logout_url( get_permalink() ) ); ?>" aria-label="<?php esc_attr_e( 'Logout Button', 'gridmode' ); ?>" class="gridmode-header-social-icon-login"><i class="fas fa-sign-out-alt" aria-hidden="true" title="<?php esc_attr_e('Logout','gridmode'); ?>"></i></a><?php else : ?><a href="<?php echo esc_url( wp_login_url( get_permalink() ) ); ?>" aria-label="<?php esc_attr_e( 'Login / Register Button', 'gridmode' ); ?>" class="gridmode-header-social-icon-login"><i class="fas fa-sign-in-alt" aria-hidden="true" title="<?php esc_attr_e('Login / Register','gridmode'); ?>"></i></a><?php endif;?><?php } ?>
    <?php if ( gridmode_get_option('show_search_button') ) { ?><a href="<?php echo esc_url( '#' ); ?>" class="gridmode-header-social-icon-search" aria-label="<?php esc_attr_e('Search Button','gridmode'); ?>"><i class="fas fa-search" aria-hidden="true" title="<?php esc_attr_e('Search','gridmode'); ?>"></i></a><?php } ?>
</div>
<?php }


/**
* Author bio box
*/

function gridmode_add_author_bio_box() {
    $content='';
    if (is_single()) {
        $content .= '
            <div class="gridmode-author-bio">
            <div class="gridmode-author-bio-inside">
            <div class="gridmode-author-bio-top">
            <span class="gridmode-author-bio-gravatar">
                '. get_avatar( get_the_author_meta('email') , 80 ) .'
            </span>
            <div class="gridmode-author-bio-text">
                <div class="gridmode-author-bio-name">'.esc_html__( 'Author: ', 'gridmode' ).'<span>'. get_the_author_link() .'</span></div><div class="gridmode-author-bio-text-description">'. wp_kses_post( get_the_author_meta('description',get_query_var('author') ) ) .'</div>
            </div>
            </div>
            </div>
            </div>
        ';
    }
    return apply_filters( 'gridmode_add_author_bio_box', $content );
}


/**
* Post meta functions
*/

if ( ! function_exists( 'gridmode_post_tags' ) ) :
/**
 * Prints HTML with meta information for the tags.
 */
function gridmode_post_tags() {
    if ( 'post' == get_post_type() ) {
        /* translators: used between list items, there is a space after the comma */
        $tags_list = get_the_tag_list( '', esc_html_x( ', ', 'list item separator', 'gridmode' ) );
        if ( $tags_list ) {
            /* translators: 1: list of tags. */
            printf( '<span class="gridmode-tags-links"><i class="fas fa-tags" aria-hidden="true"></i> ' . esc_html__( 'Tagged %1$s', 'gridmode' ) . '</span>', $tags_list ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
        }
    }
}
endif;

if ( ! function_exists( 'gridmode_grid_cats' ) ) :
function gridmode_grid_cats() {
    if ( 'post' == get_post_type() ) {
        /* translators: used between list items, there is a space */
        $categories_list = get_the_category_list( esc_html__( '&nbsp;', 'gridmode' ) );
        if ( $categories_list ) {
            /* translators: 1: list of categories. */
            printf( '<div class="gridmode-grid-post-categories gridmode-grid-post-details-block">' . __( '<span class="gridmode-sr-only">Posted in </span>%1$s', 'gridmode' ) . '</div>', $categories_list ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
        }
    }
}
endif;

if ( ! function_exists( 'gridmode_author_image' ) ) :
function gridmode_author_image() {
    global $post;
    $author_email   = get_the_author_meta( 'user_email' );
    $gravatar_args  = apply_filters(
        'gridmode_gravatar_args',
        array(
            'size' => 20,
        )
    );
    $avatar_url     = get_avatar_url( $author_email, $gravatar_args );
    $avatar_markup  = '<img class="gridmode-grid-post-author-image" alt="' . esc_attr( get_the_author() ) . '" src="' . esc_url( $avatar_url ) . '" />&nbsp;';
    return apply_filters( 'gridmode_author_image', $avatar_markup );
}
endif;

if ( ! function_exists( 'gridmode_grid_postmeta' ) ) :
function gridmode_grid_postmeta() { ?>
    <?php global $post; ?>
    <?php if ( gridmode_get_option('show_post_author_home') || !(gridmode_get_option('hide_posted_date_home')) ) { ?>
    <div class="gridmode-grid-post-footer gridmode-grid-post-details-block">
    <div class="gridmode-grid-post-footer-inside">
    <?php if ( !(gridmode_get_option('hide_posted_date_home')) ) { ?><span class="gridmode-grid-post-date gridmode-grid-post-meta"><?php echo esc_html( get_the_date() ); ?></span><?php } ?>
    <?php if ( gridmode_get_option('show_post_author_home') ) { ?><span class="gridmode-grid-post-author gridmode-grid-post-meta"><a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>"><?php echo esc_html( get_the_author() ); ?></a></span><?php } ?>
    </div>
    </div>
    <?php } ?>
<?php }
endif;

if ( ! function_exists( 'gridmode_nongrid_postmeta' ) ) :
function gridmode_nongrid_postmeta() { ?>
    <?php global $post; ?>
    <?php if ( gridmode_get_option('show_post_author_home') || !(gridmode_get_option('hide_posted_date_home')) || (gridmode_get_option('show_comments_link_home') && ( ! post_password_required() && ( comments_open() || get_comments_number() ) )) || (!(gridmode_get_option('hide_post_categories_home')) && has_category()) ) { ?>
    <div class="gridmode-entry-meta-single">
    <?php if ( gridmode_get_option('show_post_author_home') ) { ?><span class="gridmode-entry-meta-single-author"><i class="far fa-user-circle" aria-hidden="true"></i>&nbsp;<span class="author vcard" itemscope="itemscope" itemtype="http://schema.org/Person" itemprop="author"><a class="url fn n" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>"><?php echo esc_html( get_the_author() ); ?></a></span></span><?php } ?>
    <?php if ( !(gridmode_get_option('hide_posted_date_home')) ) { ?><span class="gridmode-entry-meta-single-date"><i class="far fa-clock" aria-hidden="true"></i>&nbsp;<?php echo esc_html( get_the_date() ); ?></span><?php } ?>
    <?php if ( gridmode_get_option('show_comments_link_home') ) { ?><?php if ( ! post_password_required() && ( comments_open() || get_comments_number() ) ) { ?>
    <span class="gridmode-entry-meta-single-comments"><i class="far fa-comments" aria-hidden="true"></i>&nbsp;<?php comments_popup_link( sprintf( wp_kses( /* translators: %s: post title */ __( 'Leave a Comment<span class="gridmode-sr-only"> on %s</span>', 'gridmode' ), array( 'span' => array( 'class' => array(), ), ) ), wp_kses_post( get_the_title() ) ) ); ?></span>
    <?php } ?><?php } ?>
    <?php if ( !(gridmode_get_option('hide_post_categories_home')) && has_category() ) { ?><?php gridmode_single_cats(); ?><?php } ?>
    </div>
    <?php } ?>
<?php }
endif;

if ( ! function_exists( 'gridmode_single_cats' ) ) :
function gridmode_single_cats() {
    if ( 'post' == get_post_type() ) {
        /* translators: used between list items, there is a space */
        $categories_list = get_the_category_list( esc_html__( ', ', 'gridmode' ) );
        if ( $categories_list ) {
            /* translators: 1: list of categories. */
            printf( '<span class="gridmode-entry-meta-single-cats"><i class="far fa-folder-open" aria-hidden="true"></i>&nbsp;' . __( '<span class="gridmode-sr-only">Posted in </span>%1$s', 'gridmode' ) . '</span>', $categories_list ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
        }
    }
}
endif;

if ( ! function_exists( 'gridmode_single_postmeta' ) ) :
function gridmode_single_postmeta() { ?>
    <?php global $post; ?>
    <?php if ( !(gridmode_get_option('hide_post_author')) || !(gridmode_get_option('hide_posted_date')) || (!(gridmode_get_option('hide_comments_link')) && ( ! post_password_required() && ( comments_open() || get_comments_number() ) )) || (!(gridmode_get_option('hide_post_categories')) && has_category()) || gridmode_get_option('show_post_edit') ) { ?>
    <div class="gridmode-entry-meta-single">
    <?php if ( !(gridmode_get_option('hide_post_author')) ) { ?><span class="gridmode-entry-meta-single-author"><i class="far fa-user-circle" aria-hidden="true"></i>&nbsp;<span class="author vcard" itemscope="itemscope" itemtype="http://schema.org/Person" itemprop="author"><a class="url fn n" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>"><?php echo esc_html( get_the_author() ); ?></a></span></span><?php } ?>
    <?php if ( !(gridmode_get_option('hide_posted_date')) ) { ?><span class="gridmode-entry-meta-single-date"><i class="far fa-clock" aria-hidden="true"></i>&nbsp;<?php echo esc_html( get_the_date() ); ?></span><?php } ?>
    <?php if ( !(gridmode_get_option('hide_comments_link')) ) { ?><?php if ( ! post_password_required() && ( comments_open() || get_comments_number() ) ) { ?>
    <span class="gridmode-entry-meta-single-comments"><i class="far fa-comments" aria-hidden="true"></i>&nbsp;<?php comments_popup_link( sprintf( wp_kses( /* translators: %s: post title */ __( 'Leave a Comment<span class="gridmode-sr-only"> on %s</span>', 'gridmode' ), array( 'span' => array( 'class' => array(), ), ) ), wp_kses_post( get_the_title() ) ) ); ?></span>
    <?php } ?><?php } ?>
    <?php if ( !(gridmode_get_option('hide_post_categories')) && has_category() ) { ?><?php gridmode_single_cats(); ?><?php } ?>
    <?php if ( gridmode_get_option('show_post_edit') ) { ?><?php edit_post_link( sprintf( wp_kses( /* translators: %s: Name of current post. Only visible to screen readers */ __( 'Edit<span class="gridmode-sr-only"> %s</span>', 'gridmode' ), array( 'span' => array( 'class' => array(), ), ) ), wp_kses_post( get_the_title() ) ), '<span class="edit-link">&nbsp;&nbsp;<i class="far fa-edit" aria-hidden="true"></i> ', '</span>' ); ?><?php } ?>
    </div>
    <?php } ?>
<?php }
endif;

if ( ! function_exists( 'gridmode_page_postmeta' ) ) :
function gridmode_page_postmeta() { ?>
    <?php global $post; ?>
    <?php if ( !(gridmode_get_option('hide_page_author')) || !(gridmode_get_option('hide_page_date')) || (!(gridmode_get_option('hide_page_comments')) && ( ! post_password_required() && ( comments_open() || get_comments_number() ) )) ) { ?>
    <div class="gridmode-entry-meta-single">
    <?php if ( !(gridmode_get_option('hide_page_author')) ) { ?><span class="gridmode-entry-meta-single-author"><i class="far fa-user-circle" aria-hidden="true"></i>&nbsp;<span class="author vcard" itemscope="itemscope" itemtype="http://schema.org/Person" itemprop="author"><a class="url fn n" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>"><?php echo esc_html( get_the_author() ); ?></a></span></span><?php } ?>
    <?php if ( !(gridmode_get_option('hide_page_date')) ) { ?><span class="gridmode-entry-meta-single-date"><i class="far fa-clock" aria-hidden="true"></i>&nbsp;<?php echo esc_html( get_the_date() ); ?></span><?php } ?>
    <?php if ( !(gridmode_get_option('hide_page_comments')) ) { ?><?php if ( ! post_password_required() && ( comments_open() || get_comments_number() ) ) { ?>
    <span class="gridmode-entry-meta-single-comments"><i class="far fa-comments" aria-hidden="true"></i>&nbsp;<?php comments_popup_link( sprintf( wp_kses( /* translators: %s: post title */ __( 'Leave a Comment<span class="gridmode-sr-only"> on %s</span>', 'gridmode' ), array( 'span' => array( 'class' => array(), ), ) ), wp_kses_post( get_the_title() ) ) ); ?></span>
    <?php } ?><?php } ?>
    </div>
    <?php } ?>
<?php }
endif;

if ( ! function_exists( 'gridmode_grid_postmeta_header' ) ) :
function gridmode_grid_postmeta_header() { ?>
    <?php global $post; ?>
    <?php if ( gridmode_get_option('show_comments_link_home') && (! post_password_required() && ( comments_open() || get_comments_number() )) ) { ?>
    <div class="gridmode-grid-post-header gridmode-clearfix">
    <?php if ( gridmode_get_option('comments_count_full_home') ) { ?>
    <span class="gridmode-grid-post-comments gridmode-grid-post-header-meta"><i class="far fa-comments" aria-hidden="true"></i>&nbsp;<?php comments_popup_link( sprintf( wp_kses( /* translators: %s: post title */ __( '0 Comment<span class="gridmode-sr-only"> on %s</span>', 'gridmode' ), array( 'span' => array( 'class' => array(), ), ) ), wp_kses_post( get_the_title() ) ) ); ?></span>
    <?php } else { ?>
    <span class="gridmode-grid-post-comments gridmode-grid-post-header-meta"><i class="far fa-comments" aria-hidden="true"></i>&nbsp;<?php comments_popup_link( sprintf( wp_kses( /* translators: %s: post title */ __( '0<span class="gridmode-sr-only"> Comment on %s</span>', 'gridmode' ), array( 'span' => array( 'class' => array(), ), ) ), wp_kses_post( get_the_title() ) ), sprintf( wp_kses( /* translators: %s: post title */ __( '1<span class="gridmode-sr-only"> Comment on %s</span>', 'gridmode' ), array( 'span' => array( 'class' => array(), ), ) ), wp_kses_post( get_the_title() ) ), sprintf( wp_kses( /* translators: %s: post title */ __( '%1$s<span class="gridmode-sr-only"> Comments on %2$s</span>', 'gridmode' ), array( 'span' => array( 'class' => array(), ), ) ), number_format_i18n( get_comments_number() ), wp_kses_post( get_the_title() ) ) ); ?></span>
    <?php } ?>
    </div>
    <?php } ?>
<?php }
endif;


/**
* Posts navigation functions
*/

if ( ! function_exists( 'gridmode_wp_pagenavi' ) ) :
function gridmode_wp_pagenavi() {
    ?>
    <nav class="navigation posts-navigation gridmode-clearfix" role="navigation">
        <?php wp_pagenavi(); ?>
    </nav><!-- .navigation -->
    <?php
}
endif;

if ( ! function_exists( 'gridmode_posts_navigation' ) ) :
function gridmode_posts_navigation() {
    if ( !(gridmode_get_option('hide_posts_navigation')) ) {
        if ( function_exists( 'wp_pagenavi' ) ) {
            gridmode_wp_pagenavi();
        } else {
            if ( gridmode_get_option('posts_navigation_type') === 'normalnavi' ) {
                the_posts_navigation(array('prev_text' => esc_html__( 'Older posts', 'gridmode' ), 'next_text' => esc_html__( 'Newer posts', 'gridmode' )));
            } else {
                the_posts_pagination(array('mid_size' => 2, 'prev_text' => esc_html__( '&larr; Newer posts', 'gridmode' ), 'next_text' => esc_html__( 'Older posts &rarr;', 'gridmode' )));
            }
        }
    }
}
endif;

if ( ! function_exists( 'gridmode_post_navigation' ) ) :
function gridmode_post_navigation() {
    global $post;
    if ( !(gridmode_get_option('hide_post_navigation')) ) {
            the_post_navigation(array('prev_text' => esc_html__( '%title &rarr;', 'gridmode' ), 'next_text' => esc_html__( '&larr; %title', 'gridmode' )));
    }
}
endif;


/**
* Menu Functions
*/

// Get our wp_nav_menu() fallback, wp_page_menu(), to show a "Home" link as the first item
function gridmode_page_menu_args( $args ) {
    $args['show_home'] = true;
    return $args;
}
add_filter( 'wp_page_menu_args', 'gridmode_page_menu_args' );

function gridmode_primary_menu_text() {
   $menu_text = esc_html__( 'Menu', 'gridmode' );
    if ( gridmode_get_option('primary_menu_text') ) {
        $menu_text = gridmode_get_option('primary_menu_text');
    }
   return apply_filters( 'gridmode_primary_menu_text', $menu_text );
}

function gridmode_secondary_menu_text() {
   $menu_text = esc_html__( 'Menu', 'gridmode' );
    if ( gridmode_get_option('secondary_menu_text') ) {
        $menu_text = gridmode_get_option('secondary_menu_text');
    }
   return apply_filters( 'gridmode_secondary_menu_text', $menu_text );
}

function gridmode_secondary_menu_location() {
    $secondary_menu_location = 'before-footer';
    if ( gridmode_get_option('secondary_menu_location') ) {
        $secondary_menu_location = gridmode_get_option('secondary_menu_location');
    }
    return apply_filters( 'gridmode_secondary_menu_location', $secondary_menu_location );
}

function gridmode_primary_fallback_menu() {
   wp_page_menu( array(
        'sort_column'  => 'menu_order, post_title',
        'menu_id'      => 'gridmode-menu-primary-navigation',
        'menu_class'   => 'gridmode-primary-nav-menu gridmode-menu-primary',
        'container'    => 'ul',
        'echo'         => true,
        'link_before'  => '',
        'link_after'   => '',
        'before'       => '',
        'after'        => '',
        'item_spacing' => 'discard',
        'walker'       => '',
    ) );
}

function gridmode_secondary_fallback_menu() {
   wp_page_menu( array(
        'sort_column'  => 'menu_order, post_title',
        'menu_id'      => 'gridmode-menu-secondary-navigation',
        'menu_class'   => 'gridmode-secondary-nav-menu gridmode-menu-secondary',
        'container'    => 'ul',
        'echo'         => true,
        'link_before'  => '',
        'link_after'   => '',
        'before'       => '',
        'after'        => '',
        'item_spacing' => 'discard',
        'walker'       => '',
    ) );
}

function gridmode_primary_menu_area() {
if ( gridmode_is_primary_menu_active() ) { ?>
<div class="gridmode-container gridmode-primary-menu-container gridmode-clearfix">
<div class="gridmode-primary-menu-container-inside gridmode-clearfix">
<nav class="gridmode-nav-primary" id="gridmode-primary-navigation" itemscope="itemscope" itemtype="http://schema.org/SiteNavigationElement" aria-label="<?php esc_attr_e( 'Primary Menu', 'gridmode' ); ?>">
<div class="gridmode-outer-wrapper">
<button class="gridmode-primary-responsive-menu-icon" aria-controls="gridmode-menu-primary-navigation" aria-expanded="false"><?php esc_html_e( 'Menu', 'gridmode' ); ?></button>
<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'gridmode-menu-primary-navigation', 'menu_class' => 'gridmode-primary-nav-menu gridmode-menu-primary gridmode-clearfix', 'fallback_cb' => 'gridmode_primary_fallback_menu', 'container' => '', ) ); ?>
</div>
</nav>
</div>
</div>
<?php }
}

function gridmode_secondary_menu_area() {
if ( gridmode_is_secondary_menu_active() ) { ?>
<div class="gridmode-container gridmode-secondary-menu-container gridmode-clearfix">
<div class="gridmode-secondary-menu-container-inside gridmode-clearfix">
<nav class="gridmode-nav-secondary" id="gridmode-secondary-navigation" itemscope="itemscope" itemtype="http://schema.org/SiteNavigationElement" aria-label="<?php esc_attr_e( 'Secondary Menu', 'gridmode' ); ?>">
<div class="gridmode-outer-wrapper">
<button class="gridmode-secondary-responsive-menu-icon" aria-controls="gridmode-menu-secondary-navigation" aria-expanded="false"><?php echo esc_html( gridmode_secondary_menu_text() ); ?></button>
<?php wp_nav_menu( array( 'theme_location' => 'secondary', 'menu_id' => 'gridmode-menu-secondary-navigation', 'menu_class' => 'gridmode-secondary-nav-menu gridmode-menu-secondary gridmode-clearfix', 'fallback_cb' => 'gridmode_secondary_fallback_menu', 'container' => '', ) ); ?>
</div>
</nav>
</div>
</div>
<?php }
}


/**
* Header Functions
*/

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function gridmode_pingback_header() {
    if ( is_singular() && pings_open() ) {
        echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">';
    }
}
add_action( 'wp_head', 'gridmode_pingback_header' );

// Get custom-logo URL
function gridmode_custom_logo() {
    if ( ! has_custom_logo() ) {return;}
    $gridmode_custom_logo_id = get_theme_mod( 'custom_logo' );
    $gridmode_logo = wp_get_attachment_image_src( $gridmode_custom_logo_id , 'full' );
    $gridmode_logo_src = $gridmode_logo[0];
    return apply_filters( 'gridmode_custom_logo', $gridmode_logo_src );
}

// Site Title
function gridmode_site_title() {
    if ( is_front_page() && is_home() ) { ?>
            <h1 class="gridmode-site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
            <?php if ( !(gridmode_get_option('hide_tagline')) ) { ?><p class="gridmode-site-description"><?php bloginfo( 'description' ); ?></p><?php } ?>
    <?php } elseif ( is_home() ) { ?>
            <h1 class="gridmode-site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
            <?php if ( !(gridmode_get_option('hide_tagline')) ) { ?><p class="gridmode-site-description"><?php bloginfo( 'description' ); ?></p><?php } ?>
    <?php } elseif ( is_singular() ) { ?>
            <p class="gridmode-site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
            <?php if ( !(gridmode_get_option('hide_tagline')) ) { ?><p class="gridmode-site-description"><?php bloginfo( 'description' ); ?></p><?php } ?>
    <?php } elseif ( is_category() ) { ?>
            <p class="gridmode-site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
            <?php if ( !(gridmode_get_option('hide_tagline')) ) { ?><p class="gridmode-site-description"><?php bloginfo( 'description' ); ?></p><?php } ?>
    <?php } elseif ( is_tag() ) { ?>
            <p class="gridmode-site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
            <?php if ( !(gridmode_get_option('hide_tagline')) ) { ?><p class="gridmode-site-description"><?php bloginfo( 'description' ); ?></p><?php } ?>
    <?php } elseif ( is_author() ) { ?>
            <p class="gridmode-site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
            <?php if ( !(gridmode_get_option('hide_tagline')) ) { ?><p class="gridmode-site-description"><?php bloginfo( 'description' ); ?></p><?php } ?>
    <?php } elseif ( is_archive() && !is_category() && !is_tag() && !is_author() ) { ?>
            <p class="gridmode-site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
            <?php if ( !(gridmode_get_option('hide_tagline')) ) { ?><p class="gridmode-site-description"><?php bloginfo( 'description' ); ?></p><?php } ?>
    <?php } elseif ( is_search() ) { ?>
            <p class="gridmode-site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
            <?php if ( !(gridmode_get_option('hide_tagline')) ) { ?><p class="gridmode-site-description"><?php bloginfo( 'description' ); ?></p><?php } ?>
    <?php } elseif ( is_404() ) { ?>
            <p class="gridmode-site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
            <?php if ( !(gridmode_get_option('hide_tagline')) ) { ?><p class="gridmode-site-description"><?php bloginfo( 'description' ); ?></p><?php } ?>
    <?php } else { ?>
            <h1 class="gridmode-site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
            <?php if ( !(gridmode_get_option('hide_tagline')) ) { ?><p class="gridmode-site-description"><?php bloginfo( 'description' ); ?></p><?php } ?>
    <?php }
}

function gridmode_header_image_destination() {
    $url = home_url( '/' );
    if ( gridmode_get_option('header_image_destination') ) {
        $url = gridmode_get_option('header_image_destination');
    }
    return apply_filters( 'gridmode_header_image_destination', $url );
}

function gridmode_header_image_markup() {
    if ( get_header_image() ) {
        if ( gridmode_get_option('remove_header_image_link') ) {
            the_header_image_tag( array( 'class' => 'gridmode-header-img' ) );
        } else { ?>
            <a href="<?php echo esc_url( gridmode_header_image_destination() ); ?>" rel="home" class="gridmode-header-img-link"><?php the_header_image_tag( array( 'class' => 'gridmode-header-img' ) ); ?></a>
        <?php }
    }
}

function gridmode_header_image_details() {
    $header_image_custom_title = '';
    if ( gridmode_get_option('header_image_custom_title') ) {
        $header_image_custom_title = gridmode_get_option('header_image_custom_title');
    }

    $header_image_custom_description = '';
    if ( gridmode_get_option('header_image_custom_description') ) {
        $header_image_custom_description = gridmode_get_option('header_image_custom_description');
    }

    if ( !(gridmode_get_option('hide_header_image_details')) ) {
    if ( gridmode_get_option('header_image_custom_text') ) {
        if ( $header_image_custom_title || $header_image_custom_description ) { ?>
            <div class="gridmode-header-image-info">
            <div class="gridmode-header-image-info-inside">
                <?php if ( !(gridmode_get_option('hide_header_image_title')) ) { ?><?php if ( $header_image_custom_title ) { ?><p class="gridmode-header-image-site-title gridmode-header-image-block"><?php echo wp_kses_post( force_balance_tags( do_shortcode($header_image_custom_title) ) ); ?></p><?php } ?><?php } ?>
                <?php if ( !(gridmode_get_option('hide_header_image_description')) ) { ?><?php if ( $header_image_custom_description ) { ?><p class="gridmode-header-image-site-description gridmode-header-image-block"><?php echo wp_kses_post( force_balance_tags( do_shortcode($header_image_custom_description) ) ); ?></p><?php } ?><?php } ?>
            </div>
            </div>
        <?php }
    } else { ?>
        <div class="gridmode-header-image-info">
        <div class="gridmode-header-image-info-inside">
            <?php if ( !(gridmode_get_option('hide_header_image_title')) ) { ?><p class="gridmode-header-image-site-title gridmode-header-image-block"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p><?php } ?>
            <?php if ( !(gridmode_get_option('hide_header_image_description')) ) { ?><p class="gridmode-header-image-site-description gridmode-header-image-block"><?php bloginfo( 'description' ); ?></p><?php } ?>
        </div>
        </div>
    <?php }
    }
}

function gridmode_header_image_wrapper() { ?>
    <div class="gridmode-header-image gridmode-clearfix">
    <?php gridmode_header_image_markup(); ?>
    <?php gridmode_header_image_details(); ?>
    </div><?php
}

function gridmode_header_image() {
    if ( gridmode_get_option('hide_header_image') ) { return; }
    if ( get_header_image() ) {
        gridmode_header_image_wrapper();
    }
}


/**
* Css Classes Functions
*/

// Category ids in post class
function gridmode_category_id_class($classes) {
    global $post;
    foreach((get_the_category($post->ID)) as $category) {
        $classes[] = 'wpcat-' . $category->cat_ID . '-id';
    }
    return apply_filters( 'gridmode_category_id_class', $classes );
}
add_filter('post_class', 'gridmode_category_id_class');

// Adds custom classes to the array of body classes.
function gridmode_body_classes( $classes ) {
    // Adds a class of group-blog to blogs with more than 1 published author.
    if ( is_multi_author() ) {
        $classes[] = 'gridmode-group-blog';
    }

    if ( !(gridmode_get_option('disable_loading_animation')) ) {
        $classes[] = 'gridmode-animated gridmode-fadein';
    }

    $classes[] = 'gridmode-theme-is-active';

    if ( get_header_image() ) {
        $classes[] = 'gridmode-header-image-active';
    }

    if ( gridmode_get_option('header_image_cover') ) {
        $classes[] = 'gridmode-header-image-cover';
    }

    if ( has_custom_logo() ) {
        $classes[] = 'gridmode-custom-logo-active';
    }

    $classes[] = 'gridmode-layout-type-full';

    $classes[] = 'gridmode-masonry-inactive';

    $classes[] = 'gridmode-flexbox-grid';

    if ( gridmode_get_option('show_round_social_buttons') ) {
        $classes[] = 'gridmode-round-social-buttons';
    } else {
        $classes[] = 'gridmode-square-social-buttons';
    }

    if ( !(is_singular()) ) {
        if ( gridmode_get_option('featured_nongrid_media_under_post_title') ) {
            $classes[] = 'gridmode-nongrid-media-under-title';
        }
    }

    if ( is_singular() ) {
        if( is_single() ) {
            if ( gridmode_get_option('featured_media_under_post_title') ) {
                $classes[] = 'gridmode-single-media-under-title';
            }
        }
        if( is_page() ) {
            if ( gridmode_get_option('featured_media_under_page_title') ) {
                $classes[] = 'gridmode-single-media-under-title';
            }
        }

        if ( is_page_template( array( 'template-full-width-page.php', 'template-full-width-post.php' ) ) ) {
           $classes[] = 'gridmode-layout-full-width';
        } else {
            $classes[] = 'gridmode-layout-c-s1';
        }
    } else {
        $classes[] = 'gridmode-layout-full-width';
    }

    $classes[] = 'gridmode-header-style-logo-search-social';

    if ( gridmode_get_option('hide_tagline') ) {
        $classes[] = 'gridmode-tagline-inactive';
    }

    if ( 'beside-title' === gridmode_get_option('logo_location') ) {
        $classes[] = 'gridmode-logo-beside-title';
    } elseif ( 'above-title' === gridmode_get_option('logo_location') ) {
        $classes[] = 'gridmode-logo-above-title';
    } else {
        $classes[] = 'gridmode-logo-above-title';
    }

    if ( gridmode_is_primary_menu_active() ) {
        $classes[] = 'gridmode-primary-menu-active';
    } else {
        $classes[] = 'gridmode-primary-menu-inactive';
    }
    $classes[] = 'gridmode-primary-mobile-menu-active';
    if ( gridmode_get_option('center_primary_menu') ) {
        $classes[] = 'gridmode-primary-menu-centered';
    }

    if ( gridmode_is_secondary_menu_active() ) {
        $classes[] = 'gridmode-secondary-menu-active';
    } else {
        $classes[] = 'gridmode-secondary-menu-inactive';
    }
    $classes[] = 'gridmode-secondary-mobile-menu-active';
    if ( gridmode_get_option('center_secondary_menu') ) {
        $classes[] = 'gridmode-secondary-menu-centered';
    }

    if ( 'before-header' === gridmode_secondary_menu_location() ) {
        $classes[] = 'gridmode-secondary-menu-before-header';
    } elseif ( 'after-header' === gridmode_secondary_menu_location() ) {
        $classes[] = 'gridmode-secondary-menu-after-header';
    } elseif ( 'before-footer' === gridmode_secondary_menu_location() ) {
        $classes[] = 'gridmode-secondary-menu-before-footer';
    } elseif ( 'after-footer' === gridmode_secondary_menu_location() ) {
        $classes[] = 'gridmode-secondary-menu-after-footer';
    } else {
        $classes[] = 'gridmode-secondary-menu-before-footer';
    }

    if ( gridmode_is_social_buttons_active() ) {
        $classes[] = 'gridmode-social-buttons-active';
    } else {
        $classes[] = 'gridmode-social-buttons-inactive';
    }

    if ( gridmode_get_option('auto_width_thumbnail') ) {
        $classes[] = 'gridmode-auto-width-thumbnail';
    } else {
        $classes[] = 'gridmode-full-width-thumbnail';
    }

    return apply_filters( 'gridmode_body_classes', $classes );
}
add_filter( 'body_class', 'gridmode_body_classes' );


/**
* More Custom Functions
*/

// Change excerpt length
function gridmode_excerpt_length($length) {
    if ( is_admin() ) {
        return $length;
    }
    $read_more_length = 17;
    if ( gridmode_get_option('read_more_length') ) {
        $read_more_length = gridmode_get_option('read_more_length');
    }
    return apply_filters( 'gridmode_excerpt_length', $read_more_length );
}
add_filter('excerpt_length', 'gridmode_excerpt_length');

// Change excerpt more word
function gridmode_excerpt_more($more) {
    if ( is_admin() ) {
        return $more;
    }
    return '...';
}
add_filter('excerpt_more', 'gridmode_excerpt_more');

if ( ! function_exists( 'wp_body_open' ) ) :
    /**
     * Fire the wp_body_open action.
     *
     * Added for backwards compatibility to support pre 5.2.0 WordPress versions.
     */
    function wp_body_open() { // phpcs:ignore WPThemeReview.CoreFunctionality.PrefixAllGlobals.NonPrefixedFunctionFound
        /**
         * Triggered after the opening <body> tag.
         */
        do_action( 'wp_body_open' ); // phpcs:ignore WPThemeReview.CoreFunctionality.PrefixAllGlobals.NonPrefixedHooknameFound
    }
endif;

function gridmode_search_box_placeholder_text() {
    $placeholder_text = esc_html__( 'Enter your search keyword...', 'gridmode' );
    if ( gridmode_get_option('search_box_placeholder_text') ) {
        $placeholder_text = gridmode_get_option('search_box_placeholder_text');
    }
    return apply_filters( 'gridmode_search_box_placeholder_text', $placeholder_text );
}


/**
* Custom Hooks
*/

function gridmode_before_header() {
    do_action('gridmode_before_header');
}

function gridmode_after_header() {
    do_action('gridmode_after_header');
}

function gridmode_before_main_content() {
    do_action('gridmode_before_main_content');
}
add_action('gridmode_before_main_content', 'gridmode_top_widgets', 20 );
add_action('gridmode_before_main_content', 'gridmode_top_left_right_widgets', 40 );

function gridmode_after_main_content() {
    do_action('gridmode_after_main_content');
}
add_action('gridmode_after_main_content', 'gridmode_bottom_widgets', 10 );

function gridmode_sidebar_one() {
    do_action('gridmode_sidebar_one');
}
add_action('gridmode_sidebar_one', 'gridmode_sidebar_one_widgets', 10 );

function gridmode_before_single_post() {
    do_action('gridmode_before_single_post');
}

function gridmode_before_single_post_title() {
    do_action('gridmode_before_single_post_title');
}

function gridmode_after_single_post_title() {
    do_action('gridmode_after_single_post_title');
}

function gridmode_top_single_post_content() {
    do_action('gridmode_top_single_post_content');
}

function gridmode_bottom_single_post_content() {
    do_action('gridmode_bottom_single_post_content');
}

function gridmode_after_single_post_content() {
    do_action('gridmode_after_single_post_content');
}

function gridmode_after_single_post() {
    do_action('gridmode_after_single_post');
}

function gridmode_before_single_page() {
    do_action('gridmode_before_single_page');
}

function gridmode_before_single_page_title() {
    do_action('gridmode_before_single_page_title');
}

function gridmode_after_single_page_title() {
    do_action('gridmode_after_single_page_title');
}

function gridmode_after_single_page_content() {
    do_action('gridmode_after_single_page_content');
}

function gridmode_after_single_page() {
    do_action('gridmode_after_single_page');
}

function gridmode_before_comments() {
    do_action('gridmode_before_comments');
}

function gridmode_after_comments() {
    do_action('gridmode_after_comments');
}

function gridmode_before_footer() {
    do_action('gridmode_before_footer');
}

function gridmode_after_footer() {
    do_action('gridmode_after_footer');
}

function gridmode_before_nongrid_post_title() {
    do_action('gridmode_before_nongrid_post_title');
}

function gridmode_after_nongrid_post_title() {
    do_action('gridmode_after_nongrid_post_title');
}

if ( !(gridmode_get_option('enable_widgets_block_editor')) ) {
    // Disables the block editor from managing widgets in the Gutenberg plugin.
    add_filter( 'gutenberg_use_widgets_block_editor', '__return_false', 100 );

    // Disables the block editor from managing widgets.
    add_filter( 'use_widgets_block_editor', '__return_false' );
}

if ( ! function_exists( 'gridmode_remove_theme_support' ) ) :
function gridmode_remove_theme_support() {

    if ( gridmode_is_fitvids_active() ) {
        // Remove responsive embedded content support.
        remove_theme_support( 'responsive-embeds' );
    }

}
endif;
add_action( 'after_setup_theme', 'gridmode_remove_theme_support', 1000 );


/**
* Media functions
*/

function gridmode_media_content_grid() {
    global $post; ?>
    <?php if ( !(gridmode_get_option('hide_thumbnail_home')) ) { ?>
    <?php if ( has_post_thumbnail($post->ID) ) { ?>
    <div class="gridmode-grid-post-thumbnail gridmode-grid-post-block">
        <?php if ( gridmode_get_option('thumbnail_link_home') == 'no' ) { ?>
            <?php the_post_thumbnail('gridmode-360w-270h-image', array('class' => 'gridmode-grid-post-thumbnail-img', 'title' => the_title_attribute('echo=0'))); ?>
        <?php } else { ?>
            <a href="<?php echo esc_url( get_permalink() ); ?>" class="gridmode-grid-post-thumbnail-link" title="<?php /* translators: %s: post title. */ echo esc_attr( sprintf( __( 'Permanent Link to %s', 'gridmode' ), the_title_attribute( 'echo=0' ) ) ); ?>"><?php the_post_thumbnail('gridmode-360w-270h-image', array('class' => 'gridmode-grid-post-thumbnail-img', 'title' => the_title_attribute('echo=0'))); ?></a>
        <?php } ?>

        <?php gridmode_grid_postmeta_header(); ?>

        <?php if ( !(gridmode_get_option('hide_share_buttons_home')) ) { ?>
            <?php echo wp_kses_post( force_balance_tags( gridmode_grid_sharing_buttons() ) ); ?>
        <?php } ?>
    </div>
    <?php } else { ?>
    <?php if ( !(gridmode_get_option('hide_default_thumbnail')) ) { ?>
    <div class="gridmode-grid-post-thumbnail gridmode-grid-post-thumbnail-default gridmode-grid-post-block">
        <?php if ( gridmode_get_option('thumbnail_link_home') == 'no' ) { ?>
            <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/no-image-360-270.jpg' ); ?>" class="gridmode-grid-post-thumbnail-img"/>
        <?php } else { ?>
            <a href="<?php echo esc_url( get_permalink() ); ?>" class="gridmode-grid-post-thumbnail-link" title="<?php /* translators: %s: post title. */ echo esc_attr( sprintf( __( 'Permanent Link to %s', 'gridmode' ), the_title_attribute( 'echo=0' ) ) ); ?>"><img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/no-image-360-270.jpg' ); ?>" class="gridmode-grid-post-thumbnail-img"/></a>
        <?php } ?>

        <?php gridmode_grid_postmeta_header(); ?>

        <?php if ( !(gridmode_get_option('hide_share_buttons_home')) ) { ?>
            <?php echo wp_kses_post( force_balance_tags( gridmode_grid_sharing_buttons() ) ); ?>
        <?php } ?>
    </div>
    <?php } ?>
    <?php } ?>
    <?php } ?>
<?php }

function gridmode_media_content_single() {
    global $post;
    if ( has_post_thumbnail($post->ID) ) {
        if ( !(gridmode_get_option('hide_thumbnail')) ) {
            if ( gridmode_get_option('thumbnail_link') == 'no' ) { ?>
                <div class="gridmode-post-thumbnail-single">
                <?php
                if ( is_page_template( array( 'template-full-width-post.php' ) ) ) {
                    the_post_thumbnail('gridmode-1218w-autoh-image', array('class' => 'gridmode-post-thumbnail-single-img', 'title' => the_title_attribute('echo=0')));
                } else {
                    the_post_thumbnail('gridmode-880w-autoh-image', array('class' => 'gridmode-post-thumbnail-single-img', 'title' => the_title_attribute('echo=0')));
                }
                ?>
                </div>
            <?php } else { ?>
                <div class="gridmode-post-thumbnail-single">
                <?php if ( is_page_template( array( 'template-full-width-post.php' ) ) ) { ?>
                    <a href="<?php echo esc_url( get_permalink() ); ?>" title="<?php /* translators: %s: post title. */ echo esc_attr( sprintf( __( 'Permanent Link to %s', 'gridmode' ), the_title_attribute( 'echo=0' ) ) ); ?>" class="gridmode-post-thumbnail-single-link"><?php the_post_thumbnail('gridmode-1218w-autoh-image', array('class' => 'gridmode-post-thumbnail-single-img', 'title' => the_title_attribute('echo=0'))); ?></a>
                <?php } else { ?>
                    <a href="<?php echo esc_url( get_permalink() ); ?>" title="<?php /* translators: %s: post title. */ echo esc_attr( sprintf( __( 'Permanent Link to %s', 'gridmode' ), the_title_attribute( 'echo=0' ) ) ); ?>" class="gridmode-post-thumbnail-single-link"><?php the_post_thumbnail('gridmode-880w-autoh-image', array('class' => 'gridmode-post-thumbnail-single-img', 'title' => the_title_attribute('echo=0'))); ?></a>
                <?php } ?>
                </div>
    <?php   }
        }
    }
}

function gridmode_media_content_single_location() {
    global $post;
    if( gridmode_get_option('featured_media_under_post_title') ) {
        add_action('gridmode_after_single_post_title', 'gridmode_media_content_single', 10 );
    } else {
        add_action('gridmode_before_single_post_title', 'gridmode_media_content_single', 10 );
    }
}
add_action('template_redirect', 'gridmode_media_content_single_location', 100 );

function gridmode_media_content_page() {
    global $post;
    if ( has_post_thumbnail($post->ID) ) {
        if ( !(gridmode_get_option('hide_page_thumbnail')) ) {
            if ( gridmode_get_option('thumbnail_link_page') == 'no' ) { ?>
                <div class="gridmode-post-thumbnail-single">
                <?php
                if ( is_page_template( array( 'template-full-width-page.php' ) ) ) {
                    the_post_thumbnail('gridmode-1218w-autoh-image', array('class' => 'gridmode-post-thumbnail-single-img', 'title' => the_title_attribute('echo=0')));
                } else {
                    the_post_thumbnail('gridmode-880w-autoh-image', array('class' => 'gridmode-post-thumbnail-single-img', 'title' => the_title_attribute('echo=0')));
                }
                ?>
                </div>
            <?php } else { ?>
                <div class="gridmode-post-thumbnail-single">
                <?php if ( is_page_template( array( 'template-full-width-page.php' ) ) ) { ?>
                    <a href="<?php echo esc_url( get_permalink() ); ?>" title="<?php /* translators: %s: post title. */ echo esc_attr( sprintf( __( 'Permanent Link to %s', 'gridmode' ), the_title_attribute( 'echo=0' ) ) ); ?>" class="gridmode-post-thumbnail-single-link"><?php the_post_thumbnail('gridmode-1218w-autoh-image', array('class' => 'gridmode-post-thumbnail-single-img', 'title' => the_title_attribute('echo=0'))); ?></a>
                <?php } else { ?>
                    <a href="<?php echo esc_url( get_permalink() ); ?>" title="<?php /* translators: %s: post title. */ echo esc_attr( sprintf( __( 'Permanent Link to %s', 'gridmode' ), the_title_attribute( 'echo=0' ) ) ); ?>" class="gridmode-post-thumbnail-single-link"><?php the_post_thumbnail('gridmode-880w-autoh-image', array('class' => 'gridmode-post-thumbnail-single-img', 'title' => the_title_attribute('echo=0'))); ?></a>
                <?php } ?>
                </div>
    <?php   }
        }
    }
}

function gridmode_media_content_page_location() {
    global $post;
    if( gridmode_get_option('featured_media_under_page_title') ) {
        add_action('gridmode_after_single_page_title', 'gridmode_media_content_page', 10 );
    } else {
        add_action('gridmode_before_single_page_title', 'gridmode_media_content_page', 10 );
    }
}
add_action('template_redirect', 'gridmode_media_content_page_location', 110 );

function gridmode_media_content_nongrid() {
    global $post;
    if ( has_post_thumbnail($post->ID) ) {
        if ( !(gridmode_get_option('hide_thumbnail_home')) ) {
            if ( gridmode_get_option('thumbnail_link_home') == 'no' ) { ?>
                <div class="gridmode-post-thumbnail-single">
                <?php
                if ( is_page_template( array( 'template-full-width-post.php' ) ) ) {
                    the_post_thumbnail('gridmode-1218w-autoh-image', array('class' => 'gridmode-post-thumbnail-single-img', 'title' => the_title_attribute('echo=0')));
                } else {
                    the_post_thumbnail('gridmode-880w-autoh-image', array('class' => 'gridmode-post-thumbnail-single-img', 'title' => the_title_attribute('echo=0')));
                }
                ?>
                </div>
            <?php } else { ?>
                <div class="gridmode-post-thumbnail-single">
                <?php if ( is_page_template( array( 'template-full-width-post.php' ) ) ) { ?>
                    <a href="<?php echo esc_url( get_permalink() ); ?>" title="<?php /* translators: %s: post title. */ echo esc_attr( sprintf( __( 'Permanent Link to %s', 'gridmode' ), the_title_attribute( 'echo=0' ) ) ); ?>" class="gridmode-post-thumbnail-single-link"><?php the_post_thumbnail('gridmode-1218w-autoh-image', array('class' => 'gridmode-post-thumbnail-single-img', 'title' => the_title_attribute('echo=0'))); ?></a>
                <?php } else { ?>
                    <a href="<?php echo esc_url( get_permalink() ); ?>" title="<?php /* translators: %s: post title. */ echo esc_attr( sprintf( __( 'Permanent Link to %s', 'gridmode' ), the_title_attribute( 'echo=0' ) ) ); ?>" class="gridmode-post-thumbnail-single-link"><?php the_post_thumbnail('gridmode-880w-autoh-image', array('class' => 'gridmode-post-thumbnail-single-img', 'title' => the_title_attribute('echo=0'))); ?></a>
                <?php } ?>
                </div>
    <?php   }
        }
    }
}

function gridmode_media_content_nongrid_location() {
    if( gridmode_get_option('featured_nongrid_media_under_post_title') ) {
        add_action('gridmode_after_nongrid_post_title', 'gridmode_media_content_nongrid', 10 );
    } else {
        add_action('gridmode_before_nongrid_post_title', 'gridmode_media_content_nongrid', 10 );
    }
}
add_action('template_redirect', 'gridmode_media_content_nongrid_location', 120 );


/**
* Enqueue scripts and styles
*/

function gridmode_scripts() {
    wp_enqueue_style('gridmode-maincss', get_stylesheet_uri(), array(), NULL);
    wp_enqueue_style('fontawesome', get_template_directory_uri() . '/assets/css/all.min.css', array(), NULL );
    wp_enqueue_style('gridmode-webfont', '//fonts.googleapis.com/css?family=Oswald:400,500,700|Pridi:400,500,700|Merriweather:400,400i,700,700i&amp;display=swap', array(), NULL);

    $gridmode_fitvids_active = FALSE;
    if ( gridmode_is_fitvids_active() ) {
        $gridmode_fitvids_active = TRUE;
    }
    if ( $gridmode_fitvids_active ) {
        wp_enqueue_script('fitvids', get_template_directory_uri() .'/assets/js/jquery.fitvids.min.js', array( 'jquery' ), NULL, true);
    }

    $gridmode_backtotop_active = FALSE;
    if ( gridmode_is_backtotop_active() ) {
        $gridmode_backtotop_active = TRUE;
    }

    $gridmode_primary_menu_active = FALSE;
    if ( gridmode_is_primary_menu_active() ) {
        $gridmode_primary_menu_active = TRUE;
    }
    $gridmode_secondary_menu_active = FALSE;
    if ( gridmode_is_secondary_menu_active() ) {
        $gridmode_secondary_menu_active = TRUE;
    }

    $gridmode_sticky_sidebar_active = TRUE;
    if ( is_singular() ) {
        if ( is_page_template( array( 'template-full-width-page.php', 'template-full-width-post.php' ) ) ) {
           $gridmode_sticky_sidebar_active = FALSE;
        }
    } else {
        $gridmode_sticky_sidebar_active = FALSE;
    }
    if ( $gridmode_sticky_sidebar_active ) {
        wp_enqueue_script('ResizeSensor', get_template_directory_uri() .'/assets/js/ResizeSensor.min.js', array( 'jquery' ), NULL, true);
        wp_enqueue_script('theia-sticky-sidebar', get_template_directory_uri() .'/assets/js/theia-sticky-sidebar.min.js', array( 'jquery' ), NULL, true);
    }

    wp_enqueue_script('gridmode-navigation', get_template_directory_uri() . '/assets/js/navigation.js', array(), NULL, true );
    wp_enqueue_script('gridmode-skip-link-focus-fix', get_template_directory_uri() . '/assets/js/skip-link-focus-fix.js', array(), NULL, true );
    wp_enqueue_script('gridmode-customjs', get_template_directory_uri() .'/assets/js/custom.js', array( 'jquery', 'imagesloaded' ), NULL, true);

    wp_localize_script( 'gridmode-customjs', 'gridmode_ajax_object',
        array(
            'ajaxurl' => esc_url_raw( admin_url( 'admin-ajax.php' ) ),
            'primary_menu_active' => $gridmode_primary_menu_active,
            'secondary_menu_active' => $gridmode_secondary_menu_active,
            'sticky_sidebar_active' => $gridmode_sticky_sidebar_active,
            'fitvids_active' => $gridmode_fitvids_active,
            'backtotop_active' => $gridmode_backtotop_active,
        )
    );

    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }

    wp_enqueue_script('gridmode-html5shiv-js', get_template_directory_uri() .'/assets/js/html5shiv.js', array('jquery'), NULL, true);

    wp_localize_script('gridmode-html5shiv-js','gridmode_custom_script_vars',array(
        'elements_name' => esc_html__('abbr article aside audio bdi canvas data datalist details dialog figcaption figure footer header hgroup main mark meter nav output picture progress section summary template time video', 'gridmode'),
    ));
}
add_action( 'wp_enqueue_scripts', 'gridmode_scripts' );

/**
 * Enqueue IE compatible scripts and styles.
 */
function gridmode_ie_scripts() {
    wp_enqueue_script( 'respond', get_template_directory_uri(). '/assets/js/respond.min.js', array(), NULL, false );
    wp_script_add_data( 'respond', 'conditional', 'lt IE 9' );
}
add_action( 'wp_enqueue_scripts', 'gridmode_ie_scripts' );

/**
 * Enqueue styles for the block-based editor.
 */
function gridmode_block_editor_styles() {
    wp_enqueue_style( 'gridmode-block-editor-style', get_template_directory_uri() . '/assets/css/editor-blocks.css', array(), NULL );
}
add_action( 'enqueue_block_editor_assets', 'gridmode_block_editor_styles' );

/**
 * Enqueue customizer styles.
 */
function gridmode_enqueue_customizer_styles() {
    wp_enqueue_style( 'gridmode-customizer-styles', get_template_directory_uri() . '/assets/css/customizer-style.css', array(), NULL );
    wp_enqueue_style('fontawesome', get_template_directory_uri() . '/assets/css/all.min.css', array(), NULL );
}
add_action( 'customize_controls_enqueue_scripts', 'gridmode_enqueue_customizer_styles' );


/**
* Block Styles
*/

/**
 * Register Custom Block Styles
 */
if ( function_exists( 'register_block_style' ) ) :
    function gridmode_register_block_styles() {

        /**
         * Register block style
         */
        register_block_style( 'core/button', array( 'name' => 'gridmode-button', 'label' => __( 'GridMode Button', 'gridmode' ), 'is_default' => true, 'style_handle' => 'gridmode-maincss', ) ); // phpcs:ignore WPThemeReview.PluginTerritory.ForbiddenFunctions.editor_blocks_register_block_style

    }
    add_action( 'init', 'gridmode_register_block_styles' );
endif;


/**
* Customizer Options
*/

// Header styles
if ( ! function_exists( 'gridmode_header_style' ) ) :
function gridmode_header_style() {
    $header_text_color = get_header_textcolor();
    //if ( get_theme_support( 'custom-header', 'default-text-color' ) === $header_text_color ) { return; }
    ?>
    <style type="text/css">
    <?php if ( ! display_header_text() ) : ?>
        .gridmode-site-title, .gridmode-site-description {position: absolute;clip: rect(1px, 1px, 1px, 1px);}
    <?php else : ?>
        .gridmode-site-title, .gridmode-site-title a, .gridmode-site-description {color: #<?php echo esc_attr( $header_text_color ); ?>;}
    <?php endif; ?>
    </style>
    <?php
}
endif;