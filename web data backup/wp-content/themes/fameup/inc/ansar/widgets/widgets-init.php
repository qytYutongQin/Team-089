<?php

// Load widget base.
require_once get_template_directory() . '/inc/ansar/widgets/widgets-base.php';

/* Theme Widget sidebars. */
require get_template_directory() . '/inc/ansar/widgets/widgets-common-functions.php';

/* Theme Widgets*/
require get_template_directory() . '/inc/ansar/widgets/widget-posts-carousel.php';

require get_template_directory() . '/inc/ansar/widgets/widget-latest-news.php';
require get_template_directory() . '/inc/ansar/widgets/widget-posts-list.php';
require get_template_directory() . '/inc/ansar/widgets/widget-posts-slider.php';
require get_template_directory() . '/inc/ansar/widgets/widget-design-slider.php';
require get_template_directory() . '/inc/ansar/widgets/widget-author-info.php';
require get_template_directory() . '/inc/ansar/widgets/widget-image-ads.php';
require get_template_directory() . '/inc/ansar/widgets/widget-featured-post-widget.php';
require get_template_directory() . '/inc/ansar/widgets/widget-tab-widget.php';





/* Register site widgets */
if ( ! function_exists( 'fameup_widgets' ) ) :
    /**
     * Load widgets.
     *
     * @since 1.0.0
     */
    function fameup_widgets() {
        register_widget( 'Fameup_Posts_Carousel' );
        register_widget( 'Fameup_Latest_Post' );
        register_widget( 'Fameup_Posts_List' );
        register_widget( 'Fameup_Posts_Slider' );
        register_widget( 'Fameup_Design_Slider');
        register_widget( 'Fameup_author_info');
        register_widget( 'Fameup_Image_Ads');
    }
endif;
add_action( 'widgets_init', 'fameup_widgets' );



/**
 * Fameup Widgets - Loader.
 *
 * @package Fameup Widget
 * @since 1.0.0
 */

if ( ! class_exists( 'Fameup_Widgets_Loader' ) ) {

    /**
     * Customizer Initialization
     *
     * @since 1.0.0
     */
    class Fameup_Widgets_Loader {

        /**
         * Member Variable
         *
         * @var instance
         */
        private static $instance;

        /**
         *  Initiator
         */
        public static function get_instance() {
            if ( ! isset( self::$instance ) ) {
                self::$instance = new self;
            }
            return self::$instance;
        }

        /**
         *  Constructor
         */
        public function __construct() {


            // Add Widget.

             add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
             add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_admin_scripts' ) );
        }
        
        function enqueue_scripts() {    
                wp_enqueue_style('font-awesome',get_template_directory_uri() .'/css/font-awesome.min.css');
            }
            
        function enqueue_admin_scripts() {
             

    wp_enqueue_style( 'wp-color-picker');

    wp_enqueue_style('font-awesome',get_template_directory_uri() .'/css/font-awesome.min.css');
    
    wp_enqueue_script( 'wp-color-picker');

        }
         
    }
}

/**
*  Kicking this off by calling 'get_instance()' method
*/
Fameup_Widgets_Loader::get_instance();