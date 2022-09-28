<?php
if (!function_exists('fameup_header_top_section')) :
/**
 *  Header
 *
 * @since Fameup
 *
 */
function fameup_header_top_section()
{
  
  $top_bar_data_enable = get_theme_mod('top_bar_data_enable','true');
  if ( $top_bar_data_enable == true ) { 
?>
<!--top-bar-->
      <div class="bs-head-detail hidden-xs hidden-sm">
        <div class="container">
          <div class="row align-items-center">
            <div class="col-md-7 col-xs-12">
              <div class="d-flex flex-wrap align-items-center justify-content-md-start justify-content-center mb-2 mb-md-0">
              <?php fameup_date_display_type(); ?>
              </div>
            </div>
            <!--/col-md-6-->
            <?php
            do_action('fameup_action_header_social_section')
             ?>
            <!--/col-md-6-->
          </div>
        </div>
      </div>
      <!--/top-bar-->

<?php 
} }
endif;
add_action('fameup_action_header_section', 'fameup_header_top_section', 5);


if (!function_exists('fameup_header_social_section')) :
/**
 *  Header
 *
 * @since Fameup pro
 *
 */
function fameup_header_social_section()
{ 

$header_social_icon_enable = get_theme_mod('header_social_icon_enable','1');
            $fameup_header_fb_link = get_theme_mod('fameup_header_fb_link');
            $fameup_header_fb_target = esc_attr(get_theme_mod('fameup_header_fb_target','true'));
            $fameup_header_twt_link = get_theme_mod('fameup_header_twt_link');
            $fameup_header_twt_target = esc_attr(get_theme_mod('fameup_header_twt_target','true'));
            $fameup_header_lnkd_link = get_theme_mod('fameup_header_lnkd_link');
            $fameup_header_lnkd_target = esc_attr(get_theme_mod('fameup_header_lnkd_target','true'));
            $fameup_header_insta_link = get_theme_mod('fameup_header_insta_link');
            $fameup_insta_insta_target = esc_attr(get_theme_mod('fameup_insta_insta_target','true'));
            $fameup_header_youtube_link = get_theme_mod('fameup_header_youtube_link');
            $fameup_header_youtube_target = esc_attr(get_theme_mod('fameup_header_youtube_target','true'));
            $fameup_header_pintrest_link = get_theme_mod('fameup_header_pintrest_link');
            $fameup_header_pintrest_target = esc_attr(get_theme_mod('fameup_header_pintrest_target','true'));
            $fameup_header_telegram_link = get_theme_mod('fameup_header_tele_link');
            $fameup_header_telegram_target = esc_attr(get_theme_mod('fameup_header_telegram_target','true'));
            if($header_social_icon_enable == 1)
              {
              ?>
              <div class="col-md-5 col-xs-12">
            <ul class="bs-social info-right">
                    
                      <?php if($fameup_header_fb_link !=''){ ?>
                      <li><a <?php if($fameup_header_fb_target) { ?> target="_blank" <?php } ?>href="<?php echo esc_url($fameup_header_fb_link); ?>">
                      <i class="fab fa-facebook"></i> </a></li>
                      <?php } ?>
                      <?php if($fameup_header_twt_link !=''){ ?>
                      <li><a <?php if($fameup_header_twt_target) { ?>target="_blank" <?php } ?>href="<?php echo esc_url($fameup_header_twt_link);?>">
                      <i class="fab fa-twitter"></i></a></li>
                      <?php } ?>
                      <?php if($fameup_header_lnkd_link !=''){ ?>
                      <li><a <?php if($fameup_header_lnkd_target) { ?>target="_blank" <?php } ?> href="<?php echo esc_url($fameup_header_lnkd_link); ?>">
                      <i class="fab fa-linkedin"></i></a></li>
                      <?php } ?>
                      <?php if($fameup_header_insta_link !=''){ ?>
                      <li><a <?php if($fameup_insta_insta_target) { ?>target="_blank" <?php } ?> href="<?php echo esc_url($fameup_header_insta_link); ?>">
                      <i class="fab fa-instagram"></i></a></li>
                      <?php } ?>
                      <?php if($fameup_header_youtube_link !=''){ ?>
                      <li><a <?php if($fameup_header_youtube_target) { ?>target="_blank" <?php } ?> href="<?php echo esc_url($fameup_header_youtube_link); ?>">
                      <i class="fab fa-youtube"></i></a></li>
                      <?php } ?>
                       <?php if($fameup_header_pintrest_link !=''){ ?>
                      <li><a <?php if($fameup_header_pintrest_target) { ?>target="_blank" <?php } ?> href="<?php echo esc_url($fameup_header_pintrest_link); ?>">
                      <i class="fab fa-pinterest-p"></i></a></li>
                      <?php } ?> 
                      <?php if($fameup_header_telegram_link !=''){ ?>
                      <li><a <?php if($fameup_header_telegram_target) { ?>target="_blank" <?php } ?> href="<?php echo esc_url($fameup_header_telegram_link); ?>">
                      <i class="fab fa-telegram"></i></a></li>
                      <?php } ?>
                </ul>
          </div>
<?php }
}
endif;
add_action('fameup_action_header_social_section', 'fameup_header_social_section', 2);