<?php
/**
* Template part for displaying single posts.
*
* @link https://developer.wordpress.org/themes/basics/template-hierarchy/
*
* @package GridMode WordPress Theme
* @copyright Copyright (C) 2022 ThemesDNA
* @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
* @author ThemesDNA <themesdna@gmail.com>
*/
?>

<?php gridmode_before_single_post(); ?>

<article id="post-<?php the_ID(); ?>" <?php post_class('gridmode-post-singular gridmode-box'); ?>>
<div class="gridmode-box-inside">

    <?php gridmode_before_single_post_title(); ?>

    <?php if ( !(gridmode_get_option('hide_post_header')) ) { ?>
    <header class="entry-header">
    <div class="entry-header-inside gridmode-clearfix">
        <?php if ( !(gridmode_get_option('hide_post_title')) ) { ?>

        <?php if ( gridmode_get_option('remove_post_title_link') ) { ?>
            <?php the_title( '<h1 class="post-title entry-title">', '</h1>' ); ?>
        <?php } else { ?>
            <?php the_title( sprintf( '<h1 class="post-title entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h1>' ); ?>
        <?php } ?>

        <?php } ?>

        <?php gridmode_single_postmeta(); ?>
    </div>
    </header><!-- .entry-header -->
    <?php } ?>

    <?php if ( !(gridmode_get_option('hide_share_buttons')) ) { ?>
        <?php echo wp_kses_post( force_balance_tags( gridmode_social_sharing_buttons() ) ); ?>
    <?php } ?>

    <?php gridmode_after_single_post_title(); ?>

    <div class="entry-content gridmode-clearfix">
            <?php
            gridmode_top_single_post_content();

            the_content( sprintf(
                wp_kses(
                    /* translators: %s: Name of current post. Only visible to screen readers */
                    __( 'Continue reading<span class="gridmode-sr-only"> "%s"</span> <span class="meta-nav">&rarr;</span>', 'gridmode' ),
                    array(
                        'span' => array(
                            'class' => array(),
                        ),
                    )
                ),
                wp_kses_post( get_the_title() )
            ) );

            wp_link_pages( array(
             'before'      => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'gridmode' ) . '</span>',
             'after'       => '</div>',
             'link_before' => '<span>',
             'link_after'  => '</span>',
             ) );

            gridmode_bottom_single_post_content();
            ?>
    </div><!-- .entry-content -->

    <?php gridmode_after_single_post_content(); ?>

    <?php if ( !(gridmode_get_option('hide_author_bio_box')) ) { ?>
        <?php echo wp_kses_post( force_balance_tags( gridmode_add_author_bio_box() ) ); ?>
    <?php } ?>

    <?php if ( !(gridmode_get_option('hide_post_tags')) ) { ?>
    <?php if ( has_tag() ) { ?>
    <footer class="entry-footer gridmode-entry-footer">
    <div class="gridmode-entry-footer-inside">
        <?php gridmode_post_tags(); ?>
    </div>
    </footer><!-- .entry-footer -->
    <?php } ?>
    <?php } ?>

</div>
</article>

<?php gridmode_after_single_post(); ?>