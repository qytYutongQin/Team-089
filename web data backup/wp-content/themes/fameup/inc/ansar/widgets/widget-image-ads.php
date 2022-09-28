<?php add_action('admin_enqueue_scripts', 'fameup_image_widget_scripts');

function fameup_image_widget_scripts() {    

    wp_enqueue_media();

    wp_enqueue_script('news_image_widget_script', get_template_directory_uri() . '/js/widget-image.js', false, '1.0', true);

}

class Fameup_Image_Ads extends WP_Widget {  



    public function __construct() {
        parent::__construct(
            'fameup-image-widget',
            __( 'AR: Image Ads', 'fameup' )
        );
    }

    function widget($args, $instance) {

        extract($args);

        echo $before_widget;
        
        $fameup_btnone_target = '_self';
        if( !empty($instance['open_btnone_new_window']) ):
            $fameup_btnone_target = '_blank';
        endif;
        ?>
            <?php if( !empty($instance['image_uri']) ): ?>
                    
                    <div class="bs-ads-area">
                            <?php if ( !empty($instance['btnonelink']) ) { ?>
                            <a href="<?php echo apply_filters('widget_title', $instance['btnonelink']); ?>" target="<?php echo esc_attr($fameup_btnone_target); ?>"><img src="<?php echo esc_url($instance['image_uri']); ?>" alt="<?php echo esc_attr(apply_filters('widget_title', $instance['image_uri'])); ?>" />
                            </a>
                            <?php } else { ?>
                                <img src="<?php echo esc_url($instance['image_uri']); ?>" alt="<?php echo apply_filters('widget_title', $instance['image_uri']); ?>" />
                          <?php } ?>
                    </div>
        <?php endif;

        echo $after_widget;

    }
    function update($new_instance, $old_instance) {

        $instance = $old_instance;
		$instance['btnonelink'] = stripslashes(wp_filter_post_kses($new_instance['btnonelink']));
        $instance['open_btnone_new_window'] = strip_tags($new_instance['open_btnone_new_window']);
		$instance['image_uri'] = strip_tags($new_instance['image_uri']);

        $businessup_btnone_target = '_self';
        if( !empty($instance['open_btnone_new_window']) ):
            $businessup_btnone_target = '_blank';
        endif;

        $businessup_btntwo_target = '_self';
        if( !empty($instance['open_btntwo_new_window']) ):
            $businessup_btntwo_target = '_blank';
        endif;

        return $instance;

    }

    function form($instance) {
    $instance['align'] = ( ! empty( $new_instance['align'] ) ) ? $new_instance['align'] : '';
    $align = esc_attr($instance['align']);
        ?>
            <p>
            <label for="<?php echo esc_attr($this->get_field_id('image_uri')); ?>"><?php esc_html_e('Image', 'fameup'); ?></label><br/>

            <?php

            if ( !empty($instance['image_uri']) ) :

                echo '<img class="custom_media_image_team" src="' . esc_url($instance['image_uri']) . '" style="margin:0;padding:0;max-width:100px;float:left;display:inline-block" alt="'.esc_html_e( 'Upload Image', 'fameup' ).'" /><br />';

            endif;

            ?>

            <input type="text" class="widefat custom_media_url_team" name="<?php echo $this->get_field_name('image_uri'); ?>" id="<?php echo esc_url($this->get_field_id('image_uri')); ?>" value="<?php if( !empty($instance['image_uri']) ): echo esc_url($instance['image_uri']); endif; ?>" style="margin-top:5px;">
            <input type="button" class="button button-primary custom_media_button_team" id="custom_media_button_team" name="<?php echo $this->get_field_name('image_uri'); ?>" value="<?php esc_attr_e('Upload Image','fameup'); ?>" style="margin-top:5px;">
        </p>
			
            
        <table>
			<tr>
                <td>
                    <label for="<?php echo esc_attr($this->get_field_id('btnonelink')); ?>"><?php esc_html_e('Link', 'fameup'); ?></label>
                </td>
            </tr>
            <tr>
                <td>
                    <input type="text" name="<?php echo esc_attr($this->get_field_name('btnonelink')); ?>" id="<?php echo esc_attr($this->get_field_id('btnonelink')); ?>" value="<?php if( !empty($instance['btnonelink']) ): echo esc_url($instance['btnonelink']); endif; ?>" class="widefat"/>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <input type="checkbox" name="<?php echo $this->get_field_name('open_btnone_new_window'); ?>" id="<?php echo $this->get_field_id('open_btnone_new_window'); ?>" <?php if( !empty($instance['open_btnone_new_window']) ): checked( (bool) $instance['open_btnone_new_window'], true ); endif; ?> ><?php esc_html_e( 'Open link in a new tab','fameup' ); ?>
                </td>
            </tr>
        </table>
    <?php

    }
}