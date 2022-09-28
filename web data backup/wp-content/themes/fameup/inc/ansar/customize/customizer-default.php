<?php
/**
 * Default theme options.
 *
 * @package Fameup
 */

if (!function_exists('fameup_get_default_theme_options')):

/**
 * Get default theme options
 *
 * @since 1.0.0
 *
 * @return array Default theme options.
 */
function fameup_get_default_theme_options() {

    $defaults = array();

    
    // Header options section
    $defaults['brk_news_enable'] = 1;
    $defaults['breaking_news_title'] = __('Trending', 'fameup');
    $defaults['select_brk_news_category'] = 0;
    $defaults['number_of_brk_news'] = 10;
    $defaults['header_layout'] = 'header-layout-1';
    $defaults['banner_advertisement_section'] = '';
    $defaults['banner_advertisement_section_url'] = '';
    $defaults['banner_advertisement_open_on_new_tab'] = 1;
    $defaults['banner_advertisement_scope'] = 'front-page-only';

    //Menu
    $defaults['fameup_menu_align_setting'] = 'mx-auto';

    // Frontpage Section.
    $defaults['show_popular_tags_title'] = __('Top Tags', 'fameup');
    $defaults['number_of_popular_tags'] = 7;
    $defaults['select_popular_tags_mode'] = 'post_tag';
    $defaults['select_flash_news_category'] = 0;
    $defaults['number_of_flash_news'] = 5;
    $defaults['select_flash_new_mode'] = 'flash-slide-left';
    $defaults['banner_flash_news_scope'] = 'front-page-only';
    $defaults['show_main_news_section'] = 1;
    $defaults['select_vertical_slider_news_category'] = 0;
    $defaults['vertical_slider_number_of_slides'] = 15;
    $defaults['select_slider_news_category'] = 0;
    $defaults['select_tab_section_mode'] = 'default';
    $defaults['latest_tab_title'] = __("Latest", 'fameup');
    $defaults['popular_tab_title'] = __("Popular", 'fameup');
    $defaults['trending_tab_title'] = __("Trending", 'fameup');
    $defaults['select_trending_tab_news_category'] = 0;
    $defaults['select_popular_tab_news_category'] = 0;
    $defaults['select_thumbs_news_category'] = 0;
    $defaults['number_of_slides'] = 5;
    $defaults['show_featured_news_section'] = 1;
    $defaults['featured_news_section_title'] = __('Featured Story', 'fameup');
    $defaults['select_featured_news_category'] = 0;
    $defaults['number_of_featured_news'] = 6;
    $defaults['main_banner_section_background_image']= '';
    $defaults['remove_header_image_overlay'] = 0;
    $defaults['select_editor_choice_category'] = 0;


    //Featured Ads Section
    $defaults['fatured_post_image_one'] ="";
    $defaults['featured_post_one_btn_txt'] ="";
    $defaults['featured_post_one_url'] ="";
    $defaults['featured_post_one_url_new_tab']=true;

    $defaults['fatured_post_image_two']="";
    $defaults['featured_post_two_btn_txt']="";
    $defaults['featured_post_two_url']="";
    $defaults['featured_post_two_url_new_tab']=true;

    $defaults['fatured_post_image_three']="";
    $defaults['featured_post_three_btn_txt']="";
    $defaults['featured_post_three_url']="";
    $defaults['featured_post_three_url_new_tab']=true;
    $defaults['frontpage_content_alignment'] = 'align-content-left';

    //layout options
    $defaults['fameup_content_layout'] = 'align-content-left';
    $defaults['global_post_date_author_setting'] = 'show-date-author';
    $defaults['global_hide_post_date_author_in_list'] = 1;
    $defaults['global_widget_excerpt_setting'] = 'trimmed-content';
    $defaults['global_date_display_setting'] = 'theme-date';
    
    $defaults['frontpage_latest_posts_section_title'] = __('You may have missed', 'fameup');
    $defaults['frontpage_latest_posts_category'] = 0;
    $defaults['number_of_frontpage_latest_posts'] = 4;

    //Single
    $defaults['single_show_featured_image'] = true;

    // filter.
    $defaults = apply_filters('fameup_filter_default_theme_options', $defaults);
    $defaults['single_show_share_icon'] = true;

	return $defaults;

}

endif;