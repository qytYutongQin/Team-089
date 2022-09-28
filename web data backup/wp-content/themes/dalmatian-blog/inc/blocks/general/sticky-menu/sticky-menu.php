<?php

add_action( 'customize_register', 'dalmatian_blog_sticky_menu' );
function dalmatian_blog_sticky_menu( $wp_customize ) {

	$wp_customize->add_setting('dalmatian_blog_sticky_menu_option', array(
        'sanitize_callback'     =>  'dalmatian_blog_sanitize_checkbox',
        'default'               =>  dalmatian_blog_get_default_sticky_menu(),
    ));

    $wp_customize->add_control(new Graphthemes_Toggle_Control($wp_customize, 'dalmatian_blog_sticky_menu_option', array(
        'label' => esc_html__('Enable Sticky Menu', 'dalmatian-blog'),
        'section' => 'dalmatian_blog_general_customization_section',
        'settings' => 'dalmatian_blog_sticky_menu_option',
        'type' => 'toggle',
    )));

}