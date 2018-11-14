<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the
 * installation. You don't have to use the web site, you can
 * copy this file to "wp-config.php" and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */


/**
  * Don't edit this file directly, instead, create a local-config.php file and
  * add your database settings and defines in there. This file contains the
  * production settings
*/
if ( file_exists( dirname( __FILE__ ) . '/wp-config-local.php' ) ) {
  include( dirname( __FILE__ ) . '/wp-config-local.php' );
}


 // ** MySQL settings  ** //
 define( 'DB_NAME', getenv( 'WP_DB_NAME' ) ?: 'wordpress' );
 define( 'DB_USER', getenv( 'WP_DB_USER' ) ?: 'wordpress' );
 define( 'DB_PASSWORD', getenv( 'WP_DB_PASSWORD' ) ?: 'wordpress' );
 define( 'DB_HOST', getenv( 'WP_DB_HOST' ) ?: 'mysql' . ':' . getenv( 'WP_DB_PORT' ) ?: '3306' );
 define( 'DB_CHARSET', 'utf8' );
 define( 'DB_COLLATE', '' );

 /**#@+
  * Authentication Unique Keys and Salts.
  *
  * Change these to different unique phrases!
  * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
  * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
  *
  * @since 2.6.0
  */
define( 'AUTH_KEY',         getenv( 'WP_AUTH_KEY' ) );
define( 'SECURE_AUTH_KEY',  getenv( 'WP_SECURE_AUTH_KEY' ) );
define( 'LOGGED_IN_KEY',    getenv( 'WP_LOGGED_IN_KEY' ) );
define( 'NONCE_KEY',        getenv( 'WP_NONCE_KEY' ) );
define( 'AUTH_SALT',        getenv( 'WP_AUTH_SALT' ) );
define( 'SECURE_AUTH_SALT', getenv( 'WP_SECURE_AUTH_SALT' ) );
define( 'LOGGED_IN_SALT',   getenv( 'WP_LOGGED_IN_SALT' ) );
define( 'NONCE_SALT',       getenv( 'WP_NONCE_SALT' ) );
 /**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = getenv( 'WP_TABLE_PREFIX' ) ?: 'my';


/**
 * WordPress Localized Language, defaults to English.
 *
 * Change this to localize WordPress. A corresponding MO file for the chosen
 * language must be installed to wp-content/languages. For example, install
 * de_DE.mo to wp-content/languages and set WPLANG to 'de_DE' to enable German
 * language support.
 */
define( 'WPLANG', getenv( 'WP_LANG' ) ?: 'en_US' );


/** A couple extra tweaks for HTTPS **/
// You need to alert Wordpress if you're behind a proxy server and using HTTPS
if ( isset( $_SERVER['HTTP_X_FORWARDED_PROTO'] ) && $_SERVER['HTTP_X_FORWARDED_PROTO'] === 'https') {
	$_SERVER['HTTPS'] = 'on';
}

// Define Site and Home URL with or without SSL
if ( isset( $_SERVER['HTTP_HOST'] ) ) {
  // HTTP is still the default scheme for now.
  $scheme = 'http';
  // If we have detected that the end use is HTTPS, make sure we pass that
  // through here, so <img> tags and the like don't generate mixed-mode
  // content warnings.
  if ( $_SERVER['HTTPS'] == 'on' || $_SERVER['REQUEST_SCHEME'] == 'https' ) {
    $scheme = 'https';
    // Force SSL on admin
    define('FORCE_SSL_ADMIN', true);
  }

  define('WP_HOME', $scheme . '://' . $_SERVER['HTTP_HOST']);
  define('WP_SITEURL', $scheme . '://' . $_SERVER['HTTP_HOST']);
}

/* WordPress constants for better performance and security and usability */

// Define max memory usage for WordPress
if ( !defined( 'WP_MEMORY_LIMIT' ) ) {
  define('WP_MEMORY_LIMIT', getenv( 'WP_MEMORY_LIMIT' ) ?: '256M' );
}

// Auto save time interval in seconds
if ( !defined( 'AUTOSAVE_INTERVAL' ) ) {
  define( 'AUTOSAVE_INTERVAL', getenv( 'WP_AUTOSAVE_INTERVAL' ) ?: 120 );
}

// Set number of post revisions to prevent cluttering on database
if ( !defined( 'WP_POST_REVISIONS') ) {
  define( 'WP_POST_REVISIONS', getenv( 'WP_POST_REVISIONS' ) ?: 3 );
}

// Automatic trash cleaning
if ( !defined( 'EMPTY_TRASH_DAYS' ) ) {
  define( 'EMPTY_TRASH_DAYS', getenv( 'WP_EMPTY_TRASH_DAYS' ) ?: 7 ); // 7 days
}

// Disable all core updates
if ( !defined( 'WP_AUTO_UPDATE_CORE') ) {
  define( 'WP_AUTO_UPDATE_CORE', false );
}

// Disable plugin and theme edition
if ( !defined( 'DISALLOW_FILE_EDIT' ) ) {
  define( 'DISALLOW_FILE_EDIT', true );
}

/**
* For developers: WordPress debugging mode.
*/
if ( !defined( 'WP_DEBUG' ) ) {
  define( 'WP_DEBUG', false );
}

/* That's all, stop editing! Happy Pressing. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') ) {
  define('ABSPATH', dirname(__FILE__) . '/');
}

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
