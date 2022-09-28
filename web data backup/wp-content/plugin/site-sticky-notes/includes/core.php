<?php

function site_notes_register_post_type() {
	// notes custom post type
	$labels = array(
		'name'               => _x( 'Notes', 'post type general name', 'site-sticky-notes' ),
		'singular_name'      => _x( 'Note', 'post type singular name', 'site-sticky-notes' ),
		'add_new'            => _x( 'Add New Note', 'site_notes', 'site-sticky-notes' ),
		'add_new_item'       => __( 'Add New Note', 'site-sticky-notes' ),
		'edit_item'          => __( 'Edit Note', 'site-sticky-notes' ),
		'new_item'           => __( 'New Note', 'site-sticky-notes' ),
		'all_items'          => __( 'All Notes', 'site-sticky-notes' ),
		'view_item'          => __( 'View Note', 'site-sticky-notes' ),
		'search_items'       => __( 'Search Notes', 'site-sticky-notes' ),
		'not_found'          => __( 'No note found', 'site-sticky-notes' ),
		'not_found_in_trash' => __( 'No note found in the Trash', 'site-sticky-notes' ),
		'menu_name'          => __( 'Site Notes', 'site-sticky-notes' ),
	);
	$args = array(
		'labels'        => $labels,
		'description'   => __('Holds our notes and related data', 'site-sticky-notes' ),
		'public'        => true,
		'menu_position' => 20,
		'supports'      => array( 'title' ),
		'hierarchical'  => false,
		'has_archive'   => false,
		'exclude_from_search' => true,
	);
	register_post_type( 'site_notes', $args ); // post type name max 20 characters
	flush_rewrite_rules();
}
add_action( 'init', 'site_notes_register_post_type' );


function site_notes_updated_messages( $messages ) {
	global $post, $post_ID;
	$messages['site_notes'] = array(
		0 => '', 
		1 => sprintf( __('Note updated. <a href="%s">View</a>' , 'site-sticky-notes'), esc_url( get_permalink($post_ID) ) ),
		2 => __('Custom field updated.', 'site-sticky-notes'),
		3 => __('Custom field deleted.', 'site-sticky-notes'),
		4 => __('Note updated.', 'site-sticky-notes'),
		5 => isset($_GET['revision']) ? sprintf( __('Note restored to revision from %s', 'site-sticky-notes'), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
		6 => sprintf( __('Note published. <a href="%s">View</a>', 'site-sticky-notes'), esc_url( get_permalink($post_ID) ) ),
		7 => __('Note saved.', 'site-sticky-notes'),
		8 => sprintf( __('Note submitted. <a target="_blank" href="%s">Preview</a>', 'site-sticky-notes'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
		9 => sprintf( __('Note scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview</a>', 'site-sticky-notes'), date_i18n( __( 'M j, Y @ G:i', 'site-sticky-notes' ), strtotime( $post->post_date ) ), esc_url( get_permalink($post_ID) ) ),
		10 => sprintf( __('Note draft updated. <a target="_blank" href="%s">Preview</a>', 'site-sticky-notes'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
	);

	return $messages;
}
add_filter( 'post_updated_messages', 'site_notes_updated_messages' );

function site_notes_load_script() {
	wp_register_style( 'site_notes_style', SITE_NOTES_URL.'assets/css/site-notes.css', false, '1.0' );
	wp_enqueue_style( 'site_notes_style' );
	wp_enqueue_style( 'dashicons' );
	
}
add_action( 'wp_enqueue_scripts', 'site_notes_load_script', 9);

function site_notes_load_script_footer() {

	wp_register_script( 'site_notes_script', SITE_NOTES_URL.'assets/js/site-notes.js', array( 'jquery', 'jquery-ui-draggable' ), '1.0' );

	wp_localize_script( 'site_notes_script', 'ajax_object', array(
            'ajax_url'   => admin_url( 'admin-ajax.php' )
        )
    );

	wp_enqueue_script( 'site_notes_script' );
}
add_action( 'wp_footer', 'site_notes_load_script_footer', 9);

function site_notes_adminbar_button( $wp_admin_bar ) {
	if( !is_admin() ) {
		$args = array(
			'id' => 'site-notes-adminbar-button',
			'title' => 'Add Note',
			'href' => 'javascript:void(0);',
			'meta' => array(
				'class' => 'site_notes_adminbar_button',
				'onclick' => 'us.asnotes.editnotes.newNote( event );',
			)
		);
		$wp_admin_bar->add_node($args);
	}
}
add_action('admin_bar_menu', 'site_notes_adminbar_button', 50);

function site_notes_page_setup() {
	global $post, $cat;

	$show_public = get_option('site_notes_show_public');
	$show_notes = $show_public == 1 ? true : ( is_user_logged_in() ? true : false );

	if( !is_admin() ) {
		if( $show_notes ) {
			_e( '<div id="site_notes" data-page-url="' . esc_attr($_SERVER['REQUEST_URI']) . '">' );
			_e( site_notes_get_notes_html( array('url' => $_SERVER['REQUEST_URI']) ) );
			_e( '</div>');
		}
	}
}
add_action('wp_footer', 'site_notes_page_setup', 100);


/**

	  SSS  EEEEE  TTTTT  TTTTT  IIIII  NN  N   GGGG    SSS
	SS     E__      T      T      I    N N N  G      SS
	  SSS  E        T      T      I    N  NN  G  GG    SSS
	SS     EEEEE    T      T    IIIII  N   N  GGGGG  SS

*/

function site_notes_register_settings() {
	add_option( 'site_notes_show_public', '0');

	register_setting( 'site_notes_settings', 'site_notes_show_public' ); 
} 
add_action( 'admin_init', 'site_notes_register_settings' );

function site_notes_register_options_page() {
	add_submenu_page('edit.php?post_type=site_notes', 'Settings', 'Settings', 'manage_options', 'site_notes-options', 'site_notes_options_page');
}
add_action('admin_menu', 'site_notes_register_options_page');

function site_notes_options_page() {
	?>

	<div class="wrap">
		<h2><?php _e('StickyNotate Settings', 'site-sticky-notes'); ?></h2>

		<form method="post" action="options.php">
			<?php

			settings_fields( 'site_notes_settings' );
			do_settings_sections( 'site_notes_settings' );

			$show_public = get_option('site_notes_show_public');

			?>

			<table class="form-table">
				<tr valign="top">
					<th scope="row"><?php _e('Show notes to public/non-signed in users?', 'site-sticky-notes'); ?></th>
					<td>
						<input id="site_notes_show_public_yes" type="radio" name="site_notes_show_public" value="1"<?php if( $show_public == 1 ): ?> checked<?php endif; ?> /> <label for="site_notes_show_public_yes"><?php _e('Yes', 'site-sticky-notes'); ?></label>
						&nbsp;
						<input id="site_notes_show_public_no" type="radio" name="site_notes_show_public" value="0"<?php if( $show_public == 0 ): ?> checked<?php endif; ?> /> <label for="site_notes_show_public_no"><?php _e('No', 'site-sticky-notes'); ?></label>
					</td>
				</tr>
			</table>

			<?php submit_button(); ?>
		</form>
	</div>

	<?php
}


/**

	DDDD    AAA   TTTTT   AAA
	D   D  A   A    T    A   A
	D   D  AAAAA    T    AAAAA
	DDDD   A   A    T    A   A

*/
function site_notes_get_notes( $opts=array() ) {
	$args = array(
		'post_type' => 'site_notes',
		'posts_per_page' => -1,
		'post_status' => 'publish',
	);
	if( isset($opts["note_id"]) && is_numeric($opts["note_id"]) ) {
		$args['p'] = $opts["note_id"];
	}
	if( isset($opts["url"]) ) {
		$args['meta_query'] = array(
			array(
				'key'     => '_site_notes_page_url',
				'compare' => '=',
				'value'   => $opts["url"],
			),
		);
	}
	$query = new WP_Query( $args );

	if( $query->have_posts() ) {
		$notes = $query->get_posts();

		foreach( $notes AS $key => $note ) {
			$notes[$key]->priority = get_post_meta( $note->ID, '_site_notes_priority', true );
			$notes[$key]->top_offset = get_post_meta( $note->ID, '_site_notes_top_offset', true );
			$notes[$key]->center_offset = get_post_meta( $note->ID, '_site_notes_center_offset', true );
		}

		return $notes;
	} else {
		return false;
	}
}

function site_notes_get_notes_html( $opts=array() ) {
	$notes = site_notes_get_notes( $opts );
	$html = '';
	$priority = array( 'low', 'med', 'high' );
	$user_is_admin = current_user_can( 'manage_options' );

	if( $notes ) {
		foreach( $notes AS $note ) {
			$priority_id = array_search($note->priority, $priority);

			$html .= '<div id="site_notes_note_' . $note->ID . '" ';
			$html .= 'class="note ' . $note->priority . ( !$user_is_admin ? ' tight' : '' ) . '" ';
			$html .= 'style="z-index:100000; left: 50%; margin-left: ' . ($note->center_offset-115) . 'px; top: ' . $note->top_offset . 'px;" ';
			if( $user_is_admin ) {
				$html .= 'data-note-id="' . $note->ID . '" ';
				$html .= 'data-center-offset="' . $note->center_offset . '" ';
				$html .= 'data-top-offset="' . $note->top_offset . '" ';
				$html .= 'data-priority-id="' . $priority_id . '" ';
			}
			$html .= '>';
			$html .= '<div class="rte"' . ( $user_is_admin ? ' contenteditable="true"' : '' ) . '>' . __($note->post_title,'site-sticky-notes') . '</div>';
			$html .= '<div class="icon move"></div>';
			if( $user_is_admin ) {
				$html .= '<div class="icon color" title="Toggle Note"></div>';
				$html .= '<div class="icon delete" title="Delete note"></div>';
				$html .= '<div class="icon save" title="Save note"></div>';
			}
			$html .= '</div>';
		}
	}

	return $html;
}


/**

	M   M  IIIII    SSS   CCCC
	MM MM    I    SS     C    
	M M M    I      SSS  C    
	M   M  IIIII  SS      CCCC

*/
function is_site_notes_post( $post ) {
	return ( is_object($post) && isset($post->post_type) && $post->post_type === 'site_notes' );
}

?>