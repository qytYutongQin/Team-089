<?php /*** Option Panel
 *
 * @package Fameup
 */

$fameup_default = fameup_get_default_theme_options();
/*theme option panel info*/
require get_template_directory() . '/inc/ansar/customize/frontpage-options.php';

/**
     * Create a Radio-Image control
     * 
     * This class incorporates code from the Kirki Customizer Framework and from a tutorial
     * written by Otto Wood.
     * 
     * The Kirki Customizer Framework, Copyright Aristeides Stathopoulos (@aristath),
     * is licensed under the terms of the GNU GPL, Version 2 (or later).
     * 
     * @link https://github.com/reduxframework/kirki/
     * @link http://ottopress.com/2012/making-a-custom-control-for-the-theme-customizer/
     */
    class Fameup_Custom_Radio_Default_Image_Control extends WP_Customize_Control {
        
        /**
         * Declare the control type.
         *
         * @access public
         * @var string
         */
        public $type = 'radio-image';
        
        /**
         * Enqueue scripts and styles for the custom control.
         * 
         * Scripts are hooked at {@see 'customize_controls_enqueue_scripts'}.
         * 
         * Note, you can also enqueue stylesheets here as well. Stylesheets are hooked
         * at 'customize_controls_print_styles'.
         *
         * @access public
         */
        public function enqueue() {
            wp_enqueue_script( 'jquery-ui-button' );
        }
        
        /**
         * Render the control to be displayed in the Customizer.
         */
        public function render_content() {
            if ( empty( $this->choices ) ) {
                return;
            }           
            
            $name = '_customize-radio-' . $this->id;
            ?>
            <span class="customize-control-title">
                <?php echo esc_attr( $this->label ); ?>
                <?php if ( ! empty( $this->description ) ) : ?>
                    <span class="description customize-control-description"><?php echo esc_html( $this->description ); ?></span>
                <?php endif; ?>
            </span>
            <div id="input_<?php echo $this->id; ?>" class="image">
                <?php foreach ($this->choices as $value => $label ): ?>
                    <input class="image-select" type="radio" value="<?php echo esc_attr( $value ); ?>" id="<?php echo esc_attr($this->id . $value); ?>" name="<?php echo esc_attr( $name ); ?>" <?php $this->link(); checked( $this->value(), $value ); ?>>
                        <label for="<?php echo esc_attr($this->id . $value); ?>">
                            <img src="<?php echo esc_html( $label ); ?>" alt="<?php echo esc_attr( $value ); ?>" title="<?php echo esc_attr( $value ); ?>">
                        </label>
                    </input>
                <?php endforeach; ?>
            </div>
            <script>jQuery(document).ready(function($) { $( '[id="input_<?php echo esc_attr($this->id); ?>"]' ).buttonset(); });</script>
            <?php
        }
    }

// Add Theme Options Panel.
$wp_customize->add_panel('theme_option_panel',
    array(
        'title' => esc_html__('Theme Options', 'fameup'),
        'priority' => 30,
        'capability' => 'edit_theme_options',
    )
);

// Advertisement Section.
$wp_customize->add_section('frontpage_advertisement_settings',
    array(
        'title' => esc_html__('Banner Advertisement', 'fameup'),
        'capability' => 'edit_theme_options',
        'panel' => 'theme_option_panel',
         'priority' => 1,
    )
);




// Setting banner_advertisement_section.
$wp_customize->add_setting('banner_advertisement_section',
    array(
        'default' => $default['banner_advertisement_section'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'absint',
    )
);




$wp_customize->add_control(
    new WP_Customize_Cropped_Image_Control($wp_customize, 'banner_advertisement_section',
        array(
            'label' => esc_html__('Banner Section Advertisement', 'fameup'),
            'description' => sprintf(esc_html__('Recommended Size %1$s px X %2$s px', 'fameup'), 930, 100),
            'section' => 'frontpage_advertisement_settings',
            'width' => 930,
            'height' => 100,
            'flex_width' => true,
            'flex_height' => true,
        )
    )
);

/*banner_advertisement_section_url*/
$wp_customize->add_setting('banner_advertisement_section_url',
    array(
        'default' => '#',
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'esc_url_raw',
    )
);
$wp_customize->add_control('banner_advertisement_section_url',
    array(
        'label' => esc_html__('URL Link', 'fameup'),
        'section' => 'frontpage_advertisement_settings',
        'type' => 'url',
    )
);

$wp_customize->add_setting('fameup_ad_open_on_new_tab',
    array(
        'default' => true,
        'sanitize_callback' => 'fameup_sanitize_checkbox',
    )
    );
    $wp_customize->add_control(new Fameup_Toggle_Control( $wp_customize, 'fameup_ad_open_on_new_tab', 
        array(
            'label' => esc_html__('Open link in a new tab', 'fameup'),
            'type' => 'toggle',
            'section' => 'frontpage_advertisement_settings',
        )
    ));


$font_family = fameup_typo_fonts();

$font_size = array();
for($i=9; $i<=100; $i++)
{           
    $font_size[$i] = $i;
}

$wp_customize->add_section( 'fameup_typography' , array(
        'title' => __('Typography', 'fameup'),
        'capability' => 'edit_theme_options',
        'panel' => 'theme_option_panel',
        'priority' => 5,
    ) );

$wp_customize->add_setting(
            'fameup_title_fontfamily',
            array(
                'default' => 'Volkhov',
                'capability' => 'edit_theme_options',
                'sanitize_callback' => 'fameup_sanitize_text',
            )
    );
    $wp_customize->add_control('fameup_title_fontfamily', array(
        'label' => esc_html__('Site Title', 'fameup' ),
        'section' => 'fameup_typography',
        'setting' => 'fameup_title_fontfamily',
        'type' => 'select',
        'choices' => $font_family
    ));

    $wp_customize->add_setting(
        'typography_title_settings'
            ,array(
            'capability'        => 'edit_theme_options',
            'sanitize_callback' => 'fameup_sanitize_text',
            'priority' => 1,
        )
    );

    $wp_customize->add_control(
    'typography_title_settings',
        array(
            'type' => 'hidden',
            'label' => __('Sidebar Widgets','fameup'),
            'section' => 'fameup_typography',
        )
    );

    $wp_customize->add_setting(
    'fameup_widget_title_fontfamily',
    array(
        'default'           =>  'Volkhov',
        'sanitize_callback' =>  'fameup_sanitize_text',
    )   
    );
    $wp_customize->add_control('fameup_widget_title_fontfamily', array(
            'label' => __('Title','fameup'),
            'section' => 'fameup_typography',
            'setting' => 'fameup_widget_title_fontfamily',
            'type'    =>  'select',
            'choices'=>$font_family,
    ));

    $wp_customize->add_setting(
    'sidebar_widgets_title_fontsize',
    array(
        'capability'        =>  'edit_theme_options',
        'sanitize_callback' =>  'fameup_sanitize_text',
    )   
        );
    $wp_customize->add_control('sidebar_widgets_title_fontsize', array(
        'label' => __('Font size','fameup'),
        'section' => 'fameup_typography',
        'setting' => 'sidebar_widgets_title_fontsize',
        'type'    =>  'select',
        'choices'=>$font_size,
        'description'=>__('Pixels','fameup')
    ));



    

$wp_customize->add_section( 'header_options' , array(
        'title' => __('Top Bar', 'fameup'),
        'capability' => 'edit_theme_options',
        'panel' => 'theme_option_panel',
        'priority' => 10,
    ) );


$wp_customize->add_setting(
    'top_bar_tabs',
    array(
        'default'           => '',
        'sanitize_callback' => 'esc_attr'
        ));


    $wp_customize->add_control( new Fameup_Custom_Tab_Control ( $wp_customize,'top_bar_tabs',
        array(
            'label'                 => '',
            'type' => 'custom-tab-control',
            'section'               => 'header_options',
            'controls_general'      => json_encode( array( '#customize-control-date_settings','#customize-control-header_data_enable','#customize-control-header_time_enable', '#customize-control-fameup_date_time_show_type','#customize-control-social_settings','#customize-control-header_social_icon_enable','#customize-control-fameup_header_fb_link', '#customize-control-fameup_header_fb_target','#customize-control-fameup_header_twt_link','#customize-control-fameup_header_twt_target','#customize-control-fameup_header_lnkd_link','#customize-control-fameup_header_lnkd_target','#customize-control-fameup_header_insta_link','#customize-control-fameup_insta_insta_target','#customize-control-fameup_header_youtube_link','#customize-control-fameup_header_youtube_target','#customize-control-fameup_header_pintrest_link','#customize-control-fameup_header_pintrest_target','#customize-control-fameup_header_tele_link','#customize-control-fameup_header_tele_target',) ),
                'controls_design'       => json_encode( array( '#customize-control-top_bar_header_background_color','#customize-control-top_bar_header_color',) ),
        )
            
        ));

    $wp_customize->add_setting(
        'date_settings'
            ,array(
            'capability'        => 'edit_theme_options',
            'sanitize_callback' => 'fameup_sanitize_text',
            'priority' => 1,
        )
    );

    $wp_customize->add_control(
    'date_settings',
        array(
            'type' => 'hidden',
            'label' => __('Date','fameup'),
            'section' => 'header_options',
        )
    );

    $wp_customize->add_setting('header_data_enable',
    array(
        'default' => true,
        'sanitize_callback' => 'fameup_sanitize_checkbox',
    )
    );
    $wp_customize->add_control(new Fameup_Toggle_Control( $wp_customize, 'header_data_enable', 
        array(
            'label' => esc_html__('Show Date', 'fameup'),
            'type' => 'toggle',
            'section' => 'header_options',
        )
    ));


     $wp_customize->add_setting('header_time_enable',
    array(
        'default' => true,
        'sanitize_callback' => 'fameup_sanitize_checkbox',
    )
    );
    $wp_customize->add_control(new Fameup_Toggle_Control( $wp_customize, 'header_time_enable', 
        array(
            'label' => esc_html__('Show Time', 'fameup'),
            'type' => 'toggle',
            'section' => 'header_options',
        )
    ));

    
    // date in header display type
    $wp_customize->add_setting( 'fameup_date_time_show_type', array(
        'default'           => 'fameup_default',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'fameup_sanitize_select',
    ) );

    $wp_customize->add_control( 'fameup_date_time_show_type', array(
        'type'     => 'radio',
        'label'    => esc_html__( 'Date in header display type:', 'fameup' ),
        'choices'  => array(
            'fameup_default'          => esc_html__( 'Theme Default Setting', 'fameup' ),
            'wordpress_date_setting' => esc_html__( 'From WordPress Setting', 'fameup' ),
        ),
        'section'  => 'header_options',
        'settings' => 'fameup_date_time_show_type',
    ) );


    $wp_customize->add_setting(
        'social_settings'
            ,array(
            'capability'        => 'edit_theme_options',
            'sanitize_callback' => 'fameup_sanitize_text',
            'priority' => 1,
        )
    );

    $wp_customize->add_control(
    'social_settings',
        array(
            'type' => 'hidden',
            'label' => __('Social Icons','fameup'),
            'section' => 'header_options',
        )
    );

    $wp_customize->add_setting('header_social_icon_enable',
    array(
        'default' => true,
        'sanitize_callback' => 'fameup_sanitize_checkbox',
    )
    );
    $wp_customize->add_control(new Fameup_Toggle_Control( $wp_customize, 'header_social_icon_enable', 
        array(
            'label' => esc_html__('Show Social Icons', 'fameup'),
            'type' => 'toggle',
            'section' => 'header_options',
        )
    ));

    // Soical facebook link
    $wp_customize->add_setting(
    'fameup_header_fb_link',
    array(
        'sanitize_callback' => 'esc_url_raw',
    )
    
    );
    $wp_customize->add_control(
    'fameup_header_fb_link',
    array(
        'label' => __('Facebook URL','fameup'),
        'section' => 'header_options',
        'type' => 'url',
    )
    );

    

    $wp_customize->add_setting('fameup_header_fb_target',
    array(
        'default' => true,
        'sanitize_callback' => 'fameup_sanitize_checkbox',
    )
    );
    $wp_customize->add_control(new Fameup_Toggle_Control( $wp_customize, 'fameup_header_fb_target', 
        array(
            'label' => esc_html__('Open link in a new tab', 'fameup'),
            'type' => 'toggle',
            'section' => 'header_options',
        )
    ));
    
    
    //Social Twitter link
    $wp_customize->add_setting(
    'fameup_header_twt_link',
    array(
        'sanitize_callback' => 'esc_url_raw',
    )
    
    );
    $wp_customize->add_control(
    'fameup_header_twt_link',
    array(
        'label' => __('Twitter URL','fameup'),
        'section' => 'header_options',
        'type' => 'url',
    )
    );

    $wp_customize->add_setting('fameup_header_twt_target',
    array(
        'default' => true,
        'sanitize_callback' => 'fameup_sanitize_checkbox',
    )
    );
    $wp_customize->add_control(new Fameup_Toggle_Control( $wp_customize, 'fameup_header_twt_target', 
        array(
            'label' => esc_html__('Open link in a new tab', 'fameup'),
            'type' => 'toggle',
            'section' => 'header_options',
        )
    ));
    
    //Soical Linkedin link
    $wp_customize->add_setting(
    'fameup_header_lnkd_link',
    array(
        'sanitize_callback' => 'esc_url_raw',
    )
    
    );
    $wp_customize->add_control(
    'fameup_header_lnkd_link',
    array(
        'label' => __('Linkedin URL','fameup'),
        'section' => 'header_options',
        'type' => 'url',
    )
    );

    
    $wp_customize->add_setting('fameup_header_lnkd_target',
    array(
        'default' => true,
        'sanitize_callback' => 'fameup_sanitize_checkbox',
    )
    );
    $wp_customize->add_control(new Fameup_Toggle_Control( $wp_customize, 'fameup_header_lnkd_target', 
        array(
            'label' => esc_html__('Open link in a new tab', 'fameup'),
            'type' => 'toggle',
            'section' => 'header_options',
        )
    ));


    //Soical Instagram link
    $wp_customize->add_setting(
    'fameup_header_insta_link',
    array(
        'sanitize_callback' => 'esc_url_raw',
    )
    
    );
    $wp_customize->add_control(
    'fameup_header_insta_link',
    array(
        'label' => __('Instagram URL','fameup'),
        'section' => 'header_options',
        'type' => 'url',
    )
    );

   $wp_customize->add_setting('fameup_insta_insta_target',
    array(
        'default' => true,
        'sanitize_callback' => 'fameup_sanitize_checkbox',
    )
    );
    $wp_customize->add_control(new Fameup_Toggle_Control( $wp_customize, 'fameup_insta_insta_target', 
        array(
            'label' => esc_html__('Open link in a new tab', 'fameup'),
            'type' => 'toggle',
            'section' => 'header_options',
        )
    ));

    //Soical youtube link
    $wp_customize->add_setting(
    'fameup_header_youtube_link',
    array(
        'sanitize_callback' => 'esc_url_raw',
    )
    
    );
    $wp_customize->add_control(
    'fameup_header_youtube_link',
    array(
        'label' => __('Youtube URL','fameup'),
        'section' => 'header_options',
        'type' => 'url',
    )
    );

    $wp_customize->add_setting('fameup_header_youtube_target',
    array(
        'default' => true,
        'sanitize_callback' => 'fameup_sanitize_checkbox',
    )
    );
    $wp_customize->add_control(new Fameup_Toggle_Control( $wp_customize, 'fameup_header_youtube_target', 
        array(
            'label' => esc_html__('Open link in a new tab', 'fameup'),
            'type' => 'toggle',
            'section' => 'header_options',
        )
    ));

    //Soical Pintrest link
    $wp_customize->add_setting(
    'fameup_header_pintrest_link',
    array(
        'sanitize_callback' => 'esc_url_raw',
    )
    
    );
    $wp_customize->add_control(
    'fameup_header_pintrest_link',
    array(
        'label' => __('Pintrest URL','fameup'),
        'section' => 'header_options',
        'type' => 'url',
    )
    );

    
    $wp_customize->add_setting('fameup_header_pintrest_target',
    array(
        'default' => true,
        'sanitize_callback' => 'fameup_sanitize_checkbox',
    )
    );
    $wp_customize->add_control(new Fameup_Toggle_Control( $wp_customize, 'fameup_header_pintrest_target', 
        array(
            'label' => esc_html__('Open link in a new tab', 'fameup'),
            'type' => 'toggle',
            'section' => 'header_options',
        )
    ));

    //Soical Telegram link
    $wp_customize->add_setting(
    'fameup_header_tele_link',
    array(
        'sanitize_callback' => 'esc_url_raw',
    )
    
    );
    $wp_customize->add_control(
    'fameup_header_tele_link',
    array(
        'label' => __('Telegram URL','fameup'),
        'section' => 'header_options',
        'type' => 'url',
    )
    );

    
    $wp_customize->add_setting('fameup_header_tele_target',
    array(
        'default' => true,
        'sanitize_callback' => 'fameup_sanitize_checkbox',
    )
    );
    $wp_customize->add_control(new Fameup_Toggle_Control( $wp_customize, 'fameup_header_tele_target', 
        array(
            'label' => esc_html__('Open link in a new tab', 'fameup'),
            'type' => 'toggle',
            'section' => 'header_options',
        )
    ));
    

    $wp_customize->add_setting(
    'top_bar_header_background_color',
    array(
        'default'           => '#fff',
        'sanitize_callback' => 'sanitize_hex_color',
    )
);
    $wp_customize->add_control(
    new WP_Customize_Color_Control(
        $wp_customize,
        'top_bar_header_background_color',
        array(
            'label'    => esc_html__( 'Background color', 'fameup' ),
            'section'  => 'header_options',
            'priority'      => 10,
        )
    )
    );

    $wp_customize->add_setting(
    'top_bar_header_color',
    array(
        'default'           => '#000',
        'sanitize_callback' => 'sanitize_hex_color',
    )
    );

    $wp_customize->add_control(
    new WP_Customize_Color_Control(
        $wp_customize,
        'top_bar_header_color',
        array(
            'label'    => esc_html__( 'Text color', 'fameup' ),
            'section'  => 'header_options',
            'priority'      => 10,
        )
    )
    );


//Menu Settings
$wp_customize->add_section( 'menu_options' , array(
        'title' => __('Menu', 'fameup'),
        'capability' => 'edit_theme_options',
        'panel' => 'theme_option_panel',
        'priority' => 15,
    ) );

        $wp_customize->add_setting(
                'menu_settings'
                    ,array(
                    'capability'        => 'edit_theme_options',
                    'sanitize_callback' => 'fameup_sanitize_text',
                    'priority' => 1,
                )
            );

            $wp_customize->add_control(
            'menu_settings',
                array(
                    'type' => 'hidden',
                    'label' => __('Menu','fameup'),
                    'section' => 'menu_options',
                )
            );


    $wp_customize->add_setting('sidebar_menu',
    array(
        'default' => true,
        'sanitize_callback' => 'fameup_sanitize_checkbox',
    )
    );
    $wp_customize->add_control(new Fameup_Toggle_Control( $wp_customize, 'sidebar_menu', 
        array(
            'label' => esc_html__('Sidebar Widget', 'fameup'),
            'type' => 'toggle',
            'section' => 'menu_options',
        )
    ));

    $wp_customize->add_setting('fameup_menu_subscriber',
    array(
        'default' => true,
        'sanitize_callback' => 'fameup_sanitize_checkbox',
    )
    );
    $wp_customize->add_control(new Fameup_Toggle_Control( $wp_customize, 'fameup_menu_subscriber', 
        array(
            'label' => esc_html__('Subscriber Button', 'fameup'),
            'type' => 'toggle',
            'section' => 'menu_options',
        )
    ));

    

    $wp_customize->add_setting('fameup_subsc_title', 
    array(
        'default'           => __('Subscribe','fameup'),
        'sanitize_callback' => 'sanitize_text_field',
        )
    );

    $wp_customize->add_control('fameup_subsc_title',
        array(
            'label' => esc_html__('Title', 'fameup'),
            'section' => 'menu_options',
            'type' => 'text',

        )
    );

    $wp_customize->add_setting('fameup_subsc_link', 
    array(
        'default'           => '#',
        'sanitize_callback' => 'fameup_sanitize_url',
        )
    );

    $wp_customize->add_control('fameup_subsc_link',
        array(
            'label' => esc_html__('Link', 'fameup'),
            'section' => 'menu_options',
            'type' => 'text',

        )
    );

    $wp_customize->add_setting('fameup_menu_search',
    array(
        'default' => true,
        'sanitize_callback' => 'fameup_sanitize_checkbox',
    )
    );
    $wp_customize->add_control(new Fameup_Toggle_Control( $wp_customize, 'fameup_menu_search', 
        array(
            'label' => esc_html__('Search', 'fameup'),
            'type' => 'toggle',
            'section' => 'menu_options',
        )
    ));

    $wp_customize->add_setting('fameup_lite_dark_switcher',
    array(
        'default' => true,
        'sanitize_callback' => 'fameup_sanitize_checkbox',
    )
    );
    $wp_customize->add_control(new Fameup_Toggle_Control( $wp_customize, 'fameup_lite_dark_switcher', 
        array(
            'label' => esc_html__('Show Dark Mode Switcher', 'fameup'),
            'type' => 'toggle',
            'section' => 'menu_options',
        )
    ));


// Setting - Breaking News.
    $wp_customize->add_section('breaking_news',
    array(
        'title' => esc_html__('Breaking News', 'fameup'),
        'priority' => 16,
        'capability' => 'edit_theme_options',
        'panel' => 'theme_option_panel',
    )
    );

    $wp_customize->add_setting(
    'breaking_news_tabs',
    array(
        'default'           => '',
        'sanitize_callback' => 'esc_attr'
        ));


    $wp_customize->add_control( new Fameup_Custom_Tab_Control ( $wp_customize,'breaking_news_tabs',
        array(
            'label'                 => '',
            'type' => 'custom-tab-control',
            'section'               => 'breaking_news',
            'controls_general'      => json_encode( array( '#customize-control-brk_news_enable','#customize-control-fameup_trending_style','#customize-control-fameup_trending_image_enable','#customize-control-breaking_news_title', '#customize-control-select_brk_news_category' ) ),
                'controls_design'       => json_encode( array( '#customize-control-breaking_news_background_color','#customize-control-breaking_news_color',) ),
        )
            
        ));

    $wp_customize->add_setting(
        'breaking_settings'
            ,array(
            'capability'        => 'edit_theme_options',
            'sanitize_callback' => 'fameup_sanitize_text',
            'priority' => 1,
        )
    );

    $wp_customize->add_control(
    'breaking_settings',
        array(
            'type' => 'hidden',
            'label' => __('Breaking News','fameup'),
            'section' => 'breaking_news',
        )
    );


    $wp_customize->add_setting('brk_news_enable',
    array(
        'default' => true,
        'sanitize_callback' => 'fameup_sanitize_checkbox',
    )
    );
    $wp_customize->add_control(new Fameup_Toggle_Control( $wp_customize, 'brk_news_enable', 
        array(
            'label' => esc_html__('Show Breaking News', 'fameup'),
            'type' => 'toggle',
            'section' => 'breaking_news',
        )
    ));
    $wp_customize->add_setting('breaking_news_title',
        array(
            'default' => $fameup_default['breaking_news_title'],
            'capability' => 'edit_theme_options',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );



    $wp_customize->add_control('breaking_news_title',
        array(
            'label' => esc_html__('Title', 'fameup'),
            'section' => 'breaking_news',
            'type' => 'text',
        )
    );

    $wp_customize->add_setting('fameup_trending_style', 
    array(
        'default'           => 'marquee',
        'sanitize_callback' => 'fameup_sanitize_select',
        )
    );

$wp_customize->add_control('fameup_trending_style', 
    array(            
        'section'   => 'breaking_news',
        'type'      => 'radio',
        'choices'   =>  array(
            'marquee'   => __('Marquee', 'fameup'),
            'flip'   => __('Flip', 'fameup'),
            )
        )
    );

	$wp_customize->add_setting('fameup_trending_image_enable',
    array(
        'default' => true,
        'sanitize_callback' => 'fameup_sanitize_checkbox',
    )
    );
    $wp_customize->add_control(new Fameup_Toggle_Control( $wp_customize, 'fameup_trending_image_enable', 
        array(
            'label' => esc_html__('Show Image', 'fameup'),
            'type' => 'toggle',
            'section' => 'breaking_news',
        )
    ));

    // Setting - drop down category for slider.
$wp_customize->add_setting('select_brk_news_category',
    array(
        'default' => $fameup_default['select_brk_news_category'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'absint',
    )
);


$wp_customize->add_control(new Fameup_Dropdown_Taxonomies_Control($wp_customize, 'select_brk_news_category',
    array(
        'label' => esc_html__('Breaking News Posts Category', 'fameup'),
        'description' => esc_html__('Posts to be shown on Breaking posts', 'fameup'),
        'section' => 'breaking_news',
        'type' => 'dropdown-taxonomies',
        'taxonomy' => 'category',
    )));


$wp_customize->add_setting(
    'breaking_news_background_color',
    array(
        'default'           => '#fff',
        'sanitize_callback' => 'sanitize_hex_color',
    )
);
    $wp_customize->add_control(
    new WP_Customize_Color_Control(
        $wp_customize,
        'breaking_news_background_color',
        array(
            'label'    => esc_html__( 'Background color', 'fameup' ),
            'section'  => 'breaking_news',
            'priority'      => 10,
        )
    )
    );

    $wp_customize->add_setting(
    'breaking_news_color',
    array(
        'default'           => '#000',
        'sanitize_callback' => 'sanitize_hex_color',
    )
);
    $wp_customize->add_control(
    new WP_Customize_Color_Control(
        $wp_customize,
        'breaking_news_color',
        array(
            'label'    => esc_html__( 'Text color', 'fameup' ),
            'section'  => 'breaking_news',
            'priority'      => 10,
        )
    )
    );

    

    $wp_customize->add_section( 'general_options' , array(
        'title' => __('General Settings', 'fameup'),
        'capability' => 'edit_theme_options',
        'panel' => 'theme_option_panel',
        'priority' => 20,
    ) );

    
    $wp_customize->add_setting('fameup_wow_animation_enable',
    array(
        'default' => true,
        'sanitize_callback' => 'fameup_sanitize_checkbox',
    )
    );
    $wp_customize->add_control(new Fameup_Toggle_Control( $wp_customize, 'fameup_wow_animation_enable', 
        array(
            'label' => esc_html__('Show Animation', 'fameup'),
            'type' => 'toggle',
            'section' => 'general_options',
        )
    ));


    $wp_customize->add_setting(
        'fameup_scroll_to_top_settings'
            ,array(
            'capability'        => 'edit_theme_options',
            'sanitize_callback' => 'fameup_sanitize_text',
            'priority' => 1,
        )
    );

    $wp_customize->add_control(
    'fameup_scroll_to_top_settings',
        array(
            'type' => 'hidden',
            'label' => __('Scroller','fameup'),
            'section' => 'general_options',
        )
    );

    $wp_customize->add_setting('fameup_scrollup_enable',
    array(
        'default' => true,
        'sanitize_callback' => 'fameup_sanitize_checkbox',
    )
    );
    $wp_customize->add_control(new Fameup_Toggle_Control( $wp_customize, 'fameup_scrollup_enable', 
        array(
            'label' => esc_html__('Show Scroller', 'fameup'),
            'type' => 'toggle',
            'section' => 'general_options',
        )
    ));

    $wp_customize->add_setting(
        'scrollup_layout', array(
        'default' => 'default',
        'sanitize_callback' => 'fameup_sanitize_radio'
    ) );
    
    
    $wp_customize->add_control(
        new Fameup_Custom_Radio_Default_Image_Control( 
            // $wp_customize object
            $wp_customize,
            // $id
            'scrollup_layout',
            // $args
            array(
                'settings'      => 'scrollup_layout',
                'section'       => 'general_options',
                'choices'       => array(
                    'default' => get_template_directory_uri() . '/images/fu1.svg',
                    'two'    => get_template_directory_uri() . '/images/fu2.svg',
                    'three'    => get_template_directory_uri() . '/images/fu3.svg',
                    'four'    => get_template_directory_uri() . '/images/fu4.svg',
                )
            )
        )
    );


    
    function fameup_header_info_sanitize_text( $input ) {

    return wp_kses_post( force_balance_tags( $input ) );

    }
    
    if ( ! function_exists( 'fameup_sanitize_text_content' ) ) :

    /**
     * Sanitize text content.
     *
     * @since 1.0.0
     *
     * @param string               $input Content to be sanitized.
     * @param WP_Customize_Setting $setting WP_Customize_Setting instance.
     * @return string Sanitized content.
     */
    function fameup_sanitize_text_content( $input, $setting ) {

        return ( stripslashes( wp_filter_post_kses( addslashes( $input ) ) ) );

    }
endif;
    
    function fameup_header_sanitize_checkbox( $input ) {
            // Boolean check 
    return ( ( isset( $input ) && true == $input ) ? true : false );
    
    }

/**
 * Layout options section
 *
 * @package fameup
 */


// Header Layout Setting
$wp_customize->add_section('header_layout_settings',
    array(
        'title' => esc_html__('Header Layout Settings', 'fameup'),
        'priority' => 25,
        'capability' => 'edit_theme_options',
        'panel' => 'theme_option_panel',
    )
);



// Layout Section.
$wp_customize->add_section('site_layout_settings',
    array(
        'title' => esc_html__('Content Layout Settings', 'fameup'),
        'priority' => 35,
        'capability' => 'edit_theme_options',
        'panel' => 'theme_option_panel',
    )
);
    

$wp_customize->add_setting(
        'fameup_archive_page_heading'
            ,array(
            'capability'        => 'edit_theme_options',
            'sanitize_callback' => 'fameup_sanitize_text',
            'priority' => 1,
        )
    );

    $wp_customize->add_control(
    'fameup_archive_page_heading',
        array(
            'type' => 'hidden',
            'label' => __('Archive Pages Layout','fameup'),
            'section' => 'site_layout_settings',
        )
    );
    
    $wp_customize->add_setting(
        'fameup_content_layout', array(
        'default'           => 'align-content-right',
        'sanitize_callback' => 'fameup_sanitize_radio'
    ) );
    
    
    $wp_customize->add_control(
        new Fameup_Custom_Radio_Default_Image_Control( 
            // $wp_customize object
            $wp_customize,
            // $id
            'fameup_content_layout',
            // $args
            array(
                'settings'      => 'fameup_content_layout',
                'section'       => 'site_layout_settings',
                'choices'       => array(
                    'align-content-left' => get_template_directory_uri() . '/images/fullwidth-left-sidebar.png',  
                    'full-width-content'    => get_template_directory_uri() . '/images/fullwidth.png',
                    'align-content-right'    => get_template_directory_uri() . '/images/right-sidebar.png',
                    'grid-left-sidebar' => get_template_directory_uri() . '/images/grid-left-sidebar.png',
                    'grid-fullwidth' => get_template_directory_uri() . '/images/grid-fullwidth.png',
                    'grid-right-sidebar' => get_template_directory_uri() . '/images/grid-right-sidebar.png',
                )
            )
        )
    );

    $wp_customize->add_setting(
        'fameup_pro_single_page_heading'
            ,array(
            'capability'        => 'edit_theme_options',
            'sanitize_callback' => 'fameup_sanitize_text',
            'priority' => 1,
        )
    );

    $wp_customize->add_control(
    'fameup_pro_single_page_heading',
        array(
            'type' => 'hidden',
            'label' => __('Single Blog Pages','fameup'),
            'section' => 'site_layout_settings',
        )
    );
    
    $wp_customize->add_setting(
        'fameup_single_page_layout', array(
        'default'           => 'single-align-content-right',
        'sanitize_callback' => 'fameup_sanitize_radio'
    ) );
    
    
    $wp_customize->add_control(
        new Fameup_Custom_Radio_Default_Image_Control( 
            // $wp_customize object
            $wp_customize,
            // $id
            'fameup_single_page_layout',
            // $args
            array(
                'settings'      => 'fameup_single_page_layout',
                'section'       => 'site_layout_settings',
                'choices'       => array(
                    'single-align-content-right'    => get_template_directory_uri() . '/images/right-sidebar.png',
                    'single-align-content-left' => get_template_directory_uri() . '/images/fullwidth-left-sidebar.png',
                   'single-full-width-content'    => get_template_directory_uri() . '/images/fullwidth.png',
                )
            )
        )
    );



//========== date and author options ===============

// Global Section.
$wp_customize->add_section('site_post_date_author_settings',
    array(
        'title' => esc_html__('Blog Page', 'fameup'),
        'priority' => 50,
        'capability' => 'edit_theme_options',
        'panel' => 'theme_option_panel',
    )
);


$wp_customize->add_setting(
    'blog_page_tabs',
    array(
        'default'           => '',
        'sanitize_callback' => 'esc_attr'
        ));


    $wp_customize->add_control( new Fameup_Custom_Tab_Control ( $wp_customize,'blog_page_tabs',
        array(
            'label'                 => '',
            'type' => 'custom-tab-control',
            'section'               => 'site_post_date_author_settings',
            'controls_general'      => json_encode( array( '#customize-control-fameup_post_meta_heading', '#customize-control-fameup_drop_caps_enable','#customize-control-fameup_global_category_enable','#customize-control-fameup_global_comment_enable','#customize-control-global_post_date_author_setting','#customize-control-fameup_post_pagination_heading','#customize-control-fameup_pagination_remove') ),
            'controls_custom'       => json_encode( array( '#customize-control-fameup_blog_post_icon_enable', 
                '#customize-control-fameup_blog_share_facebook_enable', '#customize-control-fameup_blog_share_twitter_enable', 
                '#customize-control-fameup_blog_share_email_enable',  '#customize-control-fameup_blog_share_pintrest_enable', 
                '#customize-control-fameup_blog_share_linkdin_enable','#customize-control-fameup_blog_share_telegram_enable') ),
        )
            
        ));
    
$wp_customize->add_setting(
        'fameup_post_meta_heading'
            ,array(
            'capability'        => 'edit_theme_options',
            'sanitize_callback' => 'fameup_sanitize_text',
            'priority' => 1,
        )
    );

    $wp_customize->add_control(
    'fameup_post_meta_heading',
        array(
            'type' => 'hidden',
            'label' => __('Post Meta','fameup'),
            'section' => 'site_post_date_author_settings',
        )
    );


// Settings = Drop Caps

$wp_customize->add_setting('fameup_drop_caps_enable',
    array(
        'default' => false,
        'sanitize_callback' => 'fameup_sanitize_checkbox',
    )
);
$wp_customize->add_control(new Fameup_Toggle_Control( $wp_customize, 'fameup_drop_caps_enable', 
    array(
        'label' => esc_html__('Drop Caps (First Big Letter)', 'fameup'),
        'type' => 'toggle',
        'section' => 'site_post_date_author_settings',
    )
));

// Setting - global content alignment of news.

$wp_customize->add_setting('fameup_global_category_enable',
    array(
        'default' => true,
        'sanitize_callback' => 'fameup_sanitize_checkbox',
    )
);
$wp_customize->add_control(new Fameup_Toggle_Control( $wp_customize, 'fameup_global_category_enable', 
    array(
        'label' => esc_html__('Category', 'fameup'),
        'type' => 'toggle',
        'section' => 'site_post_date_author_settings',
    )
));



$wp_customize->add_setting('global_post_date_author_setting',
    array(
        'default' => $fameup_default['global_post_date_author_setting'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'fameup_sanitize_select',
    )
);


$wp_customize->add_control('global_post_date_author_setting',
    array(
        'label' => esc_html__('Date and Author', 'fameup'),
        'section' => 'site_post_date_author_settings',
        'type' => 'select',
        'choices' => array(
            'show-date-author' => esc_html__('Show Date and Author', 'fameup'),
            'show-date-only' => esc_html__('Show Date Only', 'fameup'),
            'show-author-only' => esc_html__('Show Author Only', 'fameup'),
            'hide-date-author' => esc_html__('Hide All', 'fameup'),
        ),
    ));


$wp_customize->add_setting('fameup_global_comment_enable',
    array(
        'default' => true,
        'sanitize_callback' => 'fameup_sanitize_checkbox',
    )
);
$wp_customize->add_control(new Fameup_Toggle_Control( $wp_customize, 'fameup_global_comment_enable', 
    array(
        'label' => esc_html__('Comments', 'fameup'),
        'type' => 'toggle',
        'section' => 'site_post_date_author_settings',
    )
));


$wp_customize->add_setting('fameup_blog_post_icon_enable',
    array(
        'default' => true,
        'sanitize_callback' => 'fameup_sanitize_checkbox',
    )
);
$wp_customize->add_control(new Fameup_Toggle_Control( $wp_customize, 'fameup_blog_post_icon_enable', 
    array(
        'label' => esc_html__('Show Sharing Icons', 'fameup'),
        'type' => 'toggle',
        'section' => 'site_post_date_author_settings',
    )
));


    $wp_customize->add_setting(
        'fameup_post_pagination_heading'
            ,array(
            'capability'        => 'edit_theme_options',
            'sanitize_callback' => 'fameup_sanitize_text',
            'priority' => 1,
        )
    );

    $wp_customize->add_control(
    'fameup_post_pagination_heading',
        array(
            'type' => 'hidden',
            'label' => __('Pagination','fameup'),
            'section' => 'site_post_date_author_settings',
        )
    );

    // Setting - Single posts.
    $wp_customize->add_setting('fameup_pagination_remove',
    array(
        'default' => true,
        'sanitize_callback' => 'fameup_sanitize_checkbox',
    )
    );
    $wp_customize->add_control(new Fameup_Toggle_Control( $wp_customize, 'fameup_pagination_remove', 
        array(
            'label' => esc_html__('Show Next Pagination', 'fameup'),
            'type' => 'toggle',
            'section' => 'site_post_date_author_settings',
        )
    ));

// Setting - For Sharing Icon.

$wp_customize->add_setting('fameup_blog_share_facebook_enable',
    array(
        'default' => true,
        'sanitize_callback' => 'fameup_sanitize_checkbox',
    )
);
$wp_customize->add_control(new Fameup_Toggle_Control( $wp_customize, 'fameup_blog_share_facebook_enable', 
    array(
        'label' => esc_html__('Facebook', 'fameup'),
        'type' => 'toggle',
        'section' => 'site_post_date_author_settings',
    )
));

$wp_customize->add_setting('fameup_blog_share_twitter_enable',
    array(
        'default' => true,
        'sanitize_callback' => 'fameup_sanitize_checkbox',
    )
);
$wp_customize->add_control(new Fameup_Toggle_Control( $wp_customize, 'fameup_blog_share_twitter_enable', 
    array(
        'label' => esc_html__('Twitter', 'fameup'),
        'type' => 'toggle',
        'section' => 'site_post_date_author_settings',
    )
));

$wp_customize->add_setting('fameup_blog_share_email_enable',
    array(
        'default' => true,
        'sanitize_callback' => 'fameup_sanitize_checkbox',
    )
);
$wp_customize->add_control(new Fameup_Toggle_Control( $wp_customize, 'fameup_blog_share_email_enable', 
    array(
        'label' => esc_html__('Email', 'fameup'),
        'type' => 'toggle',
        'section' => 'site_post_date_author_settings',
    )
));



$wp_customize->add_setting('fameup_blog_share_linkdin_enable',
    array(
        'default' => true,
        'sanitize_callback' => 'fameup_sanitize_checkbox',
    )
);
$wp_customize->add_control(new Fameup_Toggle_Control( $wp_customize, 'fameup_blog_share_linkdin_enable', 
    array(
        'label' => esc_html__('Linkedin', 'fameup'),
        'type' => 'toggle',
        'section' => 'site_post_date_author_settings',
    )
));

$wp_customize->add_setting('fameup_blog_share_pintrest_enable',
    array(
        'default' => true,
        'sanitize_callback' => 'fameup_sanitize_checkbox',
    )
);
$wp_customize->add_control(new Fameup_Toggle_Control( $wp_customize, 'fameup_blog_share_pintrest_enable', 
    array(
        'label' => esc_html__('Pintrest', 'fameup'),
        'type' => 'toggle',
        'section' => 'site_post_date_author_settings',
    )
));


$wp_customize->add_setting('fameup_blog_share_telegram_enable',
    array(
        'default' => true,
        'sanitize_callback' => 'fameup_sanitize_checkbox',
    )
);
$wp_customize->add_control(new Fameup_Toggle_Control( $wp_customize, 'fameup_blog_share_telegram_enable', 
    array(
        'label' => esc_html__('Telegram', 'fameup'),
        'type' => 'toggle',
        'section' => 'site_post_date_author_settings',
    )
));

//========== single posts options ===============

// Single Section.
$wp_customize->add_section('site_single_posts_settings',
    array(
        'title' => esc_html__('Single Page', 'fameup'),
        'priority' => 50,
        'capability' => 'edit_theme_options',
        'panel' => 'theme_option_panel',
    )
);


    $wp_customize->add_setting(
        'fameup_single_page_heading'
            ,array(
            'capability'        => 'edit_theme_options',
            'sanitize_callback' => 'fameup_sanitize_text',
            'priority' => 1,
        )
    );

    $wp_customize->add_control(
    'fameup_single_page_heading',
        array(
            'type' => 'hidden',
            'label' => __('Single Post','fameup'),
            'section' => 'site_single_posts_settings',
        )
    );

    // Setting - Single posts.
    $wp_customize->add_setting('fameup_single_post_category',
    array(
        'default' => true,
        'sanitize_callback' => 'fameup_sanitize_checkbox',
    )
    );
    $wp_customize->add_control(new Fameup_Toggle_Control( $wp_customize, 'fameup_single_post_category', 
        array(
            'label' => esc_html__('Show Categories', 'fameup'),
            'type' => 'toggle',
            'section' => 'site_single_posts_settings',
        )
    ));


    $wp_customize->add_setting('fameup_single_post_admin_details',
    array(
        'default' => true,
        'sanitize_callback' => 'fameup_sanitize_checkbox',
    )
);
$wp_customize->add_control(new Fameup_Toggle_Control( $wp_customize, 'fameup_single_post_admin_details', 
    array(
        'label' => esc_html__('Show Author Details', 'fameup'),
        'type' => 'toggle',
        'section' => 'site_single_posts_settings',
    )
));


      $wp_customize->add_setting('fameup_single_post_date',
    array(
        'default' => true,
        'sanitize_callback' => 'fameup_sanitize_checkbox',
    )
);
$wp_customize->add_control(new Fameup_Toggle_Control( $wp_customize, 'fameup_single_post_date', 
    array(
        'label' => esc_html__('Show Date', 'fameup'),
        'type' => 'toggle',
        'section' => 'site_single_posts_settings',
    )
));


$wp_customize->add_setting('fameup_single_post_tag',
    array(
        'default' => true,
        'sanitize_callback' => 'fameup_sanitize_checkbox',
    )
);
$wp_customize->add_control(new Fameup_Toggle_Control( $wp_customize, 'fameup_single_post_tag', 
    array(
        'label' => esc_html__('Show Tag', 'fameup'),
        'type' => 'toggle',
        'section' => 'site_single_posts_settings',
    )
));


// Setting - related posts.
    $wp_customize->add_setting('single_show_featured_image',
    array(
        'default' => $fameup_default['single_show_featured_image'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'fameup_sanitize_checkbox',
    )
    );
    $wp_customize->add_control(new Fameup_Toggle_Control( $wp_customize, 'single_show_featured_image', 
        array(
            'label' => __('Show Featured Image', 'fameup'),
            'type' => 'toggle',
            'section' => 'site_single_posts_settings',
        )
    ));


    $wp_customize->add_setting('single_show_share_icon',
    array(
        'default' => $fameup_default['single_show_share_icon'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'fameup_sanitize_checkbox',
    )
    );
    $wp_customize->add_control(new Fameup_Toggle_Control( $wp_customize, 'single_show_share_icon', 
        array(
            'label' => __('Show Sharing Icons', 'fameup'),
            'type' => 'toggle',
            'section' => 'site_single_posts_settings',
        )
    ));

    

    $wp_customize->add_setting(
        'fameup_single_related_post_heading'
            ,array(
            'capability'        => 'edit_theme_options',
            'sanitize_callback' => 'fameup_sanitize_text',
            'priority' => 1,
        )
    );

    $wp_customize->add_control(
    'fameup_single_related_post_heading',
        array(
            'type' => 'hidden',
            'label' => __('Related Post','fameup'),
            'section' => 'site_single_posts_settings',
        )
    );

$wp_customize->add_setting('fameup_enable_related_post',
    array(
        'default' => true,
        'sanitize_callback' => 'fameup_sanitize_checkbox',
    )
);
$wp_customize->add_control(new Fameup_Toggle_Control( $wp_customize, 'fameup_enable_related_post', 
    array(
        'label' => esc_html__('Show Related Posts', 'fameup'),
        'type' => 'toggle',
        'section' => 'site_single_posts_settings',
    )
));

$wp_customize->add_setting('fameup_related_post_title', 
    array(
        'default' => esc_html__('Related Posts', 'fameup'),
        'sanitize_callback' => 'sanitize_text_field',
    )
);
$wp_customize->add_control('fameup_related_post_title', 
    array(
        'label' => esc_html__('Title', 'fameup'),
        'type' => 'text',
        'section' => 'site_single_posts_settings',
    )
);

/************************* Meta Hide Show *********************************/
$wp_customize->add_setting('fameup_enable_single_post_category',
    array(
        'default' => true,
        'sanitize_callback' => 'fameup_sanitize_checkbox',
    )
);
$wp_customize->add_control(new Fameup_Toggle_Control( $wp_customize, 'fameup_enable_single_post_category', 
    array(
        'label' => esc_html__('Show Categories', 'fameup'),
        'type' => 'toggle',
        'section' => 'site_single_posts_settings',
    )
));

$wp_customize->add_setting('fameup_enable_single_post_date',
    array(
        'default' => true,
        'sanitize_callback' => 'fameup_sanitize_checkbox',
    )
);
$wp_customize->add_control(new Fameup_Toggle_Control( $wp_customize, 'fameup_enable_single_post_date', 
    array(
        'label' => esc_html__('Show Date', 'fameup'),
        'type' => 'toggle',
        'section' => 'site_single_posts_settings',
    )
));

$wp_customize->add_setting('fameup_enable_single_post_comments',
    array(
        'default' => true,
        'sanitize_callback' => 'fameup_sanitize_checkbox',
    )
);
$wp_customize->add_control(new Fameup_Toggle_Control( $wp_customize, 'fameup_enable_single_post_comments', 
    array(
        'label' => esc_html__('Show Comments', 'fameup'),
        'type' => 'toggle',
        'section' => 'site_single_posts_settings',
    )
));

$wp_customize->add_setting('fameup_enable_single_post_admin',
    array(
        'default' => true,
        'sanitize_callback' => 'fameup_sanitize_checkbox',
    )
);
$wp_customize->add_control(new Fameup_Toggle_Control( $wp_customize, 'fameup_enable_single_post_admin', 
    array(
        'label' => esc_html__('Show Author Name', 'fameup'),
        'type' => 'toggle',
        'section' => 'site_single_posts_settings',
    )
));


$wp_customize->add_setting('fameup_enable_single_post_admin_details',
    array(
        'default' => true,
        'sanitize_callback' => 'fameup_sanitize_checkbox',
    )
);
$wp_customize->add_control(new Fameup_Toggle_Control( $wp_customize, 'fameup_enable_single_post_admin_details', 
    array(
        'label' => esc_html__('Show Author Details', 'fameup'),
        'type' => 'toggle',
        'section' => 'site_single_posts_settings',
    )
));

//You Missed seciton

 $wp_customize->add_section('you_missed_section',
    array(
        'title' => esc_html__('You Missed Section', 'fameup'),
        'priority' => 100,
        'capability' => 'edit_theme_options',
        'panel' => 'theme_option_panel',
    )
);


     $wp_customize->add_setting(
        'fameup_you_missed_settings'
            ,array(
            'capability'        => 'edit_theme_options',
            'sanitize_callback' => 'fameup_sanitize_text',
            'priority' => 1,
        )
    );

    $wp_customize->add_control(
    'fameup_you_missed_settings',
        array(
            'type' => 'hidden',
            'label' => __('You Missed','fameup'),
            'section' => 'you_missed_section',
        )
    );


    $wp_customize->add_setting('you_missed_enable',
    array(
        'default' => true,
        'sanitize_callback' => 'fameup_sanitize_checkbox',
    )
    );
    $wp_customize->add_control(new Fameup_Toggle_Control( $wp_customize, 'you_missed_enable', 
        array(
            'label' => esc_html__('Show Missed', 'fameup'),
            'type' => 'toggle',
            'section' => 'you_missed_section',
        )
    ));


    // Soical facebook link
    $wp_customize->add_setting(
    'you_missed_title',
    array(
        'default' => esc_html__('You Missed','fameup'),
        'sanitize_callback' => 'sanitize_text_field',
    )
    
    );
    $wp_customize->add_control(
    'you_missed_title',
    array(
        'label' => __('Title','fameup'),
        'section' => 'you_missed_section',
        'type' => 'text',
    )
    );

//========== footer latest blog carousel options ===============

// Footer Section.
    $wp_customize->add_section('footer_options', array(
        'title' => __('Footer Options','fameup'),
        'priority' => 100,
        'panel' => 'theme_option_panel',
    ) );


    $wp_customize->add_setting(
        'fameup_footer_layout', array(
        'default'           => 'footer-default',
        'sanitize_callback' => 'fameup_sanitize_radio'
    ) );
    
    
    $wp_customize->add_control(
        new Fameup_Custom_Radio_Default_Image_Control( 
            // $wp_customize object
            $wp_customize,
            // $id
            'fameup_footer_layout',
            // $args
            array(
                'settings'      => 'fameup_footer_layout',
                'section'       => 'footer_options',
                'choices'       => array(
                    'footer-default' => get_template_directory_uri() . '/images/footers/footer_default.webp',  
                    'footer-insta'    => get_template_directory_uri() . '/images/footers/footer_insta.webp',
                )
            )
        )
    );



    $wp_customize->add_setting('fameup_footer_logo_width',
        array(
            'default'           => 160,
            'capability'        => 'edit_theme_options',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );

    $wp_customize->add_control('fameup_footer_logo_width',
        array(
            'label'    => esc_html__('Logo Width', 'fameup'),
            'section'  => 'footer_options',
            'type'     => 'number',
        )
    );

    $wp_customize->add_setting('fameup_footer_logo_height',
        array(
            'default'           => 70,
            'capability'        => 'edit_theme_options',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );

    $wp_customize->add_control('fameup_footer_logo_height',
        array(
            'label'    => esc_html__('Logo Height', 'fameup'),
            'section'  => 'footer_options',
            'type'     => 'number',
        )
    );
    

    //Footer Background image
    $wp_customize->add_setting( 
        'fameup_footer_widget_background', array(
        'sanitize_callback' => 'esc_url_raw',
    ) );

    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'fameup_footer_widget_background', array(
        'label'    => __( 'Background Image', 'fameup' ),
        'section'  => 'footer_options',
        'settings' => 'fameup_footer_widget_background',
    ) ) );


    //Bqckground Overlay 
   $wp_customize->add_setting(
        'fameup_footer_overlay_color', array( 'sanitize_callback' => 'fameup_alpha_color_custom_sanitization_callback',
        
    ) );
    
    $wp_customize->add_control(new Fameup_Customize_Alpha_Color_Control( $wp_customize,'fameup_footer_overlay_color', array(
       'label'      => __('Overlay Color', 'fameup' ),
        'palette' => true,
        'section' => 'footer_options')
    ) );

     $wp_customize->add_setting(
        'fameup_footer_text_color', array( 'sanitize_callback' => 'sanitize_hex_color',
        
    ) );
    
    $wp_customize->add_control( new Fameup_Customize_Alpha_Color_Control( $wp_customize,'fameup_footer_text_color', array(
       'label'      => __('Text Color', 'fameup' ),
       'palette' => true,
       'section' => 'footer_options'))
    );

    
    $wp_customize->add_setting(
                'fameup_footer_column_layout', array(
                'default' => 3,
                'sanitize_callback' => 'fameup_sanitize_select',
            ) );

            $wp_customize->add_control(
                'fameup_footer_column_layout', array(
                'type' => 'select',
                'label' => __('Select Column Layout','fameup'),
                'section' => 'footer_options',
                'choices' => array(1=>1, 2=>2,3=>3,4=>4),
    ) );
   
    //Enable and disable social icon
    $wp_customize->add_setting('footer_social_icon_enable',
    array(
        'default' => true,
        'sanitize_callback' => 'fameup_sanitize_checkbox',
    )
    );
    $wp_customize->add_control(new Fameup_Toggle_Control( $wp_customize, 'footer_social_icon_enable', 
        array(
            'label' => esc_html__('Show Social Icons', 'fameup'),
            'type' => 'toggle',
            'section' => 'footer_options',
        )
    ));


    // Soical facebook link
    $wp_customize->add_setting(
    'fameup_footer_fb_link',
    array(
        'sanitize_callback' => 'esc_url_raw',
    )
    
    );
    $wp_customize->add_control(
    'fameup_footer_fb_link',
    array(
        'label' => __('Facebook URL','fameup'),
        'section' => 'footer_options',
        'type' => 'text',
    )
    );

   $wp_customize->add_setting('fameup_footer_fb_target',
    array(
        'default' => true,
        'sanitize_callback' => 'fameup_social_sanitize_checkbox',
    )
    );
    $wp_customize->add_control(new Fameup_Toggle_Control( $wp_customize, 'fameup_footer_fb_target', 
        array(
            'label' => esc_html__('Open link in a new tab', 'fameup'),
            'type' => 'toggle',
            'section' => 'footer_options',
        )
    ));

    //Social Twitter link
    $wp_customize->add_setting(
    'fameup_footer_twt_link',
    array(
        'sanitize_callback' => 'esc_url_raw',
    )
    
    );
    $wp_customize->add_control(
    'fameup_footer_twt_link',
    array(
        'label' => __('Twitter URL','fameup'),
        'section' => 'footer_options',
        'type' => 'text',
    )
    );

    
    $wp_customize->add_setting('fameup_footer_twt_target',
    array(
        'default' => true,
        'sanitize_callback' => 'fameup_social_sanitize_checkbox',
    )
    );
    $wp_customize->add_control(new Fameup_Toggle_Control( $wp_customize, 'fameup_footer_twt_target', 
        array(
            'label' => esc_html__('Open link in a new tab', 'fameup'),
            'type' => 'toggle',
            'section' => 'footer_options',
        )
    ));
    
    //Soical Linkedin link
    $wp_customize->add_setting(
    'fameup_footer_lnkd_link',
    array(
        'sanitize_callback' => 'esc_url_raw',
    )
    
    );
    $wp_customize->add_control(
    'fameup_footer_lnkd_link',
    array(
        'label' => __('Linkedin URL','fameup'),
        'section' => 'footer_options',
        'type' => 'text',
    )
    );

    $wp_customize->add_setting('fameup_footer_lnkd_target',
    array(
        'default' => true,
        'sanitize_callback' => 'fameup_social_sanitize_checkbox',
    )
    );
    $wp_customize->add_control(new Fameup_Toggle_Control( $wp_customize, 'fameup_footer_lnkd_target', 
        array(
            'label' => esc_html__('Open link in a new tab', 'fameup'),
            'type' => 'toggle',
            'section' => 'footer_options',
        )
    ));
    
    
    //Soical Instagram link
    $wp_customize->add_setting(
    'fameup_footer_insta_link',
    array(
        'sanitize_callback' => 'esc_url_raw',
    )
    
    );
    $wp_customize->add_control(
    'fameup_footer_insta_link',
    array(
        'label' => __('Instagram URL','fameup'),
        'section' => 'footer_options',
        'type' => 'text',
    )
    );

    $wp_customize->add_setting('fameup_footer_insta_target',
    array(
        'default' => true,
        'sanitize_callback' => 'fameup_social_sanitize_checkbox',
    )
    );
    $wp_customize->add_control(new Fameup_Toggle_Control( $wp_customize, 'fameup_footer_insta_target', 
        array(
            'label' => esc_html__('Open link in a new tab', 'fameup'),
            'type' => 'toggle',
            'section' => 'footer_options',
        )
    ));

    //Soical Youtube link
    $wp_customize->add_setting(
    'fameup_footer_youtube_link',
    array(
        'sanitize_callback' => 'esc_url_raw',
    )
    
    );
    $wp_customize->add_control(
    'fameup_footer_youtube_link',
    array(
        'label' => __('Youtube URL','fameup'),
        'section' => 'footer_options',
        'type' => 'text',
    )
    );

   $wp_customize->add_setting('fameup_footer_youtube_target',
    array(
        'default' => true,
        'sanitize_callback' => 'fameup_social_sanitize_checkbox',
    )
    );
    $wp_customize->add_control(new Fameup_Toggle_Control( $wp_customize, 'fameup_footer_youtube_target', 
        array(
            'label' => esc_html__('Open link in a new tab', 'fameup'),
            'type' => 'toggle',
            'section' => 'footer_options',
        )
    ));

    //Soical Pintrest link
    $wp_customize->add_setting(
    'fameup_footer_pinterest_link',
    array(
        'sanitize_callback' => 'esc_url_raw',
    )
    
    );
    $wp_customize->add_control(
    'fameup_footer_pinterest_link',
    array(
        'label' => __('Pinterest URL','fameup'),
        'section' => 'footer_options',
        'type' => 'text',
    )
    );

    $wp_customize->add_setting('fameup_footer_pinterest_target',
    array(
        'default' => true,
        'sanitize_callback' => 'fameup_social_sanitize_checkbox',
    )
    );
    $wp_customize->add_control(new Fameup_Toggle_Control( $wp_customize, 'fameup_footer_pinterest_target', 
        array(
            'label' => esc_html__('Open link in a new tab', 'fameup'),
            'type' => 'toggle',
            'section' => 'footer_options',
        )
    ));


    //Soical Telegram link
    $wp_customize->add_setting(
    'fameup_footer_tele_link',
    array(
        'sanitize_callback' => 'esc_url_raw',
    )
    
    );
    $wp_customize->add_control(
    'fameup_footer_tele_link',
    array(
        'label' => __('Telegram URL','fameup'),
        'section' => 'footer_options',
        'type' => 'text',
    )
    );

    $wp_customize->add_setting('fameup_footer_tele_target',
    array(
        'default' => true,
        'sanitize_callback' => 'fameup_social_sanitize_checkbox',
    )
    );
    $wp_customize->add_control(new Fameup_Toggle_Control( $wp_customize, 'fameup_footer_tele_target', 
        array(
            'label' => esc_html__('Open link in a new tab', 'fameup'),
            'type' => 'toggle',
            'section' => 'footer_options',
        )
    ));

    
    function fameup_social_sanitize_checkbox( $input ) {
            // Boolean check 
            return ( ( isset( $input ) && true == $input ) ? true : false );
            }
    
            
    if ( ! function_exists( 'fameup_sanitize_select' ) ) :

    /**
     * Sanitize select.
     *
     * @since 1.0.0
     *
     * @param mixed                $input The value to sanitize.
     * @param WP_Customize_Setting $setting WP_Customize_Setting instance.
     * @return mixed Sanitized value.
     */
    function fameup_sanitize_select( $input, $setting ) {

        // Ensure input is a slug.
        $input = sanitize_key( $input );

        // Get list of choices from the control associated with the setting.
        $choices = $setting->manager->get_control( $setting->id )->choices;

        // If the input is a valid key, return it; otherwise, return the default.
        return ( array_key_exists( $input, $choices ) ? $input : $setting->default );

    }

endif;

function fameup_template_page_sanitize_text( $input ) {

            return wp_kses_post( force_balance_tags( $input ) );

}

function fameup_sanitize_url( $url ) {
    return esc_url_raw( $url );
}