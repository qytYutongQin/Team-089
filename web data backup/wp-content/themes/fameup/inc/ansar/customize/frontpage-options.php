<?php

/**
 * Option Panel
 *
 * @package Fameup
 */

$fameup_default = fameup_get_default_theme_options();

/**
 * Frontpage options section
 *
 * @package fameup
 */

//Header Bqckground Overlay 
   $wp_customize->add_setting(
        'fameup_header_overlay_color', array( 'sanitize_callback' => 'fameup_alpha_color_custom_sanitization_callback','default' => 'rgba(255,255,255,0.73)'
        
    ) );
    
    $wp_customize->add_control(new Fameup_Customize_Alpha_Color_Control( $wp_customize,'fameup_header_overlay_color', array(
       'label'      => __('Overlay Color', 'fameup' ),
        'palette' => true,
        'section' => 'header_image')
    ) );

$wp_customize->add_setting('remove_header_image_overlay',
        array(
            'default'           => $fameup_default['remove_header_image_overlay'],
            'capability'        => 'edit_theme_options',
            'sanitize_callback' => 'fameup_sanitize_checkbox',
        )
    );

    $wp_customize->add_control('remove_header_image_overlay',
        array(
            'label'    => esc_html__('Remove Image Overlay', 'fameup'),
            'section'  => 'header_image',
            'type'     => 'checkbox',
            'priority' => 50,
        )
    );

    $wp_customize->add_setting('fameup_header_overlay_size',
        array(
            'default'           => 400,
            'sanitize_callback' => 'sanitize_text_field',
        )
    );

    $wp_customize->add_control('fameup_header_overlay_size',
        array(
            'label'    => esc_html__('Height', 'fameup'),
            'section'  => 'header_image',
            'type'     => 'number',
            'priority' => 100,
        )
    );



// Main banner Sider Section.
$wp_customize->add_section('frontpage_main_banner_section_settings',
    array(
        'title' => esc_html__('Featured Slider', 'fameup'),
        'priority' => 35,
        'capability' => 'edit_theme_options',
    )
);


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
            'controls_general'      => json_encode( array( '#customize-control-frontpage_slider_heading','#customize-control-show_main_news_section', '#customize-control-main_banner_section_background_image','#customize-control-fameup_slider_layout', '#customize-control-main_slider_section_title', '#customize-control-select_slider_news_category','#customize-control-slider_speed' ) ),
                'controls_design'       => json_encode( array( '#customize-control-slider_overlay_enable','#customize-control-fameup_slider_overlay_color', '#customize-control-fameup_slider_overlay_text_color', '#customize-control-fameup_slider_title_font_size','#customize-control-slider_icon_enable','#customize-control-slider_category_enable','#customize-control-slider_meta_enable') ),
        )
            
        ));





// Setting - show_main_news_section.
$wp_customize->add_setting('show_main_news_section',
    array(
        'default' => $fameup_default['show_main_news_section'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'fameup_sanitize_checkbox',
    )
);

$wp_customize->add_control('show_main_news_section',
    array(
        'label' => esc_html__('Enable Slider Banner Section', 'fameup'),
        'section' => 'frontpage_main_banner_section_settings',
        'type' => 'checkbox',
        'priority' => 100,

    )
);



// Setting banner_advertisement_section.
$wp_customize->add_setting('main_banner_section_background_image',
    array(
        'default' => $fameup_default['main_banner_section_background_image'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'absint',
    )
);


$wp_customize->add_control(
    new WP_Customize_Cropped_Image_Control($wp_customize, 'main_banner_section_background_image',
        array(
            'label' => esc_html__('Background image', 'fameup'),
            'description' => sprintf(esc_html__('Recommended Size %1$s px X %2$s px', 'fameup'), 1200, 720),
            'section' => 'frontpage_main_banner_section_settings',
            'width' => 1200,
            'height' => 720,
            'flex_width' => true,
            'flex_height' => true,
            'priority' => 100,
            'active_callback' => 'fameup_main_banner_section_status'
        )
    )
);

//section title
$wp_customize->add_setting('main_slider_section_title',
    array(
        'sanitize_callback' => 'sanitize_text_field',
    )
);

$wp_customize->add_control(
    new fameup_Section_Title(
        $wp_customize,
        'main_slider_section_title',
        array(
            'label'             => esc_html__( 'Slider Section ', 'fameup' ),
            'section'           => 'frontpage_main_banner_section_settings',
            'priority'          => 100,
            'active_callback' => 'fameup_main_banner_section_status'
        )
    )
);
// Setting - drop down category for slider.
$wp_customize->add_setting('select_slider_news_category',
    array(
        'default' => $fameup_default['select_slider_news_category'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'absint',
    )
);


$wp_customize->add_control(new Fameup_Dropdown_Taxonomies_Control($wp_customize, 'select_slider_news_category',
    array(
        'label' => esc_html__('Category', 'fameup'),
        'description' => esc_html__('Posts to be shown on banner slider section', 'fameup'),
        'section' => 'frontpage_main_banner_section_settings',
        'type' => 'dropdown-taxonomies',
        'taxonomy' => 'category',
        'priority' => 100,
        'active_callback' => 'fameup_main_banner_section_status'
    )));


        //SLider styling tabs
        $wp_customize->add_setting('slider_overlay_enable',
        array(
            'default' => true,
            'sanitize_callback' => 'fameup_sanitize_checkbox',
        )
        );
        $wp_customize->add_control(new Fameup_Toggle_Control( $wp_customize, 'slider_overlay_enable', 
            array(
                'label' => esc_html__('Show Slider Overlay', 'fameup'),
                'type' => 'toggle',
                'section' => 'frontpage_main_banner_section_settings',
            )
        ));


        //slider Overlay 
       $wp_customize->add_setting(
            'fameup_slider_overlay_color', array( 'sanitize_callback' => 'fameup_alpha_color_custom_sanitization_callback','default' => '#fff',
            
        ) );
        
        $wp_customize->add_control(new Fameup_Customize_Alpha_Color_Control( $wp_customize,'fameup_slider_overlay_color', array(
           'label'      => __('Overlay Color', 'fameup' ),
            'palette' => true,
            'section' => 'frontpage_main_banner_section_settings')
        ) );

        $wp_customize->add_setting(
        'fameup_slider_overlay_text_color', array( 'sanitize_callback' => 'sanitize_hex_color',
    ) );
    
    $wp_customize->add_control(new Fameup_Customize_Alpha_Color_Control( $wp_customize, 'fameup_slider_overlay_text_color', array(
       'label'      => __('Text Color', 'fameup' ),
       'palette' => true,
        'section' => 'frontpage_main_banner_section_settings'))
    );


        $wp_customize->add_setting('fameup_slider_title_font_size',
        array(
            'default'           => 38,
            'capability'        => 'edit_theme_options',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );

    $wp_customize->add_control('fameup_slider_title_font_size',
        array(
            'label'    => esc_html__('TItle font Size', 'fameup'),
            'section'  => 'frontpage_main_banner_section_settings',
            'type'     => 'number',
        )
    );

    $wp_customize->add_setting('slider_icon_enable',
    array(
        'default' => true,
        'sanitize_callback' => 'fameup_sanitize_checkbox',
    )
    );
    $wp_customize->add_control(new Fameup_Toggle_Control( $wp_customize, 'slider_icon_enable', 
        array(
            'label' => esc_html__('Show Icon', 'fameup'),
            'type' => 'toggle',
            'section' => 'frontpage_main_banner_section_settings',
        )
    ));

    $wp_customize->add_setting('slider_category_enable',
    array(
        'default' => true,
        'sanitize_callback' => 'fameup_sanitize_checkbox',
    )
    );
    $wp_customize->add_control(new Fameup_Toggle_Control( $wp_customize, 'slider_category_enable', 
        array(
            'label' => esc_html__('Show Category', 'fameup'),
            'type' => 'toggle',
            'section' => 'frontpage_main_banner_section_settings',
        )
    ));

    $wp_customize->add_setting('slider_meta_enable',
    array(
        'default' => true,
        'sanitize_callback' => 'fameup_sanitize_checkbox',
    )
    );
    $wp_customize->add_control(new Fameup_Toggle_Control( $wp_customize, 'slider_meta_enable', 
        array(
            'label' => esc_html__('Show Author,Date,Comment', 'fameup'),
            'type' => 'toggle',
            'section' => 'frontpage_main_banner_section_settings',
        )
    ));