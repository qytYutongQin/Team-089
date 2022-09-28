<?php

add_action( 'customize_register', 'dalmatian_blog_post_snippet_excerpt_size' );
function dalmatian_blog_post_snippet_excerpt_size( $wp_customize ) {

	$wp_customize->add_setting( 'post_snippet_excerpt_size', array(
        'sanitize_callback'     =>  'absint',
        'default'               =>  dalmatian_blog_get_default_post_snippet_excerpt_size()
    ) );

    $wp_customize->add_control( 'post_snippet_excerpt_size', array(
        'settings' => 'post_snippet_excerpt_size',
        'type' => 'text',
        'section' => 'dalmatian_blog_post_snippet_customization_section',
        'label' => esc_html__( 'Excerpt Size', 'dalmatian-blog' ),            
    ) );

}