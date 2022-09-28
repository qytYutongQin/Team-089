<?php if (!function_exists('fameup_footer_social_section')) :
/**
 *  Header
 *
 * @since Fameup pro
 *
 */
function fameup_footer_social_section()
{ 

$footer_social_icon_enable = get_theme_mod('footer_social_icon_enable','1');
                 if($footer_social_icon_enable == 1)
                {
              ?>
          <div class="col-md-12 text-center">
            
              <?php 
                  $fameup_footer_fb_link = get_theme_mod('fameup_footer_fb_link');
                  $fameup_footer_fb_target = esc_attr(get_theme_mod('fameup_footer_fb_target','true'));
                  $fameup_footer_twt_link = get_theme_mod('fameup_footer_twt_link');
                  $fameup_footer_twt_target = esc_attr(get_theme_mod('fameup_footer_twt_target','true'));
                  $fameup_footer_lnkd_link = get_theme_mod('fameup_footer_lnkd_link');
                  $fameup_footer_lnkd_target = esc_attr(get_theme_mod('fameup_footer_lnkd_target','true'));
                  $fameup_footer_insta_link = get_theme_mod('fameup_footer_insta_link');
                  $fameup_footer_insta_target = esc_attr(get_theme_mod('fameup_footer_insta_target','true'));
                  $fameup_footer_youtube_link = get_theme_mod('fameup_footer_youtube_link');
                  $fameup_footer_youtube_target = esc_attr(get_theme_mod('fameup_footer_youtube_target','true'));
                  $fameup_footer_pinterest_link = get_theme_mod('fameup_footer_pinterest_link');
                  $fameup_footer_pinterest_target = esc_attr(get_theme_mod('fameup_footer_pinterest_target','true'));
                  $fameup_footer_telegram_link = get_theme_mod('fameup_footer_tele_link');
                  $fameup_footer_telegram_target = esc_attr(get_theme_mod('fameup_footer_tele_target','true'));
                  ?>
                <ul class="bs-social">
                        <?php if($fameup_footer_fb_link !=''){ ?>
                       <li> <a href="<?php echo esc_url($fameup_footer_fb_link); ?>" <?php if($fameup_footer_fb_target) { ?> target="_blank" <?php } ?>><i class="fab fa-facebook"></i>
                        </a></li>
                        <?php } ?>

                        <?php if($fameup_footer_twt_link !=''){ ?>
                        <li><a <?php if($fameup_footer_twt_target) { ?>target="_blank" <?php } ?>href="<?php echo esc_url($fameup_footer_twt_link);?>"><i class="fab fa-twitter"></i></a>
                        </li>
                        <?php } ?>
                        <?php if($fameup_footer_lnkd_link !=''){ ?>
                        <li><a <?php if($fameup_footer_lnkd_target) { ?>target="_blank" <?php } ?> href="<?php echo esc_url($fameup_footer_lnkd_link); ?>">
                        <i class="fab fa-linkedin"></i></a></li>
                        <?php } ?> 
                        <?php if($fameup_footer_insta_link !=''){ ?>
                        <li><a <?php if($fameup_footer_insta_target) { ?>target="_blank" <?php } ?> href="<?php echo esc_url($fameup_footer_insta_link); ?>"><i class="fab fa-instagram"></i>
                        </a></li>
                        <?php } ?>
                        <?php if($fameup_footer_youtube_link !=''){ ?>
                        <li><a <?php if($fameup_footer_youtube_target) { ?>target="_blank" <?php } ?> href="<?php echo esc_url($fameup_footer_youtube_link); ?>">
                        <i class="fab fa-youtube"></i></a></li>
                        <?php } ?><?php 
                        if($fameup_footer_pinterest_link !=''){ ?>
                        <li><a <?php if($fameup_footer_pinterest_target) { ?>target="_blank" <?php } ?> href="<?php echo esc_url($fameup_footer_pinterest_link); ?>">
                        <i class="fab fa-pinterest-p"></i></a></li>
                        <?php } ?>

                        <?php if($fameup_footer_telegram_link !=''){ ?>
                        <li><a <?php if($fameup_footer_telegram_target) { ?>target="_blank" <?php } ?> href="<?php echo esc_url($fameup_footer_telegram_link); ?>">
                        <i class="fab fa-telegram"></i></a></li>
                        <?php } ?>
                   </ul>
          </div>
<?php }
}
endif;
add_action('fameup_action_footer_social_section', 'fameup_footer_social_section', 2);