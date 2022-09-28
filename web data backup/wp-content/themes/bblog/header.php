<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package AKB_Blog
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">

    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<!--Preloader area start-->
<div id="loader" class="loader">
    <div class="loading"></div>
</div>
<!--Preloader area End-->

<?php wp_body_open(); ?>
<div id="page" class="site">
    <a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e('Skip to content', 'bblog'); ?></a>

    <header id="masthead" class="site-header">
        <div class="container">
            <div class="row justify-content-between align-items-center" id="menu-toggle-area">
                <div class="col-lg-4 col-md-6 col-8">
                    <div class="site-branding">
                        <?php
                        the_custom_logo();
                        if (is_front_page() && is_home()) :
                            ?>
                            <h1 class="site-title"><a href="<?php echo esc_url(home_url('/')); ?>"
                                                      rel="home"><?php bloginfo('name'); ?></a></h1>
                        <?php
                        else :
                            ?>
                            <h1 class="site-title"><a href="<?php echo esc_url(home_url('/')); ?>"
                                                      rel="home"><?php bloginfo('name'); ?></a></h1>
                        <?php
                        endif; ?>
                    </div><!-- .site-branding -->
                </div>
                <div class="col-lg-6 col-md-6 col-4 menu-toggle-area">
                    <button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><i
                                class="bbm-open fas fa-bars"></i><i
                                class="bbm-close fas fa-times"></i></button>

                </div>
                <div class="col-lg-8 col-md-12 col-12 text-left">
                      <div id="site-header-menu" class="site-header-menu">
                            <nav id="site-navigation" class="main-navigation" role="navigation"
                                 aria-label="<?php esc_attr_e('Primary Menu', 'bblog'); ?>">
                                <?php
                                wp_nav_menu(
                                    array(
                                        'theme_location' => 'primary',
                                        'menu_class' => 'primary-menu',
                                    )
                                );
                                ?>
                            </nav><!-- .main-navigation -->
                        </div><!-- .site-header-menu -->
                    </div>

    </header><!-- #masthead -->
