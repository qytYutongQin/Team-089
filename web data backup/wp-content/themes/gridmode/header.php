<?php
/**
* The header for GridMode theme.
*
* @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
*
* @package GridMode WordPress Theme
* @copyright Copyright (C) 2022 ThemesDNA
* @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
* @author ThemesDNA <themesdna@gmail.com>
*/

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="profile" href="http://gmpg.org/xfn/11">
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?> id="gridmode-site-body" itemscope="itemscope" itemtype="http://schema.org/WebPage">
<?php wp_body_open(); ?>
<a class="skip-link screen-reader-text" href="#gridmode-content-wrapper"><?php esc_html_e( 'Skip to content', 'gridmode' ); ?></a>

<?php gridmode_header_image(); ?>

<?php if ( 'before-header' === gridmode_secondary_menu_location() ) { ?><?php gridmode_secondary_menu_area(); ?><?php } ?>

<?php gridmode_before_header(); ?>

<div class="gridmode-site-header gridmode-container" id="gridmode-header" itemscope="itemscope" itemtype="http://schema.org/WPHeader" role="banner">
<div class="gridmode-head-content gridmode-clearfix" id="gridmode-head-content">

<?php if ( gridmode_is_header_content_active() ) { ?>
<div class="gridmode-header-inside gridmode-clearfix">
<div class="gridmode-header-inside-content gridmode-clearfix">
<div class="gridmode-outer-wrapper">
<div class="gridmode-header-inside-container">

<div class="gridmode-header-layout-logo gridmode-header-layout-item">
<div class="gridmode-header-layout-logo-inside gridmode-header-layout-item-inside">
<?php if ( has_custom_logo() ) : ?>
    <div class="site-branding site-branding-full">
    <div class="gridmode-custom-logo-image">
    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="gridmode-logo-img-link">
        <img src="<?php echo esc_url( gridmode_custom_logo() ); ?>" alt="" class="gridmode-logo-img"/>
    </a>
    </div>
    <div class="gridmode-custom-logo-info"><?php gridmode_site_title(); ?></div>
    </div>
<?php else: ?>
    <div class="site-branding">
        <?php gridmode_site_title(); ?>
    </div>
<?php endif; ?>
</div>
</div>

<div class="gridmode-header-layout-search gridmode-header-layout-item">
<div class="gridmode-header-layout-search-inside gridmode-header-layout-item-inside">
<?php get_search_form(); ?>
</div>
</div>

<?php if ( gridmode_is_social_buttons_active() ) { ?>
<div class="gridmode-header-layout-social gridmode-header-layout-item">
<div class="gridmode-header-layout-social-inside gridmode-header-layout-item-inside">
    <?php gridmode_social_buttons(); ?>
    <?php if ( gridmode_get_option('show_search_button') ) { ?>
    <div id="gridmode-search-overlay-wrap" class="gridmode-search-overlay">
      <div class="gridmode-search-overlay-content">
        <?php get_search_form(); ?>
      </div>
      <button class="gridmode-search-closebtn" aria-label="<?php esc_attr_e( 'Close Search', 'gridmode' ); ?>" title="<?php esc_attr_e('Close Search','gridmode'); ?>">&#xD7;</button>
    </div>
    <?php } ?>
</div>
</div>
<?php } ?>

</div>
</div>
</div>
</div>
<?php } else { ?>
<div class="gridmode-no-header-content">
  <?php gridmode_site_title(); ?>
</div>
<?php } ?>

</div><!--/#gridmode-head-content -->
</div><!--/#gridmode-header -->

<?php if ( 'after-header' === gridmode_secondary_menu_location() ) { ?><?php gridmode_secondary_menu_area(); ?><?php } ?>

<?php gridmode_after_header(); ?>

<?php gridmode_primary_menu_area(); ?>

<?php gridmode_top_wide_widgets(); ?>


<div class="gridmode-outer-wrapper" id="gridmode-wrapper-outside">

<div class="gridmode-container gridmode-clearfix" id="gridmode-wrapper">
<div class="gridmode-content-wrapper gridmode-clearfix" id="gridmode-content-wrapper">