<?php

add_action( 'customize_register', 'dalmatian_blog_post_snippet_date' );
function dalmatian_blog_post_snippet_date( $wp_customize ) {

	$wp_customize->add_setting( 'post_snippet_hide_show_date', array(
        'sanitize_callback'     =>  'dalmatian_blog_sanitize_checkbox',
        'default'               =>  dalmatian_blog_get_default_post_snippet_date()
    ) );

    $wp_customize->add_control( new Graphthemes_Toggle_Control( $wp_customize, 'post_snippet_hide_show_date', array(
        'label' => esc_html__( 'Show/Hide Date','dalmatian-blog' ),
        'section' => 'dalmatian_blog_post_snippet_customization_section',
        'settings' => 'post_snippet_hide_show_date',
        'type'=> 'toggle',
    ) ) );

}