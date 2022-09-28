<?php

add_action( 'customize_register', 'dalmatian_blog_secondary_font_family' );
function dalmatian_blog_secondary_font_family( $wp_customize ) {

    $wp_customize->add_setting( 'secondary_font_family', array(
        'default'     => dalmatian_blog_get_default_secondary_font_family(),
        'transport'   => 'postMessage',
        'sanitize_callback' => 'dalmatian_blog_sanitize_google_fonts'
    ) );

    $wp_customize->add_control( 'secondary_font_family', array(
        'settings'    => 'secondary_font_family',
        'label'       =>  esc_html__( 'Secondary Font', 'dalmatian-blog' ),
        'section'     => 'dalmatian_blog_font_customization_section',
        'type'        => 'select',
        'choices'     => dalmatian_blog_google_fonts( dalmatian_blog_free_pro() ),
    ) );

}


add_action( 'customize_preview_init', 'dalmatian_blog_secondary_font_family_enqueue_scripts' );
function dalmatian_blog_secondary_font_family_enqueue_scripts() {

    $secondary_font_family = esc_attr( get_theme_mod( 'secondary_font_family', dalmatian_blog_get_default_secondary_font_family() ) );


    wp_enqueue_script( 'graphthemes-secondary-font-family-customizer', get_template_directory_uri() . '/inc/blocks/font-family/secondary/customizer-secondary-font-family.js', array('jquery'), '', true );
}


add_action( 'wp_enqueue_scripts', 'dalmatian_blog_secondary_font_family_dynamic_css' );
function dalmatian_blog_secondary_font_family_dynamic_css() {

    $secondary_font_family = esc_attr( get_theme_mod( 'secondary_font_family', dalmatian_blog_get_default_secondary_font_family() ) );


    $dynamic_css = ":root { --secondary-font: $secondary_font_family; }";

    wp_add_inline_style( 'dalmatian-blog', $dynamic_css );
}