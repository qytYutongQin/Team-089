<?php
/**
 * Moina Lite Theme Customizer
 *
 * @package Moina-lite
 */

//Sanitize Blog Post
function moina_lite_sanitize_radio_post($value){ 
    if(!in_array($value, array('true','false'))){
        $value = 'true';
    }
    return $value;
}

/**
 * 
 * Moina Blog customizer
 */
function moina_lite_customize_register( $wp_customize ) {
	// Add moina litepage options section
    $wp_customize->add_section('moina_lite_options', array(
        'title'          => esc_html__('Blogpage Settings', 'moina-lite'),
        'capability'     => 'edit_theme_options',
        'description'    => esc_html__('Select Moina lite settings from here.', 'moina-lite'),
        'priority' => 12,
    ));

    // Display Post Date
    $wp_customize->add_setting('moina_lite_display_post_date', array(
        'default'           => 'true',
        'capability'        => 'edit_theme_options',
        'type'              => 'theme_mod',
        'sanitize_callback' => 'moina_lite_sanitize_radio_post',
        'transport'         => 'refresh',
    ));
    $wp_customize->add_control('moina_lite_post_date_control', array(
        'label'      => esc_html__('Display post date?', 'moina-lite'),
        'description'=> esc_html__('If you don\'t want to show post date. Please turn button no.', 'moina-lite'),
        'section'    => 'moina_lite_options',
        'settings'   => 'moina_lite_display_post_date',
        'type'       => 'radio',
        'choices'    => array(
            'true'  => esc_html__('Yes', 'moina-lite'),
            'false' => esc_html__('No', 'moina-lite'),
        ),
    ));

    // Display Tittle
    $wp_customize->add_setting('moina_lite_display_title', array(
        'default'           => 'true',
        'capability'        => 'edit_theme_options',
        'type'              => 'theme_mod',
        'sanitize_callback' => 'moina_lite_sanitize_radio_post',
        'transport'         => 'refresh',
    ));
    $wp_customize->add_control('moina_lite_tittle_control', array(
        'label'      => esc_html__('Display post Tittle?', 'moina-lite'),
        'description'=> esc_html__('If you don\'t want to show post read more button. Please turn button no.', 'moina-lite'),
        'section'    => 'moina_lite_options',
        'settings'   => 'moina_lite_display_title',
        'type'       => 'radio',
        'choices'    => array(
            'true'  => esc_html__('Yes', 'moina-lite'),
            'false' => esc_html__('No', 'moina-lite'),
        ),
    ));

    // Display Featured Image
    $wp_customize->add_setting('moina_lite_display_featured_img', array(
        'default'           => 'true',
        'capability'        => 'edit_theme_options',
        'type'              => 'theme_mod',
        'sanitize_callback' => 'moina_lite_sanitize_radio_post',
        'transport'         => 'refresh',
    ));
    $wp_customize->add_control('moina_lite_display_featured_img_control', array(
        'label'      => esc_html__('Display post Featured Image?', 'moina-lite'),
        'description'=> esc_html__('If you don\'t want to show post read more button. Please turn button no.', 'moina-lite'),
        'section'    => 'moina_lite_options',
        'settings'   => 'moina_lite_display_featured_img',
        'type'       => 'radio',
        'choices'    => array(
            'true'  => esc_html__('Yes', 'moina-lite'),
            'false' => esc_html__('No', 'moina-lite'),
        ),
    ));

    // Add moina singlepage options section
    $wp_customize->add_section('moina_lite_single_options', array(
        'title'          => esc_html__('Singlepage Settings', 'moina-lite'),
        'capability'     => 'edit_theme_options',
        'description'    => esc_html__('Select single page settings from here.', 'moina-lite'),
        'priority' => 14,
    ));

    // Display Post Date
    $wp_customize->add_setting('moina_lite_display_single_post_date', array(
        'default'           => 'true',
        'capability'        => 'edit_theme_options',
        'type'              => 'theme_mod',
        'sanitize_callback' => 'moina_lite_sanitize_radio_post',
        'transport'         => 'refresh',
    ));
    $wp_customize->add_control('moina_lite_single_post_date_control', array(
        'label'      => esc_html__('Display post date?', 'moina-lite'),
        'description'=> esc_html__('If you don\'t want to show post date. Please turn button no.', 'moina-lite'),
        'section'    => 'moina_lite_single_options',
        'settings'   => 'moina_lite_display_single_post_date',
        'type'       => 'radio',
        'choices'    => array(
            'true'   => esc_html__('Yes', 'moina-lite'),
            'false'  => esc_html__('No', 'moina-lite'),
        ),
    ));

    // Display Post By
    $wp_customize->add_setting('moina_lite_display_single_post_by', array(
        'default'           => 'true',
        'capability'        => 'edit_theme_options',
        'type'              => 'theme_mod',
        'sanitize_callback' => 'moina_lite_sanitize_radio_post',
        'transport'         => 'refresh',
    ));
    $wp_customize->add_control('moina_lite_single_post_by_control', array(
        'label'      => esc_html__('Display post by?', 'moina-lite'),
        'description'=> esc_html__('If you don\'t want to show post date. Please turn button no.', 'moina-lite'),
        'section'    => 'moina_lite_single_options',
        'settings'   => 'moina_lite_display_single_post_by',
        'type'       => 'radio',
        'choices'    => array(
            'true'   => esc_html__('Yes', 'moina-lite'),
            'false'  => esc_html__('No', 'moina-lite'),
        ),
    ));

    // Add moina Footer Options Section
    $wp_customize->add_section('moina_lite_footer_options', array(
        'title'          => esc_html__('Footer Settings', 'moina-lite'),
        'capability'     => 'edit_theme_options',
        'description'    => esc_html__('Select footer settings from here.', 'moina-lite'),
        'priority' => 17,
    ));
    // Display Footer Background Color
    $wp_customize->add_setting('moina_lite_footer_background_color', array(
        'default'           => '#F8F8F8',
        'type'              => 'theme_mod',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'refresh',
    ));
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize, 'moina_lite_footer_background_color', array(
                'label'          => esc_html__('Footer Background Color','moina-lite'),
                'description'    => esc_html__('Select footer background color from here.', 'moina-lite'),
                'section'        => 'moina_lite_footer_options'
            )
        )
    );
}
add_action( 'customize_register', 'moina_lite_customize_register' );