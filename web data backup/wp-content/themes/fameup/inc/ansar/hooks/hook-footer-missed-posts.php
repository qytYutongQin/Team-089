<?php if (!function_exists('fameup_footer_missed_section')) :
/**
 *  Header
 *
 * @since Fameup
 *
 */
function fameup_footer_missed_section()
{ 

$you_missed_enable = get_theme_mod('you_missed_enable',true);
$you_missed_title = get_theme_mod('you_missed_title',esc_html__('You Missed','fameup'));
if($you_missed_enable == 'true')
{
  ?>
<!--==================== Missed ====================-->
    <div class="missed">
      <div class="container">
        <div class="row">
          <?php if($you_missed_title) { ?>
          <div class="col-12">
            <div class="bs-widget-title">
              <h2 class="title"><span class="bg"><?php echo esc_html($you_missed_title); ?></span></h2>
            </div>
          </div>
        <?php } 
        $fameup_you_missed_loop = new WP_Query(array( 'post_type' => 'post', 'posts_per_page' => 3, 'order' => 'DESC',  'ignore_sticky_posts' => true));
            if ( $fameup_you_missed_loop->have_posts() ) :
            while ( $fameup_you_missed_loop->have_posts() ) : $fameup_you_missed_loop->the_post(); 
            $url = fameup_get_freatured_image_url($fameup_you_missed_loop->ID, 'fameup-featured');
        ?>
          <div class="col-md-4">
            <div class="bs-blog-post bshre">
              <?php if(has_post_thumbnail()) { ?>
              <div class="bs-blog-thumb md back-img" style="background-image: url('<?php echo esc_url($url); ?>');">
                            <a class="link-div" href="<?php the_permalink(); ?>"></a>
              </div>
              <?php } ?>
              <article class="small">
                <?php fameup_post_categories(); ?>
                <h4 class="title"> <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute( array('before' => 'Permalink to: ','after'  => '') ); ?>"> <?php the_title(); ?></a> </h4>
                <?php fameup_post_meta(); ?>
              </article>
            </div>
          </div>
          <?php endwhile; endif; wp_reset_postdata(); ?>
        </div>
      </div>
    </div>
<?php 
} }
endif;
add_action('fameup_action_footer_missed_section','fameup_footer_missed_section');
?>