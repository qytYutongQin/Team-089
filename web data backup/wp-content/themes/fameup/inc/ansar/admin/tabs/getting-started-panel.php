<?php
/**
 * Getting Started Panel.
 *
 * @package Fameup
 */
?>
<div id="getting-started-panel" class="panel-left visible">
    <div class="panel-aside panel-column">
        <h4><?php esc_html_e( 'Demo Content', 'fameup' ); ?></h4>
		<a class="recommended-actions hyperlink" href="#actions"><?php esc_html_e( 'Demo Content', 'fameup' ); ?></a>
    </div> 
    <div class="panel-aside panel-column">
        <h4><?php esc_html_e( 'Fameup Documentation', 'fameup' ); ?></h4>
        <a href="<?php echo esc_url( 'https://docs.themeansar.com/docs/fameup/' ); ?>" class="hyperlink" title="<?php esc_attr_e( 'Fameup Support', 'fameup' ); ?>" target="_blank"><?php esc_html_e( 'Documentation', 'fameup' ); ?></a>
    </div>
   <div class="panel-aside panel-column">
        <h4><?php esc_html_e( 'Go to the Customizer', 'fameup' ); ?></h4>
        <a class="button button-primary" target="_blank" href="<?php echo esc_url( admin_url( 'customize.php' ) ); ?>" title="<?php esc_attr_e( 'Visit the Support', 'fameup' ); ?>"><?php esc_html_e( 'Go to the Customizer', 'fameup' ); ?></a>
    </div>
</div>