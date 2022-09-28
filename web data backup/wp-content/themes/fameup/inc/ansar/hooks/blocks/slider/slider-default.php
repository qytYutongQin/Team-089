<?php function fameup_slider_default_section()
{
global $post;
$fameup_url = fameup_get_freatured_image_url($post->ID, 'fameup-slider-full');
$slider_icon_enable = get_theme_mod('slider_icon_enable','true');
$slider_category_enable = get_theme_mod('slider_category_enable','true');
$slider_meta_enable = get_theme_mod('slider_meta_enable','true');
$slider_overlay_enable = get_theme_mod('slider_overlay_enable', 'true');
?>
  <div class="swiper-slide">
            <div class="bs-blog-thumb lg back-img" style="background-image: url('<?php echo esc_url($fameup_url); ?>');">
                <a class="link-div" href="<?php the_permalink(); ?>"> </a>

                <?php if($slider_overlay_enable == true) {?><div class="bs-blog-inner">
                    <?php if($slider_icon_enable == true) { ?><span class="post-form"><i class="fa fa-camera"></i></span><?php } ?>
                    <?php if($slider_category_enable == true) { ?><div class="bs-blog-category"> <?php fameup_post_categories(); ?> </div><?php } ?>
                    <h4 class="title"> <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                    <?php if($slider_meta_enable == true) { fameup_post_meta(); } ?>
                </div><?php } ?>
            </div>
        </div>
 
<?php } ?>