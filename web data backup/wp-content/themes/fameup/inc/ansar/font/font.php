<?php
/*--------------------------------------------------------------------*/
/*     Register Google Fonts
/*--------------------------------------------------------------------*/
function fameup_fonts_url() {
	
    $fonts_url = '';
		
    $font_families = array();
 
	$font_families = array('Vollkorn:400,500,700,800,900','Karla: 200,300,400,500,600,700,800&display=swap');
 
        $query_args = array(
            'family' => urlencode( implode( '|', $font_families ) ),
            'subset' => urlencode( 'latin,latin-ext' ),
        );
 
        $fonts_url = add_query_arg( $query_args, '//fonts.googleapis.com/css' );

    return $fonts_url;
}
function fameup_scripts_styles() {
    wp_enqueue_style( 'fameup-fonts', fameup_fonts_url(), array(), null );
}
add_action( 'wp_enqueue_scripts', 'fameup_scripts_styles' );


/*--------------------------------------------------------------------*/
/*     Register All Google Fonts
/*--------------------------------------------------------------------*/
function fameup_google_fonts_url() {
    
    $fonts_url = '';
        
    $font_families = fameup_typo_fonts();
 
    $font_families = array('Volkhov', 'Open Sans', 'Kalam', 'Lato', 'Roboto');
 
        $query_args = array(
            'family' => urlencode( implode( '|', $font_families ) ),
            'subset' => urlencode( 'latin,latin-ext' ),
        );
 
        $fonts_url = add_query_arg( $query_args, '//fonts.googleapis.com/css' );

    return $fonts_url;
}
function fameup_google_font_scripts_styles() {
    wp_enqueue_style( 'fameup-google-fonts', fameup_google_fonts_url(), array(), null );
}
add_action( 'wp_enqueue_scripts', 'fameup_google_font_scripts_styles');


/* Typography Fonts */
if (!function_exists('fameup_typo_fonts')) {

    function fameup_typo_fonts() {
        return array('Volkhov' => 'Volkhov', 'Open Sans' => 'Open Sans', 'Kalam' => 'Kalam', 'Lato' => 'Lato', 'Roboto' => 'Roboto');
    }

}