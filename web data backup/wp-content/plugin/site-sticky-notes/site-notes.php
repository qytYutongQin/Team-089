<?php

/*
Plugin Name: Site Sticky Notes
Description: Click and add a note anywhere on your site.
Version: 1.2.0
Author: Kegan Quimby
Author URI: keganquimby.com
Text Domain: site-sticky-notes
*/

if( ! defined( 'ABSPATH' ) ){
	die();
}

define( 'SITE_NOTES_DIR', plugin_dir_path(__FILE__) ); // USAGE: SITE_NOTES_DIR.'assets/img/image.jpg'
define( 'SITE_NOTES_URL', plugin_dir_url(__FILE__) );


// Load files
function site_notes_load() {
	if( is_admin() ) { // load admin files only in admin
		require_once(SITE_NOTES_DIR.'includes/admin.php');
	}

	require_once(SITE_NOTES_DIR.'includes/core.php');
}
site_notes_load();
// END Load files

?>