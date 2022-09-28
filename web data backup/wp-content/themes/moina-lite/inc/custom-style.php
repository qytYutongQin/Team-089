<?php 
function moina_lite_custom_css() {
    wp_enqueue_style('moina-lite-custom', get_template_directory_uri() . '/assets/css/custom-lite-style.css' );
    $moina_lite_footer_background_color = get_theme_mod('moina_lite_footer_background_color','#F8F8F8'); 
    $moina_lite_custom_css = '';
    $moina_lite_custom_css .= '
        .footer-area {
            background-color: '.esc_attr( $moina_lite_footer_background_color ).' ;
        }
    '; 
    wp_add_inline_style( 'moina-lite-custom', $moina_lite_custom_css );
}
add_action( 'wp_enqueue_scripts', 'moina_lite_custom_css' );