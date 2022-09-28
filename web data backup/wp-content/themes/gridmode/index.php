<?php
/**
* The main template file.
*
* This is the most generic template file in a WordPress theme
* and one of the two required files for a theme (the other being style.css).
* It is used to display a page when nothing more specific matches a query.
* E.g., it puts together the home page when no home.php file exists.
*
* @link https://developer.wordpress.org/themes/basics/template-hierarchy/
*
* @package GridMode WordPress Theme
* @copyright Copyright (C) 2022 ThemesDNA
* @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
* @author ThemesDNA <themesdna@gmail.com>
*/

get_header(); ?>

<div class="gridmode-main-wrapper gridmode-clearfix" id="gridmode-main-wrapper" itemscope="itemscope" itemtype="http://schema.org/Blog" role="main">
<div class="theiaStickySidebar">
<div class="gridmode-main-wrapper-inside gridmode-clearfix">

<?php gridmode_before_main_content(); ?>

<div class="gridmode-posts-wrapper" id="gridmode-posts-wrapper">

<?php if ( !(gridmode_get_option('hide_posts_heading')) ) { ?>
<?php if(is_home() && !is_paged()) { ?>
<?php if ( gridmode_get_option('posts_heading') ) : ?>
<div class="gridmode-posts-header"><h2 class="gridmode-posts-heading"><span class="gridmode-posts-heading-inside"><?php echo esc_html( gridmode_get_option('posts_heading') ); ?></span></h2></div>
<?php else : ?>
<div class="gridmode-posts-header"><h2 class="gridmode-posts-heading"><span class="gridmode-posts-heading-inside"><?php esc_html_e( 'Recent Posts', 'gridmode' ); ?></span></h2></div>
<?php endif; ?>
<?php } ?>
<?php } ?>

<div class="gridmode-posts-content gridmode-clearfix">

<?php if (have_posts()) : ?>

    <?php if ( 'grid' === gridmode_post_summaries_style() ) { ?>

    <div class="gridmode-posts gridmode-posts-grid gridmode-clearfix">
    <?php $gridmode_post_counter=1; while (have_posts()) : the_post(); ?>

        <?php get_template_part( 'template-parts/content-grid' ); ?>

    <?php $gridmode_post_counter++; endwhile; ?>
    </div>

    <?php } else { ?>

    <?php while (have_posts()) : the_post(); ?>
        <?php get_template_part( 'template-parts/content-nongrid' ); ?>
    <?php endwhile; ?>

    <?php } ?>

    <div class="clear"></div>

    <?php gridmode_posts_navigation(); ?>

<?php else : ?>

  <?php get_template_part( 'template-parts/content', 'none' ); ?>

<?php endif; ?>

</div>

</div><!--/#gridmode-posts-wrapper -->

<?php gridmode_after_main_content(); ?>

</div>
</div>
</div><!-- /#gridmode-main-wrapper -->

<?php get_sidebar(); ?>

<?php get_footer(); ?>