<?php
/**
* Template part for displaying posts.
*
* @link https://developer.wordpress.org/themes/basics/template-hierarchy/
*
* @package GridMode WordPress Theme
* @copyright Copyright (C) 2022 ThemesDNA
* @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
* @author ThemesDNA <themesdna@gmail.com>
*/
?>

<?php $gridmode_grid_post_content = get_the_content(); ?>
<div id="gridmode-grid-post-<?php the_ID(); ?>" class="gridmode-grid-post <?php echo esc_attr( gridmode_grid_post_class() ); ?>">
<div class="gridmode-grid-post-inside">

    <?php gridmode_media_content_grid(); ?>

    <?php if ( !(gridmode_get_option('hide_post_title_home')) || !(gridmode_get_option('hide_post_snippet')) || (!(gridmode_get_option('hide_post_categories_home')) && has_category()) || gridmode_get_option('show_post_author_home') || !(gridmode_get_option('hide_posted_date_home')) ) { ?>

    <div class="gridmode-grid-post-details gridmode-grid-post-block">
    <?php if ( !(gridmode_get_option('hide_post_categories_home')) && has_category() ) { ?>
        <?php gridmode_grid_cats(); ?>
    <?php } ?>

    <?php if ( !(gridmode_get_option('hide_post_title_home')) ) { ?>

    <?php if ( gridmode_get_option('remove_post_title_link_home') ) { ?>
        <?php the_title( '<h3 class="gridmode-grid-post-title gridmode-grid-post-details-block">', '</h3>' ); ?>
    <?php } else { ?>
        <?php the_title( sprintf( '<h3 class="gridmode-grid-post-title gridmode-grid-post-details-block"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h3>' ); ?>
    <?php } ?>

    <?php } ?>

    <?php if ( !(gridmode_get_option('hide_post_snippet')) ) { ?>
        <?php if ( !empty( $gridmode_grid_post_content ) ) { ?>
            <div class="gridmode-grid-post-snippet gridmode-grid-post-details-block"><div class="gridmode-grid-post-snippet-inside"><?php the_excerpt(); ?></div></div>
        <?php } ?>
    <?php } ?>

    <?php gridmode_grid_postmeta(); ?>
    </div>

    <?php } ?>

</div>
</div>