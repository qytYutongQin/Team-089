<?php

add_action( 'customize_register', 'dalmatian_blog_customizer_theme_info' );

function dalmatian_blog_customizer_theme_info( $wp_customize ) {
	
    $wp_customize->add_section( 'dalmatian_blog_theme_info_section' , array(
		'title'       => esc_html__( '❂ Theme Info' , 'dalmatian-blog' ),
		'priority' => 2
	) );
    

	$wp_customize->add_setting( 'theme_info', array(
		'default' => '',
		'sanitize_callback' => 'wp_kses_post',
	) );
    
    $theme_info = '';
	
	$theme_info .= '<span class="sticky_info_row wp-clearfix"><label class="row-element">' . esc_html__( 'Theme Details', 'dalmatian-blog' ) . ': </label><a class="button alignright" href="' . esc_url( 'https://graphthemes.com/dalmatian-blog/' ) . '" target="_blank">' . esc_html__( 'Click Here', 'dalmatian-blog' ) . '</a></span><hr>';

	$theme_info .= '<span class="sticky_info_row wp-clearfix"><label class="row-element">' . esc_html__( 'How to use', 'dalmatian-blog' ) . ': </label><a class="button alignright" href="' . esc_url( 'https://graphthemes.com/theme-docs/dalmatian-blog/' ) . '" target="_blank">' . esc_html__( 'Click Here', 'dalmatian-blog' ) . '</a></span><hr>';
	$theme_info .= '<span class="sticky_info_row wp-clearfix"><label class="row-element">' . esc_html__( 'View Demo', 'dalmatian-blog' ) . ': </label><a class="button alignright" href="' . esc_url( 'https://graphthemes.com/preview/?product_id=dalmatian-blog' ) . '" target="_blank">' . esc_html__( 'Click Here', 'dalmatian-blog' ) . '</a></span><hr>';
	$theme_info .= '<span class="sticky_info_row wp-clearfix"><label class="row-element">' . esc_html__( 'Support Forum', 'dalmatian-blog' ) . ': </label><a class="button alignright" href="' . esc_url( 'https://wordpress.org/support/theme/dalmatian-blog' ) . '" target="_blank">' . esc_html__( 'Click Here', 'dalmatian-blog' ) . '</a></span><hr>';

	$wp_customize->add_control( new Dalmatian_Blog_Custom_Text( $wp_customize ,'theme_info',array(
		'section' => 'dalmatian_blog_theme_info_section',
		'label' => $theme_info
	) ) );

}