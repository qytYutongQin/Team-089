<?php

/**
 * Enqueue scripts and styles.
 */
function bblog_scripts()
{
  // // bootstrap stylesheet.
  wp_enqueue_style('bootstrap', get_template_directory_uri() . '/assets/css/bootstrap.min.css', [], null);

  // // Fontawesome V5 stylesheet.
  wp_enqueue_style('fontawesome-5', get_template_directory_uri() . '/assets/css/all.min.css', [], null);

    // Web font loaded.
    wp_enqueue_style('bblog-fonts', 'https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap', [], null );

  // Theme stylesheet.
  wp_enqueue_style('bblog-style', get_stylesheet_uri(), [], BBLOG_VERSION);

  // Add main stylesheet
  wp_enqueue_style('bblog-main-style', get_template_directory_uri() . '/assets/css/bblog-style.css', [], BBLOG_VERSION);

  // Add responsive stylesheet
  wp_enqueue_style('bblog-responsive', get_template_directory_uri() . '/assets/css/responsive.css', [], null);


  /**
   * Load All jQuery Library
   */
  wp_enqueue_script('bblog-navigation', get_template_directory_uri() . '/assets/js/navigation.js', [], BBLOG_VERSION, true);

  wp_enqueue_script('bblog-bootstrap', get_template_directory_uri() . '/assets/js/bootstrap.min.js', [], BBLOG_VERSION, true);

  wp_enqueue_script('bblog-popper', get_template_directory_uri() . '/assets/js/popper.min.js', [], BBLOG_VERSION, true);

  // Add bblog-main js library
  wp_enqueue_script('bblog-scripts-js', get_template_directory_uri() . '/assets/js/bblog-scripts.js', ['jquery'], '', true);

  if (is_singular() && comments_open() && get_option('thread_comments')) {
    wp_enqueue_script('comment-reply');
  }
}

add_action('wp_enqueue_scripts', 'bblog_scripts');