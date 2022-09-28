<?php

function site_notes_admin_load_script() {
	wp_enqueue_style(' google-fonts', '//fonts.googleapis.com/css?family=Open+Sans:400,400i,700,700i|Open+Sans+Condensed:300|PT+Sans:400,400i,700,700i|Droid+Serif:400,400i,700,700i|Source+Serif+Pro:400,600,700');
	
	wp_register_style( 'site_notes_admin_style', SITE_NOTES_URL.'assets/css/site-notes-admin.css', false, '1.0' );
	wp_enqueue_style( 'site_notes_admin_style' );

	wp_register_script( 'site_notes_admin_script', SITE_NOTES_URL.'assets/js/site-notes-admin.js', false, '1.1' );
	

	wp_enqueue_script( 'site_notes_admin_script' );
}
add_action( 'admin_enqueue_scripts', 'site_notes_admin_load_script', 10 );

/* register menu item */
function site_notes_admin_menu_setup() {
	// setup custom admin menu
	remove_submenu_page('edit.php?post_type=site_notes', 'post-new.php?post_type=site_notes');
}
add_action('admin_menu', 'site_notes_admin_menu_setup'); //menu setup


// adjust columns for hero_slider post type
add_filter('manage_site_notes_posts_columns', 'site_notes_admin_columns');
function site_notes_admin_columns( $columns ) {
	$new = array();
	foreach( $columns as $key => $title ) {
		$new[$key] = $title;

		if( $key == 'title' ) { // Put new column after Title column
			$new['note_url'] = 'Related Page';
			$new['priority'] = 'Priority';
		}
	}
	return $new;
}

add_action('manage_site_notes_posts_custom_column', 'site_notes_admin_show_columns');
function site_notes_admin_show_columns($name) {
	global $post;
	
	$page_url = get_post_meta( $post->ID, '_site_notes_page_url', true );
	$params_page_url = explode('/', $page_url);
	switch ($name) {
		case 'note_url':
			_e(' <a href="' . esc_url($page_url. '#site_notes_note_' . $post->ID)  . '" class="site_notes_admin_view" title="View related page"></a>', 'site-sticky-notes');
		break;

		case 'priority':
			$priority = get_post_meta( $post->ID, '_site_notes_priority', true );
			_e('<div class="site_notes_admin_priority ' . $priority . '" title="' . ucwords($priority) . '"></div>', 'site-sticky-notes');
		break;
	}
}

// add actions to admin notes list
function site_notes_row_actions( $actions, $post ) {
	if( is_site_notes_post( $post ) ) {
		unset($actions['view']);
		unset($actions['inline hide-if-no-js']);
	}
	return $actions;
}
add_filter( 'post_row_actions', 'site_notes_row_actions', 10, 2);
add_filter( 'page_row_actions', 'site_notes_row_actions', 10, 2);

add_action( 'admin_head-edit.php', 'site_notes_change_title_in_list');
function site_notes_change_title_in_list() {
	global $post_type;

	if( 'site_notes' != $post_type ) {
		return;
	}

	add_filter( 'the_title', 'site_notes_construct_new_title', 100, 2 );
}
function site_notes_construct_new_title( $title, $id ) {
	return str_replace("\n ", "<br>\n ", strip_tags( str_replace(array("<br />", "</div>"), "\n ", htmlspecialchars_decode($title)) ));
}


/**

	 AAA   JJJJJ   AAA   X   X
	A   A     J   A   A   X_X
	AAAAA     J   AAAAA   X X
	A   A  JJJ    A   A  X   X

*/
add_action('wp_ajax_site_notes_ajax_new_note', 'site_notes_ajax_new_note');
add_action('wp_ajax_nopriv_site_notes_ajax_new_note', 'site_notes_ajax_new_note');
function site_notes_ajax_new_note() {
	// create new note post
	$args = array(
		'post_type' => 'site_notes',
		'post_title' => 'Note text here...',
		'post_content' => '',
		'post_author' => get_current_user_id(),
		'post_date_gmt' => date("Y-m-d H:i:s"),
		'post_status' => 'publish',
	);

	$note_id = wp_insert_post( $args );

	update_post_meta( $note_id, '_site_notes_page_url', sanitize_text_field($_REQUEST['url']) );
	update_post_meta( $note_id, '_site_notes_priority', 'med' );
	update_post_meta( $note_id, '_site_notes_top_offset', '64' );
	update_post_meta( $note_id, '_site_notes_center_offset', '0' );

	_e(site_notes_get_notes_html( array("note_id" => $note_id) ));
	wp_die();
}


add_action('wp_ajax_site_notes_ajax_save_note', 'site_notes_ajax_save_note');
add_action('wp_ajax_nopriv_site_notes_ajax_save_note', 'site_notes_ajax_save_note');
function site_notes_ajax_save_note() {
	$priority = array( 'low', 'med', 'high' );

	$note_id = sanitize_text_field($_REQUEST["note_id"]);
	$args = array(
		'ID' => $note_id,
		'post_title' => sanitize_text_field($_REQUEST["note_text"]),
	);

	wp_update_post( $args );

	update_post_meta( $note_id, '_site_notes_top_offset', sanitize_text_field($_REQUEST["top_offset"]) );
	update_post_meta( $note_id, '_site_notes_center_offset', sanitize_text_field($_REQUEST["center_offset"]) );
	update_post_meta( $note_id, '_site_notes_priority', sanitize_text_field($priority[$_REQUEST["priority"]]) );

	exit;
}


add_action('wp_ajax_site_notes_ajax_delete_note', 'site_notes_ajax_delete_note');
add_action('wp_ajax_nopriv_site_notes_ajax_delete_note', 'site_notes_ajax_delete_note');
function site_notes_ajax_delete_note() {


	$note_id = sanitize_text_field($_REQUEST["note_id"]);

	wp_delete_post( $note_id );

	exit;
}
/**

	M   M  EEEEE  TTTTT   AAA
	MM MM  E__      T    A   A
	M M M  E        T    AAAAA
	M   M  EEEEE    T    A   A

*/
add_action( 'add_meta_boxes', 'site_notes_options_boxes' );
function site_notes_options_boxes() {

	add_meta_box( 
		'site_notes_options_box',
		__( '&nbsp;', 'site-sticky-notes' ),
		'site_notes_options_box_content',
		'site_notes',
		'normal',
		'core'
	);

}

add_filter('gettext', 'site_notes_custom_enter_title');
function site_notes_custom_enter_title( $input ) {
	global $post_type;

	if( is_admin() && 'Enter title here' == $input && 'site_notes' == $post_type )
		return __('Note text...', 'site-sticky-notes');

	return $input;
}

function site_notes_options_box_content( $post ) {
	wp_nonce_field( plugin_basename( __FILE__ ), 'site_notes_options_box_content_nonce' );

	$page_url = get_post_meta( $post->ID, '_site_notes_page_url', true );
	$params_page_url = explode('/', $page_url);
	echo $page_url;

	_e('<table class="form-table">','site-sticky-notes');  
	_e('	<tr>','site-sticky-notes');
	_e('		<th><label for="site_notes_page_url">Related Page</label></th>','site-sticky-notes');
	_e('		<td><a href="' . esc_url($page_url. '#site_notes_note_' . $post->ID) . '">' . __('Visit','site-sticky-notes') . '</a></td>','site-sticky-notes');
	_e('	</tr>','site-sticky-notes');
	_e('</table>','site-sticky-notes');
}


/**

	  SSS   AAA   V   V  EEEEE
	SS     A   A   V V   E__
	  SSS  AAAAA   V V   E
	SS     A   A    V    EEEEE

*/
add_action( 'save_post', 'site_notes_options_box_save' );
function site_notes_options_box_save( $post_id ) {
	if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) { return; }
	if( !isset($_POST['site_notes_options_box_content_nonce']) || !wp_verify_nonce($_POST['site_notes_options_box_content_nonce'], plugin_basename( __FILE__ )) ) { return; }
}

?>