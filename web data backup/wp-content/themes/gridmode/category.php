<?php
/**
* The template for displaying category archive pages.
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

<?php if ( !(gridmode_get_option('hide_cats_title')) ) { ?>
<div class="gridmode-page-header-outside">
<header class="gridmode-page-header">
<div class="gridmode-page-header-inside">
<?php the_archive_title( '<h1 class="page-title">', '</h1>' ); ?>
<?php if ( !(gridmode_get_option('hide_cats_description')) ) { ?><?php the_archive_description( '<div class="taxonomy-description">', '</div>' ); ?><?php } ?>
</div>
</header>
</div>
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