<?php
/**
* The template for displaying 404 pages (not found).
*
* @link https://codex.wordpress.org/Creating_an_Error_404_Page
*
* @package GridMode WordPress Theme
* @copyright Copyright (C) 2022 ThemesDNA
* @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
* @author ThemesDNA <themesdna@gmail.com>
*/

get_header(); ?>

<div class='gridmode-main-wrapper gridmode-clearfix' id='gridmode-main-wrapper' itemscope='itemscope' itemtype='http://schema.org/Blog' role='main'>
<div class='theiaStickySidebar'>
<div class="gridmode-main-wrapper-inside gridmode-clearfix">

<div class='gridmode-posts-wrapper' id='gridmode-posts-wrapper'>

<div class='gridmode-posts gridmode-box'>
<div class="gridmode-box-inside">

<div class="gridmode-page-header-outside">
<header class="gridmode-page-header">
<div class="gridmode-page-header-inside">
    <?php if ( gridmode_get_option('error_404_heading') ) : ?>
    <h1 class="page-title"><?php echo esc_html( gridmode_get_option('error_404_heading') ); ?></h1>
    <?php else : ?>
    <h1 class="page-title"><?php esc_html_e( 'Oops! The page you are looking for is not available.', 'gridmode' ); ?></h1>
    <?php endif; ?>
</div>
</header><!-- .gridmode-page-header -->
</div>

<div class='gridmode-posts-content'>

    <?php if ( gridmode_get_option('error_404_message') ) : ?>
    <p><?php echo wp_kses_post( force_balance_tags( gridmode_get_option('error_404_message') ) ); ?></p>
    <?php else : ?>
    <p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'gridmode' ); ?></p>
    <?php endif; ?>

    <?php if ( !(gridmode_get_option('hide_404_search')) ) { ?><?php get_search_form(); ?><?php } ?>

</div>

</div>
</div>

</div><!--/#gridmode-posts-wrapper -->

<?php gridmode_404_widgets(); ?>

</div>
</div>
</div><!-- /#gridmode-main-wrapper -->

<?php get_footer(); ?>