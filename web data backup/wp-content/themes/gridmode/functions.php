<?php
/**
* GridMode functions and definitions.
*
* @link https://developer.wordpress.org/themes/basics/theme-functions/
*
* @package GridMode WordPress Theme
* @copyright Copyright (C) 2022 ThemesDNA
* @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
* @author ThemesDNA <themesdna@gmail.com>
*/

define( 'GRIDMODE_PROURL', 'https://themesdna.com/gridmode-pro-wordpress-theme/' );
define( 'GRIDMODE_CONTACTURL', 'https://themesdna.com/contact/' );
define( 'GRIDMODE_THEMEOPTIONSDIR', trailingslashit( get_template_directory() ) . 'includes' );

require_once( trailingslashit( GRIDMODE_THEMEOPTIONSDIR ) . 'theme-customizer.php' );
require_once( trailingslashit( GRIDMODE_THEMEOPTIONSDIR ) . 'theme-functions.php' );