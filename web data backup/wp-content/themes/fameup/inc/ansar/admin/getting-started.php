<?php
/**
 * Getting Started Page. 
 *
 * @package Fameup
 */
require get_template_directory() . '/inc/ansar/admin/class-getting-start-plugin-helper.php';


// Adding Getting Started Page in admin menu

if( ! function_exists( 'fameup_getting_started_menu' ) ) :
function fameup_getting_started_menu() {	
		$plugin_count = null;
		
	    /* translators: %1$s %2$s: about */		
		$title = sprintf(esc_html__('About %1$s %2$s', 'fameup'), esc_html( FAMEUP_THEME_NAME ), $plugin_count);
		/* translators: %1$s: welcome page */	
		add_theme_page(sprintf(esc_html__('Welcome to %1$s', 'fameup'), esc_html( FAMEUP_THEME_NAME ), esc_html(FAMEUP_THEME_VERSION)), $title, 'edit_theme_options', 'fameup-getting-started', 'fameup_getting_started_page');
}
endif;
add_action( 'admin_menu', 'fameup_getting_started_menu' );

// Load Getting Started styles in the admin
if( ! function_exists( 'fameup_getting_started_admin_scripts' ) ) :
function fameup_getting_started_admin_scripts( $hook ){
	// Load styles only on our page
	if( 'appearance_page_fameup-getting-started' != $hook ) return;

    wp_enqueue_style( 'fameup-getting-started', get_template_directory_uri() . '/inc/ansar/admin/css/getting-started.css', false, FAMEUP_THEME_VERSION );
    wp_enqueue_script( 'plugin-install' );
    wp_enqueue_script( 'updates' );
    wp_enqueue_script( 'fameup-getting-started', get_template_directory_uri() . '/inc/ansar/admin/js/getting-started.js', array( 'jquery' ), FAMEUP_THEME_VERSION, true );
    wp_enqueue_script( 'fameup-recommended-plugin-install', get_template_directory_uri() . '/inc/ansar/admin/js/recommended-plugin-install.js', array( 'jquery' ), FAMEUP_THEME_VERSION, true );    
    wp_localize_script( 'fameup-recommended-plugin-install', 'fameup_start_page', array( 'activating' => __( 'Activating ', 'fameup' ) ) );
}
endif;
add_action( 'admin_enqueue_scripts', 'fameup_getting_started_admin_scripts' );


// Plugin API
if( ! function_exists( 'fameup_call_plugin_api' ) ) :
function fameup_call_plugin_api( $slug ) {
	require_once ABSPATH . 'wp-admin/includes/plugin-install.php';
		$call_api = get_transient( 'fameup_about_plugin_info_' . $slug );

		if ( false === $call_api ) {
				$call_api = plugins_api(
					'plugin_information', array(
						'slug'   => $slug,
						'fields' => array(
							'downloaded'        => false,
							'rating'            => false,
							'description'       => false,
							'short_description' => true,
							'donate_link'       => false,
							'tags'              => false,
							'sections'          => true,
							'homepage'          => true,
							'added'             => false,
							'last_updated'      => false,
							'compatibility'     => false,
							'tested'            => false,
							'requires'          => false,
							'downloadlink'      => false,
							'icons'             => true,
						),
					)
				);
				set_transient( 'fameup_about_plugin_info_' . $slug, $call_api, 30 * MINUTE_IN_SECONDS );
			}

			return $call_api;
		}
endif;

// Callback function for admin page.
if( ! function_exists( 'fameup_getting_started_page' ) ) :
function fameup_getting_started_page() { ?>
	<div class="wrap getting-started">
		<h2 class="notices"></h2>
		<div class="intro-wrap">
			<div class="intro">
				<h3>
				<?php 
				/* translators: %1$s %2$s: welcome message */	
				printf( esc_html__( 'Welcome to %1$s - Version %2$s', 'fameup' ), esc_html( FAMEUP_THEME_NAME ), esc_html( FAMEUP_THEME_VERSION ) ); ?></h3>
				<p><?php esc_html_e( 'Fameup is a fast, clean, modern-looking Best Responsive Blog, News, Magazine WordPress theme. The theme is fully widgetized, so users can manage the content by using easy to use widgets. Fameup is suitable for dynamic blog, news, newspapers, magazine, publishers, blogs, editors, online and gaming magazines, newsportals,personal blogs, newspaper, publishing or review siteand any creative website. Fameup is SEO friendly, WPML,Elementor,Gutenberg, translation and RTL ready. Live preview : https://demos.themeansar.com/fameup-demos/ and documentation at https://docs.themeansar.com/docs/fameup/', 'fameup' ); ?></p>
			</div>
			<div class="intro right">
				<a target="_blank" href="https://themeansar.com/"><img src="<?php echo esc_url(get_template_directory_uri());  ?>/inc/ansar/admin/images/logo.png"></a>
			</div>
		</div>
		<div class="panels">
			<ul class="inline-list">
			    <li class="current">
					<a id="getting-started-panel" href="#">
						<?php esc_html_e( 'Getting Started', 'fameup' ); ?>
					</a>
				</li>

				<li class="recommended-plugins-active">
					<a id="plugins" href="#">
						<?php esc_html_e( 'Demo Content', 'fameup' ); ?>
					</a>
				</li>
				
				<li>
                	<a id="useful-plugin-panel" href="#">
						<?php esc_html_e( 'Useful Plugins', 'fameup' ); ?>
					</a>
				</li>
				
			</ul>
			<div id="panel" class="panel">
				<?php require get_template_directory() . '/inc/ansar/admin/tabs/getting-started-panel.php'; ?>
				<?php require get_template_directory() . '/inc/ansar/admin/tabs/recommended-plugins-panel.php'; ?>
				<?php require get_template_directory() . '/inc/ansar/admin/tabs/useful-plugin-panel.php'; ?>
			</div>
			<div class="panel">
				<div class="panel-aside panel-column w-50">
					<h4><?php esc_html_e( 'Fameup Theme Support', 'fameup' ); ?></h4>
					<a class="button button-primary" target="_blank" href="//wordpress.org/support/theme/fameup/" title="<?php esc_attr_e( 'Get Support', 'fameup' ); ?>"><?php esc_html_e( 'Get Support', 'fameup' ); ?></a>
				</div>
			   <div class="panel-aside panel-column w-50">
					<h4><?php esc_html_e( 'Your feedback is valuable to us', 'fameup' ); ?></h4>
					<a class="button button-primary" target="_blank" href="//wordpress.org/support/theme/fameup/reviews/#new-post" title="<?php esc_attr_e( 'Submit a review', 'fameup' ); ?>"><?php esc_html_e( 'Submit a review', 'fameup' ); ?></a>
				</div>
			</div>
		</div>
	</div>
	<?php
}
endif;


/**
 * Admin notice 
 */
class fameup_screen {
 	public function __construct() {
		/* notice  Lines*/
		add_action( 'load-themes.php', array( $this, 'fameup_activation_admin_notice' ) );
	}
	public function fameup_activation_admin_notice() {
		global $pagenow;

		if ( is_admin() && ('themes.php' == $pagenow) && isset( $_GET['activated'] ) ) {
			add_action( 'admin_notices', array( $this, 'fameup_admin_notice' ), 99 );
		}
	}
	/**
	 * Display an admin notice linking to the welcome screen
	 * @sfunctionse 1.8.2.4
	 */
	public function fameup_admin_notice() {
		?>			
		<div class="updated notice is-dismissible fameup-notice">
			<h1><?php
			$theme_info = wp_get_theme();
			printf( esc_html__('Congratulations, Welcome to %1$s Theme', 'fameup'), esc_html( $theme_info->Name ), esc_html( $theme_info->Version ) ); ?>
			</h1>
			<p><?php echo sprintf( esc_html__("Thank you for choosing Fameup theme. To take full advantage of the complete features of the theme, you have to go to our %1\$s welcome page %2\$s.", "fameup"), '<a href="' . esc_url( admin_url( 'themes.php?page=fameup-getting-started' ) ) . '">', '</a>' ); ?></p>
			
			<p><a href="<?php echo esc_url( admin_url( 'themes.php?page=fameup-getting-started' ) ); ?>" class="button button-blue-secondary button_info" style="text-decoration: none;"><?php echo esc_html__('Get started with Fameup','fameup'); ?></a></p>
		</div>
		<?php
	}
	
}
$GLOBALS['fameup_screen'] = new fameup_screen();