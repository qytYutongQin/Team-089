<?php
/**
 * Fameup Theme Customizer
 *
 * @package Fameup
 */

if (!function_exists('fameup_get_option')):
/**
 * Get theme option.
 *
 * @since 1.0.0
 *
 * @param string $key Option key.
 * @return mixed Option value.
 */
function fameup_get_option($key) {

	if (empty($key)) {
		return;
	}

	$value = '';

	$default       = fameup_get_default_theme_options();
	$default_value = null;

	if (is_array($default) && isset($default[$key])) {
		$default_value = $default[$key];
	}

	if (null !== $default_value) {
		$value = get_theme_mod($key, $default_value);
	} else {
		$value = get_theme_mod($key);
	}

	return $value;
}
endif;

// Load customize default values.
require get_template_directory().'/inc/ansar/customize/customizer-callback.php';

// Load customize default values.
require get_template_directory().'/inc/ansar/customize/customizer-default.php';

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function fameup_customize_register($wp_customize) {

	// Load customize controls.
	require get_template_directory().'/inc/ansar/customize/customizer-control.php';

    // Load customize sanitize.
	require get_template_directory().'/inc/ansar/customize/customizer-sanitize.php';

	$wp_customize->get_setting('blogname')->transport         = 'postMessage';
	$wp_customize->get_setting('blogdescription')->transport  = 'postMessage';
	$wp_customize->get_setting('header_textcolor')->transport = 'postMessage';

	if (isset($wp_customize->selective_refresh)) {
		$wp_customize->selective_refresh->add_partial('blogname', array(
				'selector'        => '.site-title a',
				'render_callback' => 'fameup_customize_partial_blogname',
			));
		$wp_customize->selective_refresh->add_partial('blogdescription', array(
				'selector'        => '.site-description',
				'render_callback' => 'fameup_customize_partial_blogdescription',
			));


        $wp_customize->selective_refresh->add_partial('header_date_enable', array(
                'selector'        => '.top-date',
                'render_callback' => 'fameup_customize_partial_header_date_enable',
        ));


         $wp_customize->selective_refresh->add_partial('fameup_header_fb_link', array(
                'selector'        => '.bs-head-detail .bs-social li a',
                'render_callback' => 'fameup_customize_partial_fameup_header_fb_link',
        ));

        $wp_customize->selective_refresh->add_partial('fameup_footer_fb_link', array(
            'selector'        => '.bs-social li a',
        ));

        $wp_customize->selective_refresh->add_partial('breaking_news_title', array(
            'selector'        => '#content .trending-cls ',
        ));

        $wp_customize->selective_refresh->add_partial('fameup_scrollup_enable', array(
            'selector'        => '.scroll-main',
        ));

        $wp_customize->selective_refresh->add_partial('you_missed_title', array(
            'selector'        => '.missed .bg',
        ));

        $wp_customize->selective_refresh->add_partial('sidebar_menu', array(
                'selector'        => '.navbar-wp [data-bs-toggle=offcanvas]',
                'render_callback' => 'fameup_customize_partial_sidebar_menu',
        ));

        // $wp_customize->selective_refresh->add_partial('fameup_menu_subscriber', array(
        //         'selector'        => '.btn-subscribe',
        //         'render_callback' => 'fameup_customize_partial_fameup_menu_subscriber',
        // ));

        $wp_customize->selective_refresh->add_partial('fameup_menu_search', array(
                'selector'        => '.bs-default .desk-header .msearch',
                'render_callback' => 'fameup_customize_partial_fameup_menu_search',
        ));

         $wp_customize->selective_refresh->add_partial('fameup_lite_dark_switcher', array(
                'selector'        => 'header .desk-header',
                'render_callback' => 'fameup_customize_partial_fameup_lite_dark_switcher',
        ));

        
         

	}

    $default = fameup_get_default_theme_options();

	/*theme option panel info*/

	require get_template_directory().'/inc/ansar/customize/theme-options.php';

	/*theme general layout panel*/
	require get_template_directory().'/inc/ansar/customize/theme-layout.php';

	/*theme general layout panel*/
	require get_template_directory().'/inc/ansar/customize/frontpage-featured.php';

}
add_action('customize_register', 'fameup_customize_register');

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function fameup_customize_partial_blogname() {
	bloginfo('name');
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function fameup_customize_partial_blogdescription() {
	bloginfo('description');
}

function fameup_customize_partial_header_date_enable() {
    return get_theme_mod( 'header_date_enable' );
}


function fameup_customize_partial_header_social_icon_enable() {
    return get_theme_mod( 'fameup_header_social_icons' ); 
}

function fameup_customize_partial_footer_social_icon_enable() {
    return get_theme_mod( 'fameup_footer_social_icons' ); 
}


function fameup_customize_partial_sidebar_menu() {
    return get_theme_mod( 'sidebar_menu' ); 
}


function fameup_customize_partial_fameup_menu_subscriber() {
    return get_theme_mod( 'fameup_menu_subscriber' ); 
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function fameup_customize_preview_js() {
	wp_enqueue_script('fameup-customizer', get_template_directory_uri().'/js/customizer.js', array('customize-preview'), '20151215', true);
}
add_action('customize_preview_init', 'fameup_customize_preview_js');

/************************* Related Post Callback function *********************************/

    function fameup_rt_post_callback ( $control ) 
    {
        if( true == $control->manager->get_setting ('fameup_enable_related_post')->value()){
            return true;
        }
        else {
            return false;
        }       
    }

/************************* Theme Customizer with Sanitize function *********************************/
function fameup_theme_option( $wp_customize )
{
    function fameup_sanitize_text( $input ) {
        return wp_kses_post( force_balance_tags( $input ) );
    }

            /*--- Site title Font size **/
    $wp_customize->add_setting('fameup_title_font_size',
        array(
            'default'           => 100,
            'capability'        => 'edit_theme_options',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );

    $wp_customize->add_control('fameup_title_font_size',
        array(
            'label'    => esc_html__('Site Title Size', 'fameup'),
            'section'  => 'title_tagline',
            'type'     => 'number',
            'priority' => 50,
        )
    );

/*--- Get Site info control ---*/
$wp_customize->get_control( 'header_textcolor')->section = 'title_tagline';
}
add_action('customize_register','fameup_theme_option');