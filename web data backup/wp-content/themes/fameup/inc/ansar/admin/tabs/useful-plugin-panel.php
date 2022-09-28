<?php
/**
 * Useful Plugin Panel
 *
 * @package Fameup
 */
?>
<div id="useful-plugin-panel" class="panel-left">
	<?php 
	$fameup_free_plugins = array(
		'contact-form-7' => array(
		    'name'      => 'Contact form 7',
			'slug'     	=> 'contact-form-7',
			'filename' 	=> 'contact-form-7.php',
		),
		'woocommerce' => array(
		    'name'     	=> 'Woocommerce',
			'slug'     	=> 'woocommerce',
			'filename' 	=> 'woocommerce.php',
		),
		'elementor' => array(
		    'name'     	=> 'Elementor',
			'slug'     	=> 'elementor',
			'filename' 	=> 'elementor.php',
		),
	);
	if( !empty( $fameup_free_plugins ) ) { ?>
		<div class="recomended-plugin-wrap">
		<?php
		foreach( $fameup_free_plugins as $fameup_plugin ) {
			$info 		= fameup_call_plugin_api( $fameup_plugin['slug'] ); ?>
			<div class="recom-plugin-wrap w-3-col">
				<div class="plugin-title-install clearfix">
					<span class="title" title="<?php echo esc_attr( $plugin['name'] ); ?>">
						<?php echo esc_html( $fameup_plugin['name'] ); ?>	
					</span>
					<?php if($fameup_plugin['slug'] == 'contact-form-7') : ?>
					<p><?php esc_html_e('To display the contact form, please install the Contact Form 7 plugin.', 'fameup'); ?></p>
					<?php endif; ?>
					
					<?php if($fameup_plugin['slug'] == 'woocommerce') : ?>
					<p><?php esc_html_e('To display the Woocommerce layout, please install the Woocommerce plugin.', 'fameup'); ?></p>
					<?php endif; ?>
					
				    <?php if($fameup_plugin['slug'] == 'elementor') : ?>
					<p><?php esc_html_e('To use the Elementor layouts and pages, install the Elementor plugin.', 'fameup'); ?></p>
					<?php endif; ?>	
					<?php 
					echo '<div class="button-wrap">';
					echo Fameup_Getting_Started_Page_Plugin_Helper::instance()->get_button_html( $fameup_plugin['slug'] );
					echo '</div>';
					?>
				</div>
			</div>
			</br>
			<?php
		} ?>
		</div>
	<?php
	} ?>
</div>