<?php

add_action( 'customize_register', 'dalmatian_blog_register_post_detail_customization_section' );
function dalmatian_blog_register_post_detail_customization_section( $wp_customize ) {

	$wp_customize->add_section( 'dalmatian_blog_post_detail_customization_section', array(
	    'title'	=> esc_html__( 'Post Detail', 'dalmatian-blog' ),
	    'priority'	=> 23
	) );

}


/* Add Default General Settings for Customizer Settings */
require dirname( __FILE__ ) . '/default-post-detail.php';

require dirname( __FILE__ ) . '/featured-image/featured-image.php';

require dirname( __FILE__ ) . '/date/date.php';

require dirname( __FILE__ ) . '/author/author.php';

require dirname( __FILE__ ) . '/comment/comment.php';

require dirname( __FILE__ ) . '/category/category.php';

require dirname( __FILE__ ) . '/tag/tag.php';

require dirname( __FILE__ ) . '/author-block/author-block.php';

require dirname( __FILE__ ) . '/related-articles/related-articles.php';

require dirname( __FILE__ ) . '/share/social-share.php';