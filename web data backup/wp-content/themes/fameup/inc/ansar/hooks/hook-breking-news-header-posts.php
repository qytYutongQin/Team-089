<?php if (!function_exists('fameup_header_brk_section')) :
/**
 *  Header
 *
 * @since Fameup
 *
 */
function fameup_header_brk_section()
{
 if (is_front_page() || is_home()) {
$brk_news_enable = fameup_get_option('brk_news_enable');
            if ($brk_news_enable): ?>
            <div class="col-md-12 trending-cls">
              <div class="bs-latest-news mb-3 two">
                <?php $fameup_brk_news_title = fameup_get_option('breaking_news_title'); ?>
                    <!-- bs-latest-news -->
                    
                            <div class="bn_title">
                                <h2><i class="fas fa-bolt"></i> <?php if (!empty($fameup_brk_news_title)): ?>
                                    <?php echo esc_html($fameup_brk_news_title); ?>
                                <?php endif; ?> </h2>
                            </div>
                    <!-- bs-latest-news_slider -->
                    <?php
                    $category = fameup_get_option('select_brk_news_category');
                    $number_of_posts = fameup_get_option('number_of_brk_news');
                    $all_posts = fameup_get_posts($number_of_posts, $category);
                    $show_trending = true;
                    $count = 1;
                    $fameup_trending_style = get_theme_mod('fameup_trending_style','marquee');
                    if($fameup_trending_style == 'marquee')
                    {
                    ?>
                    <div class="bs-latest-news-slider marquee" <?php if(is_rtl()){ ?> data-direction='right' dir="ltr"<?php } ?>>
                    <?php } else { ?>
                    <div class="bs-latest-news-slider" <?php if(is_rtl()){ ?> data-direction='right' dir="ltr"<?php } ?> >
                    <?php } ?>
                      <?php if ($all_posts->have_posts()) :
                                  global $post;
                                    while ($all_posts->have_posts()) : $all_posts->the_post();
                                        ?>
                                          <a href="<?php the_permalink(); ?>">
                                         <?php $fameup_trending_image_enable = get_theme_mod('fameup_trending_image_enable','true');
                                            if($fameup_trending_image_enable == true)
                                            {
                                          if(has_post_thumbnail()){ ?>
                                         <img class="img" <?php echo esc_url(the_post_thumbnail()); ?>
                                         <?php } else {?>
                                         <img class="img" src="<?php echo esc_url(get_stylesheet_directory_uri()); ?>/images/image.jpg" />
                                         <?php } }?>
                                          <span><?php the_title(); ?></span></a>
                                        <?php
                                        $count++;
                                    endwhile;
                                    endif;
                                    wp_reset_postdata();
                           ?>
                    </div>
                    <!-- // bs-latest-news_slider -->
                </div>
            </div>
              <?php endif; ?>
<?php 
} }
endif;
add_action('fameup_action_header_brk_section', 'fameup_header_brk_section', 5);