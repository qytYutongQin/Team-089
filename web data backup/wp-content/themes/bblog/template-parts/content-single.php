<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package bblog
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class('post-class'); ?>>
  <div class="row">
    <div class="col-lg-12">
      <div class="post-details">
        <?php if ( has_post_thumbnail() ) : ?>
          <a href="<?php the_permalink() ?>" rel="bookmark"><?php the_post_thumbnail(); ?></a>

        <?php endif; ?>
      </div>
      <div class="entry-header">
        <?php
        if ( is_singular() ) :
          the_title( '<h1 class="entry-title">', '</h1>' );
        else :
          the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
        endif;

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
        <?php endif; ?>
      </div><!-- .entry-header -->

      <div class="entry-content">
        <?php
        the_content();
        ?>

        <?php
        wp_link_pages(
          array(
            'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'bblog' ),
            'after'  => '</div>',
          )
        );
        ?>
      </div>
      <div class="entry-footer">
        <div class="entry-meta taxonomies">
          <?php the_tags( '<ul><li>', '</li><li>', '</li></ul>' ); ?>
        </div>
      </div><!-- .entry-footer -->
    </div>
  </div>
</article><!-- #post-<?php the_ID(); ?> -->
