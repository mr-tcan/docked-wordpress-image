<?php
/*
Plugin Name:  Register Theme Directory
Description:  Register default theme directory
*/
if ( !defined( 'WP_DEFAULT_THEME' ) ) {
  register_theme_directory( ABSPATH . 'wp-content/themes' );
}
