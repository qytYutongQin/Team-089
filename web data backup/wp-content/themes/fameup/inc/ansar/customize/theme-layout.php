<?php /*** Option Panel
 *
 * @package Fameup
 */
$fameup_default = fameup_get_default_theme_options();
/*theme option panel info*/
require get_template_directory() . '/inc/ansar/customize/frontpage-options.php';

// Add Theme Options Panel.
$wp_customize->add_panel('themes_layout',
    array(
        'title' => esc_html__('General Layout', 'fameup'),
        'priority' => 31,
        'capability' => 'edit_theme_options',
    )
);

    //Sidebar Layout
    $wp_customize->add_section( 'fameup_theme_sidebar_setting' , array(
        'title' => __('Sidebar Width', 'fameup'),
        'priority' => 15,
        'panel' => 'themes_layout',
    ) );


    $wp_customize->add_setting('fameup_theme_sidebar_width',
        array(
            'default'           => 355,
            'capability'        => 'edit_theme_options',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );

    $wp_customize->add_control('fameup_theme_sidebar_width',
        array(
            'label'    => esc_html__('Sidebar Width', 'fameup'),
            'section'  => 'fameup_theme_sidebar_setting',
            'type'     => 'number',
            'priority' => 50,
        )
    );

// Blog Layout Setting
$wp_customize->add_section('blog_layout_section',
    array(
        'title' => esc_html__('Blog Layout', 'fameup'),
        'priority' => 30,
        'capability' => 'edit_theme_options',
        'panel' => 'themes_layout',
    )
);

$wp_customize->add_setting(
        'blog_layout_title_settings'
            ,array(
            'capability'        => 'edit_theme_options',
            'sanitize_callback' => 'fameup_sanitize_text',
            'priority' => 1,
        )
    );

    $wp_customize->add_control(
    'blog_layout_title_settings',
        array(
            'type' => 'hidden',
            'label' => __('Blog Layout','fameup'),
            'section' => 'blog_layout_section',
        )
    );


    $wp_customize->add_setting(
        'blog_layout', array(
        'default' => 'default',
        'sanitize_callback' => 'fameup_sanitize_radio'
    ) );
    
    
    $wp_customize->add_control(
        new Fameup_Custom_Radio_Default_Image_Control( 
            // $wp_customize object
            $wp_customize,
            // $id
            'blog_layout',
            // $args
            array(
                'settings'      => 'blog_layout',
                'section'       => 'blog_layout_section',
                'choices'       => array(
                    'default' => get_template_directory_uri() . '/images/blog/blog-list.webp',
                    'three'    => get_template_directory_uri() . '/images/blog/blog-grid.webp',
                    
                )
            )
        )
    );



// Layout Section.
$wp_customize->add_section('site_layout_settings',
    array(
        'title' => esc_html__('Content Layout', 'fameup'),
        'priority' => 35,
        'capability' => 'edit_theme_options',
        'panel' => 'themes_layout',
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