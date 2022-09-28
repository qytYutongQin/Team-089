<?php

add_action( 'customize_register', 'dalmatian_blog_breadcrumbs' );
function dalmatian_blog_breadcrumbs( $wp_customize ) {

	$wp_customize->add_setting('dalmatian_blog_breadcrumbs_option', array(
        'sanitize_callback'     =>  'dalmatian_blog_sanitize_checkbox',
        'default'               =>  dalmatian_blog_get_default_breadcrumbs(),
    ));

    $wp_customize->add_control(new Graphthemes_Toggle_Control($wp_customize, 'dalmatian_blog_breadcrumbs_option', array(
        'label' => esc_html__('Enable Breadcrumbs', 'dalmatian-blog'),
        'section' => 'dalmatian_blog_general_customization_section',
        'settings' => 'dalmatian_blog_breadcrumbs_option',
        'type' => 'toggle',
    )));

}