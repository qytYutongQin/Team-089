<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package AKB_Blog
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>



    <div class="bblog-post-thumbnail">
        <?php
        if(has_post_thumbnail()){
            bblog_post_thumbnail();
        }

        ?>
    </div>

    <header class="bblog-header-content entry-header">
        <?php

        if ( 'post' === get_post_type() ) :
            ?>
            <div class="entry-meta">
                <ul>
                    <li>
                        <?php
                        bblog_posted_by();?>
                    </li>                    <li>
                        <?php
                        bblog_posted_on();?>
                    </li>                    <li>
                        <?php
                        if ( ! post_password_required() && ( comments_open() || get_comments_number() ) ){
                            bblog_comment_by();
                        }
                        ?>
                    </li>
                </ul>
            </div><!-- .entry-meta -->
        <?php endif;
        if ( is_singular() ) :
            the_title( '<h1 class="entry-title">', '</h1>' );
        else :
            the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
        endif;
        ?>
    </header><!-- .entry-header -->
    <div class="bblog entry-content">
      <?php

        the_excerpt();

      if(!is_single()):
      ?>

        <p><a class="read-more-btn" href="<?php the_permalink();?>"><?php echo esc_html__( 'Read More', 'bblog' ); ?><i class="fas fa-chevron-right"></i></a></p>
        <?php
        endif;
      wp_link_pages(
        array(
          'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'bblog' ),
          'after'  => '</div>',
        )
      );
      ?>

    </div><!-- .entry-content -->
</article><!-- #post-<?php the_ID(); ?> -->
