<?php

add_action( 'customize_register', 'dalmatian_blog_post_snippet_tag' );
function dalmatian_blog_post_snippet_tag( $wp_customize ) {

	$wp_customize->add_setting( 'post_snippet_hide_show_tag', array(
        'sanitize_callback'     =>  'dalmatian_blog_sanitize_checkbox',
        'default'               =>  dalmatian_blog_get_default_post_snippet_tag()
    ) );

    $wp_customize->add_control( new Graphthemes_Toggle_Control( $wp_customize, 'post_snippet_hide_show_tag', array(
        'label' => esc_html__( 'Show/Hide Tags','dalmatian-blog' ),
        'section' => 'dalmatian_blog_post_snippet_customization_section',
        'settings' => 'post_snippet_hide_show_tag',
        'type'=> 'toggle',
    ) ) );

}