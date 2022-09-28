<?php
/**
* GridMode Theme Customizer.
*
* @package GridMode WordPress Theme
* @copyright Copyright (C) 2022 ThemesDNA
* @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
* @author ThemesDNA <themesdna@gmail.com>
*/

if ( ! class_exists( 'WP_Customize_Control' ) ) {return NULL;}

/**
* GridMode_Customize_Static_Text_Control class
*/

class GridMode_Customize_Static_Text_Control extends WP_Customize_Control {
    public $type = 'gridmode-static-text';

    public function __construct( $manager, $id, $args = array() ) {
        parent::__construct( $manager, $id, $args );
    }

    protected function render_content() {
        if ( ! empty( $this->label ) ) :
            ?><span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span><?php
        endif;

        if ( ! empty( $this->description ) ) :
            ?><div class="description customize-control-description"><?php

        echo wp_kses_post( $this->description );

            ?></div><?php
        endif;

    }
}

/**
* GridMode_Customize_Button_Control class
*/

class GridMode_Customize_Button_Control extends WP_Customize_Control {
        public $type = 'gridmode-button';
        protected $button_tag = 'button';
        protected $button_class = 'button button-primary';
        protected $button_href = 'javascript:void(0)';
        protected $button_target = '';
        protected $button_onclick = '';
        protected $button_tag_id = '';

        public function render_content() {
        ?>
        <span class="center">
        <?php
        echo '<' . esc_html($this->button_tag);
        if (!empty($this->button_class)) {
            echo ' class="' . esc_attr($this->button_class) . '"';
        }
        if ('button' == $this->button_tag) {
            echo ' type="button"';
        }
        else {
            echo ' href="' . esc_url($this->button_href) . '"' . (empty($this->button_tag) ? '' : ' target="' . esc_attr($this->button_target) . '"');
        }
        if (!empty($this->button_onclick)) {
            echo ' onclick="' . esc_js($this->button_onclick) . '"';
        }
        if (!empty($this->button_tag_id)) {
            echo ' id="' . esc_attr($this->button_tag_id) . '"';
        }
        echo '>';
        echo esc_html($this->label);
        echo '</' . esc_html($this->button_tag) . '>';
        ?>
        </span>
        <?php
        }
}

/**
* GridMode_Customize_Submit_Control class
*/

class GridMode_Customize_Submit_Control extends WP_Customize_Control {
        public $type = 'gridmode-submit-button';
        protected $button_class = '';
        protected $button_id = '';
        protected $button_value = '';
        protected $button_onclick = '';

        public function render_content() {
        ?>
        <form action="customize.php" method="get">
        <label>
        <span style="font-weight:normal;margin-bottom:10px;" class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
        <?php
        echo '<input type="submit"';
        if (!empty($this->button_class)) {
            echo ' class="' . esc_attr($this->button_class) . '"';
        }
        if (!empty($this->button_id)) {
            echo ' name="' . esc_attr($this->button_id) . '"';
        }
        if (!empty($this->button_id)) {
            echo ' id="' . esc_attr($this->button_id) . '"';
        }
        if (!empty($this->button_value)) {
            echo ' value="' . esc_attr($this->button_value) . '"';
        }
        if (!empty($this->button_onclick)) {
            echo ' onclick="return confirm(\'' . esc_js($this->button_onclick) . '\');"';
        }
        echo '/>';
        ?>
        </label>
        </form>
        <?php
        }
}

/**
* Sanitize callback functions
*/

function gridmode_sanitize_checkbox( $input ) {
    return ( ( isset( $input ) && ( true == $input ) ) ? true : false );
}

function gridmode_sanitize_html( $input ) {
    return wp_kses_post( force_balance_tags( $input ) );
}

function gridmode_sanitize_yes_no( $input, $setting ) {
    $valid = array('yes','no');
    if ( in_array( $input, $valid ) ) {
        return $input;
    } else {
        return $setting->default;
    }
}

function gridmode_sanitize_post_summaries_style( $input, $setting ) {
    $valid = array('grid','non-grid');
    if ( in_array( $input, $valid ) ) {
        return $input;
    } else {
        return $setting->default;
    }
}

function gridmode_sanitize_posts_navigation_type( $input, $setting ) {
    $valid = array('normalnavi','numberednavi');
    if ( in_array( $input, $valid ) ) {
        return $input;
    } else {
        return $setting->default;
    }
}

function gridmode_sanitize_email( $input, $setting ) {
    if ( '' != $input && is_email( $input ) ) {
        $input = sanitize_email( $input );
        return $input;
    } else {
        return $setting->default;
    }
}

function gridmode_sanitize_logo_location( $input, $setting ) {
    $valid = array('beside-title','above-title');
    if ( in_array( $input, $valid ) ) {
        return $input;
    } else {
        return $setting->default;
    }
}

function gridmode_sanitize_secondary_menu_location( $input, $setting ) {
    $valid = array(
            'before-header' => esc_html__('Before Header', 'gridmode'),
            'after-header' => esc_html__('After Header', 'gridmode'),
            'before-footer' => esc_html__('Before Footer', 'gridmode'),
            'after-footer' => esc_html__( 'After Footer', 'gridmode' )
    );

    if ( array_key_exists( $input, $valid ) ) {
        return $input;
    } else {
        return $setting->default;
    }
}

function gridmode_sanitize_read_more_length( $input, $setting ) {
    $input = absint( $input ); // Force the value into non-negative integer.
    return ( 0 < $input ) ? $input : $setting->default;
}

function gridmode_sanitize_positive_integer( $input, $setting ) {
    $input = absint( $input ); // Force the value into non-negative integer.
    return ( 0 < $input ) ? $input : $setting->default;
}

function gridmode_sanitize_positive_float( $input, $setting ) {
    $input = (float) $input;
    return ( 0 < $input ) ? $input : $setting->default;
}

function gridmode_register_theme_customizer( $wp_customize ) {

    if(method_exists('WP_Customize_Manager', 'add_panel')):
    $wp_customize->add_panel('gridmode_main_options_panel', array( 'title' => esc_html__('Theme Options', 'gridmode'), 'priority' => 10, ));
    endif;

    $wp_customize->get_section( 'title_tagline' )->panel = 'gridmode_main_options_panel';
    $wp_customize->get_section( 'title_tagline' )->priority = 20;
    $wp_customize->get_section( 'header_image' )->panel = 'gridmode_main_options_panel';
    $wp_customize->get_section( 'header_image' )->priority = 26;
    $wp_customize->get_section( 'background_image' )->panel = 'gridmode_main_options_panel';
    $wp_customize->get_section( 'background_image' )->priority = 27;
    $wp_customize->get_section( 'colors' )->panel = 'gridmode_main_options_panel';
    $wp_customize->get_section( 'colors' )->priority = 40;
      
    $wp_customize->get_setting( 'blogname' )->transport = 'postMessage';
    $wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';
    $wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
    $wp_customize->get_setting( 'background_color' )->transport = 'postMessage';
    $wp_customize->get_control( 'background_color' )->description = esc_html__('To change Background Color, need to remove background image first:- go to Appearance : Customize : Theme Options : Background Image', 'gridmode');

    if ( isset( $wp_customize->selective_refresh ) ) {
        $wp_customize->selective_refresh->add_partial( 'blogname', array(
            'selector'        => '.gridmode-site-title a',
            'render_callback' => 'gridmode_customize_partial_blogname',
        ) );
        $wp_customize->selective_refresh->add_partial( 'blogdescription', array(
            'selector'        => '.gridmode-site-description',
            'render_callback' => 'gridmode_customize_partial_blogdescription',
        ) );
    }

    /* Getting started options */
    $wp_customize->add_section( 'gridmode_section_getting_started', array( 'title' => esc_html__( 'Getting Started', 'gridmode' ), 'description' => esc_html__( 'Thanks for your interest in GridMode! If you have any questions or run into any trouble, please visit us the following links. We will get you fixed up!', 'gridmode' ), 'panel' => 'gridmode_main_options_panel', 'priority' => 5, ) );

    $wp_customize->add_setting( 'gridmode_options[documentation]', array( 'default' => '', 'sanitize_callback' => '__return_false', ) );

    $wp_customize->add_control( new GridMode_Customize_Button_Control( $wp_customize, 'gridmode_documentation_control', array( 'label' => esc_html__( 'Documentation', 'gridmode' ), 'section' => 'gridmode_section_getting_started', 'settings' => 'gridmode_options[documentation]', 'type' => 'gridmode-button', 'button_tag' => 'a', 'button_class' => 'button button-primary', 'button_href' => esc_url( 'https://themesdna.com/gridmode-wordpress-theme/' ), 'button_target' => '_blank', ) ) );

    $wp_customize->add_setting( 'gridmode_options[contact]', array( 'default' => '', 'sanitize_callback' => '__return_false', ) );

    $wp_customize->add_control( new GridMode_Customize_Button_Control( $wp_customize, 'gridmode_contact_control', array( 'label' => esc_html__( 'Contact Us', 'gridmode' ), 'section' => 'gridmode_section_getting_started', 'settings' => 'gridmode_options[contact]', 'type' => 'gridmode-button', 'button_tag' => 'a', 'button_class' => 'button button-primary', 'button_href' => esc_url( 'https://themesdna.com/contact/' ), 'button_target' => '_blank', ) ) );


    /* Menu options */
    $wp_customize->add_section( 'gridmode_section_menu_options', array( 'title' => esc_html__( 'Menu Options', 'gridmode' ), 'panel' => 'gridmode_main_options_panel', 'priority' => 100 ) );

    $wp_customize->add_setting( 'gridmode_options[primary_menu_text]', array( 'default' => esc_html__( 'Menu', 'gridmode' ), 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'sanitize_text_field', ) );

    $wp_customize->add_control( 'gridmode_primary_menu_text_control', array( 'label' => esc_html__( 'Primary Menu Mobile Text', 'gridmode' ), 'section' => 'gridmode_section_menu_options', 'settings' => 'gridmode_options[primary_menu_text]', 'type' => 'text', ) );

    $wp_customize->add_setting( 'gridmode_options[disable_primary_menu]', array( 'default' => false, 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'gridmode_sanitize_checkbox', ) );

    $wp_customize->add_control( 'gridmode_disable_primary_menu_control', array( 'label' => esc_html__( 'Disable Primary Menu', 'gridmode' ), 'section' => 'gridmode_section_menu_options', 'settings' => 'gridmode_options[disable_primary_menu]', 'type' => 'checkbox', ) );

    $wp_customize->add_setting( 'gridmode_options[center_primary_menu]', array( 'default' => false, 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'gridmode_sanitize_checkbox', ) );

    $wp_customize->add_control( 'gridmode_center_primary_menu_control', array( 'label' => esc_html__( 'Center Primary Menu', 'gridmode' ), 'description' => '<br/><hr/>', 'section' => 'gridmode_section_menu_options', 'settings' => 'gridmode_options[center_primary_menu]', 'type' => 'checkbox', ) );


    $wp_customize->add_setting( 'gridmode_options[secondary_menu_text]', array( 'default' => esc_html__( 'Menu', 'gridmode' ), 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'sanitize_text_field', ) );

    $wp_customize->add_control( 'gridmode_secondary_menu_text_control', array( 'label' => esc_html__( 'Secondary Menu Mobile Text', 'gridmode' ), 'section' => 'gridmode_section_menu_options', 'settings' => 'gridmode_options[secondary_menu_text]', 'type' => 'text', ) );

    $wp_customize->add_setting( 'gridmode_options[disable_secondary_menu]', array( 'default' => false, 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'gridmode_sanitize_checkbox', ) );

    $wp_customize->add_control( 'gridmode_disable_secondary_menu_control', array( 'label' => esc_html__( 'Disable Secondary Menu', 'gridmode' ), 'section' => 'gridmode_section_menu_options', 'settings' => 'gridmode_options[disable_secondary_menu]', 'type' => 'checkbox', ) );

    $wp_customize->add_setting( 'gridmode_options[center_secondary_menu]', array( 'default' => false, 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'gridmode_sanitize_checkbox', ) );

    $wp_customize->add_control( 'gridmode_center_secondary_menu_control', array( 'label' => esc_html__( 'Center Secondary Menu', 'gridmode' ), 'section' => 'gridmode_section_menu_options', 'settings' => 'gridmode_options[center_secondary_menu]', 'type' => 'checkbox', ) );

    $wp_customize->add_setting( 'gridmode_options[secondary_menu_location]', array( 'default' => 'before-footer', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'gridmode_sanitize_secondary_menu_location' ) );

    $wp_customize->add_control( 'gridmode_secondary_menu_location_control', array( 'label' => esc_html__( 'Select Secondary Menu Location', 'gridmode' ), 'description' => esc_html__('Select where you want to display secondary menu.', 'gridmode'), 'section' => 'gridmode_section_menu_options', 'settings' => 'gridmode_options[secondary_menu_location]', 'type' => 'select', 'choices' => array( 'before-header' => esc_html__('Before Header', 'gridmode'), 'after-header' => esc_html__('After Header', 'gridmode'), 'before-footer' => esc_html__('Before Footer', 'gridmode'), 'after-footer' => esc_html__('After Footer', 'gridmode') ) ) );


    /* Header options */
    $wp_customize->add_section( 'gridmode_section_header', array( 'title' => esc_html__( 'Header Options', 'gridmode' ), 'panel' => 'gridmode_main_options_panel', 'priority' => 120 ) );

    $wp_customize->add_setting( 'gridmode_options[hide_tagline]', array( 'default' => false, 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'gridmode_sanitize_checkbox', ) );

    $wp_customize->add_control( 'gridmode_hide_tagline_control', array( 'label' => esc_html__( 'Hide Tagline', 'gridmode' ), 'section' => 'gridmode_section_header', 'settings' => 'gridmode_options[hide_tagline]', 'type' => 'checkbox', ) );

    $wp_customize->add_setting( 'gridmode_options[hide_header_content]', array( 'default' => false, 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'gridmode_sanitize_checkbox', ) );

    $wp_customize->add_control( 'gridmode_hide_header_content_control', array( 'label' => esc_html__( 'Hide Header Content', 'gridmode' ), 'section' => 'gridmode_section_header', 'settings' => 'gridmode_options[hide_header_content]', 'type' => 'checkbox', ) );

    $wp_customize->add_setting( 'gridmode_options[logo_location]', array( 'default' => 'above-title', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'gridmode_sanitize_logo_location' ) );

    $wp_customize->add_control( 'gridmode_logo_location_control', array( 'label' => esc_html__( 'Logo Location', 'gridmode' ), 'description' => esc_html__('Select how you want to display the site logo with site title and tagline.', 'gridmode'), 'section' => 'title_tagline', 'settings' => 'gridmode_options[logo_location]', 'type' => 'select', 'choices' => array( 'beside-title' => esc_html__( 'Before Site Title and Tagline', 'gridmode' ), 'above-title' => esc_html__( 'Above Site Title and Tagline', 'gridmode' ) ), 'priority'   => 8 ) );


    $wp_customize->add_setting( 'gridmode_options[hide_header_image]', array( 'default' => false, 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'gridmode_sanitize_checkbox', ) );

    $wp_customize->add_control( 'gridmode_hide_header_image_control', array( 'label' => esc_html__( 'Hide Header Image from Everywhere', 'gridmode' ), 'section' => 'header_image', 'settings' => 'gridmode_options[hide_header_image]', 'type' => 'checkbox', ) );

    $wp_customize->add_setting( 'gridmode_options[remove_header_image_link]', array( 'default' => false, 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'gridmode_sanitize_checkbox', ) );

    $wp_customize->add_control( 'gridmode_remove_header_image_link_control', array( 'label' => esc_html__( 'Remove Link from Header Image', 'gridmode' ), 'section' => 'header_image', 'settings' => 'gridmode_options[remove_header_image_link]', 'type' => 'checkbox', ) );

    $wp_customize->add_setting( 'gridmode_options[hide_header_image_details]', array( 'default' => false, 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'gridmode_sanitize_checkbox', ) );

    $wp_customize->add_control( 'gridmode_hide_header_image_details_control', array( 'label' => esc_html__( 'Hide both Title and Description from Header Image', 'gridmode' ), 'description' => esc_html__('If you checked this option, header image title and description will be hidden from all screen sizes.', 'gridmode'), 'section' => 'header_image', 'settings' => 'gridmode_options[hide_header_image_details]', 'type' => 'checkbox', ) );

    $wp_customize->add_setting( 'gridmode_options[hide_header_image_title]', array( 'default' => false, 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'gridmode_sanitize_checkbox', ) );

    $wp_customize->add_control( 'gridmode_hide_header_image_title_control', array( 'label' => esc_html__( 'Hide Title from Header Image', 'gridmode' ), 'description' => esc_html__('If you checked this option, header image title will be hidden from all screen sizes. This option has no effect if you have checked the option: "Hide both Title and Description from Header Image"', 'gridmode'), 'section' => 'header_image', 'settings' => 'gridmode_options[hide_header_image_title]', 'type' => 'checkbox', ) );

    $wp_customize->add_setting( 'gridmode_options[hide_header_image_description]', array( 'default' => false, 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'gridmode_sanitize_checkbox', ) );

    $wp_customize->add_control( 'gridmode_hide_header_image_description_control', array( 'label' => esc_html__( 'Hide Description from Header Image', 'gridmode' ), 'description' => esc_html__('If you checked this option, header image description will be hidden from all screen sizes. This option has no effect if you have checked the option: "Hide both Title and Description from Header Image"', 'gridmode'), 'section' => 'header_image', 'settings' => 'gridmode_options[hide_header_image_description]', 'type' => 'checkbox', ) );

    $wp_customize->add_setting( 'gridmode_options[header_image_custom_text]', array( 'default' => false, 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'gridmode_sanitize_checkbox', ) );

    $wp_customize->add_control( 'gridmode_header_image_custom_text_control', array( 'label' => esc_html__( 'Add Custom Title/Custom Description to Header Image', 'gridmode' ), 'section' => 'header_image', 'settings' => 'gridmode_options[header_image_custom_text]', 'type' => 'checkbox', ) );

    $wp_customize->add_setting( 'gridmode_options[header_image_custom_title]', array( 'default' => '', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'gridmode_sanitize_html', ) );

    $wp_customize->add_control( 'gridmode_header_image_custom_title_control', array( 'label' => esc_html__( 'Header Image Custom Title', 'gridmode' ), 'section' => 'header_image', 'settings' => 'gridmode_options[header_image_custom_title]', 'type' => 'text', ) );

    $wp_customize->add_setting( 'gridmode_options[header_image_custom_description]', array( 'default' => '', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'gridmode_sanitize_html', ) );

    $wp_customize->add_control( 'gridmode_header_image_custom_description_control', array( 'label' => esc_html__( 'Header Image Custom Description', 'gridmode' ), 'section' => 'header_image', 'settings' => 'gridmode_options[header_image_custom_description]', 'type' => 'text', ) );

    $wp_customize->add_setting( 'gridmode_options[header_image_destination]', array( 'default' => '', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'esc_url_raw' ) );

    $wp_customize->add_control( 'gridmode_header_image_destination_control', array( 'label' => esc_html__( 'Header Image Destination URL', 'gridmode' ), 'description' => esc_html__( 'Enter the URL a visitor should go when he/she click on the header image. If you did not enter a URL below, header image will be linked to the homepage of your website.', 'gridmode' ), 'section' => 'header_image', 'settings' => 'gridmode_options[header_image_destination]', 'type' => 'text' ) );

    $wp_customize->add_setting( 'gridmode_options[header_image_cover]', array( 'default' => false, 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'gridmode_sanitize_checkbox', ) );

    $wp_customize->add_control( 'gridmode_header_image_cover_control', array( 'label' => esc_html__( 'Add a Minimum Height to Header Image on Smaller Screens', 'gridmode' ), 'section' => 'header_image', 'settings' => 'gridmode_options[header_image_cover]', 'type' => 'checkbox', ) );


    $wp_customize->add_setting( 'gridmode_options[search_box_placeholder_text]', array( 'default' => esc_html__( 'Enter your search keyword...', 'gridmode' ), 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'sanitize_text_field', ) );

    $wp_customize->add_control( 'gridmode_search_box_placeholder_text_control', array( 'label' => esc_html__( 'Search Box Placeholder Text', 'gridmode' ), 'section' => 'gridmode_section_header', 'settings' => 'gridmode_options[search_box_placeholder_text]', 'type' => 'text', ) );


    /* Posts Summaries options */
    $wp_customize->add_section( 'gridmode_section_posts_summaries', array( 'title' => esc_html__( 'Posts Summaries Options', 'gridmode' ), 'panel' => 'gridmode_main_options_panel', 'priority' => 160 ) );

    $wp_customize->add_setting( 'gridmode_options[hide_posts_heading]', array( 'default' => false, 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'gridmode_sanitize_checkbox', ) );

    $wp_customize->add_control( 'gridmode_hide_posts_heading_control', array( 'label' => esc_html__( 'Hide HomePage Posts Heading', 'gridmode' ), 'section' => 'gridmode_section_posts_summaries', 'settings' => 'gridmode_options[hide_posts_heading]', 'type' => 'checkbox', ) );

    $wp_customize->add_setting( 'gridmode_options[posts_heading]', array( 'default' => esc_html__( 'Recent Posts', 'gridmode' ), 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'sanitize_text_field', ) );

    $wp_customize->add_control( 'gridmode_posts_heading_control', array( 'label' => esc_html__( 'HomePage Posts Heading', 'gridmode' ), 'section' => 'gridmode_section_posts_summaries', 'settings' => 'gridmode_options[posts_heading]', 'type' => 'text', ) );

    $wp_customize->add_setting( 'gridmode_options[post_summaries_style]', array( 'default' => 'grid', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'gridmode_sanitize_post_summaries_style' ) );

    $wp_customize->add_control( 'gridmode_post_summaries_style_control', array( 'label' => esc_html__( 'Post Summaries Style', 'gridmode' ), 'description' => esc_html__('Select the post summaries style for non-singular pages.', 'gridmode'), 'section' => 'gridmode_section_posts_summaries', 'settings' => 'gridmode_options[post_summaries_style]', 'type' => 'select', 'choices' => array( 'grid' => esc_html__('Grid Posts', 'gridmode'), 'non-grid' => esc_html__('Non-Grid Posts', 'gridmode') ) ) );

    $wp_customize->add_setting( 'gridmode_options[hide_thumbnail_home]', array( 'default' => false, 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'gridmode_sanitize_checkbox', ) );

    $wp_customize->add_control( 'gridmode_hide_thumbnail_home_control', array( 'label' => esc_html__( 'Hide Featured Images from Grid | Non-Grid Posts Summaries', 'gridmode' ), 'section' => 'gridmode_section_posts_summaries', 'settings' => 'gridmode_options[hide_thumbnail_home]', 'type' => 'checkbox', ) );

    $wp_customize->add_setting( 'gridmode_options[hide_default_thumbnail]', array( 'default' => false, 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'gridmode_sanitize_checkbox', ) );

    $wp_customize->add_control( 'gridmode_hide_default_thumbnail_control', array( 'label' => esc_html__( 'Hide Default Featured Image from Grid Posts Summaries', 'gridmode' ), 'description' => esc_html__( 'The default thumbnail image is shown when there is no featured image is set.', 'gridmode' ), 'section' => 'gridmode_section_posts_summaries', 'settings' => 'gridmode_options[hide_default_thumbnail]', 'type' => 'checkbox', ) );

    $wp_customize->add_setting( 'gridmode_options[featured_nongrid_media_under_post_title]', array( 'default' => false, 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'gridmode_sanitize_checkbox', ) );

    $wp_customize->add_control( 'gridmode_featured_nongrid_media_under_post_title_control', array( 'label' => esc_html__( 'Move Featured Images to the Bottom of Post Titles on Non-Grid Post Summaries', 'gridmode' ), 'section' => 'gridmode_section_posts_summaries', 'settings' => 'gridmode_options[featured_nongrid_media_under_post_title]', 'type' => 'checkbox', ) );

    $wp_customize->add_setting( 'gridmode_options[thumbnail_link_home]', array( 'default' => 'yes', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'gridmode_sanitize_yes_no' ) );

    $wp_customize->add_control( 'gridmode_thumbnail_link_home_control', array( 'label' => esc_html__( 'Featured Images Links', 'gridmode' ), 'description' => esc_html__('Do you want thumbnails in grid | non-grid posts summaries to be linked to their posts?', 'gridmode'), 'section' => 'gridmode_section_posts_summaries', 'settings' => 'gridmode_options[thumbnail_link_home]', 'type' => 'select', 'choices' => array( 'yes' => esc_html__('Yes', 'gridmode'), 'no' => esc_html__('No', 'gridmode') ) ) );

    $wp_customize->add_setting( 'gridmode_options[hide_post_header_home]', array( 'default' => false, 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'gridmode_sanitize_checkbox', ) );

    $wp_customize->add_control( 'gridmode_hide_post_header_home_control', array( 'label' => esc_html__( 'Hide Post Headers from Non-Grid Posts Summaries', 'gridmode' ), 'description' => esc_html__('If you check this option, it will hide both post titles and post header meta data from non-grid posts summaries.', 'gridmode'), 'section' => 'gridmode_section_posts_summaries', 'settings' => 'gridmode_options[hide_post_header_home]', 'type' => 'checkbox', ) );

    $wp_customize->add_setting( 'gridmode_options[hide_post_title_home]', array( 'default' => false, 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'gridmode_sanitize_checkbox', ) );

    $wp_customize->add_control( 'gridmode_hide_post_title_home_control', array( 'label' => esc_html__( 'Hide Post Titles from Grid | Non-Grid Posts Summaries', 'gridmode' ), 'section' => 'gridmode_section_posts_summaries', 'settings' => 'gridmode_options[hide_post_title_home]', 'type' => 'checkbox', ) );

    $wp_customize->add_setting( 'gridmode_options[remove_post_title_link_home]', array( 'default' => false, 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'gridmode_sanitize_checkbox', ) );

    $wp_customize->add_control( 'gridmode_remove_post_title_link_home_control', array( 'label' => esc_html__( 'Remove Links of Post Titles from Grid | Non-Grid Posts Summaries', 'gridmode' ), 'section' => 'gridmode_section_posts_summaries', 'settings' => 'gridmode_options[remove_post_title_link_home]', 'type' => 'checkbox', ) );

    $wp_customize->add_setting( 'gridmode_options[show_post_author_home]', array( 'default' => false, 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'gridmode_sanitize_checkbox', ) );

    $wp_customize->add_control( 'gridmode_show_post_author_home_control', array( 'label' => esc_html__( 'Show Post Author Names on Grid | Non-Grid Posts Summaries', 'gridmode' ), 'section' => 'gridmode_section_posts_summaries', 'settings' => 'gridmode_options[show_post_author_home]', 'type' => 'checkbox', ) );

    $wp_customize->add_setting( 'gridmode_options[hide_posted_date_home]', array( 'default' => false, 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'gridmode_sanitize_checkbox', ) );

    $wp_customize->add_control( 'gridmode_hide_posted_date_home_control', array( 'label' => esc_html__( 'Hide Posted Dates from Grid | Non-Grid Posts Summaries', 'gridmode' ), 'section' => 'gridmode_section_posts_summaries', 'settings' => 'gridmode_options[hide_posted_date_home]', 'type' => 'checkbox', ) );

    $wp_customize->add_setting( 'gridmode_options[show_comments_link_home]', array( 'default' => false, 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'gridmode_sanitize_checkbox', ) );

    $wp_customize->add_control( 'gridmode_show_comments_link_home_control', array( 'label' => esc_html__( 'Show Comment Links on Grid | Non-Grid Posts Summaries', 'gridmode' ), 'section' => 'gridmode_section_posts_summaries', 'settings' => 'gridmode_options[show_comments_link_home]', 'type' => 'checkbox', ) );

    $wp_customize->add_setting( 'gridmode_options[comments_count_full_home]', array( 'default' => false, 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'gridmode_sanitize_checkbox', ) );

    $wp_customize->add_control( 'gridmode_comments_count_full_home_control', array( 'label' => esc_html__( 'Display Comment Texts instead of Comments Counts on Grid Posts Summaries', 'gridmode' ), 'section' => 'gridmode_section_posts_summaries', 'settings' => 'gridmode_options[comments_count_full_home]', 'type' => 'checkbox', ) );

    $wp_customize->add_setting( 'gridmode_options[hide_post_categories_home]', array( 'default' => false, 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'gridmode_sanitize_checkbox', ) );

    $wp_customize->add_control( 'gridmode_hide_post_categories_home_control', array( 'label' => esc_html__( 'Hide Post Categories from Grid | Non-Grid Posts Summaries', 'gridmode' ), 'section' => 'gridmode_section_posts_summaries', 'settings' => 'gridmode_options[hide_post_categories_home]', 'type' => 'checkbox', ) );

    $wp_customize->add_setting( 'gridmode_options[hide_post_tags_home]', array( 'default' => false, 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'gridmode_sanitize_checkbox', ) );

    $wp_customize->add_control( 'gridmode_hide_post_tags_home_control', array( 'label' => esc_html__( 'Hide Post Tags from Non-Grid Posts Summaries', 'gridmode' ), 'section' => 'gridmode_section_posts_summaries', 'settings' => 'gridmode_options[hide_post_tags_home]', 'type' => 'checkbox', ) );

    $wp_customize->add_setting( 'gridmode_options[hide_post_snippet]', array( 'default' => false, 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'gridmode_sanitize_checkbox', ) );

    $wp_customize->add_control( 'gridmode_hide_post_snippet_control', array( 'label' => esc_html__( 'Hide Post Snippets on Grid Posts Summaries', 'gridmode' ), 'section' => 'gridmode_section_posts_summaries', 'settings' => 'gridmode_options[hide_post_snippet]', 'type' => 'checkbox', ) );

    $wp_customize->add_setting( 'gridmode_options[read_more_length]', array( 'default' => 17, 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'gridmode_sanitize_read_more_length' ) );

    $wp_customize->add_control( 'gridmode_read_more_length_control', array( 'label' => esc_html__( 'Post Snippets Length of Grid Posts Summaries', 'gridmode' ), 'description' => esc_html__('Enter the number of words need to display in grid post summaries. Default is 17 words.', 'gridmode'), 'section' => 'gridmode_section_posts_summaries', 'settings' => 'gridmode_options[read_more_length]', 'type' => 'text' ) );


    /* Post options */
    $wp_customize->add_section( 'gridmode_section_post', array( 'title' => esc_html__( 'Post Options', 'gridmode' ), 'panel' => 'gridmode_main_options_panel', 'priority' => 180 ) );

    $wp_customize->add_setting( 'gridmode_options[thumbnail_link]', array( 'default' => 'yes', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'gridmode_sanitize_yes_no' ) );

    $wp_customize->add_control( 'gridmode_thumbnail_link_control', array( 'label' => esc_html__( 'Featured Image Link', 'gridmode' ), 'description' => esc_html__('Do you want the featured image in a single post to be linked to its post?', 'gridmode'), 'section' => 'gridmode_section_post', 'settings' => 'gridmode_options[thumbnail_link]', 'type' => 'select', 'choices' => array( 'yes' => esc_html__('Yes', 'gridmode'), 'no' => esc_html__('No', 'gridmode') ) ) );

    $wp_customize->add_setting( 'gridmode_options[hide_thumbnail]', array( 'default' => false, 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'gridmode_sanitize_checkbox', ) );

    $wp_customize->add_control( 'gridmode_hide_thumbnail_control', array( 'label' => esc_html__( 'Hide Featured Image from Full Post', 'gridmode' ), 'section' => 'gridmode_section_post', 'settings' => 'gridmode_options[hide_thumbnail]', 'type' => 'checkbox', ) );

    $wp_customize->add_setting( 'gridmode_options[featured_media_under_post_title]', array( 'default' => false, 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'gridmode_sanitize_checkbox', ) );

    $wp_customize->add_control( 'gridmode_featured_media_under_post_title_control', array( 'label' => esc_html__( 'Move Featured Image to Bottom of Full Post Title', 'gridmode' ), 'section' => 'gridmode_section_post', 'settings' => 'gridmode_options[featured_media_under_post_title]', 'type' => 'checkbox', ) );

    $wp_customize->add_setting( 'gridmode_options[auto_width_thumbnail]', array( 'default' => false, 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'gridmode_sanitize_checkbox', ) );

    $wp_customize->add_control( 'gridmode_auto_width_thumbnail_control', array( 'label' => esc_html__( 'Do not Stretch Small Featured Image in Full Post', 'gridmode' ), 'section' => 'gridmode_section_post', 'settings' => 'gridmode_options[auto_width_thumbnail]', 'type' => 'checkbox', ) );

    $wp_customize->add_setting( 'gridmode_options[hide_post_header]', array( 'default' => false, 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'gridmode_sanitize_checkbox', ) );

    $wp_customize->add_control( 'gridmode_hide_post_header_control', array( 'label' => esc_html__( 'Hide Post Header from Full Post', 'gridmode' ), 'description' => esc_html__('If you check this option, it will hide post title and post header meta data from full post.', 'gridmode'), 'section' => 'gridmode_section_post', 'settings' => 'gridmode_options[hide_post_header]', 'type' => 'checkbox', ) );

    $wp_customize->add_setting( 'gridmode_options[hide_post_title]', array( 'default' => false, 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'gridmode_sanitize_checkbox', ) );

    $wp_customize->add_control( 'gridmode_hide_post_title_control', array( 'label' => esc_html__( 'Hide Post Title from Full Post', 'gridmode' ), 'section' => 'gridmode_section_post', 'settings' => 'gridmode_options[hide_post_title]', 'type' => 'checkbox', ) );

    $wp_customize->add_setting( 'gridmode_options[remove_post_title_link]', array( 'default' => false, 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'gridmode_sanitize_checkbox', ) );

    $wp_customize->add_control( 'gridmode_remove_post_title_link_control', array( 'label' => esc_html__( 'Remove Link from Full Post Title', 'gridmode' ), 'section' => 'gridmode_section_post', 'settings' => 'gridmode_options[remove_post_title_link]', 'type' => 'checkbox', ) );

    $wp_customize->add_setting( 'gridmode_options[hide_post_categories]', array( 'default' => false, 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'gridmode_sanitize_checkbox', ) );

    $wp_customize->add_control( 'gridmode_hide_post_categories_control', array( 'label' => esc_html__( 'Hide Post Categories from Full Post', 'gridmode' ), 'section' => 'gridmode_section_post', 'settings' => 'gridmode_options[hide_post_categories]', 'type' => 'checkbox', ) );

    $wp_customize->add_setting( 'gridmode_options[hide_post_author]', array( 'default' => false, 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'gridmode_sanitize_checkbox', ) );

    $wp_customize->add_control( 'gridmode_hide_post_author_control', array( 'label' => esc_html__( 'Hide Post Author from Full Post', 'gridmode' ), 'section' => 'gridmode_section_post', 'settings' => 'gridmode_options[hide_post_author]', 'type' => 'checkbox', ) );

    $wp_customize->add_setting( 'gridmode_options[hide_posted_date]', array( 'default' => false, 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'gridmode_sanitize_checkbox', ) );

    $wp_customize->add_control( 'gridmode_hide_posted_date_control', array( 'label' => esc_html__( 'Hide Posted Date from Full Post', 'gridmode' ), 'section' => 'gridmode_section_post', 'settings' => 'gridmode_options[hide_posted_date]', 'type' => 'checkbox', ) );

    $wp_customize->add_setting( 'gridmode_options[hide_comments_link]', array( 'default' => false, 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'gridmode_sanitize_checkbox', ) );

    $wp_customize->add_control( 'gridmode_hide_comments_link_control', array( 'label' => esc_html__( 'Hide Comment Link from Full Post', 'gridmode' ), 'section' => 'gridmode_section_post', 'settings' => 'gridmode_options[hide_comments_link]', 'type' => 'checkbox', ) );

    $wp_customize->add_setting( 'gridmode_options[show_post_edit]', array( 'default' => false, 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'gridmode_sanitize_checkbox', ) );

    $wp_customize->add_control( 'gridmode_show_post_edit_control', array( 'label' => esc_html__( 'Show Post Edit Link', 'gridmode' ), 'section' => 'gridmode_section_post', 'settings' => 'gridmode_options[show_post_edit]', 'type' => 'checkbox', ) );

    $wp_customize->add_setting( 'gridmode_options[hide_post_tags]', array( 'default' => false, 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'gridmode_sanitize_checkbox', ) );

    $wp_customize->add_control( 'gridmode_hide_post_tags_control', array( 'label' => esc_html__( 'Hide Post Tags from Full Post', 'gridmode' ), 'section' => 'gridmode_section_post', 'settings' => 'gridmode_options[hide_post_tags]', 'type' => 'checkbox', ) );

    $wp_customize->add_setting( 'gridmode_options[hide_author_bio_box]', array( 'default' => false, 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'gridmode_sanitize_checkbox', ) );

    $wp_customize->add_control( 'gridmode_hide_author_bio_box_control', array( 'label' => esc_html__( 'Hide Author Bio Box', 'gridmode' ), 'section' => 'gridmode_section_post', 'settings' => 'gridmode_options[hide_author_bio_box]', 'type' => 'checkbox', ) );


    /* Navigation options */
    $wp_customize->add_section( 'gridmode_section_navigation', array( 'title' => esc_html__( 'Posts Navigation Options', 'gridmode' ), 'panel' => 'gridmode_main_options_panel', 'priority' => 185 ) );

    $wp_customize->add_setting( 'gridmode_options[hide_post_navigation]', array( 'default' => false, 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'gridmode_sanitize_checkbox', ) );

    $wp_customize->add_control( 'gridmode_hide_post_navigation_control', array( 'label' => esc_html__( 'Hide Post Navigation from Full Posts', 'gridmode' ), 'section' => 'gridmode_section_navigation', 'settings' => 'gridmode_options[hide_post_navigation]', 'type' => 'checkbox', ) );

    $wp_customize->add_setting( 'gridmode_options[hide_posts_navigation]', array( 'default' => false, 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'gridmode_sanitize_checkbox', ) );

    $wp_customize->add_control( 'gridmode_hide_posts_navigation_control', array( 'label' => esc_html__( 'Hide Posts Navigation from Home/Archive/Search Pages', 'gridmode' ), 'section' => 'gridmode_section_navigation', 'settings' => 'gridmode_options[hide_posts_navigation]', 'type' => 'checkbox', ) );

    $wp_customize->add_setting( 'gridmode_options[posts_navigation_type]', array( 'default' => 'numberednavi', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'gridmode_sanitize_posts_navigation_type' ) );

    $wp_customize->add_control( 'gridmode_posts_navigation_type_control', array( 'label' => esc_html__( 'Posts Navigation Type', 'gridmode' ), 'description' => esc_html__('Select posts navigation type you need. If you activate WP-PageNavi plugin, this navigation will be replaced by WP-PageNavi navigation.', 'gridmode'), 'section' => 'gridmode_section_navigation', 'settings' => 'gridmode_options[posts_navigation_type]', 'type' => 'select', 'choices' => array( 'normalnavi' => esc_html__('Normal Navigation', 'gridmode'), 'numberednavi' => esc_html__('Numbered Navigation', 'gridmode'), 'loadmoreclick' => esc_html__('Load More Button', 'gridmode'), 'loadmorescroll' => esc_html__('Infinite Scroll', 'gridmode') ) ) );


    /* Page options */
    $wp_customize->add_section( 'gridmode_section_page', array( 'title' => esc_html__( 'Page Options', 'gridmode' ), 'panel' => 'gridmode_main_options_panel', 'priority' => 190 ) );

    $wp_customize->add_setting( 'gridmode_options[thumbnail_link_page]', array( 'default' => 'yes', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'gridmode_sanitize_yes_no' ) );

    $wp_customize->add_control( 'gridmode_thumbnail_link_page_control', array( 'label' => esc_html__( 'Featured Image Link', 'gridmode' ), 'description' => esc_html__('Do you want the featured image in a page to be linked to its page?', 'gridmode'), 'section' => 'gridmode_section_page', 'settings' => 'gridmode_options[thumbnail_link_page]', 'type' => 'select', 'choices' => array( 'yes' => esc_html__('Yes', 'gridmode'), 'no' => esc_html__('No', 'gridmode') ) ) );

    $wp_customize->add_setting( 'gridmode_options[hide_page_thumbnail]', array( 'default' => false, 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'gridmode_sanitize_checkbox', ) );

    $wp_customize->add_control( 'gridmode_hide_page_thumbnail_control', array( 'label' => esc_html__( 'Hide Featured Image from Single Page', 'gridmode' ), 'section' => 'gridmode_section_page', 'settings' => 'gridmode_options[hide_page_thumbnail]', 'type' => 'checkbox', ) );

    $wp_customize->add_setting( 'gridmode_options[featured_media_under_page_title]', array( 'default' => false, 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'gridmode_sanitize_checkbox', ) );

    $wp_customize->add_control( 'gridmode_featured_media_under_page_title_control', array( 'label' => esc_html__( 'Move Featured Image to Bottom of Page Title', 'gridmode' ), 'section' => 'gridmode_section_page', 'settings' => 'gridmode_options[featured_media_under_page_title]', 'type' => 'checkbox', ) );

    $wp_customize->add_setting( 'gridmode_options[hide_page_header]', array( 'default' => false, 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'gridmode_sanitize_checkbox', ) );

    $wp_customize->add_control( 'gridmode_hide_page_header_control', array( 'label' => esc_html__( 'Hide Page Header from Single Page', 'gridmode' ), 'description' => esc_html__('If you check this option, it will hide page title and page header meta data from single page.', 'gridmode'), 'section' => 'gridmode_section_page', 'settings' => 'gridmode_options[hide_page_header]', 'type' => 'checkbox', ) );

    $wp_customize->add_setting( 'gridmode_options[hide_page_title]', array( 'default' => false, 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'gridmode_sanitize_checkbox', ) );

    $wp_customize->add_control( 'gridmode_hide_page_title_control', array( 'label' => esc_html__( 'Hide Page Title from Single Page', 'gridmode' ), 'section' => 'gridmode_section_page', 'settings' => 'gridmode_options[hide_page_title]', 'type' => 'checkbox', ) );

    $wp_customize->add_setting( 'gridmode_options[remove_page_title_link]', array( 'default' => false, 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'gridmode_sanitize_checkbox', ) );

    $wp_customize->add_control( 'gridmode_remove_page_title_link_control', array( 'label' => esc_html__( 'Remove Link from Single Page Title', 'gridmode' ), 'section' => 'gridmode_section_page', 'settings' => 'gridmode_options[remove_page_title_link]', 'type' => 'checkbox', ) );

    $wp_customize->add_setting( 'gridmode_options[hide_page_date]', array( 'default' => false, 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'gridmode_sanitize_checkbox', ) );

    $wp_customize->add_control( 'gridmode_hide_page_date_control', array( 'label' => esc_html__( 'Hide Posted Date from Single Page', 'gridmode' ), 'section' => 'gridmode_section_page', 'settings' => 'gridmode_options[hide_page_date]', 'type' => 'checkbox', ) );

    $wp_customize->add_setting( 'gridmode_options[hide_page_author]', array( 'default' => false, 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'gridmode_sanitize_checkbox', ) );

    $wp_customize->add_control( 'gridmode_hide_page_author_control', array( 'label' => esc_html__( 'Hide Page Author from Single Page', 'gridmode' ), 'section' => 'gridmode_section_page', 'settings' => 'gridmode_options[hide_page_author]', 'type' => 'checkbox', ) );

    $wp_customize->add_setting( 'gridmode_options[hide_page_comments]', array( 'default' => false, 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'gridmode_sanitize_checkbox', ) );

    $wp_customize->add_control( 'gridmode_hide_page_comments_control', array( 'label' => esc_html__( 'Hide Comment Link from Single Page', 'gridmode' ), 'section' => 'gridmode_section_page', 'settings' => 'gridmode_options[hide_page_comments]', 'type' => 'checkbox', ) );

    $wp_customize->add_setting( 'gridmode_options[hide_page_edit]', array( 'default' => false, 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'gridmode_sanitize_checkbox', ) );

    $wp_customize->add_control( 'gridmode_hide_page_edit_control', array( 'label' => esc_html__( 'Hide Edit Link from Single Page', 'gridmode' ), 'section' => 'gridmode_section_page', 'settings' => 'gridmode_options[hide_page_edit]', 'type' => 'checkbox', ) );


    /* Social profiles options */
    $wp_customize->add_section( 'gridmode_section_social', array( 'title' => esc_html__( 'Social Links Options', 'gridmode' ), 'panel' => 'gridmode_main_options_panel', 'priority' => 240, ));

    $wp_customize->add_setting( 'gridmode_options[hide_social_buttons]', array( 'default' => false, 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'gridmode_sanitize_checkbox', ) );

    $wp_customize->add_control( 'gridmode_hide_social_buttons_control', array( 'label' => esc_html__( 'Hide Social + Search + Login/Logout Buttons', 'gridmode' ), 'description' => esc_html__('If you checked this option, all buttons will disappear. There is no any effect from these options: "Show Search Button", "Show Login/Logout Button", "Show Random Post Button".', 'gridmode'), 'section' => 'gridmode_section_social', 'settings' => 'gridmode_options[hide_social_buttons]', 'type' => 'checkbox', ) );

    $wp_customize->add_setting( 'gridmode_options[show_search_button]', array( 'default' => false, 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'gridmode_sanitize_checkbox', ) );

    $wp_customize->add_control( 'gridmode_show_search_button_control', array( 'label' => esc_html__( 'Show Search Button', 'gridmode' ), 'description' => esc_html__('This option has no effect if you have checked the option: "Hide Social + Search + Login/Logout Buttons".', 'gridmode'), 'section' => 'gridmode_section_social', 'settings' => 'gridmode_options[show_search_button]', 'type' => 'checkbox', ) );

    $wp_customize->add_setting( 'gridmode_options[show_login_button]', array( 'default' => false, 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'gridmode_sanitize_checkbox', ) );

    $wp_customize->add_control( 'gridmode_show_login_button_control', array( 'label' => esc_html__( 'Show Login/Logout Button', 'gridmode' ), 'description' => esc_html__('This option has no effect if you have checked the option: "Hide Social + Search + Login/Logout Buttons".', 'gridmode'), 'section' => 'gridmode_section_social', 'settings' => 'gridmode_options[show_login_button]', 'type' => 'checkbox', ) );

    $wp_customize->add_setting( 'gridmode_options[show_round_social_buttons]', array( 'default' => false, 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'gridmode_sanitize_checkbox', ) );

    $wp_customize->add_control( 'gridmode_show_round_social_buttons_control', array( 'label' => esc_html__( 'Show Round Social Buttons', 'gridmode' ), 'section' => 'gridmode_section_social', 'settings' => 'gridmode_options[show_round_social_buttons]', 'type' => 'checkbox', ) );

    $wp_customize->add_setting( 'gridmode_options[twitterlink]', array( 'default' => '', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'esc_url_raw' ) );

    $wp_customize->add_control( 'gridmode_twitterlink_control', array( 'label' => esc_html__( 'Twitter URL', 'gridmode' ), 'section' => 'gridmode_section_social', 'settings' => 'gridmode_options[twitterlink]', 'type' => 'text' ) );

    $wp_customize->add_setting( 'gridmode_options[facebooklink]', array( 'default' => '', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'esc_url_raw' ) );

    $wp_customize->add_control( 'gridmode_facebooklink_control', array( 'label' => esc_html__( 'Facebook URL', 'gridmode' ), 'section' => 'gridmode_section_social', 'settings' => 'gridmode_options[facebooklink]', 'type' => 'text' ) );

    $wp_customize->add_setting( 'gridmode_options[googlelink]', array( 'default' => '', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'esc_url_raw' ) ); 

    $wp_customize->add_control( 'gridmode_googlelink_control', array( 'label' => esc_html__( 'Google Plus URL', 'gridmode' ), 'section' => 'gridmode_section_social', 'settings' => 'gridmode_options[googlelink]', 'type' => 'text' ) );

    $wp_customize->add_setting( 'gridmode_options[pinterestlink]', array( 'default' => '', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'esc_url_raw' ) );

    $wp_customize->add_control( 'gridmode_pinterestlink_control', array( 'label' => esc_html__( 'Pinterest URL', 'gridmode' ), 'section' => 'gridmode_section_social', 'settings' => 'gridmode_options[pinterestlink]', 'type' => 'text' ) );
    
    $wp_customize->add_setting( 'gridmode_options[linkedinlink]', array( 'default' => '', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'esc_url_raw' ) );

    $wp_customize->add_control( 'gridmode_linkedinlink_control', array( 'label' => esc_html__( 'Linkedin Link', 'gridmode' ), 'section' => 'gridmode_section_social', 'settings' => 'gridmode_options[linkedinlink]', 'type' => 'text' ) );

    $wp_customize->add_setting( 'gridmode_options[instagramlink]', array( 'default' => '', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'esc_url_raw' ) );

    $wp_customize->add_control( 'gridmode_instagramlink_control', array( 'label' => esc_html__( 'Instagram Link', 'gridmode' ), 'section' => 'gridmode_section_social', 'settings' => 'gridmode_options[instagramlink]', 'type' => 'text' ) );

    $wp_customize->add_setting( 'gridmode_options[vklink]', array( 'default' => '', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'esc_url_raw' ) );

    $wp_customize->add_control( 'gridmode_vklink_control', array( 'label' => esc_html__( 'VK Link', 'gridmode' ), 'section' => 'gridmode_section_social', 'settings' => 'gridmode_options[vklink]', 'type' => 'text' ) );

    $wp_customize->add_setting( 'gridmode_options[flickrlink]', array( 'default' => '', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'esc_url_raw' ) );

    $wp_customize->add_control( 'gridmode_flickrlink_control', array( 'label' => esc_html__( 'Flickr Link', 'gridmode' ), 'section' => 'gridmode_section_social', 'settings' => 'gridmode_options[flickrlink]', 'type' => 'text' ) );

    $wp_customize->add_setting( 'gridmode_options[youtubelink]', array( 'default' => '', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'esc_url_raw' ) );

    $wp_customize->add_control( 'gridmode_youtubelink_control', array( 'label' => esc_html__( 'Youtube URL', 'gridmode' ), 'section' => 'gridmode_section_social', 'settings' => 'gridmode_options[youtubelink]', 'type' => 'text' ) );

    $wp_customize->add_setting( 'gridmode_options[vimeolink]', array( 'default' => '', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'esc_url_raw' ) );

    $wp_customize->add_control( 'gridmode_vimeolink_control', array( 'label' => esc_html__( 'Vimeo URL', 'gridmode' ), 'section' => 'gridmode_section_social', 'settings' => 'gridmode_options[vimeolink]', 'type' => 'text' ) );

    $wp_customize->add_setting( 'gridmode_options[soundcloudlink]', array( 'default' => '', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'esc_url_raw' ) );

    $wp_customize->add_control( 'gridmode_soundcloudlink_control', array( 'label' => esc_html__( 'Soundcloud URL', 'gridmode' ), 'section' => 'gridmode_section_social', 'settings' => 'gridmode_options[soundcloudlink]', 'type' => 'text' ) );

    $wp_customize->add_setting( 'gridmode_options[messengerlink]', array( 'default' => '', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'esc_url_raw' ) );

    $wp_customize->add_control( 'gridmode_messengerlink_control', array( 'label' => esc_html__( 'Messenger URL', 'gridmode' ), 'section' => 'gridmode_section_social', 'settings' => 'gridmode_options[messengerlink]', 'type' => 'text' ) );

    $wp_customize->add_setting( 'gridmode_options[whatsapplink]', array( 'default' => '', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'esc_url_raw' ) );

    $wp_customize->add_control( 'gridmode_whatsapplink_control', array( 'label' => esc_html__( 'WhatsApp URL', 'gridmode' ), 'section' => 'gridmode_section_social', 'settings' => 'gridmode_options[whatsapplink]', 'type' => 'text' ) );

    $wp_customize->add_setting( 'gridmode_options[tiktoklink]', array( 'default' => '', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'esc_url_raw' ) );

    $wp_customize->add_control( 'gridmode_tiktoklink_control', array( 'label' => esc_html__( 'TikTok URL', 'gridmode' ), 'section' => 'gridmode_section_social', 'settings' => 'gridmode_options[tiktoklink]', 'type' => 'text' ) );

    $wp_customize->add_setting( 'gridmode_options[lastfmlink]', array( 'default' => '', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'esc_url_raw' ) );

    $wp_customize->add_control( 'gridmode_lastfmlink_control', array( 'label' => esc_html__( 'Lastfm URL', 'gridmode' ), 'section' => 'gridmode_section_social', 'settings' => 'gridmode_options[lastfmlink]', 'type' => 'text' ) );

    $wp_customize->add_setting( 'gridmode_options[mediumlink]', array( 'default' => '', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'esc_url_raw' ) );

    $wp_customize->add_control( 'gridmode_mediumlink_control', array( 'label' => esc_html__( 'Medium URL', 'gridmode' ), 'section' => 'gridmode_section_social', 'settings' => 'gridmode_options[mediumlink]', 'type' => 'text' ) );

    $wp_customize->add_setting( 'gridmode_options[githublink]', array( 'default' => '', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'esc_url_raw' ) );

    $wp_customize->add_control( 'gridmode_githublink_control', array( 'label' => esc_html__( 'Github URL', 'gridmode' ), 'section' => 'gridmode_section_social', 'settings' => 'gridmode_options[githublink]', 'type' => 'text' ) );

    $wp_customize->add_setting( 'gridmode_options[bitbucketlink]', array( 'default' => '', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'esc_url_raw' ) );

    $wp_customize->add_control( 'gridmode_bitbucketlink_control', array( 'label' => esc_html__( 'Bitbucket URL', 'gridmode' ), 'section' => 'gridmode_section_social', 'settings' => 'gridmode_options[bitbucketlink]', 'type' => 'text' ) );

    $wp_customize->add_setting( 'gridmode_options[tumblrlink]', array( 'default' => '', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'esc_url_raw' ) );

    $wp_customize->add_control( 'gridmode_tumblrlink_control', array( 'label' => esc_html__( 'Tumblr URL', 'gridmode' ), 'section' => 'gridmode_section_social', 'settings' => 'gridmode_options[tumblrlink]', 'type' => 'text' ) );

    $wp_customize->add_setting( 'gridmode_options[digglink]', array( 'default' => '', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'esc_url_raw' ) );

    $wp_customize->add_control( 'gridmode_digglink_control', array( 'label' => esc_html__( 'Digg URL', 'gridmode' ), 'section' => 'gridmode_section_social', 'settings' => 'gridmode_options[digglink]', 'type' => 'text' ) );

    $wp_customize->add_setting( 'gridmode_options[deliciouslink]', array( 'default' => '', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'esc_url_raw' ) );

    $wp_customize->add_control( 'gridmode_deliciouslink_control', array( 'label' => esc_html__( 'Delicious URL', 'gridmode' ), 'section' => 'gridmode_section_social', 'settings' => 'gridmode_options[deliciouslink]', 'type' => 'text' ) );

    $wp_customize->add_setting( 'gridmode_options[stumblelink]', array( 'default' => '', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'esc_url_raw' ) );

    $wp_customize->add_control( 'gridmode_stumblelink_control', array( 'label' => esc_html__( 'Stumbleupon URL', 'gridmode' ), 'section' => 'gridmode_section_social', 'settings' => 'gridmode_options[stumblelink]', 'type' => 'text' ) );

    $wp_customize->add_setting( 'gridmode_options[mixlink]', array( 'default' => '', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'esc_url_raw' ) );

    $wp_customize->add_control( 'gridmode_mixlink_control', array( 'label' => esc_html__( 'Mix URL', 'gridmode' ), 'section' => 'gridmode_section_social', 'settings' => 'gridmode_options[mixlink]', 'type' => 'text' ) );

    $wp_customize->add_setting( 'gridmode_options[redditlink]', array( 'default' => '', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'esc_url_raw' ) );

    $wp_customize->add_control( 'gridmode_redditlink_control', array( 'label' => esc_html__( 'Reddit URL', 'gridmode' ), 'section' => 'gridmode_section_social', 'settings' => 'gridmode_options[redditlink]', 'type' => 'text' ) );

    $wp_customize->add_setting( 'gridmode_options[dribbblelink]', array( 'default' => '', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'esc_url_raw' ) );

    $wp_customize->add_control( 'gridmode_dribbblelink_control', array( 'label' => esc_html__( 'Dribbble URL', 'gridmode' ), 'section' => 'gridmode_section_social', 'settings' => 'gridmode_options[dribbblelink]', 'type' => 'text' ) );

    $wp_customize->add_setting( 'gridmode_options[flipboardlink]', array( 'default' => '', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'esc_url_raw' ) );

    $wp_customize->add_control( 'gridmode_flipboardlink_control', array( 'label' => esc_html__( 'Flipboard URL', 'gridmode' ), 'section' => 'gridmode_section_social', 'settings' => 'gridmode_options[flipboardlink]', 'type' => 'text' ) );

    $wp_customize->add_setting( 'gridmode_options[bloggerlink]', array( 'default' => '', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'esc_url_raw' ) );

    $wp_customize->add_control( 'gridmode_bloggerlink_control', array( 'label' => esc_html__( 'Blogger URL', 'gridmode' ), 'section' => 'gridmode_section_social', 'settings' => 'gridmode_options[bloggerlink]', 'type' => 'text' ) );

    $wp_customize->add_setting( 'gridmode_options[etsylink]', array( 'default' => '', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'esc_url_raw' ) );

    $wp_customize->add_control( 'gridmode_etsylink_control', array( 'label' => esc_html__( 'Etsy URL', 'gridmode' ), 'section' => 'gridmode_section_social', 'settings' => 'gridmode_options[etsylink]', 'type' => 'text' ) );

    $wp_customize->add_setting( 'gridmode_options[behancelink]', array( 'default' => '', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'esc_url_raw' ) );

    $wp_customize->add_control( 'gridmode_behancelink_control', array( 'label' => esc_html__( 'Behance URL', 'gridmode' ), 'section' => 'gridmode_section_social', 'settings' => 'gridmode_options[behancelink]', 'type' => 'text' ) );

    $wp_customize->add_setting( 'gridmode_options[amazonlink]', array( 'default' => '', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'esc_url_raw' ) );

    $wp_customize->add_control( 'gridmode_amazonlink_control', array( 'label' => esc_html__( 'Amazon URL', 'gridmode' ), 'section' => 'gridmode_section_social', 'settings' => 'gridmode_options[amazonlink]', 'type' => 'text' ) );

    $wp_customize->add_setting( 'gridmode_options[meetuplink]', array( 'default' => '', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'esc_url_raw' ) );

    $wp_customize->add_control( 'gridmode_meetuplink_control', array( 'label' => esc_html__( 'Meetup URL', 'gridmode' ), 'section' => 'gridmode_section_social', 'settings' => 'gridmode_options[meetuplink]', 'type' => 'text' ) );

    $wp_customize->add_setting( 'gridmode_options[mixcloudlink]', array( 'default' => '', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'esc_url_raw' ) );

    $wp_customize->add_control( 'gridmode_mixcloudlink_control', array( 'label' => esc_html__( 'Mixcloud URL', 'gridmode' ), 'section' => 'gridmode_section_social', 'settings' => 'gridmode_options[mixcloudlink]', 'type' => 'text' ) );

    $wp_customize->add_setting( 'gridmode_options[slacklink]', array( 'default' => '', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'esc_url_raw' ) );

    $wp_customize->add_control( 'gridmode_slacklink_control', array( 'label' => esc_html__( 'Slack URL', 'gridmode' ), 'section' => 'gridmode_section_social', 'settings' => 'gridmode_options[slacklink]', 'type' => 'text' ) );

    $wp_customize->add_setting( 'gridmode_options[snapchatlink]', array( 'default' => '', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'esc_url_raw' ) );

    $wp_customize->add_control( 'gridmode_snapchatlink_control', array( 'label' => esc_html__( 'Snapchat URL', 'gridmode' ), 'section' => 'gridmode_section_social', 'settings' => 'gridmode_options[snapchatlink]', 'type' => 'text' ) );

    $wp_customize->add_setting( 'gridmode_options[spotifylink]', array( 'default' => '', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'esc_url_raw' ) );

    $wp_customize->add_control( 'gridmode_spotifylink_control', array( 'label' => esc_html__( 'Spotify URL', 'gridmode' ), 'section' => 'gridmode_section_social', 'settings' => 'gridmode_options[spotifylink]', 'type' => 'text' ) );

    $wp_customize->add_setting( 'gridmode_options[yelplink]', array( 'default' => '', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'esc_url_raw' ) );

    $wp_customize->add_control( 'gridmode_yelplink_control', array( 'label' => esc_html__( 'Yelp URL', 'gridmode' ), 'section' => 'gridmode_section_social', 'settings' => 'gridmode_options[yelplink]', 'type' => 'text' ) );

    $wp_customize->add_setting( 'gridmode_options[wordpresslink]', array( 'default' => '', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'esc_url_raw' ) );

    $wp_customize->add_control( 'gridmode_wordpresslink_control', array( 'label' => esc_html__( 'WordPress URL', 'gridmode' ), 'section' => 'gridmode_section_social', 'settings' => 'gridmode_options[wordpresslink]', 'type' => 'text' ) );

    $wp_customize->add_setting( 'gridmode_options[twitchlink]', array( 'default' => '', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'esc_url_raw' ) );

    $wp_customize->add_control( 'gridmode_twitchlink_control', array( 'label' => esc_html__( 'Twitch URL', 'gridmode' ), 'section' => 'gridmode_section_social', 'settings' => 'gridmode_options[twitchlink]', 'type' => 'text' ) );

    $wp_customize->add_setting( 'gridmode_options[telegramlink]', array( 'default' => '', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'esc_url_raw' ) );

    $wp_customize->add_control( 'gridmode_telegramlink_control', array( 'label' => esc_html__( 'Telegram URL', 'gridmode' ), 'section' => 'gridmode_section_social', 'settings' => 'gridmode_options[telegramlink]', 'type' => 'text' ) );

    $wp_customize->add_setting( 'gridmode_options[bandcamplink]', array( 'default' => '', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'esc_url_raw' ) );

    $wp_customize->add_control( 'gridmode_bandcamplink_control', array( 'label' => esc_html__( 'Bandcamp URL', 'gridmode' ), 'section' => 'gridmode_section_social', 'settings' => 'gridmode_options[bandcamplink]', 'type' => 'text' ) );

    $wp_customize->add_setting( 'gridmode_options[quoralink]', array( 'default' => '', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'esc_url_raw' ) );

    $wp_customize->add_control( 'gridmode_quoralink_control', array( 'label' => esc_html__( 'Quora URL', 'gridmode' ), 'section' => 'gridmode_section_social', 'settings' => 'gridmode_options[quoralink]', 'type' => 'text' ) );

    $wp_customize->add_setting( 'gridmode_options[foursquarelink]', array( 'default' => '', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'esc_url_raw' ) );

    $wp_customize->add_control( 'gridmode_foursquarelink_control', array( 'label' => esc_html__( 'Foursquare URL', 'gridmode' ), 'section' => 'gridmode_section_social', 'settings' => 'gridmode_options[foursquarelink]', 'type' => 'text' ) );

    $wp_customize->add_setting( 'gridmode_options[deviantartlink]', array( 'default' => '', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'esc_url_raw' ) );

    $wp_customize->add_control( 'gridmode_deviantartlink_control', array( 'label' => esc_html__( 'DeviantArt URL', 'gridmode' ), 'section' => 'gridmode_section_social', 'settings' => 'gridmode_options[deviantartlink]', 'type' => 'text' ) );

    $wp_customize->add_setting( 'gridmode_options[imdblink]', array( 'default' => '', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'esc_url_raw' ) );

    $wp_customize->add_control( 'gridmode_imdblink_control', array( 'label' => esc_html__( 'IMDB URL', 'gridmode' ), 'section' => 'gridmode_section_social', 'settings' => 'gridmode_options[imdblink]', 'type' => 'text' ) );

    $wp_customize->add_setting( 'gridmode_options[codepenlink]', array( 'default' => '', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'esc_url_raw' ) );

    $wp_customize->add_control( 'gridmode_codepenlink_control', array( 'label' => esc_html__( 'Codepen URL', 'gridmode' ), 'section' => 'gridmode_section_social', 'settings' => 'gridmode_options[codepenlink]', 'type' => 'text' ) );

    $wp_customize->add_setting( 'gridmode_options[jsfiddlelink]', array( 'default' => '', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'esc_url_raw' ) );

    $wp_customize->add_control( 'gridmode_jsfiddlelink_control', array( 'label' => esc_html__( 'JSFiddle URL', 'gridmode' ), 'section' => 'gridmode_section_social', 'settings' => 'gridmode_options[jsfiddlelink]', 'type' => 'text' ) );

    $wp_customize->add_setting( 'gridmode_options[stackoverflowlink]', array( 'default' => '', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'esc_url_raw' ) );

    $wp_customize->add_control( 'gridmode_stackoverflowlink_control', array( 'label' => esc_html__( 'Stack Overflow URL', 'gridmode' ), 'section' => 'gridmode_section_social', 'settings' => 'gridmode_options[stackoverflowlink]', 'type' => 'text' ) );

    $wp_customize->add_setting( 'gridmode_options[stackexchangelink]', array( 'default' => '', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'esc_url_raw' ) );

    $wp_customize->add_control( 'gridmode_stackexchangelink_control', array( 'label' => esc_html__( 'Stack Exchange URL', 'gridmode' ), 'section' => 'gridmode_section_social', 'settings' => 'gridmode_options[stackexchangelink]', 'type' => 'text' ) );

    $wp_customize->add_setting( 'gridmode_options[bsalink]', array( 'default' => '', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'esc_url_raw' ) );

    $wp_customize->add_control( 'gridmode_bsalink_control', array( 'label' => esc_html__( 'BuySellAds URL', 'gridmode' ), 'section' => 'gridmode_section_social', 'settings' => 'gridmode_options[bsalink]', 'type' => 'text' ) );

    $wp_customize->add_setting( 'gridmode_options[web500pxlink]', array( 'default' => '', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'esc_url_raw' ) );

    $wp_customize->add_control( 'gridmode_web500pxlink_control', array( 'label' => esc_html__( '500px URL', 'gridmode' ), 'section' => 'gridmode_section_social', 'settings' => 'gridmode_options[web500pxlink]', 'type' => 'text' ) );

    $wp_customize->add_setting( 'gridmode_options[ellolink]', array( 'default' => '', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'esc_url_raw' ) );

    $wp_customize->add_control( 'gridmode_ellolink_control', array( 'label' => esc_html__( 'Ello URL', 'gridmode' ), 'section' => 'gridmode_section_social', 'settings' => 'gridmode_options[ellolink]', 'type' => 'text' ) );

    $wp_customize->add_setting( 'gridmode_options[discordlink]', array( 'default' => '', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'esc_url_raw' ) );

    $wp_customize->add_control( 'gridmode_discordlink_control', array( 'label' => esc_html__( 'Discord URL', 'gridmode' ), 'section' => 'gridmode_section_social', 'settings' => 'gridmode_options[discordlink]', 'type' => 'text' ) );

    $wp_customize->add_setting( 'gridmode_options[goodreadslink]', array( 'default' => '', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'esc_url_raw' ) );

    $wp_customize->add_control( 'gridmode_goodreadslink_control', array( 'label' => esc_html__( 'Goodreads URL', 'gridmode' ), 'section' => 'gridmode_section_social', 'settings' => 'gridmode_options[goodreadslink]', 'type' => 'text' ) );

    $wp_customize->add_setting( 'gridmode_options[odnoklassnikilink]', array( 'default' => '', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'esc_url_raw' ) );

    $wp_customize->add_control( 'gridmode_odnoklassnikilink_control', array( 'label' => esc_html__( 'Odnoklassniki URL', 'gridmode' ), 'section' => 'gridmode_section_social', 'settings' => 'gridmode_options[odnoklassnikilink]', 'type' => 'text' ) );

    $wp_customize->add_setting( 'gridmode_options[houzzlink]', array( 'default' => '', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'esc_url_raw' ) );

    $wp_customize->add_control( 'gridmode_houzzlink_control', array( 'label' => esc_html__( 'Houzz URL', 'gridmode' ), 'section' => 'gridmode_section_social', 'settings' => 'gridmode_options[houzzlink]', 'type' => 'text' ) );

    $wp_customize->add_setting( 'gridmode_options[pocketlink]', array( 'default' => '', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'esc_url_raw' ) );

    $wp_customize->add_control( 'gridmode_pocketlink_control', array( 'label' => esc_html__( 'Pocket URL', 'gridmode' ), 'section' => 'gridmode_section_social', 'settings' => 'gridmode_options[pocketlink]', 'type' => 'text' ) );

    $wp_customize->add_setting( 'gridmode_options[xinglink]', array( 'default' => '', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'esc_url_raw' ) );

    $wp_customize->add_control( 'gridmode_xinglink_control', array( 'label' => esc_html__( 'XING URL', 'gridmode' ), 'section' => 'gridmode_section_social', 'settings' => 'gridmode_options[xinglink]', 'type' => 'text' ) );

    $wp_customize->add_setting( 'gridmode_options[googleplaylink]', array( 'default' => '', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'esc_url_raw' ) );

    $wp_customize->add_control( 'gridmode_googleplaylink_control', array( 'label' => esc_html__( 'Google Play URL', 'gridmode' ), 'section' => 'gridmode_section_social', 'settings' => 'gridmode_options[googleplaylink]', 'type' => 'text' ) );

    $wp_customize->add_setting( 'gridmode_options[slidesharelink]', array( 'default' => '', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'esc_url_raw' ) );

    $wp_customize->add_control( 'gridmode_slidesharelink_control', array( 'label' => esc_html__( 'SlideShare URL', 'gridmode' ), 'section' => 'gridmode_section_social', 'settings' => 'gridmode_options[slidesharelink]', 'type' => 'text' ) );

    $wp_customize->add_setting( 'gridmode_options[dropboxlink]', array( 'default' => '', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'esc_url_raw' ) );

    $wp_customize->add_control( 'gridmode_dropboxlink_control', array( 'label' => esc_html__( 'Dropbox URL', 'gridmode' ), 'section' => 'gridmode_section_social', 'settings' => 'gridmode_options[dropboxlink]', 'type' => 'text' ) );

    $wp_customize->add_setting( 'gridmode_options[paypallink]', array( 'default' => '', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'esc_url_raw' ) );

    $wp_customize->add_control( 'gridmode_paypallink_control', array( 'label' => esc_html__( 'PayPal URL', 'gridmode' ), 'section' => 'gridmode_section_social', 'settings' => 'gridmode_options[paypallink]', 'type' => 'text' ) );

    $wp_customize->add_setting( 'gridmode_options[viadeolink]', array( 'default' => '', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'esc_url_raw' ) );

    $wp_customize->add_control( 'gridmode_viadeolink_control', array( 'label' => esc_html__( 'Viadeo URL', 'gridmode' ), 'section' => 'gridmode_section_social', 'settings' => 'gridmode_options[viadeolink]', 'type' => 'text' ) );

    $wp_customize->add_setting( 'gridmode_options[wikipedialink]', array( 'default' => '', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'esc_url_raw' ) );

    $wp_customize->add_control( 'gridmode_wikipedialink_control', array( 'label' => esc_html__( 'Wikipedia URL', 'gridmode' ), 'section' => 'gridmode_section_social', 'settings' => 'gridmode_options[wikipedialink]', 'type' => 'text' ) );

    $wp_customize->add_setting( 'gridmode_options[skypeusername]', array( 'default' => '', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'sanitize_text_field' ) );

    $wp_customize->add_control( 'gridmode_skypeusername_control', array( 'label' => esc_html__( 'Skype Username', 'gridmode' ), 'section' => 'gridmode_section_social', 'settings' => 'gridmode_options[skypeusername]', 'type' => 'text' ) );

    $wp_customize->add_setting( 'gridmode_options[emailaddress]', array( 'default' => '', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'gridmode_sanitize_email' ) );

    $wp_customize->add_control( 'gridmode_emailaddress_control', array( 'label' => esc_html__( 'Email Address', 'gridmode' ), 'section' => 'gridmode_section_social', 'settings' => 'gridmode_options[emailaddress]', 'type' => 'text' ) );

    $wp_customize->add_setting( 'gridmode_options[rsslink]', array( 'default' => '', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'esc_url_raw' ) );

    $wp_customize->add_control( 'gridmode_rsslink_control', array( 'label' => esc_html__( 'RSS Feed URL', 'gridmode' ), 'section' => 'gridmode_section_social', 'settings' => 'gridmode_options[rsslink]', 'type' => 'text' ) );


    /* Share Button options */
    $wp_customize->add_section( 'gridmode_section_share', array( 'title' => esc_html__( 'Share Buttons Options', 'gridmode' ), 'panel' => 'gridmode_main_options_panel', 'priority' => 260 ) );

    $wp_customize->add_setting( 'gridmode_options[share_buttons_home_text]', array( 'default' => '', 'sanitize_callback' => '__return_false', ) );
    
    $wp_customize->add_control( new GridMode_Customize_Static_Text_Control( $wp_customize, 'gridmode_share_buttons_home_text_control', array(
        'label'       => esc_html__( 'Share Buttons on Posts Summaries', 'gridmode' ),
        'section'     => 'gridmode_section_share',
        'settings' => 'gridmode_options[share_buttons_home_text]',
    ) ) );

    $wp_customize->add_setting( 'gridmode_options[hide_share_buttons_home]', array( 'default' => false, 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'gridmode_sanitize_checkbox', ) );

    $wp_customize->add_control( 'gridmode_hide_share_buttons_home_control', array( 'label' => esc_html__( 'Hide Share Buttons from Posts Summaries', 'gridmode' ), 'section' => 'gridmode_section_share', 'settings' => 'gridmode_options[hide_share_buttons_home]', 'type' => 'checkbox', ) );

    $wp_customize->add_setting( 'gridmode_options[hide_share_twitter_home]', array( 'default' => false, 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'gridmode_sanitize_checkbox', ) );

    $wp_customize->add_control( 'gridmode_hide_share_twitter_home_control', array( 'label' => esc_html__( 'Hide Twitter Share Button from Posts Summaries', 'gridmode' ), 'section' => 'gridmode_section_share', 'settings' => 'gridmode_options[hide_share_twitter_home]', 'type' => 'checkbox', ) );

    $wp_customize->add_setting( 'gridmode_options[hide_share_facebook_home]', array( 'default' => false, 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'gridmode_sanitize_checkbox', ) );

    $wp_customize->add_control( 'gridmode_hide_share_facebook_home_control', array( 'label' => esc_html__( 'Hide Facebook Share Button from Posts Summaries', 'gridmode' ), 'section' => 'gridmode_section_share', 'settings' => 'gridmode_options[hide_share_facebook_home]', 'type' => 'checkbox', ) );

    $wp_customize->add_setting( 'gridmode_options[hide_share_pinterest_home]', array( 'default' => false, 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'gridmode_sanitize_checkbox', ) );

    $wp_customize->add_control( 'gridmode_hide_share_pinterest_home_control', array( 'label' => esc_html__( 'Hide Pinterest Share Button from Posts Summaries', 'gridmode' ), 'section' => 'gridmode_section_share', 'settings' => 'gridmode_options[hide_share_pinterest_home]', 'type' => 'checkbox', ) );

    $wp_customize->add_setting( 'gridmode_options[hide_share_linkedin_home]', array( 'default' => false, 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'gridmode_sanitize_checkbox', ) );

    $wp_customize->add_control( 'gridmode_hide_share_linkedin_home_control', array( 'label' => esc_html__( 'Hide Linkedin Share Button from Posts Summaries', 'gridmode' ), 'section' => 'gridmode_section_share', 'settings' => 'gridmode_options[hide_share_linkedin_home]', 'type' => 'checkbox', ) );


    $wp_customize->add_setting( 'gridmode_options[share_buttons_text]', array( 'default' => '', 'sanitize_callback' => '__return_false', ) );
    
    $wp_customize->add_control( new GridMode_Customize_Static_Text_Control( $wp_customize, 'gridmode_share_buttons_text_control', array(
        'label'       => esc_html__( 'Share Buttons on Single Posts', 'gridmode' ),
        'section'     => 'gridmode_section_share',
        'settings' => 'gridmode_options[share_buttons_text]',
    ) ) );

    $wp_customize->add_setting( 'gridmode_options[hide_share_buttons]', array( 'default' => false, 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'gridmode_sanitize_checkbox', ) );

    $wp_customize->add_control( 'gridmode_hide_share_buttons_control', array( 'label' => esc_html__( 'Hide Share Buttons from Single Posts', 'gridmode' ), 'section' => 'gridmode_section_share', 'settings' => 'gridmode_options[hide_share_buttons]', 'type' => 'checkbox', ) );

    $wp_customize->add_setting( 'gridmode_options[hide_share_text]', array( 'default' => false, 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'gridmode_sanitize_checkbox', ) );

    $wp_customize->add_control( 'gridmode_hide_share_text_control', array( 'label' => esc_html__( 'Hide Share Text from Single Posts', 'gridmode' ), 'section' => 'gridmode_section_share', 'settings' => 'gridmode_options[hide_share_text]', 'type' => 'checkbox', ) );

    $wp_customize->add_setting( 'gridmode_options[share_text]', array( 'default' => esc_html__( 'Share:', 'gridmode' ), 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'sanitize_text_field', ) );

    $wp_customize->add_control( 'gridmode_share_text_control', array( 'label' => esc_html__( 'Share Text', 'gridmode' ), 'section' => 'gridmode_section_share', 'settings' => 'gridmode_options[share_text]', 'type' => 'text', ) );

    $wp_customize->add_setting( 'gridmode_options[hide_share_twitter]', array( 'default' => false, 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'gridmode_sanitize_checkbox', ) );

    $wp_customize->add_control( 'gridmode_hide_share_twitter_control', array( 'label' => esc_html__( 'Hide Twitter Share Button from Single Posts', 'gridmode' ), 'section' => 'gridmode_section_share', 'settings' => 'gridmode_options[hide_share_twitter]', 'type' => 'checkbox', ) );

    $wp_customize->add_setting( 'gridmode_options[hide_share_facebook]', array( 'default' => false, 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'gridmode_sanitize_checkbox', ) );

    $wp_customize->add_control( 'gridmode_hide_share_facebook_control', array( 'label' => esc_html__( 'Hide Facebook Share Button from Single Posts', 'gridmode' ), 'section' => 'gridmode_section_share', 'settings' => 'gridmode_options[hide_share_facebook]', 'type' => 'checkbox', ) );

    $wp_customize->add_setting( 'gridmode_options[hide_share_pinterest]', array( 'default' => false, 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'gridmode_sanitize_checkbox', ) );

    $wp_customize->add_control( 'gridmode_hide_share_pinterest_control', array( 'label' => esc_html__( 'Hide Pinterest Share Button from Single Posts', 'gridmode' ), 'section' => 'gridmode_section_share', 'settings' => 'gridmode_options[hide_share_pinterest]', 'type' => 'checkbox', ) );

    $wp_customize->add_setting( 'gridmode_options[hide_share_linkedin]', array( 'default' => false, 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'gridmode_sanitize_checkbox', ) );

    $wp_customize->add_control( 'gridmode_hide_share_linkedin_control', array( 'label' => esc_html__( 'Hide Linkedin Share Button from Single Posts', 'gridmode' ), 'section' => 'gridmode_section_share', 'settings' => 'gridmode_options[hide_share_linkedin]', 'type' => 'checkbox', ) );


    /* Footer options */
    $wp_customize->add_section( 'gridmode_section_footer', array( 'title' => esc_html__( 'Footer Options', 'gridmode' ), 'panel' => 'gridmode_main_options_panel', 'priority' => 280 ) );

    $wp_customize->add_setting( 'gridmode_options[footer_text]', array( 'default' => '', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'gridmode_sanitize_html', ) );

    $wp_customize->add_control( 'gridmode_footer_text_control', array( 'label' => esc_html__( 'Footer copyright notice', 'gridmode' ), 'section' => 'gridmode_section_footer', 'settings' => 'gridmode_options[footer_text]', 'type' => 'text', ) );

    $wp_customize->add_setting( 'gridmode_options[hide_footer_widgets]', array( 'default' => false, 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'gridmode_sanitize_checkbox', ) );

    $wp_customize->add_control( 'gridmode_hide_footer_widgets_control', array( 'label' => esc_html__( 'Hide Footer Widgets', 'gridmode' ), 'section' => 'gridmode_section_footer', 'settings' => 'gridmode_options[hide_footer_widgets]', 'type' => 'checkbox', ) );

    $wp_customize->add_setting( 'gridmode_options[disable_backtotop]', array( 'default' => false, 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'gridmode_sanitize_checkbox', ) );

    $wp_customize->add_control( 'gridmode_disable_backtotop_control', array( 'label' => esc_html__( 'Disable Back to Top Button', 'gridmode' ), 'section' => 'gridmode_section_footer', 'settings' => 'gridmode_options[disable_backtotop]', 'type' => 'checkbox', ) );


    /* 404 options */
    $wp_customize->add_section( 'gridmode_section_search_404', array( 'title' => esc_html__( 'Search and 404 Pages Options', 'gridmode' ), 'panel' => 'gridmode_main_options_panel', 'priority' => 340 ) );

    $wp_customize->add_setting( 'gridmode_options[no_search_heading]', array( 'default' => esc_html__( 'Nothing Found', 'gridmode' ), 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'gridmode_sanitize_html', ) );

    $wp_customize->add_control( 'gridmode_no_search_heading_control', array( 'label' => esc_html__( 'No Search Results Heading', 'gridmode' ), 'description' => esc_html__( 'Enter a heading to display when no search results are found.', 'gridmode' ), 'section' => 'gridmode_section_search_404', 'settings' => 'gridmode_options[no_search_heading]', 'type' => 'text' ) );

    $wp_customize->add_setting( 'gridmode_options[no_search_results]', array( 'default' => esc_html__( 'Sorry, but your search terms did not provide any results. Please try using different keywords this time.', 'gridmode' ), 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'gridmode_sanitize_html', ) );

    $wp_customize->add_control( 'gridmode_no_search_results_control', array( 'label' => esc_html__( 'No Search Results Message', 'gridmode' ), 'description' => esc_html__( 'Enter a message to display when no search results are found.', 'gridmode' ), 'section' => 'gridmode_section_search_404', 'settings' => 'gridmode_options[no_search_results]', 'type' => 'textarea' ) );

    $wp_customize->add_setting( 'gridmode_options[error_404_heading]', array( 'default' => esc_html__( 'Oops! The page you are looking for is not available.', 'gridmode' ), 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'gridmode_sanitize_html', ) );

    $wp_customize->add_control( 'gridmode_error_404_heading_control', array( 'label' => esc_html__( '404 Error Page Heading', 'gridmode' ), 'description' => esc_html__( 'Enter the heading for the 404 error page.', 'gridmode' ), 'section' => 'gridmode_section_search_404', 'settings' => 'gridmode_options[error_404_heading]', 'type' => 'text' ) );

    $wp_customize->add_setting( 'gridmode_options[error_404_message]', array( 'default' => esc_html__( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'gridmode' ), 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'gridmode_sanitize_html', ) );

    $wp_customize->add_control( 'gridmode_error_404_message_control', array( 'label' => esc_html__( 'Error 404 Message', 'gridmode' ), 'description' => esc_html__( 'Enter a message to display on the 404 error page.', 'gridmode' ), 'section' => 'gridmode_section_search_404', 'settings' => 'gridmode_options[error_404_message]', 'type' => 'textarea', ) );

    $wp_customize->add_setting( 'gridmode_options[hide_404_search]', array( 'default' => false, 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'gridmode_sanitize_checkbox', ) );

    $wp_customize->add_control( 'gridmode_hide_404_search_control', array( 'label' => esc_html__( 'Hide Search Box from 404 Page', 'gridmode' ), 'section' => 'gridmode_section_search_404', 'settings' => 'gridmode_options[hide_404_search]', 'type' => 'checkbox', ) );


    /* Other options */
    $wp_customize->add_section( 'gridmode_section_other_options', array( 'title' => esc_html__( 'Other Options', 'gridmode' ), 'panel' => 'gridmode_main_options_panel', 'priority' => 600 ) );

    $wp_customize->add_setting( 'gridmode_options[enable_widgets_block_editor]', array( 'default' => false, 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'gridmode_sanitize_checkbox', ) );

    $wp_customize->add_control( 'gridmode_enable_widgets_block_editor_control', array( 'label' => esc_html__( 'Enable Gutenberg Widget Block Editor', 'gridmode' ), 'section' => 'gridmode_section_other_options', 'settings' => 'gridmode_options[enable_widgets_block_editor]', 'type' => 'checkbox', ) );

    $wp_customize->add_setting( 'gridmode_options[disable_loading_animation]', array( 'default' => false, 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'gridmode_sanitize_checkbox', ) );

    $wp_customize->add_control( 'gridmode_disable_loading_animation_control', array( 'label' => esc_html__( 'Disable Site Loading Animation', 'gridmode' ), 'section' => 'gridmode_section_other_options', 'settings' => 'gridmode_options[disable_loading_animation]', 'type' => 'checkbox', ) );

    $wp_customize->add_setting( 'gridmode_options[disable_fitvids]', array( 'default' => false, 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'gridmode_sanitize_checkbox', ) );

    $wp_customize->add_control( 'gridmode_disable_fitvids_control', array( 'label' => esc_html__( 'Disable FitVids.JS', 'gridmode' ), 'description' => esc_html__( 'You can disable fitvids.js script if you are not using videos on your website or if you do not want fluid width videos in your post content.', 'gridmode' ), 'section' => 'gridmode_section_other_options', 'settings' => 'gridmode_options[disable_fitvids]', 'type' => 'checkbox', ) );


    /* Upgrade to pro options */
    $wp_customize->add_section( 'gridmode_section_upgrade', array( 'title' => esc_html__( 'Upgrade to Pro Version', 'gridmode' ), 'priority' => 400 ) );
    
    $wp_customize->add_setting( 'gridmode_options[upgrade_text]', array( 'default' => '', 'sanitize_callback' => '__return_false', ) );
    
    $wp_customize->add_control( new GridMode_Customize_Static_Text_Control( $wp_customize, 'gridmode_upgrade_text_control', array(
        'label'       => esc_html__( 'GridMode Pro', 'gridmode' ),
        'section'     => 'gridmode_section_upgrade',
        'settings' => 'gridmode_options[upgrade_text]',
        'description' => esc_html__( 'Do you enjoy GridMode? Upgrade to GridMode Pro now and get:', 'gridmode' ).
            '<ul class="gridmode-customizer-pro-features">' .
                '<li><i class="fas fa-check" aria-hidden="true"></i> ' . esc_html__( 'Color Options', 'gridmode' ) . '</li>' .
                '<li><i class="fas fa-check" aria-hidden="true"></i> ' . esc_html__( 'Font Options', 'gridmode' ) . '</li>' .
                '<li><i class="fas fa-check" aria-hidden="true"></i> ' . esc_html__( '1/2/3/4/5/6/7/8/9/10 Columns Options for Posts Grids', 'gridmode' ) . '</li>' .
                '<li><i class="fas fa-check" aria-hidden="true"></i> ' . esc_html__( '10 Thumbnail Sizes Options for Posts Grids', 'gridmode' ) . '</li>' .
                '<li><i class="fas fa-check" aria-hidden="true"></i> ' . esc_html__( 'Custom Thumbnail Size Options for Posts Grids', 'gridmode' ) . '</li>' .
                '<li><i class="fas fa-check" aria-hidden="true"></i> ' . esc_html__( 'Switch between Masonry Grid (JavaScript based) and CSS only Grid', 'gridmode' ) . '</li>' .
                '<li><i class="fas fa-check" aria-hidden="true"></i> ' . esc_html__( 'Display Ads/Custom Contents between Posts in the Grid', 'gridmode' ) . '</li>' .
                '<li><i class="fas fa-check" aria-hidden="true"></i> ' . esc_html__( 'Switch between Boxed or Full Layout Type', 'gridmode' ) . '</li>' .
                '<li><i class="fas fa-check" aria-hidden="true"></i> ' . esc_html__( '10+ Layout Styles for Posts/Pages', 'gridmode' ) . '</li>' .
                '<li><i class="fas fa-check" aria-hidden="true"></i> ' . esc_html__( '10+ Layout Styles for Non-Singular Pages', 'gridmode' ) . '</li>' .
                '<li><i class="fas fa-check" aria-hidden="true"></i> ' . esc_html__( 'Width Change Options for Full Website/Main Content/Left Sidebar/Right Sidebar', 'gridmode' ) . '</li>' .
                '<li><i class="fas fa-check" aria-hidden="true"></i> ' . esc_html__( '10+ Custom Page Templates', 'gridmode' ) . '</li>' .
                '<li><i class="fas fa-check" aria-hidden="true"></i> ' . esc_html__( '10+ Custom Post Templates', 'gridmode' ) . '</li>' .
                '<li><i class="fas fa-check" aria-hidden="true"></i> ' . esc_html__( '8 Header Layouts', 'gridmode' ) . '</li>' .
                '<li><i class="fas fa-check" aria-hidden="true"></i> ' . esc_html__( 'Footer with Layout Options (1/2/3/4/5/6 columns)', 'gridmode' ) . '</li>' .
                '<li><i class="fas fa-check" aria-hidden="true"></i> ' . esc_html__( 'Ability to Change Website Width/Layout Type/Layout Style/Header Style/Footer Style of any Post/Page', 'gridmode' ) . '</li>' .
                '<li><i class="fas fa-check" aria-hidden="true"></i> ' . esc_html__( 'Capability to Add Different Header Images for Each Post/Page with Unique Link, Title and Description', 'gridmode' ) . '</li>' .
                '<li><i class="fas fa-check" aria-hidden="true"></i> ' . esc_html__( 'Grid Featured Posts Widget (Recent/Categories/Tags/PostIDs based) - with capability to display posts according to Likes/Views/Comments/Dates/... and there are many options', 'gridmode' ) . '</li>' .
                '<li><i class="fas fa-check" aria-hidden="true"></i> ' . esc_html__( 'List Featured Posts Widget (Recent/Categories/Tags/PostIDs based) - with capability to display posts according to Likes/Views/Comments/Dates/... and there are many options', 'gridmode' ) . '</li>' .
                '<li><i class="fas fa-check" aria-hidden="true"></i> ' . esc_html__( 'Tabbed Featured Posts Widget (Recent/Categories/Tags/PostIDs based) - with capability to display posts according to Likes/Views/Comments/Dates/... and there are many options.', 'gridmode' ) . '</li>' .
                '<li><i class="fas fa-check" aria-hidden="true"></i> ' . esc_html__( 'About and Social Widget - 60+ Social Buttons', 'gridmode' ) . '</li>' .
                '<li><i class="fas fa-check" aria-hidden="true"></i> ' . esc_html__( 'News Ticker (Recent/Categories/Tags/PostIDs based) - It can display posts according to Likes/Views/Comments/Dates/... and there are many options.', 'gridmode' ) . '</li>' .
                '<li><i class="fas fa-check" aria-hidden="true"></i> ' . esc_html__( 'Settings Panel to Control Options in Each Post', 'gridmode' ) . '</li>' .
                '<li><i class="fas fa-check" aria-hidden="true"></i> ' . esc_html__( 'Settings Panel to Control Options in Each Page', 'gridmode' ) . '</li>' .
                '<li><i class="fas fa-check" aria-hidden="true"></i> ' . esc_html__( 'Built-in Posts Views Counter', 'gridmode' ) . '</li>' .
                '<li><i class="fas fa-check" aria-hidden="true"></i> ' . esc_html__( 'Built-in Posts Likes System', 'gridmode' ) . '</li>' .
                '<li><i class="fas fa-check" aria-hidden="true"></i> ' . esc_html__( 'Built-in Infinite Scroll and Load More Button', 'gridmode' ) . '</li>' .
                '<li><i class="fas fa-check" aria-hidden="true"></i> ' . esc_html__( 'Post Share Buttons Styles with Options - 25+ Social Networks are Supported', 'gridmode' ) . '</li>' .
                '<li><i class="fas fa-check" aria-hidden="true"></i> ' . esc_html__( 'Related Posts (Categories/Tags/Author/PostIDs based) with Many Options - For both single posts and non-grid post summaries', 'gridmode' ) . '</li>' .
                '<li><i class="fas fa-check" aria-hidden="true"></i> ' . esc_html__( 'Sticky Menu/Sticky Sidebars with enable/disable capability', 'gridmode' ) . '</li>' .
                '<li><i class="fas fa-check" aria-hidden="true"></i> ' . esc_html__( 'Author Bio Box with Social Buttons - 60+ Social Buttons', 'gridmode' ) . '</li>' .
                '<li><i class="fas fa-check" aria-hidden="true"></i> ' . esc_html__( 'Ability to Enable/Disable Mobile View from Primary and Secondary Menus', 'gridmode' ) . '</li>' .
                '<li><i class="fas fa-check" aria-hidden="true"></i> ' . esc_html__( 'Post Navigation with Thumbnails', 'gridmode' ) . '</li>' .
                '<li><i class="fas fa-check" aria-hidden="true"></i> ' . esc_html__( 'Ability to add Ads under Post Title and under Post Content', 'gridmode' ) . '</li>' .
                '<li><i class="fas fa-check" aria-hidden="true"></i> ' . esc_html__( 'Ability to Disable Google Fonts - for faster loading', 'gridmode' ) . '</li>' .
                '<li><i class="fas fa-check" aria-hidden="true"></i> ' . esc_html__( 'More Widget Areas', 'gridmode' ) . '</li>' .
                '<li><i class="fas fa-check" aria-hidden="true"></i> ' . esc_html__( 'Built-in Contact Form', 'gridmode' ) . '</li>' .
                '<li><i class="fas fa-check" aria-hidden="true"></i> ' . esc_html__( 'WooCommerce Compatible', 'gridmode' ) . '</li>' .
                '<li><i class="fas fa-check" aria-hidden="true"></i> ' . esc_html__( 'Yoast SEO Breadcrumbs Support', 'gridmode' ) . '</li>' .
                '<li><i class="fas fa-check" aria-hidden="true"></i> ' . esc_html__( 'Full RTL Language Support', 'gridmode' ) . '</li>' .
                '<li><i class="fas fa-check" aria-hidden="true"></i> ' . esc_html__( 'Search Engine Optimized', 'gridmode' ) . '</li>' .
                '<li><i class="fas fa-check" aria-hidden="true"></i> ' . esc_html__( 'Random Posts Button', 'gridmode' ) . '</li>' .
                '<li><i class="fas fa-check" aria-hidden="true"></i> ' . esc_html__( 'Many Useful Customizer Theme options', 'gridmode' ) . '</li>' .
                '<li><i class="fas fa-check" aria-hidden="true"></i> ' . esc_html__( 'More Features...', 'gridmode' ) . '</li>' .
            '</ul>'.
            '<strong><a href="'.GRIDMODE_PROURL.'" class="button button-primary" target="_blank"><i class="fas fa-shopping-cart" aria-hidden="true"></i> ' . esc_html__( 'Upgrade To GridMode PRO', 'gridmode' ) . '</a></strong>'
    ) ) );

}

add_action( 'customize_register', 'gridmode_register_theme_customizer' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function gridmode_customize_partial_blogname() {
    bloginfo( 'name' );
}
/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function gridmode_customize_partial_blogdescription() {
    bloginfo( 'description' );
}

function gridmode_customizer_js_scripts() {
    wp_enqueue_script('gridmode-theme-customizer-js', get_template_directory_uri() . '/assets/js/customizer.js', array( 'jquery', 'customize-preview' ), NULL, true);
}
add_action( 'customize_preview_init', 'gridmode_customizer_js_scripts' );