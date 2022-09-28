<?php
if( ! function_exists( 'fameup_register_custom_controls' ) ) :
/**
 * Register Custom Controls
*/
function fameup_register_custom_controls( $wp_customize ) {

    require_once get_template_directory() . '/inc/ansar/custom-control/toggle/class-toggle-control.php';
    require_once get_template_directory() . '/inc/ansar/custom-control/customizer-alpha-color-picker/class-fameup-customize-alpha-color-control.php';

    require_once  get_template_directory() . '/inc/ansar/custom-control/custom_tab_control/custom_tab_control_class.php';
	$wp_customize->register_control_type( 'fameup_Toggle_Control' );

}
endif;
add_action( 'customize_register', 'fameup_register_custom_controls' );