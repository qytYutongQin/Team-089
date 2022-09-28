<?php
/**
* The template for displaying full-width post.
*
* @package GridMode WordPress Theme
* @copyright Copyright (C) 2022 ThemesDNA
* @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
* @author ThemesDNA <themesdna@gmail.com>
*
* Template Name: Full Width, no sidebar
* Template Post Type: post
*/

get_header(); ?>

<div class="gridmode-main-wrapper gridmode-clearfix" id="gridmode-main-wrapper" itemscope="itemscope" itemtype="http://schema.org/Blog" role="main">
<div class="theiaStickySidebar">
<div class="gridmode-main-wrapper-inside gridmode-clearfix">

<?php gridmode_before_main_content(); ?>

<div class="gridmode-posts-wrapper" id="gridmode-posts-wrapper">

<?php while (have_posts()) : the_post();

    get_template_part( 'template-parts/content-single', get_post_format() );

    gridmode_post_navigation();

    gridmode_post_bottom_widgets();

    // If comments are open or we have at least one comment, load up the comment template
    if ( comments_open() || get_comments_number() ) :
            comments_template();
    endif;

endwhile; ?>

<div class="clear"></div>
</div><!--/#gridmode-posts-wrapper -->

<?php gridmode_after_main_content(); ?>

</div>
</div>
</div><!-- /#gridmode-main-wrapper -->

<?php get_footer(); ?>