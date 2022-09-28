<?php

function dalmatian_blog_customizer_upgrade_to_pro( $wp_customize ) {

	$wp_customize->add_section( new Dalmatian_Blog_Button_Control( $wp_customize, 'upgrade-to-pro',	array(
		'title'    => esc_html__( '★ Dalmatian Blog Pro ', 'dalmatian-blog' ),
		'type'	=> 'button',
		'pro_text' => esc_html__( 'Upgrade to Pro', 'dalmatian-blog' ),
		'pro_url'  => esc_url( 'https://graphthemes.com/dalmatian-blog/' ),
		'priority' => 1
	) )	);

	
}
add_action( 'customize_register', 'dalmatian_blog_customizer_upgrade_to_pro' );


function dalmatian_blog_enqueue_custom_admin_style() {
        wp_register_style( 'dalmatian-blog-button', get_template_directory_uri() . '/inc/blocks/includes/button/button.css', false );
        wp_enqueue_style( 'dalmatian-blog-button' );

        wp_enqueue_script( 'dalmatian-blog-button', get_template_directory_uri() . '/inc/blocks/includes/button/button.js', array( 'jquery' ), false, true );
}
add_action( 'admin_enqueue_scripts', 'dalmatian_blog_enqueue_custom_admin_style' );