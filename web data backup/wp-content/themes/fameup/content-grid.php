<?php
/**
 * The template for displaying the content.
 * @package Fameup
 */
?>
<div id="grid" class="row" >
     <?php while(have_posts()){ the_post();  
     $fameup_content_layout = esc_attr(get_theme_mod('fameup_content_layout','align-content-right')); ?>
    <div id="post-<?php the_ID(); ?>" <?php if($fameup_content_layout == "grid-fullwidth") { echo post_class('col-md-4'); } else { echo post_class('col-md-6'); } ?>>
       <!-- bs-posts-sec bs-posts-modul-6 -->
            <div class="bs-blog-post"> 
                <?php fameup_post_image_display_type($post); ?>
                  <article class="small">
                    <?php
                    $fameup_global_category_enable = get_theme_mod('fameup_global_category_enable','true');
                    if($fameup_global_category_enable == 'true') {
                    fameup_post_categories(); } ?>
                    <h4 class="title"><a href="<?php the_permalink();?>"><?php the_title();?></a></h4>
                    <?php fameup_post_meta(); fameup_posted_content(); wp_link_pages( ); 
                    $fameup_readmore_excerpt=get_theme_mod('fameup_blog_content','excerpt');
                            if($fameup_readmore_excerpt=="excerpt"){?>
                                <p><a href="<?php the_permalink();?>" class="more-link"><?php esc_html_e('Read More','fameup'); ?></a></p>
                            <?php 
                            } ?>
                    <?php fameup_post_social_share_post($post); ?>
                    </article>
            </div>
        </div>
        <?php } ?>
        <div class="col-md-12 text-center d-md-flex justify-content-center">
            <?php //Previous / next page navigation
                    the_posts_pagination( array(
                    'prev_text'          => '<i class="fa fa-angle-left"></i>',
                    'next_text'          => '<i class="fa fa-angle-right"></i>',
                    ) ); 
            ?>
        </div>
</div>