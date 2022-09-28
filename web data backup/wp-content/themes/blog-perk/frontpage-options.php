<?php

/**
 *
 * @package Foodup
 */
function foodup_customize_register($wp_customize) {

$fameup_default = blogperk_get_default_theme_options();

$wp_customize->add_setting(
    'slider_tabs',
    array(
        'default'           => '',
        'sanitize_callback' => 'esc_attr'
        ));


    $wp_customize->add_control( new Fameup_Custom_Tab_Control ( $wp_customize,'slider_tabs',
        array(
            'label'                 => '',
            'type' => 'custom-tab-control',
            'section'               => 'frontpage_main_banner_section_settings',
            'controls_general'      => json_encode( array( '#customize-control-frontpage_slider_heading','#customize-control-blog_perk_slider_main_news_section', '#customize-control-main_banner_section_background_image','#customize-control-fameup_slider_layout', '#customize-control-main_slider_section_title', '#customize-control-select_slider_news_category','#customize-control-slider_speed' ) ),
                'controls_design'       => json_encode( array( '#customize-control-slider_overlay_enable','#customize-control-fameup_slider_overlay_color', '#customize-control-fameup_slider_overlay_text_color', '#customize-control-fameup_slider_title_font_size','#customize-control-slider_icon_enable','#customize-control-slider_category_enable','#customize-control-slider_meta_enable') ),
        )
            
        ));





// Setting - blog_perk_slider_main_news_section.
$wp_customize->add_setting('blog_perk_slider_main_news_section',
    array(
        'default' => $fameup_default['blog_perk_slider_main_news_section'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'fameup_sanitize_checkbox',
    )
);

$wp_customize->add_control('blog_perk_slider_main_news_section',
    array(
        'label' => esc_html__('Enable Slider Banner Section', 'blog-perk'),
        'section' => 'frontpage_main_banner_section_settings',
        'type' => 'checkbox',
        'priority' => 100,

    )
);

}
add_action('customize_register', 'foodup_customize_register');