<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package Fameup
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 *
 * @return array
 */

/**
 * Add a pingback url auto-discovery header for singularly identifiable articles.
 */
function fameup_pingback_header()
{
    if (is_singular() && pings_open()) {
        echo '<link rel="pingback" href="', esc_url(get_bloginfo('pingback_url')), '">';
    }
}

add_action('wp_head', 'fameup_pingback_header');


/**
 * Returns posts.
 *
 * @since Fameup 1.0.0
 */
if (!function_exists('fameup_get_posts')):
    function fameup_get_posts($number_of_posts, $category = '0')
    {

        $ins_args = array(
            'post_type' => 'post',
            'posts_per_page' => absint($number_of_posts),
            'post_status' => 'publish',
            'orderby' => 'date',
            'order' => 'DESC',
            'ignore_sticky_posts' => true
        );

        $category = isset($category) ? $category : '0';
        if (absint($category) > 0) {
            $ins_args['cat'] = absint($category);
        }

        $all_posts = new WP_Query($ins_args);

        return $all_posts;
    }

endif;


if (!function_exists('fameup_get_block')) :
    /**
     *
     * @param null
     *
     * @return null
     *
     * @since Fameup 1.0.0
     *
     */
    function fameup_get_block($block = 'grid', $section = 'post')
    {

        get_template_part('inc/ansar/hooks/blocks/block-' . $section, $block);

    }
endif;


/**
 * @param $post_id
 * @param string $size
 *
 * @return mixed|string
 */
function fameup_get_freatured_image_url($post_id, $size = 'fameup-featured')
{
    if (has_post_thumbnail($post_id)) {
        $thumb = wp_get_attachment_image_src(get_post_thumbnail_id($post_id), $size);
        $url = $thumb !== false ? '' . $thumb[0] . '' : '""';

    } else {
        $url = '';
    }


    return $url;
}

if (!function_exists('fameup_categories_show')):
    function fameup_categories_show()
{ ?>
<div class="bs-blog-category"> 
        <?php   $cat_list = get_the_category_list();
        if(!empty($cat_list)) { ?>
        <?php the_category(' '); ?>
        <?php } ?>
</div>
<?php } endif; 

if (!function_exists('fameup_edit_link')) :

    function fameup_edit_link($view = 'default')
    {
        global $post;
            edit_post_link(
                sprintf(
                    wp_kses(
                    /* translators: %s: Name of current post. Only visible to screen readers */
                        __('Edit <span class="screen-reader-text">%s</span>', 'fameup'),
                        array(
                            'span' => array(
                                'class' => array(),
                            ),
                        )
                    ),
                    get_the_title()
                ),
                '<span class="edit-link"><i class="fas fa-edit"></i>',
                '</span>'
            );

    } 
endif;

function fameup_date_display_type() {
    // Return if date display option is not enabled
    $header_data_enable = esc_attr(get_theme_mod('header_data_enable','true'));
    $header_time_enable = esc_attr(get_theme_mod('header_time_enable','true'));
    $fameup_date_time_show_type = get_theme_mod('fameup_date_time_show_type','fameup_default');
    if(($header_data_enable == true) ||($header_time_enable == true))
    {
    if ( $fameup_date_time_show_type == 'fameup_default' ) { 
    ?>
        <div class="top-date">
            <?php if($header_data_enable == true) { ?>
            <span class="day">
            <?php echo date_i18n('D. M jS, Y ', strtotime(current_time("Y-m-d"))); ?>
            </span>
            <?php } if($header_time_enable == true) { ?>
            <span  id="time" class="time"></span> 
           <?php } ?>
        </div>
        <?php } elseif( $fameup_date_time_show_type == 'wordpress_date_setting') { ?>
        <div class="top-date">
            <span class="day">
            <?php if($header_data_enable == true) { ?>
            <?php echo date_i18n( get_option( 'date_format' ) ); ?>
            </span>
            <?php } if($header_time_enable == true) { ?>
            <span  id="time" class="time">
            <?php $format = get_option('') . ' ' . get_option('time_format');
            print date_i18n($format, current_time('timestamp')); ?> 
            </span>
           <?php } ?>
        </div>
   <?php } } }

add_filter( 'woocommerce_show_page_title', 'fameup_hide_shop_page_title' );

function fameup_hide_shop_page_title( $title ) {
    if ( is_shop() ) $title = false;
    return $title;
}


function fameup_footer_logo_size()
{
    $fameup_footer_logo_width = get_theme_mod('fameup_footer_logo_width','160px');
    $fameup_footer_logo_height = get_theme_mod('fameup_footer_logo_height','70px');
    ?>
<style>
        footer .bs-footer-bottom-area .custom-logo {
            width: <?php echo esc_html($fameup_footer_logo_width); ?>px;
            height: <?php echo esc_html($fameup_footer_logo_height); ?>px;
        }

</style>
<?php } 
add_action('wp_footer','fameup_footer_logo_size');

function fameup_social_share_post($post) {

        $single_show_share_icon = esc_attr(get_theme_mod('single_show_share_icon','true'));
                if($single_show_share_icon == true) {
        $post_link  = esc_url( get_the_permalink() );
        $post_title = get_the_title();

        $facebook_url = add_query_arg(
        array(
        'u' => $post_link,
        ),
        'https://www.facebook.com/sharer.php'
        );

                    $twitter_url = add_query_arg(
                    array(
                    'url'  => $post_link,
                    'text' => rawurlencode( html_entity_decode( wp_strip_all_tags( $post_title ), ENT_COMPAT, 'UTF-8' ) ),
                     ),
                     'http://twitter.com/share'
                     );

                     $email_title = str_replace( '&', '%26', $post_title );

                     $email_url = add_query_arg(
                    array(
                    'subject' => wp_strip_all_tags( $email_title ),
                    'body'    => $post_link,
                     ),
                    'mailto:'
                     ); 

                     $linkedin_url = add_query_arg(
                     array('url'  => $post_link,
                    'title' => rawurlencode( html_entity_decode( wp_strip_all_tags( $post_title ), ENT_COMPAT, 'UTF-8' ) )
                     ),
                    'https://www.linkedin.com/sharing/share-offsite/?url'
                    );

                     $pinterest_url = add_query_arg(
                     array('url'  => $post_link,
                      'title' => rawurlencode( html_entity_decode( wp_strip_all_tags( $post_title ), ENT_COMPAT, 'UTF-8' ) )
                     ),
                    'http://pinterest.com/pin/create/link/?url='
                    );

                     $telegram_url = add_query_arg(
                     array('url'  => $post_link,
                      'title' => rawurlencode( html_entity_decode( wp_strip_all_tags( $post_title ), ENT_COMPAT, 'UTF-8' ) )
                     ),
                    'https://telegram.me/share/url?url=&text='
                    );
                     ?>
                     <script>
    function pinIt()
    {
      var e = document.createElement('script');
      e.setAttribute('type','text/javascript');
      e.setAttribute('charset','UTF-8');
      e.setAttribute('src','https://assets.pinterest.com/js/pinmarklet.js?r='+Math.random()*99999999);
      document.body.appendChild(e);
    }
    </script>
                     <div class="post-share">
                          <div class="post-share-icons cf">
                      
                                <?php $fameup_blog_share_facebook_enable = get_theme_mod('fameup_blog_share_facebook_enable','true');
                                  if($fameup_blog_share_facebook_enable == true) { ?>
                                <a href="<?php echo esc_url("$facebook_url"); ?>" class="link " target="_blank" >
                                <i class="fab fa-facebook"></i></a>
                                <?php } $fameup_blog_share_twitter_enable = get_theme_mod('fameup_blog_share_twitter_enable','true');
                                  if($fameup_blog_share_twitter_enable == true) { ?>
            
                              <a href="<?php echo esc_url("$twitter_url"); ?>" class="link " target="_blank">
                                <i class="fab fa-twitter"></i></a>
                                <?php } $fameup_blog_share_email_enable = get_theme_mod('fameup_blog_share_email_enable','true');
                                  if($fameup_blog_share_email_enable == true) { ?>
            
                              <a href="<?php echo esc_url("$email_url"); ?>" class="link " target="_blank" >
                                <i class="fas fa-envelope-open"></i></a>
                               <?php } $fameup_blog_share_linkdin_enable = get_theme_mod('fameup_blog_share_linkdin_enable','true');
                                  if($fameup_blog_share_linkdin_enable == true) { ?>

                              <a href="<?php echo esc_url("$linkedin_url"); ?>" class="link " target="_blank" >
                                <i class="fab fa-linkedin"></i></a>
                              <?php  } $fameup_blog_share_pintrest_enable = get_theme_mod('fameup_blog_share_pintrest_enable','true');
                                  if($fameup_blog_share_pintrest_enable == true) { ?>

                              <a href="javascript:pinIt();" class="link "><i class="fab fa-pinterest"></i></a>
                              <?php } $fameup_blog_share_telegram_enable = get_theme_mod('fameup_blog_share_telegram_enable','true');
                                  if($fameup_blog_share_telegram_enable == true) {?>

                               <a href="<?php echo esc_url("$telegram_url"); ?>" class="link " target="_blank" >
                                <i class="fab fa-telegram"></i>
                              </a>
                            <?php } ?>

                          </div>
                    </div>

<?php } } 

function fameup_post_image_display_type($post)
{
$url = fameup_get_freatured_image_url($post->ID, 'fameup-medium');
if($url) { ?>
    <div class="bs-blog-thumb lg back-img" style="background-image: url('<?php echo esc_url($url); ?>');">
        <a href="<?php the_permalink(); ?>" class="link-div"></a>
    </div> 
<?php }
}

if ( ! function_exists( 'fameup_header_color' ) ) :

function fameup_header_color() {
    $fameup_logo_text_color = get_header_textcolor();
    $fameup_title_font_size = get_theme_mod('fameup_title_font_size',100);

    ?>
    <style type="text/css">
    <?php
        if ( ! display_header_text() ) :
    ?>
        .site-title,
        .site-description {
            position: absolute;
            clip: rect(1px, 1px, 1px, 1px);
        }
    <?php
        else :
    ?>
        body .site-title a,
        body .site-description {
            color: #<?php echo esc_attr( $fameup_logo_text_color ); ?>;
        }

        .site-branding-text .site-title a {
                font-size: <?php echo esc_attr( $fameup_title_font_size ); ?>px;
            }

            @media only screen and (max-width: 640px) {
                .site-branding-text .site-title a {
                    font-size: 40px;

                }
            }

            @media only screen and (max-width: 375px) {
                .site-branding-text .site-title a {
                    font-size: 32px;

                }
            }

    <?php endif; ?>
    </style>
    <?php
}
endif;


//SCROLL TO TOP //
if ( ! function_exists( 'fameup_scrolltoup' ) ) :

function fameup_scrolltoup() {
$scrollup_layout = get_theme_mod('scrollup_layout','default');
$fameup_scrollup_enable = get_theme_mod('fameup_scrollup_enable','true');
if($fameup_scrollup_enable == true)
{?><div class="scroll-main"><?php
if($scrollup_layout == 'default')
{ ?>
  <a href="#" class="bs_upscr bounceInup animated"><i class="fa fa-angle-up"></i></a>
<?php } elseif($scrollup_layout == 'two') { ?> 
 <a href="#" class="bs_upscr bounceInup animated"><i class="fas fa-angle-double-up"></i></a>
<?php } elseif($scrollup_layout == 'three') { ?> 
 <a href="#" class="bs_upscr bounceInup animated"><i class="fa fas fa-arrow-up"></i></a>
<?php } elseif($scrollup_layout == 'four') { ?> 
 <a href="#" class="bs_upscr bounceInup animated"><i class="fas fa-long-arrow-alt-up"></i></a>
<?php } ?></div><?php } } endif; 

function fameup_dropcap()
{
$fameup_drop_caps_enable = get_theme_mod('fameup_drop_caps_enable','false');
if($fameup_drop_caps_enable == 'true')
{
?>
<style>
  .bs-blog-post p:nth-of-type(1)::first-letter {
    font-size: 60px;
    font-weight: 800;
    margin-right: 10px;
    font-family: 'Vollkorn', serif;
    line-height: 1; 
    float: left;
}
</style>
<?php } else { ?>
<style>
  .bs-blog-post p:nth-of-type(1)::first-letter {
    display: none;
}
</style>
<?php } } add_action('wp_head','fameup_dropcap'); 

function fameup_post_social_share_post($post) {

        $fameup_blog_post_icon_enable = esc_attr(get_theme_mod('fameup_blog_post_icon_enable','true'));
                if($fameup_blog_post_icon_enable == true) {
        $post_link  = esc_url( get_the_permalink() );
        $post_title = get_the_title();

        $facebook_url = add_query_arg(
        array(
        'u' => $post_link,
        ),
        'https://www.facebook.com/sharer.php'
        );

                    $twitter_url = add_query_arg(
                    array(
                    'url'  => $post_link,
                    'text' => rawurlencode( html_entity_decode( wp_strip_all_tags( $post_title ), ENT_COMPAT, 'UTF-8' ) ),
                     ),
                     'http://twitter.com/share'
                     );

                     $email_title = str_replace( '&', '%26', $post_title );

                     $email_url = add_query_arg(
                    array(
                    'subject' => wp_strip_all_tags( $email_title ),
                    'body'    => $post_link,
                     ),
                    'mailto:'
                     ); 

                     $linkedin_url = add_query_arg(
                     array('url'  => $post_link,
                    'title' => rawurlencode( html_entity_decode( wp_strip_all_tags( $post_title ), ENT_COMPAT, 'UTF-8' ) )
                     ),
                    'https://www.linkedin.com/sharing/share-offsite/?url'
                    );

                     $pinterest_url = add_query_arg(
                     array('url'  => $post_link,
                      'title' => rawurlencode( html_entity_decode( wp_strip_all_tags( $post_title ), ENT_COMPAT, 'UTF-8' ) )
                     ),
                    'http://pinterest.com/pin/create/link/?url='
                    );

                     $telegram_url = add_query_arg(
                     array('url'  => $post_link,
                      'title' => rawurlencode( html_entity_decode( wp_strip_all_tags( $post_title ), ENT_COMPAT, 'UTF-8' ) )
                     ),
                    'https://telegram.me/share/url?url=&text='
                    );
                     ?>
                     <script>
    function pinIt()
    {
      var e = document.createElement('script');
      e.setAttribute('type','text/javascript');
      e.setAttribute('charset','UTF-8');
      e.setAttribute('src','https://assets.pinterest.com/js/pinmarklet.js?r='+Math.random()*99999999);
      document.body.appendChild(e);
    }
    </script>
                     <div class="post-share">
                          <div class="post-share-icons cf">
                      
                                <?php $fameup_blog_share_facebook_enable = get_theme_mod('fameup_blog_share_facebook_enable','true');
                                  if($fameup_blog_share_facebook_enable == true) { ?>
                                <a href="<?php echo esc_url("$facebook_url"); ?>" class="link " target="_blank" >
                                <i class="fab fa-facebook"></i></a>
                                <?php } $fameup_blog_share_twitter_enable = get_theme_mod('fameup_blog_share_twitter_enable','true');
                                  if($fameup_blog_share_twitter_enable == true) { ?>
            
                              <a href="<?php echo esc_url("$twitter_url"); ?>" class="link " target="_blank">
                                <i class="fab fa-twitter"></i></a>
                                <?php } $fameup_blog_share_email_enable = get_theme_mod('fameup_blog_share_email_enable','true');
                                  if($fameup_blog_share_email_enable == true) { ?>
            
                              <a href="<?php echo esc_url("$email_url"); ?>" class="link " target="_blank" >
                                <i class="fas fa-envelope-open"></i></a>
                               <?php } $fameup_blog_share_linkdin_enable = get_theme_mod('fameup_blog_share_linkdin_enable','true');
                                  if($fameup_blog_share_linkdin_enable == true) { ?>

                              <a href="<?php echo esc_url("$linkedin_url"); ?>" class="link " target="_blank" >
                                <i class="fab fa-linkedin"></i></a>
                              <?php  } $fameup_blog_share_pintrest_enable = get_theme_mod('fameup_blog_share_pintrest_enable','true');
                                  if($fameup_blog_share_pintrest_enable == true) { ?>

                              <a href="javascript:pinIt();" class="link "><i class="fab fa-pinterest"></i></a>
                              <?php } $fameup_blog_share_telegram_enable = get_theme_mod('fameup_blog_share_telegram_enable','true');
                                  if($fameup_blog_share_telegram_enable == true) {?>

                               <a href="<?php echo esc_url("$telegram_url"); ?>" class="link " target="_blank" >
                                <i class="fab fa-telegram"></i>
                              </a>
                            <?php } ?>

                          </div>
                    </div>

<?php } } ?>