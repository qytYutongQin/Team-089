<?php


add_action( 'customize_register', 'dalmatian_blog_post_snippet_featured_image' );
function dalmatian_blog_post_snippet_featured_image( $wp_customize ) {

	$wp_customize->add_setting( 'post_snippet_hide_show_featured_image', array(
        'sanitize_callback'     =>  'dalmatian_blog_sanitize_checkbox',
        'default'               =>  dalmatian_blog_get_default_post_snippet_featured_image()
    ) );

    $wp_customize->add_control( new Graphthemes_Toggle_Control( $wp_customize, 'post_snippet_hide_show_featured_image', array(
        'label' => esc_html__( 'Show/Hide Featured Image','dalmatian-blog' ),
        'section' => 'dalmatian_blog_post_snippet_customization_section',
        'settings' => 'post_snippet_hide_show_featured_image',
        'type'=> 'toggle',
    ) ) );

}


add_action( 'customize_register', 'dalmatian_blog_post_snippet_featured_image_size' );
function dalmatian_blog_post_snippet_featured_image_size( $wp_customize ) {

    $wp_customize->add_setting( 'post_snippet_featured_image_size', array(
        'default'     => dalmatian_blog_get_default_post_snippet_featured_image_size(),
        'sanitize_callback' => 'dalmatian_blog_sanitize_select',
    ) );

    $wp_customize->add_control( 'post_snippet_featured_image_size', array(
        'settings'    => 'post_snippet_featured_image_size',
        'label'       =>  esc_html__( 'Post Thumbnail Options:', 'dalmatian-blog' ),
        'section'     => 'dalmatian_blog_post_snippet_customization_section',
        'type'        => 'select',
        'active_callback' => function(){
            return get_theme_mod( 'post_snippet_hide_show_featured_image', dalmatian_blog_get_default_post_snippet_featured_image() );
        },
        'choices'     => array(
            'thumbnail' => esc_html__( 'Thumbnail', 'dalmatian-blog' ),
            'medium' => esc_html__( 'Medium', 'dalmatian-blog' ),
            'large' => esc_html__( 'Large', 'dalmatian-blog' ),
            'full' => esc_html__( 'Full / Original', 'dalmatian-blog' ),
        )
    ) );

}